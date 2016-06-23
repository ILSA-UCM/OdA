</div> <!-- Fin del cuadro interior -->


<? $navInferior = $visit->dbBuilder->getNavegacionFromTipo("B");?>		
<table>		
		<? if ($prefs["menu_derecha"]=="1") { ?>
		<td class="navderecha">
			<? if ($prefs["mostrar_cesta_resumen"]=="D"){ ?>
				<? include_once(dirname(__FILE__)."/clientes/inc_clientes_cesta.php");?>	
			<? } ?>				
			<? include_once(dirname(__FILE__)."/destacados/inc_destacados_drcha.php");?>
			<img src="<?= $_parenDir ?>view/img/pc.gif" width="1" height="6" border="0" alt=""><br>
			<? include_once(dirname(__FILE__)."/inc_secciones_drcha.php");?>
			<img src="<?= $_parenDir ?>view/img/pc.gif" width="1" height="6" border="0" alt=""><br>
			<? //include_once(dirname(__FILE__)."/catalogo/inc_escaparate.php");?>
			<!-- <img src="<?= $_parenDir ?>img/pc.gif" width="1" height="6" border="0" alt=""><br> -->

			<? if ($prefs["noticias_destacadas_home"]=="D") { ?>	
				<? $noticias = $visit->dbBuilder->getNoticiasDestacadas ();?>
				<img src="<?= $_parenDir ?>view/img/pc.gif" width="1" height="4" border="0" alt=""><br>
				<? if (count($noticias)>0){ ?>
					<? include_once(dirname(__FILE__)."/noticias/inc_noticias_drcha.php");?>
				<? } ?>
			<? } ?>
			</TD>
		<? } ?>
		
	<? if ($prefs["registro_login_rapidoD"]=="1") { ?>
				<tr>			
					<td colspan="<?= $colspan_num ?>" class="logintabla">
					<? include_once(dirname(__FILE__)."/inc_clientes_loginD.php");?>
					</td>
				</tr>
				<? } ?>
	<!-- <tr>
		<td colspan="<?= $colspan_num ?>" height="6" style="background-color:<?= $interior_fondo?>;border-left:1px solid <?= $interior_borde?>; border-bottom:1px solid <?= $interior_borde?>; border-right:1px solid #<?= $interior_borde?>; " ><IMG SRC="<?= $_parenDir ?>img/pc.gif" WIDTH="1" HEIGHT="1" BORDER="0" ALT=""></td>
	
	</tr> -->
</table>

	<div class="bottom">
		<a href="http://es.creativecommons.org/licencia/" title="Licencia Creative Commons"><img src="../img/by-nc-sa.eu_petit.png" border="0"></a>
		<div class="bottom_text">"Los contenidos de esta web est&aacute;n bajo una licencia Creative Commons si no se indica lo contrario"</div>
	</div>
	<div> 
		<? include_once(dirname(__FILE__)."/inc_menu_inferior.php");?>	
	</div>

</body>
</html>