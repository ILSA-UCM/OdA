<!-- INCLUDE SECCIONES BACKOFFICE -->
<table cellspacing="0" cellpadding="0" class="menusuperiortabla">
	<tr>
		<? for ($i=0;$i<count($navSuperior);$i++) {?>
			<?	
			$enlace = $visit->util->getEnlaceFromMenu($navSuperior[$i],$menu);
		
			if ($menu==$navSuperior[$i]->idlangprincipal) {
					
				$class="menusuperiorover";											
			}else {$class="menusuperior"; } ?>

			<td class="<?= $class ?>" onmouseover="this.className='menusuperiorover';"	onmouseout="this.className='<?= $class ?>';"><A HREF="<?= $enlace ?>" class="menusuperiornav" <? if ($navSuperior[$i]->ventanaexterna=="S") print 'target=_blank'?>><?= $navSuperior[$i]->nombre?></A></td>  
		<? } ?>
	</tr>
</table>
<!-- FIN INCLUDE SECCIONES BACKOFFICE -->
