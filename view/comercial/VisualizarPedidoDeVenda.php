<?php
   include_once('../../controller/tecnologia/Sistema.php');
   		if(!isset($_SESSION['usuario']) and !isset($_SESSION['senha'])){
   			header('Location: ../../view/estrutura/login.php?success=F');
   		}// not isset sessions of login
   		else{
   		$connect = Sistema::getConexao();
   		$referencia = Sistema::getGet('referencia');
   		$handlePedidoDeVenda = Sistema::getGet('handle');
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
      <script type="text/javascript" src="../tecnologia/js/scriptInserirPedidoDeVenda.js"></script>
      <link type="text/css" href="../tecnologia/css/jquery-ui.css" rel="stylesheet"/>
      <link type="text/css" href="../tecnologia/css/styleCustom.css" rel="stylesheet"/>
      <script type="text/javascript" src="../../view/tecnologia/js/blockUI.js"></script>
      <link type="text/css" href="../tecnologia/css/jquery.scrolling-tabs.css" rel="stylesheet"/>
      <!--// End Custom -->
   </head>
   <body>
      <div class="main-content" id="bodyFullScreen">
         <?php
            include_once('../../model/comercial/retornoVisualizarPedidoDeVenda.php');
            ?>
         <div id="loader"></div>
         <!-- header-starts -->
         <div class="sticky-header header-section" >
            <div id="toggle">
               <!--toggle button start-->
               <a href="PedidoDeVenda.php"><button id="showLeftPushVoltarForm"><i class="glyphicon glyphicon-menu-left"></i></button></a>
               <button hidden="true" class="display" id="showLeftPush"><i class="glyphicon glyphicon-menu-left"></i></button>
               <!--toggle button end-->
            </div>
            <input type="text" hidden="true" class="display" id="editou" value="N">
            <input type="text" hidden="true" class="display" id="referencia" value="<?php echo $referencia; ?>">   
            <div class="topBar">Pedido de venda</div>
            <div class="topBarRight dropdown">
               <button type="button" class="btn botaoTop dropdown-toggle desktopHide" role="button" aria-expanded="false" data-toggle="dropdown" ><i class="material-icons">&#xE5D4;</i></button>
               <ul class="dropdown-menu dropdown-menu-right" role="menu">
                  <?php
                     include_once('../../model/comercial/botoesFooterVisualizarPedidoDeVendaMobile.php');		
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
                  <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
                     <h4 class="modal-title" id="VoltarModalspan">O registro não foi salvo</h4>
                  </div>
                  <div class="modal-body">
                     Deseja salvar as alterações realizadas neste formulário?
                     <div class="clearfix"></div>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="botaoBrancoLg" id="sim" onClick="submitPedidoForm()"> Sim </button>
                     <button type="button" class="botaoBrancoLg" onClick="javascript:window.location.href='PedidoDeVenda.php'"> Não </button>
                     <button type="button" class="botaoBranco"  data-dismiss="modal"> Cancelar </button>
                  </div>
               </div>
            </div>
         </div>
         <!-- //End Modal voltar--> 
         <!-- main content start-->
         <div class="pageContent">
            <form method="post" id="Pedido" action="../../controller/comercial/WebServicePedidoDeVendaController.php?handle=<?php echo $handlePedidoDeVenda; ?>&referencia=VisualizarPedidoDeVenda&metodo=Alterar" enctype="multipart/form-data">
               <input type="text" hidden="true" class="display" name="handlePedidoDeVenda" id="handlePedidoDeVenda" value="<?php echo $handlePedidoDeVenda; ?>">
               <div class="row">
                  <?php
                     include_once('../../model/comercial/modalInserirPedidoDeVenda.php');
                     ?>
               </div>
               <div class="formContent">
                  <div class="row">
                     <div class="col-md-5 col-xs-12 pullBottom">
                        <span>Filial</span>
                        <div class="inner-addon right-addon"> <font size="-2"><i class="glyphicon glyphicon-triangle-bottom" id="spandown"></i></font>
                           <input type="text" name="filialPedidoDeVenda" id="filialPedidoDeVenda" <?php echo $disabled; ?> value="<?php echo $filialPedidoDeVenda; ?>" class="editou form-control pulaCampoEnter">
                        </div>
                        <input type="text" name="filialPedidoDeVendaHandle" value="<?php echo $filialPedidoDeVendaHandle; ?>" id="filialPedidoDeVendaHandle" hidden="true">
                     </div>
                     <div class="col-md-5 col-xs-12 pullBottom">
                        <span>Tipo</span>
                        <div class="inner-addon right-addon"> <font size="-2"><i class="glyphicon glyphicon-triangle-bottom" id="spandown"></i></font>
                           <input type="text" name="tipo" id="tipo" value="<?php echo $tipo; ?>" <?php echo $disabled; ?> class="editou form-control pulaCampoEnter">
                        </div>
                        <input type="text" name="tipoHandle" value="<?php echo $tipoHandle; ?>" id="tipoHandle" hidden="true">
                     </div>
                     <div class="col-md-2 col-xs-4 pullBottom"> <span>Número</span>
                        <input type="text" name="numero" id="numero" disabled value="<?php echo $numeroPedidoDeVenda; ?>" class="form-control">
                     </div>
                     <div class="col-md-2 col-xs-8 pullBottom"> <span>Data</span>
                        <input type='datetime-local' value="<?php echo $dataPedidoDeVenda.'T'.$horaPedidoDeVenda; ?>" <?php echo $disabled; ?> id="data" name="data" class="form-control pulaCampoEnter" />
                     </div>
                     <div class="col-md-2 col-xs-8 pullBottom"> <span>Entregar até</span>
                        <input type='date' value="<?php echo $date; ?>" id="entregarAte" <?php echo $disabled; ?> name="entregarAte" class="form-control pulaCampoEnter" />
                     </div>
                     <div class="col-md-4 col-xs-8 pullBottom">
                        <span>Cliente</span>
                        <div class="inner-addon right-addon"> <font size="-2"><i class="glyphicon glyphicon-triangle-bottom" id="spandown"></i></font>
                           <input type="text" name="cliente" value="<?php echo $cliente; ?>" <?php echo $disabled; ?> id="cliente"  class="editou form-control pulaCampoEnter">
                        </div>
                        <input type="text" name="clienteHandle" value="<?php echo $clienteHandle; ?>" id="clienteHandle" hidden="true">
                     </div>
                     <div class="col-md-4 col-xs-4 pullBottom">
                        <span>Vendedor</span>
                        <div class="inner-addon right-addon"> <font size="-2"><i class="glyphicon glyphicon-triangle-bottom" id="spandown"></i></font>
                           <input type="text" name="vendedor" value="<?php echo $loginUsuario; ?>" disabled id="vendedor"  class="editou form-control">
                        </div>
                        <input type="text" name="vendedorHandle" value="<?php echo $handleUsuario; ?>" id="vendedorHandle" hidden="true">
                     </div>
                     <div class="col-md-4 col-xs-6 pullBottom">
                        <span>Condição de pagamento</span>
                        <div class="inner-addon right-addon"> <font size="-2"><i class="glyphicon glyphicon-triangle-bottom" id="spandown"></i></font>
                           <input type="text" name="CondicaoPagamento" value="<?php echo $condicaoPagamento; ?>"  <?php echo $disabled; ?>  id="CondicaoPagamento" class="form-control pulaCampoEnter">
                        </div>
                        <input type="text" name="CondicaoPagamentoHandle" value="<?php echo $CondicaoPagamentoHandle; ?>" id="CondicaoPagamentoHandle" hidden="true">
                     </div>
                     <div class="col-md-4 col-xs-6 pullBottom">
                        <span>Forma de pagamento</span>
                        <div class="inner-addon right-addon"> <font size="-2"><i class="glyphicon glyphicon-triangle-bottom" id="spandown"></i></font>
                           <input type="text" name="FormaPagamento"  id="FormaPagamento" value="<?php echo $formaPagamento; ?>"   <?php echo $disabled; ?> class="form-control pulaCampoEnter" >
                        </div>
                        <input type="text" name="FormaPagamentoHandle" value="<?php echo $formaPagamentoHandle; ?>" id="FormaPagamentoHandle" hidden="true">
                     </div>
                     <div class="col-md-4 col-xs-12 pullBottom">
                        <span>Conta de tesouraria</span>
                        <div class="inner-addon right-addon"> <font size="-2"><i class="glyphicon glyphicon-triangle-bottom" id="spandown"></i></font>
                           <input type="text" name="ContaTesouraria"  id="ContaTesouraria" value="<?php echo $contaTesouraria; ?>"  <?php echo $disabled; ?>  class="form-control pulaCampoEnter" >
                        </div>
                        <input type="text" name="ContaTesourariaHandle" value="<?php echo $contaTesourariaHandle; ?>" id="ContaTesourariaHandle" hidden="true">
                     </div>
                     <div class="col-md-2 col-xs-4 pullBottom">
                        <span>Natureza de operação</span>
                        <div class="inner-addon right-addon"> <font size="-2"><i class="glyphicon glyphicon-triangle-bottom" id="spandown"></i></font>
                           <input type="text" name="naturezaOperacao" value="<?php echo $naturezaOperacao; ?>" id="naturezaOperacao" <?php echo $disabled; ?>  class="editou form-control pulaCampoEnter">
                        </div>
                        <input type="text" name="naturezaOperacaoHandle" value="<?php echo $naturezaOperacaoHandle; ?>" id="naturezaOperacaoHandle" hidden="true">
                     </div>
                     <div class="col-md-2 col-xs-4 pullBottom">
                        <span>Frete</span>
                        <div class="inner-addon right-addon"> <font size="-2"><i class="glyphicon glyphicon-triangle-bottom" id="spandown"></i></font>
                           <input type="text" name="frete" value="<?php echo $frete; ?>" id="frete"  <?php echo $disabled; ?> class="editou form-control pulaCampoEnter">
                        </div>
                        <input type="text" name="freteHandle" value="<?php echo $freteHandle; ?>" id="freteHandle" hidden="true">
                     </div>
                     <div class="col-md-4 col-xs-8 pullBottom">
                        <span>Transportador</span>
                        <div class="inner-addon right-addon"> <font size="-2"><i class="glyphicon glyphicon-triangle-bottom" id="spandown"></i></font>
                           <input type="text" name="transportador" value="<?php echo $transportador; ?>" <?php echo $disabled; ?> <?php echo $disabledTransportador; ?> id="transportador"  class="editou form-control pulaCampoEnter">
                        </div>
                        <input type="text" name="transportadorHandle" value="<?php echo $transportadorHandle; ?>" id="transportadorHandle" hidden="true">
                     </div>
                     <div class="col-md-2 col-xs-6 pullBottom">
                        <span>Tabela</span>
                        <div class="inner-addon right-addon"> <font size="-2"><i class="glyphicon glyphicon-triangle-bottom" id="spandown"></i></font>
                           <input type="text" name="tabela" value="<?php echo $tabela; ?>" id="tabela" <?php echo $disabled; ?>  class="editou form-control pulaCampoEnter">
                        </div>
                        <input type="text" name="tabelaHandle" value="<?php echo $tabelaHandle; ?>" id="tabelaHandle" hidden="true">
                     </div>
                     <div class="col-md-2 col-xs-6 pullBottom">
                        <span>Lista</span>
                        <div class="inner-addon right-addon"> <font size="-2"><i class="glyphicon glyphicon-triangle-bottom" id="spandown"></i></font>
                           <input type="text" name="lista" value="<?php echo $lista; ?>" id="lista" disabled class="editou form-control">
                        </div>
                        <input type="text" name="listaHandle" value="<?php echo $listaHandle; ?>" id="listaHandle" hidden="true">
                     </div>
                     <div class="col-xs-12"> <span>Observação</span>
                        <textarea id="obs" class="form-control pulaCampoEnter textarea" <?php echo $disabled; ?> name="observacao"><?php echo $observacao; ?></textarea>
                     </div>
                     <div class="clearfix"></div>
                  </div>
                  <!-- end row -->
               </div>
               <div class="row">
                  <ul class="nav nav-tabs" id="myTabs" role="tablist">
                     <li role="presentation" class="active"><a href="#itens" id="itens-tab" role="tab" data-toggle="tab" aria-controls="Pedido" aria-expanded="true">Item</a></li>
                     <li role="presentation"><a href="#observacaoUsoInterno" id="observacaoUsoInterno-tab" role="tab" data-toggle="tab" aria-controls="Pedido" aria-expanded="true">Observação (uso interno)</a></li>
                     <li role="presentation"><a href="#anexo" id="anexo-tab" role="tab" data-toggle="tab" aria-controls="Pedido" aria-expanded="true">Anexo</a></li>
                     <li role="presentation"><a href="#auditoria" id="auditoria-tab" role="tab" data-toggle="tab" aria-controls="Pedido" aria-expanded="true">Auditoria</a></li>
                  </ul>
                  <div class="tab-content">
                     <div role="tabpanel" class="tab-pane active" id="itens" aria-labelledby="item-tab">
                        <div class="col-xs-12 pullBottom">
                           <div class="right">
                              <a class="<?php echo $disabled; ?>" href="InserirItemPedidoDeVenda.php?handle=<?php echo $handlePedidoDeVenda; ?>&numero=<?php echo $numeroPedidoDeVenda; ?>&referencia=VisualizarPedidoDeVenda">
                              <button type="button" class="botaoBranco1" <?php echo $disabled; ?> id="inserirItem"><font size="3px"><i class="glyphicon glyphicon-plus"> </i> </font></button>
                              </a>
                              <button type="button" disabled class="botaoBranco1" id="visualizarItemPedido"><font size="5px"><i class="fa fa-caret-up"> </i> </font></button>
                              <button type="button" disabled class="botaoBranco1" id="excluirItemPedido"><font size="4px"><i class="fa fa-minus"> </i> </font></button>
                           </div>
                           <div class="dividerH"></div>
                           <p>
                           <div class="table-responsive" style="max-height:200px;">
                              <table class="table table-hover table-responsive tableTabPage" id="reqtablenew">
                                 <thead>
                                    <tr>
                                       <th width="1%" class="tableth">&nbsp;</th>
                                       <th width="15%" class="tableth">Codigo</th>
                                       <th class="tableth">Descrição</th>
                                       <th width="15%" class="tableth">Quantidade</th>
                                       <th width="15%" class="tableth">Unitário</th>
                                       <th width="20%" class="tableth">Valor total</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php
                                       include_once('../../model/comercial/itemPedidoDeVendaTabelaModel.php');
                                       ?>
                                 </tbody>
                              </table>
                           </div>
                           <p></p>
                           <div class="clearfix"></div>
                        </div>
                     </div>
                     <div role="tabpanel" class="tab-pane" id="observacaoUsoInterno" aria-labelledby="obs-tab">
                        <div class="col-xs-12 pullBottom">
                           <div class="formContent">
                              <textarea class="form-control pulaCampoEnter" rows="10" <?php echo $disabled; ?> name="observacaoUsoInterno"><?php echo $observacaoUsoInterno; ?></textarea>
                           </div>
                           <p></p>
                           <div class="clearfix"></div>
                        </div>
                     </div>
            </form>
            <div role="tabpanel" class="tab-pane" id="anexo" aria-labelledby="anexo-tab">
              <div class="col-xs-12 pullBottom">
                  <div class="left">
                    <!-- botoes anexo aqui -->
                  </div>
                  <div class="right">
                    <form method="post" id="AnexarPedidoDeVendaForm" name="AnexarPedidoDeVendaForm" action="../../controller/comercial/AnexarPedidoDeVendaController.php?handle=<?php echo $handlePedidoDeVenda; ?>&referencia=VisualizarPedidoDeVenda" enctype="multipart/form-data">
                        <label for="image_src" class="botaoBranco1"><font size="3px"><i class="glyphicon glyphicon-plus"> </i> </font></label>
                        <input accept="image/*" onchange="preview_image()" type="file" name="image_src[]" id="image_src"  multiple>
                        <button type="button" disabled class="botaoBranco1 botaoAnexo" id="visualizarAnexo"><font size="5px"><i class="fa fa-caret-up"> </i> </font></button>
                        <button type="button" <?php echo $disabled; ?> id="removerAnexo" disabled class="botaoBranco1 botaoAnexo"><font size="4px"><i class="fa fa-minus"> </i> </font></button>
                    </form>
                  </div>
                  <div class="dividerH"></div>
                  <p>
                  <div class="table-responsive" style="max-height:200px;">
                    <table class="table table-hover table-responsive" id="reqtableAnexo">
                        <thead>
                          <tr>
                              <th class="tableth">Nome do anexo</th>
                              <th width="12%" class="tableth">Data</th>
                          </tr>
                        </thead>
                        <?php  include('../../model/comercial/AnexosPedidoDeVenda.php'); ?>
                        <tbody id="image_preview">
                        </tbody>
                    </table>
                  </div>
                  <p></p>
                  <div class="clearfix"></div>
              </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="auditoria" aria-labelledby="auditoria-tab">
              <div class="col-xs-12 pullBottom">
                  <div class="left">
                    <!-- botoes anexo aqui -->
                  </div>
                  <div class="right">
                    <label for="image_src" class="botaoBranco1" disabled><font size="3px"  color="#A7A7A7"><i class="glyphicon glyphicon-plus"> </i> </font></label>
                    <input accept="image/*" onchange="preview_image()" disabled type="file" name="image_src[]" id="image_src"  multiple/>
                    <button type="button" disabled class="botaoBranco1" id="visualizarAuditoria"><font size="5px"><i class="fa fa-caret-up"> </i> </font></button>
                    <button type="button" disabled class="botaoBranco1"><font size="4px" color="#A7A7A7"><i class="fa fa-minus"> </i> </font></button>
                  </div>
                  <div class="dividerH"></div>
                  <p>
                  <div class="table-responsive">
                    <table class="table table-hover table-responsive" id="reqtableAuditoria">
                        <thead>
                          <tr>
                              <th width="12%" class="tableth">Data</th>
                              <th class="tableth">Usuário</th>
                              <th class="tableth">Tipo de mensagem</th>
                              <th class="tableth">Complemento</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                              include('../../model/comercial/AuditoriaPedidoDeVenda.php');
                              ?>
                        </tbody>
                    </table>
                  </div>
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
                  include_once('../../model/comercial/botoesFooterVisualizarPedidoDeVenda.php');
                  ?>	
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