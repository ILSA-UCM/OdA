<!-- <FORM METHOD=POST ACTION="" NAME="formlistado">-->
 	
	<? if ( $count!="0" ){?>				
	<table width="100%" cellspacing="0" cellpadding="0">
		<tr>
			<td width="33%" class="paginacion" align="left">[<?= $inicio ?>-<?= $visit->util->muestrahastareg($visit->options->paginacion,$count,$npag) ?>] de <?= $count ?></td>
			<? $visit->util->imprimirPaginacionArticulos($visit->options->paginacion, $visit->options->maxPaginasSiguientes, $count, $npag, $urlName); ?>
		</tr>
		
	</table>
	<img src="img/pc.gif" width="1" height="8" border="0" alt=""><BR>
	<? } ?>