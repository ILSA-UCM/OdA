<?
/* 
 * Archivo generado dinámicamente por Content Manager
*/
include_once(getcwd()."/include.php");
include_once("../../FCKeditor/fckeditor.php") ;
//
$dict = $visit->util->getRequest();
if ($id=="") {
	$fila = new ClsPaginaImagenes();
	$fila->orden ="0";
	} else {
	
	$fila = $visit->dbBuilder->getPaginaImagenesIdlangprincipal($id,$lang); 
}
$visit->options->seccion ="Contenido";
$visit->options->subseccion ="Galeria";
$titulopaginabo="Gestión de Páginas de Imágenes";
$explicaciontitulopaginabo="Cumplimente el siguiente formulario.";
if (!$visit->options->tieneAcceso("form",$fila)) $visit->options->sinAcceso();
include_once(getcwd()."/bo_top.php");
//$visit->debuger->enable(true);

if ($npag=="") { 
	$npag=1;
}

if ($paginacion=="") { 
	$paginacion = "100";
	$visit->options->paginacion=100;
}else{
	$visit->options->paginacion=$paginacion;
	
}
$visit->options->maxPaginasSiguientes=3;

$urlPag=$visit->util->construyeUrlMenosLista("",$visit->util->getRequest(),"npag,paginacion");
$urlName=$visit->util->construyeUrlMenosLista("",$visit->util->getRequest(),"npag");

$inicio = ( $npag - 1 ) * $visit->options->paginacion + 1;

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


<form name="formulario" action="do.php" method="POST" ENCTYPE="multipart/form-data" onsubmit="; return compruebaCampos()">

	<input type="hidden" name="op" value="modificar_pagina_imagenes">
	<input type="hidden" name="id" value="<?= $fila->id ?>">
	<input type="hidden" name="lang" value="<?= $lang ?>">
	<input type="hidden" name="idlangprincipal" value="<?= $fila->idlangprincipal ?>">
	<?  include_once(getcwd()."/inc_top_pestanas.php"); ?>
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

<?    include_once(getcwd()."/inc_bottom_pestanas.php");  ?>

		<TABLE  border="0" width="100%" cellpadding="0" cellspacing="10">
			<TR>				
				<TD align="left">
						<input type="image" onclick="
						if (compruebaCampos()) {
							document.formulario.submit();
						}
						event.returnValue=false;
						return false;
						" SRC="/bo/img/boton_guardar.gif" WIDTH="84" HEIGHT="21" BORDER="0" ALT="Guardar">
				</TD>
				<TD align="center">
					<!--  alfredo  140716  <A HREF="<?= $session->lspagina_imagenes ?>" onclick="  -->
					<A HREF="<?= $_SESSION["lspagina_imagenes"] ?>" onclick="
						var ir=false;
						if (revisarForm()) ir=true;
						else if (confirm('<?=utf8_encode("Ha modificado datos ¿Seguro que desea volver?")?>')) ir=true;
						event.returnValue=ir;
						return ir;
						"><IMG SRC="/bo/img/boton_volver2.gif" WIDTH="84" HEIGHT="21" BORDER="0" ALT="Volver"></A>
				</TD>				
				<TD align="right">
					&nbsp;
					<? if ($id!="" &&  $visit->options->tieneAcceso("remove",new ClsPaginaImagenes())) { ?>
						<A HREF="#" onclick="
							if (confirm('<?=utf8_encode("¿Seguro que desea eliminar el elemento?")?>')) {
								window.location.href='do.php?op=eliminar_pagina_imagenes&id=<?= $fila->id ?>&lang=<?= $lang?>';
							}
							event.returnValue=false;
							return false;
							"><IMG SRC="/bo/img/boton_eliminar.gif" WIDTH="84" HEIGHT="21" BORDER="0" ALT="Eliminar"></A>
					<? } ?>
				</TD>
			</TR>
		</TABLE>
</form>

