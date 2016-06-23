<?
include_once("include.php");

//$visit->debuger->enable(true


$visit->options->seccion = trad("accion_registrarse") ;


include_once(getcwd()."/top.php");



//var_dump($cesta);
$tarifa = $visit->dbBuilder->getPreferenciaFromAtributo("tarifa_usuario_alta");
if ($error=="1" && $session->popup_clientes!="") {
	$fila = $session->popup_clientes;
	$session->popup_clientes="";
} else if($visit->options->cliente->id!=""){ 
	$fila = $visit->dbBuilder->getClientesId($visit->options->cliente->id);
	
}else{
	$fila = new ClsClientes();
	$fila->fecha_alta = date("Ymd");
}

$tarifa = $visit->dbBuilder->getPreferenciaFromAtributo("tarifa_usuario_alta");
$tarifa_aplicable= $visit->dbBuilder->getPreferenciaFromAtributo("tarifa_aplicable");
$fila->tarifa = $tarifa->valor;
?>
<IMG SRC="f_registro_clientes.jpg" WIDTH="452" HEIGHT="48" BORDER="0" ALT="">
<? if ($error=="1"){ ?>
	<table width="100%" border="0" cellpadding="3" cellspacing="1" >
		<tr>
			<td class="explicacioncompra">
				<B style="color :#971605"><?= trad("mensaje_error_registro") ?></B>
			</td>
		</tr>
	</table>
	<BR>
<? } ?>

<!-- <table width="100%" border="0" cellpadding="3" cellspacing="1" >
	<tr>
		<td class="explicacioncompra"><?= trad("mensaje_registro") ?></td>
	</tr>
</table> -->
<form name="formulario" method="post" action="do.php">



<? include_once(getcwd()."/inc_form_clientes.php");?>

</form>


<?
include_once(getcwd()."/bottom.php");
?>