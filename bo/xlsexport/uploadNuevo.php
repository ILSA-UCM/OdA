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

$teamImage = $_FILES['file'];

var_dump($teamImage);

$serializado=serialize($teamImage);

echo '<meta http-equiv="Refresh" content="5;url=uploadProcess.php?file='.$serializado.'">';
echo "<br>";
echo '<div align="center">
 <p>Export en XML en proceso, por favor espere</p>
 <br>
 <img src="barOda.gif" alt="loding"> </div>';
echo "<br>";

?>

<?php
include_once(getcwd()."/bo_bottom.php");
?>