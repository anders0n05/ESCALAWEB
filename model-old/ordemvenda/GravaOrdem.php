<?php
include_once('../../controller/tecnologia/Sistema.php');
include_once('../../controller/tecnologia/WS.php');

date_default_timezone_set('America/Sao_Paulo');

$connect = Sistema::getConexao();

$filial = Sistema::getPost('FILIAL');
$tipo = Sistema::getPost('TIPO');
$data = Sistema::getPost('DATA');
$prioridade = Sistema::getPost('PRIORIDADE');
$cliente = Sistema::getPost('CLIENTE');
$valortotal = Sistema::getPost('VALORTOTAL');
$naturezaoperacao = Sistema::getPost('NATUREZAOPERACAO');
$formapagamento = Sistema::getPost('FORMAPAGAMENTO');
$condicaopagamento = Sistema::getPost('CONDICAOPAGAMENTO');
$contatesouraria = Sistema::getPost('CONTATESOURARIA');
$tabelapreco = Sistema::getPost('TABELAPRECO');
$vendedor = Sistema::getPost('VENDEDOR');
$observacao = Sistema::getPost('OBSERVACAO');
$tipofrete = Sistema::getPost('TIPOFRETE') ? Sistema::getPost('TIPOFRETE') : null;
$tipotransporte = Sistema::getPost('TIPOTRANSPORTE') ? Sistema::getPost('TIPOTRANSPORTE') : null;
$transportadora = Sistema::getPost('TRANSPORTADORA') ? Sistema::getPost('TRANSPORTADORA') : null;
$chave = Sistema::getPost('CHAVE');

WebService::setupCURL("ordemvenda/criar/criarordemvenda", [
    "FILIAL" => $filial,
    "TIPO" => $tipo,
    "DATA" => $data,
    "VENDEDOR" => $vendedor,
    "CLIENTE" => $cliente,
    "TABELAPRECO" => $tabelapreco,
    "FORMAPAGAMENTO" => $formapagamento,
    "CONDICAOPAGAMENTO" => $condicaopagamento,
    "OBSERVACAO" => $observacao,
    "TIPOFRETE" => $tipofrete,
    "TIPOTRANSPORTE" => $tipotransporte,
    "TRANSPORTADORA" => $transportadora,
    "CHAVE" => $chave,
    "ORIGEM" => 3
]);

WebService::execute();

$body = WebService::getBody();

$dados = json_decode($body, true);

if (isset($dados["CHAVE"])) {
    echo $dados["CHAVE"];
} else {
    echo Sistema::retornoJson(500, $body);
}