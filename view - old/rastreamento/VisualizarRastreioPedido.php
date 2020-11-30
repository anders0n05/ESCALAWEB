<?php
include_once('../../controller/tecnologia/Sistema.php');

if (!isset($_SESSION['usuario']) and !isset($_SESSION['senha'])) {
    header('Location: ../../view/estrutura/login.php?success=F');
}// not isset sessions of login
else {
    $connect = Sistema::getConexao();
    ?>
    <!DOCTYPE HTML>
    <html>
    <head>
        <title>Escalasoft</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link rel="icon" type="image/png" href="../tecnologia/img/favicon.png"/>
        <!-- Bootstrap Core CSS -->
        <link href="../tecnologia/css/bootstrap.css" rel='stylesheet' type='text/css'/>
        <!-- Custom CSS -->
        <link href="../tecnologia/css/style.css" rel='stylesheet' type='text/css'/>
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
        <link rel="stylesheet" href="../tecnologia/css/clndr.css" type="text/css"/>
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
        <link type="text/css" href="../tecnologia/css/jquery-ui.css" rel="stylesheet"/>
        <link type="text/css" href="../tecnologia/css/styleCustom.css" rel="stylesheet"/>
        <script type="text/javascript" src="../../view/tecnologia/js/blockUI.js"></script>
        <link type="text/css" href="../tecnologia/css/jquery.scrolling-tabs.css" rel="stylesheet"/>

        <!--// End Custom -->
    </head>
    <body>
    <div class="main-content" id="bodyFullScreen">
        <div id="loader"></div>
        <?php
        include_once('../../model/rastreamento/VisualizarRastreioPedidoModel.php');
        ?>
        <!-- header-starts -->
        <div class="sticky-header header-section ">

            <a href="RastreioPedido.php">
                <button id="showLeftPushVoltarForm"><i class="glyphicon glyphicon-menu-left"></i></button>
            </a>
            <a href="RastreioPedido.php" class="display" hidden="true">
                <button hidden="true" id="showLeftPush"><i class="glyphicon glyphicon-menu-left"></i></button>
            </a>
            <!--toggle button end-->

            <div class="topBar mobileHide" style="text-align:left; width:90%;">Rastreio de pedido - <font
                        color="#D1D1D1"><?php echo $situacaoRastreamento . ' desde ' . $statusDataRastreamento . ' às ' . $statusHoraRastreamento; ?></font>
            </div>
            <div class="topBar desktopHide">Rastreio de pedido</div>
            <div class="topBarRight dropdown">
                <button type="button" class="btn botaoTop dropdown-toggle desktopHide" role="button"
                        aria-expanded="false" data-toggle="dropdown"><i class="material-icons">&#xE5D4;</i></button>
            </div>

            <div class="clearfix"></div>
        </div>
        <!-- //header-ends -->        
        <!-- main content start-->
        <div class="pageContent">

            <form method="post" id="DespesaViagem" action="#" enctype="multipart/form-data">
                <div class="row">
                    <div class="formContent">
                        <div class="col-md-2 col-xs-6 pullBottom"><span>Pedido</span>
                            <div class="inner-addon right-addon"><font size="-2"><i
                                            class="glyphicon glyphicon-triangle-bottom" id="spandown"></i></font>
                                <input type="text" name="pedido" id="pedido" value="<?php echo $numeroRastreamento; ?>"
                                       class="form-control" disabled>
                            </div>
                        </div>

                        <div class="col-md-2 col-xs-3 pullBottom"><span>Nr pedido</span>
                            <div class="inner-addon right-addon"><font size="-2"><i
                                            class="glyphicon glyphicon-triangle-bottom" id="spandown"></i></font>
                                <input type="text" name="nrpedido" id="nrpedido" value="<?php echo $numeroPedido; ?>"
                                       class="form-control" disabled>
                            </div>
                        </div>

                        <div class="col-md-2 col-xs-3 pullBottom"><span>Nr controle</span>
                            <div class="inner-addon right-addon"><font size="-2"><i
                                            class="glyphicon glyphicon-triangle-bottom" id="spandown"></i></font>
                                <input type="text" name="nrcontrole" id="nrcontrole"
                                       value="<?php echo $numeroControle; ?>" class="form-control" disabled>
                            </div>
                        </div>

                        <div class="col-md-2 col-xs-6 pullBottom"><span>Rastreamento</span>
                            <input type="text" name="rastreamento" id="rastreamento"
                                   value="<?php echo $Rastreamento; ?>" class="form-control" disabled>
                        </div>

                        <div class="col-md-2 col-xs-6 pullBottom"><span>Tipo</span>
                            <div class="inner-addon right-addon"><font size="-2"><i
                                            class="glyphicon glyphicon-triangle-bottom" id="spandown"></i></font>
                                <input type="text" name="tipo" id="tipo" value="<?php echo $tipoRastreamento; ?>"
                                       class="form-control" disabled>
                            </div>
                        </div>

                        <div class="col-md-2 col-xs-6 pullBottom"><span>Filial</span>
                            <div class="inner-addon right-addon"><font size="-2"><i
                                            class="glyphicon glyphicon-triangle-bottom" id="spandown"></i></font>
                                <input type="text" name="filial" id="filial" value="<?php echo $filialRastreamento; ?>"
                                       class="form-control" disabled>
                            </div>
                        </div>

                        <div class="col-md-1 col-xs-6 pullBottom"><span>Data</span>
                            <input type="text" name="data" id="data" value="<?php echo $dataRastreamento; ?>"
                                   class="form-control" disabled>
                        </div>

                        <div class="col-md-2 col-xs-9 pullBottom"><span>Cliente</span>
                            <input type="text" name="cliente" id="cliente" value="<?php echo $clienteRastreamento; ?>"
                                   class="form-control" disabled>
                        </div>

                        <div class="col-md-1 col-xs-3 pullBottom"><span>Unidade negócio</span>
                            <div class="inner-addon right-addon"><font size="-2"><i
                                            class="glyphicon glyphicon-triangle-bottom" id="spandown"></i></font>
                                <input type="text" name="unidadenegocio" id="unidadenegocio"
                                       value="<?php echo $unidadeNegocio; ?>" class="form-control" disabled>
                            </div>
                        </div>

                        <div class="col-md-2  col-xs-3 pullBottom"><span>Quantidade</span>
                            <input type="text" name="quantidade" id="quantidade"
                                   value="<?php echo $quantidadeRastreamento; ?>" class="form-control inputRight"
                                   disabled>
                        </div>

                        <div class="col-md-2 col-xs-3 pullBottom"><span>Volumes</span>
                            <input type="text" name="volumes" id="volumes" value="<?php echo $volumeRastreamento; ?>"
                                   class="form-control inputRight" disabled>
                        </div>
                        <div class="col-md-2 col-xs-3 pullBottom"><span>Peso</span>
                            <input type="text" name="peso" id="peso" value="<?php echo $pesoRastreamento; ?>"
                                   class="form-control inputRight" disabled>
                        </div>
                        <div class="col-md-2 col-xs-3 pullBottom"><span class="mobileHide">Valor da mercadoria</span>
                            <span class="desktopHide">Vlr merc.</span>
                            <input type="text" name="valorMerc" id="valorMerc"
                                   value="<?php echo $valormercadoriaRastreamento; ?>" class="form-control inputRight"
                                   disabled>
                        </div>

                        <div class="clearfix"></div>
                    </div>
                </div>
                <!-- end row -->
            </form>
            <div class="row" style="margin: 0.2em 0 0;">
                <?php
                include_once('../../model/rastreamento/VisualizarRastreioPedidoTabsModel.php');
                ?>

                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="Remetente">
                        <div class="col-xs-12 bottonPull">
                            <div class="formContent">
                                <br>
                                <div class="col-md-3 col-xs-6 pullBottom">
                                    <span>Coletado em</span>
                                    <input type="text" name="quantidade" id="quantidade"
                                           value="<?php echo $dataColetaRastreamento; ?>" class="form-control" disabled>
                                </div>
                                <div class="col-md-3 col-xs-6 pullBottom">
                                    <span>Entregar até</span>
                                    <input type="text" name="quantidade" id="quantidade"
                                           value="<?php echo $dataEntregaAteRastreamento; ?>" class="form-control"
                                           disabled>
                                </div>
                                <div class="col-md-3 col-xs-6 pullBottom">
                                    <span>Entregue em</span>
                                    <input type="text" name="quantidade" id="quantidade"
                                           value="<?php echo $dataEntregaRastreamento; ?>" class="form-control"
                                           disabled>
                                </div>
                                <div class="col-md-3 col-xs-6 pullBottom">
                                    <span>Situação</span>
                                    <input type="text" name="quantidade" id="quantidade"
                                           value="<?php echo $situacaoRastreamento; ?>" class="form-control" disabled>
                                </div>

                                <div class="col-md-6 col-xs-12 pullBottom">
                                    <span>Remetente</span>
                                    <div class="inner-addon right-addon"><font size="-2"><i
                                                    class="glyphicon glyphicon-triangle-bottom"
                                                    id="spandown"></i></font>
                                        <input type="text" name="quantidade" id="quantidade"
                                               value="<?php echo $remetenteRastreamento; ?>" class="form-control"
                                               disabled>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-12 pullBottom">
                                    <span>Destinatário</span>
                                    <div class="inner-addon right-addon"><font size="-2"><i
                                                    class="glyphicon glyphicon-triangle-bottom"
                                                    id="spandown"></i></font>
                                        <input type="text" name="quantidade" id="quantidade"
                                               value="<?php echo $destinatarioRastreamento; ?>" class="form-control"
                                               disabled>
                                    </div>
                                </div>

                                <div class="col-md-6 col-xs-6 pullBottom">
                                    <span class="mobileHide">Endereço do local de Coleta</span>
                                    <span class="desktopHide">End. Coleta</span>
                                    <input type="text" name="quantidade" id="quantidade"
                                           value="<?php echo $tipoLogradouroEnderecoColeta . " " . $ruaColetaRastreamento . ' - ' . $numeroColetaRastreamento . ' - ' . $cepColetaRastreamento . ' - ' . $bairroColetaRastreamento . ' - ' . $munColetaRastreamento . ' - ' . $ufColetaRastreamento . ' - ' . $paisColetaRastreamento; ?>"
                                           class="form-control" disabled>
                                </div>
                                <div class="col-md-6 col-xs-6 pullBottom">
                                    <span class="mobileHide">Endereço do local de Entrega</span>
                                    <span class="desktopHide">End. Entrega</span>
                                    <input type="text" name="quantidade" id="quantidade"
                                           value="<?php echo $tipoLogradouroEnderecoEntrega . " " . $ruaEntregaRastreamento . ' - ' . $numeroEntregaRastreamento . ' - ' . $cepEntregaRastreamento . ' - ' . $bairroEntregaRastreamento . ' - ' . $munEntregaRastreamento . ' - ' . $ufEntregaRastreamento . ' - ' . $paisColetaRastreamento; ?>"
                                           class="form-control" disabled>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <?php
                    if ($documentoOriginarioExiste > null) {
                        ?>
                        <div role="tabpanel" class="tab-pane " id="DocumentoOriginario">

                            <div class="col-xs-12 bottonPull">
                                <div class="left">
                                    <!--button type="button" class="botaoBranco" name="liberarDespesaViagemAnexo" id="liberarDespesaViagemAnexo">Liberar</button>
                                    <button type="button" class="botaoBranco" name="voltarDespesaViagemAnexo" id="voltarDespesaViagemAnexo">Voltar</button-->
                                </div>
                                <div class="right">
                                    <button type="button" class="botaoBranco1" id="" disabled><font size="3px"><i
                                                    class="glyphicon glyphicon-plus"> </i> </font></button>
                                    <button type="button" class="botaoBranco1" id="" disabled><font size="5px"><i
                                                    class="fa fa-caret-up"> </i> </font></button>
                                    <button type="button" class="botaoBranco1" id="" disabled><font size="4px"><i
                                                    class="fa fa-minus"> </i> </font></button>
                                </div>
                                <div class="dividerH"></div>
                                <p>

                                <table class="table table-responsive table-striped bottomPull" id="reqtableAnexo"
                                       border="0">
                                    <thead>
                                    <th>&nbsp;</th>
                                    <th class="text-right">Número</th>
                                    <th>Tipo</th>
                                    <th>Filial</th>
                                    <th>Emissão</th>
                                    <th>Pessoa</th>
                                    <th class="text-right">Valor</th>
                                    <th class="text-right">Peso</th>
                                    <th class="text-right">Volume</th>
                                    </thead>
                                    <tbody>
                                    <?php
                                    include_once('../../model/rastreamento/VisualizarRastreioPedidoDocumentoOriginarioTabelaModel.php');
                                    ?>
                                    </tbody>
                                </table>

                                <div class="clearfix"></div>
                                </p>
                            </div>

                        </div>
                        <?php
                    }

                    if ($documentoExiste > null) {
                        ?>
                        <div role="tabpanel" class="tab-pane " id="Documento">

                            <div class="col-xs-12 bottonPull">
                                <div class="left">
                                    <button type="button" class="botaoBranco display" name="baixarXML" id="baixarXML">
                                        Baixar xml
                                    </button>
                                    <button type="button" class="botaoBranco display" name="baixarPDF" id="baixarPDF">
                                        Baixar pdf
                                    </button>
                                </div>
                                <div class="right">
                                    <button type="button" class="botaoBranco1" id="" disabled><font size="3px"><i
                                                    class="glyphicon glyphicon-plus"> </i> </font></button>
                                    <button type="button" class="botaoBranco1" id="" disabled><font size="5px"><i
                                                    class="fa fa-caret-up"> </i> </font></button>
                                    <button type="button" class="botaoBranco1" id="" disabled><font size="4px"><i
                                                    class="fa fa-minus"> </i> </font></button>
                                </div>
                                <div class="dividerH"></div>
                                <p>

                                <table class="table table-responsive table-striped bottomPull" id="reqtableDocumento" border="0">
                                    <thead>
                                    <th>&nbsp;</th>
                                    <th>Número</th>
                                    <th>Tipo</th>
                                    <th>Filial</th>
                                    <th>Emissão</th>
                                    <th>Pessoa</th>
                                    <th class="text-right">Valor</th>
                                    </thead>
                                    <tbody>
                                    <?php
                                    include_once('../../model/rastreamento/VisualizarRastreioPedidoDocumentoTabelaModel.php');
                                    ?>
                                    </tbody>
                                </table>

                                <div class="clearfix"></div>
                                </p>
                            </div>

                        </div>
                        <script>

                            function BaixarDocumentoPdf(){
                                let documentoHandleComponente = $("#reqtableDocumento .activetr #checkDocumento")[0].value.split('-');

                                let handleGD_DOCUMENTO = documentoHandleComponente[0];
                                let handleDocumento = documentoHandleComponente[1];

                                $.ajax({
                                    url: "../../controller/rastreamento/Pedido.php",
                                    method: "POST",
                                    dataType: "JSON",
                                    data: {
                                        "ACAO"       : "getDocumentoPdf",
                                        "DOCUMENTO"  : handleGD_DOCUMENTO
                                    },
                                    success: function(data) {
                                        var blob=new Blob([atob(data.Arquivo)]);
                                        var link=document.createElement('a');
                                        link.href=window.URL.createObjectURL(blob);
                                        link.download="Impressao_"+handleGD_DOCUMENTO+".pdf";
                                        link.click();
                                    }
                                });
                            }

                            function BaixarDocumentoXml(){
                                let documentoHandleComponente = $("#reqtableDocumento .activetr #checkDocumento")[0].value.split('-');

                                let handleGD_DOCUMENTO = documentoHandleComponente[0];
                                let handleDocumento = documentoHandleComponente[1];

                                $.ajax({
                                    url: "../../controller/rastreamento/Pedido.php",
                                    method: "POST",
                                    dataType: "JSON",
                                    data: {
                                        "ACAO"       : "getDocumentoXml",
                                        "DOCUMENTO"  : handleGD_DOCUMENTO
                                    },
                                    success: function(data) {
                                        var blob=new Blob([atob(data.Arquivo)]);
                                        var link=document.createElement('a');
                                        link.href=window.URL.createObjectURL(blob);
                                        link.download="Impressao_"+handleGD_DOCUMENTO+".xml";
                                        link.click();
                                    },
                                    error: function(retorno){
                                    }
                                });
                            }

                            $("#baixarPDF").click(BaixarDocumentoPdf);

                            $("#baixarXML").click(BaixarDocumentoXml);

                            $(document).ready(function () {
                                $('#reqtableDocumento tr').click(function () {
                                    //$('#reqtablenew td').removeClass("activetr");
                                    var checkboxAnterior = $(this).find('[name="checkDocumento[]"]');

                                    if (checkboxAnterior.is(':checked')) {
                                        $(this).removeClass("activetr");                                       
                                        $(this).find('[name="checkDocumento[]"]').prop('checked', false);
                                        $('#baixarXML').addClass('display');
                                        $('#baixarPDF').addClass('display');
                                    } else {
                                        $(this).addClass("activetr");
                                        $(this).find('[name="checkDocumento[]"]').prop('checked', true);
                                        $('#baixarXML').removeClass('display');
                                        $('#baixarPDF').removeClass('display');
                                    }

                                    $('input:radio').each(function () {

                                        if ($(this).is(':checked')) {

                                         //   $('#baixarXML').removeClass('display');
//                                            $('#baixarPDF').removeClass('display');

                                            checkDocumento = parseInt($(this).val());
/*
                                            var documentoArr = $(this).val().split('-');

                                            for (var i = 0, len = checkDocumento.length; i < len; i++) {
                                                var handleGD_DOCUMENTO = documentoArr[0];
                                                var handleDocumento = documentoArr[1];
                                            }
                                            var handleGD_DOCUMENTO = documentoArr[0];
                                            var handleDocumento = documentoArr[1];

                                            $.getJSON("../../controller/tecnologia/WebService.php?getWS=S", function (getWS) {
                                                var hostWS = getWS.host + ':' + getWS.porta;
                                                var hostXML = 'http://' + hostWS + '/WebCargas/DownloadXML/' + handleDocumento + '';
                                                var hostPDF = 'http://' + hostWS + '/WebCargas/DownloadReport/' + handleGD_DOCUMENTO + '';

                                                $('#baixarXML').click(function () {
                                                    window.location = hostXML;
                                                });
                                                $('#baixarPDF').click(function () {
                                                    window.location = hostPDF;
                                                });
                                            });*/
                                        }
                                    });
                                });
                            });
                        </script>
                        <?php
                    }
                    if ($OcorrenciaTransporteExiste > null) {
                        ?>
                        <div role="tabpanel" class="tab-pane" id="OcorrenciaTransporte">

                            <div class="col-xs-12 bottonPull">
                                <div class="left">
                                    <!--button type="button" class="botaoBranco" name="liberarDespesaViagemAnexo" id="liberarDespesaViagemAnexo">Liberar</button>
                                    <button type="button" class="botaoBranco" name="voltarDespesaViagemAnexo" id="voltarDespesaViagemAnexo">Voltar</button-->
                                </div>
                                <div class="right">
                                    <button type="button" class="botaoBranco1" id="" disabled><font size="3px"><i
                                                    class="glyphicon glyphicon-plus"> </i> </font></button>
                                    <button type="button" class="botaoBranco1" id="" disabled><font size="5px"><i
                                                    class="fa fa-caret-up"> </i> </font></button>
                                    <button type="button" class="botaoBranco1" id="" disabled><font size="4px"><i
                                                    class="fa fa-minus"> </i> </font></button>
                                </div>
                                <div class="dividerH"></div>
                                <p>

                                <table class="table table-responsive table-striped bottomPull" id="reqtableAnexo"
                                       border="0">
                                    <thead>
                                    <th>#</th>
                                    <th class="text-right">Número</th>
                                    <th>Filial</th>
                                    <th>Data</th>
                                    <th>Ocorrência</th>
                                    </thead>
                                    <tbody>
                                    <?php
                                    include_once('../../model/rastreamento/VisualizarRastreioPedidoOcorrenciaTransporteTabelaModel.php');
                                    ?>
                                    </tbody>
                                </table>

                                <div class="clearfix"></div>
                                </p>
                            </div>

                        </div>
                        <?php
                    }
                    if ($PosicaoExiste > null) {
                        ?>
                        <div role="tabpanel" class="tab-pane " id="Posicao">

                            <div class="col-xs-12 bottonPull">

                                <p>

                                <table class="table table-responsive table-striped bottomPull" id="reqtableAnexo"
                                       border="0">
                                    <tbody>
                                    <?php
                                    include_once('../../model/rastreamento/VisualizarRastreioPedidoPosicaoTabelaModel.php');
                                    ?>
                                    </tbody>
                                </table>

                                <div class="clearfix"></div>
                                </p>
                            </div>

                        </div>
                        <?php
                    }
                    if ($PosicaoExiste > null and $latitudeExiste > null and $longitudeExiste > null) {
                        ?>
                        <div role="tabpanel" class="tab-pane " id="Mapa">
                            <div class="col-xs-12 bottonPull">
                                <p>
                                    <iframe src="https://maps.google.com/maps?q=<?php echo $latitudePosicao . ',' . $longitudePosicao; ?>&hl=es;z=14&amp;output=embed"
                                            width="100%" height="450" frameborder="0" style="border:0"
                                            allowfullscreen></iframe>
                                </p>
                            </div>
                        </div>
                        <?php
                    }
                    if ($EtapaExiste > null) {
                        ?>
                        <div role="tabpanel" class="tab-pane " id="Etapa">

                            <div class="col-xs-12 bottonPull">
                                <div class="left">
                                    <!--button type="button" class="botaoBranco" name="liberarDespesaViagemAnexo" id="liberarDespesaViagemAnexo">Liberar</button>
                                    <button type="button" class="botaoBranco" name="voltarDespesaViagemAnexo" id="voltarDespesaViagemAnexo">Voltar</button-->
                                </div>
                                <div class="right">
                                    <button type="button" class="botaoBranco1" id="" disabled><font size="3px"><i
                                                    class="glyphicon glyphicon-plus"> </i> </font></button>
                                    <button type="button" class="botaoBranco1" id="" disabled><font size="5px"><i
                                                    class="fa fa-caret-up"> </i> </font></button>
                                    <button type="button" class="botaoBranco1" id="" disabled><font size="4px"><i
                                                    class="fa fa-minus"> </i> </font></button>
                                </div>
                                <div class="dividerH"></div>
                                <p>

                                <table class="table table-responsive table-striped bottomPull" id="reqtableAnexo"
                                       border="0">
                                    <thead>
                                    <th>&nbsp;</th>
                                    <th class="text-center">Seq</th>
                                    <th>Etapa</th>
                                    <th class="text-center">Data</th>
                                    <th>Observação</th>

                                    </thead>
                                    <tbody>
                                    <?php
                                    include_once('../../model/rastreamento/VisualizarRastreioPedidoEtapaTabelaModel.php');
                                    ?>
                                    </tbody>
                                </table>

                                <div class="clearfix"></div>
                                </p>
                            </div>

                        </div>
                        <?php
                    }
                    ?>
                </div><!-- end tab-content -->


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
    <script type="text/javascript" src="../../view/tecnologia/js/jquery.scrolling-tabs.js" id="tabnav"></script>
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
    <!-- SweetAlert -->
<script type="text/javascript" src="../tecnologia/js/sweetalert/sweetalert.min.js"></script>
    </body>
    </html>
    <?php include_once('../../model/rastreamento/ModalRastreioPedidoOcorrencia.php') ?>
    <?php
     
}