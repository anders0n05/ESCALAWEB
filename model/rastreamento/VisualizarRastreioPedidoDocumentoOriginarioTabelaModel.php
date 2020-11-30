<?php
$DocumentoOriginario = null;
$numeroDocumentoOriginario = null;
$tipoDocumentoOriginario = null;
$valorLiquidoDocumentoOriginario = '0,00';
$filialDocumentoOriginario = null;
$emissaoDocumentoOriginario = null;
$pessoaDocumentoOriginario = null;
$statusDocumentoOriginario = null;
$pesoDocumentoOriginario = null;
$volumeDocumentoOriginario = null;

$queryDocumentoOriginario->execute();
while ($rowDocumentoOriginario = $queryDocumentoOriginario->fetch(PDO::FETCH_ASSOC)) {

    $DocumentoOriginario = $rowDocumentoOriginario['HANDLE'];
    $numeroDocumentoOriginario = $rowDocumentoOriginario['NUMERO'];
    $tipoDocumentoOriginario = $rowDocumentoOriginario['TIPO'];
    $valorLiquidoDocumentoOriginario = number_format($rowDocumentoOriginario['VALORTOTAL'], 2, ',', '.');
    $pesoDocumentoOriginario = number_format($rowDocumentoOriginario['PESO'], 4, ',', '.');
    $volumeDocumentoOriginario = number_format($rowDocumentoOriginario['VOLUME'], 2, ',', '.');

    if ($valorLiquidoDocumentoOriginario == null) {
        $valorLiquidoDocumentoOriginario = '0,00';
    }

    $filialDocumentoOriginario = $rowDocumentoOriginario['FILIAL'];
    $emissaoDocumentoOriginario = date('d/m/Y H:i', strtotime($rowDocumentoOriginario['DATAEMISSAO']));
    $pessoaDocumentoOriginario = $rowDocumentoOriginario['PESSOA'];
    $statusDocumentoOriginario = $rowDocumentoOriginario['STATUSDOCUMENTO'];
    $statusDocumentoOriginarioIcone = Sistema::getImagem($rowDocumentoOriginario['RESOURCENAME'], $rowDocumentoOriginario['STATUSNOME']);

    $queryDocumentoOriginarioIntegracao = $connect->prepare("SELECT A.HANDLE
																 FROM GD_DOCUMENTOINTEGRACAO A
																 WHERE A.PROCESSO = 6
																 AND A.DOCUMENTO = '" . $documentoOriginarioExiste . "'
															    ");
    $queryDocumentoOriginarioIntegracao->execute();

    $rowDocumentoOriginarioIntegracao = $queryDocumentoOriginarioIntegracao->fetch(PDO::FETCH_ASSOC);

    $handleDocumentoOriginarioIntegracao = $rowDocumentoOriginarioIntegracao['HANDLE'];

    ?>
    <tr>
        <td hidden="true"><input type="radio" name="checkDocumentoOriginario[]" hidden="true" class="check" id="checkDocumentoOriginario" value="<?php echo $DocumentoOriginario . '-' . $handleDocumentoOriginarioIntegracao; ?>"></td>
        <td width="1%"><?php echo $statusDocumentoOriginarioIcone; ?></td>
        <td class="text-right"><?php echo $numeroDocumentoOriginario; ?></td>
        <td><?php echo $tipoDocumentoOriginario; ?></td>
        <td><?php echo $filialDocumentoOriginario; ?></td>
        <td><?php echo $emissaoDocumentoOriginario; ?></td>
        <td><?php echo $pessoaDocumentoOriginario; ?></td>
        <td class="text-right"><?php echo $valorLiquidoDocumentoOriginario; ?></td>
        <td class="text-right"><?php echo $pesoDocumentoOriginario; ?></td>
        <td class="text-right"><?php echo $volumeDocumentoOriginario; ?></td>
    </tr>
    <?php
}