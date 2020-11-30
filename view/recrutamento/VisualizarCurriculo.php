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
    <title>Visualizar currículos - Escalatalentos</title>

    <script type="text/javascript" src="../tecnologia/js/datatables/datatables.min.js"></script>
    <script type="text/javascript" src="../tecnologia/js/datatables/dataTables.bootstrap4.min.js"></script>

    <link rel="stylesheet" href="../tecnologia/css/bootstrap3/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../tecnologia/css/datatable/datatables.min.css"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css">
    <link rel="stylesheet" type="text/css" href="../tecnologia/css/recrutamento.css"/>
    <link href="../../view/tecnologia/css/bootstrap.css" rel='stylesheet' type='text/css' />
    <link href="../../view/tecnologia/css/style.css" rel='stylesheet' type='text/css' />
    <link href="../../view/tecnologia/css/font-awesome.css" rel="stylesheet"> 
    <link href="../../view/tecnologia/css/material-icons.css" rel="stylesheet">
    <link href="../../view/tecnologia/css/custom.css" rel="stylesheet"> 

    <script src="../tecnologia/js/classie.js"></script>
    <script src="../tecnologia/js/script.js"></script>

    <script src="../../view/tecnologia/js/jquery-1.11.1.min.js"></script>
    <script src="../../view/tecnologia/js/modernizr.custom.js"></script>

    <script type="text/javascript" src="../tecnologia/js/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="../tecnologia/js/bootstrap3/bootstrap.min.js"></script>

    <script type="text/javascript" src="../tecnologia/js/momentjs/moment.js"></script>
    <script type="text/javascript" src="../tecnologia/js/momentjs/moment-duration-format.js"></script>
    <script type="text/javascript" src="../tecnologia/js/sweetalert/sweetalert.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
    <script>
        Dropzone.autoDiscover = false;
        Dropzone.prototype.defaultOptions.dictRemoveFile = "Remover Arquivo";
    </script>
    <script type="text/javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src="//d2wy8f7a9ursnm.cloudfront.net/v6/bugsnag.min.js"></script>
    <script>window.bugsnagClient = bugsnag('9f6cc1049582acdb30bc5fff5e922e62')</script>
    <script type="text/javascript" src="../tecnologia/js/curriculoAlterar.js"></script>
</head>

