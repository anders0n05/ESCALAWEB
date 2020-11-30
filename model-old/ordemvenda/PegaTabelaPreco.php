<?php

$sqlTabela = "SELECT A.HANDLE,
A.NOME
FROM CM_TABELA A
WHERE A.STATUS = 8
AND A.TIPO = 4";

$queryTabela = $connect->prepare($sqlTabela);
$queryTabela->execute();

$tabelas = [];

while($dados = $queryTabela->fetch(PDO::FETCH_ASSOC)){
    $tabelas[] = $dados;
}