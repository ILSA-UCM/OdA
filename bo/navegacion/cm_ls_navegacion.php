<? 

/* 
 * Archivo generado dinámicamente por Content Manager
*/
include_once(dirname(__FILE__)."/include.php");
if (!$visit->options->tieneAcceso("ls",new ClsNavegacion())) $visit->options->sinAcceso();

$titulopaginabo="Gesti&oacute;n de Men&uacute;s";
$explicaciontitulopaginabo="Seleccione la secci&oacute;n a modificar o cree una nueva";
$visit->options->seccion = "Navegacion";

$npag = $dict["npag"];
$paginacion = $dict["paginacion"];
$orden = $dict["orden"];
$orden_tipo = $dict["orden_tipo"];
$tipo = $dict["tipo"];


$fila = new ClsNavegacion();
if ($tipo=="") {
	$tipo = "I"; 
} /*/else if ($tipo=="B") {
	$visit->options->seccion="Preferencias";

}*/
include_once(getcwd()."/bo_top.php");

//$visit->debuger->enable(true);

if ($npag=="") { 
	$npag=1;
}

//alfredo 140707   $session->lsnavegacion= $visit->util->getUrlQuery("",$visit->util->getQueryString());
$_SESSION['lsnavegacion']= $visit->util->getUrlQuery("",$visit->util->getQueryString());
$visit->options->paginacion=20;
if ($paginacion!="") $visit->options->paginacion=$paginacion;
$visit->options->maxPaginasSiguientes=3;


$urlName=$visit->util->construyeUrlMenosLista("",$visit->util->getRequest(),"npag");
$urlPag=$visit->util->construyeUrlMenosLista("",$visit->util->getRequest(),"npag,paginacion");
$urlOrden=$visit->util->construyeUrlMenosLista("",$visit->util->getRequest(),"orden,orden_tipo");
$ordenar = $orden." ".$orden_tipo;
/*
 * Descomentar y sustituir para Metodo de obtención de filas directo sin filtros.
 $count = $visit->dbBuilder->getNavegacionCount(); 
 $inicio = ( $npag - 1 ) * $visit->options->paginacion + 1;
 $filas = $visit->dbBuilder->getNavegacionLimit($inicio -1 ,$visit->options->paginacion);
*/




$inicio = 1;
$fila->tipo = $tipo;

$fila->lang = $lang;
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


$preferencia = $visit->dbBuilder->getPreferenciaFromAtributo("navegacion_".$tipo."_plegada");
if (!$preferencia ) $preferencia = new ClsPreferenciasPresentacion();

if ($visit->util->perteneceLista($tipo,"I,D")) {
?>	
		
<!-- <FORM METHOD=POST ACTION="do.php" name="formValor">
	<INPUT TYPE="hidden" NAME="op" value="modificar_preferencias_presentacion">
	<INPUT TYPE="hidden" NAME="atributo" value="navegacion_<?= $tipo?>_plegada">
	<INPUT TYPE="hidden" NAME="tipo" value="N">
	<INPUT TYPE="hidden" NAME="tiponav" value="<?= $tipo?>">
	<INPUT TYPE="hidden" NAME="id" value="<?= $preferencia->id?>">
	<INPUT TYPE="hidden" NAME="lang" value="<?= $lang?>">
	<TABLE  border="0" width="100%" cellpadding="0" cellspacing="0" style="border:1px solid #d0d0d0;">
		<TR>
			<TD width="50%" height="24" align="left"  class="buscador">
				<B>Presentación de la navegacion:</B>
			</TD>
			<TD  class="buscador">
			<? $valores = $preferencia->getValoresPresentacionNavegacion(); ?>
			<select NAME="valor" onchange="document.formValor.submit();">
				<option value="">Seleccionar presentación de navegación
				<? while (list ($clave, $val) = each ($valores)) { ?>
					<option value="<?= $clave?>" <? if ($preferencia->valor==$clave) print 'selected'?>><?= $val?>
					
				<? } ?>	
			</TD>
		</TR>
	</TABLE>
</FORM>
<BR><BR>
 --><? } ?>
		

