<?php
$queryRastreamentoDocumentoOriginario->execute();

while ($rowRastreamentoDocumentoOriginario = $queryRastreamentoDocumentoOriginario->fetch(PDO::FETCH_ASSOC)) {
    $handleRastreamentoDocumentoOriginario = $rowRastreamentoDocumentoOriginario['HANDLE'];
    $numeroRastreamentoDocumentoOriginario = $rowRastreamentoDocumentoOriginario['NUMERODOCUMENTO'];
    $tipoRastreamentoDocumentoOriginario = $rowRastreamentoDocumentoOriginario['TIPODOCUMENTO'];
    $dataEmissaoRastreamentoDocumentoOriginario = date('d/m/Y', strtotime($rowRastreamentoDocumentoOriginario['DATAEMISSAO']));
    $valorRastreamentoDocumentoOriginario = $rowRastreamentoDocumentoOriginario['VALORDOCUMENTO'];
    $emitenteRastreamentoDocumentoOriginario = $rowRastreamentoDocumentoOriginario['EMITENTE'];
    ?>
    
    <tr style="background-color: #F5F5F5;">
        <td style="border: 0; width: 10%"><label><?php echo $tipoRastreamentoDocumentoOriginario; ?> </label> <?php echo $numeroRastreamentoDocumentoOriginario; ?></td>
        <td style="border: 0;"><label>Emissão:</label> <?php echo $dataEmissaoRastreamentoDocumentoOriginario; ?></td>
        <td style="border: 0;"><label>Emitente:</label> <?php echo $emitenteRastreamentoDocumentoOriginario; ?></td>
        <td style="border: 0;"><label>Valor</label> <?php echo number_format($valorRastreamentoDocumentoOriginario, 2, ',', '.'); ?></td>
    </tr>
    <?php
}

$queryRastreamentoDocumento->execute();

while ($rowRastreamentoDocumento = $queryRastreamentoDocumento->fetch(PDO::FETCH_ASSOC)) {
    $handleRastreamentoDocumento = $rowRastreamentoDocumento['HANDLE'];
    $numeroRastreamentoDocumento = $rowRastreamentoDocumento['NUMERODOCUMENTO'];
    $tipoRastreamentoDocumento = $rowRastreamentoDocumento['TIPODOCUMENTO'];
    $dataEmissaoRastreamentoDocumento = date('d/m/Y', strtotime($rowRastreamentoDocumento['DATAEMISSAO']));
    $valorRastreamentoDocumento = $rowRastreamentoDocumento['VALORDOCUMENTO'];
    $emitenteRastreamentoDocumento = $rowRastreamentoDocumento['EMITENTE'];
    ?>
    
    <tr style="background-color: #F5F5F5;">
        <td style="border: 0; width: 10%"><label><?php echo $tipoRastreamentoDocumento; ?> </label> <?php echo $numeroRastreamentoDocumento; ?></td>
        <td style="border: 0;"><label>Emissão:</label> <?php echo $dataEmissaoRastreamentoDocumento; ?></td>
        <td style="border: 0;"><label>Emitente:</label> <?php echo $emitenteRastreamentoDocumento; ?></td>
        <td style="border: 0;"><label>Valor</label> <?php echo number_format($valorRastreamentoDocumento, 2, ',', '.'); ?></td>
    </tr>
    <?php
}