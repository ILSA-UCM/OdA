<? 

/* 
 * Archivo generado dinámicamente por Content Manager
*/

include_once(dirname(__FILE__)."/include.php");
//$visit->debuger->enable(true);
$visit->options->seccion = "OV";
$visit->options->subseccion ="Secciones";

$fila = new ClsSectionData();
$fila->lang="es";
//if (!$visit->options->tieneAcceso("ls",new ClsSectionData())) $visit->options->sinAcceso();
include_once(dirname(__FILE__)."/bo_top.php");


if ($npag=="") { 
	$npag=1;
}
// alfredo 140716  $session->lssecciones_catalogo= $visit->util->getUrlQuery("",$visit->util->getQueryString());
$_SESSION["lssecciones_catalogo"]= $visit->util->getUrlQuery("",$visit->util->getQueryString());
$visit->options->paginacion=20;
if ($paginacion!="") $visit->options->paginacion=$paginacion;
$visit->options->maxPaginasSiguientes=3;


$urlName=$visit->util->construyeUrlMenosLista("",$visit->util->getRequest(),"npag");
$urlPag=$visit->util->construyeUrlMenosLista("",$visit->util->getRequest(),"npag,paginacion");
$urlOrden=$visit->util->construyeUrlMenosLista("",$visit->util->getRequest(),"orden,orden_tipo");
$ordenar = $orden." ".$orden_tipo;

/* $count = $visit->dbBuilder->getSectionDataCount(); 
 $inicio = ( $npag - 1 ) * $visit->options->paginacion + 1;
 $filas = $visit->dbBuilder->getSectionDataLimit($inicio -1 ,$visit->options->paginacion);
*/




$inicio = 1;
$filas = $visit->dbBuilder->getTablaFiltrada($fila);
$count = count($filas);
if ($count==0) $inicio=0;

$valores = &$filas;
$dictFilas = $visit->util->getDict( $valores );
$sDictFilas = array();
while (list ($clave, $valor) = each ($dictFilas)) { 
	$nombre ="";
	$caminoItems = $visit->util->obtenerCaminoCategoria($dictFilas, "", $valor->id);
	for ($i=0;$i<count($caminoItems);$i++) $nombre .= " >> ". $visit->util->numDigitos($dictFilas[$caminoItems[$i]]->orden,5) . "_" . $dictFilas[$caminoItems[$i]]->nombre;
	$sDictFilas[$nombre] = $valor;
}
ksort( $sDictFilas );
$filas = &$sDictFilas;
?>
<script>
	window.onload = function()
	{
	  GetDivPosition();
	}
</script>
<TABLE  width="100%" cellpadding="0" cellspacing="0" border="0">
	<TR>
		<TD align="center" valign="bottom" >
			<a href="cm_form_section_data.php?tipo=<?= $tipo?>">
			<IMG SRC="../img/boton_nuevo.gif" WIDTH="77" HEIGHT="21" BORDER="0" ALT=""></a>
			&nbsp;				
		</TD>		
	</TR>
</TABLE>
<br/>
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border:1px solid #d0d0d0;">	
		<!-- CAMPOS -->
	<tr class="listadoimpar">
		<td class="lscabecera">Nombre Secci&oacute;n</td>
		<td class="lscabecera" width="50">Orden</td>
		<td class="lscabecera" width="70">Navegable</td>
		<td class="lscabecera" width="70">Visible<td>
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
			if ( $fila->id=="111" || $fila->id=="112") {
				$lsregistros="listadocustom";
			} else if ( ($i % 2) != 0 ) {
				$lsregistros="listadopar";
			} else {
				$lsregistros="listadoimpar";
			}
			$caminoItems = $visit->util->obtenerCaminoCategoria($dictFilas, "", $fila->id);
			$ancho=18*(count($caminoItems)-2);
		?>
		<? if($fila->id<=3){?>
		<tr>
			<td class="<?= $lsregistros ?>" nowrap colspan="4" align="left">
				<B><?= $fila->nombre ?></B></a>
			</td>
		</tr>
		<? } else { ?>
		<tr>
			<TD class="<?= $lsregistros ?>" nowrap>
				<IMG SRC="../img/pc.gif" WIDTH="<?= $ancho ?>" HEIGHT="1" BORDER="0" ALT="">
				<a href="cm_form_section_data.php?id=<?= $fila->id ?>"><IMG SRC="../img/ico_editar.gif" WIDTH="13" HEIGHT="16" BORDER="0" ALT=""></a>
				<a href="cm_form_section_data.php?id=<?= $fila->id ?>"
						title="<?= $fila->tooltip ?>"
					>
					&nbsp;<B><?= $fila->nombre ?></B></a>
			</TD>
			<TD class="<?= $lsregistros ?>">
					<A onclick="SetDivPosition()" HREF="do.php?op=mover_section_data&id=<?= $fila->id ?>&valor=1">
						<IMG SRC="../img/flecha_up.gif" WIDTH="16" HEIGHT="16" BORDER="0" ALT="">
					</A>
					<A onclick="SetDivPosition()" HREF="do.php?op=mover_section_data&id=<?= $fila->id ?>&valor=-1">
						<IMG SRC="../img/flecha_down.gif" WIDTH="16" HEIGHT="16" BORDER="0" ALT="">
					</A>
				</td>
			<TD class="<?= $lsregistros ?>">
					<? if ($fila->browseable=="S"){  ?> 
							<IMG SRC="../img/ico_checked_si.gif" WIDTH="12" HEIGHT="12" BORDER="0" ALT="">  
					<?	}else{ ?>
							<IMG SRC="../img/ico_checked_no.gif" WIDTH="12" HEIGHT="12" BORDER="0" ALT="">
					<? } ?>
			</TD>
			<TD class="<?= $lsregistros ?>">
					<? if ($fila->visible=="S"){  ?> 
							<IMG SRC="../img/ico_checked_si.gif" WIDTH="12" HEIGHT="12" BORDER="0" ALT="">  
					<?	}else{ ?>
							<IMG SRC="../img/ico_checked_no.gif" WIDTH="12" HEIGHT="12" BORDER="0" ALT="">
					<? } ?>
			</TD>
			<?
			if ($fila->idpadre!=0 && $fila->tipo_valores!="") {
			 //	$cuenta= $visit->dbBuilder->getOVsFromSeccionCount($fila->id,$fila->tipo_valores);
				//$cuenta=count($ovs);
				?>
				<? if ($cuenta==0) { ?>
					<!-- <TD class="<?= $lsregistros ?>">		
						<A HREF="#" onclick="
						if (confirm('<?=utf8_encode("¿Seguro que desea eliminar el elemento?")?>')) {
							window.location.href='do.php?op=eliminar_section_data&id=<?= $fila->id ?>';
						}
						return false;"><IMG SRC="../img/ico_eliminar.gif" WIDTH="14" HEIGHT="16" BORDER="0" ALT=""></A>
					</td> -->
				<? } ?>
		<? } ?>
		</tr>
		<? } ?>	
		<? } ?>
	</table>
<TABLE  width="100%" cellpadding="0" cellspacing="0" border="0" style="padding-top:20px;">
	<TR>
		<TD align="center" valign="bottom" >
			<a href="cm_form_section_data.php?tipo=<?= $tipo?>">
			<IMG SRC="../img/boton_nuevo.gif" WIDTH="77" HEIGHT="21" BORDER="0" ALT=""></a>
			&nbsp;				
		</TD>		
	</TR>
</TABLE>
	<?
include_once(getcwd()."/bo_bottom.php");
?>