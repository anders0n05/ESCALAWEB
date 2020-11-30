<?php
include_once('../../../controller/tecnologia/Sistema.php');

date_default_timezone_set('America/Sao_Paulo');

$connect = Sistema::getConexao();

$handle = Sistema::getPost('HANDLE');
$ordem = Sistema::getPost('ORDEM');
$item = Sistema::getPost('ITEM');
$unidademedida = Sistema::getPost('UNIDADEMEDIDA');
$variacao = Sistema::getPost('VARIACAO');
$quantidade = Sistema::getPost('QUANTIDADE');
$valorunitario = Sistema::getPost('VALORUNITARIO');
$valortotal = Sistema::getPost('VALORTOTAL');
$observacao = Sistema::getPost('OBSERVACAO');

$json = json_encode([
    "HANDLE" => $handle,
    "ITEM" => $item,
    "UNIDADEMEDIDA" => $unidademedida,
    "VARIACAO" => $variacao,
    "QUANTIDADE" => $quantidade,
    "OBSERVACAO" => $observacao,
    "VALORUNITARIO" => $valorunitario,
    "VALORTOTAL" => $valortotal,
    "ORDEM" => $ordem,
]);

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL,"http://RSL-PATRICK:9999/escalasoft/ordemvenda/alterar/alteraritem");
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