<?php

include_once('../../controller/tecnologia/Sistema.php');

date_default_timezone_set('America/Sao_Paulo');

$connect 			= Sistema::getConexao();
$curriculoHandle	= Sistema::getGet('handle');

// Tipo Experiencia
$queryExperiencia = "SELECT A.HANDLE, 
A.NOME 
FROM RC_TIPOCURRICULO A";

$queryExperiencia = $connect->prepare($queryExperiencia);
$queryExperiencia->execute();

$experiencias = [];

while($dadosExperiencia = $queryExperiencia->fetch(PDO::FETCH_ASSOC)){
    $experiencias[] = $dadosExperiencia;
}


// Cidades
$queryCidades = "SELECT A.HANDLE, 
A.NOME 
FROM MS_MUNICIPIO A";

$queryCidades = $connect->prepare($queryCidades);
$queryCidades->execute();

$cidades = [];

while($dadoscidades = $queryCidades->fetch(PDO::FETCH_ASSOC)){
    $cidades[] = $dadoscidades;
}

// Especialidade

$querEspc = "SELECT A.HANDLE, 
A.NOME 
FROM RC_CURRICULOESPECIALIDADE A";

$querEspc = $connect->prepare($querEspc);
$querEspc->execute();

$especs = [];

while($dadosEspecialidades = $querEspc->fetch(PDO::FETCH_ASSOC)){
    $especs[] = $dadosEspecialidades;
}

// ESTADO CIVL

$queryEstadoCivil = "SELECT A.HANDLE, 
A.NOME 
FROM MS_ESTADOCIVIL A";

$queryEstadoCivil = $connect->prepare($queryEstadoCivil);
$queryEstadoCivil->execute();

$estadocivil = [];

while($dadosEstadoCivil = $queryEstadoCivil->fetch(PDO::FETCH_ASSOC)){
    $estadocivil[] = $dadosEstadoCivil;
}

// SEXO

$querySexo = "SELECT A.HANDLE, 
A.NOME 
FROM MS_SEXOPESSOA A";

$querySexo = $connect->prepare($querySexo);
$querySexo->execute();

$especialidades = [];

while($dadosSexo = $querySexo->fetch(PDO::FETCH_ASSOC)){
    $sexos[] = $dadosSexo;
}

// FILIAL

$queryFilial = "SELECT A.HANDLE, 
A.NOME 
FROM MS_FILIAL A";

$queryFilial = $connect->prepare($queryFilial);
$queryFilial->execute();

$filiais = [];

while($dadosFilial = $queryFilial->fetch(PDO::FETCH_ASSOC)){
    $filiais[] = $dadosFilial;
}