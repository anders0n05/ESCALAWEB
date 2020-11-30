<?php
include_once('../../controller/tecnologia/Sistema.php');

date_default_timezone_set('America/Sao_Paulo');

if (!isset($_SESSION['usuario']) and !isset($_SESSION['senha'])) {
    header('Location: ../../view/estrutura/login.php?success=F');
}
else {
    $connect = Sistema::getConexao();
    $handleMinhaViagem = $_GET["viagem"];

    if (($handleMinhaViagem == 0) || (is_null($handleMinhaViagem))){
        header('Location: ../../view/operacional/MinhaViagemConsulta.php');
    }        

    ?>
    <!DOCTYPE HTML>
    <html>
        <head>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>



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
            <!--<script type="text/javascript" src="../tecnologia/js/ordemvenda/OrdemVendaListarFuncoes.js"></script>
            <!--// End shortTable -->
            <style>
                #bodyMinhaDespesa{
                    overflow: hidden;
                }

                #FormDespesa{
                    color:#808080;
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

                .fontSize1em{
                    font-size:1.1em;
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
                    
                    .col-lg-1,.col-lg-10,.col-lg-11,.col-lg-12,.col-lg-2,.col-lg-3,.col-lg-4,.col-lg-5,.col-lg-6,.col-lg-7,.col-lg-8,.col-lg-9,
                    .col-md-1,.col-md-10,.col-md-11,.col-md-12,.col-md-2,.col-md-3,.col-md-4,.col-md-5,.col-md-6,.col-md-7,.col-md-8,.col-md-9,
                    .col-sm-1,.col-sm-10,.col-sm-11,.col-sm-12,.col-sm-2,.col-sm-3,.col-sm-4,.col-sm-5,.col-sm-6,.col-sm-7,.col-sm-8,.col-sm-9,
                    .col-xs-1,.col-xs-10,.col-xs-11,.col-xs-12,.col-xs-2,.col-xs-3,.col-xs-4,.col-xs-5,.col-xs-6,.col-xs-7,.col-xs-8,.col-xs-9 {
                        padding-right: 5px;
                        padding-left: 5px;
                    }
                }
            </style>
        </head> 
        <body class="cbp-spmenu-push" id="bodyMinhaDespesa">
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
                    <div class="topBar"><h3 class="bold">Incluir despesa de viagem</h3></div>
                </div>
                <div class="clearfix"> </div>	
            </div>
            <!-- //header-ends -->
            <!-- main content start-->   
            <div class="pageContent">
                <div class="container">
                    <form id="FormDespesa">
                        <input type="hidden" class="form-control" id="VIAGEM" value="<?= $handleMinhaViagem ?>">
                        <hr>                        
                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <span>Tipo de despesa</span>
                                    <select class="form-control" id="TIPODESPESA" name="TIPODESPESA">
                                        <option selected value="">Selecione...</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <span>Despesa</span>
                                    <select class="form-control" id="DESPESA" name="DESPESA">
                                        <option selected value="">Selecione...</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <span>Data</span>
                                    <input type="datetime-local" class="form-control datahora" id="DATA">
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <span>Quantidade</span>
                                    <input type="number" min="0" max="99999" placeholder="0,00" step="0.01" class="form-control dinheiro" id="QUANTIDADE">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <span>Valor unitário</span>
                                    <input type="number" min="0" max="99999" placeholder="0,00" step="0.01"  class="form-control dinheiro" id="VALORUNITARIO">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <span>Valor total</span>
                                    <input type="number" min="0" max="99999" placeholder="0,00" step="0.01"  class="form-control dinheiro" id="VALORTOTAL" disabled="true">
                                </div>
                            </div>
                        </div>
                        
                        <hr>

                        <div class="form-row">
                            <div class="col-md-12">
                                <span>Observação</span>
                                <textarea class="form-control" rows="3" id="OBSERVACAO" name="OBSERVACAO"></textarea>
                            </div>
                        </div>

                        <hr>
                        
                        <div class="col-md-12 right botoesItem">
                            <button type="button" class="btn btn-success" id="GRAVAR">Gravar</button>
                        </div>
                        <div class="col-md-12 right">
                            <button type="button" class="btn btn-default btnFechar" >Fechar</button>
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
            <script type="text/javascript" src="../operacional/js/minhaViagemAdicionarDespesa.js"></script>
        </body>
    </html>

    <?php
}