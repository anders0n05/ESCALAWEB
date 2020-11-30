<?php

Sistema::iniciaCarregando();

$pessoaUsuarioFiltro = Sistema::getPessoaUsuarioToStr($connect);

if (!empty($pessoaUsuarioFiltro)) {
    $filtroPessoaUsuario = " AND A.HANDLE IN (SELECT X.HANDLE
                                                FROM AM_CARREGAMENTO X
                                               WHERE X.CLIENTE IN ($pessoaUsuarioFiltro)

                                               UNION ALL

                                              SELECT X.HANDLE
                                                FROM AM_CARREGAMENTO X
                                               WHERE X.TRANSPORTADORA IN ($pessoaUsuarioFiltro)) ";
} else {
    $filtroPessoaUsuario = "";
}

$queryProgramacao = "SELECT HANDLE,  
                            STATUS, 
                            NUMERO,
                            TIPOPROCESSO,
                            TRANSPORTADORA,
                            FILIAL, 
                            TIPO, 
                            DOCA, 
                            DATA, 
                            PREVISAOENTREGA, 
                            VEICULO, 
                            ACOPLADO, 
                            MOTORISTA, 
                            NUMEROCONTROLE, 
                            TIPOVEICULO, 
                            CONTEINER,
                            STATUSNOME,
                            CLIENTE,
                            NUMEROPEDIDO,
                            CLIENTEFINAL,
                            LOCALENTREGA,
                            MUNICIPIOLOCALENTREGA,
                            ESTADOLOCALENTREGA,
                            QUANTIDADEEXPEDICAO,
                            QUANTIDADEEMBALAGEM,
                            OBSERVACAO,                                               
                            COLETAPROGRAMADO,
                            INICIO,
                            TERMINO,                                               
                            RESOURCENAME,
                            SUM(PESOBRUTO) PESOBRUTO
                      FROM ( SELECT DISTINCT TOP 1000 A.HANDLE HANDLE,  
                                               A.STATUS STATUS, 
                                               A.NUMERO NUMERO,
                                               A.TIPOPROCESSO TIPOPROCESSO,
                                               B9.APELIDO TRANSPORTADORA,
                                               B1.SIGLA FILIAL, 
                                               B2.SIGLA TIPO, 
                                               B3.SIGLA DOCA, 
                                               A.DATA DATA, 
                                               A.PREVISAOENTREGA PREVISAOENTREGA, 
                                               A.PLACA VEICULO, 
                                               A.CARRETA ACOPLADO, 
                                               A.MOTORISTA MOTORISTA, 
                                               A.NUMEROCONTROLE NUMEROCONTROLE, 
                                               B5.NOME TIPOVEICULO, 
                                               B6.CODIGO CONTEINER,
                                               B8.NOME STATUSNOME,
                                               B7.APELIDO CLIENTE,
                                               B10.NUMEROPEDIDO NUMEROPEDIDO,
                                               B11.APELIDO CLIENTEFINAL,
                                               B12.APELIDO LOCALENTREGA,
                                               B14.NOME MUNICIPIOLOCALENTREGA,
                                               B15.SIGLA ESTADOLOCALENTREGA,
                                               B10.QUANTIDADEEXPEDICAO,
                                               B10.QUANTIDADEEMBALAGEM,
                                               A.OBSERVACAO OBSERVACAO,
                                               
                                               B17.PREVISAO COLETAPROGRAMADO,
                                               B17.INICIO INICIO,
                                               B17.TERMINO TERMINO,
                                               
                                               C.RESOURCENAME RESOURCENAME,

                                               COALESCE((SELECT SUM(X.QUANTIDADE)
                                                           FROM AM_ORDEMPROGRAMACAO X (NOLOCK)
                                                          WHERE X.HANDLE = Z21.ORDEMPROGRAMACAO), 0) PESOBRUTO

                                               FROM AM_CARREGAMENTO A (NOLOCK) 
                                               LEFT JOIN MS_FILIAL B1 (NOLOCK) ON A.FILIAL = B1.HANDLE 
                                               LEFT JOIN AM_TIPOCARREGAMENTO B2 (NOLOCK) ON A.TIPO = B2.HANDLE 
                                               LEFT JOIN AM_DOCA B3 (NOLOCK) ON A.DOCA = B3.HANDLE 
                                               LEFT JOIN MF_TIPOVEICULO B5 (NOLOCK) ON A.TIPOVEICULO = B5.HANDLE 
                                               LEFT JOIN PA_CONTEINER B6 (NOLOCK) ON A.CONTEINER = B6.HANDLE 
                                               LEFT JOIN MS_PESSOA B7 (NOLOCK) ON A.CLIENTE = B7.HANDLE 
                                               LEFT JOIN AM_STATUSCARREGAMENTO B8 (NOLOCK) ON B8.HANDLE = A.STATUS
                                               LEFT JOIN MS_PESSOA B9 (NOLOCK) ON B9.HANDLE = A.TRANSPORTADORA
                                               
                                               INNER JOIN AM_CARREGAMENTOITEM Z1 (NOLOCK) ON Z1.CARREGAMENTO = A.HANDLE AND Z1.STATUS <> 4
                                               INNER JOIN AM_ORDEMITEMSEPARACAOEXPEDICAO Z2 (NOLOCK) ON Z2.EMBALAGEM = Z1.EMBALAGEM AND Z2.STATUS <> 3                                             
                                               INNER JOIN AM_ORDEMITEMSEPARACAO Z21 (NOLOCK) ON Z21.HANDLE = Z2.ITEMSEPARACAO
                                               
                                               
                                               INNER JOIN AM_ORDEM B10 (NOLOCK) ON B10.HANDLE = Z2.ORDEM
                                               
                                               LEFT JOIN MS_PESSOA B11 (NOLOCK) ON B11.HANDLE = B10.CLIENTEFINAL
                                               LEFT JOIN MS_PESSOA B12 (NOLOCK) ON B12.HANDLE = B10.LOCALENTREGA
                                               LEFT JOIN MS_PESSOAENDERECO B13 (NOLOCK) ON B13.HANDLE = B12.ENDERECOFISCAL
                                               LEFT JOIN MS_MUNICIPIO B14 (NOLOCK) ON B14.HANDLE = B13.MUNICIPIO
                                               LEFT JOIN MS_ESTADO B15 (NOLOCK) ON B15.HANDLE = B14.ESTADO
                                               LEFT JOIN AM_PROGRAMACAODOCA B17 (NOLOCK) ON B17.HANDLE = A.PROGRAMACAODOCA
                                               LEFT JOIN MD_IMAGEM C (NOLOCK) ON C.HANDLE = B8.IMAGEM
                                              WHERE A.EMPRESA = $empresa
                                                AND A.TRANSPORTADORA IS NOT NULL
                                                AND A.STATUS NOT IN (4, 5)
                                                " . $filtroPessoaUsuario . "
                                                " . Sistema::getFiltroPostEntreDataMinuto('dataInicio', 'dataFinal', 'A.PREVISAOENTREGA') . "
                                                " . Sistema::getFiltroPostData('dataEmbarque', 'A.CARREGAMENTO') . "
                                                " . Sistema::getFiltroPostData('dataColeta', 'A.DATA') . "
                                                " . Sistema::getFiltroPostTexto("pedido", "B10.NUMEROPEDIDO") . "
                                                " . Sistema::getFiltroPostLookup("transportadoraHandle", "A.TRANSPORTADORA") . "

                                  UNION ALL  

                                       SELECT DISTINCT TOP 1000 A.HANDLE HANDLE,  
                                               A.STATUS STATUS, 
                                               A.NUMERO NUMERO,
                                               A.TIPOPROCESSO TIPOPROCESSO,
                                               B9.APELIDO TRANSPORTADORA,
                                               B1.SIGLA FILIAL, 
                                               B2.SIGLA TIPO, 
                                               B3.SIGLA DOCA, 
                                               A.DATA DATA, 
                                               A.PREVISAOENTREGA PREVISAOENTREGA, 
                                               A.PLACA VEICULO, 
                                               A.CARRETA ACOPLADO, 
                                               A.MOTORISTA MOTORISTA, 
                                               A.NUMEROCONTROLE NUMEROCONTROLE, 
                                               B5.NOME TIPOVEICULO, 
                                               B6.CODIGO CONTEINER,
                                               B8.NOME STATUSNOME,
                                               B7.APELIDO CLIENTE,
                                               B10.NUMEROPEDIDO NUMEROPEDIDO,
                                               B11.APELIDO CLIENTEFINAL,
                                               B12.APELIDO LOCALENTREGA,
                                               B14.NOME MUNICIPIOLOCALENTREGA,
                                               B15.SIGLA ESTADOLOCALENTREGA,
                                               B10.QUANTIDADEEXPEDICAO,
                                               B10.QUANTIDADEEMBALAGEM,
                                               A.OBSERVACAO OBSERVACAO,
                                               
                                               B17.PREVISAO COLETAPROGRAMADO,
                                               B17.INICIO INICIO,
                                               B17.TERMINO TERMINO,
                                               
                                               C.RESOURCENAME RESOURCENAME,

                                               COALESCE((SELECT SUM(X.PESOBRUTO)
                                                           FROM AM_ORDEMITEM X (NOLOCK)
                                                          WHERE X.ORDEM = B10.HANDLE
                                                            AND X.STATUS <> 3), 0) PESOBRUTO

                                               FROM AM_CARREGAMENTO A (NOLOCK)
                                               LEFT JOIN MS_FILIAL B1 (NOLOCK) ON A.FILIAL = B1.HANDLE 
                                               LEFT JOIN AM_TIPOCARREGAMENTO B2 (NOLOCK) ON A.TIPO = B2.HANDLE 
                                               LEFT JOIN AM_DOCA B3 (NOLOCK) ON A.DOCA = B3.HANDLE 
                                               LEFT JOIN MF_TIPOVEICULO B5 (NOLOCK) ON A.TIPOVEICULO = B5.HANDLE 
                                               LEFT JOIN PA_CONTEINER B6 (NOLOCK) ON A.CONTEINER = B6.HANDLE 
                                               LEFT JOIN MS_PESSOA B7 (NOLOCK) ON A.CLIENTE = B7.HANDLE 
                                               LEFT JOIN AM_STATUSCARREGAMENTO B8 (NOLOCK) ON B8.HANDLE = A.STATUS
                                               LEFT JOIN MS_PESSOA B9 (NOLOCK) ON B9.HANDLE = A.TRANSPORTADORA
                                               
                                               LEFT JOIN AM_ORDEMCONTEINER Z1 (NOLOCK) ON Z1.CARREGAMENTO = A.HANDLE                                                                                              
                                               
                                               LEFT JOIN AM_ORDEM B10 (NOLOCK) ON B10.HANDLE = Z1.ORDEM
                                               
                                               LEFT JOIN MS_PESSOA B11 (NOLOCK) ON B11.HANDLE = B10.CLIENTEFINAL
                                               LEFT JOIN MS_PESSOA B12 (NOLOCK) ON B12.HANDLE = B10.LOCALENTREGA
                                               LEFT JOIN MS_PESSOAENDERECO B13 (NOLOCK) ON B13.PESSOA = B12.HANDLE
                                               LEFT JOIN MS_MUNICIPIO B14 (NOLOCK) ON B14.HANDLE = B13.MUNICIPIO
                                               LEFT JOIN MS_ESTADO B15 (NOLOCK) ON B15.HANDLE = B14.ESTADO
                                               LEFT JOIN AM_PROGRAMACAODOCA B17 (NOLOCK) ON B17.HANDLE = A.PROGRAMACAODOCA
                                               LEFT JOIN MD_IMAGEM C (NOLOCK) ON C.HANDLE = B8.IMAGEM
                                              WHERE A.EMPRESA = $empresa
                                                AND A.TRANSPORTADORA IS NOT NULL
                                                AND A.STATUS NOT IN (4, 5)
                                                " . $filtroPessoaUsuario . "
                                                " . Sistema::getFiltroPostEntreDataMinuto('dataInicio', 'dataFinal', 'A.PREVISAOENTREGA') . "
                                                " . Sistema::getFiltroPostData('dataEmbarque', 'A.CARREGAMENTO') . "
                                                " . Sistema::getFiltroPostData('dataColeta', 'A.DATA') . "
                                                " . Sistema::getFiltroPostTexto("pedido", "B10.NUMEROPEDIDO") . "
                                                " . Sistema::getFiltroPostLookup("transportadoraHandle", "A.TRANSPORTADORA") . "
                                               
                                  ) TABELA  GROUP BY HANDLE,  
                                                 STATUS, 
                                                 NUMERO,
                                                 TIPOPROCESSO,
                                                 TRANSPORTADORA,
                                                 FILIAL, 
                                                 TIPO, 
                                                 DOCA, 
                                                 DATA, 
                                                 PREVISAOENTREGA, 
                                                 VEICULO, 
                                                 ACOPLADO, 
                                                 MOTORISTA, 
                                                 NUMEROCONTROLE, 
                                                 TIPOVEICULO, 
                                                 CONTEINER,
                                                 STATUSNOME,
                                                 CLIENTE,
                                                 NUMEROPEDIDO,
                                                 CLIENTEFINAL,
                                                 LOCALENTREGA,
                                                 MUNICIPIOLOCALENTREGA,
                                                 ESTADOLOCALENTREGA,
                                                 QUANTIDADEEXPEDICAO,
                                                 QUANTIDADEEMBALAGEM,
                                                 OBSERVACAO,                                               
                                                 COLETAPROGRAMADO,
                                                 INICIO,
                                                 TERMINO,                                               
                                                 RESOURCENAME
                                        ORDER BY NUMERO DESC ";

