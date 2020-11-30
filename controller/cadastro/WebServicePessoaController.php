<?php
include_once('../tecnologia/Sistema.php');
$connect = Sistema::getConexao();

$usuario = $_SESSION['usuario'];
$senha = $_SESSION['senha'];
$senhaNaoCriptografada = $_SESSION['senhaNaoCriptografada'];

$referencia = Sistema::getGet('referencia');
$metodo = Sistema::getGet('metodo');
$motivo = Sistema::getGet('motivo');

$nomePessoa = Sistema::getPost('nomePessoa');
$apelido = Sistema::getPost('apelido');
$codigo = Sistema::getPost('codigo');
$cnpjCpf = Sistema::getPost('cnpjCpf');
$fone = Sistema::getPost('fone');
$celular = Sistema::getPost('celular');
$email = Sistema::getPost('email');
$ramoAtividade = Sistema::getPost('ramoAtividade');
$ramoAtividadeHandle = Sistema::getPost('ramoAtividadeHandle');
$setorAtividade = Sistema::getPost('setorAtividade');
$setorAtividadeHandle = Sistema::getPost('setorAtividadeHandle');
$categoriaAtividade = Sistema::getPost('categoriaAtividade');
$categoriaAtividadeHandle = Sistema::getPost('categoriaAtividadeHandle');
$observacao = Sistema::getPost('observacao');
$inscricaoEstadual = Sistema::getPost('inscricaoEstadual');
$grupoEmpresarial = Sistema::getPost('grupoEmpresarial');
$grupoEmpresarialHandle = Sistema::getPost('grupoEmpresarialHandle');
$naturalidade = Sistema::getPost('naturalidade');
$naturalidadeHandle = Sistema::getPost('naturalidadeHandle');
$estadoCivil = Sistema::getPost('estadoCivil');
$estadoCivilHandle = Sistema::getPost('estadoCivilHandle');
$sexo = Sistema::getPost('sexo');
$sexoHandle = Sistema::getPost('sexoHandle');
$nascimento = date('Y-m-d', strtotime(Sistema::getPost('nascimento')));
$dependente = Sistema::getPost('dependente');
$escolaridade = Sistema::getPost('escolaridade');
$escolaridadeHandle = Sistema::getPost('escolaridadeHandle');
$localTrabalho = Sistema::getPost('localTrabalho');
$admissao = date('Y-m-d', strtotime(Sistema::getPost('admissao')));
$nomePai = Sistema::getPost('nomePai');
$nomeMae = Sistema::getPost('nomeMae');
$nomeConjugue = Sistema::getPost('nomeConjugue');
$cep = Sistema::getPost('cep');
$cepHandle = Sistema::getPost('cepHandle');
$tipoLogradouro = Sistema::getPost('tipoLogradouro');
$tipoLogradouroHandle = Sistema::getPost('tipoLogradouroHandle');
$logradouro = Sistema::getPost('logradouro');
$numeroEndereco = Sistema::getPost('numeroEndereco');
$complementoEndereco = Sistema::getPost('complementoEndereco');
$pais = Sistema::getPost('pais');
$paisHandle = Sistema::getPost('paisHandle');
$estado = Sistema::getPost('estado');
$estadoHandle = Sistema::getPost('estadoHandle');
$municipio = Sistema::getPost('municipio');
$municipioHandle = Sistema::getPost('municipioHandle');
$bairro = Sistema::getPost('bairro');
$bairroHandle = Sistema::getPost('bairroHandle');
$tipo = Sistema::getPost('tipo');
$tipoHandle = Sistema::getPost('tipoHandle');
$data = date('Y-m-d', strtotime(Sistema::getPost('data')));
$hora = date('H:i', strtotime(Sistema::getPost('hora')));
$FormaPagamento = Sistema::getPost('FormaPagamento');
$FormaPagamentoHandle = Sistema::getPost('FormaPagamentoHandle');
$CondicaoPagamento = Sistema::getPost('CondicaoPagamento');
$CondicaoPagamentoHandle = Sistema::getPost('CondicaoPagamentoHandle');
$ehSemNumero = Sistema::getPost('ehSemNumero');
if($ehSemNumero != 'S'){
	$ehSemNumero = 'N';	
}

//seleciona o motivo de alteração, primeiro handle da tabela
$queryMotivoAlteracao = $connect->prepare("SELECT TOP 1 HANDLE FROM GD_MOTIVOALTERACAOPESSOA");
$queryMotivoAlteracao->execute();
$rowMotivoAlteracao = $queryMotivoAlteracao->fetch(PDO::FETCH_ASSOC);
$motivoAlteracao = $rowMotivoAlteracao['HANDLE'];
	

