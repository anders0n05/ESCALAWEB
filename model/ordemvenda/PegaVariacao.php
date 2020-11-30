<?php
include_once('../../controller/tecnologia/Sistema.php');

date_default_timezone_set('America/Sao_Paulo');

$connect = Sistema::getConexao();

$item = Sistema::getPost('item');

$sqlVariacao = "SELECT A.HANDLE,
A.NOME
FROM MT_ITEMVARIACAO A
WHERE A.ITEM = $item";

$queryVariacao = $connect->prepare($sqlVariacao);
$queryVariacao->execute();

$variacoes = [];

while($dados = $queryVariacao->fetch(PDO::FETCH_ASSOC)){
    $variacoes[] = $dados;
}

echo json_encode($variacoes);