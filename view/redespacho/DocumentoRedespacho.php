<?php
include_once('../../controller/tecnologia/Sistema.php');

date_default_timezone_set('America/Argentina/Buenos_Aires');

if (!isset($_SESSION['usuario']) and !isset($_SESSION['senha'])) {
    header('Location: ../../view/estrutura/login.php?success=F');
} else {
    $connect = Sistema::getConexao();
    ?>
    <!DOCTYPE HTML>
    <html>
    <head>
        <title>Escalasoft</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link rel="icon" type="image/png" href="../tecnologia/img/favicon.png"/>
        <!-- Bootstrap Core CSS -->
        <!-- <link href="../tecnologia/css/bootstrap.css" rel='stylesheet' type='text/css' /> -->
        <link href="../tecnologia/css/bootstrap3/bootstrap.min.css" rel='stylesheet' type='text/css'/>
        <!-- Custom CSS -->
        <link href="../tecnologia/css/style.css" rel='stylesheet' type='text/css'/>
        <!-- font CSS -->
        <!-- font-awesome icons -->
        <link href="../tecnologia/css/font-awesome.css" rel="stylesheet">
        <!-- //font-awesome icons -->
        <!-- material icons -->
        <link href="../../view/tecnologia/css/material-icons.css" rel="stylesheet">
        <!-- //material icons -->
        <!-- js-->
        <!-- <script src="../tecnologia/js/jquery-1.11.1.min.js"></script> -->
        <!-- jQuery -->
        <script type="text/javascript" src="../tecnologia/js/jquery/jquery.min.js"></script>
        <script src="../tecnologia/js/modernizr.custom.js"></script>
        <!--animate-->
        <link href="../tecnologia/css/animate.css" rel="stylesheet" type="text/css" media="all">
        <script src="../tecnologia/js/wow.min.js"></script>
        <script>
            new WOW().init();
        </script>
        <!--//end-animate-->
        <!-- chart -->
        <script src="../tecnologia/js/Chart.js"></script>
        <!-- //chart -->
        <!--Calendario-->
        <link rel="stylesheet" href="../tecnologia/css/clndr.css" type="text/css"/>
        <script src="../tecnologia/js/underscore-min.js" type="text/javascript"></script>
        <script src="../tecnologia/js/moment-2.2.1.js" type="text/javascript"></script>
        <script src="../tecnologia/js/clndr.js" type="text/javascript"></script>
        <script src="../tecnologia/js/site.js" type="text/javascript"></script>
        <!--End Calendario-->
        <!-- Menu Lateral -->
        <script src="../tecnologia/js/metisMenu.min.js"></script>
        <script src="../tecnologia/js/custom.js"></script>
        <link href="../tecnologia/css/custom.css" rel="stylesheet">
        <!--//Menu Lateral-->
        <!-- Custom -->
        <script type="text/javascript" src="../tecnologia/js/jquery-ui.js"></script>
        <script type="text/javascript" src="../tecnologia/js/scriptEtapaPedido.js"></script>
        <script type="text/javascript" src="../tecnologia/js/bootbox.js"></script>
        <link type="text/css" href="../tecnologia/css/jquery-ui.css" rel="stylesheet"/>
        <link type="text/css" href="../tecnologia/css/styleCustom.css" rel="stylesheet"/>
        <link type="text/css" href="../../view/tecnologia/css/jquery.multiselect.css" rel="stylesheet"/>
        <script type="text/javascript" src="../../view/tecnologia/js/jquery.multiselect.js"></script>
        <script type="text/javascript" src="../../view/tecnologia/js/blockUI.js"></script>
        <!--// End Custom -->
        <!-- shortTable -->
        <link href="../../view/tecnologia/css/theme.bootstrap_3.min.css" rel="stylesheet">
        <script src="../../view/tecnologia/js/jquery.tablesorter.js"></script>
        <script src="../../view/tecnologia/js/jquery.tablesorter.widgets.js"></script>
        <!--// End shortTable -->

        <link href="../../view/tecnologia/css/TabelasPadrao.css" rel="stylesheet">
        <!-- jQuery BestComplete -->
        <script src="../../view/tecnologia/js/jquery-bestcomplete/jquery.bestComplete.min.js"></script>
        <link href="../../view/tecnologia/css/jquery-bestcomplete/jquery.bestComplete.min.css" rel="stylesheet">

    </head>
    <style>

        @media screen and (max-width: 768px) {
            .pesquisar {
                width: 100% !important;
            }
        }

        .container-fluid {
            padding: 0px !important;
        }

        @media screen and (min-width: 768px) {
            .pesquisar {
                display: initial;
            }
        }

        .pesquisar {
            margin-top: 10px !important;
            width: auto;
        }

        .dropdown-menu {
            padding: 0 5px 0 5px !important;
        }

        .dropdown-menu li {
            margin: 5px 0 5px 0 !important;
        }

        ul.dropdown-menu {
            animation: none;
            -moz-animation: none;
            -webkit-animation: none;
        }

        .nopadding {
            padding: 0 !important;
            margin-top: 23px;
        }

        th {
            font-weight: normal !important;
        }

        .selected {
            background-color: #2b9bcb !important;
        }

        @media screen and (min-width: 400px) {
            i.mobileHide {
                display: contents;
            }
        }

        .btn-header {
            position: fixed;
            top: 0;
            left: 0px;
            width: 100%;
            z-index: 100;
            background-color: white;
        }

        .btn-header button {
            border: none !important;
        }

        .btn-header button i:before {
            margin-right: 10px;
        }

        table th {
            margin: 5px !important;
            padding: 5px !important;
        }
    </style>
    <body class="cbp-spmenu-push" id="bodyFullScreen">
    <div id="loader"></div>
    <div class="main-content">
        <!--left-fixed -navigation-->
        <div class=" sidebar" role="navigation">
            <div class="navbar-collapse">
                <nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
                    <?php include('../../view/estrutura/menu.php') ?>
                </nav>
            </div>
        </div>

        <!--left-fixed -navigation-->
        <!-- header-starts -->
        <div class="row btn-header" style="margin: 0 !important;">
            <div class="col-md-12" style="margin: 0px !important; padding: 0px !important;">			
                <button type="button" class="btn btn-default Atualizar"><i class="fa fa-refresh" aria-hidden="true"></i>
                    Atualizar
                </button>
                <button type="button" class="btn btn-default Baixar" disabled="disabled">
                    <i class="fa fa-chevron-left" aria-hidden="true"></i> Baixar
                </button>                              
            </div>
        </div>
        <div class="sticky-header header-section" style="margin-top: 32px !important;">
            <!--toggle button start-->
            <button id="showLeftPush"><i class="fa fa-bars"></i></button>
            <!--toggle button end-->
            <div class="topBar">Documento em redespacho</div>
            <div class="topBarRight" style="top: auto !important;">
                <input type="text" class="form-control pesquisar mobileHide" placeholder="Pesquisar"
                       id="pesquisarDesktop">
                <button class="btn botaoTop dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="true">
                    <span class="glyphicon glyphicon-filter" aria-hidden="true"></span>
                </button>
                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
				    <li class="desktopHide">
                        <input type="text" class="form-control pesquisar" placeholder="Pesquisar" id="pesquisarMobile">
                    </li>
                    <li>
                        <input type="text" class="form-control" placeholder="Documento" id="nrdocumento">
                    </li>
                    <li>
                        <input type="text" class="form-control" placeholder="Manifesto" id="nrmanifesto">
                    </li>
                    <li>
                        <input type="text" class="form-control" placeholder="Situação" id="status">
                    </li>                    
                    <li>
                        <button type="button" class="btn btn-success btn-block MultiSelecao" data-multiselecao="false">
                            <i class="fa fa-check hidden" aria-hidden="true"></i>
                            Multi-seleção
                        </button>
                    </li>
                </ul>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <!-- //header-ends -->
    <!-- main content start-->
    <div class="pageContent">
        <div class="container-fluid">
            <div class="col-md-12 nopadding">
                <table id="documentoRedespacho" class="table table-striped table-bordered" cellspacing="0" style="width:100%">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Situação</th>                        
                        <th>Número</th>
                        <th>Série</th>
                        <th>Nota Fiscal</th>
                        <th>Manifesto</th>
                        <th>Município</th>
                        <th>Valor</th>                        
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <!-- Classie -->
    <script src="../tecnologia/js/classie.js"></script>
    <!--scrolling js-->
    <script src="../tecnologia/js/jquery.nicescroll.js"></script>
    <script src="../tecnologia/js/script.js"></script>
    <!--//scrolling js-->
    <!-- Bootstrap Core JavaScript -->
    <!-- <script src="../tecnologia/js/bootstrap.js"></script> -->
    <script src="../tecnologia/js/bootstrap3/bootstrap.min.js"></script>

    <!-- DataTables -->
    <link rel="stylesheet" type="text/css"
          href="https://cdn.datatables.net/v/bs/dt-1.10.18/b-1.5.6/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.18/b-1.5.6/datatables.min.js"></script>

    <!-- SweetAlert -->
    <script type="text/javascript" src="../tecnologia/js/sweetalert/sweetalert.min.js"></script>

    <!-- jQuery Mask -->
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>

    <!-- Padroes -->
    <script type="text/javascript" src="../tecnologia/js/padroes/padroes.js"></script>

    <!-- Bugsnag -->
    <script src="//d2wy8f7a9ursnm.cloudfront.net/v6/bugsnag.min.js"></script>
    <script>window.bugsnagClient = bugsnag('9f6cc1049582acdb30bc5fff5e922e62')</script>
    <script>
        $(function () {
            var table = $('#documentoRedespacho').DataTable({
                "fnCreatedRow": function( nRow, aData, iDataIndex ) {
                    $(nRow).attr('handle', aData["HANDLE"]);
                    $(nRow).attr('romaneio', aData["ROMANEIOITEM"]);
                },
                "processing": true,
                "scrollX": true,
                "serverSide": true,
                // "responsive": true,
                // "autoWidth": false,
                // "stateSave": true,
                "searching": false,
                "iDisplayLength": 50,
                dom: 't<"col-md-6 col-sm-12"i><"col-md-6 col-sm-12"p>',
                "ajax": {					
                    "url": "/model/redespacho/DocumentoRedespacho.php",
                    "data": function (d) {
                        return $.extend({}, d, {
                            "documento": $("#nrdocumento").val(),
                            "manifesto": $("#nrmanifesto").val(),
                            "status": $("#status").val(),                            
							"pesquisa": $("#pesquisarDesktop").val().length > 0 ? $("#pesquisarDesktop").val() : $("#pesquisarMobile").val()							
                        });
                    }
                },
                // "drawCallback": function () {
                // $(".dataTables_length").addClass('text-right');
                // },
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json",
                },
                // "order": [
                //     [1, "desc"]
                // ],
                "columns": [
                    {
                        "data": "STATUS",
                        "responsivePriority": 1,
                        "width": "1%"
                    },
                    {
                        "data": "STATUSNOME",
                        "responsivePriority": 2,
                        "width": "10%"
                    },                    
                    {
                        "data": "NUMERO",
                        "width": '10%',
                    },
                    {
                        "data": "SERIE",
                        "responsivePriority": 3,
                        "width": '10%',
                    },
                    {
                        "data": "NOTAFISCAL",
                        "width": '10%',
                    },                    
                    {
                        "data": "NUMEROMANIFESTO",
                        "responsivePriority": 4,
                        "width": '15%',
                    },
                    {
                        "data": "MUNICIPIO",
                        "responsivePriority": 5,
                        "width": '25%',
                    },
                    {
                        "data": "VALOR",
                        "width": '15%',
                    }]
            });
            

            $(".MultiSelecao").click(function () {
                $(this).attr('data-multiselecao', $(this).attr('data-multiselecao') == 'false' ? 'true' : 'false');
                $(this).find("i").toggleClass('hidden');
                desativaBotao([
                    ".Baixar"
                ]);
                $("#documentoRedespacho tr").removeClass('selected');
            });

            $('#documentoRedespacho tbody').on('click', 'tr', function () {
                if ($(".MultiSelecao").attr('data-multiselecao') === "true") {
                    if (!$(this).find("td").hasClass('dataTables_empty')) {
                        $(this).toggleClass('selected');
                        ativaBotao([
                            ".Baixar"
                        ]);
                    }
                } else {
                    if (!$(this).find("td").hasClass('dataTables_empty')) {
                        if ($(this).hasClass('selected')) {
                            $(this).removeClass('selected');
                            desativaBotao([
                                ".Baixar"
                            ]);
                        } else {
                            table.$('tr.selected').removeClass('selected');
                            $(this).addClass('selected');
                            ativaBotao([
                                ".Baixar"
                            ]);
                        }
                    }
                }
            });

            $(".Atualizar").on('click', () => {
                table.draw();
            });
			
			$("#pesquisarDesktop, #nrdocumento, #nrmanifesto, #status").keydown(function(e){
				if (e.which == '13') {
					table.draw();
				}
			});

            $(".Baixar").on('click', () => {
                var vHandle = [];
                var vRomaneio = [];
                $("tr.selected").each(function(){
                    vHandle.push($(this).attr("handle"));
                    vRomaneio.push($(this).attr("romaneio"));
                });                
                window.location = "../../view/redespacho/EfetuarEntrega.php?documento="+vHandle.join(',')+"&romaneio="+vRomaneio.join(',');
            });           
        });
    </script>
    </body>
    </html>

    <?php
}
