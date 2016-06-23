<? 

/* 
 * Archivo generado dinámicamente por Content Manager
*/

include_once(dirname(__FILE__)."/include.php");
if (!$visit->options->tieneAcceso("ls",new ClsVirtualObject())) $visit->options->sinAcceso();

$visit->options->seccion = "OV";
$visit->options->subseccion = "ObjetosVirtuales";


include_once(dirname(__FILE__)."/bo_top.php");

//$visit->debuger->enable(true);

if ($npag=="") { 
	$npag=1;
}

// alfredo 140707  $session->lsvirtual_object= $visit->util->getUrlQuery("",$visit->util->getQueryString());
$_SESSION['lsvirtual_object']= $visit->util->getUrlQuery("",$visit->util->getQueryString());

$visit->options->paginacion=20;
if ($paginacion!="") $visit->options->paginacion=$paginacion;
$visit->options->maxPaginasSiguientes=3;


$urlName=$visit->util->construyeUrlMenosLista("",$visit->util->getRequest(),"npag");
$urlPag=$visit->util->construyeUrlMenosLista("",$visit->util->getRequest(),"npag,paginacion");
$urlOrden=$visit->util->construyeUrlMenosLista("",$visit->util->getRequest(),"orden,orden_tipo");
$ordenar = $orden." ".$orden_tipo;
/*
 * Descomentar y sustituir para Metodo de obtención de filas directo sin filtros.
 $count = $visit->dbBuilder->getVirtualObjectCount(); 
 $inicio = ( $npag - 1 ) * $visit->options->paginacion + 1;
 $filas = $visit->dbBuilder->getVirtualObjectLimit($inicio -1 ,$visit->options->paginacion);
*/



if($visit->options->usuario->esRolSuperAdmin()){
	$virtualObject = new ClsVirtualObject();
	if (trim($ordenar)!="") $virtualObject->_orderby = $ordenar;
	$count = $visit->dbBuilder->getTablaFiltradaCount($virtualObject); 
	$inicio = ( $npag - 1 ) * $visit->options->paginacion + 1;
	if ($count==0) $inicio=0;
	$filas = $visit->dbBuilder->getTablaFiltradaLimit($virtualObject, $inicio - 1 ,$visit->options->paginacion);
} else if($visit->options->usuario->esRolAdmin()){
	$filas = $visit->dbBuilder->getPermisosFromUsuario($visit->options->usuario->id);
} else {
	$filas = null;
	$count = 0;
	$inicio = 0;
}

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
<?
//Recursos plegados
$preferencia = $visit->dbBuilder->getPreferenciaFromAtributo("navegacion_".$tipo."_plegada");
if (!$preferencia ) $preferencia = new ClsPreferenciasPresentacion();
if ($visit->util->perteneceLista($tipo,"I,D")) {
?>	
<FORM METHOD=POST ACTION="do.php" name="formValor">
	<INPUT TYPE="hidden" NAME="op" value="modificar_preferencias_presentacion">
	<INPUT TYPE="hidden" NAME="atributo" value="navegacion_<?= $tipo?>_plegada">
	<INPUT TYPE="hidden" NAME="tipo" value="N">
	<INPUT TYPE="hidden" NAME="tiponav" value="<?= $tipo?>">
	<INPUT TYPE="hidden" NAME="id" value="<?= $preferencia->id?>">
	<INPUT TYPE="hidden" NAME="lang" value="<?= $lang?>">
	<TABLE  border="0" width="100%" cellpadding="0" cellspacing="0" style="border:1px solid #d0d0d0;">
		<TR>
			<TD width="50%" height="24" align="left"  class="buscador">
				<B>Presentaci&oacute;n de la navegacion:</B>
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
<? } ?>

	<FORM METHOD=GET ACTION="<?= $visit->util->getNombreArchivo( $visit->util->getScriptName() ) ?>" name="formlistado" style="display:inline;">
		<!-- <input type="hidden" name="paginacion" value="<?= $visit->options->paginacion ?>"> -->
		<TABLE width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
			<TR>
				<TD width="200" valign="bottom" align="left">
					<TABLE width="200" border="0" cellpadding="0" cellspacing="0"  background="img/filtros_tit_fondo.gif" style="border-left:1px solid #B1B1B1;border-right:1px solid #B1B1B1;border-top:1px solid #B1B1B1;" > 		
						<TR>
							<TD width="11"><IMG SRC="img/filtros_bullet_titulos.gif" WIDTH="11" HEIGHT="19" BORDER="0" ALT=""></TD>
							<TD valign="middle"  nowrap><span class="titcuadro">Listado de objetos digitales</span></TD>
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
					<? $valoresPaginacion= explode(",","20,40,60,100,200,400"); ?>
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
				<TD width="30%" align="right" valign="bottom" background="img/backoffice_fondo_cab_tabla.jpg">
				<a href="cm_form_virtual_object.php"><IMG SRC="img/boton_nuevo.gif" WIDTH="77" HEIGHT="21" BORDER="0" ALT=""></a>
				&nbsp;				
				</TD>
			</TR>
		</TABLE>
