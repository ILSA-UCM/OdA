
<?
include_once(getcwd()."/include.php");
$titulopaginabo="Cabecera de la Web";
$explicaciontitulopaginabo="Datos de cabecera + informaci&oacute;n para buscadores";
$visit->options->seccion = "Preferencias";
$visit->options->subseccion = "Cabecera";
if (!$visit->options->tieneAcceso("form",$fila)) $visit->options->sinAcceso();
include_once(getcwd()."/bo_top.php");
$arrGrupos=array();

$mensajes = new ClsMensajes();
$mensajes->lang= $lang;
$mensajes->tipo= "cabecera";
$filas = $visit->dbBuilder->getTablaFiltrada($mensajes);
$count_filas = count($filas);
for ($i=0;$i<count($filas);$i++) {
	$arrGrupos[$filas[$i]->grupo][]=$filas[$i];
}
ksort($arrGrupos);
$grupos = array_keys($arrGrupos);
$count_grupos = count($grupos);

$preferencias = $visit->dbBuilder->getPreferenciaFromTipo("F");
$preferencias_seguridad=$visit->dbBuilder->getPreferenciaFromAtributo("seguridad_web");

//extension de archivos
$prefExtension = $visit->dbBuilder->getPreferenciaFromAtributo("extension_archivos");
$extensiones = array();
if($prefExtension != "")	$extensiones =preg_split(";",$prefExtension->valor);	


//numero de decimales a mostar en los campos numericos
/* @Deprecated
if($visit->options->numeric_decimal ==""){
	$preferenciasDecimales = new ClsPreferenciasPresentacion();
	$preferenciasDecimales->atributo = "numeric_decimal";
	$preferenciasDecimales = $visit->dbBuilder->getTablaFiltrada($preferenciasDecimales);
	$visit->options->numeric_decimal = $preferenciasDecimales[0]->valor;
}*/
	

?>
<script>
 function showColor(item) {
		var color = item.value;
		var nombre = item.id;
        document.getElementById(nombre).style.backgroundColor = color;
    }

    /* @Deprecated
	function compruebaNumerico(valor){
		if (!esNumerico(valor)) {
			alert("El valor del campo 'cantidad de decimales' debe ser numerico");
			return false;
		}
	}*/
 
</script>
<form name="formulario" action="do.php" method="POST">
	<input type="hidden" name="op" value="modificar_preferenciascabecera">
	<input type="hidden" name="lang" value="<?= $lang?>">

<? // include_once(getcwd()."/inc_top_pestanas.php"); ?>
<? for($i=0;$i<$count_grupos;$i++) {?>
	<table width="100%" border="0" cellpadding="0" cellspacing="0">	
		<tr>
			<td class="bloquecampo" colspan="2"><B><?= $grupos[$i] ?></B></td>		
		</tr>
		<tr>
			<td colspan="2" height="6"></td>		
		</tr>
		<? while (list($k,$v)=each($arrGrupos[ $grupos[$i] ])) { ?>
			<tr>
				<td class="nombrecampoprefs">
					<?= $visit->util->encapsulaInput($v->etiqueta) ?>
				</td>
				<td class="textocampoprefs">
				<? if($v->formato=="texto"){ ?>
					<TEXTAREA  name="cabecera_<?= $v->atributo ?>" style="width:400px;height:100px;"><?= $visit->util->encapsulaInput($v->valor) ?></TEXTAREA>
				<? }else if ($v->formato=="imagen"){ ?>
					<table border="0" cellpadding="0" cellspacing="0">
						<? if ($v->valor!="") { ?>
							<tr id ="id_ubicacion_cabecera_<?= $v->atributo ?>">
								<td >
									<INPUT TYPE="hidden" NAME="ubicacion_cabecera_<?= $v->atributo ?>" value ="<?= $v->valor ?>">
									<IMG  SRC="<?= $v->valor ?>" WIDTH="400"  BORDER="0" ALT="<?=$v->valor ?>"><br>
									<BR>
				<span class="ayuda">Ancho = <?= $prefs["tam_ancho_global"] ?> en px</span>
								<td>
								<TD valign="top" border="0"><A HREF="#" onclick="eliminarRecurso('cabecera_<?= $v->atributo ?>');return false;"><IMG  SRC="<?=$_parenDir?>bo/img/ico_menos.gif" WIDTH="9" HEIGHT="9" BORDER="0" ALT=""></A>
								</TD>
							</tr>
						<? } ?>
						<tr>
							<td align="left">Actualizar:<BR>
							<iframe id="iframeOculto" name="iframeOculto" style="width:0px; height:0px; border: 0px"></iframe>

							<!-- Boton que redirecciona el IFRAME hacia -->
							 <input name="cabecera_<?= $v->atributo ?>" type="text" id="imagen" class="inputcorto" style="width:200px;">
							 <input type="button" value="Seleccionar imagen" onClick="window.open ('<?=$_parenDir?>bo/bancorecursos/ls_recursos.php?seleccionar=si&campocontenedor=imagen', '', 'height=600,width=800,location=no,menubar=no,resizable,scrollbars=no,status,toolbar=no');" class="boton"> 
							<!-- <input type="file" name="imagengrande" size="20" onChange="cambio()" class="boton"> -->
							</td>
						</tr>
					</table>

				<? }else{ ?>
					<input type="text" name="cabecera_<?= $v->atributo ?>"  class="<?= $v->formato ?>" value="<?= $visit->util->encapsulaInput($v->valor) ?>">
				<? } ?>
				</td>
			</tr>	
		<? } ?>
	</table>
<? } ?>



