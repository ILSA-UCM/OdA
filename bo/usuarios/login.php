<? 
include_once(getcwd()."/include.php");
include_once(getcwd()."/top_simple.php"); 
?>

<script>
	function compruebaCampos() {
		var vall = document["formulario"];
		var nombre;
		var msgError=false;
		var newLine = "\n";
		var strError="";
	
		nombre ="login";
		if ( vall[ nombre ].value=="") strError+=" - Login" + newLine;

		nombre ="password";
		if ( vall[ nombre ].value=="") strError+=" - Clave" + newLine;


		if (strError!="") {
			alert("Debe rellenar los siguientes campos:\n"+strError);
			return false;
		}
		return true;
	}

</script>

<TABLE width="100%" border="0" cellpadding="0" cellspacing="0">
	<TR>
		<TD height="22" class="admin"><IMG SRC="img/dest_bullet.gif" WIDTH="10" HEIGHT="9" BORDER="0" ALT=""></TD>
		<? $dirBase = $visit->util->getUrlHost();?>
		<TD height="22" class="admin">Bienvenido al Sistema Gestor de Contenidos del portal <A HREF="<?=$dirBase."/".APP_NAME ?>/view/login.php"><?= $dirBase."/".APP_NAME ?></A>
		</TD>
	</TR>
</TABLE>

<form name="formulario" method="POST" action="do.php" onsubmit="return compruebaCampos()">
<input type="hidden" name="op" value="login">
<input type="hidden" name="id" value="<?= $fila->id ?>">
<input type="hidden" name="referer" value="<?= $HTTP_REFERER ?>">
<? if ($visit->options->usuario->id==""){?>
<TABLE border="0" cellpadding="0" cellspacing="0">
	<TR>
		<TD width="342" align="center"></TD>
		<TD width="440" valign="top" align="right">
			<center>
				<table width="300" class="form" cellspacing="5">
					<TR>
						<TD><span class="login"><B>Registro del Sistema</B></TD>
					</TR>
					<TR>
						<TD><font color="#8C8C8C">&gt;Por favor introduza su login y contrase&ntilde;a</TD>
					</TR>
				</TABLE>

				<span style="color:#990000">
				<? if ($error=="1") { ?>
					Correo y/o contrase&ntilde;a incorrecta
				<? } else { ?>
					&nbsp;
				<? } ?>
				</span>

				<?
					if ($referer=="") $referer=$HTTP_REFERER;
				?>
				<input type="hidden" name="referrer" value="<?= $referer ?>">
				<table width="300" class="form" cellspacing="5">
					<tr>
						<td class="form" align="right">Login:</td>			
						<td class="form"><input type="text" name="login" class="inputclass" size="14"></td>
					</tr>
					<tr>
						<td class="form" align="right">Clave:</td>
						<td class="form"><input type="password" name="password" class="inputclass" size="14"></td>
					</tr>
					<tr>
						<td class="form" align="center" colspan="2">
						<INPUT TYPE="image" SRC="<?=$_parenDir?>bo/img/boton_entrar.gif" WIDTH="66" HEIGHT="20" BORDER="0" ALT="Entrar" value="Entrar">
					
						</td>
					</tr>
				</table>
			</center>
		</TD>
	</TR>
</TABLE>
<? } ?>
</form>
</center>

<?
include_once(getcwd()."/bo_bottom.php");
?>






