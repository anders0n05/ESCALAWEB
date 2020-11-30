<?php

	include_once('../tecnologia/Sistema.php');

	$connect = Sistema::getConexao();


	$dados = $connect->prepare("SELECT A.HANDLE id, A.NOME value
								FROM TR_APLICACAOITEM A 
								WHERE ( EXISTS (SELECT Z.HANDLE            
										FROM MT_ITEMOPERACAOFISCAL Z           
										WHERE Z.ITEM = 0            
										AND Z.NATUREZA = 2            
										AND Z.STATUS = 3            
										AND Z.APLICACAO = A.HANDLE))
								ORDER BY value ASC
							   ");
	$dados->execute();
	
	echo json_encode($dados->fetchAll(PDO::FETCH_ASSOC));
?>