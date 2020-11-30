<?php

include_once('../../controller/tecnologia/Sistema.php');

date_default_timezone_set('America/Sao_Paulo');

if (!isset($_SESSION['usuario']) and !isset($_SESSION['senha'])) {
    header('Location: ../../view/estrutura/login.php?success=F');
}
else {
    $connect = Sistema::getConexao();
    $handleMinhaViagem = $_GET["viagem"];

    
    $query = $connect->prepare("SELECT NUMERO
                                  FROM OP_VIAGEM 
                                 WHERE HANDLE = '$handleMinhaViagem' ");
    $query->execute();
    $dataSet = $query->fetch(PDO::FETCH_ASSOC);

    $numeroViagem =  $dataSet['NUMERO'];
    
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

            <link href="../../view/tecnologia/css/TabelasPadrao.css" rel="stylesheet">
            <!--// End shortTable -->
                <style>
                    .ViagemDespesa{
                        width:100%;
                        height:600px;   
                        overflow-y: scroll;  
                    }

                    /* width */
                    ::-webkit-scrollbar {
                    width: 5px;
                    }

                    /* Track */
                    ::-webkit-scrollbar-track {
                    box-shadow: inset 0 0 5px grey; 
                    border-radius: 10px;
                    }
                    
                    /* Handle */
                    ::-webkit-scrollbar-thumb {
                    background: gray; 
                    border-radius: 10px;
                    }

                    /* Handle on hover */
                    ::-webkit-scrollbar-thumb:hover {
                    background: black; 
                    }


                </style>
            </head>
            <body class="cbp-spmenu-push" id="bodyMinhaViagem">
            <div class="main-content">
		<!--left-fixed -navigation-->
		<div class=" sidebar" role="navigation">
            <div class="navbar-collapse">
				<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
					<?php
						include('../../view/estrutura/menu.php');
					?>
				</nav>
			</div>
		</div>
        
		<!--left-fixed -navigation-->
		<!-- header-starts -->
		<div class="sticky-header header-section ">
            
				<!--toggle button start-->
				<button id="showLeftPush"><i class="fa fa-bars"></i></button>
				<!--toggle button end-->
            
			<div class="topBar">Despesas da viagem <?= $numeroViagem; ?></div>            
        </div>
            
			<div class="clearfix"> </div>	
		</div>
		<!-- main content start-->
		<div class="pageContent">
            <div class="container">
                <form method="post" action="#">
                    <input type="hidden" class="form-control" id="VIAGEM" value="<?= $handleMinhaViagem ?>">
                    <div class="table-responsive alturaFixa">
                            <div class="ViagemDespesa">
                                <table class="table table-striped table-bordered " id="reqtablenew" border="0">
                                    <thead class="desktopLocal">
                                        <tr class="Noactivetr">
                                            <th hidden="true">#</th>
                                            <th class="col-sm-1">Número</th>
                                            <th class="col-sm-2">Data</th>
                                            <th class="col-sm-1">Filial</th>
                                            <th class="col-sm-3">Tipo</th>
                                            <th class="col-sm-3">Despesa</th>
                                            <th class="col-sm-1">Valor</th>
                                        </tr>
                                    </thead>
                                    <tbody id="listaDespesa">

                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-6 right">
                                <button type="button" class="btn btn-success btn-lg" id="BOTAONOVA">+</button>
                                <button type="button" class="btn btn-default btn-lg btnFechar" id="BOTAOFECHAR">Fechar</button>
                            </div>  
                    </div>
                </form>
            
            </div>  
             
        </div> 
                    
            <!-- Classie -->
            <script src="../tecnologia/js/classie.js"></script>
            <!--scrolling js-->
            <script src="../tecnologia/js/jquery.nicescroll.js"></script>
            <script src="../tecnologia/js/script.js"></script>
            <!--//scrolling js-->
            <!-- Bootstrap Core JavaScript -->
            <!-- <script src="../tecnologia/js/bootstrap.js"></script> -->
            <script src="../tecnologia/js/bootstrap.js"></script>
            
            <!-- jQuery Mask -->
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
            <!-- DataTables -->
            <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.10.18/r-2.2.2/datatables.min.css"/>
            <script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.18/r-2.2.2/datatables.min.js"></script>
            <!-- SweetAlert -->
            <script type="text/javascript" src="../tecnologia/js/sweetalert/sweetalert.min.js"></script>

            <script src="//d2wy8f7a9ursnm.cloudfront.net/v6/bugsnag.min.js"></script>
            <script>window.bugsnagClient = bugsnag('9f6cc1049582acdb30bc5fff5e922e62')</script>
            <script type="text/javascript" src="../operacional/js/minhaViagemListaDespesa.js"></script>
        </body>
    </html>

    <?php
}
 ?>