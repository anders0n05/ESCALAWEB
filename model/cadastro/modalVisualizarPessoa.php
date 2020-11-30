<!-- Start modal -->
<div class="modal fade" id="LimparModal"  role="dialog" aria-spanledby="LimparModalspan">
    <div class="modal-dialog" role="document">
          <div class="modal-content">
        
              <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="LimparModalspan">Deseja realmente limpar os campos?</h4>
          </div>
              <div class="modal-body"> Ao limpar os campos, os dados editados não serão salvos!
            <div class="clearfix"></div>
          </div>
              <div class="modal-footer">
            <button type="reset" class="botaoBrancoLg" data-dismiss="modal" onClick="limparcampos()">Sim</button>
            <button type="button" class="botaoBrancoLg"  data-dismiss="modal">Não</button>
          </div>
            
      </div>
        </div>
</div>


<div class="modal fade" id="VoltarPessoaModal"  role="dialog" aria-spanledby="VoltarPessoaModalspan">
    <div class="modal-dialog" role="document">
          <div class="modal-content">
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
      </div>
        </div>
  </div>
  
  <div class="modal fade" id="ExcluirPessoaModal"  role="dialog" aria-spanledby="ExcluirPessoaModalspan">
    <div class="modal-dialog" role="document">
          <div class="modal-content">
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
      </div>
        </div>
  </div>
  
    <div class="modal fade" id="LiberarPessoaModal"  role="dialog" aria-spanledby="LiberarPessoaModalspan">
    <div class="modal-dialog" role="document">
          <div class="modal-content">
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
      </div>
        </div>
  </div>
  
  <div class="modal fade" id="CancelarPessoaModal"  role="dialog" aria-spanledby="CancelarPessoaModalspan">
    <div class="modal-dialog" role="document">
          <div class="modal-content">
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
      </div>
        </div>
  </div>
<!-- //End modal -->