<TABLE  border="0" width="100%" cellpadding="0" cellspacing="0">
	<TR>
		<TD width="50%" height="24" align="left">&nbsp;Total: <?= $count ?> categor&iacute;as</TD>
		<TD width="50%" align="right" valign="bottom">
		<a href="cm_form_navegacion.php?tipo=<?= $tipo?>">
		<IMG SRC="<?=$_parenDir?>bo/img/boton_nuevo.gif" WIDTH="77" HEIGHT="21" BORDER="0" ALT=""></a>
		&nbsp;				
		</TD>
	</TR>
</TABLE>


<TABLE class="lstabla" width="100%" cellpadding="0" cellspacing="0">
		<!-- CAMPOS -->
	<tr>
		<td class="listadocabecera">Nombre Men&uacute;</td>
		<td class="listadocabecera" width="50">Orden</td>
		<td class="listadocabecera" width="50">Visible</td>
		<td class="listadocabecera" width="20">&nbsp;<td>
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
					<IMG SRC="<?=$_parenDir?>bo/img/pc.gif" WIDTH="<?= $ancho ?>" HEIGHT="1" BORDER="0" ALT="">
					<a href="cm_form_navegacion.php?id=<?= $fila->id ?>&tipo=<?=  $fila->tipo?>&lang=<?= $lang?>"><IMG SRC="<?=$_parenDir?>bo/img/ico_editar.gif" WIDTH="13" HEIGHT="16" BORDER="0" ALT=""></a>&nbsp;
					<a href="cm_form_navegacion.php?id=<?= $fila->id ?>&tipo=<?=  $fila->tipo?>&lang=<?= $lang?>"
							title="<?= $fila->tooltip ?>"
						>
						<b><?= $fila->nombre ?></b></a>
				</TD>
				<TD class="<?= $lsregistros ?>">
					<A HREF="do.php?op=mover_navegacion&id=<?= $fila->id ?>&valor=1&tipo=<?=  $fila->tipo?>&lang=<?= $lang?>"><IMG SRC="<?=$_parenDir?>bo/img/flecha_up.gif" WIDTH="16" HEIGHT="16" BORDER="0" ALT=""></A>
					<A HREF="do.php?op=mover_navegacion&id=<?= $fila->id ?>&valor=-1&tipo=<?= $fila->tipo?>&lang=<?= $lang?>"><IMG SRC="<?=$_parenDir?>bo/img/flecha_down.gif" WIDTH="16" HEIGHT="16" BORDER="0" ALT=""></A>
				</td>
			<TD class="<?= $lsregistros ?>">
					<? if ($fila->visible=="S"){  ?> 
							<IMG SRC="<?=$_parenDir?>bo/img/ico_checked_si.gif" WIDTH="12" HEIGHT="12" BORDER="0" ALT="">  
					<?	}else{ ?>
							<IMG SRC="<?=$_parenDir?>bo/img/ico_checked_no.gif" WIDTH="12" HEIGHT="12" BORDER="0" ALT="">
					<? } ?>
			</TD>
				<TD class="<?= $lsregistros ?>">		
					<A HREF="#" onclick="
					if (confirm('Seguro que desea eliminar el elemento?')) {
						window.location.href='do.php?op=eliminar_navegacion&id=<?= $fila->id ?>&lang=<?= $lang?>';
					}
					return false;"><IMG SRC="<?=$_parenDir?>bo/img/ico_eliminar.gif" WIDTH="14" HEIGHT="16" BORDER="0" ALT=""></A>
				</td>
			</tr>
			
		<? } ?>
	</table>

<TABLE  width="100%" cellpadding="0" cellspacing="0">
	<TR>
		<TD height="26" width="100%" align="right" valign="bottom">
		<br>
			<a href="cm_form_navegacion.php?tipo=<?= $tipo?>&lang=<?= $lang?>">
			<IMG SRC="<?=$_parenDir?>bo/img/boton_nuevo.gif" WIDTH="77" HEIGHT="21" BORDER="0" ALT=""></a>
			&nbsp;				
		</TD>		
	</TR>
</TABLE>


	<?
include_once(getcwd()."/bo_bottom.php");
?>