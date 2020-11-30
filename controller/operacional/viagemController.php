<?php
	include_once('../tecnologia/Sistema.php');
	$connect = Sistema::getConexao();
		
			$empresa = $_SESSION['empresa'];
			$filial = $_SESSION['filial'];
			$NomeEmpresa = $_SESSION['NomeEmpresa'];
			$NomeFilial = $_SESSION['NomeFilial'];
			$pessoa = $_SESSION['pessoa'];
			
			foreach($_POST['check'] as $checkUnico){
					
				}
			$checkCount = count($_POST['check']);
						
			if(isset($_POST['adicionarDespesa'])){
				if($checkCount == 1){
					echo"<script language='javascript' type='text/javascript'> window.location.href='../../view/operacional/InserirDespesaViagem.php?numeroViagem=$checkUnico'</script>";
				}
				else{
					echo"<script language='javascript' type='text/javascript'> window.location.href='../../view/operacional/Viagem.php?checkCount=F'</script>";
						
				}
			}
			
			if(isset($_POST['liberar'])){
				echo 'Liberar: <br>';
				foreach($_POST['check'] as $check){
					echo $check.'<br>';
				}
			}
?>