<?php

include_once('../tecnologia/Sistema.php');

$connect = Sistema::getConexao();
$handleCarga = Sistema::getPost('handle');

$dados = $connect->prepare("SELECT OBSERVACAO FROM AM_CARREGAMENTO WHERE HANDLE = $handleCarga");

try {
    $dados->execute();
    $row = $dados->FETCH(PDO::FETCH_ASSOC);
    
    if (empty(trim($row['OBSERVACAO']))) {
        $observacao = 'Observação não informada.';
    } else {
        $observacao = Sistema::formataTexto($row['OBSERVACAO'], 500);
    }
        
    $retorno = array('sucesso' => 'S', 'retorno' => $observacao);
    
    echo json_encode($retorno);    
} catch (Exception $e) {
    Sistema::tratarErro($e);
}