<? // include_once(getcwd()."/inc_bottom_pestanas.php"); ?>
<br>



<table width="100%" border="0" cellpadding="0" cellspacing="0">	
		<tr>
			<td class="bloquecampo" colspan="2"><B>Dise&ntilde;o de la p&aacute;gina </B></td>		
		</tr>
</TABLE>
<? for($i=0;$i<count($preferencias);$i++) {?>
	
	<input type="hidden" name="campospreferencias_<?= $i?>"> 
	<input type="hidden" name="campospreferencias_<?=  $i?>_atributo" value="<?= $preferencias[$i]->atributo?>" >
	<input type="hidden" name="campospreferencias_<?= $i?>_tipo" value="F" >
	<input type="hidden" name="campospreferencias_<?= $i?>_formato" value="<?= $preferencias[$i]->formato?>">
	<input type="hidden" name="campospreferencias_<?= $i?>_etiqueta" value="<?= $preferencias[$i]->etiqueta?>" >
	<input type="hidden" name="campospreferencias_<?= $i?>_id" value="<?= $preferencias[$i]->id?>" >
	<input type="hidden" name="campospreferencias_<?= $i?>_orden" value="<?= $preferencias[$i]->orden?>" >
	
	
			<table width="100%" border="0" cellpadding="0" cellspacing="0"  >	
				<tr  >
					<td class="nombrecampoprefs"><?if ($preferencias[$i]->formato!="color") {?> <?= $visit->util->encapsulaInput($preferencias[$i]->etiqueta) ?> <? } ?></td>
					<td class="textocampoprefs" nowrap>
					
						
					<?  if ($preferencias[$i]->formato=="imagen") {?>
						
						
							<table border="0" cellpadding="0" cellspacing="0">
							<? if ($preferencias[$i]->valor!="") { ?>
								<tr id ="ubicacion_imagen_<?= $i?>">
									<td >
										<INPUT TYPE="hidden" NAME="ubicacion_imagen" value ="<?=$preferencias[$i]->valor ?>">
										<IMG  SRC="<?= $preferencias[$i]->valor ?>" height="40"  BORDER="0" ALT="<?= $preferencias[$i]->valor ?>"><br>
										<span class="ayuda">Ancho = Cualquiera </span>
									<td>
									<TD valign="top" border="0"><A HREF="#" onclick="
											getElement('ubicacion_imagen_<?= $i?>').style.display ='none';
											document.formulario.campospreferencias_<?=  $i?>_valor.value ='';
											;return false;"><IMG  SRC="<?=$_parenDir?>bo/img/ico_menos.gif" WIDTH="9" HEIGHT="9" BORDER="0" ALT=""></A>
									</TD>
								</tr>
							<? } ?>
							<tr>
								<td align="left">Actualizar:<BR>
									<iframe id="iframeOculto" name="iframeOculto" style="width:0px; height:0px; border: 0px"></iframe>

									<!-- Boton que redirecciona el IFRAME hacia -->
									 <input name="campospreferencias_<?=  $i?>_valor" type="text" id="campospreferencias_<?= $i?>_valor" class="inputcorto" style="width:200px;" value="<?= $preferencias[$i]->valor ?>">
									 <input type="button" value="Seleccionar imagen" onClick="window.open ('<?=$_parenDir?>bo/bancorecursos/ls_recursos.php?seleccionar=si&campocontenedor=campospreferencias_<?= $i?>_valor', '', 'height=600,width=800,location=no,menubar=no,resizable,scrollbars=no,status,toolbar=no');" class="boton"> 
									<!-- <input type="file" name="imagenpequenia" size="20" onChange="cambio()" class="boton"> -->
								</td>
								</tr>
							</table>
							
				

					<? }else   if ($preferencias[$i]->formato=="color") {?>
						<!-- <input type="text" name="campospreferencias_<?= $i?>_valor" value="<?= $preferencias[$i]->valor?>" onclick="cambio()" id="fondo" style="background-color:<?= $preferencias[$i]->valor?>" onBlur="showColor(this)"><IMG SRC="../../jscripts/tiny_mce/themes/advanced/images/forecolor.gif" WIDTH="20" HEIGHT="20" BORDER="0" ALT="" style="cursor: pointer;" onClick= "window.open ('paletacolores.php?editor_id=fondo', '', 'height=200,width=450,location=no,menubar=no,resizable,scrollbars=no,status,toolbar=no')"> 
						<span class="ayuda">No se utiliza, está pensado para el futuro</span> -->
					<? } ?>
					</td>
				</tr>
			</table>
<? } ?>

