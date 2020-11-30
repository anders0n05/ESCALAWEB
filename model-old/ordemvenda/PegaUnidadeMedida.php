<?php

$sqlUnidade = "SELECT A.HANDLE,
A.SIGLA
FROM MT_UNIDADEMEDIDA A
WHERE A.STATUS = 3";

$queryUnidade = $connect->prepare($sqlUnidade);
$queryUnidade->execute();

$unidadesMedida = [];

while($dados = $queryUnidade->fetch(PDO::FETCH_ASSOC)){
    $unidadesMedida[] = $dados;
}