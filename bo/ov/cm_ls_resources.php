<? 

/* 
 * Archivo generado dinámicamente por Content Manager
*/
include_once(dirname(__FILE__)."/include.php");
if (!$visit->options->tieneAcceso("ls",new ClsResources())) $visit->options->sinAcceso();


$visit->options->seccion = "OV";
$visit->options->subseccion = "Recursos";

include_once(dirname(__FILE__)."/bo_top.php");
//$visit->debuger->enable(true);

if ($npag=="") { 
	$npag=1;
}
// alfredo 140716  $session->lsresources= $visit->util->getUrlQuery("",$visit->util->getQueryString());
$_SESSION["lsresources"]= $visit->util->getUrlQuery("",$visit->util->getQueryString());
$visit->options->paginacion=20;
if ($paginacion!="") $visit->options->paginacion=$paginacion;
$visit->options->maxPaginasSiguientes=3;


$urlName=$visit->util->construyeUrlMenosLista("",$visit->util->getRequest(),"npag");
$urlPag=$visit->util->construyeUrlMenosLista("",$visit->util->getRequest(),"npag,paginacion");
$urlOrden=$visit->util->construyeUrlMenosLista("",$visit->util->getRequest(),"orden,orden_tipo");
$ordenar = $orden." ".$orden_tipo;
/*
 * Descomentar y sustituir para Metodo de obtención de filas directo sin filtros.
 $count = $visit->dbBuilder->getResourcesCount(); 
 $inicio = ( $npag - 1 ) * $visit->options->paginacion + 1;
 $filas = $visit->dbBuilder->getResourcesLimit($inicio -1 ,$visit->options->paginacion);
*/

$resources = new ClsResources();


if (trim($ordenar)!="") $resources->_orderby = $ordenar;
$count = $visit->dbBuilder->getTablaFiltradaCount($resources); 
$inicio = ( $npag - 1 ) * $visit->options->paginacion + 1;
if ($count==0) $inicio=0;
$filas = $visit->dbBuilder->getTablaFiltradaLimit($resources, $inicio - 1 ,$visit->options->paginacion);


// COMANAGER 1.0: Codigo personalizado
	function getTitulo() {
		return $this->id;
	} 

	function getAvance() {
		global $visit;
		return $visit->util->acortaCadena( $this->id );
	} 
// COMANAGER 1.0: Fin Codigo personalizado
?>	

	<FORM METHOD=GET ACTION="<?= $visit->util->getNombreArchivo( $visit->util->getScriptName() ) ?>" name="formlistado" style="display:inline;">
		<input type="hidden" name="paginacion" value="<?= $visit->options->paginacion ?>">

		<INPUT TYPE="text" NAME="q" class="inputmediofiltro" value="<?= $visit->options->busquedaGeneral ?>">
		<input type="image" SRC="img/gw_ico_buscar.gif" WIDTH="22" HEIGHT="17" BORDER="0" ALT="">

		<TABLE width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
			<TR>
				<TD width="200" valign="bottom" align="left">
					<TABLE width="200" border="0" cellpadding="0" cellspacing="0"  background="img/filtros_tit_fondo.gif" style="border-left:1px solid #B1B1B1;border-right:1px solid #B1B1B1;border-top:1px solid #B1B1B1;" > 		
						<TR>
							<TD width="11"><IMG SRC="img/filtros_bullet_titulos.gif" WIDTH="11" HEIGHT="19" BORDER="0" ALT=""></TD>
							<TD valign="middle" width="130"  nowrap><span class="titcuadro">Listado de recursos</span></TD>
							<TD width="3"><IMG SRC="img/pc.gif" WIDTH="3" HEIGHT="17" BORDER="0" ALT=""></TD>						
						</TR>	
					</TABLE>				
				</TD>
				<TD align="center" valign="bottom">
					
				</TD>
				
			</TR>
		</TABLE>

		<TABLE  border="0" width="100%" cellpadding="0" cellspacing="0" style="border:1px solid #CCCCCC;">
			<TR>
				<TD width="30%" height="24" align="left"  background="img/backoffice_fondo_cab_tabla.jpg">&nbsp;[<?= $inicio ?>-<?= $visit->util->muestrahastareg($visit->options->paginacion,$count,$npag) ?>] de <?= $count ?>&nbsp;
					<? $valoresPaginacion=explode(",","20,40,60,100,200,400"); ?>
					<select name ="paginacion"  class="selectpeque" style="width:60px;" onChange="window.location.href=construyeUrlMenosMas(window.location.href,'paginacion,npag','paginacion='+formlistado.paginacion.value)" >
						<? for ($i=0;$i<count($valoresPaginacion);$i++) { ?>
							<option value="<?= $valoresPaginacion[$i] ?>" <? if ($visit->options->paginacion==$valoresPaginacion[$i]) print "selected"; ?>><?= $valoresPaginacion[$i] ?>
						<? } ?>
						<option value ="999999" <? if ($paginacion=="999999") echo "selected"; ?> >Todas
					</select>
				</TD>
				
				<TD width="40%" nowrap background="img/backoffice_fondo_cab_tabla.jpg" align="center">
				
				<? $visit->util->imprimirPaginacion($visit->options->paginacion, $visit->options->maxPaginasSiguientes, $count, $npag, $urlName); ?>
				
				</TD>
				
			</TR>
		</TABLE>
