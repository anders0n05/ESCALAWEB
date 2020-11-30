<?php

include_once('../tecnologia/Sistema.php');

$connect = Sistema::getConexao();

$dados = $connect->prepare("SELECT A.HANDLE  id, ( CONVERT(VARCHAR(10), A.PREVISAO, 103) + ' ' + CONVERT(VARCHAR(10), A.PREVISAO, 108) + ' - ' + B.NOME) value, B.HANDLE DOCAHANDLE
							    FROM AM_PROGRAMACAODOCA A
							    INNER JOIN AM_DOCA B ON B.HANDLE = A.DOCA
							    WHERE  A.STATUS = 11 -- AGEXECUCAO
							    ORDER BY value DESC
							   ");
$dados->execute();

echo json_encode($dados->fetchAll(PDO::FETCH_ASSOC));
