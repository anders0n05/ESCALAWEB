
<?php
include_once('../tecnologia/Sistema.php');

$despesaHandle = Sistema::getGet('despesa');
$anexoHandle = Sistema::getGet('anexo');
$usuario = $_SESSION['usuario'];
$senha = $_SESSION['senha'];
$senhaNaoCriptografada = $_SESSION['senhaNaoCriptografada'];

try {
	$webservice = 'Operacional';
    include_once('../tecnologia/WebService.php');
	if($WebServiceOffline){
		$_SESSION['mensagem'] = 'Erro ao conectar com o WebService, tente novamente mais tarde';
		header('Location: ../../view/operacional/VisualizarOcorrenciaTransporte.php?despesa='.$despesaHandle);
		exit;
	}
	
	 $params = array("anexoViagemDespesa" => array(
                "viagemDespesa" => $despesaHandle,
                "anexoViagemDespesa" => $anexoHandle
     ));
			
    $result = $clientSoap->__soapCall("ExcluirAnexoViagemDespesa", array("anexoViagemDespesa" => $params));
				
    $retorno = $result->ExcluirAnexoViagemDespesaResult;
	
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
	  
      header('Location: ../../view/operacional/VisualizarDespesaViagem.php?despesa='.$despesaHandle);
      }

      if($sucesso == 'True'){
		    $_SESSION['protocolo'] = $protocolo;
      		header('Location: ../../view/operacional/VisualizarDespesaViagem.php?despesa='.$despesaHandle);
      }
      else if($sucesso == 'False'){
      $_SESSION['mensagem'] = $mensagem;
      header('Location: ../../view/operacional/VisualizarDespesaViagem.php?despesa='.$despesaHandle);
      }
    
} 
catch (SoapFault $e) {
    //var_dump($e->getMessage());
    $_SESSION['mensagem'] = 'Erro ao conectar com o WebService, tente novamente mais tarde';
    header('Location: ../../view/operacional/VisualizarDespesaViagem.php?despesa='.$despesaHandle);
}
?>