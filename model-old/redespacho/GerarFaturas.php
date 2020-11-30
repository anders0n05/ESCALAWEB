<?php
include_once('../../controller/tecnologia/Sistema.php');
include_once('../../controller/tecnologia/WS.php');

date_default_timezone_set('America/Sao_Paulo');

$connect = Sistema::getConexao();

$filial = Sistema::getPost('FILIAL');
$data = Sistema::getPost('DATA');
$dataemissao = Sistema::getPost('DATAEMISSAO');
$tipodocumento = Sistema::getPost('TIPODOCUMENTO');
$chaveeletronica = Sistema::getPost('CHAVEDOCUMENTOELETRONICO');
$numero = Sistema::getPost('NUMERO');
$serie = Sistema::getPost('SERIE');
$documento = explode(",", Sistema::getPost('HANDLE'));
$descricao = Sistema::getPost('DESCRICAO');
$redespachador = Sistema::getDadosPessoaUsuarioLogado($connect);

$anexos = [];

$ocorrencias = [];
for($i = 0; $i < count($documento); $i++) {
    $ocorrencias[] = ["handle" => $documento[$i]];    
}

$queryFilial = "SELECT TOP 1 A.FILIAL,
                           A.TRANSPORTADOR
                  FROM OP_AGRUPAMENTO A 				 
                 WHERE A.HANDLE IN (".Sistema::getPost('HANDLE').")";

$queryFilial = $connect->prepare($queryFilial);
$queryFilial->execute();

$filial = $queryFilial->fetch(PDO::FETCH_ASSOC);

if (!empty($_FILES)) {
    foreach ($_FILES['file']['tmp_name'] as $key => $value) {
        if ($_FILES['file']['name'][$key] !== 'blob') {
            $tempFile = $_FILES['file']['tmp_name'][$key];
            $base64 = Sistema::fileToBase64(file_get_contents($tempFile));
            $anexos[] = ["nome" => $_FILES['file']['name'][$key], "arquivo" => $base64, "data" => date('d/m/Y H:i:s')];
        }
    }
}

WebService::setupCURL("redespacho/criar/criarrecebimento", ["data" => $data,
                                                            "dataemissao" => $dataemissao,
                                                            "pessoa" => $filial["TRANSPORTADOR"],
                                                            "filial" => $filial["FILIAL"],
                                                            "tipodocumento" => $tipodocumento,
                                                            "chaveeletronica"=> $chaveeletronica,
                                                            "numero" => $numero,                            
                                                            "serie" => $serie,
                                                            "observacao" => $descricao,
                                                            "anexo" => $anexos,                                                            
                                                            "ocorrencia" => $ocorrencias]);

WebService::execute();

$body = WebService::getBody();

$dados = json_decode($body);

if (isset($dados->CHAVE)) {
    echo $dados->CHAVE;
} else {
    echo Sistema::retornoJson(500, $body);
}