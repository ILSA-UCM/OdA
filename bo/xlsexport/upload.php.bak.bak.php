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
$teamImage = $_FILES["file"];
/*
$APPLICATION_ID = "XXXXXXXXXXXXXXXXXXX";
$REST_API_KEY = "XXXXXXXXXXXXXXXXXXX";
*/
echo "<br>";
echo "name:".$teamImage['name'];


$ServerService='http://'.ClavyServer.':'.ClavyPort.'/'.ClavyDomine.'/rest/service/';

$urlFile = $ServerService.'uploadoda2?userclavy='.Clavyuser.'&passwordclavy='.Clavyuserkey.'&KeyClavy='.Clavykey;
//$urlFile = 'https://api.parse.com/1/files/' . $teamImage['name'];
$image = $teamImage['tmp_name'];
echo $image;
/*
$headerFile = array(
    'X-Parse-Application-Id: ' . $APPLICATION_ID,
    'X-Parse-REST-API-Key: ' . $REST_API_KEY,
    'Content-Type: ' . $teamImage['type'],
    'Content-Length: ' . strlen($image),
);*/
echo "<br>";
echo $urlFile;
echo "<br>";
$t_fich = $_FILES['file']['name'];
var_dump($t_fich);
echo "<br>";
echo 'php://temp' . "/" . $t_fich;
copy($_FILES['file']['tmp_name'],  . "/" . $t_fich);
echo "<br>";


$curlFile = curl_init($urlFile);
curl_setopt($curlFile, CURLOPT_POST, 1);
curl_setopt($curlFile, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curlFile, CURLOPT_HTTPHEADER, array('Content-Type: multipart/form-data')); 

$post = array(
    'file' => '@'. 'php://temp' . "/" . $t_fich
);

curl_setopt($curlFile, CURLOPT_POSTFIELDS,$post);

//curl_setopt($curlFile, CURLOPT_HTTPHEADER, $headerFile);
curl_setopt($curlFile, CURLOPT_SSL_VERIFYPEER, false); 

$responseFile = curl_exec($curlFile);
$httpCodeFile = curl_getinfo($curlFile, CURLINFO_HTTP_CODE);

echo "<br>";
echo $httpCodeFile;

$result = array('code'=>$httpCodeFile, 'response'=>$responseFile);

echo "<br>";
echo hola2;
 ?>

<?php
include_once(getcwd()."/bo_bottom.php");
?>