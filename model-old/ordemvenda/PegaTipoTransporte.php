<?php

$sqlTipoTransporte = "SELECT A.HANDLE,
A.NOME
FROM VE_TIPOTRANSPORTE A";

$queryTipoTransporte = $connect->prepare($sqlTipoTransporte);
$queryTipoTransporte->execute();

$tiposTransporte = [];

while($dados = $queryTipoTransporte->fetch(PDO::FETCH_ASSOC)){
    $tiposTransporte[] = $dados;
}