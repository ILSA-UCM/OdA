<?
include_once(getcwd()."/include.php");
if (!$visit->options->tieneAcceso("ls",new ClsNavegacion())) $visit->options->sinAcceso();

include_once(dirname(__FILE__)."/../../FCKeditor/fckeditor.php");
//$visit->debuger->enable(true);
$visit->options->seccion = "Navegaci&oacute;n";
$titulopaginabo="Gesti&oacute;n de Men&uacute;s";
$explicaciontitulopaginabo="Cumplimente el siguiente formulario.";

include_once(getcwd()."/bo_top.php");

// alfredo 140707   $session->lsnavegacion ="cm_ls_navegacion.php";
$_SESSION['lsnavegacion'] ="cm_ls_navegacion.php";

$dict = $visit->util->getRequest();
$tipo = $dict["tipo"];
$id = $dict["id"];


$fila = new ClsNavegacion();
if ($id=="") {
	$fila = new ClsNavegacion();
	$fila->tipo = $tipo;
	$fila->tiene_contenido = "N";
} else {
	$fila = $visit->dbBuilder->getNavegacionId($id);
	if ($fila->tiene_contenido =="") $fila->tiene_contenido  = "N";
}
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
	

		nombre ="nombre";
		if ( (vall[ nombre ].value=="") ) strError+=" - Nombre" + newLine;
					
		if (strError!="") {
			alert("Compruebe que ha rellenado los siguientes campos:\n"+strError);
			return false;
		} else {				
			return true;
		}
		return true;
	}
</script>

<form name="formulario" action="do.php" method="POST" ENCTYPE="multipart/form-data" >

	<input type="hidden" name="op" value="modificar_navegacion">
	<input type="hidden" name="id" value="<?= $fila->id ?>">
	<input type="hidden" name="orden" value="<?= $fila->orden ?>">
	<input type="hidden" name="tipo" value="<?= $fila->tipo ?>">
	<input type="hidden" name="lang" value="es">
	<input type="hidden" name="idlangprincipal" value="<?= $fila->idlangprincipal ?>">
<TABLE  border="0" width="100%" cellpadding="0" cellspacing="10"  >
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
			 <!-- //alfredo 140707  <A HREF="<?= $session->lsnavegacion?>" onclick="  -->
			<!-- alfredo 140815 <A HREF="<?= $_SESSION['lsnavegacion']?>" onclick="
				var ir=false;
				if (revisarForm()) ir=true;
				else if (confirm('Ha modificado datos, \u00BFSeguro que desea volver?')) ir=true;
				event.returnValue=ir;
				return ir;
				"><IMG SRC="<?=$_parenDir?>bo/img/boton_volver2.gif" WIDTH="84" HEIGHT="21" BORDER="0" ALT="Guardar"></A> -->
				
				<A HREF="<?= $_SESSION['lsnavegacion']?>" onclick="
				var ir=false;
				if (confirm(' \u00BFSeguro que desea volver sin guardar los cambios?')) ir=true;
				event.returnValue=ir;
				return ir;
				"><IMG SRC="<?=$_parenDir?>bo/img/boton_volver2.gif" WIDTH="84" HEIGHT="21" BORDER="0" ALT="Guardar"></A>
				
		</TD>				
		<TD align="right" width="33%">
			&nbsp;
			<? if ($id!="") { ?>
				<A HREF="#" onclick="
					if (confirm('\u00BFSeguro que desea eliminar el elemento?')) {
						window.location.href='do.php?op=eliminar_navegacion&id=<?= $fila->id ?>';
					}
					event.returnValue=false;
					return false;
					"><IMG SRC="<?=$_parenDir?>bo/img/boton_eliminar.gif" WIDTH="84" HEIGHT="21" BORDER="0" ALT=""></A>
			<? } ?>
		</TD>
	</TR>
