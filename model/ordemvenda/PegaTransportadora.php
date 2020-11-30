<?php

$sqlTransportadora = "SELECT A.HANDLE,
A.APELIDO NOME
FROM MS_PESSOA A 
WHERE A.EHTRANSPORTADOR = 'S'
AND A.STATUS = 4";

$queryTransportadora = $connect->prepare($sqlTransportadora);
$queryTransportadora->execute();

$transportadoras = [];

while($dados = $queryTransportadora->fetch(PDO::FETCH_ASSOC)){
    $transportadoras[] = $dados;
}