<?php
include_once('../../controller/tecnologia/Sistema.php');
		if(!isset($_SESSION['usuario']) and !isset($_SESSION['senha'])){
			header('Location: ../../view/estrutura/login.php?success=F');
		}// not isset sessions of login
		else{
		$connect = Sistema::getConexao();
		$referencia = Sistema::getGet('referencia');
		$handlePedidoDeVenda = Sistema::getGet('handle');
		$numeroPedidoDeVenda = Sistema::getGet('numero');
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
	<script type="text/javascript" src="../tecnologia/js/scriptInserirItemPedidoDeVenda.js"></script>
	<link type="text/css" href="../tecnologia/css/jquery-ui.css" rel="stylesheet"/>
	<link type="text/css" href="../tecnologia/css/styleCustom.css" rel="stylesheet"/>
    <script type="text/javascript" src="../../view/tecnologia/js/blockUI.js"></script>
    <link type="text/css" href="../tecnologia/css/jquery.scrolling-tabs.css" rel="stylesheet"/>
	<!--// End Custom -->
    

</head>
<body>
<div class="main-content" id="bodyFullScreen"> 
<?php
	include_once('../../model/comercial/retornoInserirItemPedidoDeVenda.php');
?>
<div id="loader"></div>
      <!-- header-starts -->
      <div class="sticky-header header-section" > 
      
			<div id="toggle">
            	<!--toggle button start-->
				<a href="VisualizarPedidoDeVenda.php?handle=<?php echo $handlePedidoDeVenda; ?>"><button id="showLeftPushVoltarForm"><i class="glyphicon glyphicon-menu-left"></i></button></a>
                <a href="VisualizarPedidoDeVenda.php?handle=<?php echo $handlePedidoDeVenda; ?>" class="display" hidden="true"><button hidden="true" id="showLeftPush"><i class="glyphicon glyphicon-menu-left"></i></button></a>
				<!--toggle button end-->
            </div>  
            <input type="text" hidden="true" class="display" id="editou" value="N">
            <input type="text" hidden="true" class="display" id="referencia" value="<?php echo $referencia; ?>">   
			<div class="topBar">Item de pedido</div>
            <div class="topBarRight dropdown">
				<button type="button" class="btn botaoTop dropdown-toggle desktopHide" role="button" aria-expanded="false" data-toggle="dropdown" ><i class="material-icons">&#xE5D4;</i></button>
                <ul class="dropdown-menu dropdown-menu-right" role="menu">
                    <li><button name="GravarPedidoMobile" class="btn botaoMobile <?php echo $display; ?>" type="button" id="GravarPedidoMobile">Gravar</button></li>
                    <li><button name="LimparMobile" class="btn botaoMobile <?php echo $display; ?>" type="button" id="LimparMobile" data-toggle="modal" data-target="#LimparModal">Limpar</button></li>
                </ul>
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
            <button type="button" class="botaoBrancoLg" id="sim" onClick="submitPedidoForm()"> Sim </button>
            <button type="button" class="botaoBrancoLg" onClick="javascript:window.location.href='VisualizarPedidoDeVenda.php?handle=<?php echo $handlePedidoDeVenda; ?>'"> Não </button>
            <button type="button" class="botaoBranco"  data-dismiss="modal"> Cancelar </button>
          </div>
            </form>
      </div>
        </div>
  </div>
      <!-- //End Modal voltar--> 
      <!-- main content start-->
      <div class="pageContent">
      <form method="post" id="FormItemPedido" action="../../controller/comercial/WebServiceItemPedidoDeVendaController.php?referencia=<?php echo $referencia; ?>&metodo=Inserir&handle=<?php echo $handlePedidoDeVenda; ?>" enctype="multipart/form-data">
    <input type="text" hidden="true" class="display" name="handlePedidoDeVenda" id="handlePedidoDeVenda" value="<?php echo $handlePedidoDeVenda; ?>">
    
    <div class="row">
<?php
	include_once('../../model/comercial/modalInserirItemPedidoDeVenda.php');
	
?>
        </div>
	<div class="formContent">
    <div class="row">
     <div class="col-md-7 col-xs-7 pullBottom"> <span>Item</span>
        <div class="inner-addon right-addon"> <font size="-2"><i class="glyphicon glyphicon-triangle-bottom" id="spandown"></i></font>
            <input type="text" name="produto" value="<?php echo $produto; ?>" id="produto"  class="editou form-control pulaCampoEnter">
        </div>
            <input type="text" name="produtoHandle" value="<?php echo $produtoHandle; ?>" id="produtoHandle" hidden="true">
    </div>
    <div class="col-md-5 col-xs-5 pullBottom"> <span>Complemento</span>
            <input type="text" name="complemento" value="<?php echo $complemento; ?>" id="complemento"  class="editou form-control pulaCampoEnter">
    </div>
    <div class="col-md-2 col-xs-2 pullBottom"> <span>Unidade</span>
        <div class="inner-addon right-addon"> <font size="-2"><i class="glyphicon glyphicon-triangle-bottom" id="spandown"></i></font>
            <input type="text" name="unidade" value="<?php echo $unidadeMedida; ?>" id="unidade" disabled class="editou form-control">
        </div>
            <input type="text" name="unidadeHandle" value="<?php echo $unidadeMedidaHandle; ?>" id="unidadeHandle" hidden="true">
    </div>
    <div class="col-md-2 col-xs-2 pullBottom"> <span>Pedido</span>
        <div class="inner-addon right-addon"> <font size="-2"><i class="glyphicon glyphicon-triangle-bottom" id="spandown"></i></font>
            <input type="text" name="pedido" value="<?php echo $numeroPedidoDeVenda; ?>" id="pedido" disabled class="editou form-control">
        </div>
            <input type="text" name="pedidoHandle" value="<?php echo $handlePedidoDeVenda; ?>" id="pedidoHandle" hidden="true">
    </div>
    <div class="col-md-2 col-xs-2 pullBottom"> <span>Seq</span>
            <input type="text" name="seq" value="<?php echo $sequencial+1; ?>" disabled id="seq"  class="editou form-control">
    </div>
    <div class="col-md-6 col-xs-6 pullBottom"> <span>Almoxarifado</span>
        <div class="inner-addon right-addon"> <font size="-2"><i class="glyphicon glyphicon-triangle-bottom" id="spandown"></i></font>
            <input type="text" name="almoxarifado" disabled value="<?php echo $almoxarifado; ?>" id="almoxarifado"  class="editou form-control pulaCampoEnter">
        </div>
            <input type="text" name="almoxarifadoHandle" value="<?php echo $almoxarifadoHandle; ?>" id="almoxarifadoHandle" hidden="true">
    </div>
    <div class="col-md-2 col-xs-6 pullBottom"> <span>Aplicação</span>
        <div class="inner-addon right-addon"> <font size="-2"><i class="glyphicon glyphicon-triangle-bottom" id="spandown"></i></font>
            <input type="text" name="aplicacao" value="<?php echo $aplicacao; ?>" id="aplicacao"  class="editou form-control pulaCampoEnter">
        </div>
            <input type="text" name="aplicacaoHandle" value="<?php echo $aplicacaoHandle; ?>" id="aplicacaoHandle" hidden="true">
    </div>
    <div class="col-md-2 col-xs-2 pullBottom"> <span>Quantidade</span>
        <input type="text" name="quantidade" id="quantidade" value="<?php echo $quantidade; ?>" onBlur="calcularInverso();" class="form-control pulaCampoEnter inputRight inputClass" >
    </div>
    <div class="col-md-2 col-xs-2 pullBottom"> <span>Unitário</span>
        <input type="text" name="ValorUnitario" value="<?php echo $ValorUnitario; ?>" disabled  id="ValorUnitario" class="form-control pulaCampoEnter inputRight inputClass" >
    </div>
    <div class="col-md-2 col-xs-3 pullBottom"> <span>Valor total</span>
        <input type="text" name="ValorTotal" id="ValorTotal" value="<?php echo $ValorTotal; ?>" disabled  class="form-control inputRight inputClass" >
    </div>
    <div class="col-md-2 col-xs-2 pullBottom"> <span>Ajuste</span>
        <input type="text" name="ajuste" id="ajuste" value="0,00" disabled class="form-control inputRight inputClass" >
    </div>
    <div class="col-md-2 col-xs-3 pullBottom"> <span>Total geral</span>
        <input type="text" name="totalGeral" id="totalGeral" value="<?php echo $TotalGeral; ?>" disabled  class="form-control inputRight inputClass" >
    </div>
    <div class="col-xs-12"> <span>Informação técnica</span>
        <textarea id="informacaoTecnica" class="form-control textarea" disabled name="informacaoTecnica"><?php echo $informacaoTecnica; ?></textarea>
    </div>
    <div class="col-xs-12"> <span>Observação</span>
        <textarea id="obs" class="form-control textarea pulaCampoEnter" name="observacao"><?php echo $observacao; ?></textarea>
    </div>
        <input type="text" name="tabelaHandle" value="<?php echo $tabelaHandle; ?>" id="tabelaHandle" hidden="true">
        <input type="text" name="listaHandle" value="<?php echo $listaHandle; ?>" id="listaHandle" hidden="true">
          <div class="clearfix"></div>
        </div><!-- end row -->
     </div>
    
    </div>
    <!-- end row -->
    <div class="footerFixed mobileHide">
      <div class="right">
        <button type="button" class="botao <?php echo $display; ?>" name="GravarPedido" id="GravarPedido">Gravar</button>
        <button type="button" class="botao <?php echo $display; ?>" name="Limpar" id="Limpar" data-toggle="modal" data-target="#LimparModal">Limpar</button>
      </div>
    </div>
    <!-- end footer -->
  </form>
      <div class="clearfix"> </div>
    </div>
</div>

<script type="text/javascript" src="../../view/tecnologia/js/jquery.scrolling-tabs.js"></script>
<script>
$('.nav-tabs').scrollingTabs();
</script>
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