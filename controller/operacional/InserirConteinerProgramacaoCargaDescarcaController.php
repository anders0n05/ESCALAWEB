<?php
include_once('../tecnologia/Sistema.php');


$codigoConteiner = null;
$tipoEquipamento = null;
$tipoEquipamentoHandle = null;
$codigoISO = null;
$codigoISOHandle = null;
$altura = null;
$largura = null;
$comprimento = null;
$capacidade = null;
$tara = null;
$mgw = null;
$fabricacao = null;
$obsInserirConteiner = null;

//inserir ocorrencia
$carregamento = null;
$tipoOcorrencia = null;
$tipoOcorrenciaHandle = null;
$progDoca = null;
$progDocaHandle = null;
$dataPrevisao = null;
$horaPrevisao = null;
$numero = null;
$veiculo = null;
$acoplado = null;
$conteiner = null;
$conteinerHandle = null;
$motorista = null;
$obs = null;
$ufVeiculo = null;
$ufVeiculoHandle = null;
$cargaDescarga = null;


$codigoConteiner = Sistema::getPost('codigoConteiner');
$tipoEquipamento = Sistema::getPost('tipoEquipamento');
$tipoEquipamentoHandle = Sistema::getPost('tipoEquipamentoHandle');
$codigoISO = Sistema::getPost('codigoISO');
$codigoISOHandle = Sistema::getPost('codigoISOHandle');
$altura = Sistema::getPost('alturaConteiner');
$largura = Sistema::getPost('larguraConteiner');
$comprimento = Sistema::getPost('comprimentoConteiner');
$capacidade = Sistema::getPost('capacidadeConteiner');
$tara = Sistema::getPost('taraConteiner');
$mgw = Sistema::getPost('mgwConteiner');
$fabricacao = Sistema::getPost('fabricacaoConteiner');
$obsInserirConteiner = Sistema::getPost('obsInserirConteiner');

$referencia = Sistema::getGet('referencia');

$mensagem = null;
$protocolo = null;
$sucesso = null;

