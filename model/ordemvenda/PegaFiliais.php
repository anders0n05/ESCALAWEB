<?php
$empresaMestre = $_SESSION["empresaMestre"];
$handleUsuarios = $_SESSION["handleUsuario"];

$sqlFiliais = "SELECT B.EMPRESA, C.FILIAL FROM MS_USUARIO A
            LEFT JOIN MS_USUARIOEMPRESA B ON B.USUARIO = A.HANDLE
            LEFT JOIN MS_USUARIOEMPRESAFILIAL C ON C.USUARIOEMPRESA = B.HANDLE
            WHERE A.HANDLE = $handleUsuario";


$queryFiliais = $connect->prepare($sqlFiliais);
$queryFiliais->execute();

$resultado = $queryFiliais->fetch(PDO::FETCH_ASSOC);

if($resultado){
    $filiais = [];
    if($resultado["FILIAL"]){
        $sqlFilial = "SELECT HANDLE, NOME FROM MS_FILIAL WHERE HANDLE = " . $resultado["FILIAL"];
        $queryFilial = $connect->prepare($sqlFilial);
        $queryFilial->execute();

        $filiais[] = $queryFilial->fetch(PDO::FETCH_ASSOC);
    } elseif($resultado["EMPRESA"]){
        $sqlEmpresa = "SELECT HANDLE, NOME FROM MS_FILIAL WHERE EMPRESA = " . $resultado["EMPRESA"];
        $queryFilial = $connect->prepare($sqlEmpresa);
        $queryFilial->execute();

        while($dados = $queryFilial->fetch(PDO::FETCH_ASSOC)){
            $filiais[] = $dados;
        }
    } else{
        $sqlEmpresa = "SELECT HANDLE, NOME FROM MS_FILIAL WHERE EMPRESA = " . $empresaMestre;
        $queryFilial = $connect->prepare($sqlEmpresa);
        $queryFilial->execute();

        while($dados = $queryFilial->fetch(PDO::FETCH_ASSOC)){
            $filiais[] = $dados;
        }
    }
}

