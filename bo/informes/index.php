<?php 
include_once(getcwd()."/include.php");
$titulopaginabo="Menu de Generacion De Informes";
$explicaciontitulopaginabo="Menu de Generacion De Informes en formato paginas HTML";
$visit->options->seccion = "Informes";
$visit->options->subseccion = "Informes";
include_once(getcwd()."/bo_top.php");
include_once("config.php");
?>

<?php

$id=$visit->options->usuario->id;
$rol=$visit->options->usuario->rol;

if ($rol==A)
	$Admin=true;
else
	$Admin=false;


//Fase 1 Revision del sistema, si esta activo
$ServerService='http://'.ClavyServer.':'.ClavyPort.'/'.ClavyDomine.'/rest/service/';
$service_url = $ServerService.'active';
$curl = curl_init($service_url);

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 1800); // Setting the amount of time (in seconds) before the request times out
curl_setopt($curl, CURLOPT_TIMEOUT, 3600); // Setting the maximum amount of time for cURL to execute queries 
$curl_response = curl_exec($curl);
if ($curl_response === false) {
    $info = curl_getinfo($curl);
    curl_close($curl);
	echo 'El sistema Clavy en http://'.ClavyServer.':'.ClavyPort.' no esta activo, por favor pruebe de nuevo y contacte con el administrador si persiste';
  
}else
{

$IsLoadCollection=false;

//Fase 2 Revision de carga de la coleccion
$service_url = $ServerService.'loadstatusoda2?KeyClavy='.Clavykey;
$curl = curl_init($service_url);

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 1800); // Setting the amount of time (in seconds) before the request times out
curl_setopt($curl, CURLOPT_TIMEOUT, 3600); // Setting the maximum amount of time for cURL to execute queries 
$curl_response = curl_exec($curl);
if ($curl_response === false) {
    $info = curl_getinfo($curl);
    curl_close($curl);
	echo 'El sistema Clavy en '.$Server.' no esta activo, por favor pruebe de nuevo y contacte con el administrador si persiste';
  
}else
{
echo "<p>Estado de carga en el Actualizador/Exportador</p>";
//fase 2 Correcta
$status = curl_getinfo($curl);
curl_close($curl);
if ($status['http_code']=='403'||$status['http_code']=='500'||$status['http_code']=='501')
	{
	echo $curl_response;
	$IsLoadCollection=false;
	}
	else{ 
		if ($status['http_code']=='404')
		{
		$IsLoadCollection=false;
		if ($Admin)
			echo "<input type=\"button\" id=\"importB\" name=Import1 onclick=\"document.location.href= 'load.php?delete=false';\" value=\"Importar colección a Clavy\">";
		}
		else{
			if ($status['http_code']=='200')
			{
			echo "<p> Fecha de la ultima actualizacion o carga : ".$curl_response."</p>";
			}
			
			$IsLoadCollection=true;
			if ($Admin)
				echo "<input type=\"button\" id=\"importB\" name=Import1 onclick=\"document.location.href= 'load.php?delete=true';\" value=\"Volver a importar colección a Clavy\">";
			}
		}
	
	
}
echo "<br>";
echo "<br>";
echo "<br>";

//Fase 3 Recuperacion del HTML

if ($IsLoadCollection)
$disponible=enabled;
else
$disponible=disabled;


echo "<p>Exportacion en HTML</p>";

echo "<input type=\"button\" name=export1 id=\"exportAll\" onclick=\"document.location.href= 'exportHP.php';\" value=\"Generar informes HTML\"".$disponible.">";

echo "<br>";
echo "<br>";


}
 ?>

<?php
include_once(getcwd()."/bo_bottom.php");
?>