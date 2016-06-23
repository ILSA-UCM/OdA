<?php 
include_once(getcwd()."/include.php");
$titulopaginabo="Menu de Exportacion/Actualización";
$explicaciontitulopaginabo="Menu de proceso de exportacion y actualización en XLS";
$visit->options->seccion = "Exportacion/Actualización";
$visit->options->subseccion = "Exportacion/Actualización";
include_once(getcwd()."/bo_top.php");
include_once("config.php");
?>

<?php

$delete=$_REQUEST['StructureOnly'];

if ((!isset($delete))||($delete!="true"))
$delete="false";


echo '<meta http-equiv="Refresh" content="5;url=updateOdaProcess.php">';
echo "<br>";
echo '<div align="center">
 <p>Actualización en proceso, por favor espere</p>
 <br>
 <img src="barOda.gif" alt="loding"> </div>';
echo "<br>";

?>

<?php
include_once(getcwd()."/bo_bottom.php");
?>