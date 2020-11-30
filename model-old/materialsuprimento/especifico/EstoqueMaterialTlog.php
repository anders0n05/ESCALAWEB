<?php

include_once('../../../controller/tecnologia/Sistema.php');
include_once('../../../controller/tecnologia/WS.php');

date_default_timezone_set('America/Sao_Paulo');

$connect = Sistema::getConexao();

$start = $_GET["start"];
$length = $_GET["length"] + $start;

$centroCusto = $_GET["centrocusto"];
$campanha = $_GET["campanha"];
$grupo = $_GET["grupo"];
$pesquisa = $_GET["pesquisar"];

$usuario = $_SESSION["handleUsuario"];

$localWhere = [];
$cliente = [0];
$pessoaAtrelada = [0];
$pessoaAtreladaComPermissao = [0];

$sql = "SELECT A.HANDLE HANDLE
          FROM CM_LISTA A
         WHERE A.TABELA = 2729
           AND A.STATUS = 8
           AND NOT EXISTS (SELECT Z.HANDLE 
                             FROM CM_LISTA Z
                            WHERE Z.TABELA = 2729
                              AND Z.STATUS = 8
                              AND Z.DATATERMINO > A.DATATERMINO)";

$queryLista = $connect->prepare($sql);
$queryLista->execute();

$lista = $queryLista->fetchAll(PDO::FETCH_COLUMN, 0);

if (count($lista) == 0)
  $lista[] = "0";

$sql = "SELECT A.PESSOA PESSOA,
               B.K_EHVISUALIZARPESSOAVINCULADA K_EHVISUALIZARPESSOAVINCULADA

          FROM MS_USUARIOPESSOA A
         INNER JOIN MS_PESSOA B ON B.HANDLE = A.PESSOA

         WHERE A.USUARIO = $usuario
         
         UNION ALL 
        
        SELECT A.PESSOA PESSOA,
               B.K_EHVISUALIZARPESSOAVINCULADA K_EHVISUALIZARPESSOAVINCULADA

          FROM MS_USUARIO A
         INNER JOIN MS_PESSOA B ON B.HANDLE = A.PESSOA

         WHERE A.HANDLE = $usuario";

$queryPessoa = $connect->prepare($sql);
$queryPessoa->execute();

while ($row = $queryPessoa->fetch(PDO::FETCH_ASSOC)) {

    $cliente[] = $row["PESSOA"];

    if ($row["K_EHVISUALIZARPESSOAVINCULADA"] == "S") {
        $pessoaAtreladaComPermissao[] = $row["PESSOA"];
    } else {
        $pessoaAtrelada[] = $row["PESSOA"];
    }
}

$localWhere[] = "EXISTS (SELECT Z.HANDLE 
                           FROM MS_PESSOA Z 
                          WHERE Z.HANDLE = A.CLIENTE 
                            AND Z.HANDLE IN (" . join(",", $cliente) . " )
           
                          UNION ALL 
          
                         SELECT Z.HANDLE 
                           FROM MT_ITEMREFERENCIA Z 
                          WHERE Z.ITEM = A.HANDLE 
                            AND Z.PESSOA IN (" . join(",", $pessoaAtrelada) . ")

                          UNION ALL                      
            
                         SELECT Z.HANDLE 
                           FROM MT_ITEMREFERENCIA Z
                          WHERE Z.ITEM = A.HANDLE 
                            AND Z.PESSOA IN (" . join(",", $pessoaAtreladaComPermissao) . ")
                            AND A.K_EHVISUALIZARPESSOAVINCULADA = 'S')";

if ($pesquisa !== '') {
    $localWhere[] = "A.NOMECODIGOREFERENCIA LIKE '%$pesquisa%'";
}

if ($centroCusto !== '') {
    $localWhere[] = "EXISTS (SELECT Z.HANDLE 
                               FROM MS_INFOCOMPLEMENTAR Z 
                              WHERE Z.HANDLEORIGEM = A.HANDLE 
                                AND Z.TIPOINFOCOMPLEMENTAR = 11
                                AND Z.CONTEUDO = '$centroCusto' 
			        AND Z.STATUS = 8 )";
}

