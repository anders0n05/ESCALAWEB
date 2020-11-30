<?php
if($status == '1'){
?>
<li><button name="GravarDespesaViagemMobile" class="btn botaoMobile display" type="button" id="GravarDespesaViagemMobile" onClick="submitDespesaViagemForm()">Gravar</button></li>
<li><button name="LimparMobile" class="btn botaoMobile display" type="button" id="LimparMobile" data-toggle="modal" data-target="#LimparModal">Limpar</button></li>
<li><button type="button" class="botaoMobile" id="excluirDespesaMobile"   data-toggle="modal"  data-target="#ExcluirDespesaModal" name="exclexcluirDespesaMobileuirDespesa">Excluir</button></li>
<li><button type="button" class="botaoMobile" id="liberarDespesaMobile" data-toggle="modal"  data-target="#LiberarDespesaModal" name="liberarDespesaMobile">Liberar</button></li>
<?php
}
?>
<?php
if($status == '2'){
?>
<li><button type="button" class="botaoMobile" id="voltarDespesaMobile" data-toggle="modal"  data-target="#VoltarDespesaModal" name="voltarDespesaMobile">Voltar</button></li>
<?php
}
?>
<?php
if($status == '3'){
?>
<li><button type="button" class="botaoMobile" id="voltarDespesaMobile" data-toggle="modal"  data-target="#VoltarDespesaModal" name="voltarDespesaMobile">Voltar</button></li>
<?php
}
?>
<?php
if($status == '4'){
?>
<li><button name="GravarDespesaViagem" type="button" class="botaoMobile display" id="sim" onClick="submitDespesaViagemForm()">Gravar</button></li>
<li><button type="button" class="botaoMobile display" name="Limpar" id="Limpar" data-toggle="modal" data-target="#LimparModal">Limpar</button></li>
<li><button type="button" class="botaoMobile" id="cancelarDespesaMobile" data-toggle="modal"  data-target="#CancelarDespesaModal"  name="cancelarDespesaMobile">Cancelar</button></li>
<li><button type="button" class="botaoMobile" id="liberarDespesaMobile" data-toggle="modal"  data-target="#LiberarDespesaModal" name="liberarDespesaMobile">Liberar</button></li>
<?php
}
?>
<?php
if($status == '5'){
?>
<li><button type="button" class="botaoMobile" id="voltarDespesaMobile" data-toggle="modal"  data-target="#VoltarDespesaModal" name="voltarDespesaMobile">Voltar</button></li>
<?php
}
?>
<?php
if($status == '7'){
?>
<li><button type="button" class="botaoMobile" id="voltarDespesaMobile" data-toggle="modal"  data-target="#VoltarDespesaModal" name="voltarDespesaMobile">Voltar</button></li>
<?php
}
?>