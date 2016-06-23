<? 

/* 
 * Archivo generado dinámicamente por Content Manager
*/
include_once(getcwd()."/include.php");
//if (!$visit->options->tieneAcceso("ls",new ClsUsuarios())) $visit->options->sinAcceso();
$titulopaginabo="Gesti&oacute;n de Usuarios";
$explicaciontitulopaginabo="Seleccione el usuario a modificar o cree uno nuevo";
$visit->options->seccion = "usuarios";
$visit->options->subseccion = "lisusuarios";
include_once(getcwd()."/bo_top.php");


$dict=$visit->util->getRequest();
$npag = $dict["npag"];
$rolUser = $dict["rol"];
$paginacion = $dict["paginacion"];
$orden = $dict["orden"];
$orden_tipo = $dict["orden_tipo"];

//$visit->debuger->enable(true);
if ($npag=="") { 
	$npag=1;
}

// alfredo 140707  $session->lsusuarios= $visit->util->getUrlQuery("",$visit->util->getQueryString());
$_SESSION['lsusuarios']= $visit->util->getUrlQuery("",$visit->util->getQueryString());
$visit->options->paginacion=20;
if ($paginacion!="") $visit->options->paginacion=$paginacion;
$visit->options->maxPaginasSiguientes=3;


$urlName=$visit->util->construyeUrlMenosLista("",$visit->util->getRequest(),"npag");
$urlPag=$visit->util->construyeUrlMenosLista("",$visit->util->getRequest(),"npag,paginacion");
$urlOrden=$visit->util->construyeUrlMenosLista("",$visit->util->getRequest(),"orden,orden_tipo");

if ($orden=="") $orden ="nombre";
if ($orden_tipo=="") $orden_tipo ="ASC";
$ordenar = $orden." ".$orden_tipo;
/*
 * Descomentar y sustituir para Metodo de obtención de filas directo sin filtros.
 $count = $visit->dbBuilder->getUsuariosCount(); 
 $inicio = ( $npag - 1 ) * $visit->options->paginacion + 1;
 $filas = $visit->dbBuilder->getUsuariosLimit($inicio -1 ,$visit->options->paginacion);
*/

$usuarios = new ClsUsuarios();

$visit->options->busquedaGeneral = $q;
//Establecer valores para el filtro en el listado de elementos
if ($rolUser!="") $usuarios->rol = $rolUser;
$fila=$usuarios;

if (trim($ordenar)!="") $usuarios->_orderby = $ordenar;
$count = $visit->dbBuilder->getTablaFiltradaCount($usuarios); 
$inicio = ( $npag - 1 ) * $visit->options->paginacion + 1;
if ($count==0) $inicio=0;
$filas = $visit->dbBuilder->getTablaFiltradaLimit($usuarios, $inicio - 1 ,$visit->options->paginacion);

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
			<script>
			function cambio(item) {
				window.location.href=construyeUrlMenosMas(window.location.href, item.name+",npag",item.name+"="+item.value );
			}			
		</script>
	

	<FORM METHOD=GET ACTION="<?= $visit->util->getNombreArchivo( $visit->util->getScriptName() ) ?>" name="formlistado" style="display:inline;">
		

		<TABLE width="100%" border="0" cellpadding="4" cellspacing="0" style="border:1px solid #d0d0d0;">
			<TR>
				<TD class="buscador" width="300" valign="top" align="left">
					<B>Buscar:</B>&nbsp;&nbsp;
					<INPUT TYPE="text" NAME="q" class="inputmediofiltro" value="<?= $q ?>">&nbsp;&nbsp;
				</TD>
				<TD  class="buscador">			
					<? $valores = $fila->getValoresRol(); ?>
					<select name="rol" onchange="cambio(this)" class="lsselectsfiltro">
						<option value="">Todos los roles
						<? while (list ($clave, $val) = each ($valores)) { ?>
							<option value="<?= $clave ?>" <? if ($clave==$fila->rol) print "selected"; ?>><?= $val ?>
						<? } ?>
					</select>						
				</TD>
				<TD class="buscador">
					<input type="image"  SRC="<?=$_parenDir?>bo/img/boton_buscar_ico.gif" WIDTH="17" HEIGHT="16" BORDER="0" ALT="">
				</TD>

			</TR>
		</TABLE>
		<BR>

		<TABLE width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
			<TR>
				<TD width="200" valign="bottom" align="left">
					<TABLE width="200" border="0" cellpadding="0" cellspacing="0"  background="/bo/img/filtros_tit_fondo.gif" style="border-left:1px solid #B1B1B1;border-right:1px solid #B1B1B1;border-top:1px solid #B1B1B1;" > 		
						<TR>
							<TD width="11"><IMG SRC="<?=$_parenDir?>bo/img/filtros_bullet_titulos.gif" WIDTH="11" HEIGHT="19" BORDER="0" ALT=""></TD>
							<TD valign="middle" width="130"  nowrap><span class="titcuadro">Listado de usuarios</span></TD>
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
							<option value="<?= $valoresPaginacion[$i] ?>" <? if ($visit->options->paginacion==$valoresPaginacion[$i]) print "selected"; ?>><?= $valoresPaginacion[$i] ?>
						<? } ?>
						<option value ="999999" <? if ($paginacion=="999999") echo "selected"; ?> >Todas
					</select>
				</TD>
				
				<TD width="40%" nowrap background="/bo/img/backoffice_fondo_cab_tabla.jpg" align="center">
				
					<? $visit->util->imprimirPaginacion($visit->options->paginacion, $visit->options->maxPaginasSiguientes, $count, $npag, $urlName); ?>
				
				</TD>
				<TD width="30%" align="right" valign="bottom" background="/bo/img/backoffice_fondo_cab_tabla.jpg">
				<a href="cm_form_usuarios.php"><IMG SRC="<?=$_parenDir?>bo/img/boton_nuevo.gif" WIDTH="77" HEIGHT="21" BORDER="0" ALT=""></a>
				&nbsp;				
				</TD>
			</TR>
		</TABLE>
