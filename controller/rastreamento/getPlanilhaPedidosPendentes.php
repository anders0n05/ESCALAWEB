<?php
header('Content-Type: application/json');
include_once('../tecnologia/Sistema.php');

$connect = Sistema::getConexao();

	$query = $connect->prepare("SELECT A.NOMEDESTINATARIO DESTINATARIO,
									   '' CANAL,
									   A.MUNICIPIODESTINATARIO MUNICIPIODESTINO,
									   A.UFDESTINATARIO ESTADODESTINO,
									   A.CEPDESTINATARIO CEPDESTINO,

									   A.NUMEROPEDIDO NUMEROPEDIDO,
									   A.NUMEROCONTROLE NUMEROCONTROLE,

									   COALESCE(B.SERIE, '') SERIE,
									   COALESCE(B.NUMERODOCUMENTO,'') NUMERODOCUMENTO,
									   COALESCE(B.CHAVEDOCUMENTOELETRONICO,'') CHAVENOTA, 

									   COALESCE(D.VALORMERCADORIA, 0) VALORMERCADORIA,
									   COALESCE(D.PESOAFERIDO, 0) PESO,
									   COALESCE(D.PESOCUBADO, 0)PESOCUBADO, 

									   E.APELIDO TRANSPORTADORA,
									   A.STATUSDATA DATASITUACAO,

									   COALESCE(A.UFREMETENTE,'') ESTADOREMETENTE,
									   COALESCE(A.CEPREMETENTE,'') CEPREMETENTE,
									   A.DATACOLETA DATACOLETA,
									   A.DATAENTREGA DATAENTREGA,
									   A.DATAENTREGAATE DATAENTREGAATE,
									   'http://$_SERVER[HTTP_HOST]/view/rastreamento/RastreioPedidoVisualizar.php?r=' + CAST(A.NUMERO AS VARCHAR) + '&enviar=Enviar' RASTREAMENTO,

									   COALESCE(A.CELULARDESTINATARIO,'') CELULAR,
									   SUBSTRING(A.CEPDESTINATARIO, 0,6) CABECA,
									   COALESCE(CASE WHEN (A.DATAENTREGAATE >= GETDATE() OR A.DATAENTREGAATE>= A.DATAENTREGA) THEN 'No prazo' ELSE 'Fora do prazo' END,'') SITUACAO,
									   (CASE WHEN A.DATAENTREGA IS NULL THEN 'Em aberto' ELSE 'Entregue' END +
									   CASE WHEN (A.DATAENTREGAATE >= GETDATE() OR A.DATAENTREGAATE>= A.DATAENTREGA) THEN ' no prazo' ELSE ' fora do prazo' END +
									   CASE WHEN EXISTS(SELECT 1 
									   					  FROM RA_PEDIDO S
					  									 WHERE S.HANDLE = A.HANDLE
														   AND EXISTS (SELECT 1
														    			 FROM RA_PEDIDOMOVIMENTACAO X
																		WHERE X.PEDIDO = S.HANDLE
																		  AND X.ORIGEM = 1371 --GD_DOCUMENTO
									   AND EXISTS (SELECT 1 
													  FROM GD_DOCUMENTO Y
													INNER JOIN GD_DOCUMENTOTRANSPORTE W ON W.DOCUMENTO = Y.HANDLE
													WHERE Y.HANDLE = X.HANDLEORIGEM
														 AND EXISTS (SELECT 1 
																	 FROM OP_OCORRENCIA O
																   WHERE O.DOCUMENTOTRANSPORTE = W.HANDLE
																	 AND O.ACAO <> 1)))) THEN ' com ocorrências' ELSE ' sem ocorrências' END ) PERFORMANCE
										FROM RA_PEDIDO A (NOLOCK)
										LEFT JOIN GD_ORIGINARIO B ON B.HANDLE = A.HANDLEORIGEM AND A.ORIGEM = 1890
										LEFT JOIN GD_DOCUMENTO C ON C.HANDLE = A.HANDLEORIGEM AND A.ORIGEM = 1371
										LEFT JOIN GD_DOCUMENTOTRANSPORTE D ON D.HANDLE = A.HANDLEORIGEM AND A.ORIGEM = 2042
										LEFT JOIN MS_PESSOA E ON E.HANDLE = A.TRANSPORTADORA
									   WHERE 1 = 1
								   " . Sistema::getFiltroPostTexto("estado", "A.UFDESTINATARIO") . "
								   " . Sistema::getFiltroPostDataPeriodo("periodo", "A.DATA") . "								
								  ORDER BY 1  ") or die('Erro ao selecionar dados');
    $query->execute();

	$retorno_arr = array();

	while($row = $query->FETCH(PDO::FETCH_ASSOC)){
		$linha = array();
		$linha['DESTINATARIO'] = Sistema::formataTexto($row['DESTINATARIO']);
		$linha['CANAL'] = Sistema::formataTexto($row['CANAL']);
		$linha['MUNICIPIODESTINO'] = Sistema::formataTexto($row['MUNICIPIODESTINO']);
		$linha['ESTADODESTINO'] = Sistema::formataTexto($row['ESTADODESTINO']);
		$linha['CEPDESTINO'] = Sistema::formataTexto($row['CEPDESTINO']);
		$linha['NUMEROPEDIDO'] = Sistema::formataTexto($row['NUMEROPEDIDO']);
		$linha['NUMEROCONTROLE'] = Sistema::formataTexto($row['NUMEROCONTROLE']);
		$linha['SERIE'] = Sistema::formataTexto($row['SERIE']);
		$linha['NUMERODOCUMENTO'] = Sistema::formataTexto($row['NUMERODOCUMENTO']);
		$linha['CHAVENOTA'] = Sistema::formataTexto($row['CHAVENOTA']);
		$linha['VALORMERCADORIA'] = $row['VALORMERCADORIA'];
		$linha['PESO'] = $row['PESO'];
		$linha['PESOCUBADO'] = $row['PESOCUBADO'];
		$linha['TRANSPORTADORA'] = Sistema::formataTexto($row['TRANSPORTADORA']);	
		$linha['DATASITUACAO'] = Sistema::formataDataHora($row['DATASITUACAO']);
		$linha['ESTADOREMETENTE'] = Sistema::formataTexto($row['ESTADOREMETENTE']);
		$linha['CEPREMETENTE'] = Sistema::formataTexto($row['CEPREMETENTE']);
		$linha['DATACOLETA'] = Sistema::formataDataHora($row['DATACOLETA']);
		$linha['DATAENTREGA'] = Sistema::formataDataHora($row['DATAENTREGA']);
		$linha['DATAENTREGAATE'] = Sistema::formataDataHora($row['DATAENTREGAATE']);
		$linha['RASTREAMENTO'] = $row['RASTREAMENTO'];
		$linha['CELULAR'] = Sistema::formataTexto($row['CELULAR']);
		$linha['CABECA'] = Sistema::formataTexto($row['CABECA']);
		$linha['SITUACAO'] = Sistema::formataTexto($row['SITUACAO']);
		$linha['PERFORMANCE'] = Sistema::formataTexto($row['PERFORMANCE']);

		$result[] = $linha;
	}
	
    echo json_encode($result, JSON_PRETTY_PRINT);	