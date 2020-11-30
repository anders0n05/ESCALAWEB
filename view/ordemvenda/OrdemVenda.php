<?php
include_once('../../controller/tecnologia/Sistema.php');

date_default_timezone_set('America/Sao_Paulo');

if (!isset($_SESSION['usuario']) and !isset($_SESSION['senha'])) {
    header('Location: ../../view/estrutura/login.php?success=F');
}
else {
    $connect = Sistema::getConexao();

    include_once('../../model/ordemvenda/PegaTipo.php');
    include_once('../../model/ordemvenda/PegaFormaPagamento.php');
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
            <script src= "../tecnologia/js/moment-2.2.1.js" type="text/javascript"></script>
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

            <style>
                body{
                    /* overflow: hidden;	 */
                }
                @media screen and (max-width: 768px) {
                    body{
                        /* overflow: auto;	 */
                    }
                    .pesquisar{
                        width: 100% !important;
                    }
                    .dataTables_info {
                        white-space: inherit !important;
                    }
                }
                .container{
                    margin-top: 0px;
                }
                .ativo{
                    border-color: green !important;
                    background: green !important;
                }
                @media screen and (max-width: 767px){
                    .dataTables_length{
                        display: none;
                    }
                    #ordemvenda_wrapper .col-sm-12{
                        padding: 0px !important;
                    }
                }
                .container-fluid{
                    padding: 0px !important;
                }
                
                @media screen and (min-width: 768px){
                    .pesquisar{
                        display: initial;
                    }
                }

                .pesquisar{
                    margin-top: 10px !important;
                    width: auto;
                }

                .dropdown-menu{
                    padding: 0 5px 0 5px !important;
                }
                .dropdown-menu li{
                    margin: 5px 0 5px 0 !important;
                }
                ul.dropdown-menu{
                    animation: none;
                    -moz-animation: none;
                    -webkit-animation: none;
                }
                .nopadding .col-md-6{
                    padding: 0 !important;
                    margin-bottom: 15px !important;
                }
                th{
                    font-weight: normal !important;
                }
                .selected{
                    background-color: #2b9bcb !important;
                }
                @media screen and (min-width: 400px){
                    i.mobileHide{
                        display: contents;
                    }
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
                
                <!--left-fixed -navigation-->
                <!-- header-starts -->
                <div class="sticky-header header-section ">
                    <!--toggle button start-->
                    <button id="showLeftPush"><i class="fa fa-bars"></i></button>
                    <!--toggle button end-->
                    <div class="topBar">Ordem de venda</div>
                    <div class="topBarRight">
                        <input type="text" class="form-control pesquisar mobileHide" placeholder="Pesquisar" id="pesquisarDesktop">
                            <button class="btn botaoTop dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <span class="glyphicon glyphicon-filter" aria-hidden="true"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
                                <li class="desktopHide">
                                    <input type="text" class="form-control pesquisar" placeholder="Pesquisar" id="pesquisarMobile">
                                </li>
                                <li>
                                    <input type="text" class="form-control Cliente" placeholder="Cliente" id="Cliente">
                                </li>
                                <li>
                                    <select class="form-control" id="Tipo" required="required">
                                        <option selected disabled value="">Selecione...</option>
                                        <?php foreach($tipos as $tipo){ ?>
                                            <option value="<?=$tipo["HANDLE"]?>"><?=$tipo["NOME"]?></option>
                                        <?php } ?>
                                    </select>
                                </li>
                                <li>
                                    <select class="form-control" id="FormaPagamento">
                                        <option selected value="">Selecione...</option>
                                        <?php foreach($formasPagamento as $formaPagamento){ ?>
                                            <option value="<?=$formaPagamento["HANDLE"]?>"><?=$formaPagamento["NOME"]?></option>
                                        <?php } ?>
                                    </select>
                                </li>
                                <li>
                                    <button type="button" class="btn btn-primary btn-block Filtrar">
                                        Filtrar
                                    </button>
                                </li>
                                <li role="separator" class="divider"></li>
                                <li>
                                    <button type="button" class="btn btn-success btn-block Pendente" data-pendente="true">
                                        <i class="fa fa-check" aria-hidden="true"></i>
                                        Pendente
                                    </button>
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
                <div class="clearfix"> </div>	
            </div>
            <!-- //header-ends -->
            <!-- main content start-->   
            <div class="pageContent">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12 btn-group nopadding">
                            <button type="button" class="btn btn-default btn-success Adicionar"><i class="fa fa-plus mobileHide" aria-hidden="true"></i> Adicionar</button>
                            <button type="button" class="btn btn-default btn-primary Editar" disabled="disabled"><i class="fa fa-pencil mobileHide" aria-hidden="true"></i> Editar</button>
                            <button type="button" class="btn btn-default btn-danger Cancelar" disabled="disabled"><i class="fa fa-ban mobileHide" aria-hidden="true"></i> Cancelar</button>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Ações <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li>
                                        <button type="button" class="btn btn-default btn-success btn-block Liberar" disabled="disabled"><i class="fa fa-check mobileHide" aria-hidden="true"></i> Liberar</button>
                                    </li>
                                    <li>
                                        <button type="button" class="btn btn-default btn-primary btn-block Voltar" disabled="disabled"><i class="fa fa-chevron-left mobileHide" aria-hidden="true"></i> Voltar</button>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="#">Separated link</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-12 nopadding">
                            <table id="ordemvenda" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Número</th>
                                        <th>Data</th>
                                        <th>Cliente</th>
                                        <th>Tipo</th>
                                        <th>Forma de pagamento</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
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
            <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.10.18/b-1.5.6/datatables.min.css"/>
            <script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.18/b-1.5.6/datatables.min.js"></script>

            <!-- SweetAlert -->
            <script type="text/javascript" src="../tecnologia/js/sweetalert/sweetalert.min.js"></script>
            
            <!-- jQuery Mask -->
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
            
            <!-- Bugsnag -->
            <script src="//d2wy8f7a9ursnm.cloudfront.net/v6/bugsnag.min.js"></script>
            <script>window.bugsnagClient = bugsnag('9f6cc1049582acdb30bc5fff5e922e62')</script>

            <script type="text/javascript" src="../tecnologia/js/ordemvenda/OrdemVendaListarFuncoes.js"></script>
            <script type="text/javascript" src="../tecnologia/js/ordemvenda/OrdemVenda.js"></script>
        </body>
    </html>

    <?php
}