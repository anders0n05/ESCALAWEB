<?php

$queryMovimentacao->execute();

while ($rowMovimentacao = $queryMovimentacao->fetch(PDO::FETCH_ASSOC)) {
	$MovimentacaoNumeroNfe = $rowMovimentacao['NUMERONFE'];
	$MovimentacaoSerieNfe = $rowMovimentacao['SERIENFE'];
	$MovimentacaoAbrangencia = $rowMovimentacao['ABRANGENCIASIGLA'];
	$MovimentacaoPessoa = $rowMovimentacao['PESSOA'];
	$MovimentacaoDataEmissao = Sistema::formataDataHora($rowMovimentacao['DATAEMISSAO']);
	$MovimentacaoQuantidade = Sistema::formataValor($rowMovimentacao['QUANTIDADE'], 4);
	$MovimentacaoUnidadeMedida = $rowMovimentacao['UNIDADEMEDIDA'];

?>
	<tr>
		<td class="text-right"><?php echo $MovimentacaoNumeroNfe; ?></td>
		<td class="text-right"><?php echo $MovimentacaoSerieNfe; ?></td>
		<td class="text-center"><?php echo $MovimentacaoAbrangencia; ?></td>
		<td><?php echo $MovimentacaoPessoa; ?></td>
		<td class="text-center"><?php echo $MovimentacaoDataEmissao; ?></td>
		<td class="text-right"><?php echo $MovimentacaoQuantidade; ?></td>
		<td><?php echo $MovimentacaoUnidadeMedida; ?></td>
	</tr>
<?php
}
?>