<?php
$viagem = null;
	$query = $connect->prepare("SELECT A.HANDLE DESPESAHANDLE, 
									   A.DATA, 
									   F.PLACA, 
									   A.STATUS, 
									   B.NUMERO VIAGEM, 
									   B.MUNICIPIOORIGEM ORIGEM, 
									   B.MUNICIPIODESTINO DESTINO, 
									   C.NOME ROTA,
									   D.NOME DESPESA, 
									   E.NOME MOTORISTA,
									   A.STATUS STATUSDESPESA
				 FROM OP_VIAGEMDESPESA A
				  INNER JOIN OP_VIAGEM B
									ON B.HANDLE = A.VIAGEM
					FULL JOIN OP_ROTA C
									ON C.HANDLE = B.ROTA
					FULL JOIN MT_ITEM D
									ON D.HANDLE = A.DESPESA
				  FULL JOIN MS_PESSOA E
									ON E.HANDLE = B.MOTORISTA
						    FULL JOIN MF_VEICULO F
									ON F.HANDLE = B.VEICULO
								 WHERE B.EMPRESA = '".$empresa."'
								   AND B.MOTORISTA = '".$pessoa."'
								   AND B.STATUS <> 6
								   AND B.STATUS <> 7	
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
			
			if($despesa > null){
				$despesaExibe = "Despesa: ".$despesa;	
			}
			else{
				$despesaExibe = "";	
			}
			if($viagem > null){
				$viagemExibe = " - Viagem: ".$viagem;	
			}
			else{
				$viagemExibe = "";	
			}
			if($placa > null){
				$placaExibe = " - Placa: ".$placa;	
			}
			else{
				$placaExibe = "";	
			}
			if($rota > null){
				$rotaExibe = " - Rota: ".$rota;	
			}
			else{
				$rotaExibe = "";	
			}
			if($origemNome > null){
				$origemExibe = " - Origem: ".$origemNome.'  '.$estadoOrigem;	
			}
			else{
				$origemExibe = "";	
			}
			if($destinoNome > null){
				$destinoExibe = " - Destino: ".$destinoNome.'  '.$estadoDestino;	
			}
			else{
				$destinoExibe = "";	
			}
			if($data > null){
				$dataExibe = " - Data: ".$data;	
			}
			else{
				$dataExibe = "";	
			}						
?>
    			<tr>
                  <td hidden="true"><input type="radio" name="check[]" hidden="true" class="check" id="check" value="<?php echo $statusDespesa.'-'.$despesaHandle; ?>"></td>
				  <td width="1%"><?php echo $statusIcone; ?></td>
                  <td class="desktopHide">
                  <?php echo $despesaExibe.$viagemExibe.$placaExibe.$rotaExibe.$origemExibe.$destinoExibe.$dataExibe; ?>
                  </td>
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