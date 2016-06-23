<? 

/* 
 * Archivo generado dinámicamente por Content Manager
*/
include_once(getcwd()."/include.php");


$titulopaginabo="Gestión de Páginas";
$explicaciontitulopaginabo="Seleccione la sección a modificar o cree una nueva";
$visit->options->seccion ="Contenido";
$visit->options->subseccion ="Galeria";

include_once(getcwd()."/bo_top.php");

//$visit->debuger->enable(true);

if ($npag=="") { 
	$npag=1;
}
// alfredo  140716  $session->lspagina_imagenes= $visit->util->getUrlQuery("",$visit->util->getQueryString());
$_SESSION["lspagina_imagenes"]= $visit->util->getUrlQuery("",$visit->util->getQueryString());
$visit->options->paginacion=20;
if ($paginacion!="") $visit->options->paginacion=$paginacion;
$visit->options->maxPaginasSiguientes=3;


$urlName=$visit->util->construyeUrlMenosLista("",$visit->util->getRequest(),"npag");
$urlPag=$visit->util->construyeUrlMenosLista("",$visit->util->getRequest(),"npag,paginacion");
$urlOrden=$visit->util->construyeUrlMenosLista("",$visit->util->getRequest(),"orden,orden_tipo");

if ($orden =="") $orden ="titulo";
if ($orden_tipo =="") $orden_tipo ="ASC";
$ordenar = $orden." ".$orden_tipo;



//$visit->debuger->enable(true);
/*
 * Descomentar y sustituir para Metodo de obtención de filas directo sin filtros.
 $count = $visit->dbBuilder->getPaginasCount(); 
 $inicio = ( $npag - 1 ) * $visit->options->paginacion + 1;
 $filas = $visit->dbBuilder->getPaginasLimit($inicio -1 ,$visit->options->paginacion);
*/
$accionnuevo="cm_form_pagina_imagenes.php?lang=".$lang;
$paginas = new ClsPaginaImagenes();
$visit->options->busquedaGeneral = $q;
$paginas->lang = $lang;
if (trim($ordenar)!="") $paginas->_orderby = $ordenar;
$count = $visit->dbBuilder->getTablaFiltradaCount($paginas); 
$inicio = ( $npag - 1 ) * $visit->options->paginacion + 1;
if ($count==0) $inicio=0;
$filas = $visit->dbBuilder->getTablaFiltradaLimit($paginas, $inicio - 1 ,$visit->options->paginacion);

$strIds = $visit->util->getIds($filas);


// COMANAGER 1.0: Codigo personalizado
	function getTitulo() {
		return $this->id;
	} 

	function getAvance() {
		global $visit;
		return $visit->util->acortaCadena( $this->id );
	} 


$menus = $visit->dbBuilder->getTablaFiltradaFromIds(new ClsNavegacion(), "idpagina", $strIds);
$dictNavegacion = $visit->util->getArrayDict( $menus,"idpagina" );
// COMANAGER 1.0: Fin Codigo personalizado
?>	
	

<FORM METHOD=GET ACTION="<?= $visit->util->getNombreArchivo( $visit->util->getScriptName() ) ?>" name="formlistado" style="display:inline;">
	
			<? include("../../bo/inc_paginacion.php");?>
</FORM>
<form name="form_generacion" action="do.php" method="POST"  style="display:inline;">

