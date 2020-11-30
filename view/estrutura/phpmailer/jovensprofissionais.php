<?php
include('admin/config.php');
include('admin/site_includes/seo.php');
include('admin/site_includes/empresa.php');
?>
<!DOCTYPE html>
<html lang="pt-br" xml:lang="pt-br" xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title><?php echo $tituloSEO; ?> - Programa jovens profissionais</title>
	<link rel="shortcut icon" href="images/favicon.png" />
	<meta name="keywords" content="<?php echo $palavraschaveSEO; ?>">
	<meta name="description" content="<?php echo $descricaoSEO; ?>">
     
	<link rel='stylesheet' id='config-css'  href='css/ts-config.css' type='text/css' media='all' />
	<link rel='stylesheet' id='font-awesome.min-css'  href='css/font-awesome.min.css' type='text/css' media='all' />
	<link rel='stylesheet' id='bootstrap.min-css'  href='css/bootstrap.css' type='text/css' media='all' />
	<link rel='stylesheet' id='megamenu-css'  href='css/megamenu.css' type='text/css' media='all' />
	<link rel='stylesheet' id='styles-css'  href='css/styles.css' type='text/css' media='all' />
	<link rel="stylesheet" id="custom-css" href="css/mobile.css" type="text/css" media="all" />
	<link rel='stylesheet'   href='css/layout.css' type='text/css' media='all' />
    <link rel='stylesheet'   href='css/styleCustom.css' type='text/css' media='all' />
	 <?php echo $googleAnalytics; ?>
</head>
<body>	
    <!--Wrapper--><div id="wrapper">
	<!-- Start header -->
<header>
<?php
	include('header.php');
?>
</header> 
<!-- End header -->

<!-- content -->			
<div id="container_full">	
<div class="ts-about-efficiently-envisioneer parallax-section sobreaempresa">

<div class="row">
    <div class="container">
					<div class="col-sm-12">
						<div class="header-interna jovensprofissionais-header">
							<h2>Estágio remunerado em <br /> tecnologia da informação</h2>
							<p>Jovens com apetite por aprendizado em tecnologia, 
								<br>inscreva-se e participe do processo seletivo
								<br>em nosso programa de estágio remunerado para 
								<br>trabalhar com desenvolvimento de sistemas.</p>
						</div>
					</div>
				</div>
	<div class="container">
		<div class="col-sm-12">
			<p class="vazio">&nbsp;</p>
			<h2 class="title">O que é o programa?</h2>
			<br>
			<p>O programa é um projeto de capacitação remunerada para estudantes que desejam trabalhar com desenvolvimento de sistemas, criado e realizado pela Escalasoft Tecnologogia, em parceria com a Unidavi.
            <br>
			<br>A carga horária total é de 720 horas, em período integral, durante o período de 6 meses, sendo 3 meses no laboratório da Unidavi e 3 meses em nosso centro de desenvolvimento, na Rua dos Pioneiros, 265, Centro de Rio do Sul/SC.
            <br>
			<br>Todos os alunos que terminarem o curso terão a contratação garantida em regime CLT para trabalhar em nosso centro de desenvolvimento.</p>
		</div>
	</div>
	
	<div class="container">
		<div class="col-sm-12">
			<p class="vazio">&nbsp;</p>
			<h2 class="title">Quem pode participar?</h2>
			<br>
			<p>Todos os alunos de Rio do Sul e região, que terminaram o ensino médio e iniciarão ou estão cursando o curso superior de tecnologia da informação.</p>
		</div>
	</div>	
	
	<div class="container">
		<div class="col-sm-12">
			<p class="vazio">&nbsp;</p>
			<h2 class="title">Como participar?</h2>
			<br>
			<p>Os interessandos em participar devem preencher o formulário de inscrição no site www.escalasoft.com.br/jovensprofissionais e enviar juntamente com seu curriculo, para registro em nosso banco de talentos.</p>
		</div>
	</div>		
	
	<div class="container">
		<div class="col-sm-12">
			<p class="vazio">&nbsp;</p>
			<h2 class="title">Quais os benefícios do programa?</h2>
			<br>
			<p>O programa de capacitação remunerado da ESCALASOFT irá oferecer:
            
            <br>- Registro de estágio durante o programa
            <br>- Salário de 1.039,00 por mês
            <br>- Certificado de conclusão de estágio
            <br>- Contratação garantida após certificação
            <br>- Treinamento no laboratório da Unidavi
            <br>- Treinamento por profissionais da Escalasoft
            <br>- Vale refeição (17,50 dia) e vale transporte após 3 mês
            <br>ATENÇÃO: Para se manter no programa, o participante deverá atingir a nota mínima nas avaliações quinzenais que serão realizadas referente ao conteúdo passado nos treinamentos.</p>
		</div>
	</div>	
