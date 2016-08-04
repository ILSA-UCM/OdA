<?php 
include_once(getcwd()."/include.php");
$titulopaginabo="Menu de Generacion De Informes";
$explicaciontitulopaginabo="Menu de Generacion De Informes en formato paginas HTML";
$visit->options->seccion = "Informes";
$visit->options->subseccion = "Informes";
include_once(getcwd()."/bo_top.php");
include_once("config.php");
?>

<?php 
function Conectarse() 
{ 
   if (!($link=mysql_connect(TZN_DB_EXTERNAL_HOST,TZN_DB_EXTERNAL_USER,TZN_DB_EXTERNAL_PASS))) 
   { 
      echo "Error conectando a la base de datos."; 
      exit(); 
   } 
   if (!mysql_select_db(TZN_DB_BASE,$link)) 
   { 
      echo "Error seleccionando la base de datos."; 
      exit(); 
   } 
   mysql_query("SET NAMES 'utf8'");
   return $link; 
}
?>

<?php
	

$id=$visit->options->usuario->id;
$rol=$visit->options->usuario->rol;

if ($rol==A)
	$Admin=true;
else
	$Admin=false;

if ($rol==C)
	$User=true;
else
	$User=false;

$ValorsDocumentos=$_SESSION["resultado_busqueda"];

echo "<br>";
	
if (empty($ValorsDocumentos))
	echo '<meta http-equiv="Refresh" content="0;url=exportH1.php?select=All">';
else
{
	echo "<form action=\"exportH1.php\">
	<p>Existe una busqueda previa a la genracion de informes por favor selecciona sobre que grupo de Objetos Digitales desea hacer el informe.</p>
	<br>
	<input type=\"radio\" name=\"select\" value=\"Selected\" checked>Sobre los Objetos Digitales de la ultima busqueda.
	<br>
	<input type=\"radio\" name=\"select\" value=\"All\">Sobre todos los Objetos Digitales disponibles.
	<br>
	<br>
	<input type=\"submit\" value=\"Seleccionar\">
	</form>";
}


?>

<?php
include_once(getcwd()."/bo_bottom.php");
?>