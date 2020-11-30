<style>
@media (max-width:1920px){
#grafico<?php echo $handleComponente; ?> {
	max-width: 1920px;
	width: 1860px;
	margin: 0 auto;
}
}
@media (max-width:1840px){
#grafico<?php echo $handleComponente; ?> {
	max-width: 1840px;
	width: 1760px;
	margin: 0 auto;
}
}
@media (max-width:1780px){
#grafico<?php echo $handleComponente; ?> {
	max-width: 1780px;
	width: 1680px;
	margin: 0 auto;
}
}
@media (max-width:1640px){
#grafico<?php echo $handleComponente; ?> {
	max-width: 1640px;
	width: 1540px;
	margin: 0 auto;
}
}
@media (max-width:1480px){
#grafico<?php echo $handleComponente; ?> {
	max-width: 1480px;
	width: 1380px;
	margin: 0 auto;
}
}
@media (max-width:1366px){
#grafico<?php echo $handleComponente; ?> {
	max-width: 1366px;
	width: 1260px;
	margin: 0 auto;
}
}
@media (max-width:1280px){
#grafico<?php echo $handleComponente; ?> {
	max-width: 1280px;
	width: 1180px;
	margin: 0 auto;
}
}
@media (max-width:991px){
#grafico<?php echo $handleComponente; ?> {
	max-width: 991px;
	width: 840px;
	margin: 0 auto;
}
}
@media (max-width:780px){
#grafico<?php echo $handleComponente; ?> {
	max-width: 780px;
	width:720px;
	margin: 0 auto;
}
}
@media (max-width:640px){
#grafico<?php echo $handleComponente; ?> {
	max-width: 640px;
	width:560px;
	margin: 0 auto;
}
}
@media (max-width:540px){
#grafico<?php echo $handleComponente; ?> {
	max-width: 470px;
	width:440px;
	margin: 0 auto;
}
}
@media (max-width:380px){
#grafico<?php echo $handleComponente; ?> {
	max-width: 380px;
	width:320px;
	margin: 0 auto;
}
}
</style>
<div class="item <?php echo $active; ?> componente">
<div class="<?php echo $colGrid; ?> item chrt-page-grids" id="teste<?php echo $handleComponente; ?>">
        <!-- Default panel contents -->
        <div class="panel-heading">
              <label class="mobileHide text-left"><?php echo $nomeComponente; ?></label>
              <label class="desktopHide text-left"><?php echo $nomeComponente; ?></label>
              <a id="fechar<?php echo $handleComponente; ?>" class="mobileHide"><i id="iconeFechar<?php echo $handleComponente; ?>" class="fa fa-times"></i></a>
              <a id="maximizar<?php echo $handleComponente; ?>" class="maximize mobileHide"><i class="fa fa-window-maximize"></i></a>
              <a onClick="window.location.reload();return false;" class="mobileHide"  id="atualizar<?php echo $handleComponente; ?>"><i class="fa fa-retweet"></i></a>
        </div>
<script>
    
</script>
        <div class="panel-body" id="painel<?php echo $handleComponente; ?>">
            <div>
<?php
if($tipografico == '1'){
?>
<div id="grafico<?php echo $handleComponente; ?>"></div>
<?php
include('../../controller/dashboard/painelGraficoColunaController.php');

}// tipografico 1

else if($tipografico == '2'){
?>
<div id="grafico<?php echo $handleComponente; ?>"></div>

<?php
include('../../controller/dashboard/painelGraficoColunaEmpinhadaController.php');

}// tipografico 2

else if($tipografico == '3'){
?>
<div id="grafico<?php echo $handleComponente; ?>"></div>

<?php
include('../../controller/dashboard/painelGraficoLinhaController.php');
}// tipografico 3

else if($tipografico == '4'){
?>
<div id="grafico<?php echo $handleComponente; ?>"></div>

<?php
include('../../controller/dashboard/painelGraficoBarraController.php');
}// tipografico 4

else if($tipografico == '5'){
?>
<div id="grafico<?php echo $handleComponente; ?>"></div>

<?php
include('../../controller/dashboard/painelGraficoBarraEmpilhadaController.php');
}// tipografico 5

else if($tipografico == '6'){
?>

 <div id="grafico<?php echo $handleComponente; ?>"></div>
<?php
include('../../controller/dashboard/painelGraficoPieController.php');

}// tipografico 6

else if($tipografico == '7'){
?>
<div id="grafico<?php echo $handleComponente; ?>"></div>

<?php
include('../../controller/dashboard/painelGraficoAreaController.php');
}// tipografico 7

else if($tipografico == '8'){
?>
<div id="grafico<?php echo $handleComponente; ?>"></div>

<?php
include('../../controller/dashboard/painelGraficoAreaEmpilhadaController.php');
}// tipografico 8
?>
</div>
        </div>
    </div>

</div>
<script>
//função fechar painel componente
(function() {
	
$("a#fechar<?php echo $handleComponente; ?>").click(function(){
	if( !$("div#painel<?php echo $handleComponente; ?>").hasClass("display") ){
		$("div#painel<?php echo $handleComponente; ?>").addClass("display");
		$("a#maximizar<?php echo $handleComponente; ?>").addClass("display");
		$("a#atualizar<?php echo $handleComponente; ?>").addClass("display");
		$("i#iconeFechar<?php echo $handleComponente; ?>").removeClass("fa-times");
		$("i#iconeFechar<?php echo $handleComponente; ?>").addClass("fa-window-restore");
	}
	else{
		$("div#painel<?php echo $handleComponente; ?>").removeClass("display");
		$("a#maximizar<?php echo $handleComponente; ?>").removeClass("display");
		$("a#atualizar<?php echo $handleComponente; ?>").removeClass("display");
		$("i#iconeFechar<?php echo $handleComponente; ?>").removeClass("fa-window-restore");
		$("i#iconeFechar<?php echo $handleComponente; ?>").addClass("fa-times");
	}
});

})(jQuery);
</script>