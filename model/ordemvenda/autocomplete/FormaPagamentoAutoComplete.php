<?php

include_once('../../../controller/tecnologia/Sistema.php');
date_default_timezone_set('America/Sao_Paulo');

$connect = Sistema::getConexao();
$empresa = $_SESSION['empresa'];
$term = Sistema::getGet('term');

$sqlFormasPagamento = "SELECT A.NOME label
FROM FN_TIPOPAGAMENTO A
WHERE A.STATUS = 3
AND A.NOME LIKE '%$term%'";

$queryFormasPagamento = $connect->prepare($sqlFormasPagamento);
$queryFormasPagamento->execute();

$formasPagamento = [];

while($dados = $queryFormasPagamento->fetch(PDO::FETCH_ASSOC)){
    $formasPagamento[] = $dados;
}

echo json_encode($formasPagamento);