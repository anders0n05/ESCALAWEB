<?php
include_once('../../../controller/tecnologia/Sistema.php');

date_default_timezone_set('America/Sao_Paulo');

$connect = Sistema::getConexao();

$departamentosCriticos = [];


$unidadeNegocio = getUnidadeNegocioPessoaLogada($connect);
$unidadeNegocio = strtolower($unidadeNegocio["NOME"]);

if ($unidadeNegocio === 'armazenagem') {
    $unidadeNegocio = implode(',', [
        4, //WMS
        8  //CMS
    ]);
} elseif ($unidadeNegocio === 'transporte') {
    $unidadeNegocio = implode(',', [
        3, //TMS
        5  //FMS
    ]);
} elseif ($unidadeNegocio === 'corporativo') {
    $unidadeNegocio = implode(",", [
        1  //ERP
//        2,  //TEC
//        6,  //CRM
//        7,  //ESC
//        9,  //PRO
//        10  // RH
    ]);
} else if ($unidadeNegocio === 'e-commerce') {
    $unidadeNegocio = implode(",", [
        11,  //B2C
    ]);

} else if ($unidadeNegocio === 'tecnologia') {
    $unidadeNegocio = implode(",", [
        2,  //TEC
        6,  //CRM
        7,  //ESC
        9,  //PRO
        10  // RH
    ]);

}

$agora = date("Y-m-d H:i:s");

$hojeInicio = date("Y-m-d 00:00:00");
$hojeFim = date("Y-m-d 23:59:59");

$ontemInicio = date("Y-m-d 00:00:00", strtotime('-1 day', time()));
$ontemFim = date("Y-m-d 23:59:59", strtotime('-1 day', time()));

$mesInicio = date("Y-m-01 00:00:00");
$mesFim = date("Y-m-t 23:59:59");

$liberadoAtendimento = implode(",", [
    5,  // Falta de Informação
    8,  // Solução de Atendimento
    16, // Encaminhar para desenvolvimento (evidenciado)
    19, // Encaminhar para consultoria (orçar)
    20, // Encaminhar para serviço técnico (orçar)
    21, // Devolução com solução do desenvolvimento
    22, // Devolução com orçamento do desenvolvimento
    26, // Encaminhar para desenvolvimento (aprovação orçamento)
    27, // Encaminhar para desenvolvimento (só encaminhado)
    36, // Encaminhar para desenvolvimento (rejeição orçamento)
    38, // Encaminhar para consultoria (aprovação orçamento)
    39, // Encaminhar para consultoria (rejeição orçamento)
    40, // Encaminhar para serviço técnico (aprovação orçamento)
    41, // Encaminhar para serviço técnico (rejeição orçamento)
]);

$liberadoDesenvolvimento = implode(",", [
    17, // Encaminhar para qualidade (nova versão)
    18, // Encaminhar para atendimento (retornar ao cliente)
    28, // Encaminhar para qualidade (gerar versão)
    29, // Encaminhar para atendimento (devolução/retrabalho)
]);

