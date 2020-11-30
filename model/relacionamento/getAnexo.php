<?php
include_once('../../controller/tecnologia/Sistema.php');

date_default_timezone_set('America/Sao_Paulo');

$connect = Sistema::getConexao();

$atendimento = $_GET["atendimento"];
$anexo = $_GET["anexo"];

$json = json_encode([
    "ANEXO" => $anexo,
    "ATENDIMENTO" => $atendimento
]);

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL,"http://srv-qualidade:8082/escalasoft/relacionamento/atendimento/pegaanexo");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_VERBOSE, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json',                                                                                
    'Content-Length: ' . strlen($json))                                                                       
);

$response = curl_exec($ch);

// Then, after your curl_exec call:
$header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
$header = substr($response, 0, $header_size);
$body = substr($response, $header_size);

$resultado = json_decode($body, true);

if($resultado){
    header( 'Content-Disposition: attachment; filename=' . $anexo);
    echo base64_decode($resultado["ANEXO"]);
} else {
    echo "Anexo não encontrado!";
}