<?php
include_once('../../controller/tecnologia/Sistema.php');
require '../../model/redespacho/getDados.php';
date_default_timezone_set('America/Sao_Paulo');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="../tecnologia/img/favicon.png"/>
    <title>Efetuar entrega</title>
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

<body>
<div class="sticky-header header-section">
    <div class="container">
        <div class="topBar container">Efetuar entrega</div>
    </div>
</div>
<div class="page-content">
    <div class="container">
        <div class="erro"></div>
        <form method="POST" id="formEntrega">
            <input type="hidden" class="form-control" name="CHAVE" value="<?= Sistema::criarGuid() ?>"/>
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <span>Data</span>
                        <input type="text" class="form-control datahora" id="DATA" name="DATA" value="<?= date('d/m/Y H:i') ?>">
                        <input type="text" class="form-control" id="HANDLE" style="display: none;" name="HANDLE" value="<?= $_GET["documento"]; ?>">                                                                      
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <span>Tipo*</span>
                        <select class="form-control" name="TIPO" required="required">
                            <option selected disabled value="">Selecione...</option>
                            <?php foreach ($tiposEntrega as $tipo) { ?>
                                <option value="<?= $tipo["HANDLE"] ?>"><?= $tipo["NOME"] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <span>Responsável*</span>
                        <select class="form-control" name="RESPONSAVEL" required="required">
                            <option selected disabled value="">Selecione...</option>
                            <?php foreach ($responsavel as $responsavel) { ?>
                                <option value="<?= $responsavel["HANDLE"] ?>"><?= $responsavel["NOME"] ?></option>
                            <?php } ?>
                        </select>
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

<script type="text/javascript" src="../tecnologia/js/redespacho/redespacho.js"></script>
</body>

</html>