<div>
			<div>
				<? if ($filas[$i]->imagen!="") {?>
						<IMG SRC="<?= $visit->util->getUrlArchivo($filas[$i]->imagen)?>"    BORDER="0" ALT="<?= $visit->util->getNombreArchivo($filas[$i]->imagen)?>"><br>										
				<? } ?>					
					<?= $filas[$i]->titulo?>
					<BR>
					<?= $filas[$i]->contenido?>								
				<div class="clearfix"></div>
			</div>
			<div>
				<? if ($filas[$i]->imagen2!="") {?>
					<IMG SRC="<?= $visit->util->getUrlArchivo($filas[$i]->imagen2)?>"    BORDER="0" ALT="<?= $visit->util->getNombreArchivo($filas[$i]->imagen2)?>"><br>										
				<? } ?>
				<?= $filas[$i]->titulo2?>
				<BR>
				<?= $filas[$i]->contenido2?>								

			</div>
	 
</div>