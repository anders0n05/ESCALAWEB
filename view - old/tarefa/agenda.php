<?php
	include_once('../../controller/tecnologia/Sistema.php');

	if (!isset($_SESSION['usuario']) and ! isset($_SESSION['senha'])) 
	{
		header('Location: ../../view/estrutura/login.php?success=F');
	}
	else 
	{
		$connect = Sistema::getConexao();
		
		include_once('../../model/tarefa/GetTipo.php');
?>

		<!DOCTYPE HTML>
		<html>
			<head>
				<title>Escalasoft</title><meta name="viewport" content="width=device-width, initial-scale=1.0">

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
				<!-- js-->
				<script src="../tecnologia/js/jquery-1.11.1.min.js"></script>
				<script src="../tecnologia/js/modernizr.custom.js"></script>
				<!-- //js-->
				<!-- Menu Lateral -->
				<script src="../tecnologia/js/metisMenu.min.js"></script>
				<script src="../tecnologia/js/custom.js"></script>
				<link href="../tecnologia/css/custom.css" rel="stylesheet">
				<!--//Menu Lateral-->
				<!-- Custom -->
				<script type="text/javascript" src="../tecnologia/js/jquery-ui.js"></script>
				<script src= "../../view/tecnologia/js/moment-2.2.1.js" type="text/javascript"></script>
				<link type="text/css" href="../tecnologia/css/jquery-ui.css" rel="stylesheet"/>
				<link type="text/css" href="../tecnologia/css/styleCustom.css" rel="stylesheet"/>
				<script type="text/javascript" src="../../view/tecnologia/js/blockUI.js"></script>
				<!--//End Custom -->
				<!-- fullcalendar -->				
				<link type="text/css" href='../../view/tecnologia/fullcalendar/core/main.css' rel='stylesheet' />
				<link type="text/css" href='../../view/tecnologia/fullcalendar/daygrid/main.css' rel='stylesheet' />
				<script type="text/javascript" src='../../view/tecnologia/fullcalendar/core/main.js'></script>
				<script type="text/javascript" src='../../view/tecnologia/fullcalendar/daygrid/main.js'></script>
				<script type="text/javascript" src='../../view/tecnologia/fullcalendar/core/locales-all.js'></script>
				<script>
					document.addEventListener('DOMContentLoaded', function() {
						var calendarEl = document.getElementById('calendar');
					
						var calendar = new FullCalendar.Calendar(calendarEl, {

							plugins: [ 'dayGrid'],

							customButtons: {
								adicionarEvento: {
									text: 'Adicionar',
									click: function() {
										
										$('#adicionarEvento #handle').val('0');
										
										$('#adicionarEvento #assunto').val('');
										$('#adicionarEvento #assunto').prop("disabled", false);
										
										$('#adicionarEvento #tipo').val('');
										$('#adicionarEvento #tipo').prop("disabled", false);										
										$('#adicionarEvento #tipo').show();

										$('#adicionarEvento #tipoDescricao').val('');
										$('#adicionarEvento #tipoDescricao').hide();
										
										$('#adicionarEvento #previsao').val('');
										$('#adicionarEvento #previsao').prop("disabled", false);										
										
										$('#adicionarEvento #inicio').val('');
										$('#adicionarEvento #inicio').prop("disabled", false);										
										
										$('#adicionarEvento #termino').val('');
										$('#adicionarEvento #termino').prop("disabled", false);										
										
										$('#adicionarEvento #observacao').val('');
										$('#adicionarEvento #observacao').prop("disabled", false);
										
										$("#gravar").show();
										$("#editar").hide();
										$("#cancelar").hide();
										
										$('#adicionarEvento').modal('show');
									}
								}
							},	

							eventClick: function (info) {
							
								$('#adicionarEvento #handle').val(info.event.id);
								
								if (info.event.extendedProps.origem != 'TA_AGENDA') {
									$('#adicionarEvento #assunto').val(info.event.extendedProps.origemDescricao + ': ' + info.event.extendedProps.assunto);
									$('#adicionarEvento #assunto').prop("disabled", true);									
								}
								else{
									$('#adicionarEvento #assunto').val(info.event.extendedProps.assunto);
									$('#adicionarEvento #assunto').prop("disabled", true);
								}
								
								$('#adicionarEvento #tipo').val(info.event.extendedProps.tipoHandle);
								$('#adicionarEvento #tipo').prop("disabled", true);
								$('#adicionarEvento #tipo').hide();

								$('#adicionarEvento #tipoDescricao').val(info.event.extendedProps.tipoNome);
								$('#adicionarEvento #tipoDescricao').prop("disabled", true);
								$('#adicionarEvento #tipoDescricao').show();
								
								$('#adicionarEvento #previsao').val(moment(info.event.start).format('YYYY-MM-DD'));
								$('#adicionarEvento #previsao').prop("disabled", true);
								
								$('#adicionarEvento #inicio').val(moment(info.event.start).format('HH:mm'));
								$('#adicionarEvento #inicio').prop("disabled", true);

								if (info.event.end != null){
									$('#adicionarEvento #termino').val(moment(info.event.end).format('HH:mm'));
								}

								$('#adicionarEvento #termino').prop("disabled", true);
								
								$('#adicionarEvento #observacao').val(info.event.extendedProps.observacao);
								$('#adicionarEvento #observacao').prop("disabled", true);
								
								if (info.event.extendedProps.origem != 'TA_AGENDA') {
									$("#gravar").hide();
									$("#editar").hide();
									$("#cancelar").hide();							
								}
								else{
									$("#gravar").hide();
									$("#editar").show();
									$("#cancelar").show();
								}								
								
								
								$('#adicionarEvento').modal('show');								
							},
							
							header: {
								left: 'adicionarEvento',
								center: 'title',
								right: 'today,prev,next'
							}, 

							views: {
								dayGridMonth: {
									titleFormat: {  year: 'numeric', month: 'short' }
								}
							},					
							
							defaultView: 'dayGridMonth',
							/*displayEventTime : false,*/
							editable: true,						
							events: '../../model/tarefa/GetEvento.php', 
							eventLimit: false,
							height: 'auto',
							/*navLinks: false,*/
							locale: 'pt-br',
							weekNumbers: false,
							weekNumbersWithinDays: false				
						});
					
						calendar.render();
					});
					
					</script>
					<style>					
						body {
							margin: 0px 0px;
							padding: 0;
							font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
							font-size: 14px;
						}
					
						#calendar {
							max-width: 900px;
							margin: 0 auto;
						}
						
						.container{
							margin-top: 0px;
						}
						
						.vermelho{
							color: red;
						}					
					</style>					
				<!--//fullcalendar -->	
			</head>
			<body>
				<div id="loader"></div>
				<div class="main-content">
					<!--left-fixed -navigation-->
					<div class=" sidebar" role="navigation">
						<div class="navbar-collapse">
							<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
								<?php
									include('../../view/estrutura/menu.php');
								?>
							</nav>
						</div>
					</div> 
					<!--left-fixed -navigation-->
				
					<!-- header-starts -->
					<div class="sticky-header header-section ">
						<!--toggle button start-->
						<button id="showLeftPush"><i class="fa fa-bars"></i></button>
						<!--toggle button end-->            
						<div class="topBar">Agenda</div>            
					</div>            
					<div class="clearfix"> </div>	
				</div>
				
