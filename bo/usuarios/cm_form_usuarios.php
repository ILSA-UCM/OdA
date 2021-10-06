<? 
/* 
 * Archivo generado din�micamente por Content Manager
*/
include_once(getcwd()."/include.php");
$visit->options->seccion = "usuarios";
if (! ($visit->util->esSuperAdmin()) ){ $visit->util->redirect("login.php");}
$titulopaginabo="Gesti&oacute;n de Usuarios";
$explicaciontitulopaginabo="Cumplimente el siguiente formulario.";
$visit->options->seccion = "usuarios";
$visit->options->subseccion = "lisusuarios";

 // alfredo 140706  $session->lsusuarios = "cm_ls_usuarios.php";
$_SESSION['lsusuarios'] = "cm_ls_usuarios.php";

include_once(getcwd()."/bo_top.php");
if (!isset($id)) $id="";
	if ($id=="") {
		$fila = new ClsUsuarios();
		$fila->fecha = date("Ymd");
	} else {
		$fila = $visit->dbBuilder->getUsuariosId($id);
		if (!file_exists("beOldMan.debug"))
			$fila->password=""; 
	}

?>
<SCRIPT LANGUAGE="JavaScript">
	var dato=0;
    function revisarForm() {
		if (dato==1 ){
			return false;
		}else{
			return true;
		}
	}

	function cambio() {
		dato=1;
	}

	function compruebaCampos() {
		var vall = document.formulario;
		var nombre;
		var msgError=false;
		var newLine = "\n";
		var strError="";
		var patron, campo, res;
		nombre ="nombre";
		if ( esVacio(getValor(vall[ nombre ])) ) strError+=" - Nombre" + newLine;
		nombre ="correo";
		
		///if(!esMail(getValor(vall[ nombre ]))) strError+=" - El correo no tiene el formato adecuado" + newLine; 

		nombre ="login";
		if ( esVacio(getValor(vall[ nombre ])) ) strError+=" - Login" + newLine;

        if (<?=var_export(is_null($fila->id), 1)?>){
            nombre = "password";
            if (esVacio(getValor(vall[nombre]))) strError += " - Password" + newLine;

            nombre = "password2";
            if (esVacio(getValor(vall[nombre]))) strError += " - Repetir password" + newLine;

            if (vall["password"].value != vall["password2"].value) strError += " - Password y repetir password deben coincidir" + newLine;
        }

		if (strError!="") {
			alert("Compruebe que ha rellenado los siguientes campos:\n"+strError);
			return false;
		} else {				
			return true;
		}

        return true;
	}



</SCRIPT>
<body >



