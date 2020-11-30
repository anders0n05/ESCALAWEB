<?php

Sistema::iniciaCarregando();

$pessoaUsuarioFiltro = Sistema::getPessoaUsuarioToStr($connect);

if (!empty($pessoaUsuarioFiltro)) {
    $filtroPessoaUsuario = " AND A.HANDLE IN (SELECT X.HANDLE
                                                FROM RA_PEDIDO X                     
                                               WHERE EXISTS(SELECT X2.HANDLE
                                                              FROM MS_PESSOA X2
                                                             WHERE X2.HANDLE IN ($pessoaUsuarioFiltro)
                                                               AND X2.CNPJCPF = A.CNPJCPFDESTINATARIO)
                                               UNION ALL
                                            
                                              SELECT X.HANDLE
                                                FROM RA_PEDIDO X                     
                                               WHERE EXISTS(SELECT X2.HANDLE
                                                              FROM MS_PESSOA X2
                                                             WHERE X2.HANDLE IN ($pessoaUsuarioFiltro)
                                                               AND X2.CNPJCPF = A.CNPJCPFREMETENTE)
                                            
                                               UNION ALL
                                            
                                              SELECT X.HANDLE
                                                FROM RA_PEDIDO X                     
                                               WHERE EXISTS(SELECT X2.HANDLE
                                                              FROM MS_PESSOA X2
                                                             WHERE X2.HANDLE IN ($pessoaUsuarioFiltro)
                                                               AND X2.CNPJCPF = G.CNPJCPF)) ";
} else {
    $filtroPessoaUsuario = "";
}

$vFiltro = "";
$bFiltro = false;

if ((Sistema::getFiltroGetLookupArray("cliente", "A.CLIENTE") != '') and (Sistema::getFiltroGetLookupArray("unidadenegocio", "A.UNIDADENEGOCIOCLIENTE") == '')) {
    $vFiltroUnidadeNegocio = " AND (A.UNIDADENEGOCIOCLIENTE IN (SELECT X.UNIDADENEGOCIOCLIENTE
                                                          FROM MS_PESSOACLIENTEUNIDADE X
                                                         INNER JOIN MS_PESSOACLIENTE Y ON Y.HANDLE = X.CLIENTE
                                                         WHERE Y.PESSOA = A.CLIENTE) or A.UNIDADENEGOCIOCLIENTE IS NULL)";
    $bFiltro = true;
} else {
    $vFiltroUnidadeNegocio = Sistema::getFiltroGetLookupArray("unidadenegocio", "A.UNIDADENEGOCIOCLIENTE");
}

if (Sistema::getFiltroGetTexto("documento", "Y.NUMERO") == '') {
    $vFiltroDocumento = "";
} else {
    $vFiltroDocumento = " AND EXISTS (SELECT 1 
                                        FROM RA_PEDIDOMOVIMENTACAO X
                                       INNER JOIN GD_ORIGINARIO Y ON Y.HANDLE = X.HANDLEORIGEM
                                       WHERE X.PEDIDO = A.HANDLE 
                                         AND X.ORIGEM = 1890
                                     " . Sistema::getFiltroGetTexto("documento", "Y.NUMERO") . ")";
    $bFiltro = true;                                     
}

if (Sistema::getFiltroGetTexto("cte", "Y.NUMERO") == '') {
    $vFiltroCte = "";
} else {
    $vFiltroCte = " AND EXISTS (SELECT 1 
                                        FROM RA_PEDIDOMOVIMENTACAO X
                                       INNER JOIN GD_DOCUMENTO Y ON Y.HANDLE = X.HANDLEORIGEM
                                       WHERE X.PEDIDO = A.HANDLE 
                                         AND X.ORIGEM = 1371
                                     " . Sistema::getFiltroGetTexto("cte", "Y.NUMERO") . ")";
    $bFiltro = true;                                     
}

if (Sistema::getFiltroGetTexto("observacao", "Y.OBSERVACAO") == '') {
    $vFiltroDocumentoObservacao = "";
} else {
    $vFiltroDocumentoObservacao = " AND EXISTS (SELECT 1 
                                        FROM RA_PEDIDOMOVIMENTACAO X
                                       INNER JOIN GD_ORIGINARIO Y ON Y.HANDLE = X.HANDLEORIGEM
                                       WHERE X.PEDIDO = A.HANDLE 
                                         AND X.ORIGEM = 1890
                                     " . Sistema::getFiltroGetLike("observacao", "Y.OBSERVACAO") . ")";
    $bFiltro = true;                                     
}

foreach($_GET as $key => $value) {
    if (($value <> "") && ($key <> "pendente") && ($key <> "ehpendente")) {
        $bFiltro = true;
        break;
    }
}

