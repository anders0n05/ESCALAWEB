<?php

if (count($clientes) > 0) {
    $stringClientes = implode(" ,", $clientes);

    $sqlCentroCusto = "SELECT A.CONTEUDO HANDLE,
                        A.CONTEUDO
                        FROM MS_INFOCOMPLEMENTAR A
                        INNER JOIN MT_ITEM B ON A.HANDLEORIGEM = B.HANDLE
                        WHERE A.TIPOINFOCOMPLEMENTAR = 11
                        AND A.STATUS = 8
                        AND A.ORIGEM = (SELECT X1.HANDLE FROM MD_TABELA X1 WHERE X1.NOME = 'MT_ITEM')
                        AND (   EXISTS(SELECT X1.HANDLE FROM MT_ITEMREFERENCIA X1 WHERE X1.PESSOA IN ($stringClientes) AND X1.ITEM = B.HANDLE) 
                             OR B.CLIENTE IN ($stringClientes) )
                        GROUP BY A.CONTEUDO";
} else {
    $sqlCentroCusto = "SELECT A.CONTEUDO HANDLE,
                        A.CONTEUDO
                        FROM MS_INFOCOMPLEMENTAR A
                        WHERE A.TIPOINFOCOMPLEMENTAR = 11
                        AND A.STATUS = 8
                        AND A.ORIGEM = (SELECT X1.HANDLE FROM MD_TABELA X1 WHERE X1.NOME = 'MT_ITEM')
						GROUP BY A.CONTEUDO";
}

$queryCentroCusto = $connect->prepare($sqlCentroCusto);
$queryCentroCusto->execute();

$centroCustos = [];

while ($dados = $queryCentroCusto->fetch(PDO::FETCH_ASSOC)) {
    $centroCustos[] = $dados;
}