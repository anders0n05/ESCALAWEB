<?php

include_once('../tecnologia/Sistema.php');

$connect = Sistema::getConexao();

$dados = "SELECT A.HANDLE HANDLE, 
		 		 A.NOME NOME
	    	FROM RA_TIPOPEDIDO A
     	   WHERE A.STATUS = 4
	   	   ORDER BY NOME";

$dadosPrepare = $connect->prepare($dados);
$dadosPrepare->execute();

$result = $dadosPrepare->fetchAll(PDO::FETCH_ASSOC);

Sistema::echoToJson($result);