$_SESSION['nomePessoa'] = $nomePessoa;
$_SESSION['apelido'] = $apelido;
$_SESSION['codigo'] = $codigo ;
$_SESSION['cnpjCpf'] = $cnpjCpf ;
$_SESSION['fone'] = $fone ;
$_SESSION['celular'] = $celular ;
$_SESSION['email'] = $email ;
$_SESSION['ramoAtividade'] = $ramoAtividade ;
$_SESSION['ramoAtividadeHandle'] = $ramoAtividadeHandle ;
$_SESSION['setorAtividade'] = $setorAtividade ;
$_SESSION['setorAtividadeHandle'] = $setorAtividadeHandle ;
$_SESSION['categoriaAtividade'] = $categoriaAtividade ;
$_SESSION['categoriaAtividadeHandle'] = $categoriaAtividadeHandle ;
$_SESSION['observacao'] = $observacao ;
$_SESSION['inscricaoEstadual'] = $inscricaoEstadual ;
$_SESSION['grupoEmpresarial'] = $grupoEmpresarial ;
$_SESSION['grupoEmpresarialHandle'] = $grupoEmpresarialHandle ;
$_SESSION['naturalidade'] = $naturalidade ;
$_SESSION['naturalidadeHandle'] = $naturalidadeHandle ;
$_SESSION['estadoCivil'] = $estadoCivil ;
$_SESSION['estadoCivilHandle'] = $estadoCivilHandle ;
$_SESSION['sexo'] = $sexo ;
$_SESSION['sexoHandle'] = $sexoHandle ;
$_SESSION['nascimento'] = $nascimento ;
$_SESSION['dependente'] = $dependente ;
$_SESSION['escolaridade'] = $escolaridade ;
$_SESSION['escolaridadeHandle'] = $escolaridadeHandle ;
$_SESSION['localTrabalho'] = $localTrabalho ;
$_SESSION['admissao'] = $admissao ;
$_SESSION['nomePai'] = $nomePai ;
$_SESSION['nomeMae'] = $nomeMae ;
$_SESSION['nomeConjugue'] = $nomeConjugue ;
$_SESSION['cep'] = $cep ;
$_SESSION['cepHandle'] = $cepHandle ;
$_SESSION['tipoLogradouro'] = $tipoLogradouro ;
$_SESSION['tipoLogradouroHandle'] = $tipoLogradouroHandle ;
$_SESSION['logradouro'] = $logradouro ;
$_SESSION['numeroEndereco'] = $numeroEndereco ;
$_SESSION['ehSemNumero'] = $ehSemNumero ;
$_SESSION['complementoEndereco'] = $complementoEndereco ;
$_SESSION['pais'] = $pais ;
$_SESSION['paisHandle'] = $paisHandle ;
$_SESSION['estado'] = $estado ;
$_SESSION['estadoHandle'] = $estadoHandle ;
$_SESSION['municipio'] = $municipio ;
$_SESSION['municipioHandle'] = $municipioHandle ;
$_SESSION['bairro'] = $bairro;
$_SESSION['bairroHandle'] = $bairroHandle;
$_SESSION['tipo'] = $tipo ;
$_SESSION['tipoHandle'] = $tipoHandle ;
$_SESSION['data'] = $data ;
$_SESSION['hora'] = $hora ;
$_SESSION['FormaPagamento'] = $FormaPagamento ;
$_SESSION['FormaPagamentoHandle'] = $FormaPagamentoHandle ;
$_SESSION['CondicaoPagamento'] = $CondicaoPagamento ;
$_SESSION['CondicaoPagamentoHandle'] = $CondicaoPagamentoHandle;


$mensagem = NULL;
$protocolo = NULL;
$sucesso = NULL;

$pessoaHandle = Sistema::getGet('handle');

