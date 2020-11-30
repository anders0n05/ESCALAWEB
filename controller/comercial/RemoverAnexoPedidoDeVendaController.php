
<?php
include_once('../tecnologia/Sistema.php');

$PedidoHandle = Sistema::getGet('handle');
$anexoHandle = Sistema::getGet('anexo');

$usuario = $_SESSION['usuario'];
$senha = $_SESSION['senha'];
$senhaNaoCriptografada = $_SESSION['senhaNaoCriptografada'];

$referencia = Sistema::getGet('referencia');

$mensagem = null;
$protocolo = null;
$sucesso = null;

try {
	$webservice = 'Venda';
    include_once('../tecnologia/WebService.php');
	if($WebServiceOffline){
		$_SESSION['mensagem'] = 'Erro ao conectar com o WebService, tente novamente mais tarde';
		header('Location: ../../view/comercial/'.$referencia.'.php?handle='.$PedidoHandle.'&referencia='.$referencia);
		exit;
	}
	
	 $params = array("pedidoVendaAnexo" => array(
                "handle" => $anexoHandle
     ));
	 
    $result = $clientSoap->__soapCall("ExcluirPedidoVendaAnexo", array("ExcluirPedidoVendaAnexo" => $params));
				
    $retorno = $result->ExcluirPedidoVendaAnexoResult;
	
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
	  
      header('Location: ../../view/comercial/'.$referencia.'.php?handle='.$PedidoHandle.'&referencia='.$referencia);
      }

      if($sucesso == 'True'){
		    $_SESSION['protocolo'] = $protocolo;
      header('Location: ../../view/comercial/'.$referencia.'.php?handle='.$PedidoHandle.'&referencia='.$referencia);
      }
      else if($sucesso == 'False'){
      $_SESSION['mensagem'] = $mensagem;
      header('Location: ../../view/comercial/'.$referencia.'.php?handle='.$PedidoHandle.'&referencia='.$referencia);
      }
} 
catch (SoapFault $e) {
    //var_dump($e->getMessage());
    $_SESSION['mensagem'] = 'Erro ao conectar com o WebService, tente novamente mais tarde';
    header('Location: ../../view/comercial/'.$referencia.'.php?handle='.$PedidoHandle.'&referencia='.$referencia);
}
?>