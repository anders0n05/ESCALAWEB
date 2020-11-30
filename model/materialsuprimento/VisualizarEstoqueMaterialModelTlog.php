<?php

$estoqueMercadoria = Sistema::getGet('estoqueMercadoria');
$filial = Sistema::getGet('filial');
$item = Sistema::getGet('item');
$ehArmazem = Sistema::getGet('ehArmazem');

# Saldo de estoque
if ($ehArmazem == 'N') {
	$queryEstoqueMercadoria = $connect->prepare(" SELECT A.BLOQUEADOQUANTIDADE BLOQUEADO,
												 		 A.CUSTOMEDIO CUSTOMEDIO,
												 		 A.DISPONIVELQUANTIDADE DISPONIVEL,
												 		 A.FILIAL FILIAL,
												 		 A.ITEM ITEM,
														 A.RESERVADOQUANTIDADE RESERVADO,
														 A.SALDOQUANTIDADE SALDOTOTAL,
														 A.SALDOVALOR VALORESTOQUE,
														 B.CODIGO CODIGOPRODUTO,
														 B.ESTOQUEMINIMO ESTOQUEMINIMO,
														 B.ESTOQUEMAXIMO ESTOQUEMAXIMO,
														 B.ESTOQUESEGURANCA ESTOQUESEGURANCA,
														 B.NOME NOMEPRODUTO,
														 C.NOME VARIACAO,
														 D1.NOME NOMEFILIAL,
														 D1.CNPJCPF CNPJFILIAL,
														 E.NOME ALMOXARIFADO
													FROM MT_SALDOESTOQUE A
													LEFT JOIN MT_ITEM B ON B.HANDLE = A.ITEM
													LEFT JOIN MT_ITEMVARIACAO C ON C.HANDLE = A.ITEMVARIACAO
													LEFT JOIN MS_FILIAL D ON D.HANDLE = A.FILIAL
													LEFT JOIN MS_PESSOA D1 ON D1.HANDLE = D.PESSOA
													LEFT JOIN MT_ALMOXARIFADO E ON E.HANDLE = A.ALMOXARIFADO
												   WHERE A.HANDLE = $estoqueMercadoria ");  
} else {
	$queryEstoqueMercadoria = $connect->prepare(" SELECT SUM(A.BLOQUEADOQUANTIDADE) BLOQUEADO,
											 			 SUM(A.DISPONIVELQUANTIDADE) DISPONIVEL,
									 					 CONVERT(NUMERIC(12,2), SUM(A.DISPONIVELVALOR) / CASE WHEN SUM(A.DISPONIVELQUANTIDADE) = 0 THEN 1 ELSE SUM(A.DISPONIVELQUANTIDADE) END) CUSTOMEDIO,
										 				 SUM(A.RESERVADOQUANTIDADE) RESERVADO,
														 SUM(A.SALDOQUANTIDADE) SALDOTOTAL,
														 SUM(A.SALDOVALOR) VALORESTOQUE,														
														 
														 A.FILIAL FILIAL,
														 A.ITEM ITEM,
														 
														 B.CODIGOREFERENCIA CODIGOPRODUTO,
														 B.ESTOQUEMINIMO ESTOQUEMINIMO,
														 B.ESTOQUEMAXIMO ESTOQUEMAXIMO,
														 B.ESTOQUESEGURANCA ESTOQUESEGURANCA,
														 B.NOME NOMEPRODUTO,		

														 NULL VARIACAO,	

														 E.NOME NOMEFILIAL,
														 E.CNPJCPF CNPJFILIAL,														
														 
														 NULL ALMOXARIFADO														
													
													FROM AM_SALDOESTOQUE A														
													
													LEFT JOIN MT_ITEM B ON B.HANDLE = A.ITEM

													LEFT JOIN MS_FILIAL D ON D.HANDLE = A.FILIAL
													LEFT JOIN MS_PESSOA E ON E.HANDLE = D.PESSOA
												   
												   WHERE A.ITEM = $item 
												     AND A.FILIAL = $filial
												   
												   GROUP BY  A.FILIAL,
															 A.ITEM,
															
															 B.CODIGOREFERENCIA,
															 B.ESTOQUEMINIMO,
														 	 B.ESTOQUEMAXIMO,
															 B.ESTOQUESEGURANCA,
															 B.NOME,		

															 E.NOME,
															 E.CNPJCPF");
}		

try {
	$queryEstoqueMercadoria->execute();
} catch (Exception $e) {
	echo 'Ocorreu um erro ao executar a consulta no banco de dados: ',  $e->getMessage(), "\n";
}	

$rowEstoqueMercadoria = $queryEstoqueMercadoria->fetch(PDO::FETCH_ASSOC);

$EstoqueMercadoriaItem = Sistema::formataInt($rowEstoqueMercadoria['ITEM']);
$EstoqueMercadoriaFilial = Sistema::formataInt($rowEstoqueMercadoria['FILIAL']);

$EstoqueMercadoriaBloqueado = Sistema::formataValor($rowEstoqueMercadoria['BLOQUEADO'], 4);
$EstoqueMercadoriaCustoMedio = Sistema::formataValor($rowEstoqueMercadoria['CUSTOMEDIO'], 10);
$EstoqueMercadoriaDisponivel = Sistema::formataValor($rowEstoqueMercadoria['DISPONIVEL'], 4);
$EstoqueMercadoriaReservado = Sistema::formataValor($rowEstoqueMercadoria['RESERVADO'], 4);
$EstoqueMercadoriaSaldoTotal = Sistema::formataValor($rowEstoqueMercadoria['SALDOTOTAL'], 4);
$EstoqueMercadoriaValorEstoque = Sistema::formataValor($rowEstoqueMercadoria['VALORESTOQUE']);
$EstoqueMercadoriaCodigoProduto = $rowEstoqueMercadoria['CODIGOPRODUTO'];
$EstoqueMercadoriaMinimo = Sistema::formataValor($rowEstoqueMercadoria['ESTOQUEMINIMO'], 4);
$EstoqueMercadoriaMaximo = Sistema::formataValor($rowEstoqueMercadoria['ESTOQUEMAXIMO'], 4);
$EstoqueMercadoriaSeguranca = Sistema::formataValor($rowEstoqueMercadoria['ESTOQUESEGURANCA'], 4);
$EstoqueMercadoriaNomeProduto = $rowEstoqueMercadoria['NOMEPRODUTO'];
$EstoqueMercadoriaVariacao = $rowEstoqueMercadoria['VARIACAO'];
$EstoqueMercadoriaNomeFilial = $rowEstoqueMercadoria['NOMEFILIAL'];
$EstoqueMercadoriaCnpjFilial = $rowEstoqueMercadoria['CNPJFILIAL'];
$EstoqueMercadoriaAlmoxarifado = $rowEstoqueMercadoria['ALMOXARIFADO'];

# Movimentacao de documento
if ($ehArmazem == 'N') {
	$sql = "  SELECT A.HANDLE,
	                 A.NUMERODOCUMENTO NUMERONFE,
					 A.SERIE SERIENFE,
					 A.DATAEMISSAOCOMHORAS DATAEMISSAO,													
					 B.QUANTIDADE QUANTIDADE,
					 C.NOME UNIDADEMEDIDA,
					 D.NOME PESSOA,
					 E.HANDLE ABRANGENCIAHANDLE,
					 E.SIGLA ABRANGENCIASIGLA
				FROM GD_DOCUMENTO A
			   INNER JOIN GD_DOCUMENTOITEM B ON B.DOCUMENTO = A.HANDLE										 
				LEFT JOIN MT_UNIDADEMEDIDA C ON C.HANDLE = B.UNIDADEMEDIDA
				LEFT JOIN MS_PESSOA D ON D.HANDLE = A.PESSOA
				LEFT JOIN MS_ABRANGENCIAOPERACAO E ON E.HANDLE = A.ABRANGENCIA										 
			   WHERE A.EHCANCELADO <> 'S'
				 AND A.EHESTORNADO <> 'S'
				 AND A.FILIAL = $EstoqueMercadoriaFilial
				 AND A.STATUS = 5										   
				 AND B.ITEM = $EstoqueMercadoriaItem
			   ORDER BY DATAEMISSAO DESC, NUMERONFE DESC ";
} else {
	$sql = "  SELECT A.HANDLE,
					 A.NUMERODOCUMENTO NUMERONFE,
					 A.SERIE SERIENFE,
					 A.DATAEMISSAOCOMHORAS DATAEMISSAO,													
					 B.QUANTIDADE QUANTIDADE,
					 C.NOME UNIDADEMEDIDA,
					 D.NOME PESSOA,
					 E.HANDLE ABRANGENCIAHANDLE,
					 E.SIGLA ABRANGENCIASIGLA
				FROM GD_DOCUMENTO A
			   INNER JOIN GD_DOCUMENTOITEM B ON B.DOCUMENTO = A.HANDLE										 
				LEFT JOIN MT_UNIDADEMEDIDA C ON C.HANDLE = B.UNIDADEMEDIDA
				LEFT JOIN MS_PESSOA D ON D.HANDLE = A.PESSOA
				LEFT JOIN MS_ABRANGENCIAOPERACAO E ON E.HANDLE = A.ABRANGENCIA
			   INNER JOIN MT_ITEM F ON F.HANDLE = $EstoqueMercadoriaItem
			   WHERE A.EHCANCELADO <> 'S'
				 AND A.EHESTORNADO <> 'S'
				 AND A.FILIAL = $EstoqueMercadoriaFilial
				 AND A.STATUS = 5										   
				 AND (B.ITEM = $EstoqueMercadoriaItem OR F.ITEMFISCAL = B.ITEM ) 
	
				 AND (  EXISTS (  SELECT W.HANDLE
				                    FROM AM_ORDEMITEMSEPARACAODEVOLUCAO W
				                   WHERE W.ITEM = $EstoqueMercadoriaItem
				                     AND W.DOCUMENTOITEM = B.HANDLE ) 
					    OR
				      
					    EXISTS (  SELECT W.HANDLE
				                    FROM AM_ORDEM W
				                   INNER JOIN AM_ORDEMITEM W1 ON W1.ORDEM = W.HANDLE
				                   INNER JOIN AM_ORDEMDOCUMENTO W2 ON W2.HANDLE = W1.ORDEMDOCUMENTO
				                   WHERE W1.ITEM = $EstoqueMercadoriaItem
				                     AND W2.DOCUMENTO = A.HANDLE ) 
				      )
               --GROUP BY A.HANDLE, A.NUMERODOCUMENTO, A.SERIE, A.DATAEMISSAOCOMHORAS, C.NOME, D.NOME, E.HANDLE, E.SIGLA 
	           ORDER BY DATAEMISSAO DESC, NUMERONFE DESC";
}
$queryMovimentacao = $connect->prepare($sql);
$queryMovimentacao->execute();

$rowMovimentacaoExiste = $queryMovimentacao->fetch(PDO::FETCH_ASSOC);
$movimentacaoExiste = $rowMovimentacaoExiste['HANDLE'];