<?php
$transportadora = null;

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

$queryPessoasUsuario = "SELECT PESSOA
						FROM MS_USUARIOPESSOA
						WHERE USUARIO = $handleUsuario";


$queryPessoasUsuario = $connect->prepare($queryPessoasUsuario);

$queryPessoasUsuario->execute();
$rowPessoasUsuario = $queryPessoasUsuario->fetch(PDO::FETCH_ASSOC);

if($rowPessoasUsuario['PESSOA'] > 0){
	
foreach($rowPessoasUsuario as $handlePessoaUsuario)
	$wherePessoasUsuario = "AND (A.TRANSPORTADORA IN (".$handlePessoaUsuario.") OR A.CLIENTE IN (".$handlePessoaUsuario."))	";
}
else{
	$wherePessoasUsuario = "";
}

$queryProgramacao =   "SELECT A.HANDLE HANDLE,  
					   A.STATUS STATUS, 
					   A.NUMERO NUMERO,
					   B1.SIGLA FILIAL, 
					   B2.SIGLA TIPO, 
					   B3.SIGLA DOCA, 
					   A.DATA DATA, 
					   A.PREVISAOENTREGA PREVISAOENTREGA, 
					   A.PLACA VEICULO, 
					   A.CARRETA ACOPLADO, 
					   A.MOTORISTA MOTORISTA, 
					   A.QUANTIDADEEMBALAGEM EMBALAGEM, 
					   A.NUMEROCONTROLE NUMEROCONTROLE, 
					   A.QUANTIDADEVOLUME VOLUME, 
					   B5.NOME TIPOVEICULO, 
					   B6.CODIGO CONTEINER, 
					   A.PESOBRUTO PESOBRUTO, 
					   B8.NOME STATUSNOME,
					   B7.APELIDO CLIENTE
					   FROM AM_CARREGAMENTO A  
					   LEFT JOIN AM_STATUSCARREGAMENTO B0 ON A.STATUS = B0.HANDLE 
					   LEFT JOIN MS_FILIAL B1 ON A.FILIAL = B1.HANDLE 
					   LEFT JOIN AM_TIPOCARREGAMENTO B2 ON A.TIPO = B2.HANDLE 
					   LEFT JOIN AM_DOCA B3 ON A.DOCA = B3.HANDLE 
					   LEFT JOIN MF_TIPOVEICULO B5 ON A.TIPOVEICULO = B5.HANDLE 
					   LEFT JOIN PA_CONTEINER B6 ON A.CONTEINER = B6.HANDLE 
					   LEFT JOIN MS_PESSOA B7 ON A.CLIENTE = B7.HANDLE 
					   LEFT JOIN AM_STATUSCARREGAMENTO B8 ON B8.HANDLE = A.STATUS
					   WHERE A.EMPRESA = '".$empresa."'
					   --AND A.STATUS NOT IN (4, 5)
					   ".$wherePessoasUsuario." 
					   ".$whereData." 
						AND";
								   
