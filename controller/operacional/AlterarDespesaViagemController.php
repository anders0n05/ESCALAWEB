<?php
include_once('../tecnologia/Sistema.php');

$usuario = $_SESSION['usuario'];
$senha = $_SESSION['senha'];
$senhaNaoCriptografada = $_SESSION['senhaNaoCriptografada'];

$viagemDespesa = Sistema::getGet('despesa');

$tipo = Sistema::getPost('tipo');
$tipoHandle = Sistema::getPost('tipoHandle');
$viagem = Sistema::getPost('viagem');
$viagemHandle = Sistema::getPost('viagemHandle');
$data = date('Y-m-d', strtotime(Sistema::getPost('data')));
$hora = date('H:i:s', strtotime(Sistema::getPost('data')));
$quantidade = Sistema::getPost('quantidade');
$ValorUnitario = Sistema::getPost('ValorUnitario');
$ValorTotal = Sistema::getPost('ValorTotal');
$despesa = Sistema::getPost('despesa');
$despesaHandle = Sistema::getPost('despesaHandle');
$fornecedor = Sistema::getPost('fornecedor');
$fornecedorHandle = Sistema::getPost('fornecedorHandle');
$FormaPagamento = Sistema::getPost('FormaPagamento');
$FormaPagamentoHandle = Sistema::getPost('FormaPagamentoHandle');
$CondicaoPagamento = Sistema::getPost('CondicaoPagamento');
$CondicaoPagamentoHandle = Sistema::getPost('CondicaoPagamentoHandle');
$observacao = Sistema::getPost('observacao');

$mensagem = null;
$protocolo = null;
$sucesso = null;

try {
    $params = array(
		"viagemDespesa" => $viagemDespesa,
        "despesa" => $despesaHandle,
        "filial" => $filial,
        "data" => $data.'T'.$hora,
        "quantidade" => $quantidade,
        "valorUnitario" => $ValorUnitario,
        "valorTotal" => $ValorTotal,
        "tipo" => $tipoHandle,
        "fornecedor" => $fornecedorHandle,
        "formaPagamento" => $FormaPagamentoHandle,
        "condicaoPagamento" => $CondicaoPagamentoHandle,
        "observacao" => $observacao
    );
	
	$webservice = 'Operacional';
    include_once('../tecnologia/WebService.php');
	if($WebServiceOffline){
		$_SESSION['mensagem'] = 'Erro ao conectar com o WebService, tente novamente mais tarde';
		header('Location: ../../view/operacional/VisualizarDespesaViagem.php?despesa='.$viagemDespesa);
		exit;
	}

    $result = $clientSoap->__soapCall("AlterarViagemDespesa", array("AlterarViagemDespesa" => array("viagemDespesa" => $params)));
     
	$retorno = $result->AlterarViagemDespesaResult;
	
	if(!empty($retorno->mensagem)){
		$mensagem = $retorno->mensagem; 
	}
	if(!empty($retorno->protocolo)){
		$protocolo = $retorno->protocolo;
	}
	if(!empty($retorno->sucesso)){
		$sucesso = $retorno->sucesso; 
	}
	
	if($mensagem == null and $protocolo == null and $sucesso == null){
	$_SESSION['mensagem'] = 'Erro ao conectar com o WebService, tente novamente mais tarde';
		
	header('Location: ../../view/operacional/VisualizarDespesaViagem.php?despesa='.$viagemDespesa);	
	}
		
	if($sucesso == 'True'){
		$_SESSION['protocolo'] = $protocolo;
		header('Location: ../../view/operacional/VisualizarDespesaViagem.php?despesa='.$viagemDespesa);	
	}
	else if($sucesso == 'False'){
		$_SESSION['mensagem'] = $mensagem;
		
		header('Location: ../../view/operacional/VisualizarDespesaViagem.php?despesa='.$viagemDespesa);
	}
} 
catch (SoapFault $e) {
    //var_dump($e->getMessage());
		
	$_SESSION['mensagem'] = 'Erro ao conectar com o WebService, tente novamente mais tarde';
	header('Location: ../../view/operacional/VisualizarDespesaViagem.php?despesa='.$viagemDespesa);
}
?>