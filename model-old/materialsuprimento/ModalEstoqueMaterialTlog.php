<!-- Start Modal Filtro -->
<div class="modal fade" id="FiltroModal" role="dialog" aria-spanledby="FiltroModalspan">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="formEstoqueMercadoriaFiltro" method="post" action="EstoqueMaterialTlog.php">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="FiltroModalspan">Filtrar estoque de material</h4>
                </div>
                <div class="modal-body">
                    <div class="col-md-4 pullBottom">
                        <span>Código</span>
                        <input class="form-control" id="codigoProduto" name="codigoProduto">
                    </div>
                    <div class="col-md-8 pullBottom">
                        <span>Produto</span>
                        <input class="form-control" id="nomeProduto" name="nomeProduto">
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

<!-- //start Modal retorno -->
<div aria-hidden="true" aria-labelledby="retornoModalLabel" role="dialog" tabindex="-1" id="retornoModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">Mensagem do sistema</h4>
            </div>
            <div class="modal-body">
                <div id="retornoModal-body">
                </div>
            </div>
            <div class="modal-footer">
                <div class="col-sm-12">
                    <button aria-hidden="true" data-dismiss="modal" class="btn btn-default" id="retornoModalOk" type="button">Ok</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- //end Modal retorno -->

<script>
    $(document).ready(function () {
        $('#codigoProduto').val("<?= Sistema::getPost("codigoProduto") ?>");
        $('#nomeProduto').val("<?= Sistema::getPost("nomeProduto") ?>");
    });
</script>