<TABLE  width="100%" cellpadding="0" class="lstabla" cellspacing="0">
	<!-- CAMPOS -->


	<TR>
		<TD class="listadocabecera"   colspan="2">
	
				<!-- CAMPO -->
				<A HREF="<? if ($orden_tipo=="DESC") { ?>
					<?= $visit->util->concatenaUrl($urlOrden,"orden=titulo&orden_tipo=ASC") ?>" 
				<? }else{ ?>
					<?= $visit->util->concatenaUrl($urlOrden,"orden=titulo&orden_tipo=DESC") ?>" 
				<? } ?>
				<? if ($orden=="titulo") { ?>
					class="listadocabeceraorden"
				<? } else { ?>
					class="listadocabeceranormal"
				<? } ?>><?=utf8_encode("Título:")?></A>
				<? if ($orden=="titulo") { ?>
					<IMG SRC="
						<? if ($ordenar=="titulo DESC"){ 
							echo $_parenDir.'/bo/img/ls_flecha_arriba_sobre.gif';
						} else  if ($ordenar=="titulo ASC"){  
							echo $_parenDir.'/bo/img/ls_flecha_abajo_sobre.gif';
						} ?>
					" WIDTH="13" HEIGHT="6" BORDER="0" ALT=""></TD>
				<? } else  { ?>
					<IMG SRC="/bo/img/pc.gif" WIDTH="13" HEIGHT="6" BORDER="0" ALT=""></TD>
				<? } ?>				

		<TD class="listadocabecera" >
	
				<!-- CAMPO -->
				<A HREF="<? if ($orden_tipo=="DESC") { ?>
					<?= $visit->util->concatenaUrl($urlOrden,"orden=cuenta&orden_tipo=ASC") ?>" 
				<? }else{ ?>
					<?= $visit->util->concatenaUrl($urlOrden,"orden=cuenta&orden_tipo=DESC") ?>" 
				<? } ?>
				<? if ($orden=="titulo") { ?>
					class="listadocabeceraorden"
				<? } else { ?>
					class="listadocabeceranormal"
				<? } ?>>Cuenta</A>
				<? if ($orden=="cuenta") { ?>
					<IMG SRC="
						<? if ($ordenar=="cuenta DESC"){ 
							echo '<?=$_parenDir?>/bo/img/ls_flecha_arriba_sobre.gif';
						} else  if ($ordenar=="cuenta ASC"){  
							echo '<?=$_parenDir?>/bo/img/ls_flecha_abajo_sobre.gif';
						} ?>
					" WIDTH="13" HEIGHT="6" BORDER="0" ALT=""></TD>
				<? } else  { ?>
					<IMG SRC="<?=$_parenDir?>/bo/img/pc.gif" WIDTH="13" HEIGHT="6" BORDER="0" ALT=""></TD>
				<? } ?>				
				
			<TD class="listadocabecera"  >
	
				<!-- CAMPO -->
				Menus Asociados
			</TD>
				
		<td class="listadocabecera">&nbsp;
			
		</td>
	</tr>


	<? for ($i=0;$i<count($filas);$i++) { ?>
	<?
		if ( ($i % 2) != 0 ) {
			$lsregistros="listadopar";
		} else {
			$lsregistros="listadoimpar";
		}
	?>
		<tr  class="<?= $lsregistros ?>">
			
			<TD width="13" style="border-right:1px solid #ffffff;">
			
			<a href="cm_form_pagina_imagenes.php?id=<?= $filas[$i]->id ?>&lang=<?= $lang?>"><IMG SRC="<?=$_parenDir?>/bo/img/ico_editar.gif" WIDTH="13" HEIGHT="16" BORDER="0" ALT=""></a>
			
			<TD style="border-right:1px solid #ffffff;">
				<a href="cm_form_pagina_imagenes.php?id=<?= $filas[$i]->id ?>&lang=<?= $lang?>" class="lsenlace"><B><?= $filas[$i]->titulo ?></B></a>
			
			
			</TD>
			

			<TD style="border-right:1px solid #ffffff;">
				<?= $filas[$i]->cuenta ?>
			</TD>

			<TD style="border-right:1px solid #ffffff;">
				<? for ($j=0;$j<count($dictNavegacion[$filas[$i]->id]);$j++) {?>
					<? if ($dictNavegacion[$filas[$i]->id][$j]->tipo_contenido=="I" && $dictNavegacion[$filas[$i]->id][$j]->lang=="es"){ ?>
						<?=  " - ". $dictNavegacion[$filas[$i]->id][$j]->nombre. " - "?><br>
					<? } ?>
				<? }?>
			</td>
			<TD style="border-right:1px solid #ffffff;">	
				<? if( $visit->options->tieneAcceso("remove",new ClsPaginaImagenes())){ ?>
					<A HREF="#" onclick="
					if (confirm('<?=utf8_encode("¿Seguro que desea eliminar el elemento?")?>')) {
						window.location.href='do.php?op=eliminar_pagina_imagenes&id=<?= $filas[$i]->id ?>&lang=<?= $lang?>';
					}
					return false;"><IMG SRC="<?=$_parenDir?>/bo/img/ico_eliminar.gif" WIDTH="14" HEIGHT="16" BORDER="0" ALT=""></A>
				<? }else{ ?>
					&nbsp;
				<? } ?>
			</td>
		</tr>
	<? } ?>
</table>
</FORM>
<? $n=1;?>
<FORM METHOD=GET ACTION="<?= $visit->util->getNombreArchivo( $visit->util->getScriptName() ) ?>" name="formlistado1" style="display:inline;">

	<? include("../../bo/inc_paginacion.php");?>

</FORM> 


	<?
include_once(getcwd()."/bo_bottom.php");
?>
