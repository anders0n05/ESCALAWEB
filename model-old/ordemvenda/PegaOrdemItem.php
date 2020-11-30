<?php
include_once('../../controller/tecnologia/Sistema.php');

date_default_timezone_set('America/Sao_Paulo');

$connect = Sistema::getConexao();

$item = Sistema::getPost('item');
$ordem = Sistema::getPost('ordem');

$sqlItem = "SELECT A.*
FROM VE_ORDEMITEM A
WHERE A.HANDLE = $item
AND A.ORDEM = $ordem";

$queryItem = $connect->prepare($sqlItem);
$queryItem->execute();

$itens = [];

while($dados = $queryItem->fetch(PDO::FETCH_ASSOC)){
    $dados["VALOR"] = Sistema::formataValor($dados["VALOR"]);
    $itens[] = $dados;
}

echo json_encode($itens);