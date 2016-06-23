<? 

/* 
 * Archivo generado dinámicamente por Content Manager
*/
include_once(dirname(__FILE__)."/include.php");
//if (!$visit->options->tieneAcceso("ls",new ClsSectionData())) $visit->options->sinAcceso();
include_once(dirname(__FILE__)."/bo_top.php");



if ($npag=="") { 
	$npag=1;
}
// alfredo  140716  $session->lssection_data= $visit->util->getUrlQuery("",$visit->util->getQueryString());
$_SESSION["lssection_data"]= $visit->util->getUrlQuery("",$visit->util->getQueryString());
$visit->options->paginacion=20;
if ($paginacion!="") $visit->options->paginacion=$paginacion;
$visit->options->maxPaginasSiguientes=3;


$urlName=$visit->util->construyeUrlMenosLista("",$visit->util->getRequest(),"npag");
$urlPag=$visit->util->construyeUrlMenosLista("",$visit->util->getRequest(),"npag,paginacion");
$urlOrden=$visit->util->construyeUrlMenosLista("",$visit->util->getRequest(),"orden,orden_tipo");
$ordenar = $orden." ".$orden_tipo;
/*
 * Descomentar y sustituir para Metodo de obtención de filas directo sin filtros.
 $count = $visit->dbBuilder->getSectionDataCount(); 
 $inicio = ( $npag - 1 ) * $visit->options->paginacion + 1;
 $filas = $visit->dbBuilder->getSectionDataLimit($inicio -1 ,$visit->options->paginacion);
*/

$sectionData = new ClsSectionData();

//$visit->debuger->enable(true);

if (trim($ordenar)!="") $sectionData->_orderby = $ordenar;
$count = $visit->dbBuilder->getTablaFiltradaCount($sectionData); 
$inicio = ( $npag - 1 ) * $visit->options->paginacion + 1;
if ($count==0) $inicio=0;
$filas = $visit->dbBuilder->getTablaFiltradaLimit($sectionData, $inicio - 1 ,$visit->options->paginacion);


// COMANAGER 1.0: Codigo personalizado
	function getTitulo() {
		return $this->id;
	} 

	function getAvance() {
		global $visit;
		return $visit->util->acortaCadena( $this->id );
	} 
// COMANAGER 1.0: Fin Codigo personalizado
?>	<?
		include("theme.php");
	?>
	

	<FORM METHOD=POST ACTION="do.php" name="formValor">
	<INPUT TYPE="hidden" NAME="op" value="modificar_preferencias_presentacion">
	<INPUT TYPE="hidden" NAME="atributo" value="secciones_plegado">
	<INPUT TYPE="hidden" NAME="tipo" value="C">
	<INPUT TYPE="hidden" NAME="id" value="<?= $preferencia->id?>">
	<INPUT TYPE="hidden" NAME="lang" value="<?= $lang?>">

</FORM>
<BR><BR>
		

<!-- <TABLE  border="0" width="100%" cellpadding="0" cellspacing="0" >
	<TR>
		<TD width="30%" height="24" align="left">&nbsp;Total: <?= $count ?> categorías &nbsp;
		</TD>
		
	
		<TD width="30%" align="right" valign="bottom" >
		<a href="cm_form_secciones_catalogo.php?tipo=<?= $tipo?>">
		<IMG SRC="/bo/img/boton_nuevo.gif" WIDTH="77" HEIGHT="21" BORDER="0" ALT=""></a>
		&nbsp;				
		</TD>
	
	</TR>
</TABLE> -->


<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border:1px solid #d0d0d0;">	
		<!-- CAMPOS -->
	<tr>
		<td class="lscabecera">Nombre Sección</td>
		<td class="lscabecera" width="50">Orden</td>
		<td class="lscabecera" width="50">Visible</td>
		<td class="lscabecera" width="20">&nbsp;<td>
	</tr>
	<!-- FILTROS -->
	<!-- FILTROS -->
	<!-- FILTROS -->
		
		
	<!-- FIN FILTROS -->
	<!-- FIN FILTROS -->
	<!-- FIN FILTROS -->

	<? while (list ($clave, $fila) = each ($filas)) { ?>		
		<?
			$i++;
			if ( ($i % 2) != 0 ) {
				$lsregistros="listadopar";
			} else {
				$lsregistros="listadoimpar";
			}
			$caminoItems = $visit->util->obtenerCaminoCategoria($dictFilas, "", $fila->id);
			$ancho=18*(count($caminoItems)-2);
		?>
			<tr>
				<TD class="<?= $lsregistros ?>" nowrap>
					<IMG SRC="/bo/img/pc.gif" WIDTH="<?= $ancho ?>" HEIGHT="1" BORDER="0" ALT="">
					<a href="cm_form_section_data.php?id=<?= $fila->id ?>"><IMG SRC="/bo/img/ico_editar.gif" WIDTH="13" HEIGHT="16" BORDER="0" ALT=""></a>
					<a href="cm_form_section_data.php?id=<?= $fila->id ?>"
							title="<?= $fila->tooltip ?>"
						>
						<B><?= $fila->nombre ?></B></a>
				</TD>
			<TD class="<?= $lsregistros ?>">
					<A HREF="do.php?op=mover_section_data&id=<?= $fila->id ?>&valor=1"><IMG SRC="/bo/img/flecha_up.gif" WIDTH="16" HEIGHT="16" BORDER="0" ALT=""></A>
					<A HREF="do.php?op=mover_section_data&id=<?= $fila->id ?>&valor=-1"><IMG SRC="/bo/img/flecha_down.gif" WIDTH="16" HEIGHT="16" BORDER="0" ALT=""></A>
				</td>
			<TD class="<?= $lsregistros ?>">
					<? if ($fila->visible=="S"){  ?> 
							<IMG SRC="/bo/img/ico_checked_si.gif" WIDTH="12" HEIGHT="12" BORDER="0" ALT="">  
					<?	}else{ ?>
							<IMG SRC="/bo/img/ico_checked_no.gif" WIDTH="12" HEIGHT="12" BORDER="0" ALT="">
					<? } ?>
			</TD>
				<TD class="<?= $lsregistros ?>">		
					<A HREF="#" onclick="
					if (confirm('<?=utf8_encode("¿Seguro que desea eliminar el elemento?")?>')) {
						window.location.href='do.php?op=eliminar_section_data&id=<?= $fila->id ?>';
					}
					return false;"><IMG SRC="/bo/img/ico_eliminar.gif" WIDTH="14" HEIGHT="16" BORDER="0" ALT=""></A>
				</td>
			</tr>
			
		<? } ?>
	</table>
<TABLE  width="100%" cellpadding="0" cellspacing="0" >
	<TR>
		<TD width="30%" height="24" align="left" >
			&nbsp;
		
		</TD>
		
			<TD width="30%" align="right" valign="bottom" >
			<a href="cm_form_section_data.php?tipo=<?= $tipo?>">
			<IMG SRC="/bo/img/boton_nuevo.gif" WIDTH="77" HEIGHT="21" BORDER="0" ALT=""></a>
			&nbsp;				
			</TD>
		
	</TR>
</TABLE>


	<?
include_once(getcwd()."/bo_bottom.php");
?>

