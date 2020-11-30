<?php
$viagem = null;
	$query = $connect->prepare("
								 ");
								 //AND A.MOTORISTA = '".$pessoa."'
	$query->execute();
		while($row = $query->fetch(PDO::FETCH_ASSOC)){
			
			$viagem = $row['VIAGEM'];
			$origem = $row['ORIGEM'];
			$destino = $row['DESTINO'];
			$placa = $row['PLACA'];
			$status = $row['STATUS'];
			$rota = $row['ROTA'];
			$despesa = $row['DESPESA'];
			$statusDespesa = $row['STATUSDESPESA'];
			$data = date('d/m/Y H:i', strtotime($row['DATA']));
			$despesaHandle = $row['DESPESAHANDLE'];
			
			
	$queryOrigem = $connect->prepare("SELECT A.NOME ORIGEM, B.SIGLA ESTADO
									    FROM MS_MUNICIPIO A
								  INNER JOIN MS_ESTADO B
									      ON A.ESTADO = B.HANDLE
									   WHERE A.HANDLE = '".$origem."'
								 ");
								   
	$queryOrigem->execute();
	
		$rowOrigem = $queryOrigem->fetch(PDO::FETCH_ASSOC);
		$origemNome = $rowOrigem['ORIGEM'];
		$estadoOrigem = $rowOrigem['ESTADO'];
		
	
	$queryDestino= $connect->prepare("SELECT A.NOME DESTINO, B.SIGLA ESTADO
									    FROM MS_MUNICIPIO A
									    INNER JOIN MS_ESTADO B
									    ON A.ESTADO = B.HANDLE
									   WHERE A.HANDLE = '".$destino."'
								 ");
								   
	$queryDestino->execute();
	
		$rowDestino = $queryDestino->fetch(PDO::FETCH_ASSOC);
		$destinoNome = $rowDestino['DESTINO'];
		$estadoDestino = $rowDestino['ESTADO'];
		
			if($status == '1'){
				$statusIcone = "<img src='../../view/tecnologia/img/status/cinza/vazio.png' width='13px' height='auto'>";	
			}
			if($status == '2'){
				$statusIcone = "<img src='../../view/tecnologia/img/status/vermelho/x.png' width='13px' height='auto'>";	
			}
			if($status == '3'){
				$statusIcone = "<img src='../../view/tecnologia/img/status/verde/ok.png' width='13px' height='auto'>";	
			}
			if($status == '4'){
				$statusIcone = "<img src='../../view/tecnologia/img/status/amarelo/exclamacao.png' width='13px' height='auto'>";	
			}
			if($status == '5'){
				$statusIcone = "<img src='../../view/tecnologia/img/status/azul/interrogacao.png' width='13px' height='auto'>";	
			}
			if($status == '6'){
				$statusIcone = "<img src='../../view/tecnologia/img/status/vermelho/ponto.png' width='13px' height='auto'>";	
			}
			if($status == '7'){
				$statusIcone = "<img src='../../view/tecnologia/img/status/azul/seta_direita.png' width='13px' height='auto'>";	
			}

									
?>
    			 <tr>
                  <td hidden="true"><input type="radio" name="check[]" hidden="true" class="check" id="check" value="<?php echo $statusDespesa.'-'.$despesaHandle; ?>"></td>
				  <td width="1%"><?php echo $statusIcone; ?></td>
                  <td>
                  Despesa: <?php echo $despesa; ?> - Viagem: <?php echo $viagem; ?> -  Placa: <?php echo $placa; ?>
                  <br>
                  Origem: <?php echo $origemNome.'  '.$estadoOrigem; ?> -  Destino: <?php echo $destinoNome.'  '.$estadoDestino; ?>
                   - Rota: <?php echo $rota; ?>
                  </td>
      			  <td width="12%"><?php echo $data; ?></td>
    			</tr>
<?php
		}
?>
<?php
if(@$viagem <= '' or @$viagem == null){
?>
     <div class="col-md-12">
     	<div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
  		<span aria-hidden="true">&times;</span>
		</button>
     		<strong>Atenção: </strong> Não encontramos registros a serem exibidos!
     	</div>
     </div>
<?php
}
?>