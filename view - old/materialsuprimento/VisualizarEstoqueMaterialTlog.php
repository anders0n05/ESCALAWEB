<?php
include_once('../../controller/tecnologia/Sistema.php');

if (!isset($_SESSION['usuario']) and ! isset($_SESSION['senha'])) {
    header('Location: ../../view/estrutura/login.php?success=F');
}// not isset sessions of login
else {
    $connect = Sistema::getConexao(); ?>
    <!DOCTYPE HTML>
    <html>
        <head>
            <?php include('../../view/estrutura/title.php'); ?>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <!-- Bootstrap Core CSS -->
            <link href="../tecnologia/css/bootstrap.css" rel='stylesheet' type='text/css' />
            <!-- Custom CSS -->
            <link href="../tecnologia/css/style.css" rel='stylesheet' type='text/css' />
            <link href="./resource/EstoqueMaterialTlog.css" rel='stylesheet' type='text/css' />
            <!-- font CSS -->
            <!-- font-awesome icons -->
            <link href="../tecnologia/css/font-awesome.css" rel="stylesheet">
            <!-- //font-awesome icons -->
            <!-- material icons -->
            <link href="../../view/tecnologia/css/material-icons.css" rel="stylesheet"> 
            <!-- //material icons -->
            <!-- js-->
            <script src="../tecnologia/js/jquery-1.11.1.min.js"></script>
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
            <script type="text/javascript" src="../tecnologia/js/bootbox.js"></script>
            <link type="text/css" href="../tecnologia/css/jquery-ui.css" rel="stylesheet"/>
            <link type="text/css" href="../tecnologia/css/styleCustom.css" rel="stylesheet"/>
            <script type="text/javascript" src="../../view/tecnologia/js/blockUI.js"></script>
            <link type="text/css" href="../tecnologia/css/jquery.scrolling-tabs.css" rel="stylesheet"/>
            <!--// End Custom -->

            <style>
                .col-md-2 {
                    width: 12.5%;
                }
            </style>
        </head>
        <body >
            <div class="main-content" id="bodyFullScreen"> 
                <div id="loader"></div>
                <?php
                include_once('../../model/materialsuprimento/VisualizarEstoqueMaterialModelTlog.php'); ?>
                <!-- header-starts -->
                <div class="sticky-header header-section "> 

                    <a href="EstoqueMaterialTlog.php"><button id="showLeftPushVoltarForm"><i class="glyphicon glyphicon-menu-left"></i></button></a>
                    <a href="EstoqueMaterialTlog.php" class="display" hidden="true"><button hidden="true" id="showLeftPush"><i class="glyphicon glyphicon-menu-left"></i></button></a>
                    <!--toggle button end-->

                    <div class="topBar mobileHide" style="text-align:left; width:90%;"><?php include('../../view/estrutura/navBarLogo.php'); ?>Estoque de material</font></div>
                    <div class="topBar desktopHide"><?php include('../../view/estrutura/navBarLogo.php'); ?>Estoque de material</div>
                    <div class="topBarRight dropdown">
                        <button type="button" class="btn botaoTop dropdown-toggle desktopHide" role="button" aria-expanded="false" data-toggle="dropdown" ><i class="material-icons">&#xE5D4;</i></button>
                    </div>

                    <div class="clearfix"> </div>
                </div>
                <!-- //header-ends --> 
                <!-- main content start-->
                <div class="pageContent">
                    <div class="row">
                        <div class="formContent">
                            <div class="col-md-3 col-xs-6 pullBottom" > <span>Filial</span>
                                <div class="inner-addon right-addon"> <font size="-2"><i class="glyphicon glyphicon-triangle-bottom" id="spandown"></i></font>
                                    <input type="text" name="filial" id="filial" value="<?php echo $EstoqueMercadoriaNomeFilial . ' - ' . $EstoqueMercadoriaCnpjFilial ?>" class="form-control" disabled>
                                </div>
                            </div>                            
                            <div class="col-md-3 col-xs-6 pullBottom" > <span>Almoxarifado</span>
                                <div class="inner-addon right-addon"> <font size="-2"><i class="glyphicon glyphicon-triangle-bottom" id="spandown"></i></font>
                                    <input type="text" name="almoxarifado" id="almoxarifado" value="<?php echo $EstoqueMercadoriaAlmoxarifado ?>" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-md-3 col-xs-6 pullBottom" > <span>Produto</span>
                                <div class="inner-addon right-addon"> <font size="-2"><i class="glyphicon glyphicon-triangle-bottom" id="spandown"></i></font>
                                    <input type="text" name="produto" id="produto" value="<?php echo $EstoqueMercadoriaCodigoProduto . ' - ' . $EstoqueMercadoriaNomeProduto ?>" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-md-3 col-xs-6 pullBottom" > <span>Variação</span>
                                <div class="inner-addon right-addon"> <font size="-2"><i class="glyphicon glyphicon-triangle-bottom" id="spandown"></i></font>
                                    <input type="text" name="variacao" id="variacao" value="<?php echo $EstoqueMercadoriaVariacao ?>" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-md-1 col-xs-6 pullBottom" > <span><b>Saldo mínimo</b></span>
                                <div class="inner-addon right-addon">
                                    <b>
                                        <input type="text" name="minimo" id="minimo" value="<?php echo $EstoqueMercadoriaMinimo ?>" class="form-control" disabled>
                                    </b>
                                </div>
                            </div>
                            <div class="col-md-1 col-xs-6 pullBottom" > <span>Máximo</span>
                                <div class="inner-addon right-addon">
                                    <input type="text" name="maximo" id="maximo" value="<?php echo $EstoqueMercadoriaMaximo ?>" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-md-1 col-xs-6 pullBottom" > <span>Segurança</span>
                                <div class="inner-addon right-addon">
                                    <input type="text" name="seguranca" id="seguranca" value="<?php echo $EstoqueMercadoriaSeguranca ?>" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-md-2 col-xs-6 pullBottom" > <span><b>Disponível</b></span>
                                <div class="inner-addon right-addon">
                                    <b>
                                        <input type="text" name="disponivel" id="disponivel" value="<?php echo $EstoqueMercadoriaDisponivel ?>" class="form-control" disabled>
                                    </b>
                                </div>
                            </div>
                            <div class="col-md-2 col-xs-6 pullBottom" > <span>Bloqueado</span>
                                <div class="inner-addon right-addon">
                                    <input type="text" name="bloqueado" id="bloqueado" value="<?php echo $EstoqueMercadoriaBloqueado ?>" class="form-control" disabled>
                                </div>
                            </div>                            
                            <div class="col-md-2 col-xs-6 pullBottom" > <span>Reservado</span>
                                <div class="inner-addon right-addon">
                                    <input type="text" name="reservado" id="reservado" value="<?php echo $EstoqueMercadoriaReservado ?>" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-md-2 col-xs-6 pullBottom" > <span><b>Saldo total</b></span>
                                <div class="inner-addon right-addon">
                                    <b>
                                        <input type="text" name="saldototal" id="saldototal" value="<?php echo $EstoqueMercadoriaSaldoTotal ?>" class="form-control" disabled>
                                    </b>
                                </div>
                            </div>
                            <div class="col-md-2 col-xs-6 pullBottom" > <span>Custo médio</span>
                                <div class="inner-addon right-addon">
                                    <input type="text" name="customedio" id="customedio" value="<?php echo $EstoqueMercadoriaCustoMedio ?>" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-md-2 col-xs-6 pullBottom" > <span>Valor estoque</span>
                                <div class="inner-addon right-addon">
                                    <input type="text" name="valorestoque" id="valorestoque" value="<?php echo $EstoqueMercadoriaValorEstoque ?>" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>

                    <div class="row" style="margin: 0.2em 0 0;">
                    
                        <?php include_once('../../model/materialsuprimento/VisualizarEstoqueMaterialTabsModelTlog.php'); ?>

                        <div class="tab-content">
                            <?php 
                            if ($movimentacaoExiste) {
                            ?>
                            <div role="tabpanel" class="tab-pane <?= ($movimentacaoExiste ? 'active' : '') ?>" id="Movimentacao">
                                <div class="col-xs-12 bottonPull">
                                    <div class="right"><button type="button" class="botaoBranco1" id="" disabled><font size="3px"><i class="glyphicon glyphicon-plus"> </i> </font></button>
                                        <button type="button" class="botaoBranco1" id="" disabled><font size="5px"><i class="fa fa-caret-up"> </i> </font></button>
                                        <button type="button" class="botaoBranco1" id="" disabled><font size="4px"><i class="fa fa-minus"> </i> </font></button>
                                    </div>

                                    <div class="dividerH"></div>

                                    <table class="table table-responsive table-striped" id="reqtableMovimentacao" border="0">
                                        <thead>
                                            <th width="15%" class="text-center">Nr doc</th>
                                            <th width="10%" class="text-center">Série</th>
                                            <th width="5%" class="text-center">Abrangência</th>
                                            <th width="35%">Pessoa</th>
                                            <th width="10%" class="text-center">Emissão</th>
                                            <th width="10%" class="text-center">Quantidade</th>
                                            <th width="15%">Unidade de medida</th>                                            
                                        </thead>
                                        <tbody>
                                            <?php include_once('../../model/materialsuprimento/VisualizarEstoqueMaterialMovimentacaoTabelaModelTlog.php'); ?>
                                        </tbody>
                                    </table>

                                    <div class="clearfix"></div>
                                    </p>
                                </div>
                            </div>
                            <?php
                            }
                            ?>
                        </div><!-- end tab-content -->
                    </div><!-- end row -->
                </div><!-- end pageContent -->

                <div class="footerFixed mobileHide">
                    <div class="right">
                        &nbsp;
                    </div>
                </div>
                <!-- end footer -->

                <div class="clearfix"> </div>
            </div>
        </div>
        <script type="text/javascript" src="../../view/tecnologia/js/jquery.scrolling-tabs.js"></script>
        <script>
                $('.nav-tabs').scrollingTabs();
        </script>
        <!-- Classie --> 
        <script src="../tecnologia/js/classie.js"></script> 
        <!--scrolling js--> 
        <script src="../tecnologia/js/jquery.nicescroll.js"></script> 
        <script src="../tecnologia/js/script.js"></script>
        <!--//scrolling js--> 
        <!-- Bootstrap Core JavaScript --> 
        <script src="../tecnologia/js/bootstrap.js"></script>
    </body>
    </html>
    <?php
}
