<?php

	include_once('../tecnologia/Sistema.php');

	$connect = Sistema::getConexao();
	
	$tabela = Sistema::getGet('tabela');
	$lista = Sistema::getGet('lista');

	$dados = $connect->prepare("SELECT A.HANDLE id, A.NOME value, B1.SIGLA UNIDADE, A.UNIDADEMEDIDA UNIDADEHANDLE, A.OBSERVACAO INFORMACAOTECNICA
								FROM MT_ITEM A  
								LEFT JOIN MT_TIPOITEM B0 ON A.TIPO = B0.HANDLE
								LEFT JOIN MT_UNIDADEMEDIDA B1 ON A.UNIDADEMEDIDA = B1.HANDLE
								WHERE A.EMPRESA = '".$empresa."'
								AND (     A.STATUS = 4  
									AND A.TIPO IN (1, 2)  
									AND EXISTS (SELECT 1                
										FROM MT_ITEMOPERACAOFISCAL X               
										WHERE X.ITEM = A.HANDLE                 
										AND X.NATUREZA = 2                 
										AND X.STATUS = 3 ))
								AND EXISTS (SELECT X.HANDLE id, X.VALOR value
								FROM CM_LISTAITEM X
								WHERE X.ITEM = A.HANDLE
								AND X.LISTA = '".$lista."'
								AND X.TABELA = '".$tabela."'
								AND X.STATUS = 4)
								AND ( (A.STATUS = 4 ) )
								ORDER BY value ASC 
							   ");
	$dados->execute();
	
	echo json_encode($dados->fetchAll(PDO::FETCH_ASSOC));
?>