<?php
		$regraBaixa = null;
		$regraBaixaHandle = null;
		$romaneioItem = null;
		$documentoTransporte = null;
		$documentoTransporteHandle = null;
		$tipoOcorrencia = null;
		$tipoOcorrenciaHandle = null;
		$tipoOperacao = null;
		$tipoOperacaoHandle = null;
		$filial = null;
		$filialHandle = null;
		$acao = null;
		$acaoHandle = null;
		$data = null;
		$hora = null;
		$dataChegada = null;
		$horaChegada = null;
		$dataEntrada = null;
		$horaEntrada = null;
		$dataSaida = null;
		$horaSaida = null;
		$motivoAtraso = null;
		$motivoAtrasoHandle = null;
		$responsavel = null;
		$responsavelHandle = null;
		$nome = null;
		$documento = null;
		$observacao = null;
		
		
			
			$mensagem = null;
			$protocolo = null;
			$toggle = null;
			
			$ocorrenciaHandle = Sistema::getGet('ocorrencia');
			$referencia = Sistema::getGet('referencia');
			
			

			$query = $connect->prepare("SELECT A.STATUS,
									   A.DOCUMENTORESPONSAVEL,
									   C.NUMERO DOCUMENTO,
									   C.HANDLE DOCUMENTOHANDLE,
									   E.NOME TIPO,
									   E.HANDLE TIPOHANDLE, 
									   F.NOME ACAO,
									   F.HANDLE ACAOHANDLE,
									   A.DATA,
									   A.DATACHEGADA,
									   A.DATAENTRADA,
									   A.DATASAIDA,
									   G.NOME FILIAL,
									   G.HANDLE FILIALHANDLE,
									   H.NOME MOTIVOATRASO,
									   H.HANDLE MOTIVOATRASOHANDLE,
									   I.NOME RESPONSAVEL,
									   I.HANDLE RESPONSAVELHANDLE,
									   A.NOMERESPONSAVEL NOME
					FROM OP_OCORRENCIA A
	  LEFT JOIN GD_DOCUMENTOTRANSPORTE B ON A.DOCUMENTOTRANSPORTE = B.HANDLE
				LEFT JOIN GD_DOCUMENTO C ON B.DOCUMENTO = C.HANDLE
				 LEFT JOIN MS_OPERACAO D ON C.OPERACAO = D.HANDLE 
		   LEFT JOIN OP_TIPOOCORRENCIA E ON A.TIPO = E.HANDLE 
		   LEFT JOIN OP_ACAOOCORRENCIA F ON A.ACAO = F.HANDLE 
				   LEFT JOIN MS_FILIAL G ON A.FILIAL = G.HANDLE 
			 LEFT JOIN OP_MOTIVOATRASO H ON A.MOTIVOATRASO = H.HANDLE
	LEFT JOIN OP_RESPONSAVELOCORRENCIA I ON A.RESPONSAVEL = I.HANDLE
								 WHERE A.STATUS <> 5 
 								   AND A.STATUS <> 4
 								   AND A.HANDLE = '".$ocorrenciaHandle."'
								   ");
    $query->execute();
    
    $row = $query->fetch(PDO::FETCH_ASSOC);
	
	$status = $row['STATUS'];
	$documento = $row['DOCUMENTORESPONSAVEL'];
	$documentoHandle = $row['DOCUMENTOHANDLE'];
	$tipoOcorrencia = $row['TIPO'];
	$tipoOcorrenciaHandle = $row['TIPOHANDLE'];
	$acao = $row['ACAO'];
	$acaoHandle = $row['ACAOHANDLE'];
	$dataOcorrencia = $row['DATA'];
	$horaOcorrencia = $row['DATA'];
	
	$dataChegada = strtotime($row['DATACHEGADA']);
	$horaChegada = strtotime($row['DATACHEGADA']);
	$dataChegada = ($dataChegada === false) ? '0000-00-00' : date('Y-m-d', $dataChegada);
	$horaChegada = ($horaChegada === false) ? '00:00:00' : date('H:i:s', $horaChegada);
	
	$dataEntrada = strtotime($row['DATAENTRADA']);
	$horaEntrada = strtotime($row['DATAENTRADA']);
	$dataEntrada = ($dataEntrada === false) ? '0000-00-00' : date('Y-m-d', $dataEntrada);
	$horaEntrada = ($horaEntrada === false) ? '00:00:00' : date('H:i:s', $horaEntrada);

	$dataSaida = strtotime($row['DATASAIDA']);
	$horaSaida = strtotime($row['DATASAIDA']);
	$dataSaida = ($dataSaida === false) ? '0000-00-00' : date('Y-m-d', $dataSaida);
	$horaSaida = ($horaSaida === false) ? '00:00:00' : date('H:i:s', $horaSaida);
	
	$filial = $row['FILIAL'];
	$filialHandle = $row['FILIALHANDLE'];
	$motivoAtraso = $row['MOTIVOATRASO'];
	$motivoAtrasoHandle = $row['MOTIVOATRASOHANDLE'];
	$responsavel = $row['RESPONSAVEL'];
	$responsavelHandle = $row['RESPONSAVELHANDLE'];
	$nome = $row['NOME'];
		
if($status == '1'){
	$disabled = '';
	$disabledColor = '';
	$toggle = '<button id="showLeftPushVoltarForm" data-toggle="modal" data-target="#VoltarModal"><i class="glyphicon glyphicon-menu-left"></i></button>';
}
if($status == '2'){
	$disabled = '';
	$disabledColor = '';
	$toggle = '<button id="showLeftPushVoltarForm" data-toggle="modal" data-target="#VoltarModal"><i class="glyphicon glyphicon-menu-left"></i></button>';
}
if($status == '3'){
	$disabled = 'disabled';
	$disabledColor = 'color="#A7A7A7"';	
	$toggle = '<a href="OcorrenciaTransporte.php"><button id="showLeftPushVoltarForm"><i class="glyphicon glyphicon-menu-left"></i></button></a>';
}
if($status == '6'){
	$disabled = 'disabled';
	$disabledColor = 'color="#A7A7A7"';	
	$toggle = '<a href="OcorrenciaTransporte.php"><button id="showLeftPushVoltarForm"><i class="glyphicon glyphicon-menu-left"></i></button></a>';
}
if($status == '7'){
	$disabled = 'disabled';	
	$disabledColor = 'color="#A7A7A7"';
	$toggle = '<a href="OcorrenciaTransporte.php"><button id="showLeftPushVoltarForm"><i class="glyphicon glyphicon-menu-left"></i></button></a>';
}
		

?>