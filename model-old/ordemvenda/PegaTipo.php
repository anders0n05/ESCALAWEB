<?php
$sqlTipos = "SELECT A.HANDLE,
A.NOME,
A.CONTATESOURARIA,
A.NATUREZAOPERACAO,
A.CONDICAOPAGAMENTO,
A.FORMAPAGAMENTO,
A.EHPERMITEVENDASEMTABELAPRECO PERMITESEMTABELA,
A.TABELAPADRAO
FROM VE_TIPOORDEM A WHERE  A.STATUS = 4
AND A.EHLANCARWEB = 'S'";

$queryTipos = $connect->prepare($sqlTipos);
$queryTipos->execute();

$tipos = [];

while($dadostipos = $queryTipos->fetch(PDO::FETCH_ASSOC)){
    $tipos[] = $dadostipos;
}
// Fim tipos