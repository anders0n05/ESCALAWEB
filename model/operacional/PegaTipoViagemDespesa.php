<?php
$sqlTipoViagemDespesa = "SELECT A.HANDLE,
                                A.NOME
                        FROM OP_TIPOVIAGEMDESPESA A 
                        WHERE A.EHPERMITEUTILIZACAOWEB = 'S'
                        AND A.STATUS = 3";

$queryTipoViagemDespesa = $connect->prepare($sqlTipoViagemDespesa);
$queryTipoViagemDespesa->execute();

$tiposDespesa = [];

while($dadosTipoViagemDespesa = $queryTipoViagemDespesa->fetch(PDO::FETCH_ASSOC)){
    $tiposDespesa[] = $dadosTipoViagemDespesa;
}
// Fim tipos