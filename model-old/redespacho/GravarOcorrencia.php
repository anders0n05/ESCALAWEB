<?php
include_once('../../controller/tecnologia/Sistema.php');
include_once('../../controller/tecnologia/WS.php');

date_default_timezone_set('America/Sao_Paulo');

$connect = Sistema::getConexao();

$filial = Sistema::getPost('FILIAL');
$tipo = Sistema::getPost('TIPO');
$data = Sistema::getPost('DATA');
$responsavel = Sistema::getPost('RESPONSAVEL');
$documento = explode(",", Sistema::getPost('HANDLE'));
$romaneio = Sistema::getPost('ROMANEIO');
if (isset($romaneio)) {
    $romaneioArr = explode(",", $romaneio);
}
$redespachador = Sistema::getDadosPessoaUsuarioLogado($connect);

$anexos = [];

if (!empty($_FILES)) {
    foreach ($_FILES['file']['tmp_name'] as $key => $value) {
        if ($_FILES['file']['name'][$key] !== 'blob') {
            $tempFile = $_FILES['file']['tmp_name'][$key];
            $base64 = Sistema::fileToBase64(file_get_contents($tempFile));
            $anexos[] = ["nome" => $_FILES['file']['name'][$key], "arquivo" => $base64, "data" => date('d/m/Y H:i:s')];
        }
    }
}

$arr = array("ocorrencia" => array());
for($i = 0; $i < count($documento); $i++) {
    if(isset($romaneioArr[$i])) {
        $romaneio = $romaneioArr[$i];
    } else {
        $romaneio = null;
    }    

    $arr["ocorrencia"][] = ["documento" => $documento[$i],
                            "romaneio" => $romaneio,
                            "filial" => $filial,
                            "tipo" => $tipo,
                            "data" => $data,
                            "responsavel"=> $responsavel,
                            "redespachador" => $redespachador["HANDLE"],                            
                            "anexo" => $anexos];   
}

WebService::setupCURL("redespacho/criar/criarocorrencia", $arr);

WebService::execute();

$body = WebService::getBody();

$dados = json_decode($body);

if (isset($dados->CHAVE)) {
    echo $dados->CHAVE;
} else {
    echo Sistema::retornoJson(500, $body);
}