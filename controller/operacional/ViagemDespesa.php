<?php

    include_once('../../controller/tecnologia/Sistema.php');
    
    include_once('../../model/operacional/ModelViagemDespesa.php');

    date_default_timezone_set('America/Sao_Paulo');

    //var_dump($_POST);

    $acao = $_POST['ACAO'];
        
    $viagemDespesa = new ViagemDespesa();
    
    if( isset($_POST['HANDLE']) )
    {
        $handle = $_POST['HANDLE'];
        $viagemDespesa->setHandle($handle);
    }

    if( isset($_POST['VIAGEM']) )
    {
        $viagem = $_POST['VIAGEM'];
        $viagemDespesa->setViagem($viagem);
    }

    if ($acao == "getListaTipoDespesa"){
        $viagemDespesa->getListaTipoDespesa();
    }

    else if ($acao == "getListaDespesa"){
        $tipo = $_POST["TIPO"];
        $viagemDespesa->getListaDespesa($tipo);
    }

    else if ($acao == "cadastrar"){
        $dados = $_POST["DADOS"];

        $viagemDespesa->Cadastrar($dados);
    }

    else if ($acao == "getDespesas"){
        $viagemDespesa->getDespesasViagem();
    }

    else{
        throw new Exception("Ação inválida",
                            "Ação: ".$acao);
    }