<?php
include_once('../../../controller/tecnologia/Sistema.php');

$connect = Sistema::getConexao();

date_default_timezone_set('America/Sao_Paulo');

$dados = getListaUsuarios($connect);

echo json_encode([
    "draw" => $_GET["draw"],
    "recordsTotal" => count($dados),
    "recordsFiltered" => count($dados),
    "data" => $dados
]);

//-- Pega a lista de usuários com base na Unidade de Negocio do usuário logado.
function getListaUsuarios($connect)
{
    $unidadeNegocio = getUnidadeNegocioPessoaLogada($connect);

    $query = "SELECT SUBSTRING(C.NOME, 1, 1) ATIVIDADE,
                     A.LOGIN RECURSO,
                     A.HANDLE HANDLEUSUARIO
               FROM MS_USUARIO A
              INNER JOIN MS_PESSOA B ON A.PESSOA = B.HANDLE
              INNER JOIN MS_CATEGORIAATIVIDADE C ON B.CATEGORIAATIVIDADE = C.HANDLE
               WHERE B.DATADEMISSAO IS NULL
                AND A.STATUS IN (4)
                AND B.PESSOAUNIDADENEGOCIO = '" . $unidadeNegocio['HANDLE'] . "'
                AND A.HANDLE <> '" . $_SESSION['handleUsuario'] . "'
               ORDER BY C.NOME";

    $query = $connect->prepare($query);

    $query->execute();

    $usuarios = [];

    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $ordem = getDadosOrdem($row["HANDLEUSUARIO"], $connect);
        $valores = getValoresUsuario($row, $unidadeNegocio["NOME"], $connect);
        $horasapontadas = getTotalHoras($ordem["SD"], $row["HANDLEUSUARIO"], $connect);
        $semHD = getTotalHorasSemHD($row["HANDLEUSUARIO"], $connect);
        $row = array_merge($row, $ordem, $valores, $horasapontadas, $semHD);

        $usuarios[] = $row;
    }

    $comCritico = pegaUsuarioComCritico(strtolower($unidadeNegocio["NOME"]), $usuarios, $connect);
    $usuarios = array_merge($usuarios, $comCritico);

    return $usuarios;
}

//-- Essa função irá pegar todos os dados dos SDs.
function getDadosOrdem($handle, $connect)
{
    $query = "SELECT C.APELIDO CLIENTE,
                     B.HANDLE SD,
                     B.DATASLARESPOSTA SLA,
                     D.ORDEM SEVERIDADE,
                     B.DATA DATAABERTURA,
                     A.CANAL,
                     (SELECT MAX(X1.DATA) FROM SD_ORDEMENCAMINHAMENTO X1 WHERE X1.ORDEM = B.HANDLE AND (X1.EHDEPARTAMENTO = 'S' OR X1.EHRECURSO = 'S')) DATAULTIMOENCAMINHAMENTO
               FROM SD_ORDEMAPONTAMENTO A
              INNER JOIN SD_ORDEM B ON A.ORDEM = B.HANDLE
              INNER JOIN MS_PESSOA C ON B.CLIENTE = C.HANDLE
              INNER JOIN MS_PRIORIDADE D ON B.SEVERIDADE = D.HANDLE
               WHERE A.STATUS IN (2, 3) AND A.RECURSO = " . $handle;

    $query = $connect->prepare($query);

    $query->execute();

    $dados = $query->fetch(PDO::FETCH_ASSOC);

    if (!$dados) {
        $dados = [
            'CLIENTE' => null,
            'SD' => null,
            'SLA' => null,
            'SEVERIDADE' => null
        ];
    } else {
        $dados["SLA"] = date('d/m/Y H:i', strtotime($dados["SLA"]));
    }

    return $dados;
}

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

