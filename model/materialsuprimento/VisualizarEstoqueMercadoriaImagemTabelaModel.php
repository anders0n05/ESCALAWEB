<?php

if ($imagemExiste) {
    $webservice = 'materialsuprimento';
    include_once('../../controller/tecnologia/WebService.php');

    try {
        Sistema::verificarWebservice($WebServiceOffline);

        $parametroBaixarAnexo = array("item" => $EstoqueMercadoriaItem);

        $baixarAnexo = $clientSoap->BaixarAnexo(array("baixarAnexo" => $parametroBaixarAnexo));

        Sistema::verificarSoapFault($baixarAnexo);

        $resultBaixarAnexo = $baixarAnexo->BaixarAnexoResult;

        Sistema::setRetornoWebService($resultBaixarAnexo, $retorno);
    } catch (SoapFault $erro) {
        Sistema::setSoapFault($erro, $retorno);
    } catch (Exception $erro) {
        Sistema::setException($erro, $retorno);
    }

	if (!$retorno['sucesso']) {
		?>
		<div class="alert alert-warning" style="margin-top: 5px">
			<strong>Atenção: </strong><?= $retorno['mensagem'] ?>
		</div>
		<?php
	} else {
		function imprimirImagem($arquivo, $nome) {
			?>
				<div class="row">
					<div class="col-md-8 col-md-offset-2">
						<div class="thumbnail">
							<img src="data:image/jpg;base64,<?=base64_encode($arquivo)?>" alt="<?= $nome ?>">
						</div>
					</div>
				</div>
			<?php			
		}

		if (!is_array($baixarAnexo->BaixarAnexoResult->anexo->Anexo)) {
			$listaImagem = $baixarAnexo->BaixarAnexoResult->anexo;
		} else {
			$listaImagem = $baixarAnexo->BaixarAnexoResult->anexo->Anexo;
		}

		foreach ($listaImagem as $anexo) {
			imprimirImagem($anexo->arquivo, $anexo->nome);
		}
	}
}