</FORM>
<form name="form_generacion" action="do.php" method="POST"  style="display:inline;">

<TABLE class="lstabla" width="100%"  cellpadding="0" cellspacing="0" border="0">
	<!-- CAMPOS -->
	<TR>
		<TD width="20" class="lscabecera"><!-- <INPUT TYPE="checkbox" NAME="checkboxtotal" onClick="selectAll(document.form_generacion,this.checked==true)"> --></TD>
	
		<TD class="lscabecera" width="30">
			<!-- CAMPO -->
			<TABLE  border="0" cellpadding="0" cellspacing="0" width='30'>
				<TR>
						<TD nowrap width='20'
							<? if ($orden=="name") { ?>
								class="camposlsactivo"
							<? } else { ?>
								class="camposls"
							<? } ?>
							>Identificador&nbsp;
						</TD>
						<TD nowrap ><A HREF="<?= $visit->util->concatenaUrl($urlOrden,"orden=id&orden_tipo=DESC") ?>"><IMG SRC="
							<? if ($ordenar=="id DESC"){ 
								echo 'img/ls_flecha_arriba_sobre.gif';
							} else { 
								echo 'img/ls_flecha_arriba_normal.gif';
							} ?>
							" WIDTH="13" HEIGHT="6" BORDER="0" ALT=""></A><BR><A HREF="<?= $visit->util->concatenaUrl($urlOrden,"orden=id&orden_tipo=ASC") ?>"><IMG SRC="
							<? if ($ordenar=="name ASC"){ 
								echo 'img/ls_flecha_abajo_sobre.gif';
							} else { 
								echo 'img/ls_flecha_abajo_normal.gif';
							}
							?>" WIDTH="13" HEIGHT="6" BORDER="0" ALT=""></A></TD>
					</TR>
			</TABLE>				
			<!-- FIN CAMPO -->
		</TD>
		<TD class="lscabecera"  colspan="0" width='100'>
		<?
			$seccion = $visit->dbBuilder->getSectionDataId(111);
			echo $seccion->nombre;
		?>
		</TD>
		<TD class="lscabecera"  colspan="0" width='100'>
		<?	
			$seccion=$visit->dbBuilder->getSectionDataId(112);
			echo $seccion->nombre;
		?>
		</TD>
		<TD class="lscabecera"  colspan="0" width='80'>
			<!-- CAMPO -->
			<TABLE  border="0" cellpadding="0" cellspacing="0">
				<TR>
						<TD nowrap 
							<? if ($orden=="ispublic") { ?>
								class="camposlsactivo"
							<? } else { ?>
								class="camposls"
							<? } ?>
							>Es publico&nbsp;</TD>
						<TD nowrap ><A HREF="<?= $visit->util->concatenaUrl($urlOrden,"orden=ispublic&orden_tipo=DESC") ?>"><IMG SRC="
							<? if ($ordenar=="ispublic DESC"){ 
								echo 'img/ls_flecha_arriba_sobre.gif';
							} else { 
								echo 'img/ls_flecha_arriba_normal.gif';
							} ?>
							" WIDTH="13" HEIGHT="6" BORDER="0" ALT=""></A><BR><A HREF="<?= $visit->util->concatenaUrl($urlOrden,"orden=ispublic&orden_tipo=ASC") ?>"><IMG SRC="
							<? if ($ordenar=="ispublic ASC"){ 
								echo 'img/ls_flecha_abajo_sobre.gif';
							} else { 
								echo 'img/ls_flecha_abajo_normal.gif';
							}
							?>" WIDTH="13" HEIGHT="6" BORDER="0" ALT=""></A></TD>
					</TR>
			</TABLE>				
			<!-- FIN CAMPO -->
		<!-- </TD>
			<TD class="lscabecera">
			<TABLE  border="0" cellpadding="0" cellspacing="0" width='80'>
				<TR>								
					<TD nowrap class="camposls" width='10'>Orden&nbsp;</TD>
					<TD nowrap ><A HREF="<?= $urlOrden ?>&orden=orden&orden_tipo=DESC"><IMG SRC="
					<? if ($ordenar=="orden DESC"){ 
						echo 'img/ls_flecha_arriba_sobre.gif';
					} else { 
						echo 'img/ls_flecha_arriba_normal.gif';
					} ?>
					" WIDTH="13" HEIGHT="6" BORDER="0" ALT=""></A><BR><A HREF="<?= $urlOrden ?>&orden=orden>&orden_tipo=ASC"><IMG SRC="
					<? if ($ordenar=="nom_cuenta ASC"){ 
						echo 'img/ls_flecha_abajo_sobre.gif';
					} else { 
						echo 'img/ls_flecha_abajo_normal.gif';
					}
					?>" WIDTH="13" HEIGHT="6" BORDER="0" ALT=""></A></TD>					 
				</TR>
			</TABLE>	
		</TD> -->
		<td class="lscabecera" width='20'>
			&nbsp;
		</td>
	</tr>



	<? for ($i=0;$i<count($filas);$i++) { ?>
	<?
		if ( ($i % 2) != 0 ) {
			$lsregistros="lsregistrospar";
		} else {
			$lsregistros="lsregistrosimpar";
		}
	?>
		<?
			$descripcion = $visit->dbBuilder->obtenerAtributoValorTextFromSeccionOV(112,$filas[$i]->id);
			$descripcion=$descripcion->value;

			$nombre = $visit->dbBuilder->obtenerAtributoValorTextFromSeccionOV(111,$filas[$i]->id);
			$nombre=$nombre->value;

		?>
		<tr>
			<TD class="<?= $lsregistros ?>" width="20">
				<!-- <INPUT TYPE="checkbox" name="set_" value="S"> -->
			</TD>
			<TD class="<?= $lsregistros ?>" width="30">
				<? if($visit->options->usuario->esRolSuperadmin()){ ?>
					<a href="cm_form_virtual_object.php?id=<?= $filas[$i]->id ?>"><IMG SRC="img/ico_editar.gif" WIDTH="13" HEIGHT="16" BORDER="0" ALT="">&nbsp;</a><a href="cm_form_virtual_object.php?id=<?= $filas[$i]->id ?>"><?= $filas[$i]->id ?></a>
				<? } else if($visit->options->usuario->esRolAdmin()){ ?>
					<a href="cm_form_virtual_object.php?id=<?= $filas[$i]->idov ?>"><IMG SRC="img/ico_editar.gif" WIDTH="13" HEIGHT="16" BORDER="0" ALT="">&nbsp;</a><a href="cm_form_virtual_object.php?id=<?= $filas[$i]->idov ?>"><?= $filas[$i]->idov ?></a>
				<? } ?>
			</TD>
			<TD class="<?= $lsregistros ?>" nowrap>
				<?	
					if(strlen($nombre)>30){
						print substr($nombre,0,30);
						print "...";
					} else {
						print $nombre;
					}
				?>
			</td>
			<TD class="<?= $lsregistros ?>" nowrap>
				<?	
					if(strlen($descripcion)>80){
						print substr($descripcion,0,90);
						print "...";
					} else {
						print $nombre;
					}
				?>
			</td>
			<TD class="<?= $lsregistros ?>"><a href="cm_form_virtual_object.php?id=<?= $filas[$i]->id ?>" class="lsenlace"><B>
						<? if ($filas[$i]->ispublic=="S"){  ?> 
								<IMG SRC="img/ico_checked_si.gif" WIDTH="12" HEIGHT="12" BORDER="0" ALT="">  
						<?	}else{ ?>
								<IMG SRC="img/ico_checked_no.gif" WIDTH="12" HEIGHT="12" BORDER="0" ALT="">
						<? } ?>
				</B></a>
			</TD>
			<!-- <TD class="<?= $lsregistros ?>">
				<A HREF="do.php?op=mover_virtual_object&id=<?= $filas[$i]->id ?>&valor=1"><IMG SRC="img/flecha_up.gif" WIDTH="16" HEIGHT="16" BORDER="0" ALT=""></A>
				<A HREF="do.php?op=mover_virtual_object&id=<?= $filas[$i]->id ?>&valor=-1"><IMG SRC="img/flecha_down.gif" WIDTH="16" HEIGHT="16" BORDER="0" ALT=""></A>
			</td> -->
			<TD class="<?= $lsregistros ?>">		
				<A HREF="#" onclick="
				if (confirm('<?=utf8_encode("¿Seguro que desea eliminar el elemento?")?>')) {
					if (confirm('Otros objetos pueden estar utilizando como recursos ajenos\n alg\u00fan recurso propio del objeto que se dispone a borrar.\n <?=utf8_encode("¿Confirma la eliminación del objeto?")?>')) {
						window.location.href='do.php?op=eliminar_virtual_object&id=<?= $filas[$i]->id ?>';
					}
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
		<TD width="30%" align="right" valign="bottom" background="img/backoffice_fondo_cab_tabla.jpg">
		<a href="cm_form_virtual_object.php"><IMG SRC="img/boton_nuevo.gif" WIDTH="77" HEIGHT="21" BORDER="0" ALT=""></a>
		&nbsp;				
		</TD>
	</TR>
</TABLE>


	<?
include_once(dirname(__FILE__)."/bo_bottom.php");