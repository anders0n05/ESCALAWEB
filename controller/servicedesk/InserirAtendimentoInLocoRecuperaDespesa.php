<?php

	include_once('../tecnologia/Sistema.php');

	$connect = Sistema::getConexao();

	
if(isset($_GET['tiposelecionado']) and $_GET['tiposelecionado'] > 0){
	
	$dados = $connect->prepare("  SELECT A.HANDLE id, A.NOME value 
                                        FROM MT_ITEM A 
                                       WHERE A.STATUS = 4
                                         AND A.TIPO = 2
                                         AND A.EMPRESA = '".$empresa."'   
                                         AND (    EXISTS(SELECT B.HANDLE 
                                                           FROM SD_TIPOINLOCODESPESADESPESA B
                                                          WHERE B.TIPOINLOCODESPESA = '".$_GET['tiposelecionado']."'
                                                            AND B.ITEM = A.HANDLE)
                                               OR
                                              NOT EXISTS(SELECT B.HANDLE 
                                                           FROM SD_TIPOINLOCODESPESADESPESA B
                                                          WHERE B.TIPOINLOCODESPESA = '".$_GET['tiposelecionado']."'))
                                       ORDER BY value");

}
else{
	
	$dados = $connect->prepare("SELECT A.HANDLE id, A.NOME value 
								FROM MT_ITEM A 
								WHERE A.EMPRESA = '".$empresa."'
								AND ( (A.STATUS = 4 ) )
								AND ( A.TIPO = 2 )
							    ORDER BY value ASC");
								
	}		
					   
	$dados->execute();
	
	
	echo json_encode($dados->fetchAll(PDO::FETCH_ASSOC));

	
?>