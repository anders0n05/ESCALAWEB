<?php

include_once('../tecnologia/Sistema.php');
include '../../controller/tecnologia/wideimage/WideImage.php';
//echo "<pre>";
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

    if ($WebServiceOffline) {
        $_SESSION['mensagem'] = 'Erro ao conectar com o WebService, tente novamente mais tarde';
        header('Location: ../../view/servicedesk/VisualizarDespesaInLoco.php?handle=' . $despesaInLocoHandle . '&referencia=' . $referencia);
        exit;
    }

    $arquivoCount = count($_FILES["image_src"]["name"]);

    $_SESSION['error'] = array();

    $sequencial = 1;
    
    for ($i = 0; $i < $arquivoCount; $i++) {
        
        $arquivoNome = $_FILES["image_src"]["name"][$i];
        
        if (isset($arquivoNome)) {
            //se existir erro gera um array contendo o nome dos anexos com erro - verifica o tamanho do arquivo
            if (($_FILES['image_src']['error'][$i]) || (($_FILES['image_src']['size'][$i] > (2 * 1000 * 1000)) || $_FILES['image_src']['size'][$i] == 0)) {
                array_push($_SESSION['error'], 'Anexo: ' . $arquivoNome . ', você deve diminuir o tamanho da resolução do arquivo.');
            }
            else {
                /*
                $extencao = pathinfo($arquivoNome, PATHINFO_EXTENSION);
                
                if ((filesize($arquivoConteudo) > (2 * 1000 * 1000)) && (strtoupper($extencao) == 'JPG' || strtoupper($extencao) == 'PNG' || strtoupper($extencao) == 'GIF' || strtoupper($extencao) == 'JPEG')) {
                    $image = WideImage::loadFromFile($arquivo);
                    $arquivoConteudo = $image->resize(1280, 840);
                }
                */
                
                $arquivo = $_FILES["image_src"]["tmp_name"][$i];
                $arquivoConteudo = file_get_contents($arquivo);
                
                $params = array(
                    "inlocoDespesa" => $despesaInLocoHandle,
                    "nome" => $arquivoNome,
                    "arquivo" => $arquivoConteudo,
                    "sequencial" => $sequencial
                );
                
                $anexos["listaAnexoInlocoDespesa"]["InserirAnexoInlocoDespesa"][] = $params;
                
                $sequencial++;
            }
        }
    }
    
    if (count($_SESSION['error']) > 0) {
        $_SESSION['mensagem'] = implode($_SESSION['error'], '<br>');
        header('Location: ../../view/servicedesk/VisualizarDespesaInLoco.php?handle=' . $despesaInLocoHandle . '&referencia=' . $referencia);
    }
    else {    
        $result = $clientSoap->__soapCall("InserirAnexoInlocoDespesa", array("InserirAnexoInlocoDespesa" => $anexos));

        $retorno = $result->InserirAnexoInlocoDespesaResult;

        $anexo1 = $retorno->retornoAnexo->RetornoAnexo;

        if (isset($anexo1->protocolo)) {
            $protocolo = $anexo1->protocolo;
        }

        if (isset($anexo1->mensagem)) {
            $mensagem = $anexo1->mensagem;
            print_r($mensagem);
        }

        if (isset($anexo1->sucesso)) {
            $sucesso = $anexo1->sucesso;
            echo 'sucesso:' . $sucesso;
            if ($sucesso <= '') {
                $_SESSION['mensagem'] = 'Erro ao conectar com o WebService, tente novamente mais tarde';
                header('Location: ../../view/servicedesk/VisualizarDespesaInLoco.php?handle=' . $despesaInLocoHandle . '&referencia=' . $referencia);
            }
            if ($sucesso == 'True') {

                header('Location: ../../view/servicedesk/VisualizarDespesaInLoco.php?handle=' . $despesaInLocoHandle . '&referencia=' . $referencia);
            } else if ($sucesso == 'False') {
                $_SESSION['mensagem'] = $mensagem;
                header('Location: ../../view/servicedesk/VisualizarDespesaInLoco.php?handle=' . $despesaInLocoHandle . '&referencia=' . $referencia);
            }
        }

        header('Location: ../../view/servicedesk/VisualizarDespesaInLoco.php?handle=' . $despesaInLocoHandle . '&referencia=' . $referencia);    
    }
} catch (SoapFault $e) {
    var_dump($e->getMessage());
    $_SESSION['mensagem'] = 'Erro ao conectar com o WebService, tente novamente mais tarde';
    header('Location: ../../view/servicedesk/VisualizarDespesaInLoco.php?handle=' . $despesaInLocoHandle . '&referencia=' . $referencia);
}