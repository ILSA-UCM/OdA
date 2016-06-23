

<? if ($q!=""){?>

	<table  width="<?= $prefs["tam_ancho_interior_contenidos"] ?>" cellpadding="0" cellspacing="0" bgcolor="#971605">
		<tr>
			<td class="historial">Inicio -  <span style='color:<?= $colorfondo2 ?>'><b> <?= trad("bloque_buscador")  ?></b></td>
		</tr>
	</table>

	<!-- <table  width="<?= $prefs["tam_ancho_interior_contenidos"] ?>" cellpadding="0" cellspacing="0" bgcolor="#971605">
		<tr>
			<td style="background-color:<?=$colorfondo2 ?> padding-left:6px;height:20px;color:#ffffff;font-weight:bold;">Resultados de la búsqueda</td>
		</tr>
	</table> -->
	<? }else if ($novedad=="1"){ ?>

		<table  width="<?= $prefs["tam_ancho_interior_contenidos"] ?>" cellpadding="0" cellspacing="0" bgcolor="#971605">
			<tr>
				<td class="historial">Inicio -  <?= trad("bloque_escaparate")?> - <span style='color:<?= $colorfondo2 ?>'><b> <?= trad("art_novedades") ?></b></td>
			</tr>
		</table>
		<!-- <table  width="<?= $prefs["tam_ancho_interior_contenidos"] ?>" cellpadding="0" cellspacing="0" bgcolor="#971605">
			<tr>
				<td style="background-color:<?=$colorfondo2 ?> padding-left:6px;height:20px;color:#ffffff;font-weight:bold;"><?= trad("art_novedades") ?></td>
			</tr>
		</table> -->

		<? }else if ($oferta=="1"){ ?>

		<table  width="<?= $prefs["tam_ancho_interior_contenidos"] ?>" cellpadding="0" cellspacing="0" bgcolor="#971605">
			<tr>
				<td class="historial">Inicio -  <?= trad("bloque_escaparate")?> - <span style='color:<?= $colorfondo2 ?>'><b> <?= trad("art_ofertas") ?></b></td>
			</tr>
		</table>
		<!-- <table  width="<?= $prefs["tam_ancho_interior_contenidos"] ?>" cellpadding="0" cellspacing="0" bgcolor="#971605">
			<tr>
				<td style="background-color:<?=$colorfondo2 ?> padding-left:6px;height:20px;color:#ffffff;font-weight:bold;"><?= trad("art_ofertas") ?></td>
			</tr>
		</table> -->
		<? }else if ($visit->util->perteneceLista(basename($SCRIPT_NAME),"registro_clientes.php,recordar_contrasenia.php")){ ?>

			<table  width="<?= $prefs["tam_ancho_interior_contenidos"] ?>" cellpadding="0" cellspacing="0" bgcolor="#971605">
				<tr>
					<td class="historial">Inicio -   <?= trad("tit_bloque_cliente_registrado") ?> - <span style='color:<?= $colorfondo2 ?>'><b><?= $visit->options->seccion?></b></td>
				</tr>
			</table>
			<!-- <table  width="<?= $prefs["tam_ancho_interior_contenidos"] ?>" cellpadding="0" cellspacing="0" bgcolor="#971605">
				<tr>
					<td style="background-color:<?=$colorfondo2 ?> padding-left:6px;height:20px;color:#ffffff;font-weight:bold;"><?= $visit->options->seccion?></td>
				</tr>
			</table> -->
		<? }else if ($visit->util->perteneceLista(basename($SCRIPT_NAME),"ls_catalogo_ventas.php")){ ?>

			<table  width="<?= $prefs["tam_ancho_interior_contenidos"] ?>" cellpadding="0" cellspacing="0" bgcolor="#971605">
				<tr>
					<td class="historial">Inicio -  <?= trad("bloque_escaparate")?> - <span style='color:<?= $colorfondo2 ?>'><b> <?= trad("art_vendidos") ?></b></td>
				</tr>
			</table>
			<!-- <table  width="<?= $prefs["tam_ancho_interior_contenidos"] ?>" cellpadding="0" cellspacing="0" bgcolor="#971605">
				<tr>
					<td style="background-color:<?=$colorfondo2 ?> padding-left:6px;height:20px;color:#ffffff;font-weight:bold;"><?= trad("art_vendidos") ?></td>
				</tr>
			</table> -->
		<? }else if ($visit->util->perteneceLista(basename($SCRIPT_NAME),"cesta_compra.php")){ ?>

			<table  width="<?= $prefs["tam_ancho_interior_contenidos"] ?>" cellpadding="0" cellspacing="0" bgcolor="#971605">
				<tr>
					<td class="historial">Inicio - <span style='color:<?= $colorfondo2 ?>'><b><?= trad("tit_bloque_mi_compra_actual") ?></b></td>
				</tr>
			</table>
			<!-- <table  width="<?= $prefs["tam_ancho_interior_contenidos"] ?>" cellpadding="0" cellspacing="0" bgcolor="#971605">
				<tr>
					<td style="background-color:<?=$colorfondo2 ?> padding-left:6px;height:20px;color:#ffffff;font-weight:bold;"><?= trad("tit_bloque_detalles_compra") ?></td>
				</tr>
			</table> -->
		<? }else if ($visit->util->perteneceLista(basename($SCRIPT_NAME),"login_clientes.php")){ ?>

			<table  width="<?= $prefs["tam_ancho_interior_contenidos"] ?>" cellpadding="0" cellspacing="0" bgcolor="#971605">
				<tr>
					<td class="historial">Inicio - <span style='color:<?= $colorfondo2 ?>'><b><?= trad("tit_form_registro_clientes")?></b></td>
				</tr>
			</table>
			<!-- <table  width="<?= $prefs["tam_ancho_interior_contenidos"] ?>" cellpadding="0" cellspacing="0" bgcolor="#971605">
				<tr>
					<td style="background-color:<?=$colorfondo2 ?> padding-left:6px;height:20px;color:#ffffff;font-weight:bold;">Registro de Clientes</td>
				</tr>
			</table> -->
		<? }else if ($visit->util->perteneceLista(basename($SCRIPT_NAME),"perfil_clientes.php,pedidos_cliente.php")){ ?>
		

			<table  width="<?= $prefs["tam_ancho_interior_contenidos"] ?>" cellpadding="0" cellspacing="0" bgcolor="#971605">
				<tr>
					<td class="historial">Inicio -  <?= trad("tit_bloque_cliente_registrado") ?> - <span style='color:<?= $colorfondo2 ?>'><b><?= $seccionlaLang ?></b></td>
				</tr>
			</table>
			<!-- <table  width="<?= $prefs["tam_ancho_interior_contenidos"] ?>" cellpadding="0" cellspacing="0" bgcolor="#971605">
				<tr>
					<td style="background-color:<?=$colorfondo2 ?> padding-left:6px;height:20px;color:#ffffff;font-weight:bold;">Registro de Clientes</td>
				</tr>
			</table> -->
		<? }else if ($visit->util->perteneceLista(basename($SCRIPT_NAME),"view_pedido.php")){ ?>
		

			<table  width="<?= $prefs["tam_ancho_interior_contenidos"] ?>" cellpadding="0" cellspacing="0" bgcolor="#971605">
				<tr>
					<td class="historial">Inicio -  <?= trad("tit_bloque_cliente_registrado") ?> - <?= trad("tit_mis_pedidos")?> - <span style='color:<?= $colorfondo2 ?>'><b>Detalle del pedido </b></td>
				</tr>
			</table>
			

		<? }else if ($visit->options->seccion == "Proceso de compra"){ ?>

			<table  width="<?= $prefs["tam_ancho_interior_contenidos"] ?>" cellpadding="0" cellspacing="0" bgcolor="#971605">
				<tr>
					<td class="historial">Inicio - <span style='color:<?= $colorfondo2 ?>'><b>Proceso de compra </b></td>
				</tr>
			</table>
			<!-- <table  width="<?= $prefs["tam_ancho_interior_contenidos"] ?>" cellpadding="0" cellspacing="0" bgcolor="#971605">
				<tr>
					<td style="background-color:<?=$colorfondo2 ?> padding-left:6px;height:20px;color:#ffffff;font-weight:bold;">Registro de Clientes</td>
				</tr>
			</table> -->
		<? }else if ($visit->options->seccionhistory != ""){ ?>

			<table  width="<?= $prefs["tam_ancho_interior_contenidos"] ?>" cellpadding="0" cellspacing="0" bgcolor="#971605">
				<tr>
					<td class="historial">Inicio - <span style='color:<?= $colorfondo2 ?>'><b><?= $visit->options->seccionhistory?> </b></td>
				</tr>
			</table>
		<? } else if (basename($SCRIPT_NAME)=="index.php") { ?>
		<table  width="<?= $prefs["tam_ancho_interior_contenidos"] ?>" cellpadding="0" cellspacing="0" bgcolor="#971605">
			<tr>
				<td class="historial"><?= trad("tit_bienvenida_web")  ?></td>
			</tr>
		</table>

		<? }else{ ?>

		<table  width="<?= $prefs["tam_ancho_interior_contenidos"] ?>" cellpadding="0" cellspacing="0" bgcolor="#971605">
			<tr>
				<td class="historial">Inicio - </a> <?= $strBarra?></td>
			</tr>
		</table>
		<!-- <table  width="<?= $prefs["tam_ancho_interior_contenidos"] ?>" cellpadding="0" cellspacing="0" bgcolor="#971605">
			<tr>
				<td style="background-color:<?=$colorfondo2 ?> padding-left:6px;height:20px;color:#ffffff;font-weight:bold;"><?= $visit->options->detalle?></td>
			</tr>
		</table> -->
		
	<? } ?>
		<table width="<?= $prefs["tam_ancho_interior_contenidos"] ?>" cellpadding="0" cellspacing="0" cellspacing="0">
			<tr>
				<td bgcolor="<?= $interior_fondo ?>" align="right"><IMG SRC="<?= $_parenDir ?>img/historial-logo02.gif" WIDTH="76" HEIGHT="8" BORDER="0" ALT=""></td>
			</tr>
		</table>