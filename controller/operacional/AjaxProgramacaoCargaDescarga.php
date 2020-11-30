<?php

include_once('../tecnologia/Sistema.php');

$webservice = 'armazem';
include_once('../tecnologia/WebService.php');

$connect = Sistema::getConexao();
$metodo = Sistema::getPost('metodo');
$retorno = array();

switch ($metodo) {
    case 'ManterOcorrencia': {
            try {
                $retorno['handleOcorrencia'] = Sistema::getPost('handleOcorrencia');

                $carregamento = Sistema::getPost('handleCarregamento');
                $tipoOcorrenciaHandle = Sistema::getPost('tipoOcorrenciaHandle');
                $progDocaHandle = Sistema::getPost('progDocaHandle');
                $docaHandle = Sistema::getPost('docaHandle');
                $veiculo = Sistema::getPost('veiculo');
                $acoplado = Sistema::getPost('acoplado');
                $conteinerHandle = Sistema::getPost('conteinerHandle');
                $motorista = Sistema::getPost('motorista');
                $obs = Sistema::getPost('obs');
                $ufVeiculoHandle = Sistema::getPost('ufVeiculoHandle');
                $propriedadeVeiculoHandle = Sistema::getPost('propriedadeVeiculoHandle');
                $documentoMotorista = Sistema::getPost('documentoMotorista');
                $tipoVeiculoHandle = Sistema::getPost('tipoVeiculoHandle');

                $queryTransportadora = $connect->prepare("SELECT TRANSPORTADORA FROM AM_CARREGAMENTO WHERE HANDLE = '" . $carregamento . "'");
                $queryTransportadora->execute();
                $rowTransportadora = $queryTransportadora->fetch(PDO::FETCH_ASSOC);
                $transportadora = Sistema::formataInt($rowTransportadora['TRANSPORTADORA']);

                $parametroManter = array(
                    'carregamento' => $carregamento,
                    'carregamentoOcorrencia' => $retorno['handleOcorrencia'],
                    'conteiner' => $conteinerHandle,
                    'data' => date('Y-m-d\TH:i:s'),
                    'doca' => $docaHandle,
                    'motorista' => $motorista,
                    'motoristaDocumento' => $documentoMotorista,
                    'observacao' => $obs,
                    'programacaoDoca' => $progDocaHandle,
                    'propriedadeVeiculo' => $propriedadeVeiculoHandle,
                    'reboque' => $acoplado,
                    'tipo' => $tipoOcorrenciaHandle,
                    'tipoVeiculo' => $tipoVeiculoHandle,
                    'vagao' => null,
                    'veiculo' => $veiculo,
                    'veiculoUF' => $ufVeiculoHandle,
                    'transportadora' => $transportadora);

                Sistema::verificarWebservice($WebServiceOffline);

                if (empty($retorno['handleOcorrencia'])) {
                    $manterOcorrencia = $clientSoap->InserirCarregamentoOcorrencia(array("inserirCarregamentoOcorrencia" => $parametroManter));

                    Sistema::verificarSoapFault($manterOcorrencia);

                    $resultManterOcorrencia = $manterOcorrencia->InserirCarregamentoOcorrenciaResult;

                    Sistema::setRetornoWebService($resultManterOcorrencia, $retorno);

                    $retorno['handleOcorrencia'] = $retorno['protocolo'];
                } else {
                    $manterOcorrencia = $clientSoap->AlterarCarregamentoOcorrencia(array("alterarCarregamentoOcorrencia" => $parametroManter));

                    Sistema::verificarSoapFault($manterOcorrencia);

                    $resultManterOcorrencia = $manterOcorrencia->AlterarCarregamentoOcorrenciaResult;

                    Sistema::setRetornoWebService($resultManterOcorrencia, $retorno);
                }
            } catch (SoapFault $erro) {
                Sistema::setSoapFault($erro, $retorno);
            } catch (Exception $erro) {
                Sistema::setException($erro, $retorno);
            }

            break;
        }

    case 'LiberarOcorrencia': {
            try {
                Sistema::verificarWebservice($WebServiceOffline);

                $parametroLiberar = array("carregamentoOcorrencia" => Sistema::getPost('handleOcorrencia'));

                $liberarOcorrencia = $clientSoap->LiberarCarregamentoOcorrencia(array("liberarCarregamentoOcorrencia" => $parametroLiberar));

                Sistema::verificarSoapFault($liberarOcorrencia);

                $resultLiberarOcorrencia = $liberarOcorrencia->LiberarCarregamentoOcorrenciaResult;

                Sistema::setRetornoWebService($resultLiberarOcorrencia, $retorno);
            } catch (SoapFault $erro) {
                Sistema::setSoapFault($erro, $retorno);
            } catch (Exception $erro) {
                Sistema::setException($erro, $retorno);
            }

            break;
        }

    case 'CarregarOcorrencia': {
            try {
                $carregamento = Sistema::getPost('handleCarregamento');

                $queryCarregamento = "SELECT A.NUMERO,
                                             A.PREVISAOENTREGA,
       
                                             B.NOME TIPO,
                                             A.TIPO TIPOHANDLE,
                                             B.ACAO ACAOHANDLE,
 
                                             CONVERT(VARCHAR(10), C.PREVISAO, 103) + ' ' + CONVERT(VARCHAR(10), C.PREVISAO, 108) + ' - ' + D.NOME PROGRAMACAODOCA,
                                             A.PROGRAMACAODOCA PROGRAMACAODOCAHANDLE,
                                             C.DOCA DOCAHANDLE,
 
                                             E.NOME TIPOVEICULO,
                                             A.TIPOVEICULO TIPOVEICULOHANDLE,
 
                                             A.PLACA VEICULO,
 
                                             F.SIGLA VEICULOUF,
                                             A.UFPLACA VEICULOUFHANDLE,
 
                                             G.NOME PROPRIEDADEVEICULO,
                                             A.PROPRIEDADEVEICULO PROPRIEDADEVEICULOHANDLE,
 
                                             A.CARRETA REBOQUE,
 
                                             H.CODIGO CONTEINER,
                                             A.CONTEINER CONTEINERHANDLE,
 
                                             A.MOTORISTA,
                                             A.DOCUMENTO MOTORISTADOCUMENTO,
       
                                             (SELECT COUNT(X.HANDLE)
                                                FROM AM_CARREGAMENTOOCORRENCIA X (NOLOCK)
                                               WHERE X.CARREGAMENTO = A.HANDLE
                                                 AND X.STATUS <> 10
                                                 AND X.ACAO IN (2, 5)) QUANTIDADEOCORRENCIA

                                        FROM AM_CARREGAMENTO A (NOLOCK)
                                        LEFT JOIN AM_TIPOCARREGAMENTOOCORRENCIA B (NOLOCK) ON B.HANDLE = A.TIPO
                                        LEFT JOIN AM_PROGRAMACAODOCA C (NOLOCK) ON C.HANDLE = A.PROGRAMACAODOCA
                                        LEFT JOIN AM_DOCA D (NOLOCK) ON D.HANDLE = C.DOCA
                                        LEFT JOIN MF_TIPOVEICULO E (NOLOCK) ON E.HANDLE = A.TIPOVEICULO
                                        LEFT JOIN MS_ESTADO F (NOLOCK) ON F.HANDLE = A.UFPLACA
                                        LEFT JOIN MF_PROPRIEDADEVEICULO G (NOLOCK) ON G.HANDLE = A.PROPRIEDADEVEICULO
                                        LEFT JOIN PA_CONTEINER H (NOLOCK) ON H.HANDLE = A.CONTEINER
                                       WHERE A.HANDLE = $carregamento";

                $queryCarregamentoPrepare = $connect->prepare($queryCarregamento);
                $queryCarregamentoPrepare->execute();

                $rowCarregamento = $queryCarregamentoPrepare->fetch(PDO::FETCH_ASSOC);

                $quantidadeOcorrencia = $rowCarregamento['QUANTIDADEOCORRENCIA'];
                
                $retorno['NUMERO'] = $rowCarregamento['NUMERO'];
                $retorno['PREVISAOENTREGA'] = Sistema::formataDataHoraMascaraTimeZone($rowCarregamento['PREVISAOENTREGA']);
                                
                $queryCarregamentoOcorrencia = "SELECT A.HANDLE,

                                                       B.NOME TIPO,
                                                       A.TIPO TIPOHANDLE,
                                                       A.ACAO ACAOHANDLE,

                                                       CONVERT(VARCHAR(10), C.PREVISAO, 103) + ' ' + CONVERT(VARCHAR(10), C.PREVISAO, 108) + ' - ' + D.NOME PROGRAMACAODOCA,
                                                       A.PROGRAMACAODOCA PROGRAMACAODOCAHANDLE,
                                                       A.DOCA DOCAHANDLE,

                                                       E.NOME TIPOVEICULO,
                                                       A.TIPOVEICULO TIPOVEICULOHANDLE,
                                                       
                                                       A.VEICULO,

                                                       F.SIGLA VEICULOUF,
                                                       A.VEICULOUF VEICULOUFHANDLE,

                                                       G.NOME PROPRIEDADEVEICULO,
                                                       A.PROPRIEDADEVEICULO PROPRIEDADEVEICULOHANDLE,

                                                       A.REBOQUE,

                                                       H.CODIGO CONTEINER,
                                                       A.CONTEINER CONTEINERHANDLE,

                                                       A.MOTORISTA,
                                                       A.MOTORISTADOCUMENTO,
                                                       A.OBSERVACAO

                                                  FROM AM_CARREGAMENTOOCORRENCIA A (NOLOCK)
                                                  LEFT JOIN AM_TIPOCARREGAMENTOOCORRENCIA B (NOLOCK) ON B.HANDLE = A.TIPO
                                                  LEFT JOIN AM_PROGRAMACAODOCA C (NOLOCK) ON C.HANDLE = A.PROGRAMACAODOCA
                                                  LEFT JOIN AM_DOCA D (NOLOCK) ON D.HANDLE = C.DOCA
                                                  LEFT JOIN MF_TIPOVEICULO E (NOLOCK) ON E.HANDLE = A.TIPOVEICULO
                                                  LEFT JOIN MS_ESTADO F (NOLOCK) ON F.HANDLE = A.VEICULOUF
                                                  LEFT JOIN MF_PROPRIEDADEVEICULO G (NOLOCK) ON G.HANDLE = A.PROPRIEDADEVEICULO
                                                  LEFT JOIN PA_CONTEINER H (NOLOCK) ON H.HANDLE = A.CONTEINER
                                                  
                                                 WHERE A.CARREGAMENTO = $carregamento
                                                   AND A.STATUS NOT IN (3, 9, 10)
                                                   
                                                   AND NOT EXISTS(SELECT X.HANDLE
                                                                    FROM AM_CARREGAMENTOOCORRENCIA X (NOLOCK)
                                                                   WHERE A.CARREGAMENTO = A.CARREGAMENTO
                                                                     AND X.STATUS NOT IN (3, 9, 10)
                                                                     AND X.DATA > A.DATA)";

                $queryCarregamentoOcorrenciaPrepare = $connect->prepare($queryCarregamentoOcorrencia);
                $queryCarregamentoOcorrenciaPrepare->execute();

                $rowCarregamentoOcorrencia = $queryCarregamentoOcorrenciaPrepare->fetch(PDO::FETCH_ASSOC);

                $retorno['HANDLE'] = Sistema::formataInt($rowCarregamentoOcorrencia['HANDLE']);
                
                if (empty($retorno['HANDLE']) && !empty($quantidadeOcorrencia)) {
                    $rowRegistro = $rowCarregamento;
                } else {
                    $rowRegistro = $rowCarregamentoOcorrencia;
                    
                    $retorno['OBSERVACAO'] = $rowCarregamentoOcorrencia['OBSERVACAO'];
                }
                
                $retorno['TIPO'] = $rowRegistro['TIPO'];
                $retorno['TIPOHANDLE'] = $rowRegistro['TIPOHANDLE'];
                $retorno['ACAOHANDLE'] = $rowRegistro['ACAOHANDLE'];
                $retorno['PROGRAMACAODOCA'] = $rowRegistro['PROGRAMACAODOCA'];
                $retorno['PROGRAMACAODOCAHANDLE'] = $rowRegistro['PROGRAMACAODOCAHANDLE'];
                $retorno['DOCAHANDLE'] = $rowRegistro['DOCAHANDLE'];
                $retorno['TIPOVEICULO'] = $rowRegistro['TIPOVEICULO'];
                $retorno['TIPOVEICULOHANDLE'] = $rowRegistro['TIPOVEICULOHANDLE'];
                $retorno['VEICULO'] = $rowRegistro['VEICULO'];
                $retorno['VEICULOUF'] = $rowRegistro['VEICULOUF'];
                $retorno['VEICULOUFHANDLE'] = $rowRegistro['VEICULOUFHANDLE'];
                $retorno['PROPRIEDADEVEICULO'] = $rowRegistro['PROPRIEDADEVEICULO'];
                $retorno['PROPRIEDADEVEICULOHANDLE'] = $rowRegistro['PROPRIEDADEVEICULOHANDLE'];
                $retorno['REBOQUE'] = $rowRegistro['REBOQUE'];
                $retorno['CONTEINER'] = $rowRegistro['CONTEINER'];
                $retorno['CONTEINERHANDLE'] = $rowRegistro['CONTEINERHANDLE'];
                $retorno['MOTORISTA'] = $rowRegistro['MOTORISTA'];
                $retorno['MOTORISTADOCUMENTO'] = $rowRegistro['MOTORISTADOCUMENTO'];
                
                $retorno['ERRO'] = '';
            } catch (Exception $erro) {
                $retorno['ERRO'] = $erro->getMessage();
            }
        }
}

Sistema::echoToJson($retorno);
