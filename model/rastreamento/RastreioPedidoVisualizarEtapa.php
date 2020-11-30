<?php

$queryRastreamentoEtapa->execute();

while($rowRastreamentoEtapa = $queryRastreamentoEtapa->fetch(PDO::FETCH_ASSOC)){
$handleRastreamentoEtapa = $rowRastreamentoEtapa['HANDLE'];
$etapaRastreamentoEtapa = $rowRastreamentoEtapa['ETAPA'];
//$dataRastreamentoEtapa = date('d/m/Y H:i:s', strtotime($rowRastreamentoEtapa['DATA']));
$observacaoRastreamentoEtapa = $rowRastreamentoEtapa['OBSERVACAO'];
	
$ts = strtotime($rowRastreamentoEtapa['DATA']);

if ($ts === false)
{
	$dataRastreamentoEtapa = NULL;
}
else
{
	$dataRastreamentoEtapa = date('d/m/Y H:i:s', strtotime($rowRastreamentoEtapa['DATA']));
}
?>
<tr>
<td style="border: 0; width: 10%"><?php echo $dataRastreamentoEtapa; ?></td>
<td style="border: 0;"><?php echo $etapaRastreamentoEtapa; ?></td>
<td style="border: 0;"><?php echo $observacaoRastreamentoEtapa; ?></td>
</tr>
<?php
}