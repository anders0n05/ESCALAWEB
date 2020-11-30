<?php
Sistema::iniciaCarregando();

$estoqueArmazem = new EstoqueArmazem();

try {
    $queryEstoqueMercadoriaPrepare = $connect->prepare($estoqueArmazem->getQuery(''));
    $queryEstoqueMercadoriaPrepare->execute();

    if ($queryEstoqueMercadoriaPrepare) {
    
        while($rowEstoqueMercadoria = $queryEstoqueMercadoriaPrepare->fetch(PDO::FETCH_ASSOC)) {

            $estoqueArmazem->loadByQuery($rowEstoqueMercadoria);
            
            echo $estoqueArmazem->getTableRow();    
        }
    } 
    else {
        Sistema::getNaoEncontrado();
    }
} 
catch (Exception $e) {
    Sistema::tratarErro($e);
}

   