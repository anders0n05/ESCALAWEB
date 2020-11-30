<?php

$empresa = $_SESSION['empresaMestre'];

$sqlAjustes = "SELECT A.HANDLE,
A.NOME,
B.NOME TIPO,
B.HANDLE TIPOHANDLE
FROM GD_AJUSTEFINANCEIRO A  
LEFT JOIN GD_TIPOAJUSTEFINANCEIRO B ON A.TIPO = B.HANDLE
WHERE A.EMPRESA IN ($empresa) AND (A.EHDOCUMENTO = 'S' AND A.ABRANGENCIA = 2) AND (A.STATUS = 3)";

$queryAjustes = $connect->prepare($sqlAjustes);
$queryAjustes->execute();

$ajustes = [];

while($dados = $queryAjustes->fetch(PDO::FETCH_ASSOC)){
    $ajustes[] = $dados;
}