<?php

include_once('../tecnologia/Sistema.php');

$webservice = 'rastreamento';
include_once('../tecnologia/WebService.php');

$connect = Sistema::getConexao();
$metodo = Sistema::getPost('metodo');
$retorno = array();

switch ($metodo) {

    case 'ExecutarEtapaPedido': {
            try {
                Sistema::verificarWebservice($WebServiceOffline);

                $parametroExecutar = array("etapaPedido" => Sistema::getPost('etapaPedido'), "observacao" => Sistema::getPost('observacao'));

                $executarEtapaPedido = $clientSoap->ExecutarPedidoEtapa(array("executarPedidoEtapa" => $parametroExecutar));

                Sistema::verificarSoapFault($executarEtapaPedido);

                $resultExecutarEtapaPedido = $executarEtapaPedido->ExecutarPedidoEtapaResult;

                Sistema::setRetornoWebService($resultExecutarEtapaPedido, $retorno);
            } catch (SoapFault $erro) {
                Sistema::setSoapFault($erro, $retorno);
            } catch (Exception $erro) {
                Sistema::setException($erro, $retorno);
            }

            break;
        }
}

Sistema::echoToJson($retorno);
