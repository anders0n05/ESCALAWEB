<?php

include_once('../../controller/tecnologia/Sistema.php');

date_default_timezone_set('America/Sao_Paulo');

$connect = Sistema::getConexao();

// Tipos
$queryTipos = "SELECT A.HANDLE,
                      A.NOME
                FROM OP_TIPOOCORRENCIA A 
               WHERE A.ACAO = 18
			     AND A.EHEXIBIRWEBCARGAS = 'S'
				 AND A.STATUS = 3";

$queryTipos = $connect->prepare($queryTipos);
$queryTipos->execute();

$tipos = [];

while($dadostipos = $queryTipos->fetch(PDO::FETCH_ASSOC)){
    $tipos[] = $dadostipos;
}
// Fim tipos


// Tipos Entrega
$queryTiposEntrega = "SELECT A.HANDLE,
                      A.NOME,
                      A.RESPONSAVEL
                FROM OP_TIPOOCORRENCIA A 
               WHERE A.ACAO IN (6, 8, 7)
			     AND A.EHEXIBIRWEBCARGAS = 'S'
				 AND A.STATUS = 3";

$queryTiposEntrega = $connect->prepare($queryTiposEntrega);
$queryTiposEntrega->execute();

$tiposEntrega = [];

while($dadostiposEntrega = $queryTiposEntrega->fetch(PDO::FETCH_ASSOC)){
    $tiposEntrega[] = $dadostiposEntrega;
}

// Fim tipos

// Responsavel
$queryResponsavel = "SELECT A.HANDLE,
                      A.NOME
                FROM OP_RESPONSAVELOCORRENCIA A";

$queryResponsavel = $connect->prepare($queryResponsavel);
$queryResponsavel->execute();

$responsavel = [];

while($dadosresponsavel = $queryResponsavel->fetch(PDO::FETCH_ASSOC)){
    $responsavel[] = $dadosresponsavel;
}


// TIPORECEBIMENTO
$queryTipoDoc = "SELECT A.HANDLE,
                        A.SIGLA NOME
                       FROM TR_TIPODOCUMENTO A 
                      WHERE A.EHEMISSAOELETRONICA = 'S'";

$queryTipoDoc = $connect->prepare($queryTipoDoc);
$queryTipoDoc->execute();

$tipoDocs = [];

while($dadosDoc = $queryTipoDoc->fetch(PDO::FETCH_ASSOC)){
    $tipoDocs[] = $dadosDoc;
}

if (isset($_GET["agrupamento"])) {
    // TOTAL SELECIONADO
    $queryValor = "SELECT SUM(VALOR) TOTAL
                    FROM OP_AGRUPAMENTOCOMPOSICAO 
                    WHERE AGRUPAMENTO IN (".$_GET["agrupamento"].")";

    $queryValor = $connect->prepare($queryValor);
    $queryValor->execute();

    $valor = $queryValor->fetch(PDO::FETCH_ASSOC);  
}