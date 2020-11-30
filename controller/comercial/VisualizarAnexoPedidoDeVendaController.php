<?php
include_once('../tecnologia/Sistema.php');
$connect = Sistema::getConexao();
$PedidoHandle = Sistema::getGet('handle');
$anexoHandle = Sistema::getGet('anexo');
$referencia = Sistema::getGet('referencia');

$usuario = $_SESSION['usuario'];
$senha = $_SESSION['senha'];
$senhaNaoCriptografada = $_SESSION['senhaNaoCriptografada'];

//seleciona o assunto do anexo
$queryAssunto = $connect->prepare("SELECT ARQUIVO FROM VE_ORDEMANEXO WHERE HANDLE = '".$anexoHandle."'");
$queryAssunto->execute();
$rowAssunto = $queryAssunto->fetch(PDO::FETCH_ASSOC);
$nomeAnexo = $rowAssunto['ARQUIVO'];

try {
	$webservice = 'Venda';
    include_once('../tecnologia/WebService.php');
	
	if($WebServiceOffline){
		$_SESSION['mensagem'] = 'Erro ao conectar com o WebService, tente novamente mais tarde';
     	header('Location: ../../view/comercial/'.$referencia.'.php?handle='.$PedidoHandle.'&referencia='.$referencia);
		exit;
	}
	
	 $params = array(
     	"handle" => $anexoHandle
     );
			
    $result = $clientSoap->__soapCall("BaixarPedidoVendaAnexo", array("BaixarPedidoVendaAnexo" => array("pedidoVendaAnexo" => $params)));
	print_r($params);	
	print_r($result);	
	
    $retorno = $result->BaixarPedidoVendaAnexoResult;
	
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
	  
      	//header('Location: ../../view/comercial/'.$referencia.'.php?handle='.$PedidoHandle.'&referencia='.$referencia);
      }

      if($sucesso == 'True'){
	  
		//	$_SESSION['protocolo'] = $protocolo;
		$_SESSION['nomeAnexo'] = $nomeAnexo;
		$_SESSION['arquivo'] = $protocolo;
			
		  header('Location: ../../view/comercial/'.$referencia.'.php?handle='.$PedidoHandle.'&referencia='.$referencia);
	  }
	  else if($sucesso == 'False'){
		  $_SESSION['mensagem'] = $mensagem;
		 // header('Location: ../../view/comercial/'.$referencia.'.php?handle='.$PedidoHandle.'&referencia='.$referencia);
      }
} 
catch (SoapFault $e) {
    //var_dump($e->getMessage());
    $_SESSION['mensagem'] = 'Erro ao conectar com o WebService, tente novamente mais tarde';
    header('Location: ../../view/comercial/'.$referencia.'.php?handle='.$PedidoHandle.'&referencia='.$referencia);
}
?>