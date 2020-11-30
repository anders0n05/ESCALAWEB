<?php

include_once('../../controller/tecnologia/Sistema.php');

$connect = Sistema::getConexao();

?>
<!DOCTYPE HTML>
<html>
<head>

    <title>Escalasoft Tecnologia</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="icon" type="image/png" href="../tecnologia/img/favicon.png"/>
    <!-- Bootstrap Core CSS -->
    <link href="../tecnologia/css/bootstrap.css" rel='stylesheet' type='text/css'/>
    <!-- Custom CSS -->
    <link href="../tecnologia/css/style.css" rel='stylesheet' type='text/css'/>
    <link href="../tecnologia/css/styleCustom.css" rel='stylesheet' type='text/css'/>
    <!-- font CSS -->
    <!-- font-awesome icons -->
    <link href="../tecnologia/css/font-awesome.css" rel="stylesheet">
    <!-- //font-awesome icons -->
    <!-- js-->
    <script src="../tecnologia/js/jquery-1.11.1.min.js"></script>
    <script src="../tecnologia/js/modernizr.custom.js"></script>

    <script>

    $(function () {
        let campoLogo = $("#LOGO");
        let campoH1Logo = $("#H1LOGO");
        campoLogo.on("error", 
            function(){
                document.getElementById("LOGO").remove();
                
                $.ajax({
                    url: "../../controller/rastreamento/Pedido.php",
                    method: "POST",
                    dataType: "JSON",
                    data: {
                        "ACAO" : "getPrimeiraEmpresa"
                    },
                    success: function (retorno) {    
                        campoH1Logo.append(retorno.APELIDOPRIMEIRAEMPRESA);
                    },
                    error: function(retorno){
                        campoH1Logo.append("Escalasoft tecnologia");
                    }
                });
            });

        campoLogo.attr("src", "../tecnologia/img/logo.png");
    });
        
    </script>
