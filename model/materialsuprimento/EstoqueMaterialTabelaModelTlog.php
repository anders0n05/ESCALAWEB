<?php

Sistema::iniciaCarregando();

$queryEstoqueMercadoria = "SELECT TOP 1000
                                  A.BLOQUEADOQUANTIDADE BLOQUEADO,
                                  A.CUSTOMEDIO CUSTOMEDIO,
                                  A.DISPONIVELQUANTIDADE DISPONIVEL,
                                  A.HANDLE HANDLE,
                                  A.RESERVADOQUANTIDADE RESERVADO,
                                  A.SALDOQUANTIDADE SALDOTOTAL,
                                  A.SALDOVALOR VALORESTOQUE,

                                  B.CODIGO CODIGOPRODUTO,
                                  B.ESTOQUEMINIMO ESTOQUEMINIMO,
                                  B.NOME NOMEPRODUTO,

                                  C.NOME VARIACAO,

                                  D.SIGLA FILIAL,

                                  E.SIGLA ALMOXARIFADO

                             FROM MT_SALDOESTOQUE A

                             LEFT JOIN MT_ITEM B ON B.HANDLE = A.ITEM
                             LEFT JOIN MT_ITEMVARIACAO C ON C.HANDLE = A.ITEMVARIACAO

                             LEFT JOIN MS_FILIAL D ON D.HANDLE = A.FILIAL

                             LEFT JOIN MT_ALMOXARIFADO E ON E.HANDLE = A.ALMOXARIFADO

                            WHERE A.EMPRESA = $empresa

                            " . Sistema::getFiltroPostTexto("codigoProduto", "B.CODIGO") . "
                            " . Sistema::getFiltroPostTexto("nomeProduto", "B.NOME") . "
                          
                              AND (EXISTS (SELECT X.HANDLE
                                             FROM MS_USUARIOPESSOA X
                                            WHERE X.USUARIO = $handleUsuario
                                              AND EXISTS (SELECT X1.HANDLE
                                                            FROM MT_ITEMFORNECEDOR X1
                                                           WHERE X1.FORNECEDOR = X.PESSOA
                                                             AND X1.ITEM = A.ITEM))
                                                           
                                   OR NOT EXISTS (SELECT X.HANDLE
                                                    FROM MS_USUARIOPESSOA X
                                                   WHERE X.USUARIO = $handleUsuario))
                                
                            ORDER BY CODIGOPRODUTO, NOMEPRODUTO ASC";

try {
    $queryEstoqueMercadoriaPrepare = $connect->prepare($queryEstoqueMercadoria);
    $queryEstoqueMercadoriaPrepare->execute();

    $rowEstoqueMercadoria = $queryEstoqueMercadoriaPrepare->fetch(PDO::FETCH_ASSOC);

    if (!empty($rowEstoqueMercadoria)) {
        do {
            $EstoqueMercadoriaHandle = Sistema::formataInt($rowEstoqueMercadoria['HANDLE']);

            $EstoqueMercadoriaBloqueado = Sistema::formataValor($rowEstoqueMercadoria['BLOQUEADO'], 4);
            $EstoqueMercadoriaCustoMedio = Sistema::formataValor($rowEstoqueMercadoria['CUSTOMEDIO'], 10);
            $EstoqueMercadoriaDisponivel = Sistema::formataValor($rowEstoqueMercadoria['DISPONIVEL'], 4);
            $EstoqueMercadoriaReservado = Sistema::formataValor($rowEstoqueMercadoria['RESERVADO'], 4);
            $EstoqueMercadoriaSaldoTotal = Sistema::formataValor($rowEstoqueMercadoria['SALDOTOTAL'], 4);
            $EstoqueMercadoriaValorEstoque = Sistema::formataValor($rowEstoqueMercadoria['VALORESTOQUE']);
            $EstoqueMercadoriaCodigoProduto = $rowEstoqueMercadoria['CODIGOPRODUTO'];
            $EstoqueMercadoriaMinimo = Sistema::formataValor($rowEstoqueMercadoria['ESTOQUEMINIMO'], 4);
            $EstoqueMercadoriaNomeProduto = $rowEstoqueMercadoria['NOMEPRODUTO'];
            $EstoqueMercadoriaVariacao = $rowEstoqueMercadoria['VARIACAO'];
            $EstoqueMercadoriaFilial = $rowEstoqueMercadoria['FILIAL'];
            $EstoqueMercadoriaAlmoxarifado = $rowEstoqueMercadoria['ALMOXARIFADO'];

            echo "  <tr>
                        <td hidden='true'><input type='radio' name='check[]' class='check' hidden='true' id='check' value='$EstoqueMercadoriaHandle'></td>
                        <td class=\"text-right\">$EstoqueMercadoriaCodigoProduto</td>
                        <td>$EstoqueMercadoriaNomeProduto</td>
                        <td>$EstoqueMercadoriaFilial</td>
                        <td>$EstoqueMercadoriaAlmoxarifado</td>
                        <td class=\"text-right\">$EstoqueMercadoriaCustoMedio</td>
                        <td class=\"text-right\">$EstoqueMercadoriaValorEstoque</td>
                        <td class=\"text-right\">$EstoqueMercadoriaSaldoTotal</td>
                        <td class=\"text-right\"><b>$EstoqueMercadoriaMinimo</b></td>
                        <td class=\"text-right\"><b>$EstoqueMercadoriaDisponivel</b></td>
                        <td class=\"text-right\">$EstoqueMercadoriaBloqueado</td>
                        <td class=\"text-right\">$EstoqueMercadoriaReservado</td>                        
                    </tr>";
        } while ($rowEstoqueMercadoria = $queryEstoqueMercadoriaPrepare->fetch(PDO::FETCH_ASSOC));
    } else {
        Sistema::getNaoEncontrado();
    }
} catch (Exception $e) {
    Sistema::tratarErro($e);
}