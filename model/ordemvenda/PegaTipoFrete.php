<?php

$sqlTipoFrete = "SELECT A.HANDLE,
A.NOME
FROM GD_FRETEPORCONTA A";

$queryTipoFrete = $connect->prepare($sqlTipoFrete);
$queryTipoFrete->execute();

$tiposFrete = [];

while($dados = $queryTipoFrete->fetch(PDO::FETCH_ASSOC)){
    $tiposFrete[] = $dados;
}