<?php

include_once('../../controller/tecnologia/Sistema.php');

date_default_timezone_set('America/Sao_Paulo');

$connect = Sistema::getConexao();

$ordem = 1;

$queryRelacionamentos = "SELECT A.NUMERO,
                                A.DESCRICAO
                                FROM RE_ORDEMRELACIONAMENTO A
                                WHERE A.ORDEM = $ordem";

$queryRelacionamentos = $connect->prepare($queryRelacionamentos);
$queryRelacionamentos->execute();

$relacionamentos = [];

while($relacionamento = $queryRelacionamentos->fetch(PDO::FETCH_ASSOC)){
    $relacionamentos[] = $relacionamento;
}

echo json_encode([
    "draw" => $_GET["draw"],
    "recordsTotal" => count($relacionamentos),
    "recordsFiltered" => count($relacionamentos),
    "data" => $relacionamentos
]);