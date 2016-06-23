<? 
include_once(getcwd()."/include.php");
if (!$visit->options->tieneAcceso("ls",new ClsLogModificaciones())) $visit->options->sinAcceso();
$titulopaginabo="Log de Modificaciones";
$visit->options->seccion = "usuarios";
$visit->options->subseccion = "lislogs";
include_once(getcwd()."/bo_top.php");

$dict=$visit->util->getRequest();
$npag = $dict["npag"];
$rol = $dict["rol"];
$paginacion = $dict["paginacion"];
$orden = $dict["orden"];
$orden_tipo = $dict["orden_tipo"];


if ($npag=="") { 
	$npag=1;
}
//  alfredo  140716  $session->logs= $visit->util->getUrlQuery("",$visit->util->getQueryString());
$_SESSION["logs"]= $visit->util->getUrlQuery("",$visit->util->getQueryString());
$visit->options->paginacion=20;
if ($paginacion!="") $visit->options->paginacion=$paginacion;
$visit->options->maxPaginasSiguientes=3;


$urlName=$visit->util->construyeUrlMenosLista("",$visit->util->getRequest(),"npag");
$urlPag=$visit->util->construyeUrlMenosLista("",$visit->util->getRequest(),"npag,paginacion");
$urlOrden=$visit->util->construyeUrlMenosLista("",$visit->util->getRequest(),"orden,orden_tipo");

if ($orden=="") $orden ="fechamodificacion";
if ($orden_tipo=="") $orden_tipo ="ASC";
$ordenar = $orden." ".$orden_tipo;

$logs = new ClsLogModificaciones();
$visit->options->busquedaGeneral = $q;
$fila=$logs;

if (trim($ordenar)!="") $logs->_orderby = $ordenar;
$count = $visit->dbBuilder->getTablaFiltradaCount($logs); 
$inicio = ( $npag - 1 ) * $visit->options->paginacion + 1;
if ($count==0) $inicio=0;
$filas = $visit->dbBuilder->getTablaFiltradaLimit($logs, $inicio - 1 ,$visit->options->paginacion);
?>
<FORM METHOD=GET ACTION="<?= $visit->util->getNombreArchivo( $visit->util->getScriptName() ) ?>" name="formlistado" style="display:inline;">
<TABLE width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
	<TR>
		<TD width="200" valign="bottom" align="left">
			<TABLE width="200" border="0" cellpadding="0" cellspacing="0"  background="/bo/img/filtros_tit_fondo.gif" style="border-left:1px solid #B1B1B1;border-right:1px solid #B1B1B1;border-top:1px solid #B1B1B1;" > 		
				<TR>
					<TD width="11"><IMG SRC="<?=$_parenDir?>bo/img/filtros_bullet_titulos.gif" WIDTH="11" HEIGHT="19" BORDER="0" ALT=""></TD>
					<TD valign="middle" width="130"  nowrap>
						<span class="titcuadro">Listado de logs</span>
					</TD>
					<TD width="3"><IMG SRC="<?=$_parenDir?>bo/img/pc.gif" WIDTH="3" HEIGHT="17" BORDER="0" ALT=""></TD>						
				</TR>	
			</TABLE>				
		</TD>
		<TD align="center" valign="bottom">
		</TD>
	</TR>
