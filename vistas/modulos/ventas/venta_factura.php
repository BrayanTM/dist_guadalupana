<!-- Content Header (Page header) -->
<div class="content-header pb-1">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0 fw-bold">FACTURA</h2>
            </div><!-- /.col -->
            <div class="col-sm-6 d-none d-md-block">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                    <li class="breadcrumb-item active">Ventas / Factura</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<div class="content">

    <input type="hidden" name="id_caja" id="id_caja" value="0">

    <div class="container-fluid">

        <form id="frm-datos-venta-factura" class="needs-validation-venta-factura" novalidate>

            <div class="row">

                <div class="col-12 col-lg-6 text-center mb-2">
                    <div class="form-group clearfix w-100 d-flex justify-content-start justify-content-lg-center my-0 ">
                        <div class="icheck-warning d-inline mx-2">
                            <input type="radio" id="rb-venta-envio" value="1" name="rb_generar_venta" checked="">
                            <label for="rb-venta-envio">
                                Generar Venta y Enviar Comprobante Electrónico
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-6 text-center mb-2">
                    <div class="form-group clearfix w-100 d-flex justify-content-start justify-content-lg-center my-0 ">
                        <div class="icheck-success d-inline mx-2">
                            <input type="radio" id="rb-venta" value="2" name="rb_generar_venta">
                            <label for="rb-venta">
                                Solo Generar Venta
                            </label>
                        </div>
                    </div>
                </div>

                <!-- --------------------------------------------------------- -->
                <!-- COMPROBANTE DE PAGO -->
                <!-- --------------------------------------------------------- -->
                <div class="col-12 col-lg-6">

                    <div class="card card-gray shadow mt-4">

                        <div class="card-body px-3 py-3" style="position: relative;">

                            <span class="titulo-fieldset px-3 py-1">COMPROBANTE DE PAGO </span>

                            <div class="row my-1">

                                <!-- EMITIR POR -->
                                <div class="col-12 mb-2">
                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-building mr-1 my-text-color"></i> Empresa Emisora</label>
                                    <select class="form-select" id="empresa_emisora" name="empresa_emisora" aria-label="Floating label select example" required>
                                    </select>
                                    <div class="invalid-feedback">Seleccione Empresa</div>
                                </div>

                                <div class="col-12 col-lg-4 mb-2">
                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-calendar-alt mr-1 my-text-color"></i> Fecha Emisión</label>
                                    <div class="input-group input-group-sm mb-3 ">
                                        <span class="input-group-text" id="inputGroup-sizing-sm" style="cursor: pointer;" data-toggle="datetimepicker" data-target="#fecha_emision"><i class="fas fa-calendar-alt ml-1 text-white"></i></span>
                                        <input type="text" class="form-control form-control-sm datetimepicker-input" style="border-top-right-radius: 20px;border-bottom-right-radius: 20px;" aria-label="Sizing example input" id="fecha_emision" name="fecha_emision" aria-describedby="inputGroup-sizing-sm" required>
                                        <div class="invalid-feedback">Ingrese Fecha de Emisión</div>
                                    </div>
                                </div>


                                <!-- TIPO COMPROBANTE -->
                                <div class="col-12 col-lg-8 mb-2">
                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-file-contract mr-1 my-text-color"></i>Tipo de Comprobante</label>
                                    <select class="form-select" id="tipo_comprobante" name="tipo_comprobante" aria-label="Floating label select example" required readOnly>
                                    </select>
                                    <div class="invalid-feedback">Seleccione Tipo de Comprobante</div>
                                </div>

                                <!-- SERIE -->
                                <div class="col-12 col-lg-4 mb-2">
                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-barcode mr-1 my-text-color"></i>Serie</label>
                                    <select class="form-select" id="serie" name="serie" aria-label="Floating label select example" required>
                                    </select>
                                    <div class="invalid-feedback">Seleccione la Serie</div>
                                </div>

                                <!-- CORRELATIVO -->
                                <div class="col-12 col-lg-4 mb-2">
                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-list-ol mr-1 my-text-color"></i>Correlativo</label>
                                    <input type="text" style="border-radius: 20px;" class="form-control form-control-sm" id="correlativo" name="correlativo" aria-label="Small" aria-describedby="inputGroup-sizing-sm" required readonly>
                                </div>

                                <!-- MONEDA -->
                                <div class="col-12 col-lg-4 mb-2">
                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-money-bill-wave mr-1 my-text-color"></i>Moneda</label>
                                    <select class="form-select" id="moneda" name="moneda" aria-label="Floating label select example" required>
                                    </select>
                                    <div class="invalid-feedback">Seleccione la moneda</div>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>

                <!-- --------------------------------------------------------- -->
                <!-- DATOS DEL CLIENTE -->
                <!-- --------------------------------------------------------- -->
                <div class="col-12 col-lg-6">

                    <div class="card card-gray shadow mt-4">

                        <div class="card-body px-3 py-3" style="position: relative;">

                            <span class="titulo-fieldset px-3 py-1">DATOS DEL CLIENTE </span>

                            <div class="row my-1">

                                <div class="col-12 col-lg-6 mb-2">

                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-file-signature mr-1 my-text-color"></i>Tipo Documento</label>
                                    <select class="form-select" id="tipo_documento" name="tipo_documento" aria-label="Floating label select example" required>
                                    </select>
                                    <div class="invalid-feedback">Seleccione el Tipo de Documento</div>

                                </div>

                                <div class="col-12 col-lg-6 mb-2">

                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-id-card mr-1 my-text-color"></i> Nro Documento</label>
                                    <div class="input-group input-group-sm mb-3 ">
                                        <span class="input-group-text btnConsultarDpi" id="inputGroup-sizing-sm" style="cursor: pointer;"><i class="fas fa-search ml-1 text-white"></i></span>
                                        <input type="text" class="form-control form-control-sm" style="border-top-right-radius: 20px;border-bottom-right-radius: 20px;" aria-label="Sizing example input" id="nro_documento" name="nro_documento" placeholder="Ingrese Nro de documento" aria-describedby="inputGroup-sizing-sm" required>
                                        <div class="invalid-feedback">Ingrese el Nro de Documento</div>
                                    </div>

                                </div>

                                <div class="col-12 mb-2">

                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-user-tie mr-1 my-text-color"></i>Nombre del Cliente/ Razón Social</label>
                                    <input type="text" style="border-radius: 20px;" class="form-control form-control-sm" id="nombre_cliente_razon_social" name="nombre_cliente_razon_social" placeholder="Ingrese Nombre del Cliente o Razón Social" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                </div>

                                <div class="col-12 col-lg-9 mb-2">

                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-map-marker-alt mr-1 my-text-color"></i>Dirección</label>
                                    <input type="text" style="border-radius: 20px;" class="form-control form-control-sm" id="direccion" name="direccion" placeholder="Ingrese la dirección" aria-label="Small" aria-describedby="inputGroup-sizing-sm">

                                </div>

                                <div class="col-12 col-lg-3 mb-2">

                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-phone-alt mr-1 my-text-color"></i>Teléfono</label>
                                    <input type="text" style="border-radius: 20px;" class="form-control form-control-sm" id="telefono" name="telefono" placeholder="Teléfono" aria-label="Small" aria-describedby="inputGroup-sizing-sm">

                                </div>

                            </div>

                        </div>

                    </div>
                </div>

                <!-- --------------------------------------------------------- -->
                <!-- LISTADO DE PRODUCTOS -->
                <!-- --------------------------------------------------------- -->
                <div class="col-12 col-lg-8">

                    <div class="card card-gray shadow mt-4">

                        <div class="card-body px-3 py-3" style="position: relative;">

                            <span class="titulo-fieldset px-3 py-1">LISTADO DE PRODUCTO </span>

                            <div class="row my-1">

                                <div class="d-block col-12 d-lg-none col-lg-12 mb-3">
                                    <div class="col-12 text-center px-2 rounded-3">
                                        <div class="btn fw-bold fs-3  text-warning my-bg w-100" id="totalVenta">Q0.00</div>
                                    </div>
                                </div>

                                <!-- INPUT PARA INGRESO DEL CODIGO DE BARRAS O DESCRIPCION DEL PRODUCTO -->
                                <div class="col-12 mb-2">
                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-cart-plus mr-1 my-text-color"></i>Digite el Producto a vender</label>
                                    <input type="text" placeholder="Ingrese el código de barras o el nombre del producto" style="border-radius: 20px;" class="form-control form-control-sm" id="producto" name="producto" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                </div>

                                <div class="col-12 col-lg-3 mb-2">
                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-file-alt mr-1 my-text-color"></i>Tipo Operación</label>
                                    <select class="form-select" id="tipo_operacion" name="tipo_operacion" aria-label="Floating label select example" required>
                                    </select>
                                    <div class="invalid-feedback">Ingrese el Tipo de Operación</div>
                                </div>

                                <!-- FORMA DE PAGO -->
                                <div class="col-12 col-lg-2 mb-2">
                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="far fa-credit-card mr-1 my-text-color"></i>Forma Pago</label>
                                    <select class="form-select" id="forma_pago" name="forma_pago" aria-label="Floating label select example" required>
                                    </select>
                                    <div class="invalid-feedback">Ingrese Forma de Pago</div>
                                </div>

                                <!-- TOTAL RECIBIDO -->
                                <div class="col-12 col-lg-2 mb-2">
                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-hand-holding-usd mr-1 my-text-color"></i>Recibido</label>
                                    <input type="number" min="0" step="0.01" placeholder="Dinero recibido" style="border-radius: 20px;" class="form-control form-control-sm" id="total_recibido" name="total_recibido" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                </div>

                                <!-- VUELTO -->
                                <div class="col-12 col-lg-2 mb-2">
                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-hand-holding-usd mr-1 my-text-color"></i>Vuelto</label>
                                    <input type="number" min="0" step="0.01" placeholder="Vuelto" style="border-radius: 20px;" class="form-control form-control-sm" id="vuelto" name="vuelto" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                </div>

                                <!-- MEDIO DE PAGO -->
                                <div class="col-12 col-lg-3 mb-2">
                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="far fa-credit-card mr-1 my-text-color"></i>Medio Pago</label>
                                    <select class="form-select" id="medio_pago" name="medio_pago" aria-label="Floating label select example" required>
                                    </select>
                                    <div class="invalid-feedback">Ingrese Medio Pago</div>
                                </div>

                                <!-- LISTADO QUE CONTIENE LOS PRODUCTOS QUE SE VAN AGREGANDO PARA LA COMPRA -->
                                <div class="col-md-12 mt-2">

                                    <table id="tbl_ListadoProductos" class="display nowrap table-striped w-100 shadow" style="font-size: 14px;">
                                        <thead class="bg-main">
                                            <tr>
                                                <th>ITEM</th>
                                                <th>CÓDIGO</th>
                                                <th>DESCRIPCIÓN</th>
                                                <th>ID TIPO IVA</th>
                                                <th>TIPO IVA</th>
                                                <th>UND/MEDIDA</th>
                                                <th>VALOR</th>
                                                <th>CANTIDAD</th>
                                                <th>SUBTOTAL</th>
                                                <th>IVA</th>
                                                <th>IMPORTE</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody style="font-size: 15px;">
                                        </tbody>
                                    </table>
                                    <!-- / table -->
                                </div>


                                <!-- /.col -->
                            </div>
                        </div> <!-- ./ end card-body -->
                    </div>
                </div>

                <!-- --------------------------------------------------------- -->
                <!-- RESUMEN DE LA VENTA -->
                <!-- --------------------------------------------------------- -->
                <div class="col-12 col-lg-4">

                    <div class="row">

                        <div class="col-12">
                            <!-- --------------------------------------------------------- -->
                            <!-- RESUMEN DE LA VENTA -->
                            <!-- --------------------------------------------------------- -->
                            <div class="card card-gray shadow mt-4">

                                <div class="card-body px-3 py-3" style="position: relative;">

                                    <span class="titulo-fieldset px-3 py-1">DETALLE DE VENTA </span>

                                    <div class="row my-1 fw-bold">

                                        <div class="col-12 col-md-12">
                                            <span>SUBTOTAL</span>
                                            <span class="float-right" id="resumen_subtotal">Q 0.00</span>
                                        </div>
                                        <div class="col-12 col-md-12">
                                            <span>IVA</span>
                                            <span class="float-right" id="resumen_total_iva">Q 0.00</span>
                                            <hr class="m-1" />
                                        </div>

                                        <div class="col-12 col-md-12 fs-4 my-color">
                                            <span>TOTAL</span>
                                            <span class="float-right " id="resumen_total_venta">Q
                                                0.00</span>
                                        </div>

                                    </div>

                                </div>

                            </div>
                        </div>

                        <div class="col-12 text-center my-1">
                            <a class="btn btn-sm btn-danger  fw-bold " id="btnCancelarVenta" style="position: relative; width: 160px;">
                                <span class="text-button">CANCELAR</span>
                                <span class="btn fw-bold icon-btn-danger d-flex align-items-center">
                                    <i class="fas fa-times fs-5 text-white m-0 p-0"></i>
                                </span>
                            </a>

                            <a class="btn btn-sm btn-success  fw-bold " id="btnGuardarComprobante" style="position: relative; width: 160px;">
                                <span class="text-button">VENDER</span>
                                <span class="btn fw-bold icon-btn-success d-flex align-items-center">
                                    <i class="fas fa-save fs-5 text-white m-0 p-0"></i>
                                </span>
                            </a>
                        </div>

                    </div>

                </div>

            </div>

        </form>

    </div>

