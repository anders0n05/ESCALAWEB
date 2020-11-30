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
								WHERE A.STATUS NOT IN (3, 4) --CANCELADO E ENCERRADO
								AND A.UFDESTINATARIO IS NOT NULL
								AND A.UFDESTINATARIO <> ''
								AND A.DATAENTREGA IS NULL
								" . Sistema::getFiltroPostTexto("estado", "A.UFDESTINATARIO") . "
								" . Sistema::getFiltroPostDataPeriodo("periodo", "A.DATA") . "								
								ORDER BY 1
							   ") or die('Erro ao selecionar dados');
    $query->execute();

	$retorno_arr = array();

	$uf = '';
	$qtd = 0;
	$num = '';
	$pedidos = array();

    while($row = $query->FETCH(PDO::FETCH_ASSOC)){
		if (empty($uf)){
			$uf = $row['ESTADO'];
		}

		if ($uf == $row['ESTADO']){
			$num .= $row['NUMEROPEDIDO'] . ";";
			$qtd++;
		}else{
			$estado[] = strtoupper($uf);
			$pedidos[] = $num;
			$quantidade[] = $qtd;

			$num = array();

			$uf = $row['ESTADO'];
			$num = $row['NUMEROPEDIDO'] . ";";
			$qtd = 1;
		}
	}

	$estado[] = strtoupper($uf);
	$pedidos[] = $num;
	$quantidade[] = $qtd;

	$retorno_arr = array(
		"labels" => $estado,
		"pedidos" => $pedidos,
		"borderColor" => "window.chartColors",
		"borderWidth" => 1,
		"datasets" => [
			array(
				"label" => "Pedidos pendentes de entrega por estado",
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