</head>
<body class="fundoAzul" id="bodyFullScreen">
<div class="main-content">
    <!-- main content start-->
    <div class="main-page">
        <div class="rastreioForm">
            <div class="col-sm-3 centering-v" id="formRastreio">
                <input type="hidden" id="RASTREAMENTO" value="<?php echo $_GET['r'] ?>" >
                <input type="hidden" id="HANDLE" >
                <h1 style="text-align: center;" id="H1LOGO"></h1>
                <img id="LOGO" width="80%" class="img-responsive" alt="Escalasoft tecnologia">
                <br>
                <p class="text-right" style="font-size: 15px;">Acompanhe o rastreamento <br>de todas as informações
                    sobre seu <br> Pedido de rastreamento</p>
                <br>
                <form method="get" id="FormRastreioPedidoBuscar" action="RastreioPedidoVisualizar.php">
                    <input type="text" name="r" name="rastreamento" style="border-radius: 3px; font-size: 16px;"
                           id="rastreamento" class="form-control" placeholder="Informe seu código de rastreamento"
                           required>
                    <br>
                    <input type="submit" name="enviar" class="btn btn-default"
                           style="float: right; font-size: 15px; border-radius: 3px;" value="Enviar">
                </form>
                <div id="retornoRastreio">
                </div>

                
            </div>
            <div class="col-sm-9" id="conteudoRastreio">
                <?php
                    include('../../model/rastreamento/RastreioPedidoVisualizar.php');
                ?>
                <div class="row">
                    <div class="col-sm-12">
                        <label>Empresa:</label> <?php echo $razaoSocialEmpresaRastreamento; ?>
                    </div>
                    <div class="col-sm-12">
                        <label>Cnpj:</label> <?php echo $cnpjEmpresaRastreamento; ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <label>Nr pedido:</label> <?php echo $numeroPedidoRastreamento; ?>
                    </div>
                    <div class="col-sm-6">
                        <label>Rastreamento:</label> <?php echo $rastreamento; ?>
                    </div>
                    <div class="col-sm-6">
                        <label>Emissão:</label> <?php echo $dataRastreamento; ?>
                    </div>
                    <div class="col-sm-6">
                        <label>Origem:</label> <?php echo $municipioColetaRastreamento . ' - ' . $ufColetaRastreamento; ?>
                    </div>
                    <div class="col-sm-6">
                        <label>Situação:</label> <?php echo $etapaRastreamentoUltimaEtapa . ' em ' . $dataRastreamentoUltimaEtapa; ?>
                    </div>
                    <div class="col-sm-6">
                        <label>Destino:</label> <?php echo $municipioEntregaRastreamento . ' - ' . $ufEntregaRastreamento; ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <label>Remetente:</label> <?php echo $remetenteRastreamento; ?>
                    </div>
                    <div class="col-xs-6">
                        <label>Destinatário:</label> <?php echo $destinatarioRastreamento; ?>
                    </div>
                    <div class="col-xs-6">
                        <?php echo $tipoLogradouroColetaRastreamento . ' ' . $ruaColetaRastreamento . ', ' . $numeroColetaRastreamento; ?>
                    </div>
                    <div class="col-xs-6">
                        <?php echo $tipoLogradouroEntregaRastreamento . ' ' . $ruaEntregaRastreamento . ', ' . $numeroEntregaRastreamento; ?>
                    </div>
                    <div class="col-xs-6">
                        <?php echo $cepColetaRastreamento . ' - ' . $municipioColetaRastreamento . ' - ' . $ufColetaRastreamento; ?>
                    </div>
                    <div class="col-xs-6">
                        <?php echo $cepEntregaRastreamento . ' - ' . $municipioEntregaRastreamento . ' - ' . $ufEntregaRastreamento; ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <label>Data:</label> <?php echo $dataRastreamento; ?>
                    </div>
                    <div class="col-xs-6">
                        <label>Volume:</label> <?php echo Sistema::formataValor($volumeRastreamento); ?>
                    </div>
                    <div class="col-xs-6">
                        <label>Quantidade:</label> <?php echo Sistema::formataValor($quantidadeRastreamento); ?>
                    </div>
                    <div class="col-xs-6">
                        <label>Peso (KG):</label> <?php echo Sistema::formataValor($pesoRastreamento); ?>
                    </div>
                    <div class="col-xs-6">
                        <label>Volume (m3):</label> <?php echo Sistema::formataValor($volumeRastreamento); ?>
                    </div>
                    <div class="col-xs-6">
                        <label>Valor Mercadoria:</label> <?php echo Sistema::formataValor($valorMercadoriaRastreamento); ?>
                    </div>
                    <div class="col-xs-6">
                        <label>Transportadora:</label> <?php echo $transportadora; ?>
                    </div>
                    <div class="col-xs-6">
                        <label>Código de rastreamento:</label> <?php echo $codigoRastreamento; ?>
                    </div>
                </div>
                <hr>

                <?php
                if (isset($handleRastreamentoDocumentoOriginario) || isset($handleRastreamentoDocumento)) {
                    ?>
                    <div class="row">
                        <div class="col-sm-12">
                            <label>Documentos emitidos</label>
                            <br>
                            <hr style="margin-top: 0; margin-bottom: 0;">
                        </div>

                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <table class="table" border="0" style="border: 0;">
                                    <tbody>
                                    <?php
                                    include('../../model/rastreamento/RastreioPedidoVisualizarDocumento.php');
                                    ?>
                                    </tbody>
                                </table>
                                <hr style="margin-top: 0;">
                            </div>
                        </div>
                    </div>

                    <?php
                }
                if (isset($handleRastreamentoEtapa)) {
                    ?>
                    <div class="row">

                        <div class="col-sm-12">
                            <label>Histórico do pedido</label>
                            <br>
                            <hr style="margin-top: 0; margin-bottom: 0;">
                        </div>

                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <table class="table table-hover" border="0" style="border: 0;">
                                    <thead style="border: 0; ">
                                    <th class="col-md-1" style="border: 0; background-color: #F5F5F5;"></th>
                                    <th class="col-md-1" style="border: 0; background-color: #F5F5F5;">Seq</th>
                                    <th class="col-md-2" style="border: 0; background-color: #F5F5F5;">Data</th>
                                    <th style="border: 0; background-color: #F5F5F5;">Etapas</th>
                                    <th style="border: 0; background-color: #F5F5F5;">Observação</th>
                                    </thead>
                                    <tbody id="GRIDETAPAEVENTO">
                                    <?php
                                   // include('../../model/rastreamento/RastreioPedidoVisualizarEtapa.php');
                                    ?>
                                    </tbody>
                                </table>
                                <hr style="margin-top: 0;">
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
    <!--footer -->
    <div class="col-md-3 col-sm-3 text-center">
        <div style="color: white; bottom: 0; position: fixed; font-size: 15px; width: 100%">
            <a href="http://www.escalasoft.com.br/" target="_blank" style="color: white;"><p>Escalasoft tecnologia</p>
            </a>
        </div>
        <div style="color: white; bottom: 0; position: absolute; font-size: 15px; width: 100% ">
            <a href="http://www.escalasoft.com.br/" target="_blank" style="color: white;">
                <img src="../tecnologia/img/logologin.png" style="margin-left: 27%;" id="LOGOESCALA" width="40%" class="img-responsive" alt="Escalasoft tecnologia">
            </a>
        </div>
    </div>
    <!--//footer-->
</div>
<!-- Classie -->
<script src="../tecnologia/js/classie.js"></script>
<!--scrolling js-->
<script src="../tecnologia/js/jquery.nicescroll.js"></script>
<!-- SweetAlert -->
<script type="text/javascript" src="../tecnologia/js/sweetalert/sweetalert.min.js"></script>
<!--script src="../tecnologia/js/script.js"></script-->
<!--//scrolling js-->
<!-- Bootstrap Core JavaScript -->
<script src="../tecnologia/js/bootstrap.js"></script>
<script src="../tecnologia/js/moment.min.js"></script>
<script src="js/rastreioPedidoVisualizarJs.js"></script>
</body>
</html>