</TABLE>
<TABLE  border="0" width="100%" cellpadding="0" cellspacing="0" style="border:1px solid #CCCCCC;">
	<TR>
		<TD width="30%" height="24" align="left"  background="/bo/img/backoffice_fondo_cab_tabla.jpg">&nbsp;[<?= $inicio ?>-<?= $visit->util->muestrahastareg($visit->options->paginacion,$count,$npag) ?>] de <?= $count ?>&nbsp;
			<? $valoresPaginacion=split(",","20,40,60,100,200,400"); ?>
			<select name ="paginacion"  class="selectpeque" style="width:60px;" onChange="window.location.href=construyeUrlMenosMas(window.location.href,'paginacion,npag','paginacion='+formlistado.paginacion.value)" >
				<? for ($i=0;$i<count($valoresPaginacion);$i++) { ?>
					<option value="<?= $valoresPaginacion[$i] ?>" <? if ($visit->options->paginacion==$valoresPaginacion[$i]) print "selected"; ?>>
						<?= $valoresPaginacion[$i] ?>
					<? } ?>
					<option value ="999999" <? if ($paginacion=="999999") echo "selected"; ?> >Todas
			</select>
		</TD>
		<TD width="40%" nowrap background="/bo/img/backoffice_fondo_cab_tabla.jpg" align="center">
			<? $visit->util->imprimirPaginacion($visit->options->paginacion, $visit->options->maxPaginasSiguientes, $count, $npag, $urlName); ?>	
		</TD>
		<TD width="30%" align="right" valign="bottom" background="/bo/img/backoffice_fondo_cab_tabla.jpg">
			<!-- <a href="cm_form_usuarios.php"><IMG SRC="<?=$_parenDir?>bo/img/boton_nuevo.gif" WIDTH="77" HEIGHT="21" BORDER="0" ALT=""></a>&nbsp;				 -->
		</TD>
	</TR>
</TABLE>
<TABLE class="lstabla" width="100%" cellpadding="0" cellspacing="0">
	<!-- CAMPOS -->
	<TR>
		<TD class="listadocabecera" nowrap>
			<A HREF="<? if ($orden_tipo=="DESC") { ?>
				<?= $visit->util->concatenaUrl($urlOrden,"orden=idusuario&orden_tipo=ASC") ?>" 
			<? }else{ ?>
				<?= $visit->util->concatenaUrl($urlOrden,"orden=idusuario&orden_tipo=DESC") ?>" 
			<? } ?>
			<? if ($orden=="idusuario") { ?>
				class="listadocabeceraorden"
			<? } else { ?>
				class="listadocabeceranormal"
			<? } ?>>Usuario</A>
			<? if ($orden=="idusuario") { ?>
				<IMG SRC="
					<? if ($ordenar=="idusuario DESC"){ 
						echo '../img/ls_flecha_arriba_sobre.gif';
					} else  if ($ordenar=="idusuario ASC"){  
						echo '../img/ls_flecha_abajo_sobre.gif';
					} ?>
				" WIDTH="13" HEIGHT="6" BORDER="0" ALT=""></TD>
			<? } else  { ?>
				<IMG SRC="<?=$_parenDir?>bo/img/pc.gif" WIDTH="13" HEIGHT="6" BORDER="0" ALT=""></TD>
			<? } ?>
		<TD class="listadocabecera" nowrap >
			<A HREF="<? if ($orden_tipo=="DESC") { ?>
				<?= $visit->util->concatenaUrl($urlOrden,"orden=fechamodificacion&orden_tipo=ASC") ?>" 
			<? }else{ ?>
				<?= $visit->util->concatenaUrl($urlOrden,"orden=fechamodificacion&orden_tipo=DESC") ?>" 
			<? } ?>
			<? if ($orden=="fechamodificacion") { ?>
				class="listadocabeceraorden"
			<? } else { ?>
				class="listadocabeceranormal"
			<? } ?>>Fecha</A>
			<? if ($orden=="fechamodificacion") { ?>
				<IMG SRC="
					<? if ($ordenar=="fechamodificacion DESC"){ 
						echo '../img/ls_flecha_arriba_sobre.gif';
					} else  if ($ordenar=="fechamodificacion ASC"){  
						echo '../img/ls_flecha_abajo_sobre.gif';
					} ?>
				" WIDTH="13" HEIGHT="6" BORDER="0" ALT=""></TD>
			<? } else  { ?>
				<IMG SRC="<?=$_parenDir?>bo/img/pc.gif" WIDTH="13" HEIGHT="6" BORDER="0" ALT=""></TD>
			<? } ?>
		<TD class="listadocabecera" nowrap >
			<A HREF="<? if ($orden_tipo=="DESC") { ?>
				<?= $visit->util->concatenaUrl($urlOrden,"orden=tipo&orden_tipo=ASC") ?>" 
			<? }else{ ?>
				<?= $visit->util->concatenaUrl($urlOrden,"orden=tipo&orden_tipo=DESC") ?>" 
			<? } ?>
			<? if ($orden=="tipo") { ?>
				class="listadocabeceraorden"
			<? } else { ?>
				class="listadocabeceranormal"
			<? } ?>>Tipo</A>
			<? if ($orden=="tipo") { ?>
				<IMG SRC="
					<? if ($ordenar=="tipo DESC"){ 
						echo '../img/ls_flecha_arriba_sobre.gif';
					} else  if ($ordenar=="tipo ASC"){  
						echo '../img/ls_flecha_abajo_sobre.gif';
					} ?>
				" WIDTH="13" HEIGHT="6" BORDER="0" ALT=""></TD>
			<? } else  { ?>
				<IMG SRC="<?=$_parenDir?>bo/img/pc.gif" WIDTH="13" HEIGHT="6" BORDER="0" ALT=""></TD>
			<? } ?>
		<TD class="listadocabecera" nowrap >
			<A HREF="<? if ($orden_tipo=="DESC") { ?>
				<?= $visit->util->concatenaUrl($urlOrden,"orden=idov&orden_tipo=ASC") ?>" 
			<? }else{ ?>
				<?= $visit->util->concatenaUrl($urlOrden,"orden=idov&orden_tipo=DESC") ?>" 
			<? } ?>
			<? if ($orden=="idov") { ?>
				class="listadocabeceraorden"
			<? } else { ?>
				class="listadocabeceranormal"
			<? } ?>>Id del OV</A>
			<? if ($orden=="idov") { ?>
				<IMG SRC="
					<? if ($ordenar=="idov DESC"){ 
						echo '../img/ls_flecha_arriba_sobre.gif';
					} else  if ($ordenar=="idov ASC"){  
						echo '../img/ls_flecha_abajo_sobre.gif';
					} ?>
				" WIDTH="13" HEIGHT="6" BORDER="0" ALT=""></TD>
			<? } else  { ?>
				<IMG SRC="<?=$_parenDir?>bo/img/pc.gif" WIDTH="13" HEIGHT="6" BORDER="0" ALT=""></TD>
			<? } ?>
	</tr>
	<? for ($i=0;$i<count($filas);$i++) { ?>
	<?
		if ( ($i % 2) != 0 ) {
			$lsregistros="listadopar";
		} else {
			$lsregistros="listadoimpar";
		}
	?>
		<tr>
			<TD class="<?= $lsregistros ?>">
				<? 
					$auxuser = $visit->dbBuilder->getUsuariosId($filas[$i]->idusuario); 
					echo $auxuser->login;
				?>
			</TD>
			<TD class="<?= $lsregistros ?>">
				<?= $visit->util->bbdd2datetime($filas[$i]->fechaModificacion); ?>
			</TD>
			<TD class="<?= $lsregistros ?>">
				<?= $filas[$i]->tipo; ?>
			</TD>
			<TD class="<?= $lsregistros ?>">
				<?= $filas[$i]->idov ?>
			</TD>
		</tr>
	<? } ?>