<body>
    <div class="main-content">
        <div id="loader"></div>
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
            <div class="topBar">Complete ou altere as informações do seu currículo</div>
        </div>

        <div class="container">
            <br><br><br><br>
            <div class="erro"></div>
            <form method="POST" id="formCurriculoAlterar">
                <input type="text" name="HANDLE" id="HANDLE" value="<?php echo $handleCurriculo; ?>" hidden="true" class="display">
                
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <span>Nome*</span>
                           <input type="text" class="form-control" id="NOME" name="NOME" value="<?php echo $nomePessoa; ?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <span>CPF*</span>
                            <input type="text" class="form-control" id="CPF" name="CPF" value="<?php echo $cpf; ?>" readonly="readonly">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <span>Data e horário*</span>
                            <input type="text" class="form-control" id="DATAHORARIO" name="DATAHORARIO" value="<?= date('d/m/Y h:i:s') ?>" readonly="readonly">
                        </div>
                    </div>
                    <div class="col-md-3" style="display: none;">
                        <div class="form-group">
                            <span>Atualizado em</span>
                            <input type="text" class="form-control" placeholder="Atualizado em" id="ATUALIZADOEM" name="ATUALIZADOEM" value="<?= date('d/m/Y h:i:s'); ?>" readonly="readonly">
                        </div>
                    </div>
                    <div class="col-md-3">
                       <div class="form-group">
                            <span>Nível de experiência</span>
                            <select class="form-control" id="NIVELEXPERIENCIA" name="NIVELEXPERIENCIA" required="required">
                                <option selected value="<?php echo $handleTipoCurriculo; ?>"><?php echo $tipoCurriculo; ?></option>
                                <?php foreach ($experiencias as $experiencia) { ?>
                                    <option name="NIVELEXPERIENCIA "value="<?= $experiencia["HANDLE"] ?>"><?= $experiencia["NOME"] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                       <div class="form-group">
                            <span>Cidade*</span>
                            <select class="form-control" id="CIDADE" name="CIDADE" required="required">
                                <option selected value="<?php echo $handleCidade; ?>"><?php echo $cidade; ?></option>
                                <?php foreach ($cidades as $cidade) { ?>
                                    <option name="CIDADE "value="<?= $cidade["HANDLE"] ?>"><?= $cidade["NOME"] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <span>Especialidade*</span>
                            <select class="form-control" name="ESPECIALIDADE" required="required">
                                <option selected value="<?php echo $handleEspecialidade; ?>"><?php echo $especialidade; ?></option>
                                <?php foreach ($especs as $especialidade) { ?>
                                    <option value="<?= $especialidade["HANDLE"] ?>"><?= $especialidade["NOME"] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <span>Estado civil*</span>
                            <select class="form-control" name="ESTADOCIVIL" required="required">
                                <option selected value="<?php echo $handleEstadoCivil; ?>"><?php echo $estadoCivil ?></option>
                                <?php foreach ($estadocivil as $civil) { ?>
                                    <option value="<?= $civil["HANDLE"] ?>"><?= $civil["NOME"] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <span>Sexo*</span>
                            <select class="form-control" name="SEXO" required="required">
                                <option selected value="<?php echo $handleSexo; ?>"><?php echo $sexo; ?></option>
                                <?php foreach ($sexos as $sexo) { ?>
                                    <option value="<?= $sexo["HANDLE"] ?>"><?= $sexo["NOME"] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <span>Data de nascimento*</span>
                            <?php 
                            if ($dataNascimento != null) { ?>
                                <input type="text" class="form-control" id="DATANASCIMENTO" name="DATANASCIMENTO" value="<?php echo date("d/m/Y", strtotime($dataNascimento)); ?>">
                            <?php } else { ?>
                            <input type="text" class="form-control" id="DATANASCIMENTO" name="DATANASCIMENTO" value="">
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <span>Celular*</span>
                            <input type="text" class="form-control" id="CELULAR" name="CELULAR" value="<?php echo $celular; ?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <span>Telefone*</span>
                            <input type="text" class="form-control" id="TELEFONE" name="TELEFONE" value="<?php echo $telefone; ?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <span>Pretensão salarial*</span>
                            <input type="text" maxlength="5" class="form-control only-number" placeholder="Apenas números" id="PRETENSAOSALARIAL" name="PRETENSAOSALARIAL" value="<?php echo floor($pretensaoSalarial);?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <span>E-mail*</span>
                            <input type="text" class="form-control" id="EMAIL" name="EMAIL" value="<?php echo $email; ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <span>Rede Social*</span>
                            <input type="text" class="form-control" id="REDESOCIAL" name="REDESOCIAL" value="<?php echo $redeSocial; ?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <span>Local vaga desejada*</span>
                            <select class="form-control" name="FILIAL" required="required">
                                <?php  
                                    $identifica     = strstr($filial,'-');
                                    $cortaFilial    = substr($identifica, 2);
                                ?>
                                <option selected value="<?php echo $handleFilial; ?>"><?php echo $cortaFilial; ?></option>
                                <?php foreach ($filiais as $filial) { ?>
                                    <?php 
                                    $identificarTexto = strstr($filial["NOME"],'-');
                                    $corteTextoFilial = substr($identificarTexto, 2);
                                    ?>
                                    <option value="<?= $filial["HANDLE"] ?>"><?= $corteTextoFilial; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <span>Preencha ou altere suas observações</span>
                            <textarea class="form-control" id="OBSERVACAO" name="OBSERVACAO" value="" rows="4" cols="50" style="height: 200px !important;"><?php echo $observacao;?></textarea>
                        </div>
                    </div>
                </div>
                    <div class="row">
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

                    <div class="row">

                    <div class="col-md-9">
                           <div class="btn-group pull-right" role="group">
                                <a style="margin-left: 20px;" href="CurriculoListar.php" title="Voltar a listagem do Currículo" class="voltar">Voltar</a>
                            </div>
                        </div>
                        <div class="col-md-13">
                            <div class="btn-group pull-right" role="group">
                                <button type="submit" class="btn btn-success">Gravar</button>
                            </div>
                        </div>


                    </div>

                    <br>
                </div>
            </form>
        </div>    
    </div>
</body>

<script src="../../view/tecnologia/js/metisMenu.min.js"></script>
<script src="../../view/tecnologia/js/custom.js"></script>


</html>
<?php } ?>