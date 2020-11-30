<div class="modal fade" id="AprovarModal"  role="dialog" aria-spanledby="AprovarModalspan">
    <div class="modal-dialog" role="document">
          <div class="modal-content">
        	
              <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="AprovarModal">Deseja aprovar os registros?</h4>
          </div>
              <div class="modal-body"> Os registros selecionados serão aprovados. 
            <div class="clearfix"></div>
          </div>
              <div class="modal-footer">
            <button type="button" name="aprovar" onClick="Aprovar()" class="botaoBrancoLg" id="sim" >Sim</button>
            <button type="button" class="botaoBrancoLg"  data-dismiss="modal">Não</button>
          </div>
         
      </div>
        </div>
</div>

<div class="modal fade" id="RecusarModal" role="dialog" aria-spanledby="RecusarModalspan">
    <div class="modal-dialog" role="document">
          <div class="modal-content">
        
              <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="RecusarModal">Deseja recusar os registros?</h4>
          </div>
              <div class="modal-body"> Os registros selecionados serão recusados, informe o motivo abaixo:
              <input class="form-control" type="text" name="motivo" id="motivo" placeholder="Motivo">
            <div class="clearfix"></div>
          </div>
              <div class="modal-footer">
            <button type="button" name="recusar" onClick="Recusar()" class="botaoBrancoLg" id="sim" >Sim</button>
            <button type="button" class="botaoBrancoLg"  data-dismiss="modal">Não</button>
          </div>
         
      </div>
        </div>
</div>
