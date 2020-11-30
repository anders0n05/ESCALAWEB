<?php
$numero = null;
$query = $connect->prepare("SELECT G.HANDLE,
									   I.DESCRICAO ORIGEM, 
									   G.VALORORIGEM, 
									   G.HISTORICO, 
									   D.SIGLA EMPRESA, 
									   E.SIGLA FILIAL , 
									   A.NIVEL, 
									   A.DATAPREVISTA ASSINARATE, 
									   H.LOGIN SOLICITANTE,
									   G.STATUS,
									   J.NOME ALCADA
		   FROM MS_APROVACAOASSINATURA A  
				LEFT JOIN MS_APROVACAO G ON A.APROVACAO = G.HANDLE 
				   LEFT JOIN MD_TABELA I ON G.ORIGEM = I.HANDLE 
		  LEFT JOIN MS_STATUSAPROVACAO C ON G.STATUS = C.HANDLE 
				  LEFT JOIN MS_EMPRESA D ON G.EMPRESAORIGEM = D.HANDLE 
				   LEFT JOIN MS_FILIAL E ON G.FILIALORIGEM = E.HANDLE 
				   LEFT JOIN MD_TABELA F ON G.ORIGEM = F.HANDLE 
				  LEFT JOIN MS_USUARIO H ON G.USUARIO = H.HANDLE 
				   LEFT JOIN MS_ALCADA J ON G.ALCADA = J.HANDLE 
							    WHERE  ((      (    A.ASSINANTE = '" . $handleUsuario . "' )      
		AND A.DATAASSINATURA IS NULL   OR (EXISTS (SELECT MS_APROVACAOASSINATURA.HANDLE                 
				FROM MS_APROVACAOASSINATURA                
				WHERE MS_APROVACAOASSINATURA.APROVACAO = A.APROVACAO                  
				AND MS_APROVACAOASSINATURA.DATAASSINATURA IS NULL                  
				AND MS_APROVACAOASSINATURA.ORIGEM = (1263)                  
				AND EXISTS (SELECT MS_ALCADANIVELUSUARIO.HANDLE 
					FROM MS_ALCADANIVELUSUARIO, MS_ALCADANIVEL                               
					WHERE MS_ALCADANIVELUSUARIO.ALCADANIVEL = MS_ALCADANIVEL.HANDLE                                 
					AND MS_ALCADANIVEL.HANDLE = MS_APROVACAOASSINATURA.HANDLEORIGEM                                 
					AND MS_ALCADANIVEL.USUARIO = A.ASSINANTE                                 
					AND MS_ALCADANIVELUSUARIO.USUARIO = A.ASSINANTE                                 
					AND ((('" . $datetime . "') BETWEEN MS_ALCADANIVELUSUARIO.DATAINICIO 
							AND MS_ALCADANIVELUSUARIO.DATATERMINO) OR (MS_ALCADANIVELUSUARIO.DATAINICIO IS NULL 
							AND MS_ALCADANIVELUSUARIO.DATATERMINO IS NULL)))))   OR (EXISTS (SELECT MS_APROVACAOASSINATURA.HANDLE                 
				FROM MS_APROVACAOASSINATURA                
				WHERE MS_APROVACAOASSINATURA.APROVACAO = A.APROVACAO                  
				AND MS_APROVACAOASSINATURA.DATAASSINATURA IS NULL                  
				AND MS_APROVACAOASSINATURA.ORIGEM = (1264)                  
				AND EXISTS (SELECT MS_ALCADAVALORUSUARIO.HANDLE 
					FROM MS_ALCADAVALORUSUARIO, MS_ALCADAVALOR                               
					WHERE MS_ALCADAVALORUSUARIO.ALCADAVALOR = MS_ALCADAVALOR.HANDLE                                 
					AND MS_ALCADAVALOR.HANDLE = MS_APROVACAOASSINATURA.HANDLEORIGEM                                 
					AND MS_ALCADAVALOR.USUARIO = A.ASSINANTE                                 
					AND MS_ALCADAVALORUSUARIO.USUARIO = A.ASSINANTE                                 
					AND ((('" . $datetime . "') BETWEEN MS_ALCADAVALORUSUARIO.DATAINICIO 
							AND MS_ALCADAVALORUSUARIO.DATATERMINO) OR (MS_ALCADAVALORUSUARIO.DATAINICIO IS NULL 
							AND MS_ALCADAVALORUSUARIO.DATATERMINO IS NULL))))) )) 
							  ORDER BY D.SIGLA DESC");

$query->execute();

while ($row = $query->fetch(PDO::FETCH_ASSOC)) {

    $AprovacaoHandle = $row['HANDLE'];
    $AprovacaoOrigem = $row['ORIGEM'];
    $AprovacaoValor = number_format($row['VALORORIGEM'], '2', ',', '.');
    $AprovacaoHistorico = $row['HISTORICO'];
    $AprovacaoEmpresa = $row['EMPRESA'];
    $AprovacaoFilial = $row['FILIAL'];
    $AprovacaoNivel = $row['NIVEL'];
    $AprovacaoAssinarate = date('d/m/Y H:i', strtotime($row['ASSINARATE']));
    $AprovacaoSolicitante = $row['SOLICITANTE'];
    $AprovacaoStatus = $row['STATUS'];
    $AprovacaoAlcada = $row['ALCADA'];

    if ($AprovacaoStatus == '1') {
        $AprovacaoStatusIcone = "<img src='../../view/tecnologia/img/status/verde/ok.png' width='13px' height='auto'>";
    }

    if ($AprovacaoStatus == '2') {
        $AprovacaoStatusIcone = "<img src='../../view/tecnologia/img/status/vermelho/vazio.png' width='13px' height='auto'>";
    }
    ?>
    <tr>
        <td hidden="true"><input type="checkbox" name="check[]" hidden="true" id="check" value="<?php echo $AprovacaoHandle; ?>"></td>
        <td width="1%"><?php echo $AprovacaoStatusIcone; ?></td>
        <td><?php echo $AprovacaoHistorico; ?></td>
        <td><?php echo $AprovacaoSolicitante; ?></td>
        <td><?php echo $AprovacaoAlcada; ?></td>
        <td><?php echo $AprovacaoNivel; ?></td>
        <td><?php echo $AprovacaoEmpresa; ?></td>
        <td><?php echo $AprovacaoFilial; ?></td>
        <td><?php echo $AprovacaoValor; ?></td>
        <td><?php echo $AprovacaoAssinarate; ?></td>
    </tr>
    <?php
}

if (@$AprovacaoHandle <= '' or @ $AprovacaoHandle == null) {
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