<?php
$queryIndicador = $connect->prepare("SELECT    A.HANDLE, 
											   A.EHEXIBIRTITULO, 
											   A.TITULOFIXO, 
											   A.TITULOVARIAVEL, 
											   A.FORMATACAO, 
											   A.ORDEM, 
											   A.EHEXIBIRBORDA,
											   B.SQL SQLVARIAVEL,
											   B.SQLORACLE SQLVARIAVELORACLE
					   FROM BI_PAINELINDICADOR A
						INNER JOIN MS_VARIAVEL B ON B.HANDLE = A.VALOR
				INNER JOIN BI_PAINELCOMPONENTE C ON C.HANDLE = A.PAINELCOMPONENTE
						  INNER JOIN BI_PAINEL D ON D.HANDLE = C.PAINEL
										 WHERE A.PAINELCOMPONENTE = '".$handleComponente."'
										   AND D.STATUS = 4
									  ORDER BY A.ORDEM ASC
							 ");
$queryIndicador->execute();

$queryCountIndicador = $connect->prepare("SELECT COUNT(A.HANDLE) COUNTINDICADOR  
					  		   FROM BI_PAINELINDICADOR A
					   	INNER JOIN BI_PAINELCOMPONENTE B ON B.HANDLE = A.PAINELCOMPONENTE
					   		   	  INNER JOIN BI_PAINEL C ON C.HANDLE = B.PAINEL
												 WHERE A.PAINELCOMPONENTE = '".$handleComponente."'
												   AND C.STATUS = 4
							 ");
$queryCountIndicador->execute();
$rowCountIndicador = $queryCountIndicador->fetch(PDO::FETCH_NUM);
$countIndicador = $rowCountIndicador[0]; 
//echo $countIndicador;

while($rowIndicador = $queryIndicador->fetch(PDO::FETCH_ASSOC)){
	
	$handleIndicador = $rowIndicador['HANDLE']; 
	$ehexibirtituloIndicador = $rowIndicador['EHEXIBIRTITULO']; 
	$titulofixoIndicador = $rowIndicador['TITULOFIXO'];
	$titulovariavelIndicador = $rowIndicador['TITULOVARIAVEL'];
	$formatacaoIndicador = $rowIndicador['FORMATACAO'];
	$ordemIndicador = $rowIndicador['ORDEM'];
	$ehexibirbordaIndicador = $rowIndicador['EHEXIBIRBORDA'];
	$sqlvariavelIndicadorAcento = tirarAcentos($rowIndicador['SQLVARIAVEL']);
	$sqlvariavelOracleIndicadorAcento = tirarAcentos($rowIndicador['SQLVARIAVELORACLE']);
	$sqlvariavelIndicador = parametros($sqlvariavelIndicadorAcento);
	$sqlvariavelOracleIndicador = parametros($sqlvariavelOracleIndicadorAcento);
	
	if($sqlvariavelOracleIndicador > NULL){
		$sqlIndicador = $sqlvariavelOracleIndicador;	
	}
	else{
		$sqlIndicador = $sqlvariavelIndicador;	
	}
	
	if($ehexibirbordaIndicador == 'S'){
		$thumbnail = 'thumbnail';	
	}
	else{
		$thumbnail = '';	
	}
	
	switch ($countIndicador) {
    case 1:
        $colIndicador = 'col-xs-12';
        break;
	
	case 2:
        $colIndicador = 'col-xs-6';
        break;
		
	case 3:
        $colIndicador = 'col-xs-4';
        break;
		
	case 4:
        $colIndicador = 'col-xs-3';
        break;
			
	case 5:
        $colIndicador = 'col-xs-2';
        break;
			
	case $countIndicador >= 6:
        $colIndicador = 'col-xs-2';
        break;
	}
	$queryIndicadorMarcador = $connect->prepare("SELECT A.HANDLE,  
														A.REGRA REGRACOMPARACAO, 
														A.TIPOVALOR TIPOVALORCOMPARACAO, 
														A.VALORFIXO, 
														A.VALORVARIAVEL, 
														D.SQL, 
														D.SQLORACLE, 
														E.VALORHEXADECIMAL CORFONTE, 
														F.VALORHEXADECIMAL CORFUNDO,
														A.IMAGEM
						FROM BI_PAINELINDICADORMARCADOR A  
					 LEFT JOIN BI_REGRAPAINELCOMPONENTE B ON A.REGRA = B.HANDLE 
				   	   LEFT JOIN BI_TIPOVALORCOMPARACAO C ON A.TIPOVALOR = C.HANDLE 
								  LEFT JOIN MS_VARIAVEL D ON A.VALORVARIAVEL = C.HANDLE 
									   LEFT JOIN MS_COR E ON E.HANDLE = A.CORFONTE 
									   LEFT JOIN MS_COR F ON F.HANDLE = A.CORFUNDO
						  INNER JOIN BI_PAINELINDICADOR G ON G.HANDLE = A.PAINELINDICADOR
						 INNER JOIN BI_PAINELCOMPONENTE H ON H.HANDLE = G.PAINELCOMPONENTE
								   INNER JOIN BI_PAINEL I ON I.HANDLE = H.PAINEL
												  WHERE A.PAINELINDICADOR = '".$handleIndicador."'
												    AND I.STATUS = 4
							 ");
							 
	$queryIndicadorMarcador->execute();
	
$rowIndicadorMarcador = $queryIndicadorMarcador->fetch(PDO::FETCH_ASSOC);
	
	$handleMarcador = $rowIndicadorMarcador['HANDLE'];
	$regracomparacaoMarcador = $rowIndicadorMarcador['REGRACOMPARACAO']; 
	$tipovalorcomparacaoMarcador = $rowIndicadorMarcador['TIPOVALORCOMPARACAO'];
	$valorfixoMarcador = $rowIndicadorMarcador['VALORFIXO'];
	$valorvariavelMarcador = $rowIndicadorMarcador['VALORVARIAVEL'];
	$sqlMarcadorAcento = tirarAcentos($rowIndicadorMarcador['SQL']);
	$sqloracleMarcadorAcento = tirarAcentos($rowIndicadorMarcador['SQLORACLE']);
	$sqlMarcador = parametros($sqlMarcadorAcento);
	$sqloracleMarcador = parametros($sqloracleMarcadorAcento);

	
	
	if($sqloracleMarcador > NULL){
		$sqlMarcadorExec = $sqloracleMarcador;	
	}
	else{
		$sqlMarcadorExec = $sqlMarcador;
	}
	
	
	
	
	//seleciona de valor de comparação pelo tipo
	if($tipovalorcomparacaoMarcador == '1'){//tipo 1 fixo
		$valorcomparacaoMarcador = $valorfixoMarcador;
	}
	else if($tipovalorcomparacaoMarcador == '2'){//tipo 2 variavel, executa sql da variavel para utilizar valor na comparação
		$querytipovalorcomparacaoMarcador = $connect->prepare($sqlMarcadorExec);
		$querytipovalorcomparacaoMarcador->execute();
		
		$rowtipovalorcomparacaoMarcador = $querytipovalorcomparacaoMarcador->fetch(PDO::FETCH_NUM);
		$valorcomparacaoMarcador = $rowtipovalorcomparacaoMarcador[0];
	}
	
	
$queryIndicadorMarcador->execute();
while( $rowLoopMarcador = $queryIndicadorMarcador->fetch(PDO::FETCH_ASSOC) ){
	//seleciona regras de comparação
	
		
	 	if($rowLoopMarcador['REGRACOMPARACAO'] == '1'){
			
			$regracomparacaoMarcadorValor = '!=';
			
			if($valorIndicador <= $valorcomparacaoMarcador){
				$imagemMarcador =  $rowLoopMarcador['IMAGEM'];	
				$corfonteMarcador = $rowLoopMarcador['CORFONTE'];
				$corfundoMarcador = $rowLoopMarcador['CORFUNDO'];
				
				switch($imagemMarcador){
					case 1: {
						$imagemMarcadorExibe = '<i class="fa fa-caret-up style="font-size:23px;""></i>';
					}
					case 2: {
						$imagemMarcadorExibe = '<i class="fa fa-caret-down" style="font-size:23px;"></i>';
					}
				}// end switch
				
				
			}//end if
			
		}//end if
		else if($rowLoopMarcador['REGRACOMPARACAO'] == '2'){
			$regracomparacaoMarcadorValor = '==';
			
			if($valorIndicador <= $valorcomparacaoMarcador){
				$imagemMarcador =  $rowLoopMarcador['IMAGEM'];	
				$corfonteMarcador = $rowLoopMarcador['CORFONTE'];
				$corfundoMarcador = $rowLoopMarcador['CORFUNDO'];
				
				switch($imagemMarcador){
					case 1: {
						$imagemMarcadorExibe = '<i class="fa fa-caret-up style="font-size:23px;""></i>';
					}
					case 2: {
						$imagemMarcadorExibe = '<i class="fa fa-caret-down" style="font-size:23px;"></i>';
					}
				}// end switch
				
				
			}//end if
			
		}//end else if
		else if($rowLoopMarcador['REGRACOMPARACAO'] == '3'){
			$regracomparacaoMarcadorValor = '<';
			
			if($valorIndicador <= $valorcomparacaoMarcador){
				$imagemMarcador =  $rowLoopMarcador['IMAGEM'];	
				$corfonteMarcador = $rowLoopMarcador['CORFONTE'];
				$corfundoMarcador = $rowLoopMarcador['CORFUNDO'];
				
				switch($imagemMarcador){
					case 1: {
						$imagemMarcadorExibe = '<i class="fa fa-caret-up style="font-size:23px;""></i>';
					}
					case 2: {
						$imagemMarcadorExibe = '<i class="fa fa-caret-down" style="font-size:23px;"></i>';
					}
				}// end switch
				
				
			}//end if
			
		}//end else if
		else if($rowLoopMarcador['REGRACOMPARACAO'] == '4'){
			$regracomparacaoMarcadorValor = '<=';
			if($valorIndicador <= $valorcomparacaoMarcador){
				$imagemMarcador =  $rowLoopMarcador['IMAGEM'];	
				$corfonteMarcador = $rowLoopMarcador['CORFONTE'];
				$corfundoMarcador = $rowLoopMarcador['CORFUNDO'];
				
				switch($imagemMarcador){
					case 1: {
						$imagemMarcadorExibe = '<i class="fa fa-caret-up style="font-size:23px;""></i>';
					}
					case 2: {
						$imagemMarcadorExibe = '<i class="fa fa-caret-down" style="font-size:23px;"></i>';
					}
				}// end switch
				
				
			}//end if
		}//end else if
		else if($rowLoopMarcador['REGRACOMPARACAO'] == '5'){
			$regracomparacaoMarcadorValor = '>';
			
			if($valorIndicador <= $valorcomparacaoMarcador){
				$imagemMarcador =  $rowLoopMarcador['IMAGEM'];	
				$corfonteMarcador = $rowLoopMarcador['CORFONTE'];
				$corfundoMarcador = $rowLoopMarcador['CORFUNDO'];
				
				switch($imagemMarcador){
					case 1: {
						$imagemMarcadorExibe = '<i class="fa fa-caret-up style="font-size:23px;""></i>';
					}
					case 2: {
						$imagemMarcadorExibe = '<i class="fa fa-caret-down" style="font-size:23px;"></i>';
					}
				}// end switch
				
				
			}//end if
		}//end else if
		else if($rowLoopMarcador['REGRACOMPARACAO'] == '6'){
			$regracomparacaoMarcadorValor = '>=';
			
			if($valorIndicador <= $valorcomparacaoMarcador){
				$imagemMarcador =  $rowLoopMarcador['IMAGEM'];	
				$corfonteMarcador = $rowLoopMarcador['CORFONTE'];
				$corfundoMarcador = $rowLoopMarcador['CORFUNDO'];
				
				switch($imagemMarcador){
					case 1: {
						$imagemMarcadorExibe = '<i class="fa fa-caret-up style="font-size:23px;""></i>';
					}
					case 2: {
						$imagemMarcadorExibe = '<i class="fa fa-caret-down" style="font-size:23px;"></i>';
					}
				}// end switch
				
				
			}//end if
		}//end else if
		

}


if(!isset($corfonteMarcador)){
	$corfonteMarcador = '';
}
if(!isset($corfundoMarcador)){
	$corfundoMarcador = '';
}
if(!isset($imagemMarcadorExibe)){
	$imagemMarcadorExibe = '';
}
	
	
	$queryIndicadorVariavel = $connect->prepare($sqlIndicador);
	$queryIndicadorVariavel->execute();
	
	$rowVariavel = $queryIndicadorVariavel->fetch(PDO::FETCH_NUM);
	$valorIndicador = $rowVariavel[0];

	//imprime marcadores
	if($organizarregistro == '1'){
		if($handleMarcador > ''){
			echo '<div class="'.$colIndicador.' '.$thumbnail.'">';
			
				echo $titulofixoIndicador; 
				
					echo '<p style="background-color:'.$corfundoMarcador.'; color:'.$corfonteMarcador.';">'.$imagemMarcadorExibe.' &nbsp; '.formataValores($valorIndicador).'</p>';
				
			echo '</div>';	
		}
		else{
			echo '<div class="'.$colIndicador.' '.$thumbnail.'">';
			
				echo $titulofixoIndicador; 
				echo '<p>'.formataValores($valorIndicador).'</p>';
			
			echo '</div>';		
		}
		}
	else{
		if($handleMarcador > ''){
			echo '<div class="col-xs-12'.$thumbnail.'">';
			
				echo $titulofixoIndicador; 
				
					echo '<p style="text-align: center;background-color:'.$corfundoMarcador.'; color:'.$corfonteMarcador.'; ">'.formataValores($valorIndicador).' '.$imagemMarcadorExibe.'</p>';
				
			echo '</div>';	
		}
		else{
			echo '<div class="col-sm-12'.$thumbnail.'">';
			
				echo $titulofixoIndicador; 
				echo '<p align="center">'.formataValores($valorIndicador).'</p>';
			
			echo '</div>';
		}
	}
	
}//end while

unset($queryIndicador);
unset($queryCountIndicador);
unset($rowCountIndicador);
unset($countIndicador);
unset($rowIndicador);
unset($handleIndicador);
unset($ehexibirtituloIndicador);
unset($titulovariavelIndicador);
unset($formatacaoIndicador);
unset($ordemIndicador);
unset($ehexibirbordaIndicador);
unset($sqlvariavelIndicador);
unset($sqlIndicador);
unset($thumbnail);
unset($colIndicador);
unset($queryIndicadorMarcador);
unset($rowIndicadorMarcador);
unset($handleMarcador);
unset($regracomparacaoMarcador);
unset($tipovalorcomparacaoMarcador);
unset($valorfixoMarcador);
unset($valorvariavelMarcador);
unset($sqlMarcador);
unset($sqloracleMarcador);
unset($corfonteMarcador);
unset($corfundoMarcador);
unset($imagemMarcador);
unset($sqlMarcadorExec);
unset($querytipovalorcomparacaoMarcador);
unset($valorcomparacaoMarcador);
unset($queryIndicadorVariavel);
unset($rowVariavel);
unset($valorIndicador);
unset($regracomparacaoMarcadorValor);
unset($imagemMarcadorExibe);
unset($sqlvariavelIndicadorAcento);
unset($sqlvariavelOracleIndicadorAcento);
unset($sqlMarcadorAcento);
unset($sqloracleMarcadorAcento);
?>