<?php
$sqlMarca = "SELECT A.HANDLE, A.NOME
FROM MT_MARCA A";

$queryMarcas = $connect->prepare($sqlMarca);
$queryMarcas->execute();

$marcas = [];

while($dados = $queryMarcas->fetch(PDO::FETCH_ASSOC)){
    $marcas[] = $dados;
}