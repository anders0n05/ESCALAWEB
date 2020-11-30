<?php

if (isset($_COOKIE['ultimologinWeb'])) {
    $ultimologin = $_COOKIE['ultimologinWeb'];
    ?>
    <script>
        $(document).ready(function (e) {
            focosenha();
        });
    </script>
    <?php

} else {
    $ultimologin = '';
}

if (isset($_GET['mensagem'])) {
    $mensagem = $_GET['mensagem'];
    unset($_GET['mensagem']);

    echo "<script type='text/javascript'>
    				$(window).load(function(){
        			$('#MensagemModal').modal('show');
    				});
				</script>";

    echo '<div class="modal fade" id="MensagemModal" role="dialog" aria-spanledby="MensagemModalspan">
    <div class="modal-dialog" role="document">
          <div class="modal-content">
        <form method="post" action="#">
              <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="MensagemModal">Erro</h4>
          </div>
              <div class="modal-body"> ' . $mensagem . '
            <div class="clearfix"></div>
          </div>
              <div class="modal-footer">
            <button type="button" class="botaoBrancoLg" onClick="focosenha();"  data-dismiss="modal">Ok</button>
          </div>
            </form>
      </div>
        </div>
  </div>';
}
?>

<?php

if (isset($_GET['success']) and $_GET['success'] == 'F') {
    ?>
    <script type='text/javascript'>
        $(window).load(function () {
            $('#MensagemModal').modal('show');
        });
    </script>

    <div class="modal fade" id="MensagemModal" role="dialog" aria-spanledby="MensagemModalspan">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="post" action="#">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="MensagemModal">Erro</h4>
                    </div>
                    <div class="modal-body"> Usuário e/ou senha incorretos!
                        <div class="clearfix"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="botaoBrancoLg" onClick="focosenha();"  data-dismiss="modal">Ok</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php

}
?>

<?php

if (isset($_GET['permissaoempresa']) and $_GET['permissaoempresa'] == 'F') {
    ?>
    <script type='text/javascript'>
        $(window).load(function () {
            $('#MensagemModal').modal('show');
        });
    </script>

    <div class="modal fade" id="MensagemModal" role="dialog" aria-spanledby="MensagemModalspan">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="post" action="#">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-span="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="MensagemModal">Erro</h4>
                    </div>
                    <div class="modal-body"> Usuário não possui permissão para acessar a empresa.
                        <div class="clearfix"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="botaoBrancoLg" onClick="focosenha();"  data-dismiss="modal">Ok</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php

}
?>