<?php
$EtapaHandle = null;
$Etapa = null;
$dataEtapa = null;
$statusEtapa = null;

$queryEtapa->execute();
while ($rowEtapa = $queryEtapa->fetch(PDO::FETCH_ASSOC)) {
    $EtapaHandle = $rowEtapa['HANDLE'];
    $Etapa = $rowEtapa['ETAPA'];
    $statusEtapa = $rowEtapa['STATUS'];
    $codigoEtapa = $rowEtapa['CODIGO'];
    $sequencialEtapa = $rowEtapa['SEQUENCIAL'];
    $observacaoEtapa = $rowEtapa['OBSERVACAO'];
    $dataEtapa = Sistema::formataDataHora($rowEtapa['DATA']);
    $statusEtapaIcone = Sistema::getImagem($rowEtapa['RESOURCENAME']);
    ?>
    <tr>
        <td hidden="true"><input type="radio" name="check[]" hidden="true" class="check" id="check" value="<?php echo $statusEtapa . '-' . $etapaHandle; ?>"></td>
        <td width="1%"><?php echo $statusEtapaIcone; ?></td>
        <td class="text-right"><?php echo $sequencialEtapa; ?></td>
        <td><?php echo $Etapa; ?></td>
        <td class="text-center"><?php echo $dataEtapa; ?></td>
        <td><?php echo $observacaoEtapa; ?></td>
    </tr>

    <?php
        $querySubEtapaEvento = $connect->prepare("SELECT TOP 10 A.STATUS STATUS,
										   A.HANDLE SUBETAPA, 
										   A.DATA DATA,
										   D.NOME NOME,
										   A.SEQUENCIAL,
										   A.OBSERVACAO,
                                           F.RESOURCENAME
									  FROM RA_PEDIDOETAPAEVENTO A
									 INNER JOIN RA_PEDIDOETAPA B ON B.HANDLE = A.PEDIDOETAPA
									 INNER JOIN RA_PEDIDO C ON C.HANDLE = B.PEDIDO
									  LEFT JOIN RA_TIPOEVENTO D ON A.TIPO = D.HANDLE
									  LEFT JOIN MS_STATUS E ON E.HANDLE = A.STATUS
									  LEFT JOIN MD_IMAGEM F ON F.HANDLE = E.IMAGEM
									 WHERE B.HANDLE = '" . $EtapaHandle . "'  
									ORDER BY A.SEQUENCIAL ASC
									");
        $querySubEtapaEvento->execute();
        if ($querySubEtapaEvento->fetch(PDO::FETCH_ASSOC) > null){
			?>

			<tr>
				<td colspan="6" style="
						padding: 0px;
						">
					<div style="
						padding-left: 47px;
						padding-bottom: 0px;
						padding-right: 0px;
						padding-top: 0px;
						background-color: white;
						">
						<table class="table table-responsive table-striped" border="0">
						<tbody>
						<tr>
						</tr>

		<?php
        while ($rowSubEtapa = $querySubEtapaEvento->fetch(PDO::FETCH_ASSOC)) {
            $SubEtapa = $rowSubEtapa['NOME'];
            $statusSubEtapa = $rowSubEtapa['STATUS'];
            $sequencialSubEtapa = $rowSubEtapa['SEQUENCIAL'];
            $observacaoSubEtapa = $rowSubEtapa['OBSERVACAO'];
            $dataSubEtapa = Sistema::formataDataHora($rowSubEtapa['DATA']);
            $statusSubEtapaIcone = Sistema::getImagem($rowSubEtapa['RESOURCENAME']);
            ?>
				<tr>
					<td hidden="true"><input type="radio" name="check[]" hidden="true" class="check" id="check"></td>
					<td width="1%"><?php echo $statusSubEtapaIcone; ?></td>
					<td class="text-right"><?php echo $sequencialSubEtapa; ?></td>
					<td><?php echo $SubEtapa; ?></td>
					<td class="text-center"><?php echo $dataSubEtapa; ?></td>
					<td><?php echo $observacaoSubEtapa; ?></td>
				</tr>
            <?php
        }
		?>
					</tbody>
					</table>
				</div>
            </td>
		</tr>
		<?php
    }
}