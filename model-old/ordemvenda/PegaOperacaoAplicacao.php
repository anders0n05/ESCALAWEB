<?php
include_once('../../controller/tecnologia/Sistema.php');

date_default_timezone_set('America/Sao_Paulo');

$connect = Sistema::getConexao();

$aplicacao = Sistema::getPost('aplicacao');
$item = Sistema::getPost('item');

$sqlAplicacao = "SELECT A.OPERACAO
FROM MT_ITEMOPERACAOFISCAL A
WHERE A.APLICACAO = $aplicacao
AND A.NATUREZA IN ( SELECT X1.HANDLE FROM GD_TIPODOCUMENTOITEM X1 WHERE X1.NOME = 'Venda')
AND A.ITEM = $item";
$queryAplicacao = $connect->prepare($sqlAplicacao);
$queryAplicacao->execute();

$operacao = $queryAplicacao->fetch(PDO::FETCH_ASSOC);

echo json_encode($operacao);