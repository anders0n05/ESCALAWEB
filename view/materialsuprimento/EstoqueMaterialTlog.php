<?php
include_once('../../controller/tecnologia/Sistema.php');

if (!isset($_SESSION['usuario']) and !isset($_SESSION['senha'])) {
    header('Location: ../../view/estrutura/login.php?success=F');
} else {
    $connect = Sistema::getConexao();

    $sqlClientes = "SELECT B.PESSOA FROM MS_USUARIO A
                    INNER JOIN MS_USUARIOPESSOA B ON A.HANDLE = B.USUARIO
                    WHERE A.HANDLE = " . $_SESSION['handleUsuario'];

    $queryClientes = $connect->prepare($sqlClientes);
    $queryClientes->execute();

    $clientes = [];

    while ($dados = $queryClientes->fetch(PDO::FETCH_ASSOC)) {
        $clientes[] = $dados["PESSOA"];
    }

    require '../../model/materialsuprimento/especifico/PegaCentroCusto.php';
    require '../../model/materialsuprimento/especifico/PegaCampanha.php';
    require '../../model/materialsuprimento/especifico/PegaGrupo.php';

    ?>
    <!DOCTYPE HTML>
    <html>

    <head>
        <title>Escalasoft</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link rel="icon" type="image/png" href="../tecnologia/img/favicon.png"/>
        <!-- Bootstrap Core CSS -->
        <link href="../tecnologia/css/bootstrap3/bootstrap.min.css" rel='stylesheet' type='text/css'/>
        <!-- Custom CSS -->
        <link href="../tecnologia/css/style.css" rel='stylesheet' type='text/css'/>
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
        <link rel="stylesheet" href="../tecnologia/css/clndr.css" type="text/css"/>
        <script src="../tecnologia/js/underscore-min.js" type="text/javascript"></script>
        <script src="../tecnologia/js/moment-2.2.1.js" type="text/javascript"></script>
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
        <!--// End shortTable -->

        <link href="../../view/tecnologia/css/TabelasPadrao.css" rel="stylesheet">
        <style>
			th { font-size: 12px; }
			td { font-size: 11px; }
			
            .container {
                margin-top: 0px;
            }

            .ativo {
                color: green;
            }

            .container-fluid {
                padding: 0px !important;
            }

            .footerFixed .row {
                margin-bottom: 10px !important;
            }

            ul.dropdown-menu {
                animation: none !important;
                -moz-animation: none !important;
                -webkit-animation: none !important;
                -webkit-backface-visibility: visible !important;
                -ms-backface-visibility: visible !important;
                backface-visibility: visible !important;
                -moz-backface-visibility: visible !important;
                padding: 5px !important;
            }

            .right {
                /* padding: 0 30px 0 0; */
                width: 100% !important;
            }

            .dropdown-menu .btn:hover {
                color: #000000a6;
            }

            .nopadding {
                margin-top: -58px !important;
            }

            #tableEstoque_wrapper .col-sm-12 {
                padding: 0 !important;
            }

            tbody tr td {
                border-bottom: 1px solid #ddd !important;
            }

            .dropdown-menu span {
                color: black;
            }

            @media screen and (min-width: 768px) {
                .pesquisar {
                    display: initial;
                }
            }

            .pesquisar {
                margin-top: 10px !important;
                width: auto;
            }

            .dropdown-menu {
                padding: 0 5px 0 5px !important;
            }

            .dropdown-menu li {
                margin: 5px 0 5px 0 !important;
            }
	    
		
			body {
				overflow-y: hidden; /* Hide vertical scrollbar */
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

        <div class="sticky-header header-section ">
            
			<!--toggle button start-->
            <button id="showLeftPush"><i class="fa fa-bars"></i></button>
            <!--toggle button end-->
            <div class="topBar">Estoque de mercadoria</div>
            <div class="topBarRight">
                <input type="text" class="form-control pesquisar mobileHide" placeholder="Pesquisar"
                       id="pesquisarDesktop">
                <button class="btn botaoTop dropdown-toggle" type="button" id="dropdownMenu1"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <i class="material-icons">&#xE5D4;</i>
                </button>
                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
                    <li class="desktopHide">
                        <input type="text" class="form-control pesquisar" placeholder="Pesquisar" id="pesquisarMobile">
                    </li>
                    <li>
                        <span>Grupo</span>
                        <select id="Grupo" class="form-control">
                            <option selected value="">Selecione...</option>
                            <?php foreach ($grupos as $grupo) { ?>
                                <option value="<?= $grupo["HANDLE"] ?>"><?= $grupo["NOME"] ?></option>
                            <?php } ?>
                        </select>
                    </li>
                    <li>
                        <span>Centro de Custo</span>
                        <select id="CentroCusto" class="form-control">
                            <option selected value="">Selecione...</option>
                            <?php foreach ($centroCustos as $centroCusto) { ?>
                                <option value="<?= $centroCusto["HANDLE"] ?>"><?= $centroCusto["CONTEUDO"] ?></option>
                            <?php } ?>
                        </select>
                    </li>
                    <li>
                        <span>Campanha</span>
                        <select id="Campanha" class="form-control">
                            <option selected value="">Selecione...</option>
                            <?php foreach ($campanhas as $campanha) { ?>
                                <option value="<?= $campanha["HANDLE"] ?>"><?= $campanha["CONTEUDO"] ?></option>
                            <?php } ?>
                        </select>
                    </li>
                    <li role="separator" class="divider"></li>
                    <li>
                        <button class="btn btn-success btn-block btnFiltrar">Filtrar</button>
                    </li>
                    <li>
                        <button class="btn btn-primary btn-block btnLimpar">Limpar</button>
                    </li>
                    <li>
                        <button id="exportar" class="btn btn-primary btn-block btn-danger">Exportar</button>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- //header-ends -->

    <!-- main content start-->
    <div class="pageContent">

                    <table id="tableEstoque" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th>Imagem</th>
                            <th>Descrição</th>
                            <th>Código de Referência</th>
                            <th>NCM</th>
                            <th>Centro de Custo</th>
                            <th>Campanha</th>
                            <th>Grupo</th>
                            <th>Valor Unitário</th>
                            <th>Saldo Mínimo</th>
                            <th>Saldo Disponível</th>
                            <th>Saldo Reservado</th>
                            <th>Saldo Bloqueado</th>
                        </tr>
                        </thead>
                    </table>

    </div>


    <div class="modal fade" id="modalImagem" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <img src="" class="imagepreview" style="width: 100%;">
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
	
	<div class="modal fade" id="selecionarColuna" tabindex="-1" role="dialogX' aria-labelledby="exampleModalLabel" data-backdrop="static">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">									
					<h4 class="modal-title text-center">Selecionar coluna</h4>
				</div>
				<div class="modal-body">
					<form>
						<div>
							<input type="checkbox" id="imagem" name="imagem" checked>
							<label> Imagem </label>
						</div>	
						<div>
							<input type="checkbox" id="nome" name="nome" checked>
							<label> Descrição </label>
						</div>
						<div>
							<input type="checkbox" id="codigoReferencia" name="codigoReferencia" checked>
							<label> Código de referência </label>
						</div>
						<div>
							<input type="checkbox" id="ncm" name="ncm" checked>
							<label> NCM </label>
						</div>
						<div>
							<input type="checkbox" id="centroCusto" name="centroCusto" checked>
							<label> Centro de custo </label>
						</div>
						<div>
							<input type="checkbox" id="campanha" name="campanha" checked>
							<label> Campanha </label>
						</div>
						<div>
							<input type="checkbox" id="grupo" name="grupo" checked>
							<label> Gurpo </label>
						</div>
						<div>
							<input type="checkbox" id="valorUnitario" name="valorUnitario" checked>
							<label> Valor unitário </label>
						</div>
						<div>
							<input type="checkbox" id="saldoMinimo" name="saldoMinimo" checked>
							<label> Saldo mínimo </label>
						</div>
						<div>
							<input type="checkbox" id="saldoDisponivel" name="saldoDisponivel" checked>
							<label> Saldo disponível </label>
						</div>	
						<div>
							<input type="checkbox" id="saldoReservado" name="saldoReservado" checked>
							<label> Saldo reservado </label>
						</div>
						<div>
							<input type="checkbox" id="saldoBloqueado" name="saldoBloqueado" checked>
							<label> Saldo bloqueado </label>
						</div>					
					</form>				
				</div>	
				<div class="modal-footer">									
					<button type="button" id="modalExportar" class="btn btn-success">Exportar</button>
					<button type="button" id="modalFechar" class="btn btn-default btnFechar" data-dismiss="modal">Fechar</button>
				</div>
			</div>
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
    <script src="../tecnologia/js/bootstrap3/bootstrap.min.js"></script>

    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.10.18/fc-3.2.5/fh-3.1.4/r-2.2.2/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.18/fc-3.2.5/fh-3.1.4/r-2.2.2/datatables.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedheader/3.1.2/css/fixedHeader.dataTables.min.css">
			
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
	
	<script src="https://cdn.datatables.net/fixedheader/3.1.2/js/dataTables.fixedHeader.min.js" type="text/javascript"></script>	
	
    <!-- SweetAlert -->
    <script type="text/javascript" src="../tecnologia/js/sweetalert/sweetalert.min.js"></script>
    <script>
	    var originalColumns = [];
        var urlImages = document.URL.split('/').slice(0, -2).join('/') + '/images/';
        	
		var oldExportAction = function (self, e, dt, button, config) {
			if (button[0].className.indexOf('buttons-excel') >= 0) {
				if ($.fn.dataTable.ext.buttons.excelHtml5.available(dt, config)) {
					$.fn.dataTable.ext.buttons.excelHtml5.action.call(self, e, dt, button, config);
				}
				else {
					$.fn.dataTable.ext.buttons.excelFlash.action.call(self, e, dt, button, config);
				}
			} else if (button[0].className.indexOf('buttons-print') >= 0) {
				$.fn.dataTable.ext.buttons.print.action(e, dt, button, config);
			}
		};		
		
		var newExportAction = function (e, dt, button, config) {
			var self = this;
			var oldStart = dt.settings()[0]._iDisplayStart;
		
			dt.one('preXhr', function (e, s, data) {
				
				data.start = 0;
				data.length = 2147483647;
		
				dt.one('preDraw', function (e, settings) {
					
					oldExportAction(self, e, dt, button, config);
		
					dt.one('preXhr', function (e, s, data) {
						settings._iDisplayStart = oldStart;
						data.start = oldStart;
					});
		
					setTimeout(dt.ajax.reload, 0);
		
					return false;
				});
			});
		
			dt.ajax.reload();
		};
		
		
        $(document).ready(function () {
            var tableAprovacoes = $('#tableEstoque').DataTable({
                "processing": false,
                "serverSide": true,
                "pageLength": 10,
                "saveState": true,
                "searching": false,
                "lengthChange": false,			
                "info": false,
				scrollY: "80vh",
				fixedHeader: true,     
				
				buttons: [
					{
						action: newExportAction,
						extend: 'excel', 
						filename: 'Estoque de mercadoria',
						name: 'excel', 
						sheetName: 'Estoque de mercadoria',
						title: 'Estoque de mercadoria',
							customize: function (xlsx) {
								
								var sheet = xlsx.xl.worksheets['sheet1.xml'];
								var cols = $('col', sheet);	
								
								$('row:eq(0) c', sheet).attr( 's', '32' );
            					$('row:eq(1) c', sheet).attr( 's', '30' );
								
								var originalColumnIndex;
								
								for (originalColumnIndex of originalColumns) {
									switch (originalColumns[originalColumnIndex]) {
										case 0:
											$(cols[originalColumnIndex]).attr('width', 10);
											
											$('row c[r^="A"]', sheet).each(function () {
												if ($('is t', this).text().indexOf("http") === 0 ) {
									
													$(this).attr('t', 'str');

													$(this).append('<f>' + 'HYPERLINK("'+$('is t', this).text()+'","Visualizar")'+ '</f>');
													$(this).append('<v>Visualizar</v>');

													$('is', this).remove();

													$(this).attr('s', '4');
												}				
											});											
											
											break;
										case 1:
											$(cols[originalColumnIndex]).attr('width', 35);	
											
											break;
										case 2:
										case 4:
											$(cols[originalColumnIndex]).attr('width', 20);	
											
											break;
										case 3:
											$(cols[originalColumnIndex]).attr('width', 10);	
											
											break;
										default:
											$(cols[originalColumnIndex]).attr('width', 16);	
									}									
								}
							},
						
						exportOptions: {
							columns: function(column, data, node) {
						
								if (
									(column == 0 && $('#selecionarColuna #imagem').is(":checked") === true) || 
								    (column == 1 && $('#selecionarColuna #nome').is(":checked") === true) || 
								    (column == 2 && $('#selecionarColuna #codigoReferencia').is(":checked") === true) || 
								    (column == 3 && $('#selecionarColuna #ncm').is(":checked") === true) || 							
								    (column == 4 && $('#selecionarColuna #centroCusto').is(":checked") === true) || 
								    (column == 5 && $('#selecionarColuna #campanha').is(":checked") === true) || 
								    (column == 6 && $('#selecionarColuna #grupo').is(":checked") === true) || 
								    (column == 7 && $('#selecionarColuna #valorUnitario').is(":checked") === true) || 						
								    (column == 8 && $('#selecionarColuna #saldoMinimo').is(":checked") === true) || 
								    (column == 9 && $('#selecionarColuna #saldoDisponivel').is(":checked") === true) || 
								    (column == 10 && $('#selecionarColuna #saldoReservado').is(":checked") === true) || 
								    (column == 11 && $('#selecionarColuna #saldoBloqueado').is(":checked") === true)
								   ) {									

									originalColumns.push(column);						

									return true;
								}							
								
								return false;
							},
							
							format: {
								body: function ( data, row, column, node ) {
									
									if (originalColumns[column] == 0 ) {
										return urlImages + tableAprovacoes.rows(row).data()[0].IMAGEM;
									}
									else if (originalColumns[column] >= 7){
                                        					if (data == ""){
                                            						data = "0";
                                        					}

										return parseFloat(data.trim().replace(/\./g, '').replace(/,/, '.')).toFixed(2);
									}
									else {
										return data
									}
								}
							}
							
						}
					}
				],
				
  
                "ajax": {
                    "url": "/escalasoft/model/materialsuprimento/especifico/EstoqueMaterialTLOG.php",
                    "data": 
                    function (data) {
                        data.centrocusto = $("#CentroCusto").val(),
                        data.campanha = $("#Campanha").val(),
                        data.grupo = $("#Grupo").val(),
                        data.pesquisar = $(".pesquisar").val()
                    }
                },
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
                },
				
				"columnDefs": [
					{ "width": "100px", "targets": 0 },
					{ "width": "350px", "targets": 1 },
					{ "width": "95px", "targets": 2 },
					{ "width": "80px", "targets": 3 },
					{ "width": "100px", "targets": 4 },
					{ "width": "100px", "targets": 5 },
					{ "width": "85px", "targets": 6 },
					{ "width": "85px", "targets": 7 },
					{ "width": "85px", "targets": 8 },
					{ "width": "85px", "targets": 9 },
					{ "width": "85px", "targets": 10 },
					{ "width": "85px", "targets": 11 }
					],				
                "columns": [{
                    "data": "IMAGEM",
                    "orderable": false,
                    "render": function (data) {
						if (data != ""){
							return '<img src="' + urlImages + data + '" width="150px" />';
						}
						
						return data;
					}
                }, {
                    "data": "NOME",
                    "orderable": false
                }, {
                    "data": "CODIGOREFERENCIA",
                    "orderable": false
                }, {
                    "data": "NCM",
                    "orderable": false
                }, {
                    "data": "CENTROCUSTO",
                    "orderable": false
                }, {
                    "data": "CAMPANHA",
                    "orderable": false
                }, {
                    "data": "GRUPO",
                    "orderable": false
                }, {
                    "data": "VALORUNITARIO",
                    "orderable": false,                    
                    "render": $.fn.dataTable.render.number('.', ',', 2, '')
                }, {
                    "data": "ESTOQUEMINIMO",
                    "orderable": false,                    
                    "render": $.fn.dataTable.render.number('.', ',', 2, '')
                }, {
                    "data": "DISPONIVEL",
                    "orderable": false,                    
                    "render": $.fn.dataTable.render.number('.', ',', 2, '')
                }, {
                    "data": "RESERVADO",
                    "orderable": false,                    
                    "render": $.fn.dataTable.render.number('.', ',', 2, '')
                }, {
                    "data": "BLOQUEADO",
                    "orderable": false,                    
                    "render": $.fn.dataTable.render.number('.', ',', 2, '')
                }]
            }).on('draw', function () {
                $('td img').on('click', function () {
                    $('.imagepreview').attr('src', $(this).attr('src'));
                    $('#modalImagem').modal('show');
                });
            });


$('#tableEstoque').on( 'draw.dt', function () {

 window.setTimeout(function () {
           tableAprovacoes.table().columns.adjust().draw(false);

        },1);
} );

      $('#tableEstoque tbody').on('dblclick', 'tr', function () {
                var data = tableAprovacoes.row(this).data();
                var param = '';

                if (data.EHARMAZEM == 'S'){
                    param = 'item=' + data.ITEM + '&filial=' + data.FILIAL;
                }
                else {
                    param = 'estoqueMercadoria=' + data.ESTOQUE;
                }

                window.location = '/escalasoft/view/materialsuprimento/VisualizarEstoqueMaterialTlog.php?' + param + '&ehArmazem=' + data.EHARMAZEM;
            });

            $('.dropdown-menu').on('click', function (e) {
                e.stopPropagation();
            });

            $(".btnFiltrar").on('click', function () {
                tableAprovacoes.draw();
            });

            $(".btnLimpar").on('click', function () {
                $('select').val(0);
            });
			
            $("#exportar").on('click', function () {
                
				originalColumns = [];
				
				$('#selecionarColuna').modal('show');
				
            });			
			
            $("#modalExportar").on('click', function () {
				
				$('#loader').removeAttr('style');
                
				var table = $('#tableEstoque').DataTable();
				table.buttons('excel:name').trigger();
				
				$('#selecionarColuna').modal('toggle');	
				
				$('#loader').hide();			
            });	

            $(".pesquisar").on('keypress', function () {
                var keycode = (event.keyCode ? event.keyCode : event.which);
                if (keycode == '13') {
                    tableAprovacoes.draw();
                }
            });
        });
    </script>
    </body>

    </html>
    <?php
}