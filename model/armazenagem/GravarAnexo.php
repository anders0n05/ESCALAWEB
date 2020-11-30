<?php
include_once('../../controller/tecnologia/Sistema.php');
include_once('../../controller/tecnologia/WS.php');

date_default_timezone_set('America/Sao_Paulo');

$connect = Sistema::getConexao();

$data = Sistema::getPost('DATA');
$cargaDescarga = Sistema::getPost('HANDLE');
$assunto = Sistema::getPost('ASSUNTO');
$gravarAutomatico = Sistema::getPost('GRAVARAUTOMATICO');


$anexos = [];

if (!empty($_FILES)) {
    foreach ($_FILES['file']['tmp_name'] as $key => $value) {
        if ($_FILES['file']['name'][$key] !== 'blob') {
            $tempFile = $_FILES['file']['tmp_name'][$key];
            $base64 = Sistema::fileToBase64(file_get_contents($tempFile));
            $anexos[] = ["nome" => $_FILES['file']['name'][$key], "arquivo" => $base64, "data" => date('d/m/Y H:i:s'), "assunto" => $assunto];
        }
    }
}

$arr = array("cargaDescarga" => array());

$arr["cargaDescarga"][] = ["handle" => $cargaDescarga,
                            "anexo" => $anexos,
                            "usuario" => $handleUsuario];   


WebService::setupCURL("armazenagem/criar/criaranexo", $arr);

WebService::execute();

$body = WebService::getBody();

$dados = json_decode($body);

if (isset($dados->CHAVE)) {
    echo $dados->CHAVE;
} else {
    echo Sistema::retornoJson(500, $body);
}