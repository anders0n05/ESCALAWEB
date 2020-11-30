<?php
		$OcorrenciaTransporte = null;
		$numeroOcorrenciaTransporte  = null;
		$filialOcorrenciaTransporte  = null;
		$dataOcorrenciaTransporte  = null;
		$statusOcorrenciaTransporte = null;
		$tipoOcorrenciaTransporte = null;



$queryOcorrenciaTransporte->execute();
while($rowOcorrenciaTransporte = $queryOcorrenciaTransporte->fetch(PDO::FETCH_ASSOC)){
		
		$OcorrenciaTransporte = $rowOcorrenciaTransporte['HANDLE']; 
		$numeroOcorrenciaTransporte  = $rowOcorrenciaTransporte['NUMERO'];
		$filialOcorrenciaTransporte  = $rowOcorrenciaTransporte['FILIAL'];
		$dataOcorrenciaTransporte  = date('d/m/Y H:i', strtotime($rowOcorrenciaTransporte['DATA'])); 
		$statusOcorrenciaTransporte = $rowOcorrenciaTransporte['STATUS'];
		$tipoOcorrenciaTransporte = $rowOcorrenciaTransporte['TIPO'];
		
		if($statusOcorrenciaTransporte == '1'){
			$statusOcorrenciaTransporteIcone = "<img src='../../view/tecnologia/img/status/cinza/vazio.png' width='13px' height='auto'>";	
		}
		if($statusOcorrenciaTransporte == '2'){
			$statusOcorrenciaTransporteIcone = "<img src='../../view/tecnologia/img/status/amarelo/exclamacao.png' width='13px' height='auto'>";	
		}
		if($statusOcorrenciaTransporte == '3'){
			$statusOcorrenciaTransporteIcone = "<img src='../../view/tecnologia/img/status/azul/interrogacao.png' width='13px' height='auto'>";	
		}
		if($statusOcorrenciaTransporte == '4'){
			$statusOcorrenciaTransporteIcone = "<img src='../../view/tecnologia/img/status/verde/ok.png' width='13px' height='auto'>";	
		}
		if($statusOcorrenciaTransporte == '5'){
			$statusOcorrenciaTransporteIcone = "<img src='../../view/tecnologia/img/status/vermelho/x.png' width='13px' height='auto'>";	
		}
		if($statusOcorrenciaTransporte == '6'){
			$statusOcorrenciaTransporteIcone = "<img src='../../view/tecnologia/img/status/azul/seta_direita.png' width='13px' height='auto'>";	
		}
		if($statusOcorrenciaTransporte == '7'){
			$statusOcorrenciaTransporteIcone = "<img src='../../view/tecnologia/img/status/azul/seta_esquerda.png' width='13px' height='auto'>";	
		}
?>
                    <tr>

                    <tr data-toggle="modal" data-target="#ocorrenciaModal" handle="<?php echo $OcorrenciaTransporte?>">
                      <td hidden="true"><input type="radio" name="check[]" hidden="true" class="check" id="check" value="<?php echo $statusOcorrenciaTransporte.'-'.$OcorrenciaTransporte; ?>"></td>
				  	  <td width="1%"><?php echo $statusOcorrenciaTransporteIcone; ?></td>
                      <td><?php echo $numeroOcorrenciaTransporte; ?></td>
                      <td><?php echo $filialOcorrenciaTransporte; ?></td>
                      <td><?php echo $dataOcorrenciaTransporte; ?></td>
                      <td><?php echo $tipoOcorrenciaTransporte; ?></td>
                    </tr>
<?php
	}
?>