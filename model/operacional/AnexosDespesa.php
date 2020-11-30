<tbody>
<?php
$query = $connect->prepare("SELECT A.HANDLE, 
								   A.DATA, 
								   A.ASSUNTO NOME, 
								   A.ARQUIVO
		FROM OP_VIAGEMDESPESAANEXO A
							 WHERE A.VIAGEMDESPESA = '".$despesaHandle."'
							");
								   
	$query->execute();
	
		while($row = $query->fetch(PDO::FETCH_ASSOC)){
			
			$AnexoHandle = $row['HANDLE'];
			$AnexoData = date('d/m/Y H:i:s', strtotime($row['DATA']));
			$AnexoNome = $row['NOME'];
			$AnexoArquivo = $row['ARQUIVO'];
?>
	<tr>
    	<td hidden="true"><input type="radio" name="check[]" hidden="true" class="check" id="check" value="<?php echo $AnexoHandle.'-'.$despesaHandle; ?>"></td>
		<td><?php echo $AnexoNome; ?></td>
		<td width="10%"><?php echo $AnexoData; ?></td>
	</tr>
<?php
		}
?>
</tbody>