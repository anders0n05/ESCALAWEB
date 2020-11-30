<?php

$rastreamento = Sistema::getGet('r');

$handleRastreamentoUltimaEtapa = NULL;
$etapaRastreamentoUltimaEtapa = NULL;
$dataRastreamentoUltimaEtapa = NULL;
$observacaoRastreamentoUltimaEtapa = NULL;

$queryRastreamento = "SELECT A.HANDLE, 
						   A.STATUS, 
						   A.NUMEROPEDIDO, 
						   C.NOME FILIAL, 
						   A.CODIGORASTREAMENTO,
						   A.DATA, 
						   A.RASTREAMENTO, 
						   A.VALORMERCADORIA, 
						   A.NOMEREMETENTE REMETENTE, 
						   A.NOMEDESTINATARIO DESTINATARIO, 
						   A.MUNICIPIOREMETENTE MUNICIPIOCOLETA, 
						   A.UFREMETENTE ESTADOCOLETA, 
						   A.MUNICIPIODESTINATARIO MUNICIPIOENTREGA, 
						   A.UFDESTINATARIO ESTADOENTREGA,
						   N.NOME TIPO,
						   A.QUANTIDADE,
						   A.VOLUME,
						   A.PESO,
						   A.DATACOLETA,
						   A.DATAENTREGAATE,
						   A.DATAENTREGA,
						   A.BAIRROREMETENTE BAIRROCOLETA,
						   A.BAIRRODESTINATARIO BAIRROENTREGA,
						   A.LOGRADOUROREMETENTE RUACOLETA,
						   A.LOGRADOURODESTINATARIO RUAENTREGA,
						   A.NUMEROREMETENTE NUMEROCOLETA,
						   A.NUMERODESTINATARIO NUMEROENTREGA,
						   A.CEPREMETENTE CEPCOLETA,
						   A.CEPDESTINATARIO CEPENTREGA,
						   U.DOCUMENTO,
						   X.NOME RAZAOSOCIALEMPRESA,
						   X.CNPJCPF CNPJCPFEMPRESA,
						   A.RASTREAMENTO,
						   A.TIPOREMETENTE TIPOLOGRADOUROCOLETA,
						   A.TIPODESTINATARIO TIPOLOGRADOUROENTREGA,
						   T.APELIDO TRANSPORTADORA
					FROM RA_PEDIDO A (NOLOCK)
				LEFT JOIN RA_STATUSPEDIDO B ON A.STATUS = B.HANDLE 
				LEFT JOIN MS_FILIAL C ON A.FILIAL = C.HANDLE
				LEFT JOIN MS_PESSOA D ON A.REMETENTE = D.HANDLE 
				LEFT JOIN MS_PESSOA E ON A.DESTINATARIO = E.HANDLE 
				LEFT JOIN MS_USUARIO F ON A.LOGUSUARIOCADASTRO = F.HANDLE
				LEFT JOIN RA_STATUSPEDIDO M ON A.STATUS = M.HANDLE
				LEFT JOIN RA_TIPOPEDIDO N ON A.TIPO = N.HANDLE
				LEFT JOIN RA_PEDIDOMOVIMENTACAO U ON A.HANDLE = U.PEDIDO
				LEFT JOIN MS_EMPRESA V ON A.EMPRESA = V.HANDLE
				LEFT JOIN MS_PESSOA X ON V.PESSOA = X.HANDLE
				LEFT JOIN MS_PESSOA T ON T.HANDLE = A.TRANSPORTADORA
				WHERE A.RASTREAMENTO = '" . $rastreamento . "' ";
$queryRastreamento = $connect->prepare($queryRastreamento);

$queryRastreamento->execute();

$rowRastreamento = $queryRastreamento->fetch(PDO::FETCH_ASSOC);

if ($rowRastreamento['HANDLE'] <= 0) {
    $_SESSION['retorno'] = 'Pedido não encontrado, tente novamente.';
    $_SESSION['rastreamento'] = $rastreamento;
    echo "<script>history.go(-1)</script>";
}

