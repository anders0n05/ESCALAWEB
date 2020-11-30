<?php
include_once('../tecnologia/Sistema.php');

$usuario = $_SESSION['usuario'];
$senha = $_SESSION['senha'];
$senhaNaoCriptografada = $_SESSION['senhaNaoCriptografada'];

$ContaTesouraria = Sistema::getPost('ContaTesouraria');
$ContaTesourariaHandle = Sistema::getPost('ContaTesourariaHandle');
$filialPedidoDeVenda = Sistema::getPost('filialPedidoDeVenda');
$filialPedidoDeVendaHandle = Sistema::getPost('filialPedidoDeVendaHandle');
$tipo = Sistema::getPost('tipo');
$tipoHandle = Sistema::getPost('tipoHandle');
$cliente = Sistema::getPost('cliente');
$clienteHandle = Sistema::getPost('clienteHandle');
$dataPedidoDeVenda = date('Y-m-d', strtotime(Sistema::getPost('data')));
$horaPedidoDeVenda = date('H:i', strtotime(Sistema::getPost('data')));
$vendedor = Sistema::getPost('vendedor');
$vendedorHandle = Sistema::getPost('vendedorHandle');
$FormaPagamento = Sistema::getPost('FormaPagamento');
$FormaPagamentoHandle = Sistema::getPost('FormaPagamentoHandle');
$CondicaoPagamento = Sistema::getPost('CondicaoPagamento');
$CondicaoPagamentoHandle = Sistema::getPost('CondicaoPagamentoHandle');
$frete = Sistema::getPost('frete');
$freteHandle = Sistema::getPost('freteHandle');
$transportador = Sistema::getPost('transportador');
$transportadorHandle = Sistema::getPost('transportadorHandle');
$tabela = Sistema::getPost('tabela');
$tabelaHandle = Sistema::getPost('tabelaHandle');
$lista = Sistema::getPost('lista');
$listaHandle = Sistema::getPost('listaHandle');
$observacao = Sistema::getPost('observacao');
$observacaoUsoInterno = Sistema::getPost('observacaoUsoInterno');
$naturezaOperacaoHandle = Sistema::getPost('naturezaOperacaoHandle');
$naturezaOperacao = Sistema::getPost('naturezaOperaca');
$entregarAte = date('Y-m-d H:i:s', strtotime(Sistema::getPost('entregarAte')));

$referencia = Sistema::getGet('referencia');
$metodo = Sistema::getGet('metodo');
$motivo = Sistema::getGet('motivo');

$mensagem = NULL;
$protocolo = NULL;
$sucesso = NULL;

$pedidoDeVendaHandle = Sistema::getGet('handle');

$_SESSION['ContaTesouraria'] = $ContaTesouraria;
$_SESSION['ContaTesourariaHandle'] = $ContaTesourariaHandle;
$_SESSION['filialPedidoDeVenda'] = $filialPedidoDeVenda;
$_SESSION['filialPedidoDeVendaHandle'] = $filialPedidoDeVendaHandle;
$_SESSION['tipo'] = $tipo;
$_SESSION['tipoHandle'] = $tipoHandle;
$_SESSION['cliente'] = $cliente;
$_SESSION['clienteHandle'] = $clienteHandle;
$_SESSION['data'] = $dataPedidoDeVenda;
$_SESSION['hora'] = $horaPedidoDeVenda;
$_SESSION['vendedor'] = $vendedor;
$_SESSION['vendedorHandle'] = $vendedorHandle;
$_SESSION['FormaPagamento'] = $FormaPagamento;
$_SESSION['FormaPagamentoHandle'] = $FormaPagamentoHandle;
$_SESSION['CondicaoPagamento'] = $CondicaoPagamento;
$_SESSION['CondicaoPagamentoHandle'] = $CondicaoPagamentoHandle;
$_SESSION['frete'] = $frete;
$_SESSION['freteHandle'] = $freteHandle;
$_SESSION['transportador'] = $transportador;
$_SESSION['transportadorHandle'] = $transportadorHandle;
$_SESSION['tabela'] = $tabela;
$_SESSION['tabelaHandle'] = $tabelaHandle;
$_SESSION['lista'] = $lista;
$_SESSION['listaHandle'] = $listaHandle;
$_SESSION['observacao'] = $observacao;
$_SESSION['observacaoUsoInterno'] = $observacaoUsoInterno;
$_SESSION['entregarAte'] = $entregarAte;
$_SESSION['naturezaOperacaoHandle'] = $naturezaOperacaoHandle;
$_SESSION['naturezaOperacao'] = $naturezaOperacao;
$_SESSION['observacaoUsoInterno'] = $observacaoUsoInterno;

