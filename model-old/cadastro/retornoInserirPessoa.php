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

if(isset($_SESSION['mensagem'])){
		$display = '';
}
else{
	$display = 'display';	
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
?>
