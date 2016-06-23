

<?if ($count!=0){?>
<TABLE  border="0" width="100%" cellpadding="4" cellspacing="0"  style="border-left:1px solid #CCCCCC;border-right:1px solid #CCCCCC; ">
		<TR >
			
			<!-- <TD bgcolor="#F5F2C9" width="20" class="lscabecera"><INPUT TYPE="checkbox" NAME="checkboxtotal" onClick="selectAll(this.checked==true)"></TD> -->

			<TD bgcolor="#F5F2C9" valign="middle" align="left" height="22" style="border-top:1px solid #FFFFFF;border-bottom:1px solid #FFFFFF;border-left:1px solid #FFFFFF;">
			<TABLE  border="0"  cellpadding="0" cellspacing="0" >
				<TR>
					<TD nowrap class="popuplstitulo"><?=utf8_encode("Imágenes")?>&nbsp;</TD>
				</TR>
			</TABLE>
			</TD>
			<TD bgcolor="#F5F2C9" valign="middle" align="left" height="22" style="border-top:1px solid #FFFFFF;border-bottom:1px solid #FFFFFF;border-left:1px solid #FFFFFF;">
			<TABLE  border="0"  cellpadding="0" cellspacing="0" >
			<TR>
					<TD nowrap class="popuplstitulo">Pie de Imagen&nbsp;</TD>
				</TR>
			</TABLE>
			</TD>
			<TD bgcolor="#F5F2C9" valign="middle" align="left" height="22" style="border-top:1px solid #FFFFFF;border-bottom:1px solid #FFFFFF;border-left:1px solid #FFFFFF;">
			<TABLE  border="0"  cellpadding="0" cellspacing="0" >
			<TR>
					<TD nowrap class="popuplstitulo">Orden&nbsp;</TD>
				
			</TR>
			</TABLE>
			</TD>
			<TD bgcolor="#F5F2C9" valign="middle" align="left" height="22" style="border-top:1px solid #FFFFFF;border-bottom:1px solid #FFFFFF;border-left:1px solid #FFFFFF;">
			<TABLE  border="0"  cellpadding="0" cellspacing="0" >
			<TR>
					<TD nowrap class="popuplstitulo">URL Asociada&nbsp;</TD>
		
			</TR>
			</TABLE>
			</TD>
			
		<TD bgcolor="#F5F2C9" style="border-top:1px solid #FFFFFF;border-bottom:1px solid #FFFFFF;border-left:1px solid #FFFFFF;"></TD>
		</TR>

	<? for ($i=0;$i<count($filaimagenes);$i++) { ?>
		<tbody id="filas_listado">
			<tr bgcolor="<? if (($i%2)==0) { $color = $theme_backcolor1; } else { $color =$theme_backcolor2; } print $color; ?>">
				<? 
				if (($i%2)==0) {
					$color = $theme_forecolor1;
				} else {
					$color =$theme_forecolor2;
				}
				?>


				<INPUT TYPE="hidden" NAME="campo_<?=$i?>" value="">
				<INPUT TYPE="hidden" NAME="campo_<?=$i?>_id" value="<?= $filaimagenes[$i]->id?>">
				<INPUT TYPE="hidden" NAME="campo_<?=$i?>_lang" value="<?= $lang?>">
				<INPUT TYPE="hidden" NAME="campo_<?=$i?>_idpaginaimagenes" value="<?= $filaimagenes[$i]->idpaginaimagenes?>">
				<td class="lstextogrid" style="color: <?= $color ?>">
			
					<IMG SRC="<?= $filaimagenes[$i]->imagen ?>" WIDTH="100" BORDER="0" ALT="">
				
				</td>
				<INPUT TYPE="hidden" NAME="campo_<?=$i?>_imagen" value="<?= $filaimagenes[$i]->imagen?>">
				<td  class="lstextogrid" style="color: <?= $color ?>">
				<TEXTAREA NAME="campo_<?=$i?>_titulo"  ROWS="3" COLS="25" ><?= $filaimagenes[$i]->titulo ?></TEXTAREA>
				
				<td  class="lstextogrid" style="color: <?= $color ?>">
				<INPUT TYPE="text" NAME="campo_<?=$i?>_orden" value="<?= $filaimagenes[$i]->orden ?>" ></td>
				
				<td class="lstextogrid" style="color: <?= $color ?>">
				<INPUT TYPE="text" NAME="campo_<?=$i?>_enlace" value="<?= $filaimagenes[$i]->enlace ?>" ></td>
			
	
				<td class="lstextogrid" style="color: <?= $color ?>">
			
					<A HREF="#" onclick="
					if (confirm('<?=utf8_encode("¿Seguro que desea eliminar el elemento?")?>')) {
						window.location.href='do.php?op=eliminar_imagenespaginas&id=<?= $filaimagenes[$i]->id?>&idpaginaimagenes=<?= $id?>';
						return false;
					} else return false;"><IMG SRC="/bo/img/ico_eliminar.gif" WIDTH="14" HEIGHT="16" BORDER="0" ALT=""></A>
				
				</td>
				
				
			</tr>
		</tbody>
	<? } ?>
</table>
<?}else{?>
	<CENTER><B><?=utf8_encode("No existen imágenes asociadas")?></B></CENTER>
<?}?>