if ($campanha !== '') {
    $localWhere[] = "EXISTS (SELECT Z.HANDLE 
                               FROM MS_INFOCOMPLEMENTAR Z 
                              WHERE Z.HANDLEORIGEM = A.HANDLE 
                                AND Z.TIPOINFOCOMPLEMENTAR = 10
                                AND Z.CONTEUDO = '$campanha'
				AND Z.STATUS = 8 )";
}

if ($grupo !== '') {
    $localWhere[] = "EXISTS (SELECT Z.HANDLE 
                               FROM MS_INFOCOMPLEMENTAR Z 
                         INNER JOIN MS_TIPOINFOCOMPLEMENTAR Z1 ON Z1.HANDLE = Z.TIPOINFOCOMPLEMENTAR
                              WHERE Z.HANDLEORIGEM = A.HANDLE
                                AND Z1.NOME LIKE 'MARKETING - GRUPO%'
                                AND Z.CONTEUDOFINAL = '$grupo'
				AND Z.STATUS = 8 )";
}

$sql = "SELECT A.HANDLE HANDLE

          FROM MT_ITEM A
        
         WHERE " . join(" AND ", $localWhere);         

$queryItem = $connect->prepare($sql);
$queryItem->execute();      

$item = $queryItem->fetchAll(PDO::FETCH_COLUMN, 0);

if (count($item) == 0)
  $item[] = "0";

$sql = "WITH ESTOQUE AS ( 

          SELECT ROW_NUMBER() OVER (ORDER BY CODIGOREFERENCIA ASC) ROW_NUMBER, * FROM (
        
            SELECT 'N' EHARMAZEM,        
            
                  CASE WHEN EXISTS (SELECT Z.VALOR 
                                      FROM CM_LISTAITEM Z 
                                     WHERE Z.ITEM = A.ITEM 
                                       AND Z.STATUS = 4
                                       AND Z.LISTA = " . $lista[0] . ") 
                       THEN        (SELECT Z.VALOR 
                                      FROM CM_LISTAITEM Z 
                                     WHERE Z.ITEM = A.ITEM 
                                       AND Z.STATUS = 4
                                       AND Z.LISTA = " . $lista[0] . ")
                       ELSE A.CUSTOMEDIO END VALORUNITARIO,

                  A.BLOQUEADOQUANTIDADE BLOQUEADO, 
                  A.DISPONIVELQUANTIDADE DISPONIVEL, 
                  A.RESERVADOQUANTIDADE RESERVADO,             

                  A.FILIAL FILIAL,
                  A.HANDLE ESTOQUE,
                  A.ITEM ITEM,

                  B.CODIGO CODIGO,
                  B.CODIGOREFERENCIA CODIGOREFERENCIA,
                  B.ESTOQUEMINIMO ESTOQUEMINIMO,
                  B.NOME NOME,

                  B.K_CAMPANHA CAMPANHA,
                  B.K_CENTROCUSTO CENTROCUSTO,
                  B.K_GRUPO GRUPO,
                  B.K_IMAGEM IMAGEM,
                  
                  C.NOME FAMILIA,

                  D.CODIGO NCM

              FROM MT_SALDOESTOQUE   A
            
            INNER JOIN MT_ITEM B ON B.HANDLE = A.ITEM

              LEFT JOIN MT_FAMILIA C ON C.HANDLE = B.FAMILIA
                  
              LEFT JOIN TR_TIPI D ON D.HANDLE = B.NCM

            WHERE A.ITEM IN (" . join(",", $item) . ")

            UNION ALL

            SELECT 'S' EHARMAZEM,        
      
                  CONVERT(NUMERIC(12,2), SUM(A.DISPONIVELVALOR) / CASE WHEN SUM(A.DISPONIVELQUANTIDADE) = 0 THEN 1 ELSE SUM(A.DISPONIVELQUANTIDADE) END) VALORUNITARIO,
                  SUM(A.BLOQUEADOQUANTIDADE) BLOQUEADO, 
                  SUM(A.DISPONIVELQUANTIDADE) DISPONIVEL, 
                  SUM(A.RESERVADOQUANTIDADE) RESERVADO,             

                  A.FILIAL FILIAL,
                  0 ESTOQUE,
                  A.ITEM ITEM,

                  B.CODIGO CODIGO,
                  CASE WHEN (B.CODIGOREFERENCIA <> F.CODIGOREFERENCIA) AND (F.CODIGOREFERENCIA IS NOT NULL) THEN B.CODIGOREFERENCIA + ' - ' + F.CODIGOREFERENCIA ELSE B.CODIGOREFERENCIA END CODIGOREFERENCIA,
                  B.ESTOQUEMINIMO ESTOQUEMINIMO,
                  B.NOME NOME,

                  B.K_CAMPANHA CAMPANHA,
                  B.K_CENTROCUSTO CENTROCUSTO,
                  B.K_GRUPO GRUPO,
                  B.K_IMAGEM IMAGEM,
              
                  C.NOME FAMILIA,

                  D.CODIGO NCM

              FROM AM_SALDOESTOQUE A
        
            INNER JOIN MT_ITEM B ON B.HANDLE = A.ITEM

              LEFT JOIN MT_FAMILIA C ON C.HANDLE = B.FAMILIA
              
              LEFT JOIN TR_TIPI D ON D.HANDLE = B.NCM

              LEFT JOIN MT_ITEM F ON F.HANDLE = B.ITEMFISCAL

              LEFT JOIN MS_PESSOA G ON G.HANDLE = A.CLIENTE

            WHERE A.ITEM IN (" . join(",", $item) . ")
              
              AND G.K_EHVISUALIZARARMZEMMATERIAIS = 'S'

            GROUP BY A.ITEM,
                      A.FILIAL,

                      B.CODIGO,
                      B.CODIGOREFERENCIA,
                      B.ESTOQUEMINIMO,
                      B.NOME,

                      B.K_CAMPANHA,
                      B.K_CENTROCUSTO,
                      B.K_GRUPO,
                      B.K_IMAGEM,
                  
                      C.NOME,

                      D.CODIGO,

                      F.CODIGOREFERENCIA
          ) ZZZ   
        )
        
        SELECT * FROM ESTOQUE A WHERE ROW_NUMBER BETWEEN $start AND $length";