if ((Sistema::getGet("pendente") == '') && (!$bFiltro)) {
    $vFiltro = " AND A.STATUS IN (6,5,2,1)";       
} else {
    if (Sistema::getFiltroGetIn("pendente", "A.STATUS") == '') {
        $vFiltro = " AND A.STATUS <> 3";
    } else {
        $vFiltro = Sistema::getFiltroGetIn("pendente", "A.STATUS");        
    }
}

$queryPedido = "SELECT TOP 1000 A.HANDLE HANDLE,
                                A.STATUS STATUS,
                                A.DATA DATA,
                                A.RASTREAMENTO RASTREAMENTO,
                                A.VALORMERCADORIA VALORMERCADORIA,
                                A.NOMEREMETENTE REMETENTE,
                                A.NOMEDESTINATARIO DESTINATARIO,
                                A.MUNICIPIOLOCALCOLETA MUNICIPIOCOLETA,
                                A.UFLOCALCOLETA ESTADOCOLETA,
                                A.MUNICIPIOLOCALENTREGA MUNICIPIOENTREGA,
                                A.UFLOCALENTREGA ESTADOENTREGA,
                                A.NUMEROPEDIDO NUMEROPEDIDO,
                                A.NUMEROCONTROLE NUMEROCONTROLE,                                
                                E.NOME STATUSNOME,
                                F.RESOURCENAME RESOURCENAME,
                                G.APELIDO CLIENTE,
                                H.DATA ETAPADATA,
                                I.NOME ETAPAATUAL,
                                A.DATAENTREGA DATAENTREGA,
                                J.NOME TIPO,
                                A.DATAENTREGAATE,

                                (SELECT MIN(X1.NUMERO)
                                   FROM RA_PEDIDOMOVIMENTACAO X
                                  INNER JOIN GD_ORIGINARIO X1 ON X1.HANDLE = X.HANDLEORIGEM
                                  WHERE X.PEDIDO = A.HANDLE
                                    AND X.STATUS = 5
                                    AND X.ORIGEM = 1890) NUMERONOTAFISCAL

	                       FROM RA_PEDIDO A (NOLOCK)
                           LEFT JOIN MS_USUARIO D ON A.LOGUSUARIOCADASTRO = D.HANDLE
                           LEFT JOIN RA_STATUSPEDIDO E ON E.HANDLE = A.STATUS
                           LEFT JOIN MD_IMAGEM F ON F.HANDLE = E.IMAGEM
                           LEFT JOIN MS_PESSOA G ON G.HANDLE = A.CLIENTE                           
                           LEFT JOIN RA_PEDIDOETAPA H ON H.HANDLE = A.ETAPAATUAL
                           LEFT JOIN RA_TIPOETAPA I ON I.HANDLE = H.ETAPA
                          INNER JOIN RA_TIPOPEDIDO J ON J.HANDLE = A.TIPO
                           
			              WHERE A.EMPRESA = $empresa

                            " . $filtroPessoaUsuario . "
                            " . Sistema::getFiltroGetTexto("numeroPedido", "A.NUMEROPEDIDO") . "
                            " . Sistema::getFiltroGetTexto("rastreamento", "A.RASTREAMENTO") . "
                            " . Sistema::getFiltroGetEntreData("dataInicio", "dataFinal", "A.DATA") . "
                            " . Sistema::getFiltroGetLookupArray("filial", "A.FILIAL") . "
                            " . Sistema::getFiltroGetLookupArray("tipo", "A.TIPO") . "
                            " . Sistema::getFiltroGetLookupArray("situacao", "I.HANDLE") . "
                            " . Sistema::getFiltroGetTexto("remetente", "A.NOMEREMETENTE") . "
                            " . Sistema::getFiltroGetTexto("destinatario", "A.NOMEDESTINATARIO") . "
                            " . Sistema::getFiltroGetTexto("numeroControle", "A.NUMEROCONTROLE") . "
                            " . Sistema::getFiltroGetLookupArray("cliente", "A.CLIENTE") . "
                            " . $vFiltroUnidadeNegocio .
    $vFiltro .
    $vFiltroDocumento .
    $vFiltroDocumentoObservacao .
    $vFiltroCte;

