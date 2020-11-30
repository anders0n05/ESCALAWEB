<?php
$queryAuditoria = $connect->prepare("SELECT A.HANDLE HANDLEAUDITORIA, 
									A.DATA DATAAUDITORIA, 
									B0.LOGIN USUARIOAUDITORIA, 
									B1.NOME TIPOMENSAGEMAUDITORIA, 
									A.COMPLEMENTO COMPLEMENTOAUDITORIA 
									FROM VE_ORDEMLOG A  
									LEFT JOIN MS_USUARIO B0 ON A.USUARIO = B0.HANDLE 
									LEFT JOIN MD_TIPOMENSAGEMAUDITORIA B1 ON A.TIPOMENSAGEM = B1.HANDLE 
									WHERE A.ORDEM = '".$handlePedidoDeVenda."'
									ORDER BY DATA DESC
									");
									
				   $queryAuditoria->execute();
					
				  while($rowauditoria = $queryAuditoria->fetch(PDO::FETCH_ASSOC)){
				  		
						$handleAuditoria = $rowauditoria['HANDLEAUDITORIA']; 
						$dataAuditoria = date('d/m/Y H:i:s', strtotime($rowauditoria['DATAAUDITORIA'])); 
						$usuarioAuditoria = $rowauditoria['USUARIOAUDITORIA']; 
						$tipoMensagemAuditoria = $rowauditoria['TIPOMENSAGEMAUDITORIA']; 
						$complementoAuditoria = $rowauditoria['COMPLEMENTOAUDITORIA']; 
				  ?>
                  	<tr>
                      <td width="12%" class=""><?php echo $dataAuditoria; ?></td>
                      <td class=""><?php echo $usuarioAuditoria; ?></th>
                      <td class=""><?php echo $tipoMensagemAuditoria; ?></td>
                      <td class=""><?php echo $complementoAuditoria; ?></td>
                    </tr>
<?php
				  }
?>