</TABLE>
<table width="100%" border="0" cellpadding="3" cellspacing="1" style="border:1px solid #CCCCCC;">
<?
if ($id!="") {
	echo '<tr id="div_visible" style="display:block">
		<td class="nombrecampo">
			Id:
		</td>
		<td class="textocampo">	'.
			$id.'
		</td>
	</tr>
	';
}
	?>
	
	<tr id="div_visible" style="display:block">
		<td class="nombrecampo">
			Visible:
		</td>
		<td class="textocampo">	
			<input type="checkbox" name="visible" value="S" <? if ($fila->visible=="S") print "checked"; ?> >
		</td>
	</tr>
	<tr>
		<td class="nombrecampo" colspan="2">
			*Nombre:
			<img src="..img/pc.gif" width="94" height="0">
			<input name="nombre" type="text" maxlength="255" value="<?= $fila->nombre ?>" class="inputmedio"  onchange="cambio(this)">
		</td>
		<td  class="textocampo">
			
		</td>
	</tr>
	<tr>
		<td class="nombrecampo" colspan="2">
			Tooltip:
			<img src="..img/pc.gif" width="108" height="0">
			<input name="tooltip" type="text" size="40" maxlength="255" value="<?= $fila->tooltip ?>" class="inputmedio"  onchange="cambio(this)">
		</td>
	</tr>
	<? if ($tipo=="I") {?>

		<tr  id="div_navegacion" style="display:none">
			<td class="nombrecampo" nowrap>
				Navegaci&oacute;n padre:
			</td>
				<td  class="textocampo">
					<? 
						//$visit->debuger->enable(true);
						$navegacion = new ClsNavegacion();
						$navegacion->tipo = $tipo; 
						$navegacion->lang = "es"; 
						$valores = $visit->dbBuilder->getTablaFiltrada($navegacion);
						$dictFilas = $visit->util->getDict( $valores );
						$sDictFilas = array();
						$numOrden=1000;
						while (list ($clave, $valor) = each ($dictFilas)) { 
							$nombre ="";
							$caminoItems = $visit->util->obtenerCaminoCategoria($dictFilas, "", $valor->id);							
							for ($i=1;$i<count($caminoItems);$i++) $nombre .= " >> ". $visit->util->numDigitos($dictFilas[$caminoItems[$i]]->orden,5) . "_" . $dictFilas[$caminoItems[$i]]->nombre;
							//Si el id de esta categoria est� en el camino no lo meto
							if (!$visit->util->perteneceLista( $fila->id, implode(",",$caminoItems) )) {
								$sDictFilas[$nombre] = $valor;
							}
							$numOrden++;
						}
						ksort( $sDictFilas );
						$valores = &$sDictFilas;			
					?>
					<select name="idpadre" class="selectmedio">
						<option value="0">---- PRINCIPAL ----
						<? while (list ($clave, $valor) = each ($valores)) { ?>					
							<? if ((count(explode(">>",$clave))>3)){?>
							<?}else{?>
								<? if($valor->tipo_contenido != "C"){?>
									<option value="<?= $valor->id ?>" <? if ($valor->id==$fila->idpadre) print "selected"; ?>>
										<?= $visit->util->repetirCadena( "&nbsp;&nbsp;&nbsp;", count(explode(">>",$clave))-2 ) ?>
										<?= $valor->nombre  ?>
								<? }?>
							<?}?>
						<?}?>
					</select>
					
			</td>
		</tr>
	<? }else{?>
		<INPUT TYPE="hidden" NAME="idpadre" value="0">
	<? } ?>
	<? if ($fila->id == ""){?>
		<input name="orden" type="hidden" value="<?= $numOrden ?>">
	<? }?>
	<tr id="div_tienecontenido" style="display:block">
		<td class="nombrecampo">
			Tiene contenido:
		</td>
		<td  class="textocampo">
			<input type="radio" name="tiene_contenido" value="N" <? if ($fila->tiene_contenido=="N") print "checked"; ?> onClick="cambiaTienecontenidos(this.value);toggleOcultacion('div_editor');">No (presenta &uacute;nicamente la imagen y/o texto inferior)<BR>
			<input type="radio" name="tiene_contenido" value="S" <? if ($fila->tiene_contenido=="S") print "checked"; ?> onClick="cambiaTienecontenidos(this.value);toggleOcultacion('div_editor');">S&iacute;
		</td>
	</tr>
	
	<tr id="div_tipocontenidos" style="display:none">
		<td class="nombrecampo">
			Tipo de contenidos:
		</td>
		<td  class="textocampo">

			<? $valores = $fila->getValoresTipoContenido();?>
			<? $hayClasificado = $visit->dbBuilder->hayNavegacionBBDD(); 
			$clasificada= $visit->dbBuilder->getNavegacionTipo("C");
			
			?>
			<SELECT name="tipo_contenido" class="selectcorto" onChange="cambiaValorTipocontenidos(this.value)">
				<OPTION VALUE=""> Seleccionar tipo de contenido
				<? while (list ($clave, $val) = each ($valores)) {?>
					<?
					if( $hayClasificado==1 && $clave=="C" && $clasificada->id!=$fila->id){						
					} else{ ?>					
						<OPTION    value="<?= $clave ?>" <? if ($clave==$fila->tipo_contenido) print "selected"; ?>><?= $val ?>&nbsp;
					<? } ?>
				<? } ?>	
			</SELECT>
		</td>
	</tr>
	
	<tr id="div_ordennoticias" style="display:none">
		<td class="nombrecampo">
		&nbsp;
		</td>
		<td  class="textocampo">

			Ordena las noticias por fecha de forma:
			<SELECT name="orden_noticias" class="selectcorto">
				<OPTION VALUE="DESC"  <? if ("DESC"==$fila->orden_noticias) print "selected"; ?>>DESC
				<OPTION VALUE="ASC"  <? if ("ASC"==$fila->orden_noticias) print "selected"; ?>>ASC
				
			</SELECT>
		</td>
	</tr>
	<tr id="div_paginas" style="display:none">
		<td class="nombrecampo">
			P&aacute;ginas:
		</td>
		<td  class="textocampo">
			<?	$paginas = new ClsPaginas();
				$paginas->lang = "es"; 
				$valores = $visit->dbBuilder->getTablaFiltrada($paginas);
			?>
			<SELECT name="idpagina"  class="selectcorto">
				<OPTION VALUE=""> Seleccionar p&aacute;gina
				<? for($i=0;$i<count($valores);$i++) { ?>
				 <option value="<?= $valores[$i]->id  ?>" <? if ( $valores[$i]->id == $fila->idpagina) print "selected"; ?>><?=  $valores[$i]->titulo ?>
					
					
					
				<? } ?>	
			
		</td>
	</tr>

	<tr id="div_formularios" style="display:none">
		<td class="nombrecampo">
			Formularios:
		</td>
		<td  class="textocampo">
			<? $valores = $visit->options->getTipoFormularios();?>
			<SELECT name="tipo_formulario"  class="selectcorto">
				<OPTION VALUE=""> Seleccionar formulario
				<? while (list ($clave, $valor) = each ($valores)) { ?>
					<option value="<?= $clave  ?>" <? if ($clave ==$comun->tipo_formulario) print "selected"; ?>><?= $valor?>
				<? } ?>	
			
		</td>
	</tr>
	<tr id="div_url" style="display:none">
		<td class="nombrecampo">
			Url:
		</td>
		<td  class="textocampo">
			<? $valores = $fila->getValoresProtocolo();?>
			<SELECT name="protocolo" class="selectcorto">
				<? while (list ($clave, $val) = each ($valores)) { ?>
					<OPTION    value="<?= $clave ?>" <? if ($clave==$fila->protocolo) print "selected"; ?>><?= $val ?>&nbsp;
				<? } ?>	
			</SELECT>
			<INPUT TYPE="text" NAME="url" value="<?= $fila->url?>">
			<br/>
			Ventana externa: <input type="checkbox" name="ventanaexterna" value="S" <? if ($fila->ventanaexterna=="S") print "checked"; ?> >
		</td>
	</tr>