try {
	if($metodo == 'Cancelar'){
    	$params = array("handle" => $pedidoDeVendaHandle, "motivo" => $motivo);
	}
	else if($metodo == 'Alterar'){
		$params = array(
		"handle" => $pedidoDeVendaHandle, 
		"filial" => $filialPedidoDeVendaHandle,
		"tipo" => $tipoHandle,
		"data" => $dataPedidoDeVenda.'T'.$horaPedidoDeVenda,
		"cliente" => $clienteHandle,
		"vendedor" => $vendedorHandle,
		"condicaoPagamento" => $CondicaoPagamentoHandle,
		"formaPagamento" => $FormaPagamentoHandle,
		"contaTesouraria" => $ContaTesourariaHandle,
		"frete" => $freteHandle,
		"transportador" => $transportadorHandle,
		"observacao" => $observacao,
		"observacaoInterna" => $observacaoUsoInterno,
		"naturezaOperacao" => $naturezaOperacaoHandle,
		"entregarAte" => $entregarAte,
		"tabelaPreco" => $tabelaHandle,
		"listaPreco" => $listaHandle
		);
	}
	else if($metodo == 'Inserir'){
		$params = array(
		"filial" => $filialPedidoDeVendaHandle,
		"tipo" => $tipoHandle,
		"data" => $dataPedidoDeVenda.'T'.$horaPedidoDeVenda,
		"cliente" => $clienteHandle,
		"vendedor" => $vendedorHandle,
		"condicaoPagamento" => $CondicaoPagamentoHandle,
		"formaPagamento" => $FormaPagamentoHandle,
		"contaTesouraria" => $ContaTesourariaHandle,
		"frete" => $freteHandle,
		"transportador" => $transportadorHandle,
		"observacao" => $observacao,
		"observacaoInterna" => $observacaoUsoInterno,
		"naturezaOperacao" => $naturezaOperacaoHandle,
		"entregarAte" => $entregarAte,
		"tabelaPreco" => $tabelaHandle,
		"listaPreco" => $listaHandle
		);
	}
	else{
		$params = array("handle" => $pedidoDeVendaHandle);
	}
	
	/*print_r($params);
	exit;*/
    
   $webservice = 'Venda';
   include_once('../tecnologia/WebService.php');
   
   if($WebServiceOffline){
		$_SESSION['mensagem'] = 'Erro ao conectar com o WebService, tente novamente mais tarde 1';
		$_SESSION['retornoPedido'] =  true;
		header('Location: ../../view/comercial/'.$referencia.'.php?handle='.$pedidoDeVendaHandle.'&referencia='.$referencia);
		exit;
	}

    $result = $clientSoap->__soapCall($metodo."PedidoVenda", array($metodo."PedidoVenda" => array("pedidoVenda" => $params)));
    
	$resultString = $metodo.'PedidoVendaResult';
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
	$_SESSION['mensagem'] = 'Erro ao conectar com o WebService, tente novamente mais tarde ';
		$_SESSION['retornoPedido'] =  true;

		header('Location: ../../view/comercial/'.$referencia.'.php?handle='.$pedidoDeVendaHandle.'&referencia='.$referencia);
	}
	
	if($sucesso == 'True'){
		$_SESSION['protocolo'] = $protocolo;
		header('Location: ../../view/comercial/'.$referencia.'.php?handle='.$pedidoDeVendaHandle.'&referencia='.$referencia);
		
	}
	else if($sucesso == 'False'){
		$_SESSION['mensagem'] = $mensagem;
		$_SESSION['retornoPedido'] =  true;
		header('Location: ../../view/comercial/'.$referencia.'.php?handle='.$pedidoDeVendaHandle.'&referencia='.$referencia);
	}

} 
catch (SoapFault $e) {
    var_dump($e->getMessage());
		
		$_SESSION['mensagem'] = 'Erro ao conectar com o WebService, tente novamente mais tarde';
		$_SESSION['retornoPedido'] =  true;
		header('Location: ../../view/comercial/'.$referencia.'.php?handle='.$pedidoDeVendaHandle.'&referencia='.$referencia);
}
?>