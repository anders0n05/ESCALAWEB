<?php
$query_itens = $connect->prepare("SELECT A.HANDLE HANDLE, 
													A.STATUS STATUS,  
													A.SEQUENCIAL CODIGO, 
													B1.NOME DESCRICAO, 
													B2.SIGLA UNMEDIDA, 
													A.QUANTIDADE QUANTIDADE, 
													A.VALORUNITARIO VALORUNITARIO, 
													A.VALORTOTAL VALORTOTAL,
													C.NOME STATUSNOME,
                                					D.RESOURCENAME RESOURCENAME
													FROM VE_ORDEMITEM A  
													LEFT JOIN VE_STATUSORDEMITEM B0 ON A.STATUS = B0.HANDLE 
													LEFT JOIN MT_ITEM B1 ON A.ITEM = B1.HANDLE 
													LEFT JOIN MT_UNIDADEMEDIDA B2 ON B1.UNIDADEMEDIDA = B2.HANDLE 
													LEFT JOIN MS_STATUS C ON C.HANDLE = A.STATUS
													LEFT JOIN MD_IMAGEM D ON D.HANDLE = C.IMAGEM
													WHERE A.ORDEM = '".$handlePedidoDeVenda."'
													ORDER BY  DESCRICAO ASC
								") or die('Erro ao executar sql de atendimentos.');

$query_itens->execute();

while ($row_itens = $query_itens->fetch(PDO::FETCH_ASSOC)) {
	$statusIconeItem = Sistema::getImagem($row_itens['RESOURCENAME'], $row_itens['STATUSNOME']);
    $handleItem = $row_itens['HANDLE'];
    $statusItem = $row_itens['STATUS'];
    $codigoItem = $row_itens['CODIGO'];
    $descricaoItem = $row_itens['DESCRICAO'];
    $unMedidaItem = $row_itens['UNMEDIDA'];
    $quantidadeItem = number_format($row_itens['QUANTIDADE'], '4', ',', '.');
    $valorUnitarioItem = number_format($row_itens['VALORUNITARIO'], '10', ',', '.');
    $valorTotalItem = number_format($row_itens['VALORTOTAL'], '2', ',', '.'); ?>

	<tr>
		<td hidden="true"><input type="radio" name="check[]" hidden="true" class="check" id="checkItem" value="<?php echo $handleItem.';'.$handlePedidoDeVenda.';'.$statusItem; ?>"></td>
		<td width="1%"><?php echo $statusIconeItem; ?></td>
		<td width="8%"><?php echo $codigoItem; ?></td>
		<td width="67%"><?php echo $descricaoItem; ?></td>
		<td style="text-align:right;" width="8%"><?php echo $quantidadeItem; ?></td>
		<td style="text-align:right;" width="8%"><?php echo $valorUnitarioItem; ?></td>
		<td style="text-align:right;" width="8%"><?php echo $valorTotalItem; ?></td>
	</tr>
<?php
}
?>