if($transportadoraHandle > null){
foreach($_POST['transportadora'] as $transportadora){
	
$transportadoraExplode = explode(';', $transportadora);
$transportadoraHandle = $transportadoraExplode[0];

$queryProgramacao .= " A.TRANSPORTADORA = '".$transportadoraHandle."' OR ";

}
}

								   
								   
	$queryProgramacao = substr($queryProgramacao, 0, -3);
	
					  
	$queryProgramacao = $connect->prepare($queryProgramacao);
	$queryProgramacao->execute();
		while($rowProgramacao = $queryProgramacao->fetch(PDO::FETCH_ASSOC)){
			
			$ProgramacaoHandle = $rowProgramacao['HANDLE'];
			$ProgramacaoStatus = $rowProgramacao['STATUS'];
			$ProgramacaoStatusNome = $rowProgramacao['STATUSNOME'];
			$ProgramacaoNumero = $rowProgramacao['NUMERO'];
			$ProgramacaoFilial = $rowProgramacao['FILIAL'];
			$ProgramacaoTipo = $rowProgramacao['TIPO'];
			$ProgramacaoDoca = $rowProgramacao['DOCA'];
			$ProgramacaoData = date('d/m/Y H:i', strtotime($rowProgramacao['DATA']));
			$ProgramacaoPrevisaoEntrega = date('d/m/Y H:i', strtotime($rowProgramacao['PREVISAOENTREGA']));
			$ProgramacaoVeiculo = $rowProgramacao['VEICULO'];
			$ProgramacaoAcoplado = $rowProgramacao['ACOPLADO'];
			$ProgramacaoMotorista = $rowProgramacao['MOTORISTA'];
			$ProgramacaoEmbalagem = $rowProgramacao['EMBALAGEM'];
			$ProgramacaoNumeroControle = $rowProgramacao['NUMEROCONTROLE'];
			$ProgramacaoVolume = $rowProgramacao['VOLUME'];
			$ProgramacaoTipoVeiculo = $rowProgramacao['TIPOVEICULO'];
			$ProgramacaoConteiner = $rowProgramacao['CONTEINER'];
			$ProgramacaoPesoBruto = $rowProgramacao['PESOBRUTO'];
			$ProgramacaoCliente = $rowProgramacao['CLIENTE'];			
			
			if($ProgramacaoStatus == '1'){
				$ProgramacaoStatusIcone = "<img src='../../view/tecnologia/img/status/cinza/vazio.png' width='13px' height='auto' title='".$ProgramacaoStatusNome."' alt='".$ProgramacaoStatusNome."'>";
			}
			if($ProgramacaoStatus == '2'){
				$ProgramacaoStatusIcone = "<img src='../../view/tecnologia/img/status/amarelo/exclamacao.png' width='13px' height='auto' title='".$ProgramacaoStatusNome."' alt='".$ProgramacaoStatusNome."'>";
			}
			if($ProgramacaoStatus == '3'){
				$ProgramacaoStatusIcone = "<img src='../../view/tecnologia/img/status/verde/vazio.png' width='13px' height='auto' title='".$ProgramacaoStatusNome."' alt='".$ProgramacaoStatusNome."'>";
			}
			if($ProgramacaoStatus == '4'){
				$ProgramacaoStatusIcone = "<img src='../../view/tecnologia/img/status/verde/ok.png' width='13px' height='auto' title='".$ProgramacaoStatusNome."' alt='".$ProgramacaoStatusNome."'>";
			}
			if($ProgramacaoStatus == '5'){
				$ProgramacaoStatusIcone = "<img src='../../view/tecnologia/img/status/vermelho/x.png' width='13px' height='auto' title='".$ProgramacaoStatusNome."' alt='".$ProgramacaoStatusNome."'>";
			}
			if($ProgramacaoStatus == '6'){
				$ProgramacaoStatusIcone = "<img src='../../view/tecnologia/img/status/cerde/verificado.png' width='13px' height='auto' title='".$ProgramacaoStatusNome."' alt='".$ProgramacaoStatusNome."'>";
			}
			if($ProgramacaoStatus == '7'){
				$ProgramacaoStatusIcone = "<img src='../../view/tecnologia/img/status/cinza/vazio.png' width='13px' height='auto' title='".$ProgramacaoStatusNome."' alt='".$ProgramacaoStatusNome."'>";
			}
			if($ProgramacaoStatus == '8'){
				$ProgramacaoStatusIcone = "<img src='../../view/tecnologia/img/status/azul/seta_direita.png' width='13px' height='auto' title='".$ProgramacaoStatusNome."' alt='".$ProgramacaoStatusNome."'>";
			}
			if($ProgramacaoStatus == '9'){
				$ProgramacaoStatusIcone = "<img src='../../view/tecnologia/img/status/azul/seta_esquerda.png' width='13px' height='auto' title='".$ProgramacaoStatusNome."' alt='".$ProgramacaoStatusNome."'>";
			}
			if($ProgramacaoStatus == '10'){
				$ProgramacaoStatusIcone = "<img src='../../view/tecnologia/img/status/azul/ponto.png' width='13px' height='auto' title='".$ProgramacaoStatusNome."' alt='".$ProgramacaoStatusNome."'>";
			}
			if($ProgramacaoStatus == '12'){
				$ProgramacaoStatusIcone = "<img src='../../view/tecnologia/img/status/azul/seta_direita.png' width='13px' height='auto' title='".$ProgramacaoStatusNome."' alt='".$ProgramacaoStatusNome."'>";
			}
			if($ProgramacaoStatus == '13'){
				$ProgramacaoStatusIcone = "<img src='../../view/tecnologia/img/status/verde/ponto.png' width='13px' height='auto' title='".$ProgramacaoStatusNome."' alt='".$ProgramacaoStatusNome."'>";
			}
			if($ProgramacaoStatus == '14'){
				$ProgramacaoStatusIcone = "<img src='../../view/tecnologia/img/status/amarelo/vazio.png' width='13px' height='auto' title='".$ProgramacaoStatusNome."' alt='".$ProgramacaoStatusNome."'>";
			}
			if($ProgramacaoStatus == '15'){
				$ProgramacaoStatusIcone = "<img src='../../view/tecnologia/img/status/azul/sustenido.png' width='13px' height='auto' title='".$ProgramacaoStatusNome."' alt='".$ProgramacaoStatusNome."'>";
			}
				
					
			
			if($ProgramacaoNumero > ''){
				$ProgramacaoNumeroExibe = 'Número: '.$ProgramacaoNumero;
			}
			else{
				$ProgramacaoNumeroExibe = null;
			}
			if($ProgramacaoData > ''){
				$ProgramacaoDataExibe = ' - Data: '.$ProgramacaoData;
			}
			else{
				$ProgramacaoDataExibe = null;
			}
			if($ProgramacaoTipo > ''){
				$ProgramacaoTipoExibe = ' - Tipo: '.$ProgramacaoTipo;
			}
			else{
				$ProgramacaoTipoExibe = null;
			}
			if($ProgramacaoFilial > ''){
				$ProgramacaoFilialExibe = ' - Filial: '.$ProgramacaoFilial;
			}
			else{
				$ProgramacaoFilialExibe = null;
			}
			if($ProgramacaoPrevisaoEntrega > ''){
				$ProgramacaoPrevisaoEntregaExibe = ' - Prev. entrega: '.$ProgramacaoPrevisaoEntrega;
			}
			else{
				$ProgramacaoPrevisaoEntregaExibe = null;
			}
			if($ProgramacaoDoca > ''){
				$ProgramacaoDocaExibe = ' - Doca: '.$ProgramacaoDoca;
			}
			else{
				$ProgramacaoDocaExibe = null;
			}
			if($ProgramacaoDoca > ''){
				$ProgramacaoDocaExibe = ' - Doca: '.$ProgramacaoDoca;
			}
			else{
				$ProgramacaoDocaExibe = null;
			}
			if($ProgramacaoNumeroControle > ''){
				$ProgramacaoNumeroControleExibe = ' - Controle: '.$ProgramacaoNumeroControle;
			}
			else{
				$ProgramacaoNumeroControleExibe = null;
			}
			if($ProgramacaoVolume > ''){
				$ProgramacaoVolumeExibe = ' - Volume: '.$ProgramacaoVolume;
			}
			else{
				$ProgramacaoVolumeExibe = null;
			}
			if($ProgramacaoEmbalagem > ''){
				$ProgramacaoEmbalagemExibe = ' - Embalagem: '.$ProgramacaoEmbalagem;
			}
			else{
				$ProgramacaoEmbalagemExibe = null;
			}
			if($ProgramacaoPesoBruto > ''){
				$ProgramacaoPesoBrutoExibe = ' - Peso bruto: '.number_format($ProgramacaoPesoBruto, '4', ',', '.');
			}
			else{
				$ProgramacaoPesoBrutoExibe = null;
			}
			if($ProgramacaoTipoVeiculo > ''){
				$ProgramacaoTipoVeiculoExibe = ' - Tipo veículo: '.$ProgramacaoTipoVeiculo;
			}
			else{
				$ProgramacaoTipoVeiculoExibe = null;
			}
			if($ProgramacaoVeiculo > ''){
				$ProgramacaoVeiculoExibe = ' - Veículo: '.$ProgramacaoVeiculo;
			}
			else{
				$ProgramacaoVeiculoExibe = null;
			}
			if($ProgramacaoAcoplado > ''){
				$ProgramacaoAcopladoExibe = ' - Acoplado: '.$ProgramacaoAcoplado;
			}
			else{
				$ProgramacaoAcopladoExibe = null;
			}
			if($ProgramacaoConteiner > ''){
				$ProgramacaoConteinerExibe = ' - Conteiner: '.$ProgramacaoConteiner;
			}
			else{
				$ProgramacaoConteinerExibe = null;
			}
			if($ProgramacaoMotorista > ''){
				$ProgramacaoMotoristaExibe = ' - Motorista: '.$ProgramacaoMotorista;
			}
			else{
				$ProgramacaoMotoristaExibe = null;
			}
			if($ProgramacaoCliente > ''){
				$ProgramacaoClienteExibe = ' - Cliente: '.$ProgramacaoCliente;
			}
			else{
				$ProgramacaoClienteExibe = null;
			}
?>
    			<tr>
                  <td hidden="true"><input type="radio" name="check[]" class="check" hidden="true" id="check" value="<?php echo $ProgramacaoHandle; ?>"></td>
 				   <td width="1%"><?php echo $ProgramacaoStatusIcone; ?></td> 
                   <td><?php echo $ProgramacaoNumeroExibe.$ProgramacaoDataExibe.$ProgramacaoTipoExibe.$ProgramacaoFilialExibe.$ProgramacaoPrevisaoEntregaExibe.$ProgramacaoDocaExibe.$ProgramacaoNumeroControleExibe.$ProgramacaoVolumeExibe.$ProgramacaoEmbalagemExibe.$ProgramacaoPesoBrutoExibe.$ProgramacaoTipoVeiculoExibe.$ProgramacaoVeiculoExibe.$ProgramacaoAcopladoExibe.$ProgramacaoConteinerExibe.$ProgramacaoMotoristaExibe.$ProgramacaoClienteExibe; ?></td>
    			</tr>
<?php
	}
?>
<?php
if(@$ProgramacaoHandle <= '' or @$ProgramacaoHandle == null){
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