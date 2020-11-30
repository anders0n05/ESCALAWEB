<?php
$cpf = $_SESSION['CPF'];
$codigoCurriculo = null;

$queryCurriculo = $connect->prepare("SELECT TOP 1000
										    A.STATUS STATUS, 
										    A.NUMERO NUMERO, 
										    A.NOME NOME, 
										    A.DATA DATA, 
										    A.CPF CPF, 
										    A.CELULAR CELULAR, 
										    B3.NOME CIDADE, 
										    B10.NOME ESPECIALIDADE, 
										    A.FORMACAO FORMACAO, 
											A.LOCALTRABALHO LOCALTRABALHO, 
											A.NASCIMENTO DATANASCIMENTO, 
											B7.NOME ESTADOCIVIL, 
											B5.NOME SEXO
									FROM RC_CURRICULO A  
									    LEFT JOIN MS_STATUS B0 ON A.STATUS = B0.HANDLE 
									  	LEFT JOIN RC_TIPOCURRICULO B1 ON A.TIPO = B1.HANDLE 
										LEFT JOIN MS_FILIAL B2 ON A.FILIAL = B2.HANDLE 
										LEFT JOIN MS_MUNICIPIO B3 ON A.CIDADE = B3.HANDLE 
										LEFT JOIN RC_CLASSIFICACAOANALISE B4 ON A.CLASSIFICACAOANALISE = B4.HANDLE 
										LEFT JOIN MS_SEXOPESSOA B5 ON A.SEXO = B5.HANDLE 
										LEFT JOIN RC_CURRICULOESPECIALIDADE B6 ON A.ESPECIALIDADE = B6.HANDLE 
										LEFT JOIN MS_ESTADOCIVIL B7 ON A.ESTADOCIVIL = B7.HANDLE 
										LEFT JOIN MS_PESSOA B8 ON A.INDICADOR = B8.HANDLE 
										LEFT JOIN MS_USUARIO B9 ON A.LOGUSUARIOALTERACAO = B9.HANDLE 
										LEFT JOIN RC_CURRICULOESPECIALIDADE B10 ON A.ESPECIALIDADE = B10.HANDLE
									WHERE 1 = 1 
										AND
											A.STATUS <> 6
										AND
											A.CPF = '".$cpf."'"
								) or die ('Erro ao executar sql de atendimentos.');
	
   
$queryCurriculo->execute();

while($rowPessoa = $queryCurriculo->fetch(PDO::FETCH_ASSOC)){
	
	$statusCurriculo 	= $rowPessoa['STATUS'];
	$codigoCurriculo 	= $rowPessoa['NUMERO'];
	$nomePessoa 		= $rowPessoa['NOME']; 
	$dataInclusao 		= $rowPessoa['DATA'];  
	$cpf 				= $rowPessoa['CPF'];  
	$celular 			= $rowPessoa['CELULAR'];  
	$cidade 			= $rowPessoa['CIDADE'];  
	$especialidade 		= $rowPessoa['ESPECIALIDADE'];  
	$formacao 			= $rowPessoa['FORMACAO'];  
	$localTrabalho 		= $rowPessoa['LOCALTRABALHO'];  
	$dataNascimento 	= $rowPessoa['DATANASCIMENTO'];  
	$estadoCivil 		= $rowPessoa['ESTADOCIVIL'];  
	$sexo 				= $rowPessoa['SEXO'];  

if($statusCurriculo == '1'){
	$statusIcone = "<img src='../../view/tecnologia/img/status/cinza/vazio.png' widtd='13px' height='13px'>";	
}

if($statusCurriculo == '2'){
	$statusIcone = "<img src='../../view/tecnologia/img/status/amarelo/exclamacao.png' widtd='13px' height='13px'>";	
}

if($statusCurriculo == '3'){
	$statusIcone = "<img src='../../view/tecnologia/img/status/azul/interrogacao.png' widtd='13px' height='13px'>";	
}
if($statusCurriculo == '5'){
	$statusIcone = "<img src='../../view/tecnologia/img/status/verde/ok.png' widtd='13px' height='13px'>";	
}
if($statusCurriculo == '4'){
	$statusIcone = "<img src='../../view/tecnologia/img/status/vermelho/vazio.png' widtd='13px' height='13px'>";	
}
if($statusCurriculo == '6'){
	$statusIcone = "<img src='../../view/tecnologia/img/status/vermelho/x.png' widtd='13px' height='13px'>";	
}
if($statusCurriculo == '7'){
	$statusIcone = "<img src='../../view/tecnologia/img/status/vermelho/x.png' widtd='13px' height='13px'>";	
}
if($statusCurriculo == '16'){
	$statusIcone = "<img src='../../view/tecnologia/img/status/verde/ok.png' widtd='13px' height='13px'>";	
}
?>

<tr>
  <td hidden="true"><input type="radio" name="check[]" hidden="true" id="check" value="<?php echo $statusCurriculo.'; '.$codigoCurriculo; ?>"></td>
  <td widtd="1%" style="font-size:14px;"><?php echo $statusIcone; ?></td>
  <td style="text-align:right;"><?php echo $codigoCurriculo; ?></td>
  <td><?php echo $nomePessoa; ?></td>
  <td><?php echo $dataInclusao; ?></td>
  <td><?php echo $cpf; ?></td>
  <td><?php echo $celular; ?></td>
  <td><?php echo $cidade; ?></td>
  <td><?php echo $especialidade; ?></td>
  <td><?php echo date("d/m/Y", strtotime($dataNascimento)); ?></td>
  <td><?php echo $estadoCivil; ?></td>
  <td><?php echo $sexo; ?></td>
</tr>
<?php
		}
?>
<?php 
if(@$codigoCurriculo <= '' or @$codigoCurriculo == null){
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