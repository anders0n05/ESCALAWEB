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
	<script type="text/javascript" src="../tecnologia/js/scriptInserirPessoa.js"></script>
	<link type="text/css" href="../tecnologia/css/jquery-ui.css" rel="stylesheet"/>
	<link type="text/css" href="../tecnologia/css/styleCustom.css" rel="stylesheet"/>
    <script type="text/javascript" src="../../view/tecnologia/js/blockUI.js"></script>
    <link type="text/css" href="../tecnologia/css/jquery.scrolling-tabs.css" rel="stylesheet"/>
	<!--// End Custom -->
    

</head>
<body>
<div class="main-content" id="bodyFullScreen"> 
<?php
	include_once('../../model/cadastro/retornoInserirPessoa.php');
?>
<div id="loader"></div>
      <!-- header-starts -->
      <div class="sticky-header header-section" > 
      
			<div id="toggle">
            	<!--toggle button start-->
				<a href="Pessoa.php"><button id="showLeftPushVoltarForm"><i class="glyphicon glyphicon-menu-left"></i></button></a>
                <button hidden="true" id="showLeftPush" class="display"><i class="glyphicon glyphicon-menu-left"></i></button>
				<!--toggle button end-->
            </div>  
            <input type="text" hidden="true" class="display" id="editou" value="N">
            <input type="text" hidden="true" class="display" id="referencia" value="<?php echo $referencia; ?>">   
			<div class="topBar">Pessoa</div>
            <div class="topBarRight dropdown">
				<button type="button" class="btn botaoTop dropdown-toggle desktopHide" role="button" aria-expanded="false" data-toggle="dropdown"><i class="material-icons">&#xE5D4;</i></button>
                <ul class="dropdown-menu dropdown-menu-right" role="menu">
                    <li><button name="GravarPessoaMobile" class="btn botaoMobile <?php echo $display; ?>" type="button" id="GravarPessoaMobile">Gravar</button></li>
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
            <button type="button" class="botaoBrancoLg" id="sim" onClick="submitPessoaForm()"> Sim </button>
            <button type="button" class="botaoBrancoLg" onClick="javascript:window.location.href='Pessoa.php'"> Não </button>
            <button type="button" class="botaoBranco"  data-dismiss="modal"> Cancelar </button>
          </div>
            </form>
      </div>
        </div>
  </div>
      <!-- //End Modal voltar--> 
      <!-- main content start-->
      <div class="pageContent">
      <form method="post" id="Pessoa" action="../../controller/cadastro/WebServicePessoaController.php?metodo=Inserir&referencia=InserirPessoa" enctype="multipart/form-data">
    <div class="row">
<?php
	include_once('../../model/cadastro/modalInserirPessoa.php');
