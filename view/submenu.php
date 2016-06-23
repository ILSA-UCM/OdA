<? if ($seccion=="Preferencias") { ?>		
<!-- Preferencias -->
	
<!-- FIN Preferencias -->
<!-- OPCIONES preferencias -->
	<table width="100%" border="0" cellpadding="0" cellspacing="0"> 		
		<tr>
			<td class="divisionsubmenu">&nbsp;</td>
			<td class="divisionsubmenu">Preferencias generales</td>
		</tr>
		<tr>
			<td class="submenu">-</td>
			<td class="submenu"><a href="datos_tienda.php" class="submenulink">Datos del contenedor</a></td>
		</tr>
		<tr>
			<td class="submenu">-</td>
			<td class="submenu"><a href="" class="submenulink">Cabecera del contenedor</a></td>
		</tr>
		<tr>
			<td class="submenu">-</td>
			<td class="submenu"><a href="" class="submenulink"><?=utf8_encode("Página de mantenimiento")?></a></td>
		</tr>	
	</table>
	
	<? } else if ($seccion=="Catálogo"){ ?>
	
	<!-- OPCIONES CATALOGO -->
	<table width="100%" border="0" cellpadding="0" cellspacing="0"> 		
		<tr>
			<td class="divisionsubmenu">&nbsp;</td>
			<td class="divisionsubmenu">Gestión del catálogo</td>
		</tr>
		<tr>
			<td class="submenu">-</td>
			<td class="submenu"><a href="secciones.php" class="submenulink">Secciones</a></td>
		</tr>
		<tr>
			<td class="submenu">-</td>
			<td class="submenu"><a href="articulos.php" class="submenulink"><?=utf8_encode("Artículos")?></a></td>
		</tr>
		<tr>
			<td class="submenu">-</td>
			<td class="submenu"><a href="marcas.php" class="submenulink">Marcas</a></td>
		</tr>	
		<tr>
			<td class="divisionsubmenu">&nbsp;</td>
			<td class="divisionsubmenu">Elementos destacados</td>
		</tr>	
		<tr>
			<td class="submenu">-</td>
			<td class="submenu"><a href="" class="submenulink">Destacados</a></td>
		</tr>
		<tr>
			<td class="submenu">-</td>
			<td class="submenu"><a href="" class="submenulink">Escaparate</a></td>
		</tr>
		<tr>
			<td class="submenu">-</td>
			<td class="submenu"><a href="" class="submenulink">+vendidos</a></td>
		</tr>
		<tr>
			<td class="submenu">-</td>
			<td class="submenu"><a href="" class="submenulink">Novedades</a></td>
		<tr>
			<td class="submenu">-</td>
			<td class="submenu"><a href="" class="submenulink">Ofertas</a></td>
		</tr>	

		<tr>
			<td class="submenu">-</td>
			<td class="submenu"><a href="" class="submenulink">Página de mantenimiento</a></td>
		</tr>	
	</table>
	
	<? } else if ($seccion=="Informes"){ ?>
	<table width="100%" border="0" cellpadding="0" cellspacing="0"> 		
		<tr>
			<td class="divisionsubmenu">&nbsp;</td>
			<td class="divisionsubmenu">Informes de ventas</td>
		</tr>
		<tr>
			<td class="submenu">-</td>
			<td class="submenu"><a href="informes_volumen.php" class="submenulink">Por volumen de €</a></td>
		</tr>
		<tr>
			<td class="submenu">-</td>
			<td class="submenu"><a href="informes_volumen.php" class="submenulink">Por artículos</a></td>
		</tr>
		<tr>
			<td class="submenu">-</td>
			<td class="submenu"><a href="informes_volumen.php" class="submenulink">Por marcas</a></td>
		</tr>	
		<tr>
			<td class="divisionsubmenu">&nbsp;</td>
			<td class="divisionsubmenu">Informes de visitas</td>
		</tr>	
		<tr>
			<td class="submenu">-</td>
			<td class="submenu"><a href="" class="submenulink"><?=utf8_encode("Por sección")?></a></td>
		</tr>
		<tr>
			<td class="submenu">-</td>
			<td class="submenu"><a href="" class="submenulink"><?=utf8_encode("Por artículo")?> </a></td>
		</tr>
		<tr>
			<td class="divisionsubmenu">&nbsp;</td>
			<td class="divisionsubmenu">Otros informes</td>
		</tr>	
		<tr>
			<td class="submenu">-</td>
			<td class="submenu"><a href="" class="submenulink">Flujo de compra</a></td>
		</tr>
		<tr>
			<td class="submenu">-</td>
			<td class="submenu"><a href="" class="submenulink">Nº de clientes</a></td>
		</tr>
		<tr>
			<td class="submenu">-</td>
			<td class="submenu"><a href="" class="submenulink">Nº de usuarios suscritos</a></td>
		</tr>
		<tr>
			<td class="submenu">-</td>
			<td class="submenu"><a href="" class="submenulink">Formas de pago</a></td>
		</tr>
	</table>
	<? } ?>

	