<? if ($id!=""){

	

	$count = $visit->dbBuilder->getCountImagenesFromPagina($fila->id, $lang);
	$filaimagenes= $visit->dbBuilder->getTablaImagenesFromPaginaLimit($fila->id,$lang, $inicio - 1 ,$visit->options->paginacion);
			
?>	
	
		<form name="form_imagenes" action="do.php" method="POST" ENCTYPE="multipart/form-data" onsubmit="return compruebaCampos()">
				<iframe id="iframeOculto" name="iframeOculto" style="width:0px; height:0px; border: 0px"></iframe>
				<input type="hidden" name="op" value="modificar_imagenespaginas">
				<input type="hidden" name="idpaginaimagenes" value="<?= $id ?>">
				<input type="hidden" name="lang" value="<?= $lang ?>">
					<TABLE  border="0" width="100%" cellpadding="6" cellspacing="0">
					<TR>
					<TD width="70%">Listado de <B><?=utf8_encode("Imágenes")?></B></TD>
						<TD width="30%" height="24" align="right">&nbsp;[<?= $inicio ?>-<?= $visit->util->muestrahastareg($visit->options->paginacion,$count,$npag) ?>] de <?= $count ?>&nbsp;
						<? $valoresPaginacion=explode(",","5,10,20,40,60,100,200,400"); ?>
						<select name ="paginacion"  style="width:60px;" onChange="window.location.href='<?= $urlPag ?>&paginacion='+form_imagenes.paginacion.value" >
						<? for ($i=0;$i<count($valoresPaginacion);$i++) { ?>
							<option value="<?= $valoresPaginacion[$i] ?>" <? if ($paginacion==$valoresPaginacion[$i]) print "selected"; ?>><?= $valoresPaginacion[$i] ?>
						<? } ?>
						<option value ="999999" <? if ($paginacion=="999999") echo "selected"; ?> >Todas
					</select>
						</TD>
					</TR>
					<TR>
						<TD width="40%" nowrap background="img/backoffice_fondo_cab_tabla.jpg" align="center">
				
				<? $visit->util->imprimirPaginacion($visit->options->paginacion, $visit->options->maxPaginasSiguientes, $count, $npag, $urlName); ?>
				
				</TD>
					</TR>
				</TABLE>
				<? include_once(getcwd()."/inc_ls_imagenes.php");?>
				<!-- Boton que redirecciona el IFRAME hacia -->
				<!--  <input name="campo_1_imagen" type="text" id="campo_1_contenedorImagen"> -->
				<? $indice = $count-1?>
				<iframe id="iframeOculto" name="iframeOculto" style="width:0px; height:0px; border: 0px"></iframe>

						<!-- Boton que redirecciona el IFRAME hacia -->
						 <input name="imagen" type="hidden" id="imagen" class="inputcorto" style="width:200px;">
						 <input type="button" value="Seleccionar imagen" onClick="window.open ('/bo/bancorecursos/ls_recursos.php?seleccionar=si&campocontenedor=imagen&campoimagen=campo_1_&origen=paginas&idrecurso=<?= $id?>&tiporecurso=paginas&lang=es&ordenar=<?= $filaimagenes[$indice]->orden +1?>', '', 'height=600,width=800,location=no,menubar=no,resizable,scrollbars=no,status,toolbar=no');" class="boton"> 
				<!-- <input type="file" name="imagen_asociada" size="10" onChange="cambio()"> -->
		<BR><BR>
		<A HREF="#" onclick="document.form_imagenes.submit();return false;"><IMG SRC="/bo/img/boton_guardar.gif" WIDTH="84" HEIGHT="21" BORDER="0" ALT=""></A>
		</form>
		
	
<? }?>
<? 
//	$visit->debuger->enable(true);
	//$obj = new ClsContenidosPagina();
	//$filas = $visit->dbBuilder->getContenidosPaginaFromIdpagina( $fila->id );
	
	//include_once(getcwd()."/inc_cm_popup_contenidospagina.php");
   include_once(getcwd()."/inc_bottom_pestanas.php"); 
?>
<BR><BR>


						<script>
				//Para que funcione las relaciones 1-n
				var idCampos=2;
				function fun_load() {


						capturaCadena_campocontenidospagina();	
	}
				//window.onload=fun_load;	
			</script>


</form>
<? include_once(getcwd()."/bo_bottom.php"); ?>
