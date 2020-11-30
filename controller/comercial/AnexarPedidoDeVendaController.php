<?php
include_once('../tecnologia/Sistema.php');
include '../../controller/tecnologia/wideimage/WideImage.php';
//echo "<pre>";
$usuario = $_SESSION['usuario'];
$senha = $_SESSION['senha'];
$senhaNaoCriptografada = $_SESSION['senhaNaoCriptografada'];

$referencia = Sistema::getGet('referencia');
$pedidoDeVendaHandle = Sistema::getGet('handle');

$mensagem = null;
$protocolo = null;
$sucesso = null;

try {
	$webservice = 'Venda';
    include_once('../tecnologia/WebService.php');
	
	if($WebServiceOffline){
		$_SESSION['mensagem'] = 'Erro ao conectar com o WebService, tente novamente mais tarde';
		header('Location: ../../view/comercial/VisualizarPedidoDeVenda.php?handle='.$pedidoDeVendaHandle.'&referencia='.$referencia);
		exit;
	}

   	$arquivoCount = count($_FILES["image_src"]["name"]);
	
   	$_SESSION['error'] = array();
	
	$sequencial = 1;
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
					"pedidoVenda" => $pedidoDeVendaHandle,
					"assunto" => $nome,
					"arquivo" => $arquivo
				);
				
				//$anexos["listaPedidoVendaAnexo"]["InserirPedidoVendaAnexo"][] = $params;
				
				$sequencial++;
			}//else arquivo > 4mb
			
        
		
	$result = $clientSoap->__soapCall("InserirPedidoVendaAnexo", array("InserirPedidoVendaAnexo" => array("pedidoVendaAnexo" => $params)));
	
    $retorno = $result->InserirPedidoVendaAnexoResult;
    	
    if(!empty($retorno->mensagem)){
		$mensagem = $retorno->mensagem; 
	}
	if(!empty($retorno->protocolo)){
		$protocolo = $retorno->protocolo;
	}
	if(!empty($retorno->sucesso)){
		$sucesso = $retorno->sucesso; 
	}
	
	
	if($mensagem == NULL and $protocolo == NULL and $sucesso == NULL){
	$_SESSION['mensagem'] = 'Erro ao conectar com o WebService, tente novamente mais tarde';

		header('Location: ../../view/comercial/VisualizarPedidoDeVenda.php?handle='.$pedidoDeVendaHandle.'&referencia='.$referencia);
	}
	
	  if($sucesso <= ''){
		$_SESSION['mensagem'] = 'Erro ao conectar com o WebService, tente novamente mais tarde';
		header('Location: ../../view/comercial/VisualizarPedidoDeVenda.php?handle='.$pedidoDeVendaHandle.'&referencia='.$referencia);
	  }
	  if($sucesso == 'True'){
		  $_SESSION['protocolo'] = $protocolo;
		header('Location: ../../view/comercial/VisualizarPedidoDeVenda.php?handle='.$pedidoDeVendaHandle.'&referencia='.$referencia);
	  }
	  else if($sucesso == 'False'){
		 $_SESSION['retornoAnexo'] = true;
		 array_push($_SESSION['mensagem'], $mensagem);
		 header('Location: ../../view/comercial/VisualizarPedidoDeVenda.php?handle='.$pedidoDeVendaHandle.'&referencia='.$referencia);
	  }
	  }//se existir anexo
	  else{
		 $_SESSION['mensagem'] = "Selecione arquivos para enviar";
		 header('Location: ../../view/comercial/VisualizarPedidoDeVenda.php?handle='.$pedidoDeVendaHandle.'&referencia='.$referencia);  
	  }
}//end for
	
	 header('Location: ../../view/comercial/VisualizarPedidoDeVenda.php?handle='.$pedidoDeVendaHandle.'&referencia='.$referencia);

} catch (SoapFault $e) {
    var_dump($e->getMessage());
    $_SESSION['mensagem'] = 'Erro ao conectar com o WebService, tente novamente mais tarde';
	header('Location: ../../view/comercial/VisualizarPedidoDeVenda.php?handle='.$pedidoDeVendaHandle.'&referencia='.$referencia);
}
?>