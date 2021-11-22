<? 
/* 
 * Archivo generado dinámicamente por Content Manager
*/
include_once("include.php");
if (!$visit->options->usuario->id) $visit->options->sinAcceso();
$titulopaginabo="Gesti&oacute;n de Banco de Recursos";
$explicaciontitulopaginabo=" Banco de Recursos ";
$visit->options->seccion ="Contenido";
$visit->options->subseccion = "Banco";
$visit->options->seccionhistory  = "Gestión de Banco de imágenes";

$default_dir="../../download/bancorecursos";// $_parenDir
				
$dict = $visit->util->getRequest();
$seleccionar = $dict["seleccionar"];
$campocontenedor = $dict["campocontenedor"];	
$orden = $dict["orden"]	;
$orden_tipo = $dict["orden_tipo"]	;

if($_GET['path']==''){ //valor pasado por la URL, si esta vació, asignamos el directorio por default

	$path=$default_dir;
 }else{
	$path=$_GET['path'];  //si existe, lo asignamos...
}

$urlSinPath=$visit->util->construyeUrlMenosLista("",$visit->util->getRequest(),"path");

$cadena = substr($path,0,strlen($default_dir));
if ($default_dir!=$cadena) $visit->util->redirect($urlSinPath);
if (isset($seleccionar)) {
	include_once("top_simple.php");
}else{
	include_once("bo_top.php");
}
$urlPag=$visit->util->construyeUrl("",$visit->util->getRequest());
$urlPag = substr($urlPag,1);
$urlPag = "&".$urlPag;




$urlOrden=$visit->util->construyeUrlMenosLista("",$visit->util->getRequest(),"orden,orden_tipo");
?><style>
.lstitulogrid { font-size: 8.5pt; font-family:  Verdana, Helvetica, Arial, sans-serif; color: <?= $theme_cab_forecolor ?>; font-weight:bold; }
.lstextogrid { font-size: 8.5pt; font-family:  Verdana, Helvetica, Arial, sans-serif; }
</style>

<script>
var files="";
function imagenPegar() {
	var archivos="";
	archivos = getCookie("archivos_seleccionados");
	if (archivos!=null) {
		document.images["ImagenPegar"].src="img/pegar.gif";
	}
}
function camposSeleccionados() {

	var f = document.formulario;
	for(i=0;i<f.all.length;i++) {	
		var campo = f[i];
		if (campo!=null) {
			if( campo.checked == true){
				return true;
				break;
			}
		}
	}
	event.returnValue=false;
	return false;
}

function imagenes(item ){
	var f = document.formulario;
	var marcado=0;
	for(i=0;i<f.length;i++) {
		var campo = f[i];
		if (campo!=null) {
			if (campo.checked == true) {
				marcado=1;
				document.images["ImagenCortar"].style.cursor= "pointer";
				document.images["ImagenCortar"].src = "img/cortar.gif";
				document.images["ImagenCopiar"].style.cursor= "pointer";
				document.images["ImagenCopiar"].src = "img/copiar.gif";
				document.images["ImagenEliminar"].style.cursor= "pointer";
				document.images["ImagenEliminar"].src = "img/eliminar.gif";
			}
		}
		if (marcado==0) {
			document.images["ImagenCortar"].style.cursor= "default";
			document.images["ImagenCortar"].src = "img/cortar_disable.gif";
			document.images["ImagenCopiar"].style.cursor= "default";
			document.images["ImagenCopiar"].src = "img/copiar_disable.gif";
			document.images["ImagenEliminar"].style.cursor= "default";
			document.images["ImagenEliminar"].src = "img/eliminar_disable.gif";
		}
	}
}
function checkboxSelected() {
	var n;
	var f = document.formulario;
	for(i=0;i<f.length;i++) {
		var campo = f[i];
		if (campo!=null) {
			var nombreCampo = campo.name;
			if (campo.checked == true) {
				files +=campo.value + ",";
			}
		}
	}
	files=files.substring(0,files.length-1);
	//window.location.href='do.php?files='+files+'&destino=<?= $path ?>&cop='+accion;
}

function imagenesSelected() {
	var n;
	var f = document.formulario;
	for(i=0;i<f.length;i++) {
		var campo = f[i];
		if (campo!=null) {
			var nombreCampo = campo.name;
			if (campo.checked == true) {
				files +=campo.value + ",";
			}
		}
	}
	files=files.substring(0,files.length-1);
	var id = f.idpagina.value;

	window.location.href='../view/do.php?files='+files+'&destino=<?= $path ?>&op=anadir_imagenes&idrecurso='+id+'&tiporecurso=paginas';
	
}

