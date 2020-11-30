<?php
include_once('../../controller/tecnologia/Sistema.php');
include_once('../../controller/armazenagem/EstoqueArmazemController.php');

if (!isset($_SESSION['usuario']) and !isset($_SESSION['senha'])) {
    header('Location: ../estrutura/login.php?success=F');
} else {
    $connect = Sistema::getConexao();

    $estoqueArmazem = new EstoqueArmazemController($connect);
    $estoqueArmazem->montaFiltro();
    ?>
    <!DOCTYPE HTML>
    <html>
    <head>
        <title>Escalasoft</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>


        <?php
        include_once('../tecnologia/importCSS.php');
        include_once('../tecnologia/importJavascript.php');
        ?>

        <link type="text/css" href="resource/estoqueArmazem.css" rel="stylesheet">

        <script type="text/javascript" src="resource/estoqueArmazem.js"></script>
    </head>
    <body class="cbp-spmenu-push" id="bodyFullScreen">
    <div>
        <div id="loader"></div>
        <div class="main-content">
            <div class=" sidebar" role="navigation">
                <div class="navbar-collapse">
                    <nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
                        <?php
                        include('../estrutura/menu.php');
                        ?>
                    </nav>
                </div>
            </div>
            <div class="sticky-header header-section ">
                <button id="showLeftPush"><i class="fa fa-bars"></i></button>
                <div class="topBar">Estoque armazém</div>
                <div class="topBarRight">
                    <!--                            <button type="button" class="btn botaoTop dropdown-toggle" role="button" aria-expanded="false" id="dropdownMenuButton" data-toggle="dropdown"><i class="material-icons">&#xE5D4;</i></button>-->
                    <!--                            <ul id="columnSelector" class="list-group checked-list-box dropdown-menu dropdown-menu-right keep-open">-->
                    <!--                                <li class="list-group-item" ind-column="3">Natureza de mercadoria</li>-->
                    <!--                                <li class="list-group-item" ind-column="4">Cliente</li>-->
                    <!--                                <li class="list-group-item" ind-column="5">Nota Fiscal</li>-->
                    <!--                                <li class="list-group-item" ind-column="6">Data emissão</li>-->
                    <!--                                <li class="list-group-item" ind-column="7">Nr pedido</li>-->
                    <!--                                <li class="list-group-item" ind-column="8">Lote</li>-->
                    <!--                                <li class="list-group-item" ind-column="9">Validade</li>-->
                    <!--                                <li class="list-group-item" ind-column="10">Unidade</li>-->
                    <!--                                <li class="list-group-item-button">-->
                    <!--                                    <button class="botaoBranco pullTop">Ok</button>-->
                    <!--                                    <button class="botaoBranco pullTop" onclick="limparColunasExibir(event)">Limpar</button>-->
                    <!--                                </li>-->
                    <!--                            </ul>                       -->
                    <button data-toggle="modal" class="botaoTop" title="Filtrar" onClick="multiselection();" data-target="#FiltroModal"><i class="glyphicon glyphicon-search"></i></button>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="pageContent">
            <?php
            include('EstoqueArmazemModalFiltro.php');
            ?>
            <div id="registroNaoEncontrato" style="display: none;">
                <div class="alert alert-warning" style="margin-bottom: 0;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>Atenção: </strong> Não encontramos registros a serem exibidos!
                </div>
            </div>
            <div class="table-responsive mobileHide">
                <div class="larguraInteira">
                    <table id="tableEstoqueArmazem" class="table table-striped table-bordered" border="0">
                        <thead>
                        <tr class="Noactivetr">
                            <th>Produto</th>
                            <th>Descrição do produto</th>
                            <th>Lote</th>
                            <th>Validade</th>
                            <th>Fabricação</th>
                            <th>Nr Série</th>
                            <th>Nr Documento</th>
                            <th>Nr pedido</th>
                            <th>Unitização</th>
                            <th>Endereço</th>
                            <th>Disponível</th>
                            <th>Reservado</th>
                            <th>Bloqueado</th>
                            <th>Total</th>
                            <th>Peso bruto</th>
                            <th>Valor mercadoria</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        Sistema::iniciaCarregando();

                        $rows = $estoqueArmazem->getRegistro();

                        echo join(' ', $rows['DADOS']);
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="desktopHide">
                <?php
                include_once('EstoqueArmazemTabelaMobile.php');
                ?>
            </div>
            <div class="footerFixed mobileHide">
                <div class="col-xs-1">
                    <button type="button" class="span">&nbsp;</button>
                </div>
                <div class="col-xs-11">
                    <div class="right">

                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <script src="../tecnologia/js/classie.js"></script>
    <script src="../tecnologia/js/jquery.nicescroll.js"></script>
    <script src="../tecnologia/js/script.js"></script>
    <script src="../tecnologia/js/bootstrap.js"></script>
    </body>
    </html>
    <?php
}