$queryAtendimento = "SELECT ( SELECT COUNT(A.HANDLE)
                                FROM SD_ORDEM A
                                WHERE A.SISTEMA IN ($unidadeNegocio)
                                  AND A.STATUS NOT IN (4, 5) -- Encerrado e Cancelado
                                  AND A.DEPARTAMENTO IN (4) -- Atendimento
                            ) QTDATUALATENDIMENTO,

                            ( SELECT SUM(A.SUPORTE)
                                FROM SD_POSICAODIARIA A
                                WHERE A.SISTEMA IN ($unidadeNegocio)
                                  AND A.DATA BETWEEN '$ontemInicio' AND '$ontemFim'
                            ) QTDINICIALATENDIMENTO,

                            ( SELECT COUNT(A.HANDLE) FROM SD_ORDEM A
                                WHERE A.SISTEMA IN ($unidadeNegocio)
                                  AND A.DATA BETWEEN '$hojeInicio' AND '$hojeFim'
                                  AND A.STATUS NOT IN (5) -- Cancelado
                            ) QTDNOVOSATENDIMENTO,

                            ( SELECT COUNT(A.HANDLE) FROM SD_ORDEM A
                                WHERE A.SISTEMA IN ($unidadeNegocio)
                                  AND A.STATUS NOT IN (5) -- Cancelado
                                  AND EXISTS (SELECT X1.HANDLE FROM SD_ORDEMENCAMINHAMENTO X1
                                                WHERE X1.ORDEM = A.HANDLE
                                                  AND X1.DATA BETWEEN '$hojeInicio' AND '$hojeFim'
                                                  AND X1.TIPO IN (18)
                                             )
                            ) QTDVOLTARAMATENDIMENTO,
                            
                            ( SELECT COUNT(A.HANDLE)
                                FROM SD_ORDEM A 
                                WHERE A.SISTEMA IN ($unidadeNegocio)
                                AND A.STATUS NOT IN (5) --Cancelado
                                AND EXISTS ( SELECT X1.HANDLE FROM SD_ORDEMENCAMINHAMENTO X1
                                                WHERE X1.ORDEM = A.HANDLE
                                                AND X1.TIPO IN ($liberadoAtendimento)
                                                AND X1.DATA BETWEEN '$hojeInicio' AND '$hojeFim')
                            ) QTDLIBERADOATENDIMENTO,

                            ( SELECT COUNT(A.HANDLE)
                                FROM SD_ORDEM A
                                WHERE A.SISTEMA IN ($unidadeNegocio)
                                  AND A.STATUS IN (5) --Cancelado
                                  AND EXISTS (SELECT X1.HANDLE FROM SD_ORDEMENCAMINHAMENTO X1
                                                WHERE X1.DATA BETWEEN '$hojeInicio' AND '$hojeFim'
                                                  AND X1.TIPO IN (7, 12, 29) -- Reenvio para Escala, Enviado para Atendimento Retrabalho, ou envio para escalasoft
                                                  AND X1.ORDEM = A.HANDLE)
                            ) QTDDEVOLUCAOATENDIMENTO,

                            ( SELECT COUNT(A.HANDLE)
                                FROM SD_ORDEM A
                                 WHERE A.SISTEMA IN ($unidadeNegocio)
                                  AND A.DATASLARESPOSTA <= '$agora'
                                  AND A.DEPARTAMENTO IN (4) -- Atendimento
                                  AND A.STATUS NOT IN (4, 5) --Encerrado e Cancelado
                            ) QTDSLAVENCIDO,

                            ( SELECT COUNT(A.HANDLE)
                                FROM SD_ORDEM A
                                 INNER JOIN MS_PRIORIDADE B ON A.SEVERIDADE = B.HANDLE
                                WHERE B.ORDEM = 0
                                  AND A.SISTEMA IN ($unidadeNegocio)
                                  AND A.DEPARTAMENTO IN (4) -- Atendimento
                                  AND EXISTS (SELECT X1.HANDLE FROM SD_ORDEMENCAMINHAMENTO X1 WHERE X1.TIPO IN (7, 12) -- Envio para a Escalasoft e Reenvio para Escalasoft
                                                 AND X1.ORDEM = A.HANDLE)
                                  AND A.STATUS NOT IN (4,5) --Encerrado e Cancelado
                            ) QTDCRITICOSATENDIMENTO,
                            
                            ( SELECT COUNT(A.HANDLE) VALOR
                                FROM SD_ORDEM A
                                WHERE A.SISTEMA IN ($unidadeNegocio)
                                  AND A.STATUS NOT IN (5) -- Cancelado
                                  AND EXISTS (SELECT * FROM SD_ORDEMENCAMINHAMENTO X1 WHERE X1.ORDEM = A.HANDLE AND X1.MOTIVOENCAMINHAMENTO IS NOT NULL)
                                  AND EXISTS (SELECT * FROM SD_ORDEMAPONTAMENTO X1 WHERE X1.ORDEM = A.HANDLE AND X1.DATA BETWEEN '$mesInicio' AND '$mesFim')
                            ) QTDRETRABALHO,

                            ( SELECT COUNT(A.HANDLE)
                                FROM SD_ORDEM A
                                WHERE A.SISTEMA IN ($unidadeNegocio)
                                AND A.STATUS NOT IN (5) -- Cancelado
                                AND A.DATA BETWEEN '$mesInicio' AND '$mesFim'
                            ) TOTALHDS
            FROM SD_ORDEM A";

