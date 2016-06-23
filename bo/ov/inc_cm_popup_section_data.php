<?

?>

<script>
	function capturaCadena_camposection_data() {
		var f = document.formulario;
		var nodo = getElement("camposection_data_1_span");		
		var strHtml = nodo.innerHTML;
		nodo = getElement("camposection_data_1_href");
		<? if (count($campos)>0) { ?>
			idCampos=2;
			nuevoCampo( nodo,"camposection_data",strHtml);
		<? } ?>
		<? for ($i=0;$i<count($campos);$i++) { ?>
			f.camposection_data_<?= $i+2 ?>_id.value="<?= $campos[$i]->id ?>";
			f.camposection_data_<?= $i+2 ?>_idpadre.value="<?= $campos[$i]->idpadre ?>";
			f.camposection_data_<?= $i+2 ?>_nombre.value="<?= $campos[$i]->nombre ?>";
			f.camposection_data_<?= $i+2 ?>_codigo.value="<?= $campos[$i]->codigo ?>";
			f.camposection_data_<?= $i+2 ?>_tooltip.value="<?= $campos[$i]->tooltip ?>";
			f.camposection_data_<?= $i+2 ?>_visible.value="<?= $campos[$i]->visible ?>";
			f.camposection_data_<?= $i+2 ?>_orden.value="<?= $campos[$i]->orden ?>";
			f.camposection_data_<?= $i+2 ?>_lang.value="<?= $campos[$i]->lang ?>";
			f.camposection_data_<?= $i+2 ?>_idlangprincipal.value="<?= $campos[$i]->idlangprincipal ?>";
			f.camposection_data_<?= $i+2 ?>_browseable.value="<?= $campos[$i]->browseable ?>";
			f.camposection_data_<?= $i+2 ?>_tipo_valores.value="<?= $campos[$i]->tipo_valores ?>";
			
			<? if ($i!=count($campos)-1) { ?>
				nuevoCampo( nodo,"camposection_data",strHtml);
			<? } ?>
		<? } ?>		
	}

</script>

<TABLE  border="0" width="460" cellpadding="0" cellspacing="0" style="border-top:1px solid #CCCCCC;border-left:1px solid #CCCCCC;border-right:1px solid #CCCCCC;">
	<TR>
		<TD height="24" align="left" background="img/backoffice_fondo_cab_tabla.jpg">
		&nbsp;<B>Modelo de datos</B></TD>		
	</TR>
</TABLE>

<TABLE width="100%" border="0" cellpadding="0" cellspacing="0" >

	<TR>
		<TD width="100%" colspan="2"  align="center" height="4"></TD>
	</TR>
	<tr>
		<td colspan="2">			
				<table border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td>
							<div id=camposection_data_1_span style="display:none">
								<input type="hidden" name="camposection_data_1" value="">
								<input type="hidden" name="camposection_data_1_id" value="">