</table>
<BR>
<?  include_once(getcwd()."/inc_top_pestanas.php"); ?>
<table id="div_editor" width="100%" border="0" cellpadding="3" cellspacing="1" <? if($fila->tiene_contenido=="S"){ ?> style="display:none;"<?}?>>
	<tr>
		<td class="nombrecampo">
			Imagen:
		</td>
		<td  class="textocampo">
			
				<table border="0" cellpadding="0" cellspacing="0">
				<? if ($fila->imagen!="") { ?>
					<tr id ="id_ubicacion_imagen">
						<td >
							<INPUT TYPE="hidden" NAME="ubicacion_imagen" value ="<?= $fila->imagen ?>">
							<IMG  SRC="<?= $fila->imagen ?>" WIDTH="328"  BORDER="0" ALT="<?= $fila->imagen ?>"><br>
						<td>
						<TD valign="top" border="0"><A HREF="#" onclick="eliminarRecurso('imagen');return false;"><IMG  SRC="<?=$_parenDir?>bo/img/ico_menos.gif" WIDTH="9" HEIGHT="9" BORDER="0" ALT=""></A>
						</TD>
					</tr>
				<? } ?>
				<tr>
					<td align="left">Actualizar:<BR>
						<iframe id="iframeOculto" name="iframeOculto" style="width:0px; height:0px; border: 0px"></iframe>

						<!-- Boton que redirecciona el IFRAME hacia -->
						 <input name="imagen" type="text" id="imagen" class="inputcorto" style="width:200px;"  onpropertychange="cambio(this)">
						 <input type="button" value="Seleccionar imagen" onClick="window.open ('<?=$_parenDir?>bo/bancorecursos/ls_recursos.php?seleccionar=si&campocontenedor=imagen', '', 'height=600,width=800,location=no,menubar=no,resizable,scrollbars=no,status,toolbar=no');" class="boton"> 
						<!-- <input type="file" name="imagenpequenia" size="20" onChange="cambio()" class="boton"> -->
					</td>
					</tr>
				</table>
				
		</td>
	</tr>

	<tr>
		<td class="nombrecampo">
			Contenido:
		</td>
		<td  class="textocampo">
			<?
								$oFCKeditor = new FCKeditor('contenido') ;
								$oFCKeditor->BasePath = $_parenDir."FCKeditor/";
								$oFCKeditor->Width		= '800' ;
								$oFCKeditor->Height		= '400' ;
								$oFCKeditor->Value = $visit->util->cambiaEtiqueta($fila->contenido,"SPAN", "FONT");
								$oFCKeditor->Create() ;
							?> 
		</td>
	</tr>
	</table>
