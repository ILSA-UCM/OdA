<? 

/* 
 * Archivo generado dinámicamente por Content Manager
*/
include_once(getcwd()."/include.php");
if (!$visit->options->tieneAcceso("form",$fila)) $visit->options->sinAcceso();

$titulopaginabo="Gesti&oacute;n de P&aacute;ginas";
$explicaciontitulopaginabo="Seleccione la secci&oacute;n a modificar o cree una nueva";
$visit->options->seccion ="Contenido";
$visit->options->subseccion ="Paginas";

include_once(getcwd()."/bo_top.php");

//$visit->debuger->enable(true);


$dict=$visit->util->getRequest();
$npag = $dict["npag"];
$paginacion = $dict["paginacion"];
$orden = $dict["orden"];
$orden_tipo = $dict["orden_tipo"];

if ($npag=="") { 
	$npag=1;
}
// alfredo 140716  $session->lspaginas= $visit->util->getUrlQuery("",$visit->util->getQueryString());
$_SESSION["lspaginas"]= $visit->util->getUrlQuery("",$visit->util->getQueryString());

$visit->options->paginacion=20;
if ($paginacion!="") $visit->options->paginacion=$paginacion;
$visit->options->maxPaginasSiguientes=3;


$urlName=$visit->util->construyeUrlMenosLista("",$visit->util->getRequest(),"npag");
$urlPag=$visit->util->construyeUrlMenosLista("",$visit->util->getRequest(),"npag,paginacion");
$urlOrden=$visit->util->construyeUrlMenosLista("",$visit->util->getRequest(),"orden,orden_tipo");

if ($orden =="") $orden ="id";
if ($orden_tipo =="") $orden_tipo ="ASC";
$ordenar = $orden." ".$orden_tipo;



//$visit->debuger->enable(true);
/*
 * Descomentar y sustituir para Metodo de obtención de filas directo sin filtros.
 $count = $visit->dbBuilder->getPaginasCount(); 
 $inicio = ( $npag - 1 ) * $visit->options->paginacion + 1;
 $filas = $visit->dbBuilder->getPaginasLimit($inicio -1 ,$visit->options->paginacion);
*/
$accionnuevo="cm_form_paginas.php?lang=".$lang;
$paginas = new ClsPaginas();
$visit->options->busquedaGeneral = $q;
$paginas->lang = $lang;
if (trim($ordenar)!="") $paginas->_orderby = $ordenar;
$count = $visit->dbBuilder->getTablaFiltradaCount($paginas); 
$inicio = ( $npag - 1 ) * $visit->options->paginacion + 1;
if ($count==0) $inicio=0;
$filas = $visit->dbBuilder->getTablaFiltradaLimit($paginas, $inicio - 1 ,$visit->options->paginacion);
$strIds = $visit->util->getIds($filas);
//$visit->debuger->enable(true);
//$menus = $visit->dbBuilder->getTablaFiltradaFromIds(new ClsNavegacion(), "idpagina", $strIds);
//$dictNavegacion = $visit->util->getArrayDict( $menus,"idpagina" );
//var_dump($menus);

// COMANAGER 1.0: Codigo personalizado
	function getTitulo() {
		return $this->id;
	} 

	function getAvance() {
		global $visit;
		return $visit->util->acortaCadena( $this->id );
	} 


$menus = $visit->dbBuilder->getTablaFiltradaFromIdsLang(new ClsNavegacion(), "idpagina", $strIds, "es");
$dictNavegacion = $visit->util->getArrayDict( $menus,"idpagina" );
// COMANAGER 1.0: Fin Codigo personalizado
?>	
	

<FORM METHOD=GET ACTION="<?= $visit->util->getNombreArchivo( $visit->util->getScriptName() ) ?>" name="formlistado" style="display:inline;">
	
			<? include("../../bo/inc_paginacion.php");?>
</FORM>
<form name="form_generacion" action="do.php" method="POST"  style="display:inline;">