$handleRastreamento = $rowRastreamento['HANDLE'];
$numeroPedidoRastreamento = $rowRastreamento['NUMEROPEDIDO'];
$filialRastreamento = $rowRastreamento['FILIAL'];
$valorMercadoriaRastreamento = $rowRastreamento['VALORMERCADORIA'];
$remetenteRastreamento = $rowRastreamento['REMETENTE'];
$destinatarioRastreamento = $rowRastreamento['DESTINATARIO'];
$municipioColetaRastreamento = $rowRastreamento['MUNICIPIOCOLETA'];
$ufColetaRastreamento = $rowRastreamento['ESTADOCOLETA'];
$municipioEntregaRastreamento = $rowRastreamento['MUNICIPIOENTREGA'];
$ufEntregaRastreamento = $rowRastreamento['ESTADOENTREGA'];
$tipoRastreamento = $rowRastreamento['TIPO'];
$quantidadeRastreamento = $rowRastreamento['QUANTIDADE'];
$volumeRastreamento = $rowRastreamento['VOLUME'];
$pesoRastreamento = $rowRastreamento['PESO'];
$dataColetaRastreamento = $rowRastreamento['DATACOLETA'];
$dataEntregaAteRastreamento = $rowRastreamento['DATAENTREGAATE'];
$dataEntregaRastreamento = $rowRastreamento['DATAENTREGA'];
$bairroColetaRastreamento = $rowRastreamento['BAIRROCOLETA'];
$ruaColetaRastreamento = $rowRastreamento['RUACOLETA'];
$ruaEntregaRastreamento = $rowRastreamento['RUAENTREGA'];
$numeroColetaRastreamento = $rowRastreamento['NUMEROCOLETA'];
$numeroEntregaRastreamento = $rowRastreamento['NUMEROENTREGA'];
$cepColetaRastreamento = $rowRastreamento['CEPCOLETA'];
$cepEntregaRastreamento = $rowRastreamento['CEPENTREGA'];
$paisColetaRastreamento = "Brasil";
$documentoRastreamento = $rowRastreamento['DOCUMENTO'];
$razaoSocialEmpresaRastreamento = $rowRastreamento['RAZAOSOCIALEMPRESA'];
$cnpjEmpresaRastreamento = $rowRastreamento['CNPJCPFEMPRESA'];
$paisEntregaRastreamento = "Brasil";
$tipoLogradouroColetaRastreamento = $rowRastreamento['TIPOLOGRADOUROCOLETA'];
$tipoLogradouroEntregaRastreamento = $rowRastreamento['TIPOLOGRADOUROENTREGA'];
$transportadora = $rowRastreamento['TRANSPORTADORA'];
$codigoRastreamento = $rowRastreamento['CODIGORASTREAMENTO'];

if (isset($rowRastreamento['DATA'])) {
    $dataRastreamento = date('d/m/Y H:i:s', strtotime($rowRastreamento['DATA']));
} else {
    $dataRastreamento = "";
}

$queryRastreamentoUltimaEtapa = "SELECT TOP 1 HANDLE, DATA, ETAPA, OBSERVACAO
								FROM (
								SELECT  A.HANDLE HANDLE, A.DATA DATA, B1.NOME ETAPA, B1.OBSERVACAO OBSERVACAO
								FROM RA_PEDIDOETAPA A  
								LEFT JOIN MS_STATUS B0 ON A.STATUS = B0.HANDLE 
								LEFT JOIN RA_TIPOETAPA B1 ON A.ETAPA = B1.HANDLE 
								WHERE A.PEDIDO = '" . $handleRastreamento . "'
                                                                  AND A.STATUS = 9

								UNION ALL

								SELECT A.HANDLE HANDLE, A.DATA DATA, B3.NOME ETAPA, A.OBSERVACAO OBSERVACAO
								FROM OP_OCORRENCIA A  
								LEFT JOIN OP_STATUSOCORRENCIA B0 ON A.STATUS = B0.HANDLE 
								LEFT JOIN MS_FILIAL B1 ON A.FILIAL = B1.HANDLE 
								LEFT JOIN OP_TIPOOCORRENCIA B2 ON A.TIPO = B2.HANDLE 
								LEFT JOIN OP_ACAOOCORRENCIA B3 ON A.ACAO = B3.HANDLE 
								WHERE A.EMPRESA IN (1)  
                                                                  AND A.STATUS = 4
								  AND EXISTS(SELECT X.HANDLE           
									FROM RA_PEDIDOMOVIMENTACAO X          
									INNER JOIN GD_DOCUMENTO  X1 ON X1.HANDLE = X.DOCUMENTO          
									WHERE X.PEDIDO = '" . $handleRastreamento . "'         
									AND X1.DOCUMENTOTRANSPORTE = A.DOCUMENTOTRANSPORTE) 
								) 
								AS ETAPAS
								ORDER BY DATA DESC
								";
