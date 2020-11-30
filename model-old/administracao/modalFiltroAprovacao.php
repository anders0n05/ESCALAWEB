<!-- Start Modal Filtro -->
<div class="modal fade" id="FiltroModal" role="dialog" aria-spanledby="FiltroModalspan">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form method="post" action="AprovacaoFiltro.php">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="FiltroModalspan">Filtrar aprovação</h4>
      </div>
      <div class="modal-body">
        	<div class="col-xs-6 col-md-4 pullBottom">
            	<span>Data Inicial</span>
                <input type="datetime-local" id="dataInicio"  class="form-control" name="dataInicio">
            </div>
            <div class="col-xs-6 col-md-4 pullBottom">
            	<span>Data Final</span>
                <input type="datetime-local" id="dataFinal"  class="form-control" name="dataFinal">
            </div>
            <div class="col-xs-6 col-md-4 pullBottom">
            	<span>Origem</span>
    			<select name="origem[]" multiple id="origem">
				</select>
            </div>
            <div class="col-xs-6 col-md-12 pullBottom">
            	<span>Alçada</span>
                <select name="alcada[]" multiple id="alcada">
				</select>
           </div>
            <div class="col-xs-6 col-md-6 pullBottom">
            	<span>Empresa</span>
                	<select name="empresa[]" multiple id="empresa">
					</select>
            </div>
            <div class="col-xs-6 col-md-6 pullBottom">
            	<span>Filial</span>
                <select name="filial[]" multiple id="filial">
				</select>
                <div class="clearfix"></div>
            </div>
            </div>
      <div class="modal-footer">
        <button type="button" class="botaoBranco pullTop" data-dismiss="modal">Cancelar</button>
        <button type="reset" class="botaoBranco pullTop">Limpar</button>
        <button type="submit" class="botaoBranco pullTop">Aplicar</button>
      </div>
      </form>
  </div>
</div>
</div>
<!-- //End Modal Filtro -->