<?  include_once(getcwd()."/inc_bottom_pestanas.php"); ?>
<BR><BR>

<script>
var idCampos=2;
	function funcload() {
			cambiaValorTipocontenidos("<?= $fila->tipo_contenido?>");
			//cambiaValorTipocontenidos("<?= $fila->tipo?>");
			
			cambiaTienecontenidos("<?= $fila->tiene_contenido?>");
			
		
	}

	window.onload=funcload;
</script>

<TABLE  border="0" width="100%" cellpadding="0" cellspacing="10"  >
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
			 <!-- //alfredo 140707  <A HREF="<?= $session->lsnavegacion?>" onclick="  -->
			<!-- alfredo 140815  <A HREF="<?= $_SESSION['lsnavegacion']?>" onclick="
				var ir=false;
				if (revisarForm()) ir=true;
				else if (confirm('Ha modificado datos \u00BFSeguro que desea volver?')) ir=true;
				event.returnValue=ir;
				return ir;
				"><IMG SRC="<?=$_parenDir?>bo/img/boton_volver2.gif" WIDTH="84" HEIGHT="21" BORDER="0" ALT="Guardar"></A> -->
				
				<A HREF="<?= $_SESSION['lsnavegacion']?>" onclick="
				var ir=false;
				if (confirm(' \u00BFSeguro que desea volver sin guardar los cambios?')) ir=true;
				event.returnValue=ir;
				return ir;
				"><IMG SRC="<?=$_parenDir?>bo/img/boton_volver2.gif" WIDTH="84" HEIGHT="21" BORDER="0" ALT="Guardar"></A>
				
		</TD>				
		<TD align="right" width="33%">
			&nbsp;
			<? if ($id!="") { ?>
				<A HREF="#" onclick="
					if (confirm('\u00BFSeguro que desea eliminar el elemento?')) {
						window.location.href='do.php?op=eliminar_navegacion&id=<?= $fila->id ?>';
					}
					event.returnValue=false;
					return false;
					"><IMG SRC="<?=$_parenDir?>bo/img/boton_eliminar.gif" WIDTH="84" HEIGHT="21" BORDER="0" ALT=""></A>
			<? } ?>
		</TD>
	</TR>
</TABLE>
</form>


<? include_once(getcwd()."/bo_bottom.php"); ?>
