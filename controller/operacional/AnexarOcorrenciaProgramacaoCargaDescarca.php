<?php

include_once('../tecnologia/Sistema.php');

$webservice = 'armazem';
include_once('../tecnologia/WebService.php');

$retorno = array();

try {
    if (isset($_FILES['file']['name'])) {
        if (($_FILES['file']['error']) || (filesize($_FILES['file']['tmp_name']) > (4 * 1024 * 1024))) {
            throw new Exception('Arquivo ' . $_FILES['file']['name'] . ' inválido, você somente pode enviar arquivos de até 4 MB.');
        } else {
            $nome = $_FILES['file']['name'];
            $extencao = strtolower(pathinfo($nome, PATHINFO_EXTENSION));

            $arquivo = base64_encode(file_get_contents($_FILES['file']['tmp_name']));

            $parametro = array(
                'carregamentoOcorrencia' => Sistema::getPost('handleOcorrencia'),
                'descricao' => $nome,
                'arquivoBase64' => $arquivo);

            Sistema::verificarWebservice($WebServiceOffline);

            $inserirOcorrenciaAnexo = $clientSoap->InserirCarregamentoOcorrenciaAnexo(array('inserirCarregamentoOcorrenciaAnexo' => $parametro));

            Sistema::verificarSoapFault($inserirOcorrenciaAnexo);

            $result = $inserirOcorrenciaAnexo->InserirCarregamentoOcorrenciaAnexoResult;

            Sistema::setRetornoWebService($result, $retorno);
        }
    }
} catch (SoapFault $erro) {
    Sistema::setSoapFault($erro, $retorno);
} catch (Exception $erro) {
    Sistema::setException($erro, $retorno);
}

Sistema::echoToJson($retorno);
