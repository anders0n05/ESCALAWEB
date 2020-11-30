<?php
include_once('../tecnologia/Sistema.php');

$inLocoHandle = Sistema::getGet('handle');
$anexoHandle = Sistema::getGet('anexo');
$usuario = $_SESSION['usuario'];
$senha = $_SESSION['senha'];
$senhaNaoCriptografada = $_SESSION['senhaNaoCriptografada'];

try {
	$webservice = 'ServiceDesk';
    include_once('../tecnologia/WebService.php');
	if($WebServiceOffline){
		$_SESSION['mensagem'] = 'Erro ao conectar com o WebService, tente novamente mais tarde';
		header('Location: ../../view/servicedesk/VisualizarDespesaInLoco.php?handle=' . $inLocoHandle);
		exit;
	}
	
	 $params = array("anexoInlocoDespesa" => array(
                "inlocoDespesa" => $inLocoHandle,
                "anexoInlocoDespesa" => $anexoHandle
            ));
			
    $result = $clientSoap->__soapCall("BaixarAnexoInlocoDespesa", array("inlocoDespesa" => $params));
				
    $retorno = $result->BaixarAnexoInlocoDespesaResult;
    
    if (isset($retorno->arquivo)) {
       $arquivo = $retorno->arquivo;
		//header ('Content-Type: image/jpg');
    }
	
	if (isset($retorno->nome)) {
        $nomeAnexo = $retorno->nome;
    }
    
	if (isset($retorno->sucesso)) {
        $sucesso = $retorno->sucesso;
    }
	
	if (isset($retorno->mensagem)) {
        $mensagem = $retorno->mensagem;
    }
	
	if (isset($retorno->protocolo)) {
        $protocolo = $retorno->protocolo;
    }
    
      if($mensagem == null and $sucesso == null and $protocolo == null and $arquivo == null){
      $_SESSION['mensagem'] = 'Erro ao conectar com o WebService, tente novamente mais tarde';
	  
      header('Location: ../../view/servicedesk/VisualizarDespesaInLoco.php?handle='.$inLocoHandle.'&referencia=DespesaAtendimentoInLoco');
      }

      if($sucesso == 'True'){
		  
		    $_SESSION['protocolo'] = $protocolo;
			$_SESSION['nomeAnexo'] = $nomeAnexo;
			$_SESSION['arquivo'] = $arquivo;
			
      		header('Location: ../../view/servicedesk/VisualizarDespesaInLoco.php?handle='.$inLocoHandle.'&referencia=DespesaAtendimentoInLoco');
      }
      else if($sucesso == 'False'){
      $_SESSION['mensagem'] = $mensagem;
      header('Location: ../../view/servicedesk/VisualizarDespesaInLoco.php?handle='.$inLocoHandle.'&referencia=DespesaAtendimentoInLoco');
      }
    
} 
catch (SoapFault $e) {
    //var_dump($e->getMessage());
    $_SESSION['mensagem'] = 'Erro ao conectar com o WebService, tente novamente mais tarde';
   header('Location: ../../view/servicedesk/VisualizarDespesaInLoco.php?handle='.$inLocoHandle.'&referencia=DespesaAtendimentoInLoco');
}
?>