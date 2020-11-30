<?php
include_once('../../controller/tecnologia/Sistema.php');
		if(!isset($_SESSION['usuario']) and !isset($_SESSION['senha'])){
			header('Location: ../../view/estrutura/login.php?success=F');
		}// not isset sessions de login
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
<link href="../tecnologia/css/bootstrap.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="../tecnologia/css/style.css" rel='stylesheet' type='text/css' />
<!-- font CSS -->
<!-- font-awesome icons -->
<link href="../tecnologia/css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons -->
 <!-- js-->
<script src="../tecnologia/js/jquery-1.11.1.min.js"></script>
<script src="../tecnologia/js/modernizr.custom.js"></script>
<!--webfonts-->
<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
<!--//webfonts--> 
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
<!--circlechart-->
<script src="../tecnologia/js/jquery.circlechart.js"></script>
<!--circlechart-->
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
<script type="text/javascript" src="../tecnologia/js/scriptViagem.js"></script>
<script type="text/javascript" src="../tecnologia/js/bootbox.js"></script>
<link type="text/css" href="../tecnologia/css/jquery-ui.css" rel="stylesheet"/>
<link type="text/css" href="../tecnologia/css/styleCustom.css" rel="stylesheet"/>
<link href="../tecnologia/css/jquery.multiselect.css" rel="stylesheet" type="text/css">
<!--// End Custom -->