try {
	if($metodo == 'Cancelar'){
    	$params = array("handle" => $pessoaHandle, "motivo" => $motivo);
	}
	else if($metodo == 'Alterar'){
		$params = array(
		"handle" => $pessoaHandle, 
		"nome" => $nomePessoa,
		"apelido" => $apelido,
		"tipo" => $tipoHandle,
		"cpfcnpj" => $cnpjCpf,
		"telefone" => $fone,
		"celular" => $celular,
		"email" => $email,
		"ramoAtividade" => $ramoAtividadeHandle,
		"setorAtividade" => $setorAtividadeHandle,
		"categoriaAtividade" => $categoriaAtividadeHandle,
		"observacao" => $observacao,
		"naturalidade" => $naturalidadeHandle,
		"estadoCivil" => $estadoCivilHandle,
		"sexo" => $sexoHandle,
		"dataNascimento" => $nascimento,
		"dependente" => $dependente,
		"escolaridade" => $escolaridadeHandle,
		"localTrabalho" => $localTrabalho,
		"dataAdmissao" => $admissao,
		"nomePai" => $nomePai,
		"nomeMae" => $nomeMae,
		"nomeConjugue" => $nomeConjugue,
		"inscricaoEstadual" => $inscricaoEstadual,
		"grupoEmpresarial" => $grupoEmpresarialHandle
		);
	}
	else if($metodo == 'Inserir'){
		$params = array(
		"nome" => $nomePessoa,
		"apelido" => $apelido,
		"tipo" => $tipoHandle,
		"cpfcnpj" => $cnpjCpf,
		"telefone" => $fone,
		"celular" => $celular,
		"email" => $email,
		"ramoAtividade" => $ramoAtividadeHandle,
		"setorAtividade" => $setorAtividadeHandle,
		"categoriaAtividade" => $categoriaAtividadeHandle,
		"observacao" => $observacao,
		"naturalidade" => $naturalidadeHandle,
		"estadoCivil" => $estadoCivilHandle,
		"sexo" => $sexoHandle,
		"dataNascimento" => $nascimento,
		"dependente" => $dependente,
		"escolaridade" => $escolaridadeHandle,
		"localTrabalho" => $localTrabalho,
		"dataAdmissao" => $admissao,
		"nomePai" => $nomePai,
		"nomeMae" => $nomeMae,
		"nomeConjugue" => $nomeConjugue,
		"inscricaoEstadual" => $inscricaoEstadual,
		"grupoEmpresarial" => $grupoEmpresarialHandle
		);
	}
	else{
		$params = array("handle" => $pessoaHandle);
	}
    
   $webservice = 'Administracao';
   include_once('../tecnologia/WebService.php');
  
   if($WebServiceOffline){
		$_SESSION['mensagem'] = 'Erro ao conectar com o WebService, tente novamente mais tarde';
		$_SESSION['retornoPessoa'] =  true;
		$_SESSION['metodo'] = $metodo;
		header('Location: ../../view/cadastro/'.$referencia.'.php?handle='.$pessoaHandle.'&referencia='.$referencia);
		exit;
	}

    $result = $clientSoap->__soapCall($metodo."Pessoa", array($metodo."Pessoa" => array("pessoa" => $params)));
    print_r($result);
	$resultString = $metodo.'PessoaResult';
	$retorno = $result->$resultString;
	
	if(!empty($retorno->mensagem)){
		$mensagem = $retorno->mensagem; 
	}
	if(!empty($retorno->protocolo)){
		$protocolo = $retorno->protocolo;
	}
	if(!empty($retorno->sucesso)){
		$sucesso = $retorno->sucesso; 
	}
	
	if($mensagem == NULL and $protocolo == NULL and $sucesso == NULL){
	$_SESSION['mensagem'] = 'Erro ao conectar com o WebService, tente novamente mais tarde';
		$_SESSION['retornoPessoa'] =  true;
		$_SESSION['metodo'] = $metodo;

		header('Location: ../../view/cadastro/'.$referencia.'.php?handle='.$pessoaHandle.'&referencia='.$referencia);
	}
	
	if($sucesso == 'True'){
		$_SESSION['protocolo'] = $protocolo;
		
		include('../../controller/cadastro/WebServicePessoaEnderecoController.php');
	
		if($metodo == 'Inserir' || $metodo == 'Alterar'){
			include('../../controller/cadastro/WebServicePessoaClienteController.php');
		}
		
		header('Location: ../../view/cadastro/'.$referencia.'.php?handle='.$pessoaHandle.'&referencia='.$referencia);
		
	}
	else if($sucesso == 'False'){
		$_SESSION['mensagem'] = $mensagem;
		$_SESSION['retornoPessoa'] =  true;
		$_SESSION['metodo'] = $metodo;
		header('Location: ../../view/cadastro/'.$referencia.'.php?handle='.$pessoaHandle.'&referencia='.$referencia);
	}
}
catch (SoapFault $e) {
    var_dump($e->getMessage());
		
	$_SESSION['mensagem'] = 'Erro ao conectar com o WebService, tente novamente mais tarde';
		$_SESSION['retornoPessoa'] =  true;
		$_SESSION['metodo'] = $metodo;
		header('Location: ../../view/cadastro/'.$referencia.'.php?handle='.$pessoaHandle.'&referencia='.$referencia);
}
?>