function cargarArchivo(item) {
	var ruta= item.value;
	
	document.formulario.submit();
}


function modArchivos(accion){
	//ESTABLECER COOKIE
	var expdate = new Date ();
	archivos = getCookie("archivos_seleccionados");
	FixCookieDate (expdate); // Correct for Mac date bug - call only once for given Date object!
	expdate.setTime (expdate.getTime() + (60 * 24 * 60 * 60 * 1000)); // 24 hrs from now 
	SetCookie("archivos_seleccionados",files,expdate);
	SetCookie("cop",accion,expdate);
	if (getCookie("archivos_seleccionados")==null){
		alert ("Debe seleccionar al menos un archivo");
	}else if (accion=='cortar_archivos' || accion=='copiar_archivos'){
		document.images["ImagenPegar"].src = "img/pegar.gif";
	}else if (accion=='eliminar_archivos' || accion=='cargar_zip' ){
		<? if ($path==""){
			
				$path="../../download/bancorecursos";
				$mostrar="/bancorecursos";
			
		}
		?>
		window.location.href='do.php?files='+files+'&destino=<?= $path ?>&cop='+accion;
	}
}
function pegar() {
	var archivos="";
	var cop ="";
	archivos = getCookie("archivos_seleccionados");
	cop= getCookie("cop");
	if (archivos==null) {
		alert ("Debe seleccionar al menos un archivo para pegar ");
	
	}else{
		//alert (archivos);
		window.location.href='do.php?files='+archivos+'&destino=<?= $path ?>&cop='+cop;
		//window.location.href='do.php?files='+archivos+'&destino=<?= $path ?>&cop=pega';
	}
}

function borrarFichero(fichero){
	<? if ($path==""){
		$path="../../download/bancorecursos";
	}?>
	window.location.href='do.php?files='+fichero+'&destino=<?= $path ?>&cop=eliminar_archivos';
}
window.onload=imagenPegar;

function compruebaZip(){
	if (document.formulario.nombre_archivo.value!=""){
		extension = document.formulario.nombre_archivo.value;
		extension = extension.substring(extension.length-3, extension.length);
		//alert(extension);
		if (extension!="zip") {
			return false;
		}
	}
	return true;
}

</script>
<?
if (isset($campo)) $campo = "_".$campo;
$dictNuevo = $_GET;
$urlName=$visit->util->construyeUrl( basename ($SCRIPT_NAME), $dictNuevo); 


?>

<TABLE  border="0" width="100%" cellpadding="0" cellspacing="0" style="border-top:1px solid #CCCCCC;border-left:1px solid #CCCCCC;border-right:1px solid #CCCCCC;border-bottom:1px solid #CCCCCC;">
	<TR>		
		<TD height="24" align="left" background="/view/img/backoffice_fondo_cab_tabla.jpg">
		&nbsp;<B>Banco de Recursos</B></TD>						
	</TR>	
