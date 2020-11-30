<?php
header('Content-Type: application/json');
include_once('../tecnologia/Sistema.php');


function random_color_part() {
    return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
}

function random_color() {
    return random_color_part() . random_color_part() . random_color_part();
}


$connect = Sistema::getConexao();

	$query = $connect->prepare("SELECT A.UFDESTINATARIO AS ESTADO, 
	                                   A.NUMEROPEDIDO NUMEROPEDIDO
								  FROM RA_PEDIDO A (NOLOCK)
								 WHERE A.DATA >= GETDATE()-30
								   AND A.DATAENTREGA IS NULL
								   AND A.UFDESTINATARIO IS NOT NULL
								   AND A.UFDESTINATARIO <> ''
								   " . Sistema::getFiltroPostTexto("estado", "A.UFDESTINATARIO") . "
								   " . Sistema::getFiltroPostDataPeriodo("periodo", "A.DATA") . "								
								  ORDER BY 1
							   ") or die('Erro ao selecionar dados');
    $query->execute();

	$retorno_arr = array();

	$estado = '';
	$num = '';	
	$qtd = 0;
	$pedidos = array();

    while($row = $query->FETCH(PDO::FETCH_ASSOC)){
		if (empty($estado)){
			$estado = $row['ESTADO'];
		}

		if ($estado == $row['ESTADO']){
			$num .= $row['NUMEROPEDIDO'] . ";";
			$qtd++;
		}else{
			$estados[] = strtoupper($estado);
			$pedidos[] = $num;
			$quantidade[] = $qtd;

			$num = array();

			$estado = $row['ESTADO'];
			$num = $row['NUMEROPEDIDO'] . ";";
			$qtd = 1;
		}
	}

	$estados[] = strtoupper($estado);
	$pedidos[] = $num;
	$quantidade[] = $qtd;


	$retorno_arr = array(
		"labels" => $estados,
		"pedidos" => $pedidos,
		"borderColor" => "window.chartColors",
		"borderWidth" => 1,
		"datasets" => [
			array(
				"label" => "Pedidos pendentes dos últimos ".Sistema::getPost('periodo')." de entrega por estado",
				"backgroundColor" => [
					'#'.random_color(),
					'#'.random_color(),
					'#'.random_color(),
					'#'.random_color(),
					'#'.random_color(),
					'#'.random_color(),
					'#'.random_color(),
					'#'.random_color(),
					'#'.random_color(),
					'#'.random_color(),
					'#'.random_color(),
					'#'.random_color(),
					'#'.random_color(),
					'#'.random_color(),
					'#'.random_color(),
					'#'.random_color(),
					'#'.random_color(),
					'#'.random_color(),
					'#'.random_color(),
					'#'.random_color(),
					'#'.random_color(),
					'#'.random_color(),
					'#'.random_color(),
					'#'.random_color(),
					'#'.random_color(),
					'#'.random_color(),
					'#'.random_color()
								],
				"borderWidth" => 1,
				"data" => $quantidade,
			)
		]
	);

echo json_encode($retorno_arr, JSON_PRETTY_PRINT);