</head> 
<body class="cbp-spmenu-push">
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
				<?php 
					if($NomeFilial > null){
						echo $NomeFilial; 
					}
					else{
						echo $NomeEmpresa;
					}
				?>
            </div>
            <!--div class="topBarRight">
            X
            </div-->
            
        </div>
            
			<div class="clearfix"> </div>	
		</div>
        
        
			<div class="main-page charts-page">
				<h3 class="title1">Dashboard</h3>
                <div class="charts">
                 <div class="tab-content" id="myTabContent">
       			 <div class="tab-pane fade active in" role="tabpanel" id="diretoria" aria-labelledby="diretoria-tab">
				<div class="row row-height">

					<div class="col-md-4 chrt-page-grids col-height">
                    <div class="panel panel-default" id="resultadomesatual">
                      <!-- Default panel contents -->
                      <div class="panel-heading">
                      Resultado do mês atual 
                      <a href="#resultadomesatual" data-dismiss="alert" aria-label="close" id="hide"><i class="fa fa-times"></i></a>
                      <a href="#" class="maximize"><i class="fa fa-window-maximize"></i></a>
                      <a href="#" data-dismiss="alert" aria-label="close" id="hide"><i class="fa fa-retweet"></i></a>
                      </div>
                      
                      <div class="panel-body">
						<div class="col-sm-4">
                        Receita
                        <p>0,00</p>
                        </div>
                        <div class="col-sm-4">
                        Despesa
                        <p>337,50</p>
                        </div>
                        <div class="col-sm-4">
                        Resultado
                        <p style="color:#FF0004;">-337,50</p>
                        </div>

                      </div>
					</div>
                    </div>
                   
                    
                    <div class="col-md-2 chrt-page-grids col-height">
                    <div class="panel panel-default" id="saldobancarioatual">
                      <!-- Default panel contents -->
                      <div class="panel-heading">
                      Saldo bancário atual
                      <a href="#saldobancarioatual" data-dismiss="alert" aria-label="close" id="hide"><i class="fa fa-times"></i></a>
                      <a href="#" class="maximize"><i class="fa fa-window-maximize"></i></a>
                      <a href="#" data-dismiss="alert" aria-label="close" id="hide"><i class="fa fa-retweet"></i></a>
                      </div>
                      
                      <div class="panel-body">
						<table class="table-striped table-responsive" width="100%" border="0">
                          <tbody>
                            <tr>
                              <td>BRADESCO - RIO DO SUL</td>
                              <td style="color:#FF0004; text-align:right;">-3842,33</td>
                            </tr>
                            <tr>
                              <td>SICREDI</td>
                              <td style="text-align:right;">2275,59</td>
                            </tr>
                            <tr>
                              <td>BANCO DO BRASIL</td>
                              <td style="text-align:right;">0,00</td>
                            </tr>
                            <tr>
                              <td>SANTANDER</td>
                              <td style="text-align:right;">0,00</td>
                            </tr>
                            <tr class="pullBottom" style="background-color:#FFFFFF; border-top: 1px solid #dfdfdf; text-align:right" >
                              <td></td>
                              <td style="padding-top:10px;">-1566,74</td>
                            </tr>
                          </tbody>
                        </table>

					</div>
                    </div>
                    </div>
                    <div class="col-md-6 chrt-page-grids col-height">
                    <div class="panel panel-default" id="faturamentoporcliente">
                      <!-- Default panel contents -->
                      <div class="panel-heading">
                      Faturamento por cliente
                      <a href="#faturamentoporcliente" data-dismiss="alert" aria-label="close" id="hide"><i class="fa fa-times"></i></a>
                      <a href="#" class="maximize"><i class="fa fa-window-maximize"></i></a>
                      <a href="#" data-dismiss="alert" aria-label="close" id="hide"><i class="fa fa-retweet"></i></a>
                      </div>
                      
                      <div class="panel-body">
						<table width="100%" class="table-striped table-responsive" border="0">
                          <tbody>
                            <tr>
                              <td>Cliente</td>
                              <td>Mês atual</td>
                              <td>Mês passado</td>
                              <td>Mês retrasado</td>
                              <td>Média 3 meses</td>
                            </tr>
                            <tr>
                              <td>DOW / SP</td>
                              <td>0,00</td>
                              <td>19.470,06</td>
                              <td>0,00</td>
                              <td>6.490,02</td>
                            </tr>
                            <tr>
                              <td>MELITA - ILHOTA/SC</td>
                              <td>0,00</td>
                              <td>1078,06</td>
                              <td>0,00</td>
                              <td>359,49</td>
                            </tr>
                            <tr>
                              <td>DOW / SP</td>
                              <td>0,00</td>
                              <td>19.470,06</td>
                              <td>0,00</td>
                              <td>6.490,02</td>
                            </tr>
                            <tr class="pullBottom" style="background-color:#FFFFFF; border-top: 1px solid #dfdfdf;" >
                              <td></td>
                              <td style="padding-top:10px;">0,00</td>
                              <td style="padding-top:10px;">0,00</td>
                              <td style="padding-top:10px;">0,00</td>
                              <td style="padding-top:10px;">49.809,47</td>
                            </tr>
                          </tbody>
                        </table>

					</div>
                    </div>
                    </div>
                    </div>
                    <div class="row row-height">
                    <div class="col-md-7 chrt-page-grids col-height">
                    <div class="panel panel-default" id="faturamentoporfilial">
                      <!-- Default panel contents -->
                      <div class="panel-heading">
                      Faturamento por filial
                      <a href="#faturamentoporfilial" data-dismiss="alert" aria-label="close" id="hide"><i class="fa fa-times"></i></a>
                      <a href="#" class="maximize"><i class="fa fa-window-maximize"></i></a>
                      <a href="#" data-dismiss="alert" aria-label="close" id="hide"><i class="fa fa-retweet"></i></a>
                      </div>
                      
                      <div class="panel-body">
						<table width="100%" class="table-striped table-responsive" border="0">
                          <tbody>
                            <tr>
                              <td>Filial</td>
                              <td>Hoje</td>
                              <td>Ontem</td>
                              <td>Mês atual</td>
                              <td>Mês passado</td>
                            </tr>
                            <tr>
                              <td>LOGÍSTICA - CURITIBA/PR</td>
                              <td>0,00</td>
                              <td>0,00</td>
                              <td>0,00</td>
                              <td>1677,22</td>
                            </tr>
                            <tr>
                              <td>LOGÍSTICA - MATRIZ/SC</td>
                              <td>0,00</td>
                              <td>0,00</td>
                              <td>0,00</td>
                              <td>72,50</td>
                            </tr>
                            <tr>
                              <td>LOGÍSTICA - SÃO PAULO/SP</td>
                              <td>0,00</td>
                              <td>0,00</td>
                              <td>0,00</td>
                              <td>48.079,75</td>
                            </tr>
                            <tr class="pullBottom" style="background-color:#FFFFFF; border-top: 1px solid #dfdfdf;" >
                              <td></td>
                              <td style="padding-top:10px;">0,00</td>
                              <td style="padding-top:10px;">0,00</td>
                              <td style="padding-top:10px;">0,00</td>
                              <td style="padding-top:10px;">49.809,47</td>
                            </tr>
                          </tbody>
                        </table>
                        

					</div>
                    </div>
                    </div>
                    
                    <div class="col-md-5 chrt-page-grids col-height">
                    <div class="panel panel-default" id="taxaocupacaoarmazem">
                      <!-- Default panel contents -->
                      <div class="panel-heading">
                      Taxa de ocupação do armazém
                      <a href="#taxaocupacaoarmazem" data-dismiss="alert" aria-label="close" id="hide"><i class="fa fa-times"></i></a>
                      <a href="#" class="maximize"><i class="fa fa-window-maximize"></i></a>
                      <a href="#" data-dismiss="alert" aria-label="close" id="hide"><i class="fa fa-retweet"></i></a>
                      </div>
                      
                      <div class="panel-body">
							<div class="col-sm-6">
                                <span style="margin:0  102px">Picking</span>
                            	<div class="picking" data-percent="45" style="margin:0  102px 15px "></div>
                            </div>
							<div class="col-sm-6">
                                <span style="margin:0  102px">Pulmão</span>
                            	<div class="pulmao" data-percent="65" style="margin:0  102px 15px "></div>
                            </div>
					</div>
                    
                    </div>
                    </div>
                </div>
                <div class="row row-height">
                    <div class="col-md-12 charts chrt-page-grids">
                    <div class="panel panel-default" id="contasapagarereceber">
                      <!-- Default panel contents -->
                      <div class="panel-heading">
                      Contas a pagar e receber
                     <a href="#contasapagarereceber" data-dismiss="alert" aria-label="close" id="hide"><i class="fa fa-times"></i></a>
                      <a class="maximize"><i class="fa fa-window-maximize"></i></a>
                      <a data-dismiss="alert" aria-label="close" id="hide"><i class="fa fa-retweet"></i></a>
                      </div>
                      
                      <div class="panel-body">
						<div class="col-sm-12">
                        	<canvas id="bar" height="300" width="400" style="width: 400px; height: 300px;"></canvas>
                        </div>
                        <div class="col-sm-12">
                            <label><font color="#ed6c2d" size="+2"><i class="fa fa-square"></i></font> Receber</label>
                            <br>
                            <label><font color="#747474" size="+2"><i class="fa fa-square"></i></font> Pagar</label>
                        </div>
					</div>
                </div>
                </div>
                </div>
                
					<div class="clearfix"> </div>
					<script>
						
						var barChartData = {
							labels : ["Ontem","Hoje","Amanhã","Na semana","No mês atual"],
							datasets : [
								{
									fillColor : "rgba(233, 78, 2, 0.83)",
									strokeColor : "#ef553a",
									highlightFill: "#ef553a",
									data : [65,59,90,81,56]
								},
								{
									fillColor : "rgba(88, 88, 88, 0.83)",
									strokeColor : "#585858",
									highlightFill: "#585858",
									data : [28,48,40,19,96]
								}
							]
							
						};
					
						new Chart(document.getElementById("bar").getContext("2d")).Bar(barChartData);
						
						
						$('.picking').percentcircle({
						animate : true,
						diameter : 100,
						guage: 3,
						coverBg: '#fff',
						bgColor: '#efefef',
						fillColor: '#e94e02',
						percentSize: '15px',
						percentWeight: 'normal'
						});

						$('.pulmao').percentcircle({
						animate : true,
						diameter : 100,
						guage: 3,
						coverBg: '#fff',
						bgColor: '#efefef',
						fillColor: '#F2B33F',
						percentSize: '15px',
						percentWeight: 'normal'
					});
					
					
					</script>
              	
             	</div>
             
             
       			 <div class="tab-pane fade" role="tabpanel" id="freteembarcador" aria-labelledby="freteembarcador-tab">
                 Frete embarcador
             	</div>
             </div>
             
              <ul class="nav nav-tabs" id="myTabs" role="tablist">
                <li role="presentation" class="active"><a href="#diretoria" id="anexo-tab" role="tab" data-toggle="tab" aria-controls="dashboard" aria-expanded="true">Diretoria</a></li>
                <li role="presentation"><a href="#freteembarcador" id="anexo-tab" role="tab" data-toggle="tab" aria-controls="dashboard" aria-expanded="true">Frete embarcador</a></li>
              </ul>
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