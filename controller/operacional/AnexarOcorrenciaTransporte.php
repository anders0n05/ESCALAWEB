<?php
include_once('../tecnologia/Sistema.php');
include '../../controller/tecnologia/wideimage/WideImage.php';echo "<pre>";
$ocorrenciaHandle = Sistema::getGet('ocorrencia');
$usuario = $_SESSION['usuario'];
$senha = $_SESSION['senha'];
$senhaNaoCriptografada = $_SESSION['senhaNaoCriptografada'];


try {
	$webservice = 'Operacional';
    include_once('../tecnologia/WebService.php');
	if($WebServiceOffline){
		$_SESSION['mensagem'] = 'Erro ao conectar com o WebService, tente novamente mais tarde';
		header('Location: ../../view/operacional/VisualizarOcorrenciaTransporte.php?ocorrencia=' . $ocorrenciaHandle);
		exit;
	}

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
					"ocorrencia" => $ocorrenciaHandle,
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
  
      if($anexo1->mensagem == null and $anexo1->sucesso == null and $anexo1->protocolo == null){
      $_SESSION['mensagem'] = 'Erro ao conectar com o WebService, tente novamente mais tarde';
	  
      header('Location: ../../view/operacional/VisualizarOcorrenciaTransporte.php?ocorrencia='.$ocorrenciaHandle);
      }

      if($sucesso == 'True'){
      header('Location: ../../view/operacional/VisualizarOcorrenciaTransporte.php?ocorrencia='.$ocorrenciaHandle);
      }
      else if($sucesso == 'False'){
      $_SESSION['mensagem'] = $mensagem;
      header('Location: ../../view/operacional/VisualizarOcorrenciaTransporte.php?ocorrencia='.$ocorrenciaHandle);
      }
    
	
} catch (SoapFault $e) {
    //var_dump($e->getMessage());
    $_SESSION['mensagem'] = 'Erro ao conectar com o WebService, tente novamente mais tarde';
    header('Location: ../../view/operacional/VisualizarOcorrenciaTransporte.php?ocorrencia=' . $ocorrenciaHandle);
}
?>