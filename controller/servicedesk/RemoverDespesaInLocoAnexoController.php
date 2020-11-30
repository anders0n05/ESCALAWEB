
<?php
include_once('../tecnologia/Sistema.php');


$anexoHandle = Sistema::getGet('anexo');
$usuario = $_SESSION['usuario'];
$senha = $_SESSION['senha'];
$senhaNaoCriptografada = $_SESSION['senhaNaoCriptografada'];

$tipo = Sistema::getPost('tipo');
$tipoHandle = Sistema::getPost('tipoHandle');
$data = date('Y-m-d', strtotime(Sistema::getPost('data')));
$hora = date('H:i:s', strtotime(Sistema::getPost('data')));
$quantidade = Sistema::getPost('quantidade');
$ValorUnitario = Sistema::getPost('ValorUnitario');
$ValorTotal = Sistema::getPost('ValorTotal');
$despesa = Sistema::getPost('despesa');
$despesaHandle = Sistema::getPost('despesaHandle');
$inLoco = Sistema::getPost('inLoco');
$inLocoHandle = Sistema::getPost('inLocoHandle');
$observacao = Sistema::getPost('observacao');
$complemento = Sistema::getPost('complemento');

$referencia = Sistema::getGet('referencia');

$mensagem = null;
$protocolo = null;
$sucesso = null;

$despesaInLocoHandle = Sistema::getGet('handle');


$SESSION['tipo'] = $tipo;
$SESSION['tipoHandle'] = $tipoHandle;
$SESSION['data'] = $data;
$SESSION['hora'] = $data;
$SESSION['quantidade'] = $quantidade;
$SESSION['ValorUnitario'] = $ValorUnitario;
$SESSION['ValorTotal'] = $ValorTotal;
$SESSION['despesa'] = $despesa;
$SESSION['despesaHandle'] = $despesaHandle;
$SESSION['inLoco'] = $inLoco;
$SESSION['inLocoHandle'] = $inLocoHandle;
$SESSION['observacao'] = $observacao;
$SESSION['complemento'] = $complemento;

try {
	$webservice = 'ServiceDesk';
    include_once('../tecnologia/WebService.php');
	if($WebServiceOffline){
		$_SESSION['mensagem'] = 'Erro ao conectar com o WebService, tente novamente mais tarde';
		header('Location: ../../view/servicedesk/'.$referencia.'.php?handle='.$despesaInLocoHandle.'&referencia='.$referencia);
		exit;
	}
	
	 $params = array("anexoInlocoDespesa" => array(
                "inlocoDespesa" => $despesaInLocoHandle,
                "anexoInlocoDespesa" => $anexoHandle
     ));
			
    $result = $clientSoap->__soapCall("ExcluirAnexoInlocoDespesa", array("inlocoDespesa" => $params));
				
    $retorno = $result->ExcluirAnexoInlocoDespesaResult;
	
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
	  
      header('Location: ../../view/servicedesk/VisualizarDespesaInLoco.php?handle='.$despesaInLocoHandle.'&referencia=DespesaAtendimentoInLoco');
      }

      if($sucesso == 'True'){
		    $_SESSION['protocolo'] = $protocolo;
      		header('Location: ../../view/servicedesk/VisualizarDespesaInLoco.php?handle='.$despesaInLocoHandle.'&referencia=DespesaAtendimentoInLoco');
      }
      else if($sucesso == 'False'){
      $_SESSION['mensagem'] = $mensagem;
      	header('Location: ../../view/servicedesk/VisualizarDespesaInLoco.php?handle='.$despesaInLocoHandle.'&referencia=DespesaAtendimentoInLoco');
      }
    
} 
catch (SoapFault $e) {
    //var_dump($e->getMessage());
    $_SESSION['mensagem'] = 'Erro ao conectar com o WebService, tente novamente mais tarde';
    header('Location: ../../view/servicedesk/VisualizarDespesaInLoco.php?handle='.$despesaInLocoHandle.'&referencia=DespesaAtendimentoInLoco');
}
?>