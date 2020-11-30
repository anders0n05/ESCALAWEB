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
    <title>Vagas disponíveis - Escalatalentos</title>

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
            <div class="topBar">Vagas disponíveis</div>
        </div>

        <div class="container">
            <br><br><br><br><br>
            <div class="erro"></div>
            <table class="vagas">
                <tr>
                    <td><h2>Descrição das vagas</h2></td>
                    <td style="text-align: center;"><h2>Vagas</h2></td>
                    <td style="text-align: center;"><h2>Local</h2></td>
                    <td style="text-align: center;"><h2>Início</h2></td>
                    <td style="text-align: center;"><h2>Término</h2></td>
                    <td colspan="2" style="text-align: center;"></td>
                </tr>
                <tr>
                    <td><span class="vagaSelecionada" value="1">Estágio - setor administrativo</span></td>
                    <td style="text-align: center;"><span>1</span></td>
                    <td style="text-align: center;"><span>Rio do Sul</span></td>
                    <td style="text-align: center;"><span>15/03/2021</span></td>
                    <td style="text-align: center;"><span>15/03/2022</span></td>
                    <td style="text-align: center;"><button value="A VAGA É PARA ESTAGIARIOS" class="detalhesVagas">Mais detalhes</button></td>
                    <td style="text-align: center;"><button value="Estágio - setor administrativo" class="showVaga">Candidatar-se</button></td>
                </tr>
               <tr>
                    <td><span class="vagaSelecionada" value="2">Jovens Profissionais 2021</span></td>
                    <td style="text-align: center;"><span>10</span></td>
                    <td style="text-align: center;"><span>Rio do Sul</span></td>
                    <td style="text-align: center;"><span>15/03/2021</span></td>
                    <td style="text-align: center;"><span>15/03/2022</span></td>
                    <td style="text-align: center;"><button value="A VAGA É PARA JOVENS" class="detalhesVagas">Mais detalhes</button></td>
                    <td style="text-align: center;"><button value="Jovens Profissionais 2021" class="showVaga">Candidatar-se</button></td>
                    <td style="display: none;" class="descricaoVaga" value="A VAGA É PARA JOVENS PROFISSIONAIS"></td>
                </tr>
                <tr>
                    <td colspan="7" class="visualizarVaga" style="padding: 20px;">
                        <p class="descricaoDetalhadaVaga">      
                        </p>
                    </td>
                </tr>
            </table>

            <form method="POST" id="formCurriculoAlterar" class="formularioVaga">
                <input type="text" name="HANDLE" id="HANDLE" value="<?php echo $handleCurriculo; ?>" hidden="true" class="display">    
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <span>Nome</span>
                           <input type="text" class="form-control" id="NOME" name="NOME" value="<?php echo $nomePessoa; ?>" readonly="readonly">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <span>CPF</span>
                            <input type="text" class="form-control" id="CPF" name="CPF" value="<?php echo $cpf; ?>" readonly="readonly">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <span>Vaga selecionada</span>
                            <input type="text" class="form-control" id="VAGASELECIONADA" name="VAGASELECIONADA" value="">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <span>Preencha ou altere suas observações</span>
                            <textarea class="form-control" id="OBSERVACAO" name="OBSERVACAO" value="" rows="4" cols="50" style="height: 200px !important;"><?php echo $observacao;?></textarea>
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
                <div class="row">
                    <div class="col-md-13">
                        <div class="btn-group pull-right" role="group">
                            <button type="submit" class="btn btn-success">Cadastrar</button>
                            <a style="margin-left: 20px;" href="CurriculoListar.php" title="Voltar a listagem do Currículo" class="voltar">Voltar</a>
                        </div>
                    </div>
                </div>
                <br>
            </form>
        </div>    
    </div>
</body>

<script src="../../view/tecnologia/js/metisMenu.min.js"></script>
<script src="../../view/tecnologia/js/custom.js"></script>

</html>
<?php } ?>