<?
/* 
 * Archivo generado dinámicamente por Content Manager
*/
include_once(dirname(__FILE__)."/../include.php");

$visit->options->seccion = "usuarios";
$visit->options->subseccion = "Administrar permisos";
$tieneHijos=false;
$dict = $visit->util->getRequest();
if ($id!="")  {
	$filas = $visit->dbBuilder->getPermisosFromOV($id);
}

if (!$visit->options->tieneAcceso("form",$filas)) $visit->options->sinAcceso();
include_once(dirname(__FILE__)."/../bo_top.php");
?>
<script>
	var dato=0;
	function revisarForm() {
		return (dato!=1 );
	}
	function cambio(item) {
		dato=1;
	} 
	
	function actualizarUsuarios(idUsuario){
		var str = idUsuario;
			eliminarDeListaMultiple("usuarios",str);
			/*if(eliminarDeListaMultiple("editoriales",str)){
				document.formulario.tipo_seleccion_editorial.checked=false;
			} else {
				document.formulario.tipo_seleccion_editorial.checked=true;
			}*/
	}
	function compruebaCampos() {
		var vall = document.formulario;
		var nombre;
		var msgError=false;
		var newLine = "\n";
		var strError="";
		var patron, campo, res;
		if (vall.idov.value=="") {
			strError += "  - Debe elegir el objeto virtual sobre el que desea aplicar los permisos \n";
		}
		if (vall.tipoPermiso.value=="") {
			strError += "  - Debe elegir un tipo de permiso \n";
		}
		if (vall.usuarios.value=="") {
			strError += "  - Debe elegir los usuarios a los que dar permisos \n";
		}
		if (strError!="") {
			alert("Compruebe que ha rellenado los siguientes campos:\n"+strError);
			return false;
		} else {				
			return true;
		}
		return true;
	}
	
	function annadirUsuario(codigo,titulo) {
		var nombre="mostrar_usuarios";
		var res = document.formulario.usuarios.value;
		if (perteneceLista(codigo,res)) {
		} else {
			var nodo = getElementDoc(document, nombre);
			
			var contenidoNuevo = "<span id='mostrar_usuarios_"+codigo+"'><table border=0 cellpadding=0 cellspacing=0><tr><td class=titcampobloque valign=bottom style='padding-right:10px'>"+titulo+"</td><td class='accion'><span class='accion' tipo='usuarios_sel'>[ <a href='#' class='botonaccion' tipo='editoriales_sel' onclick='actualizarUsuarios(\""+codigo+"\");return false;'>Borrar</a> ]</span></td></tr></table></span>";
			var contNuevo = "<table border=0 cellpadding=0 cellspacing=0><tr><td class=titcampobloque valign=bottom style='padding-right:10px'>"+titulo+"</td><td class='accion'><span class='accion' tipo='usuarios_sel'>[ <a href='#' class='botonaccion' tipo='usuarios_sel' onclick='actualizarUsuarios(\""+codigo+"\");return false;'>Borrar</a> ]</span></td></tr></table>";
			var contenidoViejo = nodo.innerHTML;
			elem = top.document.createElement("span");
			elem.id = "mostrar_usuarios_" + codigo;
			elem.innerHTML = contNuevo;
			nodo.appendChild(elem);
			res = res + ","+codigo;
			if (res.substring(0,1)==",") res = res.substring(1);
		}
		document.formulario.usuarios.value = res;
	}

	function annadirListaUsuarios(listaIds,listaTitulos) {
		
		var i;
		var lista = listaIds.split(";");
		document.formulario.lista_usuarios_marcados.value="";
		var listaTit = listaTitulos.split(";");
		for(i = 0;i<lista.length;i++){
			annadirUsuario(lista[i],listaTit[i]);
		}
	}
	
</script>
<TABLE  border="0" width="460" cellpadding="0" cellspacing="0" style="border-top:1px solid #CCCCCC;border-left:1px solid #CCCCCC;border-right:1px solid #CCCCCC;">
	<TR>
		<TD height="24" align="left" background="img/backoffice_fondo_cab_tabla.jpg">
		&nbsp;<B>Administración de Permisos</B></TD>		
	</TR>
</TABLE>

<form name="formulario" action="do.php" method="POST" ENCTYPE="multipart/form-data" onsubmit="; return compruebaCampos()">
	<input type="hidden" id="lista_usuarios_marcados" value="">
	<input type="hidden" id="lista_nombres_usuarios_marcados" value="">
	<input type="hidden" name="op" value="asignar_permisos">
	<!-- <input type="hidden" name="id" value="<?= $fila->id ?>">
	<input type="hidden" name="orden" value="<?= $fila->orden ?>"> -->
	<input type="hidden" name="lang" value="<?= $lang ?>">
	<!-- <input type="hidden" name="idlangprincipal" value="<?= $fila->idlangprincipal ?>"> -->
