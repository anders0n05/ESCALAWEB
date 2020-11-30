<?php
include_once('../../controller/tecnologia/Sistema.php');

date_default_timezone_set('America/Sao_Paulo');

if (!isset($_SESSION['usuario']) and !isset($_SESSION['senha'])) {
    header('Location: ../../view/estrutura/login.php?success=F');
}
else {
    $connect = Sistema::getConexao();
    $ordem = Sistema::getGet('ordem');

    $sqlHandle = "SELECT A.HANDLE FROM VE_ORDEM A WHERE A.CHAVE = '$ordem'";
    $queryHandle = $connect->prepare($sqlHandle);
    $queryHandle->execute();
    $handle = $queryHandle->fetch(PDO::FETCH_ASSOC);

    include_once('../../model/ordemvenda/PegaUnidadeMedida.php');
    include_once('../../model/ordemvenda/PegaMarca.php');
    include_once('../../model/ordemvenda/PegaAjustes.php');
    include_once('../../model/ordemvenda/PegaFiliais.php');
    include_once('../../model/ordemvenda/PegaTipo.php');
    include_once('../../model/ordemvenda/PegaClientes.php');
    include_once('../../model/ordemvenda/PegaPrioridades.php');
    include_once('../../model/ordemvenda/PegaFormaPagamento.php');
    include_once('../../model/ordemvenda/PegaCondicaoPagamento.php');
    include_once('../../model/ordemvenda/PegaContaTesouraria.php');
    include_once('../../model/ordemvenda/PegaTabelaPreco.php');
    include_once('../../model/ordemvenda/PegaTipoFrete.php');
    include_once('../../model/ordemvenda/PegaTipoTransporte.php');
    include_once('../../model/ordemvenda/PegaTransportadora.php');
    ?>
    <!DOCTYPE HTML>
    <html>
        <head>
            <title>Escalasoft</title>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <link rel="icon" type="image/png" href="../tecnologia/img/favicon.png" />
            <!-- Bootstrap Core CSS -->
            <!-- <link href="../tecnologia/css/bootstrap.css" rel='stylesheet' type='text/css' /> -->
            <link href="../tecnologia/css/bootstrap3/bootstrap.min.css" rel='stylesheet' type='text/css' />
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
            <!-- <script src="../tecnologia/js/jquery-1.11.1.min.js"></script> -->
            <!-- jQuery -->
            <script type="text/javascript" src="../tecnologia/js/jquery/jquery.min.js"></script>
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
            <script type="text/javascript" src="../tecnologia/js/scriptEtapaPedido.js"></script>
            <script type="text/javascript" src="../tecnologia/js/bootbox.js"></script>
            <link type="text/css" href="../tecnologia/css/jquery-ui.css" rel="stylesheet"/>
            <link type="text/css" href="../tecnologia/css/styleCustom.css" rel="stylesheet"/>
            <link type="text/css" href="../../view/tecnologia/css/jquery.multiselect.css" rel="stylesheet"/>
            <script type="text/javascript" src="../../view/tecnologia/js/jquery.multiselect.js"></script>
            <script type="text/javascript" src="../../view/tecnologia/js/blockUI.js"></script>
            <!--// End Custom -->
            <!-- shortTable -->
            <link href="../../view/tecnologia/css/theme.bootstrap_3.min.css" rel="stylesheet">
            <script src="../../view/tecnologia/js/jquery.tablesorter.js"></script>
            <script src="../../view/tecnologia/js/jquery.tablesorter.widgets.js"></script>

            
            <link href="../../view/tecnologia/css/TabelasPadrao.css" rel="stylesheet">
            <script type="text/javascript" src="../tecnologia/js/ordemvenda/OrdemVendaListarFuncoes.js"></script>
            <!--// End shortTable -->
            <style>
                th{
                    font-weight: normal !important;
                }

                .selected{
                    background-color: #2b9bcb !important;
                }

                input[disabled], select[disabled]{
                    cursor: default !important;
                }

                thead{
                    background: #e9e9e9;
                }

                .dataTables_wrapper {
                    margin-top: -30px;
                    margin-bottom: -10px;
                }

                .panel-body{
                    padding: 0 !important;
                }
                
                .container{
                    margin-top: 0px;
                }

                .form-control{
                    padding: 6px 6px !important;
                }

                .ativo{
                    color:green;
                }

                .header{
                    margin-top: -10px;
                }

                .col-sm-12{
                    margin: 0px !important;
                    padding: 0px !important;
                }

                hr{
                    margin: 15px 0 15px 0 !important;
                }

                .right{
                    text-align:right !important;
                    width: 100% !important;
                    padding-right: 15px;
                    padding-left: 15px;
                }

                @media screen and (max-width: 767px) {
                    .right{
                        padding-top: 10px;
                        padding: 5px !important;
                        float: inherit !important;
                    }
                    
                    .col-lg-1,
                    .col-lg-10,
                    .col-lg-11,
                    .col-lg-12,
                    .col-lg-2,
                    .col-lg-3,
                    .col-lg-4,
                    .col-lg-5,
                    .col-lg-6,
                    .col-lg-7,
                    .col-lg-8,
                    .col-lg-9,
                    .col-md-1,
                    .col-md-10,
                    .col-md-11,
                    .col-md-12,
                    .col-md-2,
                    .col-md-3,
                    .col-md-4,
                    .col-md-5,
                    .col-md-6,
                    .col-md-7,
                    .col-md-8,
                    .col-md-9,
                    .col-sm-1,
                    .col-sm-10,
                    .col-sm-11,
                    .col-sm-12,
                    .col-sm-2,
                    .col-sm-3,
                    .col-sm-4,
                    .col-sm-5,
                    .col-sm-6,
                    .col-sm-7,
                    .col-sm-8,
                    .col-sm-9,
                    .col-xs-1,
                    .col-xs-10,
                    .col-xs-11,
                    .col-xs-12,
                    .col-xs-2,
                    .col-xs-3,
                    .col-xs-4,
                    .col-xs-5,
                    .col-xs-6,
                    .col-xs-7,
                    .col-xs-8,
                    .col-xs-9 {
                        padding-right: 5px;
                        padding-left: 5px;
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
                            <?php include('../../view/estrutura/menu.php') ?>
                        </nav>
                    </div>
                </div>
                
                <!--left-fixed -navigation-->
                <!-- header-starts -->
                <div class="sticky-header header-section ">
                    <!--toggle button start-->
                    <button id="showLeftPush"><i class="fa fa-bars"></i></button>
                    <!--toggle button end-->
                    <div class="topBar">Visualizar ordem de venda nº <?= $handle["HANDLE"] ?></div>
                </div>
                <div class="clearfix"> </div>	
            </div>
            <!-- //header-ends -->
            <!-- main content start-->   
            <div class="pageContent">
                <div class="container">
                    <div class="row">
                        <form id="FormOrdem">
                            <input type="hidden" class="form-control" id="ORDEM" name="ORDEM" value="<?= $handle["HANDLE"] ?>">
                            <input type="hidden" class="form-control" id="CHAVE" value="<?= $ordem ?>">
                            <input type="hidden" class="form-control" id="STATUS" disabled="disabled">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <span>Filial</span>
                                    <select class="form-control" id="FILIAL" name="FILIAL" required="required" disabled="disabled">
                                        <option selected disabled value="">Selecione...</option>
                                        <?php foreach($filiais as $filial){ ?>
                                            <option value="<?=$filial["HANDLE"]?>"><?=$filial["NOME"]?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <span>Tipo</span>
                                    <select class="form-control" id="TIPO" name="TIPO" required="required" disabled="disabled">
                                        <option selected disabled value="">Selecione...</option>
                                        <?php foreach($tipos as $tipo){ ?>
                                            <option value="<?=$tipo["HANDLE"]?>"
                                            data-tabelapadrao="<?=$tipo["TABELAPADRAO"]?>"
                                            data-permitirsemtabela="<?=$tipo["PERMITESEMTABELA"]?>"
                                            data-condicaopagamento="<?=$tipo["CONDICAOPAGAMENTO"]?>"
                                            data-formapagamento="<?=$tipo["FORMAPAGAMENTO"]?>"
                                            data-contatesouraria="<?=$tipo["CONTATESOURARIA"]?>"><?=$tipo["NOME"]?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <span>Data</span>
                                    <input type="text" class="form-control datahora" id="DATA" disabled="disabled">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <span>Prioridade</span>
                                    <select class="form-control" id="PRIORIDADE" name="PRIORIDADE" required="required" disabled="disabled">
                                        <option selected disabled value="">Selecione...</option>
                                        <?php foreach($prioridades as $prioridade){ ?>
                                            <option value="<?=$prioridade["HANDLE"]?>"><?=$prioridade["NOME"]?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <span>Cliente</span>
                                    <select class="form-control" id="CLIENTE" name="CLIENTE" required="required" disabled="disabled">
                                        <option selected disabled value="">Selecione...</option>
                                        <?php foreach($clientes as $cliente){ ?>
                                            <option value="<?=$cliente["HANDLE"]?>"><?=$cliente["NOME"]?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <span>Tabela de Preço</span>
                                    <select class="form-control" id="TABELAPRECO" name="TABELAPRECO" required="required" disabled="disabled">
                                        <option selected disabled value="">Selecione...</option>
                                        <?php foreach($tabelas as $tabela){ ?>
                                            <option value="<?=$tabela["HANDLE"]?>"><?=$tabela["HANDLE"]?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <span>Forma de Pagamento</span>
                                    <select class="form-control" id="FORMAPAGAMENTO" name="FORMAPAGAMENTO" disabled="disabled">
                                        <option selected value="">Selecione...</option>
                                        <?php foreach($formasPagamento as $formaPagamento){ ?>
                                            <option value="<?=$formaPagamento["HANDLE"]?>"><?=$formaPagamento["NOME"]?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <span>Condição de Pagamento</span>
                                    <select class="form-control" id="CONDICAOPAGAMENTO" name="CONDICAOPAGAMENTO" disabled="disabled">
                                        <option selected value="">Selecione...</option>
                                        <?php foreach($condicoesPagamento as $condicaoPagamento){ ?>
                                            <option value="<?=$condicaoPagamento["HANDLE"]?>"><?=$condicaoPagamento["NOME"]?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <span>Status</span>
                                    <input type="text" class="form-control" id="STATUSNOME" disabled="disabled">
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <span>Subtotal</span>
                                    <input type="text" class="form-control dinheiro" id="SUBTOTAL" disabled="disabled">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <span>Ajuste</span>
                                    <input type="text" class="form-control dinheiro" id="VALORAJUSTE" disabled="disabled">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <span>Valor total</span>
                                    <input type="text" class="form-control dinheiro" id="VALORTOTAL" disabled="disabled">
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="headingOne">
                                            <h4 class="panel-title">
                                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTransporte" aria-expanded="true" aria-controls="collapseOne">Transporte</a>
                                            </h4>
                                        </div>
                                        <div id="collapseTransporte" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <span>Tipo de frete</span>
                                                            <select class="form-control" id="TIPOFRETE" name="TIPOFRETE" disabled="disabled" required="required">
                                                                <option selected value="">Selecione...</option>
                                                                <?php foreach($tiposFrete as $tipoFrete){ ?>
                                                                    <option value="<?=$tipoFrete["HANDLE"]?>"><?=$tipoFrete["NOME"]?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <span>Tipo de transporte</span>
                                                            <select class="form-control" id="TIPOTRANSPORTE" name="TIPOTRANSPORTE" disabled="disabled">
                                                                <option selected value="">Selecione...</option>
                                                                <?php foreach($tiposTransporte as $tipoTransporte){ ?>
                                                                    <option value="<?=$tipoTransporte["HANDLE"]?>"><?=$tipoTransporte["NOME"]?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <span>Transportadora</span>
                                                            <select class="form-control" id="TRANSPORTADORA" name="TRANSPORTADORA" disabled="disabled">
                                                                <option selected value="">Selecione...</option>
                                                                <?php foreach($transportadoras as $transportadora){ ?>
                                                                    <option value="<?=$transportadora["HANDLE"]?>"><?=$transportadora["NOME"]?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <span>Espécie de volume</span>
                                                            <input type="text" class="form-control text-right" id="ESPECIEVOLUME" disabled="disabled">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <span>Volume</span>
                                                            <input type="text" class="form-control text-right" id="VOLUME" disabled="disabled">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <span>Quantidade</span>
                                                            <input type="text" class="form-control text-right" id="QUANTIDADEORDEM" disabled="disabled">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <span>Peso</span>
                                                            <input type="text" class="form-control text-right" id="PESO" disabled="disabled">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <span>Entregar até</span>
                                                            <input type="text" class="form-control text-right" id="ENTREGARATE" disabled="disabled">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="headingOne">
                                            <h4 class="panel-title">
                                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseObservacao" aria-expanded="true" aria-controls="collapseOne">Observação</a>
                                            </h4>
                                        </div>
                                        <div id="collapseObservacao" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <span>Observação</span>
                                                            <textarea class="form-control" rows="3" id="OBSERVACAO" name="OBSERVACAO" disabled="disabled"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-12 right">
                                <button type="button" class="btn btn-primary EditarOrdem hidden" disabled="disabled">Editar</button>
                                <button type="button" class="btn btn-primary LimparOrdem hidden" disabled="disabled">Limpar</button>
                                <button type="button" class="btn btn-success GravarOrdem hidden" disabled="disabled">Gravar</button>
                                <button type="button" class="btn btn-success LiberarOrdem hidden" disabled="disabled">Liberar</button>
                                <button type="button" class="btn btn-success VoltarOrdem hidden" disabled="disabled">Voltar</button>
                                <button type="button" class="btn btn-danger CancelarOrdem hidden" disabled="disabled">Cancelar</button>
                            </div>
                            <div class="col-md-12">
                                <hr/>
                            </div>
                            <div class="itemArea">
                                <div class="col-md-12">
                                    <h4 class="header">Itens</h4>
                                    <table id="ItensTable" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Seq</th>
                                                <th>Item</th>
                                                <th>Unidade</th>
                                                <th>Quantidade</th>
                                                <th>Valor Unitário</th>
                                                <th>Total</th>
                                                <th>Ajuste</th>
                                                <th>Valor Total</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <div class="col-md-12 right botoesItem">
                                    <button type="button" class="btn btn-primary EditarItem hidden" disabled="disabled">Editar</button>
                                    <button type="button" class="btn btn-danger ExcluirItem hidden" disabled="disabled">Excluir</button>
                                    <button type="button" class="btn btn-danger CancelarItem hidden" disabled="disabled">Cancelar</button>
                                    <button type="button" class="btn btn-success LiberarItem hidden" disabled="disabled">Liberar</button>
                                    <button type="button" class="btn btn-success VoltarItem hidden" disabled="disabled">Voltar</button>
                                    <button type="button" class="btn btn-primary VerItem hidden" disabled="disabled">Ver</button>
                                    <button type="button" class="btn btn-success" id="AdicionarItem">Adicionar</button>
                                </div>
                                <div class="col-md-12">
                                    <hr/>
                                </div>
                            </div>
                            <div class="ajusteArea">
                                <div class="col-md-12">
                                    <h4 class="header">Ajustes</h4>
                                    <table id="AjusteTable" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Ajuste</th>
                                                <th>Tipo</th>
                                                <th>Valor</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <div class="col-md-12 right botoesAjuste">
                                    <button type="button" class="btn btn-primary EditarAjuste hidden" disabled="disabled">Editar</button>
                                    <button type="button" class="btn btn-danger ExcluirAjuste hidden" disabled="disabled">Excluir</button>
                                    <button type="button" class="btn btn-danger CancelarAjuste hidden" disabled="disabled">Cancelar</button>
                                    <button type="button" class="btn btn-success LiberarAjuste hidden" disabled="disabled">Liberar</button>
                                    <button type="button" class="btn btn-success VoltarAjuste hidden" disabled="disabled">Voltar</button>
                                    <button type="button" class="btn btn-primary VerAjuste hidden" disabled="disabled">Ver</button>
                                    <button type="button" class="btn btn-success" id="AdicionarAjuste">Adicionar</button>
                                </div>
                                <div class="col-md-12">
                                    <hr/>
                                </div>
                            </div>
                            <div class="col-md-12 right">
                                <button type="button" class="btn btn-default btnFechar">Fechar</button>
                            </div>
                        </form>
                    </div>
                </div>         
            </div> 
                    
            <div class="clearfix"></div>

            <div class="modal fade bs-example-modal-lg" id="ModalAdicionarItem" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <form id="FormItem">
                            <input type="hidden" class="form-control" id="ORDEM" name="ORDEM" value="<?= $handle["HANDLE"] ?>">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Adicionar item</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <span>Item<span class="vermelho">*</span></span>
                                            <select class="form-control" id="ITEM" name="ITEM" required="required">
                                                <option selected value="" disabled="disabled">Selecione...</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <span>Unidade</span>
                                            <select class="form-control" id="UNIDADEMEDIDA" name="UNIDADEMEDIDA" disabled="disabled">
                                                <option selected value="" disabled="disabled">Selecione...</option>
                                                <?php foreach($unidadesMedida as $unidademedida){ ?>
                                                    <option value="<?=$unidademedida["HANDLE"]?>"><?=$unidademedida["SIGLA"]?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <span>Variação<span class="vermelho">*</span></span>
                                            <select class="form-control" id="VARIACAO" name="VARIACAO" required="required">
                                                <option selected value="" disabled="disabled">Selecione...</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <span>Marca</span>
                                            <select class="form-control" id="MARCA" name="MARCA" disabled="disabled">
                                                <option selected value="">Selecione...</option>
                                                <?php foreach($marcas as $marca){ ?>
                                                    <option value="<?=$marca["HANDLE"]?>"><?=$marca["NOME"]?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <span>Quantidade<span class="vermelho">*</span></span>
                                            <input type="number" class="form-control" id="QUANTIDADE" name="QUANTIDADE" required="required">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <span>Valor Unitário</span>
                                            <input type="text" class="form-control text-right dinheiro" id="VALORUNITARIO" name="VALORUNITARIO" disabled="disabled">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <span>Subtotal</span>
                                            <input type="text" class="form-control text-right dinheiro" id="VALORTOTAL" name="VALORTOTAL" disabled="disabled">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <span>Valor Total</span>
                                            <input type="text" class="form-control text-right dinheiro" id="VALORGERAL" name="VALORGERAL" disabled="disabled">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <span>Descrição detalhada</span>
                                            <textarea class="form-control" rows="3" name="OBSERVACAO" id="OBSERVACAO"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Gravar</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade bs-example-modal-lg" id="ModalVerItem" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <form id="FormItemVer">
                            <input type="hidden" class="form-control" id="POS" name="ITEM" disabled="disabled">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Ver item</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <span>Item<span class="vermelho">*</span></span>
                                            <select class="form-control" id="ITEMVER" name="ITEM" required="required">
                                                <option selected value="" disabled="disabled">Selecione...</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <span>Unidade</span>
                                            <select class="form-control" id="UNIDADEMEDIDAVER" name="UNIDADEMEDIDA" disabled="disabled">
                                                <option selected value="" disabled="disabled">Selecione...</option>
                                                <?php foreach($unidadesMedida as $unidademedida){ ?>
                                                    <option value="<?=$unidademedida["HANDLE"]?>"><?=$unidademedida["SIGLA"]?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <span>Variação<span class="vermelho">*</span></span>
                                            <select class="form-control" id="VARIACAOVER" name="VARIACAO" required="required">
                                                <option selected value="" disabled="disabled">Selecione...</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <span>Marca</span>
                                            <select class="form-control" id="MARCAVER" name="MARCA" disabled="disabled">
                                                <option selected value="">Selecione...</option>
                                                <?php foreach($marcas as $marca){ ?>
                                                    <option value="<?=$marca["HANDLE"]?>"><?=$marca["NOME"]?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <span>Quantidade<span class="vermelho">*</span></span>
                                            <input type="text" class="form-control" id="QUANTIDADEVER" name="QUANTIDADE" required="required">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <span>Valor Unitário</span>
                                            <input type="text" class="form-control text-right dinheiro" id="VALORUNITARIOVER" name="VALORUNITARIO" disabled="disabled">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <span>Subtotal</span>
                                            <input type="text" class="form-control text-right dinheiro" id="VALORTOTALVER" name="VALORTOTAL" disabled="disabled">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <span>Ajuste</span>
                                            <input type="text" class="form-control text-right dinheiro" id="AJUSTEVER" disabled="disabled">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <span>Valor Total</span>
                                            <input type="text" class="form-control text-right dinheiro" id="TOTALGERALVER" name="TOTALGERAL" disabled="disabled">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <span>Descrição detalhada</span>
                                            <textarea class="form-control" rows="3" name="OBSERVACAO" id="OBSERVACAOVER"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <hr/>
                                        <h4 class="header">Ajustes</h4>
                                        <table id="AjusteItemTableVer" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Ajuste</th>
                                                    <th>Tipo</th>
                                                    <th>Valor</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                    <div class="col-md-12 right">
                                        <button type="button" class="btn btn-success" id="AdicionarAjusteItemEditando">Adicionar ajuste</button>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success IncluirItem" data-dismiss="modal">Incluir</button>
                                <button type="button" class="btn btn-primary GravarItem" data-dismiss="modal">Gravar</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <div class="modal fade bs-example-modal-lg" id="ModalAdicionarAjuste" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <form id="FormAjuste">
                            <input type="hidden" class="form-control" id="ORDEM" name="ORDEM" value="<?= $handle["HANDLE"] ?>">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Adicionar ajuste</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <span>Ajuste Financeiro<span class="vermelho">*</span></span>
                                            <select class="form-control" id="AJUSTEFINANCEIRO" name="AJUSTEFINANCEIRO" required="required">
                                                <option selected value="" disabled="disabled">Selecione...</option>
                                                <?php foreach($ajustes as $ajuste){ ?>
                                                    <option value="<?=$ajuste["HANDLE"]?>" data-tipo="<?=$ajuste["TIPOHANDLE"]?>" data-tiponome="<?=$ajuste["TIPO"]?>"><?=$ajuste["NOME"]?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <span>Tipo<span class="vermelho">*</span></span>
                                            <input type="text" class="form-control" id="TIPONOME" disabled="disabled">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <span>Valor Ajuste<span class="vermelho">*</span></span>
                                            <input type="text" class="form-control text-right dinheiro" id="VALORAJUSTE" name="VALORAJUSTE" required="required">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Gravar</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade bs-example-modal-lg" id="ModalAdicionarAjusteItem" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <form id="FormAjusteItem">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Adicionar ajuste no item</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <span>Ajuste Financeiro<span class="vermelho">*</span></span>
                                            <select class="form-control" id="AJUSTEFINANCEIROITEM" name="AJUSTEFINANCEIRO" required="required">
                                                <option selected value="" disabled="disabled">Selecione...</option>
                                                <?php foreach($ajustes as $ajuste){ ?>
                                                    <option value="<?=$ajuste["HANDLE"]?>" data-tipo="<?=$ajuste["TIPOHANDLE"]?>" data-tiponome="<?=$ajuste["TIPO"]?>"><?=$ajuste["NOME"]?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <span>Tipo<span class="vermelho">*</span></span>
                                            <input type="text" class="form-control" id="TIPONOME" disabled="disabled">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <span>Valor Ajuste<span class="vermelho">*</span></span>
                                            <input type="text" class="form-control text-right dinheiro" id="VALORAJUSTEITEM" name="VALORAJUSTE" required="required">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Gravar</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade bs-example-modal-lg" id="ModalAdicionarAjusteItemEditando" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <form id="FormAjusteItemEditando">
                            <input type="hidden" class="form-control" id="ITEM" name="ITEM">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Adicionar ajuste no item</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <span>Ajuste Financeiro<span class="vermelho">*</span></span>
                                            <select class="form-control" id="AJUSTEFINANCEIROITEM" name="AJUSTEFINANCEIRO" required="required">
                                                <option selected value="" disabled="disabled">Selecione...</option>
                                                <?php foreach($ajustes as $ajuste){ ?>
                                                    <option value="<?=$ajuste["HANDLE"]?>" data-tipo="<?=$ajuste["TIPOHANDLE"]?>" data-tiponome="<?=$ajuste["TIPO"]?>"><?=$ajuste["NOME"]?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <span>Tipo<span class="vermelho">*</span></span>
                                            <input type="text" class="form-control" id="TIPONOME" disabled="disabled">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <span>Valor Ajuste<span class="vermelho">*</span></span>
                                            <input type="text" class="form-control text-right dinheiro" id="VALORAJUSTEITEM" name="VALORAJUSTE" required="required">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Gravar</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade bs-example-modal-lg" id="ModalAjusteItemVer" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <form id="FormAjusteItem">
                            <input type="hidden" class="form-control" id="HANDLE">
                            <input type="hidden" class="form-control" id="POS">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Ajuste do item</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <span>Ajuste Financeiro</span>
                                            <input type="text" class="form-control" id="AJUSTENOME" disabled="disabled">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <span>Tipo</span>
                                            <input type="text" class="form-control" id="TIPONOME" disabled="disabled">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <span>Valor Ajuste</span>
                                            <input type="text" class="form-control text-right dinheiro" id="VALORAJUSTEITEM" name="VALORAJUSTE" disabled="disabled">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-danger CancelarAjuste">Cancelar ajuste</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade bs-example-modal-lg" id="ModalAjusteVer" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <form id="FormAjusteItemVer">
                            <input type="hidden" class="form-control" id="HANDLE">
                            <input type="hidden" class="form-control" id="POS">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Ajuste da ordem</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <span>Ajuste Financeiro</span>
                                            <select class="form-control" id="AJUSTEFINANCEIROVER" name="AJUSTEFINANCEIRO" required="required">
                                                <option selected value="" disabled="disabled">Selecione...</option>
                                                <?php foreach($ajustes as $ajuste){ ?>
                                                    <option value="<?=$ajuste["HANDLE"]?>" data-tipo="<?=$ajuste["TIPOHANDLE"]?>" data-tiponome="<?=$ajuste["TIPO"]?>"><?=$ajuste["NOME"]?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <span>Tipo</span>
                                            <input type="text" class="form-control" id="TIPONOME" disabled="disabled">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <span>Valor Ajuste</span>
                                            <input type="text" class="form-control text-right dinheiro" id="VALORAJUSTEITEMVER" name="VALORAJUSTE" disabled="disabled">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success GravarAjuste">Gravar</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Classie -->
            <script src="../tecnologia/js/classie.js"></script>
            <!--scrolling js-->
            <script src="../tecnologia/js/jquery.nicescroll.js"></script>
            <script src="../tecnologia/js/script.js"></script>
            <!--//scrolling js-->
            <!-- Bootstrap Core JavaScript -->
            <!-- <script src="../tecnologia/js/bootstrap.js"></script> -->
            <script src="../tecnologia/js/bootstrap.js"></script>
            
            <!-- jQuery Mask -->
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
            <!-- DataTables -->
            <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.10.18/r-2.2.2/datatables.min.css"/>
            <script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.18/r-2.2.2/datatables.min.js"></script>
            <!-- SweetAlert -->
            <script type="text/javascript" src="../tecnologia/js/sweetalert/sweetalert.min.js"></script>

            <script src="//d2wy8f7a9ursnm.cloudfront.net/v6/bugsnag.min.js"></script>
            <script>window.bugsnagClient = bugsnag('9f6cc1049582acdb30bc5fff5e922e62')</script>
            <script type="text/javascript" src="../tecnologia/js/ordemvenda/OrdemVendaListarOrdem.js"></script>
            <script type="text/javascript" src="../tecnologia/js/ordemvenda/OrdemVendaListarItens.js"></script>
            <script type="text/javascript" src="../tecnologia/js/ordemvenda/OrdemVendaListarAjustes.js"></script>
        </body>
    </html>

    <?php
}