<?php
$ContaTesouraria = NULL;
$ContaTesourariaHandle = NULL;
$filialPedidoDeVenda = NULL;
$filialPedidoDeVendaHandle = NULL;
$tipo = NULL;
$tipoHandle = NULL;
$cliente = NULL;
$clienteHandle = NULL;
$data = NULL;
$hora = NULL;
$vendedor = NULL;
$vendedorHandle = NULL;
$FormaPagamento = NULL;
$FormaPagamentoHandle = NULL;
$CondicaoPagamento = NULL;
$CondicaoPagamentoHandle = NULL;
$frete = NULL;
$freteHandle = NULL;
$transportador = NULL;
$transportadorHandle = NULL;
$tabela = NULL;
$tabelaHandle = NULL;
$lista = NULL;
$listaHandle = NULL;
$observacao = NULL;
$naturezaOperacaoHandle = NULL;
$naturezaOperacao = NULL;
$mensagem = NULL;
$protocolo = NULL;
$gravou = NULL;
$entregarAte = NULL;
$disabled = NULL;


$query = $connect->prepare("SELECT A.HANDLE, 
								A.STATUS STATUS, 
								A.NUMERO PEDIDO,
								B1.NOME FILIAL, 
								B1.HANDLE FILIALHANDLE,
								B2.NOME TIPO, 
								B2.HANDLE TIPOHANDLE,
								A.DATA DATA, 
								B3.APELIDO CLIENTE, 
								B3.HANDLE CLIENTEHANDLE,
								A.VALORTOTAL VALORTOTAL, 
								A.QUANTIDADE QUANTIDADE, 
								B4.NOME TRANSPORTADOR, 
								B4.HANDLE TRANSPORTADORHANDLE,
								B5.NOME CONDICAOPAGAMENTO, 
								B5.HANDLE CONDICAOPAGAMENTOHANDLE,
								B6.NOME FORMAPAGAMENTO, 
								B6.HANDLE FORMAPAGAMENTOHANDLE,
								B8.NOME CONTATESOURARIA, 
								B8.HANDLE CONTATESOURARIAHANDLE,
								B9.NOME FRETE, 
								B9.HANDLE FRETEHANDLE,
								A.LOGDATACADASTRO DATAINCLUSAO, 
								B7.LOGIN USUARIOINCLUSAO,
								A.OBSERVACAO OBSERVACAO,
								B10.CODIGO TABELA,
								B10.HANDLE TABELAHANDLE,
								B11.NOME LISTA,
								B11.HANDLE LISTAHANDLE,
								A.OBSERVACAOINTERNA,
								A.OBSERVACAO,
								B12.HANDLE NATUREZAOPERACAOHANDLE,
								B12.NOME NATUREZAOPERACAO,
								A.ENTREGARATE ENTREGARATE
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
								LEFT JOIN CM_TABELA B10 ON A.TABELA = B10.HANDLE
								LEFT JOIN CM_LISTA B11 ON A.LISTA = B11.HANDLE
								LEFT JOIN OP_NATUREZAOPERACAO B12 ON A.NATUREZAOPERACAO = B12.HANDLE
								WHERE A.EMPRESA = '".$empresa."'
								AND A.HANDLE = '".$handlePedidoDeVenda."'
								AND A.VENDEDOR = '".$handleUsuario."'
								ORDER BY NUMERO ASC
								") or die ('Erro ao executar sql de atendimentos.');
	
   
	$query->execute();


	
		$row = $query->fetch(PDO::FETCH_ASSOC);
			
			$numeroPedidoDeVenda = $row['PEDIDO'];
			$handlePedidoDeVenda = $row['HANDLE'];
			$status = $row['STATUS'];
			$filialPedidoDeVenda = $row['FILIAL'];
			$filialPedidoDeVendaHandle = $row['FILIALHANDLE'];
		    $dataPedidoDeVenda = date('Y-m-d', strtotime($row['DATA']));
			$horaPedidoDeVenda = date('H:i', strtotime($row['DATA']));
		    $cliente = $row['CLIENTE']; 
			$clienteHandle = $row['CLIENTEHANDLE']; 
			$tipo = $row['TIPO']; 
			$tipoHandle = $row['TIPOHANDLE']; 
			$valorTotal = number_format($row['VALORTOTAL'], '2', ',', '.');
			$quantidade = number_format($row['QUANTIDADE'], '2', ',', '.');
			$transportador = $row['TRANSPORTADOR'];
			$transportadorHandle = $row['TRANSPORTADORHANDLE'];
			$condicaoPagamento = $row['CONDICAOPAGAMENTO'];
			$condicaoPagamentoHandle = $row['CONDICAOPAGAMENTOHANDLE'];
			$formaPagamento = $row['FORMAPAGAMENTO'];
			$formaPagamentoHandle = $row['FORMAPAGAMENTOHANDLE'];
			$contaTesouraria = $row['CONTATESOURARIA'];
			$contaTesourariaHandle = $row['CONTATESOURARIAHANDLE'];
			$frete = $row['FRETE'];
			$freteHandle = $row['FRETEHANDLE'];
			$dataInclusao = date('d/m/Y', strtotime($row['DATAINCLUSAO']));
			$usuarioInclusao = $row['USUARIOINCLUSAO'];
			$observacaoUsoInterno = $row['OBSERVACAOINTERNA'];
			$observacao = $row['OBSERVACAO'];
			$tabela = $row['TABELA'];
			$tabelaHandle = $row['TABELAHANDLE'];
			$lista = $row['LISTA'];
			$listaHandle = $row['LISTAHANDLE'];
			$naturezaOperacaoHandle = $row['NATUREZAOPERACAOHANDLE'];
			$naturezaOperacao = $row['NATUREZAOPERACAO'];
			$entregarAte = $row['ENTREGARATE'];
			
			if($freteHandle == '4'){
				$disabledTransportador = 'disabled';	
			}
			else{
				$disabledTransportador = NULL;
			}
if(isset($_SESSION['error']) and $_SESSION['error'] > null){
			
			//var_dump($_SESSION);
			
			echo "<script type='text/javascript'>
    				$(window).load(function(){
        			$('#MensagemModal').modal('show');
    				});
				</script>";
		
		foreach(@$_SESSION['error'] as $error){
			echo '
			<div class="modal fade" id="MensagemModal" role="dialog" style="z-index:3040;" aria-spanledby="MensagemModalspan">
    			<div class="modal-dialog" role="document">
          			<div class="modal-content">
        				<form method="post" action="#">
             				<div class="modal-header">
            					<button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
            						<h4 class="modal-title" id="MensagemModal">Erro ao enviar anexo</h4>
          					</div>
              				<div class="modal-body"> 
								 '.$error.' 
            					<div class="clearfix"></div>
          					</div>
              				<div class="modal-footer">
            					<button type="button" class="botaoBrancoLg"  data-dismiss="modal">Ok</button>
          					</div>
            			</form>
      				</div>
        		</div>
  			</div>';
		}
		unset($_SESSION['error']);
}
		
if(isset($_SESSION['arquivo']) and $_SESSION['arquivo'] > null){
					$nomeAnexoExplode = explode('.', $_SESSION['nomeAnexo']);
					$nomeAnexo = $nomeAnexoExplode[0];
					$extAnexo = $nomeAnexoExplode[1];
										
?>
<script type='text/javascript'>
$(window).load(function(){
	$('#AnexoModal').modal('show');
});
//$('#loader').removeAttr( 'style' );
</script>
            
            
			<div class="modal fade" id="AnexoModal" role="dialog" style="z-index:3040;" aria-spanledby="AnexoModalspan">
    			<div class="modal-dialog" role="document">
          			<div class="modal-content">
                    		<div class="modal-header">
            					<button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
            						<h4 class="modal-title" id="AnexoModal"><?php echo $nomeAnexo; ?></h4>
          					</div>
              				<div class="modal-body"> 
								<img src="../../controller/estrutura/VisualizarAnexo.php" width="100%" class="image-responsive" alt="<?php echo $nomeAnexo; ?>" title="<?php echo $nomeAnexo; ?>" />
            					<div class="clearfix"></div>
          					</div>
      				</div>
        		</div>
  			</div>
            
<?php
					}//isset error

if(isset($_SESSION['mensagem']) and isset($_SESSION['retornoPedido'])){
	$mensagem = $_SESSION['mensagem'];
	
	echo "<script type='text/javascript'>
			$(window).load(function(){
			$('#MensagemModal').modal('show');
			});
		</script>";
		
	echo '<div class="modal fade" id="MensagemModal" role="dialog" aria-spanledby="MensagemModalspan">
<div class="modal-dialog" role="document">
  <div class="modal-content">
<form method="post" action="#">
	  <div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title" id="MensagemModal">Erro</h4>
  </div>
	  <div class="modal-body"> '.$mensagem.'
	<div class="clearfix"></div>
  </div>
	  <div class="modal-footer">
	<button type="button" class="botaoBrancoLg"  data-dismiss="modal">Ok</button>
  </div>
	</form>
</div>
</div>
</div>';


	unset($_SESSION['retornoPedido']);
	
	$observacaoUsoInterno = $_SESSION['observacaoUsoInterno'];
	$naturezaOperacaoHandle = $_SESSION['naturezaOperacaoHandle'];
	$naturezaOperacao = $_SESSION['naturezaOperacao'];
	$ContaTesouraria = $_SESSION['ContaTesouraria'];
	$ContaTesourariaHandle = $_SESSION['ContaTesourariaHandle']; 
	$filialPedidoDeVenda = $_SESSION['filialPedidoDeVenda']; 
	$filialPedidoDeVendaHandle = $_SESSION['filialPedidoDeVendaHandle']; 
	$tipo = $_SESSION['tipo']; 
	$tipoHandle = $_SESSION['tipoHandle']; 
	$cliente = $_SESSION['cliente']; 
	$clienteHandle = $_SESSION['clienteHandle']; 
	$data = $_SESSION['data']; 
	$hora = $_SESSION['hora']; 
	$vendedor = $_SESSION['vendedor']; 
	$vendedorHandle = $_SESSION['vendedorHandle']; 
	$FormaPagamento = $_SESSION['FormaPagamento']; 
	$FormaPagamentoHandle = $_SESSION['FormaPagamentoHandle']; 
	$CondicaoPagamento = $_SESSION['CondicaoPagamento']; 
	$CondicaoPagamentoHandle = $_SESSION['CondicaoPagamentoHandle']; 
	$frete = $_SESSION['frete']; 
	$freteHandle = $_SESSION['freteHandle']; 
	$transportador = $_SESSION['transportador']; 
	$transportadorHandle = $_SESSION['transportadorHandle']; 
	$tabela = $_SESSION['tabela']; 
	$tabelaHandle = $_SESSION['tabelaHandle']; 
	$lista = $_SESSION['lista']; 
	$listaHandle = $_SESSION['listaHandle']; 
	$observacao = $_SESSION['observacao']; 
	$entregarAte = $_SESSION['entregarAte']; 

	unset($_SESSION['observacaoUsoInterno']);
	unset($_SESSION['entregarAte']);
	unset($_SESSION['naturezaOperacaoHandle']);
	unset($_SESSION['naturezaOperaca']);
	unset($_SESSION['mensagem']);
	unset($_SESSION['protocolo']);
	unset($_SESSION['sucesso']);
	unset($_SESSION['ContaTesouraria']);
	unset($_SESSION['ContaTesourariaHandle']);
	unset($_SESSION['filialPedidoDeVenda']);
	unset($_SESSION['filialPedidoDeVendaHandle']);
	unset($_SESSION['tipo']);
	unset($_SESSION['tipoHandle']);
	unset($_SESSION['cliente']);
	unset($_SESSION['clienteHandle']);
	unset($_SESSION['data']);
	unset($_SESSION['hora']);
	unset($_SESSION['vendedor']);
	unset($_SESSION['vendedorHandle']);
	unset($_SESSION['FormaPagamento']);
	unset($_SESSION['FormaPagamentoHandle']);
	unset($_SESSION['CondicaoPagamento']);
	unset($_SESSION['CondicaoPagamentoHandle']);
	unset($_SESSION['frete']);
	unset($_SESSION['freteHandle']);
	unset($_SESSION['transportador']);
	unset($_SESSION['transportadorHandle']);
	unset($_SESSION['tabela']);
	unset($_SESSION['tabelaHandle']);
	unset($_SESSION['lista']);
	unset($_SESSION['listaHandle']);
	unset($_SESSION['observacao']);
	
}
else if(isset($_SESSION['mensagem']) and isset($_SESSION['retornoItemPedido'])){
	$mensagem = $_SESSION['mensagem'];
	
	echo "<script type='text/javascript'>
			$(window).load(function(){
			$('#MensagemModal').modal('show');
			});
		</script>";

	echo '<div class="modal fade" id="MensagemModal" role="dialog" aria-spanledby="MensagemModalspan">
<div class="modal-dialog" role="document">
  <div class="modal-content">
<form method="post" action="#">
	  <div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title" id="MensagemModal">Erro</h4>
  </div>
	  <div class="modal-body"> '.$mensagem.'
	<div class="clearfix"></div>
  </div>
	  <div class="modal-footer">
	<button type="button" class="botaoBrancoLg"  data-dismiss="modal">Ok</button>
  </div>
	</form>
</div>
</div>
</div>';

unset($_SESSION['retornoItemPedido']);
unset($_SESSION['mensagem']);
}

else if(isset($_SESSION['mensagem']) and !isset($_SESSION['retornoItemPedido']) and !isset($_SESSION['retornoPedido']) and !isset($_SESSION['retornoAnexo'])){
	$mensagem = $_SESSION['mensagem'];
	
	echo "<script type='text/javascript'>
			$(window).load(function(){
			$('#MensagemModal').modal('show');
			});
		</script>";

	echo '<div class="modal fade" id="MensagemModal" role="dialog" aria-spanledby="MensagemModalspan">
<div class="modal-dialog" role="document">
  <div class="modal-content">
<form method="post" action="#">
	  <div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title" id="MensagemModal">Erro</h4>
  </div>
	  <div class="modal-body"> '.$mensagem.'
	<div class="clearfix"></div>
  </div>
	  <div class="modal-footer">
	<button type="button" class="botaoBrancoLg"  data-dismiss="modal">Ok</button>
  </div>
	</form>
</div>
</div>
</div>';

	unset($_SESSION['mensagem']);
	unset($_SESSION['retornoItemPedido']);
}
else if(isset($_SESSION['mensagem']) and isset($_SESSION['retornoAnexo'])){
	$mensagem = $_SESSION['mensagem'];
	
	echo "<script type='text/javascript'>
			$(window).load(function(){
			$('#MensagemModal').modal('show');
			});
		</script>";

foreach(@$_SESSION['mensagem'] as $mensagem){
	echo '<div class="modal fade" id="MensagemModal" role="dialog" aria-spanledby="MensagemModalspan">
<div class="modal-dialog" role="document">
  <div class="modal-content">
<form method="post" action="#">
	  <div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title" id="MensagemModal">Erro</h4>
  </div>
	  <div class="modal-body"> '.$mensagem.'
	<div class="clearfix"></div>
  </div>
	  <div class="modal-footer">
	<button type="button" class="botaoBrancoLg"  data-dismiss="modal">Ok</button>
  </div>
	</form>
</div>
</div>
</div>';
}//end foreach

unset($_SESSION['retornoItemPedido']);
unset($_SESSION['mensagem']);
}

	
else if(isset($_SESSION['protocolo'])){
	$protocolo = $_SESSION['protocolo'];	
	unset($_SESSION['protocolo']);
}

if(isset($_POST['check'])){
	
	$check =  $_POST['check'];
	
foreach($check as $chk){
	$checkValue = $chk;
}
}

if($status == '1'){
	$disabled = '';
}
if($status == '2'){
	$disabled = '';
}
else{
	$disabled  = 'disabled';
}

if(isset($_SESSION['arquivo']) and $_SESSION['arquivo'] > null){
					$nomeAnexoExplode = explode('.', $_SESSION['nomeAnexo']);
					$nomeAnexo = $nomeAnexoExplode[0];
					$extAnexo = $nomeAnexoExplode[1];
										
?>
<script type='text/javascript'>
$(window).load(function(){
	$('#AnexoModal').modal('show');
});
		
$.blockUI({ css: { 
	border: 'none', 
	padding: '10px',
	backgroundColor: 'transparent', 
	'-webkit-border-radius': '0px', 
	'-moz-border-radius': '0px',
	opacity: 1,
	color: '#fff'
}
 
});

setTimeout($.unblockUI, 4000);
</script>

<div class="modal fade" id="AnexoModal" role="dialog" style="z-index:3040;" aria-spanledby="AnexoModalspan">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="AnexoModal"><?php echo $nomeAnexo; ?></h4>
                </div>
                <div class="modal-body"> 
                    <img src="../../controller/estrutura/VisualizarAnexo.php" width="100%" class="image-responsive" alt="<?php echo $nomeAnexo; ?>" title="<?php echo $nomeAnexo; ?>" />
                    <div class="clearfix"></div>
                </div>
        </div>
    </div>
</div>
            
<?php
				}
?>
