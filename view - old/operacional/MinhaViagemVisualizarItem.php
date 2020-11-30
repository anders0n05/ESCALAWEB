<?php
    $sqlItem = "SELECT A.NUMERO,
                        B.APELIDO LOCAL, 
                        D.NOME TIPOLOGRADOUROLOCAL, 
                        C.LOGRADOURO LOGRADOUROLOCAL, 
                        C.NUMERO NUMEROLOCAL, 
                        C.COMPLEMENTO COMPLEMENTOLOCAL, 
                        E.NOME MUNICIPIOLOCAL, 
                        F.SIGLA ESTADOLOCAL, 
                        A.STATUS, 
                        A2.HANDLE,
                        1 TIPODOCUMENTO, 
                        '' SERIE, 
                        '' ORIGINARIOS,
                        'N' EHENTREGAEFETUADA,
                        '' NOMERESPONSAVEL,
                        '' DOCUMENTORESPONSAVEL,
                        'Ordem de frete' TITULO,
                        CASE WHEN A2.STATUS = 3 THEN 'S' ELSE 'N' END EHENCERRADO
                    FROM OP_ORDEM A
                    LEFT JOIN MS_PESSOA B ON B.HANDLE = A.LOCALCOLETA
                    LEFT JOIN MS_PESSOAENDERECO C ON C.HANDLE = A.ENDERECOLOCALCOLETA
                    LEFT JOIN MS_TIPOLOGRADOURO D ON D.HANDLE = C.TIPOLOGRADOURO
                    LEFT JOIN MS_MUNICIPIO E ON E.HANDLE = C.MUNICIPIO
                    LEFT JOIN MS_ESTADO F ON F.HANDLE = C.ESTADO
                    LEFT JOIN MS_PESSOA G ON G.HANDLE = A.LOCALENTREGA
                    LEFT JOIN MS_PESSOAENDERECO H ON H.HANDLE = A.ENDERECOLOCALENTREGA
                    LEFT JOIN MS_TIPOLOGRADOURO I ON I.HANDLE = H.TIPOLOGRADOURO
                    LEFT JOIN MS_MUNICIPIO J ON J.HANDLE = H.MUNICIPIO
                    LEFT JOIN MS_ESTADO K ON K.HANDLE = H.ESTADO
                    INNER JOIN OP_VIAGEMROMANEIOITEM A2 ON A2.ORDEM = A.HANDLE
                    WHERE A2.VIAGEM = '$handleMinhaViagem'
                      AND A2.STATUS NOT IN (4)
                      AND A2.TIPOOPERACAO <> 4
                                                            
                    UNION ALL 

                    SELECT  B1.NUMERO,
                            G.APELIDO LOCAL, 
                            I.NOME TIPOLOGRADOUROLOCAL, 
                            H.LOGRADOURO LOGRADOUROLOCAL, 
                            H.NUMERO NUMEROLOCAL, 
                            H.COMPLEMENTO COMPLEMENTOLOCAL, 
                            J.NOME MUNICIPIOLOCAL, 
                            K.SIGLA ESTADOLOCAL,
                            A.STATUS, 
                            A2.HANDLE, 
                            2 TIPODOCUMENTO, 
                            B1.SERIE, 
                            A.DOCUMENTOORIGINARIO ORIGINARIOS,
                            CASE WHEN NOT EXISTS (SELECT X2.HANDLE 
                                                    FROM OP_VIAGEMROMANEIOITEM X2 
                                                    WHERE X2.STATUS IN (2)
                                                    AND X2.DOCUMENTOTRANSPORTE = A.HANDLE
                                                    AND X2.VIAGEM = M.HANDLE) THEN 'S' ELSE 'N' END  EHENTREGAEFETUADA,
                            L.NOMERESPONSAVEL,
                            L.DOCUMENTORESPONSAVEL,
                            'Documento de transporte' TITULO,
                            CASE WHEN A2.STATUS = 3 THEN 'S' ELSE 'N' END EHENCERRADO
                       FROM GD_DOCUMENTOTRANSPORTE A
                       LEFT JOIN GD_DOCUMENTO B1 ON B1.HANDLE = A.DOCUMENTO
                       LEFT JOIN GD_DOCUMENTOENDERECO B2 ON B2.DOCUMENTO = A.DOCUMENTO AND B2.TIPO = 6
                       LEFT JOIN GD_DOCUMENTOENDERECO B3 ON B3.DOCUMENTO = A.DOCUMENTO AND B3.TIPO = 7
                       LEFT JOIN MS_PESSOA B ON B.HANDLE = B2.PESSOA
                       LEFT JOIN MS_PESSOAENDERECO C ON C.HANDLE = B2.PESSOAENDERECO
                       LEFT JOIN MS_TIPOLOGRADOURO D ON D.HANDLE = C.TIPOLOGRADOURO
                       LEFT JOIN MS_MUNICIPIO E ON E.HANDLE = C.MUNICIPIO
                       LEFT JOIN MS_ESTADO F ON F.HANDLE = C.ESTADO
                       LEFT JOIN MS_PESSOA G ON G.HANDLE = B3.PESSOA
                       LEFT JOIN MS_PESSOAENDERECO H ON H.HANDLE = B3.PESSOAENDERECO
                       LEFT JOIN MS_TIPOLOGRADOURO I ON I.HANDLE = H.TIPOLOGRADOURO
                       LEFT JOIN MS_MUNICIPIO J ON J.HANDLE = H.MUNICIPIO
                       LEFT JOIN MS_ESTADO K ON K.HANDLE = H.ESTADO
                      INNER JOIN OP_VIAGEMROMANEIOITEM A2 ON A2.DOCUMENTOTRANSPORTE = A.HANDLE
                       LEFT JOIN OP_OCORRENCIA L ON L.DOCUMENTOTRANSPORTE = A.HANDLE
                                                AND L.ACAO IN (15, 6, 4)
                                                AND L.STATUS = 4
                       LEFT JOIN OP_VIAGEM M ON M.HANDLE = A2.VIAGEM
                      WHERE A2.VIAGEM = '$handleMinhaViagem'
                        AND A2.STATUS NOT IN (4) 
                        AND NOT EXISTS (SELECT X.HANDLE
                                          FROM OP_VIAGEMROMANEIOITEM X
                                         INNER JOIN GD_ORIGINARIO X1 ON X1.HANDLE = X.ORIGINARIO
                                         WHERE X.DOCUMENTOTRANSPORTE = A2.DOCUMENTOTRANSPORTE
                                           AND X.VIAGEM = A2.VIAGEM
                                           AND X.ORIGINARIO > A2.ORIGINARIO )";

    $queryItem = $connect->prepare($sqlItem);
    $queryItem->execute();
