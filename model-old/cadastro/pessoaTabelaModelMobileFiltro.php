<?php
$codigoPessoaMobile = null;

	    $queryPessoa->execute();
		
		while($rowPessoaMobile = $queryPessoa->fetch(PDO::FETCH_ASSOC)){
			
			$handlePessoaMobile = $rowPessoaMobile['HANDLE'];
			$codigoPessoaMobile = $rowPessoaMobile['CODIGO'];
			$EHCLIENTEMobile = $rowPessoaMobile['EHCLIENTE'];
			$statusPessoaMobile = $rowPessoaMobile['STATUS'];
			$nomePessoaMobile = $rowPessoaMobile['NOME']; 
			$cnpjCpfMobile = $rowPessoaMobile['CNPJCPF'];  
			$apelidoPessoaMobile = $rowPessoaMobile['APELIDO'];  
			$municipioPessoaMobile = $rowPessoaMobile['MUNICIPIO'];  
			$estadoPessoaMobile = $rowPessoaMobile['ESTADO'];  
			$telefonePessoaMobile = $rowPessoaMobile['TELEFONE'];  
			$celularPessoaMobile = $rowPessoaMobile['CELULAR'];  
			$emailPessoaMobile = $rowPessoaMobile['EMAIL'];  
			$tipoPessoaMobile = $rowPessoaMobile['TIPOPESSOA'];
			$dataInclusaoMobile = date('d/m/Y H:i', strtotime($rowPessoaMobile['DATAINCLUSAO']));
			$usuarioInclusaoMobile = $rowPessoaMobile['USUARIOINCLUSAO'];
			$grupoEmpresarialMobile = $rowPessoaMobile['GRUPOEMPRESARIAL'];
			$ramoAtividadeMobile = $rowPessoaMobile['RAMOATIVIDADE'];
			$setorAtividadeMobile = $rowPessoaMobile['SETORATIVIDADE'];
			$categoriaAtividadeMobile = $rowPessoaMobile['CATEGORIAATIVIDADE'];
			$formaPagamentoMobile = $rowPessoaMobile['FORMAPAGAMENTO'];
			$condicaoPagamentoMobile = $rowPessoaMobile['CONDICAOPAGAMENTO'];

			if($statusPessoaMobile == '1'){
				$statusIconeMobile = "<img src='../../view/tecnologia/img/status/cinza/vazio.png' widtd='13px' height='13px'>";	
			}
			
			if($statusPessoaMobile == '2'){
				$statusIconeMobile = "<img src='../../view/tecnologia/img/status/amarelo/exclamacao.png' widtd='13px' height='13px'>";	
			}
			
			if($statusPessoaMobile == '3'){
				$statusIconeMobile = "<img src='../../view/tecnologia/img/status/azul/interrogacao.png' widtd='13px' height='13px'>";	
			}
			if($statusPessoaMobile == '4'){
				$statusIconeMobile = "<img src='../../view/tecnologia/img/status/verde/ok.png' widtd='13px' height='13px'>";	
			}
			if($statusPessoaMobile == '5'){
				$statusIconeMobile = "<img src='../../view/tecnologia/img/status/vermelho/vazio.png' widtd='13px' height='13px'>";	
			}
			if($statusPessoaMobile == '6'){
				$statusIconeMobile = "<img src='../../view/tecnologia/img/status/vermelho/x.png' widtd='13px' height='13px'>";	
			}
			if($statusPessoaMobile == '7'){
				$statusIconeMobile = "<img src='../../view/tecnologia/img/status/vermelho/x.png' widtd='13px' height='13px'>";	
			}
			
			
			if($codigoPessoaMobile > null){
				$codigoPessoaMobileExibe = 'Código: '.$codigoPessoaMobile;
			}
			else{
				$codigoPessoaMobileExibe = null;
			}
			if($nomePessoaMobile > null){
				$nomePessoaMobileExibe = ' - Nome/razão social: '.$nomePessoaMobile;
			}
			else{
				$nomePessoaMobileExibe = null;
			}
			if($apelidoPessoaMobile > null){
				$apelidoPessoaMobileexibe = ' - Apelido/nome fantasia: '.$apelidoPessoaMobile;
			}
			else{
				$apelidoPessoaMobileexibe = null;
			}
			if($tipoPessoaMobile > null){
				$tipoPessoaMobileExibe = ' - Tipo: '.$tipoPessoaMobile;
			}
			else{
				$tipoPessoaMobileExibe = null;
			}
			if($cnpjCpfMobile > null){
				$cnpjCpfMobileExibe = ' - CNPJ/CPF: '.$cnpjCpfMobile;
			}
			else{
				$cnpjCpfMobileExibe = null;
			}
			if($municipioPessoaMobile > null){
				$municipioPessoaMobileExibe = ' - Município: '.$municipioPessoaMobile;
			}
			else{
				$municipioPessoaMobileExibe = null;
			}
			if($estadoPessoaMobile > null){
				$estadoPessoaMobileExibe = ' - Estado: '.$estadoPessoaMobile;
			}
			else{
				$estadoPessoaMobileExibe = null;
			}
			if($telefonePessoaMobile > null){
				$telefonePessoaMobileExibe = ' - Telefone: '.$telefonePessoaMobile;
			}
			else{
				$telefonePessoaMobileExibe = null;
			}
			if($celularPessoaMobile > null){
				$celularPessoaMobileExibe = ' - Celular: '.$celularPessoaMobile;
			}
			else{
				$celularPessoaMobileExibe = null;
			}
			if($emailPessoaMobile > null){
				$emailPessoaMobileExibe = ' - E-mail: '.$emailPessoaMobile;
			}
			else{
				$emailPessoaMobileExibe = null;
			}
			if($setorAtividadeMobile > null){
				$setorAtividadeMobileExibe = ' - Setor de atividade: '.$setorAtividadeMobile;
			}
			else{
				$setorAtividadeMobileExibe = null;
			}
			if($ramoAtividadeMobile > null){
				$ramoAtividadeMobileExibe = ' - Ramo de atividade: '.$ramoAtividadeMobile;
			}
			else{
				$ramoAtividadeMobileExibe = null;
			}
			if($categoriaAtividadeMobile > null){
				$categoriaAtividadeMobileExibe = ' - Categoria de atividade: '.$categoriaAtividadeMobile;
			}
			else{
				$categoriaAtividadeMobileExibe = null;
			}
			if($grupoEmpresarialMobile > null){
				$grupoEmpresarialMobileExibe = ' - Grupo empresarial: '.$grupoEmpresarialMobile;
			}
			else{
				$grupoEmpresarialMobileExibe = null;
			}
			if($dataInclusaoMobile > null){
				$dataInclusaoMobileExibe = ' - Data de inclusão: '.$dataInclusaoMobile;
			}
			else{
				$dataInclusaoMobileExibe = null;
			}
			if($usuarioInclusaoMobile > null){
				$usuarioInclusaoMobileExibe = ' - Usuário inclusão: '.$usuarioInclusaoMobile;
			}
			else{
				$usuarioInclusaoMobileExibe = null;
			}
?>
    			<tr>
                  <td hidden="true"><input type="radio" name="check[]" hidden="true" id="check" value="<?php echo $statusPessoaMobile.';'.$handlePessoaMobile.';'.$codigoPessoaMobileExibe; ?>"></td>
                  <td widtd="1%" style="font-size:14px;"><?php echo $statusIconeMobile; ?></td>
                  <td><?php echo $codigoPessoaMobileExibe.$apelidoPessoaMobileexibe.$nomePessoaMobileExibe.$municipioPessoaMobileExibe.$estadoPessoaMobileExibe.$tipoPessoaMobileExibe.$cnpjCpfMobileExibe.$telefonePessoaMobileExibe.$celularPessoaMobileExibe.$emailPessoaMobileExibe.$setorAtividadeMobileExibe.$ramoAtividadeMobileExibe.$categoriaAtividadeMobileExibe.$grupoEmpresarialMobileExibe.$dataInclusaoMobileExibe.$usuarioInclusaoMobileExibe; ?></td>	
    			</tr>
<?php
		}
?>
<?php
if(@$codigoPessoaMobile <= '' or @$codigoPessoaMobile == null){
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