<? 
include_once(getcwd()."/top_simple.php");
?>

<TABLE  border="0" width="100%" height="300" cellpadding="0" cellspacing="0">
	<TR>
		<TD width="100%" align="center" valign="middle">

		<TABLE  border="0" width="300" height="150" cellpadding="0" cellspacing="0" style="border:1px solid #B7B7B7">
			<TR>
				<TD width="100%" align="center" valign="middle" bgcolor="#E9E9E9">
		<? if ($op=="eliminar_portal") { ?>

			<?=utf8_encode("El portal se ha eliminado satisfactoriamente.")?> 

			<BR><BR><BR><BR>
			<A HREF="cm_ls_portal.php"><IMG SRC="img/boton_ir_listado.gif" WIDTH="87" HEIGHT="24" BORDER="0" ALT=""></A>


			

		<? } else if ($op=="modificar_portal" && !$existePortal) { ?>

				<?=utf8_encode("El portal se ha modificado satisfactoriamente.")?> 
		
			<BR><BR><BR><BR>
			<A HREF="cm_popup_portal.php?id=<?= $obj->id ?>"><IMG SRC="img/boton_ver_recurso.gif" WIDTH="87" HEIGHT="24" BORDER="0" ALT=""></A>
			&nbsp;&nbsp;&nbsp;&nbsp;
			<A HREF="cm_ls_portal.php"><IMG SRC="img/boton_ir_listado.gif" WIDTH="87" HEIGHT="24" BORDER="0" ALT=""></A>
		
		<? } else if ($op=="modificar_portal" && $existePortal) {?>

				<?=utf8_encode("Ya existe un portal con este mismo nombre.")?> 
		
			<BR><BR><BR><BR>
			<A HREF="cm_popup_portal.php?<?if ($id!="") print "id==". $obj->id ?>"><IMG SRC="img/boton_ver_recurso.gif" WIDTH="87" HEIGHT="24" BORDER="0" ALT=""></A>
			&nbsp;&nbsp;&nbsp;&nbsp;
			<A HREF="cm_ls_portal.php"><IMG SRC="img/boton_ir_listado.gif" WIDTH="87" HEIGHT="24" BORDER="0" ALT=""></A>


		<? } else if ($op=="eliminar_secciones") { ?>

			<?=utf8_encode("La sección se ha eliminado satisfactoriamente.")?> 

			<BR><BR><BR><BR>
			<A HREF="ls_contactos.php"><IMG SRC="img/boton_ir_listado.gif" WIDTH="87" HEIGHT="24" BORDER="0" ALT=""></A>

		<? } else if ($op=="modificar_secciones") { ?>

			<?=utf8_encode("La sección se ha modificado satisfactoriamente.")?> 
			
			<BR><BR><BR><BR>
			<A HREF="cm_popup_secciones.php?id=<?= $obj->id ?>"><IMG SRC="img/boton_ver_recurso.gif" WIDTH="87" HEIGHT="24" BORDER="0" ALT=""></A>
			&nbsp;&nbsp;&nbsp;&nbsp;
			<A HREF="cm_ls_secciones.php?idtipo_recurso=2"><IMG SRC="img/boton_ir_listado.gif" WIDTH="87" HEIGHT="24" BORDER="0" ALT=""></A>

		<? } else if ($op=="eliminar_menus") { ?>

			<?=utf8_encode("El menú se ha eliminado satisfactoriamente.")?> 

			<BR><BR><BR><BR>
			<A HREF="cm_ls_menus.php"><IMG SRC="img/boton_ir_listado.gif" WIDTH="87" HEIGHT="24" BORDER="0" ALT=""></A>

		<? } else if ($op=="modificar_menus") { ?>

			<?=utf8_encode("El menu se ha modificado satisfactoriamente.")?> 

			<BR><BR><BR><BR>
			<A HREF="cm_popup_menus.php?id=<?= $obj->id ?>"><IMG SRC="img/boton_ver_recurso.gif" WIDTH="87" HEIGHT="24" BORDER="0" ALT=""></A>
			&nbsp;&nbsp;&nbsp;&nbsp;
			<A HREF="cm_ls_menus.php"><IMG SRC="img/boton_ir_listado.gif" WIDTH="87" HEIGHT="24" BORDER="0" ALT=""></A>

		<? } else if ($op=="eliminar_paginas") { ?>

			<?=utf8_encode("La página se ha eliminado satisfactoriamente.")?> 

			<BR><BR><BR><BR>
			<A HREF="cm_ls_paginas.php"><IMG SRC="img/boton_ir_listado.gif" WIDTH="87" HEIGHT="24" BORDER="0" ALT=""></A>

		<? } else if ($op=="modificar_paginas") { ?>

			<?=utf8_encode("La página se ha modificado satisfactoriamente.")?> 

			<BR><BR><BR><BR>
			<A HREF="cm_popup_paginas.php?id=<?= $obj->id ?>"><IMG SRC="img/boton_ver_recurso.gif" WIDTH="87" HEIGHT="24" BORDER="0" ALT=""></A>
			&nbsp;&nbsp;&nbsp;&nbsp;
			<A HREF="cm_ls_paginas.php"><IMG SRC="img/boton_ir_listado.gif" WIDTH="87" HEIGHT="24" BORDER="0" ALT=""></A>
		<? } else if ($op=="eliminar_formularios") {?>
			
			<?=utf8_encode("El formulario se ha eliminado satisfactoriamente")?> 

			<BR><BR><BR><BR>
			<A HREF="ls_clientespotenciales.php"><IMG SRC="img/boton_ir_listado.gif" WIDTH="87" HEIGHT="24" BORDER="0" ALT=""></A>

		<? } else if ($op=="modificar_formularios") {?>

			<?=utf8_encode("El cliente potencial se ha modificado satisfactoriamente")?> 
			
			<BR><BR><BR><BR>
			<A HREF="cm_popup_formularios.php?id=<?= $obj->id ?>"><IMG SRC="img/boton_ver_recurso.gif" WIDTH="87" HEIGHT="24" BORDER="0" ALT=""></A>
			&nbsp;&nbsp;&nbsp;&nbsp;
			<A HREF="cm_ls_formularios.php"><IMG SRC="img/boton_ir_listado.gif" WIDTH="87" HEIGHT="24" BORDER="0" ALT=""></A>

		<? } else if ($op=="eliminar_noticias") {?>
			
			<?=utf8_encode("La noticia se ha eliminado satisfactoriamente")?> 

			<BR><BR><BR><BR>
			<A HREF="cm_ls_noticias.php"><IMG SRC="img/boton_ir_listado.gif" WIDTH="87" HEIGHT="24" BORDER="0" ALT=""></A>

		<? } else if ($op=="modificar_noticias") {?>

			<?=utf8_encode("La noticia se ha modificado satisfactoriamente")?> 
			
			<BR><BR><BR><BR>
			<A HREF="cm_popup_noticias.php?id=<?= $obj->id ?>"><IMG SRC="img/boton_ver_recurso.gif" WIDTH="87" HEIGHT="24" BORDER="0" ALT=""></A>
			&nbsp;&nbsp;&nbsp;&nbsp;
			<A HREF="cm_ls_noticias.php"><IMG SRC="img/boton_ir_listado.gif" WIDTH="87" HEIGHT="24" BORDER="0" ALT=""></A>

		<? } else if ($op=="eliminar_eventos") {?>
			
			<?=utf8_encode("El evento se ha eliminado satisfactoriamente")?> 

			<BR><BR><BR><BR>
			<A HREF="cm_ls_eventos.php"><IMG SRC="img/boton_ir_listado.gif" WIDTH="87" HEIGHT="24" BORDER="0" ALT=""></A>

		<? } else if ($op=="modificar_eventos") {?>

			<?=utf8_encode("El evento se ha modificado satisfactoriamente")?> 
			
			<BR><BR><BR><BR>
			<A HREF="cm_popup_eventos.php?id=<?= $obj->id ?>"><IMG SRC="img/boton_ver_recurso.gif" WIDTH="87" HEIGHT="24" BORDER="0" ALT=""></A>
			&nbsp;&nbsp;&nbsp;&nbsp;
			<A HREF="cm_ls_eventos.php"><IMG SRC="img/boton_ir_listado.gif" WIDTH="87" HEIGHT="24" BORDER="0" ALT=""></A>
		
		<? } else if ($op=="eliminar_eventos") {?>
			
			<?=utf8_encode("El evento se ha eliminado satisfactoriamente")?> 

			<BR><BR><BR><BR>
			<A HREF="cm_ls_eventos.php"><IMG SRC="img/boton_ir_listado.gif" WIDTH="87" HEIGHT="24" BORDER="0" ALT=""></A>
		
		<? } else if ($op=="modificar_eventos") {?>

			<?=utf8_encode("El evento se ha modificado satisfactoriamente")?> 
			
			<BR><BR><BR><BR>
			<A HREF="cm_popup_eventos.php?id=<?= $obj->id ?>"><IMG SRC="img/boton_ver_recurso.gif" WIDTH="87" HEIGHT="24" BORDER="0" ALT=""></A>
			&nbsp;&nbsp;&nbsp;&nbsp;
			<A HREF="cm_ls_eventos.php"><IMG SRC="img/boton_ir_listado.gif" WIDTH="87" HEIGHT="24" BORDER="0" ALT=""></A>
		
		<? } else if ($op=="eliminar_item") {?>
			
			<?=utf8_encode("La opción se ha eliminado satisfactoriamente")?> 

			<BR><BR><BR><BR>
			<A HREF="cm_popup_menus.php?id=<?= $idmenu ?>"><IMG SRC="img/boton_ir_listado.gif" WIDTH="87" HEIGHT="24" BORDER="0" ALT=""></A>

		<? } else if ($op=="modificar_item") {?>

			<?=utf8_encode("La opción se ha modificado satisfactoriamente")?> 
			
			<BR><BR><BR><BR>
			<A HREF="cm_popup_item.php?id=<?= $obj->id ?>&idmenu=<?=$idmenu ?>"><IMG SRC="img/boton_ver_recurso.gif" WIDTH="87" HEIGHT="24" BORDER="0" ALT=""></A>
			&nbsp;&nbsp;&nbsp;&nbsp;
			<A HREF="cm_popup_menus.php?id=<?= $obj->idmenu ?>"><IMG SRC="img/boton_ir_listado.gif" WIDTH="87" HEIGHT="24" BORDER="0" ALT=""></A>
		
		<? } else if ($op=="eliminar_usuarios") {?>
			
			<?=utf8_encode("El usuario se ha eliminado satisfactoriamente")?> 

			<BR><BR><BR><BR>
			<A HREF="cm_ls_usuarios.php"><IMG SRC="img/boton_ir_listado.gif" WIDTH="87" HEIGHT="24" BORDER="0" ALT=""></A>
		
		<? } else if ($op=="modificar_usuarios") {?>

			<?=utf8_encode("El usuario se ha modificado satisfactoriamente")?> 
			
			<BR><BR><BR><BR>
			<A HREF="cm_popup_usuarios.php?id=<?= $obj->id ?>"><IMG SRC="img/boton_ver_recurso.gif" WIDTH="87" HEIGHT="24" BORDER="0" ALT=""></A>
			&nbsp;&nbsp;&nbsp;&nbsp;
			<A HREF="cm_ls_usuarios.php"><IMG SRC="img/boton_ir_listado.gif" WIDTH="87" HEIGHT="24" BORDER="0" ALT=""></A>

		<? } else if ($cop=="eliminar_archivos") { ?>
		
			El directorio <b><?= $visit->util->getNombreArchivo($nombre_archivo[$i])?></b> <?=utf8_encode("no está vacío")?>. <BR/> &iquest;Desea borrar la carpeta y su contenido?&nbsp;
			
			<BR><BR><BR><BR>
			<A HREF="do.php?cop=eliminar_carpeta&accion=S&path=<?= $destino?>&files=<?=$dict['files']?>">
				<IMG SRC="../img/boton_si.png" WIDTH="34" HEIGHT="24" BORDER="0" ALT="">
			</A>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<A HREF="ls_recursos.php?path=<?= $destino?>">
				<IMG SRC="../img/boton_no.png" WIDTH="34" HEIGHT="24" BORDER="0" ALT="">
			</A>	
		<? } else { ?>
			<? if ($errorMessage!="") {?>
				<?=utf8_encode("Se ha producido un error en el sistema. Si estaba introduciendo algún dato verifique los campos. En cualquier caso pongase en contacto con el responsable informático de la Red en su Nodo.")?> 	
			<br>
				<a href="javascript:window.history.go(-1);">Volver</a>

			<? } else { ?>

				<?=utf8_encode($message)?>
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
//include_once(getcwd()."/bottom_simple.php");
?>