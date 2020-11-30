<?php
include_once('../../controller/tecnologia/Sistema.php');
require '../../model/relacionamento/listarDados.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="../tecnologia/img/favicon.png" />
    <title>Listagem do Ticket #<?= $dadosOrdem["HANDLE"] ?></title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="../tecnologia/css/bootstrap3/bootstrap.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="../tecnologia/css/datatable/datatables.min.css" />
    <!-- DropZone -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="../tecnologia/css/relacionamentoListar.css" />
</head>

<body>
    <div class="sticky-header header-section">
        <div class="container">
            <div class="topBar container">Listagem do Ticket #<?= $dadosOrdem["HANDLE"] ?></div>
        </div>
    </div>
    <div class="page-content">
        <div class="container">
            <input type="text" class="form-control hidden" disabled="disabled" value="<?= $dadosOrdem["HANDLE"] ?>" name="ATENDIMENTO">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <span>Nome</span>
                        <input type="text" class="form-control" placeholder="Nome" id="NOME" name="NOME" disabled="disabled" value="<?= $dadosOrdem["SOLICITANTE"] ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <span>E-mail</span>
                        <input type="email" class="form-control" placeholder="E-mail" name="EMAIL" disabled="disabled" value="<?= $dadosOrdem["EMAIL"] ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <span>Telefone</span>
                        <input type="text" class="form-control" placeholder="Telefone"  name="TELEFONE" disabled="disabled" value="<?= $dadosOrdem["TELEFONE"] ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <span>Ticket</span>
                        <input type="text" class="form-control" disabled="disabled" value="<?= $dadosOrdem["HANDLE"] ?>">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <span>Abertura</span>
                        <input type="text" class="form-control" disabled="disabled" value="<?= $dadosOrdem["DATA"] ?>">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <span>Situação atual*</span>
                        <input type="text" class="form-control" disabled="disabled" value="<?= $dadosOrdem["STATUS"] ?>">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <span>Tipo*</span>
                        <input type="text" class="form-control" disabled="disabled" value="<?= $dadosOrdem["TIPO"] ?>">
                        <input type="text" class="form-control hidden" disabled="disabled" value="<?= $dadosOrdem["TIPOHANDLE"] ?>" name="TIPO">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <span>Marca do Equipamento</span>
                        <input type="text" class="form-control" disabled="disabled" value="<?= $dadosMarcaEquipamento["NOME"] ?>">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <span>Modelo do Equipamento</span>
                        <input type="text" class="form-control" disabled="disabled" value="<?= $dadosModeloEquipamento["NOME"] ?>">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <span>Nro de Série</span>
                        <input type="text" class="form-control" disabled="disabled" value="<?= $dadosNRSerieEquipamento["CONTEUDO"] ?>">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <span>Nro da NF-e</span>
                        <input type="text" class="form-control" disabled="disabled" value="<?= $dadosOrdem["NFE"] ?>">
                    </div>
                </div>
            </div>
            <hr/>
            <div class="row">
                <div class="col-md-12">
                    <h3>Histórico</h3>
                </div>  
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="btn-group pull-right" role="group">
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target=".responderModal<?= $gambiaStatusModal; ?>">Responder</button>
                    </div>
                </div>
            </div>
            <div class="historico">
                <?php foreach($relacionamentos as $relacionamento){ ?>
                    <hr/>
                    <div class="row">
                        <div class="col-md-12">
                            <b>Data/hora:</b> <span><?= $relacionamento["DATA"]?></span>
                            <b>Canal:</b> <span><?= $relacionamento["CANAL"] ?></span>
                            <b>Tipo de relacionamento:</b> <span><?= $relacionamento["TIPO"] ?></span>
                            <?php if($relacionamento["ANEXOS"]){ ?>
                                <div class="anexos">
                                <?php
                                    foreach($relacionamento["ANEXOS"] as $anexo){
                                        echo "<span><a target='_NEW' href='../../model/relacionamento/getAnexo.php?atendimento=" . $dadosOrdem["CHAVE"] ."&anexo=". $anexo["ANEXO"] ."'>" . $anexo["ANEXO"] . "</a></span>; ";
                                    }
                                ?>
                                </div>
                            <?php } ?>
                            <div class="detalhamento">
                                <?= $relacionamento["DESCRICAO"]?>
                            </div>
                        </div>
                    </div>
                <?php } ?>   
            </div>
            <hr/>
        </div>
    </div>

    <!-- MODAL DE RESPOSTA -->
    <div class="modal fade bs-example-modal-lg responderModal1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form>
                    <input type="text" class="form-control hidden" name="NOME" value="<?= $dadosOrdem["SOLICITANTE"] ?>">
                    <input type="text" class="form-control hidden" name="EMAIL" value="<?= $dadosOrdem["EMAIL"] ?>">
                    <input type="text" class="form-control hidden" name="TELEFONE" value="<?= $dadosOrdem["TELEFONE"] ?>">
                    <input type="text" class="form-control hidden" name="TIPO" value="<?= $dadosOrdem["TIPOHANDLE"] ?>" >
                    <input type="text" class="form-control hidden" name="ATENDIMENTO" value="<?= $dadosOrdem["HANDLE"] ?>" >
                    <input type="hidden" class="form-control" name="CHAVE" value="<?= Sistema::criarGuid() ?>"/>
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Responder ticket</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <span>Resposta*</span>
                                    <textarea class="form-control" rows="4" placeholder="Resposta" required="required" name="RESPOSTA"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <span>Anexos</span>
                                <div class="dropzone">
                                    <div class="dz-message" data-dz-message><span>Clique ou solte arquivos aqui para anexar.</span></div>
                                    <div class="fallback">
                                        <input name="file" type="file" multiple />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-success">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL DE INCLUIR NOVO -->
    <div class="modal fade bs-example-modal-lg responderModal2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Ticket encerrado</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <p>Este atendimento está encerrado, um novo atendimento pode ser aberto clicando no botão incluir novo.</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                        <button type="button" class="btn btn-success"><a style="text-decoration: none; color: #fff;" href="RelacionamentoClienteAgf.php">Incluir novo</a></button>
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
    <!-- FontAwessome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
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
    
    <script type="text/javascript" src="../tecnologia/js/relacionamentoListar.js"></script>
</body>
</html>