<?php

#Alterar Host e porta para conexão ao WebService
$host = "APL01.OLLOGISTICA.COM.BR";
$porta = 8080;
#######

if (isset($_GET['getWS'])) {
    $arrWS = array();
    $arrWS = ["host" => $host, "porta" => $porta];
    echo json_encode($arrWS);
    exit();
}

$location = "http://" . $host . ":" . $porta . "/webservice/" . $webservice . ".asmx?wsdl";
$uri = "http://escalasoft.com.br/";

function endereco_existe($url) {
    @$h = get_headers($url);
    return $h;
}

$verificaStatusWsdl = endereco_existe($location);

if ($verificaStatusWsdl) {

    $usuario = $_SESSION['usuario'];
    $senha = $_SESSION['senha'];
    $senhaNaoCriptografada = $_SESSION['senhaNaoCriptografada'];

    ini_set('default_socket_timeout', 99000);
    ini_set('max_input_time', -1);
    ini_set('soap.wsdl_cache_enabled', 0);

    $opcoes = array(
        'trace' => 1,
        'exceptions' => 0,
        'cache_wsdl' => WSDL_CACHE_NONE,
        'keep_alive' => true,
        'soap_version' => SOAP_1_1,
        'style' => SOAP_DOCUMENT,
        'use' => SOAP_LITERAL,
        'encoding' => 'UTF-8',
        'location' => $location,
        'uri' => $uri,
        'proxy_host' => $host,
        'proxy_port' => $porta,
        'authentication' => SOAP_AUTHENTICATION_BASIC
    );

    $clientSoap = new SoapClient($location, $opcoes);

    $auth = array('Username' => $usuario, 'Password' => $senhaNaoCriptografada);
    $header = new SoapHeader($uri, "Authentication", $auth, false);
    $clientSoap->__setSoapHeaders($header);

    $WebServiceOffline = false;
} else {
    $WebServiceOffline = true;
}