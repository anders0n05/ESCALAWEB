<?php

include_once('../../../controller/tecnologia/Sistema.php');
date_default_timezone_set('America/Sao_Paulo');

$connect = Sistema::getConexao();
$term = Sistema::getGet('term');

$sqlClientes = "SELECT C.APELIDO label FROM MS_USUARIO A
INNER JOIN MS_USUARIOPESSOA B ON B.USUARIO = A.HANDLE
INNER JOIN MS_PESSOA C ON B.PESSOA = C.HANDLE
WHERE (C.NOME LIKE '%$term%' OR C.APELIDO LIKE '%$term%')";

$queryClientes = $connect->prepare($sqlClientes);
$queryClientes->execute();

$clientes = [];

while($dados = $queryClientes->fetch(PDO::FETCH_ASSOC)){
    $clientes[] = $dados;
}


echo json_encode($clientes);