<?php
include_once('../../controller/tecnologia/Sistema.php');
include_once('../../controller/tecnologia/WS.php');

date_default_timezone_set('America/Sao_Paulo');

$connect = Sistema::getConexao();

$handleCurriculo    = $_POST["HANDLE"];
$nome               = $_POST["NOME"];
$cpf                = $_POST["CPF"];
$senhaAtual         = $_POST["SENHAATUAL"];
$novaSenha          = $_POST["SENHAWEB"];

$senhaCriptografada = base64_encode(sha1($senhaAtual, true));

$queryLogin = $connect->prepare("SELECT A.CPF CPF,
                                   A.HANDLE HANDLE,
                                   A.STATUS STATUS,
                                   A.SENHAWEB SENHAWEB
                                FROM 
                                    RC_CURRICULO A
                                WHERE 
                                    A.CPF = '$cpf'
                                AND
                                    A.STATUS <> 6
                                AND
                                    A.HANDLE = '$handleCurriculo'
                                AND 
                                    A.SENHAWEB = '".$senhaCriptografada."'
                                ");
$queryLogin->execute();

$rowLogin = $queryLogin->fetch(PDO::FETCH_ASSOC);

$senha  = $rowLogin['SENHAWEB'];

// VERIFICAR SE A SENHA DIGITADA NÃO É A MESMA JÁ CADASTRADA

if ($senha != $senhaCriptografada) {
    echo Sistema::retornoJson(500);
} else {

WebService::setupCURL("recrutamento/curriculo/alterarsenhaacesso", [
    "HANDLE"    => $handleCurriculo,
    "NOME"      => $nome,
    "CPF"       => $cpf,
    "SENHAWEB"  => $novaSenha
]);

WebService::execute();

$body = WebService::getBody();

$dados = json_decode($body, true);

if (isset($dados["Mensagem"])) {
    echo $dados["Mensagem"];
} else {
    echo Sistema::retornoJson(500, $body);
}
}
?>