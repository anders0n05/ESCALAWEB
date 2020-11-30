<?php
$nomePessoa = NULL;
$apelido = NULL;
$codigo = NULL;
$cnpjCpf = NULL;
$fone = NULL;
$celular = NULL;
$email = NULL;
$ramoAtividade = NULL;
$ramoAtividadeHandle = NULL;
$setorAtividade = NULL;
$setorAtividadeHandle = NULL;
$categoriaAtividade = NULL;
$categoriaAtividadeHandle = NULL;
$observacao = NULL;
$inscricaoEstadual = NULL;
$grupoEmpresarial = NULL;
$grupoEmpresarialHandle = NULL;
$naturalidade = NULL;
$naturalidadeHandle = NULL;
$estadoCivil = NULL;
$estadoCivilHandle = NULL;
$sexo = NULL;
$sexoHandle = NULL;
$nascimento = NULL;
$dependente = NULL;
$escolaridade = NULL;
$escolaridadeHandle = NULL;
$localTrabalho = NULL;
$admissao = NULL;
$nomePai = NULL;
$nomeMae = NULL;
$nomeConjugue = NULL;
$cep = NULL;
$cepHandle = NULL;
$tipoLogradouro = NULL;
$tipoLogradouroHandle = NULL;
$logradouro = NULL;
$numeroEndereco = NULL;
$ehSemNumero = NULL;
$complementoEndereco = NULL;
$pais = NULL;
$paisHandle = NULL;
$estado = NULL;
$estadoHandle = NULL;
$municipio = NULL;
$municipioHandle = NULL;
$bairro = NULL;
$bairroHandle = NULL;
$disabled = NULL;
$tipo = NULL;
$tipoHandle = NULL;
$data = NULL;
$hora = NULL;
$FormaPagamento = NULL;
$FormaPagamentoHandle = NULL;
$CondicaoPagamento = NULL;
$CondicaoPagamentoHandle = NULL;
$mensagem = NULL;
$protocolo = NULL;
$gravou = NULL;