<TABLE  width="100%" class="lstabla" cellpadding="0" cellspacing="0">
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
				<? } ?>>T&iuml;tulo</A>
				<? if ($orden=="titulo") { ?>
					<IMG SRC="
						<? if ($ordenar=="titulo DESC"){ 
							echo $_parenDir.'/bo/img/ls_flecha_arriba_sobre.gif';
						} else  if ($ordenar=="titulo ASC"){  
							echo $_parenDir.'/bo/img/ls_flecha_abajo_sobre.gif';
						} ?>
					" WIDTH="13" HEIGHT="6" BORDER="0" ALT=""></TD>
				<? } else  { ?>
					<IMG SRC="<?=$_parenDir?>bo/img/pc.gif" WIDTH="13" HEIGHT="6" BORDER="0" ALT=""></TD>
				<? } ?>				

			<!-- Eliminamos Visible -->
			<!-- <TD class="listadocabecera"  >
				<A HREF="<? if ($orden_tipo=="DESC") { ?>
					<?= $visit->util->concatenaUrl($urlOrden,"orden=visible&orden_tipo=ASC") ?>" 
				<? }else{ ?>
					<?= $visit->util->concatenaUrl($urlOrden,"orden=visible&orden_tipo=DESC") ?>" 
				<? } ?>
				<? if ($orden=="visible") { ?>
					class="listadocabeceraorden"
				<? } else { ?>
					class="listadocabeceranormal"
				<? } ?>>Visible</A>
				<? if ($orden=="visible") { ?>
					<IMG SRC="
						<? if ($ordenar=="visible DESC"){ 
							echo $_parenDir.'/bo/img/ls_flecha_arriba_sobre.gif';
						} else  if ($ordenar=="visible ASC"){  
							echo $_parenDir.'/bo/img/ls_flecha_abajo_sobre.gif';
						} ?>
					" WIDTH="13" HEIGHT="6" BORDER="0" ALT=""></TD>
				<? } else  { ?>
					<IMG SRC="<?=$_parenDir?>bo/img/pc.gif" WIDTH="13" HEIGHT="6" BORDER="0" ALT="">
				<? } ?>	
			</TD> -->

			<TD class="listadocabecera"  >
	
				<!-- CAMPO -->
				Men&uacute;s Asociados
			</TD>
				
		<td class="listadocabecera">&nbsp;
		
		</td>
	</tr>


	<? for ($i=0;$i<count($filas);$i++) { ?>
	<?
			if ( $filas[$i]->id=="1") {
				$lsregistros="listadocustom";
			} else if ( ($i % 2) != 0 ) {
				$lsregistros="listadopar";
			} else {
				$lsregistros="listadoimpar";
			}
	?>
		<tr  class="<?= $lsregistros ?>">
			
			<TD width="13" style="border-right:1px solid #ffffff;">
		
			<a href="cm_form_paginas.php?id=<?= $filas[$i]->id ?>&lang=<?= $lang?>"><IMG SRC="<?=$_parenDir?>bo/img/ico_editar.gif" WIDTH="13" HEIGHT="16" BORDER="0" ALT=""></a>
			
			<TD style="border-right:1px solid #ffffff;">
				<a href="cm_form_paginas.php?id=<?= $filas[$i]->id ?>&lang=<?= $lang?>" class="lsenlace"><B><?= $filas[$i]->titulo ?></B></a>
			
			
			</TD>
			
			<!-- Eliminamos Visible -->
			<!-- <TD style="border-right:1px solid #ffffff;">
					<? if ($filas[$i]->visible=="S"){  ?> 
							<IMG SRC="<?=$_parenDir?>bo/img/ico_checked_si.gif" WIDTH="12" HEIGHT="12" BORDER="0" ALT="">  
					<?	}else{ ?>
							<IMG SRC="<?=$_parenDir?>bo/img/ico_checked_no.gif" WIDTH="12" HEIGHT="12" BORDER="0" ALT="">
					<? } ?>
			</TD>
			-->
			<TD style="border-right:1px solid #ffffff;">
				<? for ($j=0;$j<count($dictNavegacion[$filas[$i]->id]);$j++) {?>
					
					<?=  " - ". $dictNavegacion[$filas[$i]->id][$j]->nombre. " - "?><br>
				<? }?>
			</td>
			<TD style="border-right:1px solid #ffffff;">	
				<? if( $visit->options->tieneAcceso("remove",new ClsPaginas()) && $filas[$i]->id!=1){ ?>
					<A HREF="#" onclick="
					if (confirm('Seguro que desea eliminar el elemento ?')) {
						window.location.href='do.php?op=eliminar_paginas&id=<?= $filas[$i]->id ?>&lang=<?= $lang?>';
					}
					return false;"><IMG SRC="<?=$_parenDir?>bo/img/ico_eliminar.gif" WIDTH="14" HEIGHT="16" BORDER="0" ALT=""></A>
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