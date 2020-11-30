<?php
	
	include_once('../tecnologia/Sistema.php');

	$connect = Sistema::getConexao();
	
	$empresa = $_SESSION['empresa'];
	
	$queryPessoasUsuario = "SELECT PESSOA
							FROM MS_USUARIOPESSOA
							WHERE USUARIO = $handleUsuario";


	$queryPessoasUsuario = $connect->prepare($queryPessoasUsuario);

	$queryPessoasUsuario->execute();
	$rowPessoasUsuario = $queryPessoasUsuario->fetch(PDO::FETCH_ASSOC);

	if($rowPessoasUsuario['PESSOA'] > 0){

	foreach($rowPessoasUsuario as $handlePessoaUsuario)
		$wherePessoasUsuario = "AND EXISTS (
								SELECT XA.HANDLE FROM AM_CARREGAMENTO XA
								LEFT JOIN AM_CARREGAMENTOITEM XB ON XB.CARREGAMENTO = XA.HANDLE
								LEFT JOIN AM_EMBALAGEM XC ON XC.HANDLE = XB.EMBALAGEM
								LEFT JOIN AM_ORDEM XD ON XD.HANDLE = XC.ORDEM
								WHERE ( XA.TRANSPORTADORA IN (".$handlePessoaUsuario.") 
								OR XA.CLIENTE IN (".$handlePessoaUsuario.") )
								AND XD.HANDLE = A.HANDLE
								AND XA.STATUS NOT IN (4, 5)
								AND XD.STATUS NOT IN (5, 6)
							    )
							   ";
	}
	else{
		$wherePessoasUsuario = "";
	}

	$dados  =  "SELECT A.HANDLE, A.NUMEROPEDIDO
				FROM AM_ORDEM A
				WHERE EXISTS (
					SELECT A.HANDLE
					FROM AM_CARREGAMENTO
					WHERE EMPRESA = 1
					)
				AND A.NUMEROPEDIDO IS NOT NULL 
				AND A.NUMEROPEDIDO > ''
				AND A.STATUS NOT IN (5, 6)
				".$wherePessoasUsuario." 
			   ";
							   
	$dados = $connect->prepare($dados);
	
	$dados->execute();
	
    $result = $dados->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(array('data'=>$result));

?>