try {
    $queryEstoque = $connect->prepare($sql);
    $queryEstoque->execute();
} catch (Exception $e) {
    echo json_encode(["error" => 'Um erro ocorreu na busca dos dados do estoque: ' . $e->getMessage()]);    
}

$estoque[] = $queryEstoque->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT COUNT(ITEM) QUANTIDADE FROM (  
        
        SELECT A.ITEM ITEM

          FROM MT_SALDOESTOQUE A

         WHERE A.ITEM IN (" . join(",", $item) . ")

         UNION ALL
         
        SELECT A.ITEM ITEM

          FROM AM_SALDOESTOQUE A
    
         INNER JOIN MT_ITEM B ON B.HANDLE = A.ITEM

          LEFT JOIN MT_FAMILIA C ON C.HANDLE = B.FAMILIA
          
          LEFT JOIN TR_TIPI D ON D.HANDLE = B.NCM

          LEFT JOIN MT_ITEM F ON F.HANDLE = B.ITEMFISCAL

          LEFT JOIN MS_PESSOA G ON G.HANDLE = A.CLIENTE

         WHERE A.ITEM IN (" . join(",", $item) . ")
           
           AND G.K_EHVISUALIZARARMZEMMATERIAIS = 'S'

         GROUP BY A.ITEM,
                  A.FILIAL,

                  B.CODIGO,
                  B.CODIGOREFERENCIA,
                  B.ESTOQUEMINIMO,
                  B.NOME,

                  B.K_CAMPANHA,
                  B.K_CENTROCUSTO,
                  B.K_GRUPO,
                  B.K_IMAGEM,
              
                  C.NOME,

                  D.CODIGO,

                  F.CODIGOREFERENCIA
            
        ) ZZZ" ;

try {
    $queryEstoque = $connect->prepare($sql);
    $queryEstoque->execute();
} catch (Exception $e) {
    echo json_encode(["error" => 'Um erro ocorreu na busca dos dados totais: ' . $e->getMessage()]);    
}

$quantidadeTotal = $queryEstoque->fetchAll(PDO::FETCH_COLUMN, 0);

echo json_encode([
    "draw" => $_GET['draw'],
    "recordsTotal" => $quantidadeTotal,
    "recordsFiltered" => $quantidadeTotal,
    "data" => $estoque[0]
]);
	
