<?php
include_once('../../controller/tecnologia/Sistema.php');
include_once('../../controller/tecnologia/WS.php');

date_default_timezone_set('America/Sao_Paulo');

$connect = Sistema::getConexao();

$handle      = $_POST["HANDLE"];
$nome        = $_POST["NOME"];
$cpf         = $_POST["CPF"];
$senhaweb    = $_POST["SENHAWEB"];
$datahorario = $_POST["DATAHORARIO"];
$email       = $_POST["EMAIL"];

$queryBuscaCPF = $connect->prepare("SELECT A.CPF CPF
                                FROM 
                                    RC_CURRICULO A
                                WHERE 
                                    A.CPF = '$cpf'
                                AND
                                    A.STATUS <> 6
                                ");
$queryBuscaCPF->execute();

var_dump($queryBuscaCPF);

$rowCPF = $queryBuscaCPF->fetch(PDO::FETCH_ASSOC);
$pegaCPF  = $rowCPF['CPF'];

echo $pegaCPF;
echo "------" . $cpf;

if ($pegaCPF == $cpf) {
    echo Sistema::retornoJson(500);
} else {

    //HANDLE SEMPRE VAI COM A ORIGEM 0

    WebService::setupCURL("recrutamento/curriculo/cadastraracesso", [
        "HANDLE"        => $handle,
        "NOME"          => $nome,
        "CPF"           => $cpf,
        "SENHAWEB"      => $senhaweb,
        "DATAHORARIO"   => $datahorario,
        "EMAIL"         => $email
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
}
?>
