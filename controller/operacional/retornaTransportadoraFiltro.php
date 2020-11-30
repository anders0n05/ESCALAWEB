<?php

include_once('../tecnologia/Sistema.php');

$connect = Sistema::getConexao();

$dados = "SELECT A.HANDLE id,
		         A.APELIDO value
			FROM MS_PESSOA A 
		   WHERE A.STATUS = 4
			 AND A.EHTRANSPORTADOR = 'S'
		   ORDER BY APELIDO ASC";
                            
$dados = $connect->prepare($dados);

$dados->execute();

$dados->execute();
echo json_encode($dados->fetchAll(PDO::FETCH_ASSOC));
