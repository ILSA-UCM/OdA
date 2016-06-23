<div>
	<? if ($filas[$i]->imagen!="") {?>
		<IMG SRC="<?= $visit->util->getUrlArchivo($filas[$i]->imagen)?>"    BORDER="0" ALT="<?= $visit->util->getNombreArchivo($filas[$i]->imagen)?>"><br>										
		
	<? } ?>
		<?= $filas[$i]->contenido?>		
</div>