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
	$query = $connect->prepare(" SELECT B.NOME ESTADO		
								   FROM RA_PEDIDO A (NOLOCK)
								  INNER JOIN MS_ESTADO B (NOLOCK) ON B.SIGLA = A.UFDESTINATARIO
							      INNER JOIN MS_PAIS C (NOLOCK) ON C.HANDLE = B.PAIS
		    					  WHERE C.NOME = 'BRASIL'
			  					    AND A.UFDESTINATARIO <> 'EX'
			  					    AND A.STATUS <> 3 --CANCELADO 
								  GROUP BY B.NOME
							  	  ORDER BY ESTADO"
							) or die('Erro ao selecionar dados');
	$query->execute();

	$detalhe = $connect->prepare("SELECT B.APELIDO AS TRANSPORTADORA,
										 COUNT(A.HANDLE) QUANTIDADE,
										 (SELECT COUNT(X.HANDLE) FROM RA_PEDIDO X WHERE X.STATUS NOT IN(3,4) AND X.DATAENTREGA IS NULL) TOTAL,
										 E.NOME ESTADO
								    FROM RA_PEDIDO A (NOLOCK) 
								   INNER JOIN MS_PESSOA B (NOLOCK) ON B.HANDLE = A.TRANSPORTADORA
								   INNER JOIN MS_ESTADO E (NOLOCK) ON E.SIGLA = A.UFDESTINATARIO
								   WHERE A.STATUS NOT IN (3, 4) --CANCELADO E ENCERRADO
								     AND A.DATAENTREGA IS NULL
								   GROUP BY B.APELIDO, E.NOME") or die('Erro ao selecionar dados');
    $detalhe->execute();

	$vResult = array();
	
	while($rowEstado = $query->FETCH(PDO::FETCH_ASSOC)){
		$vSituacao = Array();
		$vSituacao['ESTADO'] = $rowEstado['ESTADO'];
		
		while($row = $detalhe->FETCH(PDO::FETCH_ASSOC)){
			if ($vSituacao['ESTADO'] == $row['ESTADO']){
				$vDetalhe = Array();
				$vDetalhe['TRANSPORTADORA'] = $row['TRANSPORTADORA'];
				$vDetalhe['QUANTIDADE'] = $row['QUANTIDADE'];
				$vDetalhe['PERCENTUAL'] = ((100 / $row['TOTAL']) * $row['QUANTIDADE']);
	
				$vSituacao['DETALHE'][] = $vDetalhe;
			}
		}

		$detalhe->execute();

		$vResult[] = $vSituacao;
	}
	
echo json_encode($vResult, JSON_PRETTY_PRINT);