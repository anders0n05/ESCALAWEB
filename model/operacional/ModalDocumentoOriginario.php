<!-- Start Modal Filtro -->
<div class="modal fade" id="FiltroModal" role="dialog" aria-spanledby="FiltroModalspan">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form method="post" action="DespesaViagemFiltro.php">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="FiltroModalspan">Filtrar despesa de viagem</h4>
      </div>
      <div class="modal-body">
      
        	<div class="col-xs-6 col-md-4">
            	<span>Data Inicial</span>
                <input type="datetime-local" id="dataInicio"  class="form-control" name="dataInicio">
            </div>
            <div class="col-xs-6 col-md-4">
            	<span>Data Final</span>
                <input type="datetime-local" id="dataFinal"  class="form-control" name="dataFinal">
            </div>
            <div class="col-xs-12 col-md-4">
            	<span>Situação</span>
                	<select name="situacao[]" multiple id="situacao">
					</select>
            </div>
            <div class="col-xs-12">
            	<span>Tipo de Despesa</span>
                <select name="tipo[]" multiple id="tipo">
				</select>
            </div>
            <div class="col-xs-8 col-md-9">
            	<span>Despesa</span>
    			<select name="despesa[]" multiple id="despesa">
				</select>
            </div>
            <div class="col-xs-4 col-md-3">
            	<span>Viagem</span>
                <select name="viagem[]" multiple id="viagem">
				</select>
            <div class="clearfix"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="botaoBranco" data-dismiss="modal">Cancelar</button>
        <button type="reset" class="botaoBranco">Limpar</button>
        <button type="submit" class="botaoBranco">Aplicar</button>
      </div>
      </form>
    </div>
  </div>
</div>
</div>
<!-- //End Modal Filtro -->

 <!-- Start modal -->
      <div class="modal fade" id="VoltarModal"  role="dialog" aria-spanledby="VoltarModalspan">
    <div class="modal-dialog" role="document">
          <div class="modal-content">
        <form method="post" action="#">
              <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="VoltarModalspan">O registro não foi salvo</h4>
          </div>
              <div class="modal-body"> Deseja salvar as alterações realizadas neste formulário?
            <div class="clearfix"></div>
          </div>
              <div class="modal-footer">
            <button type="button" class="botaoBrancoLg" id="sim" onClick="submitDespesaViagemForm()">Sim</button>
            <button type="button" class="botaoBrancoLg" onClick="javascript:window.location.href='DespesaViagem.php'">Não</button>
            <button type="button" class="botaoBranco"  data-dismiss="modal">Cancelar</button>
          </div>
            </form>
      </div>
        </div>
  </div>
      
      <div class="modal fade" id="VoltarDespesaModal"  role="dialog" aria-spanledby="VoltarDespesaModalspan">
    <div class="modal-dialog" role="document">
          <div class="modal-content">
        <form method="post" action="#">
              <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="VoltarDespesaModalspan">Deseja voltar as despesas da viagem?</h4>
          </div>
              <div class="modal-body"> As despesas da viagem ficarão disponíveis para edição.
            <div class="clearfix"></div>
          </div>
         <div class="modal-footer">
            <button type="button" onClick="VoltarDespesaViagem()" id="sim" class="botaoBrancoLg">Sim</button>
            <button type="button" class="botaoBrancoLg" data-dismiss="modal">Não</button>
          </div>
            </form>
      </div>
        </div>
  </div>
  
  <div class="modal fade" id="ExcluirDespesaModal"  role="dialog" aria-spanledby="ExcluirDespesaModalspan">
    <div class="modal-dialog" role="document">
          <div class="modal-content">
        <form method="post" action="#">
              <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="VoltarDespesaModalspan">O registro será perdido</h4>
          </div>
              <div class="modal-body"> Deseja realmente excluir o registro?
            <div class="clearfix"></div>
          </div>
         <div class="modal-footer">
            <button type="button" onClick="ExcluirDespesaViagem()" id="sim" class="botaoBrancoLg">Sim</button
            ><!-- -->
            <button type="button" class="botaoBrancoLg" data-dismiss="modal">Não</button>
          </div>
            </form>
      </div>
        </div>
  </div>
  
    <div class="modal fade" id="LiberarDespesaModal"  role="dialog" aria-spanledby="LiberarDespesaModalspan">
    <div class="modal-dialog" role="document">
          <div class="modal-content">
        <form method="post" action="#">
              <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="VoltarDespesaModalspan">Deseja liberar as despesas da viagem?</h4>
          </div>
              <div class="modal-body"> As despesas da viagem serão liberadas e encerradas.
            <div class="clearfix"></div>
          </div>
         <div class="modal-footer">
            <button type="button" onClick="LiberarDespesaViagem()" id="sim" class="botaoBrancoLg">Sim</button>
            <button type="button" class="botaoBrancoLg" data-dismiss="modal">Não</button>
          </div>
            </form>
      </div>
        </div>
  </div>
  
  <div class="modal fade" id="CancelarDespesaModal"  role="dialog" aria-spanledby="CancelarDespesaModalspan">
    <div class="modal-dialog" role="document">
          <div class="modal-content">
        <form method="post" action="#">
              <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="CancelarDespesaModalspan">Deseja cancelar as despesas da viagem?</h4>
          </div>
              <div class="modal-body">Informe o motivo
              <input class="form-control" type="text" name="motivo" id="motivo">
            <div class="clearfix"></div>
          </div>
         <div class="modal-footer">
            <button type="button" class="botaoBrancoLg" id="sim" onClick="CancelarDespesaViagem()">Sim</button>
            <button type="button" class="botaoBrancoLg" data-dismiss="modal">Não</button>
          </div>
            </form>
      </div>
        </div>
  </div>
<!-- //End modal -->