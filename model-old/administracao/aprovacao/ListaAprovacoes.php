<?php
include_once('../../../controller/tecnologia/Sistema.php');

date_default_timezone_set('America/Sao_Paulo');

$connect = Sistema::getConexao();
$pendente = Sistema::getGet('pendente');
$usuario = $_SESSION['handleUsuario'];

$dataHoje = date('d/m/Y H:i:s');

$start = $_GET["start"];
$length = $_GET["length"] + $start;
$search = $_GET["search"]["value"];

$order = $_GET["order"];
$columns = $_GET["columns"];
$col = 0;
$dir = "desc";

if (!empty($order)) {
    foreach ($order as $o) {
        $col = $o['column'];
        $dir = $o['dir'];
    }
}

$where = [];
$whereOr = [];

$where[] = "((A.ASSINANTE = $usuario 
		AND A.DATAASSINATURA IS NULL         OR EXISTS (SELECT X.HANDLE                      
			FROM MS_APROVACAOASSINATURA X                     
			WHERE X.APROVACAO = A.APROVACAO                       
			AND X.DATAASSINATURA IS NULL                       
			AND X.ORIGEM = 1263                      
			AND EXISTS (SELECT Y.HANDLE                                     
				FROM MS_ALCADANIVELUSUARIO Y                                    
				INNER JOIN MS_ALCADANIVEL Y1 ON Y1.HANDLE = Y.ALCADANIVEL                                    
				WHERE Y.USUARIO = $usuario                                   
				AND Y1.HANDLE = X.HANDLEORIGEM                                      
				AND Y1.USUARIO = A.ASSINANTE                                      
				AND (('$dataHoje' BETWEEN Y.DATAINICIO 
						AND Y.DATATERMINO) OR (Y.DATAINICIO IS NULL 
						AND Y.DATATERMINO IS NULL))))         OR EXISTS (SELECT X.HANDLE                      
			FROM MS_APROVACAOASSINATURA X                     
			WHERE X.APROVACAO = A.APROVACAO                       
			AND X.DATAASSINATURA IS NULL                       
			AND X.ORIGEM = 1264                      
			AND EXISTS (SELECT Y.HANDLE                                     
				FROM MS_ALCADANIVELUSUARIO Y                                    
				INNER JOIN MS_ALCADANIVEL Y1 ON Y1.HANDLE = Y.ALCADANIVEL                                    
				INNER JOIN MS_ALCADAVALOR Y2 ON Y2.HANDLE = Y1.ALCADAVALOR                                    
				WHERE Y2.HANDLE = X.HANDLEORIGEM                                      
				AND Y1.USUARIO = A.ASSINANTE                                      
				AND Y.USUARIO = $usuario                                     
				AND (('$dataHoje' BETWEEN Y.DATAINICIO 
						AND Y.DATATERMINO) OR (Y.DATAINICIO IS NULL 
                        AND Y.DATATERMINO IS NULL))))))
                        ";

if($search){
    $whereOr[] =  "B0.HISTORICO LIKE '%".$search."%'";
    $whereOr[] =  "B4.LOGIN LIKE '%".$search."%'";
}

if(count($whereOr) > 0){
    $where[] = '(' . join(' OR ', $whereOr) . ')';
}

$whereTexto = '';
if(count($where) > 0){
    $whereTexto = "WHERE " . join(' AND ', $where);
}

$order = "ORDER BY A.DATAPREVISTA DESC";

$sqlOrdens = "WITH ORDENS AS
(
SELECT ROW_NUMBER() OVER ($order) ROW_NUMBER,
A.APROVACAO APROVACAO,
A.HANDLE,
B1.NOME STATUSNOME,
B2.SIGLA EMPRESA,
B3.SIGLA FILIAL,
B4.LOGIN SOLICITANTE,
B5.NOME NIVEL,
B0.VALORORIGEM,
B6.DESCRICAO,
B0.HISTORICO,
B0.HISTORICO HISTORICOVALOR,
A.DATAPREVISTA ASSINARATE,
B7.NOME ALCADA,
B8.LOGIN,
A.LOGDATACADASTRO,
B0.ORIGEM,
B9.RESOURCENAME,
A.LOGUSUARIOCADASTRO
FROM MS_APROVACAOASSINATURA A  
LEFT JOIN MS_APROVACAO B0 ON A.APROVACAO = B0.HANDLE 
LEFT JOIN MS_STATUSAPROVACAO B1 ON B0.STATUS = B1.HANDLE 
LEFT JOIN MS_EMPRESA B2 ON B0.EMPRESAORIGEM = B2.HANDLE 
LEFT JOIN MS_FILIAL B3 ON B0.FILIALORIGEM = B3.HANDLE 
LEFT JOIN MS_USUARIO B4 ON B0.USUARIO = B4.HANDLE 
LEFT JOIN MS_NIVELALCADA B5 ON A.NIVEL = B5.HANDLE 
LEFT JOIN MD_TABELA B6 ON B0.ORIGEM = B6.HANDLE 
LEFT JOIN MS_ALCADA B7 ON B0.ALCADA = B7.HANDLE 
LEFT JOIN MS_USUARIO B8 ON A.LOGUSUARIOCADASTRO = B8.HANDLE
INNER JOIN MD_IMAGEM B9 ON B1.IMAGEM = B9.HANDLE
$whereTexto
)   
SELECT * FROM ORDENS A WHERE row_number BETWEEN $start AND $length
";

