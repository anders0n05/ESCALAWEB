<div class="topoMenu"> 
    <div class="row">
        <div class="col-xs-12">                
            <h4 class="titleMenu"> Painel de navegação 
                <button id="showLeftPushClose">x</button>
            </h4>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-3">
            <div class="imgMenu"><img src="../tecnologia/img/usermenu.png" class="img-circle img-responsive"></div>
        </div>
        <div class="col-xs-9">
            <p class="infoMenu"><?php echo $loginUsuario.'<br>'.$papelNome; ?></p>
        </div>
    </div>
</div> 
<ul class="nav" id="side-menu">
	<li>
		<a href="../../view/estrutura/index.php">Principal</a>
	</li>

<?php
$queryMenu = $connect->prepare("SELECT DISTINCT( B.NOME ), B.HANDLE
								  FROM MD_ICONE A
							     INNER JOIN MD_PAINELNAVEGACAO B ON B.HANDLE = A.PAINELNAVEGACAO
							     WHERE A.MODULO = 37
								   AND (A.CLIENTE IS NULL OR A.CLIENTE = 0 OR A.CLIENTE = " . $_SESSION['sistemaCliente'] . ")
								   AND EXISTS (SELECT 1
												 FROM MS_USUARIO X
												INNER JOIN MS_USUARIOPAPEL X1 ON X1.USUARIO = X.HANDLE AND X1.STATUS = 4
												INNER JOIN MS_PAPELICONEPAINELNAVEGACAO X2 ON X2.PAPEL = X1.PAPEL				 
												WHERE X2.DEFINICAOACESSO = 2 
											      AND X.HANDLE = '".$handleUsuario."'
												  AND X2.PAINELNAVEGACAO = A.HANDLE)");
                                                           
$queryMenu->execute();

while ($rowMenu = $queryMenu->fetch(PDO::FETCH_ASSOC)) {
	$agrupadorMenu = $rowMenu['NOME'];
	$agrupadorMenuHandle = $rowMenu['HANDLE']; ?>

	<li>
		<a href="#"><?php echo $agrupadorMenu; ?> <span class="fa arrow"></span></a>
		<ul class="nav nav-second-level collapse">

		<?php
		$queryMenu_filho = $connect->prepare("SELECT A.TITULO, A.COMANDO
												FROM MD_ICONE A
											   INNER JOIN MD_PAINELNAVEGACAO B ON B.HANDLE = A.PAINELNAVEGACAO
										       WHERE A.MODULO = 37
												 AND B.HANDLE = '".$agrupadorMenuHandle."'
												 AND ((A.CLIENTE IS NULL OR A.CLIENTE = 0) OR A.CLIENTE = " . $_SESSION['sistemaCliente'] . ")
											     AND EXISTS (SELECT 1
												               FROM MS_USUARIO X
															  INNER JOIN MS_USUARIOPAPEL X1 ON X1.USUARIO = X.HANDLE
															  INNER JOIN MS_PAPELICONEPAINELNAVEGACAO X2 ON X2.PAPEL = X1.PAPEL				 
															  WHERE X2.DEFINICAOACESSO = 2
															    AND X.HANDLE = '".$handleUsuario."'
															    AND X2.PAINELNAVEGACAO = A.HANDLE)");
																	
	$queryMenu_filho->execute();
		
	while ($rowMenuFilho = $queryMenu_filho->fetch(PDO::FETCH_ASSOC)) {
		$filhoMenu = $rowMenuFilho['TITULO'];
		$comandoMenu = $rowMenuFilho['COMANDO']; ?>
		
		<li>
			<a href="<?php echo $comandoMenu; ?>"><?php echo $filhoMenu; ?></a>
		</li>
	<?php
	} 
	?>
		</ul>
	</li>  
<?php
}
?>
	<li>
		<a href="../../controller/estrutura/logout.php">Sair</a>
	</li>
</ul>