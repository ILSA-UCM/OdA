<script>
	var dato=0;
	function revisarForm() {
		return (dato!=1 );
	}
	function cambio(item) {
		dato=1;
	}
	function compruebaCampos() {
		var vall = document.formulario;
		var nombre;
		var msgError=false;
		var newLine = "\n";
		var strError="";
		var patron, campo, res;
		nombre ="correo";
		if ( esVacio(getValor(vall[ nombre ])) ){
			strError+=" - <?= trad('form_alta_correo') ?>" + newLine;
		}else if(!esMail(getValor(vall[ nombre ]))){
			strError+=" - Formato correo incorrecto " + newLine;
		}else if (getValor(vall[ nombre ])!= getValor(vall[ "correo2" ])){
			
			strError+=" - Correo y repetir Correo deben ser iguales " + newLine;

		}
		nombre ="password";
		if ( esVacio(getValor(vall[ nombre ])) ){
			strError+=" - <?= trad('form_alta_clave') ?>" + newLine;
		}else if(getValor(vall[ nombre ])!= getValor(vall[ "clave2" ])){
			strError+=" - La clave y repetir clave deben coincidir" + newLine;
		}else if(getValor(vall[ nombre ]).length<'4'){
			strError+= utf8_encode(" - La clave debe tener un mínimo de 4 caracteres") + newLine;
		}
		nombre ="nombre";
		if ( esVacio(getValor(vall[ nombre ])) ) strError+=" - <?= $visit->util->encapsulaInput(trad('form_alta_nombre')) ?>" + newLine;
		nombre ="apellidos";
		if ( esVacio(getValor(vall[ nombre ])) ) strError+=" - <?= $visit->util->encapsulaInput(trad('form_alta_apellidos')) ?>" + newLine;
		
		/*nombre ="dni";
		if ( esVacio(getValor(vall[ nombre ])) ) strError+=" - Dni" + newLine;*/

				
		if (strError!="") {
			alert("Compruebe que ha rellenado los siguientes campos:\n"+strError);
			return false;
		} else {				
			return true;
		}
		return true;
	}


</script>



<input type="hidden" name="op" value="modificar_usuarios">
<input type="hidden" name="id" value="<?= $fila->id ?>">
<!-- <input type="hidden" name="lang" value="<?= $lang ?>">
<input type="hidden" name="tarifa" value="<?= $fila->tarifa ?>">
<input type="hidden" name="descuento" value="<?= $fila->descuento ?>">
<input type="hidden" name="fecha_alta" value="<?= $fila->fecha_alta ?>"> -->
<input type="hidden" name="desde" value="<?= basename($SCRIPT_NAME) ?>">
	


<table width="100%" border="0" cellpadding="3" cellspacing="1" >
	<tr>
			<td class="bloqueform">
			<?= trad("tit_bloque_datos_acceso") ?>
		</td>
	
	</tr>
</table>

<table width="100%" border="0" cellpadding="3" cellspacing="1" >
	<tr>
			<td 
		<? if ($session->popup_errores["signatura"]=="") {?>
			class="epigrafeform"
		<? } else { ?>
			class="epigrafeformerr"
		<? } ?> width="110">
			*<?= trad("form_alta_correo") ?>
		</td>
		<td  class="formvalor" colspan="3">
			<input name="correo" type="text"  maxlength="255" value="<?= $visit->util->encapsulaInput( $fila->correo) ?>" onchange="cambio(this)" class="formlargo">
		</td>
	</tr>

	<tr>
			<td 
		<? if ($session->popup_errores["signatura"]=="") {?>
			class="epigrafeform"
		<? } else { ?>
			class="epigrafeformerr"
		<? } ?> width="110">
			*<?= trad("form_alta_repetir_correo") ?>
		</td>
		<td  class="formvalor" colspan="3">
			<input name="correo2" type="text"  maxlength="255" value="<?= $visit->util->encapsulaInput( $fila->correo) ?>" onchange="cambio(this)" class="formlargo">
		</td>
	</tr>

	<tr>
		<td class="epigrafeform">
			*<?= trad("form_alta_clave") ?>
		</td>
		<td  class="formvalor">
			<input name="password" type="password"  maxlength="20" value="<?= $visit->util->encapsulaInput( $fila->clave) ?>" onchange="cambio(this)" class="formmedio">
		</td>	
		<td class="epigrafeform" width="100">
			*<?= trad("form_alta_repetir_clave") ?>
		</td>
		<td  class="formvalor">
			<input name="clave2" type="password" maxlength="20" value="<?= $visit->util->encapsulaInput( $fila->clave) ?>" onchange="cambio(this)" class="formmedio">
		</td>
	</tr>
</table>
<BR>
<table width="100%" border="0" cellpadding="3" cellspacing="1" >
	<tr>
			<td class="bloqueform">
			<?= trad("tit_bloque_datos_personales") ?>
		</td>
	
	</tr>
</table>
<table width="100%" border="0" cellpadding="3" cellspacing="1" >	
	<tr>
		<td class="epigrafeform" width="110">
			*<?= trad("form_alta_nombre") ?>
		</td>
		<td  class="formvalor">
			<input name="nombre" type="text" maxlength="255" value="<?= $visit->util->encapsulaInput( $fila->nombre) ?>" onchange="cambio(this)" class="formlargo">
		</td>
	</tr>
	<tr>
		<td class="epigrafeform">
			*<?= trad("form_alta_apellidos") ?>
		</td>
		<td  class="formvalor">
			<input name="apellidos" type="text" maxlength="255" value="<?= $visit->util->encapsulaInput( $fila->apellidos) ?>" onchange="cambio(this)" class="formlargo">
		</td>
	</tr>
	<!-- <tr>
		<td class="epigrafeform">
			*Dni:
		</td>
		<td  class="formvalor">
			<input name="dni" type="text" maxlength="20" value="<?= $visit->util->encapsulaInput( $fila->dni) ?>" onchange="cambio(this)" class="formmedio">
		</td>
	</tr> -->
</table>
<BR>

<? 

	if (basename($SCRIPT_NAME)=="perfil_clientes.php"){
		$boton = trad("boton_modificar");
	}else if ($visit->options->cliente->id==""){
		$boton = trad("boton_registrarse");
	}
	if ($boton!="") {?>
	<TABLE  border="0" width="100%" cellpadding="0" cellspacing="10">
		<TR>				
			<TD align="center" width="100%">
					<!-- <input type="image" onclick="
					if (compruebaCampos()) {
						document.formulario.submit();
					}
					event.returnValue=false;
					return false;
					" SRC="img/boton_guardar.gif" WIDTH="84" HEIGHT="21" BORDER="0" ALT=""> -->
					<input type="bottom" onclick="
					if (compruebaCampos()) {
						document.formulario.submit();
					}
					event.returnValue=false;
					return false;
					" class="boton" value=" <?= $boton ?> ">
					
			</TD>
			
		</TR>
	</TABLE>
<? } ?>