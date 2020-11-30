<?php

$sqlLocal = "SELECT B.APELIDO,
                    A.SEQUENCIA,
                    CASE WHEN A.STATUS = 5 THEN 'S' ELSE 'N' END EHENCERRADO,
                    CASE WHEN A.STATUS = 181 THEN 'Chegada'
                         WHEN A.STATUS = 182 THEN 'Entrada'
                         WHEN A.STATUS = 183 THEN 'Saída'
                         WHEN A.STATUS = 184 THEN 'Iniciar carga/descarga'
                         WHEN A.STATUS = 185 THEN 'Carga/descarga efetuada'
                         ELSE 'Baixar'
                    END BOTAO,
                    CASE WHEN A.STATUS = 181 THEN 1
                         WHEN A.STATUS = 182 THEN 2
                         WHEN A.STATUS = 183 THEN 5
                         WHEN A.STATUS = 184 THEN 3
                         WHEN A.STATUS = 185 THEN 4
                         ELSE 0
                    END OPERACAO,
                    A.HANDLE,
                    D.NOME TIPOLOGRADOURO,
                    C.LOGRADOURO LOGRADOURO,
                    C.NUMERO NUMERO,
                    E.NOME MUNICIPIO,
                    F.SIGLA ESTADO    
               FROM OP_ROMANEIOLOCAL A 
              INNER JOIN MS_PESSOA B ON B.HANDLE = A.PESSOA 
              INNER JOIN MS_PESSOAENDERECO C ON C.HANDLE = A.PESSOAENDERECO
               LEFT JOIN MS_TIPOLOGRADOURO D ON D.HANDLE = C.TIPOLOGRADOURO
               LEFT JOIN MS_MUNICIPIO E ON E.HANDLE = C.MUNICIPIO
               LEFT JOIN MS_ESTADO F ON F.HANDLE = C.ESTADO
              WHERE A.VIAGEM = '$handleMinhaViagem'";
$queryLocal = $connect->prepare($sqlLocal);
$queryLocal->execute();
?>

<div class="itemArea">   
<h4 class="header">Itens</h4>      
    <div id="ViagemItem">
    
        <table id="ItensTable" class="table table-striped table-bordered" style="width:100%">
            <tbody>
                <?php while($dataSetLocal = $queryLocal->fetch(PDO::FETCH_ASSOC)){ ?>
                    <tr>
                        <td class="tdcheck">
                            <?php if ($dataSetLocal['EHENCERRADO'] == 'S') {?>
                                <h3>OK</h3>
                            <?php
                            }else{ ?>
                                <input class="big-checkbox local" type="checkbox" name="viagemlocalhandle" id="viagemlocalhandle" situacao="<?= $dataSetLocal['BOTAO']?>" operacao="<?= $dataSetLocal['OPERACAO']?>" value="<?= $dataSetLocal['HANDLE'] ?>">
                            <?php } ?>
                        </td>
                        <td class="tddata">                            
                            <p><?php echo $dataSetLocal['APELIDO'] . "<br/>".
                                          $dataSetLocal['TIPOLOGRADOURO']." ".
                                          $dataSetLocal['LOGRADOURO'].", ".
                                          $dataSetLocal['NUMERO']." - ".
                                          $dataSetLocal['MUNICIPIO']."/". 
                                          $dataSetLocal['ESTADO'] ?></p>                                
                        </td>
                        <td class="tdicone">
                        </td>
                    </tr>

                    <?php
                        $queryItem = $connect->prepare(getItem($dataSetLocal['HANDLE']));
                        $queryItem->execute();
                        while($dataSetItem = $queryItem->fetch(PDO::FETCH_ASSOC)){?>
                        <tr>
                            <td class="tdcheck">
                                <?php if ($dataSetItem['EHENCERRADO'] == 'S') {?>
                                    <h3>OK</h3>
                                <?php
                                }else{ ?>
                                    <input class="big-checkbox item" disabled type="checkbox" local="<?= $dataSetLocal['HANDLE'] ?>" item="<?=$dataSetItem['HANDLE']?>" name="viagemitemhandle" id="viagemitemhandle" operacao="<?= $dataSetLocal['OPERACAO']?>" value="<?= $dataSetItem['HANDLE'] ?>">
                                <?php } ?>
                            </td>
                            <td class="tddata" style="padding-top: 3px;" onclick="trViagemItemOnClick(<?= $dataSetItem['TIPODOCUMENTO'] ?>,<?= $dataSetItem['HANDLE'] ?>)">                            
                                <hr>
                                <small><?php echo $dataSetItem['TITULO']." ".$dataSetItem['NUMERO']; ?></small>
                                <small><?php echo "<br/> Situação: ".$dataSetItem['NOMESTATUS']; ?></small>
                                <small class="floatRigth"><?php echo "Originários: ".$dataSetItem['ORIGINARIOS']; ?></small>
                            </td>  
                            <td class="tdicone">
                            <?php if($dataSetItem['TIPODOCUMENTO'] == 2) { ?>
                              <i class="glyphicon glyphicon-download" handle="<?=$dataSetItem['DOCUMENTO']?>" style="cursor:pointer"></i>  
                            <?php } ?>
                            </td>                          
                        </tr>
                    <?php } ?>
                <?php } ?>
            </tbody>
        </table>
    </div>        
