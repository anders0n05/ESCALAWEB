<?php
$numeroPedidoDeVenda = null;
    $query = $connect->prepare("SELECT A.HANDLE, 
								A.STATUS STATUS, 
								A.NUMERO PEDIDO,
								B1.NOME FILIAL, 
								B2.SIGLA TIPO, 
								A.DATA DATA, 
								B3.APELIDO CLIENTE, 
								A.VALORTOTAL VALORTOTAL, 
								A.QUANTIDADE QUANTIDADE, 
								B4.NOME TRANSPORTADOR, 
								B5.NOME CONDICAOPAGAMENTO, 
								B6.NOME FORMAPAGAMENTO, 
								B8.NOME CONTATESOURARIA, 
								B9.NOME FRETE, 
								A.LOGDATACADASTRO DATAINCLUSAO, 
								B7.LOGIN USUARIOINCLUSAO,
								C.NOME STATUSNOME,
                                D.RESOURCENAME RESOURCENAME
								FROM VE_ORDEM A 
								LEFT JOIN MS_FILIAL B1 ON A.FILIAL = B1.HANDLE 
								LEFT JOIN VE_TIPOORDEM B2 ON A.TIPO = B2.HANDLE 
								LEFT JOIN MS_PESSOA B3 ON A.CLIENTE = B3.HANDLE 
								LEFT JOIN MS_PESSOA B4 ON A.TRANSPORTADORA = B4.HANDLE 
								LEFT JOIN FN_CONDICAOPAGAMENTO B5 ON A.CONDICAOPAGAMENTO = B5.HANDLE 
								LEFT JOIN FN_TIPOPAGAMENTO B6 ON A.FORMAPAGAMENTO = B6.HANDLE 
								LEFT JOIN MS_USUARIO B7 ON A.LOGUSUARIOCADASTRO = B7.HANDLE 
								LEFT JOIN TS_CONTA B8 ON A.CONTA = B8.HANDLE
								LEFT JOIN GD_FRETEPORCONTA B9 ON A.FRETEPORCONTA = B9.HANDLE
								LEFT JOIN MS_STATUS C ON C.HANDLE = A.STATUS
								LEFT JOIN MD_IMAGEM D ON D.HANDLE = C.IMAGEM
								WHERE A.EMPRESA = '".$empresa."'
								AND A.VENDEDOR = '".$handleUsuario."'
								ORDER BY NUMERO ASC
								") or die('Erro ao executar sql de atendimentos.');
    
   
    $query->execute();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $statusIcone = Sistema::getImagem($row['RESOURCENAME'], $row['STATUSNOME']);
            $numeroPedidoDeVenda = $row['PEDIDO'];
            $handlePedidoDeVenda = $row['HANDLE'];
            $status = $row['STATUS'];
            $filialPedidoDeVenda = $row['FILIAL'];
            $dataPedidoDeVenda = date('d/m/Y H:i', strtotime($row['DATA']));
            $cliente = $row['CLIENTE'];
            $tipo = $row['TIPO'];
            $valorTotal = number_format($row['VALORTOTAL'], '2', ',', '.');
            $quantidade = number_format($row['QUANTIDADE'], '2', ',', '.');
            $transportador = $row['TRANSPORTADOR'];
            $condicaoPagamento = $row['CONDICAOPAGAMENTO'];
            $formaPagamento = $row['FORMAPAGAMENTO'];
            $contaTesouraria = $row['CONTATESOURARIA'];
            $frete = $row['FRETE'];
            $dataInclusao = date('d/m/Y H:i', strtotime($row['DATAINCLUSAO']));
            $usuarioInclusao = $row['USUARIOINCLUSAO'];

            ?>
    			<tr>
                  <td hidden="true"><input type="radio" name="check[]" hidden="true" id="check" value="<?php echo $status.';'.$handlePedidoDeVenda.';'.$numeroPedidoDeVenda; ?>"></td>
                  <td widtd="1%" style="font-size:14px;"><?php echo $statusIcone; ?></td>
                  <td style="text-align:right;"><?php echo $numeroPedidoDeVenda; ?></td>
                  <td><?php echo $dataPedidoDeVenda; ?></td>
                  <td><?php echo $tipo; ?></td>
                  <td><?php echo $cliente; ?></td>
                  <td style="text-align:right;"><?php echo $quantidade; ?></td>
                  <td style="text-align:right;"><?php echo $valorTotal; ?></td>
                  <td><?php echo $condicaoPagamento; ?></td>
                  <td><?php echo $formaPagamento; ?></td>
                  <td><?php echo $contaTesouraria; ?></td>
                  <td><?php echo $frete; ?></td>
                  <td><?php echo $transportador; ?></td>
                  <td><?php echo $dataInclusao; ?></td>
                  <td><?php echo $usuarioInclusao; ?></td>	
    			</tr>
<?php
        }
?>