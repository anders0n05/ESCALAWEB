<?php

$filial = null;
$cliente = null;
$item = null;
$unidadeMedida = null;
$ordem = null;
$nrPedido = null;
$naturezaOperacao = null;
$clienteFaturamento = null;
$deposito = null;
$endereco = null;
$unitizacao = null;
$volume = null;
$ocorrencia = null;
$nrDocumento = null;
$nrDescarga = null;
$lote = null;
$nrSerie = null;
$fabricacao = null;
$validade = null;
$conteiner = null;

$disponivelQuantidade = null;
$disponivelVolume = null;
$disponivelPesoBruto = null;
$disponivelPesoLiquido = null;
$disponivelValor = null;

$reservadoQuantidade = null;
$reservadoVolume = null;
$reservadoPesoBruto = null;
$reservadoPesoLiquido = null;
$reservadoValor = null;

$bloqueadoQuantidade = null;
$bloqueadoVolume = null;
$bloqueadoPesoBruto = null;
$bloqueadoPesoLiquido = null;
$bloqueadoValor = null;

$saldoQuantidade = null;
$saldoVolume = null;
$saldoPesoBruto = null;
$saldoPesoLiquido = null;
$saldoValor = null;

$saldoEstoque = Sistema::getGet('saldoEstoque');
$query = $connect->prepare("SELECT  A.HANDLE,
                            		D.NOME FILIAL,
                            		E.NOME CLIENTE,
                            		F.NOMECODIGOREFERENCIA ITEM,
                            		N.SIGLA UNIDADEMEDIDA,
                            		C.NUMERO ORDEM,
                            		C.NUMEROPEDIDO,
                            		G.NOME NATUREZAOPERACAO,
                            		E1.NOME CLIENTEFATURAMENTO,
                            		H.SIGLA DEPOSITO,
                            		I.ESTRUTURA ENDERECO,
                            		A.UNITIZACAO,
                            		A.VOLUME,
                            		J.NUMERO OCORRENCIA,
                            		C.NUMERODOCUMENTO DOCUMENTO,
                            		C.NUMERO CARREGAMENTO,
                            		B.LOTEPESQUISA,
                            		B.IDENTIFICACAO NUMEROSERIE,
                            		B.FABRICACAO,
                            		B.VALIDADE,
                            		M.CODIGO CONTEINER,

                            		'Disponivel',
                            		A.DISPONIVELQUANTIDADE,
                            		A.DISPONIVELQUANTIDADEVOLUME,
                            		A.DISPONIVELPESOBRUTO,
                            		A.DISPONIVELPESOLIQUIDO,
                            		A.DISPONIVELVALOR,

                            		'Reservado', 
                            		A.RESERVADOQUANTIDADE,
                            		A.RESERVADOQUANTIDADEVOLUME,
                            		A.RESERVADOPESOBRUTO,
                            		A.RESERVADOPESOLIQUIDO,
                            		A.RESERVADOVALOR,

                            		'Bloqueado',
                            		A.BLOQUEADOQUANTIDADE,
                            		A.BLOQUEADOQUANTIDADEVOLUME,
                            		A.BLOQUEADOPESOBRUTO,
                            		A.BLOQUEADOPESOLIQUIDO,
                            		A.BLOQUEADOVALOR,

                            		'Saldo',
                            		A.SALDOQUANTIDADE,
                            		A.SALDOQUANTIDADEVOLUME,
                            		A.SALDOPESOBRUTO,
                            		A.SALDOPESOLIQUIDO,
                            		A.SALDOVALOR

                            FROM AM_SALDOESTOQUE A
                           LEFT JOIN AM_ORDEMITEMLOTE B ON B.HANDLE = A.ITEMLOTE
                           LEFT JOIN AM_ORDEM C ON C.HANDLE = B.ORDEM
                           LEFT JOIN MS_FILIAL D ON D.HANDLE = A.FILIAL
                           LEFT JOIN MS_PESSOA E ON E.HANDLE = A.CLIENTE
                           LEFT JOIN MS_PESSOA E1 ON E1.HANDLE = A.CLIENTEFATURAMENTO
                           LEFT JOIN MT_ITEM F ON F.HANDLE = A.ITEM
                           LEFT JOIN OP_NATUREZAOPERACAO G ON G.HANDLE = C.NATUREZAOPERACAO
                           LEFT JOIN AM_DEPOSITO H ON H.HANDLE = A.DEPOSITO
                           LEFT JOIN AM_DEPOSITOLOCALIZACAO I ON I.HANDLE = A.ENDERECO
                           LEFT JOIN AM_OCORRENCIA J ON J.HANDLE = A.OCORRENCIA
                           LEFT JOIN AM_CARREGAMENTO K ON K.HANDLE = B.CARREGAMENTO
                           LEFT JOIN AM_ORDEMCONTEINER L ON L.HANDLE = B.ORDEMCONTEINER
                           LEFT JOIN PA_CONTEINER M ON M.HANDLE = L.CONTEINER    
                           LEFT JOIN MT_UNIDADEMEDIDA N ON N.HANDLE = A.UNIDADEMEDIDA
					       WHERE A.HANDLE = '" . $saldoEstoque . "' ");
$query->execute();

$row = $query->fetch(PDO::FETCH_ASSOC);

$filial = $row['FILIAL'];
$cliente = $row['CLIENTE'];
$item = $row['ITEM'];
$unidadeMedida =$row['UNIDADEMEDIDA'];
$ordem = $row['ORDEM'];
$nrPedido = $row['NUMEROPEDIDO'];
$naturezaOperacao = $row['NATUREZAOPERACAO'];
$clienteFaturamento = $row['CLIENTEFATURAMENTO'];
$deposito = $row['DEPOSITO'];
$endereco = $row['ENDERECO'];
$unitizacao = $row['UNITIZACAO'];
$volume = $row['VOLUME'];
$ocorrencia = $row['OCORRENCIA'];
$nrDocumento = $row['DOCUMENTO'];
$nrDescarga = $row['CARREGAMENTO'];
$lote = $row['LOTEPESQUISA'];
$nrSerie = $row['NUMEROSERIE'];
$fabricacao = Sistema::formataData($row['FABRICACAO']);
$validade = Sistema::formataData($row['VALIDADE']);
$conteiner = $row['CONTEINER'];

//DISPONIVEL
$disponivelQuantidade = number_format($row['DISPONIVELQUANTIDADE'], '4', ',', '.');     
if ($disponivelQuantidade == null) {
    $disponivelQuantidade = '0,00';
}  
$disponivelVolume = $row['DISPONIVELQUANTIDADEVOLUME'];
$disponivelPesoBruto =  number_format($row['DISPONIVELPESOBRUTO'], '4', ',', '.');          
if ($disponivelPesoBruto == null) {
    $disponivelPesoBruto = '0,00';
}
$disponivelPesoLiquido =number_format($row['DISPONIVELPESOLIQUIDO'], '4', ',', '.');      
if ($disponivelPesoLiquido == null) {
    $disponivelPesoLiquido = '0,00';
}
$disponivelValor = number_format($row['DISPONIVELVALOR'], '2', ',', '.');
if ($disponivelValor == null) {
    $disponivelValor = '0,00';
}
//RESERVADO
$reservadoQuantidade = number_format($row['RESERVADOQUANTIDADE'], '4', ',', '.');     
if ($reservadoQuantidade == null) {
    $reservadoQuantidade = '0,00';
}  
$reservadoVolume = $row['RESERVADOQUANTIDADEVOLUME'];
$reservadoPesoBruto =  number_format($row['RESERVADOPESOBRUTO'], '4', ',', '.');          
if ($reservadoPesoBruto == null) {
    $reservadoPesoBruto = '0,00';
}
$reservadoPesoLiquido =number_format($row['RESERVADOPESOLIQUIDO'], '4', ',', '.');      
if ($reservadoPesoLiquido == null) {
    $reservadoPesoLiquido = '0,00';
}
$reservadoValor = number_format($row['RESERVADOVALOR'], '2', ',', '.');
if ($reservadoValor == null) {
    $reservadoValor = '0,00';
}
//BLOQUEADO
$bloqueadoQuantidade = number_format($row['BLOQUEADOQUANTIDADE'], '4', ',', '.');     
if ($bloqueadoQuantidade == null) {
    $bloqueadoQuantidade = '0,00';
}  
$bloqueadoVolume = $row['BLOQUEADOQUANTIDADEVOLUME'];
$bloqueadoPesoBruto =  number_format($row['BLOQUEADOPESOBRUTO'], '4', ',', '.');          
if ($bloqueadoPesoBruto == null) {
    $bloqueadoPesoBruto = '0,00';
}
$bloqueadoPesoLiquido =number_format($row['BLOQUEADOPESOLIQUIDO'], '4', ',', '.');      
if ($bloqueadoPesoLiquido == null) {
    $bloqueadoPesoLiquido = '0,00';
}
$bloqueadoValor = number_format($row['BLOQUEADOVALOR'], '2', ',', '.');
if ($bloqueadoValor == null) {
    $bloqueadoValor = '0,00';
}
// SALDO
$saldoQuantidade = number_format($row['SALDOQUANTIDADE'], '4', ',', '.');     
if ($saldoQuantidade == null) {
    $saldoQuantidade = '0,00';
}  
$saldoVolume = $row['SALDOQUANTIDADEVOLUME'];
$saldoPesoBruto =  number_format($row['SALDOPESOBRUTO'], '4', ',', '.');          
if ($saldoPesoBruto == null) {
    $saldoPesoBruto = '0,00';
}
$saldoPesoLiquido =number_format($row['SALDOPESOLIQUIDO'], '4', ',', '.');      
if ($saldoPesoLiquido == null) {
    $saldoPesoLiquido = '0,00';
}
$saldoValor = number_format($row['SALDOVALOR'], '2', ',', '.');
if ($saldoValor == null) {
    $saldoValor = '0,00';
}