$queryAtendimento = $connect->prepare($queryAtendimento);
$queryAtendimento->execute();
$contadoresAtendimento = $queryAtendimento->fetch(PDO::FETCH_ASSOC);


$queryDesenvolvimento = "SELECT ( SELECT COUNT(A.HANDLE)
                                    FROM SD_ORDEM A
                                    WHERE A.DEPARTAMENTO IN (1) --Desenvolvimento
                                      AND A.SISTEMA IN ($unidadeNegocio)
                                      AND A.TIPO NOT IN (2) -- Não pega melhoria
                                      AND A.STATUS NOT IN (4,5) --Encerrado e cancelado
                                ) QTDATUALDESENV,

                                ( SELECT SUM(A.DESENVOLVIMENTO)
                                FROM SD_POSICAODIARIA A
                                    WHERE A.SISTEMA IN ($unidadeNegocio)
                                      AND A.DATA BETWEEN '$ontemInicio' AND '$ontemFim'
                                ) QTDDESENVOLVIMENTO,

                                ( SELECT COUNT(A.HANDLE)
                                    FROM SD_ORDEM A
                                    WHERE A.SISTEMA IN ($unidadeNegocio)
                                      AND A.TIPO NOT IN (2) -- Não pega melhoria
                                      AND A.STATUS NOT IN (5) -- Cancelado
                                      AND EXISTS (SELECT X1.HANDLE FROM SD_ORDEMENCAMINHAMENTO X1
                                                    WHERE X1.EHDEPARTAMENTO = 'S'
                                                      AND X1.DEPARTAMENTO = 1
                                                      AND X1.ORDEM = A.HANDLE
                                                      AND X1.DATA BETWEEN '$hojeInicio' AND '$hojeFim')
                                ) QTDNOVOSDESENVOLVIMENTO,

                                ( SELECT COUNT(A.HANDLE)
                                    FROM SD_ORDEM A
                                    WHERE A.SISTEMA IN ($unidadeNegocio)
                                      AND A.TIPO IN (1) -- Só correção
                                      AND A.STATUS NOT IN (5) -- Cancelado
                                      AND EXISTS (SELECT X1.HANDLE FROM SD_ORDEMENCAMINHAMENTO X1
                                                    WHERE X1.EHDEPARTAMENTO = 'S'
                                                      AND X1.DEPARTAMENTO = 1
                                                      AND X1.ORDEM = A.HANDLE
                                                      AND X1.DATA BETWEEN '$hojeInicio' AND '$hojeFim') 
                                ) QTDCORRECAODESENVOLVIMENTO,

                                ( SELECT COUNT(A.HANDLE)
                                    FROM SD_ORDEM A	
                                    WHERE A.SISTEMA IN ($unidadeNegocio)
                                      AND A.TIPO NOT IN (2) -- Não pega melhoria
                                      AND A.STATUS NOT IN (5) -- Cancelado
                                      AND EXISTS (SELECT X1.HANDLE FROM SD_ORDEMENCAMINHAMENTO X1
                                                    WHERE X1.TIPO IN ($liberadoDesenvolvimento)
                                                      AND X1.ORDEM = A.HANDLE
                                                      AND X1.DATA BETWEEN '$hojeInicio' AND '$hojeFim')
                                ) QTDLIBERADODESENVOLVIMENTO,

                                ( SELECT COUNT(A.HANDLE)
                                    FROM SD_ORDEM A
                                    WHERE A.SISTEMA IN ($unidadeNegocio)
                                      AND A.DATASLA <= '$agora'
                                      AND A.TIPO NOT IN (2) -- Não pega melhoria
                                      AND A.DEPARTAMENTO IN (1) -- Desenvolvimento
                                      AND A.STATUS NOT IN (4, 5) -- Encerrado e Cancelado
                                ) QTDSLAVENCIDO,

                                ( SELECT COUNT(A.HANDLE)
                                    FROM SD_ORDEM A
                                    INNER JOIN MS_PRIORIDADE B ON A.SEVERIDADE = B.HANDLE
                                    WHERE B.ORDEM = 0
                                      AND A.DEPARTAMENTO IN (1) -- Desenvolvimento
                                      AND A.TIPO NOT IN (2) -- Não pega melhoria
                                      AND A.SISTEMA IN ($unidadeNegocio)
                                      AND A.STATUS NOT IN (4, 5) -- Encerrado e Cancelado
                                ) QTDCRITICOSDESENVOLVIMENTO,

                                (
                                    SELECT COUNT(A.HANDLE)
                                    FROM SD_ORDEM A
                                    WHERE A.TIPO IN (1) -- Correção
                                    AND A.SISTEMA IN ($unidadeNegocio)
                                    AND A.STATUS NOT IN (5) -- Cancelado
                                    AND A.DATA BETWEEN '$mesInicio' AND '$mesFim'
                                ) TOTALCORRECAO,

                                (
                                    SELECT COUNT(A.HANDLE)
                                    FROM SD_ORDEM A
                                    WHERE A.SISTEMA IN ($unidadeNegocio)
                                    AND A.STATUS NOT IN (5) -- Cancelado
                                    AND A.DATA BETWEEN '$mesInicio' AND '$mesFim'
                                ) TOTALHDS
                        FROM SD_ORDEM A";