function getValoresUsuario($usuario, $unidadeNegocio, $connect)
{
    $unidadeNegocio = strtolower($unidadeNegocio);

    $tipoOk = null;
    $tipoDevolvido = null;

    $agora = date("Y-m-d H:i:s");

    $hojeInicio = date("Y-m-d 00:00:00");
    $hojeFim = date("Y-m-d 23:59:59");

    $ontemInicio = date("Y-m-d 00:00:00", strtotime('-1 day', time()));
    $ontemFim = date("Y-m-d 23:59:59", strtotime('-1 day', time()));
    $handleUsuario = $usuario["HANDLEUSUARIO"];

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
//            2,  //TEC
//            6,  //CRM
//            7,  //ESC
//            9,  //PRO
//            10  // RH
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

    if ($usuario["ATIVIDADE"] === 'A') {
        $tipoOk = implode(",", [
            8,  // Devolução com Solução do Atendimento
            16, // Encaminhar para o Desenvolvimento
        ]);

        $tipoDevolvido = implode(",", [
            5,  // Devolução por falta de informação
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

        $sqlRetra = "SELECT COUNT(A.HANDLE)
                        FROM SD_ORDEM A
                        WHERE A.SISTEMA IN ($unidadeNegocio)
                        AND EXISTS (SELECT * FROM SD_ORDEMENCAMINHAMENTO X1 WHERE X1.ORDEM = A.HANDLE AND X1.MOTIVOENCAMINHAMENTO IS NOT NULL)
                        AND EXISTS (SELECT * FROM SD_ORDEMAPONTAMENTO X1 WHERE X1.ORDEM = A.HANDLE AND X1.RECURSO = $handleUsuario AND X1.DATA BETWEEN '$hojeInicio' AND '$hojeFim')";

    } elseif ($usuario["ATIVIDADE"] === 'P') {
        $tipoOk = implode(",", [
            17, // Encaminhar para qualidade (nova versão)
            28, // Encaminhar para qualidade (gerar versão)
        ]);

        $tipoDevolvido = implode(",", [
            29,  // Encaminhar para atendimento (devolução/retrabalho),
            18,  // Encaminhar para atendimento (retornar ao cliente)
        ]);

        $sqlRetra = "SELECT COUNT(A.HANDLE)
                        FROM SD_ORDEM A
                        WHERE A.SISTEMA IN ($unidadeNegocio)
                        AND A.TIPO IN (1)
                        AND EXISTS (SELECT * FROM SD_ORDEMAPONTAMENTO X1 WHERE X1.ORDEM = A.HANDLE AND X1.RECURSO = $handleUsuario AND X1.DATA BETWEEN '$hojeInicio' AND '$hojeFim')";
    } elseif ($usuario["ATIVIDADE"] === 'L') {
        $tipoOk = implode(",", [
            8,  // Devolução com Solução do Atendimento
            16, // Encaminhar para o Desenvolvimento
            17, // Encaminhar para qualidade (nova versão)
            28, // Encaminhar para qualidade (gerar versão)
        ]);

        $tipoDevolvido = implode(",", [
            5,  // Devolução por falta de informação
            19, // Encaminhar para consultoria (orçar)
            20, // Encaminhar para serviço técnico (orçar)
            21, // Devolução com solução do desenvolvimento
            22, // Devolução com orçamento do desenvolvimento
            26, // Encaminhar para desenvolvimento (aprovação orçamento)
            27, // Encaminhar para desenvolvimento (só encaminhado)
            29, // Encaminhar para atendimento (devolução/retrabalho)
            36, // Encaminhar para desenvolvimento (rejeição orçamento)
            38, // Encaminhar para consultoria (aprovação orçamento)
            39, // Encaminhar para consultoria (rejeição orçamento)
            40, // Encaminhar para serviço técnico (aprovação orçamento)
            41, // Encaminhar para serviço técnico (rejeição orçamento)
            18,  // Encaminhar para atendimento (retornar ao cliente)
        ]);

        $sqlRetra = "SELECT COUNT(A.HANDLE)
                        FROM SD_ORDEM A
                        WHERE A.SISTEMA IN ($unidadeNegocio)
                            AND EXISTS (SELECT * FROM SD_ORDEMENCAMINHAMENTO X1 WHERE X1.ORDEM = A.HANDLE AND X1.MOTIVOENCAMINHAMENTO IS NOT NULL)
                            AND EXISTS (SELECT * FROM SD_ORDEMAPONTAMENTO X1 WHERE X1.ORDEM = A.HANDLE AND X1.RECURSO = $handleUsuario AND X1.DATA BETWEEN '$hojeInicio' AND '$hojeFim')";
    } else {
        $tipoOk = 0;
        $tipoDevolvido = 0;
        $sqlRetra = "SELECT 0 FROM MD_SISTEMA";
    }

    $query = "SELECT (SELECT COUNT(A.HANDLE)
                FROM SD_ORDEM A
                WHERE A.SISTEMA IN ($unidadeNegocio)
                    AND EXISTS ( SELECT X1.HANDLE FROM SD_ORDEMENCAMINHAMENTO X1
                                    WHERE X1.ORDEM = A.HANDLE
                                      AND X1.USUARIO = $handleUsuario
                                      AND X1.TIPO IN ($tipoOk) 
                                      AND X1.STATUS IN (2)
                                      AND X1.MOTIVOENCAMINHAMENTO IS NULL
                                      AND X1.DATA BETWEEN '$hojeInicio' AND '$hojeFim')
                ) OK,
                (SELECT COUNT(A.HANDLE)
                FROM SD_ORDEM A
                WHERE A.SISTEMA IN ($unidadeNegocio)
                    AND EXISTS ( SELECT X1.HANDLE FROM SD_ORDEMENCAMINHAMENTO X1
                                    WHERE X1.ORDEM = A.HANDLE
                                      AND X1.USUARIO = $handleUsuario
                                      AND X1.TIPO IN ($tipoDevolvido)
                                      AND X1.STATUS IN (2)
                                      AND X1.MOTIVOENCAMINHAMENTO IS NULL
                                      AND X1.DATA BETWEEN '$hojeInicio' AND '$hojeFim')
                ) DEV,
                ($sqlRetra) RETRA
                FROM MD_SISTEMA";

    if ($query) {
        $query = $connect->prepare($query);

        $query->execute();

        $dados = $query->fetch(PDO::FETCH_ASSOC);

        if (!$dados) {
            $dados = [
                "OK" => null,
                "TOTALAPONTA" => null,
                "HRS" => null,
                "RETRA" => null,
                "DEV" => null,
                "TOTAL" => null
            ];
        } else {
            if ($dados["OK"] == 0) {
                $dados["OK"] = null;
            }
            if ($dados["DEV"] == 0) {
                $dados["DEV"] = null;
            }
            if ($dados["RETRA"] == 0) {
                $dados["RETRA"] = null;
            }
            $dados["TOTALAPONTA"] = null;
            $dados["HRS"] = null;
            $dados["TOTAL"] = null;
        }
    }

    return $dados;
}

function pegaUsuarioComCritico($unidadeNegocio, $usuarios, $connect)
{
    $hdsAponta = [0];

    foreach ($usuarios as $usuario) {
        if ($usuario["SD"]) {
            $hdsAponta[] = $usuario["SD"];
        }
    }

    $hdsAponta = implode(",", $hdsAponta);

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
            1,  //ERP
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

    $query = "SELECT SUBSTRING(G.NOME, 1, 1) ATIVIDADE,
                               C.LOGIN RECURSO,
                               C.HANDLE HANDLEUSUARIO,
                               null OK,
                               0 TOTALAPONTA,
                               null RETRA,
                               null HRS,
                               null DEV,
                               ( SELECT SUM(DATEDIFF(minute, CONVERT(VARCHAR(5), X1.INICIO, 108), CONVERT(VARCHAR(5), X1.TERMINO, 108))) FROM SD_ORDEMAPONTAMENTO X1 WHERE X1.ORDEM = A.HANDLE
                               ) TOTALAPONTA,
                               null TOTAL,
                               F.APELIDO CLIENTE,
                               A.HANDLE SD,
                               A.DATASLARESPOSTA SLA,
                               B.ORDEM SEVERIDADE,
                               A.DATA DATAABERTURA
                        FROM SD_ORDEM A
                        INNER JOIN MS_PRIORIDADE B ON A.SEVERIDADE = B.HANDLE
                        INNER JOIN MS_USUARIO C ON A.RECURSO = C.HANDLE
                        INNER JOIN MS_PESSOA E ON C.PESSOA = E.HANDLE
                        INNER JOIN MS_PESSOA F ON A.CLIENTE = F.HANDLE
                        LEFT JOIN MS_CATEGORIAATIVIDADE G ON E.CATEGORIAATIVIDADE = G.HANDLE
                        WHERE A.SISTEMA IN ($unidadeNegocio)
                          AND A.HANDLE NOT IN ($hdsAponta)
                          AND B.ORDEM = 0
                          AND A.RECURSO NOT IN (12, 13, 26)"; //-- Liberado, Melhoria

    $query = $connect->prepare($query);

    $query->execute();

    $retorno = [];
    $retorno[] = ["ATIVIDADE" => null,
        "CLIENTE" => null,
        "DATAABERTURA" => null,
        "DEV" => null,
        "HANDLEUSUARIO" => null,
        "TOTALAPONTA" => null,
        "OK" => null,
        "RECURSO" => null,
        "RETRA" => null,
        "SD" => null,
        "SEVERIDADE" => null,
        "HRS" => null,
        "SLA" => null,
        "TOTAL" => null];

    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $row["SLA"] = date('d/m/Y H:i', strtotime($row["SLA"]));
        $row["TOTALAPONTA"] = floor($row["TOTALAPONTA"] / 60) . "," . $row["TOTALAPONTA"] % 60;
        $retorno[] = $row;
    }

    return $retorno;
}

