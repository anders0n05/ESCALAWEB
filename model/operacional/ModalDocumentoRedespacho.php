<!-- Start Modal Filtro ->
<div class="modal fade" id="FiltroModal" role="dialog" aria-spanledby="FiltroModalspan">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form method="post" action="RomaneioTransporteFiltro.php">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="FiltroModalspan">Filtrar romaneio de transporte</h4>
      </div>
      <div class="modal-body">
        	<div class="col-xs-6 col-md-4 pullBottom">
            	<span>Data Inicial</span>
                <input type="datetime-local" id="dataInicio"  class="form-control" name="dataInicio">
            </div>
            <div class="col-xs-6 col-md-4 pullBottom">
            	<span>Data Final</span>
                <input type="datetime-local" id="dataFinal" class="form-control" name="dataFinal">
            </div>
            <div class="col-xs-12 col-md-4 pullBottom">
            	<span>Filial</span>
                	<select name="filial[]" multiple id="filial">
					</select>
            </div>
            <div class="col-xs-12 pullBottom">
            	<span>Destinatário</span>
                <select name="destinatario[]" multiple id="destinatario">
				</select>
            </div>
            <div class="col-xs-6 col-md-6 pullBottom">
            	<span>Romaneio</span>
    			<select name="romaneio[]" multiple id="romaneio">
				</select>
            </div>
            <div class="col-xs-6 col-md-6 pullBottom">
            	<span>Viagem</span>
                <select name="viagem[]" multiple id="viagem">
				</select>
            <div class="clearfix"></div>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="botaoBranco pullTop" data-dismiss="modal">Cancelar</button>
        <button type="reset" class="botaoBranco pullTop" onClick="limpaform()">Limpar</button>
        <button type="submit" class="botaoBranco pullTop">Aplicar</button>
      </div>
      </form>
  </div>
</div>
</div>
<!-- //End Modal Filtro -->


<!-- Start Modal Baixa -->
<div class="modal fade" id="BaixarModal" role="dialog" aria-spanledby="BaixarModalspan">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form method="post" action="../../controller/operacional/BaixarDocumentoRedespachoController.php" enctype="multipart/form-data">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="BaixarModalspan">Baixar documento em redespacho</h4>
      </div>
      <div class="modal-body">
        	<div class="col-xs-6 pullBottom">
            	<span>Tipo de ocorrência</span>
           		<div class="inner-addon right-addon"> <font size="-2"><i class="glyphicon glyphicon-triangle-bottom" id="spandown"></i></font>
				 <input type="text" name="tipoOcorrencia" id="tipoOcorrencia"  onClick="clickdownTipoOcorrencia();" class="editou form-control pulaCampoEnter">
				</div>
				<input type="text" name="tipoOcorrenciaHandle" id="tipoOcorrenciaHandle" hidden="true">
          		<input type="text" name="acaoHandle" id="acaoHandle" hidden="true">
          		<input type="text" name="documentoHandle" id="documentoHandle" hidden="true">
            </div>
            <div class="col-xs-6 pullBottom">
            	<span>Motivo atraso</span>           
				<div class="inner-addon right-addon"> <font size="-2"><i class="glyphicon glyphicon-triangle-bottom" id="spandown"></i></font>
				 <input type="text" name="motivoAtraso" id="motivoAtraso"  onClick="clickdownMotivoAtraso();" class="editou form-control pulaCampoEnter">
				</div>
				<input type="text" name="motivoAtrasoHandle" id="motivoAtrasoHandle" hidden="true">
            </div>
            <div class="col-xs-4 pullBottom">
            	<span>Responsável</span>
           		<div class="inner-addon right-addon"> <font size="-2"><i class="glyphicon glyphicon-triangle-bottom" id="spandown"></i></font>
				 <input type="text" name="responsavel" id="responsavel"  onClick="clickdownResponsavel();" class="editou form-control pulaCampoEnter">
				</div>
				<input type="text" name="responsavelHandle" id="responsavelHandle" hidden="true">
            </div>
            <div class="col-xs-4 pullBottom">
            	<span>Nome</span>
                <input type="text" id="nome"  class="form-control" name="nome">
            </div>
            <div class="col-xs-4 pullBottom">
            	<span>Nr documento</span>
                <input type="text" id="numeroDocumento"  class="form-control" name="numeroDocumento">
            </div>
            <div class="col-xs-12 pullBottom">
            	<span>Anexo</span>
                <input type="file" style="display: block;" name="image_src" class="form-control">
            </div>
            <div class="col-xs-12 pullBottom">
            	<span>Observação</span>
                <textarea id="obs"  class="form-control" name="obs"></textarea>
            </div>
            
      </div>
      <div class="modal-footer">
        <button type="button" class="botaoBranco pullTop" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="botaoBranco pullTop">Gravar</button>
      </div>
      </form>
  </div>
</div>
</div>
<!-- //End Modal Baixa -->