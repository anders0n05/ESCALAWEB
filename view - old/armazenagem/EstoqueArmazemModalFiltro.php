<div class="modal fade" id="FiltroModal" role="dialog" aria-spanledby="FiltroModalspan">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form method="get" action="EstoqueArmazemView.php">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="FiltroModalspan">Filtrar estoque</h4>
            </div>
            <div class="modal-body">
                <div class="col-xs-12 col-md-8 pullBottom">
                    <span>Produto</span>
                    <select name="produto[]" multiple id="produto">
                        <?php                        
                            foreach($estoqueArmazem->getFiltro('PRODUTO') as $filtro) {                                 
                                echo "<option value=\"{$filtro['HANDLE']}\">{$filtro['C1']} - {$filtro['C2']}</option>";
                            }                        
                        ?>
                    </select>
                </div>
                <div class="col-xs-12 col-md-4 pullBottom">
                    <span>Natureza de mercadoria</span>
                    <select name="naturezamercadoria[]" multiple id="naturezamercadoria">
                        <?php                        
                            foreach($estoqueArmazem->getFiltro('NATUREZAMERCADORIA') as $filtro) {                                 
                                echo "<option value=\"{$filtro['HANDLE']}\">{$filtro['C1']}</option>";
                            }                        
                        ?>
                    </select>
                    <div class="clearfix"></div>
                </div>
                <div class="col-xs-12 col-md-12 pullBottom">
                    <span>Cliente</span>
                    <select name="cliente[]" multiple id="cliente">
                        <?php                        
                            foreach($estoqueArmazem->getFiltro('CLIENTE') as $filtro) {                                 
                                echo "<option value=\"{$filtro['HANDLE']}\">{$filtro['C2']} - {$filtro['C1']}</option>";
                            }                        
                        ?>
                    </select>
                </div> 
                <div class="col-md-3 pullBottom">
                    <span>Nr Pedido</span>
                    <input class="form-control" id="nrpedido" name="nrpedido">
                </div>
                <div class="col-md-3 pullBottom">
                    <span>Lote</span>
                    <input class="form-control" id="lote" name="lote">
                </div>
                <div class="col-md-2 pullBottom">
                    <span>Validade</span>
                    <input type="date" class="form-control" id="validade" name="validade">
                </div>
                <div class="col-md-2 pullBottom">
                    <span>Nota fiscal</span>
                    <input class="form-control" id="notafiscal" name="notafiscal">
                </div>
                <div class="col-md-2 pullBottom">
                    <span>Data de emissão</span>
                    <input type="date" class="form-control" id="emissao" name="emissao">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="botaoBranco pullTop" data-dismiss="modal">Cancelar</button>
                <button type="button" class="botaoBranco pullTop" onclick="limparFiltro()">Limpar</button>
                <button type="button" class="botaoBranco pullTop" onclick="aplicarFiltro()">Aplicar</button>
            </div>       
         </form>     
        </div>
    </div>
</div>