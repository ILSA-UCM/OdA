<? 
include("include.php");
include("top_simple.php");
$dict = $visit->util->getRequest();
$path = $dict["path"];
?>
<script>
	function FixCookieDate (date) {
		var base = new Date(0);
		var skew = base.getTime(); // dawn of (Unix) time - should be 0
		if (skew > 0) // Except on the Mac - ahead of its time
		date.setTime (date.getTime() - skew);
	}
	function SetCookie (name,value,expires,path,domain,secure) {
		document.cookie = name + "=" + escape (value) +
		((expires) ? "; expires=" + expires.toGMTString() : "") +
		((path) ? "; path=" + path : "") +
		((domain) ? "; domain=" + domain : "") +
		((secure) ? "; secure" : "");
	}
	function crearCarpeta(){
		var expdate = new Date ();
		FixCookieDate (expdate); // Correct for Mac date bug - call only once for given Date object!
		expdate.setTime (expdate.getTime() + (60 * 24 * 60 * 60 * 1000)); // 24 hrs from now 
		SetCookie("cop","crear_carpeta",expdate);
	}
</script>
<FORM METHOD="POST" ACTION="do.php" name="form" onsubmit="
	if (form.nombre_carpeta.value==''){
		alert ('Debe dar un nombre a la nueva carpeta');
		return false;
	} else {
		crearCarpeta();
		return true;
	}
">

	Nombre de la carpeta :&nbsp;
	<INPUT TYPE="text" NAME="nombre_carpeta"><BR><BR>
	<input type="hidden" name="cop" value="crear_carpeta">

	<?if ($path!=""){?>
		<input type="hidden" name="path" value="<?= $_GET['path']?>">
	<?}else{?>
		<input type="hidden" name="path" value="bancorecursos">
	<?}?>
	<INPUT TYPE="submit" value="Aceptar" onClick="">
	<INPUT TYPE="button" value="Cancelar" onClick="window.close()">
</FORM>