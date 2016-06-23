<? 
/* 
 * Archivo generado dinámicamente por Content Manager
*/
include_once(getcwd()."/include.php");


$visit->options->seccion = trad("accion_recordar_clave") ;
include_once(getcwd()."/top.php");
if (!isset($id)) $id="";
	if ($id=="") {
		$fila = new ClsUsuarios();
	} else {
		$fila = $visit->dbBuilder->getUsuariosId($id);
	}

?>

<script>	
	var datosCambiados=false;
	function revisarForm() {
		return (datosCambiados!=true );
	}
	function setDatosCambiados(item) {
			datosCambiados=true;
	
	}
	function compruebaCampos() {								
		var res;
		var vall = document.formulario;
		var nombre;
		var msgError=false;
		var newLine = "\n";
		var strError="";
		var patron, campo, res;
		//Los campos que tengan texto, debo comprobar que tienen la confirmación de SI

		

		nombre ="correo";
		if ( (vall[ nombre ].value=="") ){
			strError+=" - Correo" + newLine;
		}else if(!esMail(getValor(vall[ nombre ]))){
			strError+=" - Formato correo incorrecto " + newLine;
		}

		if (strError!="") {
			alert("Compruebe que ha rellenado los siguientes campos:\n"+strError);
			res=false;
		} else {				
			res=true;
		}
		return res;			
	}
</script>	
<BR>
<? if ($envio=="S"){?>
		<TABLE align="center">
			<TR>
				<TD class="explicacioncompra" ><?= trad("form_recordar_msj_correcto")?></TD>
			</TR>
		</TABLE>
	
<?}else{?>

	<? if($error=="S"){?>
		<TABLE align="center">
			<TR>
				<TD  class="explicacioncompra" align="center"><?= trad("form_recordar_msj_error")?></TD>
			</TR>
		</TABLE>
	<?}else{?>
		<TABLE  border="0" width="100%">
			<TR>
				<TD class="explicacioncompra">
				<?= trad("form_recordar_msj_intro")?>
					
				</TD>
			</TR>
		</TABLE>
	<? } ?>

	<form name="formulario" action="clientes/do.php" method="POST" ENCTYPE="multipart/form-data" onsubmit="return compruebaCampos()">
		<input type="hidden" name="op" value="recordar_contrasena">
		<input type="hidden" name="id" value="<?= $id ?>">
		
		<BR>
		<table width="100%" border="0" cellpadding="3" cellspacing="1" >
		<tr>
				<td colspan="4" style="border-bottom:1px solid #E2E2E2;font-size:11px;font-weight:bold;color:<?=$colorfondo1?>">
				<?= trad("form_recordar_tit")?>
			</td>
		
		</tr>
	</table>
		<table width="100%" border="0" cellpadding="3" cellspacing="1" >	
		<tr>
			<td class="epigrafeform" width="110">
				*<?= trad("form_recordar_correo")?>
			</td>
			<td  class="formvalor">
				<input name="correo" type="text" maxlength="255" value="<?= $visit->util->encapsulaInput( $fila->correo) ?>" style="width:350px;">
			</td>
		</tr>
		
		</table>
		<TABLE width="90%" border="0" cellpadding="0" cellspacing="0">
			<TR>
				<TD width="1" height="2"><IMG SRC="img/pc" WIDTH="1" HEIGHT="2" BORDER="0" ALT=""></TD>
				<TD  height="2" background="img/bloque_sombra_fondo.gif"><IMG SRC="img/pc" WIDTH="1" HEIGHT="2" BORDER="0" ALT=""></TD>
			</TR>
		</TABLE>

		<? if ($envio!="S" && $error!="S"){?>
			<TABLE  border="0" width="100%">
				<TR>
					<TD class="explicacioncompra">
					<?= trad("form_recordar_msj_pie")?>
						
					</TD>
				</TR>
			</TABLE>
		<? } ?>

		<br>
		<? if ($envio!="S"){?>
		<TABLE width="100%" border="0" cellpadding="0" cellspacing="0">
					
			<TR>
				<TD align="center"><input type="bottom"  onclick="
					if (compruebaCampos()) {
						document.formulario.submit();
					}
					return false;
				"  class="boton" VALUE="<?= trad("form_recordar_boton")?>">
				<BR>
				</TD>
				

			</TR>
		</TABLE>
		<? } ?>
	</form>

<?}?>

<? include_once(getcwd()."/bottom.php"); ?>