$queryOrdens = $connect->prepare($sqlOrdens);
$queryOrdens->execute();

$ordens = [];

while($dados = $queryOrdens->fetch(PDO::FETCH_ASSOC)){
    $dados["ASSINARATE"] = Sistema::formataDataHoraSegundo($dados["ASSINARATE"]);
	$dados["VALORORIGEM"] = Sistema::formataValor($dados["VALORORIGEM"]);
    $dados["STATUS"] = Sistema::getImagem($dados['RESOURCENAME'], $dados['STATUSNOME']);
    $dados["HISTORICO"] = $dados["HISTORICO"] . " do usuário " . $dados["SOLICITANTE"];

	$ordens[] = $dados;
}

$sqlOrdensFiltro = "SELECT COUNT(A.HANDLE) FILTRADO
FROM MS_APROVACAOASSINATURA A  
LEFT JOIN MS_APROVACAO B0 ON A.APROVACAO = B0.HANDLE 
LEFT JOIN MS_STATUSAPROVACAO B1 ON B0.STATUS = B1.HANDLE 
LEFT JOIN MS_EMPRESA B2 ON B0.EMPRESAORIGEM = B2.HANDLE 
LEFT JOIN MS_FILIAL B3 ON B0.FILIALORIGEM = B3.HANDLE 
LEFT JOIN MS_USUARIO B4 ON B0.USUARIO = B4.HANDLE 
LEFT JOIN MS_NIVELALCADA B5 ON A.NIVEL = B5.HANDLE 
LEFT JOIN MD_TABELA B6 ON B0.ORIGEM = B6.HANDLE 
LEFT JOIN MS_ALCADA B7 ON B0.ALCADA = B7.HANDLE 
LEFT JOIN MS_USUARIO B8 ON A.LOGUSUARIOCADASTRO = B8.HANDLE
$whereTexto";


$queryOrdensFiltro = $connect->prepare($sqlOrdensFiltro);
$queryOrdensFiltro->execute();

$filtro = $queryOrdensFiltro->fetch(PDO::FETCH_ASSOC);

$sqlOrdensTotal = "SELECT COUNT(A.HANDLE) TOTAL
FROM MS_APROVACAOASSINATURA A  
LEFT JOIN MS_APROVACAO B0 ON A.APROVACAO = B0.HANDLE 
LEFT JOIN MS_STATUSAPROVACAO B1 ON B0.STATUS = B1.HANDLE 
LEFT JOIN MS_EMPRESA B2 ON B0.EMPRESAORIGEM = B2.HANDLE 
LEFT JOIN MS_FILIAL B3 ON B0.FILIALORIGEM = B3.HANDLE 
LEFT JOIN MS_USUARIO B4 ON B0.USUARIO = B4.HANDLE 
LEFT JOIN MS_NIVELALCADA B5 ON A.NIVEL = B5.HANDLE 
LEFT JOIN MD_TABELA B6 ON B0.ORIGEM = B6.HANDLE 
LEFT JOIN MS_ALCADA B7 ON B0.ALCADA = B7.HANDLE 
LEFT JOIN MS_USUARIO B8 ON A.LOGUSUARIOCADASTRO = B8.HANDLE
$whereTexto";


$queryOrdensTotal = $connect->prepare($sqlOrdensTotal);
$queryOrdensTotal->execute();

$total = $queryOrdensTotal->fetch(PDO::FETCH_ASSOC);

echo json_encode([
    "draw" => $_GET['draw'],
    "recordsTotal" => $total["TOTAL"],
    "recordsFiltered" => $filtro["FILTRADO"],
    "data" => $ordens
]);