<?php
include_once('../../controller/tecnologia/Sistema.php');
		if(!isset($_SESSION['usuario']) and !isset($_SESSION['senha'])){
			header('Location: ../../view/estrutura/login.php?success=F');
		}// not isset sessions of login
		else{
		$connect = Sistema::getConexao();
		$referencia = Sistema::getGet('referencia');
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
	<script type="text/javascript" src="../tecnologia/js/scriptConfirmarSeparacao.js"></script>
	<link type="text/css" href="../tecnologia/css/jquery-ui.css" rel="stylesheet"/>
	<link type="text/css" href="../tecnologia/css/styleCustom.css" rel="stylesheet"/>
    <script type="text/javascript" src="../../view/tecnologia/js/blockUI.js"></script>
	<!--// End Custom -->
</head>
<body id="bodyFullScreen">
<div id="loader"></div>
<div class="main-content"> 
      <!-- header-starts -->
      <div class="sticky-header header-section "> 
      
				<!--toggle button start-->
				<a href="../../view/estrutura/index.php"><button id="showLeftPushVoltarForm"><i class="glyphicon glyphicon-menu-left"></i></button></a>
                <a href="../../view/estrutura/index.php" class="display" hidden="true"><button hidden="true" id="showLeftPush"><i class="glyphicon glyphicon-menu-left"></i></button></a>
				<!--toggle button end-->
            
			<div class="topBar">Confirmar separação</div>
            <div class="topBarRight dropdown">
				<button type="button" class="btn botaoTop dropdown-toggle desktopHide" role="button" aria-expanded="false" data-toggle="dropdown" ><i class="material-icons">&#xE5D4;</i></button>
                <ul class="dropdown-menu dropdown-menu-right" role="menu">
                    <li><button name="GravarConfirmarSeparacaoMobile" class="btn botaoMobile" type="button" id="GravarConfirmarSeparacaoMobile">Gravar</button></li>
                    <li><button name="LimparMobile" class="btn botaoMobile" type="button" id="LimparMobile" data-toggle="modal" data-target="#LimparModal">Limpar</button></li>
                </ul>
            </div>
            
            </div>
    <div class="clearfix"> </div>
  </div>
      <!-- //header-ends --> 
      
      <!-- Start VoltarModal -->
      <div class="modal fade" id="VoltarModal"  role="dialog" aria-spanledby="VoltarModalspan">
    <div class="modal-dialog" role="document">
          <div class="modal-content">
        <form method="post" action="#">
              <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="VoltarModalspan">O registro não foi salvo</h4>
          </div>
              <div class="modal-body"> Deseja salvar as alterações realizadas neste formulário?
              
             
          
            <div class="clearfix"></div>
          </div>
              <div class="modal-footer">
            <button type="button" class="botaoBrancoLg" id="sim" onClick="submitConfirmarSeparacaoForm()"> Sim </button>
            <button type="button" class="botaoBrancoLg" onClick="javascript:window.location.href='../../view/estrutura/index.php'"> Não </button>
            <button type="button" class="botaoBranco"  data-dismiss="modal"> Cancelar </button>
          </div>
            </form>
      </div>
        </div>
  </div>
      <!-- //End Modal Filtro --> 
      <!-- main content start-->
      <div class="pageContent">
      <!-- method="post" id="ConfirmarSeparacao" action="../../controller/operacional/ConfirmacaoSeparacaoController.php" enctype="multipart/form-data"-->
      
      <div class="row">
      &nbsp;
      </div>
      <form method="post" id="ConfirmarSeparacao" action="" enctype="multipart/form-data">
    <div class="container">
    <div class="row">
       <div class="col-xs-12 pullBottom">
        <div class="inner-addonLg right-addonLg"> <font size=""><i class="glyphicon glyphicon-triangle-bottom" id="spandown"></i></font>
              <input type="text" class="form-control inputLg" name="os" id="os" placeholder="Informe a ordem de serviço" onClick="clickdownTipo();" class="form-control">
            </div>
        <input type="text" name="osHandle" id="osHandle" hidden="true">
      </div>
      
          <div class="clearfix"></div>
        </div><!-- end row -->
    </div>
    
    <div class="container">
    <div class="row">
    	<div class="panel-body widget-shadow">
          <h4 class="panelTitle">Informação coletadas</h4>
          
          <table class="table table-striped table-responsive" border="0">
  			<tbody>
    			<tr>
      				<td>Ordem de servico:  5473 </td>
   	 			</tr>
    			<tr>
      				<td>Produto:  Textil </td>
    			</tr>
                <tr>
      				<td>Código de barras:  789 02389 23721 2 </td>
    			</tr>
                <tr>
      				<td>Produto:  Automotivo </td>
    			</tr>
                <tr>
      				<td>Observação:  Teste </td>
    			</tr>
                <tr>
      				<td><font color="#FF0004">Quantidade:</font>  38 </td>
    			</tr>
                <tr>
      				<td><font color="#FF0004">Volume: </font>  7 </td>
    			</tr>
                <tr>
      				<td>Código de barras:  789 02389 23721 3 </td>
    			</tr>
                <tr>
      				<td>Produto:  textil </td>
    			</tr>
                <tr>
      				<td>Observação:  teste </td>
    			</tr>
  			</tbody>
		</table>

        </div><!-- end panel -->
        </div><!-- end row -->
        </div>
        
        <div class="container">
    	<div class="row">
        <div class="panel-body widget-shadow">
          <h4 class="panelTitle">Informação complementar</h4>
          
         
          <table class="table table-striped table-responsive" border="0">
  			<tbody>
    			<tr>
      				<td><font color="#FF0004">Saldo: </font>  23 </td>
   	 			</tr>
    			<tr>
      				<td><font color="#FF0004">Saldo de volumes: </font>  3 </td>
    			</tr>
  			</tbody>
		</table>

        </div><!-- end row -->
    </div><!-- end row -->
    </div>
    
    <div class="footerFixed">
          <div class="right">
        <button type="button" class="botao" name="GravarConfirmarSeparacao" onClick="GravarConfirmarSeparacao" id="GravarConfirmarSeparacao" >Gravar</button>
        <button type="button" class="botao" name="Limpar" id="Limpar" data-toggle="modal" data-target="#LimparModal">Limpar</button>
      </div>
      
        </div>
    <!-- end footer -->
  </form>
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