?>

<div class="itemArea">
    <h4 class="header">Itens</h4>
    <div class="row" id="ViagemItem"> 
        <div class="col-md-12">

            <table id="ItensTable" class="table table-striped table-bordered" style="width:100%">
                <tbody>
                    <?php while($dataSetItem = $queryItem->fetch(PDO::FETCH_ASSOC)){ ?>
                    <tr>
                        <td class="tdcheck">
                             <?php if ($dataSetItem['EHENCERRADO'] == 'S') {?>
                                <h3>OK</h3>
                            <?php
                            }
                             else{ ?>
                                <input class="big-checkbox" type="checkbox" name="viagemitemhandle" id="viagemitemhandle" value="<?= $dataSetItem['HANDLE'] ?>">
                            <?php } ?>
                             
                        </td>
                        <td class="tddata" onclick="trViagemItemOnClick(<?= $dataSetItem['TIPODOCUMENTO'] ?>,<?= $dataSetItem['HANDLE'] ?>)">
                            <div class="d-flex w-100 justify-content-between">
                                <h4><?php echo $dataSetItem['LOCAL']; ?></h5>
                                <hr>
                                <small><?php echo $dataSetItem['TITULO']." ".$dataSetItem['NUMERO']; ?></small>
                                <small class="floatRigth"><?php echo "Originários: ".$dataSetItem['ORIGINARIOS']; ?></small>
                            </div>
                            <hr>
                            <p><?php echo $dataSetItem['TIPOLOGRADOUROLOCAL']." ".
                                          $dataSetItem['LOGRADOUROLOCAL'].", ".
                                          $dataSetItem['NUMEROLOCAL']." - ".
                                          $dataSetItem['MUNICIPIOLOCAL']."/". 
                                          $dataSetItem['ESTADOLOCAL'] ?></p>                                
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>