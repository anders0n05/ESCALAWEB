<?php
include_once('../../controller/tecnologia/Sistema.php');
include_once('../../controller/tecnologia/WS.php');

date_default_timezone_set('America/Sao_Paulo');

$connect = Sistema::getConexao();

$handle             = $_POST["HANDLE"];
$nome               = $_POST["NOME"];
$cpf                = $_POST["CPF"];
$datahorario        = $_POST["DATAHORARIO"];
$celular            = $_POST["CELULAR"];
$cidade             = $_POST["CIDADE"];
$especialidade      = $_POST["ESPECIALIDADE"];
$estadocivl         = $_POST["ESTADOCIVIL"];
$sexo               = $_POST["SEXO"];
$dataNascimento     = $_POST["DATANASCIMENTO"];
$telefone           = $_POST["TELEFONE"];
$pretensaosalarial  = $_POST["PRETENSAOSALARIAL"];
$atualizadoEm       = $_POST["ATUALIZADOEM"];
$email              = $_POST["EMAIL"];
$redeSocial         = $_POST["REDESOCIAL"];
$filial             = $_POST["FILIAL"];

$chave          = $_POST["CHAVE"];

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

//HANDLE SEMPRE VAI COM A ORIGEM 0

WebService::setupCURL("recrutamento/curriculo/cadastrar", [
    "HANDLE"            => $handle,
    "NOME"              => $nome,
    "CPF"               => $cpf,
    "DATAHORARIO"       => $datahorario,
    "CELULAR"           => $celular,     
    "CIDADE"            => $cidade,
    "ESPECIALIDADE"     => $especialidade,
    "ESTADOCIVIL"       => $estadocivl,
    "SEXO"              => $sexo,
    "DATANASCIMENTO"    => $dataNascimento,
    "TELEFONE"          => $telefone,
    "PRETENSAOSALARIAL" => $pretensaosalarial,
    "ATUALIZADOEM"      => $atualizadoEm,
    "EMAIL"             => $email,
    "REDESOCIAL"        => $redeSocial,
    "FILIAL"            => $filial
    //"CHAVE" => $chave,
]);

WebService::execute();

$body = WebService::getBody();

$dados = json_decode($body, true);

if (isset($dados["Mensagem"])) {
    echo $dados["Mensagem"];
} else {
    echo Sistema::retornoJson(500, $body);
}