<?php
	
	include_once('../tecnologia/Sistema.php');

	$connect = Sistema::getConexao();
	
	$dados = $connect->prepare("SELECT A.HANDLE, A.NOME 
FROM MS_PESSOA A 
WHERE A.STATUS = 4
ORDER BY A.NOME


							   ");
	
	$dados->execute();
	
    $result = $dados->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(array('data'=>$result));

?>