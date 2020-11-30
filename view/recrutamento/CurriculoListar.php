<?php
include_once('../../controller/tecnologia/Sistema.php');

if((!isset($_SESSION['CPF'])) and (!isset($_SESSION['SENHAWEB']))) {
			header('Location: ../../view/estrutura/acesso.php?success=F');
		}// not isset sessions of login
		else{
			$connect = Sistema::getConexao();
?>
<!DOCTYPE HTML>
<html>
	<head>
	<title>Escalasoft - Listar Currículo</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="icon" type="image/png" href="../tecnologia/img/favicon.png" />
	<!-- Bootstrap Core CSS -->
	<link href="../../view/tecnologia/css/bootstrap.css" rel='stylesheet' type='text/css' />
	<!-- Custom CSS -->
	<link href="../../view/tecnologia/css/style.css" rel='stylesheet' type='text/css' />
	<!-- font CSS -->
	<!-- font-awesome icons -->
	<link href="../../view/tecnologia/css/font-awesome.css" rel="stylesheet"> 
	<!-- //font-awesome icons -->
	<!-- material icons -->
	<link href="../../view/tecnologia/css/material-icons.css" rel="stylesheet"> 
	<!-- //material icons -->
	 <!-- js-->
	<script src="../../view/tecnologia/js/jquery-1.11.1.min.js"></script>
	<script src="../../view/tecnologia/js/modernizr.custom.js"></script>
	<!--animate-->
	<link href="../../view/tecnologia/css/animate.css" rel="stylesheet" type="text/css" media="all">
	<script src="../../view/tecnologia/js/wow.min.js"></script>
		<script>
			 new WOW().init();
		</script>
	<!--//end-animate-->
	<!-- chart -->
	<script src="../tecnologia/js/Chart.js"></script>
	<!-- //chart -->
	<!--Calendario-->
	<link rel="stylesheet" href="../../view/tecnologia/css/clndr.css" type="text/css" />
	<script src="../../view/tecnologia/js/underscore-min.js" type="text/javascript"></script>
	<script src= "../../view/tecnologia/js/moment-2.2.1.js" type="text/javascript"></script>
	<script src="../../view/tecnologia/js/clndr.js" type="text/javascript"></script>
	<script src="../../view/tecnologia/js/site.js" type="text/javascript"></script>
	<!--End Calendario-->
	<!-- Menu Lateral -->
	<script src="../../view/tecnologia/js/metisMenu.min.js"></script>
	<script src="../../view/tecnologia/js/custom.js"></script>
	<link href="../../view/tecnologia/css/custom.css" rel="stylesheet">
	<!--//Menu Lateral-->
	<!-- Custom -->
	<script type="text/javascript" src="../tecnologia/js/jquery-ui.js"></script>
	<script type="text/javascript" src="../tecnologia/js/scriptCurriculo.js"></script>
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
		$(function(){
			$('table').tablesorter({
				widgets        : ['zebra', 'columns'],
				usNumberFormat : false,
				sortReset      : true,
				sortRestart    : true,
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
						<?php
							include('../../view/estrutura/menuCurriculo.php');
						?>
					</nav>
				</div>
			</div>
	        
			<div class="sticky-header header-section ">
				<button class="btn" id="showLeftPush"><i class="fa fa-bars"></i></button>
				<div class="topBar">Currículo</div>
	        </div>
			
			<div class="clearfix"> </div>	
			
			<div class="pageContent">
	            <form method="post" action="#">
	            <div class="table-responsive mobileHide">
		            <div class="larguraInteira" style="background: url('Fundo de tela_Escalatalentos2.png') center no-repeat;">
		                <!--table class="table table-striped table-bordered " id="reqtablenew" border="0">
		                	<thead>
		                    	<tr class="Noactivetr">
		                    	<th hidden="true">#</th>
								<th></th>
		                    	<th>Cod</th>
								<th>Nome</th>
		                        <th>Data</th>
		                        <th>Cpf</th>
								<th>Telefone</th>
		                        <th>Cidade</th>
		                        <th>Especialidade</th>
								<th>Data de nascimento</th>
								<th>Estado civil</th>
								<th>Sexo</th>
		                        </tr>
		                    </thead>
		                    <tbody>
		                        <?php
		                        	include_once('../../model/recrutamento/curriculoTabelaModel.php');
		                        ?>
		                    </tbody>
		                </table-->
		             </div>
	             </div>
	             
	             <!--div class="desktopHide">
	                <table class="table table-striped table-bordered bottomPull" id="reqtablenewMobile" border="0">
	                    <tbody>
	                        <?php
	                        	include_once('../../model/cadastro/pessoaTabelaModelMobile.php');
	                        ?>
	                    </tbody>
	                </table>
	             </div-->            
	              
	               <!--div class="footerFixed mobileHide">
	                    <div class="right">
	                        <div class="col-xs-1">
	                        	<button type="button" class="span">&nbsp;</button>
	                        </div>
	                        <div class="col-xs-11">
								<div class="right">
									<button name="visualizarCurriculo" class="botao display" type="button" id="visualizarCurriculo">Visualizar / Alterar</button>
								</div>
	                        </div>
	                    </div>
	                </div--><!-- end footer -->
	            </form>
	        </div><!-- end pageContent -->
	            
			<div class="clearfix"> </div>
		</div>
		<script src="../tecnologia/js/classie.js"></script>
		<script src="../tecnologia/js/jquery.nicescroll.js"></script>
		<script src="../tecnologia/js/script.js"></script>
	   <script src="../tecnologia/js/bootstrap.js"> </script>
	</body>
</html>

<?php
		}
?>