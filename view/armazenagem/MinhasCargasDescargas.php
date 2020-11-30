<?php
include_once('../../controller/tecnologia/Sistema.php');
include_once('../../controller/armazenagem/MinhasCargasDescargasController.php');

if (!isset($_SESSION['usuario']) and !isset($_SESSION['senha'])) {
    header('Location: ../estrutura/login.php?success=F');
} else {
    $connect = Sistema::getConexao();

    $minhasCargasDescargas = new minhasCargasDescargasController($connect);
    $minhasCargasDescargas->montaFiltro();
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

        <link type="text/css" href="resource/minhasCargasDescargas.css" rel="stylesheet">

        <script type="text/javascript" src="resource/minhasCargasDescargas.js"></script>
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
                <div class="topBar">Minhas cargas/descargas</div>
                <div class="topBarRight">
                   
                    <button data-toggle="modal" class="botaoTop" title="Filtrar" onClick="multiselection();" data-target="#FiltroModal"><i class="glyphicon glyphicon-search"></i></button>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="pageContent">
            <?php
            include('MinhasCargasDescargasModalFiltro.php');
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
                    <table id="tableMinhasCargasDescargas" class="table table-striped table-bordered" border="0">
                        <thead>
                        <tr class="Noactivetr">
                            <th>&nbsp;</th> 
                            <th>Número</th>
                            <th>Filial</th>
                            <th>Nr pedido</th>
                            <th>Nr controle</th>
                            <th>Nr ordem</th>
                            <th>Tipo</th>
                            <th>Processo</th>
                            <th>Data</th>
                            <th>Cliente</th>
                            <th>Transportadora</th>
                            <th>Quantidade</th>
                            <th>Volume</th>
                            <th>Peso líquido</th>
                            <th>Peso bruto</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        Sistema::iniciaCarregando();

                        $rows = $minhasCargasDescargas->getRegistro();

                        echo join(' ', $rows['DADOS']);
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="desktopHide">
                <?php
                include_once('MinhasCargasDescargasTabelaMobile.php');
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