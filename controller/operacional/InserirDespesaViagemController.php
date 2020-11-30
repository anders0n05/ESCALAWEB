<?php
include_once('../tecnologia/Sistema.php');

$usuario = $_SESSION['usuario'];
$senha = $_SESSION['senha'];
$senhaNaoCriptografada = $_SESSION['senhaNaoCriptografada'];

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

$referencia = Sistema::getGet('referencia');

$mensagem = null;
$protocolo = null;
$sucesso = null;

try {

    $params = array("viagem" => $viagemHandle,
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
		
		$_SESSION['tipo'] = $tipo;
		$_SESSION['tipoHandle'] = $tipoHandle;
		$_SESSION['viagem'] = $viagem;
		$_SESSION['viagemHandle'] = $viagemHandle;
		$_SESSION['data'] = $data;
		$_SESSION['hora'] = $hora;
		$_SESSION['quantidade'] = $quantidade;
		$_SESSION['ValorUnitario'] = $ValorUnitario;
		$_SESSION['mensaValorTotalgem'] = $ValorTotal;
		$_SESSION['despesa'] = $despesa;
		$_SESSION['despesaHandle'] = $despesaHandle;
		$_SESSION['fornecedor'] = $fornecedor;
		$_SESSION['fornecedorHandle'] = $fornecedorHandle;
		$_SESSION['FormaPagamento'] = $FormaPagamento;
		$_SESSION['FormaPagamentoHandle'] = $FormaPagamentoHandle;
		$_SESSION['CondicaoPagamento'] = $CondicaoPagamento;
		$_SESSION['CondicaoPagamentoHandle'] = $CondicaoPagamentoHandle;
		$_SESSION['observacao'] = $observacao;
		
		header('Location: ../../view/operacional/InserirDespesaViagem.php?referencia='.$referencia);
		exit;
	}
	
	

    $result = $clientSoap->__soapCall("InserirViagemDespesa", array("InserirViagemDespesa" => array("viagemDespesa" => $params)));
	
	$retorno = $result->InserirViagemDespesaResult;
	
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
		
		$_SESSION['tipo'] = $tipo;
		$_SESSION['tipoHandle'] = $tipoHandle;
		$_SESSION['viagem'] = $viagem;
		$_SESSION['viagemHandle'] = $viagemHandle;
		$_SESSION['data'] = $data;
		$_SESSION['hora'] = $hora;
		$_SESSION['quantidade'] = $quantidade;
		$_SESSION['ValorUnitario'] = $ValorUnitario;
		$_SESSION['mensaValorTotalgem'] = $ValorTotal;
		$_SESSION['despesa'] = $despesa;
		$_SESSION['despesaHandle'] = $despesaHandle;
		$_SESSION['fornecedor'] = $fornecedor;
		$_SESSION['fornecedorHandle'] = $fornecedorHandle;
		$_SESSION['FormaPagamento'] = $FormaPagamento;
		$_SESSION['FormaPagamentoHandle'] = $FormaPagamentoHandle;
		$_SESSION['CondicaoPagamento'] = $CondicaoPagamento;
		$_SESSION['CondicaoPagamentoHandle'] = $CondicaoPagamentoHandle;
		$_SESSION['observacao'] = $observacao;
		
		header('Location: ../../view/operacional/InserirDespesaViagem.php?referencia='.$referencia);	
	}
	
	if($sucesso == 'True'){
		$_SESSION['protocolo'] = $protocolo;
		$_SESSION['protocolo'] = $protocolo;
		$_SESSION['gravou'] = 'true';
		
		header('Location: ../../view/operacional/VisualizarDespesaViagem.php?despesa='.$protocolo.'&referencia='.$referencia);
		
	}
	else if($sucesso == 'False'){
		$_SESSION['mensagem'] = $mensagem;
		
		$_SESSION['tipo'] = $tipo;
		$_SESSION['tipoHandle'] = $tipoHandle;
		$_SESSION['viagem'] = $viagem;
		$_SESSION['viagemHandle'] = $viagemHandle;
		$_SESSION['data'] = $data;
		$_SESSION['hora'] = $hora;
		$_SESSION['quantidade'] = $quantidade;
		$_SESSION['ValorUnitario'] = $ValorUnitario;
		$_SESSION['mensaValorTotalgem'] = $ValorTotal;
		$_SESSION['despesa'] = $despesa;
		$_SESSION['despesaHandle'] = $despesaHandle;
		$_SESSION['fornecedor'] = $fornecedor;
		$_SESSION['fornecedorHandle'] = $fornecedorHandle;
		$_SESSION['FormaPagamento'] = $FormaPagamento;
		$_SESSION['FormaPagamentoHandle'] = $FormaPagamentoHandle;
		$_SESSION['CondicaoPagamento'] = $CondicaoPagamento;
		$_SESSION['CondicaoPagamentoHandle'] = $CondicaoPagamentoHandle;
		$_SESSION['observacao'] = $observacao;
		
		header('Location: ../../view/operacional/InserirDespesaViagem.php?referencia='.$referencia);
	}
	
} 
catch (SoapFault $e) {
   // var_dump($e->getMessage());
		
		$_SESSION['mensagem'] = 'Erro ao conectar com o WebService, tente novamente mais tarde';
		
		$_SESSION['tipo'] = $tipo;
		$_SESSION['tipoHandle'] = $tipoHandle;
		$_SESSION['viagem'] = $viagem;
		$_SESSION['viagemHandle'] = $viagemHandle;
		$_SESSION['data'] = $data;
		$_SESSION['hora'] = $hora;
		$_SESSION['quantidade'] = $quantidade;
		$_SESSION['ValorUnitario'] = $ValorUnitario;
		$_SESSION['mensaValorTotalgem'] = $ValorTotal;
		$_SESSION['despesa'] = $despesa;
		$_SESSION['despesaHandle'] = $despesaHandle;
		$_SESSION['fornecedor'] = $fornecedor;
		$_SESSION['fornecedorHandle'] = $fornecedorHandle;
		$_SESSION['FormaPagamento'] = $FormaPagamento;
		$_SESSION['FormaPagamentoHandle'] = $FormaPagamentoHandle;
		$_SESSION['CondicaoPagamento'] = $CondicaoPagamento;
		$_SESSION['CondicaoPagamentoHandle'] = $CondicaoPagamentoHandle;
		$_SESSION['observacao'] = $observacao;
		
	header('Location: ../../view/operacional/InserirDespesaViagem.php?referencia='.$referencia);
}
?>