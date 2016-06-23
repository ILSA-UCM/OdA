<?
function trad($atributo) {
	global $visit;
	$res = "";
	
	$lang = $visit->options->lang;
	if ($lang=="") $lang="es";
	if ($visit->options->notificacion =="S") $lang="es";
	$res = $visit->dbBuilder->getMensajeValorFromLangAtributo($lang,$atributo);
	return $res;
}

?>