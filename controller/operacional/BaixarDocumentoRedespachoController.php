<?php
include_once('../tecnologia/Sistema.php');

$usuario = $_SESSION['usuario'];
$senha = $_SESSION['senha'];
$senhaNaoCriptografada = $_SESSION['senhaNaoCriptografada'];

$tipoOcorrencia = Sistema::getPost('tipoOcorrencia');
$tipoOcorrenciaHandle = Sistema::getPost('tipoOcorrenciaHandle');
$acaoHandle = Sistema::getPost('acaoHandle');
$motivoAtraso = Sistema::getPost('motivoAtraso');
$motivoAtrasoHandle = Sistema::getPost('motivoAtrasoHandle');
$responsavel = Sistema::getPost('responsavel');
$responsavelHandle = Sistema::getPost('responsavelHandle');
$nomeResponsavel = Sistema::getPost('nome');
$numeroDocumento = Sistema::getPost('numeroDocumento');
$documentoHandle = Sistema::getPost('documentoHandle');
$obs = Sistema::getPost('obs');
$dataOcorrencia = date('Y-m-d', strtotime($data));
$horaOcorrencia = date('H:i:s', strtotime($hora));

$mensagem = null;
$protocolo = null;
$sucesso = null;

try {
	
	$documentoHandleExplode = explode(';', $documentoHandle);
	$documentoHandleExplodeCount = count($documentoHandleExplode);
	for($i=0;$i<=$documentoHandleExplodeCount;$i++){
		$documentoHandleExplodeReal = explode('-', $documentoHandleExplodeCount[$i]);
	
    $params = array("romaneioItem" => $documentoHandleExplodeReal[1],
        "acao" => $acaoHandle,
        "filial" => $filial,
        "regraBaixa" => null,
        "responsavel" => $responsavelHandle,
        "tipoOcorrencia" => $tipoOcorrenciaHandle,
        "tipoOperacao" => '3',
        "motivoAtraso" => $motivoAtrasoHandle,
        "data" => $dataOcorrencia.'T'.$horaOcorrencia,
	    "documentoResponsavel" => $numeroDocumento,
		"nomeResponsavel" => $nomeResponsavel,
		"observacao" => $obs
    );
	
	$webservice = 'Operacional';
	include_once('../tecnologia/WebService.php');
	
	if($WebServiceOffline){
		$_SESSION['mensagem'] = 'Erro ao conectar com o WebService, tente novamente mais tarde';
		
		$_SESSION['tipoOcorrencia'] = $tipoOcorrencia;
		$_SESSION['tipoOcorrenciaHandle'] = $tipoOcorrenciaHandle;
		$_SESSION['acaoHandle'] = $acaoHandle;
		$_SESSION['motivoAtraso'] = $motivoAtraso;
		$_SESSION['motivoAtrasoHandle'] = $motivoAtrasoHandle;
		$_SESSION['responsavel'] = $responsavel;
		$_SESSION['responsavelHandle'] = $responsavelHandle;
		$_SESSION['nome'] = $nome;
		$_SESSION['numeroDocumento'] = $numeroDocumento;
		$_SESSION['obs'] = $obs;

		header('Location: ../../view/operacional/DocumentoRedespacho.php');
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
	
	
	
	if($_FILES["image_src"]["size"] > 0){
		$arquivoCount = count($_FILES["image_src"]["name"]);
		//echo "count: ".$arquivoCount;
		$_SESSION['error'] = array();

		for ($i = 0; $i < $arquivoCount; $i++) {

			if (isset($_FILES["image_src"]["name"][$i])) {

				//se existir erro gera um array contendo o nome dos anexos com erro.
				if($_FILES['image_src']['error'][$i]) { 
					 array_push($_SESSION['error'], 'Anexo: '.$_FILES["image_src"]["name"][$i]);
				}

				$nome = $_FILES["image_src"]["name"][$i];
				$nomeExplode = explode('.', $nome);
				$extencao = $nomeExplode[1];

				if($extencao == 'jpg' || $extencao == 'png' || $extencao == 'gif' || $extencao == 'jpeg' || $extencao == 'JPG' || $extencao == 'PNG' || $extencao == 'GIF' || $extencao == 'JPEG'){
					$image = WideImage::loadFromFile($_FILES["image_src"]["tmp_name"][$i]);
					$arquivo = $image->resize(1280, 840);	
				}
				else{
					$arquivo = file_get_contents($_FILES["image_src"]["tmp_name"][$i]);
				}

				//verifica o tamanho do arquivo
				if(filesize($arquivo) > (4 * 1000 * 1000)){
					array_push($_SESSION['error'], 'Anexo: '.$_FILES["image_src"]["name"][$i].'<br> Você pode enviar arquivos de até 4 MB.');
				}
				else{
					$params = array(
						"ocorrencia" => $protocolo,
						"nome" => $nome,
						"arquivo" => $arquivo,
						"sequencial" => $sequencial
					);

					$anexos["listaAnexoOcorrencia"]["InserirAnexoOcorrencia"][] = $params;

					$sequencial++;
				}//else arquivo > 4mb
			}
		}

		$result = $clientSoap->__soapCall("InserirAnexoOcorrencia", array("InserirAnexoOcorrencia" => $anexos));

		$retorno = $result->InserirAnexoOcorrenciaResult;

		# VARRER TODOS OS ANEXOS RETORNADOS
		$anexo1 = $retorno->retornoAnexo->RetornoAnexo;

		if (isset($anexo1->protocolo)) {
			print_r($anexo1->protocolo);
			echo '<br/>';
		}

		if (isset($anexo1->mensagem)) {
			$mensagem = $anexo1->mensagem;
			//print_r($mensagem);
		}

		if (isset($anexo1->sucesso)) {
			$sucesso = $anexo1->sucesso;
		}
	}
	
	}//end for loop explode handle documento
	
	if($mensagem == null and $protocolo == null and $sucesso == null){
		$_SESSION['mensagem'] = 'Erro ao conectar com o WebService, tente novamente mais tarde';
		
		$_SESSION['tipoOcorrencia'] = $tipoOcorrencia;
		$_SESSION['tipoOcorrenciaHandle'] = $tipoOcorrenciaHandle;
		$_SESSION['acaoHandle'] = $acaoHandle;
		$_SESSION['motivoAtraso'] = $motivoAtraso;
		$_SESSION['motivoAtrasoHandle'] = $motivoAtrasoHandle;
		$_SESSION['responsavel'] = $responsavel;
		$_SESSION['responsavelHandle'] = $responsavelHandle;
		$_SESSION['nome'] = $nome;
		$_SESSION['numeroDocumento'] = $numeroDocumento;
		$_SESSION['obs'] = $obs;
		
		header('Location: ../../view/operacional/DocumentoRedespacho.php');
	}
	
	if($sucesso == 'True'){
		$_SESSION['protocolo'] = $protocolo;
		$_SESSION['protocolo'] = $protocolo;
		$_SESSION['gravou'] = 'true';
		
		header('Location: ../../view/operacional/DocumentoRedespacho.php');
		
	}
	else if($sucesso == 'False'){
		$_SESSION['mensagem'] = $mensagem;
		
		
		$_SESSION['tipoOcorrencia'] = $tipoOcorrencia;
		$_SESSION['tipoOcorrenciaHandle'] = $tipoOcorrenciaHandle;
		$_SESSION['acaoHandle'] = $acaoHandle;
		$_SESSION['motivoAtraso'] = $motivoAtraso;
		$_SESSION['motivoAtrasoHandle'] = $motivoAtrasoHandle;
		$_SESSION['responsavel'] = $responsavel;
		$_SESSION['responsavelHandle'] = $responsavelHandle;
		$_SESSION['nome'] = $nome;
		$_SESSION['numeroDocumento'] = $numeroDocumento;
		$_SESSION['obs'] = $obs;
		
		header('Location: ../../view/operacional/DocumentoRedespacho.php');
	}
	
} 
catch (SoapFault $e) {

		$_SESSION['mensagem'] = 'Erro ao conectar com o WebService, tente novamente mais tarde';
		
		
		$_SESSION['tipoOcorrencia'] = $tipoOcorrencia;
		$_SESSION['tipoOcorrenciaHandle'] = $tipoOcorrenciaHandle;
		$_SESSION['acaoHandle'] = $acaoHandle;
		$_SESSION['motivoAtraso'] = $motivoAtraso;
		$_SESSION['motivoAtrasoHandle'] = $motivoAtrasoHandle;
		$_SESSION['responsavel'] = $responsavel;
		$_SESSION['responsavelHandle'] = $responsavelHandle;
		$_SESSION['nome'] = $nome;
		$_SESSION['numeroDocumento'] = $numeroDocumento;
		$_SESSION['obs'] = $obs;
		
	header('Location: ../../view/operacional/DocumentoRedespacho.php');
}
?>