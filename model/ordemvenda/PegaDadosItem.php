<?php
include_once('../../controller/tecnologia/Sistema.php');

date_default_timezone_set('America/Sao_Paulo');

$connect = Sistema::getConexao();

$item = Sistema::getPost('ITEM');

$sqlOrdem = "SELECT A.HANDLE,
A.STATUS,
A.ITEM,
A.UNIDADEMEDIDA,
A.ITEMVARIACAO,
B.MARCA,
A.QUANTIDADE,
A.VALORUNITARIO,
A.TOTALGERAL,
A.VALORAJUSTE,
A.OBSERVACAO
FROM VE_ORDEMITEM A
INNER JOIN MT_ITEM B ON A.ITEM = B.HANDLE
WHERE A.HANDLE = $item";

$queryOrdem = $connect->prepare($sqlOrdem);
$queryOrdem->execute();

$dadosOrdem = $queryOrdem->fetch(PDO::FETCH_ASSOC);

$dadosOrdem["QUANTIDADE"] = Sistema::formataInt($dadosOrdem["QUANTIDADE"]);
$dadosOrdem["VALORUNITARIO"] = Sistema::formataValor($dadosOrdem["VALORUNITARIO"]);
$dadosOrdem["TOTALGERAL"] = Sistema::formataValor($dadosOrdem["TOTALGERAL"]);
$dadosOrdem["VALORAJUSTE"] = Sistema::formataValor($dadosOrdem["VALORAJUSTE"]);

echo json_encode($dadosOrdem);