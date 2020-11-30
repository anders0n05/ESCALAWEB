// seleciona radio ao clicar em <tr>
$(document).ready(function () {
	$('#reqtablenew td').dblclick(function () {
		$('#reqtablenew td').removeClass("activetr");

		$(this).addClass("activetr");

		$(this).parent('tr').find('[name="check[]"]').prop('checked', true);

		$('input:radio').each(function () {
			//Verifica qual está selecionado
			if ($(this).is(':checked')) {
				PedidoDeVenda = parseInt($(this).val());

				var PedidoDeVendaArr = $(this).val().split(';');

				for (var i = 0, len = PedidoDeVenda.length; i < len; i++) {
					var status = PedidoDeVendaArr[0];
					var PedidoDeVendaHandle = PedidoDeVendaArr[1];
				}
				var PedidoStatus = PedidoDeVendaArr[0];
				var PedidoDeVendaHandle = PedidoDeVendaArr[1];

				//$('#adicionarPedido').removeClass('display');
				$('#visualizarPedido').removeClass('display');
			}

			if (PedidoStatus == '1') {
				//Botoes grid
				$('#liberarPedido').removeClass('display');
				$('#excluirPedido').removeClass('display');

				$('#voltarPedido').addClass('display');
				$('#cancelarPedido').addClass('display');
			}
			else if (PedidoStatus == '2') {
				//Botoes grid 
				$('#liberarPedido').removeClass('display');
				$('#cancelarPedido').removeClass('display');

				$('#voltarPedido').addClass('display');
				$('#excluirPedido').addClass('display');
			}
			else if (PedidoStatus == '3') {
				//Botoes grid
				$('#voltarPedido').removeClass('display');

				$('#liberarPedido').addClass('display');
				$('#cancelarPedido').addClass('display');
				$('#excluirPedido').addClass('display');
			}
			else if (PedidoStatus == '4') {
				//Botoes grid
				$('#voltarPedido').removeClass('display');

				$('#liberarPedido').addClass('display');
				$('#cancelarPedido').addClass('display');
				$('#excluirPedido').addClass('display');
			}
			else if (PedidoStatus == '5') {
				//Botoes grid
				$('#voltarPedido').removeClass('display');

				$('#liberarPedido').addClass('display');
				$('#cancelarPedido').addClass('display');
				$('#excluirPedido').addClass('display');
			}
			else if (PedidoStatus == '6') {

				//Botoes grid
				$('#voltarPedido').removeClass('display');

				$('#liberarPedido').addClass('display');
				$('#cancelarPedido').addClass('display');
				$('#excluirPedido').addClass('display');
			}
			else if (PedidoStatus == '7') {

				//Botoes grid
				$('#voltarPedido').removeClass('display');

				$('#liberarPedido').addClass('display');
				$('#cancelarPedido').addClass('display');
				$('#excluirPedido').addClass('display');
			}
			else if (PedidoStatus == '8') {

				//Botoes grid
				$('#voltarPedido').removeClass('display');

				$('#liberarPedido').addClass('display');
				$('#cancelarPedido').addClass('display');
				$('#excluirPedido').addClass('display');
			}
		});

	});
});



function clickdownTipo() {
	$('#tipo').autocomplete('option', 'minLength', 0);
	$('#tipo').autocomplete('search', $('#tipo').val());
};
function clickdownStatus() {
	$('#situacao').autocomplete('option', 'minLength', 0);
	$('#situacao').autocomplete('search', $('#situacao').val());
};
function clickdownPedidoDeVenda() {
	$('#PedidoDeVenda').autocomplete('option', 'minLength', 0);
	$('#PedidoDeVenda').autocomplete('search', $('#PedidoDeVenda').val());
};
function clickdownPedido() {
	$('#transportador').autocomplete('option', 'minLength', 0);
	$('#transportador').autocomplete('search', $('#transportador').val());
};

$(document).ready(function () {

	$('button#visualizarPedido').click(function () {
		$('.modal').modal('hide');
		$('#loader').removeAttr('style');
		//Executa Loop entre todas as Radio buttons com o name de check 
		$('input:radio').each(function () {
			//Verifica qual está selecionado
			if ($(this).is(':checked')) {
				PedidoDeVendaCheck = parseInt($(this).val());

				var PedidoDeVendaArr = $(this).val().split(';');

				for (var i = 0, len = PedidoDeVendaCheck.length; i < len; i++) {
					var status = PedidoDeVendaArr[0];
					var handle = PedidoDeVendaArr[1];
				}

				var status = PedidoDeVendaArr[0];
				var handle = PedidoDeVendaArr[1];

				window.location.href = 'VisualizarPedidoDeVenda.php?handle=' + handle;
			}

		});
	});
});

$(document).ready(function () {

	$('#editarPedido').click(function () {
		$('.modal').modal('hide');
		$('#loader').removeAttr('style');

		//Executa Loop entre todas as Radio buttons com o name de check 
		$('input:radio').each(function () {
			//Verifica qual está selecionado
			if ($(this).is(':checked'))
				PedidoDeVenda = parseInt($(this).val());
		})

		bootbox.confirm("Você deseja alterar a Pedido da PedidoDeVenda " + PedidoDeVenda + "?", function (result) {
			//alert("Confirm result: " + result);
			if (result == true) {
				window.location.href = '../operacional/AlterarPedidoPedidoDeVenda.php?numeroPedidoDeVenda=' + PedidoDeVenda;
			}
		});
	});
});


