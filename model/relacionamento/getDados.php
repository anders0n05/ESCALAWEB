<?php

include_once('../../controller/tecnologia/Sistema.php');

date_default_timezone_set('America/Sao_Paulo');

$connect = Sistema::getConexao();

// Tipos
$queryTipos = "SELECT A.HANDLE,
                      A.NOME
                FROM RE_TIPOORDEM A";

$queryTipos = $connect->prepare($queryTipos);
$queryTipos->execute();

$tipos = [];

while($dadostipos = $queryTipos->fetch(PDO::FETCH_ASSOC)){
    $tipos[] = $dadostipos;
}
// Fim tipos

// Marcas equipamentos
$queryMarcasEquipamentos = "SELECT A.HANDLE,
                                   A.NOME
                                FROM ME_MARCA A";

$queryMarcasEquipamentos = $connect->prepare($queryMarcasEquipamentos);
$queryMarcasEquipamentos->execute();

$marcasEquipamentos = [];

while($dadosmarcasequipamentos = $queryMarcasEquipamentos->fetch(PDO::FETCH_ASSOC)){
    $marcasEquipamentos[] = $dadosmarcasequipamentos;
}
// Fim marcas equipamentos

// Equipamentos
$queryModelosEquipamentos = "SELECT A.HANDLE,
                                   A.NOME
                                FROM ME_MODELO A";

$queryModelosEquipamentos = $connect->prepare($queryModelosEquipamentos);
$queryModelosEquipamentos->execute();

$modelosEquipamentos = [];

while($dadosmodelosequipamentos = $queryModelosEquipamentos->fetch(PDO::FETCH_ASSOC)){
    $modelosEquipamentos[] = $dadosmodelosequipamentos;
}
// Fim equipamentos