</FORM>
<form name="form_generacion" action="do.php" method="POST"  style="display:inline;">

<TABLE class="lstabla" width="100%" cellpadding="0" cellspacing="0">
	<!-- CAMPOS -->
	<TR>
		<!-- <TD width="20" class="listadocabecera"><INPUT TYPE="checkbox" NAME="checkboxtotal" onClick="selectAll(document.form_generacion,this.checked==true)"></TD> -->
	
		<TD class="listadocabecera" nowrap colspan="2">
				<!-- CAMPO -->
				<A HREF="<? if ($orden_tipo=="DESC") { ?>
					<?= $visit->util->concatenaUrl($urlOrden,"orden=login&orden_tipo=ASC") ?>" 
				<? }else{ ?>
					<?= $visit->util->concatenaUrl($urlOrden,"orden=login&orden_tipo=DESC") ?>" 
				<? } ?>
				<? if ($orden=="nombre") { ?>
					class="listadocabeceraorden"
				<? } else { ?>
					class="listadocabeceranormal"
				<? } ?>>Login</A>
				<? if ($orden=="login") { ?>
					<IMG SRC="
						<? if ($ordenar=="login DESC"){ 
							echo '../img/ls_flecha_arriba_sobre.gif';
						} else  if ($ordenar=="login ASC"){  
							echo '../img/ls_flecha_abajo_sobre.gif';
						} ?>
					" WIDTH="13" HEIGHT="6" BORDER="0" ALT=""></TD>
				<? } else  { ?>
					<IMG SRC="../img/pc.gif" WIDTH="13" HEIGHT="6" BORDER="0" ALT=""></TD>
				<? } ?>						
				<!-- FIN CAMPO -->
		<TD class="listadocabecera" nowrap >
				<!-- CAMPO -->
				<A HREF="<? if ($orden_tipo=="DESC") { ?>
					<?= $visit->util->concatenaUrl($urlOrden,"orden=apellidos&orden_tipo=ASC") ?>" 
				<? }else{ ?>
					<?= $visit->util->concatenaUrl($urlOrden,"orden=apellidos&orden_tipo=DESC") ?>" 
				<? } ?>
				<? if ($orden=="apellidos") { ?>
					class="listadocabeceraorden"
				<? } else { ?>
					class="listadocabeceranormal"
				<? } ?>>Nombre</A>
				<? if ($orden=="apellidos") { ?>
					<IMG SRC="
						<? if ($ordenar=="apellidos DESC"){ 
							echo '../img/ls_flecha_arriba_sobre.gif';
						} else  if ($ordenar=="apellidos ASC"){  
							echo '../img/ls_flecha_abajo_sobre.gif';
						} ?>
					" WIDTH="13" HEIGHT="6" BORDER="0" ALT=""></TD>
				<? } else  { ?>
					<IMG SRC="<?=$_parenDir?>bo/img/pc.gif" WIDTH="13" HEIGHT="6" BORDER="0" ALT=""></TD>
				<? } ?>						
				<!-- FIN CAMPO -->
		<TD class="listadocabecera" nowrap >
				<!-- CAMPO -->
				<A HREF="<? if ($orden_tipo=="DESC") { ?>
					<?= $visit->util->concatenaUrl($urlOrden,"orden=correo&orden_tipo=ASC") ?>" 
				<? }else{ ?>
					<?= $visit->util->concatenaUrl($urlOrden,"orden=correo&orden_tipo=DESC") ?>" 
				<? } ?>
				<? if ($orden=="correo") { ?>
					class="listadocabeceraorden"
				<? } else { ?>
					class="listadocabeceranormal"
				<? } ?>>Correo</A>
				<? if ($orden=="correo") { ?>
					<IMG SRC="
						<? if ($ordenar=="correo DESC"){ 
							echo '../img/ls_flecha_arriba_sobre.gif';
						} else  if ($ordenar=="correo ASC"){  
							echo '../img/ls_flecha_abajo_sobre.gif';
						} ?>
					" WIDTH="13" HEIGHT="6" BORDER="0" ALT=""></TD>
				<? } else  { ?>
					<IMG SRC="../img/pc.gif" WIDTH="13" HEIGHT="6" BORDER="0" ALT=""></TD>
				<? } ?>						
				<!-- FIN CAMPO -->
			<TD class="listadocabecera" nowrap >
				<!-- CAMPO -->
				<A HREF="<? if ($orden_tipo=="DESC") { ?>
					<?= $visit->util->concatenaUrl($urlOrden,"orden=rol&orden_tipo=ASC") ?>" 
				<? }else{ ?>
					<?= $visit->util->concatenaUrl($urlOrden,"orden=rol&orden_tipo=DESC") ?>" 
				<? } ?>
				<? if ($orden=="rol") { ?>
					class="listadocabeceraorden"
				<? } else { ?>
					class="listadocabeceranormal"
				<? } ?>>Rol</A>
				<? if ($orden=="rol") { ?>
					<IMG SRC="
						<? if ($ordenar=="rol DESC"){ 
							echo '../img/ls_flecha_arriba_sobre.gif';
						} else  if ($ordenar=="rol ASC"){  
							echo '../img/ls_flecha_abajo_sobre.gif';
						} ?>
					" WIDTH="13" HEIGHT="6" BORDER="0" ALT=""></TD>
				<? } else  { ?>
					<IMG SRC="<?=$_parenDir?>bo/img/pc.gif" WIDTH="13" HEIGHT="6" BORDER="0" ALT=""></TD>
				<? } ?>		
		<td class="listadocabecera">
			Ultimo Acceso
		</td>
		<td class="listadocabecera">
			Objetos Digitales
		</td>
		<td class="listadocabecera">
			&nbsp;
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
		<tr>
		<!-- <TD  class="<?= $lsregistros ?>" width="20"><INPUT TYPE="checkbox" name="set_" value="S"></TD> -->
