<?php
$filtroTransportadora = Sistema::getFiltroPostLookup("transportadoraHandle", "A.TRANSPORTADORA");

$dataInicio = strtotime(Sistema::getPost('dataInicio'));
$dataInicioFormat = ($dataInicio === false) ? '' : date('Y-m-d H:i', $dataInicio);
$dataInicioFormatExibe = ($dataInicio === false) ? '' : date('d/m/Y H:i', $dataInicio);
$dataFinal = strtotime(Sistema::getPost('dataFinal'));
$dataFinalFormat = ($dataFinal === false) ? '' : date('Y-m-d H:i', $dataFinal);
$dataFinalFormatExibe = ($dataFinal === false) ? '' : date('d/m/Y H:i', $dataFinal);

$dataEmbarque = strtotime(Sistema::getPost('dataEmbarque'));
$dataEmbarqueFormat = ($dataEmbarque === false) ? '0000-00-00' : date('Y-m-d', $dataEmbarque);
$dataEmbarqueExibe = ($dataEmbarque === false) ? '00-00-0000' : date('d/m/Y', $dataEmbarque);

if ($dataEmbarque > null) {
    $whereDataEmbarque = "AND CAST( A.CARREGAMENTO AS DATE ) = '$dataEmbarqueFormat'";
} else {
    $whereDataEmbarque = null;
}

$dataColetar = strtotime(Sistema::getPost('dataColetar'));
$dataColetarFormat = ($dataColetar === false) ? '0000-00-00' : date('Y-m-d', $dataColetar);
$dataColetarExibe = ($dataColetar === false) ? '00-00-0000' : date('d/m/Y', $dataColetar);

if ($dataColetar > null) {
    $whereDataColetar = "AND CAST( A.DATA AS DATE ) = '$dataColetarFormat'";
} else {
    $whereDataColetar = null;
}

if ($dataInicio > null and $dataFinal > null) {
    $whereData = "AND A.DATA >=  '$dataInicioFormat' AND A.DATA < '$dataFinalFormat'";
} else if ($dataFinal > null and $dataInicio <= null) {
    $whereData = "AND CONVERT(VARCHAR(25), A.DATA, 126) LIKE '$dataFinalFormat%'";
} else if ($dataFinal <= null and $dataInicio > null) {
    $whereData = "AND CONVERT(VARCHAR(25), A.DATA, 126) LIKE '$dataInicioFormat%'";
} else {
    $whereData = ' ';
}
$resultPessoasUsuario = array();
$queryPessoasUsuario = "SELECT PESSOA
						FROM MS_USUARIOPESSOA
						WHERE USUARIO = $handleUsuario";


$queryPessoasUsuario = $connect->prepare($queryPessoasUsuario);

$queryPessoasUsuario->execute();

while ($rowPessoasUsuario = $queryPessoasUsuario->fetch(PDO::FETCH_ASSOC)) {
    $resultPessoasUsuario[] = $rowPessoasUsuario;
}

$wherePessoasUsuario = "AND ( A.TRANSPORTADORA IN (";
foreach ($resultPessoasUsuario as $PessoasUsuario) {
    $wherePessoasUsuario .= $PessoasUsuario['PESSOA'] . ',';
}
$wherePessoasUsuario = substr($wherePessoasUsuario, 0, -1);

$wherePessoasUsuario .= ") OR A.CLIENTE IN (";
foreach ($resultPessoasUsuario as $PessoasUsuario) {
    $wherePessoasUsuario .= $PessoasUsuario['PESSOA'] . ',';
}
$wherePessoasUsuario = substr($wherePessoasUsuario, 0, -1);
$wherePessoasUsuario .= ") )";

