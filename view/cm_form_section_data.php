<?
/* 
 * Archivo generado dinámicamente por Content Manager
*/
include_once(dirname(__FILE__)."/include.php");
$dict = $visit->util->getRequest();
if ($id=="") {
	$fila = new ClsSectionData();
	} else {
	$fila = $visit->dbBuilder->getSectionDataId($id);
}
//if (!$visit->options->tieneAcceso("form",$fila)) $visit->options->sinAcceso();
include_once(dirname(__FILE__)."/top_simple.php");
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
		&nbsp;<B>Datos de Sección</B></TD>		
	</TR>
</TABLE>

<form name="formulario" action="do.php" method="POST" ENCTYPE="multipart/form-data" onsubmit="; return compruebaCampos()">

	<input type="hidden" name="op" value="modificar_section_data">
	<input type="hidden" name="id" value="<?= $fila->id ?>">
	<input type="hidden" name="orden" value="<?= $fila->orden ?>">
	<input type="hidden" name="popup" value="S">
	<input type="hidden" name="lang" value="<?= $lang ?>">
	<input type="hidden" name="idlangprincipal" value="<?= $fila->idlangprincipal ?>">
<table width="100%" border="0" cellpadding="3" cellspacing="1"  style="border:1px solid #CCCCCC;">
	<tr>
		<td class="popuptitcampo">
			Nombre:
		</td>
		<td  class="popupcampo">
			<input name="nombre" type="text" size="40" maxlength="255" value="<?= $visit->util->encapsulaInput( $fila->nombre) ?>" onchange="cambio(this)">
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
			Browseable:
		</td>
		<td  class="popupcampo">
			<input type="checkbox" name="browseable" value="S" <? if ($fila->browseable=="S") print "checked"; ?> onchange="cambio(this)">
		</td>
	</tr>
	<tr>
		<td class="popuptitcampo">
			Extensible:
		</td>
		<td  class="popupcampo">
			<input type="checkbox" name="extensible" value="S" <? if ($fila->extensible=="S") print "checked"; ?> onchange="cambio(this)">
		</td>
	</tr>
	<tr>
		<td class="popuptitcampo">
			Tipo de Valor:
		</td>
		<td  class="popupcampo">
			<? $valores = $fila->getValoresTipoValores(); ?>
				<select name="tipo_valores" onchange="cambio(this)" class="lsselectsfiltro">
					<option value="">- 
					<? while (list ($clave, $val) = each ($valores)) { ?>
						<option value="<?= $clave ?>" <? if ($clave==$fila->tipo_valores) print "selected"; ?>><?= $val ?>
					<? } ?></select>
		</td>
	</tr>
	<tr>
			<td class="nombrecampo">
				Navegación padre:
			</td>
			<td  class="textocampo">
					<? 
						$navegacion = new ClsSectionData();
						$navegacion->lang = "es";
						$valores = $visit->dbBuilder->getTablaFiltrada($navegacion);
						$dictFilas = $visit->util->getDict( $valores );
						$sDictFilas = array();
						$numOrden=1000;
						while (list ($clave, $valor) = each ($dictFilas)) { 
							$nombre ="";
							$caminoItems = $visit->util->obtenerCaminoCategoria($dictFilas, "", $valor->id);							
							for ($i=1;$i<count($caminoItems);$i++) $nombre .= " >> ". $visit->util->numDigitos($dictFilas[$caminoItems[$i]]->orden,5) . "_" . $dictFilas[$caminoItems[$i]]->nombre;
							//Si el id de esta categoria está en el camino no lo meto
							if (!$visit->util->perteneceLista( $fila->id, implode(",",$caminoItems) )) {
								$sDictFilas[$nombre] = $valor;
							}
							$numOrden++;
						}
						ksort( $sDictFilas );
						$valores = &$sDictFilas;			
					?>
					<select name="idpadre" class="selectmedio" onchange="cambio(this); " <? if ($fila->idpadre==0 && $fila->idpadre!="") echo disabled ?>>
						
						<? while (list ($clave, $valor) = each ($valores)) { ?>					
							<? if ((count(explode(">>",$clave))>20)){?>
							<?}else{?>
								<option value="<?= $valor->id ?>" <? if ($valor->id==$idpadre) echo "selected"; ?>>
									<?= $visit->util->repetirCadena( "&nbsp;&nbsp;&nbsp;", count(explode(">>",$clave))-2 ) ?>
									<?= $valor->nombre  ?>
							<?}?>
						<?}?>
					</select>
					<input name="orden" type="hidden" value="<?= $numOrden ?>">

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
						" SRC="<?=$_parenDir?>bo/img/boton_guardar.gif" WIDTH="84" HEIGHT="21" BORDER="0" ALT="">
				</TD>
				<TD align="center" width="34%">
					<A HREF="<?= $session->ls_section_data ?>" onclick="
						window.close();
						"><IMG SRC="<?=$_parenDir?>bo/img/boton_volver2.gif" WIDTH="84" HEIGHT="21" BORDER="0" ALT="Guardar"></A>
				</TD>				
				<TD align="right" width="33%">
					&nbsp;
					<? if ($id!="") { ?>
						<A HREF="#" onclick="
							if (confirm('<?=utf8_encode("¿Seguro que desea eliminar el elemento?")?>')) {
								window.location.href='do.php?op=eliminar_section_data&id=<?= $fila->id ?>';
							}
							event.returnValue=false;
							return false;
							"><IMG SRC="<?=$_parenDir?>bo/img/boton_eliminar.gif" WIDTH="84" HEIGHT="21" BORDER="0" ALT=""></A>
					<? } ?>
				</TD>
			</TR>
		</TABLE>
</form>
<? include_once(dirname(__FILE__)."/bottom_simple.php"); ?>