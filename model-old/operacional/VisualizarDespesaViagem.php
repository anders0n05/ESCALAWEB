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
	<script type="text/javascript" src="../tecnologia/js/scriptDespesaViagem.js"></script>
	<script type="text/javascript" src="../tecnologia/js/bootbox.js"></script>
	<link type="text/css" href="../tecnologia/css/jquery-ui.css" rel="stylesheet"/>
	<link type="text/css" href="../tecnologia/css/styleCustom.css" rel="stylesheet"/>
    <script type="text/javascript" src="../../view/tecnologia/js/blockUI.js"></script>
	<!--// End Custom -->
	</head>
	<body id="bodyFullScreen">
    <div id="loader"></div>
<div class="main-content"> 
<?php
include_once('../../model/operacional/retornoAlterarDespesaViagem.php');
?>
      <!-- header-starts -->
      <div class="sticky-header header-section "> 
          
         <div id="toggle">
         		<!--toggle button start-->
				<a href="DespesaViagem.php"><button id="showLeftPushVoltarForm"><i class="glyphicon glyphicon-menu-left"></i></button></a>
                <a href="DespesaViagem.php" class="display" hidden="true"><button hidden="true" id="showLeftPush"><i class="glyphicon glyphicon-menu-left"></i></button></a>
				<!--toggle button end-->            	
            </div>  
            <input type="text" hidden="true" class="display" id="editou" value="N">  
			<input type="text" hidden="true" class="display" id="referencia" value="<?php echo $referencia; ?>"> 
			<div class="topBar mobileHide" style="text-align:left; width:90%;">Despesa de viagem - <font color="#D1D1D1"><?php echo $statusNome.' desde '.$statusData.' às '.$statusHora; ?></font></div>
            <div class="topBar desktopHide">Despesa de viagem</div>
            <div class="topBarRight dropdown">
				<button type="button" class="btn botaoTop dropdown-toggle desktopHide" role="button" aria-expanded="false" data-toggle="dropdown" ><i class="material-icons">&#xE5D4;</i></button>
                <ul class="dropdown-menu dropdown-menu-right" role="menu">
                	<?php
						include_once('../../model/operacional/botoesFooterVisualizarDespesaViagemMobile.php');
					?>
                </ul>
            </div>
            
    <div class="clearfix"> </div>
  </div>
      <!-- //header-ends --> 
      <!-- main content start-->
      <div class="pageContent">
