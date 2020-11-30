<?php
include_once('../tecnologia/Sistema.php');
echo "<pre>";
$usuario = $_SESSION['usuario'];
$senha = $_SESSION['senha'];
$senhaNaoCriptografada = $_SESSION['senhaNaoCriptografada'];

$ocorrenciaHandle = Sistema::getGet('ocorrencia');
$documentoTransporte = Sistema::getPost('documentoTransporte');
$documentoTransporteHandle = Sistema::getPost('documentoTransporteHandle');
$regraBaixa = Sistema::getPost('regraBaixa');
$regraBaixaHandle = Sistema::getPost('regraBaixaHandle');
$romaneioItem = Sistema::getPost('romaneioItem');
$tipoOperacao = Sistema::getPost('tipoOperacao');
$tipoOperacaoHandle = Sistema::getPost('tipoOperacaoHandle');
$tipo = Sistema::getPost('tipo');
$tipoHandle = Sistema::getPost('tipoHandle');
$filial = Sistema::getPost('filial');
$filialHandle = Sistema::getPost('filialHandle');
$acao = Sistema::getPost('acao');
$acaoHandle = Sistema::getPost('acaoHandle');
$dataOcorrencia = date('Y-m-d', strtotime(Sistema::getPost('data')));
$horaOcorrencia = date('H:i:s', strtotime(Sistema::getPost('data')));
$dataChegada = date('Y-m-d', strtotime(Sistema::getPost('dataChegada')));
$horaChegada = date('H:i:s', strtotime(Sistema::getPost('dataChegada')));
$dataEntrada = date('Y-m-d', strtotime(Sistema::getPost('dataEntrada')));
$horaEntrada = date('H:i:s', strtotime(Sistema::getPost('dataEntrada')));
$dataSaida = date('Y-m-d', strtotime(Sistema::getPost('dataSaida')));
$horaSaida = date('H:i:s', strtotime(Sistema::getPost('dataSaida')));
$motivoAtraso = Sistema::getPost('motivoAtraso');
$motivoAtrasoHandle = Sistema::getPost('motivoAtrasoHandle');
$responsavel = Sistema::getPost('responsavel');
$responsavelHandle = Sistema::getPost('responsavelHandle');
$nome = Sistema::getPost('nome');
$documento = Sistema::getPost('documento');
$observacao = Sistema::getPost('observacao');

$mensagem = null;
$protocolo = null;
$sucesso = null;

try {
    $params = array(
		"ocorrencia" => $ocorrenciaHandle,
        "filial" => $filialHandle,
        "acao" => $acaoHandle,
        "regraBaixa" => $regraBaixaHandle,
        "responsavel" => $responsavelHandle,
        "tipoOcorrencia" => $tipoHandle,
        "tipoOperacao" => $tipoOperacaoHandle,
        "motivoAtraso" => $motivoAtrasoHandle,
        "data" => $dataOcorrencia.'T'.$horaOcorrencia,
        "dataChegada" => $dataChegada.'T'.$horaChegada,
        "dataEntrada" => $dataEntrada.'T'.$horaEntrada,
        "dataSaida" => $dataSaida.'T'.$horaSaida,
	    "documentoResponsavel" => $documento,
		"nomeResponsavel" => $nome,
		"observacao" => $observacao
    );
	
	//print_r($params);
	$webservice = 'Operacional';
	include_once('../tecnologia/WebService.php');
	if($WebServiceOffline){
		$_SESSION['mensagem'] = 'Erro ao conectar com o WebService, tente novamente mais tarde';
		header('Location: ../../view/operacional/VisualizarDespesaViagem.php?ocorrencia='.$viagemDespesa);
		exit;
	}

    $result = $clientSoap->__soapCall("AlterarOcorrencia", array("AlterarOcorrencia" => array("ocorrencia" => $params)));
     
	$retorno = $result->AlterarOcorrenciaResult;
	
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
		
	header('Location: ../../view/operacional/VisualizarOcorrenciaTransporte.php?ocorrencia='.$ocorrenciaHandle);	
	}
		
	if($sucesso == 'True'){
		$_SESSION['protocolo'] = $protocolo;
		header('Location: ../../view/operacional/VisualizarOcorrenciaTransporte.php?ocorrencia='.$ocorrenciaHandle);	
	}
	else if($sucesso == 'False'){
		$_SESSION['mensagem'] = $mensagem;
		
		header('Location: ../../view/operacional/VisualizarOcorrenciaTransporte.php?ocorrencia='.$ocorrenciaHandle);
	}
	
} 
catch (SoapFault $e) {
    //var_dump($e->getMessage());
		
	$_SESSION['mensagem'] = 'Erro ao conectar com o WebService, tente novamente mais tarde';
	header('Location: ../../view/operacional/VisualizarDespesaViagem.php?ocorrencia='.$viagemDespesa);
}
?>