$queryRastreamentoUltimaEtapa = $connect->prepare($queryRastreamentoUltimaEtapa);

$queryRastreamentoUltimaEtapa->execute();

while ($rowRastreamentoUltimaEtapa = $queryRastreamentoUltimaEtapa->fetch(PDO::FETCH_ASSOC)) {
    $handleRastreamentoUltimaEtapa = $rowRastreamentoUltimaEtapa['HANDLE'];
    $etapaRastreamentoUltimaEtapa = $rowRastreamentoUltimaEtapa['ETAPA'];
    $dataRastreamentoUltimaEtapa = date('d/m/Y H:i:s', strtotime($rowRastreamentoUltimaEtapa['DATA']));
    $observacaoRastreamentoUltimaEtapa = $rowRastreamentoUltimaEtapa['OBSERVACAO'];
}
if ($handleRastreamento <= 0) {
    $_SESSION['retorno'] = 'Pedido não encontrado, tente novamente.';
    $_SESSION['rastreamento'] = $rastreamento;
    header('Location: RastreioPedidoBuscar.php');
}

# ETAPA
$queryRastreamentoEtapa = "SELECT HANDLE, DATA, ETAPA, OBSERVACAO
							FROM (
							SELECT  A.HANDLE HANDLE, A.DATA DATA, B1.NOME ETAPA, B1.OBSERVACAO OBSERVACAO
							FROM RA_PEDIDOETAPA A  
							LEFT JOIN MS_STATUS B0 ON A.STATUS = B0.HANDLE 
							LEFT JOIN RA_TIPOETAPA B1 ON A.ETAPA = B1.HANDLE 
							WHERE A.PEDIDO = '" . $handleRastreamento . "'
                                                          AND A.STATUS = 9

							UNION ALL

							SELECT A.HANDLE HANDLE, A.DATA DATA, B3.NOME ETAPA, A.OBSERVACAO OBSERVACAO
							FROM OP_OCORRENCIA A  
							LEFT JOIN OP_STATUSOCORRENCIA B0 ON A.STATUS = B0.HANDLE 
							LEFT JOIN MS_FILIAL B1 ON A.FILIAL = B1.HANDLE 
							LEFT JOIN OP_TIPOOCORRENCIA B2 ON A.TIPO = B2.HANDLE 
							LEFT JOIN OP_ACAOOCORRENCIA B3 ON A.ACAO = B3.HANDLE 
							WHERE A.EMPRESA IN (1)
                                                          AND A.STATUS = 4
							  AND EXISTS(SELECT X.HANDLE           
								FROM RA_PEDIDOMOVIMENTACAO X          
								INNER JOIN GD_DOCUMENTO  X1 ON X1.HANDLE = X.DOCUMENTO          
								WHERE X.PEDIDO = '" . $handleRastreamento . "'         
								AND X1.DOCUMENTOTRANSPORTE = A.DOCUMENTOTRANSPORTE) 
							) 
							AS ETAPAS
							ORDER BY DATA DESC
							";
$queryRastreamentoEtapa = $connect->prepare($queryRastreamentoEtapa);
$queryRastreamentoEtapa->execute();

