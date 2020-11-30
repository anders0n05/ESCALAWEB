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

	$query = $connect->prepare("SELECT CASE WHEN (A.DATAENTREGA > A.DATAENTREGAATE) THEN 'Fora do prazo' 
										    WHEN (A.DATAENTREGA <= A.DATAENTREGAATE) THEN 'No prazo'  END SITUACAO,
									   A.NUMEROPEDIDO
								  FROM RA_PEDIDO A (NOLOCK)
								WHERE A.STATUS IN (4) --ENCERRADO
								  AND A.DATAENTREGA IS NOT NULL
								" . Sistema::getFiltroPostTexto("estado", "A.UFDESTINATARIO") . "
								" . Sistema::getFiltroPostDataPeriodo("periodo", "A.DATA") . "								
								ORDER BY 1
							   ") or die('Erro ao selecionar dados');
    $query->execute();

	$retorno_arr = array();

	$situacao = '';
	$num = '';	
	$qtd = 0;
	$pedidos = array();

    while($row = $query->FETCH(PDO::FETCH_ASSOC)){
		if (empty($situacao)){
			$situacao = $row['SITUACAO'];
		}

		if ($situacao == $row['SITUACAO']){
			$num .= $row['NUMEROPEDIDO'] . ";";
			$qtd++;
		}else{
			$situacoes[] = $situacao;
			$pedidos[] = $num;
			$quantidade[] = $qtd;

			$num = array();

			$situacao = $row['SITUACAO'];
			$num = $row['NUMEROPEDIDO'] . ";";
			$qtd = 1;
		}
	}

	$situacoes[] = $situacao;
	$pedidos[] = $num;
	$quantidade[] = $qtd;

	$retorno_arr = array(
		"labels" => $situacoes,
		"pedidos" => $pedidos,
		"borderColor" => "window.chartColors",
		"borderWidth" => 1,
		"datasets" => [
			array(
				"label" => "Situação de pedidos pendentes",
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
