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
<link rel="icon" type="image/png" href="view/tecnologia/img/favicon.png" />
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
<script type="text/javascript" src="../../view/tecnologia/js/jquery-ui.js"></script>
<script type="text/javascript" src="../../view/tecnologia/js/scriptAprovacao.js"></script>
<link type="text/css" href="../../view/tecnologia/css/styleCustom.css" rel="stylesheet"/>
<link type="text/css" href="../../view/tecnologia/css/jquery.multiselect.css" rel="stylesheet"/>
<script type="text/javascript" src="../../view/tecnologia/js/jquery.multiselect.js"></script>
<script type="text/javascript" src="../../view/tecnologia/js/blockUI.js"></script>
<script type="text/javascript" src="../../view/tecnologia/js/scriptAprovacaoFiltro.js"></script>
<!--// End Custom -->
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
            	<strong>Arquivos</strong> 
            </div>
            
        </div>
            
			<div class="clearfix"> </div>	
		</div>
		<!-- main content start-->
		<div class="pageContent">
            <div class="table-responsive">
            <div class="larguraInteira">
                <!--table class="table table-striped table-bordered bottomPull" border="0">
                	<thead>
                        <th>Arquivo</th>
                        <th>Tamanho</th>
                        <th><i class="fa fa-cogs"></i></th>
                    </thead>
                    <tbody>
							<?php
								/*$dir = '../armazenagem';
								$files = scandir($dir);
								foreach($files as $file)
								{
								  $ext = pathinfo($file, PATHINFO_EXTENSION);
								  $name = pathinfo($file, PATHINFO_FILENAME);
								  $size = realpath($file);
									var_dump( $size);
									if($name <> '.' && $name <> '..' && $name <> '...'){
										echo '<tr><td>'.$file.'</td> <td>'.$ext.'</td> <td><a href="'.$dir.'/'.$file.'"> <i class="fa fa-download"></i> </a> </td></tr>';
									}
								}
								
								$ftp_server = 'ftp.escalasoft.com.br';
								$ftp_user_name = 'escalaso';
								$ftp_user_pass = '#eschospedagem';
								
								$conn_id = ftp_connect($ftp_server);

								// login with username and password
								$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);

								// get contents of the current directory
								$contents = ftp_nlist($conn_id, "www/area-do-cliente");
								
								// output $contents
								//var_dump($contents);
								foreach($contents as $file)
								{
								  $ext = pathinfo($file, PATHINFO_EXTENSION);
								  $name = pathinfo($file, PATHINFO_FILENAME);
									
									if($name <> '.' && $name <> '..' && $name <> '...'){
										echo '<tr><td>'.$file.'</td> <td>'.$ext.'</td> <td><a href="'.$file.'"> <i class="fa fa-download"></i> </a> </td></tr>';
									}
								}*/
							?>
                    </tbody>
                </table-->
				<style>
				.myIframe {
					height: 100vh;
					overflow: auto; 
					-webkit-overflow-scrolling:touch;
					border: solid black 1px;
				} 
				.myIframe iframe {
					position: absolute;
					top: 0;
					left: 0;
					width: 100%;
					height: 100%;
				}
				</style>
				<div class="myIframe">
					<iframe src="http://www.escalasoft.com.br/area-do-cliente" frameborder="0"></iframe>
				</div>
			</div>
            </div>
		</div><!-- end pageContent -->
		<div class="clearfix"> </div>
		</div>
	</div>
   
	<!-- Classie -->
		<script src="../../view/tecnologia/js/classie.js"></script>
	<!--scrolling js-->
	<script src="../../view/tecnologia/js/jquery.nicescroll.js"></script>
	<script src="../../view/tecnologia/js/script.js"></script>
	<!--//scrolling js-->
	<!-- Bootstrap Core JavaScript -->
   <script src="../../view/tecnologia/js/bootstrap.js"> </script>
</body>
</html>

<?php
		}
?>