<tbody>
<?php
$query = $connect->prepare("SELECT  A.HANDLE, 
									A.DATA, 
									A.DESCRICAO NOME ,
									A.ARQUIVO
			FROM OP_OCORRENCIAANEXO A  
							  WHERE A.OCORRENCIA = '".$ocorrenciaHandle."'
						  ORDER BY  A.NOME ASC
							");
								   
	$query->execute();
	
		while($row = $query->fetch(PDO::FETCH_ASSOC)){
			
			$AnexoHandle = $row['HANDLE'];
			$AnexoData = date('d/m/Y H:i:s', strtotime($row['DATA']));
			$AnexoNomeExplode = explode('.', $row['NOME']);
			$AnexoArquivo = $row['ARQUIVO'];
?>
	<tr>
    	<td hidden="true"><input type="radio" name="check[]" hidden="true" class="check" id="check" value="<?php echo $AnexoHandle.'-'.$ocorrenciaHandle; ?>"></td>
		<td><?php echo $AnexoNomeExplode[0]; ?></td>
		<td width="10%"><?php echo $AnexoData; ?></td>
	</tr>
<?php
		}
?>
</tbody>