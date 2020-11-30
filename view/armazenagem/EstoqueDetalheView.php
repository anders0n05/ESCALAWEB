<?php
include_once('../../controller/tecnologia/Sistema.php');

if (!isset($_SESSION['usuario']) and !isset($_SESSION['senha'])) {
    header('Location: ../../view/estrutura/login.php?success=F');
} // not isset sessions of login
else {
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
        <script src="../tecnologia/js/moment-2.2.1.js" type="text/javascript"></script>
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
        <link type="text/css" href="../tecnologia/css/jquery-ui.css" rel="stylesheet" />
        <link type="text/css" href="../tecnologia/css/styleCustom.css" rel="stylesheet" />
        <script type="text/javascript" src="../../view/tecnologia/js/blockUI.js"></script>
        <link type="text/css" href="../tecnologia/css/jquery.scrolling-tabs.css" rel="stylesheet" />

        <!--// End Custom -->
    </head>

    <body>
        <div class="main-content" id="bodyFullScreen">
            <div id="loader"></div>
            <?php
            include_once('../../model/armazenagem/EstoqueDetalheModel.php');
            ?>
            <!-- header-starts -->
            <div class="sticky-header header-section ">

                <a href="EstoqueArmazemView.php">
                    <button id="showLeftPushVoltarForm"><i class="glyphicon glyphicon-menu-left"></i></button>
                </a>
                <a href="RastreioPedido.php" class="display" hidden="true">
                    <button hidden="true" id="showLeftPush"><i class="glyphicon glyphicon-menu-left"></i></button>
                </a>
                <!--toggle button end-->

                <div class="topBar mobileHide" style="text-align:left; width:90%;">Detalhe do estoque de mercadoria</div>
                <div class="topBar desktopHide">Detalhe do estoque de mercadoria</div>
                <div class="topBarRight dropdown">
                    <button type="button" class="btn botaoTop dropdown-toggle desktopHide" role="button" aria-expanded="false" data-toggle="dropdown"><i class="material-icons">&#xE5D4;</i></button>
                </div>

                <div class="clearfix"></div>
            </div>
            <!-- //header-ends -->
            <!-- main content start-->
            <div class="pageContent">

                <form method="post" id="SaldoEstoque" action="#" enctype="multipart/form-data">
                    <div class="row">
                        <div class="formContent">
                            <div class="col-md-6 col-xs-1 pullBottom"><span>Filial</span>
                                <input type="text" name="filial" id="filial" value="<?php echo $filial; ?>" class="form-control" disabled>
                            </div>

                            <div class="col-md-6 col-xs-3 pullBottom"><span>Cliente</span>
                                <input type="text" name="cliente" id="cliente" value="<?php echo $cliente; ?>" class="form-control" disabled>
                            </div>

                            <div class="col-md-10 col-xs-3 pullBottom"><span>Item</span>
                                <input type="text" name="item" id="item" value="<?php echo $item; ?>" class="form-control" disabled>
                            </div>

                            <div class="col-md-2 col-xs-3 pullBottom"><span>Un</span>
                                <input type="text" name="unidadeMedida" id="unidadeMedida" value="<?php echo $unidadeMedida; ?>" class="form-control" disabled>
                            </div>

                            <div class="col-md-2 col-xs-3 pullBottom"><span>Nr ordem</span>
                                <input type="text" name="ordem" id="ordem" value="<?php echo $ordem; ?>" class="form-control" disabled>
                            </div>

                            <div class="col-md-2 col-xs-3 pullBottom"><span>Nr pedido</span>
                                <input type="text" name="nrPedido" id="nrPedido" value="<?php echo $nrPedido; ?>" class="form-control" disabled>
                            </div>

                            <div class="col-md-4 col-xs-3 pullBottom"><span>Natureza operação</span>
                                <input type="text" name="naturezaOperacao" id="naturezaOperacao" value="<?php echo $naturezaOperacao; ?>" class="form-control" disabled>
                            </div>

                            <div class="col-md-4 col-xs-3 pullBottom"><span>Ciente faturamento</span>
                                <input type="text" name="clienteFaturamento" id="clienteFaturamento" value="<?php echo $clienteFaturamento; ?>" class="form-control" disabled>
                            </div>

                            <div class="col-md-2 col-xs-3 pullBottom"><span>Depósito</span>
                                <input type="text" name="deposito" id="deposito" value="<?php echo $deposito; ?>" class="form-control" disabled>
                            </div>

                            <div class="col-md-2 col-xs-3 pullBottom"><span>Endereço</span>
                                <input type="text" name="endereco" id="endereco" value="<?php echo $endereco; ?>" class="form-control" disabled>
                            </div>

                            <div class="col-md-1 col-xs-3 pullBottom"><span>Unitização</span>
                                <input type="text" name="unitizacao" id="unitizacao" value="<?php echo $unitizacao; ?>" class="form-control" disabled>
                            </div>

                            <div class="col-md-1 col-xs-3 pullBottom"><span>Volume</span>
                                <input type="text" name="volume" id="volume" value="<?php echo $volume; ?>" class="form-control" disabled>
                            </div>

                            <div class="col-md-2 col-xs-3 pullBottom"><span>Nr ocorrência</span>
                                <input type="text" name="ocorrencia" id="ocorrencia" value="<?php echo $ocorrencia; ?>" class="form-control" disabled>
                            </div>

                            <div class="col-md-2 col-xs-3 pullBottom"><span>Nr documento</span>
                                <input type="text" name="nrDocumento" id="nrDocumento" value="<?php echo $nrDocumento; ?>" class="form-control" disabled>
                            </div>

                            <div class="col-md-2 col-xs-3 pullBottom"><span>Nr descarga</span>
                                <input type="text" name="nrDescarga" id="nrDescarga" value="<?php echo $nrDescarga; ?>" class="form-control" disabled>
                            </div>

                            <div class="col-md-3 col-xs-3 pullBottom"><span>Lote</span>
                                <input type="text" name="lote" id="lote" value="<?php echo $lote; ?>" class="form-control" disabled>
                            </div>

                            <div class="col-md-3 col-xs-3 pullBottom"><span>Nr série</span>
                                <input type="text" name="nrSerie" id="nrSerie" value="<?php echo $nrSerie; ?>" class="form-control" disabled>
                            </div>

                            <div class="col-md-2 col-xs-3 pullBottom"><span>Fabricação</span>
                                <input type="text" name="fabricacao" id="fabricacao" value="<?php echo $fabricacao; ?>" class="form-control" disabled>
                            </div>

                            <div class="col-md-2 col-xs-3 pullBottom"><span>Validade</span>
                                <input type="text" name="validade" id="validade" value="<?php echo $validade; ?>" class="form-control" disabled>
                            </div>

                            <div class="col-md-2 col-xs-3 pullBottom"><span>Conteiner</span>
                                <input type="text" name="conteiner" id="conteiner" value="<?php echo $conteiner; ?>" class="form-control" disabled>
                            </div>

                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <!--end row -->

                    <div class="col-xs-12 bottonPull">
                        <div class="dividerH"></div>
                        <p>
                            <table class="table table-responsive table-striped bottomPull" id="reqtableAnexo" border="0">
                                <thead>
                                    <th class="col-md-2 col-xs-3 pullBottom">Tipo de saldo</th>
                                    <th class="col-md-2 col-xs-3 pullBottom">Quantidade</th>
                                    <th class="col-md-2 col-xs-3 pullBottom">Volume</th>
                                    <th class="col-md-2 col-xs-3 pullBottom">Peso bruto</th>
                                    <th class="col-md-2 col-xs-3 pullBottom">Peso líquido</th>
                                    <th class="col-md-2 col-xs-3 pullBottom">Valor</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="col-md-2 col-xs-3 pullBottom">
                                                Disponível
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-md-2 col-xs-3 pullBottom">
                                                <?php echo $disponivelQuantidade; ?>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-md-2 col-xs-3 pullBottom">
                                                <?php echo $disponivelVolume; ?>
                                            </div class="col-md-2 col-xs-3 pullBottom">
                                        </td>
                                        <td>
                                            <div class="col-md-2 col-xs-3 pullBottom">
                                                <?php echo $disponivelPesoBruto; ?>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-md-2 col-xs-3 pullBottom">
                                                <?php echo $disponivelPesoLiquido; ?>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-md-2 col-xs-3 pullBottom">
                                                <?php echo $disponivelValor; ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="col-md-2 col-xs-3 pullBottom">
                                                Reservado
                                            </div class="col-md-2 col-xs-3 pullBottom">
                                        </td>
                                        <td>
                                            <div class="col-md-2 col-xs-3 pullBottom">
                                                <?php echo $reservadoQuantidade; ?>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-md-2 col-xs-3 pullBottom">
                                                <?php echo $reservadoVolume; ?>
                                            </div class="col-md-2 col-xs-3 pullBottom">
                                        </td>
                                        <td>
                                            <div class="col-md-2 col-xs-3 pullBottom">
                                                <?php echo $reservadoPesoBruto; ?>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-md-2 col-xs-3 pullBottom">
                                                <?php echo $reservadoPesoLiquido; ?>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-md-2 col-xs-3 pullBottom">
                                                <?php echo $reservadoValor; ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="col-md-2 col-xs-3 pullBottom">
                                                Bloqueado
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-md-2 col-xs-3 pullBottom">
                                                <?php echo $bloqueadoQuantidade; ?>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-md-2 col-xs-3 pullBottom">
                                                <?php echo $bloqueadoVolume; ?>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-md-2 col-xs-3 pullBottom">
                                                <?php echo $bloqueadoPesoBruto; ?>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-md-2 col-xs-3 pullBottom">
                                                <?php echo $bloqueadoPesoLiquido; ?>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-md-2 col-xs-3 pullBottom">
                                                <?php echo $bloqueadoValor; ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="col-md-2 col-xs-3 pullBottom">
                                                Atual
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-md-2 col-xs-3 pullBottom">
                                                <?php echo $saldoQuantidade; ?>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-md-2 col-xs-3 pullBottom">
                                                <?php echo $saldoVolume; ?>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-md-2 col-xs-3 pullBottom">
                                                <?php echo $saldoPesoBruto; ?>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-md-2 col-xs-3 pullBottom">
                                                <?php echo $saldoPesoLiquido; ?>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="col-md-2 col-xs-3 pullBottom">
                                                <?php echo $saldoValor; ?>
                                            </div>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>

                            <div class="clearfix"></div>
                        </p>
                    </div>
                </form>
            </div><!-- end row -->
        </div><!-- end pageContent -->
        <div class="footerFixed mobileHide">
            <div class="right">
                &nbsp;
            </div>
        </div>
        <!-- end footer -->

        <div class="clearfix"></div>
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
        <script src="../tecnologia/js/bootstrap.js"></script>
    </body>

    </html>
<?php
}
