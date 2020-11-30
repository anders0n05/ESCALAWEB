<?php
date_default_timezone_set('America/Sao_Paulo');
$viagem = null;
		
		$dataInicio = strtotime(Sistema::getPost('dataInicio'));
		$dataInicioFormat = ($dataInicio === false) ? '0000-00-00 00:00' : date('Y-m-d H:i', $dataInicio);
		$dataInicioFormatExibe= ($dataInicio === false) ? '00-00-0000 00:00' : date('d/m/Y H:i', $dataInicio);
		$dataFinal = strtotime(Sistema::getPost('dataFinal'));
		$dataFinalFormat = ($dataFinal === false) ? '0000-00-00 00:00' : date('Y-m-d H:i', $dataFinal);
		$dataFinalFormatExibe = ($dataFinal === false) ? '00-00-0000 00:00' : date('d/m/Y H:i', $dataFinal);


if($dataInicio > null and $dataFinal > null){
$whereData = "AND A.DATA >=  '$dataInicioFormat' AND A.DATA < '$dataFinalFormat'";			
}
else if($dataFinal > null and $dataInicio <= null){
$whereData = "AND CONVERT(VARCHAR(25), A.DATA, 126) LIKE '$dataFinalFormat%'";	
}
else if($dataFinal <= null and $dataInicio > null){
$whereData = "AND CONVERT(VARCHAR(25), A.DATA, 126) LIKE '$dataInicioFormat%'";	
}
else{
$whereData = ' ';	
}
		
	
  						   $query = "SELECT A.HANDLE DESPESAHANDLE, 
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
					INNER JOIN MT_ITEM D
									ON D.HANDLE = A.DESPESA
				  INNER JOIN MS_PESSOA E
									ON E.HANDLE = B.MOTORISTA
						    INNER JOIN MF_VEICULO F
									ON F.HANDLE = B.VEICULO
								 WHERE B.EMPRESA = '".$empresa."'
								   AND B.MOTORISTA = '".$pessoa."'
								   AND B.STATUS <> 6
								   AND B.STATUS <> 7
								   ".$whereData." 
								   AND";


if($viagemHandle > null){
	//$query .= " AND ";
foreach($_POST['viagem'] as $viagem){
	
$viagemExplode = explode(';', $viagem);
$viagemHandle = $viagemExplode[0];

$query .= " A.HANDLE = '".$viagemHandle."' OR ";

}
//$query = substr($query, 0, -3);
}

if($despesaHandle > null){
	//$query .= " AND ";
foreach($_POST['despesa'] as $despesa){
	
$despesaExplode = explode(';', $despesa);
$despesaHandle = $despesaExplode[0];

$query .= " D.HANDLE = '".$despesaHandle."' OR ";

}
//$query = substr($query, 0, -3);
}


if($tipoHandle > null){
	//$query .= " AND ";
foreach($_POST['tipo'] as $tipo){
	
$tipoExplode = explode(';', $tipo);
$tipoHandle = $tipoExplode[0];

$query .= " D.TIPO = '".$tipoHandle."' OR ";

}
//$query = substr($query, 0, -3);
}

if($situacaoHandle > null){
	//$query .= " AND ";
foreach($_POST['situacao'] as $situacao){
	
$situacaoExplode = explode(';', $situacao);
$situacaoHandle = $situacaoExplode[0];

$query .= " A.STATUS = '".$situacaoHandle."' OR ";

}
//$query = substr($query, 0, -3);
}

$query = substr($query, 0, -3);

	/*
	echo "<pre>";
	print_r($query);
	*/
		$query = $connect->prepare($query);
			
	$query->execute();
	
		while($row = $query->fetch(PDO::FETCH_ASSOC)){
			
			$viagem = $row['VIAGEM'];
			$origem = $row['ORIGEM'];
			$destino = $row['DESTINO'];
			$placa = $row['PLACA'];
			$status = $row['STATUS'];
			$rota = $row['ROTA'];
			$data = date('d/m/Y H:i', strtotime($row['DATA']));
			$despesa = $row['DESPESA'];
			$despesaHandleSelect = $row['DESPESAHANDLE'];
			
			
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
                  <td hidden="true"><input type="radio" name="check[]" hidden="true" class="check" id="check" value="<?php echo $status.'-'.$despesaHandle; ?>"></td>
				  <td width="1%"><?php echo $statusIcone; ?></td>
                  <td><?php echo $despesa; ?></td>
                  <td><?php echo $viagem; ?></td>
                  <td><?php echo $placa; ?></td>
                  <td><?php echo $rota; ?></td>
                  <td><?php echo $origemNome; ?></td>
                  <td><?php echo $destinoNome; ?></td>
                  <td><?php echo $data; ?></td>
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