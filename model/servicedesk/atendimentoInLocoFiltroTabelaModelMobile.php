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
									   A.APROVACAOCADASTRO, 
									   A.STATUS, 
									   A.NUMERO,
									   C.SIGLA FILIAL, 
									   A.DATA, 
									   A.PREVISAOINICIO, 
									   A.PREVISAOTERMINO, 
									   E.LOGIN TECNICO, 
									   F.APELIDO CLIENTE, 
									   A.ASSUNTOATENDIMENTO ASSUNTO
						FROM SD_INLOCO A   
			 LEFT JOIN SD_STATUSINLOCO B  ON A.STATUS = B.HANDLE 
				   LEFT JOIN MS_FILIAL C  ON A.FILIAL = C.HANDLE 
			   LEFT JOIN SD_TIPOINLOCO D  ON A.TIPO = D.HANDLE 
				  LEFT JOIN MS_USUARIO E  ON A.TECNICO = E.HANDLE 
				   LEFT JOIN MS_PESSOA F  ON A.CLIENTE = F.HANDLE 
				  LEFT JOIN MS_USUARIO G  ON A.LOGUSUARIOCADASTRO = G.HANDLE 
								 WHERE A.EMPRESA = '".$empresa."'
								 AND A.TECNICO = '".$handleUsuario."'
								 AND ( A.STATUS NOT IN (4, 5) ) 
								 ".$whereData."
								AND ";
								
if($filialHandle > null){
	//$query .= " AND ";
foreach($_POST['filial'] as $filial){
	
$filialExplode = explode(';', $filial);
$filialHandle = $filialExplode[0];

$query .= "A.FILIAL = '".$filialHandle."' OR ";

}
//$query = substr($query, 0, -3);
}

if($clienteHandle > null){
	//$query .= " AND ";
foreach($_POST['cliente'] as $cliente){
	
$clienteExplode = explode(';', $cliente);
$clienteHandle = $clienteExplode[0];

$query .= "A.CLIENTE = '".$clienteHandle."' OR ";

}
//$query = substr($query, 0, -3);
}


if($tecnicoHandle > null){
	//$query .= " AND ";
foreach($_POST['tecnico'] as $tecnico){
	
$tecnicoExplode = explode(';', $tecnico);
$tecnicoHandle = $tecnicoExplode[0];

$query .= "A.TECNICO = '".$tecnicoHandle."' OR ";

}
//$query = substr($query, 0, -3);
}

if($situacaoHandle > null){
	//$query .= " AND ";
foreach($_POST['situacao'] as $situacao){
	
$situacaoExplode = explode(';', $situacao);
$situacaoHandle = $situacaoExplode[0];

$query .= "A.STATUS = '".$situacaoHandle."' OR ";

}
//$query = substr($query, 0, -3);
}

$query = substr($query, 0, -4);


/*
echo "<pre>";
print_r($query);
*/
		$query .= "ORDER BY A.NUMERO DESC";
		$query = $connect->prepare($query);
		$query->execute();
	
		while($row = $query->fetch(PDO::FETCH_ASSOC)){
			
			$numero = $row['NUMERO'];
			$handle = $row['HANDLE'];
			$status = $row['STATUS'];
			$filial = $row['FILIAL'];
		    $datainloco = $row['DATA'];
			$prevInicio = date('d/m/Y', strtotime($row['PREVISAOINICIO'])); 
			$prevTermino = date('d/m/Y', strtotime($row['PREVISAOTERMINO'])); 
		    $tecnico = $row['TECNICO'];
		    $cliente = $row['CLIENTE'];
		    $assunto = $row['ASSUNTO'];

			if($status == '1'){
				$statusIcone = "<img src='../../view/tecnologia/img/status/cinza/vazio.png' width='13px' height='auto'>";	
			}
			
			if($status == '2'){
				$statusIcone = "<img src='../../view/tecnologia/img/status/amarelo/exclamacao.png' width='13px' height='auto'>";	
			}
			
			if($status == '3'){
				$statusIcone = "<img src='../../view/tecnologia/img/status/azul/interrogacao.png' width='13px' height='auto'>";	
			}
			if($status == '4'){
				$statusIcone = "<img src='../../view/tecnologia/img/status/vermelho/x.png' width='13px' height='auto'>";	
			}
			if($status == '5'){
				$statusIcone = "<img src='../../view/tecnologia/img/status/verde/ok.png' width='13px' height='auto'>";	
			}
			if($status == '6'){
				$statusIcone = "<img src='../../view/tecnologia/img/status/verde/vazio.png' width='13px' height='auto'>";	
			}
			if($status == '7'){
				$statusIcone = "<img src='../../view/tecnologia/img/status/verde/cifrao.png' width='13px' height='auto'>";	
			}
			if($status == '8'){
				$statusIcone = "<img src='../../view/tecnologia/img/status/azul/ponto.png' width='13px' height='auto'>";	
			}
			
			if($numero > null){
				$numeroInLoco = 'Número: '.$numero;	
			}
			else{
				$numeroInLoco = "";	
			}
			if($prevInicio > null){
				$previsaoInicio = ' - Prev. Início: '.$prevInicio;	
			}
			else{
				$previsaoInicio = "";	
			}
			if($prevTermino > null){
				$previsaoTermino = ' - Prev. Término: '.$prevTermino;	
			}
			else{
				$previsaoTermino = "";	
			}
			if($tecnico > null){
				$tecnicoInLoco = ' - Técnico: '.$tecnico;	
			}
			else{
				$tecnicoInLoco = "";	
			}
			if($cliente > null){
				$clienteInLoco = ' - Cliente: '.$cliente;	
			}
			else{
				$clienteInLoco = "";	
			}
			if($assunto > null){
				$assuntoInLoco = ' - Assunto: '.$assunto;	
			}
			else{
				$assuntoInLoco = "";	
			}
			if($filial > null){
				$filialInLoco = ' - Filial: '.$filial;	
			}
			else{
				$filialInLoco = "";	
			}
?>
    			<tr>
                  <td hidden="true"><input type="radio" name="check[]" hidden="true" id="check" value="<?php echo $status.';'.$handle.';'.$numero; ?>"></td>
                   <td width="1%"><?php echo $statusIcone; ?></td>
                  <td class="desktopHide">
                  <?php echo $numeroInLoco.$tecnicoInLoco.$clienteInLoco.$assuntoInLoco.$filialInLoco.$previsaoInicio.$previsaoTermino; ?>
                  </td>
    			</tr>
<?php
		}
?>
<?php
if(@$numero <= '' or @$numero == null){
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