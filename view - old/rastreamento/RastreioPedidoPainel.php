<?php
include_once('../../controller/tecnologia/Sistema.php');
if (!isset($_SESSION['usuario']) and ! isset($_SESSION['senha'])) {
    header('Location: ../../view/estrutura/login.php?success=F');
}// not isset sessions of login
else {
    $connect = Sistema::getConexao();
    ?>
    <!DOCTYPE HTML>
    <html>
        <head>
            <title>Escalasoft</title>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <link rel="icon" type="image/png" href="../tecnologia/img/favicon.png" />
            <!-- Bootstrap Core CSS -->
            <link href="../tecnologia/css/bootstrap.css" rel='stylesheet' type='text/css' />
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
            <link type="text/css" href="../tecnologia/css/styleCustom.css" rel="stylesheet"/>
            <link type="text/css" href="../../view/tecnologia/css/jquery.multiselect.css" rel="stylesheet"/>
            <!--// End Custom -->
            <!-- shortTable -->
            <link href="../../view/tecnologia/css/theme.bootstrap_3.min.css" rel="stylesheet">
			<style>
				canvas{
                    position: relative; 
				}
			</style>
        </head> 
        <body class="cbp-spmenu-push" id="bodyFullScreen">
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

                    <div class="topBar">Painel de pedidos</div>

                    <div class="topBarRight">
                        <ul class="dropdown-menu dropdown-menu-right" role="menu">
                            <li><button name="atualizar" class="btn botaoMobile display" type="button" id="atualizar">Atualizar</button></li>
                        </ul>
						<button data-toggle="modal" class="btn botaoTop" onclick="atualizarPagina();"><i class="glyphicon glyphicon-refresh"></i></button>
                    </div>
                </div>

                <div class="clearfix"> </div>	
            </div>
            <!-- //header-ends -->
            <!-- main content start-->
            <div class="pageContent">
                <div class="container-fluid ">
                    <div class="col-md-12" style="margin-top: 10px;">
                        <div class="col-md-6">
                            <h3>Painel de indicadores</h2>
                        </div>          

                        <div class="col-md-2 col-sm-3">
                            <button type="button" class="form-control" id="btnExport" name="btnExport">Exportar</button>
                        </div> 
                        <form id="filtroPedido" action="/view/rastreamento/RastreioPedidoPainel.php" method="POST">
                            <div class="col-md-2 col-sm-3">
                                <select class="form-control" id="pedidoEstadoFiltro" name="pedidoEstadoFiltro">
                                    <option value="">Estado</option>    
                                </select>                                
                            </div>

                            <div class="col-md-2 col-sm-3">
                                <select class="form-control" name="periodoFiltro" id="periodoFiltro">
                                    <option value="15" selected>Últimos 15 dias</option>
                                    <option value="30">Últimos 30 dias</option>
                                    <option value="60">Últimos 60 dias</option>
                                    <option value="90">Últimos 90 dias</option>
                                    <option value="180">Últimos 180 dias</option>
                                    <option value="360">Últimos 360 dias</option>
                                </select>                                
                            </div>
                        </form>
                    </div>
                    <div class="col-md-12" style="margin-top: 10px;">
                        <div class="col-sm-6 itemPedidoPainel mapa">
                            <h4>Mapa do Brasil<h4>
                            <hr>
                                <div id="regions_div"></div>
                            </div>

                            <div class="col-sm-6 itemPedidoPainel mapa">
                                <h4>Detalhando <span id="estado">por estado</span><h4>
                                <hr>
                                <div id="wrapper">
                                    <canvas id="detalhePedido"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 itemPedidoPainel">
                            <h4>
                                Pedidos pendentes de entrega por transportadora
                            </h4>
                            <hr>
                            <canvas id="pedidosPendentesTransportadora"></canvas>
                        </div>

                        <div class="col-sm-6 itemPedidoPainel">
                            <h4>
                                Situação de entrega dos pedidos já realizados
                            </h4>
                            <hr>
                            <canvas id="situacaoPedidosPendentes"></canvas>
                        </div>
                        <div class="col-sm-6 itemPedidoPainel">
                            <h4>
                                Situação de pedidos
                            </h4>
                            <hr>
                            <canvas id="pedidosPendentesPrazo"></canvas>
                        </div>
                        <div class="col-sm-6 itemPedidoPainel">
                            <h4>
                                Pedidos pendentes por etapa 
                            </h4>
                            <hr>
                            <canvas id="pedidosPendentesEtapa"></canvas>
                        </div>
                        <div class="col-sm-6 itemPedidoPainel">
                            <h4>
                                Pedidos pendentes por transportadora  
                            </h4>
                            <hr>
                            <canvas id="pedidosUltimos30DiasTransportadora"></canvas>
                        </div>
                        <div class="col-sm-6 itemPedidoPainel">
                            <h4>
                                Pedidos dos últimos <?= Sistema::getPost("periodoFiltro") ?> dias por transportadora  
                            </h4>
                            <hr>
                            <canvas id="pedidosUltimos90DiasTransportadora"></canvas>
                        </div>
                        <div class="col-sm-6 itemPedidoPainel">
                            <h4>
                                Pedidos pendentes por estado  
                            </h4>
                            <hr>
                            <canvas id="pedidosPendentesEstado"></canvas>
                        </div>
                        <div class="col-sm-6 itemPedidoPainel">
                            <h4>
                                Pedidos dos últimos <?= Sistema::getPost("periodoFiltro") ?> dias por estado  
                            </h4>
                            <hr>
                            <canvas id="pedidosPendentesUltimos30DiasEstado"></canvas>
                        </div>
                    </div>
                </div>
                <!-- end pageContent -->
            <div class="clearfix"> </div>
            <form method="POST" hidden action="RastreioPedido.php" id="formNumeroPedido">
                <input id="numeroPedido" name="numeroPedido">
            </form>
            <script>
                $(document).ready(function () {
                    $.ajax({
                        url: "../../controller/rastreamento/getPedidosEstado.php",
                        async: false,
                        dataType: 'json',
                        success: function(data) {			
			                $.each(data, function(key,value) {
				                $('#pedidoEstadoFiltro')
					            .append($("<option value="+value+"></option>")
					            .text(value));
		                    });
		                }
	                });	

                    $('#pedidoEstadoFiltro').val("<?= Sistema::getPost("pedidoEstadoFiltro") ?>");
                    $('#periodoFiltro').val("<?= (!empty(Sistema::getPost("periodoFiltro"))) ? Sistema::getPost("periodoFiltro") : 15 ?>");

                    $('#pedidoEstadoFiltro').change(function() {
                        $('#filtroPedido').submit();
                    });

                    $('#periodoFiltro').change(function() {
                        $('#filtroPedido').submit();
                    });
                });

                var retornoJson = [];

                $("#btnExport").click(function(){                   
                    $.ajax({
		            method: "post",
                    data: { 
			            estado: $('#pedidoEstadoFiltro').val(), 
                        periodo: $('#periodoFiltro').val(),
		            },
    		        url: "../../controller/rastreamento/getPlanilhaPedidosPendentes.php",
	    	        async: false,
		            dataType: 'json',
		            success: function (data) {
                        retornoJson = data;
		            }
                    });
                    
                    downloadCSV({ filename: "pedidos.csv", stockData: retornoJson });
                });

            </script>
            <script src="../tecnologia/js/jsapi.js"></script>            
            
            <!-- Classie -->
            <script src="../tecnologia/js/classie.js"></script>
            <!--scrolling js-->
            <script src="../tecnologia/js/jquery.nicescroll.js"></script>
            <script src="../tecnologia/js/script.js"></script>
            <script src="../tecnologia/js/exportar.js"></script>
            <script src="../tecnologia/js/scriptRastreioPedidoPainel.js"></script>
            <!--//scrolling js-->
            <!-- Bootstrap Core JavaScript -->
            <script src="../tecnologia/js/bootstrap.js"></script>

            <script src="../tecnologia/js/loader.js"></script>            
            <script type="text/javascript">
            
            google.charts.load('current', {'packages':['geochart']});
            google.charts.setOnLoadCallback(drawRegionsMap);
                
            estados = $.parseJSON($.ajax({
                    method: "post",
                    data: { 
                        periodo: $('#periodoFiltro').val(),
		            },
                    url: "../../controller/rastreamento/getPedidosMapaBrasilDetalhe.php",
                    dataType: "json",                
                    async: false
                }).responseText);
            
            var ultimoEstadoSelecionado = '';

            function drawRegionsMap(dados) {
                var jsonData = $.ajax({
                    method: "post",
                    data: { 
                        periodo: $('#periodoFiltro').val(),
		            },
                    url: "../../controller/rastreamento/getPedidosMapaBrasil.php",                
                    dataType: "json",                
                    async: false
                }).responseText;
                         
                vDados = jQuery.parseJSON(jsonData);

                var data = new google.visualization.DataTable();
                data.addColumn('string', 'Country');
                data.addColumn('number', 'Percentual de pedidos');
                data.addRows([['Brazil', 100],]);

                GerarGrafico(0,0);
                
                $.each(vDados, function(i, item) {
                    data.addRows([[item.ESTADO, item.PERCENTUAL]]);
                })
                
                vDetalhe = ['DEFAULT'];
                $.each(vDados, function(i, item) {
                    vDetalhe.push(item.ESTADO);
                })

                var options = {
                    region: 'BR',
                    resolution: 'provinces',
                    datalessRegionColor: 'white',
                    colorAxis: {colors:['#87CEFA', '#4169E1']},
                    defaultColor: '#2b9bcb',
                    legend:  {textStyle: {color: 'black', fontSize: 16}},
                    enableRegionInteractivity: true,
                    };

                    var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));
        
                    function myClickHandler(){
                        var selection = chart.getSelection();
                        var message = '';
                        for (var i = 0; i < selection.length; i++) {
                            var item = selection[i];
                            if (item.row != null && item.column != null) {
                                message += '{' + item.row + ',column:' + item.column + '}';
                            } else if (item.row != null) {
                                message += '' + item.row + '';
                            } else if (item.column != null) {
                                message += '{column:' + item.column + '}';
                            }
                        }

                        if (message == '') {
                            message = ultimoEstadoSelecionado;
                        }else{
                            ultimoEstadoSelecionado = message;
                        }
                    
                        document.getElementById("wrapper").innerHTML = '<canvas id="detalhePedido"></canvas>';
						
						vTransportadora = [];
                        vValores = [];

                        for(var i = 0; i < Object.keys(estados).length; i ++){ 
                            document.getElementById("estado").innerHTML = vDetalhe[message];
                            
                            if((estados[i].ESTADO == vDetalhe[message]) && estados[i].DETALHE!= null){
                                for(var j = 0; j < Object.keys(estados[i].DETALHE).length; j ++){ 
                                    if(estados[i].DETALHE[j].TRANSPORTADORA != undefined){
                                        vTransportadora.push(estados[i].DETALHE[j].TRANSPORTADORA);
                                        vValores.push(estados[i].DETALHE[j].QUANTIDADE);    
                                    }
                                }
                            }
                        }
						GerarGrafico(vTransportadora, vValores);
                    }
                    google.visualization.events.addListener(chart, 'select', myClickHandler);
                    chart.draw(data, options);

                    function GerarGrafico(prTransportadora, prValores){
                        var ctx = document.getElementById("detalhePedido");
                        var myChart = new Chart(ctx, {
                            type: 'horizontalBar',
                            data: {
                                labels: prTransportadora,
                                datasets: [{
                                    data: prValores,
                                    backgroundColor: [
                                        'rgba(255, 99, 132)',
                                        'rgba(54, 162, 235)',
                                        'rgba(255, 206, 86)',
                                        'rgba(75, 192, 192)',
                                        'rgba(153, 102, 255)',
                                        'rgba(255, 159, 64)'
                                    ],
                                    borderColor: [
                                        'rgba(255,99,132)',
                                        'rgba(54, 162, 235)',
                                        'rgba(255, 206, 86)',
                                        'rgba(75, 192, 192)',
                                        'rgba(153, 102, 255)',
                                        'rgba(255, 159, 64)'
                                    ],
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true,
                                legend: {
                                    display: false
                                },
                                animation: {
                                    duration: 2500
                                },
                                scales: {
                                    xAxes: [{
                                        id: 'x-axis-0',
                                        gridLines: {
                                            display: false
                                        },
                                        ticks: {
                                            beginAtZero: true
                                        }
                                    }],
                                    yAxes: [{
                                        id: 'y-axis-0',
                                        gridLines: {
                                            display: false
                                        },
                                        ticks: {
                                            beginAtZero: true
                                        }
                                    }]
                                }
                            }
                        });
                    }
                }
            </script>
        </body>
    </html>

    <?php
}