<?php
	  $query = "SELECT A.HANDLE HANDLEDOCUMENTO, 
	  			B1.HANDLE HANDLEDOCUMENTOTRANSPORTE, 
				A.NUMERO NUMERO, 
				B1.STATUS STATUS, 
				A.DATAEMISSAO EMISSAO, 
				B8.APELIDO REMETENTE, 
				B9.APELIDO DESTINATARIO, 
				B11.NOME MUNICIPIOORIGEM, 
				B12.SIGLA UFORIGEM, 
				B13.NOME MUNICIPIODESTINO, 
				B14.SIGLA UFDESTINO, 
				B1.PESO PESO, 
				B1.VOLUME VOLUME, 
				B1.VALORMERCADORIA,
				B5.SIGLA FILIAL
				FROM GD_DOCUMENTO A
				LEFT JOIN GD_STATUSDOCUMENTO B0 ON A.STATUS = B0.HANDLE
				LEFT JOIN GD_DOCUMENTOTRANSPORTE B1 ON A.DOCUMENTOTRANSPORTE = B1.HANDLE
				LEFT JOIN GD_STATUSDOCUMENTOTRANSPORTE B2 ON B1.STATUS = B2.HANDLE
				LEFT JOIN TR_TIPODOCUMENTO B3 ON A.TIPODOCUMENTOFISCAL = B3.HANDLE
				LEFT JOIN MS_OPERACAO B4 ON A.OPERACAO = B4.HANDLE
				LEFT JOIN MS_FILIAL B5 ON A.FILIAL = B5.HANDLE
				LEFT JOIN MS_FILIAL B6 ON B1.FILIALTRANSPORTE = B6.HANDLE
				LEFT JOIN MS_FILIAL B7 ON B1.FILIALDESTINO = B7.HANDLE
				LEFT JOIN MS_PESSOA B8 ON B1.REMETENTE = B8.HANDLE
				LEFT JOIN MS_PESSOA B9 ON B1.DESTINATARIO = B9.HANDLE
				LEFT JOIN MS_PESSOA B10 ON A.PESSOA = B10.HANDLE
				LEFT JOIN MS_MUNICIPIO B11 ON B1.MUNICIPIOORIGEM = B11.HANDLE
				LEFT JOIN MS_ESTADO B12 ON B11.ESTADO = B12.HANDLE
				LEFT JOIN MS_MUNICIPIO B13 ON B1.MUNICIPIODESTINO = B13.HANDLE
				LEFT JOIN MS_ESTADO B14 ON B13.ESTADO = B14.HANDLE
				LEFT JOIN MS_MUNICIPIO B15 ON B13.MUNICIPIOPOLO = B15.HANDLE
				LEFT JOIN CM_TABELA B16 ON B1.TABELA = B16.HANDLE
				LEFT JOIN OP_NATUREZAOPERACAO B17 ON B1.NATUREZAOPERACAO = B17.HANDLE
				LEFT JOIN MT_NATUREZAMERCADORIA B18 ON B1.NATUREZAMERCADORIA = B18.HANDLE
				LEFT JOIN MS_PESSOA B19 ON B1.TRANSPORTADOR = B19.HANDLE
				LEFT JOIN OP_TIPOTRANSPORTE B20 ON B1.TIPOTRANSPORTE = B20.HANDLE
				LEFT JOIN MS_USUARIO B21 ON A.LOGUSUARIOALTERACAO = B21.HANDLE
				LEFT JOIN MS_USUARIO B22 ON A.LOGUSUARIOCADASTRO = B22.HANDLE
				WHERE A.EMPRESA = '".$empresa."'
				AND B1.STATUS IN (19)
				AND B1.TRANSPORTADOR = '".$pessoa."'
				AND ((NOT EXISTS (SELECT HANDLE
							FROM MS_OPERACAOPAPELUSUARIO
							WHERE OPERACAO = A.OPERACAO)
				 OR EXISTS (SELECT HANDLE
							FROM MS_OPERACAOPAPELUSUARIO

							WHERE OPERACAO = A.OPERACAO
							AND PAPEL IN (SELECT PAPEL
								FROM MS_USUARIOPAPEL

								WHERE USUARIO = '".$handleUsuario."'))))
				AND ( A.ABRANGENCIA = 2
					AND A.EHTRANSPORTE = 'S' )
				AND ( A.EHCANCELADO <> 'S'
					AND  EXISTS (SELECT Z.HANDLE
						FROM GD_DOCUMENTOTRANSPORTE Z
						WHERE Z.HANDLE = A.DOCUMENTOTRANSPORTE     
						AND Z.STATUS <> 9)) 
				 ORDER BY A.NUMERO DESC 
                      ";
					  
	$query = $connect->prepare($query);
	$query->execute();
		while($row = $query->fetch(PDO::FETCH_ASSOC)){
			
			$DocumentoHandle = $row['HANDLEDOCUMENTO'];
			$DocumentoTransporteHandle = $row['HANDLEDOCUMENTOTRANSPORTE'];
			$DocumentoStatus = $row['STATUS'];
			$DocumentoUfOrigem = $row['UFORIGEM'];
			$DocumentoUfDestino = $row['UFDESTINO'];
			$DocumentoMunicipioOrigem = $row['MUNICIPIOORIGEM'];
			$DocumentoMunicipioDestino = $row['MUNICIPIODESTINO'];
			$DocumentoFilial = $row['FILIAL'];
			$DocumentoVolume = $row['VOLUME'];
			$DocumentoNumero = $row['NUMERO'];
			$DocumentoPeso = number_format($row['PESO'], '4', ',', '.');
			$DocumentoValorMercadoria = number_format($row['VALORMERCADORIA'], '2', ',', '.');
			$DocumentoRemetente = $row['REMETENTE'];
			$DocumentoDestinatario = $row['DESTINATARIO'];
			$DocumentoDataEmissao = date('d/m/Y', strtotime($row['EMISSAO']));
			
			$DocumentoStatusIcone = "<img src='../../view/tecnologia/img/status/preto/vazio.png' width='13px' height='auto'>";			
?>
    			<tr>
                  <td hidden="true"><input type="checkbox" name="check[]" class="check" hidden="true" id="check" value="<?php echo $DocumentoStatus.'-'.$DocumentoHandle; ?>"></td>
 				   <td width="1%"><?php echo $DocumentoStatusIcone; ?></td> 
                   <td><?php echo $DocumentoNumero; ?></td>
                   <td><?php echo $DocumentoFilial; ?></td>
                   <td><?php echo $DocumentoDataEmissao; ?></td>
                   <td><?php echo $DocumentoRemetente; ?></td>
                   <td><?php echo $DocumentoDestinatario; ?></td>
                   <td><?php echo $DocumentoMunicipioOrigem.' - '.$DocumentoUfOrigem; ?></td>
                   <td><?php echo $DocumentoMunicipioDestino.' - '.$DocumentoUfDestino; ?></td>
                   <td><?php echo $DocumentoPeso; ?></td>
                   <td><?php echo $DocumentoVolume; ?></td>
                   <td><?php echo $DocumentoValorMercadoria; ?></td>
    			</tr>
<?php
	}
?>
<?php
if(@$DocumentoHandle <= '' or @$DocumentoHandle == null){
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