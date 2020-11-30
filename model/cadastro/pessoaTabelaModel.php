<?php
$codigoPessoa = null;

$queryPessoa = $connect->prepare("SELECT TOP 1000
								A.HANDLE HANDLE,
								A.EHCLIENTE EHCLIENTE, 
								A.STATUS STATUS, 
								A.NOME NOME, 
								A.CNPJCPF CNPJCPF, 
								A.APELIDO APELIDO, 
								B2.NOME MUNICIPIO, 
								B3.SIGLA ESTADO, 
								A.CNPJCPF CNPJCPF,
								A.CODIGO CODIGO, 
								A.TELEFONE TELEFONE, 
								A.CELULAR CELULAR, 
								A.EMAIL EMAIL, 
								B8.NOME TIPOPESSOA, 
								A.DATAINCLUSAO DATAINCLUSAO, 
								B12.LOGIN USUARIOINCLUSAO,
								B14.NOME GRUPOEMPRESARIAL,
								B15.NOME RAMOATIVIDADE,
								B16.NOME SETORATIVIDADE,
								B17.NOME CATEGORIAATIVIDADE,
								B19.NOME FORMAPAGAMENTO,
								B20.NOME CONDICAOPAGAMENTO
								FROM MS_PESSOA A  
								LEFT JOIN MS_STATUSPESSOA B0 ON A.STATUS = B0.HANDLE 
								LEFT JOIN MS_PESSOAENDERECO B1 ON A.ENDERECOFISCAL = B1.HANDLE 
								LEFT JOIN MS_MUNICIPIO B2 ON B1.MUNICIPIO = B2.HANDLE 
								LEFT JOIN MS_ESTADO B3 ON B1.ESTADO = B3.HANDLE 
								LEFT JOIN MS_RAMOATIVIDADE B4 ON A.RAMOATIVIDADE = B4.HANDLE 
								LEFT JOIN MS_SETORATIVIDADE B5 ON A.SETORATIVIDADE = B5.HANDLE 
								LEFT JOIN MS_CATEGORIAATIVIDADE B6 ON A.CATEGORIAATIVIDADE = B6.HANDLE 
								LEFT JOIN MS_TIPOPESSOA B8 ON A.TIPO = B8.HANDLE 
								LEFT JOIN MS_PESSOA B9 ON A.GRUPOEMPRESARIAL = B9.HANDLE 
								LEFT JOIN MS_INATIVACAOPESSOA B10 ON A.INATIVACAOPESSOA = B10.HANDLE 
								LEFT JOIN MS_MOTIVOINATIVACAO B11 ON B10.MOTIVO = B11.HANDLE 
								LEFT JOIN MS_USUARIO B12 ON A.LOGUSUARIOCADASTRO = B12.HANDLE 
								LEFT JOIN MS_GRUPOEMPRESARIAL B14 ON A.GRUPOEMPRESARIAL = B14.HANDLE
								LEFT JOIN MS_RAMOATIVIDADE B15 ON A.RAMOATIVIDADE = B15.HANDLE
								LEFT JOIN MS_SETORATIVIDADE B16 ON A.SETORATIVIDADE = B16.HANDLE
								LEFT JOIN MS_CATEGORIAATIVIDADE B17 ON A.CATEGORIAATIVIDADE = B17.HANDLE
								LEFT JOIN MS_PESSOACLIENTE B18 ON A.HANDLE = B18.PESSOA
								LEFT JOIN FN_TIPOPAGAMENTO B19 ON B18.FORMAPAGAMENTO = B19.HANDLE
								LEFT JOIN FN_CONDICAOPAGAMENTO B20 ON B18.CONDICAOPAGAMENTO = B20.HANDLE
								ORDER BY A.APELIDO ASC
								") or die ('Erro ao executar sql de atendimentos.');
	
   
		$queryPessoa->execute();
	
		while($rowPessoa = $queryPessoa->fetch(PDO::FETCH_ASSOC)){
			
			$handlePessoa = $rowPessoa['HANDLE'];
			$codigoPessoa = $rowPessoa['CODIGO'];
			$EHCLIENTE = $rowPessoa['EHCLIENTE'];
			$statusPessoa = $rowPessoa['STATUS'];
			$nomePessoa = $rowPessoa['NOME']; 
			$cnpjCpf = $rowPessoa['CNPJCPF'];  
			$apelidoPessoa = $rowPessoa['APELIDO'];  
			$municipioPessoa = $rowPessoa['MUNICIPIO'];  
			$estadoPessoa = $rowPessoa['ESTADO'];  
			$telefonePessoa = $rowPessoa['TELEFONE'];  
			$celularPessoa = $rowPessoa['CELULAR'];  
			$emailPessoa = $rowPessoa['EMAIL'];  
			$tipoPessoa = $rowPessoa['TIPOPESSOA'];
			$dataInclusao = date('d/m/Y H:i', strtotime($rowPessoa['DATAINCLUSAO']));
			$usuarioInclusao = $rowPessoa['USUARIOINCLUSAO'];
			$grupoEmpresarial = $rowPessoa['GRUPOEMPRESARIAL'];
			$ramoAtividade = $rowPessoa['RAMOATIVIDADE'];
			$setorAtividade = $rowPessoa['SETORATIVIDADE'];
			$categoriaAtividade = $rowPessoa['CATEGORIAATIVIDADE'];
			$formaPagamento = $rowPessoa['FORMAPAGAMENTO'];
			$condicaoPagamento = $rowPessoa['CONDICAOPAGAMENTO'];

			if($statusPessoa == '1'){
				$statusIcone = "<img src='../../view/tecnologia/img/status/cinza/vazio.png' widtd='13px' height='13px'>";	
			}
			
			if($statusPessoa == '2'){
				$statusIcone = "<img src='../../view/tecnologia/img/status/amarelo/exclamacao.png' widtd='13px' height='13px'>";	
			}
			
			if($statusPessoa == '3'){
				$statusIcone = "<img src='../../view/tecnologia/img/status/azul/interrogacao.png' widtd='13px' height='13px'>";	
			}
			if($statusPessoa == '4'){
				$statusIcone = "<img src='../../view/tecnologia/img/status/verde/ok.png' widtd='13px' height='13px'>";	
			}
			if($statusPessoa == '5'){
				$statusIcone = "<img src='../../view/tecnologia/img/status/vermelho/vazio.png' widtd='13px' height='13px'>";	
			}
			if($statusPessoa == '6'){
				$statusIcone = "<img src='../../view/tecnologia/img/status/vermelho/x.png' widtd='13px' height='13px'>";	
			}
			if($statusPessoa == '7'){
				$statusIcone = "<img src='../../view/tecnologia/img/status/vermelho/x.png' widtd='13px' height='13px'>";	
			}
?>
    			<tr>
                  <td hidden="true"><input type="radio" name="check[]" hidden="true" id="check" value="<?php echo $statusPessoa.';'.$handlePessoa.';'.$codigoPessoa; ?>"></td>
                  <td widtd="1%" style="font-size:14px;"><?php echo $statusIcone; ?></td>
                  <td style="text-align:right;"><?php echo $codigoPessoa; ?></td>
                  <td><?php echo $apelidoPessoa; ?></td>
                  <td><?php echo $nomePessoa; ?></td>
                  <td><?php echo $municipioPessoa; ?></td>
                  <td><?php echo $estadoPessoa; ?></td>
                  <td><?php echo $tipoPessoa; ?></td>
                  <td><?php echo $cnpjCpf; ?></td>
                  <td><?php echo $telefonePessoa; ?></td>
                  <td><?php echo $celularPessoa; ?></td>
                  <td><?php echo $emailPessoa; ?></td>
                  <th><?php echo $setorAtividade; ?></th>
                  <th><?php echo $ramoAtividade; ?></th>
                  <th><?php echo $categoriaAtividade; ?></th>
                  <th><?php echo $grupoEmpresarial; ?></th>
                  <td><?php echo $dataInclusao; ?></td>
                  <td><?php echo $usuarioInclusao; ?></td>	
    			</tr>
<?php
		}
?>
<?php 
if(@$codigoPessoa <= '' or @$codigoPessoa == null){
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