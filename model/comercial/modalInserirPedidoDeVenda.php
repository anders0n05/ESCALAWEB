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


<div class="modal fade" id="VoltarPedidoModal"  role="dialog" aria-spanledby="VoltarPedidoModalspan">
    <div class="modal-dialog" role="document">
          <div class="modal-content">
        
              <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="VoltarPedidoModalspan">Deseja voltar as Pedidos de venda?</h4>
          </div>
              <div class="modal-body"> Os Pedidos de venda ficarão disponíveis para edição.
            <div class="clearfix"></div>
          </div>
         <div class="modal-footer">
            <button type="button" onClick="VoltarPedidoDeVenda()" id="sim" class="botaoBrancoLg">Sim</button>
            <button type="button" class="botaoBrancoLg" data-dismiss="modal">Não</button>
          </div>
            
      </div>
        </div>
  </div>
  
  <div class="modal fade" id="ExcluirPedidoModal"  role="dialog" aria-spanledby="ExcluirPedidoModalspan">
    <div class="modal-dialog" role="document">
          <div class="modal-content">
        
              <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="ExcluirPedidoModalspan">O registro será perdido</h4>
          </div>
              <div class="modal-body"> Deseja realmente excluir o Pedido?
            <div class="clearfix"></div>
          </div>
         <div class="modal-footer">
            <button type="button" onClick="ExcluirPedidoDeVenda()" id="sim" class="botaoBrancoLg">Sim</button
            ><!-- -->
            <button type="button" class="botaoBrancoLg" data-dismiss="modal">Não</button>
          </div>
            
      </div>
        </div>
  </div>
  
    <div class="modal fade" id="LiberarPedidoModal"  role="dialog" aria-spanledby="LiberarPedidoModalspan">
    <div class="modal-dialog" role="document">
          <div class="modal-content">
        
              <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="LiberarPedidoModalspan">Deseja liberar os Pedidos de venda?</h4>
          </div>
              <div class="modal-body"> Os Pedidos de venda serão liberados.
            <div class="clearfix"></div>
          </div>
         <div class="modal-footer">
            <button type="button" onClick="LiberarPedidoDeVenda()" id="sim" class="botaoBrancoLg">Sim</button>
            <button type="button" class="botaoBrancoLg" data-dismiss="modal">Não</button>
          </div>
            
      </div>
        </div>
  </div>
  
  
  <div class="modal fade" id="CancelarPedidoModal"  role="dialog" aria-spanledby="CancelarPedidoModalspan">
    <div class="modal-dialog" role="document">
          <div class="modal-content">
        
              <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="CancelarPedidoModalspan">Deseja cancelar os Pedidos?</h4>
          </div>
              <div class="modal-body">Informe o motivo
              <input class="form-control" type="text" name="motivo" id="motivo">
            <div class="clearfix"></div>
          </div>
         <div class="modal-footer">
            <button type="button" class="botaoBrancoLg" id="sim" onClick="CancelarPedidoDeVenda()">Sim</button>
            <button type="button" class="botaoBrancoLg" data-dismiss="modal">Não</button>
          </div>
            
      </div>
        </div>
  </div>
<!-- //End modal -->