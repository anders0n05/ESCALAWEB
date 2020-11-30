<?php

$sqlPrioridades = "SELECT A.HANDLE,
A.NOME
FROM MS_PRIORIDADE A
WHERE A.HANDLE IN (2,4) ";

$queryPrioridades = $connect->prepare($sqlPrioridades);
$queryPrioridades->execute();

$prioridades = [];

while($dados = $queryPrioridades->fetch(PDO::FETCH_ASSOC)){
    $prioridades[] = $dados;
}