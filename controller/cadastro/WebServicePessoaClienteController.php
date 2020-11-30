<?php
try {

	$params = array(
	"pessoa" => $protocolo,
	"formaPagamento" => $FormaPagamentoHandle,
	"condicaoPagamento" => $CondicaoPagamentoHandle
	);
	
    $result = $clientSoap->__soapCall("AlterarPessoaCliente", array("AlterarPessoaCliente" => array("pessoaCliente" => $params)));
    
	$resultString = 'AlterarPessoaClienteResult';
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