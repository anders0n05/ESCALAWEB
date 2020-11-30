<?php

    include_once('../../controller/tecnologia/Sistema.php');
    
    include_once('../../model/rastreamento/ModelRastreioPedidoOcorrencia.php');

    date_default_timezone_set('America/Sao_Paulo');

    $acao = $_POST['ACAO'];
    
    $Ocorrencia = new Ocorrencia();
    
    switch ($acao) {
        case "getOcorrenciaTransporte":
            $ocorrenciaHandle = $_POST['OCORRENCIA'];
            
            $Ocorrencia->setHandle($ocorrenciaHandle);
            $Ocorrencia->getOcorrencia();
        break;
        case "getOcorrenciaTransporteAnexo":
            $ocorrenciaHandle = $_POST['OCORRENCIA'];
            
            $Ocorrencia->setHandle($ocorrenciaHandle);
            $Ocorrencia->getOcorrenciaAnexo();    
        break;
        case "baixarOcorrenciaTransporteAnexo":
            $handleAnexo = $_POST['ANEXO'];
            $ocorrenciaHandle = $_POST['OCORRENCIA'];
            
            $Ocorrencia->setHandleAnexo($handleAnexo);
            $Ocorrencia->setHandle($ocorrenciaHandle);
            $Ocorrencia->getAnexo();    
        break;
        default: 
            throw new Exception("Ação inválida",
                                "Ação: ".$acao);
    }

    ?>