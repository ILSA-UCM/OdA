<? include_once(dirname(__FILE__)."/../include.php"); ?>
<? if ($tipo=="I" && $prefs["menu_izquierda"]=="0") $visit->util->redirect("../index.php");
	if ($tipo=="D" && $prefs["menu_derecha"]!="1") $visit->util->redirect("../index.php");
	if ($tipo=="P" && $prefs["menu_superior"]!="1") $visit->util->redirect("../index.php");
	if ($tipo=="S" && $prefs["menu_inferior"]!="1") $visit->util->redirect("../index.php");
?>