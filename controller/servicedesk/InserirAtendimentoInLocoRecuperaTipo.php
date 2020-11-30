<?php

	include_once('../tecnologia/Sistema.php');

	$connect = Sistema::getConexao();


	$dados = $connect->prepare("SELECT A.NOME value,
							   A.HANDLE id, 
							   A.EHALTERAPERCENTUAL, 
							   A.PERCENTUALREEMBOLSO, 
							   A.VALORREEMBOLSO,
							   (SELECT X1.HANDLE
								  FROM SD_TIPOINLOCODESPESADESPESA X
								 INNER JOIN MT_ITEM X1 ON X1.HANDLE = X.ITEM
								 WHERE X.TIPOINLOCODESPESA = A.HANDLE
								   AND NOT EXISTS(SELECT Y.HANDLE 
													FROM SD_TIPOINLOCODESPESADESPESA Y 
												   WHERE Y.TIPOINLOCODESPESA = A.HANDLE
													 AND Y.HANDLE <> X.HANDLE)) DESPESAHANDLE,
													 (SELECT X1.NOME
								  FROM SD_TIPOINLOCODESPESADESPESA X
								 INNER JOIN MT_ITEM X1 ON X1.HANDLE = X.ITEM
								 WHERE X.TIPOINLOCODESPESA = A.HANDLE
								   AND NOT EXISTS(SELECT Y.HANDLE 
													FROM SD_TIPOINLOCODESPESADESPESA Y 
												   WHERE Y.TIPOINLOCODESPESA = A.HANDLE
													 AND Y.HANDLE <> X.HANDLE)) DESPESA
						  FROM SD_TIPOINLOCODESPESA A
						 WHERE A.STATUS = 4
						   AND A.EHPERMITEUTILIZACAOWEB = 'S'
						 GROUP BY A.NOME, 
								  A.HANDLE, 
								  A.EHALTERAPERCENTUAL, 
								  A.PERCENTUALREEMBOLSO, 
								  A.VALORREEMBOLSO
						 ORDER BY NOME ASC
							   ");
	$dados->execute();
	
	echo json_encode($dados->fetchAll(PDO::FETCH_ASSOC));
?>