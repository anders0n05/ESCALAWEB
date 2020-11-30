<?php

		$Documento = null;
		$numeroDocumento  = null;
		$tipoDocumento  = null;
		$valorLiquidoDocumento = '0,00';	
		$filialDocumento  = null;
		$emissaoDocumento  = null;
		$pessoaDocumento  = null;
		$statusDocumento = null;
		
$queryDocumento->execute();
while($rowDocumento = $queryDocumento->fetch(PDO::FETCH_ASSOC)){
		
		$Documento = $rowDocumento['HANDLE']; 
		$numeroDocumento  = $rowDocumento['NUMERO'];
		$tipoDocumento  = $rowDocumento['TIPO'];
		$valorLiquidoDocumento  = number_format($rowDocumento['VALORLIQUIDO'], 2, ',', '.');
	
		if($valorLiquidoDocumento == null){
			$valorLiquidoDocumento = '0,00';	
		}
	
		$filialDocumento  = $rowDocumento['FILIAL'];
		$emissaoDocumento  = date('d/m/Y H:i', strtotime($rowDocumento['DATAEMISSAO'])); 
		$pessoaDocumento  = $rowDocumento['PESSOA'];
		$statusDocumento = $rowDocumento['STATUSDOCUMENTO'];
	
	    /*$pesoDocumento = $rowDocumento['PESODOCUMENTO'];
		$volumesDocumento = $rowDocumento['VOLUMESDOCUMENTO'];*/
		
		$queryDocumentoIntegracao = $connect->prepare(" SELECT A.HANDLE
														FROM GD_DOCUMENTOINTEGRACAO A
														WHERE A.PROCESSO = 6
														AND A.DOCUMENTO = '".$Documento."'
													  ");
		$queryDocumentoIntegracao->execute();
	
		$rowDocumentoIntegracao = $queryDocumentoIntegracao->fetch(PDO::FETCH_ASSOC);
		
		$handleDocumentoIntegracao = $rowDocumentoIntegracao['HANDLE'];
	
	
	
	
		if($statusDocumento == '1'){
			$statusDocumentoIcone = "<img src='../../view/tecnologia/img/status/cinza/vazio.png' width='13px' height='auto'>";	
		}
		if($statusDocumento == '2'){
			$statusDocumentoIcone = "<img src='../../view/tecnologia/img/status/amarelo/exclamacao.png' width='13px' height='auto'>";	
		}
		if($statusDocumento == '3'){
			$statusDocumentoIcone = "<img src='../../view/tecnologia/img/status/azul/interrogacao.png' width='13px' height='auto'>";	
		}
		if($statusDocumento == '4'){
			$statusDocumentoIcone = "<img src='../../view/tecnologia/img/status/azul/sustenido.png' width='13px' height='auto'>";	
		}
		if($statusDocumento == '5'){
			$statusDocumentoIcone = "<img src='../../view/tecnologia/img/status/verde/ok.png' width='13px' height='auto'>";	
		}
		if($statusDocumento == '6'){
			$statusDocumentoIcone = "<img src='../../view/tecnologia/img/status/preto/vazio.png' width='13px' height='auto'>";	
		}
		if($statusDocumento == '7'){
			$statusDocumentoIcone = "<img src='../../view/tecnologia/img/status/vermelho/x.png' width='13px' height='auto'>";	
		}
		if($statusDocumento == '8'){
			$statusDocumentoIcone = "<img src='../../view/tecnologia/img/status/vermelho/vazio.png' width='13px' height='auto'>";	
		}
		if($statusDocumento == '9'){
			$statusDocumentoIcone = "<img src='../../view/tecnologia/img/status/preto/vazio.png' width='13px' height='auto'>";	
		}
?>
					<tr>
                      <td hidden="true"><input type="radio" name="checkDocumento[]" hidden="true" class="check" id="checkDocumento" value="<?php echo $Documento.'-'.$handleDocumentoIntegracao; ?>"></td>
				  	  <td width="1%"><?php echo $statusDocumentoIcone; ?></td>
                      <td><?php echo $numeroDocumento; ?></td>
                      <td><?php echo $tipoDocumento; ?></td>
                      <td><?php echo $filialDocumento; ?></td>
                      <td><?php echo $emissaoDocumento; ?></td>
                      <td><?php echo $pessoaDocumento; ?></td>
                      <td><?php echo $valorLiquidoDocumento; ?></td>
                    </tr>
<?php
		}
?>