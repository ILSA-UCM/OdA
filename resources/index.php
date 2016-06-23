<?
include_once(getcwd()."/include.php");
include_once(getcwd()."/top.php");
?>

<? if ($prefs["destacados_principales"]=="1") { ?>
	<? include_once(dirname(__FILE__)."/destacados/inc_destacados_central.php");?>
<? } ?>
<? if ($prefs["destacados_dobles"]=="1") { ?>
	<? include_once(dirname(__FILE__)."/destacados/inc_destacados_doble.php");?>
<? } ?>
<? if ($prefs["destacados_triples"]=="1") { ?>	
	<? include_once(dirname(__FILE__)."/destacados/inc_destacados_triple.php");?>
<? } ?>
<? if ($prefs["noticias_destacadas_home"]=="C") { ?>	
	<? include_once(dirname(__FILE__)."/noticias/inc_noticias_centro.php");?>
<? } ?>
<?
include_once(getcwd()."/bottom.php");
?>