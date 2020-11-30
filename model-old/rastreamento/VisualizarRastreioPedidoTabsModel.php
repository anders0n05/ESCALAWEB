<ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#Remetente" id="Remetente-tab" role="tab" data-toggle="tab" aria-controls="rastreiopedido" aria-expanded="true">Remetente / destinatário</a></li>
        <!--li role="presentation"><a href="#Destinatario" id="Destinatario-tab" role="tab" data-toggle="tab" aria-controls="rastreiopedido" aria-expanded="true">Destinatário</a></li-->
<?php
if($documentoOriginarioExiste > null){
?>
        <li role="presentation"><a href="#DocumentoOriginario" id="DocumentoOriginario-tab" role="tab" data-toggle="tab" aria-controls="rastreiopedido" aria-expanded="true">Doc originário</a></li>
<?php
}
if($documentoExiste > null){
?>
        <li role="presentation"><a href="#Documento" id="Documento-tab" role="tab" data-toggle="tab" aria-controls="rastreiopedido" aria-expanded="true">Documento</a></li>
<?php
}
if($OcorrenciaTransporteExiste > null){
?>
        <li role="presentation"><a href="#OcorrenciaTransporte" id="OcorrenciaTransporte-tab" role="tab" data-toggle="tab" aria-controls="rastreiopedido" aria-expanded="true">Ocorrência transporte</a></li>
<?php
}
if($PosicaoExiste > null){
?>
        <li role="presentation"><a href="#Posicao" id="Posicao-tab" role="tab" data-toggle="tab" aria-controls="rastreiopedido" aria-expanded="true">Posição</a></li>
        <?php
}
if($PosicaoExiste > null and $latitudeExiste > null and $longitudeExiste > null){
?>
        <li role="presentation"><a href="#Mapa" id="Mapa-tab" role="tab" data-toggle="tab" aria-controls="rastreiopedido" aria-expanded="true">Mapa</a></li>
        <?php
}
if($EtapaExiste > null){
?>
        <li role="presentation"><a href="#Etapa" id="Etapa-tab" role="tab" data-toggle="tab" aria-controls="rastreiopedido" aria-expanded="true">Etapa</a></li>
        <?php
}
?>
      </ul>