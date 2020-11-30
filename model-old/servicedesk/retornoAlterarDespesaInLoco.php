<?php
$despesaInLocoHandle = Sistema::getGet('handle');
$query = $connect->prepare("SELECT A.HANDLE, 
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
									   A.STATUS,
									   A.TIPO TIPOHANDLE,
									   A.ITEM DESPESAHANDLE,
									   A.PERCENTUAL,
									   A.REEMBOLSO,
									   D.EHALTERAPERCENTUAL
				 FROM SD_INLOCODESPESA A
				  INNER JOIN SD_INLOCO B ON B.HANDLE = A.INLOCO
					INNER JOIN MT_ITEM C ON C.HANDLE = A.ITEM
	   INNER JOIN SD_TIPOINLOCODESPESA D ON D.HANDLE = A.TIPO
								 WHERE B.EMPRESA = '".$empresa."'
								   AND B.TECNICO = '".$handleUsuario."'
								   AND A.HANDLE = '".$despesaInLocoHandle."'
								 AND ( B.STATUS NOT IN (4, 5) ) 
							  ORDER BY B.NUMERO DESC
								 ");
	$query->execute();
		$row = $query->fetch(PDO::FETCH_ASSOC);
			$percentualReembolso = number_format($row['PERCENTUAL'], '2', ',', '');
			$totalReembolso = number_format($row['REEMBOLSO'], '2', ',', '');
			$EHALTERAPERCENTUAL = $row['EHALTERAPERCENTUAL'];
			$handleDespesa = $row['HANDLE'];
			$handleInLoco = $row['INLOCO'];
			$complemento = $row['COMPLEMENTO'];
			$observacao = $row['OBSERVACAO'];
			$quantidade = $row['QUANTIDADE'];
			$valorunitario = $row['VALORUNITARIO'];
			$valortotal = $row['VALORTOTAL'];
			$despesa = $row['DESPESA'];
			$assuntoInLoco = $row['ASSUNTOATENDIMENTO'];
			$dataDespesa = date('Y-m-d', strtotime($row['DATA']));
			$horaDespesa = date('H:i', strtotime($row['DATA']));
			$numeroInLoco = $row['NUMERO'];
			$tipo = $row['TIPO'];
			$status = $row['STATUS'];
		    $tipoHandle = $row['TIPOHANDLE'];	
		    $despesaHandle = $row['DESPESAHANDLE'];
			
			if($EHALTERAPERCENTUAL == 'S'){
				$disabledPercentual = '';	
			}
			else{
				$disabledPercentual = 'disabled';	
			}
		

$disabled = null;


if($status == '1'){
	$disabled = '';
	$toggle = '<button id="showLeftPushVoltarForm" data-toggle="modal" data-target="#VoltarModal"><i class="glyphicon glyphicon-menu-left"></i></button>';
}
if($status == '2'){
	$disabled = '';
	$toggle = '<button id="showLeftPushVoltarForm" data-toggle="modal" data-target="#VoltarModal"><i class="glyphicon glyphicon-menu-left"></i></button>';
}
if($status == '3'){
	$disabled = 'disabled';	
	$toggle = '<a href="'.$referencia.'.php"><button id="showLeftPushVoltarForm"><i class="glyphicon glyphicon-menu-left"></i></button></a>';
}
if($status == '4'){
	$disabled = 'disabled';	
	$toggle = '<a href="'.$referencia.'.php"><button id="showLeftPushVoltarForm"><i class="glyphicon glyphicon-menu-left"></i></button></a>';
}
if($status == '5'){
	$disabled = 'disabled';	
	$toggle = '<a href="'.$referencia.'.php"><button id="showLeftPushVoltarForm"><i class="glyphicon glyphicon-menu-left"></i></button></a>';
}
if($status == '6'){
	$disabled = 'disabled';	
	$toggle = '<a href="'.$referencia.'.php"><button id="showLeftPushVoltarForm"><i class="glyphicon glyphicon-menu-left"></i></button></a>';
}



if(isset($_SESSION['mensagem'])){
		$display = '';
}
else{
	$display = 'display';	
}
	

?>