<?php
include_once('../../controller/tecnologia/Sistema.php');
include_once('../../controller/tecnologia/WS.php');

$connect = Sistema::getConexao();

$nome = $_POST["NOME"];
$email = $_POST["EMAIL"];
$telefone = $_POST["TELEFONE"];
$tipo = $_POST["TIPO"];
$descricao = $_POST["DESCRICAO"];
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

WebService::setupCURL("relacionamento/atendimento/incluiratendimento", [
    "FILIAL" => 1,
    "TIPO" => $tipo,
    "SEVERIDADE" => 3,
    "DATA" => date('d/m/Y H:i:s'),
    "CANALATENDIMENTO" => 1,
    "CLIENTE" => $email,
    "SOLICITANTE" => $nome,
    "TELEFONE" => $telefone,
    "CELULAR" => "",
    "EMAIL" => $email,
    "NUMEROCONTROLE" => "",
    "DESCRICAO" => $descricao,
    "ANEXOS" => $anexos,
    "CHAVE" => $chave,
]);

WebService::execute();

$body = WebService::getBody();

$dados = json_decode($body, true);

if (isset($dados["CHAVE"])) {
    echo $dados["CHAVE"];
} else {
    echo Sistema::retornoJson(500, $body);
}