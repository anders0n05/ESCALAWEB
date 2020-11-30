<?php
if (!empty($_SESSION['complementoTitulo'])) {
?>
    <title>Escalasoft - <?=$_SESSION['complementoTitulo']?></title>
<?php
} else {
?>
    <title>Escalasoft</title>
<?php
}

if (file_exists("../tecnologia/img/empresa.png")) {
?>
    <link rel="icon" type="image/png" href="../tecnologia/img/empresa.png" />
<?php
} else {
?>
    <link rel="icon" type="image/png" href="../tecnologia/img/favicon.png" />
<?php
}
?>