<?php
include_once('../../controller/tecnologia/Sistema.php');
require '../../model/recrutamento/getDados.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="../tecnologia/img/favicon.png"/>
    <title>Cadastro de acesso - Escalasoft</title>
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
    <link rel="stylesheet" type="text/css" href="../tecnologia/css/recrutamento.css"/>
    <link href="../tecnologia/css/style.css" rel='stylesheet' type='text/css' />
    <link type="text/css" href="../tecnologia/css/styleCustom.css" rel="stylesheet"/>
    <link href="../tecnologia/css/font-awesome.css" rel="stylesheet"> 
</head>

<body class="fundoAzul" id="bodyFullScreen">
    <div class="main-content">
        <div class="main-page login-page  FlexContainer">
            <div class="erro"></div>
            <img src="../tecnologia/img/logologin.png" class="logologin" alt="Escalasoft tecnologia">
            <br>
            <div class="login-body FlexItem">
                <form method="POST" id="formCurriculoAcesso" style="width: 337px;">
                    <input type="text" name="HANDLE" id="HANDLE" value="0" hidden="true" class="display">
                    <input type="text" hidden="true" id="DATAHORARIO" name="DATAHORARIO" value="<?= date('d/m/Y h:i:s') ?>" class="display">
                    <input type="hidden" class="form-control" name="CHAVE" value="<?= Sistema::criarGuid() ?>"/>

                    <div class="inner-addon left-addon pullBottomLogin">
                        <i class="icone fa fa-user"></i> 
                        <input type="text" class="form-control" placeholder="Nome" id="NOME" name="NOME" required="required">
                    </div>

                    <div class="inner-addon left-addon pullBottomLogin">
                        <i class="icone fa fa-address-card-o"></i> 
                        <input type="text" class="form-control" placeholder="CPF" id="CPF" name="CPF" required="required">
                    </div>

                    <div class="inner-addon left-addon pullBottomLogin">
                        <i class="icone fa fa-envelope"></i> 
                        <input type="text" class="form-control" placeholder="E-mail" id="EMAIL" name="EMAIL" required="required">
                    </div>

                    <div class="inner-addon left-addon pullBottomLogin">
                        <i class="icone fa fa-lock"></i> 
                        <input type="password" class="form-control" placeholder="Senha de acesso" id="SENHAWEB" name="SENHAWEB" required="required">
                    </div>

                        <input type="submit" name="entrar" value="Cadastrar">
                        <a title="Voltar" href="../estrutura/acesso.php" class="botaoVoltar">Voltar</a>
                    <div class="row" style="display: none;">
                        <div class="col-md-12">
                            <span>Anexo</span>
                            <div class="dropzone">
                                <div class="dz-message" data-dz-message>
                                    <span>Clique ou solte arquivos aqui para anexar.</span>
                                </div>
                                <div class="fallback">
                                    <input name="file" type="file" multiple/>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
                </form>
            </div>
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

<script type="text/javascript" src="../tecnologia/js/curriculoAcesso.js"></script>
</body>

</html>