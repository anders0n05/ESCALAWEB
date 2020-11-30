<?php
include_once('../../controller/tecnologia/Sistema.php');

if((!isset($_SESSION['CPF'])) and (!isset($_SESSION['SENHAWEB']))) {
    header('Location: ../../view/estrutura/acesso.php?success=F');
} else {

require '../../model/recrutamento/getDados.php';

$curriculoHandle = Sistema::getGet('handle');

include_once('../../model/recrutamento/retornoVisualizarCurriculo.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="../tecnologia/img/favicon.png"/>
    <title>Visualizar currículos - Escalasoft</title>
    <link rel="stylesheet" href="../tecnologia/css/bootstrap3/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../tecnologia/css/datatable/datatables.min.css"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
          integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css">
    <link rel="stylesheet" type="text/css" href="../tecnologia/css/recrutamento.css"/>
    <link href="../../view/tecnologia/css/bootstrap.css" rel='stylesheet' type='text/css' />
    <link href="../../view/tecnologia/css/style.css" rel='stylesheet' type='text/css' />
    <link href="../../view/tecnologia/css/font-awesome.css" rel="stylesheet"> 
    <script src="../../view/tecnologia/js/jquery-1.11.1.min.js"></script>
    <script src="../../view/tecnologia/js/modernizr.custom.js"></script>
    <script src="../tecnologia/js/classie.js"></script>
    <script src="../tecnologia/js/script.js"></script>
</head>

<body class="cbp-spmenu-push" id="bodyFullScreen">
    <div id="loader"></div>
    <div class="main-content">
        <div class=" sidebar" role="navigation">
            <div class="navbar-collapse">
                <nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
                    <?php
                        include('../../view/estrutura/menuCurriculo.php');
                    ?>
                </nav>
            </div>
        </div>
            
        <div class="sticky-header header-section ">
            <button class="btn" id="showLeftPush"><i class="fa fa-bars"></i></button>
            <div class="topBar">Alterar senha de acesso </div>
        </div>

        <div class="container">
            <br><br><br><br>
            <div class="erro"></div>
            <br><br>
            <form method="POST" id="formCurriculoAlterarSenha">
                <input type="text" name="HANDLE" id="HANDLE" value="<?php echo $handleCurriculo; ?>" hidden="true" class="display">
                <div class="row" style="margin: 0 auto; max-width: 570px;">
                    <div class="col-md-12">
                        <div class="form-group">
                            <span>Nome</span>
                            <input type="text" class="form-control" id="NOME" name="NOME" value="<?php echo $nomePessoa; ?>" readonly="readonly">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <span>CPF</span>
                            <input type="text" class="form-control" id="CPF" name="CPF" value="<?php echo $cpf; ?>" readonly="readonly">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <span>Senha atual</span>
                            <input type="password" class="form-control" id="SENHAATUAL" name="SENHAATUAL" value="" required="true">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <span>Nova senha</span>
                            <input type="password" class="form-control" id="SENHAWEB" name="SENHAWEB" value="" required="true">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <span>Confirmar nova senha</span>
                            <input type="password" class="form-control" id="NOVASENHACONFIRMACAO" name="NOVASENHACONFIRMACAO" value="" required="true">
                        </div>
                    </div>
                </div>
                <div class="row" style="display: none;">
                    <div class="col-md-12">
                        <span>Anexo</span>
                        <div class="dropzone">
                            <div class="dz-message" data-dz-message>
                                <span>Clique ou solte arquivos aqui para anexar.</span>
                            </div>
                            <div class="fallback">
                                <input name="file" type="file" value="file" multiple/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin: 0 auto; width: 59%; float: left; margin: 20px 0 20px 0;">
                    <div class="btn-group pull-right" role="group">
                        <button type="submit" class="btn btn-success">Enviar</button>
                    </div>
                </div>

                <div class="row" style="margin: 0 auto; width: 59%; float: left; margin: 0 0 20px 0;">
                   <div class="btn-group pull-right" role="group">
                        <a href="CurriculoListar.php" title="Voltar a listagem do Currículo" class="voltar">Voltar</a>
                    </div>
                </div>  
                    <br>
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
<!-- Scripts -->
<script src="//d2wy8f7a9ursnm.cloudfront.net/v6/bugsnag.min.js"></script>
<script>window.bugsnagClient = bugsnag('9f6cc1049582acdb30bc5fff5e922e62')</script>
<script type="text/javascript" src="../tecnologia/js/curriculoAlterarSenha.js"></script>
<script src="../tecnologia/js/jquery.nicescroll.js"></script>
<script src="../tecnologia/js/bootstrap.js"></script>
<!-- Menu Lateral -->
<script src="../../view/tecnologia/js/metisMenu.min.js"></script>
<script src="../../view/tecnologia/js/custom.js"></script>
<link href="../../view/tecnologia/css/custom.css" rel="stylesheet">
<!--//Menu Lateral-->
</body>

</html>
<?php } ?>