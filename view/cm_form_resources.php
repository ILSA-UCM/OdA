<?
/* 
 * Archivo generado dinámicamente por Content Manager
*/
include_once(dirname(__FILE__)."/include.php");
$dict = $visit->util->getRequest();
if ($id=="") {
	$fila = new ClsResources();
	} else {
	$fila = $visit->dbBuilder->getResourcesId($id);
}
if (!$visit->options->tieneAcceso("form",$fila)) $visit->options->sinAcceso();
include_once(dirname(__FILE__)."/top.php");
?>
<script>
	var dato=0;
	function revisarForm() {
		return (dato!=1 );
	}
	function cambio(item) {
		dato=1;
	}
	function compruebaCampos() {
		var vall = document.formulario;
		var nombre;
		var msgError=false;
		var newLine = "\n";
		var strError="";
		var patron, campo, res;
					
		if (strError!="") {
			alert("Compruebe que ha rellenado los siguientes campos:\n"+strError);
			return false;
		} else {				
			return true;
		}
		return true;
	}
</script>
<TABLE  border="0" width="460" cellpadding="0" cellspacing="0" style="border-top:1px solid #CCCCCC;border-left:1px solid #CCCCCC;border-right:1px solid #CCCCCC;">
	<TR>
		<TD height="24" align="left" background="img/backoffice_fondo_cab_tabla.jpg">
		&nbsp;<B>Datos de resources</B></TD>		
	</TR>
</TABLE>

<form name="formulario" action="do.php" method="POST" ENCTYPE="multipart/form-data" onsubmit="; return compruebaCampos()">

	<input type="hidden" name="op" value="modificar_resources">
	<input type="hidden" name="id" value="<?= $fila->id ?>">
<table width="100%" border="0" cellpadding="3" cellspacing="1"  style="border:1px solid #CCCCCC;">

	<tr>
		<td class="popuptitcampo">
			Idov:
		</td>
		<td  class="popupcampo">
			<input name="idov" type="text" size="40" maxlength="255" value="<?= $visit->util->encapsulaInput( $fila->idov) ?>" onchange="cambio(this)">
		</td>
	</tr>
	<tr>
		<td class="popuptitcampo">
			Ordinal:
		</td>
		<td  class="popupcampo">
			<input name="ordinal" type="text" size="40" maxlength="255" value="<?= $visit->util->encapsulaInput( $fila->ordinal) ?>" onchange="cambio(this)">
		</td>
	</tr>
	<tr>
		<td class="popuptitcampo">
			Visible:
		</td>
		<td  class="popupcampo">
			<input type="checkbox" name="visible" value="S" <? if ($fila->visible=="S") print "checked"; ?> onchange="cambio(this)">
		</td>
	</tr>
	<tr>
		<td class="popuptitcampo">
			Iconoov:
		</td>
		<td  class="popupcampo">
			<input type="checkbox" name="iconoov" value="S" <? if ($fila->iconoov=="S") print "checked"; ?> onchange="cambio(this)">
		</td>
	</tr>
	<tr>
		<td class="popuptitcampo">
			Name:
		</td>
		<td  class="popupcampo">
			<input name="name" type="text" size="40" maxlength="255" value="<?= $visit->util->encapsulaInput( $fila->name) ?>" onchange="cambio(this)">
		</td>
	</tr>
	<tr>
		<td class="popuptitcampo">
			Idov_refered:
		</td>
		<td  class="popupcampo">
			<input name="idov_refered" type="text" size="40" maxlength="255" value="<?= $visit->util->encapsulaInput( $fila->idov_refered) ?>" onchange="cambio(this)">
		</td>
	</tr>
	<tr>
		<td class="popuptitcampo">
			Idresource_refered:
		</td>
		<td  class="popupcampo">
			<input name="idresource_refered" type="text" size="40" maxlength="255" value="<?= $visit->util->encapsulaInput( $fila->idresource_refered) ?>" onchange="cambio(this)">
		</td>
	</tr>
	<tr>
		<td class="popuptitcampo">
			Type:
		</td>
		<td  class="popupcampo">
			<? $valores = $fila->getValoresType(); ?>
				<select name="type" onchange="cambio(this)" class="lsselectsfiltro">
					<option value="">- 
					<? while (list ($clave, $val) = each ($valores)) { ?>
						<option value="<?= $clave ?>" <? if ($clave==$fila->type) print "selected"; ?>><?= $val ?>
					<? } ?></select>
		</td>
	</tr>
</table>
		<TABLE  border="0" width="100%" cellpadding="0" cellspacing="10" style="border-left:1px solid #CCCCCC;border-right:1px solid #CCCCCC;border-bottom:1px solid #CCCCCC;">
			<TR>				
				<TD align="left" width="33%">
						<input type="image" onclick="
						if (compruebaCampos()) {
							document.formulario.submit();
						}
						event.returnValue=false;
						return false;
						" SRC="img/boton_guardar.gif" WIDTH="84" HEIGHT="21" BORDER="0" ALT="">
				</TD>
				<TD align="center" width="34%">
				<!--	<A HREF="<?= $session->lsresources ?>" onclick="  -->
				<A HREF="<?= $_SESSION["lsresources"] ?>" onclick="
						var ir=false;
						if (revisarForm()) ir=true;
						else if (confirm('<?=utf8_encode("Ha modificado datos ¿Seguro que desea volver?")?>')) ir=true;
						event.returnValue=ir;
						return ir;
						"><IMG SRC="img/boton_volver2.gif" WIDTH="84" HEIGHT="21" BORDER="0" ALT="Guardar"></A>
				</TD>				
				<TD align="right" width="33%">
					&nbsp;
					<? if ($id!="") { ?>
						<A HREF="#" onclick="
							if (confirm('<?=utf8_encode("¿Seguro que desea eliminar el elemento?")?>')) {
								window.location.href='do.php?op=eliminar_resources&id=<?= $fila->id ?>';
							}
							event.returnValue=false;
							return false;
							"><IMG SRC="img/boton_eliminar.gif" WIDTH="84" HEIGHT="21" BORDER="0" ALT=""></A>
					<? } ?>
				</TD>
			</TR>
		</TABLE>
</form>
<? include_once(dirname(__FILE__)."/bottom.php"); ?>
