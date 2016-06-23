<?
/* 
 * Archivo generado dinámicamente por Content Manager
*/
include_once(getcwd()."/include.php");
include_once("../../FCKeditor/fckeditor.php") ;
$dict = $visit->util->getRequest();
if ($id=="") {
	$fila = new ClsPaginas();
	$fila->orden ="0";
} else {
	$fila = $visit->dbBuilder->getPaginasId($id); 
}
$visit->options->seccion ="Contenido";
$visit->options->subseccion ="Paginas";
$titulopaginabo="Gesti&oacute;n de P&aacute;ginas";
$explicaciontitulopaginabo="Cumplimente el siguiente formulario.";
// alfredo  10716   $session->lspaginas = "cm_ls_paginas.php";
$_SESSION["lspaginas"] = "cm_ls_paginas.php";
if (!$visit->options->tieneAcceso("form",$fila)) $visit->options->sinAcceso();

$obj = new ClsContenidosPagina();
$filas = $visit->dbBuilder->getContenidosPaginaFromIdpagina( $id );
if ($filas[0]->id==null) $noExiste="1";

include_once(getcwd()."/bo_top.php");
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
		nombre ="titulo";
		if ( esVacio(getValor(vall[ nombre ])) ) strError+=" - Titulo" + newLine;
					
		if (strError!="") {
			alert("Compruebe que ha rellenado los siguientes campos:\n"+strError);
			return false;
		} else {				
			return true;
		}
		return true;
	}

	function eliminarRecurso(tipo) {
		var vall = document.formulario;
		nombre ="ubicacion_"+tipo;
		vall[ nombre ].value="";
		getElement('img_eliminar_'+tipo).style.display='none';
	}
	
</script>
<BR>


<form name="formulario" onload action="do.php" method="POST" ENCTYPE="multipart/form-data"  onsubmit="; return compruebaCampos()">
	<input type="hidden" name="op" value="modificar_paginas">
	<input type="hidden" name="id" value="<?= $fila->id ?>">
	<input type="hidden" name="lang" value="<?= $lang ?>">
	<input type="hidden" name="idlangprincipal" value="<?= $fila->idlangprincipal ?>">
	<table width="100%" border="0" cellpadding="3" cellspacing="1">
	<tr>
		<td class="nombrecamporeq">
			*Titulo:
		</td>
		<td  class="textocampo">
			<input name="titulo" type="text" size="40" maxlength="255" value="<?= $visit->util->mostrar($fila->titulo) ?>" class="inputlargo" onchange="cambio(this)">
		</td>
	</tr>
	</table>
	<? 
	/*
	//Si no hay paginas en este idioma intento sacar las páginas del idioma asociado. Además reseteo el id para que vuelva a guardarlo en BBDD
	if (count($filas)==0) {
		
		$filas = $visit->dbBuilder->getContenidosPaginaFromIdpagina( $fila->idlangprincipal );
		for ($j=0;$j<count($filas);$j++) {
			$filas[$j]->id="";
		}
	}
	*/
	include_once(getcwd()."/inc_cm_popup_contenidospagina.php");
?>
<BR><BR>
<table width="100%" border="0" cellpadding="3" cellspacing="1"  style="border:1px solid #CCCCCC;">
	<tr>
		<td class="nombrecampo">Documento</td>
		<td>
			<table border="0" >
				<? if ($fila->documento!="") { ?>
					<tr id="id_ubicacion_documento">
						<td>
							<input name="ubicacion_documento" type="hidden" value="<?= $fila->documento?>">
							<a href="<?= $visit->util->getUrlArchivo($fila->documento) ?>" target="_blank">
								<?= $visit->util->getNombreArchivo($fila->documento) ?>
							</a>
							<img SRC="<?=$_parenDir?>bo/img/ico_menos.gif" onclick="
									var ubicacion='ubicacion_documento';
									document.formulario[ubicacion].value='';
									getElement('id_ubicacion_documento').style.display='none';">
						<td>
					</tr>
				<? } ?>
				<tr>
					<td>
						<input name="documento" type="text" id="documento" class="inputcorto" style="width:200px;">
						<input type="button" value="Seleccionar documento" onClick="window.open ('<?=$_parenDir?>bo/bancorecursos/ls_recursos.php?seleccionar=si&campocontenedor=documento', '', 'height=600,width=800,location=no,menubar=no,resizable,scrollbars=no,status,toolbar=no');" class="boton"> 
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<!--<tr>
		<td class="nombrecampo">
			Visible:
		</td>
		<td  class="textocampo">
			<input type="checkbox" name="visible" value="S" <? if ($fila->visible=="S") print "checked"; ?> onchange="cambio(this)">
		</td>
	</tr>-->
</table>
	<script>
	//Para que funcione las relaciones 1-n
	var idCampos=2;
	function fun_load() {
	<? if ($noExiste=="1") { ?>
		//document.formulario.submit();
	<? } ?>
		//	capturaCadena_campocontenidospagina();	
	}
	window.onload=fun_load;	
	</script>
	<TABLE  border="0" width="100%" cellpadding="0" cellspacing="10">
		<TR>				
			<TD align="left">
					<input type="image" onclick="
					if (compruebaCampos()) {
						document.formulario.submit();
					}
					event.returnValue=false;
					return false;
					" SRC="<?=$_parenDir?>bo/img/boton_guardar.gif" WIDTH="84" HEIGHT="21" BORDER="0" ALT="Guardar">
			</TD>
			<TD align="center">
				
					<!-- <A HREF="<?= $_SESSION["lspaginas"] ?>" onclick="
					var ir=false;
					if (revisarForm()) ir=true;
					else if (confirm('Ha modificado datos, Seguro que desea volver?')) ir=true;
					event.returnValue=ir;
					return ir;
					"><IMG SRC="<?=$_parenDir?>bo/img/boton_volver2.gif" WIDTH="84" HEIGHT="21" BORDER="0" ALT="Volver"></A> 
						-->
					
					<A HREF="<?= $_SESSION["lspaginas"] ?>" onclick="
					var ir=false;
					if (confirm('Seguro que desea volver sin guardar los cambios?')) ir=true;
					event.returnValue=ir;
					return ir;
					"><IMG SRC="<?=$_parenDir?>bo/img/boton_volver2.gif" WIDTH="84" HEIGHT="21" BORDER="0" ALT="Volver"></A>
				
				<!-- alfredo  140716  <A HREF="<?= $session->lspaginas ?>" onclick="  
				<A HREF="<?= $_SESSION["lspaginas"] ?>" onclick="
					var ir=true;
					if (confirm('Seguro que desea volver sin salvar los cambios?')) ir=true;
					event.returnValue=ir;
					return ir;
					"><IMG SRC="<?=$_parenDir?>bo/img/boton_volver2.gif" WIDTH="84" HEIGHT="21" BORDER="0" ALT="Volver"></A>
			</TD> -->				
			<TD align="right">
				&nbsp;
				<? if ($id!="" && $id!="1") { ?>
					<A HREF="#" onclick="
						if (confirm('Seguro que desea eliminar el elemento?')) {
							window.location.href='do.php?op=eliminar_paginas&id=<?= $fila->id ?>&lang=<?= $lang?>';
						}
						event.returnValue=false;
						return false;
						"><IMG SRC="<?=$_parenDir?>bo/img/boton_eliminar.gif" WIDTH="84" HEIGHT="21" BORDER="0" ALT="Eliminar"></A>
				<? } ?>
			</TD>
		</TR>
	</TABLE>
</form>
<? include_once(getcwd()."/bo_bottom.php"); ?>