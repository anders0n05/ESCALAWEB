<?php
include_once('../../controller/tecnologia/Sistema.php');

date_default_timezone_set('America/Sao_Paulo');

$connect = Sistema::getConexao();

$ordem = Sistema::getPost('ordem');

$sqlOrdem = "SELECT A.FILIAL,
A.TIPO,
A.DATA,
A.PRIORIDADE,
A.CLIENTE,
A.TABELA TABELAPRECO,
A.FORMAPAGAMENTO,
A.CONDICAOPAGAMENTO,
A.VALORTOTAL,
A.STATUS,
A.OBSERVACAO,
A.FRETEPORCONTA TIPOFRETE,
A.TIPOTRANSPORTE,
A.TRANSPORTADORA,
A.VOLUME,
A.QUANTIDADE QUANTIDADEORDEM,
A.PESOBRUTO PESO,
A.ENTREGARATE,
A.VALORAJUSTE,
A.VALORPRODUTO,
A.VALORSERVICO,
B.NOME STATUSNOME,
C.NOME ESPECIEVOLUME
FROM VE_ORDEM A
INNER JOIN MS_STATUS B ON A.STATUS = B.HANDLE
LEFT JOIN GD_ESPECIEVOLUME C ON A.ESPECIEVOLUME = C.HANDLE
WHERE A.CHAVE = '$ordem'";

$queryOrdem = $connect->prepare($sqlOrdem);
$queryOrdem->execute();

if($dadosOrdem = $queryOrdem->fetch(PDO::FETCH_ASSOC)){
    $dadosOrdem["SUBTOTAL"] = $dadosOrdem["VALORPRODUTO"] + $dadosOrdem["VALORSERVICO"];

    $dadosOrdem["SUBTOTAL"] = Sistema::formataValor($dadosOrdem["SUBTOTAL"]);
    $dadosOrdem["VALORAJUSTE"] = Sistema::formataValor($dadosOrdem["VALORAJUSTE"]);
    $dadosOrdem["DATA"] = Sistema::formataDataHora($dadosOrdem["DATA"]);
    $dadosOrdem["VALORTOTAL"] = Sistema::formataValor($dadosOrdem["VALORTOTAL"]);
    $dadosOrdem["PESO"] = Sistema::formataValor($dadosOrdem["PESO"]);
    $dadosOrdem["VOLUME"] = Sistema::formataValor($dadosOrdem["VOLUME"]);
    $dadosOrdem["QUANTIDADEORDEM"] = Sistema::formataValor($dadosOrdem["QUANTIDADEORDEM"]);
    $dadosOrdem["ENTREGARATE"] = Sistema::formataDataHora($dadosOrdem["ENTREGARATE"]);

    echo json_encode($dadosOrdem);
}