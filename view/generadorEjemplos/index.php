<?php 
include_once ("../../resources/include.php"); 
include_once("../top.php");

$titulopaginabo="Menu de Generacion De Ejemplos";
$explicaciontitulopaginabo="Menu de Generacion De Ejemplos";
$visit->options->seccion = "Generacion";
$visit->options->subseccion = "Ejemplos";
?>

<?php

$id=$visit->options->usuario->id;
$rol=$visit->options->usuario->rol;

if ($rol==A)
	$Admin=true;
else
	$Admin=false;



if (isset($_POST["buscadorin"]))
{
	
$valor_in=$_POST["buscadorin"];
	
	$envio="{\"query\": \"".$_POST["buscadorin"]."\"}";
	
	
	$service_url='http://localhost:8420/gen';

	
	$curl = curl_init($service_url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST,           1 );
curl_setopt($curl, CURLOPT_POSTFIELDS,$envio); 
curl_setopt($curl, CURLOPT_HTTPHEADER,     array('Content-Type: application/json')); 
curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 1800); // Setting the amount of time (in seconds) before the request times out
curl_setopt($curl, CURLOPT_TIMEOUT, 3600); // Setting the maximum amount of time for cURL to execute queries 
$curl_response = curl_exec($curl);

if ($curl_response === false) {
    $info = curl_getinfo($curl);
    curl_close($curl);
	echo 'El sistema de generacion no funciona en este momento, por favor prueve mas tarde.';
}else
{
	$valor_resultado=$curl_response;	
}
}



 ?>
 <form name="formulario" action="" method="POST" ENCTYPE="multipart/form-data">

 
<div class="busc_img">


		<INPUT class="boton_buscar" TYPE="submit"  VALUE="" />
	</div> 

		<div class="tabla_buscador">


<span>Verbo a Buscar: </span><input class="busc_input" name="buscadorin" type="text" size="100" maxlength="255" value="<?=$valor_in?>"
								 >

</div>
<hr>


<style type="text/css">
  input.sololectura {     background-color: #ccc;     font-size: 20px; }
</style>


<div class="tabla_buscador">




<span>Resultado&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </span>
<input class="busc_input sololectura" name="buscadorout" type="text" size="100" maxlength="255" readonly value=<?=$valor_resultado?>
								 >

	</div>

 
</form>
<?php
include_once(dirname(__FILE__)."/bottom.php"); 
?>