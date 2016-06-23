<div>
	<? if ($filas[$i]->imagen!="") {?>
				<IMG SRC="<?= $visit->util->getUrlArchivo($filas[$i]->imagen)?>"    BORDER="0" ALT="<?= $visit->util->getNombreArchivo($filas[$i]->imagen)?>" width="<?= $prefs["tam_ancho_interior_contenidos"]?>"><br>										

	<? } ?>
	
</div>
	 
