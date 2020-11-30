<?php

include_once('../tecnologia/Sistema.php');

$connect = Sistema::getConexao();

$dados = "SELECT A.HANDLE,
				 A.CODIGOREFERENCIA + ' - ' +  A.NOME NOME
			FROM MS_UNIDADENEGOCIOCLIENTE A
		   WHERE EXISTS (SELECT 1 
		  				   FROM MS_PESSOACLIENTEUNIDADE X
						  INNER JOIN MS_PESSOACLIENTE Y ON Y.HANDLE = X.CLIENTE
		 				  WHERE X.UNIDADENEGOCIOCLIENTE = A.HANDLE 
								" . Sistema::getFiltroPostLookupArray("cliente", "Y.PESSOA") . ")";

$dadosPrepare = $connect->prepare($dados);
$dadosPrepare->execute();

Sistema::echoToJson($dadosPrepare->fetchAll(PDO::FETCH_ASSOC));