<?php
include_once('../../controller/tecnologia/Sistema.php');

date_default_timezone_set('America/Sao_Paulo');

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
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="icon" type="image/png" href="../tecnologia/img/favicon.png" />
        <!-- Bootstrap Core CSS -->
        <!-- <link href="../tecnologia/css/bootstrap.css" rel='stylesheet' type='text/css' /> -->
        <link href="../tecnologia/css/bootstrap3/bootstrap.min.css" rel='stylesheet' type='text/css' />
        <!-- Custom CSS -->
        <link href="../tecnologia/css/style.css" rel='stylesheet' type='text/css' />
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
        <link rel="stylesheet" href="../tecnologia/css/clndr.css" type="text/css" />
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
        <link type="text/css" href="../tecnologia/css/jquery-ui.css" rel="stylesheet" />
        <link type="text/css" href="../tecnologia/css/styleCustom.css" rel="stylesheet" />
        <link type="text/css" href="../../view/tecnologia/css/jquery.multiselect.css" rel="stylesheet" />
        <script type="text/javascript" src="../../view/tecnologia/js/jquery.multiselect.js"></script>
        <script type="text/javascript" src="../../view/tecnologia/js/blockUI.js"></script>
        <!--// End Custom -->
        <!-- shortTable -->
        <link href="../../view/tecnologia/css/theme.bootstrap_3.min.css" rel="stylesheet">
        <script src="../../view/tecnologia/js/jquery.tablesorter.js"></script>
        <script src="../../view/tecnologia/js/jquery.tablesorter.widgets.js"></script>
        <!--// End shortTable -->

        <link href="../../view/tecnologia/css/TabelasPadrao.css" rel="stylesheet">
        <style>
            body {
                /* overflow: hidden;	 */
            }

            @media screen and (max-width: 768px) {
                body {
                    /* overflow: auto;	 */
                }
            }

            .container {
                margin-top: 0px;
            }

            .ativo {
                color: green;
            }

            .container-fluid {
                padding: 0px !important;
            }

            .footerFixed .row {
                margin-bottom: 10px !important;
            }

            ul.dropdown-menu {
                animation: none !important;
                -moz-animation: none !important;
                -webkit-animation: none !important;
                -webkit-backface-visibility: visible !important;
                -ms-backface-visibility: visible !important;
                backface-visibility: visible !important;
                -moz-backface-visibility: visible !important;
                padding: 5px !important;
            }

            .right {
                /* padding: 0 30px 0 0; */
                width: 100% !important;
            }

            .dropdown-menu .btn {
                color: black;
            }

            .dropdown-menu .btn:hover {
                color: #000000a6;
            }

            #tableAprovacoes td {
                border: none !important;
            }

            #tableAprovacoes th {
                font-weight: normal;
                border: none !important;
            }

            .textAreaModal {
                width: 100%;
                min-width: 100%;
                max-width: 100%;
            }

            .verde {
                color: green !important;
            }
        </style>
    </head>

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

            <div class="sticky-header header-section ">
                <!--toggle button start-->
                <button id="showLeftPush"><i class="fa fa-bars"></i></button>
                <!--toggle button end-->
                <div class="topBar">Aprovação (novo)</div>
                <div class="topBarRight">
                    <button class="btn botaoTop dropdown-toggle desktopHide" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <i class="material-icons">&#xE5D4;</i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
                        <li>
                            <button class="btn btnAprovarResponsivo" style="width:100%;" disabled="disabled">Aprovar</button>
                        </li>
                        <li style="padding: 10px 0 0 0 !important">
                            <button class="btn btnRecusarResponsivo" style="width:100%;" disabled="disabled">Recusar</button>
                        </li>
                        <li role="separator" class="divider"></li>
                        <li>
                            <button class="btn btnMultiSelecao" style="width:100%;">
                                <span class="glyphicon glyphicon-ok verde hidden"></span>
                                Multi seleção
                            </button>
                        </li>
                    </ul>
                    <!-- <button data-toggle="modal" class="botaoTop ativo" data-pendente="true" id="Pendente"><i class="glyphicon glyphicon-th-list"></i></button> -->
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <!-- //header-ends -->

        <!-- main content start-->
        <div class="pageContent">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 nopadding">
                        <table id="tableAprovacoes" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Aprovação pendente</th>
                                    <th>Solicitante</th>
                                    <th>Nível</th>
                                    <th>Empresa</th>
                                    <th>Filial</th>
                                    <th>Valor</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="footerFixed mobileHide">
            <div class="right">
                <div class="col-md-12">
                    <div class="right">
                        <button class="botao btnAprovar" disabled="disabled" type="button">Aprovar</button>
                        <button class="botao btnRecusar" disabled="disabled" type="button">Recusar</button>
                        <button class="botao btnMultiSelecao" type="button">
                            <span class="glyphicon glyphicon-ok verde hidden"></span>
                            Multi seleção
                        </button>
                    </div>
                </div>
            </div>
        </div><!-- end footer -->
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
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.10.18/r-2.2.2/datatables.min.css" />
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.18/r-2.2.2/datatables.min.js"></script>

        <!-- SweetAlert -->
        <script type="text/javascript" src="../tecnologia/js/sweetalert/sweetalert.min.js"></script>
        <script src="//d2wy8f7a9ursnm.cloudfront.net/v6/bugsnag.min.js"></script>
        <script>
            window.bugsnagClient = bugsnag('9f6cc1049582acdb30bc5fff5e922e62')
        </script>

        <script type="text/javascript" src="../tecnologia/js/scriptAprovacaoNovo.js"></script>
    </body>

    </html>

<?php
}
