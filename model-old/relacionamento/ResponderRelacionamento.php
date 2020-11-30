<?php
include_once('../../controller/tecnologia/Sistema.php');
include_once('../../controller/tecnologia/WS.php');

date_default_timezone_set('America/Sao_Paulo');

$connect = Sistema::getConexao();

$nome = $_POST["NOME"];
$email = $_POST["EMAIL"];
$telefone = $_POST["TELEFONE"];
$atendimento = $_POST["ATENDIMENTO"];
$resposta = $_POST["RESPOSTA"];
$tipo = $_POST["TIPO"];
$chave = $_POST["CHAVE"];

$anexos = [];
if (!empty($_FILES)) {
    foreach ($_FILES['file']['tmp_name'] as $key => $value) {
        if ($_FILES['file']['name'][$key] !== 'blob') {
            $tempFile = $_FILES['file']['tmp_name'][$key];
            $base64 = Sistema::fileToBase64(file_get_contents($tempFile));
            $anexos[] = ["NOME" => $_FILES['file']['name'][$key], "ARQUIVO" => $base64, "DATA" => date('d/m/Y H:i:s')];
        }
    }
}

WebService::setupCURL("relacionamento/atendimento/incluirresposta", [
    "ATENDIMENTO" => $atendimento,
    "RESPOSTA" => $resposta,
    "DATA" => date('d/m/Y H:i:s'),
    "EMAIL" => $email,
    "SOLICITANTE" => $nome,
    "TELEFONE" => $telefone,
    "TIPO" => $tipo,
    "CANAL" => 1,
    "ANEXOS" => $anexos,
    "CHAVE" => $chave,
]);

WebService::execute();

$body = WebService::getBody();

if (strlen($body) == 0) {
    echo Sistema::retornoJson(200);
} else {
    echo Sistema::retornoJson(500, $body);
}