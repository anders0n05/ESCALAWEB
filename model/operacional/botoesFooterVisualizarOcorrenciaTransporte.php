
<?php
if($status == '1'){
?>
<button name="GravarOcorrenciaTransporte" type="submit" class="botao display" id="sim" onClick="submitOcorrenciaTransporteForm()" >Gravar</button>
<button type="button" class="botao display" name="Limpar" id="Limpar" data-toggle="modal" data-target="#LimparModal">Limpar</button>
<button type="button" class="botao" id="excluirOcorrencia"   data-toggle="modal"  data-target="#ExcluirOcorrenciaModal" name="excluirOcorrencia">Excluir</button>
<button type="button" class="botao" id="liberarOcorrencia" data-toggle="modal"  data-target="#LiberarOcorrenciaModal" name="liberarOcorrencia">Liberar</button>
<?php
}
?>
<?php
if($status == '2'){
?>
<button name="GravarOcorrenciaTransporte" type="submit" class="botao display" id="sim" onClick="submitOcorrenciaTransporteForm()" >Gravar</button>
<button type="button" class="botao display" name="Limpar" id="Limpar" data-toggle="modal" data-target="#LimparModal">Limpar</button>
<button type="button" class="botao" id="cancelarOcorrencia" data-toggle="modal"  data-target="#CancelarOcorrenciaModal" name="cancelarOcorrencia">Cancelar</button>
<button type="button" class="botao" id="liberarOcorrencia" data-toggle="modal"  data-target="#LiberarOcorrenciaModal" name="liberarOcorrencia">Liberar</button>
<?php
}
?>
<?php
if($status == '3'){
?>
<button type="button" class="botao" id="voltarOcorrencia" data-toggle="modal"  data-target="#VoltarOcorrenciaModal" name="voltarOcorrencia">Voltar</button>
<?php
}
?>
<?php
if($status == '6'){
?>
<button type="button" class="botao" id="voltarOcorrencia" data-toggle="modal"  data-target="#VoltarOcorrenciaModal" name="voltarOcorrencia">Voltar</button>
<?php
}
?>
<?php
if($status == '7'){
?>
<button type="button" class="botao" id="voltarOcorrencia" data-toggle="modal"  data-target="#VoltarOcorrenciaModal" name="voltarOcorrencia">Voltar</button>
<?php
}
?>