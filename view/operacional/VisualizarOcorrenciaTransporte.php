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
	<script type="text/javascript" src="../tecnologia/js/scriptOcorrenciaTransporte.js"></script>
	<script type="text/javascript" src="../tecnologia/js/bootbox.js"></script>
	<link type="text/css" href="../tecnologia/css/jquery-ui.css" rel="stylesheet"/>
	<link type="text/css" href="../tecnologia/css/styleCustom.css" rel="stylesheet"/>
    <script type="text/javascript" src="../../view/tecnologia/js/blockUI.js"></script>
	<!--// End Custom -->
</head>
<body id="bodyFullScreen">
<div id="loader"></div>
<div class="main-content" > 
<?php
include_once('../../model/operacional/retornoAlterarOcorrenciaTransporte.php');
?>
      <!-- header-starts -->
      <div class="sticky-header header-section "> 
           <div id="toggle">
           		<!--toggle button start-->
				<a href="<?php echo $referencia; ?>.php"><button id="showLeftPushVoltarForm"><i class="glyphicon glyphicon-menu-left"></i></button></a>
                <a href="<?php echo $referencia; ?>.php" class="display" hidden="true"><button hidden="true" id="showLeftPush"><i class="glyphicon glyphicon-menu-left"></i></button></a>
				<!--toggle button end-->
            </div>  
            <input type="text" hidden="true" class="display" id="editou" value="N"> 
            <input type="text" hidden="true" class="display" id="referencia" value="<?php echo $referencia; ?>">  
            
			<div class="topBar">Ocorrência de Transporte</div>
            <div class="topBarRight dropdown">
				<button type="button" class="btn botaoTop dropdown-toggle desktopHide" role="button" aria-expanded="false" data-toggle="dropdown" ><i class="material-icons">&#xE5D4;</i></button>
                <ul class="dropdown-menu dropdown-menu-right" role="menu">
                	<?php
						include_once('../../model/operacional/botoesFooterVisualizarOcorrenciaTransporteMobile.php');
					?>
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
            <button type="button" class="botaoBrancoLg" id="sim" onClick="submitOcorrenciaTransporteForm()">Sim</button>
            <button type="button" class="botaoBrancoLg" onClick="javascript:window.location.href='OcorrenciaTransporte.php'">Não</button>
            <button type="button" class="botaoBranco"  data-dismiss="modal">Cancelar</button>
          </div>
            </form>
      </div>
        </div>
  </div>
      <!-- //End Modal Filtro --> 
      <!-- main content start-->
      <div class="pageContent">
      <?php
	  	include('../../model/operacional/modalVisualizarOcorrenciaTransporte.php');
	  ?>
       
      <form method="post" id="OcorrenciaTransporte" action="../../controller/operacional/AlterarOcorrenciaTransporteController.php?ocorrencia=<?php echo $ocorrenciaHandle; ?>" enctype="multipart/form-data">
    
    <div class="row">
    <div class="formContent">
    <div class="col-md-3  col-xs-12 pullBottom"> <span>Filial</span>
        <div class="inner-addon right-addon"> <font size="-2"><i class="glyphicon glyphicon-triangle-bottom" id="spandown"></i></font>
              <input type="text" name="filial" value="<?php echo $filial; ?>" id="filial" onClick="clickdownFilial();" class="form-control pulaCampoEnter">
            </div>
        <input type="text" name="filialHandle" value="<?php echo $filialHandle; ?>" id="filialHandle" hidden="true">
        
      </div>
      
     <div class="col-md-3 col-xs-12 pullBottom"> <span>Tipo de ocorrência</span>
        <div class="inner-addon right-addon"> <font size="-2"><i class="glyphicon glyphicon-triangle-bottom" id="spandown"></i></font>
              <input type="text" name="tipoOcorrencia" id="tipoOcorrencia" value="<?php echo $tipoOcorrencia; ?>" <?php echo $disabled; ?>  onClick="clickdownTipoOcorrencia();" class="form-control pulaCampoEnter">
        </div>
        	  <input type="text" name="tipoOcorrenciaHandle" id="tipoOcorrenciaHandle" value="<?php echo $tipoOcorrenciaHandle; ?>" hidden="true">
      </div>
          
      <div class="col-md-3	col-xs-12 pullBottom"> <span>Ação</span>
        <div class="inner-addon right-addon"> <font size="-2"><i class="glyphicon glyphicon-triangle-bottom" id="spandown"></i></font>
              <input type="text" name="acao" id="acao"  value="<?php echo $acao; ?>" <?php echo $disabled; ?>  onClick="clickdownAcao();" class="form-control pulaCampoEnter">
            </div>
        <input type="text" name="acaoHandle" id="acaoHandle" value="<?php echo $acaoHandle; ?>" hidden="true">
      </div>
      
      <div class="col-md-1 col-xs-3 pullBottom"> <span>Documento</span>
        <div class="inner-addon right-addon"> <font size="-2"><i class="glyphicon glyphicon-triangle-bottom" id="spandown"></i></font>
              <input type="text" name="documentoTransporte" id="documentoTransporte"  value="<?php echo $documentoTransporte; ?>" <?php echo $disabled; ?>  onClick="clickdowndocumentoTransporte();" class="form-control pulaCampoEnter">
            </div>
        <input type="text" name="romaneioItem" id="romaneioItem" value="<?php echo $romaneioItem; ?>" hidden="true">
        <input type="text" name="documentoTransporteHandle" id="documentoTransporteHandle" value="<?php echo $documentoTransporteHandle; ?>" hidden="true">
      </div>
      
       <div class="col-md-2 col-xs-9 pullBottom"> <span>Tipo de operação</span>
        <div class="inner-addon right-addon"> <font size="-2"><i class="glyphicon glyphicon-triangle-bottom" id="spandown"></i></font>
              <input type="text" name="acao" id="tipoOperacao"  value="<?php echo $tipoOperacao; ?>" <?php echo $disabled; ?>  onClick="clickdowntipoOperacao();" class="form-control pulaCampoEnter">
            </div>
        <input type="text" name="tipoOperacaoHandle" id="tipoOperacaoHandle" value="<?php echo $tipoOperacaoHandle; ?>" hidden="true">
      </div>
      
      <div class="col-md-3 col-xs-6 pullBottom"> <span>Motivo do atraso</span>
        <div class="inner-addon right-addon"> <font size="-2"><i class="glyphicon glyphicon-triangle-bottom" id="spandown"></i></font>
              <input type="text" name="motivoAtraso" value="<?php echo $motivoAtraso; ?>" id="motivoAtraso" class="form-control pulaCampoEnter" onClick="clickdownMotivoAtraso();">
            </div>
        <input type="text" name="motivoAtrasoHandle" value="<?php echo $motivoAtrasoHandle; ?>" id="motivoAtrasoHandle" hidden="true">
      </div>
      
      <div class="col-md-3 col-xs-6 pullBottom"> <span>Regra de baixa</span>
        <div class="inner-addon right-addon"> <font size="-2"><i class="glyphicon glyphicon-triangle-bottom" id="spandown"></i></font>
              <input type="text" name="regraBaixa" value="<?php echo $regraBaixa; ?>" id="regraBaixa" class="form-control pulaCampoEnter" onClick="clickdownregraBaixa();">
            </div>
        <input type="text" name="regraBaixaHandle" value="<?php echo $regraBaixaHandle; ?>" id="regraBaixaHandle" hidden="true">
      </div>
      
      <div class="col-md-2 col-xs-6 pullBottom"> <span>Data da ocorrência</span>
        <input type='datetime-local' value="<?php echo $date.'T'.$time; ?>" id="data" name="data" class="form-control pulaCampoEnter" />
      </div>
      
      <div class="col-md-2 col-xs-6 pullBottom"> <span>Data da chegada</span>
        <input name="dataChegada" id="dataChegada"  type='datetime-local' class="form-control pulaCampoEnter" >
      </div>
      <div class="col-md-2 col-xs-6 pullBottom"> <span>Data da entrada</span>
        <input name="dataEntrada" id="dataEntrada"  type='datetime-local' class="form-control pulaCampoEnter" >
      </div>
          <div class="col-md-2 col-xs-6 pullBottom"> <span>Data da saída</span>
        <input name="dataSaida" type='datetime-local' id="dataSaida" class="form-control pulaCampoEnter" >
      </div>
      <div class="col-md-3 col-xs-12 pullBottom"> <span>Responsável</span>
        <div class="inner-addon right-addon"> <font size="-2"><i class="glyphicon glyphicon-triangle-bottom" id="spandown"></i></font>
              <input type="text" name="responsavel" id="responsavel" value="<?php echo $responsavel; ?>" class="form-control pulaCampoEnter" onClick="clickdownResponsavel();" >
            </div>
        <input type="text" name="responsavelHandle" value="<?php echo $responsavelHandle; ?>" id="responsavelHandle" hidden="true">
      </div>
          <div class="col-md-5 col-xs-6  pullBottom"> <span>Nome do responsável</span>
              <input type="text" name="nome" value="<?php echo $nome; ?>" id="nome" class="form-control pulaCampoEnter">
      </div>
      <div class="col-md-2 col-xs-6 pullBottom"> <span>Nº documento</span>
              <input type="text" name="documento" value="<?php echo $documento; ?>" id="documento" class="form-control pulaCampoEnter">
      </div>
          <div class="col-xs-12"> <span>Observação</span>
        <textarea id="obs" class="form-control pulaCampoEnter textarea" name="observacao"><?php echo $observacao; ?></textarea>
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
            <!-- botoes anexo aqui -->
                </div>
            <div class="right">
            <form method="post" enctype="multipart/form-data" action="../../controller/operacional/AnexarOcorrenciaTransporte.php?ocorrencia=<?php echo $ocorrenciaHandle; ?>" id="InserirAnexoForm">
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
                  <?php include('../../model/operacional/AnexosOcorrenciaTransporte.php'); ?>
                  <tbody id="image_preview">
                  </tbody>
                </table>
            <div ></div>
            <p></p>
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
				include_once('../../model/operacional/botoesFooterVisualizarOcorrenciaTransporte.php');
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