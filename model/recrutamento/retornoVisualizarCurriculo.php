<?php
	$nomePessoa 		= NULL;
	$cpf 				= NULL;
	$data 				= NULL;
	$celular 			= NULL;
	$cidade 			= NULL;
	$tipoCurriculo 		= NULL;
	$especialidade 		= NULL;
	$estadoCivil 		= NULL;
	$sexo 				= NULL;
	$dataNascimento 	= NULL;
	$telefone 			= NULL;
	$pretensaoSalarial 	= NULL;
	$atualizadoEm 		= NULL;
	$email 				= NULL;
	$redeSocial 		= NULL;
	$filial 			= NULL;
	$observacao         = NULL;

	$queryCurriculo = $connect->prepare("
		SELECT 
               A.HANDLE HANDLECURRICULO, 
			   A.STATUS STATUS, 
			   A.NUMERO NUMERO, 
			   A.NOME NOME, 
			   A.CPF CPF, 
			   A.DATA DATA, 
			   A.CELULAR CELULAR,
			   B1.HANDLE HANDLETIPOCURRICULO,
			   B1.NOME TIPOCURRICULO, 
			   B3.HANDLE HANDLECIDADE,
			   B3.NOME CIDADE,		
			   B10.HANDLE HANDLEESPECIALIDADE,	   
			   B10.NOME ESPECIALIDADE,
			   B7.HANDLE HANDLEESTADOCIVIL,
			   B7.NOME ESTADOCIVIL, 
			   B5.HANDLE HANDLESEXO,
			   B5.NOME SEXO, 
			   A.NASCIMENTO DATANASCIMENTO, 
			   A.TELEFONE TELEFONE, 
			   A.PRETENSAOSALARIAL PRETENSAOSALARIAL, 
			   A.ATUALIZADOEM ATUALIZADOEM,
			   A.EMAIL EMAIL, 
			   A.REDESOCIAL REDESOCIAL,
			   B11.HANDLE HANDLEFILIAL,
			   B11.NOME FILIAL,
			   A.SENHAWEB SENHAWEB,
			   A.OBSERVACAO OBSERVACAO
		
		  FROM RC_CURRICULO A  
		  
		  LEFT JOIN MS_STATUS B0 ON A.STATUS = B0.HANDLE 
		  LEFT JOIN RC_TIPOCURRICULO B1 ON A.TIPO = B1.HANDLE 
		  LEFT JOIN MS_FILIAL B2 ON A.FILIAL = B2.HANDLE 
		  LEFT JOIN MS_MUNICIPIO B3 ON A.CIDADE = B3.HANDLE 
		  LEFT JOIN RC_CLASSIFICACAOANALISE B4 ON A.CLASSIFICACAOANALISE = B4.HANDLE 
		  LEFT JOIN MS_SEXOPESSOA B5 ON A.SEXO = B5.HANDLE 
		  LEFT JOIN RC_CURRICULOESPECIALIDADE B6 ON A.ESPECIALIDADE = B6.HANDLE 
		  LEFT JOIN MS_ESTADOCIVIL B7 ON A.ESTADOCIVIL = B7.HANDLE 
		  LEFT JOIN MS_PESSOA B8 ON A.INDICADOR = B8.HANDLE 
		  LEFT JOIN MS_USUARIO B9 ON A.LOGUSUARIOALTERACAO = B9.HANDLE 
		  LEFT JOIN RC_CURRICULOESPECIALIDADE B10 ON A.ESPECIALIDADE = B10.HANDLE
	      LEFT JOIN MS_FILIAL B11 ON A.FILIAL = B11.HANDLE
		
		 WHERE A.HANDLE = ".$curriculoHandle."");

	$queryCurriculo->execute();
	$rowCurriculo 			= $queryCurriculo->fetch(PDO::FETCH_ASSOC);	
	$handleCurriculo 		= $rowCurriculo['HANDLECURRICULO'];
	$nomePessoa 			= $rowCurriculo['NOME'];
	$cpf 					= $rowCurriculo['CPF'];
	$data 					= $rowCurriculo['DATA'];
	$celular 				= $rowCurriculo['CELULAR'];
	$handleTipoCurriculo 	= $rowCurriculo['HANDLETIPOCURRICULO'];
	$tipoCurriculo 			= $rowCurriculo['TIPOCURRICULO'];
	$handleCidade       	= $rowCurriculo['HANDLECIDADE'];
	$cidade 				= $rowCurriculo['CIDADE'];
	$handleEspecialidade	= $rowCurriculo['HANDLEESPECIALIDADE'];
	$especialidade 			= $rowCurriculo['ESPECIALIDADE'];
	$handleEstadoCivil		= $rowCurriculo['HANDLEESTADOCIVIL'];
	$estadoCivil 			= $rowCurriculo['ESTADOCIVIL'];
	$handleSexo 			= $rowCurriculo['HANDLESEXO'];
	$sexo 					= $rowCurriculo['SEXO'];
	$dataNascimento 		= $rowCurriculo['DATANASCIMENTO'];
	$telefone 				= $rowCurriculo['TELEFONE'];
	$pretensaoSalarial 		= $rowCurriculo['PRETENSAOSALARIAL'];
	$atualizadoEm 			= $rowCurriculo['ATUALIZADOEM'];
	$email 					= $rowCurriculo['EMAIL'];
	$redeSocial 			= $rowCurriculo['REDESOCIAL'];
	$handleFilial 			= $rowCurriculo['HANDLEFILIAL'];
	$filial 				= $rowCurriculo['FILIAL'];
	$senhaWeb 				= $rowCurriculo['SENHAWEB'];
	$observacao 			= $rowCurriculo['OBSERVACAO'];
?>
