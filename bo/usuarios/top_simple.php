<?

//include("../top_simple.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
<HEAD>
	<meta http-equiv="Content-Type" content="text/html; charset=utf8">
	<TITLE>Backoffice Gestor de Objetos de Aprendizaje</TITLE>
	<LINK REL="stylesheet" TYPE="text/css" HREF="<?=$_parenDir?>bo/backoffice.css"></link>
	<script language="JavaScript" type="text/JavaScript"></script>
	<script src="<?=$_parenDir?>bo/misc/scripts/ts_picker.js"></script>
	<script src="<?=$_parenDir?>bo/misc/scripts/func.js"></script>
	<script src="<?=$_parenDir?>bo/misc/scripts/custom.js"></script>
	<META NAME="Author" CONTENT="VARADERO SOFTWARE FACTORY">
	<META NAME="Keywords" CONTENT="">
	<META NAME="Description" CONTENT="">
</HEAD>
<body >
<?
	
	if ($lang=="") $lang = "es";
	$visit->options->lang="";
?>
<table width="100%" cellpadding="0" cellspacing="0" border="0" height="100%">
	<tr>
		<td align="center">
			<table width="1000" cellpadding="0" cellspacing="0" border="0" height="100%">
			<!-- cabecera -->
			<tr>
				<td  align="center" height="70" valign="top" colspan="2">
					<table  width="100%" cellpadding="0" cellspacing="0" border="0">			
						<tr>	
							<td height="55">
								<h2>Gesti&oacute;n de OdA 2.5</h2>
							</td>				
							<td height="20" width="520" valign="top" style="padding-top:2px;padding-right:10px;background:URL(<?=$_parenDir?>bo/img/fondo_cab_bao.gif) no-repeat right;" align="right">
								<table border="0" cellpadding="0" cellspacing="0" >
									<tr>
										<? if(isset($_SESSION['authenticated'])){
											if($_SESSION['authenticated']== APP_NAME.$visit->options->usuario->id){ ?>
												<? if ($visit->options->usuario->esRolSuperadmin()){ ?>
											<td><A HREF="<?=$_parenDir?>bo/usuarios/cm_ls_usuarios.php"><IMG SRC="<?=$_parenDir?>bo/img/bo_top_ico_usuarios.gif" WIDTH="60" HEIGHT="15" BORDER="0" ALT=""></A></td>
										<? } ?>
										<td><b><?= $visit->options->usuario->nombre." ".$visit->options->usuario->apellidos?></b></span> </td>
												<td><a href="do.php?op=logout"><img src="<?=$_parenDir?>bo/img/ico_menos.gif" width="5" height="5" border="0" alt=""></a></td>
												<td class="cabico">&nbsp;<a href="<?=$_parenDir?>bo/usuarios/do.php?op=logout">Salir</a></td>
											<? } ?>
										<? } ?>
									</tr>
								</table>
								<BR> 
							</td>
						</tr>
					</table>
					<table  width="100%" cellpadding="0" cellspacing="0" border="0">
						<tr>
							<td height="28" style="background:url(<?=$_parenDir?>bo/img/fondo_secciones_cab.jpg) repeat-x;">
								<table  border="0" cellpadding="0" cellspacing="0">
									<tr>
										<? if(isset($_SESSION['authenticated'])&&($_SESSION['authenticated']== APP_NAME.$visit->options->usuario->id)&&!$visit->options->usuario->esRolUsuario()){ ?>
											<?	if ($visit->options->seccion=="Preferencias") {
													$class="menuover";														
												}else {$class="menu"; } ?>

<? if ($visit->options->usuario->esRolSuperAdmin()){ ?>
											<td class="<?= $class ?>" onmouseover="this.className='menuover';"	onmouseout="this.className='<?= $class ?>';"
											onclick="SetDivPosition(); window.location.href = '<?=$_parenDir?>bo/preferencias/cabecera.php'">Preferencias</td>
										
											<?	if ($visit->options->seccion=="Navegacion") {
													$class="menuover";														
												}else {$class="menu"; } ?>

											<td class="<?= $class ?>" onmouseover="this.className='menuover';"	onmouseout="this.className='<?= $class ?>';"
											onclick="SetDivPosition(); window.location.href = '<?=$_parenDir?>bo/navegacion/cm_ls_navegacion.php'">Navegaci&oacute;n</td>
										
											<?	if ($visit->options->seccion=="Contenido") {
													$class="menuover";											
												}else {$class="menu"; } ?>
											
											<td class="<?= $class ?>" onmouseover="this.className='menuover';"	onmouseout="this.className='<?= $class ?>';" onclick="SetDivPosition(); window.location.href = '<?=$_parenDir?>bo/paginas/cm_ls_paginas.php'">
												Contenido
											</td>
											<?	if ($visit->options->seccion=="Usuarios") {
													$class="menuover";											
												} else {$class="menu"; } ?>
											<td class="<?= $class ?>" onmouseover="this.className='menuover';"	onmouseout="this.className='<?= $class ?>';" onclick="SetDivPosition(); window.location.href = '<?=$_parenDir?>bo/usuarios/cm_ls_usuarios.php'">
												Usuarios
											</td>
<? } ?>
							<?	if ($visit->options->seccion=="OV") {
									$class="menuover";														
								} else { $class="menu"; } ?>
							<?
								$rutaObjetos = "";
								if ($visit->options->usuario->esRolSuperAdmin()){ 
									$rutaObjetos =			$_parenDir."bo/ov/cm_ls_section_data.php";
								} else if ($visit->options->usuario->esRolAdmin()){ 
									$rutaObjetos =			$_parenDir."bo/ov/cm_ls_virtual_object.php";
								}
							?>
							<td class="<?= $class ?>" onmouseover="this.className='menuover';"	onmouseout="this.className='<?= $class ?>';"
							onclick="SetDivPosition(); window.location.href='<?=$rutaObjetos?>'; return false;">
								Objetos Digitales
							</td>
<? if ($visit->options->usuario->esRolSuperAdmin()){ ?>							
							<?	if ($visit->options->seccion=="Mantenimiento") {
													$class="menuover";											
												} else {$class="menu"; } ?>
											<td class="<?= $class ?>" onmouseover="this.className='menuover';"	onmouseout="this.className='<?= $class ?>';" onclick="SetDivPosition(); window.location.href = '<?=$_parenDir?>bo/mantenimiento/cm_ls_recursos.php?l=1&orden=idov&orden_tipo=ASC'">
												Mantenimiento Recursos
											</td>
<? } ?>							
										<? } ?>
									</tr>
								</table>
							</td>
						</tr>
					</table>
					<? if ( $visit->options->seccion=="Contenido") { ?>
					<table  width="100%" cellpadding="0" cellspacing="0" border="0">
						<tr>
							<td height="22" style="background:url(<?=$_parenDir?>bo/img/fondo_subsecciones_cab.jpg) repeat-x;">
								<table  border="0" cellpadding="0" cellspacing="0">
									<tr>
									<? if(isset($_SESSION['authenticated'])&&($_SESSION['authenticated']== APP_NAME.$visit->options->usuario->id)) {?>
										<?	if ($visit->options->subseccion=="Prehome") {
											$class="menu2over";									
										} else {$class="menu2"; } ?>
										<? if( $prefs["tiene_prehome"]=="1"){?>
											<td class="<?= $class ?>" onmouseover="this.className='menu2over';"	onmouseout="this.className='<?= $class ?>';"
											onclick="window.location.href = '<?=$_parenDir?>bo/prehome/cm_form_prehome.php'">Prehome</td> 
										<? } ?>
										<?	if ($visit->options->subseccion=="Paginas") {
												$class="menu2over";											
											} else {$class="menu2"; } ?>
										<td class="<?= $class ?>" onmouseover="this.className='menu2over';"	onmouseout="this.className='<?= $class ?>';"
										onclick="window.location.href = '<?=$_parenDir?>bo/paginas/cm_ls_paginas.php'">P&aacute;ginas de texto</td>  
										<?	if ($visit->options->subseccion=="Destacados") {
												$class="menu2over";											
											} else {$class="menu2"; } ?>
										<?	if ($visit->options->subseccion=="Noticias") {
												$class="menu2over";											
											} else {$class="menu2"; } 
										?>
										<?	if ($visit->options->subseccion=="Faqs") {
												$class="menu2over";											
											} else {$class="menu2"; } 
										?>
										<?	if ($visit->options->subseccion=="Banco") {
												$class="menu2over";								
											} else {$class="menu2"; } ?>
										<td class="<?= $class ?>" onmouseover="this.className='menu2over';"	onmouseout="this.className='<?= $class ?>';" onclick="window.location.href = '<?=$_parenDir?>bo/bancorecursos/ls_recursos.php'">Banco de Recursos</td>				
									<? } ?>
								</tr>
							</table>
						</td>
					</tr>
					</table>
				<? } ?>				
				</td>
			</tr>
			
			<!-- fin cabecera -->
			<tr>
				
				<? if ( !$visit->util->perteneceLista( basename($SCRIPT_NAME),"login.php,cm_form_boletines.php" )) {?>
					<td width="200" valign="top" style="border-top:1px solid #ffffff;border-left:1px solid #E6E6E6;">
						<? include_once(getcwd()."/submenu.php");?>
					
					<BR>
					<img src="<?=$_parenDir?>bo/img/pc.gif" width="168" height="1" border="0" alt=""><BR>
					</td>
				<? } ?>
				<td width="800" valign="top" style="padding:16px;padding-top:6px;border-left:1px solid #E6E6E6;border-right:1px solid #E6E6E6;">
					<table width="100%"  border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td class="tituloseccionbo" nowrap><?= $titulopaginabo ?></td>
							<td class="explicacionseccionbo" width="100%"><?= $explicaciontitulopaginabo ?></td>
						</tr>
					</table>
					<img src="<?=$_parenDir?>bo/img/pc.gif" width="1" height="10" border="0" alt=""><BR>
