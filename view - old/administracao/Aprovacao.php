<?php
include_once('../../controller/tecnologia/Sistema.php');

if(!isset($_SESSION['usuario']) and !isset($_SESSION['senha'])){
			header('Location: ../../view/estrutura/login.php?success=F');
		}// not isset sessions of login
		else{
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
<script type="text/javascript" src="../tecnologia/js/scriptAprovacao.js"></script>
<link type="text/css" href="../tecnologia/css/styleCustom.css" rel="stylesheet"/>
<link type="text/css" href="../../view/tecnologia/css/jquery.multiselect.css" rel="stylesheet"/>
<script type="text/javascript" src="../../view/tecnologia/js/jquery.multiselect.js"></script>
<script type="text/javascript" src="../../view/tecnologia/js/blockUI.js"></script>
<script type="text/javascript" src="../../view/tecnologia/js/scriptAprovacaoFiltro.js"></script>
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
                
			<div class="topBar">
            	<strong>Aprovação</strong> 
            </div>
            
            <div class="topBarRight">
            	<button type="button" class="btn botaoTop dropdown-toggle desktopHide" role="button" aria-expanded="false" data-toggle="dropdown"><i class="material-icons">&#xE5D4;</i></button>
                <ul class="dropdown-menu dropdown-menu-right" role="menu">
                    <li><button name="aprovarMobile" class="btn botaoMobile display" type="button" id="aprovarMobile" data-toggle="modal"  data-target="#AprovarModal">Aprovar</button></li>
                    <li><button name="recusarMobile" class="btn botaoMobile display" type="button" id="recusarMobile" id="recusar" data-toggle="modal"   data-target="#RecusarModal">Recusar</button></li>
                </ul>
				<button data-toggle="modal" class="botaoTop" onClick="multiselection();"  data-target="#FiltroModal"><i class="glyphicon glyphicon-search"></i></button>
            </div>
        </div>
            
			<div class="clearfix"> </div>	
		</div>
		<!-- main content start-->
		<div class="pageContent">
<?php
	include('../../model/administracao/modalFiltroAprovacao.php');
?>
        <!--form method="post" id="aprovacaoForm" action="../../controller/administracao/Aprovar.php?ref=Aprovacao"-->
        <form method="post" id="aprovacaoForm">
<?php
	include('../../model/administracao/retornoAprovacao.php');
	include('../../model/administracao/modalAprovacao.php');
?>
           <!--input type="text" name="acao" id="acao" value=""-->
            <div class="table-responsive mobileHide">
            <div class="larguraInteira">
                <table class="table table-striped table-bordered bottomPull" id="reqtablenew" border="0">
                	<thead>
                    	<th></th>
                        <th>Histórico</th>
                        <th>Solicitante</th>
                        <th>Alçada</th>
                        <th>Nível</th>
                        <th>Empresa</th>
                        <th>Filial</th>
                        <th>Valor</th>
                        <th>Assinar até</th>
                    </thead>
                    <tbody>
                        <?php
                        include_once('../../model/administracao/AprovacaoTabelaModel.php');
                        ?>
                    </tbody>
                </table>
			</div>
            </div>
            
            <div class="desktopHide">
                <table class="table table-striped table-bordered bottomPull" id="reqtablenewMobile" border="0">
                    <tbody>
                        <?php
                        	include_once('../../model/administracao/AprovacaoTabelaModelMobile.php');
                        ?>
                    </tbody>
                </table>
             </div>
             
               <div class="footerFixed mobileHide">
                        <div class="right">
                            <div class="col-xs-1">
                            
                            <button type="button" class="span">&nbsp;</button>
                            </div>
                            <div class="col-xs-11">
                            <div class="right">
                            <button name="aprovar" class="botao display" type="button" id="aprovar" data-toggle="modal"   data-target="#AprovarModal">Aprovar</button>
                            <button name="recusar" class="botao display" type="button" id="recusar" data-toggle="modal"   data-target="#RecusarModal">Recusar</button>
                            </div>
                            </div>
                        </div>
                </div><!-- end footer -->
            </form>
            </div><!-- end pageContent -->
				<div class="clearfix"> </div>
		</div>
	</div>
   
	<!-- Classie -->
		<script src="../tecnologia/js/classie.js"></script>
	<!--scrolling js-->
	<script src="../tecnologia/js/jquery.nicescroll.js"></script>
	<script src="../tecnologia/js/script.js"></script>
	<!--//scrolling js-->
	<!-- Bootstrap Core JavaScript -->
   <script src="../tecnologia/js/bootstrap.js"> </script>
</body>
</html>

<?php
		}
?>