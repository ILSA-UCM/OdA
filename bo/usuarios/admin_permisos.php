<?
/* 
 * Archivo generado dinámicamente por Content Manager
*/
include_once(dirname(__FILE__)."/../include.php");

$visit->options->seccion = "usuarios";
$visit->options->subseccion = "adminpermisos";
$tieneHijos=false;
$dict = $visit->util->getRequest();
if ($id!="")  {
	$filas = $visit->dbBuilder->getPermisosFromOV($id);
	$ov = $visit->dbBuilder->getVirtualObjectId($id);
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
		//alert(idUsuario);
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
		/*if (vall.usuarios.value=="") {
			strError += "  - Debe elegir los usuarios a los que dar permisos \n";
		}*/
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
		
			var nodo = getElementDoc(document, nombre);
			var contenidoNuevo = "<span id='mostrar_usuarios_"+codigo+"'><tr><td class=titcampobloque valign=bottom style='padding-right:10px'>"+titulo+"</td><td class='accion'><span class='accion' tipo='usuarios_sel'>[ <a href='#' class='botonaccion' tipo='editoriales_sel' onclick='actualizarUsuarios(\""+codigo+"\");return false;'>Borrar</a> ]</span></td></tr></span>";
			var contNuevo = "<table><tr><td class=titcampobloque valign=bottom style='padding-right:10px'>"+titulo+"</td><td class='accion'><span class='accion' tipo='usuarios_sel'>[ <a href='#' class='botonaccion' tipo='usuarios_sel' onclick='actualizarUsuarios(\""+codigo+"\");return false;'>Borrar</a> ]</span></td></tr></table>";
			var contenidoViejo = nodo.innerHTML;
			elem = top.document.createElement("span");
			elem.id = "mostrar_usuarios_" + codigo;
			elem.innerHTML = contNuevo;
			nodo.appendChild(elem);
			res = res + ","+codigo;
			if (res.substring(0,1)==",") res = res.substring(1);
			
		
		document.formulario.usuarios.value = res;
	}

	function annadirListaUsuarios(listaIds,listaTitulos) {
		var i;
		var lista = listaIds.split(";");
		document.formulario.lista_usuarios_marcados.value="";
		var listaTit = listaTitulos.split(";");
		for(i = 0;i<lista.length;i++){
			if (lista[i]!=""){
			annadirUsuario(lista[i],listaTit[i]);
			}
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
			Identificador de Objeto Virtual:&nbsp;
			<input name="idov" type="text" size="20" maxlength="8" value="<?=$id?>" onchange="cambio(this)">&nbsp;&nbsp;[ <a href="#" onclick="window.location.href='admin_permisos.php?id='+document.formulario.idov.value; return false;">buscar</a> ]
		</td>
		<?$objetos= $visit->dbBuilder->getTodosOV();?>
		<td  class="popupcampo">
			<select name="ovs" onChange="location='admin_permisos.php?id='+this.options [this.selectedIndex].value+'&menu=229&lang=es&orden='<?=$orden?>">
				<option value="" selected> - Ir a OV - </option>
			<? for ($j=0;$j<count($objetos);$j++) { ?>	
			<option value="<?=$objetos[$j]->id?>" <?if($id==$objetos[$j]->id){?> selected<?}?>><?=$objetos[$j]->id?>
			/
					<?	
						$item = $visit->dbBuilder->getNombreFromIdOV($objetos[$j]->id);
						if(strlen($item->value)>20){
							print substr($item->value,0,20);
							print "...";
						} else {
							print $item->value;
						}
					?>
					/
					<?	
						$item = $visit->dbBuilder->getDescripcionFromIdOV($objetos[$j]->id);
						if(strlen($item->value)>40){
							print substr($item->value,0,40);
							print "...";
						} else {
							print $item->value;
						}
					?>
				</option>
			<? } ?>
		</td>
		<!-- <td><?var_dump($filas)?></td> -->
		
	</tr>
	
	<? if ($id!="" && $ov!="")  { ?>
		<tr>
			<td class="popuptitcampo" valign='top'>
				<?=utf8_encode("Permisos asignados a éste objeto virtual:")?>
			</td>
			
			<td  class="popupcampo">
				<span id='mostrar_usuarios'>
								
								<? 
								$usuariosActuales=  $usuarios;
								if ($usuariosActuales=="") {
									for ($j=0;$j<count($filas);$j++) { 
										$usuario= new ClsUsuarios();
										$usuario= $visit->dbBuilder->getUsuariosId($filas[$j]->idusuario);
										 if ($usuario->id != "") { 
											$usuariosActuales .= $usuario->id.","; 
										 }

									} 
								}?>

								<? 
								$usuariosActuales = substr($usuariosActuales,0,strlen($usuariosActuales)-1);	
								$usuAct = explode(",",$usuariosActuales);?>
								<? if ($usuariosActuales != "") { ?>
									<? for ($i=0;$i<count($usuAct);$i++) { 
										$usuarioA= $visit->dbBuilder->getUsuariosId($usuAct[$i]);?>
										<span id='mostrar_usuarios_<?= $usuarioA->id ?>'>
											<table cellspacing='0' cellpadding='0' border='0' width='100%'>
														<tr>
															<td style='padding-right:10px;' width="50%">
																<?= $usuarioA->nombre ?> <?= $usuarioA->apellidos ?>
															</td>
															<td>
																<span class="accion" tipo="usuarios_sel" width="50%">
																		[ <a href='#' tipo="usuarios_sel" class='botonaccion' onclick='actualizarUsuarios("<?= $usuarioA->id ?>"); return false;'>Borrar</a> ]
																</span>
															</td>
														</tr>
												</table>
										</span>
									<? } ?>
								<? } ?>	
					</span>
									<table cellspacing='0' cellpadding='0' border='0' style='padding-top:4px;'>
									<tr>
										<td class="nombrecampo" nowrap>
											<input type="hidden" id="usuarios"  name="usuarios" value="<?= $usuariosActuales?>">
											<span class="accion" tipo="usuarios_sel" tipo="usuarios_sel">
											[ <a href="#" tipo="usuarios_sel" onclick='var lsusumarcados = getElement("lista_usuarios_marcados");
																					var lsnombresusumarcados = getElement("lista_nombres_usuarios_marcados");
																					lsusumarcados.value = "";
																					lsnombresusumarcados.value = "";											window.open("ls_usuarios_popup.php?div=mostrar_usuarios&usuarios="+usuarios.value,"","width=680,height=800,scrollbars=yes");return false;'
																					class="botonaccion">
																				A&ntilde;adir Usuarios </a> ]
											</span>
										</td>
									</tr>
									</table>
								<?// $usuariosActuales= substr($usuariosActuales, 0, count($usuariosActuales)-1)?>
						
				</td>
			</tr>
			
			
			<!-- <tr>
				<td class="popuptitcampo">
					Permisos:
				</td>
				<td  class="popupcampo">
					<select  name="tipoPermiso" onchange="cambio(this)" class="lsselectsfiltro"> 
					<option value="">-- Permisos --</option>
					<option value="E" selected>Edición</option>
					<option value="B">Eliminación</option>
					</select>
				</td>
			</tr> -->
		
	<? } else { ?>
		<? if ( $id!="" && $ov=="") { ?>
			<table width="100%" border="0" cellpadding="3" cellspacing="1"  style="border:1px solid #CCCCCC;" height='200'>
			<tr>
				<td valign='center' align='center'><b>No existen Objetos Digitales con ese Identificador</b></td>
			</tr>
			</table>
		<? } ?>
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
						" SRC="<?=$_parenDir?>bo/img/boton_guardar.gif" WIDTH="84" HEIGHT="21" BORDER="0" ALT="">
				</TD>
				<TD align="center" width="34%">
					<A HREF="cm_ls_usuarios.php" onclick="
						var ir=false;
						if (revisarForm()) ir=true;
						else if (confirm('<?=utf8_encode("Ha modificado datos ¿Seguro que desea volver?")?>')) ir=true;
						event.returnValue=ir;
						return ir;
						"><IMG SRC="<?=$_parenDir?>bo/img/boton_volver2.gif" WIDTH="84" HEIGHT="21" BORDER="0" ALT="Guardar"></A>
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
							"><IMG SRC="<?=$_parenDir?>bo/img/boton_eliminar.gif" WIDTH="84" HEIGHT="21" BORDER="0" ALT=""></A>
					<? } ?>
				</TD> -->
			</TR>
		</TABLE>
</form>
<? include_once(dirname(__FILE__)."/../bo_bottom.php"); ?>