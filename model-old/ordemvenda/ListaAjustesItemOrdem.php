<?php
include_once('../../controller/tecnologia/Sistema.php');

date_default_timezone_set('America/Sao_Paulo');

$connect = Sistema::getConexao();

$item = Sistema::getGet('item');

// Pega os itens da Ordem
$sqlAjuste = "SELECT A.HANDLE,
A.VALOR,
A.EHMANUAL,
B.NOME AJUSTENOME,
C.NOME TIPONOME
FROM VE_ORDEMITEMAJUSTE A
INNER JOIN GD_AJUSTEFINANCEIRO B ON A.AJUSTEFINANCEIRO = B.HANDLE
INNER JOIN GD_TIPOAJUSTEFINANCEIRO C ON B.TIPO = C.HANDLE
WHERE A.ORDEMITEM = $item
AND A.STATUS IN (5)";

$queryAjuste = $connect->prepare($sqlAjuste);
$queryAjuste->execute();

$ajustes = [];

while($dadosAjuste = $queryAjuste->fetch(PDO::FETCH_ASSOC)){
    $dadosAjuste["VALOR"] = Sistema::formataValor($dadosAjuste["VALOR"]);
    
    $ajustes[] = $dadosAjuste;
}

echo json_encode([
    "draw" => $_GET['draw'],
    "recordsTotal" => count($ajustes),
    // "recordsFiltered" => $filtro["FILTRADO"],
    "data" => $ajustes
]);