<form name="formulario" action="do.php" method="POST" ENCTYPE="multipart/form-data" onsubmit="return compruebaCampos()">
	<input type="hidden" name="op" value="modificar_usuarios">
	<input type="hidden" name="id" value="<?= $id ?>">
	<input type="hidden" name="tipoPermisos" <? if("B"==$fila->rol){ ?> value="E"<? } else if("C"==$fila->rol){ ?>  value="C"<? } ?>> 

    <table width="100%" border="0" cellpadding="3" cellspacing="1" style="border:1px solid #CCCCCC;">
		<tr id="fila_listado" bgcolor="#FFFFFF" valign="top">
			  <td   class="nombrecamporeq">
				Nombre:
			  </td>
			  <td  class="textocampo">
				
					<input name="nombre" type="text" class="inputmedio" maxlength="255" value="<?= $fila->nombre ?>" onChange="cambio()">&nbsp;
					
			  </td>
        </tr>
				
		<tr bgcolor="#FFFFFF" valign="top">
			  <td   class="nombrecampo">
				Apellidos:
			  </td>
			  <td class="textocampo">
				
					<input name="apellidos" type="text" class="inputmedio" maxlength="255" value="<?= $fila->apellidos ?>" onChange="cambio()">
					
			  </td>
        </tr>
		
		<tr bgcolor="#FFFFFF" valign="top">
			  <td  class="nombrecampo">
				Correo:
			  </td>
			  <td class="textocampo">
				
					<input name="correo" type="text" class="inputmedio" maxlength="255" value="<?= $fila->correo ?>" onChange="cambio()">
					
			  </td>
        </tr>
				
		<tr bgcolor="#FFFFFF" valign="top">
			  <td  class="nombrecamporeq">
				Login:
			  </td>
			  <td  class="textocampo">
				
					<input name="login" type="text" class="inputmedio" maxlength="255" value="<?= $fila->login ?>" onChange="cambio()">
					
			  </td>
        </tr>
				
		<tr bgcolor="#FFFFFF" valign="top">
			  <td  class="nombrecamporeq">
				Password:
			  </td>
			  <td class="textocampo">
					<? if ($visit->options->usuario->esRolSuperAdmin()){ ?>
						<input name="password" type="text" class="inputmedio" maxlength="255" value="<?= $fila->password ?>" onChange="cambio()">
					<? } else { ?>
						<input name="password" type="password" class="inputmedio" maxlength="255" value="<?= $fila->password ?>" onChange="cambio()"> 
					<? } ?>
			  </td>
        </tr>
		<tr bgcolor="#FFFFFF" valign="top">
			  <td  class="nombrecamporeq">
				Repetir Password:
			  </td>
			  <td  class="textocampo">
					<? if ($visit->util->esSuperAdmin()){ ?>
						<input name="password2" type="text" class="inputmedio" maxlength="255" value="<?= $fila->password ?>" onChange="cambio()">
					<? } else { ?>
						<input name="password2" type="password" class="inputmedio" maxlength="255" value="<?= $fila->password ?>" onChange="cambio()"> 
					<? } ?>
			  </td>			  
        </tr>
		<tr>
			<td class="ultimoacceso">Ultimo Acceso:</td>
			 <td><?= $fila->getValorUltimoAcceso() ?></td>
		</tr>


		
		

		
		<tr>
				<td colspan="2" style="border-top:1px solid #CCCCCC;border-bottom:1px solid #CCCCCC;"  align="left" class="liayudaformulario">
				Seleccionar uno de los siguientes roles : 
				<UL style="margin-top:6px;margin-bottom:4px;">
					<LI class="liayudaformulario"><B>Superadministrador</B> (Usuario con permisos para gestionar <B>todos</B> los contenidos del gestor: p&aacute;ginas, usuarios y objetos digitales)
					<LI class="liayudaformulario"><B>Administrador</B> (Usuario con permisos para  <B>crear</B> y <B>modificar</B> sus objetos digitales, y consultar <B>todos</B> los objetos del gestor menos los confidenciales)
					<LI class="liayudaformulario"><B>Usuario</B> (Usuario con permisos para consultar <B>todos</B> los objetos del gestor menos los confidenciales)				
				</UL>

					
			  </td>
        </tr>
				
		<tr bgcolor="#FFFFFF" valign="top">
			  <td style="border-top:0px solid #CCCCCC;border-bottom:0px solid #CCCCCC;" class="nombrecampo">
				Rol:
			  </td>
			  <td style="border-top:0px solid #CCCCCC;border-bottom:0px solid #CCCCCC;" width="320" class="textocampo">
					<? $aux = new ClsUsuarios(); 
					$valores = $aux->getValoresRol(); ?>
					<select name="rol"  class="selectmedio" onChange="cambio();">
						<? while (list ($clave, $val) = each ($valores)) { ?>
							<option value="<?= $clave ?>" <? if ($clave==$fila->rol) print "selected"; ?>><?= $val ?>
						<? } ?>
					</select>
					
			  </td>
			 </tr>
		<? if("B"==$fila->rol) {?>	
		<tr bgcolor="#FFFFFF" valign="top">
			  <td style="border-top:1px solid #CCCCCC;border-bottom:0px solid #CCCCCC; class="nombrecampo">
					Objetos de aprendizaje<br/> con permisos de edici&oacute;n:		
			  </td>
			  <td style="border-top:1px solid #CCCCCC;border-bottom:0px solid #CCCCCC; width="320" class="textocampo">
					<input id="permisos" name="permisos" type="text" size="80" value="<?=$visit->dbBuilder->getObjetosEdicionFromUsuario($id)?>">
			  </td>
        </tr>
		<? } ?>
</table>
	<br>
	<TABLE  border="0" width="100%" cellpadding="0" cellspacing="10" >
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
					<!-- // alfredo 140706  <A HREF="<?= $session->lsusuarios ?>" onclick=" --> 
					<A HREF="<?= $_SESSION['lsusuarios'] ?>" onclick="
						var ir=false;
						if (revisarForm()) ir=true;
						else if (confirm('<?=utf8_encode("Ha modificado datos �Seguro que desea volver?")?>')) ir=true;
						event.returnValue=ir;
						return ir;
						"><IMG SRC="<?=$_parenDir?>bo/img/boton_volver2.gif" WIDTH="84" HEIGHT="21" BORDER="0" ALT="Guardar"></A>
				</TD>				
				<TD align="right" width="33%">
					&nbsp;
					<? if($id!=""&&$id!=1&&$id!=11&&$id!=111){ ?>
						<A HREF="#" onclick="
							if (confirm('<?=utf8_encode("�Seguro que desea eliminar el elemento?")?>')) {
								window.location.href='do.php?op=eliminar_usuarios&id=<?= $fila->id ?>&lang=<?= $lang?>';
							}
							event.returnValue=false;
							return false;
							"><IMG SRC="<?=$_parenDir?>bo/img/boton_eliminar.gif" WIDTH="84" HEIGHT="21" BORDER="0" ALT=""></A>
					<? } ?>
				</TD>
			</TR>
		</TABLE>
<?//}?>

</form>

<? include_once(getcwd()."/bo_bottom.php"); ?>
