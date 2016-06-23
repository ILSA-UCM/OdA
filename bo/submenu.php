<? if ($visit->options->seccion=="Preferencias") { ?>		
<!-- Preferencias -->
	
<!-- FIN Preferencias -->
<!-- OPCIONES preferencias -->
	<table width="100%" border="0" cellpadding="0" cellspacing="0"> 		
		<tr>
			<td class="divisionsubmenu">&nbsp;</td>
			<td class="divisionsubmenu"><B>Preferencias generales</B></td>
		</tr>
		<tr>
			<td class="submenu">-</td>
			<? 
				if ($visit->options->subseccion=="Cabecera del contenedor") { 
					$classenlace="submenulinkactivo";
				} else { 
					$classenlace="submenulink";
				} 
			?>
			<td class="submenu">
				<a href="cabecera.php" class="<?= $classenlace?>">
					Cabecera de la Web
				</a>
			</td>
		</tr>
		<!-- <tr>
			<td class="submenu">-</td>
			<? 
				if ($visit->options->subseccion=="Presentacion") { 
					$classenlace="submenulink";
				} else { 
					$classenlace="submenulinkactivo";
				} 
			?>
			<td class="submenu">
				<a href="presentacion.php" class="<?= $classenlace?>">
					Presentacion
				</a>
			</td>
		</tr>		 -->
	</table> 
	<? }else if ($visit->options->seccion=="Configuración") { ?>	
	
	<? }else if ($visit->options->seccion=="Mantenimiento") { ?>	
		<table width="100%" border="0" cellpadding="0" cellspacing="0"> 		
		<tr>
			<td class="divisionsubmenu">&nbsp;</td>
			<td class="divisionsubmenu"><B>Recursos</B></td>
		</tr>
		<tr>
			<td class="submenu">-</td>
			<? 
				if ($visit->options->subseccion=="listado_recursos") { 
					$classenlace="submenulinkactivo";
				} else { 
					$classenlace="submenulink";
				} 
			?>
			<td class="submenu">
				<a href="cm_ls_recursos.php" class="<?= $classenlace?>">
					ListadoRecursos
				</a>
			</td>
		</tr>
	</table>
	
	
	<? }else if ($visit->options->seccion=="Navegacion"){ ?>
	<table width="100%" border="0" cellpadding="0" cellspacing="0"> 		
		<tr>
			<td class="divisionsubmenu">&nbsp;</td>
			<td class="divisionsubmenu">Tipo de men&uacute;s</td>
		</tr>
			<? $fila = new ClsNavegacion(); ?> 
			<? $valores = $fila->getValoresTipoCustom(); ?>
			<? while (list ($clave, $val) = each ($valores)) { ?>
				<? 
				$mostrar=true;
				if ($clave=="I" && $prefs["menu_izquierda"]=="0") $mostrar=false;
				///if ($clave=="D" && $prefs["menu_derecha"]!="1") $mostrar=false;
				///if ($clave=="P" && $prefs["menu_superior"]!="1") $mostrar=false;
				///if ($clave=="S" && $prefs["menu_inferior"]!="1") $mostrar=false;
				
				?>
				<? if ($mostrar) { ?>
				<tr>
					<td class="submenu">-</td>
					<td class="submenu">
						<? if ($tipo==$clave){?>
							<a href="<?=$_parenDir?>bo/navegacion/cm_ls_navegacion.php?tipo=<?= $clave?>" class="submenulink"><B><?= $val ?></B></a>
						<? }else{?>
							<a href="<?=$_parenDir?>bo/navegacion/cm_ls_navegacion.php?tipo=<?= $clave?>" class="submenulink"><?= $val ?></a>
						<? } ?>
					</td>
				</tr>
				<? } ?>
			<? } ?>	
	</table>

<? } else if ($visit->options->seccion=="OV"){ ?>
	<table width="100%" border="0" cellpadding="0" cellspacing="0"> 	
	    <tr>
			<td class="divisionsubmenu">&nbsp;</td>
			<td class="divisionsubmenu">Objetos Digitales</td>
		</tr>
		<tr>
			<td class="submenu">-</td>
			<? 
				if ($visit->options->subseccion=="ObjetosVirtuales") { 
					$classenlace="submenulinkactivo";
				} else { 
					$classenlace="submenulink";
				} 
			?>	
			<td class="submenu"><a href="cm_ls_virtual_object.php" class="<?= $classenlace ?>">Objetos</a></td>
		</tr>	
		<? if ($visit->options->usuario->esRolSuperAdmin()){ ?>	
		<tr>
			<td class="submenu">-</td>
			<? 
				if ($visit->options->subseccion=="Secciones") { 
					$classenlace="submenulinkactivo";
				} else { 
					$classenlace="submenulink";
				} 
			?>	
			<td class="submenu"><a href="cm_ls_section_data.php" class="<?= $classenlace ?>">Modelo de Datos</a></td>
		</tr>
		<? } ?>
		<!-- 
		<tr>
			<td class="submenu">-</td>
			<? 
				if ($visit->options->subseccion=="Recursos") { 
					$classenlace="submenulinkactivo";
				} else { 
					$classenlace="submenulink";
				} 
			?>	
			<td class="submenu"><a href="cm_ls_resources.php" class="<?= $classenlace ?>">Recursos</a></td>
		</tr> -->


	</table>
	<? } else if ($visit->options->seccion=="usuarios"){ ?>
	<table width="100%" border="0" cellpadding="0" cellspacing="0"> 	
	    <tr>
			<td class="divisionsubmenu">&nbsp;</td>
			<td class="divisionsubmenu">Usuarios</td>
		</tr>
		<tr>
			<td class="submenu">-</td>
			<? 
				if ($visit->options->subseccion=="lisusuarios") { 
					$classenlace="submenulinkactivo";
				} else { 
					$classenlace="submenulink";
				} 
			?>	
			<td class="submenu"><a href="cm_ls_usuarios.php" class="<?= $classenlace ?>">Usuarios</a></td>
		</tr>
		<!-- <tr>
			<td class="submenu">-</td>
			<? 
				if ($visit->options->subseccion=="adminpermisos") { 
					$classenlace="submenulinkactivo";
				} else { 
					$classenlace="submenulink";
				} 
			?>	
			<td class="submenu"><a href="admin_permisos.php" class="<?= $classenlace ?>">Permisos</a></td>
		</tr>	 -->
		<tr>
			<td class="submenu">-</td>
			<? 
				if ($visit->options->subseccion=="lislogs") { 
					$classenlace="submenulinkactivo";
				} else { 
					$classenlace="submenulink";
				} 
			?>	
			<td class="submenu"><a href="cm_ls_logs.php?orden=fechamodificacion&orden_tipo=DESC" class="<?= $classenlace ?>">Log de modificaciones</a></td>
		</tr>
		
		
			
	</table>
	<? } ?>