?>
        </div>
	<div class="formContent">
    <div class="row">
      <div class="col-md-5 col-xs-12 pullBottom"> <span>Nome/razão social</span>
         <input type="text" name="nomePessoa" id="nomePessoa" value="<?php echo $nomePessoa; ?>" class="editou form-control pulaCampoEnter">
      </div>
      <div class="col-md-5 col-xs-10 pullBottom"> <span>Apelido/nome fantasia</span>
         <input type="text" name="apelido" id="apelido" value="<?php echo $apelido; ?>" class="editou form-control pulaCampoEnter">
      </div>
      <div class="col-md-2 col-xs-2 pullBottom"> <span>Código</span>
              <input type="text" name="codigo" id="codigo" disabled value="<?php echo $codigo; ?>" class="form-control">
      </div>
      <div class="col-md-2 col-xs-6 pullBottom"> <span>Tipo</span>
        <div class="inner-addon right-addon"> <font size="-2"><i class="glyphicon glyphicon-triangle-bottom" id="spandown"></i></font>
        <input type="text" name="tipo" value="<?php echo $tipo; ?>" id="tipo"  class="editou form-control pulaCampoEnter">
        </div>
        <input type="text" name="tipoHandle" value="<?php echo $tipoHandle; ?>" id="tipoHandle" hidden="true">
      </div>
      <div class="col-md-2 col-xs-6 pullBottom" id="cnpjCpf"> <span id="tituloCnpjCpf">Identificação</span>
        <input type="text" name="cnpjCpf" value="<?php echo $cnpjCpf; ?>" id="cnpjCpf"  class="editou form-control pulaCampoEnter">
      </div>
      <div class="col-md-2 col-xs-6 pullBottom"> <span>Fone</span>
        <input type="text" name="fone" value="<?php echo $fone; ?>" id="fone"  class="editou form-control pulaCampoEnter">
      </div>
      <div class="col-md-2 col-xs-6 pullBottom"> <span>Celular</span>
        <input type="text" name="celular" value="<?php echo $celular; ?>" id="celular"  class="editou form-control pulaCampoEnter">
      </div>
      <div class="col-md-4 col-xs-12 pullBottom"> <span>E-mail</span>
        <input type="text" name="email" value="<?php echo $email; ?>" id="email"  class="editou form-control pulaCampoEnter">
      </div>
          <div class="clearfix"></div>
        </div><!-- end row -->
     </div>
    
    <div class="row">
      <ul class="nav nav-tabs" id="myTabs" role="tablist">
        <li role="presentation" class="active"><a href="#complemento" id="complemento-tab" role="tab" data-toggle="tab" aria-controls="Pessoa" aria-expanded="true">Complemento</a></li>
        <li role="presentation" class="display"><a  href="#juridica" id="juridica-tab" role="tab" data-toggle="tab" aria-controls="Pessoa" aria-expanded="true">Jurídica</a></li>
        <li role="presentation" class="display"><a href="#fisica" id="fisica-tab" role="tab" data-toggle="tab" aria-controls="Pessoa" aria-expanded="true">Física</a></li>
        <li role="presentation"><a href="#endereco" id="endereco-tab" role="tab" data-toggle="tab" aria-controls="Pessoa" aria-expanded="true">Endereço</a></li>
        <li role="presentation"><a href="#clienteTab" id="clienteTab-tab" role="tab" data-toggle="tab" aria-controls="Pessoa" aria-expanded="true">Cliente</a></li>
      </ul>
      
        <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="complemento" aria-labelledby="complemento-tab">
        	<div class="col-xs-12 pullBottom">
            	<div class="formContent">
                	  <div class="col-md-4 col-xs-4 pullBottom"> <span>Ramo de atividade</span>
                        <div class="inner-addon right-addon"> <font size="-2"><i class="glyphicon glyphicon-triangle-bottom" id="spandown"></i></font>
                        <input type="text" name="ramoAtividade" value="<?php echo $ramoAtividade; ?>" id="ramoAtividade"  class="editou form-control pulaCampoEnter">
                        </div>
                        <input type="text" name="ramoAtividadeHandle" value="<?php echo $ramoAtividadeHandle; ?>" id="ramoAtividadeHandle" hidden="true">
                      </div>
                      <div class="col-md-4 col-xs-4 pullBottom"> <span>Setor de atividade</span>
                        <div class="inner-addon right-addon"> <font size="-2"><i class="glyphicon glyphicon-triangle-bottom" id="spandown"></i></font>
                        <input type="text" name="setorAtividade" disabled value="<?php echo $setorAtividade; ?>" id="setorAtividade"  class="editou form-control pulaCampoEnter">
                        </div>
                        <input type="text" name="setorAtividadeHandle" value="<?php echo $setorAtividadeHandle; ?>" id="setorAtividadeHandle" hidden="true">
                      </div>
                      <div class="col-md-4 col-xs-4 pullBottom"> <span>Categoria de atividade</span>
                        <div class="inner-addon right-addon"> <font size="-2"><i class="glyphicon glyphicon-triangle-bottom" id="spandown"></i></font>
                        <input type="text" name="categoriaAtividade" value="<?php echo $categoriaAtividade; ?>" id="categoriaAtividade"  class="editou form-control pulaCampoEnter">
                        </div>
                        <input type="text" name="categoriaAtividadeHandle" value="<?php echo $categoriaAtividadeHandle; ?>" id="categoriaAtividadeHandle" hidden="true">
                      </div>
                      <div class="col-md-12 col-xs-12 pullBottom"> <span>Observação</span>
                        <textarea name="obs" id="obs"  class="editou form-control pulaCampoEnter"><?php echo $observacao; ?></textarea>
                      </div>
                </div>
            </div>
        </div>
        
        <div role="tabpanel" class="tab-pane " id="juridica" aria-labelledby="juridica-tab">
        	<div class="col-xs-12 pullBottom">
            	<div class="formContent">
                	  <div class="col-md-4 col-xs-6 pullBottom"> <span>Inscrição estadual</span>
                        <input type="text" name="inscricaoEstadual" value="<?php echo $inscricaoEstadual; ?>" id="inscricaoEstadual"  class="editou form-control pulaCampoEnter">
                      </div>
                      <div class="col-md-8 col-xs-6 pullBottom"> <span>Grupo empresarial</span>
                        <div class="inner-addon right-addon"> <font size="-2"><i class="glyphicon glyphicon-triangle-bottom" id="spandown"></i></font>
                        <input type="text" name="grupoEmpresarial" value="<?php echo $grupoEmpresarial; ?>" id="grupoEmpresarial"  class="editou form-control pulaCampoEnter">
                        </div>
                        <input type="text" name="grupoEmpresarialHandle" value="<?php echo $grupoEmpresarialHandle; ?>" id="grupoEmpresarialHandle" hidden="true">
                      </div>
                </div>
            </div>
        </div>
        
        <div role="tabpanel" class="tab-pane " id="fisica" aria-labelledby="fisica-tab">
        	<div class="col-xs-12 pullBottom">
            	<div class="formContent">
                	  <div class="col-md-3 col-xs-6 pullBottom"> <span>Naturalidade</span>
                        <div class="inner-addon right-addon"> <font size="-2"><i class="glyphicon glyphicon-triangle-bottom" id="spandown"></i></font>
                        <input type="text" name="naturalidade" value="<?php echo $naturalidade; ?>" id="naturalidade"  class="editou form-control pulaCampoEnter">
                        </div>
                        <input type="text" name="naturalidadeHandle" value="<?php echo $naturalidadeHandle; ?>" id="naturalidadeHandle" hidden="true">
                      </div>
                      <div class="col-md-3 col-xs-6 pullBottom"> <span>Estado civil</span>
                        <div class="inner-addon right-addon"> <font size="-2"><i class="glyphicon glyphicon-triangle-bottom" id="spandown"></i></font>
                        <input type="text" name="estadoCivil" value="<?php echo $estadoCivil; ?>" id="estadoCivil"  class="editou form-control pulaCampoEnter">
                        </div>
                        <input type="text" name="estadoCivilHandle" value="<?php echo $estadoCivilHandle; ?>" id="estadoCivilHandle" hidden="true">
                      </div>
                      <div class="col-md-2 col-xs-6 pullBottom"> <span>Sexo</span>
                        <div class="inner-addon right-addon"> <font size="-2"><i class="glyphicon glyphicon-triangle-bottom" id="spandown"></i></font>
                        <input type="text" name="sexo" value="<?php echo $sexo; ?>" id="sexo"  class="editou form-control pulaCampoEnter">
                        </div>
                        <input type="text" name="sexoHandle" value="<?php echo $sexoHandle; ?>" id="sexoHandle" hidden="true">
                      </div>
                      <div class="col-md-2 col-xs-6 pullBottom"> <span>Nascimento</span>
                        <input type='date' value="<?php echo $date; ?>" id="nascimento" name="nascimento" class="form-control pulaCampoEnter" />
                      </div>
                      <div class="col-md-2 col-xs-6 pullBottom"> <span>Dependente</span>
                        <input type='text' value="<?php echo $dependente; ?>" id="dependente" name="dependente" class="form-control pulaCampoEnter inputRight" />
                      </div>
                      <div class="col-md-5 col-xs-6 pullBottom"> <span>Escolaridade</span>
                        <div class="inner-addon right-addon"> <font size="-2"><i class="glyphicon glyphicon-triangle-bottom" id="spandown"></i></font>
                        <input type="text" name="escolaridade" value="<?php echo $escolaridade; ?>" id="escolaridade"  class="editou form-control pulaCampoEnter">
                        </div>
                        <input type="text" name="escolaridadeHandle" value="<?php echo $escolaridadeHandle; ?>" id="escolaridadeHandle" hidden="true">
                      </div>
                      <div class="col-md-5 col-xs-12 pullBottom"> <span>Local de trabalho</span>
                        <input type='text' value="<?php echo $localTrabalho; ?>" id="localTrabalho" name="localTrabalho" class="form-control pulaCampoEnter" />
                      </div>
                      <div class="col-md-2 col-xs-6 pullBottom"> <span>Admissão</span>
                        <input type='date' value="<?php echo $date; ?>" id="admissao" name="admissao" class="form-control pulaCampoEnter" />
                      </div>
                      <div class="col-md-4 col-xs-6 pullBottom"> <span>Nome do pai</span>
                        <input type='text' value="<?php echo $nomePai; ?>" id="nomePai" name="nomePai" class="form-control pulaCampoEnter" />
                      </div>
                      <div class="col-md-4 col-xs-6 pullBottom"> <span>Nome da mãe</span>
                        <input type='text' value="<?php echo $nomeMae; ?>" id="nomeMae" name="nomeMae" class="form-control pulaCampoEnter" />
                      </div>
                      <div class="col-md-4 col-xs-6 pullBottom"> <span>Nome do cônjugue</span>
                        <input type='text' value="<?php echo $nomeConjugue; ?>" id="nomeConjugue" name="nomeConjugue" class="form-control pulaCampoEnter" />
                      </div>
                </div>
            </div>
        </div>
        
        <div role="tabpanel" class="tab-pane " id="endereco" aria-labelledby="endereco-tab">
        	<div class="col-xs-12 pullBottom">
            	<div class="formContent">
                	  <div class="col-md-2 col-xs-4 pullBottom"> <span>Cep</span>
                        <div class="inner-addon right-addon"> <font size="-2"><i class="glyphicon glyphicon-triangle-bottom" id="spandown"></i></font>
                        <input type="text" name="cep" value="<?php echo $cep; ?>" id="cep"  class="editou form-control pulaCampoEnter inputRight">
                        </div>
                        <input type="text" name="cepHandle" value="<?php echo $cepHandle; ?>" id="cepHandle" hidden="true">
                      </div>
                      <div class="col-md-3 col-xs-8 pullBottom"> <span>Tipo logradouro</span>
                        <div class="inner-addon right-addon"> <font size="-2"><i class="glyphicon glyphicon-triangle-bottom" id="spandown"></i></font>
                        <input type="text" name="tipoLogradouro"  value="<?php echo $tipoLogradouro; ?>" id="tipoLogradouro"  class="editou form-control">
                        </div>
                        <input type="text" name="tipoLogradouroHandle" value="<?php echo $tipoLogradouroHandle; ?>" id="tipoLogradouroHandle" hidden="true">
                      </div>
                      <div class="col-md-5 col-xs-8 pullBottom"> <span>Logradouro</span>
                        <input type='text' value="<?php echo $logradouro; ?>"  id="logradouro" name="logradouro" class="form-control" />
                      </div>
                      <div class="col-md-1 col-xs-2 pullBottom"> <span>Número</span>
                        <input type='text' value="<?php echo $numeroEndereco; ?>" id="numeroEndereco" name="numeroEndereco" class="form-control pulaCampoEnter inputRight" />
                      </div>
                      <div class="col-md-1 col-xs-2 pullBottom"> <br class="desktopHide"><p class="mobileHide">&nbsp;</p>
                      <span>
                        <input type='checkbox' value="<?php echo $ehSemNumero; ?>" id="ehSemNumero" name="ehSemNumero"/>
                        Sem número
                      </span>  
                      </div>
                      <div class="col-md-4 col-xs-4 pullBottom"> <span>Complemento</span>
                        <input type='text' value="<?php echo $complementoEndereco; ?>" id="complementoEndereco" name="complementoEndereco" class="form-control pulaCampoEnter" />
                      </div>
                      <div class="col-md-4 col-xs-4 pullBottom"> <span>País</span>
                        <div class="inner-addon right-addon"> <font size="-2"><i class="glyphicon glyphicon-triangle-bottom" id="spandown"></i></font>
                        <input type="text" name="pais" value="<?php echo $pais; ?>"  id="pais"  class="editou form-control">
                        </div>
                        <input type="text" name="paisHandle" value="<?php echo $paisHandle; ?>" id="paisHandle" hidden="true">
                      </div>
                      <div class="col-md-4 col-xs-4 pullBottom"> <span>Estado</span>
                        <div class="inner-addon right-addon"> <font size="-2"><i class="glyphicon glyphicon-triangle-bottom" id="spandown"></i></font>
                        <input type="text" name="estado" value="<?php echo $estado; ?>"  id="estado"  class="editou form-control">
                        </div>
                        <input type="text" name="estadoHandle" value="<?php echo $estadoHandle; ?>" id="estadoHandle" hidden="true">
                      </div>
                      <div class="col-md-6 col-xs-6 pullBottom"> <span>Município</span>
                        <div class="inner-addon right-addon"> <font size="-2"><i class="glyphicon glyphicon-triangle-bottom" id="spandown"></i></font>
                        <input type="text" name="municipio" value="<?php echo $municipio; ?>"  id="municipio"  class="editou form-control">
                        </div>
                        <input type="text" name="municipioHandle" value="<?php echo $municipioHandle; ?>" id="municipioHandle" hidden="true">
                      </div>
                      <div class="col-md-6 col-xs-6 pullBottom"> <span>Bairro</span>
                        <div class="inner-addon right-addon"> <font size="-2"><i class="glyphicon glyphicon-triangle-bottom" id="spandown"></i></font>
                        <input type="text" name="bairro" value="<?php echo $bairro; ?>"  id="bairro"  class="editou form-control">
                        </div>
                        <input type="text" name="bairroHandle" value="<?php echo $bairroHandle; ?>" id="bairroHandle" hidden="true">
                      </div>
                </div>
            </div>
        </div>
        
        <div role="tabpanel" class="tab-pane " id="clienteTab" aria-labelledby="clienteTab-tab">
        	<div class="col-xs-12 pullBottom">
            	<div class="formContent">
                	  <div class="col-md-6 col-xs-6 pullBottom"> <span>Forma de pagamento padrão</span>
                        <div class="inner-addon right-addon"> <font size="-2"><i class="glyphicon glyphicon-triangle-bottom" id="spandown"></i></font>
                              <input type="text" name="FormaPagamento"  id="FormaPagamento" value="<?php echo $FormaPagamento; ?>"   class="form-control pulaCampoEnter" >
                            </div>
                        <input type="text" name="FormaPagamentoHandle" value="<?php echo $FormaPagamentoHandle; ?>" id="FormaPagamentoHandle" hidden="true">
                      </div>
                      <div class="col-md-6 col-xs-6 pullBottom"> <span>Condição de pagamento padrão</span>
                        <div class="inner-addon right-addon"> <font size="-2"><i class="glyphicon glyphicon-triangle-bottom" id="spandown"></i></font>
                              <input type="text" name="CondicaoPagamento" value="<?php echo $CondicaoPagamento; ?>"   id="CondicaoPagamento" class="form-control pulaCampoEnter">
                            </div>
                        <input type="text" name="CondicaoPagamentoHandle" value="<?php echo $CondicaoPagamentoHandle; ?>" id="CondicaoPagamentoHandle" hidden="true">
                      </div>
                </div>
            </div>
        </div>
            
      </div>
          <!-- end table --> 
        </div>
  </form>
    </div>
    <!-- end row -->
    <div class="footerFixed mobileHide">
      <div class="right">
        <button type="button" class="botao <?php echo $display; ?>" name="GravarPessoa" id="GravarPessoa">Gravar</button>
        <button type="button" class="botao <?php echo $display; ?>" name="Limpar" id="Limpar" data-toggle="modal" data-target="#LimparModal">Limpar</button>
      </div>
    
    </div>
    <!-- end footer -->
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