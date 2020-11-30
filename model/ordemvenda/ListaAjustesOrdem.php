<?php
include_once('../../controller/tecnologia/Sistema.php');

date_default_timezone_set('America/Sao_Paulo');

$connect = Sistema::getConexao();

$ordem = Sistema::getGet('ordem');

// Pega os itens da Ordem
$sqlAjuste = "SELECT A.HANDLE,
A.VALOR,
A.AJUSTEFINANCEIRO,
B.NOME AJUSTENOME,
C.NOME TIPONOME,
A.STATUS,
D.NOME STATUSNOME,
E.RESOURCENAME
FROM VE_ORDEMAJUSTE A
INNER JOIN GD_AJUSTEFINANCEIRO B ON A.AJUSTEFINANCEIRO = B.HANDLE
INNER JOIN GD_TIPOAJUSTEFINANCEIRO C ON B.TIPO = C.HANDLE
INNER JOIN MS_STATUS D ON A.STATUS = D.HANDLE
INNER JOIN MD_IMAGEM E ON D.IMAGEM = E.HANDLE
WHERE A.ORDEM = $ordem
AND A.STATUS NOT IN (6, 7)";

$queryAjuste = $connect->prepare($sqlAjuste);
$queryAjuste->execute();

$ajustes = [];

while($dadosAjuste = $queryAjuste->fetch(PDO::FETCH_ASSOC)){
    $dadosAjuste["STATUSIMAGE"] = Sistema::getImagem($dadosAjuste['RESOURCENAME'], $dadosAjuste['STATUSNOME']);
    $dadosAjuste["VALOR"] = Sistema::formataValor($dadosAjuste["VALOR"]);
    
    $ajustes[] = $dadosAjuste;
}

echo json_encode([
    "draw" => $_GET['draw'],
    "recordsTotal" => count($ajustes),
    "data" => $ajustes
]);