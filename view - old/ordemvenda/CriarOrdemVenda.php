<?php
include_once('../../controller/tecnologia/Sistema.php');

date_default_timezone_set('America/Sao_Paulo');

if (!isset($_SESSION['usuario']) and !isset($_SESSION['senha'])) {
    header('Location: ../../view/estrutura/login.php?success=F');
}
else {
    $connect = Sistema::getConexao();
    include_once('../../model/ordemvenda/PegaFiliais.php');
    include_once('../../model/ordemvenda/PegaTipo.php');
    include_once('../../model/ordemvenda/PegaClientes.php');
    include_once('../../model/ordemvenda/PegaPrioridades.php');
    include_once('../../model/ordemvenda/PegaFormaPagamento.php');
    include_once('../../model/ordemvenda/PegaCondicaoPagamento.php');
    include_once('../../model/ordemvenda/PegaContaTesouraria.php');
    include_once('../../model/ordemvenda/PegaUnidadeMedida.php');
    include_once('../../model/ordemvenda/PegaTabelaPreco.php');
    include_once('../../model/ordemvenda/PegaAjustes.php');
    include_once('../../model/ordemvenda/PegaMarca.php');
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
            <!--// End shortTable -->
            <style>
                body{
                    /* overflow: hidden;	 */
                }
                @media screen and (max-width: 768px) {
                    body{
                        /* overflow: auto;	 */
                    }
                }
                .container{
                    margin-top: 0px;
                }
                .vermelho{
                    color: red;
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
                    <div class="topBar">Ordem de venda</div>
                    <div class="topBarRight">
                    </div>
                </div>
                <div class="clearfix"> </div>	
            </div>
            <!-- //header-ends -->

            <!-- main content start-->   
            <div class="pageContent">
                <div class="container">
                    <form method="POST" id="FormOrdem">
                        <input type="text" class="form-control hidden" id="TABELAPADRAO" name="TABELAPADRAO">
                        <input type="text" class="form-control hidden" id="VENDEDOR" name="VENDEDOR" value="<?= $_SESSION['handleUsuario'] ?>">
                        <input type="text" class="form-control hidden" id="CHAVE" name="CHAVE" value="<?= Sistema::criarGuid(); ?>">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <span>Filial<span class="vermelho">*</span></span>
                                    <select class="form-control" id="FILIAL" name="FILIAL" required="required">
                                        <option selected disabled value="">Selecione...</option>
                                        <?php foreach($filiais as $filial){ ?>
                                            <option value="<?=$filial["HANDLE"]?>"><?=$filial["NOME"]?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <span>Tipo<span class="vermelho">*</span></span>
                                    <select class="form-control" id="TIPO" name="TIPO" required="required">
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
                                    <input type="text" class="form-control datahora" id="DATA" name="DATA" value="<?= date('d/m/Y h:i') ?>" readonly="readonly">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <span>Prioridade<span class="vermelho">*</span></span>
                                    <select class="form-control" id="PRIORIDADE" name="PRIORIDADE" required="required">
                                        <option selected disabled value="">Selecione...</option>
                                        <?php foreach($prioridades as $prioridade){ ?>
                                            <option value="<?=$prioridade["HANDLE"]?>"><?=$prioridade["NOME"]?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <span>Cliente<span class="vermelho">*</span></span>
                                    <select class="form-control" id="CLIENTE" name="CLIENTE" required="required">
                                        <option selected disabled value="">Selecione...</option>
                                        <?php foreach($clientes as $cliente){ ?>
                                            <option value="<?=$cliente["HANDLE"]?>"><?=$cliente["NOME"]?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <span>Tabela de Preço<span class="vermelho">*</span></span>
                                    <select class="form-control" id="TABELAPRECO" name="TABELAPRECO" required="required">
                                        <option selected disabled value="">Selecione...</option>
                                        <?php foreach($tabelas as $tabela){ ?>
                                            <option value="<?=$tabela["HANDLE"]?>"><?=$tabela["HANDLE"]?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <span>Forma de Pagamento<span class="vermelho">*</span></span>
                                    <select class="form-control" id="FORMAPAGAMENTO" name="FORMAPAGAMENTO">
                                        <option selected value="">Selecione...</option>
                                        <?php foreach($formasPagamento as $formaPagamento){ ?>
                                            <option value="<?=$formaPagamento["HANDLE"]?>"><?=$formaPagamento["NOME"]?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <span>Condição de Pagamento<span class="vermelho">*</span></span>
                                    <select class="form-control" id="CONDICAOPAGAMENTO" name="CONDICAOPAGAMENTO">
                                        <option selected value="">Selecione...</option>
                                        <?php foreach($condicoesPagamento as $condicaoPagamento){ ?>
                                            <option value="<?=$condicaoPagamento["HANDLE"]?>"><?=$condicaoPagamento["NOME"]?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <span>Valor</span>
                                    <input type="text" class="form-control dinheiro" disabled="disabled" name="VALORORDEM" id="VALORORDEM" value="0,00">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <span>Tipo de frete<span class="vermelho">*</span></span>
                                    <select class="form-control" id="TIPOFRETE" name="TIPOFRETE" required="required">
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
                                    <select class="form-control" id="TIPOTRANSPORTE" name="TIPOTRANSPORTE">
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
                                    <select class="form-control" id="TRANSPORTADORA" name="TRANSPORTADORA">
                                        <option selected value="">Selecione...</option>
                                        <?php foreach($transportadoras as $transportadora){ ?>
                                            <option value="<?=$transportadora["HANDLE"]?>"><?=$transportadora["NOME"]?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <span>Observação</span>
                                    <textarea class="form-control" rows="3" name="OBSERVACAO"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12 right">
                                <button type="submit" class="btn btn-success">Gravar</button>
                                <button type="button" class="btn btn-default btnFechar">Fechar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- end pageContent -->     

            <div class="clearfix"></div>
            <!-- Classie -->
            <script src="../tecnologia/js/classie.js"></script>
            <!--scrolling js-->
            <script src="../tecnologia/js/jquery.nicescroll.js"></script>
            <script src="../tecnologia/js/script.js"></script>
            <!--//scrolling js-->
            <!-- Bootstrap Core JavaScript -->
            <script src="../tecnologia/js/bootstrap.js"></script>
            <!-- jQuery Mask -->
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
            <!-- DataTables -->
            <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.10.18/r-2.2.2/datatables.min.css"/>
            <script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.18/r-2.2.2/datatables.min.js"></script>
            <!-- SweetAlert -->
            <script type="text/javascript" src="../tecnologia/js/sweetalert/sweetalert.min.js"></script>

            <!-- Bugsnag -->
            <script src="//d2wy8f7a9ursnm.cloudfront.net/v6/bugsnag.min.js"></script>
            <script>window.bugsnagClient = bugsnag('9f6cc1049582acdb30bc5fff5e922e62')</script>

            <script type="text/javascript" src="../tecnologia/js/CriarOrdemVenda.js"></script>
        </body>
    </html>

    <?php
}