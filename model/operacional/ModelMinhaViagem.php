<?php
$numero = null;
    $query = $connect->prepare("SELECT A.NUMERO, 
                                       A.HANDLE,
                                       C.NOME NOMESTATUS, 
                                       C.HANDLE STATUS, 
                                       G.PLACA VEICULO, 
                                       A.DATAPREVISAOINICIO, 
                                       A.DATAPREVISAOTERMINO, 
                                       D.NOME ROTA, 
                                       E.NOME MUNICIPIOORIGEM, 
                                       F.NOME MUNICIPIODESTINO,
                                       H.NOME FILIAL,
                                       K.APELIDO LOCALCOLETA, 
                                       M.APELIDO LOCALENTREGA, 
                                       Q.NOME TIPOLOGRADOUROCOLETA, 
                                       L.LOGRADOURO LOGRADOUROCOLETA, 
                                       L.NUMERO NUMEROCOLETA, 
                                       O.NOME MUNICIPIOCOLETA, 
                                       S.SIGLA UFCOLETA, 
                                       R.NOME TIPOLOGRADOUROENTREGA, 
                                       N.LOGRADOURO LOGRADOUROENTREGA, 
                                       N.NUMERO NUMEROENTREGA, 
                                       P.NOME MUNICIPIOENTREGA, 
                                       T.SIGLA UFENTREGA
                                                                            
                                    FROM OP_VIAGEM A
                                    INNER JOIN MS_PESSOA B ON B.HANDLE = A.MOTORISTA
                                    INNER JOIN OP_STATUSVIAGEM C ON C.HANDLE = A.STATUS
                                    LEFT JOIN OP_ROTA D ON D.HANDLE = A.ROTA
                                    LEFT JOIN MS_MUNICIPIO E ON E.HANDLE = A.MUNICIPIOORIGEM
                                    LEFT JOIN MS_MUNICIPIO F ON F.HANDLE = A.MUNICIPIODESTINO
                                    LEFT JOIN MF_VEICULO G ON G.HANDLE = A.VEICULO
                                    LEFT JOIN MS_FILIAL H ON H.HANDLE = A.FILIAL
                                    LEFT JOIN OP_VIAGEMROMANEIOITEM I ON I.HANDLE = (SELECT MIN(X.HANDLE) FROM OP_VIAGEMROMANEIOITEM X WHERE X.VIAGEM = A.HANDLE AND X.STATUS <> 4 AND X.ORDEM IS NOT NULL)
                                    LEFT JOIN OP_ORDEM J ON J.HANDLE = I.ORDEM 
                                    LEFT JOIN MS_PESSOA K ON K.HANDLE = J.LOCALCOLETA
                                    LEFT JOIN MS_PESSOAENDERECO L ON L.HANDLE = J.ENDERECOLOCALCOLETA
                                    LEFT JOIN MS_PESSOA M ON M.HANDLE = J.LOCALENTREGA
                                    LEFT JOIN MS_PESSOAENDERECO N ON N.HANDLE = J.ENDERECOLOCALENTREGA
                                    LEFT JOIN MS_MUNICIPIO O ON O.HANDLE = L.MUNICIPIO
                                    LEFT JOIN MS_MUNICIPIO P ON P.HANDLE = N.MUNICIPIO
                                    LEFT JOIN MS_TIPOLOGRADOURO Q ON Q.HANDLE = L.TIPOLOGRADOURO
                                    LEFT JOIN MS_TIPOLOGRADOURO R ON R.HANDLE = N.TIPOLOGRADOURO
                                    LEFT JOIN MS_ESTADO S ON S.HANDLE = L.ESTADO
                                    LEFT JOIN MS_ESTADO T ON T.HANDLE = N.ESTADO
                                    WHERE A.MOTORISTA = '".$pessoa."'
                                      AND A.EMPRESA IN (".$empresa.") 
                                      AND A.STATUS IN (4, 5, 12) 
                                    ORDER BY A.NUMERO ASC");
								   
	$query->execute();
	
		while($row = $query->fetch(PDO::FETCH_ASSOC)){
            
            $coleta = $row['LOCALCOLETA'];
            $coletaEndereco = $row['TIPOLOGRADOUROCOLETA'].' '.$row['LOGRADOUROCOLETA'].', '.$row['NUMEROCOLETA'];
            $coletaMunicipio = $row['MUNICIPIOCOLETA'].'/'.$row['UFCOLETA'];

            $handleMinhaViagem = $row['HANDLE'];
            
            $entrega = $row['LOCALENTREGA'];
            $entregaEndereco = $row['TIPOLOGRADOUROENTREGA'].' '.$row['LOGRADOUROENTREGA'].', '.$row['NUMEROENTREGA'];
            $entregaMunicipio =  $row['MUNICIPIOENTREGA'].'/'.$row['UFENTREGA'];

			$numero = $row['NUMERO'];
            
			$prevInicio = date('d/m/Y H:i', strtotime($row['DATAPREVISAOINICIO']));
			$prevTermino = date('d/m/Y H:i', strtotime($row['DATAPREVISAOTERMINO']));
				
?>
                <tr onclick="trOnClick(<?php echo $handleMinhaViagem; ?>)">
                    <td hidden="true"><input type="radio" name="check[]" hidden="true" id="check" value="<?php echo $numero.';'.$handleMinhaViagem; ?>"></td>

                    <td class="desktopLocal"><?php echo $numero; ?></td>
                    <td class="desktopLocal"><?php echo $prevInicio; ?></td>
                    <td class="desktopLocal"><?php echo $prevTermino; ?></td>
                    <td class="desktopLocal"><?php echo $coleta; ?></td>
                    <td class="desktopLocal"><?php echo $coletaEndereco; ?></td>
                    <td class="desktopLocal"><?php echo $coletaMunicipio; ?></td>
                    <td class="desktopLocal"><?php echo $entrega; ?></td>
                    <td class="desktopLocal"><?php echo $entregaEndereco; ?></td>
                    <td class="desktopLocal"><?php echo $entregaMunicipio; ?></td>
                    
                    <td class="mobile">
                                <div class="d-flex w-100 justify-content-between">
                                    <h4><?php echo "Número ". $numero; ?></h5>
                                    <hr>
                                    <small><?php echo "Previsão de início: ".$prevInicio; ?></small>
                                    <small class="floatRigth"><?php echo "Previsão de término: ".$prevTermino; ?></small>
                                </div>
                                <hr>
                                <p><?php echo "Coleta: ".$coleta; ?></p>
                                <p><?php echo "Endereço: ".$coletaEndereco; ?></p>
                                <p><?php echo "Município: ".$coletaMunicipio; ?></p>
                                <hr>
                                <p><?php echo "Entrega: ".$entrega; ?></p>
                                <p> <?php echo "Endereço: ".$entregaEndereco; ?></p>
                                <p><?php echo "Município: ".$entregaMunicipio; ?></p>
                        
                    </td>
    			</tr>
                
<?php
		}
?>
<?php
if(@$numero <= '' or @$numero == null){
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
?>