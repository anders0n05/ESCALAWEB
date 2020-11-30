<?php
$regraBaixa = null;
$regraBaixaHandle = null;
$romaneioItem = null;
$documentoTransporte = null;
$documentoTransporteHandle = null;
$tipoOcorrencia = null;
$tipoOcorrenciaHandle = null;
$tipoOperacao = null;
$tipoOperacaoHandle = null;
$filial = null;
$filialHandle = null;
$acao = null;
$acaoHandle = null;
$data = null;
$hora = null;
$dataChegada = null;
$horaChegada = null;
$dataEntrada = null;
$horaEntrada = null;
$dataSaida = null;
$horaSaida = null;
$motivoAtraso = null;
$motivoAtrasoHandle = null;
$responsavel = null;
$responsavelHandle = null;
$nome = null;
$documento = null;
$observacao = null;

$mensagem = null;
$protocolo = null;
$gravou = null;

$disabled = null;

if (isset($_SESSION['mensagem'])) {
    $mensagem = $_SESSION['mensagem'];

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
            <h4 class="modal-title" id="MensagemModal">Erro ao inserir despesa</h4>
          </div>
              <div class="modal-body"> ' . $mensagem . '
            <div class="clearfix"></div>
          </div>
              <div class="modal-footer">
            <button type="button" class="botaoBrancoLg"  data-dismiss="modal">Ok</button>
          </div>
            </form>
      </div>
        </div>
  </div>';

    $regraBaixa = $_SESSION['regraBaixa'];
    $regraBaixaHandle = $_SESSION['regraBaixaHandle'];
    $romaneioItem = $_SESSION['romaneioItem'];
    $documentoTransporte = $_SESSION['documentoTransporte'];
    $documentoTransporteHandle = $_SESSION['documentoTransporteHandle'];
    $tipoOperacao = $_SESSION['tipoOperacao'];
    $tipoOperacaoHandle = $_SESSION['tipoOperacaoHandle'];
    $tipoOcorrencia = $_SESSION['tipo'];
    $tipoOcorrenciaHandle = $_SESSION['tipoHandle'];
    $filial = $_SESSION['filial'];
    $filialHandle = $_SESSION['filialHandle'];
    $acao = $_SESSION['acao'];
    $acaoHandle = $_SESSION['acaoHandle'];
    $data = $_SESSION['data'];
    $hora = $_SESSION['hora'];
    $dataChegada = $_SESSION['dataChegada'];
    $horaChegada = $_SESSION['horaChegada'];
    $dataEntrada = $_SESSION['dataEntrada'];
    $horaEntrada = $_SESSION['horaEntrada'];
    $dataSaida = $_SESSION['dataSaida'];
    $horaSaida = $_SESSION['horaSaida'];
    $motivoAtraso = $_SESSION['motivoAtraso'];
    $motivoAtrasoHandle = $_SESSION['motivoAtrasoHandle'];
    $responsavel = $_SESSION['responsavel'];
    $responsavelHandle = $_SESSION['responsavelHandle'];
    $nome = $_SESSION['nome'];
    $documento = $_SESSION['documento'];
    $observacao = $_SESSION['observacao'];

    unset($_SESSION['regraBaixa']);
    unset($_SESSION['regraBaixaHandle']);
    unset($_SESSION['tipoOperacao']);
    unset($_SESSION['romaneioItem']);
    unset($_SESSION['tipoOperacaoHandle']);
    unset($_SESSION['documentoTransporte']);
    unset($_SESSION['documentoTransporteHandle']);
    unset($_SESSION['tipoOcorrencia']);
    unset($_SESSION['tipoOcorrenciaHandle']);
//			unset($_SESSION['filial']);
//			unset($_SESSION['filialHandle']);
    unset($_SESSION['tipoHandle']);
    unset($_SESSION['acao']);
    unset($_SESSION['acaoHandle']);
    unset($_SESSION['data']);
    unset($_SESSION['hora']);
    unset($_SESSION['dataChegada']);
    unset($_SESSION['horaChegada']);
    unset($_SESSION['dataEntrada']);
    unset($_SESSION['horaEntrada']);
    unset($_SESSION['dataSaida']);
    unset($_SESSION['horaSaida']);
    unset($_SESSION['motivoAtraso']);
    unset($_SESSION['motivoAtrasoHandle']);
    unset($_SESSION['responsavel']);
    unset($_SESSION['responsavelHandle']);
    unset($_SESSION['nome']);
    unset($_SESSION['documento']);
    unset($_SESSION['observacao']);

} else if (isset($_SESSION['protocolo'])) {
    $protocolo = $_SESSION['protocolo'];
    unset($_SESSION['protocolo']);


}

if (isset($_GET['romaneio'])) {
    $romaneio = $_GET['romaneio'];
} else {
    $romaneio = null;
}

/*if(isset($_POST['check'])){

    $check =  $_POST['check'];

foreach($check as $chk){
    $checkValue = $chk;
}

$numeroViagem = explode(';', $checkValue);
$numero = $numeroViagem[0];
$viagemHandle = $numeroViagem[1];
}


if($numero == null){
    @$numero = $_GET['numero'];
}
if($viagemHandle == null){
    @$viagemHandle = $_GET['handle'];
    $disabled = 'disabled';
}
if($numero > null){
    $disabled = 'disabled';
}
else{
    $disabled = '';
}*/
?>