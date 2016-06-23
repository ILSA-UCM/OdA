<?
$visit->options->paginacion=20;
if ($dict["paginacion"]!="") $visit->options->paginacion=$dict["paginacion"];
?>
	<?
		include("theme.php");
	?>
	

	<FORM METHOD=GET ACTION="<?= $visit->util->getNombreArchivo( $visit->util->getScriptName() ) ?>" name="formlistado" style="display:inline;">
		<input type="hidden" name="paginacion" value="<?= $visit->options->paginacion ?>">

		<INPUT TYPE="text" NAME="q" class="inputmediofiltro" value="<?= $visit->options->busquedaGeneral ?>">
		<input type="image" SRC="img/gw_ico_buscar.gif" WIDTH="22" HEIGHT="17" BORDER="0" ALT="">

		<TABLE width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
			<TR>
				<TD width="200" valign="bottom" align="left">
					<TABLE width="200" border="0" cellpadding="0" cellspacing="0"  background="img/filtros_tit_fondo.gif" style="border-left:1px solid #B1B1B1;border-right:1px solid #B1B1B1;border-top:1px solid #B1B1B1;" > 		
						<TR>
							<TD width="11"><IMG SRC="img/filtros_bullet_titulos.gif" WIDTH="11" HEIGHT="19" BORDER="0" ALT=""></TD>
							<TD valign="middle" width="130"  nowrap><span class="titcuadro">Listado de section_data</span></TD>
							<TD width="3"><IMG SRC="img/pc.gif" WIDTH="3" HEIGHT="17" BORDER="0" ALT=""></TD>						
						</TR>	
					</TABLE>				
				</TD>
				<TD align="center" valign="bottom">
					
				</TD>
				
			</TR>
		</TABLE>

		<TABLE  border="0" width="100%" cellpadding="0" cellspacing="0" style="border:1px solid #CCCCCC;">
			<TR>
				<TD width="30%" height="24" align="left"  background="img/backoffice_fondo_cab_tabla.jpg">&nbsp;[<?= $inicio ?>-<?= $visit->util->muestrahastareg($visit->options->paginacion,$count,$npag) ?>] de <?= $count ?>&nbsp;
					<? $valoresPaginacion=explode(",","20,40,60,100,200,400"); ?>
					<select name ="paginacion"  class="selectpeque" style="width:60px;" onChange="window.location.href=construyeUrlMenosMas(window.location.href,'paginacion,npag','paginacion='+this.value)" >
						<? for ($i=0;$i<count($valoresPaginacion);$i++) { ?>
							<option value="<?= $valoresPaginacion[$i] ?>" <? if ($visit->options->paginacion==$valoresPaginacion[$i]) print "selected"; ?>><?= $valoresPaginacion[$i] ?>
						<? } ?>
						<option value ="999999" <? if ($paginacion=="999999") echo "selected"; ?> >Todas
					</select>
				</TD>
				
				<TD width="40%" nowrap background="img/backoffice_fondo_cab_tabla.jpg" align="center">
				
				<? $visit->util->imprimirPaginacion($visit->options->paginacion, $visit->options->maxPaginasSiguientes, $count, $npag, $urlName); ?>
				
				</TD>
				<TD width="30%" align="right" valign="bottom" background="img/backoffice_fondo_cab_tabla.jpg">
				<a href="cm_form_section_data.php?<?= $nombreCampoRelacionado ?>=<?= $fila->id ?>"><IMG SRC="img/boton_nuevo.gif" WIDTH="77" HEIGHT="21" BORDER="0" ALT=""></a>
				&nbsp;				
				</TD>
			</TR>
		</TABLE>
</FORM>
<form name="form_generacion" action="do.php" method="POST"  style="display:inline;">

