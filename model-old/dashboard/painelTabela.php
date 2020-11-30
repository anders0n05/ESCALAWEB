<div class="item <?php echo $active; ?> componente">
<div class="<?php echo $colGrid; ?> item chrt-page-grids">
                    
                      <!-- Default panel contents -->
                      <div class="panel-heading">
                      <label class="mobileHide text-left"><?php echo $nomeComponente; ?></label>
                      <label class="desktopHide text-left"><?php echo $nomeComponente; ?></label>
                      <a id="fechar<?php echo $handleComponente; ?>" class="mobileHide"><i id="iconeFechar<?php echo $handleComponente; ?>" class="fa fa-times"></i></a>
                      <a id="maximizar<?php echo $handleComponente; ?>" class="maximize mobileHide"><i class="fa fa-window-maximize"></i></a>
                      <a onClick="window.location.reload();return false;" class="mobileHide"  id="atualizar<?php echo $handleComponente; ?>"><i class="fa fa-retweet"></i></a>
                      </div>
                      <div class="panel-body" id="painel<?php echo $handleComponente; ?>">
                      <div class="row">
						<table id="<?php echo $handleComponente; ?>" class="displayTable dataTable table table-responsive Loadtable" role="grid" cellspacing="0" width="100%" border="0">
                          <thead>
                            <tr>
<?php 
//echo $handleComponente;

$colunas = $connect->query($sqlComponente);

for ($i = 0; $i < $colunas->columnCount(); $i++) {
    $col = $colunas->getColumnMeta($i);
    $columns[] = ucfirst(strtolower($col['name']));
	echo '<td>'.str_replace('_',' ', $columns[$i]).'</td>';
}
//print_r($columns);
$columns = null;
?>
                            </tr>
                           </thead>
                           <tfoot>
                           </tfoot>
                        </table>
                      </div>
					</div>
				
</div>
</div>
<script>

$(document).ready(function() {
	
$.ajaxSetup({ cache: false });

$("table#<?php echo $handleComponente; ?>").DataTable({
		"bDestroy": true,
		"paging": true,
		"language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.13/i18n/Portuguese-Brasil.json"
        },
		"info": false,
		"searching": false,
		"responsive": true,
		//"bAutoWidth": false,
		"bProcessing": true,
		"sServerMethod": "GET",
		"sAjaxSource": "../../controller/dashboard/painelTabelaController.php",
		"fnServerParams": function ( aoData )   
		{  
			aoData.push( { "name": "handleComponente", "value": "<?php echo $handleComponente; ?>" } );
		} ,
		"bJQueryUI": true,
		"sAjaxDataProp" : "",
		"aoColumns": [			
			<?php
			for ($i = 0; $i < $colunas->columnCount(); $i++) {
				$col = $colunas->getColumnMeta($i);
				$columns[] = $col['name'];
				echo '{"mDataProp": "'.$columns[$i].'", render: $.fn.dataTable.render.number(".", ",", 2, "")},';
			}
			$columns = null;
			?>
		]
});

} );

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