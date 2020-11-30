<?php
include_once('../tecnologia/Sistema.php');

$ocorrenciaHandle = Sistema::getGet('ocorrencia');
$anexoHandle = Sistema::getGet('anexo');
$usuario = $_SESSION['usuario'];
$senha = $_SESSION['senha'];
$senhaNaoCriptografada = $_SESSION['senhaNaoCriptografada'];

try {
	$webservice = 'Operacional';
    include_once('../tecnologia/WebService.php');
	if($WebServiceOffline){
		$_SESSION['mensagem'] = 'Erro ao conectar com o WebService, tente novamente mais tarde';
		header('Location: ../../view/operacional/VisualizarOcorrenciaTransporte.php?ocorrencia='.$ocorrenciaHandle);
		exit;
	}
	
	 $params = array("anexoOcorrencia" => array(
                "ocorrencia" => $ocorrenciaHandle,
                "anexoOcorrencia" => $anexoHandle
     ));
			
    $result = $clientSoap->__soapCall("ExcluirAnexoOcorrencia", array("anexoOcorrencia" => $params));
				
    $retorno = $result->ExcluirAnexoOcorrenciaResult;
	
	if (isset($retorno->sucesso)) {
        $sucesso = $retorno->sucesso;
		//echo $sucesso;
    }
	
	if (isset($retorno->mensagem)) {
        $mensagem = $retorno->mensagem;
    }
	
	if (isset($retorno->protocolo)) {
        $protocolo = $retorno->protocolo;
    }
    
      if($mensagem == null and $sucesso == null and $protocolo == null){
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
    header('Location: ../../view/operacional/VisualizarOcorrenciaTransporte.php?ocorrencia='.$ocorrenciaHandle);
}
?>