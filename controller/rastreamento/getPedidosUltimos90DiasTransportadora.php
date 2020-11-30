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

	$query = $connect->prepare("SELECT B.APELIDO AS TRANSPORTADORA, 
	                                   A.NUMEROPEDIDO NUMEROPEDIDO
								  FROM RA_PEDIDO A (NOLOCK)
								 INNER JOIN MS_PESSOA B ON B.HANDLE = A.TRANSPORTADORA
								 WHERE A.STATUS NOT IN (3) --CANCELADO
								   AND A.DATAENTREGA IS NULL
								   AND A.DATA >= GETDATE()-90
								   " . Sistema::getFiltroPostTexto("estado", "A.UFDESTINATARIO") . "
								   " . Sistema::getFiltroPostDataPeriodo("periodo", "A.DATA") . "								
								 ORDER BY 1
							   ") or die('Erro ao selecionar dados');
    $query->execute();

	$retorno_arr = array();

	$transp = '';
	$num = '';	
	$qtd = 0;
	$pedidos = array();

    while($row = $query->FETCH(PDO::FETCH_ASSOC)){
		if (empty($transp)){
			$transp = $row['TRANSPORTADORA'];
		}

		if ($transp == $row['TRANSPORTADORA']){
			$num .= $row['NUMEROPEDIDO'] . ";";
			$qtd++;
		}else{
			$transportadoras[] = $transp;
			$pedidos[] = $num;
			$quantidade[] = $qtd;

			$num = array();

			$transp = $row['TRANSPORTADORA'];
			$num = $row['NUMEROPEDIDO'] . ";";
			$qtd = 1;
		}
	}

	$transportadoras[] = $transp;
	$pedidos[] = $num;
	$quantidade[] = $qtd;

	$retorno_arr = array(
		"labels" => $transportadoras,
		"pedidos" => $pedidos,
		"borderColor" => "window.chartColors",
		"borderWidth" => 1,
		"datasets" => [
			array(
				"label" => "Pedidos dos últimos ".Sistema::getPost('periodo')." dias por transportadora",
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