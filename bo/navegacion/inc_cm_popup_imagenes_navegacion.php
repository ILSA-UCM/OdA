<?

?>

<script>
	function capturaCadena_campoimagenes_navegacion() {
		var f = document.formulario;
		var nodo = getElement("campoimagenesnavegacion_1_span");		
		var strHtml = nodo.innerHTML;
		nodo = getElement("campoimagenesnavegacion_1_href");
		idCampos=2;
		<? if (count($campos)>0) { ?>
			nuevoCampo( nodo,"campoimagenesnavegacion",strHtml);
		<? } ?>
		<? for ($i=0;$i<count($campos);$i++) { ?>
		//	alert('a');
			f.campoimagenesnavegacion_<?= $i+2 ?>_id.value="<?= $campos[$i]->id ?>";
			f.campoimagenesnavegacion_<?= $i+2 ?>_imagen.value="<?= $campos[$i]->imagen ?>";
			f.campoimagenesnavegacion_<?= $i+2 ?>_orden.value="<?= $campos[$i]->orden ?>";


			f.campoimagenesnavegacion_<?= $i+2 ?>_textoimagen.value="<?= $campos[$i]->imagen ?>";
			f.campoimagenesnavegacion_<?= $i+2 ?>_srcimagen.src="<?= $campos[$i]->imagen ?>";
			
			<? if ($i!=count($campos)-1) { ?>
				nuevoCampo( nodo,"campoimagenesnavegacion",strHtml);
			<? } ?>
		<? } ?>		
	}

</script>

<TABLE  border="0" width="460" cellpadding="0" cellspacing="0"  >
	<TR>
		<TD height="24" align="left" background="img/backoffice_fondo_cab_tabla.jpg">
		&nbsp;<B><?=utf8_encode("Imágenes")?></B></TD>		
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
							<div id=campoimagenesnavegacion_1_span style="display:none">
								<input type="hidden" name="campoimagenesnavegacion_1" value="">
								<input type="hidden" name="campoimagenesnavegacion_1_id" value="">
<table width="460" border="0" cellpadding="3" cellspacing="1"  style="border:1px solid #CCCCCC;">

		<INPUT TYPE="hidden" name="campoimagenesnavegacion_1_idnavegacion">
		<INPUT TYPE="hidden" name="campoimagenesnavegacion_1_textoimagen">
		<tr bgcolor="#FFFFFF" valign="top">
		<td width="140" class="popuptitcampo">
			Imagen :<BR><span class="dimension">(200x150 pixeles)</span>
			</td>
			<TD valign="top" >
				<img src="/bo/img/pc.gif" WIDTH="100" name="campoimagenesnavegacion_1_srcimagen"><BR>
													
			
				
				<a href="#" onclick="
					return eliminar_campo(this.parentNode.parentNode.parentNode.parentNode.parentNode.id);">
					
				</a><BR>
				<input type="file" name="campoimagenesnavegacion_1_imagen" size="40" onChange="cambio()"   class="inputmedio">

			</TD>
		</tr>
		
		<tr bgcolor="#FFFFFF" valign="top">
			<td width="140" class="popuptitcampo">
				Orden:
			</td>
			<td width="320" class="popupcampo">
				<input name="campoimagenesnavegacion_1_orden" type="text" size="10" maxlength="255" onchange="cambio(this)">
			</td>
		</tr>
</table>


									<a href="#" onclick="
										return eliminarCampo(this);">
										<IMG SRC="/bo/img/ico_menos.gif" WIDTH="9" HEIGHT="9" BORDER="0" ALT="">
									</a>								
							</div>
						</td>
					</tr>
					
					<tr>
						<td valign="bottom" align="left">
							<IMG SRC="img/cpb" WIDTH="3" HEIGHT="1" BORDER="0" ALT="">
							<a  id='campoimagenesnavegacion_1_href' href='#' onclick="
							nuevoCampo(this,'campoimagenesnavegacion',getElement('campoimagenesnavegacion_1_span').innerHTML);
							return false;">
								<IMG SRC="/bo/img/ico_mas.gif" WIDTH="9" HEIGHT="9" BORDER="0" ALT="">
							</a>
						</td>
					</tr>
				</table>
			
		</td>
	</tr>

</TABLE>

<BR>
