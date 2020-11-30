<?php
$queryEndereco = $connect->prepare("SELECT HANDLE FROM MS_PESSOAENDERECO WHERE PESSOA = '".$protocolo."' AND STATUS = 1 ");
$queryEndereco->execute();
$rowEndereco = $queryEndereco->fetch(PDO::FETCH_ASSOC);
$enderecoHandle = $rowEndereco['HANDLE'];

try {
	if($metodo == 'Cancelar'){
    	$params = array("handle" => $pessoaHandle, "motivo" => $motivo);
	}
	else if($metodo == 'Inserir'){
		$params = array(
		"pessoa" => $protocolo,
		"tipo" => "1",
		"motivo" => $motivoAlteracao,
		"cep" => $cep,
		"tipoLogradouro" => $tipoLogradouroHandle,
		"logradouro" => $logradouro,
		"numero" => $numeroEndereco,
		"ehSemNumero" => $ehSemNumero,
		"complemento" => $complementoEndereco,
		"pais" => $paisHandle,
		"estado" => $estadoHandle,
		"municipio" => $municipioHandle,
		"bairro" => $bairroHandle
		);
	}
	else if($metodo == 'Alterar'){
		
		$params = array(
		"handle" => $enderecoHandle,
		"tipo" => "1",
		"motivo" => $motivoAlteracao,
		"cep" => $cep,
		"tipoLogradouro" => $tipoLogradouroHandle,
		"logradouro" => $logradouro,
		"numero" => $numeroEndereco,
		"ehSemNumero" => $ehSemNumero,
		"complemento" => $complementoEndereco,
		"pais" => $paisHandle,
		"estado" => $estadoHandle,
		"municipio" => $municipioHandle,
		"bairro" => $bairroHandle
		);
	}
	else{
		$params = array("handle" => $enderecoHandle);
	}
	
    $result = $clientSoap->__soapCall($metodo."PessoaEndereco", array($metodo."PessoaEndereco" => array("pessoaEndereco" => $params)));
    
	$resultString = $metodo.'PessoaEnderecoResult';
	$retorno = $result->$resultString;
	
	if(!empty($retorno->mensagem)){
		$mensagem = $retorno->mensagem; 
	}
	if(!empty($retorno->protocolo)){
		$protocolo = $retorno->protocolo;
	}
	if(!empty($retorno->sucesso)){
		$sucesso = $retorno->sucesso; 
	}
	
	if($mensagem == NULL and $protocolo == NULL and $sucesso == NULL){
	$_SESSION['mensagem'] = 'Erro ao conectar com o WebService, tente novamente mais tarde';
		$_SESSION['retornoPessoa'] =  true;
		$_SESSION['metodo'] = $metodo;

		header('Location: ../../view/cadastro/'.$referencia.'.php?handle='.$pessoaHandle.'&referencia='.$referencia);
	}
	
	if($sucesso == 'True'){
		$_SESSION['protocolo'] = $protocolo;
		header('Location: ../../view/cadastro/'.$referencia.'.php?handle='.$pessoaHandle.'&referencia='.$referencia);
		
	}
	else if($sucesso == 'False'){
		$_SESSION['mensagem'] = $mensagem;
		$_SESSION['retornoPessoa'] =  true;
		$_SESSION['metodo'] = $metodo;
		header('Location: ../../view/cadastro/'.$referencia.'.php?handle='.$pessoaHandle.'&referencia='.$referencia);
	}
}
catch (SoapFault $e) {
    var_dump($e->getMessage());
		
	$_SESSION['mensagem'] = 'Erro ao conectar com o WebService, tente novamente mais tarde';
		$_SESSION['retornoPessoa'] =  true;
		$_SESSION['metodo'] = $metodo;
		header('Location: ../../view/cadastro/'.$referencia.'.php?handle='.$pessoaHandle.'&referencia='.$referencia);
}
?>