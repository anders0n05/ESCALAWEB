<?php
$filial = null;
$filialHandle = null;
$tipoHandle = null;
$tipo = null;
$acaoHandle = null;
$acao = null;
$documentoHandle  = null;
$documento = null;

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

	$query = "SELECT A.HANDLE, 
									   A.STATUS, 
									   A.NUMERO, 
									   C.NUMERO DOCUMENTO, 
									   E.NOME TIPO, 
									   F.NOME ACAO, 
									   A.DATA, 
									   D.CODIGO OPERACAO,
									   A.ROMANEIOITEM,
									   A.ROMANEIOITEM,
									   K.HANDLE VIAGEM
					FROM OP_OCORRENCIA A
	  LEFT JOIN GD_DOCUMENTOTRANSPORTE B ON A.DOCUMENTOTRANSPORTE = B.HANDLE
				LEFT JOIN GD_DOCUMENTO C ON B.DOCUMENTO = C.HANDLE
				 LEFT JOIN MS_OPERACAO D ON C.OPERACAO = D.HANDLE 
		   LEFT JOIN OP_TIPOOCORRENCIA E ON A.TIPO = E.HANDLE 
		   LEFT JOIN OP_ACAOOCORRENCIA F ON A.ACAO = F.HANDLE  
	  LEFT JOIN GD_DOCUMENTOTRANSPORTE G ON A.DOCUMENTOTRANSPORTE = G.HANDLE 
				LEFT JOIN GD_DOCUMENTO H ON G.DOCUMENTO = H.HANDLE 
	   LEFT JOIN OP_VIAGEMROMANEIOITEM I ON A.ROMANEIOITEM = I.HANDLE 
		   LEFT JOIN OP_VIAGEMROMANEIO J ON I.VIAGEMROMANEIO = J.HANDLE 
			  LEFT JOIN OP_VIAGEM K ON J.VIAGEM = K.HANDLE
								 WHERE A.STATUS <> 5 
 								   AND A.STATUS <> 4
 								   AND A.EMPRESA = ".$empresa." 
								   AND K.MOTORISTA = ".$pessoa."
								   ".$whereData." 
								   AND";
								   
if($filialHandle > null){
foreach($_POST['filial'] as $filial){
	
$filialExplode = explode(';', $filial);
$filialHandle = $filialExplode[0];

$query .= " A.FILIAL = '".$filialHandle."' OR ";

}
}

if($tipoHandle > null){
foreach($_POST['tipo'] as $tipo){
	
$tipoExplode = explode(';', $tipo);
$tipoHandle = $tipoExplode[0];

$query .= " A.TIPO = '".$tipoHandle."' OR ";

}
}

if($acaoHandle > null){
foreach($_POST['acao'] as $acao){
	
$acaoExplode = explode(';', $acao);
$acaoHandle = $acaoExplode[0];

$query .= " A.ACAO = '".$acaoHandle."' OR ";

}
}

if($documentoHandle > null){
foreach($_POST['documento'] as $documento){
	
$documentoExplode = explode(';', $documento);
$documentoHandle = $documentoExplode[0];

$query .= " C.NUMERO = '".$documentoHandle."' OR ";

}
}
								   
								   
	$query = substr($query, 0, -3);
	/*
	echo "<pre>";
	print_r($query);
	echo "</pre>";
	*/
	$query = $connect->prepare($query);
	$query->execute();
		while($row = $query->fetch(PDO::FETCH_ASSOC)){
			
			$OcorrenciaHandle = $row['HANDLE'];
			$OcorrenciaStatus = $row['STATUS'];
			$OcorrenciaNumero = $row['NUMERO'];
			$OcorrenciaDocumento = $row['DOCUMENTO'];
			$OcorrenciaTipo = $row['TIPO'];
			$OcorrenciaAcao = $row['ACAO'];
			$OcorrenciaOperacao = $row['OPERACAO'];
			$OcorrenciaRomaneio = $row['ROMANEIOITEM'];
			$OcorrenciaData = date('d/m/Y H:i', strtotime($row['DATA']));
						
		
			if($OcorrenciaStatus == '1'){
				$OcorrenciaStatusIcone = "<img src='../../view/tecnologia/img/status/cinza/vazio.png' width='13px' height='auto'>";	
			}
			if($OcorrenciaStatus == '2'){
				$OcorrenciaStatusIcone = "<img src='../../view/tecnologia/img/status/amarelo/exclamacao.png' width='13px' height='auto'>";	
			}
			if($OcorrenciaStatus == '3'){
				$OcorrenciaStatusIcone = "<img src='../../view/tecnologia/img/status/azul/interrogacao.png' width='13px' height='auto'>";	
			}
			if($OcorrenciaStatus == '4'){
				$OcorrenciaStatusIcone = "<img src='../../view/tecnologia/img/status/verde/ok.png' width='13px' height='auto'>";	
			}
			if($OcorrenciaStatus == '5'){
				$OcorrenciaStatusIcone = "<img src='../../view/tecnologia/img/status/vermelho/x.png' width='13px' height='auto'>";	
			}
			if($OcorrenciaStatus == '6'){
				$OcorrenciaStatusIcone = "<img src='../../view/tecnologia/img/status/azul/seta_direita.png' width='13px' height='auto'>";	
			}
			if($OcorrenciaStatus == '7'){
				$OcorrenciaStatusIcone = "<img src='../../view/tecnologia/img/status/azul/seta_esquerda.png' width='13px' height='auto'>";	
			}
			
			if($OcorrenciaNumero > null){
				$numeroExibe = "Número: ".$OcorrenciaNumero;	
			}
			else{
				$numeroExibe = '';	
			}
			if($OcorrenciaOperacao > null){
				$operacaoExibe = " - Operação: ".$OcorrenciaOperacao;	
			}
			else{
				$operacaoExibe = '';	
			}
			if($OcorrenciaDocumento > null){
				$documentoExibe = " - Documento: ".$OcorrenciaDocumento;	
			}
			else{
				$documentoExibe = '';	
			}
			if($OcorrenciaTipo > null){
				$tipoExibe = " - Tipo: ".$OcorrenciaTipo;	
			}
			else{
				$tipoExibe = '';	
			}
			if($OcorrenciaAcao > null){
				$acaoExibe = " - Ação: ".$OcorrenciaAcao;	
			}
			else{
				$acaoExibe = '';	
			}
			if($OcorrenciaData > null){
				$dataExibe = " - Data: ".$OcorrenciaData;	
			}
			else{
				$dataExibe = '';	
			}
			
?>
    			<tr>
                  <td hidden="true"><input type="radio" name="check[]" hidden="true" class="check" id="check" value="<?php echo $OcorrenciaStatus.'-'.$OcorrenciaHandle; ?>"></td>
				  <td width="1%"><?php echo $OcorrenciaStatusIcone; ?></td>
                  <td class="desktopHide">
                  <?php echo $numeroExibe.$operacaoExibe.$documentoExibe.$tipoExibe.$acaoExibe.$dataExibe; ?>
                  </td>
    			</tr>
<?php
	}
?>
<?php
if(@$OcorrenciaHandle <= '' or @$OcorrenciaHandle == null){
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