<TD width="13" class="<?= $lsregistros ?>"><a href="cm_form_usuarios.php?id=<?= $filas[$i]->id ?>"><IMG SRC="<?=$_parenDir?>bo/img/ico_editar.gif" WIDTH="13" HEIGHT="16" BORDER="0" ALT=""></a></TD>
					<TD class="<?= $lsregistros ?>"><a href="cm_form_usuarios.php?id=<?= $filas[$i]->id ?>" class="lsenlace"><B><?= $filas[$i]->login ?></B></a></TD>
			<TD class="<?= $lsregistros ?>"><?= $filas[$i]->nombre ?>&nbsp;<?= $filas[$i]->apellidos ?></TD>
			<TD class="<?= $lsregistros ?>"><?= $filas[$i]->correo ?></TD>
			<TD class="<?= $lsregistros ?>"><?= $filas[$i]->getValorRol($filas[$i]->rol) ?></TD>
			<td class="<?= $lsregistros ?>">
				<?= $filas[$i]->getValorUltimoAcceso() ?>
			</td>
			<TD class="<?= $lsregistros ?>">
				<!-- input type="text" size="40" value=" -->
				<?=$visit->dbBuilder->getObjetosEdicionFromUsuario($filas[$i]->id)?>
			</td>
			
		</td>
			<TD class="<?= $lsregistros ?>">		
				<? if($filas[$i]->id!=1&&$filas[$i]->id!=11&&$filas[$i]->id!=111){ ?>
				<A HREF="#" onclick="
				if (confirm('Seguro que desea eliminar el elemento?')) {
					window.location.href='do.php?op=eliminar_usuarios&id=<?= $filas[$i]->id ?>&lang=<?= $lang?>';
				}
				return false;"><IMG SRC="<?=$_parenDir?>bo/img/ico_eliminar.gif" WIDTH="14" HEIGHT="16" BORDER="0" ALT=""></A>
				<? } ?>
			</td>
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
		<a href="cm_form_usuarios.php"><IMG SRC="<?=$_parenDir?>bo/img/boton_nuevo.gif" WIDTH="77" HEIGHT="21" BORDER="0" ALT=""></a>
		&nbsp;				
		</TD>
	</TR>
</TABLE>


	<?
include_once(getcwd()."/bo_bottom.php");
?>