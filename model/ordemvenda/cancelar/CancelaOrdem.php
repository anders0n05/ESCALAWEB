<?php
include_once('../../../controller/tecnologia/Sistema.php');

date_default_timezone_set('America/Sao_Paulo');

$connect = Sistema::getConexao();

$motivo = Sistema::getPost('motivo');
$ordens = $_POST["ordens"];
$mensagens = [];

foreach($ordens as $ordem){
    $json = json_encode([
        "ORDEM" => $ordem,
        "MOTIVO" => $motivo,
    ]);
    
    $ch = curl_init();
    
    curl_setopt($ch, CURLOPT_URL,"http://RSL-PATRICK:9999/escalasoft/ordemvenda/cancelar/cancelarordem");
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

    if(strlen($body) > 0){
        $mensagens[] = "Não foi possível voltar a ordem nº $ordem: " . $body;
    }
}

if(count($mensagens) == 0){
    echo Sistema::retornoJson(200);
} else {
    $mensagens = join("; \n\n ", $mensagens);
    echo Sistema::retornoJson(500, $mensagens);
}