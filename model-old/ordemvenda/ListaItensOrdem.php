<?php
include_once('../../controller/tecnologia/Sistema.php');

date_default_timezone_set('America/Sao_Paulo');

$connect = Sistema::getConexao();

$ordem = Sistema::getGet('ordem');

// Pega os itens da Ordem
$sqlItem = "SELECT A.HANDLE,
A.STATUS,
A.SEQUENCIAL,
A.QUANTIDADE,
A.VALORUNITARIO,
A.VALORTOTAL,
A.TOTALGERAL,
A.VALORAJUSTE,
A.OBSERVACAO,
B.NOME ITEM,
A.ITEM ITEMHANLE,
C.SIGLA UNIDADEMEDIDA,
A.UNIDADEMEDIDA UNIDADEMEDIDAHANDLE,
D.NOME VARIACAO,
D.HANDLE VARIACAOHANDLE,
E.NOME MARCA,
B.MARCA MARCAHANDLE,
F.NOME STATUSNOME,
G.RESOURCENAME
FROM VE_ORDEMITEM A
INNER JOIN MT_ITEM B ON A.ITEM = B.HANDLE
INNER JOIN MT_UNIDADEMEDIDA C ON A.UNIDADEMEDIDA = C.HANDLE
INNER JOIN MT_ITEMVARIACAO D ON A.ITEMVARIACAO = D.HANDLE
LEFT JOIN MT_MARCA E ON B.MARCA = E.HANDLE
INNER JOIN MS_STATUS F ON A.STATUS = F.HANDLE
INNER JOIN MD_IMAGEM G ON F.IMAGEM = G.HANDLE
WHERE A.ORDEM = $ordem
AND A.STATUS NOT IN (6)";

$queryItem = $connect->prepare($sqlItem);
$queryItem->execute();

$itens = [];

while($dadosItem = $queryItem->fetch(PDO::FETCH_ASSOC)){
    $dadosItem["STATUSIMAGE"] = Sistema::getImagem($dadosItem['RESOURCENAME'], $dadosItem['STATUSNOME']);
    $dadosItem["VALORUNITARIO"] = Sistema::formataValor($dadosItem["VALORUNITARIO"]);
    $dadosItem["VALORTOTAL"] = Sistema::formataValor($dadosItem["VALORTOTAL"]);
    $dadosItem["VALORAJUSTE"] = Sistema::formataValor($dadosItem["VALORAJUSTE"]);
    $dadosItem["TOTALGERAL"] = Sistema::formataValor($dadosItem["TOTALGERAL"]);
    $dadosItem["QUANTIDADE"] = Sistema::formataInt($dadosItem["QUANTIDADE"]);
    
    $itens[] = $dadosItem;
}

echo json_encode([
    "draw" => $_GET['draw'],
    "recordsTotal" => count($itens),
    "data" => $itens
]);