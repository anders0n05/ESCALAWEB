<?php

$estoqueMercadoria = Sistema::getGet('estoqueMercadoria');

# Saldo de estoque
$queryEstoqueMercadoria = $connect->prepare("SELECT A.BLOQUEADOQUANTIDADE BLOQUEADO,
													A.CUSTOMEDIO CUSTOMEDIO,
													A.DISPONIVELQUANTIDADE DISPONIVEL,
													A.FILIAL FILIAL,
													A.HANDLE HANDLE,
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

											   WHERE A.HANDLE = $estoqueMercadoria
												
											     AND (EXISTS (SELECT X.HANDLE
																FROM MS_USUARIOPESSOA X
															   WHERE X.USUARIO = $handleUsuario
																 AND EXISTS (SELECT X1.HANDLE
																   			   FROM MT_ITEMREFERENCIA X1
																			  WHERE X1.PESSOA = X.PESSOA
																				AND X1.ITEM = A.ITEM))
                                                           
													  OR NOT EXISTS (SELECT X.HANDLE
																	   FROM MS_USUARIOPESSOA X
																	  WHERE X.USUARIO = $handleUsuario)) ");
$queryEstoqueMercadoria->execute();

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
$queryMovimentacao = $connect->prepare("SELECT A.HANDLE,
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

										 ORDER BY DATAEMISSAO DESC, NUMERONFE DESC");
$queryMovimentacao->execute();

$rowMovimentacaoExiste = $queryMovimentacao->fetch(PDO::FETCH_ASSOC);
$movimentacaoExiste = $rowMovimentacaoExiste['HANDLE'];

# Imagem
$queryImagem = $connect->prepare("SELECT COUNT(HANDLE) QUANTIDADEIMAGEM
								    FROM MT_ITEMANEXO
								   WHERE ITEM = $EstoqueMercadoriaItem
									 AND TIPO = 1");
$queryImagem->execute();

$rowImagemExiste = $queryImagem->fetch(PDO::FETCH_ASSOC);
$imagemExiste = Sistema::formataInt($rowImagemExiste['QUANTIDADEIMAGEM']) > 0;