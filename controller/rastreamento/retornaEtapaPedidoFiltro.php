<?php

include_once('../tecnologia/Sistema.php');

$connect = Sistema::getConexao();

$dados = "SELECT A.HANDLE HANDLE, 
			 	 A.NOME NOME
			FROM RA_TIPOETAPA A
		   WHERE A.STATUS = 4
			 AND EXISTS(SELECT X.HANDLE
					  	  FROM RA_TIPOPEDIDOETAPA X
						 INNER JOIN RA_TIPOPEDIDO X1 ON X1.HANDLE = X.TIPOPEDIDO
						 WHERE X.ETAPA = A.HANDLE
						   AND X.STATUS = 4
				 		   AND X1.STATUS = 4)
	       ORDER BY NOME";

$dadosPrepare = $connect->prepare($dados);
$dadosPrepare->execute();

$result = $dadosPrepare->fetchAll(PDO::FETCH_ASSOC);

Sistema::echoToJson($result);