<table width="460" border="0" cellpadding="3" cellspacing="1"  style="border:1px solid #CCCCCC;">

		<tr bgcolor="#FFFFFF" valign="top">
		<td width="140" class="popuptitcampo">
			Idpadre:
		</td>
		<td width="320" class="popupcampo">
			<input name="camposection_data_1_idpadre" type="text" size="40" maxlength="255" value="<?= $visit->util->encapsulaInput( $fila->idpadre) ?>" onchange="cambio(this)">
		</td>
	</tr>
		<tr bgcolor="#FFFFFF" valign="top">
		<td width="140" class="popuptitcampo">
			Nombre:
		</td>
		<td width="320" class="popupcampo">
			<input name="camposection_data_1_nombre" type="text" size="40" maxlength="255" value="<?= $visit->util->encapsulaInput( $fila->nombre) ?>" onchange="cambio(this)">
		</td>
	</tr>
		<tr bgcolor="#FFFFFF" valign="top">
		<td width="140" class="popuptitcampo">
			Codigo:
		</td>
		<td width="320" class="popupcampo">
			<input name="camposection_data_1_codigo" type="text" size="40" maxlength="255" value="<?= $visit->util->encapsulaInput( $fila->codigo) ?>" onchange="cambio(this)">
		</td>
	</tr>
		<tr bgcolor="#FFFFFF" valign="top">
		<td width="140" class="popuptitcampo">
			Tooltip:
		</td>
		<td width="320" class="popupcampo">
			<input name="camposection_data_1_tooltip" type="text" size="40" maxlength="255" value="<?= $visit->util->encapsulaInput( $fila->tooltip) ?>" onchange="cambio(this)">
		</td>
	</tr>
		<tr bgcolor="#FFFFFF" valign="top">
		<td width="140" class="popuptitcampo">
			Visible:
		</td>
		<td width="320" class="popupcampo">
			<input type="checkbox" name="camposection_data_1_visible" value="S" <? if ($fila->visible=="S") print "checked"; ?> onchange="cambio(this)">
		</td>
	</tr>
		<tr bgcolor="#FFFFFF" valign="top">
		<td width="140" class="popuptitcampo">
			Orden:
		</td>
		<td width="320" class="popupcampo">
			<input name="camposection_data_1_orden" type="text" size="40" maxlength="255" value="<?= $visit->util->encapsulaInput( $fila->orden) ?>" onchange="cambio(this)">
		</td>
	</tr>
		<tr bgcolor="#FFFFFF" valign="top">
		<td width="140" class="popuptitcampo">
			Lang:
		</td>
		<td width="320" class="popupcampo">
			<input name="camposection_data_1_lang" type="text" size="40" maxlength="255" value="<?= $visit->util->encapsulaInput( $fila->lang) ?>" onchange="cambio(this)">
		</td>
	</tr>
		<tr bgcolor="#FFFFFF" valign="top">
		<td width="140" class="popuptitcampo">
			Idlangprincipal:
		</td>
		<td width="320" class="popupcampo">
			<input name="camposection_data_1_idlangprincipal" type="text" size="40" maxlength="255" value="<?= $visit->util->encapsulaInput( $fila->idlangprincipal) ?>" onchange="cambio(this)">
		</td>
	</tr>
		<tr bgcolor="#FFFFFF" valign="top">
		<td width="140" class="popuptitcampo">
			Browseable:
		</td>
		<td width="320" class="popupcampo">
			<input type="checkbox" name="camposection_data_1_browseable" value="S" <? if ($fila->browseable=="S") print "checked"; ?> onchange="cambio(this)">
		</td>
	</tr>
		<tr bgcolor="#FFFFFF" valign="top">
		<td width="140" class="popuptitcampo">
			Tipo_valores:
		</td>
		<td width="320" class="popupcampo">
			<? $valores = $fila->getValoresTipoValores(); ?>
				<select name="camposection_data_1_tipo_valores" onchange="cambio(this)" class="lsselectsfiltro">
					<option value="">- 
					<? while (list ($clave, $val) = each ($valores)) { ?>
						<option value="<?= $clave ?>" <? if ($clave==$fila->tipo_valores) print "selected"; ?>><?= $val ?>
					<? } ?></select>
		</td>
	</tr>
</table>


									<a href="#" onclick="
										return eliminarCampo(this);">
										<IMG SRC="img/ico_menos.gif" WIDTH="9" HEIGHT="9" BORDER="0" ALT="">
									</a>								
							</div>
						</td>
					</tr>
					
					<tr>
						<td valign="bottom" align="left">
							<IMG SRC="img/cpb" WIDTH="3" HEIGHT="1" BORDER="0" ALT="">
							<a  id='camposection_data_1_href' href='#' onclick="
							nuevoCampo(this,'camposection_data',getElement('camposection_data_1_span').innerHTML);
							return false;">
								<IMG SRC="img/ico_mas.gif" WIDTH="9" HEIGHT="9" BORDER="0" ALT="">
							</a>
						</td>
					</tr>
				</table>
			
		</td>
	</tr>

</TABLE>

<BR>