$rowRastreamentoEtapa = $queryRastreamentoEtapa->fetch(PDO::FETCH_ASSOC);

$handleRastreamentoEtapa = $rowRastreamentoEtapa['HANDLE'];

# DOCUMENTO
$queryRastreamentoDocumentoOriginario = "SELECT A.HANDLE, 
												   A.NUMERO NUMERODOCUMENTO, 
												   B.SIGLA TIPODOCUMENTO, 
												   A.VALORTOTAL VALORDOCUMENTO, 
												   C.NOME FILIAL, 
												   A.DATAEMISSAO DATAEMISSAO,
												   A.STATUS STATUSDOCUMENTO,
												   D.APELIDO EMITENTE,
												   A.PESOBRUTO PESO,
												   A.VOLUME
								 FROM GD_ORIGINARIO A  
						LEFT JOIN GD_TIPOORIGINARIO B ON A.TIPO = B.HANDLE 
							   LEFT JOIN MS_FILIAL C ON A.FILIAL = C.HANDLE
							   LEFT JOIN MS_PESSOA D ON A.EMITENTE = D.HANDLE
				   LEFT JOIN RA_PEDIDOMOVIMENTACAO E ON A.HANDLE = E.DOCUMENTO
											 WHERE EXISTS ( SELECT X.HANDLE             
																  FROM RA_PEDIDOMOVIMENTACAO X            
																  WHERE X.PEDIDO = '" . $handleRastreamento . "'       
																  AND X.HANDLEORIGEM = A.HANDLE              
																  AND X.ORIGEM = 1890
																)
										  ORDER BY A.NUMERO
									   ";
$queryRastreamentoDocumentoOriginario = $connect->prepare($queryRastreamentoDocumentoOriginario);
$queryRastreamentoDocumentoOriginario->execute();

$rowRastreamentoDocumentoOriginario = $queryRastreamentoDocumentoOriginario->fetch(PDO::FETCH_ASSOC);

$handleRastreamentoDocumentoOriginario = $rowRastreamentoDocumentoOriginario['HANDLE'];

$queryRastreamentoDocumento = "SELECT A.HANDLE, 
							   A.NUMERODOCUMENTO NUMERODOCUMENTO, 
							   B3.SIGLA TIPODOCUMENTO, 
							   A.DATAEMISSAO DATAEMISSAO, 
							   A.VALORBRUTO VALORDOCUMENTO,
							   B5.APELIDO EMITENTE
						FROM GD_DOCUMENTO A  
						LEFT JOIN GD_STATUSDOCUMENTO B0 ON A.STATUS = B0.HANDLE 
						LEFT JOIN GD_DOCUMENTOTRANSPORTE B1 ON A.DOCUMENTOTRANSPORTE = B1.HANDLE 
						LEFT JOIN GD_STATUSDOCUMENTOTRANSPORTE B2 ON B1.STATUS = B2.HANDLE 
						LEFT JOIN TR_TIPODOCUMENTO B3 ON A.TIPODOCUMENTOFISCAL = B3.HANDLE 
						LEFT JOIN TR_MODELODOCUMENTO B4 ON A.MODELO = B4.HANDLE 
						LEFT JOIN MS_PESSOA B5 ON A.PESSOA = B5.HANDLE 
						WHERE EXISTS (  SELECT X.HANDLE             
										FROM RA_PEDIDOMOVIMENTACAO X            
										WHERE X.PEDIDO = '" . $handleRastreamento . "'           
										AND X.HANDLEORIGEM = A.HANDLE              
										AND X.ORIGEM = 1371 
									 ) 
							ORDER BY  NUMERODOCUMENTO, TIPODOCUMENTO, DATAEMISSAO, VALORDOCUMENTO ASC
									   ";
$queryRastreamentoDocumento = $connect->prepare($queryRastreamentoDocumento);
$queryRastreamentoDocumento->execute();

$rowRastreamentoDocumento = $queryRastreamentoDocumento->fetch(PDO::FETCH_ASSOC);

$handleRastreamentoDocumento = $rowRastreamentoDocumento['HANDLE'];
