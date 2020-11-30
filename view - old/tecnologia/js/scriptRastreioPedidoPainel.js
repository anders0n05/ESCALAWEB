jQuery(window).ready(function () {
	function DetalhePedido(prChat, prEvt) {
		var activePoints = prChat.getElementsAtEvent(prEvt);
		if (activePoints[0]) {
			var chartData = activePoints[0]['_chart'].config.data;
			var idx = activePoints[0]['_index'];
			var value = chartData.pedidos[idx];
			document.getElementById("numeroPedido").value = value;
			$('#formNumeroPedido').submit();			
		}
	}

	//define as opções globais do chartJS
	var option = {
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
	};

	//consulta ajax retornando JSON
	$.ajax({
		method: "post",
		data: { 
			estado: $('#pedidoEstadoFiltro').val(), 
			periodo: $('#periodoFiltro').val(),
		},
		url: "../../controller/rastreamento/getPedidosPendentesEtapa.php",
		async: false,
		dataType: 'json',
		success: function (data) {
			//inicializando pedidosPendentesEtapa
			var pedidosPendentesEtapa = document.getElementById('pedidosPendentesEtapa');
			var pedidosPendentesEtapaChart = new Chart(pedidosPendentesEtapa, {
				type: 'horizontalBar',
				data: data,
				options: option
			});

			pedidosPendentesEtapa.onclick = function (evt) {
				DetalhePedido(pedidosPendentesEtapaChart, evt);
			};
		}
	});

	//inicializando situacaoPedidosPendentes
	$.ajax({
		method: "post",
		data: { 
			estado: $('#pedidoEstadoFiltro').val(), 
			periodo: $('#periodoFiltro').val(),
		},
		url: "../../controller/rastreamento/getSituacaoPedidosPendentes.php",
		async: false,
		dataType: 'json',
		success: function (data) {
			//inicializando situacaoPedidosPendentes
			var situacaoPedidosPendentes = document.getElementById('situacaoPedidosPendentes');
			var situacaoPedidosPendentesChart = new Chart(situacaoPedidosPendentes, {
				type: 'horizontalBar',
				data: data,
				options: option
			});

			situacaoPedidosPendentes.onclick = function (evt) {
				DetalhePedido(situacaoPedidosPendentesChart, evt);
			};
		}
	});

	//inicializando pedidosPendentesPrazo
	$.ajax({
		method: "post",
		data: { 
			estado: $('#pedidoEstadoFiltro').val(), 
			periodo: $('#periodoFiltro').val(),
		},
		url: "../../controller/rastreamento/getPedidosPendentesPrazo.php",
		async: false,
		dataType: 'json',
		success: function (data) {
			var pedidosPendentesPrazo = document.getElementById('pedidosPendentesPrazo');
			var pedidosPendentesPrazoChart = new Chart(pedidosPendentesPrazo, {
				type: 'horizontalBar',
				data: data,
				options: option
			});

			pedidosPendentesPrazo.onclick = function (evt) {
				DetalhePedido(pedidosPendentesPrazoChart, evt);
			};
		}
	});

	//inicializando pedidosPendentesTransportadora
	$.ajax({
		method: "post",
		data: { 
			estado: $('#pedidoEstadoFiltro').val(), 
			periodo: $('#periodoFiltro').val(),
		},
		url: "../../controller/rastreamento/getPedidosPendentesTransportadora.php",
		async: false,
		dataType: 'json',
		success: function (data) {
			var pedidosPendentesTransportadora = document.getElementById('pedidosPendentesTransportadora');
			var pedidosPendentesTransportadoraChart = new Chart(pedidosPendentesTransportadora, {
				type: 'horizontalBar',
				data: data,
				options: option
			});

			pedidosPendentesTransportadora.onclick = function (evt) {
				DetalhePedido(pedidosPendentesTransportadoraChart, evt);
			};
		}
	});


	//inicializando pedidosUltimos30DiasTransportadora
	$.ajax({
		method: "post",
		data: { 
			estado: $('#pedidoEstadoFiltro').val(), 
			periodo: $('#periodoFiltro').val(),
		},
		url: "../../controller/rastreamento/getPedidosUltimos30DiasTransportadora.php",
		async: false,
		dataType: 'json',
		success: function (data) {
			var pedidosUltimos30DiasTransportadora = document.getElementById('pedidosUltimos30DiasTransportadora');
			var pedidosUltimos30DiasTransportadoraChart = new Chart(pedidosUltimos30DiasTransportadora, {
				type: 'horizontalBar',
				data: data,
				options: option
			});

			pedidosUltimos30DiasTransportadora.onclick = function (evt) {
				DetalhePedido(pedidosUltimos30DiasTransportadoraChart, evt);
			};
		}
	});


	//inicializando pedidosUltimos90DiasTransportadora
	$.ajax({
		method: "post",
		data: { 
			estado: $('#pedidoEstadoFiltro').val(), 
			periodo: $('#periodoFiltro').val(),
		},
		url: "../../controller/rastreamento/getPedidosUltimos90DiasTransportadora.php",
		async: false,
		dataType: 'json',
		success: function (data) {
			var pedidosUltimos90DiasTransportadora = document.getElementById('pedidosUltimos90DiasTransportadora');
			var pedidosUltimos90DiasTransportadoraChart = new Chart(pedidosUltimos90DiasTransportadora, {
				type: 'horizontalBar',
				data: data,
				options: option
			});

			pedidosUltimos90DiasTransportadora.onclick = function (evt) {
				DetalhePedido(pedidosUltimos90DiasTransportadoraChart, evt);
			};
		}
	});


	//inicializando pedidosPendentesEstado
	$.ajax({
		method: "post",
		data: { 
			estado: $('#pedidoEstadoFiltro').val(), 
			periodo: $('#periodoFiltro').val(),
		},
		url: "../../controller/rastreamento/getPedidosPendentesEstado.php/",
		async: false,
		dataType: 'json',
		success: function (data) {
			var pedidosPendentesEstado = document.getElementById('pedidosPendentesEstado');
			var pedidosPendentesEstadoChart = new Chart(pedidosPendentesEstado, {
				type: 'horizontalBar',
				data: data,
				options: option
			});

			pedidosPendentesEstado.onclick = function (evt) {
				DetalhePedido(pedidosPendentesEstadoChart, evt);
			};
		}
	});


	//inicializando pedidosPendentesUltimos30DiasEstado
	$.ajax({
		method: "post",
		data: { 
			estado: $('#pedidoEstadoFiltro').val(), 
			periodo: $('#periodoFiltro').val(),
		},
		url: "../../controller/rastreamento/getPedidosPendentesUltimos30DiasEstado.php",
		async: false,
		dataType: 'json',
		success: function (data) {
			var pedidosPendentesUltimos30DiasEstado = document.getElementById('pedidosPendentesUltimos30DiasEstado');
			var pedidosPendentesUltimos30DiasEstadoChart = new Chart(pedidosPendentesUltimos30DiasEstado, {
				type: 'horizontalBar',
				data: data,
				options: option
			});

			pedidosPendentesUltimos30DiasEstado.onclick = function (evt) {
				DetalhePedido(pedidosPendentesUltimos30DiasEstadoChart, evt);
			};
		}
	});
});