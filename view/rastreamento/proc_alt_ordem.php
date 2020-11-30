<?php
include_once "conexao.php";
$array_aulas = $_POST['arrayordem'];

$cont_ordem = 1;
foreach($array_aulas as $id_aula){
	$result_aulas = "UPDATE aulas SET ordem = $cont_ordem WHERE id = $id_aula";
	$resultado_aulas = mysqli_query($conn, $result_aulas);	
	$cont_ordem++;
}
echo "<span style='color: green;'>Alterado com sucesso</span>";