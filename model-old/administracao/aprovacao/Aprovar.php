<?php

include_once('../../../controller/tecnologia/Sistema.php');
include_once('../../../controller/tecnologia/WS.php');

if (!isset($_SESSION['usuario']) and !isset($_SESSION['senha'])) {
    echo Sistema::retornoJson(500, "Erro ao aprovar: favor atualizar a página antes de continuar");
} else {
    $aprovacoes = $_POST["APROVACAO"];
    $usuario = $_SESSION['handleUsuario'];

    $mensagens = [];

    foreach ($aprovacoes as $aprovacao) {
        WebService::setupCURL("administracao/aprovacao/aprovar", ["APROVACAO" => $aprovacao, "USUARIO" => $usuario]);
        WebService::execute();

        $body = WebService::getBody();

        if (strlen($body) > 0) {
            $mensagens[] = $body;
        }
    }

    if (count($mensagens) == 0) {
        echo Sistema::retornoJson(200);
    } else {
        $mensagens = join("; ", $mensagens);

        echo Sistema::retornoJson(500, $mensagens);
    }
}
