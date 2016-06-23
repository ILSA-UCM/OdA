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
$delete=$_REQUEST['StructureOnly'];

if ((!isset($delete))||($delete!="true"))
$delete='false';

	
//Borrar a coleccion antes

$service_url = $ServerService.'exportXLS?userclavy='.Clavyuser.'&passwordclavy='.Clavyuserkey.'&KeyClavy='.Clavykey.'&exclude='.$delete;
$curl = curl_init($service_url);


//exportXLS?userclavy=gayoxo@gmail.com&passwordclavy=ClaW1538457&KeyClavy=89877859&exclude=true
//curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
//curl_setopt($curl, CURLOPT_HEADER,true);

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$curl_response = curl_exec($curl);
if ($curl_response === false) {
    $info = curl_getinfo($curl);
    curl_close($curl);
	echo "<br>";
	echo 'El sistema Clavy en http://'.ClavyServer.':'.ClavyPort.' ha dado un error en la exportacion, por favor intentelo de nuevo';
	echo "<br>";
	echo $curl_response;
	echo "<br>";
	
}else
{
$status = curl_getinfo($curl);
curl_close($curl);
if ($status['http_code']=='200')
{
//list($headers, $content) = explode("\r\n\r\n",$curl_response,2);
//
//// Print header
//foreach (explode("\r\n",$headers) as $hdr)
 //   printf('<p>Header: %s</p>', $hdr);
//
// Print Content
//echo $content;

echo $curl_response;

echo "<br>";
echo "<br>";
echo "<input type=\"button\" name=volver onclick=\"document.location.href= 'index.php';\" value=\"Volver al menu de Import/Export\">";
}
else
{
	echo "<br>";
	echo 'Error: '.$status['http_code'];
	echo 'El sistema Clavy en http://'.ClavyServer.':'.ClavyPort.' ha dado un error en la exportacion, por favor intentelo de nuevo';
	echo "<br>";
	echo $curl_response;
	echo "<br>";
	
}
}

?>

<?php
include_once(getcwd()."/bo_bottom.php");
?>