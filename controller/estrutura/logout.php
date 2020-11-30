<?php
include_once('../tecnologia/Sistema.php');
	

        unset($_SESSION['pessoa']);
		unset($_SESSION['papel']);
        unset($_SESSION['usuario']);
        unset($_SESSION['senha']);
        unset($_SESSION['senhaNaoCriptografada']);
        unset($_SESSION['empresa']);
        unset($_SESSION['filial']);
		unset($_SESSION['loginUsuario']);
		unset($_SESSION['papelNome']);
		unset($_SESSION['NomeEmpresa']);
		unset($_SESSION['NomeFilial']);
		unset($_SESSION);
		unset($_COOKIE);
        header('Location: ../../view/estrutura/login.php');
   
?>