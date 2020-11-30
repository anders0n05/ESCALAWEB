<div class="modal fade" id="FiltroModal" role="dialog" aria-spanledby="FiltroModalspan">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form method="get" action="MinhasCargasDescargas.php">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="FiltroModalspan">Filtrar carga/descarga</h4>
            </div>
            <div class="modal-body">
                <div class="col-xs-12 col-md-8 pullBottom">
                    <span>Tipo</span>
                    <select name="tipo[]" multiple id="tipo">
                        <?php                        
                            foreach($minhasCargasDescargas->getFiltro('TIPO') as $filtro) {                                 
                                echo "<option value=\"{$filtro['HANDLE']}\">{$filtro['C1']} - {$filtro['C2']}</option>";
                            }                        
                        ?>
                    </select>
                </div>
                <div class="col-xs-12 col-md-4 pullBottom">
                    <span>Processo</span>
                    <select name="processo[]" multiple id="processo">
                        <?php                        
                            foreach($minhasCargasDescargas->getFiltro('PROCESSO') as $filtro) {                                 
                                echo "<option value=\"{$filtro['HANDLE']}\">{$filtro['C1']}</option>";
                            }                        
                        ?>
                    </select>
                    <div class="clearfix"></div>
                </div>
                
                <div class="col-xs-12 col-md-12 pullBottom">
                    <span>Transportadora</span>
                    <select name="transportadora[]" multiple id="transportadora">
                        <?php                        
                            foreach($minhasCargasDescargas->getFiltro('TRANSPORTADORA') as $filtro) {                                 
                                echo "<option value=\"{$filtro['HANDLE']}\">{$filtro['C2']} - {$filtro['C1']}</option>";
                            }                        
                        ?>
                    </select>
                </div> 
                <div class="col-xs-12 col-md-12 pullBottom">
                    <span>Cliente</span>
                    <select name="cliente[]" multiple id="cliente">
                        <?php                        
                            foreach($minhasCargasDescargas->getFiltro('CLIENTE') as $filtro) {                                 
                                echo "<option value=\"{$filtro['HANDLE']}\">{$filtro['C2']} - {$filtro['C1']}</option>";
                            }                        
                        ?>
                    </select>
                </div> 
                                
                <div class="col-md-4 pullBottom">
                    <span>Nr controle</span>
                    <input class="form-control" id="nrcontrole" name="nrcontrole">
                </div>
                <div class="col-md-4 pullBottom">
                    <span>Nr pedido</span>
                    <input class="form-control" id="nrpedido" name="nrpedido">
                </div>
                <div class="col-md-4 pullBottom">
                    <span>Nr ordem</span>
                    <input class="form-control" id="nrordem" name="nrordem">
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