</TABLE>
<FORM METHOD="POST" ACTION="do.php" name="formulario"  enctype="multipart/form-data">
	<input type="hidden" name="op" value="cargar_archivo">

	<?if ($path==""){?>

		
		<input type="hidden" name="destino" value="bancorecursos"  class="inputclass" >
	<?}else{?>
		<input type="hidden" name="destino" value="<?= $path ?>"  class="inputclass" >
	<?}?>
	<?if ($seleccionar=="si"){?>
		<BR>
		<INPUT TYPE="button" value="Seleccionar imagen"  class="inputclass"  onClick="
			if ( camposSeleccionados()){
				checkboxSelected();
				window.opener.document.getElementById('contenedorDato').innerText=files;window.close();
			}else{
				alert('<?=utf8_encode("Debe seleccionar al menos una imágen")?>');
			}">
		<INPUT TYPE="file" id="nombre_archivo" name="nombre_archivo" onchange="cargarArchivo(this)" class="inputclass" >
		<INPUT TYPE="hidden" name="parametrosurl"  class="inputclass" value="<?= $visit->util->construyeUrlMenosLista("",$visit->util->getRequest(),"")?>">
		<INPUT TYPE="button" value="Cancelar"  class="inputclass" onClick="window.close()">
		
	<?}else{?>
		<?$imgPegar="img/pegar.gif"?>

	<TABLE  width="100%" border="0" cellpadding="0" cellspacing="0" style="border-top:1px solid #CCCCCC;border-left:1px solid #CCCCCC;border-right:1px solid #CCCCCC;">
	<TR><TD>
		<TABLE border="0">
		<TR>
		<TD >
			<a href="#" onClick= "window.open ('inc_toma_datos.php?path=<?=$path?>', 'crear_carpeta', 'height=150,width=450,location=no,menubar=no,resizable,scrollbars=no,status,toolbar=no');
			event.returnValue=false;
			return false;"><IMG SRC="img/nueva_carpeta.jpg" BORDER="0" ALT="" title="nueva carpeta">
			</a>
		</TD>
		<TD>		
			<IMG SRC="img/browserRefresh.gif" WIDTH="22" HEIGHT="18" BORDER="0" ALT="" onClick="location.reload()" style="cursor: pointer; ">&nbsp;
		</TD>
		<TD>

			<INPUT TYPE="file" name="nombre_archivo" onchange="cargarArchivo(this)" class="inputclass" >
			&nbsp;

			<!-- <A HREF="#" onclick="checkboxSelected();modArchivos('cortar_archivos');
			event.returnValue=false;
			return false;" ><IMG NAME="ImagenCortar" SRC="img/cortar_disable.gif" style="cursor: default;" WIDTH="16" HEIGHT="16" BORDER="0" ALT="" title="Cortar"></A> -->

			<A HREF="#" onclick="checkboxSelected();pegar(); return false;" ><IMG NAME="ImagenPegar" SRC="img/pegar_disable.gif" style="cursor: default;" WIDTH="16" HEIGHT="16" BORDER="0" ALT="" title="Pegar" ></A>
			&nbsp;
			<A HREF="#" onclick="checkboxSelected();modArchivos('copiar_archivos');
			event.returnValue=false;
			return false;" ><IMG NAME="ImagenCopiar" SRC="img/copiar_disable.gif" style="cursor: default;" WIDTH="16" HEIGHT="16" BORDER="0" ALT="" title="Copiar"></A>
			&nbsp;
			<A href="#" onclick="checkboxSelected();modArchivos('eliminar_archivos');
			event.returnValue=false;
			return false;"><IMG NAME="ImagenEliminar" SRC="img/eliminar.gif" WIDTH="22" HEIGHT="17" BORDER="0" ALT="" style="cursor: default;" title="Eliminar seleccionados"></A>
		</TD>
		<!--<TD>
			<A href="#" onclick="compruebaZip();modArchivos('cargar_zip');
			return false;">Cargar Zip</A>
		</TD>-->
	</TR>
</TABLE>
</TD>
</TR>
</TABLE>
<?}?>

