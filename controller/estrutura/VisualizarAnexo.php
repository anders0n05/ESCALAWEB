<?php
	include_once('../../controller/tecnologia/Sistema.php');
	$arquivo = $_SESSION['arquivo'];
	$nomeAnexoExplode = explode('.', $_SESSION['nomeAnexo']);
	$nomeAnexo = $nomeAnexoExplode[0];
	$extAnexo = $nomeAnexoExplode[1];
	unset($_SESSION['arquivo']);
	unset($_SESSION['nomeAnexo']);
	
	header ('Content-Type: image/'.$extAnexo);	
	echo $arquivo;
?>