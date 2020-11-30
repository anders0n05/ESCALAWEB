<?php
header('Content-Type: application/json');
include_once('../tecnologia/Sistema.php');


function random_color_part() {
    return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
}

function random_color() {
    return random_color_part() . random_color_part() . random_color_part();
}


$connect = Sistema::getConexao();

	$query = $connect->prepare("SELECT 'Pronto para envio' SITUACAO,
						 		 	   A.HANDLE HANDLE,
									   A.NUMEROPEDIDO NUMEROPEDIDO
								  FROM RA_PEDIDO A (NOLOCK)
								 WHERE 1 = 1
								   " . Sistema::getFiltroPostTexto("estado", "A.UFDESTINATARIO") . "
								   " . Sistema::getFiltroPostDataPeriodo("periodo", "A.DATA") . "								
								   AND EXISTS (SELECT 1 
			  									 FROM RA_PEDIDOETAPA X
			 									WHERE X.PEDIDO = A.HANDLE
			   									  AND X.ETAPA = 4 --SEPARACAO
			   									  AND X.STATUS = 9) --ENCERRADA

								   AND NOT EXISTS (SELECT 1
				  									 FROM RA_PEDIDOETAPA X
				 									WHERE X.PEDIDO = A.HANDLE
				   									  AND X.ETAPA = 2 --INICIO DA VIAGEM
				   									  AND X.STATUS = 9) --ENCERRADA

								UNION ALL

								SELECT  'Em aberto no prazo sem ocorrência' SITUACAO,
										A.HANDLE HANDLE,
										A.NUMEROPEDIDO NUMEROPEDIDO
 								  FROM RA_PEDIDO A (NOLOCK)
								 WHERE A.DATAENTREGA IS NULL
								   AND A.DATAENTREGAATE > GETDATE()
								   " . Sistema::getFiltroPostTexto("estado", "A.UFDESTINATARIO") . "
								   " . Sistema::getFiltroPostDataPeriodo("periodo", "A.DATA") . "								
  								   AND EXISTS (SELECT 1
			  									 FROM RA_PEDIDOMOVIMENTACAO X
			   									WHERE X.PEDIDO = A.HANDLE
			   									  AND X.ORIGEM = 1371 --GD_DOCUMENTO
			   									  AND EXISTS (SELECT 1 
							 									FROM GD_DOCUMENTO Y
															   INNER JOIN GD_DOCUMENTOTRANSPORTE W ON W.DOCUMENTO = Y.HANDLE
															   WHERE Y.HANDLE = X.HANDLEORIGEM
							  									 AND (EXISTS (SELECT 1 
																				FROM OP_OCORRENCIA O
										   									   WHERE O.DOCUMENTOTRANSPORTE = W.HANDLE
											 									 AND O.ACAO = 1)
								  	OR NOT EXISTS (SELECT 1 
												     FROM OP_OCORRENCIA O
												    WHERE O.DOCUMENTOTRANSPORTE = W.HANDLE))))
								UNION ALL

								SELECT  'Em aberto no prazo com ocorrência' SITUACAO,
										A.HANDLE HANDLE,
										A.NUMEROPEDIDO NUMEROPEDIDO
 								  FROM RA_PEDIDO A (NOLOCK)
								 WHERE A.DATAENTREGA IS NULL
								   AND A.DATAENTREGAATE > GETDATE()
								   " . Sistema::getFiltroPostTexto("estado", "A.UFDESTINATARIO") . "
								   " . Sistema::getFiltroPostDataPeriodo("periodo", "A.DATA") . "								
  								   AND EXISTS (SELECT 1
			  									 FROM RA_PEDIDOMOVIMENTACAO X
			   									WHERE X.PEDIDO = A.HANDLE
			   									  AND X.ORIGEM = 1371 --GD_DOCUMENTO
			   									  AND EXISTS (SELECT 1 
							 								 	FROM GD_DOCUMENTO Y
															   INNER JOIN GD_DOCUMENTOTRANSPORTE W ON W.DOCUMENTO = Y.HANDLE
															   WHERE Y.HANDLE = X.HANDLEORIGEM
							  									 AND EXISTS (SELECT 1 
																			   FROM OP_OCORRENCIA O
										   									  WHERE O.DOCUMENTOTRANSPORTE = W.HANDLE
											 									AND O.ACAO <> 1)))

								UNION ALL

								SELECT  'Em aberto fora do prazo sem ocorrência' SITUACAO,
										A.HANDLE HANDLE,
										A.NUMEROPEDIDO NUMEROPEDIDO
 								  FROM RA_PEDIDO A (NOLOCK)
								 WHERE A.DATAENTREGA IS NULL
								   AND A.DATAENTREGAATE < GETDATE()
								   " . Sistema::getFiltroPostTexto("estado", "A.UFDESTINATARIO") . "
								   " . Sistema::getFiltroPostDataPeriodo("periodo", "A.DATA") . "																	 
  								   AND EXISTS (SELECT 1
			  					 				 FROM RA_PEDIDOMOVIMENTACAO X
			   					 				WHERE X.PEDIDO = A.HANDLE
			   									  AND X.ORIGEM = 1371 --GD_DOCUMENTO
			   									  AND EXISTS (SELECT 1 
			   									  				FROM GD_DOCUMENTO Y
															   INNER JOIN GD_DOCUMENTOTRANSPORTE W ON W.DOCUMENTO = Y.HANDLE
															   WHERE Y.HANDLE = X.HANDLEORIGEM
							  									 AND (EXISTS (SELECT 1 
																			    FROM OP_OCORRENCIA O
										   									   WHERE O.DOCUMENTOTRANSPORTE = W.HANDLE
											 									 AND O.ACAO = 1)
								  	OR NOT EXISTS (SELECT 1 
												     FROM OP_OCORRENCIA O
												    WHERE O.DOCUMENTOTRANSPORTE = W.HANDLE))))

								UNION ALL

								SELECT  'Em aberto fora do prazo com ocorrência' SITUACAO,
										A.HANDLE HANDLE,
										A.NUMEROPEDIDO NUMEROPEDIDO
								  FROM RA_PEDIDO A (NOLOCK)
								 WHERE A.DATAENTREGA IS NULL
								   AND A.DATAENTREGAATE < GETDATE()
								   " . Sistema::getFiltroPostTexto("estado", "A.UFDESTINATARIO") . "
								   " . Sistema::getFiltroPostDataPeriodo("periodo", "A.DATA") . "								 
								   AND EXISTS (SELECT 1
								   				 FROM RA_PEDIDOMOVIMENTACAO X
												WHERE X.PEDIDO = A.HANDLE
												  AND X.ORIGEM = 1371 --GD_DOCUMENTO
												  AND EXISTS (SELECT 1 
												  				FROM GD_DOCUMENTO Y
															   INNER JOIN GD_DOCUMENTOTRANSPORTE W ON W.DOCUMENTO = Y.HANDLE
							  								   WHERE Y.HANDLE = X.HANDLEORIGEM
																 AND EXISTS (SELECT 1 
											   								   FROM OP_OCORRENCIA O
																			  WHERE O.DOCUMENTOTRANSPORTE = W.HANDLE
											   									AND O.ACAO <> 1)))
								UNION ALL

			   					SELECT 'Entregue no prazo' SITUACAO,
									   A.HANDLE HANDLE,
									   A.NUMEROPEDIDO NUMEROPEDIDO
 								  FROM RA_PEDIDO A (NOLOCK)
								 WHERE A.DATAENTREGA IS NOT NULL
								   AND A.DATAENTREGA <= A.DATAENTREGAATE
								   " . Sistema::getFiltroPostTexto("estado", "A.UFDESTINATARIO") . "
								   " . Sistema::getFiltroPostDataPeriodo("periodo", "A.DATA") . "								 

								UNION ALL

								SELECT 'Entregue fora do prazo' SITUACAO,
									   A.HANDLE HANDLE,
									   A.NUMEROPEDIDO NUMEROPEDIDO
  								  FROM RA_PEDIDO A (NOLOCK)
 								 WHERE A.DATAENTREGA IS NOT NULL
								   AND A.DATAENTREGA > A.DATAENTREGAATE
								   " . Sistema::getFiltroPostTexto("estado", "A.UFDESTINATARIO") . "
								   " . Sistema::getFiltroPostDataPeriodo("periodo", "A.DATA") . "

								   ORDER BY 1  ") or die('Erro ao selecionar dados');
    $query->execute();

	$retorno_arr = array();
	
	$situacao = '';
	$num = '';	
	$qtd = 0;
	$pedidos = array();

    while($row = $query->FETCH(PDO::FETCH_ASSOC)){
		if (empty($situacao)){
			$situacao = $row['SITUACAO'];
		}

		if ($situacao == $row['SITUACAO']){
			$num .= $row['NUMEROPEDIDO'] . ";";
			$qtd++;
		}else{
			$etapa[] = $situacao;
			$pedidos[] = $num;
			$quantidade[] = $qtd;

			$num = array();

			$situacao = $row['SITUACAO'];
			$num = $row['NUMEROPEDIDO'] . ";";
			$qtd = 1;
		}
	}

	$etapa[] = $situacao;
	$pedidos[] = $num;
	$quantidade[] = $qtd;

	$retorno_arr = array(
		"labels" => $etapa,
		"pedidos" => $pedidos,
		"borderColor" => "window.chartColors",
		"borderWidth" => 1,
		"datasets" => [
			array(
				"label" => "Pedidos pendentes de entrega por prazo",
				"backgroundColor" => [
								  '#'.random_color(),
								  '#'.random_color(),
								  '#'.random_color(),
								  '#'.random_color(),
								  '#'.random_color(),
								  '#'.random_color(),
								  '#'.random_color(),
								  '#'.random_color(),
								  '#'.random_color(),
								  '#'.random_color(),
								  '#'.random_color(),
								  '#'.random_color(),
								  '#'.random_color(),
								  '#'.random_color(),
								  '#'.random_color(),
								  '#'.random_color(),
								  '#'.random_color(),
								  '#'.random_color(),
								  '#'.random_color(),
								  '#'.random_color(),
								  '#'.random_color(),
								  '#'.random_color(),
								  '#'.random_color(),
								  '#'.random_color(),
								  '#'.random_color(),
								  '#'.random_color(),
								  '#'.random_color()
								],
				"borderWidth" => 1,
				"data" => $quantidade,
			)
		]
	);

echo json_encode($retorno_arr, JSON_PRETTY_PRINT);