function getTotalHoras($sd, $usuario, $connect)
{
    $hojeInicio = date("Y-m-d 00:00:00");
    $hojeFim = date("Y-m-d 23:59:59");

    $query = "SELECT CONVERT(VARCHAR(5), A.INICIO, 108) INICIO,
                        CONVERT(VARCHAR(5), A.TERMINO, 108) TERMINO
                FROM SD_ORDEMAPONTAMENTO A
                WHERE A.RECURSO = $usuario
                    AND A.DATA BETWEEN '$hojeInicio' AND '$hojeFim'
                    AND A.STATUS NOT IN (5)";

    $query = $connect->prepare($query);

    $query->execute();

    $totalHoras = 0;

    while ($dados = $query->fetch(PDO::FETCH_ASSOC)) {
        $dados["INICIO"] = date('H:i', strtotime($dados["INICIO"]));

        if (!$dados["TERMINO"]) {
            $dados["TERMINO"] = date('H:i');
        }

        $dados["TERMINO"] = date('H:i', strtotime($dados["TERMINO"]));
        $totalHoras += strtotime($dados["TERMINO"]) - strtotime($dados["INICIO"]); //Retorna em Segundos
    }

    return ["TOTALAPONTA" => $totalHoras];
}

function getTotalHorasSemHD($usuario, $connect)
{
    $hojeInicio = date("Y-m-d 00:00:00");
    $hojeFim = date("Y-m-d 23:59:59");
    $comecoDia = date('Y-m-d 08:00:00');
    $agora = date('Y-m-d H:i:s');
    $horas = 0;

    $query = "SELECT TOP 1
                     CONVERT(VARCHAR(5), A.INICIO, 108) INICIO,
                     CONVERT(VARCHAR(5), A.TERMINO, 108) TERMINO
                FROM SD_ORDEMAPONTAMENTO A
                WHERE A.RECURSO = $usuario
                  AND A.DATA BETWEEN '$hojeInicio' AND '$hojeFim'
                  AND A.STATUS NOT IN (5)
				ORDER BY A.HANDLE DESC";

    $query = $connect->prepare($query);

    $query->execute();

    $dados = $query->fetch(PDO::FETCH_ASSOC);

    if ($dados) {
        if ($dados["TERMINO"]) {
            $dados["TERMINO"] = date('H:i', strtotime($dados["TERMINO"]));
            $horas = strtotime($agora) - strtotime($dados["TERMINO"]);
        }
    } else {
        $horas = strtotime($agora) - strtotime($comecoDia);
    }

    return ["HORASSEMHD" => $horas];
}