<TABLE class="lstabla" width="100%" cellpadding="0" cellspacing="0">
	<!-- CAMPOS -->
	<TR>
		<TD width="20" class="lscabecera"><INPUT TYPE="checkbox" NAME="checkboxtotal" onClick="selectAll(document.form_generacion,this.checked==true)"></TD>
		<TD class="lscabecera" >
			<!-- CAMPO -->
			<TABLE  border="0" cellpadding="0" cellspacing="0">
				<TR>
						<TD nowrap 
							<? if ($orden=="nombre") { ?>
								class="camposlsactivo"
							<? } else { ?>
								class="camposls"
							<? } ?>
							>Nombre&nbsp;</TD>
						<TD nowrap ><A HREF="<?= $visit->util->concatenaUrl($urlOrden,"orden=nombre&orden_tipo=DESC") ?>"><IMG SRC="
							<? if ($ordenar=="nombre DESC"){ 
								echo 'img/ls_flecha_arriba_sobre.gif';
							} else { 
								echo 'img/ls_flecha_arriba_normal.gif';
							} ?>
							" WIDTH="13" HEIGHT="6" BORDER="0" ALT=""></A><BR><A HREF="<?= $visit->util->concatenaUrl($urlOrden,"orden=nombre&orden_tipo=ASC") ?>"><IMG SRC="
							<? if ($ordenar=="nombre ASC"){ 
								echo 'img/ls_flecha_abajo_sobre.gif';
							} else { 
								echo 'img/ls_flecha_abajo_normal.gif';
							}
							?>" WIDTH="13" HEIGHT="6" BORDER="0" ALT=""></A></TD>
					</TR>
			</TABLE>				
			<!-- FIN CAMPO -->
		</TD>
				<TD class="lscabecera" >
			<!-- CAMPO -->
			<TABLE  border="0" cellpadding="0" cellspacing="0">
				<TR>
						<TD nowrap 
							<? if ($orden=="visible") { ?>
								class="camposlsactivo"
							<? } else { ?>
								class="camposls"
							<? } ?>
							>Visible&nbsp;</TD>
						<TD nowrap ><A HREF="<?= $visit->util->concatenaUrl($urlOrden,"orden=visible&orden_tipo=DESC") ?>"><IMG SRC="
							<? if ($ordenar=="visible DESC"){ 
								echo 'img/ls_flecha_arriba_sobre.gif';
							} else { 
								echo 'img/ls_flecha_arriba_normal.gif';
							} ?>
							" WIDTH="13" HEIGHT="6" BORDER="0" ALT=""></A><BR><A HREF="<?= $visit->util->concatenaUrl($urlOrden,"orden=visible&orden_tipo=ASC") ?>"><IMG SRC="
							<? if ($ordenar=="visible ASC"){ 
								echo 'img/ls_flecha_abajo_sobre.gif';
							} else { 
								echo 'img/ls_flecha_abajo_normal.gif';
							}
							?>" WIDTH="13" HEIGHT="6" BORDER="0" ALT=""></A></TD>
					</TR>
			</TABLE>				
			<!-- FIN CAMPO -->
		</TD>
								<TD class="lscabecera">
			<!-- CAMPO -->
			<TABLE  border="0" cellpadding="0" cellspacing="0">
				<TR>								
					<TD nowrap class="camposls">Orden&nbsp;</TD>
					<TD nowrap ><A HREF="<?= $urlOrden ?>&orden=orden&orden_tipo=DESC"><IMG SRC="
					<? if ($ordenar=="orden DESC"){ 
						echo 'img/ls_flecha_arriba_sobre.gif';
					} else { 
						echo 'img/ls_flecha_arriba_normal.gif';
					} ?>
					" WIDTH="13" HEIGHT="6" BORDER="0" ALT=""></A><BR><A HREF="<?= $urlOrden ?>&orden=orden>&orden_tipo=ASC"><IMG SRC="
					<? if ($ordenar=="nom_cuenta ASC"){ 
						echo 'img/ls_flecha_abajo_sobre.gif';
					} else { 
						echo 'img/ls_flecha_abajo_normal.gif';
					}
					?>" WIDTH="13" HEIGHT="6" BORDER="0" ALT=""></A></TD>					 
				</TR>
			</TABLE>	
			<!-- FIN CAMPO -->
		</TD>
		<td class="lscabecera">
			&nbsp;
		</td>
	</tr>