</div>


<div class="loading">Loading</div>

<script>
    //Variables Globales
    var itemProducto = 1;
    var $simbolo_moneda = '';

    var $today = new Date();
    var $date = $today.getFullYear() + '-0' + ($today.getMonth() + 1) + '-' + $today.getDate();

    $(document).ready(function() {

        fnc_MostrarLoader();

        /*===================================================================*/
        // V E R I F I C A R   E M P R E S A S   R E G I S T R A D A S
        /*===================================================================*/
        fnc_VerificarEmpresasRegistradas();

        /*===================================================================*/
        // V E R I F I C A R   E L   E S T A D O   D E   L A   C A J A
        /*===================================================================*/
        fnc_ObtenerEstadoCajaPorDia()

        /*===================================================================*/
        // I N I C I A L I Z A R   F O R M U L A R I O 
        /*===================================================================*/
        fnc_InicializarFormulario();

        $('#empresa_emisora').on('change', function(e) {
            fnc_VerificarEmpresaFacturacionElectronica();
        });


        $('#tipo_comprobante').on('change', function(e) {
            $("#correlativo").val('')
            CargarSelect(null, $("#serie"), "--Seleccione Serie--", "ajax/ventas.ajax.php", 'obtener_serie_comprobante', $('#tipo_comprobante').val());

        });

        $('#tipo_documento').on('change', function(e) {

            fnc_CargarAutocompleteClientes()

            $("#nro_documento").val('')
            $("#nombre_cliente_razon_social").val('')
            $("#direccion").val('')
            $("#telefono").val('')

            if ($('#tipo_documento').val() == 0) {
                fnc_BloquearDatosCliente(true)
            } else {
                fnc_BloquearDatosCliente(false)
            }

        });

        $('#serie').on('change', function(e) {
            fnc_ObtenerCorrelativo($("#serie").val())
        })

        $(".btnConsultarDpi").on('click', function() {
            fnc_ConsultarNroDocumento($("#nro_documento").val());
        })

        $("#nro_documento").on('keypress', function(e) {
            if (e.which == 13) {
                fnc_ConsultarNroDocumento($("#nro_documento").val())
            }
        });

        $("#direccion").on('keypress', function(e) {
            if (e.which == 13) {
                $("#telefono").focus();
            }
        });

        $("#telefono").on('keypress', function(e) {
            if (e.which == 13) {
                $("#producto").focus();
            }
        });

        $("#total_recibido").on("keyup", function() {
            $total_venta = parseFloat($("#resumen_total_venta").html().replace('Q', '')).toFixed(2);

            console.log('TOTAL V.', $total_venta)

            $total_recibido = parseFloat($("#total_recibido").val());

            console.log('TOTAL R.', $total_recibido)

            if ($total_recibido >= $total_venta) {
                $("#vuelto").val(parseFloat($total_recibido - $total_venta).toFixed(2));

                console.log('VUELTO', $total_recibido - $total_venta)
            }
        })


        $("#total_recibido").change(function() {
            $total_venta = $("#totalVenta").html().replace('Q', '');
            $total_recibido = parseFloat($("#total_recibido").val());

            if ($total_recibido < $total_venta) {
                mensajeToast("warning", "El monto recibido es menor al valor de la venta");
                $("#total_recibido").val('')
                $("#total_recibido").focus();
                $("#vuelto").val('')
                return false;
            }
        })


        /* ======================================================================================
        I N I C I O   E V E N T O S   D A T A T A B L E   L I S T A D O   D E   P R O D U C T O S
        ====================================================================================== */

        /* ======================================================================================
        EVENTO PARA MODIFICAR EL PRECIO DE VENTA DEL PRODUCTO
        ======================================================================================*/
        $('#tbl_ListadoProductos tbody').on('click', '.dropdown-item', function() {

            codigo_producto = $(this).attr("codigo");
            precio_venta = parseFloat($(this).attr("precio")).toFixed(2);

            recalcularMontos(codigo_producto, precio_venta);
        });

        /* ======================================================================================
        EVENTO PARA MODIFICAR LA CANTIDAD DE PRODUCTOS DEL DATATABLE
        ====================================================================================== */
        $('#tbl_ListadoProductos tbody').on('change', '.iptCantidad', function() {

            let $subtotal = 0;
            let $factor_iva = 0;
            let $porcentaje_iva = 0;
            let $iva = 0;
            let $importe = 0;

            let $tiene_stock = 1;

            let cantidad_actual = $(this)[0]['value'];
            let cod_producto_actual = $(this)[0]['attributes']['codigoproducto']['value'];

            if (cantidad_actual.length == 0 || cantidad_actual == 0) {
                cantidad_actual = 1;
            }

            if (cantidad_actual < 0) {
                mensajeToast("error", "Ingrese valores mayores a 0")
                return;
            }

            $.ajax({
                async: false,
                url: "ajax/productos.ajax.php",
                method: "POST",
                data: {
                    'accion': 'verificar_stock',
                    'codigo_producto': cod_producto_actual,
                    'cantidad_a_comprar': cantidad_actual
                },
                dataType: 'json',
                success: function(respuesta) {

                    if (parseInt(respuesta['stock']) < cantidad_actual) {

                        mensajeToast('error', ' El producto  no tiene el stock ingresado, el stock actual es: ' + respuesta.stock);
                        $tiene_stock = 0;
                        cantidad_actual = respuesta.stock;
                    }
                }
            })

            $('#tbl_ListadoProductos').DataTable().rows().eq(0).each(function(index) {

                var row = $('#tbl_ListadoProductos').DataTable().row(index);
                var data = row.data();

                if (data["codigo_producto"] == cod_producto_actual) {

                    //OBTENER PRECIO DEL PRODUCTO
                    $precio_con_iva = (parseFloat($.parseHTML(data['precio'])[0]['value'])).toFixed(2);

                    $id_tipo_afectacion = $('#tbl_ListadoProductos').DataTable().cell(index, 3).data();

                    var formaData = new FormData();
                    formaData.append('accion', 'obtener_porcentaje_impuesto');
                    formaData.append('codigo_afectacion', $id_tipo_afectacion);

                    $afectacion = SolicitudAjax('ajax/tipo_afectacion_iva.ajax.php', 'POST', formaData);

                    // ACTUALIZAR CANTIDAD
                    $('#tbl_ListadoProductos').DataTable().cell(index, 7).data(`<input type="number"  min="0" step="0.01"
                                                            style="width:100%;"
                                                            codigoProducto = ` + cod_producto_actual + `
                                                            class="form-control form-control-sm text-center iptCantidad m-0 p-0 rounded-pill" 
                                            value="` + (cantidad_actual) + `">`).draw();




                    //CALCULAR IVA
                    if ($id_tipo_afectacion == 12) {
                        //CALCULAR SUBTOTAL
                        $factor_iva = $afectacion.factor;
                        $porcentaje_iva = $afectacion.porcentaje;

                        $subtotal = ($precio_con_iva / $factor_iva) * cantidad_actual
                        $iva = ($precio_con_iva * cantidad_actual) - (($precio_con_iva * cantidad_actual) / $factor_iva); // * EL % DE IVA
                    } else {
                        //CALCULAR SUBTOTAL
                        $subtotal = ($precio_con_iva) * cantidad_actual
                        $iva = 0
                        $factor_iva = 1;
                    }

                    $('#tbl_ListadoProductos').DataTable().cell(index, 8).data(parseFloat($subtotal).toFixed(2)).draw();
                    $('#tbl_ListadoProductos').DataTable().cell(index, 9).data(parseFloat($iva).toFixed(2)).draw();

                    //CALCULAR IMPORTE
                    $importe = ($precio_con_iva * cantidad_actual) * $factor_iva; // * EL FACTOR DE IVA 
                    $('#tbl_ListadoProductos').DataTable().cell(index, 10).data(parseFloat(parseFloat($.parseHTML(data['precio'])[0]['value']) * cantidad_actual).toFixed(2)).draw();

                    $("#producto").val("");
                    $("#producto").focus();

                    // RECALCULAMOS TOTALES
                    recalcularTotales();

                }

            })

        });

        /* ======================================================================================
        EVENTO PARA MODIFICAR EL PRECIO DEL PRODUCTO DEL DATATABLE
        ====================================================================================== */
        $('#tbl_ListadoProductos tbody').on('change', '.iptPrecio', function() {

            let $id_tipo_afectacion = 0;
            let $subtotal = 0;
            let $factor_iva = 0;
            let $porcentaje_iva = 0;
            let $iva = 0;
            let $importe = 0;
            let $cantidad_actual = 0;

            $precio_con_iva = parseFloat($(this)[0]['value']);

            cod_producto_actual = $(this)[0]['attributes']['codigoProducto']['value'];

            if ($precio_con_iva.length == 0 || $precio_con_iva == 0) {
                $precio_con_iva = 1;
            }

            if ($precio_con_iva < 0) {
                mensajeToast("error", "El precio debe ser mayor a 0")
                return;
            }

            $('#tbl_ListadoProductos').DataTable().rows().eq(0).each(function(index) {

                var row = $('#tbl_ListadoProductos').DataTable().row(index);
                var data = row.data();

                if (data["codigo_producto"] == cod_producto_actual) {

                    $cantidad_actual = parseFloat($.parseHTML(data['cantidad'])[0]['value'])
                    $id_tipo_afectacion = $('#tbl_ListadoProductos').DataTable().cell(index, 3).data();

                    var formaData = new FormData();
                    formaData.append('accion', 'obtener_porcentaje_impuesto');
                    formaData.append('codigo_afectacion', $id_tipo_afectacion);

                    $afectacion = SolicitudAjax('ajax/tipo_afectacion_iva.ajax.php', 'POST', formaData);

                    // ACTUALIZAR PRECIO
                    $('#tbl_ListadoProductos').DataTable().cell(index, 6)
                        .data(`<input type="number"  min="0" step="0.01"
                                    style="width:100%;" 
                                    codigoProducto = ` + cod_producto_actual + ` 
                                    class="form-control form-control-sm text-center iptPrecio m-0 p-0 rounded-pill" 
                                    value="` + $precio_con_iva + `">`).draw();


                    //CALCULAR IVA
                    if ($id_tipo_afectacion == 12) {
                        //CALCULAR SUBTOTAL
                        $factor_iva = $afectacion.factor;
                        $porcentaje_iva = $afectacion.porcentaje;

                        $subtotal = ($precio_con_iva / $factor_iva) * $cantidad_actual
                        $iva = ($precio_con_iva * $cantidad_actual) - (($precio_con_iva * $cantidad_actual) / $factor_iva); // * EL % DE IVA
                    } else {
                        //CALCULAR SUBTOTAL
                        $subtotal = ($precio_con_iva) * $cantidad_actual
                        $iva = 0
                        $factor_iva = 1;
                    }

                    $('#tbl_ListadoProductos').DataTable().cell(index, 8).data(parseFloat($subtotal).toFixed(2)).draw();
                    $('#tbl_ListadoProductos').DataTable().cell(index, 9).data(parseFloat($iva).toFixed(2)).draw();

                    //CALCULAR IMPORTE
                    $importe = ($precio_con_iva * $cantidad_actual) * $factor_iva; // * EL FACTOR DE IVA
                    $('#tbl_ListadoProductos').DataTable().cell(index, 10).data(parseFloat($.parseHTML(data['cantidad'])[0]['value'] * $precio_con_iva).toFixed(2)).draw();

                    // RECALCULAMOS TOTALES
                    recalcularTotales();

                }

            })

        });

        /* ======================================================================================
        EVENTO PARA ELIMINAR UN PRODUCTO DEL LISTADO
        ======================================================================================*/
        $('#tbl_ListadoProductos tbody').on('click', '.btnEliminarproducto', function() {
            $('#tbl_ListadoProductos').DataTable().row($(this).parents('tr')).remove().draw();
            recalcularTotales();
        });

        /* ======================================================================================
        F I N   E V E N T O S   D A T A T A B L E   L I S T A D O   D E   P R O D U C T O S
        ====================================================================================== */

        $("#btnGuardarComprobante").on('click', function() {
            fnc_GuardarVenta();
        })

        $("#btnCancelarVenta").on('click', function() {
            fnc_InicializarFormulario();
        })

        $('#tbl_ListadoProductos tbody').on('keypress', '.iptCantidad', function(e) {
            var key = e.keyCode;
            //102 -> F
            //98 -> B

            if (key == 45) {
                e.preventDefault();
            }

        });

        $("#moneda").change(function() {
            fnc_ObtenerSimboloMoneda();
            // fnc_CargarDataTableListadoProductos();
            // recalcularTotales();
            // if ($("#moneda").val() == "GTQ") {
            //     $("#tipo_cambio").addClass("my-disabled");
            //     $("#tipo_cambio").val(parseFloat(1.000).toFixed(3))
            // } else {
            //     $("#tipo_cambio").removeClass("my-disabled");
            // }

            // fnc_InicializarFormulario();
        })

        fnc_OcultarLoader();

    }) // fin document ready


    function fnc_InicializarFormulario() {

        fnc_CargarSelects();
        fnc_ObtenerSimboloMoneda();
        fnc_ObtenerCorrelativo($("#serie").val())
        fnc_BloquearDatosCliente(true);
        fnc_CargarPluginDateTime();
        fnc_CargarAutocompleteProductos();
        fnc_CargarAutocompleteClientes();

        fnc_CargarDataTableListadoProductos();


        //Datos del Cliente
        // $("#tipo_documento").val('')
        $("#nro_documento").val('')
        $("#nombre_cliente_razon_social").val('')
        $("#direccion").val('')
        $("#telefono").val('')

        //Datos de la Venta
        $("#forma_pago").attr("readonly", true);
        $("#producto").val('')
        $("#totalVenta").html('')
        $("#totalVenta").html('Q 0.00')
        $("#total_recibido").val('')
        $("#vuelto").val('')

        //Datos del Resumen
        $("#resumen_subtotal").html('Q 0.00')
        $("#resumen_total_iva").html('Q 0.00')
        $("#resumen_total_venta").html('Q 0.00')

        $(".needs-validation-venta-factura").removeClass("was-validated");

        fnc_VerificarEmpresaFacturacionElectronica();

    }


    /*===================================================================*/
    //CARGAR DROPDOWN'S
    /*===================================================================*/
    function fnc_CargarSelects() {

        var formData = new FormData();
        formData.append("accion", "obtener_empresa_defecto");
        var response = SolicitudAjax("ajax/empresas.ajax.php", "POST", formData);

        // EMPRESA EMISORA
        CargarSelect(response.id_empresa ?? "", $("#empresa_emisora"), "--Seleccionar--", "ajax/empresas.ajax.php", 'obtener_empresas_select');

        // TIPO DE COMPROBANTE
        CargarSelect('01', $("#tipo_comprobante"), "--Seleccionar--", "ajax/series.ajax.php", 'obtener_tipo_comprobante');

        // SERIE
        CargarSelect(null, $("#serie"), "--Seleccionar--", "ajax/ventas.ajax.php", 'obtener_serie_comprobante', $('#tipo_comprobante option:selected').val());
        $("#serie").prop('selectedIndex', 1).change();

        // MONEDA
        CargarSelect('GTQ', $("#moneda"), "--Seleccionar--", "ajax/ventas.ajax.php", 'obtener_moneda');

        // TIPO DOCUMENTO
        CargarSelect('0', $("#tipo_documento"), "--Seleccionar--", "ajax/ventas.ajax.php", 'obtener_tipo_documento');

        // TIPO OPERACION
        CargarSelect('0101', $("#tipo_operacion"), "--Seleccionar--", "ajax/ventas.ajax.php", 'obtener_tipo_operacion');

        // FORMA DE PAGO
        CargarSelect(1, $("#forma_pago"), "--Seleccionar--", "ajax/ventas.ajax.php", 'obtener_forma_pago');

        // MEDIO DE PAGO
        CargarSelect(1, $("#medio_pago"), "--Seleccionar--", "ajax/ventas.ajax.php", 'obtener_medio_pago');

    }

    /*===================================================================*/
    // P L U G I N   D A T E T I M E P I C K E R
    /*===================================================================*/
    function fnc_CargarPluginDateTime() {
        $('#fecha_emision').datetimepicker({
            format: 'YYYY-MM-DD',
            locale: moment.lang('es', {
                months: 'Enero_Febrero_Marzo_Abril_Mayo_Junio_Julio_Agosto_Septiembre_Octubre_Noviembre_Diciembre'
                    .split('_'),
                monthsShort: 'Enero._Feb._Mar_Abr._May_Jun_Jul._Ago_Sept._Oct._Nov._Dec.'.split(
                    '_'),
                weekdays: 'Domingo_Lunes_Martes_Miercoles_Jueves_Viernes_Sabado'.split('_'),
                weekdaysShort: 'Dom._Lun._Mar._Mier._Jue._Vier._Sab.'.split('_'),
                weekdaysMin: 'Do_Lu_Ma_Mi_Ju_Vi_Sa'.split('_')
            }),
            defaultDate: moment(),
        });
    }

    /*===================================================================*/
    // V E R I F I C A   S I   E M P R E S A   G E N E R A   F A C T U R A C I O N   E L E C T R O N I C A
    /*===================================================================*/
    function fnc_VerificarEmpresaFacturacionElectronica() {

        var formData = new FormData();
        formData.append('accion', 'verificar_empresa_facturacion_electronica');
        formData.append('id_empresa', $("#empresa_emisora").val());

        var response = SolicitudAjax("ajax/empresas.ajax.php", "POST", formData);

        if (response.genera_fact_electronica == "1") {
            $("#rb-venta-envio").prop("disabled", false);
            $("#rb-venta").prop("disabled", false);
        } else {
            $("#rb-venta-envio").prop("disabled", true);
            $("#rb-venta").prop("disabled", true);

            $("#rb-venta-envio").prop("checked", false);
            $("#rb-venta").prop("checked", true);
        }

    }

    /*===================================================================*/
    // O B T E N E R   C O R R E L A T I V O
    /*===================================================================*/
    function fnc_ObtenerCorrelativo(id_serie) {
        var formData = new FormData();
        formData.append('accion', 'obtener_correlativo_serie');
        formData.append('id_serie', id_serie);

        response = SolicitudAjax('ajax/ventas.ajax.php', 'POST', formData);
        $("#correlativo").val(response["correlativo"])
    }

    /*===================================================================*/
    //CARGAR AUTOCOMPLETE DE PRODUCTOS
    /*===================================================================*/
    function fnc_CargarAutocompleteProductos() {

        $("#producto").autocomplete({
            source: "ajax/autocomplete_productos.ajax.php",
            minLength: 2,
            autoFocus: true,
            select: function(event, ui) {
                CargarProductos(ui.item.id);
                $("#producto").val('');
                $("#producto").focus();
                return false;
            },
            response: function(event, ui) {

                if (!ui.content.length) {
                    var noResult = {
                        value: "",
                        label: '<a href="javascript:void(0);" class="d-flex border border-secondary border-left-0 border-right-0 border-top-0" style="width:100% !important;">' +
                            '<div class=""> ' +
                            '<span class="text-sm fw-bold">No existen datos</span>' +
                            '</div>' +
                            '</a>'
                    };
                    ui.content.push(noResult);
                }
            }
        }).data("ui-autocomplete")._renderItem = function(ul, item) {
            return $("<li class='ui-autocomplete-row'></li>")
                .data("item.autocomplete", item)
                .append(item.label)
                .appendTo(ul);
        };

    }

    /*===================================================================*/
    //A U T O C O M P L E T E   D E   C L I E N T E S
    /*===================================================================*/
    function fnc_CargarAutocompleteClientes() {

        $("#nro_documento").autocomplete({
            source: "ajax/autocomplete_clientes.ajax.php?id_tipo_documento=" + $("#tipo_documento").val(),
            minLength: 2,
            autoFocus: true,
            select: function(event, ui) {
                CargarCliente(ui.item.value);
                return false;
            },
            response: function(event, ui) {

                if (!ui.content.length) {
                    var noResult = {
                        value: "",
                        label: '<a href="javascript:void(0);" class="d-flex border border-secondary border-left-0 border-right-0 border-top-0" style="width:100% !important;">' +
                            '<div class=""> ' +
                            '<span class="text-sm fw-bold">No existen datos</span>' +
                            '</div>' +
                            '</a>'
                    };
                    ui.content.push(noResult);
                }
            },
            open: function() {
                $("ul.ui-menu").width($(this).innerWidth());
            }
        }).data("ui-autocomplete")._renderItem = function(ul, item) {
            return $("<li class='ui-autocomplete-row'></li>")
                .data("item.autocomplete", item)
                .append(item.label)
                .appendTo(ul);
        };

    }

    /*===================================================================*/
    // C A R G A R   D A T A T A B L E   D E   P R O D U C T O S   A   V E N D ER
    /*===================================================================*/
    function fnc_CargarDataTableListadoProductos() {

        if ($.fn.DataTable.isDataTable('#tbl_ListadoProductos')) {
            $('#tbl_ListadoProductos').DataTable().destroy();
            $('#tbl_ListadoProductos tbody').empty();
        }

        $('#tbl_ListadoProductos').DataTable({
            // searching: false,
            paging: false,
            info: false,
            "columns": [{
                    "data": "id"
                },
                {
                    "data": "codigo_producto"
                },
                {
                    "data": "descripcion"
                },
                {
                    "data": "id_tipo_iva"
                },
                {
                    "data": "tipo_iva"
                },
                {
                    "data": "unidad_medida"
                },
                {
                    "data": "precio"
                },
                {
                    "data": "cantidad"
                },
                {
                    "data": "subtotal"
                },
                {
                    "data": "iva"
                },
                {
                    "data": "importe"
                },
                {
                    "data": "acciones"
                }
            ],
            columnDefs: [{
                    "className": "dt-center",
                    "targets": [6, 7, 10]
                },
                {
                    targets: [0, 1, 3, 4, 5, 8, 9],
                    visible: false
                },
                {
                    width: '50%',
                    "className": "dt-left",
                    targets: 2,

                },
                {
                    width: '15%',
                    targets: 6
                },
                {
                    width: '15%',
                    targets: 7
                },
                {
                    width: '15%',
                    targets: 10
                }
            ],
            "order": [
                [0, 'desc']
            ],
            "language": {
                "url": "ajax/language/spanish.json"
            }
        });

        ajustarHeadersDataTables($("#tbl_ListadoProductos"))

    }

    /*===================================================================*/
    // C A R G A R   P R O D U C T O S   E N   E L   D A T A T A B L E
    /*===================================================================*/
    function CargarProductos(producto = "") {

        var codigo_producto;

        if (producto != "") codigo_producto = producto;
        else codigo_producto = $("#iptCodigoVenta").val();

        var producto_repetido = 0;

        /*===================================================================*/
        // AUMENTAMOS LA CANTIDAD SI EL PRODUCTO YA EXISTE EN EL LISTADO
        /*===================================================================*/
        $('#tbl_ListadoProductos').DataTable().rows().eq(0).each(function(index) {

            var row = $('#tbl_ListadoProductos').DataTable().row(index);
            var data = row.data();

            if (codigo_producto == data['codigo_producto']) {

                var formaData = new FormData();
                formaData.append('accion', 'obtener_porcentaje_impuesto');
                formaData.append('codigo_afectacion', data['id_tipo_iva']);

                $afectacion = SolicitudAjax('ajax/tipo_afectacion_iva.ajax.php', 'POST', formaData);

                producto_repetido = 1;

                cantidad_a_comprar = parseFloat($.parseHTML(data['cantidad'])[0]['value']) + 1;

                $.ajax({
                    async: false,
                    url: "ajax/productos.ajax.php",
                    method: "POST",
                    data: {
                        'accion': 'verificar_stock',
                        'codigo_producto': codigo_producto,
                        'cantidad_a_comprar': cantidad_a_comprar
                    },
                    dataType: 'json',
                    success: function(respuesta) {

                        if (parseInt(respuesta['stock']) < cantidad_a_comprar) {

                            mensajeToast('error', ' El producto ' + data['descripcion'] + ' no tiene el stock ingresado, el stock actual es: ' + respuesta.stock);

                            $("#producto").val("");
                            $("#producto").focus();

                        } else {

                            $valor_unitario = parseFloat($.parseHTML(data['precio'])[0]['value'] / $afectacion.factor);
                            $id_tipo_afectacion = $('#tbl_ListadoProductos').DataTable().cell(index, 3).data()

                            let $subtotal = 0;
                            let $factor_iva = 0;
                            let $porcentaje_iva = 0;
                            let $iva = 0;
                            let $importe = 0;

                            // ACTUALIZAR CANTIDAD A 1
                            $('#tbl_ListadoProductos').DataTable().cell(index, 7).data(`<input  type="number" min="0"
                                                            style="width:100%;" 
                                                            codigoProducto = "` + codigo_producto + `" 
                                                            class="form-control form-control-sm text-center iptCantidad m-0 p-0 rounded-pill" 
                                                            value="` + cantidad_a_comprar + `">`).draw();

                            // $('#tbl_ListadoProductos').DataTable().cell(index, 8).data(cantidad_a_comprar)

                            //ACTUALIZAR SUBTOTAL
                            $subtotal = $valor_unitario * cantidad_a_comprar;

                            $('#tbl_ListadoProductos').DataTable().cell(index, 8).data(parseFloat($subtotal).toFixed(2)).draw();

                            //ACTUALIZAR IVA
                            if ($id_tipo_afectacion == 12) {
                                $factor_iva = $afectacion.factor;
                                $porcentaje_iva = $afectacion.porcentaje;
                                $iva = ($valor_unitario * cantidad_a_comprar * $porcentaje_iva); // * EL % DE IVA

                            } else {
                                $iva = 0
                                $factor_iva = 1;
                            }

                            $('#tbl_ListadoProductos').DataTable().cell(index, 9).data(parseFloat($iva).toFixed(2)).draw();

                            //ACTUALIZAR IMPORTE
                            $importe = ($valor_unitario * cantidad_a_comprar) * $factor_iva; // * EL FACTOR DE IVA

                            $('#tbl_ListadoProductos').DataTable().cell(index, 10).data(parseFloat($importe).toFixed(2)).draw();

                            // RECALCULAMOS TOTALES
                            recalcularTotales();

                        }
                    }
                });

            }
        });

        if (producto_repetido == 1) {
            return;
        }

        $.ajax({
            url: "ajax/productos.ajax.php",
            method: "POST",
            data: {
                'accion': 'obtener_producto_x_codigo', //BUSCAR PRODUCTOS POR SU CODIGO DE BARRAS
                'codigo_producto': codigo_producto
            },
            dataType: 'json',
            success: function(respuesta) {

                /*===================================================================*/
                //SI LA RESPUESTA ES VERDADERO, TRAE ALGUN DATO
                /*===================================================================*/
                if (respuesta) {

                    var TotalVenta = 0.00;

                    $tipo_cambio = 1.00;
                    $factor_iva = respuesta.factor_iva
                    $codigo_producto = respuesta.codigo_producto;
                    $descripcion = respuesta.descripcion;
                    $precio = respuesta.precio_unitario_con_iva;
                    $precio = $precio / $tipo_cambio;
                    $subtotal = ($precio / $factor_iva) * 1;
                    $iva = ($precio) - ($precio / $factor_iva);
                    $importe = $precio * 1;

                    $('#tbl_ListadoProductos').DataTable().row.add({
                        'id': itemProducto,
                        'codigo_producto': $codigo_producto,
                        'descripcion': $descripcion.length > 60 ? $descripcion.substring(0, 60) + '...' : $descripcion,
                        'id_tipo_iva': respuesta.id_tipo_afectacion_iva,
                        'tipo_iva': respuesta.tipo_afectacion_iva,
                        'unidad_medida': respuesta.unidad_medida,
                        'precio': `<input type="number" style="width:100%;" class="form-control form-control-sm text-center iptPrecio rounded-pill p-0 m-0" codigoProducto=` +
                            $.trim($codigo_producto) + ` value=` + parseFloat($precio).toFixed(2) + `>`,
                        'cantidad': `<input type="number" style="width:100%;" class="form-control form-control-sm text-center iptCantidad rounded-pill p-0 m-0" codigoProducto=` +
                            $.trim($codigo_producto) + ` value="1">`,
                        'subtotal': parseFloat($subtotal).toFixed(2),
                        'iva': parseFloat($iva).toFixed(2),
                        'importe': parseFloat($importe).toFixed(2),
                        'acciones': "<center>" +
                            "<span class='btnEliminarproducto text-danger px-1'style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Eliminar producto'> " +
                            "<i class='fas fa-trash fs-5'> </i> " +
                            "</span>" +
                            "<div class='btn-group'>" +
                            "<button type='button' class=' p-0 btn btn-primary transparentbar dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>" +
                            "<i class='fas fa-hand-holding-usd fs-5 text-green'></i> <i class='fas fa-chevron-down text-primary'></i>" +
                            "</button>" +

                            "<ul class='dropdown-menu'>" +

                            "<li><a class='dropdown-item' codigo = '" + $codigo_producto +
                            "' precio=' " + respuesta['precio_unitario_con_iva'] +
                            "' style='cursor:pointer; font-size:14px;'>Normal (" + parseFloat(respuesta[
                                'precio_unitario_con_iva']).toFixed(2) + ")</a></li>" +

                            "<li><a class='dropdown-item' codigo = '" + $codigo_producto +
                            "' precio=' " + respuesta['precio_unitario_mayor_con_iva'] +
                            "' style='cursor:pointer; font-size:14px;'>Por Mayor (Q " + parseFloat(
                                respuesta['precio_unitario_mayor_con_iva']).toFixed(2) + ")</a></li>" +

                            "<li><a class='dropdown-item' codigo = '" + $codigo_producto +
                            "' precio=' " + respuesta['precio_unitario_oferta_con_iva'] +
                            "' style='cursor:pointer; font-size:14px;'>Oferta (Q " + parseFloat(
                                respuesta['precio_unitario_oferta_con_iva']).toFixed(2) + ")</a></li>" +

                            "</ul>" +
                            "</div>" +
                            "</center>"
                    }).draw();

                    itemProducto = itemProducto + 1;
                    //  Recalculamos el total de la venta
                    recalcularTotales();

                    /*===================================================================*/
                    //SI LA RESPUESTA ES FALSO, NO TRAE ALGUN DATO
                    /*===================================================================*/
                } else {
                    mensajeToast('error', 'EL PRODUCTO NO EXISTE O NO TIENE STOCK');
                }

            }
        });

        $("#producto").val("");
        $("#producto").focus();

    }

    function CargarCliente($cliente) {

        $("#nro_documento").val($cliente.split(" - ")[0].trim());
        $("#nombre_cliente_razon_social").val($cliente.split(" - ")[1].trim());
        $("#direccion").val($cliente.split(" - ")[2].trim());
        $("#telefono").val($cliente.split(" - ")[3].trim());
    }

    function recalcularMontos(codigo_producto, precio_venta) {

        $('#tbl_ListadoProductos').DataTable().rows().eq(0).each(function(index) {

            var row = $('#tbl_ListadoProductos').DataTable().row(index);

            var data = row.data();


            if (data['codigo_producto'] == codigo_producto) {

                // AUMENTAR EN 1 EL VALOR DE LA CANTIDAD
                $('#tbl_ListadoProductos').DataTable().cell(index, 6).data(
                    `<input type="number" style="width:100%;" class="form-control form-control-sm text-center iptPrecio rounded-pill p-0 m-0" codigoProducto=` +
                    $.trim(codigo_producto) + ` value=` + precio_venta + `>`
                ).draw();

                //OBTENER PRECIO DEL PRODUCTO
                $precio = precio_venta; //parseFloat($.parseHTML(data['precio'])[0]['value']);

                $id_tipo_afectacion = $('#tbl_ListadoProductos').DataTable().cell(index, 3).data();

                var formaData = new FormData();
                formaData.append('accion', 'obtener_porcentaje_impuesto');
                formaData.append('codigo_afectacion', $id_tipo_afectacion);

                $afectacion = SolicitudAjax('ajax/tipo_afectacion_iva.ajax.php', 'POST', formaData);

                let $subtotal = 0;
                let $factor_iva = 0;
                let $porcentaje_iva = 0;
                let $iva = 0;
                let $importe = 0;

                cantidad_actual = parseFloat($.parseHTML(data['cantidad'])[0]['value']);

                //CALCULAR IVA
                if ($id_tipo_afectacion == 12) {
                    $factor_iva = $afectacion.factor;
                    $porcentaje_iva = $afectacion.porcentaje;
                    $iva = ($precio * cantidad_actual * $porcentaje_iva); // * EL % DE IVA
                    $subtotal = $precio / $factor_iva
                } else {
                    $iva = 0
                    $factor_iva = 1;
                    $subtotal = $precio / $factor_iva
                }

                //CALCULAR SUBTOTAL                
                $('#tbl_ListadoProductos').DataTable().cell(index, 8).data(parseFloat($subtotal).toFixed(2)).draw();

                $('#tbl_ListadoProductos').DataTable().cell(index, 9).data(parseFloat($iva).toFixed(2)).draw();

                //CALCULAR IMPORTE
                $importe = ($precio * cantidad_actual); // * EL FACTOR DE IVA 
                $('#tbl_ListadoProductos').DataTable().cell(index, 10).data(parseFloat($importe).toFixed(2)).draw();

            }

            // RECALCULAMOS TOTALES
            recalcularTotales();


        });

        // RECALCULAMOS TOTALES
        recalcularTotales();

    }

    /*===================================================================*/
    //R E C A L C U L A R   L O S   T O T A L E S  D E   V E N T A
    /*===================================================================*/
    function recalcularTotales() {

        let totalVenta = 0.00;
        let total = 0.00;
        let subtotal = 0.00;
        let total_iva = 0.00;
        let factor_iva = 1;

        $('#tbl_ListadoProductos').DataTable().rows().eq(0).each(function(index) {

            var row = $('#tbl_ListadoProductos').DataTable().row(index);
            var data = row.data();

            factor_iva = 1;

            var formaData = new FormData();
            formaData.append('accion', 'obtener_porcentaje_impuesto');
            formaData.append('codigo_afectacion', data['id_tipo_iva']);

            $afectacion = SolicitudAjax('ajax/tipo_afectacion_iva.ajax.php', 'POST', formaData);

            $cantidad = parseFloat($.parseHTML(data['cantidad'])[0]['value']);

            if (data['id_tipo_iva'] == 12) {
                $valor_unitario = parseFloat($.parseHTML(data['precio'])[0]['value'] / $afectacion.factor);
                total = parseFloat(total) + (parseFloat($valor_unitario) * parseFloat($cantidad));
                total_iva = parseFloat(total_iva) + ((parseFloat($valor_unitario) * $cantidad) * $afectacion.porcentaje);
            }

            if (data['id_tipo_iva'] == 5) {
                $valor_unitario = parseFloat($.parseHTML(data['precio'])[0]['value'] / $afectacion.factor);
                total = parseFloat(total) + (parseFloat($valor_unitario) * parseFloat($cantidad));
                total_iva = parseFloat(total_iva) + ((parseFloat($valor_unitario) * $cantidad) * $afectacion.porcentaje);
            }

        });

        totalVenta = parseFloat(totalVenta) + parseFloat(total) + parseFloat(total_iva);
        subtotal = subtotal + total;

        $("#resumen_subtotal").html($simbolo_moneda + parseFloat(subtotal).toFixed(2));
        $("#resumen_total_iva").html($simbolo_moneda + parseFloat(total_iva).toFixed(2));
        $("#resumen_total_venta").html($simbolo_moneda + parseFloat(totalVenta).toFixed(2));

        $("#total_recibido").val(parseFloat(totalVenta).toFixed(2))

    }

    function fnc_GuardarVenta() {

        let count = 0;
        form_comprobante_validate = validarFormulario('needs-validation-venta-factura');

        //INICIO DE LAS VALIDACIONES
        if (!form_comprobante_validate) {
            mensajeToast("error", "complete los datos obligatorios");
            return;
        }

        if ($("#tipo_documento").val() != "0" && ($("#nro_documento").val() == "" ||
                $("#nombre_cliente_razon_social").val() == "" ||
                $("#direccion").val() == "")) {
            mensajeToast("error", "Debe completar los datos del Cliente");
            return;
        }

        if ($("#totalVenta").html().replace('Q ', '') > 2000) {

            if ($("#tipo_documento").val() == "0") {
                mensajeToast("error", "Para montos mayores a 2000, se debe identificar al cliente!");
                return;
            }

        }


        $('#tbl_ListadoProductos').DataTable().rows().eq(0).each(function(index) {
            count = count + 1;
        });

        if (count == 0) {
            mensajeToast("error", "Ingrese los productos para la venta");
            return;
        }

        if ($("#total_recibido").val() == "") {
            mensajeToast("error", "Ingrese el Total recibido");
            return;
        }

        if (!fnc_ValidarStock()) {
            return;
        }

        var start = new Date($("#fecha_emision").val()),
            end = new Date($date);

        // get days
        diff = new Date(end - start);

        days = diff / 1000 / 60 / 60 / 24;

        if (parseInt(days) > parseInt(2)) {
            Swal.fire({
                position: 'top-center',
                icon: "error",
                title: "La fecha de emisión no puede ser mayor a dos dias",
                showConfirmButton: true
            })
            return;
        }

        //FIN DE LAS VALIDACIONES

        var $productos = [];

        Swal.fire({
            title: 'Está seguro(a) de registrar la Venta?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, deseo registrarlo!',
            cancelButtonText: 'Cancelar',
        }).then((result) => {

            if (result.isConfirmed) {

                $('#tbl_ListadoProductos').DataTable().rows().eq(0).each(function(index) {

                    var arr = {};
                    var row = $('#tbl_ListadoProductos').DataTable().row(index);

                    var data = row.data();

                    var formaData = new FormData();
                    formaData.append('accion', 'obtener_porcentaje_impuesto');
                    formaData.append('codigo_afectacion', data["id_tipo_iva"]);

                    $afectacion = SolicitudAjax('ajax/tipo_afectacion_iva.ajax.php', 'POST', formaData);

                    if (data["id_tipo_iva"] == "12") {
                        precio = parseFloat($.parseHTML(data['precio'])[0]['value']) / $afectacion.factor;
                    } else {
                        precio = parseFloat($.parseHTML(data['precio'])[0]['value']);
                    }

                    cantidad = parseFloat($.parseHTML(data['cantidad'])[0]['value'])

                    arr['codigo_producto'] = data["codigo_producto"];
                    arr['descripcion'] = data["descripcion"];
                    arr['id_tipo_iva'] = data["id_tipo_iva"];
                    arr['precio'] = precio;
                    arr['cantidad'] = cantidad;
                    arr['iva'] = data["iva"];
                    arr['subtotal'] = data["subtotal"];
                    arr['importe_total'] = data["importe"];
                    $productos.push(arr);

                });

                var formData = new FormData();
                formData.append('accion', 'registrar_venta');
                formData.append('datos_venta', $("#frm-datos-venta-factura").serialize());
                formData.append('id_caja', $("#id_caja").val());
                // formData.append('arr_detalle_productos', JSON.stringify(detalle_productos));
                formData.append('productos', JSON.stringify($productos));

                response = SolicitudAjax('ajax/ventas.ajax.php', 'POST', formData);

                // if ($("input[name='rb_generar_venta']:checked").val() == 1) {
                //     Swal.fire({
                //         position: 'top-center',
                //         icon: 'success',
                //         title: 'Se envio a Sat, ' + response['mensaje_respuesta_sat'],
                //         showConfirmButton: true
                //     })
                // } else {
                //     Swal.fire({
                //         position: 'top-center',
                //         icon: response.tipo_msj,
                //         title: response.msj + ', esta pendiente el envio a Sat',
                //         showConfirmButton: true
                //     })
                // }

                Swal.fire({
                    position: 'top-center',
                    icon: response['tipo_msj'],
                    title: response['msj'],
                    showConfirmButton: true
                })

                window.open($ruta + 'vistas/modulos/impresiones/generar_factura_a4.php?id_venta=' + response["id_venta"],
                    'fullscreen=yes' +
                    "resizable=0,"
                );

                fnc_InicializarFormulario();

            }

        });

    }

    /*===================================================================*/
    // V A L I D A R   S T O C K   A N T E S   D E  G U A R D A R   V E N T A
    /*===================================================================*/
    function fnc_ValidarStock() {

        let stock_valido = true;

        $('#tbl_ListadoProductos').DataTable().rows().eq(0).each(function(index) {

            var row = $('#tbl_ListadoProductos').DataTable().row(index);

            var data = row.data();

            var datos = new FormData();
            datos.append('accion', 'verificar_stock');
            datos.append('codigo_producto', data["codigo_producto"]);
            datos.append('cantidad_a_comprar', data["cantidad_final"]);

            response = SolicitudAjax('ajax/productos.ajax.php', 'POST', datos);

            if (response.stock < parseInt(data["cantidad_final"])) {
                mensajeToast("error", "El producto " + data["descripcion"] + " no tiene el stock ingresado, el stock actual es: " + response.stock)
                $('#tbl_ListadoProductos').DataTable().cell(index, 7)
                    .data(`<input  type="number" min="0"
            style="width:100%;background-color:#D98880" 
            codigoProducto = "` + cod_producto_actual + `" 
            class="form-control text-center iptCantidad m-0 p-0 form-control-sm rounded-pill" 
            value="` + data["cantidad_final"] + `">`).draw();

                stock_valido = false;

            }

        });

        return stock_valido;
    }


    /*===================================================================*/
    //GENERALES
    /*===================================================================*/
    function fnc_ConsultarNroDocumento(nro_documento) {

        var formData = new FormData();
        let accion = '';

        if ($("#tipo_documento").val() == 1) {
            accion = 'consultar_dpi';
        } else if ($("#tipo_documento").val() == 4) {
            accion = 'consultar_nit';
        }

        formData.append('accion', accion);
        formData.append('nro_documento', $.trim(nro_documento));

        response = SolicitudAjax('ajax/apis/apis.ajax.php', 'POST', formData);

        if (response) {

            if (response['message']) {

                if (response['message'] == "not found") {
                    mensajeToast("error", 'No se encontraron datos')
                }

                if (response['message'] == "dpi no valido") {
                    mensajeToast("error", 'El DPI ingresado no es válido')
                }

                if (response['message'] == "nit no valido") {
                    mensajeToast("error", 'El NIT ingresado no es válido')
                }

                $("#nro_documento").val('')
                $("#nombre_cliente_razon_social").val('')
                $("#direccion").val('')
                $("#telefono").val('')
                return;
            }

            if ($("#tipo_documento").val() == 1) {
                $("#nombre_cliente_razon_social").val(response['nombres'] + ' ' + response['apellidoPaterno'] + ' ' +
                    response['apellidoMaterno']);
            } else if ($("#tipo_documento").val() == 4) {
                $("#nombre_cliente_razon_social").val(response['razonSocial']);
                $("#direccion").val(response['direccion']);
                if (response['telefono']) $("#telefono").val(response['telefono']);

                $("#direccion").focus();
            }

        }
    }

    function fnc_BloquearDatosCliente(disabled) {
        $("#nro_documento").prop('disabled', disabled)
        $("#nombre_cliente_razon_social").prop('disabled', disabled)
        $("#direccion").prop('disabled', disabled)
        $("#telefono").prop('disabled', disabled)
        if (disabled == true) $(".btnConsultarDpi").prop('readonly', 'true')
        else $(".btnConsultarDpi").prop('readonly', 'false');

    }

    function fnc_ImprimirFactura($id_venta) {
        window.open($ruta + 'vistas/modulos/impresiones/generar_ticket.php?id_venta=' + $id_venta,
            "ModalPopUp",
            "toolbar=no," +
            "scrollbars=no," +
            "location=no," +
            "statusbar=no," +
            "menubar=no," +
            "resizable=0," +
            "width=400," +
            "height=600," +
            "left = 450," +
            "top=200");
    }

    function fnc_ImprimirFacturaA4($id_venta) {
        window.open($ruta + 'vistas/modulos/impresiones/generar_factura_a4.php?id_venta=' + $id_venta,
            'fullscreen=yes' +
            "resizable=0,"
        );
    }

    function fnc_ObtenerEstadoCajaPorDia() {

        var datos = new FormData();
        datos.append('accion', 'obtener_estado_caja_por_dia');

        response = SolicitudAjax('ajax/arqueo_caja.ajax.php', 'POST', datos)

        //CUANDO LA CAJA ESTA CERRADA
        if (response['cantidad'] == '0' || response['estado'] == '0') {
            Swal.fire({
                position: 'top-center',
                icon: 'warning',
                title: 'Debe aperturar la caja',
                showConfirmButton: true
            })
            $(".nav-link").removeClass('active');
            $(this).addClass('active');
            // CargarContenido('vistas/caja.php', 'content-wrapper');
            $(".content-wrapper").fadeOut('slow', function() {
                $(".content-wrapper").load('vistas/modulos/caja/caja.php',
                    function() {
                        $(".content-wrapper").fadeIn(60);

                    },
                );
            })

        } else {
            $("#id_caja").val(response["id"]);
        }
    }

    function fnc_VerificarEmpresasRegistradas() {

        var datos = new FormData();
        datos.append('accion', 'verificar_empresas_registradas');

        response = SolicitudAjax('ajax/empresas.ajax.php', 'POST', datos)

        //CUANDO LA CAJA ESTA CERRADA
        if (response['cantidad'] == '0') {
            Swal.fire({
                position: 'top-center',
                icon: 'warning',
                title: 'Debe registrar la Empresa del Negocio',
                showConfirmButton: true
            })
            $(".nav-link").removeClass('active');
            $(this).addClass('active');
            // CargarContenido('vistas/administrar_empresas.php', 'content-wrapper');
            $(".content-wrapper").fadeOut('slow', function() {
                $(".content-wrapper").load('vistas/modulos/administracion/administrar_empresas.php',
                    function() {
                        $(".content-wrapper").fadeIn(60);

                    },
                );
            })

        }
    }

    function fnc_ObtenerSimboloMoneda() {

        var formData = new FormData();
        formData.append('accion', 'obtener_simbolo_moneda');
        formData.append('moneda', $("#moneda").val());

        response = SolicitudAjax("ajax/ventas.ajax.php", "POST", formData);

        $simbolo_moneda = response["simbolo"];
    }
</script>