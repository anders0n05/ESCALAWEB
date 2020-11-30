<?php
include_once('../../controller/tecnologia/Sistema.php');

date_default_timezone_set('America/Sao_Paulo');

if (!isset($_SESSION['usuario']) and !isset($_SESSION['senha'])) {
    header('Location: ../../view/estrutura/login.php?success=F');
}
else {
    $connect = Sistema::getConexao();
    $handleMinhaViagem = $_GET["viagem"];
    $handleItem = $_GET['item'];

    if (($handleMinhaViagem == 0) || (is_null($handleMinhaViagem))){
        header('Location: ../../view/operacional/MinhaViagemConsulta.php');
    } 
    else if (($handleItem == 0) || (is_null($handleItem))){
        header('Location: ../../view/operacional/MinhaViagemVisualizar.php?viagem='+$handleMinhaViagem);
    }

    $sql = "SELECT A.NUMERO,
                    B.APELIDO LOCALCOLETA, 
                    D.NOME TIPOLOGRADOUROCOLETA, 
                    C.LOGRADOURO LOGRADOUROCOLETA, 
                    C.NUMERO NUMEROCOLETA, 
                    C.COMPLEMENTO COMPLEMENTOCOLETA, 
                    E.NOME MUNICIPIOCOLETA, 
                    F.SIGLA ESTADOCOLETA, 
                    G.APELIDO LOCALENTREGA, 
                    I.NOME TIPOLOGRADOUROENTREGA, 
                    H.LOGRADOURO LOGRADOUROENTREGA, 
                    H.NUMERO NUMEROENTREGA, 
                    H.COMPLEMENTO COMPLEMENTOENTREGA, 
                    J.NOME MUNICIPIOENTREGA, 
                    K.SIGLA ESTADOENTREGA,
                    A.STATUS, 
                    A.HANDLE,
                    A.VALORMERCADORIA,
                    A.PESO,
                    A.QUANTIDADEVOLUME VOLUMES
                FROM OP_ORDEM A
                LEFT JOIN MS_PESSOA B ON B.HANDLE = A.LOCALCOLETA
                LEFT JOIN MS_PESSOAENDERECO C ON C.HANDLE = A.ENDERECOLOCALCOLETA
                LEFT JOIN MS_TIPOLOGRADOURO D ON D.HANDLE = C.TIPOLOGRADOURO
                LEFT JOIN MS_MUNICIPIO E ON E.HANDLE = C.MUNICIPIO
                LEFT JOIN MS_ESTADO F ON F.HANDLE = C.ESTADO
                LEFT JOIN MS_PESSOA G ON G.HANDLE = A.LOCALENTREGA
                LEFT JOIN MS_PESSOAENDERECO H ON H.HANDLE = A.ENDERECOLOCALENTREGA
                LEFT JOIN MS_TIPOLOGRADOURO I ON I.HANDLE = H.TIPOLOGRADOURO
                LEFT JOIN MS_MUNICIPIO J ON J.HANDLE = H.MUNICIPIO
                LEFT JOIN MS_ESTADO K ON K.HANDLE = H.ESTADO
                INNER JOIN OP_VIAGEMROMANEIOITEM A2 ON A2.ORDEM = A.HANDLE
                WHERE A2.HANDLE = '$handleItem'";
    $query = $connect->prepare($sql);
    $query->execute();
    $dataSet = $query->fetch(PDO::FETCH_ASSOC);

    $numero = $dataSet['NUMERO'];
    $localColeta = $dataSet['LOCALCOLETA'];
    $localColetaEndereco = $dataSet['TIPOLOGRADOUROCOLETA']." ".
                           $dataSet['LOGRADOUROCOLETA'].", ".
                           $dataSet['NUMEROCOLETA']." - ".
                           $dataSet['COMPLEMENTOCOLETA'].($dataSet['COMPLEMENTOCOLETA'] != "" ? " - " : "").
                           $dataSet['MUNICIPIOCOLETA']."/".
                           $dataSet['ESTADOCOLETA'];

    $localEntrega = $dataSet['LOCALENTREGA'];
    $localEntregaEndereco = $dataSet['TIPOLOGRADOUROENTREGA']." ".
                            $dataSet['LOGRADOUROENTREGA'].", ".
                            $dataSet['NUMEROENTREGA']." - ".
                            $dataSet['COMPLEMENTOENTREGA'].($dataSet['COMPLEMENTOENTREGA'] != "" ? " - " : "").
                            $dataSet['MUNICIPIOENTREGA']."/".
                            $dataSet['ESTADOENTREGA'];

    $valorMercadoria = $dataSet['VALORMERCADORIA'];
    $peso = $dataSet['PESO'];
    $volumes = $dataSet['VOLUMES'];

    ?>
    <!DOCTYPE HTML>
    <html>
        <head>
            <title>Escalasoft</title>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <link rel="icon" type="image/png" href="../tecnologia/img/favicon.png" />
            <!-- Bootstrap Core CSS -->
            <!-- <link href="../tecnologia/css/bootstrap.css" rel='stylesheet' type='text/css' /> -->
            <link href="../tecnologia/css/bootstrap3/bootstrap.min.css" rel='stylesheet' type='text/css' />
            <!-- Custom CSS -->
            <link href="../tecnologia/css/style.css" rel='stylesheet' type='text/css' />
            <!-- font CSS -->
            <!-- font-awesome icons -->
            <link href="../tecnologia/css/font-awesome.css" rel="stylesheet"> 
            <!-- //font-awesome icons -->
            <!-- material icons -->
            <link href="../../view/tecnologia/css/material-icons.css" rel="stylesheet"> 
            <!-- //material icons -->
            <!-- js-->
            <!-- <script src="../tecnologia/js/jquery-1.11.1.min.js"></script> -->
            <!-- jQuery -->
            <script type="text/javascript" src="../tecnologia/js/jquery/jquery.min.js"></script>
            <script src="../tecnologia/js/modernizr.custom.js"></script>
            <!--animate-->
            <link href="../tecnologia/css/animate.css" rel="stylesheet" type="text/css" media="all">
            <script src="../tecnologia/js/wow.min.js"></script>
            <script>
                new WOW().init();
            </script>
            <!--//end-animate-->    
            <!-- chart -->
            <script src="../tecnologia/js/Chart.js"></script>
            <!-- //chart -->
            <!--Calendario-->
            <link rel="stylesheet" href="../tecnologia/css/clndr.css" type="text/css" />
            <script src="../tecnologia/js/underscore-min.js" type="text/javascript"></script>
            <script src= "../tecnologia/js/moment-2.2.1.js" type="text/javascript"></script>
            <script src="../tecnologia/js/clndr.js" type="text/javascript"></script>
            <script src="../tecnologia/js/site.js" type="text/javascript"></script>
            <!--End Calendario-->
            <!-- Menu Lateral -->
            <script src="../tecnologia/js/metisMenu.min.js"></script>
            <script src="../tecnologia/js/custom.js"></script>
            <link href="../tecnologia/css/custom.css" rel="stylesheet">
            <!--//Menu Lateral-->
            <!-- Custom -->
            <script type="text/javascript" src="../tecnologia/js/jquery-ui.js"></script>
            <script type="text/javascript" src="../tecnologia/js/scriptEtapaPedido.js"></script>
            <script type="text/javascript" src="../tecnologia/js/bootbox.js"></script>
            <link type="text/css" href="../tecnologia/css/jquery-ui.css" rel="stylesheet"/>
            <link type="text/css" href="../tecnologia/css/styleCustom.css" rel="stylesheet"/>
            <link type="text/css" href="../../view/tecnologia/css/jquery.multiselect.css" rel="stylesheet"/>
            <script type="text/javascript" src="../../view/tecnologia/js/jquery.multiselect.js"></script>
            <script type="text/javascript" src="../../view/tecnologia/js/blockUI.js"></script>
            <!--// End Custom -->
            <!-- shortTable -->
            <link href="../../view/tecnologia/css/theme.bootstrap_3.min.css" rel="stylesheet">
            <script src="../../view/tecnologia/js/jquery.tablesorter.js"></script>
            <script src="../../view/tecnologia/js/jquery.tablesorter.widgets.js"></script>

            <link href="../../view/tecnologia/css/TabelasPadrao.css" rel="stylesheet">
            <!--// End shortTable -->
            <style>
                #bodyMinhaOrdem{
                    overflow: hidden;
                }

                .liBarRight button{
                    width: 100%;
                    margin: 0px !important;
                    padding-top: 0px !important;
                    padding-bottom: 1px !important;
                }

                #FormOrdem{
                    color:#808080;
                }

                #OrdemItem{
                    width:100%;
                    height:350px;
                    overflow-y: scroll;  
                }

                th{
                    font-weight: normal !important;
                }

                .selected{
                    background-color: #2b9bcb !important;
                }    
                
                .floatRigth{
                    float:right;
                }

                #stats{
                    text-align:center;
                    color:#c94c4c;
                    font-weight:bold;
                }
                
                .bold{
                    font-weight:bold;
                }

                .textoDestacado{
                    color:#616161;
                    font-weight:bold;
                }

                .fontSize1em{
                    font-size:1em;
                }

                .fontSize13em{
                    font-size:1.3em;
                }

                input[disabled], select[disabled]{
                    cursor: default !important;
                }

                thead{
                    background: #e9e9e9;
                }

                .dataTables_wrapper {
                    margin-top: -30px;
                    margin-bottom: -10px;
                }

                .panel-body{
                    padding: 0 !important;
                }
                
                .container{
                    margin-top: 0px;
                }

                .form-control{
                    padding: 6px 6px !important;
                }

                .ativo{
                    color:green;
                }

                .header{
                    margin-top: -10px;
                    font-weight:bold;
                }

                .col-sm-12{
                    margin: 0px !important;
                    padding: 0px !important;
                }

                hr {
                    display: block;
                    margin-top: 0.2em;
                    margin-bottom: 0.2em;
                    margin-left: auto;
                    margin-right: auto;
                    border-style: inset;
                    border-width: 0px;
                }

                .right{
                    text-align:right !important;
                    width: 100% !important;
                    padding-right: 15px;
                    padding-left: 15px;
                }

                /* width */
                ::-webkit-scrollbar {
                width: 5px;
                }

                /* Track */
                ::-webkit-scrollbar-track {
                box-shadow: inset 0 0 5px grey; 
                border-radius: 10px;
                }
                
                /* Handle */
                ::-webkit-scrollbar-thumb {
                background: gray; 
                border-radius: 10px;
                }

                /* Handle on hover */
                ::-webkit-scrollbar-thumb:hover {
                background: black; 
                }

                @media screen and (max-width: 767px) {
                    .right{
                        padding-top: 10px;
                        padding: 5px !important;
                        float: inherit !important;
                    }
                    
                .col-lg-1,.col-lg-10,.col-lg-11,.col-lg-12,.col-lg-2,.col-lg-3,.col-lg-4,.col-lg-5,.col-lg-6,.col-lg-7,.col-lg-8,
                .col-lg-9,.col-md-1,.col-md-10,.col-md-11,.col-md-12,.col-md-2,.col-md-3,.col-md-4,.col-md-5,.col-md-6,.col-md-7,
                .col-md-8,.col-md-9,.col-sm-1,.col-sm-10,.col-sm-11,.col-sm-12,.col-sm-2,.col-sm-3,.col-sm-4,.col-sm-5,.col-sm-6,
                .col-sm-7,.col-sm-8,.col-sm-9,.col-xs-1,.col-xs-10,.col-xs-11,.col-xs-12,.col-xs-2,.col-xs-3,.col-xs-4,.col-xs-5,
                .col-xs-6,.col-xs-7,.col-xs-8,.col-xs-9 {
                        padding-right: 5px;
                        padding-left: 5px;
                    }
                }
            </style>
            <script>
                function FecharOnClick(){
                    window.location.href = "../../view/operacional/MinhaViagemVisualizar.php?viagem="+<?= $handleMinhaViagem ?>;
                }
            </script>
        </head> 
        <body class="cbp-spmenu-push" id="bodyMinhaOrdem">
            <div id="loader"></div>
            <div class="main-content">
                <!--left-fixed -navigation-->
                <div class=" sidebar" role="navigation">
                    <div class="navbar-collapse">
                        <nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
                            <?php include('../../view/estrutura/menu.php') ?>
                        </nav>
                    </div>
                </div>
                
                <!--left-fixed -navigation-->
                <!-- header-starts -->
                <div class="sticky-header header-section ">
                    <!--toggle button start-->
                    <button id="showLeftPush"><i class="fa fa-bars"></i></button>
                    <!--toggle button end-->
                    <div class="topBar"><h3 class="bold">Ordem de frete <?= $numero ?></h3></div>

                    <!--
                        <div class="topBarRight">
                        <button type="button" class="btn botaoTop dropdown-toggle" role="button" aria-expanded="false" data-toggle="dropdown"><i class="material-icons">&#xE5D4;</i></button>
                        <ul class="dropdown-menu dropdown-menu-right" role="menu">                            
                            <li class="liBarRight"><button name="importarOriginario" class="btn btn-primary btn-sm" type="button" id="importarOriginario">Importar documento originário</button></li>
                        </ul>
                    </div>
                    --> 
                </div>
                <div class="clearfix"> </div>	
            </div>
            <!-- //header-ends -->
            <!-- main content start-->   
            <div class="pageContent">
                <div class="container">
                    <form id="FormOrdem">
                        <input type="hidden" class="form-control" id="HANDLE" value="<?= $handleItem ?>">
                                                
                        <hr>
                        
                        <div class="form-row">
                            <div class="col-md-12 fontSize13em textoDestacado"><?= "Local de coleta: "; ?></div>
                            <div class="col-md-12 fontSize1em textoDestacado"><?= $localColeta; ?></div>
                            <div class="col-md-12 fontSize1em"><?= $localColetaEndereco; ?></div>
                        </div>

                        <hr>
                        <hr>

                        <div class="form-row">
                            <div class="col-md-12 fontSize13em textoDestacado"><?= "Local de entrega: "; ?></div>
                            <div class="col-md-12 fontSize1em textoDestacado"><?= $localEntrega; ?></div>
                            <div class="col-md-12 fontSize1em"><?= $localEntregaEndereco; ?></div>
                        </div>

                        <hr>
                        <hr>

                        <table>
                            <tr>
                                <td class="col-md-4 textoDestacado fontSize13em">Valor mercadoria</td>
                                <td class="col-md-4 textoDestacado fontSize13em">Peso</td>
                                <td class="col-md-4 textoDestacado fontSize13em">Volume</td>
                            </tr>
                            <tr>
                                <td class="col-md-4 fontSize1em"><?= $valorMercadoria; ?></td>
                                <td class="col-md-4 fontSize1em"><?= $peso; ?></td>
                                <td class="col-md-4 fontSize1em"><?= $volumes; ?></td>
                            </tr>
                        </table>

                        <hr>
                        <hr>

                        <div class="col-md-12 right">
                            <button type="button" class="btn btn-default btnFechar" onclick="FecharOnClick()">Fechar</button>
                        </div>
                    </form>
                    
                </div>         
            </div> 
                    
            <!-- Classie -->
            <script src="../tecnologia/js/classie.js"></script>
            <!--scrolling js-->
            <script src="../tecnologia/js/jquery.nicescroll.js"></script>
            <script src="../tecnologia/js/script.js"></script>
            <!--//scrolling js-->
            <!-- Bootstrap Core JavaScript -->
            <!-- <script src="../tecnologia/js/bootstrap.js"></script> -->
            <script src="../tecnologia/js/bootstrap.js"></script>
            
            <!-- jQuery Mask -->
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
            <!-- DataTables -->
            <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.10.18/r-2.2.2/datatables.min.css"/>
            <script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.18/r-2.2.2/datatables.min.js"></script>
            <!-- SweetAlert -->
            <script type="text/javascript" src="../tecnologia/js/sweetalert/sweetalert.min.js"></script>

            <script src="//d2wy8f7a9ursnm.cloudfront.net/v6/bugsnag.min.js"></script>
            <script>window.bugsnagClient = bugsnag('9f6cc1049582acdb30bc5fff5e922e62')</script>
        </body>
    </html>

    <?php
}