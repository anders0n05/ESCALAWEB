<?php
			$tipo = null;
			$tipoHandle = null;
			$numero = null;
			$viagemHandle = null;
			$data = null;
			$hora = null;
			$quantidade = null;
			$ValorUnitario = null;
			$ValorTotal = null;
			$despesa = null;
			$despesaHandle = null;
			$fornecedor = null;
			$fornecedorHandle = null;
			$FormaPagamento = null;
			$FormaPagamentoHandle = null;
			$CondicaoPagamento = null;
			$CondicaoPagamentoHandle = null;
			$observacao = null;
			$mensagem = null;
			$protocolo = null;
			$toggle = null;
			
			$despesaHandle = Sistema::getGet('despesa');
			$referencia = Sistema::getGet('referencia');

	$query = $connect->prepare("SELECT A.DATA,  
									   C.NOME DESPESA,
									   C.HANDLE DESPESAHANDLE,
									   A.QUANTIDADE ,
									   A.VALORUNITARIO, 
									   A.VALOR,
									   A.OBSERVACAO,
									   B.NUMERO VIAGEM,
									   B.HANDLE VIAGEMHANDLE,
									   D.NOME FORMAPAGAMENTO,
									   D.HANDLE FORMAPAGAMENTOHANDLE,
									   E.NOME TIPO,
									   E.HANDLE TIPOHANDLE,
									   F.NOME CONDICAOPAGAMENTO,
									   F.HANDLE CONDICAOPAGAMENTOHANDLE,
									   G.NOME FORNECEDOR,
									   G.HANDLE FORNECEDORHANDLE,
									   A.STATUS,
									   H.NOME STATUSNOME,
									   A.STATUSDATA,
									   A.EHGERARORDEMCOMPRAFORNECEDOR, 
									   A.EHGERARDOCUMENTOFORNECEDOR, 
									   A.EHGERARDOCUMENTOMOTORISTA
				 FROM OP_VIAGEMDESPESA A
				  INNER JOIN OP_VIAGEM B
									ON B.HANDLE = A.VIAGEM
					 FULL JOIN MT_ITEM C
									ON C.HANDLE = A.DESPESA
		    FULL JOIN FN_TIPOPAGAMENTO D
									ON D.HANDLE = A.FORMAPAGAMENTO
		FULL JOIN OP_TIPOVIAGEMDESPESA E
									ON E.HANDLE = A.TIPO
		FULL JOIN FN_CONDICAOPAGAMENTO F
									ON F.HANDLE = A.CONDICAOPAGAMENTO
				   FULL JOIN MS_PESSOA G
									ON G.HANDLE = A.FORNECEDOR
	 INNER JOIN OP_STATUSVIAGEMDESPESA H
									ON A.STATUS = H.HANDLE
								 WHERE A.HANDLE = '".$despesaHandle."'");
    $query->execute();
    
    $row = $query->fetch(PDO::FETCH_ASSOC);
	
	$dataDespesa = date('Y-m-d', strtotime($row['DATA'])); 
	$horaDespesa = date('H:i:s', strtotime($row['DATA'])); 
	$despesa = $row['DESPESA'];
	$despesaHandleItem = $row['DESPESAHANDLE'];
	$quantidade = $row['QUANTIDADE'];
	$valodUnitario = $row['VALORUNITARIO']; 
	$valorTotal = $row['VALOR'];
	$observacao = $row['OBSERVACAO'];
	$numeroViagem = $row['VIAGEM'];
	$viagemHandle = $row['VIAGEMHANDLE'];
	$formaPagamento = $row['FORMAPAGAMENTO'];
	$formaPagamentoHandle = $row['FORMAPAGAMENTOHANDLE'];
	$tipo = $row['TIPO'];
	$tipoHandle = $row['TIPOHANDLE'];
	$CondicaoPagamento = $row['CONDICAOPAGAMENTO'];
	$CondicaoPagamentoHandle = $row['CONDICAOPAGAMENTOHANDLE'];
	$fornecedor = $row['FORNECEDOR'];
	$fornecedorHandle = $row['FORNECEDORHANDLE'];
	$status = $row['STATUS'];
	$statusNome = $row['STATUSNOME'];
	$statusData = date('d-m-Y', strtotime($row['STATUSDATA']));
	$statusHora = date('H:i', strtotime($row['STATUSDATA']));
	$EHGERARORDEMCOMPRAFORNECEDOR = $row['EHGERARORDEMCOMPRAFORNECEDOR']; 
	$EHGERARDOCUMENTOFORNECEDOR = $row['EHGERARDOCUMENTOFORNECEDOR']; 
	$EHGERARDOCUMENTOMOTORISTA = $row['EHGERARDOCUMENTOMOTORISTA'];
	
	if($EHGERARDOCUMENTOFORNECEDOR == 'S' || $EHGERARDOCUMENTOMOTORISTA == 'S' || $EHGERARORDEMCOMPRAFORNECEDOR == 'S'){
		$disabledpagamento = '';	
	}
	else{
		$disabledpagamento = 'disabled';
	}
		if(isset($_POST['check'])){
			
			$check =  $_POST['check'];
			
		foreach($check as $chk){
			$checkValue = $chk;
		}
		
		$numeroViagem = explode(';', $checkValue);
		$numero = $numeroViagem[0];
		$viagemHandle = $numeroViagem[1];
		}
		
		if($numero == null){
			@$numero = $_GET['numero'];	
		}
		if($viagemHandle == null){
			@$viagemHandle = $_GET['handle'];
		}

$disabled = null;


if($status == '1'){
	$disabled = '';
	$toggle = '<button id="showLeftPushVoltarForm" data-toggle="modal" data-target="#VoltarModal"><i class="glyphicon glyphicon-menu-left"></i></button>';
}
if($status == '2'){
	$disabled = 'disabled';	
	$toggle = '<a href="'.$referencia.'.php"><button id="showLeftPushVoltarForm"><i class="glyphicon glyphicon-menu-left"></i></button></a>';
}
if($status == '3'){
	$disabled = 'disabled';	
	$toggle = '<a href="'.$referencia.'.php"><button id="showLeftPushVoltarForm"><i class="glyphicon glyphicon-menu-left"></i></button></a>';
}
if($status == '4'){
	$disabled = '';
	$toggle = '<button id="showLeftPushVoltarForm" data-toggle="modal" data-target="#VoltarModal"><i class="glyphicon glyphicon-menu-left"></i></button>';	
}
if($status == '5'){
	$disabled = 'disabled';	
	$toggle = '<a href="'.$referencia.'.php"><button id="showLeftPushVoltarForm"><i class="glyphicon glyphicon-menu-left"></i></button></a>';
}
if($status == '6'){
	$disabled = 'disabled';	
	$toggle = '<a href="'.$referencia.'.php"><button id="showLeftPushVoltarForm"><i class="glyphicon glyphicon-menu-left"></i></button></a>';
}
if($status == '7'){
	$disabled = 'disabled';	
	$toggle = '<a href="'.$referencia.'.php"><button id="showLeftPushVoltarForm"><i class="glyphicon glyphicon-menu-left"></i></button></a>';
}

?>