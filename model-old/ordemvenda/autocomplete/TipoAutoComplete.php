<?php

include_once('../../../controller/tecnologia/Sistema.php');
date_default_timezone_set('America/Sao_Paulo');

$connect = Sistema::getConexao();
$empresa = $_SESSION['empresa'];
$term = Sistema::getGet('term');

$sqlTipos = "SELECT A.NOME label
FROM VE_TIPOORDEM A 
WHERE A.EMPRESA IN ($empresa)
AND A.STATUS = 4
AND A.NOME LIKE '%$term%'";

$queryTipos = $connect->prepare($sqlTipos);
$queryTipos->execute();

$tipos = [];

while($dados = $queryTipos->fetch(PDO::FETCH_ASSOC)){
    $tipos[] = $dados;
}


echo json_encode($tipos);