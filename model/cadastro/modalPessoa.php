<!-- Start Modal Filtro -->
<div class="modal fade" id="FiltroModal" role="dialog" aria-spanledby="FiltroModalspan">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form method="post" action="PessoaFiltro.php">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="FiltroModalspan">Filtrar pessoa</h4>
      </div>
      <div class="modal-body">
      
            <div class="col-xs-5 col-md-4 pullBottom">
            	<span>Tipo</span>
                	<select name="tipo[]" multiple id="tipo">
					</select>
            </div>
            <div class="col-xs-7 col-md-4 pullBottom">
            	<span>CNPJ/CPF</span>
                <div class="ms-options-wrap" style="position: relative;">
    			<input name="cnpjCpf" class="form-control" id="cnpjCpf">
				</div>
            </div>
            <div class="col-xs-3 col-md-4 pullBottom">
            	<span>País</span>
                <select name="pais[]" multiple id="pais">
				</select>
            <div class="clearfix"></div>
     	 	</div>
            <div class="col-xs-2 col-md-4 pullBottom">
            	<span>Estado</span>
                <select name="estado[]" multiple id="estado">
				</select>
            <div class="clearfix"></div>
     	 	</div>
            <div class="col-xs-7 col-md-4 pullBottom">
            	<span>Município</span>
                <select name="municipio[]" multiple id="municipio">
				</select>
            <div class="clearfix"></div>
     	 	</div>
            <div class="col-xs-12 col-md-4 pullBottom">
            	<span>Setor de atividade</span>
                <select name="setorAtividade[]" multiple id="setorAtividade">
				</select>
            <div class="clearfix"></div>
     	 	</div>
            <div class="col-xs-12 col-md-4 pullBottom">
            	<span>Ramo de atividade</span>
                <select name="ramoAtividade[]" multiple id="ramoAtividade">
				</select>
            <div class="clearfix"></div>
     	 	</div>
            <div class="col-xs-12 col-md-4 pullBottom">
            	<span>Categoria de atividade</span>
                <select name="categoriaAtividade[]" multiple id="categoriaAtividade">
				</select>
            <div class="clearfix"></div>
     	 	</div>
            <div class="col-xs-12 col-md-4 pullBottom">
            	<span>Grupo empresarial</span>
                <select name="grupoEmpresarial[]" multiple id="grupoEmpresarial">
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


<div class="modal fade" id="VoltarPessoaModal"  role="dialog" aria-spanledby="VoltarPessoaModalspan">
    <div class="modal-dialog" role="document">
          <div class="modal-content">
        <form method="post" action="#">
              <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="VoltarPessoaModalspan">Deseja voltar as Pessoas?</h4>
          </div>
              <div class="modal-body"> As pessoas ficarão disponíveis para edição.
            <div class="clearfix"></div>
          </div>
         <div class="modal-footer">
            <button type="button" onClick="VoltarPessoa()" id="sim" class="botaoBrancoLg">Sim</button>
            <button type="button" class="botaoBrancoLg" data-dismiss="modal">Não</button>
          </div>
            </form>
      </div>
        </div>
  </div>
  
  <div class="modal fade" id="ExcluirPessoaModal"  role="dialog" aria-spanledby="ExcluirPessoaModalspan">
    <div class="modal-dialog" role="document">
          <div class="modal-content">
        <form method="post" action="#">
              <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="ExcluirPessoaModalspan">O registro será perdido</h4>
          </div>
              <div class="modal-body"> Deseja realmente excluir a pessoa?
            <div class="clearfix"></div>
          </div>
         <div class="modal-footer">
            <button type="button" onClick="ExcluirPessoa()" id="sim" class="botaoBrancoLg">Sim</button
            ><!-- -->
            <button type="button" class="botaoBrancoLg" data-dismiss="modal">Não</button>
          </div>
            </form>
      </div>
        </div>
  </div>
  
    <div class="modal fade" id="LiberarPessoaModal"  role="dialog" aria-spanledby="LiberarPessoaModalspan">
    <div class="modal-dialog" role="document">
          <div class="modal-content">
        <form method="post" action="#">
              <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="LiberarPessoaModalspan">Deseja liberar as pessoas?</h4>
          </div>
              <div class="modal-body"> as pessoas serão liberados.
            <div class="clearfix"></div>
          </div>
         <div class="modal-footer">
            <button type="button" onClick="LiberarPessoa()" id="sim" class="botaoBrancoLg">Sim</button>
            <button type="button" class="botaoBrancoLg" data-dismiss="modal">Não</button>
          </div>
            </form>
      </div>
        </div>
  </div>
  
  <div class="modal fade" id="CancelarPessoaModal"  role="dialog" aria-spanledby="CancelarPessoaModalspan">
    <div class="modal-dialog" role="document">
          <div class="modal-content">
        <form method="post" action="#">
              <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="CancelarPessoaModalspan">Deseja cancelar as pessoas?</h4>
          </div>
              <div class="modal-body">Informe o motivo
              <input class="form-control" type="text" name="motivo" id="motivo">
            <div class="clearfix"></div>
          </div>
         <div class="modal-footer">
            <button type="button" class="botaoBrancoLg" id="sim" onClick="CancelarPessoa()">Sim</button>
            <button type="button" class="botaoBrancoLg" data-dismiss="modal">Não</button>
          </div>
            </form>
      </div>
        </div>
  </div>
<!-- //End modal -->