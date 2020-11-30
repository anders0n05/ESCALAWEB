<?php
	
	include_once('../tecnologia/Sistema.php');

	$connect = Sistema::getConexao();
	
	$dados = $connect->prepare("SELECT A.HANDLE id, 
									   A.NOME value,
									   A.EHGERARORDEMCOMPRAFORNECEDOR, 
									   A.EHGERARDOCUMENTOFORNECEDOR, 
									   A.EHGERARDOCUMENTOMOTORISTA
			 FROM OP_TIPOVIAGEMDESPESA A 
	 							 WHERE A.STATUS = 3
								   AND A.EHPERMITEUTILIZACAOWEB = 'S' 
							  ORDER BY value ASC
							   ");
	
	$dados->execute();
	echo json_encode($dados->fetchAll(PDO::FETCH_ASSOC));
?>