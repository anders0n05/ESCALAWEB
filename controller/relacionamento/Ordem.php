<?php

    include_once('../../controller/tecnologia/Sistema.php');
    
    include_once('../../model/relacionamento/ModelOrdem.php');

    date_default_timezone_set('America/Sao_Paulo');

    //var_dump($_POST);
    $acao = $_POST['ACAO'];
    
    //$handle = $_POST['HANDLE'];
    
    $OrdemRelacionamento = new OrdemRelacionamento();
    
   // $OrdemRelacionamento->setHandle($handle);

    switch ($acao) {
        case "getMarcas":
            $OrdemRelacionamento->getMarcas();
            break;

        case "getModelos":
            $marca =  $_POST['MARCA'];

            $OrdemRelacionamento->getModelos($marca);
            break;

        case "getTipos":
            $OrdemRelacionamento->getTipos();
            break;

        case "getTipoClienteObrigatorio":
            $tipo =  $_POST['TIPO'];

            $OrdemRelacionamento->getTipoClienteObrigatorio($tipo);
            break;

        case "getDadosFromCepSemMascara":
            $cep = $_POST['CEP'];

            $OrdemRelacionamento->getDadosFromCepSemMascara($cep);
            break;
        
        case "getEstados":
            $OrdemRelacionamento->getEstados();
            break;

        case "getMunicipios":
            $estado = $_POST['ESTADO'];
            $OrdemRelacionamento->getMunicipios($estado);

            break;
        
        case "getBairros":
            $municipio = $_POST['MUNICIPIO'];
            $OrdemRelacionamento->getBairros($municipio);

            break;

        case "getDadosFromCnpjCpf":
            $cnpjCpf = $_POST['CPFCNPJ'];
            $OrdemRelacionamento->getDadosFromCnpjCpf($cnpjCpf);

            break;
        
        case "cadastrarRelacionamento":
            
            $dados = [];
            $dados["TIPOHANDLE"] = $_POST["TIPO"];
            $dados["CNPJCPFSEMMASCARA"] = $_POST["CNPJCPFSEMMASCARA"];
            $dados["EMAIL"] = $_POST["EMAIL"];
            $dados["NOME"] = $_POST["NOME"];
            $dados["TELEFONE"] = $_POST["TELEFONE"];
            $dados["MARCANOME"] = $_POST["MARCANOME"];
            $dados["MODELONOME"] = $_POST["MODELONOME"];
            $dados["NROSERIE"] = $_POST["NROSERIE"];
            $dados["NRONFE"] = $_POST["NRONFE"];
            $dados["DESCRICAO"] = $_POST["DESCRICAO"];
            $dados["CHAVE"] = $_POST["CHAVE"];

            
            if (isset($_POST['ESTADO'])){
                $dados["UFHANDLE"] = $_POST["ESTADO"];
                $dados["UFSIGLA"] = $_POST["UFSIGLA"];
            }
            else{
                $dados["UFHANDLE"] = 0;
                $dados["UFSIGLA"] = "";
            }

            if (isset($_POST['MUNICIPIO'])){
                $dados["MUNICIPIONOME"] = $_POST["MUNICIPIONOME"];
                $dados["MUNICIPIOHANDLE"] = $_POST["MUNICIPIO"];
            }
            else{
                $dados["MUNICIPIOHANDLE"] = 0;
                $dados["MUNICIPIONOME"] = "";
            }

            if (isset($_POST['BAIRRO'])){
                $dados["BAIRRO"] = $_POST["BAIRRO"];
            }
            else{
                $dados["BAIRRO"] = "";
            }
            
            $dados["LOGRADOURO"] = $_POST["LOGRADOURO"];
            $dados["ENDERECONUMERO"] = $_POST["ENDERECONUMERO"];
            $dados["CEP"] = $_POST["CEPSEMMASCARA"];
            $dados["COMPLEMENTO"] = $_POST["COMPLEMENTO"];

            $OrdemRelacionamento->cadastrarRelacionamento($dados);

            break;

        default: 
            throw new Exception("Ação inválida",
                                "Ação: ".$acao);
    }

    ?>