<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td class="bloquecampo" colspan="2"><B>Extensi&oacute;n de archivos</B></td>		
	</tr>
		<tr>
		<td class="nombrecampoprefs" align="left"><b>Extensiones ya a&ntilde;adidas</b> </td>
		<td> Para a&ntilde;adir una extensi&oacute;n introduzca la <b>extensi&oacute;n sin el punto</b>. 
		</td>
		<?while (list($key, $value)=each($extensiones)){
			if($value != ""){ ?>
			<tr>
				<td align="left"></td>
				<td >
					<span ><?=$value?></span>
					<span style="border:1px solid;"  onclick = "location.href='./do.php?op=modificar_extension_archivo&valor=<?=$value ?>'">X</span> 
										 
					
				</td>
			</tr> 
		<? } 
		}?>
		</tr>
	<tr>
		<td class="nombrecampoprefs" align="left">Agregar extensi&oacute;n</td>
		<td>
			<input name="extension_archivos_text" type="text"  onclick="cambio()">
			<input name="extension_archivos_button" type="button" onclick = "document.formulario.submit();return false;" VALUE="Agregar" >
		</td>
	</tr>
</table>
<!--
@Deprecated
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td class="bloquecampo" colspan="2"><B>Cantidad de decimales</B></td>		
	</tr>
	<tr>
		<td class="nombrecampoprefs" align="left">Indique la cantidad de n&uacute;meros decimales</td>
		<td>Valor actual: <?=$visit->options->numeric_decimal ?></td>
		<td>Nuevo valor: <input name="num_decimales" type="text" onchange="compruebaNumerico(this.value);"></td>
	</tr>
</table>-->
<BR>


<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td class="bloquecampo" colspan="2"><B>Seguridad acceso web</B></td>		
	</tr>
	<tr>
		<td class="nombrecampoprefs" align="left">Habilitar seguridad web</td>
		<td><input name="seguridad_web" type="checkbox" <?if($preferencias_seguridad->valor == S){?>checked<?}?>></td>
	</tr>
</table>
<BR>
<TABLE width="100%">
	<TR>
		<TD align="center">
	<input type="image" src="../img/boton_guardar.gif" name="" >
	</center></TD>
	</TR>
</TABLE>
</form>
<? include_once(getcwd()."/bo_bottom.php"); ?>