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

	$query = $connect->prepare("SELECT A.NUMEROPEDIDO NUMEROPEDIDO,
									   C.NOME SITUACAO
								  FROM RA_PEDIDO A (NOLOCK)
								 INNER JOIN RA_PEDIDOETAPA B ON B.PEDIDO = A.HANDLE AND B.HANDLE = (SELECT MAX(X.HANDLE)
																  									  FROM RA_PEDIDOETAPA X
																 									 WHERE X.PEDIDO = A.HANDLE
																   									   AND X.STATUS = 9) --ENCERRADO
								 INNER JOIN RA_TIPOETAPA C ON C.HANDLE = B.ETAPA
							     WHERE 1 = 1
								   AND A.STATUS NOT IN (3) --CANCELADO E ENCERRADO
								   " . Sistema::getFiltroPostTexto("estado", "A.UFDESTINATARIO") . "
								   " . Sistema::getFiltroPostDataPeriodo("periodo", "A.DATA") . "								
								ORDER BY 2") or die('Erro ao selecionar dados');
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
			$etapa[] = strtoupper($situacao);
			$pedidos[] = $num;
			$quantidade[] = $qtd;

			$num = array();

			$situacao = $row['SITUACAO'];
			$num = $row['NUMEROPEDIDO'] . ";";
			$qtd = 1;
		}
	}

	$etapa[] = strtoupper($situacao);
	$pedidos[] = $num;
	$quantidade[] = $qtd;

	$retorno_arr = array(
		"labels" => $etapa,
		"pedidos" => $pedidos,
		"borderColor" => "window.chartColors",
		"borderWidth" => 1,
		"datasets" => [
			array(
				"label" => "Pedidos pendentes por etapa",
				"backgroundColor" => [
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