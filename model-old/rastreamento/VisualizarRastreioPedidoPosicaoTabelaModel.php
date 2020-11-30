<?php
$Posicao = null;
$veiculoPosicao = null;
$viagemPosicao = null;
$dataPosicao = null;
$latitudePosicao = null;
$longitudePosicao = null;
$localizacaoPosicao = null;
/*
  $queryPosicao = $connect->prepare("SELECT A.HANDLE,
  A.DATA,
  B.PLACA VEICULO,
  C.NUMERO VIAGEM,
  A.LOCALIZACAO,
  A.LATITUDE,
  A.LONGITUDE
  FROM OP_POSICAOVEICULO A
  LEFT JOIN MF_VEICULO B ON A.VEICULO = B.HANDLE
  LEFT JOIN OP_VIAGEM C ON A.VIAGEM = C.HANDLE
  WHERE EXISTS(SELECT X.HANDLE
  FROM RA_PEDIDODOCUMENTO X
  INNER JOIN GD_DOCUMENTO  X1 ON X1.HANDLE = X.DOCUMENTO
  INNER JOIN OP_VIAGEMROMANEIOITEM X2 ON X2.DOCUMENTOTRANSPORTE = X1.DOCUMENTOTRANSPORTE
  WHERE X.PEDIDO = '" . $pedidoRastreamento . "'
  AND X2.VIAGEM = A.VIAGEM)
  ORDER BY  A.HANDLE ASC
  ");
 */
$queryPosicao->execute();

while ($rowPosicao = $queryPosicao->fetch(PDO::FETCH_ASSOC)) {

    $Posicao = $rowPosicao['HANDLE'];
    $veiculoPosicao = $rowPosicao['VEICULO'];
    $viagemPosicao = $rowPosicao['VIAGEM'];
    $dataPosicao = date('d/m/Y H:i', strtotime($rowPosicao['DATA']));
    $latitudePosicao = $rowPosicao['LATITUDE'];
    $longitudePosicao = $rowPosicao['LONGITUDE'];
    $localizacaoPosicao = $rowPosicao['LOCALIZACAO'];
    ?>
    <tr>
        <td hidden="true"><input type="radio" name="check[]" hidden="true" class="check" id="check" value="<?php echo $Posicao . '-' . $Posicao; ?>"></td>
        <td>
            Data: <?php echo $dataPosicao; ?> - Veículo: <?php echo $veiculoPosicao; ?> - Viagem: <?php echo $viagemPosicao; ?> - Localização: <?php echo $localizacaoPosicao; ?>
        </td>
    </tr>
    <?php
}
?>