$queryPessoa = $connect->prepare("SELECT A.HANDLE HANDLE,
									A.NOME NOME,
									A.APELIDO APELIDO,
									A.CNPJCPF CNPJCPF,
									A.TELEFONE FONE,
									A.CELULAR CELULAR,
									A.CODIGO CODIGOPESSOA,
									A.DATANASCIMENTO NASCIMENTO,
									A.DEPENDENTES DEPENDENTE,
									A.STATUS STATUS,
									A.DATAADMISSAO ADMISSAO,
									A.LOCALTRABALHO LOCALTRABALHO,
									A.OBSERVACAO,
									A.NOMEDOPAI NOMEPAI,
									A.NOMEMAE NOMEMAE,
									A.NOMECONJUGE NOMECONJUGUE,
									A.INSCRICAOESTADUAL,
									B0.HANDLE SEXOHANDLE,
									B0.NOME SEXO,
									B1.HANDLE TIPOPESSOAHANDLE,
									B1.NOME TIPOPESSOA,
									B2.HANDLE ESCOLARIDADEHANDLE,
									B2.NOME ESCOLARIDADE,
									B3.HANDLE ESTADOCIVILHANDLE,
									B3.NOME ESTADOCIVIL,
									B4.HANDLE NATURALIDADEHANDLE,
									B4.NOME NATURALIDADE,
									B5.HANDLE GRUPOEMPRESARIALHANDLE,
									B5.NOME GRUPOEMPRESARIAL,
									B6.HANDLE RAMOATIVIDADEHANDLE,
									B6.NOME RAMOATIVIDADE,
									B7.HANDLE SETORATIVIDADEHANDLE,
									B7.NOME SETORATIVIDADE,
									B8.HANDLE CATEGORIAATIVIDADEHANDLE,
									B8.NOME CATEGORIAATIVIDADE,
									B10.HANDLE CEPHANDLE,
									B10.CEP CEP,
									B11.HANDLE MUNICIPIOHANDLE,
									B11.NOME MUNICIPIO,
									B12.HANDLE ESTADOHANDLE,
									B12.NOME ESTADO,
									B13.HANDLE BAIRROHANDLE,
									B13.NOME BAIRRO,
									B14.HANDLE TIPOLOGRADOUROHANDLE,
									B14.NOME TIPOLOGRADOURO,
									B15.HANDLE PAISHANDLE,
									B15.NOME PAIS,
									B10.LOGRADOURO LOGRADOURO,
									B9.NUMERO NUMEROENDERECO,
									B9.EHSEMNUMERO EHSEMNUMERO, 
									B17.HANDLE FORMAPAGAMENTOHANDLE,
									B17.NOME FORMAPAGAMENTO,
									B18.HANDLE CONDICAOPAGAMENTOHANDLE,
									B18.NOME CONDICAOPAGAMENTO
									FROM MS_PESSOA A
									LEFT JOIN MS_SEXOPESSOA B0 ON A.SEXO = B0.HANDLE
									LEFT JOIN MS_TIPOPESSOA B1 ON A.TIPO = B1.HANDLE
									LEFT JOIN MS_ESCOLARIDADE B2 ON A.ESCOLARIDADE = B2.HANDLE
									LEFT JOIN MS_ESTADOCIVIL B3 ON A.ESTADOCIVIL = B3.HANDLE
									LEFT JOIN MS_MUNICIPIO B4 ON A.NATURALIDADE = B4.HANDLE
									LEFT JOIN MS_GRUPOEMPRESARIAL B5 ON A.GRUPOEMPRESARIAL = B5.HANDLE
									LEFT JOIN MS_RAMOATIVIDADE B6 ON A.RAMOATIVIDADE = B6.HANDLE
									LEFT JOIN MS_SETORATIVIDADE B7 ON A.SETORATIVIDADE = B7.HANDLE
									LEFT JOIN MS_CATEGORIAATIVIDADE B8 ON A.CATEGORIAATIVIDADE = B8.HANDLE
									LEFT JOIN MS_PESSOAENDERECO B9 ON A.ENDERECOFISCAL = B9.HANDLE
									LEFT JOIN MS_CEP B10 ON B9.CEP = B10.HANDLE
									LEFT JOIN MS_MUNICIPIO B11 ON B10.MUNICIPIO = B0.HANDLE 
									LEFT JOIN MS_ESTADO B12 ON B10.ESTADO = B12.HANDLE
									LEFT JOIN MS_BAIRRO B13 ON B10.BAIRRO = B13.HANDLE
									LEFT JOIN MS_TIPOLOGRADOURO B14 ON B10.TIPOLOGRADOURO = B14.HANDLE
									LEFT JOIN MS_PAIS B15 ON B10.PAIS = B15.HANDLE
									LEFT JOIN MS_PESSOACLIENTE B16 ON A.HANDLE = B16.PESSOA
									LEFT JOIN FN_TIPOPAGAMENTO B17 ON B16.FORMAPAGAMENTO = B17.HANDLE
									LEFT JOIN FN_CONDICAOPAGAMENTO B18 ON B16.CONDICAOPAGAMENTO = B18.HANDLE
									WHERE A.HANDLE = ".$pessoaHandle."
									");
	$queryPessoa->execute();
	$rowPessoa = $queryPessoa->fetch(PDO::FETCH_ASSOC);
	
	$nomePessoa = $rowPessoa['NOME'];
	$apelido = $rowPessoa['APELIDO'];
	$cnpjCpf = $rowPessoa['CNPJCPF'];
	$fone = $rowPessoa['FONE'];
	$celular = $rowPessoa['CELULAR'];
	$codigo = $rowPessoa['CODIGOPESSOA'];
	$nascimento = $rowPessoa['NASCIMENTO'];
	$dependente = $rowPessoa['DEPENDENTE'];
	$statusPessoa = $rowPessoa['STATUS'];
	$admissao = $rowPessoa['ADMISSAO'];
	$localTrabalho = $rowPessoa['LOCALTRABALHO'];
	$observacao = $rowPessoa['OBSERVACAO'];
	$nomePai = $rowPessoa['NOMEPAI'];
	$nomeMae = $rowPessoa['NOMEMAE'];
	$nomeConjugue = $rowPessoa['NOMECONJUGUE'];
	$inscricaoEstadual = $rowPessoa['INSCRICAOESTADUAL'];
	$sexoHandle = $rowPessoa['SEXOHANDLE'];
	$sexo = $rowPessoa['SEXO'];
	$tipoHandle = $rowPessoa['TIPOPESSOAHANDLE'];
	$tipo = $rowPessoa['TIPOPESSOA'];
	$escolaridadeHandle = $rowPessoa['ESCOLARIDADEHANDLE'];
	$escolaridade = $rowPessoa['ESCOLARIDADE'];
	$estadoCivilHandle = $rowPessoa['ESTADOCIVILHANDLE'];
	$estadoCivil = $rowPessoa['ESTADOCIVIL'];
	$naturalidadeHandle = $rowPessoa['NATURALIDADEHANDLE'];
	$naturalidade = $rowPessoa['NATURALIDADE'];
	$grupoEmpresarialHandle = $rowPessoa['GRUPOEMPRESARIALHANDLE'];
	$grupoEmpresarial = $rowPessoa['GRUPOEMPRESARIAL'];
	$ramoAtividadeHandle = $rowPessoa['RAMOATIVIDADEHANDLE'];
	$ramoAtividade = $rowPessoa['RAMOATIVIDADE'];
	$setorAtividadeHandle = $rowPessoa['SETORATIVIDADEHANDLE'];
	$setorAtividade = $rowPessoa['SETORATIVIDADE'];
	$categoriaAtividadeHandle = $rowPessoa['CATEGORIAATIVIDADEHANDLE'];
	$categoriaAtividade = $rowPessoa['CATEGORIAATIVIDADE'];
	$cepHandle = $rowPessoa['CEPHANDLE'];
	$cep = $rowPessoa['CEP'];
	$municipioHandle = $rowPessoa['MUNICIPIOHANDLE'];
	$municipio = $rowPessoa['MUNICIPIO'];
	$estadoHandle = $rowPessoa['ESTADOHANDLE'];
	$estado = $rowPessoa['ESTADO'];
	$bairroHandle = $rowPessoa['BAIRROHANDLE'];
	$bairro = $rowPessoa['BAIRRO'];
	$tipoLogradouroHandle = $rowPessoa['TIPOLOGRADOUROHANDLE'];
	$tipoLogradouro = $rowPessoa['TIPOLOGRADOURO'];
	$paisHandle = $rowPessoa['PAISHANDLE'];
	$pais = $rowPessoa['PAIS'];
	$logradouro = $rowPessoa['LOGRADOURO'];
	$FormaPagamentoHandle = $rowPessoa['FORMAPAGAMENTOHANDLE'];
	$FormaPagamento = $rowPessoa['FORMAPAGAMENTO'];
	$CondicaoPagamentoHandle = $rowPessoa['CONDICAOPAGAMENTOHANDLE'];
	$CondicaoPagamento = $rowPessoa['CONDICAOPAGAMENTO'];
	$numeroEndereco = $rowPessoa['NUMEROENDERECO'];
	$ehSemNumero = $rowPessoa['EHSEMNUMERO'];
	if($ehSemNumero == 'S'){
		$numeroEndereco = 'S/N';
		$disabledNumeroEndereco = 'disabled';
		$checkEhSemNumero = 'checked';	
	}
	else{
		$disabledNumeroEndereco = '';
		$checkEhSemNumero = '';		
	}
	
	if($tipoHandle == '1'){
		$titulocnpjCpfCpf = 'CPF';
		$titulocnpjCpfCpftipoHandle = 'CPF';
		$cpfDisplay = '';
		$cnpjCpfDisplay = 'display';	
	}
	if($tipoHandle == '2'){
		$titulocnpjCpfCpf = 'CNPJ';
		$cpfDisplay = 'display';
		$cnpjCpfDisplay = '';	
	}
	if($tipoHandle == '3'){
		$titulocnpjCpfCpf = 'Identificação';	
		$cpfDisplay = 'display';
		$cnpjCpfDisplay = 'display';	
	}
	if($tipoHandle == '4'){
		$titulocnpjCpfCpf = 'Identificação';	
		$cpfDisplay = 'display';
		$cnpjCpfDisplay = 'display';	
	}	
	
	
	if($statusPessoa == '1'){
		$disabledInput = '';
	}
	if($statusPessoa == '2'){
		$disabledInput = '';
	}
	if($statusPessoa == '3'){
		$disabledInput = 'disabled';
	}
	if($statusPessoa == '4'){
		$disabledInput = 'disabled';
	}
	if($statusPessoa == '5'){
		$disabledInput = 'disabled';
	}
	if($statusPessoa == '6'){
		$disabledInput = 'disabled';
	}
	if($statusPessoa == '7'){
		$disabledInput = 'disabled';
	}

	
if(isset($_SESSION['mensagem']) and $_SESSION['metodo'] == 'Inserir' || $_SESSION['metodo'] == 'Alterar'){
	$mensagem = $_SESSION['mensagem'];
	unset($_SESSION['metodo']);
	
	echo "<script type='text/javascript'>
			$(window).load(function(){
			$('#MensagemModal').modal('show');
			});
		</script>";

	echo '<div class="modal fade" id="MensagemModal" role="dialog" aria-spanledby="MensagemModalspan">
			<div class="modal-dialog" role="document">
			  <div class="modal-content">
			<form method="post" action="#">
				  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="MensagemModal">Erro ao inserir despesa</h4>
			  </div>
				  <div class="modal-body"> '.$mensagem.'
				<div class="clearfix"></div>
			  </div>
				  <div class="modal-footer">
				<button type="button" class="botaoBrancoLg"  data-dismiss="modal">Ok</button>
			  </div>
				</form>
			</div>
			</div>
	  	</div>';
		
	$nomePessoa = $_SESSION['nomePessoa'];
	$apelido = $_SESSION['apelido'];
	$codigo = $_SESSION['codigo'];
	$cnpjCpf = $_SESSION['cnpjCpf'];
	$fone = $_SESSION['fone'];
	$celular = $_SESSION['celular'];
	$email = $_SESSION['email'];
	$ramoAtividade = $_SESSION['ramoAtividade'];
	$ramoAtividadeHandle = $_SESSION['ramoAtividadeHandle'];
	$setorAtividade = $_SESSION['setorAtividade'];
	$setorAtividadeHandle = $_SESSION['setorAtividadeHandle'];
	$categoriaAtividade = $_SESSION['categoriaAtividade'];
	$categoriaAtividadeHandle = $_SESSION['categoriaAtividadeHandle'];
	$observacao = $_SESSION['observacao'];
	$inscricaoEstadual = $_SESSION['inscricaoEstadual'];
	$grupoEmpresarial = $_SESSION['grupoEmpresarial'];
	$grupoEmpresarialHandle = $_SESSION['grupoEmpresarialHandle'];
	$naturalidade = $_SESSION['naturalidade'];
	$naturalidadeHandle = $_SESSION['naturalidadeHandle'];
	$estadoCivil = $_SESSION['estadoCivil'];
	$estadoCivilHandle = $_SESSION['estadoCivilHandle'];
	$sexo = $_SESSION['sexo'];
	$sexoHandle = $_SESSION['sexoHandle'];
	$nascimento = $_SESSION['nascimento'];
	$dependente = $_SESSION['dependente'];
	$escolaridade = $_SESSION['escolaridade'];
	$escolaridadeHandle = $_SESSION['escolaridadeHandle'];
	$localTrabalho = $_SESSION['localTrabalho'];
	$admissao = $_SESSION['admissao'];
	$nomePai = $_SESSION['nomePai'];
	$nomeMae = $_SESSION['nomeMae'];
	$nomeConjugue = $_SESSION['nomeConjugue'];
	$cep = $_SESSION['cep'];
	$cepHandle = $_SESSION['cepHandle'];
	$tipoLogradouro = $_SESSION['tipoLogradouro'];
	$tipoLogradouroHandle = $_SESSION['tipoLogradouroHandle'];
	$logradouro = $_SESSION['logradouro'];
	$numeroEndereco = $_SESSION['numeroEndereco'];
	$ehSemNumero = $_SESSION['ehSemNumero'];
	$complementoEndereco = $_SESSION['complementoEndereco'];
	$pais = $_SESSION['pais'];
	$paisHandle = $_SESSION['paisHandle'];
	$estado = $_SESSION['estado'];
	$estadoHandle = $_SESSION['estadoHandle'];
	$municipio = $_SESSION['municipio'];
	$municipioHandle = $_SESSION['municipioHandle'];
	$bairro = $_SESSION['bairro'];
	$bairroHandle = $_SESSION['bairroHandle'];
	$tipo = $_SESSION['tipo'];
	$tipoHandle = $_SESSION['tipoHandle'];
	$data = $_SESSION['data'];
	$hora = $_SESSION['hora'];
	$FormaPagamento = $_SESSION['FormaPagamento'];
	$FormaPagamentoHandle = $_SESSION['FormaPagamentoHandle'];
	$CondicaoPagamento = $_SESSION['CondicaoPagamento'];
	$CondicaoPagamentoHandle = $_SESSION['CondicaoPagamentoHandle'];
	
	unset($_SESSION['mensagem']);
	unset($_SESSION['nomePessoa']);
	unset($_SESSION['apelido']);
	unset($_SESSION['codigo']);
	unset($_SESSION['cnpjCpf']);
	unset($_SESSION['fone']);
	unset($_SESSION['celular']);
	unset($_SESSION['email']);
	unset($_SESSION['ramoAtividade']);
	unset($_SESSION['ramoAtividadeHandle']);
	unset($_SESSION['setorAtividade']);
	unset($_SESSION['setorAtividadeHandle']);
	unset($_SESSION['categoriaAtividade']);
	unset($_SESSION['categoriaAtividadeHandle']);
	unset($_SESSION['observacao']);
	unset($_SESSION['inscricaoEstadual']);
	unset($_SESSION['grupoEmpresarial']);
	unset($_SESSION['grupoEmpresarialHandle']);
	unset($_SESSION['naturalidade']);
	unset($_SESSION['naturalidadeHandle']);
	unset($_SESSION['estadoCivil']);
	unset($_SESSION['estadoCivilHandle']);
	unset($_SESSION['sexo']);
	unset($_SESSION['sexoHandle']);
	unset($_SESSION['nascimento']);
	unset($_SESSION['dependente']);
	unset($_SESSION['escolaridade']);
	unset($_SESSION['escolaridadeHandle']);
	unset($_SESSION['localTrabalho']);
	unset($_SESSION['admissao']);
	unset($_SESSION['nomePai']);
	unset($_SESSION['nomeMae']);
	unset($_SESSION['nomeConjugue']);
	unset($_SESSION['cep']);
	unset($_SESSION['cepHandle']);
	unset($_SESSION['tipoLogradouro']);
	unset($_SESSION['tipoLogradouroHandle']);
	unset($_SESSION['logradouro']);
	unset($_SESSION['numeroEndereco']);
	unset($_SESSION['ehSemNumero']);
	unset($_SESSION['complementoEndereco']);
	unset($_SESSION['pais']);
	unset($_SESSION['paisHandle']);
	unset($_SESSION['estado']);
	unset($_SESSION['estadoHandle']);
	unset($_SESSION['municipio']);
	unset($_SESSION['municipioHandle']);
	unset($_SESSION['bairro']);
	unset($_SESSION['bairroHandle']);
	unset($_SESSION['tipo']);
	unset($_SESSION['tipoHandle']);
	unset($_SESSION['data']);
	unset($_SESSION['hora']);
	unset($_SESSION['FormaPagamento']);
	unset($_SESSION['FormaPagamentoHandle']);
	unset($_SESSION['CondicaoPagamento']);
	unset($_SESSION['CondicaoPagamentoHandle']);
	
}
else if(isset($_SESSION['mensagem']) and $_SESSION['metodo'] <> 'Inserir' and $_SESSION['metodo'] <> 'Alterar'){
	$mensagem = $_SESSION['mensagem'];
	unset($_SESSION['metodo']);
	unset($_SESSION['mensagem']);
	
	echo "<script type='text/javascript'>
			$(window).load(function(){
			$('#MensagemModal').modal('show');
			});
		</script>";

	echo '<div class="modal fade" id="MensagemModal" role="dialog" aria-spanledby="MensagemModalspan">
			<div class="modal-dialog" role="document">
			  <div class="modal-content">
			<form method="post" action="#">
				  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="MensagemModal">Erro ao inserir despesa</h4>
			  </div>
				  <div class="modal-body"> '.$mensagem.'
				<div class="clearfix"></div>
			  </div>
				  <div class="modal-footer">
				<button type="button" class="botaoBrancoLg"  data-dismiss="modal">Ok</button>
			  </div>
				</form>
			</div>
			</div>
	  	</div>';	
}
	
else if(isset($_SESSION['protocolo'])){
	$protocolo = $_SESSION['protocolo'];	
	unset($_SESSION['protocolo']);
}

if(isset($_POST['check'])){
	
	$check =  $_POST['check'];
	
foreach($check as $chk){
	$checkValue = $chk;
}


}



if(isset($_SESSION['mensagem'])){
		$display = '';
}
else{
	$display = 'display';	
}
	
?>
