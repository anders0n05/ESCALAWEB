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

	$query = $connect->prepare("SELECT A.UFDESTINATARIO AS ESTADO
								FROM RA_PEDIDO A (NOLOCK)
								WHERE A.UFDESTINATARIO IS NOT NULL
								AND A.UFDESTINATARIO <> ''
								GROUP BY A.UFDESTINATARIO")
								or die('Erro ao selecionar dados');

	$query->execute();

	$retorno_arr = array();

    while($row = $query->FETCH(PDO::FETCH_ASSOC)){		
		$estado[] = strtoupper( $row['ESTADO'] );
	}

echo json_encode($estado, JSON_PRETTY_PRINT);