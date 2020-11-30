<?php
include_once('../../controller/tecnologia/Sistema.php');
require '../../model/redespacho/getDados.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="../tecnologia/img/favicon.png"/>
    <title>Gerar fatura</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="../tecnologia/css/bootstrap3/bootstrap.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="../tecnologia/css/datatable/datatables.min.css"/>
    <!-- FontAwessome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
          integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <!-- DropZone -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="../tecnologia/css/relacionamento.css"/>    
</head>

<style>
    .col-md-2, .col-md-4, .col-md-1, .col-md-12 {
        padding-right: 5px;
        padding-left: 5px;
    }
</style>

<body>
<div class="sticky-header header-section">
    <div class="container">
        <div class="topBar container">Gerar fatura</div>
    </div>
</div>
<div class="page-content">
    <div class="container">
        <div class="erro"></div>
        <form method="POST" id="formFatura">
            <input type="hidden" class="form-control" name="CHAVE" value="<?= Sistema::criarGuid() ?>"/>
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <span>Data</span>
                        <input type="text" class="form-control datahora" readonly="true" id="DATA" name="DATA" value="<?= date('d/m/Y H:i') ?>">
                        <input type="text" class="form-control" id="HANDLE" style="display: none;" name="HANDLE" value="<?= $_GET["agrupamento"]; ?>">                                                
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <span>Data emissão</span>
                        <input type="text" class="form-control datahora" id="DATAEMISSAO" name="DATAEMISSAO" value="<?= date('d/m/Y H:i') ?>">                                                               
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <span>Tipo de doc*</span>
                        <select class="form-control" name="TIPODOCUMENTO" required="required">
                            <option selected disabled value="">Selecione...</option>
                            <?php foreach ($tipoDocs as $tipodoc) { ?>
                                <option value="<?= $tipodoc["HANDLE"] ?>"><?= $tipodoc["NOME"] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>                
                <div class="col-md-4">
                    <div class="form-group">
                        <span>Chave documento eletrônico</span>
                        <input type="text" class="form-control" id="CHAVEDOCUMENTOELETRONICO" name="CHAVEDOCUMENTOELETRONICO" >
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <span>Número</span>
                        <input type="text" class="form-control" id="NUMERO" name="NUMERO">
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <span>Série</span>
                        <input type="text" class="form-control" id="SERIE" name="SERIE">
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <span>Valor</span>
                        <input type="text" disabled class="form-control" style="text-align:right;" id="VALOR" name="VALOR" value="<?= Sistema::formataValor($valor["TOTAL"])?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <span>Descrição detalhada*</span>
                        <textarea class="form-control" rows="4" placeholder="Descrição detalhada" required="required"
                                  name="DESCRICAO"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <span>Anexo</span>
                    <div class="dropzone">
                        <div class="dz-message" data-dz-message><span>Clique ou solte arquivos aqui para anexar.</span>
                        </div>
                        <div class="fallback">
                            <input name="file" type="file" multiple/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="btn-group pull-right" style="padding-left: 5px;"  role="group">
                        <button type="button" class="btn btn-cancel Cancelar"  onclick="window.history.go(-1); return false;">Fechar</button>
                    </div>
                    <div class="btn-group pull-right" role="group">
                        <button type="submit" class="btn btn-success">Enviar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- jQuery -->
<script type="text/javascript" src="../tecnologia/js/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script type="text/javascript" src="../tecnologia/js/bootstrap3/bootstrap.min.js"></script>
<!-- DataTables -->
<script type="text/javascript" src="../tecnologia/js/datatables/datatables.min.js"></script>
<script type="text/javascript" src="../tecnologia/js/datatables/dataTables.bootstrap4.min.js"></script>
<!-- MomentJS -->
<script type="text/javascript" src="../tecnologia/js/momentjs/moment.js"></script>
<script type="text/javascript" src="../tecnologia/js/momentjs/moment-duration-format.js"></script>
<!-- SweetAlert -->
<script type="text/javascript" src="../tecnologia/js/sweetalert/sweetalert.min.js"></script>
<!-- DropZone -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
<script>
    Dropzone.autoDiscover = false;
    Dropzone.prototype.defaultOptions.dictRemoveFile = "Remover Arquivo";
</script>
<!-- jQueryUI -->
<script type="text/javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<!-- jQuery Mask -->
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<!-- Scripts -->

<script src="//d2wy8f7a9ursnm.cloudfront.net/v6/bugsnag.min.js"></script>
<script>window.bugsnagClient = bugsnag('9f6cc1049582acdb30bc5fff5e922e62')</script>

<script>

var dz = null;

    $(".modal-dialog").draggable();

    $("div.dropzone").dropzone({       
        autoProcessQueue: false,
        maxFilesize: 50, // MB
        timeout: 180000,
        uploadMultiple: true,
        url: '../../model/redespacho/GerarFaturas.php',
        addRemoveLinks: true,
        init: function () {
            dz = this;
            this.on('sending', function (file, xhr, formData) {
                var data = $('form').serializeArray();

                $.each(data, function (key, el) {
                    formData.append(el.name, el.value);
                });

                $('input, select, textarea').attr('disabled', "disabled");
                $('button').attr('disabled', "disabled");
                $('button').html('<i class="fas fa-sync fa-spin"></i>');
            });
        },
        success: function (file, response) {
            swal({
                title: "Sucesso!",
                text: "Fatura gerada com sucesso - Fatura nr: " + response,
                icon: "success",                
                button: true
            }).then(function () {
                window.location.href = '/view/redespacho/GerarFatura.php';                                    
            });
        },
        error: function (file, retorno) {
            retorno = JSON.parse(retorno);
            $('input, select, textarea').not('#VALOR').removeAttr('disabled');
            $('button').removeAttr('disabled');
            $('button').html('Enviar');

            bugsnagClient.notify(new Error(retorno.message), {
                beforeSend: function (report) {
                    report.updateMetaData('Dados enviados', {
                        "DADOS": $('#formRelacionamento').serializeArray()
                    })
                }
            });

            swal({
                title: "Oopss!",
                text: "Não foi possível efetuar o procedimento: " + retorno.message,
                icon: "error"
            });

            $.each(dz.files, function (i, file) {
                file.status = Dropzone.QUEUED
            });

        }
    });

    $('form').on('submit', function () {
        if (dz.getQueuedFiles().length === 0) {
            var blob = new Blob();
            blob.upload = {
                'chunked': dz.defaultOptions.chunking
            };
            dz.uploadFile(blob);
        } else {
            dz.processQueue();
        }
        return false;
    });

</script>

</body>

</html>