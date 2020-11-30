<ul class="nav nav-tabs" role="tablist">

<?php
if ($movimentacaoExiste) {
?>
        <li role="presentation" class="active">
                <a href="#Movimentacao" 
                   id="Movimentacao-tab" 
                   role="tab" 
                   data-toggle="tab" 
                   aria-controls="estoquemercadoria" 
                   aria-expanded="true">Movimentação</a></li>
<?php
}

if ($imagemExiste) {
?>
        <li role="presentation" <?= (!$movimentacaoExiste ? 'class="active"' : '') ?>>
                <a href="#Imagem" 
                   id="Imagem-tab" 
                   role="tab" 
                   data-toggle="tab" 
                   aria-controls="estoquemercadoria" 
                   aria-expanded="true">Imagem</a></li>
<?php
}
?>

</ul>