</table>
<TABLE  width="100%" cellpadding="0" cellspacing="0" style="border:1px solid #CCCCCC;">
	<TR>
		<TD width="30%" height="24" align="left"  background="/bo/img/backoffice_fondo_cab_tabla.jpg">&nbsp;[<?= $inicio ?>-<?= $visit->util->muestrahastareg($visit->options->paginacion,$count,$npag) ?>] de <?= $count ?>&nbsp;
			<? $valoresPaginacion=split(",","20,40,60,100,200,400"); ?>
		</TD>
		<TD width="40%" nowrap background="/bo/img/backoffice_fondo_cab_tabla.jpg" align="center">
			<? $visit->util->imprimirPaginacion($visit->options->paginacion, $visit->options->maxPaginasSiguientes, $count, $npag, $urlName); ?>
		</TD>
		<TD width="30%" align="right" valign="bottom" background="/bo/img/backoffice_fondo_cab_tabla.jpg">
			<!-- <a href="cm_form_usuarios.php"><IMG SRC="<?=$_parenDir?>bo/img/boton_nuevo.gif" WIDTH="77" HEIGHT="21" BORDER="0" ALT=""></a>
			&nbsp;				 -->
		</TD>
	</TR>
</TABLE>
</FORM>
<? include_once(getcwd()."/bo_bottom.php"); ?>