function VoltarPedidoDeVenda() {
	$('.modal').modal('hide');
	$('#loader').removeAttr('style');

	$(this).find('[name="check[]"]').prop('checked', true);

	//Executa Loop entre todas as Radio buttons com o name de check 
	$('input:radio').each(function () {

		//Verifica qual está selecionado
		if ($(this).is(':checked')) {
			PedidoDeVendaCheck = parseInt($(this).val());

			var PedidoDeVendaArr = $(this).val().split(';');
			for (var i = 0, len = PedidoDeVendaCheck.length; i < len; i++) {
				var PedidoDeVendaStatus = PedidoDeVendaArr[0];
				var PedidoDeVendaHandle = PedidoDeVendaArr[1];
			}

			var PedidoDeVendaStatus = PedidoDeVendaArr[0];
			var PedidoDeVendaHandle = PedidoDeVendaArr[1];


			window.location.href = '../../controller/comercial/WebServicePedidoDeVendaController.php?metodo=Voltar&referencia=PedidoDeVenda&handle=' + PedidoDeVendaHandle;

		}

	})
}

function LiberarPedidoDeVenda() {
	$('.modal').modal('hide');
	$('#loader').removeAttr('style');

	$(this).find('[name="check[]"]').prop('checked', true);

	//Executa Loop entre todas as Radio buttons com o name de check 
	$('input:radio').each(function () {

		//Verifica qual está selecionado
		if ($(this).is(':checked')) {
			PedidoDeVendaCheck = parseInt($(this).val());

			var PedidoDeVendaArr = $(this).val().split(';');
			for (var i = 0, len = PedidoDeVendaCheck.length; i < len; i++) {
				var PedidoDeVendaStatus = PedidoDeVendaArr[0];
				var PedidoDeVendaHandle = PedidoDeVendaArr[1];
			}

			var PedidoDeVendaStatus = PedidoDeVendaArr[0];
			var PedidoDeVendaHandle = PedidoDeVendaArr[1];


			window.location.href = '../../controller/comercial/WebServicePedidoDeVendaController.php?metodo=Liberar&referencia=PedidoDeVenda&handle=' + PedidoDeVendaHandle;

		}

	})
}

function ExcluirPedidoDeVenda() {
	$('.modal').modal('hide');
	$('#loader').removeAttr('style');
	$(this).find('[name="check[]"]').prop('checked', true);

	//Executa Loop entre todas as Radio buttons com o name de check 
	$('input:radio').each(function () {

		//Verifica qual está selecionado
		if ($(this).is(':checked')) {
			PedidoDeVendaCheck = parseInt($(this).val());

			var PedidoDeVendaArr = $(this).val().split(';');
			for (var i = 0, len = PedidoDeVendaCheck.length; i < len; i++) {
				var PedidoDeVendaStatus = PedidoDeVendaArr[0];
				var PedidoDeVendaHandle = PedidoDeVendaArr[1];
			}

			var PedidoDeVendaStatus = PedidoDeVendaArr[0];
			var PedidoDeVendaHandle = PedidoDeVendaArr[1];


			window.location.href = '../../controller/comercial/WebServicePedidoDeVendaController.php?metodo=Excluir&referencia=PedidoDeVenda&handle=' + PedidoDeVendaHandle;

		}

	})
}

function CancelarPedidoDeVenda() {
	$('.modal').modal('hide');
	$('#loader').removeAttr('style');
	$(this).find('[name="check[]"]').prop('checked', true);

	//Executa Loop entre todas as Radio buttons com o name de check 
	$('input:radio').each(function () {

		//Verifica qual está selecionado
		if ($(this).is(':checked')) {
			PedidoDeVendaCheck = parseInt($(this).val());

			var PedidoDeVendaArr = $(this).val().split(';');
			for (var i = 0, len = PedidoDeVendaCheck.length; i < len; i++) {
				var PedidoDeVendaStatus = PedidoDeVendaArr[0];
				var PedidoDeVendaHandle = PedidoDeVendaArr[1];
			}

			var PedidoDeVendaStatus = PedidoDeVendaArr[0];
			var PedidoDeVendaHandle = PedidoDeVendaArr[1];

			var motivo = document.getElementById('motivo').value;

			window.location.href = '../../controller/comercial/WebServicePedidoDeVendaController.php?metodo=Cancelar&referencia=PedidoDeVenda&handle=' + PedidoDeVendaHandle + '&motivo=' + motivo;

		}

	})
}


//***Define Multiselect
function multiselection() {

	$('#situacao').multiselect({
		columns: 1,
		search: true
	});

	$('#transportador').multiselect({
		columns: 1,
		search: true
	});

	$('#cliente').multiselect({
		columns: 1,
		search: true
	});

	$('#filial').multiselect({
		columns: 1,
		search: true
	});

}


function limpaform() {
	$('input[type=datetime-local]').valueAsDate = '0000-00-00 00:00';
	$('option').removeAttr('selected');
	$('button#btnMultiselect').text("   ").attr({
		title: "Limpou"
	});

}
