<?php

$sqlCondicao = "SELECT A.HANDLE,
A.NOME
FROM FN_CONDICAOPAGAMENTO A
WHERE A.STATUS = 4";

$queryCondicao = $connect->prepare($sqlCondicao);
$queryCondicao->execute();

$condicoesPagamento = [];

while($dados = $queryCondicao->fetch(PDO::FETCH_ASSOC)){
    $condicoesPagamento[] = $dados;
}