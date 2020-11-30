<?php
include_once('../tecnologia/Sistema.php');

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

$referencia = Sistema::getGet('referencia');

$mensagem = null;
$protocolo = null;
$sucesso = null;

try {

    $params = array("romaneioItem" => $romaneioItem,
        "acao" => $acaoHandle,
        "filial" => $filialHandle,
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
	
	$webservice = 'Operacional';
	include_once('../tecnologia/WebService.php');
	
	if($WebServiceOffline){
		$_SESSION['mensagem'] = 'Erro ao conectar com o WebService, tente novamente mais tarde';
		
		$_SESSION['documentoTransporte'] = $documentoTransporte;
		$_SESSION['documentoTransporteHandle'] = $documentoTransporteHandle;
		$_SESSION['romaneioItem'] = $romaneioItem;
		$_SESSION['regraBaixa'] = $regraBaixa;
		$_SESSION['regraBaixaHandle'] = $regraBaixaHandle;
		$_SESSION['tipo'] = $tipo;
		$_SESSION['tipoHandle'] = $tipoHandle;
		$_SESSION['tipoOperacao'] = $tipo;
		$_SESSION['tipoOperacaoHandle'] = $tipoOperacaoHandle;
		$_SESSION['filial'] = $filial;
		$_SESSION['filialHandle'] = $filialHandle;
		$_SESSION['acao'] = $acao;
		$_SESSION['acaoHandle'] = $acaoHandle;
		$_SESSION['data'] = $data;
		$_SESSION['hora'] = $hora;
		$_SESSION['dataChegada'] = $dataChegada;
		$_SESSION['horaChegada'] = $horaChegada;
		$_SESSION['dataEntrada'] = $dataEntrada;
		$_SESSION['horaEntrada'] = $horaEntrada;
		$_SESSION['dataSaida'] = $dataSaida;
		$_SESSION['horaSaida'] = $horaSaida;
		$_SESSION['motivoAtraso'] = $motivoAtraso;
		$_SESSION['motivoAtrasoHandle'] = $motivoAtrasoHandle;
		$_SESSION['responsavel'] = $responsavel;
		$_SESSION['responsavelHandle'] = $responsavelHandle;
		$_SESSION['nome'] = $nome;
		$_SESSION['documento'] = $documento;
		$_SESSION['observacao'] = $observacao;
		
		header('Location: ../../view/operacional/InserirOcorrenciaTransporte.php?referencia='.$referencia);	
		exit;
	}
	
    $result = $clientSoap->__soapCall("InserirOcorrencia", array("InserirOcorrencia" => array("ocorrencia" => $params)));
	
	$retorno = $result->InserirOcorrenciaResult;
	
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
		
		$_SESSION['documentoTransporte'] = $documentoTransporte;
		$_SESSION['documentoTransporteHandle'] = $documentoTransporteHandle;
		$_SESSION['romaneioItem'] = $romaneioItem;
		$_SESSION['regraBaixa'] = $regraBaixa;
		$_SESSION['regraBaixaHandle'] = $regraBaixaHandle;
		$_SESSION['tipo'] = $tipo;
		$_SESSION['tipoHandle'] = $tipoHandle;
		$_SESSION['tipoOperacao'] = $tipo;
		$_SESSION['tipoOperacaoHandle'] = $tipoOperacaoHandle;
		$_SESSION['filial'] = $filial;
		$_SESSION['filialHandle'] = $filialHandle;
		$_SESSION['acao'] = $acao;
		$_SESSION['acaoHandle'] = $acaoHandle;
		$_SESSION['data'] = $data;
		$_SESSION['hora'] = $hora;
		$_SESSION['dataChegada'] = $dataChegada;
		$_SESSION['horaChegada'] = $horaChegada;
		$_SESSION['dataEntrada'] = $dataEntrada;
		$_SESSION['horaEntrada'] = $horaEntrada;
		$_SESSION['dataSaida'] = $dataSaida;
		$_SESSION['horaSaida'] = $horaSaida;
		$_SESSION['motivoAtraso'] = $motivoAtraso;
		$_SESSION['motivoAtrasoHandle'] = $motivoAtrasoHandle;
		$_SESSION['responsavel'] = $responsavel;
		$_SESSION['responsavelHandle'] = $responsavelHandle;
		$_SESSION['nome'] = $nome;
		$_SESSION['documento'] = $documento;
		$_SESSION['observacao'] = $observacao;
		
		header('Location: ../../view/operacional/InserirOcorrenciaTransporte.php?referencia='.$referencia);	
	}
	
	if($sucesso == 'True'){
		$_SESSION['protocolo'] = $protocolo;
		$_SESSION['protocolo'] = $protocolo;
		$_SESSION['gravou'] = 'true';
		
		header('Location: ../../view/operacional/VisualizarOcorrenciaTransporte.php?ocorrencia='.$protocolo.'&referencia='.$referencia);
		
	}
	else if($sucesso == 'False'){
		$_SESSION['mensagem'] = $mensagem;
		
		$_SESSION['documentoTransporte'] = $documentoTransporte;
		$_SESSION['documentoTransporteHandle'] = $documentoTransporteHandle;
		$_SESSION['romaneioItem'] = $romaneioItem;
		$_SESSION['regraBaixa'] = $regraBaixa;
		$_SESSION['regraBaixaHandle'] = $regraBaixaHandle;
		$_SESSION['tipo'] = $tipo;
		$_SESSION['tipoHandle'] = $tipoHandle;
		$_SESSION['tipoOperacao'] = $tipo;
		$_SESSION['tipoOperacaoHandle'] = $tipoOperacaoHandle;
		$_SESSION['filial'] = $filial;
		$_SESSION['filialHandle'] = $filialHandle;
		$_SESSION['acao'] = $acao;
		$_SESSION['acaoHandle'] = $acaoHandle;
		$_SESSION['data'] = $data;
		$_SESSION['hora'] = $hora;
		$_SESSION['dataChegada'] = $dataChegada;
		$_SESSION['horaChegada'] = $horaChegada;
		$_SESSION['dataEntrada'] = $dataEntrada;
		$_SESSION['horaEntrada'] = $horaEntrada;
		$_SESSION['dataSaida'] = $dataSaida;
		$_SESSION['horaSaida'] = $horaSaida;
		$_SESSION['motivoAtraso'] = $motivoAtraso;
		$_SESSION['motivoAtrasoHandle'] = $motivoAtrasoHandle;
		$_SESSION['responsavel'] = $responsavel;
		$_SESSION['responsavelHandle'] = $responsavelHandle;
		$_SESSION['nome'] = $nome;
		$_SESSION['documento'] = $documento;
		$_SESSION['observacao'] = $observacao;
		
		header('Location: ../../view/operacional/InserirOcorrenciaTransporte.php?referencia='.$referencia);
	}
	
} 
catch (SoapFault $e) {
   // var_dump($e->getMessage());
		
		$_SESSION['mensagem'] = 'Erro ao conectar com o WebService, tente novamente mais tarde';
		
		$_SESSION['documentoTransporte'] = $documentoTransporte;
		$_SESSION['documentoTransporteHandle'] = $documentoTransporteHandle;
		$_SESSION['romaneioItem'] = $romaneioItem;
		$_SESSION['regraBaixa'] = $regraBaixa;
		$_SESSION['regraBaixaHandle'] = $regraBaixaHandle;
		$_SESSION['tipo'] = $tipo;
		$_SESSION['tipoHandle'] = $tipoHandle;
		$_SESSION['tipoOperacao'] = $tipo;
		$_SESSION['tipoOperacaoHandle'] = $tipoOperacaoHandle;
		$_SESSION['filial'] = $filial;
		$_SESSION['filialHandle'] = $filialHandle;
		$_SESSION['acao'] = $acao;
		$_SESSION['acaoHandle'] = $acaoHandle;
		$_SESSION['data'] = $data;
		$_SESSION['hora'] = $hora;
		$_SESSION['dataChegada'] = $dataChegada;
		$_SESSION['horaChegada'] = $horaChegada;
		$_SESSION['dataEntrada'] = $dataEntrada;
		$_SESSION['horaEntrada'] = $horaEntrada;
		$_SESSION['dataSaida'] = $dataSaida;
		$_SESSION['horaSaida'] = $horaSaida;
		$_SESSION['motivoAtraso'] = $motivoAtraso;
		$_SESSION['motivoAtrasoHandle'] = $motivoAtrasoHandle;
		$_SESSION['responsavel'] = $responsavel;
		$_SESSION['responsavelHandle'] = $responsavelHandle;
		$_SESSION['nome'] = $nome;
		$_SESSION['documento'] = $documento;
		$_SESSION['observacao'] = $observacao;
		
	header('Location: ../../view/operacional/InserirOcorrenciaTransporte.php?referencia='.$referencia);
}
?>