if (@$PessoasUsuario > NULL) {
    $queryProgramacao = "SELECT DISTINCT TOP 1000 A.HANDLE HANDLE,  
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
						   B10.NUMEROPEDIDO,
						   B11.APELIDO CLIENTEFINAL,
						   B12.APELIDO LOCALENTREGA,
						   B14.NOME MUNICIPIOLOCALENTREGA,
						   B15.SIGLA ESTADOLOCALENTREGA,
                                                   B10.QUANTIDADEEXPEDICAO,
                                                   B10.QUANTIDADEEMBALAGEM,
						   A.OBSERVACAO,
						   B17.PREVISAO COLETAPROGRAMADO,
						   B17.INICIO,
						   B17.TERMINO,
                                                   
                                                   COALESCE((SELECT SUM(X.QUANTIDADE)
                                                               FROM AM_ORDEMPROGRAMACAO X (NOLOCK)
                                                              WHERE X.ORDEM = B10.HANDLE
                                                                AND X.STATUS <> 10), 0) PESOBRUTO
                                                   
						   FROM AM_CARREGAMENTO A  (NOLOCK)
						   LEFT JOIN AM_STATUSCARREGAMENTO B0 (NOLOCK) ON A.STATUS = B0.HANDLE 
						   LEFT JOIN MS_FILIAL B1 (NOLOCK) ON A.FILIAL = B1.HANDLE 
						   LEFT JOIN AM_TIPOCARREGAMENTO B2 (NOLOCK) ON A.TIPO = B2.HANDLE 
						   LEFT JOIN AM_DOCA B3 (NOLOCK) ON A.DOCA = B3.HANDLE 
						   LEFT JOIN MF_TIPOVEICULO B5 (NOLOCK) ON A.TIPOVEICULO = B5.HANDLE 
						   LEFT JOIN PA_CONTEINER B6 (NOLOCK) ON A.CONTEINER = B6.HANDLE 
						   LEFT JOIN MS_PESSOA B7 (NOLOCK) ON A.CLIENTE = B7.HANDLE 
						   LEFT JOIN AM_STATUSCARREGAMENTO B8 (NOLOCK) ON B8.HANDLE = A.STATUS
						   LEFT JOIN MS_PESSOA B9 (NOLOCK) ON B9.HANDLE = A.TRANSPORTADORA
						   LEFT JOIN AM_ORDEM B10 (NOLOCK) ON B10.CARREGAMENTO = A.HANDLE
						   LEFT JOIN MS_PESSOA B11 (NOLOCK) ON B11.HANDLE = B10.CLIENTEFINAL
						   LEFT JOIN MS_PESSOA B12 (NOLOCK) ON B12.HANDLE = B10.LOCALENTREGA
						   LEFT JOIN MS_PESSOAENDERECO B13 (NOLOCK) ON B13.PESSOA = B12.HANDLE
						   LEFT JOIN MS_MUNICIPIO B14 (NOLOCK) ON B14.HANDLE = B13.MUNICIPIO
						   LEFT JOIN MS_ESTADO B15 (NOLOCK) ON B15.HANDLE = B14.ESTADO
						   LEFT JOIN AM_CARREGAMENTOOCORRENCIA B16 (NOLOCK) ON B16.CARREGAMENTO = A.HANDLE
						   LEFT JOIN AM_PROGRAMACAODOCA B17 (NOLOCK) ON B17.HANDLE = B16.PROGRAMACAODOCA
						  WHERE A.EMPRESA = '" . $empresa . "'
                            AND A.TRANSPORTADORA IS NOT NULL
                           
                           " . $whereDataEmbarque . " 
                           " . $whereDataColetar . "						   
						   " . $wherePessoasUsuario . "
                           " . $whereData . " 
                           " . $filtroTransportadora . " ";
} else {
    $queryProgramacao = "SELECT DISTINCT TOP 1000 A.HANDLE HANDLE,  
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
						   B10.NUMEROPEDIDO,
						   B11.APELIDO CLIENTEFINAL,
						   B12.APELIDO LOCALENTREGA,
						   B14.NOME MUNICIPIOLOCALENTREGA,
						   B15.SIGLA ESTADOLOCALENTREGA,
                                                   B10.QUANTIDADEEXPEDICAO,
                                                   B10.QUANTIDADEEMBALAGEM,
						   A.OBSERVACAO,
						   B17.PREVISAO COLETAPROGRAMADO,
						   B17.INICIO,
						   B17.TERMINO,
                                                   
                                                   COALESCE((SELECT SUM(X.QUANTIDADE)
                                                               FROM AM_ORDEMPROGRAMACAO X (NOLOCK)
                                                              WHERE X.ORDEM = B10.HANDLE
                                                                AND X.STATUS <> 10), 0) PESOBRUTO
                                                   
						   FROM AM_CARREGAMENTO A  (NOLOCK)
						   LEFT JOIN AM_STATUSCARREGAMENTO B0 (NOLOCK) ON A.STATUS = B0.HANDLE 
						   LEFT JOIN MS_FILIAL B1 (NOLOCK) ON A.FILIAL  = B1.HANDLE 
						   LEFT JOIN AM_TIPOCARREGAMENTO B2 (NOLOCK) ON A.TIPO = B2.HANDLE 
						   LEFT JOIN AM_DOCA B3 (NOLOCK) ON A.DOCA  = B3.HANDLE 
						   LEFT JOIN MF_TIPOVEICULO B5 (NOLOCK) ON A.TIPOVEICULO = B5.HANDLE 
						   LEFT JOIN PA_CONTEINER B6 (NOLOCK) ON A.CONTEINER = B6.HANDLE 
						   LEFT JOIN MS_PESSOA B7 (NOLOCK) ON A.CLIENTE = B7.HANDLE 
						   LEFT JOIN AM_STATUSCARREGAMENTO B8 (NOLOCK) ON B8.HANDLE = A.STATUS
						   LEFT JOIN MS_PESSOA B9 (NOLOCK) ON B9.HANDLE = A.TRANSPORTADORA
						   LEFT JOIN AM_ORDEM B10 (NOLOCK) ON B10.CARREGAMENTO = A.HANDLE
						   LEFT JOIN MS_PESSOA B11 (NOLOCK) ON B11.HANDLE = B10.CLIENTEFINAL
						   LEFT JOIN MS_PESSOA B12 (NOLOCK) ON B12.HANDLE = B10.LOCALENTREGA
						   LEFT JOIN MS_PESSOAENDERECO B13 (NOLOCK) ON B13.PESSOA = B12.HANDLE
						   LEFT JOIN MS_MUNICIPIO B14 (NOLOCK) ON B14.HANDLE = B13.MUNICIPIO
						   LEFT JOIN MS_ESTADO B15 (NOLOCK) ON B15.HANDLE = B14.ESTADO
						   LEFT JOIN AM_CARREGAMENTOOCORRENCIA B16 (NOLOCK) ON B16.CARREGAMENTO = A.HANDLE
						   LEFT JOIN AM_PROGRAMACAODOCA B17 (NOLOCK)ON B17.HANDLE = B16.PROGRAMACAODOCA
						  WHERE A.EMPRESA = '" . $empresa . "'
                            AND A.TRANSPORTADORA IS NOT NULL
                           
                           " . $whereDataEmbarque . " 
                           " . $whereDataColetar . "                           
                           " . $whereData . " 
                           " . $filtroTransportadora . " ";
}

