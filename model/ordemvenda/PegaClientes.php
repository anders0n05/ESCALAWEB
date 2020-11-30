<?php

$usuario = $_SESSION['handleUsuario'];

$sqlPessoasUsuario = "SELECT C.HANDLE, C.APELIDO NOME FROM MS_USUARIO A
INNER JOIN MS_USUARIOPESSOA B ON B.USUARIO = A.HANDLE
INNER JOIN MS_PESSOA C ON B.PESSOA = C.HANDLE
WHERE A.HANDLE = $usuario";

$queryPessoasUsuario = $connect->prepare($sqlPessoasUsuario);
$queryPessoasUsuario->execute();

$clientes = [];

while($dados = $queryPessoasUsuario->fetch(PDO::FETCH_ASSOC)){
    $clientes[] = $dados;
}