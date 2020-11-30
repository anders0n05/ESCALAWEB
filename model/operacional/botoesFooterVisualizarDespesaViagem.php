<?php
if($status == '1'){
?>
<button name="GravarDespesaViagem" type="button" class="botao display" id="sim" name="GravarDespesaViagem" onClick="submitDespesaViagemForm()">Gravar</button>
<button type="button" class="botao display" name="Limpar" id="Limpar" data-toggle="modal" data-target="#LimparModal">Limpar</button>
<button type="button" class="botao" id="excluirDespesa"   data-toggle="modal"  data-target="#ExcluirDespesaModal" name="excluirDespesa">Excluir</button>
<button type="button" class="botao" id="liberarDespesa" data-toggle="modal"  data-target="#LiberarDespesaModal" name="liberarDespesa">Liberar</button>
<?php
}
?>
<?php
if($status == '2'){
?>
 <button type="button" class="botao" id="voltarDespesa" data-toggle="modal" data-target="#VoltarDespesaModal" name="voltarDespesa">Voltar</button>
<?php
}
?>
<?php
if($status == '3'){
?>
<button type="button" class="botao" id="voltarDespesa" data-toggle="modal"  data-target="#VoltarDespesaModal" name="voltarDespesa">Voltar</button>
<?php
}
?>
<?php
if($status == '4'){
?>
<button name="GravarDespesaViagem" type="button" class="botao display" id="sim" onClick="submitDespesaViagemForm()">Gravar</button>
<button type="button" class="botao display" name="Limpar" id="Limpar" data-toggle="modal" data-target="#LimparModal">Limpar</button>
<button type="button" class="botao" id="cancelarDespesa" data-toggle="modal"  data-target="#CancelarDespesaModal"  name="cancelarDespesa">Cancelar</button>
<button type="button" class="botao" id="liberarDespesa" data-toggle="modal"  data-target="#LiberarDespesaModal" name="liberarDespesa">Liberar</button>
<?php
}
?>
<?php
if($status == '5'){
?>
<button type="button" class="botao" id="voltarDespesa" data-toggle="modal"  data-target="#VoltarDespesaModal" name="voltarDespesa">Voltar</button>
<?php
}
?>
<?php
if($status == '7'){
?>
<button type="button" class="botao" id="voltarDespesa" data-toggle="modal"  data-target="#VoltarDespesaModal" name="voltarDespesa">Voltar</button>
<?php
}
?>