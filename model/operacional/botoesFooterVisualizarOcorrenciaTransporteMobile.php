<li><button name="GravarAtendimentoInLocoMobile" class="btn botaoMobileMobile display" type="button" id="GravarAtendimentoInLocoMobile" onClick="submitAtendimentoInLocoForm()">Gravar</button></li>
<?php
if($status == '1'){
?>
<li><button name="GravarOcorrenciaTransporteMobile" type="submit" class="botaoMobile display" id="GravarOcorrenciaTransporteMobile" onClick="submitOcorrenciaTransporteForm()" >Gravar</button></li>
<li><button type="button" class="botaoMobile display" name="LimparMobile" id="LimparMobile" data-toggle="modal" data-target="#LimparModal">Limpar</button></li>
<li><button type="button" class="botaoMobile" id="excluirOcorrenciaMobile"   data-toggle="modal"  data-target="#ExcluirOcorrenciaModal" name="excluirOcorrenciaMobile">Excluir</button></li>
<li><button type="button" class="botaoMobile" id="liberarOcorrenciaMobile" data-toggle="modal"  data-target="#LiberarOcorrenciaModal" name="liberarOcorrenciaMobile">Liberar</button></li>
<?php
}
?>
<?php
if($status == '2'){
?>
<li><button name="GravarOcorrenciaTransporteMobile" type="submit" class="botaoMobile display" id="GravarOcorrenciaTransporteMobile" onClick="submitOcorrenciaTransporteForm()" >Gravar</button></li>
<li><button type="button" class="botaoMobile display" name="LimparMobile" id="LimparMobile" data-toggle="modal" data-target="#LimparModal">Limpar</button></li>
<li><button type="button" class="botaoMobile" id="cancelarOcorrenciaMobile" data-toggle="modal"  data-target="#CancelarOcorrenciaModal" name="cancelarOcorrenciaMobile">Cancelar</button></li>
<li><button type="button" class="botaoMobile" id="liberarOcorrenciaMobile" data-toggle="modal"  data-target="#LiberarOcorrenciaModal" name="liberarOcorrenciaMobile">Liberar</button></li>
<?php
}
?>
<?php
if($status == '3'){
?>
<li><button type="button" class="botaoMobile" id="voltarOcorrenciaMobile" data-toggle="modal"  data-target="#VoltarOcorrenciaModal" name="voltarOcorrenciaMobile">Voltar</button></li>
<?php
}
?>
<?php
if($status == '6'){
?>
<li><button type="button" class="botaoMobile" id="voltarOcorrenciaMobile" data-toggle="modal"  data-target="#VoltarOcorrenciaModal" name="voltarOcorrenciaMobile">Voltar</button></li>
<?php
}
?>
<?php
if($status == '7'){
?>
<li><button type="button" class="botaoMobile" id="voltarOcorrenciaMobile" data-toggle="modal"  data-target="#VoltarOcorrenciaModal" name="voltarOcorrenciaMobile">Voltar</button></li>
<?php
}
?>