</div>
<?php

function getItem($local) {
    $sqlItem = "SELECT A.NUMERO,
                       A.HANDLE DOCUMENTO,
                        B.APELIDO LOCAL, 
                        D.NOME TIPOLOGRADOUROLOCAL, 
                        C.LOGRADOURO LOGRADOUROLOCAL, 
                        C.NUMERO NUMEROLOCAL, 
                        C.COMPLEMENTO COMPLEMENTOLOCAL, 
                        E.NOME MUNICIPIOLOCAL, 
                        F.SIGLA ESTADOLOCAL, 
                        CASE WHEN A2.STATUS = 11 THEN 1
                             WHEN A2.STATUS = 12 THEN 2
                             WHEN A2.STATUS = 13 THEN 5
                             WHEN A2.STATUS = 14 THEN 3
                             WHEN A2.STATUS = 15 THEN 4
                             ELSE 0
                        END OPERACAO,
                        N.NOME NOMESTATUS,
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
                     LEFT JOIN OP_STATUSROMANEIOITEM N ON N.HANDLE = A2.STATUS
                    WHERE A2.ROMANEIOLOCAL = '$local'
                      AND A2.STATUS NOT IN (4)
                                                            
                    UNION ALL 

                    SELECT  B1.NUMERO,
                            B1.HANDLE DOCUMENTO,
                            G.APELIDO LOCAL, 
                            I.NOME TIPOLOGRADOUROLOCAL, 
                            H.LOGRADOURO LOGRADOUROLOCAL, 
                            H.NUMERO NUMEROLOCAL, 
                            H.COMPLEMENTO COMPLEMENTOLOCAL, 
                            J.NOME MUNICIPIOLOCAL, 
                            K.SIGLA ESTADOLOCAL,
                            CASE WHEN A2.STATUS = 11 THEN 1
                                 WHEN A2.STATUS = 12 THEN 2
                                 WHEN A2.STATUS = 13 THEN 5
                                 WHEN A2.STATUS = 14 THEN 3
                                 WHEN A2.STATUS = 15 THEN 4
                                 ELSE 0
                            END OPERACAO,
                            N.NOME NOMESTATUS,
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
                       LEFT JOIN OP_STATUSROMANEIOITEM N ON N.HANDLE = A2.STATUS
                      WHERE A2.ROMANEIOLOCAL = '$local'
                        AND A2.STATUS NOT IN (4) 
                        AND NOT EXISTS (SELECT X.HANDLE
                                          FROM OP_VIAGEMROMANEIOITEM X
                                         INNER JOIN GD_ORIGINARIO X1 ON X1.HANDLE = X.ORIGINARIO
                                         WHERE X.DOCUMENTOTRANSPORTE = A2.DOCUMENTOTRANSPORTE
                                           AND X.VIAGEM = A2.VIAGEM
                                           AND X.ORIGINARIO > A2.ORIGINARIO )";

   return $sqlItem;
}
?>