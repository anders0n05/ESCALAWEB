<?php
include('../../controller/tecnologia/Sistema.php');
header('Content-Type: application/json');
function tirarAcentos($string){
    return preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$string);
}

function parametros($stringparametro){
	$retornoparametro = str_replace("@PESSOAUSUARIOLOGADO", $_SESSION['pessoa'], $stringparametro);
	$retornoparametro = str_replace("@USUARIOLOGADO", $_SESSION['handleUsuario'], $retornoparametro);
	$retornoparametro = str_replace("@USUARIO", $_SESSION['handleUsuario'], $retornoparametro);
	$retornoparametro = str_replace("@FILIALLOGADA", $_SESSION['filial'], $retornoparametro);
	$retornoparametro = str_replace("@FILIAL", $_SESSION['filial'], $retornoparametro);
	$retornoparametro = str_replace("@EMPRESALOGADA", $_SESSION['empresa'], $retornoparametro);
	$retornoparametro = str_replace("@EMPRESA", $_SESSION['empresa'], $retornoparametro);
	//$retornoparametro = str_replace("@REFERENCIAPAPELUSUARIO", $_SESSION['referenciaPapelUsuario'], $retornoparametro);
	$retornoparametro = str_replace("@EXECUTANDOPELATELAPRINCIPAL", "S", $retornoparametro);
	
	return $retornoparametro;
}

$connect = Sistema::getConexao();
$handleComponenteGET = Sistema::getGet('handleComponente');

$queryPainelComponente = $connect->prepare("SELECT  A.SQL
						   FROM BI_PAINELCOMPONENTE A
						   					  WHERE A.HANDLE = '".$handleComponenteGET."'
							 ") or die ('Erro ao selecionar handleComponente');
$queryPainelComponente->execute();

$rowPainelTabela = $queryPainelComponente->fetch(PDO::FETCH_ASSOC);
$sqlComponente = $rowPainelTabela['SQL'];

$sqlComponenteAcentos = tirarAcentos($sqlComponente);
$sqlComponenteExec =parametros( $sqlComponenteAcentos );

$listar = $connect->query($sqlComponenteExec);

echo json_encode($listar->fetchAll(PDO::FETCH_OBJ), JSON_UNESCAPED_UNICODE);
?>