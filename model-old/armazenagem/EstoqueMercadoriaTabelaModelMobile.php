<?php
	$queryEstoqueMercadoria =  "SELECT A.HANDLE, 
									B0.CODIGOREFERENCIA CODIGOREFERENCIA, 
									B0.NOME PRODUTO, 
									B1.APELIDO CLIENTE, 
									B3.SIGLA DEPOSITO, 
									B2.ESTRUTURA ENDERECO, 
									B4.NOME TIPOAREA, 
									B5.NUMEROUNITIZACAO UNITIZACAO, 
									B6.SIGLA UNIDADEMEDIDA, 
									B8.NOME LOTE, 
									B7.FABRICACAO FABRICACAO,
									B7.VALIDADE VALIDADE, 
									B13.SIGLA TIPODOC,  
									B12.NUMERO NUMERODOCUMENTO,
									B14.NUMEROPEDIDO NUMEROPEDIDO, 
									B14.NUMERO ORDEM, 
									B12.EMISSAO EMISSAODOCUMENTO, 
									A.DISPONIVELQUANTIDADE DISPONIVELQUANTIDADE,
									A.BLOQUEADOQUANTIDADE BLOQUEADOQUANTIDADE, 
									A.RESERVADOQUANTIDADE RESERVADOQUANTIDADE, 
                       				A.RECEBIMENTOQUANTIDADE ENTRADAVIRTUALQUANTIDADE, 
									A.SALDOQUANTIDADE SALDOQUANTIDADE, 
									A.SALDOQUANTIDADEVOLUME SALDOQUANTIDADEVOLUME, 
									A.SALDOPESOLIQUIDO SALDOPESOLIQUIDO, 
									A.SALDOPESOBRUTO SALDOPESOBRUTO, 
									A.DISPONIVELQUANTIDADEVOLUME DISPONIVELQUANTIDADEVOLUME, 
									A.DISPONIVELPESOLIQUIDO DISPONIVELPESOLIQUIDO, 
									A.DISPONIVELPESOBRUTO DISPONIVELPESOBRUTO, 
									A.BLOQUEADOQUANTIDADEVOLUME BLOQUEADOQUANTIDADEVOLUME, 
									A.BLOQUEADOPESOLIQUIDO BLOQUEADOPESOLIQUIDO, 
									A.BLOQUEADOPESOBRUTO BLOQUEADOPESOBRUTO, 
									A.RESERVADOQUANTIDADEVOLUME RESERVADOQUANTIDADEVOLUME, 
									A.RESERVADOPESOLIQUIDO RESERVADOPESOLIQUIDO, 
									A.RESERVADOPESOBRUTO RESERVADOPESOBRUTO, 
									A.SALDOQUANTIDADEVOLUME SALDOQUANTIDADEVOLUME, 
									A.SALDOQUANTIDADE SALDOQUANTIDADE, 
									A.SALDOPESOLIQUIDO SALDOPESOLIQUIDO,
									A.SALDOPESOBRUTO SALDOPESOBRUTO
									FROM AM_SALDOESTOQUE A  
									LEFT JOIN MT_ITEM B0 ON A.ITEM = B0.HANDLE 
									LEFT JOIN MS_PESSOA B1 ON A.CLIENTE = B1.HANDLE 
									LEFT JOIN AM_DEPOSITOLOCALIZACAO B2 ON A.ENDERECO = B2.HANDLE 
									LEFT JOIN AM_DEPOSITO B3 ON B2.DEPOSITO = B3.HANDLE 
									LEFT JOIN AM_TIPOAREA B4 ON B2.TIPOAREA = B4.HANDLE 
									LEFT JOIN AM_UNITIZACAO B5 ON A.UNITIZACAO = B5.HANDLE 
									LEFT JOIN MT_UNIDADEMEDIDA B6 ON A.UNIDADEMEDIDA = B6.HANDLE 
									LEFT JOIN AM_ORDEMITEMLOTE B7 ON A.ITEMLOTE = B7.HANDLE 
									LEFT JOIN AM_LOTE B8 ON B7.LOTE = B8.HANDLE 
									LEFT JOIN AM_ORDEMCONTEINER B9 ON B7.ORDEMCONTEINER = B9.HANDLE 
									LEFT JOIN PA_CONTEINER B10 ON B9.CONTEINER = B10.HANDLE 
									LEFT JOIN AM_ORDEMITEM B11 ON B7.ORDEMITEM = B11.HANDLE 
									LEFT JOIN AM_ORDEMDOCUMENTO B12 ON B11.ORDEMDOCUMENTO = B12.HANDLE 
									LEFT JOIN GD_TIPOORIGINARIO B13 ON B12.TIPO = B13.HANDLE 
									LEFT JOIN AM_ORDEM B14 ON B7.ORDEM = B14.HANDLE 
									WHERE A.SALDOQUANTIDADE > 0 
									ORDER BY CODIGOREFERENCIA ASC 
								   ";
	
	$queryEstoqueMercadoria = $connect->prepare($queryEstoqueMercadoria);

	$queryEstoqueMercadoria->execute();
		while($rowEstoqueMercadoria = $queryEstoqueMercadoria->fetch(PDO::FETCH_ASSOC)){
			
			$handleEstoqueMercadoria = $rowEstoqueMercadoria['HANDLE']; 
			$codigoReferenciaProdutoEstoqueMercadoria = $rowEstoqueMercadoria['CODIGOREFERENCIA'];  
			$produtoEstoqueMercadoria = $rowEstoqueMercadoria['PRODUTO'];  
			$clienteEstoqueMercadoria = $rowEstoqueMercadoria['CLIENTE'];  
			$depositoEstoqueMercadoria = $rowEstoqueMercadoria['DEPOSITO'];  
			$enderecoEstoqueMercadoria = $rowEstoqueMercadoria['ENDERECO'];  
			$tipoAreaEstoqueMercadoria = $rowEstoqueMercadoria['TIPOAREA'];  
			$unitizacaoEstoqueMercadoria = $rowEstoqueMercadoria['UNITIZACAO'];  
			$unidadeMedidaEstoqueMercadoria = $rowEstoqueMercadoria['UNIDADEMEDIDA'];  
			$loteEstoqueMercadoria = $rowEstoqueMercadoria['LOTE'];  
			$fabricacaoEstoqueMercadoria = date('d/m/Y', strtotime($rowEstoqueMercadoria['FABRICACAO'])); 
			$validadeEstoqueMercadoria = date('d/m/Y', strtotime($rowEstoqueMercadoria['VALIDADE']));  
			$tipoDocEstoqueMercadoria = $rowEstoqueMercadoria['TIPODOC'];   
			$numeroDocEstoqueMercadoria = $rowEstoqueMercadoria['NUMERODOCUMENTO']; 
			$numeroPedidoEstoqueMercadoria = $rowEstoqueMercadoria['NUMEROPEDIDO'];  
			$numeroOrdemEstoqueMercadoria = $rowEstoqueMercadoria['ORDEM'];  
			$emissaoDocEstoqueMercadoria = date('d/m/Y', strtotime($rowEstoqueMercadoria['EMISSAODOCUMENTO']));  
			$disponivelQuantidadeEstoqueMercadoria = $rowEstoqueMercadoria['DISPONIVELQUANTIDADE']; 
			$bloqueadoQuantidadeEstoqueMercadoria = $rowEstoqueMercadoria['BLOQUEADOQUANTIDADE'];  
			$reservadoQuantidadeEstoqueMercadoria = $rowEstoqueMercadoria['RESERVADOQUANTIDADE'];  
			$entradaVirtualQuantidadeEstoqueMercadoria = $rowEstoqueMercadoria['ENTRADAVIRTUALQUANTIDADE'];  
			$saldoQuantidadeEstoqueMercadoria = $rowEstoqueMercadoria['SALDOQUANTIDADE'];  
			$saldoQuantidadeVolumeEstoqueMercadoria = $rowEstoqueMercadoria['SALDOQUANTIDADEVOLUME'];  
			$saldoPesoLiquidoEstoqueMercadoria = $rowEstoqueMercadoria['SALDOPESOLIQUIDO'];  
			$saldoPesoBrutoEstoqueMercadoria = $rowEstoqueMercadoria['SALDOPESOBRUTO'];  
			$disponivelQuantidadeVolumeEstoqueMercadoria = $rowEstoqueMercadoria['DISPONIVELQUANTIDADEVOLUME'];  
			$diponivelPesoLiquidoEstoqueMercadoria = $rowEstoqueMercadoria['DISPONIVELPESOLIQUIDO'];  
			$disponivelPesoBrutoEstoqueMercadoria = $rowEstoqueMercadoria['DISPONIVELPESOBRUTO'];  
			$bloqueadoQuantidadeVolumeEstoqueMercadoria = $rowEstoqueMercadoria['BLOQUEADOQUANTIDADEVOLUME'];  
			$bloqueadoPesoLiquidoEstoqueMercadoria = $rowEstoqueMercadoria['BLOQUEADOPESOLIQUIDO'];  
			$bloqueadoPesoBrutoEstoqueMercadoria = $rowEstoqueMercadoria['BLOQUEADOPESOBRUTO'];  
			$reservadoQuantidadeVolumeEstoqueMercadoria = $rowEstoqueMercadoria['RESERVADOQUANTIDADEVOLUME'];  
			$reservadoPesoLiquidoEstoqueMercadoria = $rowEstoqueMercadoria['RESERVADOPESOLIQUIDO'];  
			$reservadoPesoBrutoEstoqueMercadoria = $rowEstoqueMercadoria['RESERVADOPESOBRUTO'];  			
?>
    			<tr>
                  <td hidden="true"><input type="radio" name="check[]" hidden="true" class="check" id="check" value="<?php echo $Rastreamento.'-'.$pedidoRastreamento; ?>"></td>
				  <td><?php echo '<strong>Codigo Ref.:</strong> '.$codigoReferenciaProdutoEstoqueMercadoria; ?>
                  <?php echo ' - <strong>Produto:</strong> '.$produtoEstoqueMercadoria; ?>
                  <?php echo ' - <strong>Cliente:</strong> '.$clienteEstoqueMercadoria; ?>
                  <?php echo ' - <strong>Depósito:</strong> '.$depositoEstoqueMercadoria; ?>
                  <?php echo ' - <strong>Endereço:</strong> '.$enderecoEstoqueMercadoria; ?>
                  <?php echo ' - <strong>Tipo de Área:</strong> '.$tipoAreaEstoqueMercadoria; ?>
                  <?php echo ' - <strong>Unitização:</strong> '.$unitizacaoEstoqueMercadoria; ?>
                  <?php echo ' - <strong>Lote:</strong> '.$loteEstoqueMercadoria; ?>
                  <?php echo ' - <strong>Fabricação:</strong> '.$fabricacaoEstoqueMercadoria; ?>
                  <?php echo ' - <strong>Validade:</strong> '.$validadeEstoqueMercadoria; ?>
                  <?php echo ' - <strong>Tipo Doc.:</strong> '.$tipoDocEstoqueMercadoria; ?>
                  <?php echo ' - <strong>Número Doc.:</strong> '.$numeroDocEstoqueMercadoria; ?>
                  <?php echo ' - <strong>Emissão Doc.:</strong> '.$emissaoDocEstoqueMercadoria; ?>
                  <?php echo ' - <strong>Pedido:</strong> '.$numeroPedidoEstoqueMercadoria; ?>
                  <?php echo ' - <strong>Ordem:</strong> '.$numeroOrdemEstoqueMercadoria; ?>
                  <?php echo ' - <strong>Unidade Medida:</strong> '.$unidadeMedidaEstoqueMercadoria; ?>
                  <?php echo ' - <strong>Qtd Disponível:</strong> '.number_format($disponivelQuantidadeEstoqueMercadoria, 4, ',', '.'); ?>
                  <?php echo ' - <strong>Qtd Bloqueada:</strong> '.number_format($bloqueadoQuantidadeEstoqueMercadoria, 4, ',', '.'); ?>
                  <?php echo ' - <strong>Qtd Reservada:</strong> '.number_format($reservadoQuantidadeEstoqueMercadoria, 4, ',', '.'); ?>
                  <?php echo ' - <strong>Qtd Entrada Virtual:</strong> '.number_format($entradaVirtualQuantidadeEstoqueMercadoria, 4, ',', '.'); ?>
                  <?php echo ' - <strong>Qtd Saldo:</strong> '.number_format($saldoQuantidadeEstoqueMercadoria, 4, ',', '.'); ?>
                  <?php echo ' - <strong>Qtd Disponível Volume:</strong> '.$disponivelQuantidadeVolumeEstoqueMercadoria; ?>
                  <?php echo ' - <strong>Qtd Saldo Volume:</strong> '.$saldoQuantidadeVolumeEstoqueMercadoria; ?></td>
    			</tr>
<?php
		}
?>