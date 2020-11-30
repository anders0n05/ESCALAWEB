<?php

$sql = "SELECT A.HANDLE HANDLE,
			   A.NOME NOME
			   
          FROM TA_TIPOAGENDA A 
		 		  
		 WHERE A.STATUS = 4 
		   		 
		 ORDER BY NOME";

$query = $connect->prepare($sql);
$query->execute();

$tiposAgenda = [];

while($rowQuery = $query->fetch(PDO::FETCH_ASSOC)){
    $tiposAgenda[] = $rowQuery;
}