try {
    $queryProgramacaoPrepare = $connect->prepare($queryProgramacao);
    $queryProgramacaoPrepare->execute();
    
    $rowProgramacao = $queryProgramacaoPrepare->fetch(PDO::FETCH_ASSOC);
    
    if (!empty($rowProgramacao)) {
        do {
            $programacaoHandle = $rowProgramacao['HANDLE'];
            $programacaoStatus = $rowProgramacao['STATUS'];
            
            $programacaoStatusIcone = Sistema::getImagem($rowProgramacao['RESOURCENAME'], $rowProgramacao['STATUSNOME']);
            $programacaoNumero = $rowProgramacao['NUMERO'];
            $programacaoNumeroPedido = $rowProgramacao['NUMEROPEDIDO'];
            $programacaoTransportadora = $rowProgramacao['TRANSPORTADORA'];
            $programacaoColeta = Sistema::formataDataHora($rowProgramacao['DATA']);
            $programacaoEntrega = Sistema::formataDataHora($rowProgramacao['PREVISAOENTREGA']);
            $programacaoProgramacaoEntrega = Sistema::formataDataHora($rowProgramacao['COLETAPROGRAMADO']);
            $programacaoTipo = $rowProgramacao['TIPO'];
            $programacaoFilial = $rowProgramacao['FILIAL'];
            $programacaoClienteFinal = $rowProgramacao['CLIENTEFINAL'];
            $programacaoLocalEntrega = $rowProgramacao['LOCALENTREGA'];
            $programacaoMunicipioLocalEntrega = $rowProgramacao['MUNICIPIOLOCALENTREGA'];
            $programacaoEstadoLocalEntrega = $rowProgramacao['ESTADOLOCALENTREGA'];
            $programacaoVolume = $rowProgramacao['QUANTIDADEEXPEDICAO'];
            $programacaoEmbalagem = $rowProgramacao['QUANTIDADEEMBALAGEM'];
            $programacaoPesoBruto = Sistema::formataValor($rowProgramacao['PESOBRUTO']);
            $programacaoTipoVeiculo = $rowProgramacao['TIPOVEICULO'];
            $programacaoVeiculo = $rowProgramacao['VEICULO'];
            $programacaoAcoplado = $rowProgramacao['ACOPLADO'];
            $programacaoConteiner = $rowProgramacao['CONTEINER'];
            $programacaoMotorista = $rowProgramacao['MOTORISTA'];
            $programacaoOBS = Sistema::formataTexto($rowProgramacao['OBSERVACAO']);

            $programacaoColetaOrdenacao = strtotime($rowProgramacao['DATA']);
            $programacaoEntregaOrdenacao = strtotime($rowProgramacao['PREVISAOENTREGA']);
            $programacaoProgramacaoEntregaOrdenacao = strtotime($rowProgramacao['COLETAPROGRAMADO']);
            echo "  <tr>
                        <td class='handle' hidden='true'>$programacaoHandle</td>
                        <td>$programacaoStatusIcone</td>
                        <td class=\"text-right\">$programacaoNumero</td>
                        <td class=\"text-right\">$programacaoNumeroPedido</td>
                        <td>$programacaoTransportadora</td>
                        <td class=\"text-center\"><span style=\"display:none\">$programacaoColetaOrdenacao</span>$programacaoColeta</td>
                        <td class=\"text-center\"><span style=\"display:none\">$programacaoEntregaOrdenacao</span>$programacaoEntrega</td>
                        <td class=\"text-center\"><span style=\"display:none\">$programacaoProgramacaoEntregaOrdenacao</span>$programacaoProgramacaoEntrega</td>
                        <td>$programacaoTipo</td>
                        <td>$programacaoFilial</td>
                        <td>$programacaoClienteFinal</td>
                        <td>$programacaoLocalEntrega</td>
                        <td>$programacaoMunicipioLocalEntrega - $programacaoEstadoLocalEntrega</td>
                        <td class=\"text-right\">$programacaoVolume</td>
                        <td class=\"text-right\">$programacaoEmbalagem</td>
                        <td class=\"text-right\">$programacaoPesoBruto</td>
                        <td>$programacaoTipoVeiculo</td>
                        <td>$programacaoVeiculo</td>
                        <td>$programacaoAcoplado</td>
                        <td>$programacaoConteiner</td>
                        <td>$programacaoMotorista</td>
                        <td>$programacaoOBS</td>
                    </tr>";
        } while ($rowProgramacao = $queryProgramacaoPrepare->fetch(PDO::FETCH_ASSOC));
    } else {
        Sistema::getNaoEncontrado();
    }
} catch (Exception $e) {
    Sistema::tratarErro($e);
}
