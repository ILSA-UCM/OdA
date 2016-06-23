<?
/* 
 * Archivo generado dinámicamente por Content Manager
*/
include_once(dirname(__FILE__)."/../include.php");
$visit->options->seccion = "OV";
$visit->options->subseccion = "Secciones";

$_SESSION["popup_section_data"]=false; // alfredo 140723


$tieneHijos=false;
$dict = $visit->util->getRequest();
if ($id=="") {
	$fila = new ClsSectionData();
} else {
	$fila = $visit->dbBuilder->getSectionDataId($id);
	$tieneHijos = $visit->dbBuilder->tieneHijosSeccion($fila->id);
}
	
if (!$visit->options->tieneAcceso("form",$fila)) $visit->options->sinAcceso();
include_once(dirname(__FILE__)."/../bo_top.php");
?>
<script>
	var dato=0;
	function revisarForm() {
		return (dato!=1 );
	}
	function cambio(item) {
	 dato=1;
		if("tipo_valores"==item.name){
			if("N"==item.value){
				document.getElementById("decimales").style.display = "";
				document.getElementById("decimales").style.visibility = 'visible';
			} else {
				document.getElementById("decimales").style.display = "none";
				document.getElementById("decimales").style.visibility = 'hidden';
			}
			if("C"==item.value){
				document.getElementById("vocabulario").style.display = "";
				document.getElementById("vocabulario").style.visibility = 'visible';
			} else {
				document.getElementById("vocabulario").style.display = "none";
				document.getElementById("vocabulario").style.visibility = 'hidden';
			}
		}
	}
	/*function cambio(item) {
		if("tipo_valores"==item.name){
			if (document.getElementById && document.getElementById("browseable") !=  null) 
				if("C"==item.value||"X"==item.value){
					document.getElementById("browseable").style.display = "inline";
					document.getElementById("browseable").style.visibility='visible';
				} else {
					document.getElementById("browseable").style.visibility='hidden';
				}
				if("C"==item.value){
					document.getElementById("vocabulario").style.display = "inline";
					document.getElementById("vocabulario").style.visibility='visible';
				} else {
					document.getElementById("vocabulario").style.visibility='hidden';
				}
				
		}
		dato=1;
	}*/
	function compruebaExtensible(){
		var vall = document.formulario;
		//alert(vall.extensible.value);
		if (vall.extensible.checked==false) { 
			<? if ($tieneHijos) { ?>
			alert(" Antes de marcar una sección como no extensible debe comprobar que ésta no tenga subsecciones");
			return false;
			<? } else { ?>
			return true
			<? } ?>
		}
		return true;
	}
	function compruebaCampos() {
		var vall = document.formulario;
		var nombre;
		var msgError=false;
		var newLine = "\n";
		var strError="";
		var patron, campo, res;
		if (vall.nombre.value=="") {
			strError += "  - El campo nombre es obligatorio ";
		}
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
		&nbsp;<B>Modelo de datos</B></TD>		
	</TR>
</TABLE>
<form name="formulario" action="do.php" method="POST" ENCTYPE="multipart/form-data" onsubmit="; return compruebaCampos()">
	<input type="hidden" name="op" value="modificar_section_data">
	<input type="hidden" name="id" value="<?= $fila->id ?>">
	<input type="hidden" name="orden" value="<?= $fila->orden ?>">
	<input type="hidden" name="vocabulario" value="<?=$fila->vocabulario?>">
	<input type="hidden" name="decimales" value="<?=$fila->decimales?>">
	<TABLE  border="0" width="100%" cellpadding="0" cellspacing="10" style="border:1px solid #CCCCCC;">
			<TR>				
				<TD align="left" width="33%">
					<input type="image" onclick="
						if (compruebaExtensible()) {
							if (compruebaCampos()) {
								document.formulario.submit();
							}
						}
						event.returnValue=false;
						return false;
						" 
						SRC="img/boton_guardar.gif" 
						WIDTH="84" HEIGHT="21" BORDER="0" ALT="">
				</TD>
				<TD align="center" width="34%">
					<A HREF="cm_ls_section_data.php" onclick="
						var ir=false;
						if (revisarForm()) ir=true;
						else if (confirm('<?=utf8_encode("Ha modificado datos. Seguro que desea volver?")?>')) ir=true;
						event.returnValue=ir;
						return ir;
						"><IMG SRC="img/boton_volver2.gif" WIDTH="84" HEIGHT="21" BORDER="0" ALT="Guardar"></A>
				</TD>				
				<TD align="right" width="33%">
					&nbsp;
					<? if ($id!=""&&$id!=111&&$id!=112&&$id!=4) { ?>
						<A HREF="#" onclick="
							if (confirm('<?=utf8_encode("Seguro que desea eliminar este campo?")?>')) {
								if (confirm('Se va a eliminar este campo y su contenido de TODOS los objetos de la BASE DE DATOS.\n \n Se van a perder TODOS los datos asociados a este campo.\n \n Confirma que quiere ELIMINARLO?')) {
									window.location.href='do.php?op=eliminar_section_data&id=<?= $fila->id ?>';
								}
							}
							event.returnValue=false;
							return false;
							"><IMG SRC="img/boton_eliminar.gif" WIDTH="84" HEIGHT="21" BORDER="0" ALT=""></A>
					<? } else if($id!=""){ ?>
						<span class="subcabecera">
						Este campo no se puede borrar.<br>
						Esta secci&oacute;n es obligatoria al mostrarse en los distintos listados.	
						</span>
					<? } else { ?>
						&nbsp;
					<? } ?>
				</TD>
			</TR>
		</TABLE>
	<table width="100%" border="0" cellpadding="3" cellspacing="1"  style="border:1px solid #CCCCCC; border-bottom:0px; padding-top:10px;">
		<tr>
			<td class="popuptitcampo" nowrap>
				Nombre:
			</td>
			<td  class="popupcampo" nowrap>
				<input name="nombre" type="text" size="40" maxlength="255" value="<?= $visit->util->encapsulaInput( $fila->nombre) ?>" onchange="cambio(this)">
			</td>
		</tr>
		<tr>
			<td class="popuptitcampo">
				Visible:
			</td>
			<td class="popupcampo">
				<input type="checkbox" name="visible" value="S" <? if ($fila->visible=="S") print "checked"; ?> onchange="cambio(this)">
			</td>
		</tr>
	<tr>
		<td class="popuptitcampo" nowrap style="width:126px;">
			Navegable:
		</td>
		<td class="popupcampo" nowrap>
			<input type="checkbox" name="browseable" value="S" <? if ($fila->browseable=="S") print "checked"; ?> onchange="cambio(this)">
		</td>
	</tr>
	<tr>
		<td class="popuptitcampo" nowrap width="119px">
			Extensible:
		</td>
		<td  class="popupcampo" nowrap>
			<input type="checkbox" name="extensible" value="S" <? if ($fila->extensible=="S") print "checked"; ?> onchange="cambio(this)">
		</td>
	</tr>
	<tr>
		<td class="popuptitcampo" nowrap>
			Tipo de Valor:
		</td>
		<td class="popupcampo" nowrap>
			<? $valores = $fila->getValoresTipoValores(); ?>
			<select name="tipo_valores" onchange="cambio(this)" class="lsselectsfiltro" <? if ($id>0) echo disabled ?>>
				<option value="X"> Ninguno
				<? while (list ($clave, $val) = each ($valores)) { ?>
					<option value="<?= $clave ?>" <? if ($clave==$fila->tipo_valores) print "selected"; ?>><?= $val ?>
				<? } ?>
			</select>
		</td>
	</tr>
	<tr id="vocabulario" <? if($fila->tipo_valores!="C"){ ?> style="display:none;"<? } ?>>
		<td class="popuptitcampo" nowrap>
			Vocabulario:
		</td>
		<td class="popupcampo" nowrap>
			<? $vocabularios = $visit->dbBuilder->getValoresVocabulario() ?>
			<select name="vocabulario" id="vocabulario" onchange="cambio(this)" class="lsselectsfiltro" <? if ($id>0) echo disabled ?>>
				<option value="0" <? if (0 == $fila->vocabulario) print "selected" ?>>No comparte vocabulario
				<option value="1" <? if (1 == $fila->vocabulario) print "selected" ?>>Comparte vocabulario
				<? for ($i=0; $i<count($vocabularios); $i++) { ?>
					<option value="<?= $vocabularios[$i]->id ?>" <? if ($vocabularios[$i]->id == $fila->vocabulario) print "selected"; ?>>Vocabulario de <?=$vocabularios[$i]->nombre ?>
				<? } ?>
			</select>
		</td>
	</tr>
	<tr id="decimales"  <? if($fila->tipo_valores!="N"){ ?> style="display:none;"<? } ?>>
		<td  class="popuptitcampo" nowrap>
			Cantidad de decimales:
		</td>
		<td class="popupcampo" nowrap>
			<? 
			$decimales = $visit->dbBuilder->getCantidadDecimales($fila->id);
			?>
			<input name="decimales" id="decimales"  type="number" min="0" max="10" step="1" value="<?= $decimales?>"/>
		</td>
	</tr>
	<tr>
		<td class="nombrecampo" nowrap>
			Navegaci&oacute;n padre:
		</td>
		<td class="textocampo" nowrap>
			<? 
				$navegacion = new ClsSectionData();
				$navegacion->lang = "es";
				$valores = $visit->dbBuilder->getTablaFiltrada($navegacion);
				//var_dump($valores);
				$dictFilas = $visit->util->getDict( $valores );
				//var_dump($dictFilas);
				$sDictFilas = array();
				//var_dump($sDictFilas);
				$numOrden=1000;
				while (list ($clave, $valor) = each ($dictFilas)) { 
					$nombre ="";
					$caminoItems = $visit->util->obtenerCaminoCategoria($dictFilas, "", $valor->id);							
					for ($i=1;$i<count($caminoItems);$i++) 
						$nombre .= " >> ". $visit->util->numDigitos($dictFilas[$caminoItems[$i]]->orden,5) . "_" . $dictFilas[$caminoItems[$i]]->nombre;
					//Si el id de esta categoria está en el camino no lo meto
					if (!$visit->util->perteneceLista( $fila->id, implode(",",$caminoItems) )) {
						$sDictFilas[$nombre] = $valor;
					}
					//var_dump($numOrden);echo(">>");
					$numOrden++;
					//var_dump($numOrden);
				}
				//var_dump($sDictFilas);
				ksort( $sDictFilas );
				//var_dump($sDictFilas);
				$valores = &$sDictFilas;			
			?>
			<select name="idpadre" class="selectmedio" onchange="cambio(this);" <?/// if ($fila->idpadre==0 && $fila->idpadre!="") echo disabled ?>>
				<? while (list ($clave, $valor) = each ($valores)) { //var_dump($clave);echo("---");var_dump($valor); ?>					
					<? if ((count(explode(">>",$clave))>20) || $valor->extensible!="S"){?>
					<?}else{?>
						<option value="<?= $valor->id ?>" <? if ($valor->id==$fila->idpadre) echo "selected"; ?>>
							<?= $visit->util->repetirCadena( "&nbsp;&nbsp;&nbsp;", count(explode(">>",$clave))-2 ) ?>
							<?= $valor->nombre ?>
					<?  //echo("valor-nombre=");var_dump($valor->nombre);echo("valor-id=");var_dump($valor->id);echo("fila-idpadre=");
						//var_dump($fila->idpadre);echo("fila-orden=");var_dump($fila->orden);
					}?>
				<?}?>
			</select>
			<!-- <input name="orden" type="hidden" value="<?= $numOrden ?>"> -->
		</td>
	</tr>
	</table>
		<TABLE  border="0" width="100%" cellpadding="0" cellspacing="10" style="border-left:1px solid #CCCCCC;border-right:1px solid #CCCCCC;border-bottom:1px solid #CCCCCC;">
			<TR>				
				<TD align="left" width="33%">
						<input type="image" onclick="
						if (compruebaExtensible()) {
							if (compruebaCampos()) {
								document.formulario.submit();
							}
						}
						event.returnValue=false;
						return false;
						" SRC="img/boton_guardar.gif" WIDTH="84" HEIGHT="21" BORDER="0" ALT="">
				</TD>
				<TD align="center" width="34%">
					<A HREF="cm_ls_section_data.php" onclick="
						var ir=false;
						if (revisarForm()) ir=true;
						else if (confirm('Ha modificado datos Seguro que desea volver?')) ir=true;
						event.returnValue=ir;
						return ir;
						"><IMG SRC="img/boton_volver2.gif" WIDTH="84" HEIGHT="21" BORDER="0" ALT="Guardar"></A>
				</TD>				
				<TD align="right" width="33%">
					&nbsp;
					<? if ($id!=""&&$id!=111&&$id!=112&&$id!=4) { ?>
						<A HREF="#" onclick="
							if (confirm('Seguro que desea eliminar este campo?')) {
								if (confirm('Se va a eliminar este campo y su contenido de TODOS los objetos de la BASE DE DATOS.\n Por lo que se van a perder TODOS los datos asociados a este campo.\n Confirma que quiere ELIMINARLO?')) {
									window.location.href='do.php?op=eliminar_section_data&id=<?= $fila->id ?>';
								}
							}
							event.returnValue=false;
							return false;
							"><IMG SRC="img/boton_eliminar.gif" WIDTH="84" HEIGHT="21" BORDER="0" ALT=""></A>
					<? } else if($id!=""){ ?>
						<span class="subcabecera">
						Este campo no se puede borrar.<br>
						Esta secci&oacute;n es obligatoria al mostrarse en los distintos listados.	
						</span>
					<? } else { ?>
						&nbsp;
					<? } ?>
				</TD>
			</TR>
		</TABLE>
</form>
<? include_once(dirname(__FILE__)."/../bo_bottom.php"); ?>