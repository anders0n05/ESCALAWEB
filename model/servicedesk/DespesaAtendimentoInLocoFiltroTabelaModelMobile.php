<?php
date_default_timezone_set('America/Sao_Paulo');
		$numero = null;
		
		$dataInicio = strtotime(Sistema::getPost('dataInicio'));
		$dataInicioFormat = ($dataInicio === false) ? '0000-00-00 00:00:00' : date('Y-m-d H:i', $dataInicio);
		$dataInicioFormatExibe= ($dataInicio === false) ? '00-00-0000 00:00:00' : date('d/m/Y H:i', $dataInicio);
		$dataFinal = strtotime(Sistema::getPost('dataFinal'));
		$dataFinalFormat = ($dataFinal === false) ? '0000-00-00 00:00:00' : date('Y-m-d H:i', $dataFinal);
		$dataFinalFormatExibe = ($dataFinal === false) ? '00-00-0000 00:00:00' : date('d/m/Y H:i', $dataFinal);

if($dataInicio > null and $dataFinal > null){
$whereData = "AND A.DATAPREVISAOINICIO >=  '$dataInicioFormat' AND A.DATAPREVISAOINICIO < '$dataFinalFormat'";				
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

	$query = "SELECT A.HANDLE, 
									   A.INLOCO,
									   A.COMPLEMENTO, 
									   A.OBSERVACAO, 
									   A.DATA, 
									   A.QUANTIDADE, 
									   A.VALORUNITARIO, 
									   A.VALORTOTAL, 
									   C.NOME DESPESA, 
									   B.ASSUNTOATENDIMENTO, 
									   B.NUMERO,
									   D.NOME TIPO,
									   A.STATUS
				 FROM SD_INLOCODESPESA A
				  INNER JOIN SD_INLOCO B ON B.HANDLE = A.INLOCO
					INNER JOIN MT_ITEM C ON C.HANDLE = A.ITEM
	   INNER JOIN SD_TIPOINLOCODESPESA D ON D.HANDLE = A.TIPO
								 WHERE B.EMPRESA = '".$empresa."'
								   AND B.TECNICO = '".$handleUsuario."'
								 AND ( B.STATUS NOT IN (4, 5) )
								  ".$whereData."
								AND ";
								
if($situacaoHandle > null){
	//$query .= " AND ";
foreach($_POST['situacao'] as $situacao){
	
$situacaoExplode = explode(';', $situacao);
$situacaoHandle = $situacaoExplode[0];

$query .= "A.STATUS = '".$situacaoHandle."' OR ";

}
//$query = substr($query, 0, -3);
}

if($tipoHandle > null){
	//$query .= " AND ";
foreach($_POST['tipo'] as $tipo){
	
$tipoExplode = explode(';', $tipo);
$tipoHandle = $tipoExplode[0];

$query .= "A.TIPO = '".$tipoHandle."' OR ";

}
//$query = substr($query, 0, -3);
}

if($despesaHandle > null){
	//$query .= " AND ";
foreach($_POST['despesa'] as $despesa){
	
$despesaExplode = explode(';', $despesa);
$despesaHandle = $despesaExplode[0];

$query .= "A.ITEM = '".$despesaHandle."' OR ";

}
//$query = substr($query, 0, -3);
}

if($inLocoHandle > null){
	//$query .= " AND ";
foreach($_POST['InLoco'] as $inLoco){
	
$inLocoExplode = explode(';', $inLoco);
$inLocoHandle = $inLocoExplode[0];

$query .= "A.INLOCO = '".$inLocoHandle."' OR ";

}
//$query = substr($query, 0, -3);
}



$query = substr($query, 0, -4);		
			
$query .= "ORDER BY B.NUMERO DESC";
$query = $connect->prepare($query);
$query->execute();

while($row = $query->fetch(PDO::FETCH_ASSOC)){
	
	$handleDespesa = $row['HANDLE'];
	$handleInLoco = $row['INLOCO'];
	$complemento = $row['COMPLEMENTO'];
	$observacao = $row['OBSERVACAO'];
	$quantidade = $row['QUANTIDADE'];
	$valorunitario = $row['VALORUNITARIO'];
	$valortotal = $row['VALORTOTAL'];
	$despesa = $row['DESPESA'];
	$assuntoInLoco = $row['ASSUNTOATENDIMENTO'];
	$data = date('d/m/Y H:i', strtotime($row['DATA']));
	$numeroInLoco = $row['NUMERO'];
	$tipo = $row['TIPO'];
	$status = $row['STATUS'];			
	
	
	if($despesa > null){
		$despesaExibe = " - Despesa: ".$despesa;	
	}
	else{
		$despesaExibe = "";	
	}
	if($tipo > null){
		$tipoExibe = "Tipo: ".$tipo;	
	}
	else{
		$tipoExibe = "";	
	}
	if($complemento > null){
		$complementoExibe = " - Complemento: ".$complemento;	
	}
	else{
		$complementoExibe = "";	
	}
	if($assuntoInLoco > null){
		$assuntoInLocoExibe = " - In Loco: ".$numeroInLoco." - ".$assuntoInLoco;	
	}
	else{
		$assuntoInLocoExibe = "";	
	}
	if($data > null){
		$dataExibe = " - Data: ".$data;	
	}
	else{
		$dataExibe = "";	
	}	

	if($status == '1'){
		$statusIcone = "<img src='../../view/tecnologia/img/status/cinza/vazio.png' width='13px' height='auto'>";	
	}
	if($status == '2'){
		$statusIcone = "<img src='../../view/tecnologia/img/status/amarelo/exclamacao.png' width='13px' height='auto'>";	
	}
	if($status == '3'){
		$statusIcone = "<img src='../../view/tecnologia/img/status/vermelho/x.png' width='13px' height='auto'>";	
	}
	if($status == '4'){
		$statusIcone = "<img src='../../view/tecnologia/img/status/verde/ok.png' width='13px' height='auto'>";	
	}
	if($status == '5'){
		$statusIcone = "<img src='../../view/tecnologia/img/status/azul/interrogacao.png' width='13px' height='auto'>";	
	}
	if($status == '6'){
		$statusIcone = "<img src='../../view/tecnologia/img/status/azul/vazio.png' width='13px' height='auto'>";	
	}					
?>
		<tr>
		  <td hidden="true"><input type="radio" name="check[]" hidden="true" class="check" id="check" value="<?php echo $status.';'.$handleDespesa; ?>"></td>
		  <td width="1%"><?php echo $statusIcone; ?></td>
		  <td class="desktopHide">
		  <?php echo $tipoExibe.$despesaExibe.$complementoExibe.$assuntoInLocoExibe.$dataExibe; ?>
		  </td>
		</tr>
<?php
}
?>
<?php
if(@$handleDespesa <= '' or @$handleDespesa == null){
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