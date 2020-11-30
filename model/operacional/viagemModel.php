<?php
	if(Sistema::getGet('checkCount') == 'F'){
?>

		<div class="alert alert-danger alert-dismissible" role="alert">
  			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  		<strong>Atenção!</strong> Selecione apenas uma viagem para inserir despesas.
		</div>

<?php
	}
?>
<?php
	if(Sistema::getGet('filtrar') == 'F'){
?>

		<div class="alert alert-danger alert-dismissible" role="alert">
  			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  		<strong>Atenção!</strong> Selecione o filtro desejado e clique em Aplicar filtro.
		</div>

<?php
	}
?>