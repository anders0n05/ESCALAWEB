<?php
include_once('../../controller/tecnologia/Sistema.php');
if (!isset($_SESSION['usuario']) and ! isset($_SESSION['senha'])) {
    header('Location: ../../view/estrutura/login.php?success=F');
}// not isset sessions of login
else {
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
            <link href="../tecnologia/css/bootstrap.css" rel='stylesheet' type='text/css' />
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
            <script src="../tecnologia/js/jquery-1.11.1.min.js"></script>
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
            <script type="text/javascript" src="../tecnologia/js/exportar.js"></script>
            <script type="text/javascript" src="../tecnologia/js/scriptRastreioPedido.js"></script>
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
            <script>
                $(function () {
                    $('table').tablesorter({
                        widgets: ['zebra', 'columns'],
                        usNumberFormat: false,
                        sortReset: true,
                        sortRestart: true,
                        dateFormat: 'pt'
                    });
                });
            </script>
            <!--// End shortTable -->
            <style>
                body{
                    overflow: hidden;	
                }
                @media screen and (max-width: 768px) {
                    body{
                        overflow: auto;	
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

                    <div class="topBar">Rastreio de pedido</div>

                    <div class="topBarRight">
                        <ul class="dropdown-menu dropdown-menu-right" role="menu">
                            <li><button name="visualizarRastreioPedidoMobile" class="btn botaoMobile display" type="button" id="visualizarRastreioPedidoMobile">Visualizar</button></li>
                        </ul>
                        <button data-toggle="modal" class="botaoTop" title="Filtrar" onClick="multiselection();" data-target="#FiltroModal"><i class="glyphicon glyphicon-search"></i></button>
                        <?php
                            if (Sistema::getGet("pendente") == '0'){
                                echo "<button class=\"botaoTop\" title=\"Pendente\" onClick=\"pedente();\"><span class=\"glyphicon glyphicon-list\"></span></i></button>";
                            }
                            else{
                                echo "<button class=\"botaoTop\" title=\"Pendente\" onClick=\"pedente();\"><span class=\"glyphicon glyphicon-list\" style=\"color: grey;\"></span></i></button>";
                            }
                        ?>
                        <button data-toggle="modal" class="botaoTop" title="Exportar" onClick="exportarOnHandler();"><i class="glyphicon glyphicon-export"></i></button>
                    </div>
                </div>

                <div class="clearfix"> </div>	
            </div>
            <!-- //header-ends -->
            <?php include_once('../../model/rastreamento/ModalRastreioPedido.php') ?>
            <!-- main content start-->
            <div class="pageContent">
                <form method="post" action="../../controller/rastreamento/viagemController.php">
                    <div class="table-responsive">
                        <div class="larguraInteira">
                            <table class="table table-striped table-bordered " id="reqtablenew" border="0">
                                <thead>
                                    <tr class="Noactivetr">
                                        <th width="1%">&nbsp;</th>
                                        <th width="4%"  class="text-center">Rastreamento</th>
                                        <th width="4%"  class="text-center">Tipo</th>
                                        <th width="4%"  class="text-center">Nr pedido</th>
                                        <th width="4%"  class="text-center">Nr controle</th>
                                        <th width="4%"  class="text-center">Nr nota fiscal</th>
                                        <th width="10%">Remetente</th>
                                        <th width="7%">Origem</th>
                                        <th width="3%">UF</th>
                                        <th width="7%">Destinatário</th>
                                        <th width="5%">Destino</th>
                                        <th width="3%">UF</th>
                                        <th width="5%" class="text-center">Previsão</th>
                                        <th width="10%">Etapa atual</th>
                                        <th width="10%" class="text-center">Entrega</th>                                        
                                        <th width="8%">Duração</th>
                                        <th width="4%">Cliente</th>
                                        <th width="5%" class="text-center">Valor da mercadoria</th>
                                        <th width="5%" class="text-center">Data</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php include_once('../../model/rastreamento/RastreioPedidoTabelaModel.php') ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="footerFixed">
                        <div class="col-xs-1">
                            <button type="button" class="span">&nbsp;</button>
                        </div>
                    </div><!-- end footer -->
                </form>
            </div><!-- end pageContent -->

            <form method="GET" action="../../view/rastreamento/RastreioPedido.php" hidden id="formPendente">
                <?php
                    if (Sistema::getGet("pendente") == '0'){
                        echo "<input class=\"botaoPressionado\" type='text' name='pendente' value='6,5,2,1'>";
                        echo "<input class=\"botaoPressionado\" type='text' name='ehpendente' value='False'>";
                    }
                    else{
                        echo "<input class=\"botaoPressionado\" type='text' name='pendente' value='0'>";
                        echo "<input class=\"botaoPressionado\" type='text' name='ehpendente' value='True'>";
                    }
                ?>
            </form>

            <div class="clearfix"> </div>

            <!-- Classie -->
            <script src="../tecnologia/js/classie.js"></script>
            <!--scrolling js-->
            <script src="../tecnologia/js/jquery.nicescroll.js"></script>
            <script src="../tecnologia/js/script.js"></script>
            <!--//scrolling js-->
            <!-- Bootstrap Core JavaScript -->
            <script src="../tecnologia/js/bootstrap.js"></script>
            <script>
                function pedente(){
                    document.getElementById("formPendente").submit();
                }

                var retornoJson = <?php isset($retornoJson) ? Sistema::echoToJson($retornoJson) : '' ?>;
            </script>
        </body>
    </html>

    <?php
}