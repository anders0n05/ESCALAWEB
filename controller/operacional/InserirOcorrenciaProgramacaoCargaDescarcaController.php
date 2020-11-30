<?php

include_once('../tecnologia/Sistema.php');
$connect = Sistema::getConexao();

$cargaDescarga = null;
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
$tipoVeiculo = null;
$tipoVeiculoHandle = null;
$docaHandle = null;
$propriedadeVeiculo = null;
$propriedadeVeiculoHandle = null;
$documentoMotorista = null;

//inserir conteiner
$codigoConteiner = null;
$tipoEquipamento = null;
$tipoEquipamentoHandle = null;
$codigoISO = null;
$codigoISOHandle = null;
$alturaConteiner = null;
$larguraConteiner = null;
$comprimentoConteiner = null;
$capacidadeConteiner = null;
$taraConteiner = null;
$mgwConteiner = null;
$fabricacaoConteiner = null;
$obsInserirConteiner = null;

$carregamento = Sistema::getPost('carregamento');
$tipoOcorrencia = Sistema::getPost('tipoOcorrencia');
$tipoOcorrenciaHandle = Sistema::getPost('tipoOcorrenciaHandle');
$progDoca = Sistema::getPost('progDoca');
$progDocaHandle = Sistema::getPost('progDocaHandle');
$docaHandle = Sistema::getPost('docaHandle');
$dataPrevisao = date('Y-m-d', Sistema::getPost('previsao'));
$horaPrevisao = date('H:i:s', Sistema::getPost('previsao'));
$numero = Sistema::getPost('numero');
$veiculo = Sistema::getPost('veiculo');
$acoplado = Sistema::getPost('acoplado');
$container = Sistema::getPost('conteiner');
$containerHandle = Sistema::getPost('conteinerHandle');
$motorista = Sistema::getPost('motorista');
$obs = Sistema::getPost('obs');
$ufVeiculo = Sistema::getPost('ufVeiculo');
$ufVeiculoHandle = Sistema::getPost('ufVeiculoHandle');
$propriedadeVeiculo = Sistema::getPost('propriedadeVeiculo');
$propriedadeVeiculoHandle = Sistema::getPost('propriedadeVeiculoHandle');
$documentoMotorista = Sistema::getPost('documentoMotorista');
$tipoVeiculoHandle = Sistema::getPost('tipoVeiculoHandle');

$queryTransportadora = $connect->prepare("SELECT TRANSPORTADORA FROM AM_CARREGAMENTO WHERE HANDLE = '" . $carregamento . "'");
$queryTransportadora->execute();
while ($rowTransportadora = $queryTransportadora->fetch(PDO::FETCH_ASSOC)) {
    $transportadora = $rowTransportadora['TRANSPORTADORA'];
}
//echo $transportadora;
$referencia = Sistema::getGet('referencia');

$mensagem = null;
$protocolo = null;
$sucesso = null;

