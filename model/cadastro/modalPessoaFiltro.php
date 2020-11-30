<!-- Start Modal Filtro -->
<div class="modal fade" id="FiltroModal" role="dialog" aria-spanledby="FiltroModalspan">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
<?php
$tipoHandle = null;
$cnpjCpf = null;
$paisHandle = null;
$estadoHandle = null;
$municipioHandle = null;
$setorAtividadeHandle = null;
$ramoAtividadeHandle = null;
$categoriaAtividadeHandle = null;
$grupoEmpresarialHandle = null;
?>
    <form method="post" action="PessoaFiltro.php">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="FiltroModalspan">Filtrar pessoa</h4>
      </div>
      <div class="modal-body">
      
            <div class="col-xs-5 col-md-4 pullBottom">
            	<span>Tipo</span>
                	<select name="tipo[]" multiple id="tipo">
                    <?php
					if(isset($_POST['tipo'])){
						foreach($_POST['tipo'] as $tipo){
							$tipoExplode = explode(';', $tipo);
							$tipoHandle = $tipoExplode[0];
							@$tipo = $tipoExplode[1];
					?>
                    <option value="<?php echo $tipoHandle; ?>" selected><?php echo $tipo; ?></option>
                    <?php
						}
					}
					?>
					</select>
            </div>
            <div class="col-xs-7 col-md-4 pullBottom">
            	<span>CNPJ/CPF</span>
                <div class="ms-options-wrap" style="position: relative;">
                <?php
				if(isset($_POST['cnpjCpf'])){
					
						$cnpjCpf = $_POST['cnpjCpf'];
				?>
				<input name="cnpjCpf" value="<?php echo $cnpjCpf; ?>" class="form-control" id="cnpjCpf">
				<?php
				}
				else{
				?>
                <input name="cnpjCpf" class="form-control" id="cnpjCpf">
                <?php
				}
				?>
				</div>
            </div>
            <div class="col-xs-3 col-md-4 pullBottom">
            	<span>País</span>
                <select name="pais[]" multiple id="pais">
                <?php
					if(isset($_POST['pais'])){
						foreach($_POST['pais'] as $pais){
							$paisExplode = explode(';', $pais);
							$paisHandle = $paisExplode[0];
							@$pais = $paisExplode[1];
					?>
                    <option value="<?php echo $paisHandle; ?>" selected><?php echo $pais; ?></option>
                    <?php
						}
					}
					?>
				</select>
            <div class="clearfix"></div>
     	 	</div>
            <div class="col-xs-2 col-md-4 pullBottom">
            	<span>Estado</span>
                <select name="estado[]" multiple id="estado">
                <?php
					if(isset($_POST['estado'])){
						foreach($_POST['estado'] as $estado){
							$estadoExplode = explode(';', $estado);
							$estadoHandle = $estadoExplode[0];
							@$estado = $estadoExplode[1];
					?>
                    <option value="<?php echo $estadoHandle; ?>" selected><?php echo $estado; ?></option>
                    <?php
						}
					}
					?>
				</select>
            <div class="clearfix"></div>
     	 	</div>
            <div class="col-xs-7 col-md-4 pullBottom">
            	<span>Município</span>
                <select name="municipio[]" multiple id="municipio">
                <?php
					if(isset($_POST['municipio'])){
						foreach($_POST['municipio'] as $municipio){
							$municipioExplode = explode(';', $municipio);
							$municipioHandle = $municipioExplode[0];
							@$municipio = $municipioExplode[1];
					?>
                    <option value="<?php echo $municipioHandle; ?>" selected><?php echo $municipio; ?></option>
                    <?php
						}
					}
					?>
				</select>
            <div class="clearfix"></div>
     	 	</div>
            <div class="col-xs-12 col-md-4 pullBottom">
            	<span>Setor de atividade</span>
                <select name="setorAtividade[]" multiple id="setorAtividade">
                <?php
					if(isset($_POST['setorAtividade'])){
						foreach($_POST['setorAtividade'] as $setorAtividade){
							$setorAtividadeExplode = explode(';', $setorAtividade);
							$setorAtividadeHandle = $setorAtividadeExplode[0];
							@$setorAtividade = $setorAtividadeExplode[1];
					?>
                    <option value="<?php echo $setorAtividadeHandle; ?>" selected><?php echo $setorAtividade; ?></option>
                    <?php
						}
					}
					?>
				</select>
            <div class="clearfix"></div>
     	 	</div>
            <div class="col-xs-12 col-md-4 pullBottom">
            	<span>Ramo de atividade</span>
                <select name="ramoAtividade[]" multiple id="ramoAtividade">
                <?php
					if(isset($_POST['ramoAtividade'])){
						foreach($_POST['ramoAtividade'] as $ramoAtividade){
							$ramoAtividadeExplode = explode(';', $ramoAtividade);
							$ramoAtividadeHandle = $ramoAtividadeExplode[0];
							@$ramoAtividade = $ramoAtividadeExplode[1];
					?>
                    <option value="<?php echo $ramoAtividadeHandle; ?>" selected><?php echo $ramoAtividade; ?></option>
                    <?php
						}
					}
					?>
				</select>
            <div class="clearfix"></div>
     	 	</div>
            <div class="col-xs-12 col-md-4 pullBottom">
            	<span>Categoria de atividade</span>
                <select name="categoriaAtividade[]" multiple id="categoriaAtividade">
                <?php
					if(isset($_POST['categoriaAtividade'])){
						foreach($_POST['categoriaAtividade'] as $categoriaAtividade){
							$categoriaAtividadeExplode = explode(';', $categoriaAtividade);
							$categoriaAtividadeHandle = $categoriaAtividadeExplode[0];
							@$categoriaAtividade = $categoriaAtividadeExplode[1];
					?>
                    <option value="<?php echo $categoriaAtividadeHandle; ?>" selected><?php echo $categoriaAtividade; ?></option>
                    <?php
						}
					}
					?>
				</select>
            <div class="clearfix"></div>
     	 	</div>
            <div class="col-xs-12 col-md-4 pullBottom">
            	<span>Grupo empresarial</span>
                <select name="grupoEmpresarial[]" multiple id="grupoEmpresarial">
                <?php
					if(isset($_POST['grupoEmpresarial'])){
						foreach($_POST['grupoEmpresarial'] as $grupoEmpresarial){
							$grupoEmpresarialExplode = explode(';', $grupoEmpresarial);
							$grupoEmpresarialHandle = $grupoEmpresarialExplode[0];
							@$grupoEmpresarial = $grupoEmpresarialExplode[1];
					?>
                    <option value="<?php echo $grupoEmpresarialHandle; ?>" selected><?php echo $grupoEmpresarial; ?></option>
                    <?php
						}
					}
					?>
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