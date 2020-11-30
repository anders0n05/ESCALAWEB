<?php
include_once('../../controller/tecnologia/Sistema.php');
if (!isset($_SESSION['usuario']) and ! isset($_SESSION['senha'])) {
    header('Location: ../../view/estrutura/login.php?success=F');
}// not isset sessions de login
else {
    $connect = Sistema::getConexao();
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Escalasoft</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="icon" type="image/png" href="view/tecnologia/img/favicon.png" />
		<!-- Bootstrap Core CSS -->
		<link href="view/tecnologia/css/bootstrap.css" rel='stylesheet' type='text/css' />
		<!-- Custom CSS -->
		<link href="view/tecnologia/css/style.css" rel='stylesheet' type='text/css' />
		<!-- font CSS -->
		<!-- font-awesome icons -->
		<link href="view/tecnologia/css/font-awesome.css" rel="stylesheet"> 
		<!-- //font-awesome icons -->
		<!-- js-->
		<script src="view/tecnologia/js/jquery-1.11.1.min.js"></script>
		<script src="view/tecnologia/js/modernizr.custom.js"></script>
		<!--animate-->
		<link href="view/tecnologia/css/animate.css" rel="stylesheet" type="text/css" media="all">
		<script src="view/tecnologia/js/wow.min.js"></script>
		<script>
			new WOW().init();
		</script>
		<!--//end-animate-->
		<!-- chart -->
		<script src="view/tecnologia/js/Chart.js"></script>
		<!-- //chart -->
		<!--circlechart-->
		<script src="view/tecnologia/js/jquery.circlechart.js"></script>
		<!--circlechart-->
		<!--Calendario-->
		<link rel="stylesheet" href="view/tecnologia/css/clndr.css" type="text/css" />
		<script src="view/tecnologia/js/underscore-min.js" type="text/javascript"></script>
		<script src= "view/tecnologia/js/moment-2.2.1.js" type="text/javascript"></script>
		<script src="view/tecnologia/js/clndr.js" type="text/javascript"></script>
		<script src="view/tecnologia/js/site.js" type="text/javascript"></script>
		<!--End Calendario-->
		<!-- Menu Lateral -->
		<script src="view/tecnologia/js/metisMenu.min.js"></script>
		<script src="view/tecnologia/js/custom.js"></script>
		<link href="view/tecnologia/css/custom.css" rel="stylesheet">
		<!--//Menu Lateral-->
		<!-- Custom -->
		<script type="text/javascript" src="view/tecnologia/js/jquery-ui.js"></script>
		<script type="text/javascript" src="view/tecnologia/js/bootbox.js"></script>
		<link type="text/css" href="view/tecnologia/css/jquery-ui.css" rel="stylesheet"/>
		<link type="text/css" href="view/tecnologia/css/styleCustom.css" rel="stylesheet"/>
		<link href="view/tecnologia/css/jquery.multiselect.css" rel="stylesheet" type="text/css">
		<link type="text/css" href="view/tecnologia/css/dashboard.css" rel="stylesheet"/>
		<!--// End Custom -->

		<!-- Charts -->
		<script src="view/tecnologia/js/raphael-2.1.4.min.js"></script>
		<script src="view/tecnologia/js/dx.all.js"></script>
		<script src="view/tecnologia/js/justgage.js"></script>
		<!-- End Charts -->

		<!-- DataTables -->
		<link type="text/css" href="view/tecnologia/css/jquery.dataTables.css" rel="stylesheet"/>
		<link type="text/css" href="view/tecnologia/css/jquery.dataTables_themeroller.css" rel="stylesheet"/>
		<script src="view/tecnologia/js/jquery.dataTables.js"></script>
		<script src="view/tecnologia/js/dataTables.uikit.js"></script>
		<!-- DataTables -->

		<!-- Calendario -->
		<script type="text/javascript" src="view/tecnologia/js/bootstrap-datepicker.js"></script>
		<script type="text/javascript" src="view/tecnologia/js/bootstrap-datepicker.pt-BR.min.js"></script>
		<link type="text/css" href="view/tecnologia/css/bootstrap-datepicker.css" rel="stylesheet"/>
		<style type="text/css">
			body,td,th {
				font-family: "Segoe UI Light";
			}
		</style>
		<!-- End Calendario -->

		<!-- Relogio -->
		<script language="javascript" type="text/javascript" src="view/tecnologia/js/jquery.thooClock.js"></script>  
		<!-- End Relogio -->

	</head>
	<!--body class="cbp-spmenu-push dashboardBody" id="bodyFullScreen"-->
	<body class="cbp-spmenu-push dashboardBody">
		<div id="loader"></div>
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
				<button id="showLeftPush" ><i class="fa fa-bars"></i></button>
				<!--toggle button end-->

				<div class="topBar">
					<?php
					if ($NomeFilial > null) {
						print( limitarTexto($NomeFilial, $limite = 25));
					} else {
						print( limitarTexto($NomeEmpresa, $limite = 25));
					}
					?>
				</div>
				<!--div class="topBarRight">
									<button class="botaoTop" onclick="toggleFullScreen()"><i class="fa fa-arrows-alt"></i></button>
				</div-->

			</div>

			<div class="clearfix"> </div>	
		</div>

		<div class="overlay"> &nbsp; </div>
		<div class="main-page charts-page">
			<h3 class="title1"></h3>
			<div class="charts">
				<?php include('../../model/dashboard/painelModel.php') ?>
			</div>
		</div>

	</div>



	<!--footer-//
	<div class="footer">
	   <p>&copy; 2016 Escalasoft Tecnologia Todos os direitos reservados| Simples, rápido e completo.</p>
	</div>
	<!--//footer-->
</div>


<!-- Classie -->
<script src="view/tecnologia/js/classie.js"></script>
<!--scrolling js-->
<script src="view/tecnologia/js/script.js"></script>
<script src="view/tecnologia/js/dashboard.js"></script>
<!--//scrolling js-->
<!-- Bootstrap Core JavaScript -->
<script src="view/tecnologia/js/bootstrap.js"></script>
<!-- jQueryMobile Core JavaScript -->
</body>
</html>

<?php
}
?>