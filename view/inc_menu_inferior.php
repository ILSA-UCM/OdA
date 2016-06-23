<!-- INCLUDE SECCIONES BACKOFFICE -->
<table cellspacing="0" cellpadding="0" >
	<tr>
		<? for ($i=0;$i<count($navInferior);$i++) {?>
			<?	
				$enlace = $visit->util->getEnlaceFromMenu($navInferior[$i],$menu);
				if ($menu==$navInferior[$i]->idlangprincipal) {
					$class="menuinferiorover";											
				} else {
					$class="menuinferior"; 
				} 
			?>
			<td class="<?= $class ?>" onmouseover="this.className='menuinferiorover';"	onmouseout="this.className='<?= $class ?>';">
				<A HREF="<?= $enlace?>" class="menuinferiornav" <? if ($navInferior[$i]->ventanaexterna=="S") print 'target=_blank'?>>
					<?= $navInferior[$i]->nombre?>
				</A>
			</td>  
		<? } ?>
	</tr>
</table>
<!-- FIN INCLUDE SECCIONES BACKOFFICE -->
