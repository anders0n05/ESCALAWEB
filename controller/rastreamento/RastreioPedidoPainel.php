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
            <link type="text/css" href="../tecnologia/css/styleCustom.css" rel="stylesheet"/>
            <link type="text/css" href="../../view/tecnologia/css/jquery.multiselect.css" rel="stylesheet"/>
            <!--// End Custom -->
            <!-- shortTable -->
            <link href="../../view/tecnologia/css/theme.bootstrap_3.min.css" rel="stylesheet">
			<style>
				canvas{
                    position: relative; 
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

                    <div class="topBar">Painel de pedidos</div>

                    <div class="topBarRight">
                        <ul class="dropdown-menu dropdown-menu-right" role="menu">
                            <li><button name="atualizar" class="btn botaoMobile display" type="button" id="atualizar">Atualizar</button></li>
                        </ul>
						<button data-toggle="modal" class="btn botaoTop" onclick="atualizarPagina();"><i class="glyphicon glyphicon-refresh"></i></button>
                    </div>
                </div>

                <div class="clearfix"> </div>	
            </div>
            <!-- //header-ends -->
            <!-- main content start-->
            <div class="pageContent">
                    <div class="container-fluid ">
                        <div class="col-md-12">
                            <div class="col-md-8">
                                <h3>Painel de indicadores</h2>
                            </div>          

                            <div class="col-md-1">
                                <button class="btn">Exportar</button>
                            </div> 

                            <div class="col-md-2">
                                <select class="form-control">
                                    <option>Últimos 15 dias</option>
                                    <option>Últimos 30 dias</option>
                                    <option>Últimos 60 dias</option>
                                    <option>Últimos 90 dias</option>
                                    <option>Últimos 180 dias</option>
                                    <option>Últimos 360 dias</option>
                                </select>                                
                            </div>
                            
                            <div class="col-md-1">
                                <select class="form-control">
                                    <option>SC</option>
                                </select>                                
                            </div>                            
                        </div>                        
                        <div class="col-md-offset-1">
                        <div class="row">
                            <div class="col-sm-5 itemPedidoPainel">
								<h4>
									Pedidos pendentes por etapa 
									<i class="fa fa-pie-chart pedidosPendentesEtapa-Pie"></i> 
									<i class="fa fa-line-chart pedidosPendentesEtapa-Line"></i> 
									<i class="fa fa-bar-chart pedidosPendentesEtapa-Bar"></i> 
									<i class="fa fa-area-chart pedidosPendentesEtapa-Area"></i>
									<i class="fa fa-list pedidosPendentesEtapa-List"></i>
								</h4>
								<hr>
								<canvas id="pedidosPendentesEtapa"></canvas>
							</div>
							<div class="col-sm-5 itemPedidoPainel">
								<h4>
									Situação de pedidos pendentes  
									<i class="fa fa-pie-chart situacaoPedidosPendentes-Pie"></i> 
									<i class="fa fa-line-chart situacaoPedidosPendentes-Line"></i> 
									<i class="fa fa-bar-chart situacaoPedidosPendentes-Bar"></i> 
									<i class="fa fa-area-chart situacaoPedidosPendentes-Area"></i>
									<i class="fa fa-list situacaoPedidosPendentes-List"></i>
								</h4>
								<hr>
								<canvas id="situacaoPedidosPendentes"></canvas>
							</div>
							<div class="col-sm-5 itemPedidoPainel">
								<h4>
									Pedidos pendentes de entrega por prazo  
									<i class="fa fa-pie-chart pedidosPendentesPrazo-Pie"></i> 
									<i class="fa fa-line-chart pedidosPendentesPrazo-Line"></i> 
									<i class="fa fa-bar-chart pedidosPendentesPrazo-Bar"></i> 
									<i class="fa fa-area-chart pedidosPendentesPrazo-Area"></i>
									<i class="fa fa-list pedidosPendentesPrazo-List"></i>
								</h4>
								<hr>
								<canvas id="pedidosPendentesPrazo"></canvas>
							</div>
							<div class="col-sm-5 itemPedidoPainel">
								<h4>
									Pedidos pendentes de entrega por transportadora  
									<i class="fa fa-pie-chart pedidosPendentesTransportadora-Pie"></i> 
									<i class="fa fa-line-chart pedidosPendentesTransportadora-Line"></i> 
									<i class="fa fa-bar-chart pedidosPendentesTransportadora-Bar"></i> 
									<i class="fa fa-area-chart pedidosPendentesTransportadora-Area"></i>
									<i class="fa fa-list pedidosPendentesTransportadora-List"></i>
								</h4>
								<hr>
								<canvas id="pedidosPendentesTransportadora"></canvas>
							</div>
							<div class="col-sm-5 itemPedidoPainel">
								<h4>
									Pedidos dos últimos 30 dias por transportadora  
									<i class="fa fa-pie-chart pedidosUltimos30DiasTransportadora-Pie"></i> 
									<i class="fa fa-line-chart pedidosUltimos30DiasTransportadora-Line"></i> 
									<i class="fa fa-bar-chart pedidosUltimos30DiasTransportadora-Bar"></i> 
									<i class="fa fa-area-chart pedidosUltimos30DiasTransportadora-Area"></i>
									<i class="fa fa-list pedidosUltimos30DiasTransportadora-List"></i>
								</h4>
								<hr>
								<canvas id="pedidosUltimos30DiasTransportadora"></canvas>
							</div>
							<div class="col-sm-5 itemPedidoPainel">
								<h4>
									Pedidos dos últimos 90 dias por transportadora  
									<i class="fa fa-pie-chart pedidosUltimos90DiasTransportadora-Pie"></i> 
									<i class="fa fa-line-chart pedidosUltimos90DiasTransportadora-Line"></i> 
									<i class="fa fa-bar-chart pedidosUltimos90DiasTransportadora-Bar"></i> 
									<i class="fa fa-area-chart pedidosUltimos90DiasTransportadora-Area"></i>
									<i class="fa fa-list pedidosUltimos90DiasTransportadora-List"></i>
								</h4>
								<hr>
								<canvas id="pedidosUltimos90DiasTransportadora"></canvas>
							</div>
							<div class="col-sm-5 itemPedidoPainel">
								<h4>
									Pedidos pendentes de entrega por estado  
									<i class="fa fa-pie-chart pedidosPendentesEstado-Pie"></i> 
									<i class="fa fa-line-chart pedidosPendentesEstado-Line"></i> 
									<i class="fa fa-bar-chart pedidosPendentesEstado-Bar"></i> 
									<i class="fa fa-area-chart pedidosPendentesEstado-Area"></i>
									<i class="fa fa-list pedidosPendentesEstado-List"></i>
								</h4>
								<hr>
								<canvas id="pedidosPendentesEstado"></canvas>
							</div>
							<div class="col-sm-5 itemPedidoPainel">
								<h4>
									Pedidos dos últimos 30 dias por estado  
									<i class="fa fa-pie-chart pedidosPendentesUltimos30DiasEstado-Pie"></i> 
									<i class="fa fa-line-chart pedidosPendentesUltimos30DiasEstado-Line"></i> 
									<i class="fa fa-bar-chart pedidosPendentesUltimos30DiasEstado-Bar"></i> 
									<i class="fa fa-area-chart pedidosPendentesUltimos30DiasEstado-Area"></i>
									<i class="fa fa-list pedidosPendentesUltimos30DiasEstado-List"></i>
								</h4>
								<hr>
								<canvas id="pedidosPendentesUltimos30DiasEstado"></canvas>
                            </div>
                            </div>                            
                        </div>
                    </div>

                    <!--div class="footerFixed">
                        <div class="col-xs-1">
                            <button type="button" class="span">&nbsp;</button>
                        </div>
                    </div><!-- end footer -->
            </div><!-- end pageContent -->

            <div class="clearfix"> </div>

            <!-- Classie -->
            <script src="../tecnologia/js/classie.js"></script>
            <!--scrolling js-->
            <script src="../tecnologia/js/jquery.nicescroll.js"></script>
            <script src="../tecnologia/js/script.js"></script>
            <script src="../tecnologia/js/scriptRastreioPedidoPainel.js"></script>
            <!--//scrolling js-->
            <!-- Bootstrap Core JavaScript -->
            <script src="../tecnologia/js/bootstrap.js"></script>
        </body>
    </html>

    <?php
}