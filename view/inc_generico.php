<? $menuActualLang = $visit->dbBuilder->getNavegacionId($id);?>
<? if($menuActualLang->nombre!= "") {
	$titulopag =  " > ". $menuActualLang->nombre;
}?>
<div class = "titulopagina"> 	<?   print $visit->util->migaspan($idpadre,$migas); ?><?//= $titulopag?></div>

<TABLE cellpadding="2" cellspacing="2" width="100%">
	
	<!-- MAQUETAR -->


	<? if($menuActualLang->nombre!="" && $menuActualLang->tiene_contenido=="N"){ ?>
		<? if($menuActualLang->imagen!=""){ ?>
		<TR>
			<TD>
				<IMG SRC="<?= $visit->util->getUrlArchivo(substr($menuActualLang->imagen,3,strlen($menuActualLang->imagen)))?>" WIDTH="" BORDER="0" ALT="<?= $visit->util->getNombreArchivo($menuActualLang->imagen)?>">
			</TD>
		</TR>
		<? } ?>
		
	<? } ?>
		<!--  -->

		<? if($menuActualLang->contenido!=""){ ?>
		<TR>
			<TD class="contenidopagina">
				<p><?= $menuActualLang->contenido?></p>
			</TD>
		</TR>	
	<? } ?>
	
</TABLE>