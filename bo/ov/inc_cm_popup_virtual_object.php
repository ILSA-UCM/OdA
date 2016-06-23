<?

?>

<script>
	function capturaCadena_campovirtual_object() {
		var f = document.formulario;
		var nodo = getElement("campovirtual_object_1_span");		
		var strHtml = nodo.innerHTML;
		nodo = getElement("campovirtual_object_1_href");
		<? if (count($campos)>0) { ?>
			idCampos=2;
			nuevoCampo( nodo,"campovirtual_object",strHtml);
		<? } ?>
		<? for ($i=0;$i<count($campos);$i++) { ?>
			f.campovirtual_object_<?= $i+2 ?>_id.value="<?= $campos[$i]->id ?>";
			f.campovirtual_object_<?= $i+2 ?>_ispublic.value="<?= $campos[$i]->ispublic ?>";
			f.campovirtual_object_<?= $i+2 ?>_name.value="<?= $campos[$i]->name ?>";
			
			<? if ($i!=count($campos)-1) { ?>
				nuevoCampo( nodo,"campovirtual_object",strHtml);
			<? } ?>
		<? } ?>		
	}

</script>

<TABLE  border="0" width="460" cellpadding="0" cellspacing="0" style="border-top:1px solid #CCCCCC;border-left:1px solid #CCCCCC;border-right:1px solid #CCCCCC;">
	<TR>
		<TD height="24" align="left" background="img/backoffice_fondo_cab_tabla.jpg">
		&nbsp;<B>Datos de virtual_object</B></TD>		
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
							<div id=campovirtual_object_1_span style="display:none">
								<input type="hidden" name="campovirtual_object_1" value="">
								<input type="hidden" name="campovirtual_object_1_id" value="">
<table width="460" border="0" cellpadding="3" cellspacing="1"  style="border:1px solid #CCCCCC;">

		<tr bgcolor="#FFFFFF" valign="top">
		<td width="140" class="popuptitcampo">
			Ispublic:
		</td>
		<td width="320" class="popupcampo">
			<input type="checkbox" name="campovirtual_object_1_ispublic" value="S" <? if ($fila->ispublic=="S") print "checked"; ?> onchange="cambio(this)">
		</td>
	</tr>
		<tr bgcolor="#FFFFFF" valign="top">
		<td width="140" class="popuptitcampo">
			Name:
		</td>
		<td width="320" class="popupcampo">
			<input name="campovirtual_object_1_name" type="text" size="40" maxlength="255" value="<?= $visit->util->encapsulaInput( $fila->name) ?>" onchange="cambio(this)">
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
							<a  id='campovirtual_object_1_href' href='#' onclick="
							nuevoCampo(this,'campovirtual_object',getElement('campovirtual_object_1_span').innerHTML);
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