$queryDesenvolvimento = $connect->prepare($queryDesenvolvimento);
$queryDesenvolvimento->execute();
$contadoresDesenvolvimento = $queryDesenvolvimento->fetch(PDO::FETCH_ASSOC);

echo json_encode([
    "atualAtendimento" => $contadoresAtendimento["QTDATUALATENDIMENTO"],
    "inicialAtendimento" => $contadoresAtendimento["QTDINICIALATENDIMENTO"],
    "novosAtendimento" => $contadoresAtendimento["QTDNOVOSATENDIMENTO"] + $contadoresAtendimento["QTDVOLTARAMATENDIMENTO"],
    "devolucaoAtendimento" => $contadoresAtendimento["QTDDEVOLUCAOATENDIMENTO"],
    "liberadoAtendimento" => $contadoresAtendimento["QTDLIBERADOATENDIMENTO"],
    "slavencidoAtendimento" => $contadoresAtendimento["QTDSLAVENCIDO"],
    "criticoAtendimento" => $contadoresAtendimento["QTDCRITICOSATENDIMENTO"],
    "porcentoretrabalhoAtendimento" => ($contadoresAtendimento["QTDRETRABALHO"] / ($contadoresAtendimento["TOTALHDS"] == 0 ? 1 : $contadoresAtendimento["TOTALHDS"])) * 100,
    // Desenv
    "atualDesenvolvimento" => $contadoresDesenvolvimento["QTDATUALDESENV"],
    "inicialDesenvolvimento" => $contadoresDesenvolvimento["QTDDESENVOLVIMENTO"],
    "novosDesenvolvimento" => $contadoresDesenvolvimento["QTDNOVOSDESENVOLVIMENTO"],
    "correcaoDesenvolvimento" => $contadoresDesenvolvimento["QTDCORRECAODESENVOLVIMENTO"],
    "liberadoDesenvolvimento" => $contadoresDesenvolvimento["QTDLIBERADODESENVOLVIMENTO"],
    "slavencidoDesenvolvimento" => $contadoresDesenvolvimento["QTDSLAVENCIDO"],
    "criticoDesenvolvimento" => $contadoresDesenvolvimento["QTDCRITICOSDESENVOLVIMENTO"],
    "porcentoretrabalhoDesenvolvimento" => ($contadoresDesenvolvimento["TOTALCORRECAO"] / ($contadoresDesenvolvimento["TOTALHDS"] == 0 ? 1 : $contadoresDesenvolvimento["TOTALHDS"])) * 100
]);

//-- Pega a Unidade de Negocio de pessoa logada, para pegar os outros usuários da mesma unidade.
function getUnidadeNegocioPessoaLogada($connect)
{
    $query = "SELECT C.HANDLE,
                     C.NOME
                 FROM MS_USUARIO A
                INNER JOIN MS_PESSOA B ON A.PESSOA = B.HANDLE
                INNER JOIN CT_UNIDADENEGOCIO C ON B.PESSOAUNIDADENEGOCIO = C.HANDLE
                 WHERE A.HANDLE = " . $_SESSION["handleUsuario"];

    $query = $connect->prepare($query);

    $query->execute();

    $retorno = $query->fetch(PDO::FETCH_ASSOC);

    return $retorno;
}