</div>
</div>

<div  class="ts-home4-provice-services parallax-section curriculo" id="curriculo">
<div class="container">
<div class="row">
<div class="col-sm-12">	
    <div class="st-wrapper">
        <div class="ts-section-title">
			<br>
            <h2 class="title">Cadastre seu interesse no programa</h2>
        </div>	
        <div>
        <p style="font-size:16px;">
        	Preencha o formulário de interesse ao programa jovens profissionais, anexe seu currículo e participe do nosso processo seletivo.
        </p>
    </div> 
</div>
	     
            
<?php
if(isset($_SESSION['retorno'])){
	$retorno = $_SESSION['retorno'];
	unset($_SESSION['retorno']);
?>
<div class="col-sm-12">
<div class="alert alert-info">
<?php echo $retorno; ?>
</div>
</div>
<?php
}
?>
</div> 
    
    <form method="post" action="jovensprofissionais_query.php" enctype="multipart/form-data">
        <div class="col-sm-6">
        <label>Nome <font color="#FF0004">*</font></label>
        <input type="text" class="form-control input-lg" name="nome" id="nome" required>
        </div>
		
        <div class="col-sm-3">
        <label>CPF<font color="#FF0004">*</font></label>
		<input type="text" class="form-control input-lg" name="cpf" id="cpf" maxlength="14" required>	
	
        </div>		
        
        <div class="col-sm-3">
        <label>Data de nascimento<font color="#FF0004">*</font></label>
        <input type="date" class="form-control input-lg" name="datanasc" required>
        </div>
        
        <div class="col-sm-3">
        <label>Telefone</label>
        <input type="text" class="form-control input-lg" name="telefone">
        </div>
        
        <div class="col-sm-3">
        <label>Celular <font color="#FF0004">*</font></label>
        <input type="text" class="form-control input-lg" name="celular" required>
        </div>
        
        <div class="col-sm-6">
        <label>Cidade / UF <font color="#FF0004">*</font></label>
        <input type="text" class="form-control input-lg" name="cidadeuf" required>
        </div>
        
        <div class="col-sm-6">
        <label>E-mail <font color="#FF0004">*</font></label>
        <input type="email" class="form-control input-lg" name="email" required>
        </div> 
        
        <div class="col-sm-6">
        <label>Programa <font color="#FF0004">*</font></label>
		<select class="form-control input-lg" name="programa" id="programa">
			<option value="Estágio remunerado de Jan/2020 à Jun/2020">Estágio remunerado de Jan/2020 à Jun/2020</option>
		</select>
        </div>
        
        <div class="col-sm-12">
        <label>Observação</label>
        <textarea class="form-control input-lg" rows="8" name="obs"></textarea>
        </div>
        
        <div class="col-sm-3">
        <br>
		<div class="fileUpload ts-style-button large">
    		<span>Buscar arquivo</span>
    		<input id="uploadBtn" name="curriculo" type="file" class="upload" required />
		</div>
			<div id="curriculoSelecionado"></div>
        
        
        </div>
        <div class="col-sm-3">
         <br>
        <button type="submit" class="ts-style-button large">Enviar</button>
        </div>
   
</form>

</div>
</div>	



</div><!-- End / content -->

</div><!-- End / wrapper -->


	<!-- Start footer -->
<?php

	include('footer.php');
?>
	<!-- End / Page wrap -->

	<script type='text/javascript' src='js/jquery.js'></script>
	<script type='text/javascript' src='js/jquery.themepunch.tools.min.js'></script>
	<script type='text/javascript' src='js/jquery.themepunch.revolution.min.js'></script> 
	<script type="text/javascript" src="js/slideshow-homepage1791.js"></script>
	<script type='text/javascript' src='js/bootstrap.min.js'></script>
	<script type='text/javascript' src='js/jquery.appear.min.js'></script>
	<script type='text/javascript' src='js/jquery.owl.carousel.js'></script>
	<script type='text/javascript' src='js/easyResponsiveTabs.js?'></script>
	<script type='text/javascript' src='js/custom.js'></script>
	<script type='text/javascript' src='js/scripts.js'></script>
	<script type="text/javascript" src="js/jovensprofissionais.js"></script>   
</body>
</html>