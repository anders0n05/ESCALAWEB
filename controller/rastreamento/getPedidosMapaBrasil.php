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

	$vQuantidade = $connect->query("SELECT COUNT(A.HANDLE) TOTAL 
									  FROM RA_PEDIDO A (NOLOCK)
								 	 INNER JOIN MS_ESTADO B (NOLOCK) ON B.SIGLA = A.UFDESTINATARIO
								 	 INNER JOIN MS_PAIS C (NOLOCK) ON C.HANDLE = B.PAIS
									 WHERE C.NOME = 'BRASIL'
								       AND A.UFDESTINATARIO <> 'EX'
								       AND A.STATUS <> 3 ")->fetchColumn();

	$query = $connect->prepare("SELECT COUNT(A.HANDLE) QUANTIDADE,
									   B.NOME ESTADO
								  FROM RA_PEDIDO A (NOLOCK)
								 INNER JOIN MS_ESTADO B (NOLOCK) ON B.SIGLA = A.UFDESTINATARIO
								 INNER JOIN MS_PAIS C (NOLOCK) ON C.HANDLE = B.PAIS
								 WHERE C.NOME = 'BRASIL'
								   AND A.UFDESTINATARIO <> 'EX'
								   AND A.STATUS <> 3 --CANCELADO
								 GROUP BY B.NOME
								 ORDER BY B.NOME") or die('Erro ao selecionar dados');
    $query->execute();

	$vResult = array();

    while($row = $query->FETCH(PDO::FETCH_ASSOC)){
		$vSituacao['ESTADO'] = $row['ESTADO'];
		$vSituacao['QUANTIDADE'] = $row['QUANTIDADE'];
		$vSituacao['TOTAL'] = $vQuantidade;
		$vSituacao['PERCENTUAL'] = round(((100 / $vSituacao['TOTAL']) * $vSituacao['QUANTIDADE']), 2);

		$vResult[] = $vSituacao;
	}
	
echo json_encode($vResult, JSON_PRETTY_PRINT);