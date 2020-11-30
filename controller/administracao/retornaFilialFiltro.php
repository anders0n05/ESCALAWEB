<?php

include_once('../tecnologia/Sistema.php');

$connect = Sistema::getConexao();

$dados = "SELECT A.HANDLE HANDLE, 
		 A.NOME NOME
	    FROM MS_FILIAL A
     	   WHERE A.EMPRESA = $empresa
             AND A.STATUS = 4
	   ORDER BY NOME";

$dadosPrepare = $connect->prepare($dados);
$dadosPrepare->execute();

$result = $dadosPrepare->fetchAll(PDO::FETCH_ASSOC);

Sistema::echoToJson(array('data' => $result));