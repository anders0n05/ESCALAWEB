<?php 

$cpf             = $_SESSION['CPF'];
$nome            = $_SESSION['NOME'];
$handleCurriculo = $_SESSION['HANDLE'];

?>
<div class="topoMenu"> 
    <div class="row">
        <div class="col-xs-12">                
            <h4 class="titleMenu"> Painel de navegação 
                <button id="showLeftPushClose">x</button>
            </h4>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-3">
            <div class="imgMenu"><img src="../tecnologia/img/usermenu.png" class="img-circle img-responsive"></div>
        </div>
        <div class="col-xs-9">
            <p class="infoMenu"><?php echo $cpf; ?> <br> <?php echo $nome; ?> </p>
        </div>
    </div>
</div>

<ul class="nav" id="side-menu">
    <li>
        <a href="#" title="Administração">Administração<span class="fa arrow"></span></a>
        <ul class="nav nav-second-level collapse">
            <li>
                <a href="alteraSenhaCurriculo.php?handle=<?php echo $handleCurriculo;?>" title="Alterar senha de acesso">Alterar senha de acesso</a>
            <li/>
        </ul>
    </li>
    <li>
        <a href="#">Recrutamento e Seleção<span class="fa arrow"></span></a>
        <ul class="nav nav-second-level collapse">
            <li>
                <a href="VisualizarCurriculo.php?handle=<?php echo $handleCurriculo;?>" title="Visualizar currículo">Meu currículo</a>
                <a href="VisualizarVagas.php?handle=<?php echo $handleCurriculo;?>" title="Vagas disponíveis">Vagas disponíveis</a>
            <li/>
        </ul>
    </li>
    <li>
        <a href="../../controller/estrutura/sair.php">Sair</a>
    </li>
</ul>