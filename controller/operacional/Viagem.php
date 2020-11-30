<?php

    include_once('../../controller/tecnologia/Sistema.php');
    
    include_once('../../model/operacional/ModelViagem.php');

    date_default_timezone_set('America/Sao_Paulo');

    //var_dump($_POST);

    if (!isset($_POST['ACAO'])){
        throw new Exception("Ação inválida. Nenhuma ação informada.");
    }

    $acao = $_POST['ACAO'];
    $handle = $_POST['HANDLE'];

    $viagem = new Viagem();
    
    $viagem->setHandle($handle);

    if ($acao == "efetuarsaida"){

        $viagem->EfetuarSaida();

    }
    else if ($acao == 'efetuarchegada'){

        $viagem->efetuarChegada();

    }
    else if ($acao == "getFiliais"){

        $viagem->getFiliaisEmpresa();

    }
    else if ($acao == "getPermissoesBotao"){

        $viagem->getPermissoesBotao();

    }
    
    else if ($acao == "getFiliaisEmpresa"){

        $viagem->getListaFiliaisEmpresa();

    }
    
    else if ($acao == "getOcorrenciaResponsavel"){
        $viagem->getListaResponsavelOcorrencia();
    }
    
    else if ($acao == "getTiposOcorrencia"){

        $viagem->getListaTipoOcorrencia();

    }

    else if ($acao == "baixarItensViagem"){
        $dados = $_POST["DADOS"];

        $viagem->baixarItens($dados);
    }

    else if ($acao == "getOcorrenciaMotivo"){
        
        $viagem->getListaMotivoOcorrencia();

    }

    else if ($acao == "getMotivoGenericoOcorrencia") {

        $viagem->getListaMotivoGenericoOcorrencia();
        
    }

    else{
        throw new Exception("Ação inválida",
                            "Ação: ".$acao);
    }

    ?>