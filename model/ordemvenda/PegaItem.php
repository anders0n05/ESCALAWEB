<?php
include_once('../../controller/tecnologia/Sistema.php');

date_default_timezone_set('America/Sao_Paulo');

$connect = Sistema::getConexao();

$tabela = Sistema::getPost('tabela');

$empresa = $_SESSION['empresa'];

$sqlItem = "SELECT C.HANDLE,
C.NOME,
C.MARCA,
C.UNIDADEMEDIDA,
B.VALOR,
C.OBSERVACAO
FROM CM_LISTA A 
INNER JOIN CM_LISTAITEM B ON B.LISTA = A.HANDLE
INNER JOIN MT_ITEM C ON B.ITEM = C.HANDLE
WHERE A.TABELA = $tabela
AND A.STATUS <> 5 
AND B.EHNAOPERMITIRVENDAINDIVIDUAL <> 'S'";

$queryItem = $connect->prepare($sqlItem);
$queryItem->execute();

$itens = [];

while($dados = $queryItem->fetch(PDO::FETCH_ASSOC)){
    $dados["VALOR"] = Sistema::formataValor($dados["VALOR"]);
    $itens[] = $dados;
}

echo json_encode($itens);