</FORM>
<form name="form_generacion" action="do.php" method="POST"  style="display:inline;">

<TABLE class="lstabla" width="100%" cellpadding="0" cellspacing="0" style='padding-left=3px;'>
	<!-- CAMPOS -->
	<TR>
					<TD class="lscabecera" >
			<!-- CAMPO -->
			<TABLE  border="0" cellpadding="0" cellspacing="0">
				<TR>
						<TD nowrap class="camposls">Nombre&nbsp;</TD>
					</TR>
			</TABLE>				
			<!-- FIN CAMPO -->
		</TD>
						<td class="lscabecera">
			&nbsp;
		</td>
	</tr>
<!-- FILTROS -->
<!-- FILTROS -->
<!-- FILTROS -->
	
	<TR>
						
		<TD class="lscabecerafiltros" >			
						&nbsp;
						
		</TD>
						<td class="lscabecerafiltros">&nbsp;</td>
	</tr>

<!-- FIN FILTROS -->
<!-- FIN FILTROS -->
<!-- FIN FILTROS -->


	<? for ($i=0;$i<count($filas);$i++) { ?>
	<?
		if ( ($i % 2) != 0 ) {
			$lsregistros="lsregistrospar";
		} else {
			$lsregistros="lsregistrosimpar";
		}
	?>
		<tr>

					<TD class="<?= $lsregistros ?>" ><?= $filas[$i]->name ?></TD>
			<TD class="<?= $lsregistros ?>">		
				<A HREF="#" onclick="
				if (confirm('<?=utf8_encode("¿Seguro que desea eliminar el elemento?")?>')) {
					window.location.href='do.php?op=eliminar_resources&id=<?= $filas[$i]->id ?>';
				}
				return false;"><IMG SRC="img/ico_eliminar.gif" WIDTH="14" HEIGHT="16" BORDER="0" ALT=""></A>
			</td>
		</tr>
	<? } ?>
</table>
<TABLE  width="100%" cellpadding="0" cellspacing="0" style="border:1px solid #CCCCCC;">
	<TR>
		<TD width="30%" height="24" align="left"  background="img/backoffice_fondo_cab_tabla.jpg">&nbsp;[<?= $inicio ?>-<?= $visit->util->muestrahastareg($visit->options->paginacion,$count,$npag) ?>] de <?= $count ?>&nbsp;
			<? $valoresPaginacion=explode(",","20,40,60,100,200,400"); ?>
		</TD>
		
		<TD width="40%" nowrap background="img/backoffice_fondo_cab_tabla.jpg" align="center">
		
		<? $visit->util->imprimirPaginacion($visit->options->paginacion, $visit->options->maxPaginasSiguientes, $count, $npag, $urlName); ?>
		
		</TD>
		
	</TR>
</TABLE>


	<?
include_once(dirname(__FILE__)."/bo_bottom.php");
?>