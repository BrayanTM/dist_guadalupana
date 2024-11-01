<?php

require_once "../modelos/cotizaciones.modelo.php";
require_once "../modelos/ventas.modelo.php";
require_once "../modelos/productos.modelo.php";

require "../vendor/autoload.php";

use Dompdf\Dompdf;


/* ===================================================================================  */
/* P O S T   P E T I C I O N E S  */
/* ===================================================================================  */

if (isset($_POST["accion"])) {

    switch ($_POST["accion"]) {

        case 'obtener_listado_cotizaciones':

            $response = CotizacionesModelo::mdlObtenerListadoCotizaciones($_POST);
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
            break;

        case 'registrar_cotizacion':

            //Datos del comprobante
            $datos_cotizacion = [];
            parse_str($_POST['datos_cotizacion'], $datos_cotizacion);
            $detalle_productos = json_decode($_POST["productos"]);

            $datos_cliente = VentasModelo::mdlObtenerDatosCliente(
                $datos_cotizacion['tipo_documento'],
                $datos_cotizacion['nro_documento'],
                $datos_cotizacion['nombre_cliente_razon_social'],
                $datos_cotizacion['direccion'],
                $datos_cotizacion['telefono']
            );

            $count_items = 0;

            $total = 0;
            $total_iva = 0;
            $total_icbper = 0;
            $detalle_venta = array();

            //RECORREMOS EL DETALLE DE LOS PRODUCTOS DE LA VENTA

            for ($i = 0; $i < count($detalle_productos); $i++) {

                $count_items = $count_items + 1;

                $iva_producto = 0; //EN CASO EL PRODUCTO NO TENGA IVA, SE MANTIENE CON EL VALOR = 0
                $factor_iva = 1; //EN CASO EL PRODUCTO NO TENGA IVA, SE MANTIENE CON EL FACTOR = 1

                if ($detalle_productos[$i]->id_tipo_iva == 12) { //SI ES OPERACION GRAVADA = 12
                    $iva = ProductosModelo::mdlObtenerImpuesto($detalle_productos[$i]->id_tipo_iva);
                    $porcentaje_iva = $iva['impuesto'] / 100; //0.12;
                    $factor_iva = 1 + ($iva['impuesto'] / 100);
                    $iva_producto = $detalle_productos[$i]->precio * $detalle_productos[$i]->cantidad * $porcentaje_iva;
                } else $porcentaje_iva = 0.0; // SI ES INAFECTA O EXONERADA

                $total_impuestos_producto = $iva_producto;

                $afectacion = VentasModelo::ObtenerTipoAfectacionIVA($detalle_productos[$i]->id_tipo_iva);
                $costo_unitario = VentasModelo::ObtenerCostoUnitarioUnidadMedida($detalle_productos[$i]->codigo_producto);

                $producto = array(
                    'item'                  => $count_items,
                    'codigo'                => $detalle_productos[$i]->codigo_producto,
                    'descripcion'           => $detalle_productos[$i]->descripcion,
                    'porcentaje_iva'        => $porcentaje_iva * 100, //Para registrar el IVA que se consideró para la venta
                    'unidad'                => $costo_unitario['id_unidad_medida'], //$detalle_productos[$i]->unidad_medida,
                    'cantidad'              => $detalle_productos[$i]->cantidad,
                    'costo_unitario'        => $costo_unitario['costo_unitario'],
                    'valor_unitario'        => $detalle_productos[$i]->precio, // SIN IVA
                    'precio_unitario'       => $detalle_productos[$i]->precio * $factor_iva, // CON IVA
                    'valor_total'           => $detalle_productos[$i]->precio * $detalle_productos[$i]->cantidad,
                    'iva'                   => $iva_producto,
                    'importe_total'         => $detalle_productos[$i]->precio * $detalle_productos[$i]->cantidad * $factor_iva,
                    'codigos'               => array($afectacion['codigo'], $afectacion['nombre_tributo'])
                );

                array_push($detalle_venta, $producto);

                //CALCULAMOS LOS TOTALES POR TIPO DE OPERACIÓN
                if ($detalle_productos[$i]->id_tipo_iva == 12) {
                    $total = $total + $producto['valor_total'];
                }

                if ($detalle_productos[$i]->id_tipo_iva == 5) {
                    $total = $total + $producto['valor_total'];
                }

                $total_iva = $total_iva + $producto['iva'];
            }

            //OBTENER LA SERIE DEL COMPROBANTE
            $serie = VentasModelo::mdlObtenerSerie($datos_cotizacion['serie']);

            //DATOS DE LA VENTA:
            $cotizacion['id_empresa_emisora']            = $datos_cotizacion["empresa_emisora"];

            $cotizacion['id_serie']                      = $serie['id'];
            $cotizacion['serie']                         = $serie['serie'];
            $cotizacion['correlativo']                   = intval($serie['correlativo']) + 1;
            $cotizacion['fecha_emision']                 = $datos_cotizacion['fecha_emision'];
            $cotizacion['fecha_expiracion']             = $datos_cotizacion['fecha_expiracion'];

            $cotizacion['id_cliente']                    = $datos_cliente["id"];
            $cotizacion['tipo_comprobante']              = $datos_cotizacion["tipo_comprobante"];

            $cotizacion['moneda']                        = $datos_cotizacion["moneda"];
            $cotizacion['tipo_cambio']                   = $datos_cotizacion["tipo_cambio"];
            $cotizacion['tipo_comprobante_a_generar']    = $datos_cotizacion["tipo_comprobante_a_generar"];

            $cotizacion['total_impuestos']               = $total_iva;
            $cotizacion['total_iva']                     = $total_iva;
            $cotizacion['total_sin_impuestos']           = 0.00;
            $cotizacion['total_con_impuestos']           = 0.00;
            $cotizacion['total_a_pagar']                 = $total + $total_iva;

            /*****************************************************************************************
                R E G I S T R A R   C O T I Z A C I O N   Y   D E T A L L E   E N   L A   B D
             *****************************************************************************************/
            $response = CotizacionesModelo::mdlRegistrarCotizacion($cotizacion, $detalle_venta);

            echo json_encode($response);

            break;

        case 'actualizar_cotizacion':

            //Datos del comprobante
            $datos_cotizacion = [];
            parse_str($_POST['datos_cotizacion'], $datos_cotizacion);
            $detalle_productos = json_decode($_POST["productos"]);

            $datos_cliente = VentasModelo::mdlObtenerDatosCliente(
                $datos_cotizacion['tipo_documento'],
                $datos_cotizacion['nro_documento'],
                $datos_cotizacion['nombre_cliente_razon_social'],
                $datos_cotizacion['direccion'],
                $datos_cotizacion['telefono']
            );

            $count_items = 0;

            $total = 0;
            $total_iva = 0;
            $total_icbper = 0;
            $detalle_venta = array();

            //RECORREMOS EL DETALLE DE LOS PRODUCTOS DE LA VENTA

            for ($i = 0; $i < count($detalle_productos); $i++) {

                $count_items = $count_items + 1;

                $iva_producto = 0; //EN CASO EL PRODUCTO NO TENGA IVA, SE MANTIENE CON EL VALOR = 0
                $factor_iva = 1; //EN CASO EL PRODUCTO NO TENGA IVA, SE MANTIENE CON EL FACTOR = 1

                if ($detalle_productos[$i]->id_tipo_iva == 12) { //SI ES OPERACION GRAVADA = 12
                    $iva = ProductosModelo::mdlObtenerImpuesto($detalle_productos[$i]->id_tipo_iva);
                    $porcentaje_iva = $iva['impuesto'] / 100; //0.12;
                    $factor_iva = 1 + ($iva['impuesto'] / 100);
                    $iva_producto = $detalle_productos[$i]->precio * $detalle_productos[$i]->cantidad * $porcentaje_iva;
                } else $porcentaje_iva = 0.0; // SI ES INAFECTA O EXONERADA

                $total_impuestos_producto = $iva_producto;

                $afectacion = VentasModelo::ObtenerTipoAfectacionIVA($detalle_productos[$i]->id_tipo_iva);
                $costo_unitario = VentasModelo::ObtenerCostoUnitarioUnidadMedida($detalle_productos[$i]->codigo_producto);

                $producto = array(
                    'item'                  => $count_items,
                    'codigo'                => $detalle_productos[$i]->codigo_producto,
                    'descripcion'           => $detalle_productos[$i]->descripcion,
                    'porcentaje_iva'        => $porcentaje_iva * 100, //Para registrar el IVA que se consideró para la venta
                    'unidad'                => $costo_unitario['id_unidad_medida'], //$detalle_productos[$i]->unidad_medida,
                    'cantidad'              => $detalle_productos[$i]->cantidad,
                    'costo_unitario'        => $costo_unitario['costo_unitario'],
                    'valor_unitario'        => $detalle_productos[$i]->precio, // SIN IVA
                    'precio_unitario'       => $detalle_productos[$i]->precio * $factor_iva, // CON IVA
                    'valor_total'           => $detalle_productos[$i]->precio * $detalle_productos[$i]->cantidad,
                    'iva'                   => $iva_producto,
                    'importe_total'         => $detalle_productos[$i]->precio * $detalle_productos[$i]->cantidad * $factor_iva,
                    'codigos'               => array($afectacion['codigo'], $afectacion['nombre_tributo'])
                );

                array_push($detalle_venta, $producto);

                //CALCULAMOS LOS TOTALES POR TIPO DE OPERACIÓN
                if ($detalle_productos[$i]->id_tipo_iva == 12) {
                    $total = $total + $producto['valor_total'];
                }

                if ($detalle_productos[$i]->id_tipo_iva == 5) {
                    $total = $total + $producto['valor_total'];
                }

                $total_iva = $total_iva + $producto['iva'];
            }

            //OBTENER LA SERIE DEL COMPROBANTE
            $serie = VentasModelo::mdlObtenerSerie($datos_cotizacion['serie']);

            //DATOS DE LA VENTA:
            $cotizacion['id_empresa_emisora']            = $datos_cotizacion["empresa_emisora"];

            $cotizacion['id_serie']                      = $serie['id'];
            $cotizacion['serie']                         = $serie['serie'];
            $cotizacion['correlativo']                   = intval($serie['correlativo']) + 1;
            $cotizacion['fecha_emision']                 = $datos_cotizacion['fecha_emision'];
            $cotizacion['fecha_expiracion']             = $datos_cotizacion['fecha_expiracion'];

            $cotizacion['id_cliente']                    = $datos_cliente["id"];
            $cotizacion['tipo_comprobante']              = $datos_cotizacion["tipo_comprobante"];

            $cotizacion['moneda']                        = $datos_cotizacion["moneda"];
            $cotizacion['tipo_cambio']                   = $datos_cotizacion["tipo_cambio"];
            $cotizacion['tipo_comprobante_a_generar']    = $datos_cotizacion["tipo_comprobante_a_generar"];

            $cotizacion['total_impuestos']               = $total_iva;
            $cotizacion['total_iva']                     = $total_iva;
            $cotizacion['total_sin_impuestos']           = 0.00;
            $cotizacion['total_con_impuestos']           = 0.00;
            $cotizacion['total_a_pagar']                 = $total + $total_iva;
            $cotizacion['id_cotizacion']                 = $_POST["id_cotizacion"];

            /*****************************************************************************************
            A C T U A L I Z A R   C O T I Z A C I O N   Y   D E T A L L E   E N   L A   B D
             *****************************************************************************************/
            $response = CotizacionesModelo::mdlActualizarCotizacion($cotizacion, $detalle_venta);

            echo json_encode($response);

            break;
        case 'obtener_cotizacion_x_id':

            $response = CotizacionesModelo::mdlObtenerCotizacionPorId($_POST["id_cotizacion"]);

            echo json_encode($response);

            break;

        case 'obtener_detalle_cotizacion_x_id':

            $response = CotizacionesModelo::mdlObtenerDetalleCotizacionPorId($_POST["id_cotizacion"]);

            echo json_encode($response);

            break;

        case 'confirmar_cotizacion':

            $response = CotizacionesModelo::mdlConfirmarCotizacion($_POST["id_cotizacion"]);

            echo json_encode($response);

            break;

        case 'cerrar_cotizacion':

            $response = CotizacionesModelo::mdlCerrarCotizacion($_POST["id_cotizacion"]);

            echo json_encode($response);

            break;

        case 'generar_boleta_cotizacion':

            $id_cotizacion = $_POST["id_cotizacion"];

            // DATOS DE LA COTIZACION:
            $detalle_cotizacion = CotizacionesModelo::mdlDetalleCotizacionBoleta($id_cotizacion);

            // DATOS DEL EMISOR:
            $datos_emisor = VentasModelo::mdlObtenerDatosEmisor($detalle_cotizacion[0]->id_empresa_emisora);

            // DATOS DEL CLIENTE:
            $datos_cliente = VentasModelo::mdlObtenerDatosClientePorId($detalle_cotizacion[0]->id_cliente);

            $count_items = 0;

            $total = 0;
            $total_iva = 0;
            $total_icbper = 0;
            $detalle_venta = array();


            //RECORREMOS EL DETALLE DE LOS PRODUCTOS DE LA COTIZACION:
            for ($i = 0; $i < count($detalle_cotizacion); $i++) {

                $count_items = $count_items + 1;

                $iva_producto = 0; //EN CASO EL PRODUCTO NO TENGA IVA, SE MANTIENE CON EL VALOR = 0
                $factor_iva = 1; //EN CASO EL PRODUCTO NO TENGA IVA, SE MANTIENE CON EL FACTOR = 1

                if ($detalle_productos[$i]->id_tipo_iva == 12) { //SI ES OPERACION GRAVADA = 12
                    $iva = ProductosModelo::mdlObtenerImpuesto($detalle_productos[$i]->id_tipo_iva);
                    $porcentaje_iva = $iva['impuesto'] / 100; //0.12;
                    $factor_iva = 1 + ($iva['impuesto'] / 100);
                    $iva_producto = $detalle_productos[$i]->precio * $detalle_productos[$i]->cantidad * $porcentaje_iva;
                } else $porcentaje_iva = 0.0; // SI ES INAFECTA O EXONERADA

                $total_impuestos_producto = $iva_producto;

                $afectacion = VentasModelo::ObtenerTipoAfectacionIVA($detalle_cotizacion[$i]->id_tipo_iva);
                $costo_unitario = VentasModelo::ObtenerCostoUnitarioUnidadMedida($detalle_cotizacion[$i]->codigo_producto);

                $producto = array(
                    'item'                  => $count_items,
                    'codigo'                => $detalle_cotizacion[$i]->codigo_producto,
                    'descripcion'           => $detalle_cotizacion[$i]->descripcion,
                    'porcentaje_iva'        => $porcentaje_iva * 100, //Para registrar el IVA que se consideró para la venta
                    'unidad'                => $costo_unitario['id_unidad_medida'], //$detalle_cotizacion[$i]->unidad_medida,
                    'cantidad'              => $detalle_cotizacion[$i]->cantidad_final,
                    'costo_unitario'        => $costo_unitario['costo_unitario'],
                    'valor_unitario'        => $detalle_cotizacion[$i]->precio,
                    'precio_unitario'       => $detalle_cotizacion[$i]->precio * $factor_iva,
                    'valor_total'           => $detalle_cotizacion[$i]->precio * $detalle_cotizacion[$i]->cantidad_final,
                    'iva'                   => $iva_producto,
                    'importe_total'         => $detalle_cotizacion[$i]->precio * $detalle_cotizacion[$i]->cantidad_final * $factor_iva,
                    'codigos'               => array($afectacion['codigo'], $afectacion['nombre_tributo'])
                );


                array_push($detalle_venta, $producto);

                //CALCULAMOS LOS TOTALES POR TIPO DE OPERACIÓN
                if ($detalle_productos[$i]->id_tipo_iva == 12) {
                    $total = $total + $producto['valor_total'];
                }

                if ($detalle_productos[$i]->id_tipo_iva == 5) {
                    $total = $total + $producto['valor_total'];
                }

                $total_iva = $total_iva + $iva_producto;
            }

            //OBTENER LA SERIE DE LA BOLETA
            $serie = VentasModelo::mdlObtenerSeriePorTipo('03');

            if ($serie == false) {
                $respuesta['tipo_msj'] = "error";
                $respuesta['msj'] = 'No se ha registrado ninguna serie para Boletas';
                echo json_encode($respuesta);
                return;
            }

            $forma_pago = "Contado";

            //DATOS DE LA VENTA:
            $venta['id_empresa_emisora'] = $datos_emisor["id_empresa"];
            $venta['id_cliente'] = $datos_cliente["id"];
            $venta['tipo_operacion'] = '0101';
            $venta['tipo_comprobante'] = $serie["id_tipo_comprobante"];
            $venta['id_serie'] = $serie['id'];
            $venta['serie'] = $serie['serie'];
            $venta['correlativo'] = intval($serie['correlativo']) + 1;
            $venta['fecha_emision'] = Date('Y-m-d');
            $venta['hora_emision'] = Date('H:i:s');
            $venta['fecha_vencimiento'] = Date('Y-m-d');
            $venta['moneda'] = $detalle_cotizacion[0]->id_moneda;
            $venta['forma_pago'] = $forma_pago;
            $venta['medio_pago'] = '1';
            $venta['monto_credito'] = $total + $total_iva;
            $venta['total_impuestos'] = $total_iva;
            $venta['total_iva'] = round($total_iva, 2);
            $venta['total_sin_impuestos'] = round($total, 2);
            $venta['total_con_impuestos'] = round($total + $total_iva, 2);
            $venta['total_a_pagar'] = round($total + $total_iva, 2);
            $venta['vuelto'] = 0.00;
            $venta['efectivo_recibido'] = $total + $total_iva;
            $venta['cuotas'] = [];

            /*****************************************************************************************
            R E G I S T R A R   V E N T A   Y   D E T A L L E   E N   L A   B D
             *****************************************************************************************/
            $id_venta = VentasModelo::mdlRegistrarVenta($venta, $detalle_venta, $_POST["id_caja"]);

            // var_dump($id_venta);
            // return;

            break;

        case 'generar_factura_cotizacion':

            $id_cotizacion = $_POST["id_cotizacion"];

            // DATOS DE LA COTIZACION:
            $detalle_cotizacion = CotizacionesModelo::mdlDetalleCotizacionBoleta($id_cotizacion);

            // DATOS DEL EMISOR:
            $datos_emisor = VentasModelo::mdlObtenerDatosEmisor($detalle_cotizacion[0]->id_empresa_emisora);

            // DATOS DEL CLIENTE:
            $datos_cliente = VentasModelo::mdlObtenerDatosClientePorId($detalle_cotizacion[0]->id_cliente);

            $count_items = 0;

            $total = 0;
            $total_iva = 0;
            $total_icbper = 0;
            $detalle_venta = array();
            $tipo_cambio = $detalle_cotizacion[0]->tipo_cambio;


            //RECORREMOS EL DETALLE DE LOS PRODUCTOS DE LA COTIZACION:
            for ($i = 0; $i < count($detalle_cotizacion); $i++) {

                $count_items = $count_items + 1;

                $iva_producto = 0; //EN CASO EL PRODUCTO NO TENGA IVA, SE MANTIENE CON EL VALOR = 0
                $factor_iva = 1; //EN CASO EL PRODUCTO NO TENGA IVA, SE MANTIENE CON EL FACTOR = 1

                if ($detalle_productos[$i]->id_tipo_iva == 12) { //SI ES OPERACION GRAVADA = 12
                    $iva = ProductosModelo::mdlObtenerImpuesto($detalle_productos[$i]->id_tipo_iva);
                    $porcentaje_iva = $iva['impuesto'] / 100; //0.12;
                    $factor_iva = 1 + ($iva['impuesto'] / 100);
                    $iva_producto = $detalle_productos[$i]->precio * $detalle_productos[$i]->cantidad * $porcentaje_iva;
                } else $porcentaje_iva = 0.0; // SI ES INAFECTA O EXONERADA

                $total_impuestos_producto = $iva_producto;

                $afectacion = VentasModelo::ObtenerTipoAfectacionIVA($detalle_cotizacion[$i]->id_tipo_iva);
                $costo_unitario = VentasModelo::ObtenerCostoUnitarioUnidadMedida($detalle_cotizacion[$i]->codigo_producto);

                $producto = array(
                    'item'                  => $count_items,
                    'codigo'                => $detalle_cotizacion[$i]->codigo_producto,
                    'descripcion'           => $detalle_cotizacion[$i]->descripcion,
                    'porcentaje_iva'        => $porcentaje_iva * 100, //Para registrar el IVA que se consideró para la venta
                    'unidad'                => $costo_unitario['id_unidad_medida'], //$detalle_cotizacion[$i]->unidad_medida,
                    'cantidad'              => $detalle_cotizacion[$i]->cantidad_final,
                    'costo_unitario'        => $costo_unitario['costo_unitario'],
                    'valor_unitario'        => round($detalle_cotizacion[$i]->precio / $tipo_cambio, 2),
                    'precio_unitario'       => round(($detalle_cotizacion[$i]->precio / $tipo_cambio) * $factor_iva, 2),
                    'valor_total'           => round(($detalle_cotizacion[$i]->precio / $tipo_cambio) * $detalle_cotizacion[$i]->cantidad_final, 2),
                    'iva'                   => round($iva_producto, 2),
                    'importe_total'         => round(($detalle_cotizacion[$i]->precio / $tipo_cambio) * $detalle_cotizacion[$i]->cantidad_final * $factor_iva, 2),
                    'codigos'               => array($afectacion['codigo'], $afectacion['nombre_tributo'])
                );


                array_push($detalle_venta, $producto);

                //CALCULAMOS LOS TOTALES POR TIPO DE OPERACIÓN
                if ($detalle_productos[$i]->id_tipo_iva == 12) {
                    $total = $total + $producto['valor_total'];
                }

                if ($detalle_productos[$i]->id_tipo_iva == 5) {
                    $total = $total + $producto['valor_total'];
                }

                $total_iva = $total_iva + $iva_producto;
            }

            //OBTENER LA SERIE DE LA FACTURA
            $serie = VentasModelo::mdlObtenerSeriePorTipo('01');

            if ($serie == false) {
                $respuesta['tipo_msj'] = "error";
                $respuesta['msj'] = 'No se ha registrado ninguna serie para Facturas';
                echo json_encode($respuesta);
                return;
            }

            $forma_pago = "Contado";

            //DATOS DE LA VENTA:
            $venta['id_empresa_emisora'] = $datos_emisor["id_empresa"];
            $venta['id_cliente'] = $datos_cliente["id"];
            $venta['tipo_operacion'] = '0101';
            $venta['tipo_comprobante'] = $serie["id_tipo_comprobante"];
            $venta['id_serie'] = $serie['id'];
            $venta['serie'] = $serie['serie'];
            $venta['correlativo'] = intval($serie['correlativo']) + 1;
            $venta['fecha_emision'] = Date('Y-m-d');
            $venta['hora_emision'] = Date('H:i:s');
            $venta['fecha_vencimiento'] = Date('Y-m-d');
            $venta['moneda'] = $detalle_cotizacion[0]->id_moneda;
            $venta['forma_pago'] = $forma_pago;
            $venta['medio_pago'] = '1';
            $venta['monto_credito'] = round($total + $total_iva, 2);
            $venta['total_impuestos'] = round($total_iva, 2);
            $venta['total_iva'] = round($total_iva, 2);
            $venta['total_sin_impuestos'] = round($total, 2);
            $venta['total_con_impuestos'] = round($total + $total_iva, 2);
            $venta['total_a_pagar'] = round($total + $total_iva, 2);
            $venta['vuelto'] = 0.00;
            $venta['efectivo_recibido'] = round($total + $total_iva, 2);
            $venta['cuotas'] = [];


            /*****************************************************************************************
                R E G I S T R A R   V E N T A   Y   D E T A L L E   E N   L A   B D
             *****************************************************************************************/
            $id_venta = VentasModelo::mdlRegistrarVenta($venta, $detalle_venta, $_POST["id_caja"]);
            $response = CotizacionesModelo::mdlActualizarEstadoCotizacion($id_cotizacion, 2);
            // var_dump($id_venta);
            // return;

            break;

        case 'eliminar_cotizacion':

            $response = CotizacionesModelo::mdlEliminarCotizacion($_POST["id_cotizacion"]);

            echo json_encode($response);

            break;
    }
}

/* ===================================================================================  */
/* G E T   P E T I C I O N E S  */
/* ===================================================================================  */
if (isset($_GET["accion"])) {

    switch ($_GET["accion"]) {

        case 'generar_cotizacion_a4':


            $cotizacion = CotizacionesModelo::mdlObtenerCotizacionPorIdFormatoA4($_GET["id_cotizacion"]);
            $detalle_cotizacion = CotizacionesModelo::mdlObtenerDetalleCotizacionPorId($_GET["id_cotizacion"]);

            ob_start();

            require "impresion_cotizacion_a4.php";

            $html = ob_get_clean();

            $dompdf = new Dompdf();

            $dompdf->loadHtml($html);
            $dompdf->setpaper('A4');
            $dompdf->render();
            $dompdf->stream('cotizacion_a4.pdf', array('Attachment' => false));

            // $output = $dompdf->output();
            // file_put_contents('../fe/facturas/' .  $venta["nit"] . '-' . trim($venta["id_tipo_comprobante"]) .  '-' . trim($venta["serie"])  .   '-' . $venta["correlativo"] . '.pdf', $dompdf->output());

            break;
    }
}