try {
    $paramsInserir = array("carregamento" => $carregamento,
        "conteiner" => $containerHandle,
        "data" => date('Y-m-d') . 'T' . date('H:i:s'),
        "doca" => $docaHandle,
        "motorista" => $motorista,
        "motoristaDocumento" => $documentoMotorista,
        "observacao" => $obs,
        "programacaoDoca" => $progDocaHandle,
        "propriedadeVeiculo" => $propriedadeVeiculoHandle,
        "reboque" => $acoplado,
        "tipo" => $tipoOcorrenciaHandle,
        "tipoVeiculo" => $tipoVeiculoHandle,
        "vagao" => null,
        "veiculo" => $veiculo,
        "veiculoUF" => $ufVeiculoHandle,
        "transportadora" => $transportadora);

    $webservice = 'armazem';
    include_once('../tecnologia/WebService.php');

    if ($WebServiceOffline) {
        $_SESSION['mensagem'] = 'Erro ao conectar com o WebService, tente novamente mais tarde 1';

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
        $_SESSION['tipoVeiculo'] = $tipoVeiculo;
        $_SESSION['tipoVeiculoHandle'] = $tipoVeiculoHandle;
        $_SESSION['docaHandle'] = $docaHandle;
        $_SESSION['propriedadeVeiculo'] = $propriedadeVeiculo;
        $_SESSION['propriedadeVeiculoHandle'] = $propriedadeVeiculoHandle;
        $_SESSION['documentoMotorista'] = $documentoMotorista;
        //inserir conteiner
        $_SESSION['codigoConteiner'] = $codigoConteiner;
        $_SESSION['tipoEquipamento'] = $tipoEquipamento;
        $_SESSION['tipoEquipamentoHandle'] = $tipoEquipamentoHandle;
        $_SESSION['codigoISO'] = $codigoISO;
        $_SESSION['codigoISOHandle'] = $codigoISOHandle;
        $_SESSION['alturaConteiner'] = $alturaConteiner;
        $_SESSION['larguraConteiner'] = $larguraConteiner;
        $_SESSION['comprimentoConteiner'] = $comprimentoConteiner;
        $_SESSION['capacidadeConteiner'] = $capacidadeConteiner;
        $_SESSION['taraConteiner'] = $taraConteiner;
        $_SESSION['mgwConteiner'] = $mgwConteiner;
        $_SESSION['fabricacaoConteiner'] = $fabricacaoConteiner;
        $_SESSION['obsInserirConteiner'] = $obsInserirConteiner;

        header('Location: ../../view/operacional/ProgramacaoCargaDescarga.php?referencia=' . $referencia);
        exit;
    }

    /*
      echo "<pre>";
      print_r($paramsInserir);
      echo "<br> params end <br><br>";
      print_r($_POST);
      echo "</pre>";
     */

    $resultInserir = $clientSoap->__soapCall("InserirCarregamentoOcorrencia", array("InserirCarregamentoOcorrencia" => array("inserirCarregamentoOcorrencia" => $paramsInserir)));

    $retornoInserir = $resultInserir->InserirCarregamentoOcorrenciaResult;

    if (!empty($retornoInserir->mensagem)) {
        $mensagem = $retornoInserir->mensagem;
    }

    if (!empty($retornoInserir->protocolo)) {
        $protocolo = $retornoInserir->protocolo;
    }

    if (!empty($retornoInserir->sucesso)) {
        $sucesso = $retornoInserir->sucesso;
    }

    if ($mensagem == null and $protocolo == null and $sucesso == null) {
        $_SESSION['mensagem'] = 'Erro ao conectar com o WebService, tente novamente mais tarde 2';

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
        $_SESSION['tipoVeiculo'] = $tipoVeiculo;
        $_SESSION['tipoVeiculoHandle'] = $tipoVeiculoHandle;
        $_SESSION['docaHandle'] = $docaHandle;
        $_SESSION['propriedadeVeiculo'] = $propriedadeVeiculo;
        $_SESSION['propriedadeVeiculoHandle'] = $propriedadeVeiculoHandle;
        $_SESSION['documentoMotorista'] = $documentoMotorista;
        //inserir conteiner
        $_SESSION['codigoConteiner'] = $codigoConteiner;
        $_SESSION['tipoEquipamento'] = $tipoEquipamento;
        $_SESSION['tipoEquipamentoHandle'] = $tipoEquipamentoHandle;
        $_SESSION['codigoISO'] = $codigoISO;
        $_SESSION['codigoISOHandle'] = $codigoISOHandle;
        $_SESSION['alturaConteiner'] = $alturaConteiner;
        $_SESSION['larguraConteiner'] = $larguraConteiner;
        $_SESSION['comprimentoConteiner'] = $comprimentoConteiner;
        $_SESSION['capacidadeConteiner'] = $capacidadeConteiner;
        $_SESSION['taraConteiner'] = $taraConteiner;
        $_SESSION['mgwConteiner'] = $mgwConteiner;
        $_SESSION['fabricacaoConteiner'] = $fabricacaoConteiner;
        $_SESSION['obsInserirConteiner'] = $obsInserirConteiner;

        //header('Location: ../../view/operacional/ProgramacaoCargaDescarga.php?referencia='.$referencia);	
    }

    if ($sucesso == 'True') {
        //Anexar ordem de coleta start
        include('AnexarOcorrenciaProgramacaoCargaDescarca.php');

        //liberar ocorrência start
        $paramsLiberar = array("carregamentoOcorrencia" => $protocolo);

        $resultLiberar = $clientSoap->__soapCall("LiberarCarregamentoOcorrencia", array("LiberarCarregamentoOcorrencia" => array("liberarCarregamentoOcorrencia" => $paramsLiberar)));

        $retornoLiberar = $resultLiberar->LiberarCarregamentoOcorrenciaResult;

        if (!empty($retornoLiberar->mensagem)) {
            $mensagemLiberar = $retornoLiberar->mensagem;
        }
        if (!empty($retornoLiberar->protocolo)) {
            $protocoloLiberar = $retornoLiberar->protocolo;
        }
        if (!empty($retornoLiberar->sucesso)) {
            $sucessoLiberar = $retornoLiberar->sucesso;
        }

        if ($sucessoLiberar == 'True') {
            $_SESSION['protocolo'] = $protocoloLiberar;
            $_SESSION['protocolo'] = $protocoloLiberar;
            $_SESSION['gravou'] = 'true';

            header('Location: ../../view/operacional/ProgramacaoCargaDescarga.php?ocorrencia=' . $protocoloLiberar . '&referencia=' . $referencia);
        }//if($sucessoLiberar == 'True'){
        else if ($sucessoLiberar == 'False') {
            $_SESSION['mensagem'] = $mensagemLiberar . '<br> Ocorrência inclusa mas não liberada.';

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
            $_SESSION['tipoVeiculo'] = $tipoVeiculo;
            $_SESSION['tipoVeiculoHandle'] = $tipoVeiculoHandle;
            $_SESSION['docaHandle'] = $docaHandle;
            $_SESSION['propriedadeVeiculo'] = $propriedadeVeiculo;
            $_SESSION['propriedadeVeiculoHandle'] = $propriedadeVeiculoHandle;
            $_SESSION['documentoMotorista'] = $documentoMotorista;
            //inserir conteiner
            $_SESSION['codigoConteiner'] = $codigoConteiner;
            $_SESSION['tipoEquipamento'] = $tipoEquipamento;
            $_SESSION['tipoEquipamentoHandle'] = $tipoEquipamentoHandle;
            $_SESSION['codigoISO'] = $codigoISO;
            $_SESSION['codigoISOHandle'] = $codigoISOHandle;
            $_SESSION['alturaConteiner'] = $alturaConteiner;
            $_SESSION['larguraConteiner'] = $larguraConteiner;
            $_SESSION['comprimentoConteiner'] = $comprimentoConteiner;
            $_SESSION['capacidadeConteiner'] = $capacidadeConteiner;
            $_SESSION['taraConteiner'] = $taraConteiner;
            $_SESSION['mgwConteiner'] = $mgwConteiner;
            $_SESSION['fabricacaoConteiner'] = $fabricacaoConteiner;
            $_SESSION['obsInserirConteiner'] = $obsInserirConteiner;

            header('Location: ../../view/operacional/ProgramacaoCargaDescarga.php?referencia=' . $referencia);
        }//else if($sucessoLiberar == 'False'){
    }//if($sucesso == 'True'){
    else if ($sucesso == 'False') {
        $_SESSION['mensagem'] = $mensagem;

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
        $_SESSION['tipoVeiculo'] = $tipoVeiculo;
        $_SESSION['tipoVeiculoHandle'] = $tipoVeiculoHandle;
        $_SESSION['docaHandle'] = $docaHandle;
        $_SESSION['propriedadeVeiculo'] = $propriedadeVeiculo;
        $_SESSION['propriedadeVeiculoHandle'] = $propriedadeVeiculoHandle;
        $_SESSION['documentoMotorista'] = $documentoMotorista;
        //inserir conteiner
        $_SESSION['codigoConteiner'] = $codigoConteiner;
        $_SESSION['tipoEquipamento'] = $tipoEquipamento;
        $_SESSION['tipoEquipamentoHandle'] = $tipoEquipamentoHandle;
        $_SESSION['codigoISO'] = $codigoISO;
        $_SESSION['codigoISOHandle'] = $codigoISOHandle;
        $_SESSION['alturaConteiner'] = $alturaConteiner;
        $_SESSION['larguraConteiner'] = $larguraConteiner;
        $_SESSION['comprimentoConteiner'] = $comprimentoConteiner;
        $_SESSION['capacidadeConteiner'] = $capacidadeConteiner;
        $_SESSION['taraConteiner'] = $taraConteiner;
        $_SESSION['mgwConteiner'] = $mgwConteiner;
        $_SESSION['fabricacaoConteiner'] = $fabricacaoConteiner;
        $_SESSION['obsInserirConteiner'] = $obsInserirConteiner;

        header('Location: ../../view/operacional/ProgramacaoCargaDescarga.php?referencia=' . $referencia);
    }//else if($sucesso == 'False'){
} //try
catch (SoapFault $e) {
    // var_dump($e->getMessage());

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
    $_SESSION['tipoVeiculo'] = $tipoVeiculo;
    $_SESSION['tipoVeiculoHandle'] = $tipoVeiculoHandle;
    $_SESSION['docaHandle'] = $docaHandle;
    $_SESSION['propriedadeVeiculo'] = $propriedadeVeiculo;
    $_SESSION['propriedadeVeiculoHandle'] = $propriedadeVeiculoHandle;
    $_SESSION['documentoMotorista'] = $documentoMotorista;
    //inserir conteiner
    $_SESSION['codigoConteiner'] = $codigoConteiner;
    $_SESSION['tipoEquipamento'] = $tipoEquipamento;
    $_SESSION['tipoEquipamentoHandle'] = $tipoEquipamentoHandle;
    $_SESSION['codigoISO'] = $codigoISO;
    $_SESSION['codigoISOHandle'] = $codigoISOHandle;
    $_SESSION['alturaConteiner'] = $alturaConteiner;
    $_SESSION['larguraConteiner'] = $larguraConteiner;
    $_SESSION['comprimentoConteiner'] = $comprimentoConteiner;
    $_SESSION['capacidadeConteiner'] = $capacidadeConteiner;
    $_SESSION['taraConteiner'] = $taraConteiner;
    $_SESSION['mgwConteiner'] = $mgwConteiner;
    $_SESSION['fabricacaoConteiner'] = $fabricacaoConteiner;
    $_SESSION['obsInserirConteiner'] = $obsInserirConteiner;

    header('Location: ../../view/operacional/ProgramacaoCargaDescarga.php?referencia=' . $referencia);
}
?>