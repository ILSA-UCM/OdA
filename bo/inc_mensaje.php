<? 
include_once(getcwd()."/bo_top.php");
?>
<TABLE  border="0" width="100%" height="300" cellpadding="0" cellspacing="0">
	<TR>
		<TD width="100%" align="center" valign="middle">

		<TABLE  border="0" width="300" height="150" cellpadding="0" cellspacing="0" style="border:1px solid #B7B7B7">
			<TR>
				<TD width="100%" align="center" valign="middle" bgcolor="#E9E9E9">
		<? if ($op=="") { ?>
		<? } else if ($op=="modificar_usuarios" && $existeCorreo) {?>
				Ya existe un usuario con este correo.
			
			<BR><BR><BR><BR>
			<A HREF="cm_form_usuarios.php"><IMG SRC="<?=$_parenDir?>bo/img/boton_ver_recurso.gif" WIDTH="87" HEIGHT="24" BORDER="0" ALT=""></A>
			&nbsp;&nbsp;&nbsp;&nbsp;
			<A HREF="cm_ls_usuarios.php"><IMG SRC="<?=$_parenDir?>bo/img/boton_ir_listado.gif" WIDTH="87" HEIGHT="24" BORDER="0" ALT=""></A> 
		<? } else if ($visit->util->getFirstPart($op,"_")=="clonar") {?>
			Los datos se han clonado satisfactoriamente
			
			<BR><BR><BR><BR>
			<A HREF="<?= $volverRecurso ?>"><IMG SRC="<?=$_parenDir?>bo/img/boton_ver_recurso.gif" WIDTH="87" HEIGHT="24" BORDER="0" ALT=""></A>
			&nbsp;&nbsp;&nbsp;&nbsp;
			<A HREF="<?= $volverListado ?>"><IMG SRC="<?=$_parenDir?>bo/img/boton_ir_listado.gif" WIDTH="87" HEIGHT="24" BORDER="0" ALT=""></A> 
	
		<? } else if ($op=="modificar_usuarios" && $existeLogin) {?>
				Ya existe un usuario con este login.
			
			<BR><BR><BR><BR>
			<A HREF="cm_form_usuarios.php"><IMG SRC="<?=$_parenDir?>bo/img/boton_ver_recurso.gif" WIDTH="87" HEIGHT="24" BORDER="0" ALT=""></A>
			&nbsp;&nbsp;&nbsp;&nbsp;
			<A HREF="cm_ls_usuarios.php"><IMG SRC="<?=$_parenDir?>bo/img/boton_ir_listado.gif" WIDTH="87" HEIGHT="24" BORDER="0" ALT=""></A> 

		<? } else if ( $visit->util->getFirstPart($op,"_")=="modificar") {?>
			Los datos se han modificado satisfactoriamente
			
			<BR><BR><BR><BR>
			<A HREF="<?= $volverRecurso ?>"><IMG SRC="<?=$_parenDir?>bo/img/boton_ver_recurso.gif" WIDTH="87" HEIGHT="24" BORDER="0" ALT=""></A>
		
			<? if ($action!="mensajes") {?>
					&nbsp;&nbsp;&nbsp;&nbsp;
				<A HREF="<?= $volverListado ?>"><IMG SRC="<?=$_parenDir?>bo/img/boton_ir_listado.gif" WIDTH="87" HEIGHT="24" BORDER="0" ALT=""></A> 
			<? } ?>
		<? } else if ( $visit->util->getFirstPart($op,"_")=="eliminar") {?>			
			Los datos de se han eliminado satisfactoriamente
			<BR><BR><BR><BR>
			<A HREF="<?= $volverListado ?>"><IMG SRC="<?=$_parenDir?>bo/img/boton_ir_listado.gif" WIDTH="87" HEIGHT="24" BORDER="0" ALT=""></A>
		<? } else if ( $visit->util->getFirstPart($op,"_")=="duplicar") {?>			
			El objeto se ha duplicado satisfactoriamente
			<BR><BR><BR><BR>
			<A HREF="<?= $volverRecurso ?>"><IMG SRC="<?=$_parenDir?>bo/img/boton_ver_recurso.gif" WIDTH="87" HEIGHT="24" BORDER="0" ALT=""></A>
			&nbsp;&nbsp;&nbsp;&nbsp;
			<A HREF="<?= $volverListado ?>"><IMG SRC="<?=$_parenDir?>bo/img/boton_ir_listado.gif" WIDTH="87" HEIGHT="24" BORDER="0" ALT=""></A> 
		
		<? } else { ?>
			<? if ($errorMessage!="") {?>
				<?=utf8_encode("Se ha producido un error en el sistema. Si estaba introduciendo algún dato verifique los campos. En cualquier caso pongase en contacto con el responsable informático de la Red en su Nodo.	")?>
			<br>
				<a href="javascript:window.history.go(-1);">Volver</a>

			<? } else { ?>

				<?= $message?>
			<br>
				<a href="<?= $url ?>">Aceptar</a>
			<? } ?>
		<? } ?>

				</TD>
			</TR>
		</TABLE>
		</TD>
	</TR>
</TABLE>



<br>
<? 
include_once(getcwd()."/bo_bottom.php");
?>