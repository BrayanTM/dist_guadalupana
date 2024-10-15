<!-- Content Header (Page header) -->
<div class="content-header pb-1">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0 fw-bold">REPORTE VENTAS DEL MES</h2>
            </div><!-- /.col -->
            <div class="col-sm-6 d-none d-md-block">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="./">Inicio</a></li>
                    <li class="breadcrumb-item active">Reporte Ventas del Mes</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content" style="position: relative;">

    <div class="row">

        <div class="col-12 ">

            <div class="card card-primary card-outline card-outline-tabs">

                <div class="card-header p-0 border-bottom-0">

                    <ul class="nav nav-tabs" id="custom-tabs-comprobantes" role="tablist">

                        <!-- TAB LISTADO BOLETAS -->
                        <li class="nav-item">
                            <a class="nav-link active my-0" id="listado-boletas-tab" data-toggle="pill" href="#listado-boletas" role="tab" aria-controls="listado-boletas" aria-selected="false"><i class="fas fa-list"></i> Ventas</a>
                        </li>

                    </ul>
                </div>

                <div class="card-body py-1">

                    <div class="tab-content" id="custom-tabs-comprobantesContent">

                        <!-- TAB CONTENT BOLETAS -->
                        <div class="tab-pane fade active show" id="listado-boletas" role="tabpanel" aria-labelledby="listado-boletas-tab">

                            <div class="row my-2">

                                <!--LISTADO DE BOLETAS -->
                                <div class="col-md-12">

                                    <table id="tbl_boletas" class="table shadow border border-secondary" style="width:100%">
                                        <thead class="bg-main text-left">
                                            <th></th>
                                            <th>Id</th>
                                            <th>Comprob.</th>
                                            <th>Fec. Emisión</th>
                                            <th>Forma Pago</th>
                                            <th>IVA</th>
                                            <th>Total</th>
                                        </thead>
                                    </table>

                                </div>

                            </div>

                        </div>

                    </div>
                </div>

            </div>

        </div>

    </div>

</div>


<!-- =============================================================================================================================
M O D A L   E N V I A R   C O R R E O
===============================================================================================================================-->
<div class="modal fade" id="mdlEnviarComprobanteCorreo" role="dialog" tabindex="-1">

    <div class="modal-dialog modal-md" role="document">

        <!-- contenido del modal -->
        <div class="modal-content">

            <!-- cabecera del modal -->
            <div class="modal-header my-bg py-1">

                <h5 class="modal-title text-white text-lg">Enviar comprobante a:</h5>

                <button type="button" class="btn btn-danger btn-sm text-white text-sm" data-bs-dismiss="modal">
                    <i class="fas fa-times text-sm m-0 p-0"></i>
                </button>

            </div>

            <!-- cuerpo del modal -->
            <div class="modal-body">

                <div class="row mb-2">

                    <!-- EMAIL -->
                    <div class="col-12 mb-2">
                        <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-list-ol mr-1 my-text-color"></i>Email</label>
                        <input type="email" style="border-radius: 20px;" class="form-control form-control-sm" id="email" name="email" aria-label="Small" aria-describedby="inputGroup-sizing-sm">

                    </div>

                </div>

                <div class="row mt-3">

                    <div class="col-12 text-center">

                        <a class="btn btn-sm btn-success fw-bold " id="btnEnviarComprobanteCorreo" style="position: relative; width: 200px;">
                            <span class="text-button">ENVIAR CORREO</span>
                            <span class="btn fw-bold icon-btn-success ">
                                <i class="fas fa-save fs-5 text-white m-0 p-0"></i>
                            </span>
                        </a>

                    </div>

                </div>

            </div>


        </div>

    </div>

</div>

<script>
    var $id_venta_para_correo;

    var $today = new Date();
    var $date = $today.getFullYear() + '-0' + ($today.getMonth() + 1) + '-' + $today.getDate();

    $(document).ready(function() {


        /*===================================================================*/
        // I N I C I A L I Z A R   F O R M U L A R I O 
        /*===================================================================*/
        fnc_InicializarFormulario();

        /* ======================================================================================
        I N I C I O   E V E N T O S   D A T A T A B L E   B O L E T A S
        ====================================================================================== */

        $('#tbl_boletas tbody').on('click', '.btnImprimirBoleta', function() {
            var data = $('#tbl_boletas').DataTable().row($(this).parents('tr')).data();
            $id_venta = data[1];
            fnc_ImprimirBoleta($id_venta)
        });

        /* ======================================================================================
        F I N   E V E N T O S   D A T A T A B L E   B O L E T A S
        ====================================================================================== */

    })


    function fnc_InicializarFormulario() {
        fnc_CargarDataTableListadoBoletas();
    }

    /* ======================================================================================
    I N I C I O   F U N C I O N E S   D A T A T A B L E   B O L E T A S
    ====================================================================================== */
    function fnc_CargarDataTableListadoBoletas() {

        if ($.fn.DataTable.isDataTable('#tbl_boletas')) {
            $('#tbl_boletas').DataTable().destroy();
            $('#tbl_boletas tbody').empty();
        }

        $("#tbl_boletas").DataTable({
            dom: 'Bfrtip',
            buttons: [{
                extend: 'excel',
                title: function() {
                    var printTitle = 'LISTADO DE BOLETAS';
                    return printTitle
                }
            }, 'pageLength'],
            pageLength: 10,
            processing: true,
            serverSide: true,
            order: [],
            ajax: {
                url: 'ajax/ventas.ajax.php',
                data: {
                    'accion': 'obtener_listado_boletas'
                },
                type: 'POST'
            },
            scrollX: true,
            scrollY: "63vh",
            columnDefs: [{
                    "className": "dt-center",
                    "targets": "_all"
                },
                {
                    targets: [1],
                    visible: false
                },
                {
                    targets: 0,
                    orderable: false,
                    createdCell: function(td, cellData, rowData, row, col) {

                        $options = `<div class="btn-group">
                                
                                <button class="btn btn-sm dropdown-toggle p-0 m-0 my-text-color fs-5" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-list-alt"></i>
                                </button>

                                <div class="dropdown-menu z-3">
                                    <a class="dropdown-item btnImprimirBoleta" style='cursor:pointer;'><i class='px-1 fas fa-print fs-5 text-secondary'></i> <span class='my-color'>Imprimir Boleta (ticket)</span></a>   `

                        $options = $options + `</div>
                                    </div>`;

                        $(td).html($options)
                    }
                },
            ],
            language: {
                url: "ajax/language/spanish.json"
            }
        })

        ajustarHeadersDataTables($("#tbl_boletas"));
    }

    function fnc_ImprimirBoleta($id_venta) {

        window.open($ruta+'vistas/modulos/impresiones/generar_ticket.php?id_venta=' + $id_venta,
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

    /* ======================================================================================
    F I N   F U N C I O N E S   D A T A T A B L E   B O L E T A S
    ====================================================================================== */

</script>