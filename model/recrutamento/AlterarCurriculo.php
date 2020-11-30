<?php
include_once('../../controller/tecnologia/Sistema.php');
include_once('../../controller/tecnologia/WS.php');

date_default_timezone_set('America/Sao_Paulo');

$connect = Sistema::getConexao();

$handleCurriculo    = $_POST["HANDLE"];
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
$experiencia        = $_POST["NIVELEXPERIENCIA"];
$email              = $_POST["EMAIL"];
$redeSocial         = $_POST["REDESOCIAL"];
$filial             = $_POST["FILIAL"];
$observacao         = $_POST["OBSERVACAO"];

$anexos = [];

//$chave          = $_POST["CHAVE"];

print_r($_FILES);

if (!empty($_FILES)) {
    foreach ($_FILES['file']['tmp_name'] as $key => $value) {
        if ($_FILES['file']['name'][$key] !== 'blob') {
            $tempFile = $_FILES['file']['tmp_name'][$key];
            $base64 = Sistema::fileToBase64(file_get_contents($tempFile));
            $anexos[] = ["NOME" => $_FILES['file']['name'][$key], "ARQUIVO" => $base64, "DATA" => date('d/m/Y H:i:s')];
        }
    }
}

WebService::setupCURL("recrutamento/curriculo/alterar", [
    "HANDLE"            => $handleCurriculo,
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
    "NIVELEXPERIENCIA"  => $experiencia,
    "EMAIL"             => $email,
    "REDESOCIAL"        => $redeSocial,
    "FILIAL"            => $filial,
    "OBSERVACAO"        => $observacao,
    "ANEXOS"            => $anexos
    //"CHAVE" => $chave,
]);

WebService::execute();

$body = WebService::getBody();

$dados = json_decode($body, true);

var_dump($dados);

if (isset($dados["Mensagem"])) {
    echo $dados["Mensagem"];
} else {
    echo Sistema::retornoJson(500, $body);
}