try {
    $retornoJson = array();

    $queryPedidoPrepare = $connect->prepare($queryPedido);
    $queryPedidoPrepare->execute();

    $rowPedido = $queryPedidoPrepare->fetch(PDO::FETCH_ASSOC);

    if (!empty($rowPedido)) {
        do {
            $pedidoHandle = Sistema::formataInt($rowPedido['HANDLE']);
            $pedidoStatus = Sistema::formataInt($rowPedido['STATUS']);

            $pedidoStatusIcone = Sistema::getImagem($rowPedido['RESOURCENAME'], $rowPedido['STATUSNOME']);
            $pedidoRastreamento = $rowPedido['RASTREAMENTO'];
            $pedidoTipo = $rowPedido['TIPO'];
            $pedidoDataEntrega = Sistema::formataData($rowPedido['DATAENTREGA']);
            $pedidoNumeroPedido = $rowPedido['NUMEROPEDIDO'];
            $pedidoNumeroControle = $rowPedido['NUMEROCONTROLE'];
            $pedidoNumeroNotaFiscal = Sistema::formataTexto($rowPedido['NUMERONOTAFISCAL'], 15);
            $pedidoRemetente = $rowPedido['REMETENTE'];
            $pedidoMunicipioColeta = $rowPedido['MUNICIPIOCOLETA'];
            $pedidoEstadoColeta = $rowPedido['ESTADOCOLETA'];
            $pedidoDestinatario = $rowPedido['DESTINATARIO'];
            $pedidoMunicipioEntrega = $rowPedido['MUNICIPIOENTREGA'];
            $pedidoEstadoEntrega = $rowPedido['ESTADOENTREGA'];
            $pedidoEntregarAte = Sistema::formataData($rowPedido['DATAENTREGAATE']);
            $pedidoEtapaAtual = $rowPedido['ETAPAATUAL'];
            $pedidoEtapaDuracao = Sistema::formataDuracao($rowPedido['ETAPADATA']);
            $pedidoCliente = $rowPedido['CLIENTE'];
            $pedidoValor = Sistema::formataValor($rowPedido['VALORMERCADORIA']);
            $pedidoData = Sistema::formataData($rowPedido['DATA']);

            $linha = array();
            $linha['Rastreamento'] = Sistema::formataTexto($pedidoRastreamento);
            $linha['Tipo'] = Sistema::formataTexto($pedidoTipo);
            $linha['Nr pedido'] = Sistema::formataTexto($pedidoNumeroPedido);
            $linha['Nr controle'] = Sistema::formataTexto($pedidoNumeroControle);
            $linha['Nr nota fiscal'] = Sistema::formataTexto($pedidoNumeroNotaFiscal);
            $linha['Remetente'] = Sistema::formataTexto($pedidoRemetente);
            $linha['Remetente'] = Sistema::formataTexto($pedidoRemetente);
            $linha['Data entrega'] = Sistema::formataTexto($pedidoDataEntrega);
            $linha['Origem'] = Sistema::formataTexto($pedidoMunicipioColeta);
            $linha['UF'] = Sistema::formataTexto($pedidoEstadoColeta);
            $linha['Destinatario'] = Sistema::formataTexto($pedidoDestinatario);
            $linha['Destino'] = Sistema::formataTexto($pedidoMunicipioEntrega);
            $linha['UF'] = Sistema::formataTexto($pedidoEstadoEntrega);
            $linha['Entregar até'] = Sistema::formataTexto($pedidoEntregarAte);
            $linha['Etapa atual'] = Sistema::formataTexto($pedidoEtapaAtual);
            $linha['Duracao'] = Sistema::formataTexto($pedidoEtapaDuracao);
            $linha['Cliente'] = Sistema::formataTexto($pedidoCliente);
            $linha['Valor da mercadoria'] = Sistema::formataTexto($pedidoValor);
            $linha['Data'] = Sistema::formataTexto($pedidoData);

            $retornoJson[] = $linha;

            echo "  <tr>
                        <td hidden='true'><input type='radio' name='check[]' class='check' hidden='true' id='check' data-ref='$pedidoStatus' value='$pedidoHandle'></td>
                        <td>$pedidoStatusIcone</td>
                        <td class=\"text-right\">$pedidoRastreamento</td>
                        <td>$pedidoTipo</td>
                        <td class=\"text-right\">$pedidoNumeroPedido</td>
                        <td class=\"text-right\">$pedidoNumeroControle</td>
                        <td class=\"text-right\">$pedidoNumeroNotaFiscal</td>
                        <td>$pedidoRemetente</td>
                        <td>$pedidoMunicipioColeta</td>
                        <td>$pedidoEstadoColeta</td>
                        <td>$pedidoDestinatario</td>
                        <td>$pedidoMunicipioEntrega</td>
                        <td>$pedidoEstadoEntrega</td>                        
                        <td>$pedidoEntregarAte</td>
                        <td>$pedidoEtapaAtual</td>
                        <td>$pedidoDataEntrega</td>
                        <td>$pedidoEtapaDuracao</td>
                        <td>$pedidoCliente</td>
                        <td class=\"text-right\">$pedidoValor</td>
                        <td class=\"text-center\">$pedidoData</td>
                    </tr>";
        } while ($rowPedido = $queryPedidoPrepare->fetch(PDO::FETCH_ASSOC));
    } else {
        Sistema::getNaoEncontrado();
    }
} catch (Exception $e) {
    Sistema::tratarErro($e);
}
