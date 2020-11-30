<?php
include_once('../../../controller/tecnologia/Sistema.php');

date_default_timezone_set('America/Sao_Paulo');

$connect = Sistema::getConexao();

$ordem = Sistema::getPost('ORDEM');
$prioridade = Sistema::getPost('PRIORIDADE');
$formapagamento = Sistema::getPost('FORMAPAGAMENTO');
$condicaopagamento = Sistema::getPost('CONDICAOPAGAMENTO');
$observacao = Sistema::getPost('OBSERVACAO');
$tipofrete = Sistema::getPost('TIPOFRETE') ? Sistema::getPost('TIPOFRETE') : null;
$tipotransporte = Sistema::getPost('TIPOTRANSPORTE') ? Sistema::getPost('TIPOTRANSPORTE') : null;
$transportadora = Sistema::getPost('TRANSPORTADORA') ? Sistema::getPost('TRANSPORTADORA') : null;

$json = json_encode([
    "ORDEM" => $ordem,
    "PRIORIDADE" => $prioridade,
    "FORMAPAGAMENTO" => $formapagamento,
    "CONDICAOPAGAMENTO" => $condicaopagamento,
    "OBSERVACAO" => $observacao,
    "TIPOFRETE" => $tipofrete,
    "TIPOTRANSPORTE" => $tipotransporte,
    "TRANSPORTADORA" => $transportadora,
]);

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL,"http://RSL-PATRICK:9999/escalasoft/ordemvenda/alterar/alterarordem");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
curl_setopt($ch, CURLOPT_VERBOSE, true);
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json',                                                                                
    'Content-Length: ' . strlen($json))                                                                       
);

$result = curl_exec($ch);

$header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
$header = substr($result, 0, $header_size);
$body = substr($result, $header_size);

curl_close($ch);

if(strlen($body) == 0){
    header("HTTP/1.1 200 Ok");
} else {
    echo $body;
    header("HTTP/1.1 500 Internal Server Error");
}