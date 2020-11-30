<?php

if (count($clientes) > 0) {
    $stringClientes = implode(" ,", $clientes);

    $sqlGrupo = " SELECT A.CONTEUDOFINAL HANDLE,
                        A.CONTEUDOFINAL NOME
                        FROM MS_INFOCOMPLEMENTAR A
                        INNER JOIN MT_ITEM B ON A.HANDLEORIGEM = B.HANDLE
                        INNER JOIN MS_TIPOINFOCOMPLEMENTAR C ON C.HANDLE = A.TIPOINFOCOMPLEMENTAR
                        WHERE C.NOME LIKE 'MARKETING - GRUPO%'
                        AND A.STATUS = 8
                        AND A.ORIGEM = (SELECT X1.HANDLE FROM MD_TABELA X1 WHERE X1.NOME = 'MT_ITEM')
                        AND (    EXISTS(SELECT X1.HANDLE FROM MT_ITEMREFERENCIA X1 WHERE X1.PESSOA IN ($stringClientes) AND X1.ITEM = B.HANDLE) 
                              OR B.CLIENTE IN ($stringClientes) )
                        AND (EXISTS(SELECT HANDLE FROM MT_SALDOESTOQUE Z1 WHERE Z1.ITEM = B.HANDLE) 
                              OR EXISTS(SELECT HANDLE FROM AM_SALDOESTOQUE Z2 WHERE Z2.ITEM = B.HANDLE))          
                        GROUP BY A.CONTEUDOFINAL ";
} else {
  $sqlGrupo = " SELECT A.CONTEUDOFINAL HANDLE,
                        A.CONTEUDOFINAL NOME
                        FROM MS_INFOCOMPLEMENTAR A
                        INNER JOIN MS_TIPOINFOCOMPLEMENTAR B ON B.HANDLE = A.TIPOINFOCOMPLEMENTAR
                        WHERE B.NOME LIKE 'MARKETING - GRUPO%'
                        AND A.STATUS = 8
                        AND A.ORIGEM = (SELECT X1.HANDLE FROM MD_TABELA X1 WHERE X1.NOME = 'MT_ITEM')
		        GROUP BY A.CONTEUDOFINAL ";
}

$queryGrupo = $connect->prepare($sqlGrupo);
$queryGrupo->execute();

$grupos = [];

while ($dados = $queryGrupo->fetch(PDO::FETCH_ASSOC)) {
    $grupos[] = $dados;
}