<!-- FILTROS -->
<!-- FILTROS -->
<!-- FILTROS -->
	
	<TR>
		<TD width="20" class="lscabecerafiltros">&nbsp;</TD>
			
		<TD class="lscabecerafiltros" >			
						&nbsp;
						
		</TD>
					
		<TD class="lscabecerafiltros" >			
						&nbsp;
						
		</TD>
								<TD class="lscabecerafiltros">&nbsp;</TD>
		<td class="lscabecerafiltros">&nbsp;</td>
	</tr>

<!-- FIN FILTROS -->
<!-- FIN FILTROS -->
<!-- FIN FILTROS -->


	<? for ($i=0;$i<count($filas);$i++) { ?>
	<?
		if ( ($i % 2) != 0 ) {
			$lsregistros="lsregistrospar";
		} else {
			$lsregistros="lsregistrosimpar";
		}
	?>
		<tr>
		<TD  class="<?= $lsregistros ?>" width="20"><INPUT TYPE="checkbox" name="set_" value="S"></TD>
<TD width="13" class="<?= $lsregistros ?>"><a href="cm_form_section_data.php?id=<?= $filas[$i]->id ?>"><IMG SRC="img/ico_editar.gif" WIDTH="13" HEIGHT="16" BORDER="0" ALT=""></a></TD>
					<TD class="<?= $lsregistros ?>"><?= $filas[$i]->nombre ?></TD>
			<TD class="<?= $lsregistros ?>">
					<? if ($filas[$i]->visible=="S"){  ?> 
							<IMG SRC="img/ico_checked_si.gif" WIDTH="12" HEIGHT="12" BORDER="0" ALT="">  
					<?	}else{ ?>
							<IMG SRC="img/ico_checked_no.gif" WIDTH="12" HEIGHT="12" BORDER="0" ALT="">
					<? } ?>
			</TD>
			<TD class="<?= $lsregistros ?>">
				<A HREF="do.php?op=mover_section_data&id=<?= $filas[$i]->id ?>&valor=1"><IMG SRC="img/flecha_up.gif" WIDTH="16" HEIGHT="16" BORDER="0" ALT=""></A>
				<A HREF="do.php?op=mover_section_data&id=<?= $filas[$i]->id ?>&valor=-1"><IMG SRC="img/flecha_down.gif" WIDTH="16" HEIGHT="16" BORDER="0" ALT=""></A>
			</td>
			<TD class="<?= $lsregistros ?>">		
				<A HREF="#" onclick="
				if (confirm('<?=utf8_encode("¿Seguro que desea eliminar el elemento?")?>')) {
					window.location.href='do.php?op=eliminar_section_data&id=<?= $filas[$i]->id ?>';
				}
				return false;"><IMG SRC="img/ico_eliminar.gif" WIDTH="14" HEIGHT="16" BORDER="0" ALT=""></A>
			</td>
		</tr>
	<? } ?>
</table>
<TABLE  width="100%" cellpadding="0" cellspacing="0" style="border:1px solid #CCCCCC;">
	<TR>
		<TD width="30%" height="24" align="left"  background="img/backoffice_fondo_cab_tabla.jpg">&nbsp;[<?= $inicio ?>-<?= $visit->util->muestrahastareg($visit->options->paginacion,$count,$npag) ?>] de <?= $count ?>&nbsp;
			<? $valoresPaginacion=explode(",","20,40,60,100,200,400"); ?>
		</TD>
		
		<TD width="40%" nowrap background="img/backoffice_fondo_cab_tabla.jpg" align="center">
		
		<? $visit->util->imprimirPaginacion($visit->options->paginacion, $visit->options->maxPaginasSiguientes, $count, $npag, $urlName); ?>
		
		</TD>
		<TD width="30%" align="right" valign="bottom" background="img/backoffice_fondo_cab_tabla.jpg">
		<a href="cm_form_section_data.php"><IMG SRC="img/boton_nuevo.gif" WIDTH="77" HEIGHT="21" BORDER="0" ALT=""></a>
		&nbsp;				
		</TD>
	</TR>
</TABLE>
