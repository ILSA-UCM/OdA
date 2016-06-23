<?
/* 
 * Archivo generado dinámicamente por Content Manager
*/
include_once(dirname(__FILE__)."/include.php");
$dict = $visit->util->getRequest();
if ($id=="") {
	$fila = new ClsNumericData();
	} else {
	$fila = $visit->dbBuilder->getNumericDataId($id);
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
		&nbsp;<B>Datos de numeric_data</B></TD>		
	</TR>
</TABLE>

<form name="formulario" action="do.php" method="POST" ENCTYPE="multipart/form-data" onsubmit="; return compruebaCampos()">

	<input type="hidden" name="op" value="modificar_numeric_data">
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
			Idseccion:
		</td>
		<td  class="popupcampo">
			<input name="idseccion" type="text" size="40" maxlength="255" value="<?= $visit->util->encapsulaInput( $fila->idseccion) ?>" onchange="cambio(this)">
		</td>
	</tr>
	<tr>
		<td class="popuptitcampo">
			Value:
		</td>
		<td  class="popupcampo">
			<input name="value" type="text" size="40" maxlength="255" value="<?= $visit->util->encapsulaInput( $fila->value) ?>" onchange="cambio(this)">
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
					<!--    alfredo 140716  <A HREF="<?= $session->lsnumeric_data ?>" onclick="  -->
						<A HREF="<?= $_SESSION["lsnumeric_data"] ?>" onclick="
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
								window.location.href='do.php?op=eliminar_numeric_data&id=<?= $fila->id ?>';
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
