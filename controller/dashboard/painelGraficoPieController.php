<?php


$queryCampos = $connect->prepare("SELECT A.NOME
				    FROM BI_PAINELCAMPOSQL A
				   WHERE A.PAINELCOMPONENTE = '" . $handleComponente . "'
				   ORDER BY A.ORDEM ASC");
$queryCampos->execute();


while ($rowCampos = $queryCampos->fetch(PDO::FETCH_ASSOC)) {
    $arrayCampo[] = $rowCampos['NOME'];
}

$campoLabel = $arrayCampo[0];
$campoValor = $arrayCampo[1];

$queryComponente = $connect->prepare($sqlComponente);
$queryComponente->execute();

$arrayJson = array();
$arrayRow = array();

while ($rowSqlComponente = $queryComponente->fetch(PDO::FETCH_ASSOC)) {

    $inserir = true;

    for ($y = 0; $y < count($arrayJson); $y++)
    {
        if ($arrayJson[$y][$campoLabel] == $rowSqlComponente[$campoLabel])
        {
            $arrayJson[$y][$campoValor] += $rowSqlComponente[$campoValor];

            $inserir = false;
        }
    }

    if ($inserir)    
    {
        $arrayRow[$campoLabel] = $rowSqlComponente[$campoLabel];
        $arrayRow[$campoValor] = $rowSqlComponente[$campoValor];

        $arrayJson[] = $arrayRow;
    }
}
?>
<script>
var dataSource<?php echo $handleComponente; ?> = <?php echo json_encode($arrayJson, JSON_UNESCAPED_UNICODE); ?>;
    
$(function(){

    $("div#grafico<?php echo $handleComponente; ?>").dxPieChart({
        palette: "bright",
        dataSource: dataSource<?php echo $handleComponente; ?>,
        legend: {
            orientation: "horizontal",
            itemTextPosition: "bottom",
            horizontalAlignment: "center",
            verticalAlignment: "bottom",
            columnCount: 4,
			border: { visible: true }
        },
		adaptiveLayout: {
        		width: 400,
            keepLabels: false
        },
        series: [{
            argumentField: "<?php echo $campoLabel; ?>",
            valueField: "<?php echo $campoValor; ?>",
            label: {
                visible: true,
                font: {
                    size: 16
                },
                connector: {
                    visible: true,
                    width: 0.5
                },
                position: "columns",
                customizeText: function(arg) {
                    return arg.valueText + " (" + arg.percentText + ")";
                }
            }
        }]
    });
	
});

</script>
<?php
unset($queryCampos);
unset($rowCampos);
unset($campoLabel);
unset($campoValor);
unset($queryComponente);
unset($arrayJson);
unset($arrayRow);
unset($rowSqlComponente);
unset($inserir);
unset($yRow);
unset($y2);
unset($y1);
unset($label1);
unset($label2);
unset($arrayCampo);
?>