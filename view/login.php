<?
include_once(dirname(__FILE__)."/include.php");
if ($_SESSION["idusuario"]!=""){
		$visit->util->redirect("/".APP_NAME."/view/index.php");	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<HTML>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<script src="js/jquery-1.6.2.min.js"></script>
		<script src="js/login.js"></script>
		<script type="text/javascript">
			function revisaForm(form){
				var usr = form.login.value;
				var pass = form.password.value;
				if(usr == "" || pass==""){
					alert("Usuario o contrase&ntilde;a incorrectos");
					return -1;
				}
				return 1;
			}

			function valida_enter(e,form)	{
				if (window.event) {keyval=e.keyCode}
				else
				if (e.which) {keyval=e.which}

				if (keyval=="13" && document.buscar.busqueda.value!="") {document.form.submit()} 
			} 
			
			
		</script>
		<!--

		//-->
		</script>
		<STYLE>
			<?
				include("css.php"); 
			?>
		</STYLE>
	</head>
<body>

	<div class="header">
		<a href="<?= $_parenDir ?>view/paginas/view_paginas.php?id=1">
			<IMG SRC="<?= $_parenDir."html/view/".trad("datos_imagen")?>" WIDTH="1152" height="120" BORDER="0" ALT="<?= trad("datos_tienda_titulo") ?>">
		</a>
	</div>
	
	
	<div class="contenido_login">
		<div class="formLogin" style="height:125px; width:325px; ">
			<form name="formLogin" id="formLogin" action="do.php" method="POST" ENCTYPE="multipart/form-data">
				<input type="hidden" name="op" value="login">
				<div >
					<span class="etiqueta">Usuario</span><input id="login" type="text" name="login" value="">
				</div>
				<div>
					<span class="etiqueta">Contrase&ntilde;a</span><input id="password" type="password" name="password" value="">
				</div>
			</form>
			<p><button class="boton_login" id="enviar">Entrar</button></p>
				<div id="error" style="display:none;color:red;"><?=utf8_encode("Los campos est&aacute;n vac&iacute;os")?></div>
		</div>
	</div>


		<? include_once(dirname(__FILE__)."/bottom.php"); ?>

</body>