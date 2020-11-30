
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
<script type="text/javascript" src="../tecnologia/js/scriptViagem.js"></script>
<link type="text/css" href="../tecnologia/css/styleCustom.css" rel="stylesheet"/>
<link type="text/css" href="../../view/tecnologia/css/jquery.multiselect.css" rel="stylesheet"/>
<script type="text/javascript" src="../../view/tecnologia/js/jquery.multiselect.js"></script>
<script type="text/javascript" src="../../view/tecnologia/js/blockUI.js"></script>
<script type="text/javascript" src="../../view/tecnologia/js/scriptFiltro.js"></script>
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

.desktopLocal{
    display:default;
}

thead.desktopLocal{
    display:table-header-group;
}

td.desktopLocal{
    display: table-cell;
}

.mobile{
    display: none;
}

.floatRigth{
    float:right;
}

hr {
  display: block;
  margin-top: 0.2em;
  margin-bottom: 0.2em;
  margin-left: auto;
  margin-right: auto;
  border-style: inset;
  border-width: 0px;
}

@media screen and (max-width: 768px) {
    body{
        overflow: auto;	
    }

    .desktopLocal{
        display:none;
    }

    thead.desktopLocal{
        display:none;
    }

    td.desktopLocal{
        display: none;
    }

    .mobile{
        display: block;
    }

    .registro{
        float:left;
    }

    .alturaFixa{
        width:100%;
        height:750px;
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
}
</style>

<script>
    function trOnClick(prViagem) {
        window.location.href = "../../view/operacional/MinhaViagemVisualizar.php?viagem="+prViagem;
    }
</script>
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
            
			<div class="topBar">Viagem disponíveis</div>
            
        </div>
            
			<div class="clearfix"> </div>	
		</div>
		<!-- main content start-->
		<div class="pageContent">
        
<?php
	include('../../model/operacional/modalViagem.php');
?>
            <form method="post" action="#">
            <div class="table-responsive alturaFixa">
            <div class="larguraInteira">
                <table class="table table-striped table-bordered " id="reqtablenew" border="0">
                    <thead class="desktopLocal">
                    	<tr class="Noactivetr">
                            <th hidden="true">#</th>
                            <th class="col-sm-1">Número</th>
                            <th class="col-sm-2">Previsão de início</th>
                            <th class="col-sm-2">Previsão de término</th>
                            <th class="col-sm-2">Coleta</th>
                            <th class="col-sm-3">Endereço</th>
                            <th class="col-sm-2">Município</th>
                            <th class="col-sm-2">Entrega</th>
                            <th class="col-sm-3">Endereço</th>
                            <th class="col-sm-2">Município</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        	include_once('../../model/operacional/ModelMinhaViagem.php');
                        ?>
                    </tbody>
                </table>
             </div>
             </div>
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