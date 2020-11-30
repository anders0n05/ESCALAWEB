<?php

include_once('../../controller/tecnologia/Sistema.php');

date_default_timezone_set('America/Sao_Paulo');

$connect = Sistema::getConexao();

$atendimento = $_GET['atendimento'];

$sqlOrdem = "SELECT A.DATA,
                    A.HANDLE,
                    A.CHAVE,
                    A.SOLICITANTE,
                    A.TELEFONE,
                    A.EMAIL,
                    B.HANDLE STATUSHANDLE,
                    B.NOME STATUS,
                    C.NOME TIPO,
                    C.HANDLE TIPOHANDLE,

                    D.CONTEUDO MODELO,

                    E.CONTEUDO NUMEROSERIE,

                    F.CONTEUDO MARCA,

                    G.CONTEUDO NFE

                FROM RE_ORDEM A
                INNER JOIN MS_STATUS    B ON A.STATUS = B.HANDLE
                INNER JOIN RE_TIPOORDEM C ON A.TIPO = C.HANDLE
                LEFT JOIN MS_INFOCOMPLEMENTAR D ON D.ORIGEM = 5854
                                                AND D.HANDLEORIGEM = A.HANDLE
                                                AND D.TIPOINFOCOMPLEMENTAR = 8
                LEFT JOIN MS_INFOCOMPLEMENTAR E ON E.ORIGEM = 5854
                                                AND E.HANDLEORIGEM = A.HANDLE
                                                AND E.TIPOINFOCOMPLEMENTAR = 10
                LEFT JOIN MS_INFOCOMPLEMENTAR F ON F.ORIGEM = 5854
                                                AND F.HANDLEORIGEM = A.HANDLE
                                                AND F.TIPOINFOCOMPLEMENTAR = 7
                LEFT JOIN MS_INFOCOMPLEMENTAR G ON G.ORIGEM = 5854
                                                AND G.HANDLEORIGEM = A.HANDLE
                                                AND G.TIPOINFOCOMPLEMENTAR = 38
                WHERE A.CHAVE LIKE '$atendimento'";

$queryOrdem = $connect->prepare($sqlOrdem);
$queryOrdem->execute();

$dadosOrdem = $queryOrdem->fetch(PDO::FETCH_ASSOC);

$gambiaStatusModal = ($dadosOrdem["STATUSHANDLE"] == 5 ? 2 : 1);

if(!$dadosOrdem){
    echo "<h1>Registro não encontrado!</h1>";
    exit;
} else{
    $handle = $dadosOrdem["HANDLE"];
    $dadosOrdem["DATA"] = Sistema::formataDataHoraSegundo($dadosOrdem["DATA"]);

    $sqlEquipamento = "SELECT A.NOME
    FROM ME_EQUIPAMENTO A WHERE HANDLE = (SELECT X1.CONTEUDO
        FROM MS_INFOCOMPLEMENTAR X1
        WHERE X1.TIPOINFOCOMPLEMENTAR IN (6)
        AND X1.ORIGEM IN (SELECT X2.HANDLE FROM MD_TABELA X2 WHERE X2.NOME = 'RE_ORDEM')
        AND X1.HANDLEORIGEM = $handle)";

    $sqlMarcaEquipamento = "SELECT X1.CONTEUDO NOME
                    FROM MS_INFOCOMPLEMENTAR X1
                    WHERE X1.TIPOINFOCOMPLEMENTAR IN (7)
                    AND X1.ORIGEM IN (SELECT X2.HANDLE FROM MD_TABELA X2 WHERE X2.NOME = 'RE_ORDEM')
                    AND X1.HANDLEORIGEM = $handle";

    $sqlModeloEquipamento = "SELECT X1.CONTEUDO NOME
                    FROM MS_INFOCOMPLEMENTAR X1
                    WHERE X1.TIPOINFOCOMPLEMENTAR IN (8)
                    AND X1.ORIGEM IN (SELECT X2.HANDLE FROM MD_TABELA X2 WHERE X2.NOME = 'RE_ORDEM')
                    AND X1.HANDLEORIGEM = $handle";

    $sqlNRSerieEquipamento = "SELECT A.CONTEUDO
                FROM MS_INFOCOMPLEMENTAR A
                WHERE A.TIPOINFOCOMPLEMENTAR IN (10)
                AND A.ORIGEM IN (SELECT HANDLE FROM MD_TABELA WHERE NOME = 'RE_ORDEM')
                AND A.HANDLEORIGEM = $handle";


    $sqlRelacionamento = "SELECT A.DATA,
                                 A.HANDLE,
                                 A.DESCRICAO,
                                 B.NOME TIPO,
                                 C.NOME CANAL
                                FROM RE_ORDEMRELACIONAMENTO A
                                INNER JOIN RE_TIPOORDEMRELACIONAMENTO B ON A.TIPO  = B.HANDLE
                                INNER JOIN RE_CANALORDEM              C ON A.CANAL = C.HANDLE
                                WHERE A.ORDEM = $handle
								  AND A.EHVISUALIZARWEB = 'S'
                                ORDER BY A.DATA DESC";

    $queryEquipamento = $connect->prepare($sqlEquipamento);
    $queryEquipamento->execute();
    $dadosEquipamento = $queryEquipamento->fetch(PDO::FETCH_ASSOC);

    $queryMarcaEquipamento = $connect->prepare($sqlMarcaEquipamento);
    $queryMarcaEquipamento->execute();
    $dadosMarcaEquipamento = $queryMarcaEquipamento->fetch(PDO::FETCH_ASSOC);

    $queryModeloEquipamento = $connect->prepare($sqlModeloEquipamento);
    $queryModeloEquipamento->execute();
    $dadosModeloEquipamento = $queryModeloEquipamento->fetch(PDO::FETCH_ASSOC);

    $queryNRSerieEquipamento = $connect->prepare($sqlNRSerieEquipamento);
    $queryNRSerieEquipamento->execute();
    $dadosNRSerieEquipamento = $queryNRSerieEquipamento->fetch(PDO::FETCH_ASSOC);

    $queryRelacionamento = $connect->prepare($sqlRelacionamento);
    $queryRelacionamento->execute();

    $relacionamentos = [];

    while ($dadosRelacionamento = $queryRelacionamento->fetch(PDO::FETCH_ASSOC)){
        $anexos = [];

        $dadosRelacionamento["DATA"] = Sistema::formataDataHoraSegundo($dadosRelacionamento["DATA"]);
        $sqlAnexoRelacionamento = "SELECT A.*
                                    FROM RE_ORDEMANEXO A
                                    WHERE A.ORDEMRELACIONAMENTO = " . $dadosRelacionamento['HANDLE'] . " AND ORDEM = " . $dadosOrdem["HANDLE"];
        
        $queryAnexoRelacionamento = $connect->prepare($sqlAnexoRelacionamento);
        $queryAnexoRelacionamento->execute();

        while($anexoRelacionamento = $queryAnexoRelacionamento->fetch(PDO::FETCH_ASSOC)){
            $anexos[] = $anexoRelacionamento;
        }

        $dadosRelacionamento["ANEXOS"] = $anexos;

        $relacionamentos[] = $dadosRelacionamento;
    }
}