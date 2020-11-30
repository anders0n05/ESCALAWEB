<?php

			$query = "SELECT A.STATUS, 
					   		 A.HANDLE, 
					   		 A.NUMERO,
					   		 B.PESO,
					   		 B.VALORMERCADORIA,
					   		 B.NUMERO VIAGEM, 
					   		 C.NUMERO ROMANEIO, 
					   		 D.SIGLA FILIAL, 
						 	 A.DATAEMISSAO, 
					 		 E.PLACA,
					 		 F.APELIDO REMETENTE,
					 		 G.APELIDO DESTINATARIO,
					 		 B.DATAPREVISAOINICIO
  FROM OP_VIAGEMROMANEIOITEM A
  		INNER JOIN OP_VIAGEM B ON B.HANDLE = A.VIAGEM
INNER JOIN OP_VIAGEMROMANEIO C ON C.HANDLE = A.NUMERO
  		INNER JOIN MS_FILIAL D ON D.HANDLE = A.FILIAL
  	   INNER JOIN MF_VEICULO E ON E.HANDLE = B.VEICULO
  	    INNER JOIN MS_PESSOA F ON A.REMETENTE = F.HANDLE 
  	    INNER JOIN MS_PESSOA G ON A.DESTINATARIO = G.HANDLE 
 					   WHERE  EXISTS (SELECT OP_VIAGEMROMANEIO.HANDLE
               			FROM OP_VIAGEMROMANEIO
					   WHERE OP_VIAGEMROMANEIO.HANDLE = A.VIAGEMROMANEIO)
               			 AND B.EMPRESA = '".$empresa."'
               			 AND B.MOTORISTA IN (".Sistema::getPessoaUsuarioToStr($connect).")
                      ";
					  
	$query = $connect->prepare($query);
	$query->execute();
		while($row = $query->fetch(PDO::FETCH_ASSOC)){
			
			$RomaneioHandle = $row['HANDLE'];
			$RomaneioStatus = $row['STATUS'];
			$RomaneioViagem = $row['VIAGEM'];
			$Romaneio = $row['ROMANEIO'];
			$RomaneioFilial = $row['FILIAL'];
			$RomaneioPlaca = $row['PLACA'];
			$RomaneioNumero = $row['NUMERO'];
			$RomaneioPeso = $row['PESO'];
			$RomaneioValorMercadoria = $row['VALORMERCADORIA'];
			$RomaneioRemetente = $row['REMETENTE'];
			$RomaneioDestinatario = $row['DESTINATARIO'];
			$RomaneioPrevInicio = date('d/m/Y H:i', strtotime($row['DATAPREVISAOINICIO']));
			$RomaneioDataEmissao = date('d/m/Y', strtotime($row['DATAEMISSAO']));
						
			if($RomaneioStatus == '1'){
				$RomaneioStatusIcone = "<img src='../../view/tecnologia/img/status/cinza/vazio.png' width='13px' height='auto'>";	
			}
			if($RomaneioStatus == '2'){
				$RomaneioStatusIcone = "<img src='../../view/tecnologia/img/status/amarelo/exclamacao.png' width='13px' height='auto'>";	
			}	
			if($RomaneioStatus == '3'){
				$RomaneioStatusIcone = "<img src='../../view/tecnologia/img/status/azul/sustenido.png' width='13px' height='auto'>";	
			}
			if($RomaneioStatus == '4'){
				$RomaneioStatusIcone = "<img src='../../view/tecnologia/img/status/verde/igual.png' width='13px' height='auto'>";	
			}
			if($RomaneioStatus == '5'){
				$RomaneioStatusIcone = "<img src='../../view/tecnologia/img/status/verde/ok.png' width='13px' height='auto'>";	
			}
			if($RomaneioStatus == '6'){
				$RomaneioStatusIcone = "<img src='../../view/tecnologia/img/status/vermelho/x.png' width='13px' height='auto'>";	
			}
			if($RomaneioStatus == '7'){
				$RomaneioStatusIcone = "<img src='../../view/tecnologia/img/status/preto/vazio.png' width='13px' height='auto'>";	
			}
			if($RomaneioStatus == '8'){
				$RomaneioStatusIcone = "<img src='../../view/tecnologia/img/status/preto/vazio.png' width='13px' height='auto'>";	
			}	
			
			if($RomaneioNumero > null){
				$numeroExibe = "Número: ".$RomaneioNumero;	
			}
			else{
				$numeroExibe = "";	
			}
			if($RomaneioViagem > null){
				$viagemExibe = " - Viagem: ".$RomaneioViagem;	
			}
			else{
				$viagemExibe = "";	
			}
			if($Romaneio > null){
				$romaneioExibe = " - Romaneio: ".$Romaneio;	
			}
			else{
				$romaneioExibe = "";	
			}
			if($RomaneioDataEmissao > null){
				$emissaoExibe = " - Emissão: ".$RomaneioDataEmissao;	
			}
			else{
				$emissaoExibe = "";	
			}
			if($RomaneioPlaca > null){
				$placaExibe = " - Veículo: ".$RomaneioPlaca;	
			}
			else{
				$placaExibe = "";	
			}
			if($RomaneioFilial > null){
				$filialExibe = " - Filial: ".$RomaneioFilial;	
			}
			else{
				$filialExibe = "";	
			}
			if($RomaneioPeso > null){
				$pesoExibe = " - Peso: ".number_format($RomaneioPeso, 2, ',', '.');	
			}
			else{
				$pesoExibe = "";	
			}
			if($RomaneioValorMercadoria > null){
				$valorMercExibe = " - Valor mercadoria: ".number_format($RomaneioValorMercadoria, 2, ',', '.');
			}
			else{
				$valorMercExibe = "";	
			}
			if($RomaneioPrevInicio > null){
				$prevInicioExibe = " - Prev. Início: ".$RomaneioPrevInicio;
			}
			else{
				$prevInicioExibe = "";	
			}
?>
    			<tr>
                  <td hidden="true"><input type="radio" name="check[]" hidden="true" class="check" id="check" value="<?php echo $RomaneioStatus.'-'.$RomaneioHandle; ?>"></td>
 				   <td width="1%"><?php echo $RomaneioStatusIcone; ?></td>
                  <td class="desktopHide">
                  <?php echo $numeroExibe.$viagemExibe.$romaneioExibe.$emissaoExibe.$placaExibe.$filialExibe.$pesoExibe.$valorMercExibe.$prevInicioExibe; ?>
                  </td>
    			</tr>
<?php
	}
?>
<?php
if(@$RomaneioHandle <= '' or @$RomaneioHandle == null){
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