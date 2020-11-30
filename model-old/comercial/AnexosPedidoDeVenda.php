<tbody>
<?php
$queryAnexoPedido = $connect->prepare(" SELECT  A.HANDLE HANDLE, 
										A.DATA DATA, 
										A.ASSUNTO NOME
										FROM VE_ORDEMANEXO A  
										LEFT JOIN MS_USUARIO B0 ON A.RECURSO = B0.HANDLE 
										WHERE A.ORDEM = '".$handlePedidoDeVenda."'
										ORDER BY A.DATA DESC 
										");
								   
	$queryAnexoPedido->execute();
	
		while($rowAnexoPedido = $queryAnexoPedido->fetch(PDO::FETCH_ASSOC)){
			
			$AnexoHandle = $rowAnexoPedido['HANDLE'];
			$AnexoData = date('d/m/Y H:i:s', strtotime($rowAnexoPedido['DATA']));
			$AnexoNome = $rowAnexoPedido['NOME'];
?>
	<tr>
    	<td hidden="true"><input type="radio" name="check[]" hidden="true" class="check" id="check" value="<?php echo $AnexoHandle.'-'.$handlePedidoDeVenda; ?>"></td>
		<td><?php echo $AnexoNome; ?></td>
		<td width="10%"><?php echo $AnexoData; ?></td>
	</tr>
<?php
		}
?>
</tbody>