<?php

if (count($clientes) > 0) {
    $stringClientes = implode(" ,", $clientes);

    $sqlCampanha = "SELECT A.CONTEUDOFINAL HANDLE,
                           A.CONTEUDOFINAL CONTEUDO
                      FROM MS_INFOCOMPLEMENTAR A                         
                     INNER JOIN MT_ITEM B ON A.HANDLEORIGEM = B.HANDLE
                     INNER JOIN MS_TIPOINFOCOMPLEMENTAR C ON C.HANDLE = A.TIPOINFOCOMPLEMENTAR 
                     WHERE C.NOME LIKE '%MARKETING - CAMPANHA%'
                       AND A.STATUS = 8
                       AND A.ORIGEM = (SELECT X1.HANDLE FROM MD_TABELA X1 WHERE X1.NOME = 'MT_ITEM')
                       AND (   EXISTS (SELECT X1.HANDLE FROM MT_ITEMREFERENCIA X1 WHERE X1.PESSOA IN ($stringClientes) AND X1.ITEM = B.HANDLE) 
                            OR B.CLIENTE IN ($stringClientes) )
                     GROUP BY A.CONTEUDOFINAL";
} else {
    $sqlCampanha = "SELECT A.CONTEUDOFINAL HANDLE,
                           A.CONTEUDOFINAL CONTEUDO
                      FROM MS_INFOCOMPLEMENTAR A
                     INNER JOIN MS_TIPOINFOCOMPLEMENTAR B ON B.HANDLE = A.TIPOINFOCOMPLEMENTAR 
                     WHERE B.NOME LIKE '%MARKETING - CAMPANHA%'
                       AND A.STATUS = 8
                       AND A.ORIGEM = (SELECT X1.HANDLE FROM MD_TABELA X1 WHERE X1.NOME = 'MT_ITEM')
                     GROUP BY A.CONTEUDOFINAL";
}
$queryCampanha = $connect->prepare($sqlCampanha);
$queryCampanha->execute();

$campanhas = [];

while ($dados = $queryCampanha->fetch(PDO::FETCH_ASSOC)) {
    $campanhas[] = $dados;
}