<?php
include_once('../../model/operacional/modalVisualizarDespesaViagem.php');
?>
      <form method="post" id="DespesaViagem" action="../../controller/operacional/AlterarDespesaViagemController.php?despesa=<?php echo $despesaHandle; ?>" enctype="multipart/form-data">
    <div class="row">
    <div class="formContent">
          <div class="col-md-5 col-xs-12 pullBottom" > <span>Tipo de despesa</span>
        <div class="inner-addon right-addon"> <font size="-2"><font size="-2"><i class="glyphicon glyphicon-triangle-bottom" id="spandown"></i></font></font>
              <input type="text" name="tipo" id="tipo" value="<?php echo $tipo; ?>" onKeyUp="digitou();"  onClick="clickdownTipo();" class="form-control pulaCampoEnter" <?php echo $disabled; ?>>
            </div>
        <input type="text" name="tipoHandle" value="<?php echo $tipoHandle; ?>" id="tipoHandle" hidden="true">
      </div>
          <div class="col-md-5 col-xs-12 pullBottom"> <span>Despesa</span>
        <div class="inner-addon right-addon"> <font size="-2"><i class="glyphicon glyphicon-triangle-bottom" id="spandown"></i></font>
              <input type="text" name="despesa" value="<?php echo $despesa; ?>" id="despesa" onClick="clickdownDespesa();" class="form-control pulaCampoEnter" <?php echo $disabled; ?>>
            </div>
        <input type="text" name="despesaHandle" value="<?php echo $despesaHandleItem; ?>" id="despesaHandle" hidden="true">
        </select>
      </div>
          <div class="col-md-2 col-xs-6 pullBottom"> <span>Viagem</span>
        <div class="inner-addon right-addon"> <font size="-2"><i class="glyphicon glyphicon-triangle-bottom" id="spandown"></i></font>
              <input type="text" name="viagem" id="viagem"  value="<?php echo $numeroViagem; ?>"  onClick="clickdownViagem();" class="form-control" disabled>
            </div>
        <input type="text" name="viagemHandle" id="viagemHandle" value="<?php echo $viagemHandle; ?>" hidden="true" disabled>
      </div>
          <div class="col-md-3 col-xs-6 pullBottom"> <span>Data</span>
        <input type='datetime-local' value="<?php echo $dataDespesa.'T'.$horaDespesa; ?>" id="data" name="data" class="form-control pulaCampoEnter" <?php echo $disabled; ?> />
      </div>
          <div class="col-md-3 col-xs-4 pullBottom"> <span>Quantidade</span>
        <input type="text" name="quantidade" id="quantidade" value="<?php echo $quantidade; ?>" onBlur="calcularInverso();" class="form-control pulaCampoEnter inputClass inputRight"<?php echo $disabled; ?> >
      </div>
          <div class="col-md-3 col-xs-4 pullBottom"> <span>Valor</span>
        <input type="text" name="ValorUnitario" onBlur="calcular();" value="<?php echo $valodUnitario; ?>"   onClick="limpavalor()" id="ValorUnitario" class="form-control pulaCampoEnter inputClass inputRight" <?php echo $disabled; ?>>
      </div>
          <div class="col-md-3 col-xs-4 pullBottom"> <span>Total</span>
        <input type="text" name="ValorTotal" id="ValorTotal" value="<?php echo $valorTotal; ?>" onBlur="calcularInverso();" class="form-control pulaCampoEnter inputClass inputRight" <?php echo $disabled; ?>>
      </div> 
          <div class="col-md-5 col-xs-12 pullBottom"> <span>Fornecedor</span>
        <div class="inner-addon right-addon"> <font size="-2"><i class="glyphicon glyphicon-triangle-bottom" id="spandown"></i></font>
              <input type="text" name="fornecedor" value="<?php echo $fornecedor; ?>" id="fornecedor" class="form-control pulaCampoEnter" onClick="clickdownFornecedor();" <?php echo $disabled; ?>>
            </div>
        <input type="text" name="fornecedorHandle" value="<?php echo $fornecedorHandle; ?>" id="fornecedorHandle" hidden="true">
      </div>
          <div class="col-md-4 col-xs-12 pullBottom"> <span>Forma de pagamento</span>
        <div class="inner-addon right-addon"> <font size="-2"><i class="glyphicon glyphicon-triangle-bottom" id="spandown"></i></font>
              <input type="text" name="FormaPagamento" id="FormaPagamento" value="<?php echo $FormaPagamento; ?>" class="form-control" onClick="clickdownFormaPagamento();" <?php echo $disabled.' '.$disabledpagamento; ?>>
            </div>
        <input type="text" name="FormaPagamentoHandle" value="<?php echo $FormaPagamentoHandle; ?>" id="FormaPagamentoHandle" hidden="true">
      </div>
          <div class="col-md-3 col-xs-12 pullBottom"> <span>Condição de pagamento</span>
        <div class="inner-addon right-addon"> <font size="-2"><i class="glyphicon glyphicon-triangle-bottom" id="spandown"></i></font>
              <input type="text" name="CondicaoPagamento" value="<?php echo $CondicaoPagamento; ?>" id="CondicaoPagamento" class="form-control" onClick="clickdownCondicaoPagamento();" <?php echo $disabled.' '.$disabledpagamento; ?>>
            </div>
        <input type="text" name="CondicaoPagamentoHandle" value="<?php echo $CondicaoPagamentoHandle; ?>" id="CondicaoPagamentoHandle" hidden="true">
      </div>
          <div class="col-xs-12"> <span>Observação</span>
        <textarea id="obs" class="form-control pulaCampoEnter textarea" name="observacao" <?php echo $disabled; ?>><?php echo $observacao; ?></textarea>
      </div>
          <div class="clearfix"></div>
    </div>
    </div>
    <!-- end row -->
    </form>
    <div class="row">
          <ul class="nav nav-tabs" id="myTabs" role="tablist">
        <li role="presentation" class="active"><a href="#anexo" id="anexo-tab" role="tab" data-toggle="tab" aria-controls="despesaviagem" aria-expanded="true">Anexo</a></li>
      </ul>
          <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade active in" role="tabpanel" id="anexo" aria-labelledby="anexo-tab">
              <div class="col-xs-12 bottonPull">
            <div class="left">
                  <!--button type="button" class="botaoBranco" name="liberarDespesaViagemAnexo" id="liberarDespesaViagemAnexo">Liberar</button>
                  <button type="button" class="botaoBranco" name="voltarDespesaViagemAnexo" id="voltarDespesaViagemAnexo">Voltar</button-->
                </div>
            <div class="right">
            <form method="post" enctype="multipart/form-data" action="../../controller/operacional/AnexarViagemDespesa.php?despesa=<?php echo $despesaHandle; ?>" id="InserirAnexoForm">
                  <label for="image_src" class="botaoBranco1" ><font size="3px"><i class="glyphicon glyphicon-plus"> </i> </font></label>
                  <input accept="image/*" onchange="preview_image()" type="file" name="image_src[]" id="image_src"  multiple/>
                  <button type="button" class="botaoBranco1" id="visualizarAnexo" disabled><font size="5px"><i class="fa fa-caret-up"> </i> </font></button>
                  <button type="button" class="botaoBranco1" id="removerAnexo" disabled><font size="4px"><i class="fa fa-minus"> </i> </font></button>
            </form>
            </div>
            <div class="dividerH"></div>
            <p>
                <table class="table table-bordered bottomPull" id="reqtableAnexo" border="0">
                  <thead>
                    <tr>
                      <th class="tableth">Nome do anexo</th>
                      <th width="12%" class="tableth">Data</th>
                    </tr>
                  </thead>
                  <?php include('../../model/operacional/AnexosDespesa.php'); ?>
                  <tbody id="image_preview">
                  </tbody>
                </table>
            <div ></div>
            </p>
            <div class="clearfix"></div>
          </div>
            </div>
      </div>
          <!-- end table --> 
        </div>
    </div>
    <!-- end row -->
    <div class="footerFixed mobileHide">
		<div class="right">
			<?php
				include_once('../../model/operacional/botoesFooterVisualizarDespesaViagem.php');
			?>
      	</div>
    </div>
    <!-- end footer -->
  
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