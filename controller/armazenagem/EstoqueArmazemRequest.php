<?php
include_once('../tecnologia/Sistema.php');
include_once('EstoqueArmazemController.php');

$conexao = Sistema::getConexao();

$estoqueArmazem = new EstoqueArmazemController($conexao);

switch($_POST['REQUEST']) {
    
    case 'getRegistro':
        $dadosFiltro = json_decode(json_encode($_POST["FILTRO"]));
        
        $filtro = "";
        if(is_array($dadosFiltro->PRODUTO)) {
            $filtro = " AND A.ITEM IN (" . implode(',', $dadosFiltro->PRODUTO) . ") ";
        }
        
        if(is_array($dadosFiltro->CLIENTE)) {
            $filtro .= " AND A.CLIENTE IN (" . implode(',', $dadosFiltro->CLIENTE) . ") ";
        }
        
        if(is_array($dadosFiltro->NATUREZAMERCADORIA)) {
            $filtro .= " AND B0.NATUREZAMERCADORIA IN (" . implode(',', $dadosFiltro->NATUREZAMERCADORIA) . ") ";
        }
        
        if(!empty($dadosFiltro->NRPEDIDO)) {
            $filtro .= " AND B14.NUMEROPEDIDO = '" . $dadosFiltro->NRPEDIDO . "' ";
        }
        
        if(!empty($dadosFiltro->LOTE)) {
            $filtro .= " AND B8.NOME = '" . $dadosFiltro->LOTE . "' ";
        }
        
        if(!empty($dadosFiltro->VALIDADE)) {
            $filtro .= " AND B7.VALIDADE = '" . $dadosFiltro->VALIDADE . "' ";
        }
        
        if(!empty($dadosFiltro->NOTAFISCAL)) {
            $filtro .= " AND B12.NUMERO = '" . $dadosFiltro->NOTAFISCAL . "' ";
        }
        
        if(!empty($dadosFiltro->EMISSAO)) {
            $filtro .= " AND B12.EMISSAO = '" . $dadosFiltro->EMISSAO . "' ";
        }
        
        $rows = $estoqueArmazem->getRegistro($filtro);
        
        echo json_encode($rows);
    break;    
    
    case 'getFiltroProduto':
        $estoqueArmazem->montaFiltro();
        
        echo json_encode($estoqueArmazem->getFiltro('PRODUTO'));
    break;    

    case 'getFiltroCliente':
        $estoqueArmazem->montaFiltro();
        
        echo json_encode($estoqueArmazem->getFiltro('CLIENTE'));
    break;

    case 'getFiltroNaturezaMercadoria':
        $estoqueArmazem->montaFiltro();
        
        echo json_encode($estoqueArmazem->getFiltro('NATUREZAMERCADORIA'));
    break;
    
    case 'getFiltroLote':
        $estoqueArmazem->montaFiltro();
        
        echo json_encode($estoqueArmazem->getFiltro('LOTE'));
    break;    
}