<?php
include_once('../tecnologia/Sistema.php');

$usuario = $_SESSION['usuario'];
$senha = $_SESSION['senha'];
$senhaNaoCriptografada = $_SESSION['senhaNaoCriptografada'];

$sequencial = Sistema::getPost('sequencial');
$tabela = Sistema::getPost('tabela');
$tabelaHandle = Sistema::getPost('tabelaHandle');
$lista = Sistema::getPost('lista');
$listaHandle = Sistema::getPost('listaHandle');
$quantidade = Sistema::getPost('quantidade');
$ValorUnitario = Sistema::getPost('ValorUnitario');
$ValorTotal = Sistema::getPost('ValorTotal');
$TotalGeral = Sistema::getPost('TotalGeral');
$produto = Sistema::getPost('produto');
$produtoHandle = Sistema::getPost('produtoHandle');
$unidadeMedida = Sistema::getPost('unidadeMedida');
$unidadeMedidaHandle = Sistema::getPost('unidadeMedidaHandle');
$numeroPedidoDeVenda = Sistema::getPost('numeroPedidoDeVenda');
$almoxarifado = Sistema::getPost('almoxarifado');
$almoxarifadoHandle = Sistema::getPost('almoxarifadoHandle');
$complemento = Sistema::getPost('complemento');
$observacao = Sistema::getPost('observacao');
$informacaoTecnica = Sistema::getPost('informacaoTecnica');
$aplicacao = Sistema::getPost('aplicacao');
$aplicacaoHandle = Sistema::getPost('aplicacaoHandle');

$entregarAte = date('Y-m-d', strtotime(Sistema::getPost('entregarAte')));

$referencia = Sistema::getGet('referencia');
$metodo = Sistema::getGet('metodo');
$motivo = Sistema::getGet('motivo');
$pedidoDeVendaHandle = Sistema::getGet('handle');
$itemPedidoDeVendaHandle = Sistema::getGet('handleItem');

$mensagem = NULL;
$protocolo = NULL;
$sucesso = NULL;


$_SESSION['sequencial'] = $sequencial;
$_SESSION['tabela'] = $tabela;
$_SESSION['tabelaHandle'] = $tabelaHandle;
$_SESSION['lista'] = $lista;
$_SESSION['listaHandle'] = $listaHandle;
$_SESSION['quantidade'] = $quantidade;
$_SESSION['ValorUnitario'] = $ValorUnitario;
$_SESSION['ValorTotal'] = $ValorTotal;
$_SESSION['TotalGeral'] = $TotalGeral;
$_SESSION['produto'] = $produto;
$_SESSION['produtoHandle'] = $produtoHandle;
$_SESSION['unidadeMedida'] = $unidadeMedida;
$_SESSION['unidadeMedidaHandle'] = $unidadeMedidaHandle;
$_SESSION['numeroPedidoDeVenda'] = $numeroPedidoDeVenda;
$_SESSION['almoxarifado'] = $almoxarifado;
$_SESSION['almoxarifadoHandle'] = $almoxarifadoHandle;
$_SESSION['complemento'] = $complemento;
$_SESSION['observacao'] = $observacao;
$_SESSION['informacaoTecnica'] = $informacaoTecnica;
$_SESSION['aplicacao'] = $aplicacao;
$_SESSION['aplicacaoHandle'] = $aplicacaoHandle;

try {
	if($metodo == 'Cancelar'){
    	$params = array("handle" => $pedidoDeVendaHandle, "motivo" => $motivo);
	}
	else if($metodo == 'Alterar'){
		$params = array(
		"handle" => $itemPedidoDeVendaHandle,
		"item" => $produtoHandle,
		"aplicacao" => $aplicacaoHandle,
		"complemento" => $complemento,
		"unidade" => $unidadeMedidaHandle,
		"almoxarifado" => $almoxarifadoHandle,
		"quantidade" => $quantidade,
		"valorUnitario" => $ValorUnitario,
		"valorTotal" => $ValorTotal,
		"valorTotalGeral" => $TotalGeral,
		"observacao" => $observacao

		);
	}
	else if($metodo == 'Inserir'){
		$params = array(
		"pedidoVenda" => $pedidoDeVendaHandle,
		"item" => $produtoHandle,
		"aplicacao" => $aplicacaoHandle,
		"complemento" => $complemento,
		"unidade" => $unidadeMedidaHandle,
		"almoxarifado" => $almoxarifadoHandle,
		"quantidade" => $quantidade,
		"valorUnitario" => $ValorUnitario,
		"valorTotal" => $ValorTotal,
		"valorTotalGeral" => $TotalGeral,
		"observacao" => $observacao
		);
	}
	else{
		$params = array("handle" => $itemPedidoDeVendaHandle);
	}
    
   $webservice = 'Venda';
   include_once('../tecnologia/WebService.php');
   
   if($WebServiceOffline){
		$_SESSION['mensagem'] = 'Erro ao conectar com o WebService, tente novamente mais tarde';
		$_SESSION['retornoItemPedido'] =  true;
		header('Location: ../../view/comercial/'.$referencia.'.php?handleItem='.$itemPedidoDeVendaHandle.'&handle='.$pedidoDeVendaHandle.'&referencia='.$referencia);
		exit;
	}

    $result = $clientSoap->__soapCall($metodo."PedidoVendaItem", array($metodo."PedidoVendaItem" => array("pedidoVendaItem" => $params)));
    
	$resultString = $metodo.'PedidoVendaItemResult';
	$retorno = $result->$resultString;
	
	print_r($result);
	
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
	$_SESSION['retornoItemPedido'] =  true;
		header('Location: ../../view/comercial/'.$referencia.'.php?handleItem='.$itemPedidoDeVendaHandle.'&handle='.$pedidoDeVendaHandle.'&referencia='.$referencia);
	}
	
	if($sucesso == 'True'){
		$_SESSION['protocolo'] = $protocolo;
		header('Location: ../../view/comercial/'.$referencia.'.php?handleItem='.$itemPedidoDeVendaHandle.'&handle='.$pedidoDeVendaHandle.'&referencia='.$referencia);
		
	}
	else if($sucesso == 'False'){
		$_SESSION['mensagem'] = $mensagem;
		$_SESSION['retornoItemPedido'] =  true;
		header('Location: ../../view/comercial/'.$referencia.'.php?handleItem='.$itemPedidoDeVendaHandle.'&handle='.$pedidoDeVendaHandle.'&referencia='.$referencia);
	}

} 
catch (SoapFault $e) {
    var_dump($e->getMessage());
		
	$_SESSION['mensagem'] = 'Erro ao conectar com o WebService, tente novamente mais tarde';
	$_SESSION['retornoItemPedido'] =  true;
		header('Location: ../../view/comercial/'.$referencia.'.php?handleItem='.$itemPedidoDeVendaHandle.'&handle='.$pedidoDeVendaHandle.'&referencia='.$referencia);
}
?>