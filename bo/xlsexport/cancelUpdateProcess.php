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

$ServerService='http://'.ClavyServer.':'.ClavyPort.'/'.ClavyDomine.'/rest/service/';
$delete=true;

$service_url = $ServerService.'importOda2?user='.TZN_DB_EXTERNAL_USER.'&password='.TZN_DB_EXTERNAL_PASS.'&server='.TZN_DB_EXTERNAL_HOST.'&database='.TZN_DB_BASE.'&port=3306&url=http://'.TZN_ODA_HOST.'/'.APP_NAME.'&convert=true&userclavy='.Clavyuser.'&passwordclavy='.Clavyuserkey.'&KeyClavy='.Clavykey;
$curl = curl_init($service_url);

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 1800); // Setting the amount of time (in seconds) before the request times out
curl_setopt($curl, CURLOPT_TIMEOUT, 3600); // Setting the maximum amount of time for cURL to execute queries 
$curl_response = curl_exec($curl);
if ($curl_response === false) {
    $info = curl_getinfo($curl);
    curl_close($curl);
	echo "<br>";
	echo 'El sistema Clavy en http://'.ClavyServer.':'.ClavyPort.' ha dado un error en la carga, por favor intentelo de nuevo';
	echo "<br>";
	echo $curl_response;
	echo "<br>";
	
}else
{
$status = curl_getinfo($curl);
curl_close($curl);
if ($status['http_code']=='200')
{
echo "<br>";
echo $curl_response;
echo "<br>";
echo "<br>";
echo "<input type=\"button\" name=volver onclick=\"document.location.href= 'index.php';\" value=\"Volver al menu de Import/Export\">";
}
else
{
	echo "<br>";
	echo 'Error: '.$status['http_code'];
	echo 'El sistema Clavy en http://'.ClavyServer.':'.ClavyPort.' ha dado un error en la carga, por favor intentelo de nuevo';
	echo "<br>";
	echo $curl_response;
	echo "<br>";
	
}

header ("Location: index.php");

}

?>

<?php
include_once(getcwd()."/bo_bottom.php");
?>