if (@$pedido > null) {
    if (isset($_POST['pedido'])) {
        $queryProgramacao .= " AND (1 = 2 ";

        $pedidoArray = explode(';', $_POST['pedido']);

        foreach ($pedidoArray as $pedido) {
            $queryProgramacao .= " OR B10.NUMEROPEDIDO = '" . $pedido . "' ";
        }

        $queryProgramacao .= ")";
    }
}

$queryProgramacao .= ' ORDER BY NUMERO DESC ';
$queryProgramacao = $connect->prepare($queryProgramacao);
$queryProgramacao->execute();

while ($rowProgramacao = $queryProgramacao->fetch(PDO::FETCH_ASSOC)) {

    $ProgramacaoHandle = $rowProgramacao['HANDLE'];
    $ProgramacaoStatus = $rowProgramacao['STATUS'];
    $ProgramacaoStatusNome = $rowProgramacao['STATUSNOME'];
    $ProgramacaoNumero = $rowProgramacao['NUMERO'];
    $ProgramacaoFilial = $rowProgramacao['FILIAL'];
    $ProgramacaoTipo = $rowProgramacao['TIPO'];
    $ProgramacaoTipoProcesso = $rowProgramacao['TIPOPROCESSO'];
    $ProgramacaoDoca = $rowProgramacao['DOCA'];
    $ProgramacaoVeiculo = $rowProgramacao['VEICULO'];
    $ProgramacaoAcoplado = $rowProgramacao['ACOPLADO'];
    $ProgramacaoMotorista = $rowProgramacao['MOTORISTA'];
    $ProgramacaoEmbalagem = $rowProgramacao['QUANTIDADEEMBALAGEM'];
    $ProgramacaoNumeroControle = $rowProgramacao['NUMEROCONTROLE'];
    $ProgramacaoTipoVeiculo = $rowProgramacao['TIPOVEICULO'];
    $ProgramacaoConteiner = $rowProgramacao['CONTEINER'];
    $ProgramacaoPesoBruto = $rowProgramacao['PESOBRUTO'];
    $ProgramacaoCliente = $rowProgramacao['CLIENTE'];
    $ProgramacaoNumeroPedido = $rowProgramacao['NUMEROPEDIDO'];
    $ProgramacaoClienteFinal = $rowProgramacao['CLIENTEFINAL'];
    $ProgramacaoLocalEntrega = $rowProgramacao['LOCALENTREGA'];
    $ProgramacaoMunicipioLocalEntrega = $rowProgramacao['MUNICIPIOLOCALENTREGA'];
    $ProgramacaoEstadoLocalEntrega = $rowProgramacao['ESTADOLOCALENTREGA'];
    $ProgramacaoVolume = $rowProgramacao['QUANTIDADEEXPEDICAO'];
    $ProgramacaoOBS = $rowProgramacao['OBSERVACAO'];
    $ProgramacaoTransportadora = $rowProgramacao['TRANSPORTADORA'];

    if (isset($rowProgramacao['DATA'])) {
        $ProgramacaoColeta = date('d/m/Y H:i', strtotime($rowProgramacao['DATA']));
    } else {
        $ProgramacaoColeta = "";
    }

    if (isset($rowProgramacao['PREVISAOENTREGA'])) {
        $ProgramacaoEntrega = date('d/m/Y H:i', strtotime($rowProgramacao['PREVISAOENTREGA']));
    } else {
        $ProgramacaoEntrega = "";
    }

    if (isset($rowProgramacao['COLETAPROGRAMADO'])) {
        $ProgramacaoProgramacaoEntrega = date('d/m/Y H:i', strtotime($rowProgramacao['COLETAPROGRAMADO']));
    } else {
        $ProgramacaoProgramacaoEntrega = "";
    }

    if ($ProgramacaoStatus == '1') {
        $ProgramacaoStatusIcone = "<img src='../../view/tecnologia/img/status/cinza/vazio.png' width='13px' height='auto' title='" . $ProgramacaoStatusNome . "' alt='" . $ProgramacaoStatusNome . "'>";
    }
    if ($ProgramacaoStatus == '2') {
        $ProgramacaoStatusIcone = "<img src='../../view/tecnologia/img/status/amarelo/exclamacao.png' width='13px' height='auto' title='" . $ProgramacaoStatusNome . "' alt='" . $ProgramacaoStatusNome . "'>";
    }
    if ($ProgramacaoStatus == '3') {
        $ProgramacaoStatusIcone = "<img src='../../view/tecnologia/img/status/verde/vazio.png' width='13px' height='auto' title='" . $ProgramacaoStatusNome . "' alt='" . $ProgramacaoStatusNome . "'>";
    }
    if ($ProgramacaoStatus == '4') {
        $ProgramacaoStatusIcone = "<img src='../../view/tecnologia/img/status/verde/ok.png' width='13px' height='auto' title='" . $ProgramacaoStatusNome . "' alt='" . $ProgramacaoStatusNome . "'>";
    }
    if ($ProgramacaoStatus == '5') {
        $ProgramacaoStatusIcone = "<img src='../../view/tecnologia/img/status/vermelho/x.png' width='13px' height='auto' title='" . $ProgramacaoStatusNome . "' alt='" . $ProgramacaoStatusNome . "'>";
    }
    if ($ProgramacaoStatus == '6') {
        $ProgramacaoStatusIcone = "<img src='../../view/tecnologia/img/status/cerde/verificado.png' width='13px' height='auto' title='" . $ProgramacaoStatusNome . "' alt='" . $ProgramacaoStatusNome . "'>";
    }
    if ($ProgramacaoStatus == '7') {
        $ProgramacaoStatusIcone = "<img src='../../view/tecnologia/img/status/cinza/vazio.png' width='13px' height='auto' title='" . $ProgramacaoStatusNome . "' alt='" . $ProgramacaoStatusNome . "'>";
    }
    if ($ProgramacaoStatus == '8') {
        $ProgramacaoStatusIcone = "<img src='../../view/tecnologia/img/status/azul/seta_direita.png' width='13px' height='auto' title='" . $ProgramacaoStatusNome . "' alt='" . $ProgramacaoStatusNome . "'>";
    }
    if ($ProgramacaoStatus == '9') {
        $ProgramacaoStatusIcone = "<img src='../../view/tecnologia/img/status/azul/seta_esquerda.png' width='13px' height='auto' title='" . $ProgramacaoStatusNome . "' alt='" . $ProgramacaoStatusNome . "'>";
    }
    if ($ProgramacaoStatus == '10') {
        $ProgramacaoStatusIcone = "<img src='../../view/tecnologia/img/status/azul/ponto.png' width='13px' height='auto' title='" . $ProgramacaoStatusNome . "' alt='" . $ProgramacaoStatusNome . "'>";
    }
    if ($ProgramacaoStatus == '12') {
        $ProgramacaoStatusIcone = "<img src='../../view/tecnologia/img/status/azul/seta_direita.png' width='13px' height='auto' title='" . $ProgramacaoStatusNome . "' alt='" . $ProgramacaoStatusNome . "'>";
    }
    if ($ProgramacaoStatus == '13') {
        $ProgramacaoStatusIcone = "<img src='../../view/tecnologia/img/status/verde/ponto.png' width='13px' height='auto' title='" . $ProgramacaoStatusNome . "' alt='" . $ProgramacaoStatusNome . "'>";
    }
    if ($ProgramacaoStatus == '14') {
        $ProgramacaoStatusIcone = "<img src='../../view/tecnologia/img/status/amarelo/vazio.png' width='13px' height='auto' title='" . $ProgramacaoStatusNome . "' alt='" . $ProgramacaoStatusNome . "'>";
    }
    if ($ProgramacaoStatus == '15') {
        $ProgramacaoStatusIcone = "<img src='../../view/tecnologia/img/status/azul/sustenido.png' width='13px' height='auto' title='" . $ProgramacaoStatusNome . "' alt='" . $ProgramacaoStatusNome . "'>";
    }
    ?>
    <tr>
        <td hidden="true"><input type="radio" name="check[]" class="check" hidden="true" id="check" value="<?php echo $ProgramacaoHandle . '-' . $ProgramacaoHandle; ?>"></td>
        <td width="1%"><?php echo $ProgramacaoStatusIcone; ?></td> 
        <td><?php echo $ProgramacaoNumero; ?></td>
        <td><?php echo $ProgramacaoNumeroPedido; ?></td>
        <td><?php echo $ProgramacaoTransportadora; ?></td>
        <td><?= $ProgramacaoColeta ?></td>
        <td><?= $ProgramacaoEntrega ?></td>
        <td><?= $ProgramacaoProgramacaoEntrega ?></td>
        <td><?php echo $ProgramacaoTipo; ?></td>
        <td><?php echo $ProgramacaoFilial; ?></td>
        <td><?php echo $ProgramacaoClienteFinal; ?></td>
        <td><?php echo $ProgramacaoLocalEntrega; ?></td>
        <td><?php echo $ProgramacaoMunicipioLocalEntrega . '-' . $ProgramacaoEstadoLocalEntrega; ?></td>
        <td><?= $ProgramacaoVolume ?></td>
        <td><?= $ProgramacaoEmbalagem ?></td>
        <td class="text-right"><?= number_format($ProgramacaoPesoBruto, '4', ',', '.'); ?></td>
        <td><?php echo $ProgramacaoTipoVeiculo; ?></td>
        <td><?php echo $ProgramacaoVeiculo; ?></td>
        <td><?php echo $ProgramacaoAcoplado; ?></td>
        <td><?php echo $ProgramacaoConteiner; ?></td>
        <td><?php echo $ProgramacaoMotorista; ?></td>
        <td><?php echo substr($ProgramacaoOBS, 0, 50) . '[...]'; ?></td>
    </tr>
    <?php
}

if (@$ProgramacaoHandle <= '' or @ $ProgramacaoHandle == null) {
    ?>
    <div class="col-md-12">
        <div class="alert alert-warning">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>Atenção: </strong> Não encontramos registros a serem exibidos!
        </div>
    </div>
    <?php
}