<?php
$queryMedidor = $connect->prepare("SELECT  A.HANDLE, 
										   A.EHDESTACAR, 
										   A.EHEXIBIRBORDA, 
										   A.EHEXIBIRESCALADEVALOR, 
										   A.EHEXIBIRTITULO, 
										   A.TITULOFIXO, 
										   A.TITULOVARIAVEL, 
										   A.FORMATACAO,
										   A.ORDEM, 
										   A.VALOR, 
										   A.VALORINICIAL, 
										   A.VALORFINAL, 
										   D.SQL, 
										   D.SQLORACLE, 
										   D.CASASDECIMAIS,
										   B.TIPOMEDIDOR
					 FROM BI_PAINELMEDIDOR A
			INNER JOIN BI_PAINELCOMPONENTE B ON B.HANDLE = A.PAINELCOMPONENTE
					  INNER JOIN BI_PAINEL C ON C.HANDLE = B.PAINEL 
					INNER JOIN MS_VARIAVEL D ON D.HANDLE = A.VALOR
									 WHERE A.PAINELCOMPONENTE = '".$handleComponente."'
									   AND A.STATUS = 1
									   AND B.STATUS = 2
									   AND C.STATUS = 4
								  ORDER BY A.ORDEM ASC
								");
$queryMedidor->execute();

$queryCountMedidor = $connect->prepare("SELECT COUNT(A.HANDLE)
							   FROM BI_PAINELMEDIDOR A
					  INNER JOIN BI_PAINELCOMPONENTE B ON B.HANDLE = A.PAINELCOMPONENTE
								INNER JOIN BI_PAINEL C ON C.HANDLE = B.PAINEL 
											   WHERE A.PAINELCOMPONENTE = '".$handleComponente."'
												 AND A.STATUS = 1
												 AND B.STATUS = 2
												 AND C.STATUS = 4
							 		   ");
$queryCountMedidor->execute();
$rowCountMedidor = $queryCountMedidor->fetch(PDO::FETCH_NUM);
$countMedidor = $rowCountMedidor[0]; 



while($rowMedidor = $queryMedidor->fetch(PDO::FETCH_ASSOC)){
	
	$handleMedidor = $rowMedidor['HANDLE']; 
	$ehdestacarMedidor = $rowMedidor['EHDESTACAR'];  
	$ehexibirbordaMedidor = $rowMedidor['EHEXIBIRBORDA']; 
	$ehexibirescaladevalorMedidor = $rowMedidor['EHEXIBIRESCALADEVALOR']; 
	$ehexibirtituloMedidor = $rowMedidor['EHEXIBIRTITULO']; 
	$titulofixoMedidor = $rowMedidor['TITULOFIXO']; 
	$titulovariavelMedidor = $rowMedidor['TITULOVARIAVEL']; 
	$formatacaoMedidor = $rowMedidor['FORMATACAO'];
	$valorinicialMedidor = $rowMedidor['VALORINICIAL']; 
	$valorfinalMedidor = $rowMedidor['VALORFINAL']; 
	$sqlVariavelMedidorAcento = tirarAcentos($rowMedidor['SQL']); 
	$sqlVariavelOracleMedidorAcento = tirarAcentos($rowMedidor['SQLORACLE']); 
	$sqlVariavelMedidor = parametros($sqlVariavelMedidorAcento); 
	$sqlVariavelOracleMedidor = parametros($sqlVariavelOracleMedidorAcento); 
	$casasdecimaisMedidor = $rowMedidor['CASASDECIMAIS'];
	$tipomedidor = $rowMedidor['TIPOMEDIDOR'];
	//echo $handleMedidor;
	//identifica sql a executar
	if($sqlVariavelOracleMedidor > NULL){
		$sqlMedidor = $sqlVariavelOracleMedidor;	
	}
	else{
		$sqlMedidor = $sqlVariavelMedidor;	
	}
	
	//exibir borda s ou n
	if($ehexibirbordaMedidor == 'S'){
		$thumbnail = 'thumbnail';	
	}
	else{
		$thumbnail = '';	
	}
	
	//seleciona titulo variavel se existir
	if($titulovariavelMedidor > NULL){
		$querySQLTituloMedidor = $connect->prepare("SELECT SQL, SQLORACLE FROM MS_VARIAVEL WHERE HANDLE = '".$titulovariavelMedidor."'");
		$querySQLTituloMedidor->execute();
		$rowSQLTituloMedidor = $querySQLTituloMedidor->fetch(PDO::FETCH_ASSOC);
		$SQLVariaveltituloMedidorAcento = tirarAcentos($SQLrowTituloMedidor['SQL']); 
		$SQLORACLEVariaveltituloMedidorAcento = tirarAcentos($SQLrowTituloMedidor['SQLORACLE']); 
		$SQLVariaveltituloMedidor = parametros($SQLVariaveltituloMedidorAcento); 
		$SQLORACLEVariaveltituloMedidor = parametros($SQLORACLEVariaveltituloMedidorAcento); 
		
		if($SQLORACLEVariaveltituloMedidor > NULL){
			$sqlTituloMedidor = $SQLORACLEVariaveltituloMedidor;	
		}
		else{
			$sqlTituloMedidor = $SQLVariaveltituloMedidor;	
		}
		
		$queryTituloMedidor = $connect->prepare($sqlTituloMedidor);
		$queryTituloMedidor->execute();
		$rowTituloMedidor = $queryTituloMedidor->fetch(PDO::FETCH_ASSOC);
		$titulomedidor = $rowTituloMedidor[0];
	}
	else{
		$titulomedidor = $titulofixoMedidor;	
	}
	
	//define colunas
	switch ($countMedidor) {
    case 1:
        $col = 'col-xs-12';
        break;
	
	case 2:
        $col = 'col-xs-6';
        break;
		
	case 3:
        $col = 'col-xs-4';
        break;
		
	case 4:
        $col = 'col-xs-3';
        break;
			
	case 5:
        $col = 'col-xs-2';
        break;
			
	case $countIndicador >= 6:
        $col = 'col-xs-2';
        break;
	}

//exec sql variavel do medidor
$queryMedidorVariavel = $connect->prepare($sqlMedidor);
$queryMedidorVariavel->execute();
$rowMedidorVariavel = $queryMedidorVariavel->fetch(PDO::FETCH_NUM);
$valorVariavelMedidor = $rowMedidorVariavel[0]; 


$queryMedidorGrupo = $connect->prepare("SELECT  A.HANDLE, 
												A.VALORINICIAL, 
												A.VALORFINAL, 
												A.TITULO NOMECOR, 
												B.VALORHEXADECIMAL  
					 FROM BI_PAINELMEDIDORGRUPO A  
							   LEFT JOIN MS_COR B ON A.COR = B.HANDLE 
										  WHERE A.PAINELMEDIDOR = '".$handleMedidor."'
									  ORDER BY  A.VALORINICIAL ASC
										");
$queryMedidorGrupo->execute();

if($tipomedidor == '1'){
	
if($organizarregistro == '1'){
	echo "<div class='$col $thumbnail'>";
	echo "<p> $titulomedidor </p>";
	echo "<div id='medidor$handleMedidor' class='chart-gauge'></div>";
	echo "</div>";
}
else{
	echo "<div class='col-md-12 $thumbnail'>";
	echo "<p> $titulomedidor </p>";
	echo "<div id='medidor$handleMedidor' class='chart-gauge'></div>";
	echo "</div>";	
}

?>

<script>
document.addEventListener("DOMContentLoaded", function(event) {

    var dflt = {
      min: <?php echo $valorinicialMedidor; ?>,
      max: <?php echo $valorfinalMedidor; ?>,
      label: "<?php echo number_format($valorinicialMedidor, '0', '', ' ').' - '.number_format($valorfinalMedidor, '0', '', ' '); ?>",
      donut: true,
      relativeGaugeSize: true,
      counter: true,
      hideInnerShadow: true
    }
		  
		  
      var g2 = new JustGage({
        id: "medidor<?php echo $handleMedidor; ?>",
        value: <?php echo $valorVariavelMedidor; ?>,
        
        symbol: '%',
        pointer: true,
        pointerOptions: {
          toplength: -15,
          bottomlength: 10,
          bottomwidth: 12,
          color: '#8e8e93',
          stroke: '#ffffff',
          stroke_width: 3,
          stroke_linecap: 'round'
        },
        levelColors: 
		 <?php
		 echo "[";
		while($rowMedidorGrupo = $queryMedidorGrupo->fetch(PDO::FETCH_ASSOC)){
			$valorhexadecimal = $rowMedidorGrupo['VALORHEXADECIMAL'];
			echo "'".$valorhexadecimal."',";
		}
		echo "]";
		?>,
		defaults: dflt
      });

    });
</script>

<?php
}//tipomedidor 1


if($tipomedidor == '2'){
	
if($organizarregistro == '1'){
	echo "<div class='$col $thumbnail'>";
	echo "<p> $titulomedidor </p>";
	echo "<div id='medidor$handleMedidor' class='chart-gauge'></div><div style='padding:2em;'>".number_format($valorVariavelMedidor, '0', '', ' ')."%</div>";
	echo "</div>";
}
else{
	echo "<div class='col-md-12 $thumbnail'>";
	echo "<p> $titulomedidor </p>";
	echo "<div id='medidor$handleMedidor'></div>";
	echo "</div>";	
}

?>

<script>
 $(function(){
    $("div#medidor<?php echo $handleMedidor; ?>").dxLinearGauge({
		geometry: { orientation: "vertical" },
        scale: {
            startValue: <?php echo $valorinicialMedidor; ?>, 
    		endValue: <?php echo $valorfinalMedidor; ?>,
            
        },
        rangeContainer: {
            offset: 10,
            ranges: [
			 <?php
		 
		while($rowMedidorGrupo = $queryMedidorGrupo->fetch(PDO::FETCH_ASSOC)){
			echo "{";
			$valorhexadecimal = $rowMedidorGrupo['VALORHEXADECIMAL'];
			$valorInicialMarcador = $rowMedidorGrupo['VALORINICIAL'];
			$valorFinallMarcador = $rowMedidorGrupo['VALORFINAL'];
			echo "startValue: ".$valorInicialMarcador.", endValue: ".$valorFinallMarcador.", color: '".$valorhexadecimal."'";
			echo "},";
		}
		
		?>
            ]
        },
        valueIndicator: {
            offset: 20
        },
        subvalueIndicator: {
            offset: -15
        },
        subvalues: [<?php echo $valorVariavelMedidor; ?>]
    });
});
</script>

<?php
}//tipomedidor 2


if($tipomedidor == '3'){
	
	
	if($organizarregistro == '1'){
	echo "<div class='$col $thumbnail'>";
	echo "<p> $titulomedidor </p>";
	echo "<div id='medidor$handleMedidor' class='chart-gauge'></div> <div>".number_format($valorVariavelMedidor, '0', '', ' ')."%</div>";
	echo "</div>";
}
else{
	echo "<div class='col-xs-12 $thumbnail'>";
	echo "<p> $titulomedidor </p>";
	echo "<div id='medidor$handleMedidor'></div>";
	echo "</div>";	
}

?>

<script>
 $(function(){
    $("div#medidor<?php echo $handleMedidor; ?>").dxLinearGauge({
        scale: {
            startValue: <?php echo $valorinicialMedidor; ?>, 
    		endValue: <?php echo $valorfinalMedidor; ?>,
            
        },
        rangeContainer: {
            offset: 10,
            ranges: [
			 <?php
		 
		while($rowMedidorGrupo = $queryMedidorGrupo->fetch(PDO::FETCH_ASSOC)){
			echo "{";
			$valorhexadecimal = $rowMedidorGrupo['VALORHEXADECIMAL'];
			$valorInicialMarcador = $rowMedidorGrupo['VALORINICIAL'];
			$valorFinallMarcador = $rowMedidorGrupo['VALORFINAL'];
			echo "startValue: ".$valorInicialMarcador.", endValue: ".$valorFinallMarcador.", color: '".$valorhexadecimal."'";
			echo "},";
		}
		
		?>
            ]
        },
        valueIndicator: {
            offset: 20
        },
        subvalueIndicator: {
            offset: -15
        },
        subvalues: [<?php echo $valorVariavelMedidor; ?>]
    });
});
</script>

<?php
}//tipomedidor 3

if($tipomedidor == '4'){

if($organizarregistro == '1'){
	echo "<div class='$col $thumbnail'>";
	echo "<p> $titulomedidor </p>";
	echo "<div id='medidor$handleMedidor' class='chart-gauge'></div>";
	echo "</div>";
}
else{
	echo "<div class='col-md-12 $thumbnail'>";
	echo "<p> $titulomedidor </p>";
	echo "<div id='medidor$handleMedidor' class='chart-gauge'></div>";
	echo "</div>";	
}

?>

<script>
document.addEventListener("DOMContentLoaded", function(event) {

    
		  
		  
      var g2 = new JustGage({
        id: "medidor<?php echo $handleMedidor; ?>",
        value: <?php echo $valorVariavelMedidor; ?>,
        min: <?php echo $valorinicialMedidor; ?>,
        max: <?php echo $valorfinalMedidor; ?>,
        symbol: '%',
        pointer: true,
        pointerOptions: {
          toplength: -15,
          bottomlength: 10,
          bottomwidth: 12,
          color: '#8e8e93',
          stroke: '#ffffff',
          stroke_width: 3,
          stroke_linecap: 'round'
        },
        levelColors: 
		 <?php
		 echo "[";
		while($rowMedidorGrupo = $queryMedidorGrupo->fetch(PDO::FETCH_ASSOC)){
			$valorhexadecimal = $rowMedidorGrupo['VALORHEXADECIMAL'];
			echo "'".$valorhexadecimal."',";
		}
		echo "]";
		?>,
		relativeGaugeSize: true,
        counter: true
      });

    });
</script>

<?php
}//tipomedidor 4

}// end while


unset($queryMedidor);
unset($queryCountMedidor);
unset($rowCountMedidor);
unset($countMedidor);
unset($rowMedidor);
unset($handleMedidor);
unset($ehdestacarMedidor);
unset($ehexibirbordaMedidor);
unset($ehexibirescaladevalorMedidor);
unset($ehexibirtituloMedidor);
unset($titulofixoMedidor);
unset($titulovariavelMedidor);
unset($formatacaoMedidor);
unset($valorinicialMedidor);
unset($valorfinalMedidor);
unset($sqlVariavelMedidor);
unset($sqlVariavelOracleMedidor);
unset($casasdecimaisMedidor);
unset($tipomedidor);
unset($sqlMedidor);
unset($querySQLTituloMedidor);
unset($rowSQLTituloMedidor);
unset($SQLVariaveltituloMedidor);
unset($SQLORACLEVariaveltituloMedidor);
unset($sqlTituloMedidor);
unset($queryTituloMedidor);
unset($rowTituloMedidor);
unset($titulomedidor);
unset($col);
unset($queryMedidorVariavel);
unset($rowMedidorVariavel);
unset($valorVariavelMedidor);
unset($queryMedidorGrupo);
unset($sqlVariavelMedidorAcento);
unset($sqlVariavelOracleMedidorAcento);
unset($SQLVariaveltituloMedidorAcento);
unset($SQLORACLEVariaveltituloMedidorAcento);
?>