try {

    $paramsInserir = array("altura" => $altura,
					"capacidade" => $capacidade,
					"codigo" => $codigoConteiner,
					"codigoISO" => $codigoISOHandle,
					"comprimento" => $comprimento,
					"fabricacao" => $fabricacao,
					"largura" => $largura,
					"mgw" => $mgw,
					"observacao" => $obsInserirConteiner,
					"tara" => $tara,
					"tipoEquipamento" => $tipoEquipamentoHandle
    );
	
	$webservice = 'patio';
	include_once('../tecnologia/WebService.php');
	
	if($WebServiceOffline){
		//$_SESSION['mensagem'] = 'Erro ao conectar com o WebService, tente novamente mais tarde';
		
		$_SESSION['codigoConteiner'] = $codigoConteiner;
		$_SESSION['tipoEquipamento'] = $tipoEquipamento;
		$_SESSION['tipoEquipamentoHandle'] = $tipoEquipamentoHandle;
		$_SESSION['codigoISO'] = $codigoISO;
		$_SESSION['codigoISOHandle'] = $codigoISOHandle;
		$_SESSION['alturaConteiner'] = $altura;
		$_SESSION['larguraConteiner'] = $largura;
		$_SESSION['comprimentoConteiner'] = $comprimento;
		$_SESSION['capacidadeConteiner'] = $capacidade;
		$_SESSION['taraConteiner'] = $tara;
		$_SESSION['mgwConteiner'] = $mgw;
		$_SESSION['fabricacaoConteiner'] = $fabricacao;
		$_SESSION['obsInserirConteiner'] = $obsInserirConteiner;
		
		//inserir ocorrencia
		$_SESSION['cargaDescarga'] = $cargaDescarga;
		$_SESSION['carregamento'] = $carregamento;
		$_SESSION['tipoOcorrencia'] = $tipoOcorrencia;
		$_SESSION['tipoOcorrenciaHandle'] = $tipoOcorrenciaHandle;
		$_SESSION['progDoca'] = $progDoca;
		$_SESSION['progDocaHandle'] = $progDocaHandle;
		$_SESSION['dataPrevisao'] = $dataPrevisao;
		$_SESSION['horaPrevisao'] = $horaPrevisao;
		$_SESSION['numero'] = $numero;
		$_SESSION['veiculo'] = $veiculo;
		$_SESSION['acoplado'] = $acoplado;
		$_SESSION['container'] = $conteiner;
		$_SESSION['conteinerHandle'] = $conteinerHandle;
		$_SESSION['motorista'] = $motorista;
		$_SESSION['obs'] = $obs;
		$_SESSION['ufVeiculo'] = $ufVeiculo;
		$_SESSION['ufVeiculoHandle'] = $ufVeiculoHandle;
		
		//header('Location: ../../view/operacional/ProgramacaoCargaDescarga.php?referencia='.$referencia);	
		$retorno = array('sucesso'=>'N', 'retorno'=>'Erro ao conectar com o WebService, tente novamente mais tarde');
		echo json_encode($retorno);
		exit;
	}
	
	
    $result = $clientSoap->__soapCall("IncluirConteiner", array("IncluirConteiner" => array("incluirConteiner" => $paramsInserir)));
	
	$retorno = $result->IncluirConteinerResult ;
	
	if(!empty($retorno->mensagem)){
		$mensagem = $retorno->mensagem; 
	}
	if(!empty($retorno->protocolo)){
		$protocolo = $retorno->protocolo;
	}
	if(!empty($retorno->sucesso)){
		$sucesso = $retorno->sucesso; 
	}
	
	
	if($mensagem == null and $protocolo == null and $sucesso == null){
		//$_SESSION['mensagem'] = 'Erro ao conectar com o WebService, tente novamente mais tarde';
		
		$_SESSION['codigoConteiner'] = $codigoConteiner;
		$_SESSION['tipoEquipamento'] = $tipoEquipamento;
		$_SESSION['tipoEquipamentoHandle'] = $tipoEquipamentoHandle;
		$_SESSION['codigoISO'] = $codigoISO;
		$_SESSION['codigoISOHandle'] = $codigoISOHandle;
		$_SESSION['alturaConteiner'] = $altura;
		$_SESSION['larguraConteiner'] = $largura;
		$_SESSION['comprimentoConteiner'] = $comprimento;
		$_SESSION['capacidadeConteiner'] = $capacidade;
		$_SESSION['taraConteiner'] = $tara;
		$_SESSION['mgwConteiner'] = $mgw;
		$_SESSION['fabricacaoConteiner'] = $fabricacao;
		$_SESSION['obsInserirConteiner'] = $obsInserirConteiner;
		
		//inserir ocorrencia
		$_SESSION['cargaDescarga'] = $cargaDescarga;
		$_SESSION['carregamento'] = $carregamento;
		$_SESSION['tipoOcorrencia'] = $tipoOcorrencia;
		$_SESSION['tipoOcorrenciaHandle'] = $tipoOcorrenciaHandle;
		$_SESSION['progDoca'] = $progDoca;
		$_SESSION['progDocaHandle'] = $progDocaHandle;
		$_SESSION['dataPrevisao'] = $dataPrevisao;
		$_SESSION['horaPrevisao'] = $horaPrevisao;
		$_SESSION['numero'] = $numero;
		$_SESSION['veiculo'] = $veiculo;
		$_SESSION['acoplado'] = $acoplado;
		$_SESSION['container'] = $conteiner;
		$_SESSION['conteinerHandle'] = $conteinerHandle;
		$_SESSION['motorista'] = $motorista;
		$_SESSION['obs'] = $obs;
		$_SESSION['ufVeiculo'] = $ufVeiculo;
		$_SESSION['ufVeiculoHandle'] = $ufVeiculoHandle;
		
		//header('Location: ../../view/operacional/ProgramacaoCargaDescarga.php?referencia='.$referencia);	
		$retorno = array('sucesso'=>'N', 'retorno'=>'Erro ao conectar com o WebService, tente novamente mais tarde');
		echo json_encode($retorno);
	}
	
	if($sucesso == 'True'){
		$paramsLiberar = array("handle" => $protocolo);
		
		$resultLiberar = $clientSoap->__soapCall("LiberarConteiner", array("LiberarConteiner" => array("liberarConteiner" => $paramsLiberar)));

		$retornoLiberar = $resultLiberar->LiberarConteinerResult;

		if(!empty($retornoLiberar->mensagem)){
			$mensagemLiberar = $retornoLiberar->mensagem; 
		}
		if(!empty($retornoLiberar->protocolo)){
			$protocoloLiberar = $retornoLiberar->protocolo;
		}
		if(!empty($retornoLiberar->sucesso)){
			$sucessoLiberar = $retornoLiberar->sucesso; 
		}
		
		if($sucessoLiberar == 'True'){
			$_SESSION['protocolo'] = $protocoloLiberar;
			$_SESSION['protocolo'] = $protocoloLiberar;
			$_SESSION['gravou'] = 'true';

			//header('Location: ../../view/operacional/ProgramacaoCargaDescarga.php?ocorrencia='.$protocoloLiberar.'&referencia='.$referencia);
			$retorno = array('sucesso'=>'S', 'retorno'=>'Conteiner cadastrado com sucesso!', 'conteiner'=>$codigoConteiner, 'conteinerHandle'=>$protocoloLiberar);
			echo json_encode($retorno);

		}//if($sucessoLiberar == 'True'){
		else if($sucessoLiberar == 'False'){
			//$_SESSION['mensagem'] = $mensagemLiberar;

			$_SESSION['codigoConteiner'] = $codigoConteiner;
			$_SESSION['tipoEquipamento'] = $tipoEquipamento;
			$_SESSION['tipoEquipamentoHandle'] = $tipoEquipamentoHandle;
			$_SESSION['codigoISO'] = $codigoISO;
			$_SESSION['codigoISOHandle'] = $codigoISOHandle;
			$_SESSION['alturaConteiner'] = $altura;
			$_SESSION['larguraConteiner'] = $largura;
			$_SESSION['comprimentoConteiner'] = $comprimento;
			$_SESSION['capacidadeConteiner'] = $capacidade;
			$_SESSION['taraConteiner'] = $tara;
			$_SESSION['mgwConteiner'] = $mgw;
			$_SESSION['fabricacaoConteiner'] = $fabricacao;
			$_SESSION['obsInserirConteiner'] = $obsInserirConteiner;
			
			
			//inserir ocorrencia
			$_SESSION['cargaDescarga'] = $cargaDescarga;
			$_SESSION['carregamento'] = $carregamento;
			$_SESSION['tipoOcorrencia'] = $tipoOcorrencia;
			$_SESSION['tipoOcorrenciaHandle'] = $tipoOcorrenciaHandle;
			$_SESSION['progDoca'] = $progDoca;
			$_SESSION['progDocaHandle'] = $progDocaHandle;
			$_SESSION['dataPrevisao'] = $dataPrevisao;
			$_SESSION['horaPrevisao'] = $horaPrevisao;
			$_SESSION['numero'] = $numero;
			$_SESSION['veiculo'] = $veiculo;
			$_SESSION['acoplado'] = $acoplado;
			$_SESSION['container'] = $conteiner;
			$_SESSION['conteinerHandle'] = $conteinerHandle;
			$_SESSION['motorista'] = $motorista;
			$_SESSION['obs'] = $obs;
			$_SESSION['ufVeiculo'] = $ufVeiculo;
			$_SESSION['ufVeiculoHandle'] = $ufVeiculoHandle;

			//header('Location: ../../view/operacional/ProgramacaoCargaDescarga.php?referencia='.$referencia);
		
			$retorno = array('sucesso'=>'N', 'retorno'=>$mensagemLiberar);
			echo json_encode($retorno);
			
		}//else if($sucessoLiberar == 'False'){
		
	}//if($sucesso == 'True'){
	else if($sucesso == 'False'){
		//$_SESSION['mensagem'] = $mensagem;

		$_SESSION['codigoConteiner'] = $codigoConteiner;
		$_SESSION['tipoEquipamento'] = $tipoEquipamento;
		$_SESSION['tipoEquipamentoHandle'] = $tipoEquipamentoHandle;
		$_SESSION['codigoISO'] = $codigoISO;
		$_SESSION['codigoISOHandle'] = $codigoISOHandle;
		$_SESSION['alturaConteiner'] = $altura;
		$_SESSION['larguraConteiner'] = $largura;
		$_SESSION['comprimentoConteiner'] = $comprimento;
		$_SESSION['capacidadeConteiner'] = $capacidade;
		$_SESSION['taraConteiner'] = $tara;
		$_SESSION['mgwConteiner'] = $mgw;
		$_SESSION['fabricacaoConteiner'] = $fabricacao;
		$_SESSION['obsInserirConteiner'] = $obsInserirConteiner;
		
		//inserir ocorrencia
		$_SESSION['cargaDescarga'] = $cargaDescarga;
		$_SESSION['carregamento'] = $carregamento;
		$_SESSION['tipoOcorrencia'] = $tipoOcorrencia;
		$_SESSION['tipoOcorrenciaHandle'] = $tipoOcorrenciaHandle;
		$_SESSION['progDoca'] = $progDoca;
		$_SESSION['progDocaHandle'] = $progDocaHandle;
		$_SESSION['dataPrevisao'] = $dataPrevisao;
		$_SESSION['horaPrevisao'] = $horaPrevisao;
		$_SESSION['numero'] = $numero;
		$_SESSION['veiculo'] = $veiculo;
		$_SESSION['acoplado'] = $acoplado;
		$_SESSION['container'] = $conteiner;
		$_SESSION['conteinerHandle'] = $conteinerHandle;
		$_SESSION['motorista'] = $motorista;
		$_SESSION['obs'] = $obs;
		$_SESSION['ufVeiculo'] = $ufVeiculo;
		$_SESSION['ufVeiculoHandle'] = $ufVeiculoHandle;

		//header('Location: ../../view/operacional/ProgramacaoCargaDescarga.php?referencia='.$referencia);
		
		$retorno = array('sucesso'=>'N', 'retorno'=>$mensagem);
		echo json_encode($retorno);
	}//else if($sucesso == 'False'){
	
} //try
catch (SoapFault $e) {
   // var_dump($e->getMessage());
		
		$_SESSION['codigoConteiner'] = $codigoConteiner;
		$_SESSION['tipoEquipamento'] = $tipoEquipamento;
		$_SESSION['tipoEquipamentoHandle'] = $tipoEquipamentoHandle;
		$_SESSION['codigoISO'] = $codigoISO;
		$_SESSION['codigoISOHandle'] = $codigoISOHandle;
		$_SESSION['alturaConteiner'] = $altura;
		$_SESSION['larguraConteiner'] = $largura;
		$_SESSION['comprimentoConteiner'] = $comprimento;
		$_SESSION['capacidadeConteiner'] = $capacidade;
		$_SESSION['taraConteiner'] = $tara;
		$_SESSION['mgwConteiner'] = $mgw;
		$_SESSION['fabricacaoConteiner'] = $fabricacao;
		$_SESSION['obsInserirConteiner'] = $obsInserirConteiner;
	
		//inserir ocorrencia
		$_SESSION['cargaDescarga'] = $cargaDescarga;
		$_SESSION['carregamento'] = $carregamento;
		$_SESSION['tipoOcorrencia'] = $tipoOcorrencia;
		$_SESSION['tipoOcorrenciaHandle'] = $tipoOcorrenciaHandle;
		$_SESSION['progDoca'] = $progDoca;
		$_SESSION['progDocaHandle'] = $progDocaHandle;
		$_SESSION['dataPrevisao'] = $dataPrevisao;
		$_SESSION['horaPrevisao'] = $horaPrevisao;
		$_SESSION['numero'] = $numero;
		$_SESSION['veiculo'] = $veiculo;
		$_SESSION['acoplado'] = $acoplado;
		$_SESSION['container'] = $conteiner;
		$_SESSION['conteinerHandle'] = $conteinerHandle;
		$_SESSION['motorista'] = $motorista;
		$_SESSION['obs'] = $obs;
		$_SESSION['ufVeiculo'] = $ufVeiculo;
		$_SESSION['ufVeiculoHandle'] = $ufVeiculoHandle;
		
		//header('Location: ../../view/operacional/ProgramacaoCargaDescarga.php?referencia='.$referencia);
		
		$retorno = array('sucesso'=>'N', 'retorno'=>$mensagem);
		echo json_encode($retorno);
}
?>