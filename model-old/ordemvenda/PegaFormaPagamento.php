<?php

$sqlFormaPagamento = "SELECT A.HANDLE,
A.NOME
FROM FN_TIPOPAGAMENTO A
WHERE A.STATUS = 3 ";

$queryFormaPagamento = $connect->prepare($sqlFormaPagamento);
$queryFormaPagamento->execute();

$formasPagamento = [];

while($dados = $queryFormaPagamento->fetch(PDO::FETCH_ASSOC)){
    $formasPagamento[] = $dados;
}