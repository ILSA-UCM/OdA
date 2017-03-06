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

$teamImage = $_FILES['file']['tmp_name'];

$ServerService='http://'.ClavyServer.':'.ClavyPort.'/'.ClavyDomine.'/rest/service/';

$urlFile = $ServerService.'uploadoda2?userclavy='.Clavyuser.'&passwordclavy='.Clavyuserkey.'&KeyClavy='.Clavykey;

$filename = basename($_FILES['file']['name']);


$data = array(
'file' => '@'.$teamImage.';type='.$_FILES['file']["type"].';name='.$filename.';filename='.$filename.';fileName='.$filename
);





$curl = curl_init($urlFile);
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: multipart/form-data')); 
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); 
curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 1800); // Setting the amount of time (in seconds) before the request times out
curl_setopt($curl, CURLOPT_TIMEOUT, 3600); // Setting the maximum amount of time for cURL to execute queries 

$curl_response = curl_exec($curl);

if ($curl_response === false) {
    $info = curl_getinfo($curl);
    curl_close($curl);
	echo "<br>";
	echo 'El sistema Clavy en http://'.ClavyServer.':'.ClavyPort.' ha dado un error en la importacion, por favor intentelo de nuevo';
	echo "<br>";
	echo $curl_response;
	echo "<br>";
	
}else
{
$status = curl_getinfo($curl);
curl_close($curl);
if ($status['http_code']=='200')
{
echo $curl_response;

echo "<br>";
echo "<br>";
echo "<input type=\"button\" name=volver onclick=\"document.location.href= 'updateOda.php';\" value=\"Confirmar Actualizacion Oda\">";
echo "<br>";
echo "<br>";
echo "<input type=\"button\" name=volver onclick=\"document.location.href= 'cancelUpdate.php';\" value=\"Cancelar Actualizacion Oda\">";

}
else
{
	echo "<br>";
	echo 'Error: '.$status['http_code'];
	echo 'El sistema Clavy en http://'.ClavyServer.':'.ClavyPort.' ha dado un error en la importacion, por favor intentelo de nuevo';
	echo "<br>";
	echo $curl_response;
	echo "<br>";
}	

}

?>

<?php
include_once(getcwd()."/bo_bottom.php");
?>