-				<!-- main content start-->
                <div class="pageContent">	
					<div id='calendar'></div>
					
					<div class="modal fade" id="adicionarEvento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static">
						<div class="modal-dialog" role="document">
							<form id="addevent" method="POST" enctype="multipart/form-data">
								<div class="modal-content">
									<div class="modal-header">									
										<h4 class="modal-title text-center">Evento</h4>
									</div>
									<div class="modal-body">	
										<input type="hidden" id="handle" name="handle" value="">
										<div class="row">										
											<div class="col-md-12">												
												<span>Assunto<span class="vermelho">*</span></span>
												<input type="text" name="assunto" id="assunto" value="" class="editou form-control pulaCampoEnter" required="required">
											</div>
											<div class="col-md-6">												
												<span>Tipo<span class="vermelho">*</span></span>
												<select class="form-control" id="tipo" name="tipo" class="editou form-control pulaCampoEnter" required="required">
													<option selected disabled value="">Selecione...</option>
													<?php 
														foreach ($tiposAgenda as $tipoAgenda) { ?>
															<option value="<?= $tipoAgenda["HANDLE"] ?>"><?= $tipoAgenda["NOME"] ?></option>
													<?php } ?>
												</select>	
												<input type="text" name="tipoDescricao" id="tipoDescricao" value="" class="editou form-control pulaCampoEnter">											
											</div>
											<div class="col-md-2">
												<span>Previsão<span class="vermelho">*</span></span>
												<input type='date' value="" id="previsao" name="previsao" class="form-control pulaCampoEnter" required="required" />
											</div>
											<div class="col-md-2">
												<span>Início<span class="vermelho">*</span></span>
												<input type='time' value="" id="inicio" name="inicio" class="form-control pulaCampoEnter" required="required" />
											</div>
											<div class="col-md-2">
												<span>Término<span class="vermelho">*</span></span>
												<input type='time' value="" id="termino" name="termino" class="form-control pulaCampoEnter" required="required" />
											</div>	
											<div class="col-md-12">
												<span>Observação</span>
												<textarea class="form-control" rows="3" id="observacao" name="observacao" style="resize: none;"></textarea>
											</div>										
										</div>
									</div>
									<div class="modal-footer">									
										<button type="submit" id="gravar" class="btn btn-success">Gravar</button>
										<button type="button" id="editar" class="btn btn-default btn-primary Editar">Editar</button>
										<button type="button" id="cancelar" class="btn btn-default btn-danger Cancelar">Cancelar</button>
										<button type="button" id="fechar" class="btn btn-default btnFechar" data-dismiss="modal">Fechar</button>
									</div>
								</form>
  							</div>
						</div>	
					</div>	

					<!-- Classie -->
					<script src="../tecnologia/js/classie.js"></script>
					<!--scrolling js-->
					<script src="../tecnologia/js/jquery.nicescroll.js"></script>
					<script src="../tecnologia/js/script.js"></script>
					<!-- Bootstrap Core JavaScript -->
					<script src="../tecnologia/js/bootstrap.js"></script>
					<!-- SweetAlert -->
					<script type="text/javascript" src="../tecnologia/js/sweetalert/sweetalert.min.js"></script>
							
					<script type="text/javascript" src="../tecnologia/js/tarefa/Agenda.js"></script>
				</div>
			</body>
		</html>
<?php
	}
?>