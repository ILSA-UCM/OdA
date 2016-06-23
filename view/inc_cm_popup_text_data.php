<?

?>

<script>
	function capturaCadena_campotext_data() {
		var f = document.formulario;
		var nodo = getElement("campotext_data_1_span");		
		var strHtml = nodo.innerHTML;
		nodo = getElement("campotext_data_1_href");
		<? if (count($campos)>0) { ?>
			idCampos=2;
			nuevoCampo( nodo,"campotext_data",strHtml);
		<? } ?>
		<? for ($i=0;$i<count($campos);$i++) { ?>
			f.campotext_data_<?= $i+2 ?>_id.value="<?= $campos[$i]->id ?>";
			f.campotext_data_<?= $i+2 ?>_idov.value="<?= $campos[$i]->idov ?>";
			f.campotext_data_<?= $i+2 ?>_idseccion.value="<?= $campos[$i]->idseccion ?>";
			f.campotext_data_<?= $i+2 ?>_value.value="<?= $campos[$i]->value ?>";
			
			<? if ($i!=count($campos)-1) { ?>
				nuevoCampo( nodo,"campotext_data",strHtml);
			<? } ?>
		<? } ?>		
	}

</script>

<TABLE  border="0" width="460" cellpadding="0" cellspacing="0" style="border-top:1px solid #CCCCCC;border-left:1px solid #CCCCCC;border-right:1px solid #CCCCCC;">
	<TR>
		<TD height="24" align="left" background="img/backoffice_fondo_cab_tabla.jpg">
		&nbsp;<B>Datos de text_data</B></TD>		
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
							<div id=campotext_data_1_span style="display:none">
								<input type="hidden" name="campotext_data_1" value="">
								<input type="hidden" name="campotext_data_1_id" value="">
<table width="460" border="0" cellpadding="3" cellspacing="1"  style="border:1px solid #CCCCCC;">

		<tr bgcolor="#FFFFFF" valign="top">
		<td width="140" class="popuptitcampo">
			Idov:
		</td>
		<td width="320" class="popupcampo">
			<input name="campotext_data_1_idov" type="text" size="40" maxlength="255" value="<?= $visit->util->encapsulaInput( $fila->idov) ?>" onchange="cambio(this)">
		</td>
	</tr>
		<tr bgcolor="#FFFFFF" valign="top">
		<td width="140" class="popuptitcampo">
			Idseccion:
		</td>
		<td width="320" class="popupcampo">
			<input name="campotext_data_1_idseccion" type="text" size="40" maxlength="255" value="<?= $visit->util->encapsulaInput( $fila->idseccion) ?>" onchange="cambio(this)">
		</td>
	</tr>
		<tr bgcolor="#FFFFFF" valign="top">
		<td width="140" class="popuptitcampo">
			Value:
		</td>
		<td width="320" class="popupcampo">
			<input name="campotext_data_1_value" type="text" size="40" maxlength="255" value="<?= $visit->util->encapsulaInput( $fila->value) ?>" onchange="cambio(this)">
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
							<a  id='campotext_data_1_href' href='#' onclick="
							nuevoCampo(this,'campotext_data',getElement('campotext_data_1_span').innerHTML);
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
