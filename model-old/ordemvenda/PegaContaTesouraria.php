<?php

$sqlConta = "SELECT A.HANDLE,
A.NOME
FROM TS_CONTA A
WHERE A.STATUS = 3 ";

$queryConta = $connect->prepare($sqlConta);
$queryConta->execute();

$contasTesouraria = [];

while($dados = $queryConta->fetch(PDO::FETCH_ASSOC)){
    $contasTesouraria[] = $dados;
}