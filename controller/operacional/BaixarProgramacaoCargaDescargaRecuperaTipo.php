<?php

include_once('../tecnologia/Sistema.php');

$connect = Sistema::getConexao();

$carregamento = Sistema::getPost('handle');

$queryTipo = "SELECT A.ACAO acao,
                     A.HANDLE id,
                     A.NOME value
                FROM AM_TIPOCARREGAMENTOOCORRENCIA A 
               WHERE A.EHPERMITIRWEB = 'S'
                 AND A.STATUS = 4
                 AND A.ACAO = 5
                 AND EXISTS (SELECT X.HANDLE
                               FROM AM_CARREGAMENTO X
                              WHERE X.HANDLE = $carregamento
                                AND X.STATUS IN (8, 9, 10, 15, 19))
               
               UNION
               
              SELECT A.ACAO acao,
                     A.HANDLE id,
                     A.NOME value
                FROM AM_TIPOCARREGAMENTOOCORRENCIA A 
               WHERE A.EHPERMITIRWEB = 'S'
                 AND A.STATUS = 4
                 AND A.ACAO IN (1, 3, 4)
                 
               ORDER BY value ASC";
$queryTipoPrepare = $connect->prepare($queryTipo);
$queryTipoPrepare->execute();

echo json_encode($queryTipoPrepare->fetchAll(PDO::FETCH_ASSOC));
