<?php

include_once('../tecnologia/Sistema.php');

$connect = Sistema::getConexao();

$handleUsuario = Sistema::getUsuario();

$dados = "SELECT A.HANDLE,
				 A.APELIDO NOME
		    FROM MS_PESSOA A (NOLOCK)
		   WHERE EXISTS (SELECT 1 
		  				  FROM RA_PEDIDO X (NOLOCK)
						  WHERE X.CLIENTE = A.HANDLE) 
			 AND (EXISTS (SELECT 1
			 			   FROM MS_USUARIOPESSOA X (NOLOCK)
						  WHERE X.USUARIO = $handleUsuario
						    AND X.PESSOA = A.HANDLE)
			    OR NOT EXISTS (SELECT 1
								 FROM MS_USUARIOPESSOA X (NOLOCK)
								WHERE X.USUARIO = $handleUsuario))";

$dadosPrepare = $connect->prepare($dados);
$dadosPrepare->execute();

$result = $dadosPrepare->fetchAll(PDO::FETCH_ASSOC);

Sistema::echoToJson($result);