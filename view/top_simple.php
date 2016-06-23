<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<HTML>
<HEAD>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<TITLE> <?= trad("datos_titulo") ?></TITLE>
	<script language="JavaScript" type="text/JavaScript"></script>
	<script SRC="<?=$_parenDir?>bo/misc/scripts/func.js"></script>
	<script SRC="<?=$_parenDir?>bo/misc/scripts/ts_picker.js"></script>
	<script SRC="<?=$_parenDir?>view/js/jquery-1.6.2.min.js"></script>
	<script SRC="<?=$_parenDir?>view/js/jquery-ui-1.8.16.custom.min.js"></script>
	<script SRC="<?=$_parenDir?>view/js/combobox.js"></script>
	<link rel="stylesheet" href="css/smoothness/jquery-ui-1.8.16.custom.css">	
	
	
	<META NAME="Author" CONTENT="Universidad Complutense de Madrid & Bernardo Chenlo">
	<META NAME="Keywords" CONTENT="<?= trad("datos_palabras")  ?>">
	<META NAME="Description" CONTENT="<?=trad("datos_descripcion") ?>">
</HEAD>
<STYLE>

/*$c_texto["negro"]="#000000"; 
$c_texto["gris"]="#666666"; 
$c_texto["rojo"]="#971605"; 
$c_texto["marron"]="#6d3605"; 
$c_texto["blanco"]="#ffffff"; 
$c_texto["amarillo"]="#deb90e"; */

<? include("css.php"); ?>



</STYLE>
<body <?= $visit->template->bodyStr ?>>
<center>
