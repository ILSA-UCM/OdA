<? 
/* 
 * Archivo generado dinámicamente por Content Manager
*/
include("include.php");


include("top_simple.php");
$path = $dict["path"];
$nombre_archivo = $dict["nombre_archivo"];
$files = $dict["files"];
?>
<script>
	function openWindowFoto(url,imagen) {
	
	var strancho;
	var stralto;
	//if (ancho==null) strancho = 530;
	//if (alto==null) stralto = 360;

	a = new Image();
	a.src=imagen;
	strancho = a.width+40;
	stralto = a.height+40;

	
	window.open(url+"?imagen="+imagen,"","resizable=yes,status=1,scrollbars=1,width="+strancho+",height="+stralto,false);
}
</script>
<LINK REL="stylesheet" TYPE="text/css" HREF="style.css"></link>
<TABLE>
	<TR>
		<TD>Informaci&oacute;n de 
		<?
		if (is_dir($path)){
				print  "carpeta" ;
		}else if (is_file($nombre_archivo)){
				print "imagen";
		}
		?></TD>
	</TR>
</TABLE>
<TABLE>
	<?
	if (is_dir($path)){ 
		$nombre_dir=$path;
	?>
		<TR>
			<TD><B>Directorio</B>:</TD>
			<TD><?= $visit->util->getNombreArchivo($nombre_dir)?></TD>
		</TR>
		<TR>
				<TD><B>Subdirectorio</B>:</TD>
				<TD><?=  str_replace("../"," ",$nombre_dir)?></TD>
		</TR>
		<TR>
				<TD><B>Fecha de creaci&oacute;n</B>:</TD>
				<TD><?= date("d m Y H:i:s", filemtime($nombre_dir)); ?></TD>
		</TR>
		<TR>
				<TD><B>Archivos</B>:</TD>
				<TD>
				<? 
				$archivos=$visit->util->getCarpetas ($nombre_dir);
				print count($archivos)-2;//Eliminamos. y ..
				?></TD>
		</TR>
		<TR>
				<TD><B>Fecha de Modificaci&oacute;n</B>:</TD>
				<TD><?= date("d m Y H:i:s", fileatime($nombre_dir)); ?></TD>
		</TR>
		<TR>
				<TD><B>Tama&ntilde;o del archivo:</B></TD>
				<TD><?= filesize($nombre_dir)?>Bytes</TD>
		</TR>
				
				<TD><B>Acceso:</B> </TD>
				<TD>
					<? if (is_readable($nombre_dir)){
						print "Lectura/";
		
					}else if (is_readable($nombre_dir)){
						print "Escritura";
					}
					?>
				</TD>
		</TR>
		
	<?}else if (is_file($nombre_archivo)){?>

	
	<FORM METHOD=POST ACTION="do.php">
		<TR>
			<TD><B>Imagen</B>: <?= $visit->util->getNombreArchivo($nombre_archivo)?></TD>
			<TD></TD>
		</TR>
		<TR>
				<TD><B>Fecha de creaci&oacute;n</B>:</TD>
				<TD><?= date("d m Y H:i:s", filemtime($nombre_archivo)); ?></TD>
		</TR>
		<TR>
				<TD><B>Fecha de Modificaci&oacute;n</B>:</TD>
				<TD><?= date("d m Y H:i:s", fileatime($nombre_archivo)); ?></TD>
		</TR>
		<TR>
				<TD><B>Tama&ntilde;o de la imagen</B>:</TD>
				<TD><?= filesize($nombre_archivo)  ?> bytes</TD>
		</TR>
		<TR>
				<TD><B>Acceso</B>: <? if (is_readable($nombre_archivo)){
						print "Lectura ";
		
					}else if (is_readable($nombre_archivo)){
						print "Escritura";
					}
				?>
				</TD>	
		</TR>
		<TR>
				<TD colspan="2">
				
				<TABLE>
				<TR>
					<!-- <TD width="200" height="150" style="background-image: url(<?= $_GET["nombre_archivo"]?>) ;background-repeat:no-repeat;"><BR>-->
					<TD width="200" height="150" style="background-image: url(<?= $nombre_archivo?>) ;background-repeat:no-repeat;"><BR>	
					</TD>
				</tr>
				<TR>
					<TD>
						<!--  <A HREF="#" onclick="openWindowFoto('view_foto.php','<?= $visit->util->getUrlArchivo($_GET["nombre_archivo"])?>');return false;">Ampliar imagen</A>  -->
						<A HREF="#" onclick="openWindowFoto('view_foto.php','<?= $visit->util->getUrlArchivo($nombre_archivo)?>');return false;">Ampliar imagen</A> 
						
					</TD>
				</TR>
				<TR>
					<TD>
						<A HREF="descarga.php?fichero=<?= $visit->util->getUrlArchivo($nombre_archivo)?>">Descargar elemento</A> 		
					</TD>
				</TR>
				</TABLE>
				
				
				
				</TD>
				
		</TR>
		

		<!-- <input type="hidden" name="id" value="<?= $id ?>"> -->
		
	</FORM>
	<?}?>
</TABLE>
		
<?// include_once(getcwd()."/bottom.php"); ?>