<table width="100%" border="0" cellpadding="3" cellspacing="1"  style="border:1px solid #CCCCCC;">

	<tr>
		<td class="popuptitcampo">
			Identificador de Objeto Virtual:
		</td>
		<td  class="popupcampo">
	
			<input name="idov" type="text" size="20" maxlength="8" value="<?=$id?>" onchange="cambio(this)">&nbsp;&nbsp;[ <a href="#" onclick="window.location.href='admin_permisos.php?id='+document.formulario.idov.value; return false;">buscar</a> ]
		</td>
		<!-- <td><?var_dump($filas)?></td> -->
		
	</tr>
	<!-- <tr>
		<td class="popuptitcampo">
			Codigo:
		</td>
		<td  class="popupcampo">
			<input name="codigo" type="text" size="40" maxlength="255" value="<?= $visit->util->encapsulaInput( $fila->codigo) ?>" onchange="cambio(this)">
		</td>
	</tr>
	<tr>
		<td class="popuptitcampo">
			Tooltip:
		</td>
		<td  class="popupcampo">
			<input name="tooltip" type="text" size="40" maxlength="255" value="<?= $visit->util->encapsulaInput( $fila->tooltip) ?>" onchange="cambio(this)">
		</td>
	</tr> -->
	<? if ($id!="") { ?>
		<tr>
			<td class="popuptitcampo">
				<?=utf8_encode("Permisos asignados a éste objeto virtual: ")?>
			</td>
			<td  class="popupcampo">
				<table cellspacing='0' cellpadding='0' border='0'>
				<tr>
					<td class="nombrecampo" colspan='2'>
								<?
									$usuariosActuales = $usuarios;
									for ($j=0;$j<count($filas);$j++) { 
										$usuariosActuales = $filas[$j]->idusuario;
									}
								?>
								<input type="hidden" id="editoriales" onpropertychange="cambio(); checkPublico();" name="editoriales" value="<%= editorialesActuales %>">
						<input type="hidden" id="usuarios"  name="usuarios" value="">
						<span id='mostrar_usuarios'>
							<span class="accion" tipo="usuarios_sel" tipo="usuarios_sel">
													[ <a href="#" tipo="usuarios_sel" onclick='
															var lsusumarcados = getElement("lista_usuarios_marcados");
															var lsnombresusumarcados = getElement("lista_nombres_usuarios_marcados");
															lsusumarcados.value = "";
															lsnombresusumarcados.value = ""; 
															window.open("ls_usuarios_popup.php","","width=680,height=800,scrollbars=yes");return false;'
															class="botonaccion">
														Añadir Usuarios
													</a> ]
							</span>
						</span>
					</td>
				
				</tr>
				<? for ($i=0;$i<count($filas);$i++) { ?>
					<tr>
						<?
						$usuario= new ClsUsuarios();
						$usuario= $visit->dbBuilder->getUsuariosId($filas[$i]->idusuario);
						?>
						<td><?= $usuario->nombre ?> <?= $usuario->apellidos ?></td>
						<!-- <td class='accion'><span class='accion' tipo='usuarios_sel'>[ <a href='#' class='botonaccion' tipo='editoriales_sel' onclick='actualizarUsuarios(<?=$usuario->id?>);return false;'>Borrar</a> ]</span></td> -->
					</tr>
				<? } ?>
					
				</table>
			</td>
		</tr>
		<tr>
			<td class="popuptitcampo">
				Permisos:
			</td>
			<td  class="popupcampo">
				<select  name="tipoPermiso" onchange="cambio(this)" class="lsselectsfiltro"> 
				<option value="">-- Permisos --</option>
				<option value="E">Edición</option>
				<option value="B">Eliminación</option>
				</select>
			</td>
		</tr>
		
	<? } ?>
</table>
		<TABLE  border="0" width="100%" cellpadding="0" cellspacing="10" style="border-left:1px solid #CCCCCC;border-right:1px solid #CCCCCC;border-bottom:1px solid #CCCCCC;">
			<TR>				
				<TD align="left" width="33%">
						<input type="image" onclick="
						
							if (compruebaCampos()) {
								document.formulario.submit();
							}
						
						event.returnValue=false;
						return false;
						" SRC="/bo/img/boton_guardar.gif" WIDTH="84" HEIGHT="21" BORDER="0" ALT="">
				</TD>
				<TD align="center" width="34%">
					<A HREF="cm_ls_section_data.php" onclick="
						var ir=false;
						if (revisarForm()) ir=true;
						else if (confirm('<?=utf8_encode("Ha modificado datos ¿Seguro que desea volver?")?>')) ir=true;
						event.returnValue=ir;
						return ir;
						"><IMG SRC="/bo/img/boton_volver2.gif" WIDTH="84" HEIGHT="21" BORDER="0" ALT="Guardar"></A>
				</TD>				
				<!-- <TD align="right" width="33%">
					&nbsp;
					<? if ($id!="") { ?>
						<A HREF="#" onclick="
							if (confirm('¿Seguro que desea eliminar el elemento?')) {
								window.location.href='do.php?op=eliminar_section_data&id=<?= $fila->id ?>';
							}
							event.returnValue=false;
							return false;
							"><IMG SRC="/bo/img/boton_eliminar.gif" WIDTH="84" HEIGHT="21" BORDER="0" ALT=""></A>
					<? } ?>
				</TD> -->
			</TR>
		</TABLE>
</form>
<? include_once(dirname(__FILE__)."/../bo_bottom.php"); ?>