<?php
$sqlViagemDespesaItem = " SELECT HANDLE, NOME
                            FROM MT_ITEM A
                            WHERE EXISTS (SELECT Z.HANDLE 
                                            FROM MT_ITEMOPERACAOFISCAL Z 
                                           WHERE Z.ITEM = A.HANDLE 
                                             AND Z.NATUREZA = 1
                                             AND Z.STATUS = 3
                                             AND Z.OPERACAO IS NOT NULL) ";

$queryViagemDespesaItem = $connect->prepare($sqlViagemDespesaItem);
$queryViagemDespesaItem->execute();

$despesas = [];

while($dadosViagemDespesaItem = $queryViagemDespesaItem->fetch(PDO::FETCH_ASSOC)){
    $despesas[] = $dadosViagemDespesaItem;
}