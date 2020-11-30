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
    <title>Cadastro de currículos - Escalasoft</title>
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
</head>

<body>
    <div class="sticky-header header-section">
        <div class="container">
            <div class="topBar container">Inserir Currículo</div>
        </div>
    </div>
    <div class="page-content">
    <div class="container">
        <div class="erro"></div>
        <form method="POST" id="formRelacionamento">
            <input type="text" name="HANDLE" id="HANDLE" value="0" hidden="true" class="display">
            <input type="hidden" class="form-control" name="CHAVE" value="<?= Sistema::criarGuid() ?>"/>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <span>Nome*</span>
                        <input type="text" class="form-control" placeholder="Nome" id="NOME" name="NOME"
                               required="required">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <span>CPF*</span>
                        <input type="text" class="form-control" placeholder="Cpf" id="CPF" name="CPF"
                               required="required">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <span>Data e horário*</span>
                        <input type="text" class="form-control" placeholder="Data e horário" id="DATAHORARIO" name="DATAHORARIO" value="<?= date('d/m/Y h:i:s') ?>" readonly="readonly">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <span>Celular*</span>
                        <input type="text" class="form-control" placeholder="Celular" id="CELULAR" name="CELULAR"
                               required="required">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <span>Cidade</span>
                        <select class="form-control" id="CIDADE" name="CIDADE" required="required">
                            <option selected disabled value="">Selecione a Cidade</option>
                            <?php foreach ($cidades as $cidade) { ?>
                                <option name="CIDADE "value="<?= $cidade["HANDLE"] ?>"><?= $cidade["NOME"] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <span>Sua especialidade</span>
                        <select class="form-control" name="ESPECIALIDADE" required="required">
                            <option selected disabled value="">Selecione sua especialidade</option>
                            <?php foreach ($especs as $especialidade) { ?>
                                <option value="<?= $especialidade["HANDLE"] ?>"><?= $especialidade["NOME"] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <span>Estado civil</span>
                        <select class="form-control" name="ESTADOCIVIL" required="required">
                            <option selected disabled value="">Selecione seu estado civil</option>
                            <?php foreach ($estadocivil as $civil) { ?>
                                <option value="<?= $civil["HANDLE"] ?>"><?= $civil["NOME"] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <span>Sexo</span>
                        <select class="form-control" name="SEXO" required="required">
                            <option selected disabled value="">Selecione seu sexo</option>
                            <?php foreach ($sexos as $sexo) { ?>
                                <option value="<?= $sexo["HANDLE"] ?>"><?= $sexo["NOME"] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <span>Data de nascimento</span>
                        <input type="text" class="form-control" placeholder="__/__/____" id="DATANASCIMENTO" name="DATANASCIMENTO">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <span>Telefone</span>
                        <input type="text" class="form-control" placeholder="Telefone" id="TELEFONE" name="TELEFONE"
                               required="required">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <span>Pretensão salarial</span>
                        <input type="text" maxlength="5" class="form-control only-number" placeholder="Apenas números" id="PRETENSAOSALARIAL" name="PRETENSAOSALARIAL"
                               required="required">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <span>Atualizado em</span>
                        <input type="text" class="form-control" placeholder="Atualizado em" id="ATUALIZADOEM" name="ATUALIZADOEM" value="<?= date('d/m/Y h:i:s') ?>" readonly="readonly">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <span>E-mail</span>
                        <input type="text" class="form-control" placeholder="E-mail" id="EMAIL" name="EMAIL"
                               required="required">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <span>Rede Social</span>
                        <input type="text" class="form-control" placeholder="Rede Social" id="REDESOCIAL" name="REDESOCIAL"
                               required="required">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <span>Local vaga desejada</span>
                        <select class="form-control" name="FILIAL" required="required">
                            <option selected disabled value="">Local para a vaga desejada</option>
                            <?php foreach ($filiais as $filial) { ?>
                                <option value="<?= $filial["HANDLE"] ?>"><?= $filial["NOME"] ?></option>
                            <?php } ?>
                        </select>
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
                    <div class="btn-group pull-right" role="group">
                        <button type="submit" class="btn btn-success">Enviar</button>
                    </div>
                </div>
            </div>

        </form>

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
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<!-- Scripts -->

<script src="//d2wy8f7a9ursnm.cloudfront.net/v6/bugsnag.min.js"></script>
<script>window.bugsnagClient = bugsnag('9f6cc1049582acdb30bc5fff5e922e62')</script>

<script type="text/javascript" src="../tecnologia/js/curriculo.js"></script>
</body>

</html>