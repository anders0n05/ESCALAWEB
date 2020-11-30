<?php

	include_once('../../controller/tecnologia/Sistema.php');

	date_default_timezone_set('America/Sao_Paulo');

	$connect = Sistema::getConexao();

	$sql = "SELECT * FROM ( 

            SELECT 'TA_AGENDA' ORIGEM,
		           'Agenda' ORIGEMDESCRICAO,

				   B.NOME TITULO,


				   A.ASSUNTO ASSUNTO,
				   A.HANDLE HANDLE,
				   A.INICIO INICIO,
				   A.OBSERVACAO OBSERVACAO,
				   A.STATUS STATUS,
				   A.TERMINO TERMINO,

				   B.HANDLE TIPOHANDLE,
				   B.NOME TIPONOME, 

				   C.VALORRGB VALORRGB
			   
			  FROM TA_AGENDA A 
			 INNER JOIN TA_TIPOAGENDA B ON B.HANDLE = A.TIPO  
			  LEFT JOIN MS_COR C ON C.HANDLE = B.COR 
			  
			 WHERE A.USUARIO = {$_SESSION['handleUsuario']} 
			   AND A.STATUS = 4

			 UNION ALL

			SELECT 'TA_REUNIAO' ORIGEM,
				   'Reuniao' ORIGEMDESCRICAO,

				   B.NOME TITULO,
		       
				   A.ASSUNTO ASSUNTO,
				   A.HANDLE HANDLE,
				   A.PREVISAO INICIO,
				   A.OBSERVACAO OBSERVACAO,
				   A.STATUS STATUS,
				   NULL TERMINO,

				   B.HANDLE TIPOHANDLE,
				   B.NOME TIPONOME, 

				   '0,0,51' VALORRGB
				   
			  FROM TA_REUNIAO A 
			 INNER JOIN TA_TIPOREUNIAO B ON B.HANDLE = A.TIPO  
			  
			 WHERE EXISTS (SELECT Z.HANDLE FROM TA_REUNIAOPARTICIPANTE Z WHERE Z.REUNIAO = A.HANDLE AND Z.PESSOA = {$_SESSION['pessoa']} )
			   AND A.STATUS <> 9
			   AND A.STATUS <> 6

			 UNION ALL

			SELECT 'TA_ORDEM' ORIGEM,
				   'Tarefa' ORIGEMDESCRICAO,

				   COALESCE(A.TITULOAGENDA, B.NOME) TITULO,

				   A.ASSUNTO ASSUNTO,
				   A.HANDLE HANDLE,
				   A.PREVISAO INICIO,
				   A.OBSERVACAO OBSERVACAO,
				   A.STATUS STATUS,
				   NULL TERMINO,
   
				   B.HANDLE TIPOHANDLE,
				   B.NOME TIPONOME, 
   
				   '0,51,51' VALORRGB
				   
			  FROM TA_ORDEM A 
			 INNER JOIN TA_TIPOORDEM B ON B.HANDLE = A.TIPO  
			  
			 WHERE A.RECURSO = {$_SESSION['handleUsuario']} 
			   AND A.STATUS <> 9
			   AND A.STATUS <> 10

			 UNION ALL

			SELECT 'SD_INLOCO' ORIGEM,
				   'In loco' ORIGEMDESCRICAO,

				   B.NOME TITULO,

				   A.ASSUNTOATENDIMENTO ASSUNTO,
				   A.HANDLE HANDLE,
				   A.PREVISAOINICIO INICIO,
				   A.OBSERVACAO OBSERVACAO,
				   A.STATUS STATUS,
				   A.PREVISAOTERMINO TERMINO,

				   B.HANDLE TIPOHANDLE,
				   B.NOME TIPONOME, 

				   '0,0,102' VALORRGB

			  FROM SD_INLOCO A 
			 INNER JOIN SD_TIPOINLOCO B ON B.HANDLE = A.TIPO  

			 WHERE A.TECNICO = {$_SESSION['handleUsuario']} 
			   AND A.STATUS <> 9
			   AND A.STATUS <> 4

            ) ZZZZ
					 
		 ORDER BY INICIO";

	$query = $connect->prepare($sql);
	$query->execute();

	$eventos = [];

	while($rowQuery = $query->fetch(PDO::FETCH_ASSOC)){
		$assunto = $rowQuery['ASSUNTO'];
		$cor = "rgb(" . $rowQuery['VALORRGB'] . ')';
		$inicio = $rowQuery['INICIO'];
		$handle = $rowQuery['HANDLE'];
		$observacao = $rowQuery['OBSERVACAO'];
		$origem = $rowQuery['ORIGEM'];
		$origemDescricao = $rowQuery['ORIGEMDESCRICAO'];
		$status = $rowQuery['STATUS'];
		$termino = $rowQuery['TERMINO'];
		$titulo = $rowQuery['TITULO'];
		$tipoHandle = $rowQuery['TIPOHANDLE'];
		$tipoNome = $rowQuery['TIPONOME'];
		
		$complemento = [
			'assunto' => $assunto,
			'observacao' => $observacao,
			'origem' => $origem,
			'origemDescricao' => $origemDescricao,
			'tipoHandle' => $tipoHandle,
			'tipoNome' => $tipoNome,
		];	
	 
		$eventos[] = [
			'id' => $handle, 
			'title' => $titulo,
			'color' => $cor, 
			'start' => $inicio, 
			'end' => $termino, 
			'extendedProps' => $complemento
			];
	}
		
	echo json_encode($eventos);

?>