<div style="border:0px solid black; width:100%; height:520px; overflow:auto;">
<DIV width="97%" height="100%" >
<TABLE width="100%"  border="0" cellpadding="0" cellspacing="0">
	
	<TR>
			<TD colspan="2">
			<TABLE width="100%"  border="1" cellpadding="6" cellspacing="0">				
				<TR>
					<TD>
						<?
							$current_dir=basename($path);
							$parent_dir= preg_replace("/$current_dir$","",$path);
							
						
						?>
						<a href='<?= $visit->util->concatenaUrl( $urlSinPath,"path=". $parent_dir ) ?>'><img src="img/subir_carpeta.gif" border="0"></a><B><?= str_replace("../"," ",$path)?></B>
					</TD>
				</TR>
			</TABLE>
			</TD>
		
		</TR>
	<TR>
		<TD width="55%" height="280" bgcolor="#FFFFFF" align="left" valign="top" style="border-right:1px solid #cccccc;border-left:1px solid #cccccc;">
			<TABLE width="100%"  border="0" cellpadding="0" cellspacing="0">				
				<TR>
					
					<TD background="img/fondo_cab.gif" height="20"><a href="<?= $visit->util->concatenaUrl($urlOrden,"orden=nombre&orden_tipo=ASC") ?>">Nombre</a></TD>
					
					<TD background="img/fondo_cab.gif" height="20"><a href="<?= $visit->util->concatenaUrl($urlOrden,"orden=size&orden_tipo=ASC") ?>">Tama&ntilde;o</a></TD>
					
					<TD background="img/fondo_cab.gif" height="20"><a href="<?= $visit->util->concatenaUrl($urlOrden,"orden=fecha&orden_tipo=ASC") ?>">Fecha mod.</a></TD>

					<TD background="img/fondo_cab.gif" height="20"><a href="#">Eliminar</a></TD>
				</TR>
				<!-- VICTOR METE -->
				<?
				//indicamos el directorio donde inicia el explorador

				                                       
				if ($orden=="") $orden="nombre";
				
				$filenames = $visit->util->getCarpetas ($path, $orden);
				for ($i;$i<count($filenames); $i++){
					$file=$filenames[$i];   
					if(is_dir("$path/$file")){  // si es un directorio, si lo es, tenemos dos casos que sea el ../
						if($file==".."){ // si son ../ regresamos un nivel
						?>
					   <? }else {// mostramos el nombre del directorio ?>
							<?if ($file!=""){?>
								<TR> 
									<TD colspan="3">
										
										<? if ($seleccionar=="") {?>	
											<INPUT TYPE="checkbox" NAME="file_<?= $file?>" VALUE="<?= $path."/".$file?>" onclick="imagenes(this)"> 
										<? }else{ ?>
											<IMG SRC="<?=$_parenDir?>bo/img/pc.gif" WIDTH="20" HEIGHT="17" BORDER="0" ALT="">
										<? } ?>
										<IMG SRC="img/carpeta.gif" WIDTH="20" HEIGHT="17" BORDER="0" ALT=""><a href='<?= $urlSinPath ?>&path=<?= $path."/".$file ?>' ><?= $file?></a>
									</td>
								</tr>
							<?}?>
					   <? }           
							
				  }else{ //si no es un directorio, es un archivo, lo mostramos con su url
				 ?>      
					<TR> 
						<TD>
							<? $ext= $visit->util->getExtensionArchivo($file)?>
							<? $icono= $visit->util->getIconoExtension($file)?>
							<INPUT TYPE="checkbox" NAME="file_<?= $file?>" VALUE="<?= $path."/".$file?>" 
								<?if ($seleccionar=="si"){?> 
								onClick="

									if (confirm('Ha seleccionado <?= $file?> Seguro que desea continuar?')){ 								
								

										<? if ($origen=="textoenriquecido"){?>
											window.opener.document.formimage['src'].value='/bancoimagenes/<?= $path."/".$file?>';
											window.close();
										<?}else if ($origen=="textoenriquecidoOver"){?>
											window.opener.document.formimage['onmouseover'].value='/bancoimagenes/<?= $path."/".$file?>';
											window.close();
										<?}else if ($origen=="textoenriquecidoOut"){?>
											window.opener.document.formimage['onmouseout'].value='/bancoimagenes/<?= $path."/".$file?>';
											window.close();

										<?}else if ($origen=="textoenriquecidofck"){?>
											var nodo = getElement('txtUrl', window.opener.document);
											nodo.value='/bancoimagenes/<?= $path."/".$file?>';
											window.close();
										
										<?}else if ($origen=="paginas"){?>
											window.location.href='<?=$_parenDir?>/bo/galeria/do.php?op=anadir_imagenespaginas&lang=<?= $lang?>&idpaginaimagenes=<?= $idrecurso?>&imagen=<?= $path."/".$file?>&orden=<?= $ordenar?>';
									

										<?}else{?>
											window.opener.document.formulario<?= $numForm?>['<?= $campocontenedor?>'].value='<?= $path."/".$file?>';window.close();
										<?}?>
									}else{
										this.checked=false;
									}"
								
								<?}else{?>
									onclick="imagenes(this)"
								<?}?>>
							
								<IMG SRC="img/<?= $icono?>"  BORDER="0" ALT="">
							
							<a href="cm_view_banco.php?nombre_archivo=<?=$path."/".$file.$urlSel?>" target="iframef"><B><?=$file?></B> </a>
						</TD>
						<TD align="right" nowrap>
							<?
								$kas = ceil( filesize($path."/".$file)/1024 );
							?>
							<?= $kas ?> Kb&nbsp;
						</TD>
						<TD>
							<?= date("d/m/Y", fileatime($path."/".$file)); ?>
						</td>
						<td align="center">
							<a href="javascript:if(confirm('\u00BFEst\u00e1 seguro que quiere eliminar <?=$file?>?')){
										borrarFichero('<?= $path."/".$file?>');
									}">
								<img width="14" border="0" height="16" alt="" src="../img/ico_eliminar.gif">
							</a>
						</td>
					</tr>
						
				<?}?>
								
				<? } ?>
					</td>
				</tr>
				<tr><td><IMG SRC="<?=$_parenDir?>bo/img/pc.gif" WIDTH="10" HEIGHT="10" BORDER="0" ALT=""></td></tr>
				
			
			</table>
			<!-- FIN VICTOR METE -->
</FORM>

</TD>

	<TD width="52%" align="left" bgcolor="#FFFFFF" valign="top">						
		<iframe name="iframef" src="cm_view_banco.php?path=<?= $path.$urlSel?>" width="100%" height="400" frameborder="0" scrolling="no"></iframe>
	</TD>
	</TR>

</TABLE>
</div>
</div>

<?
include_once(getcwd()."/bo_bottom.php");
?>