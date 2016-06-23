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


//Fase 1 Revision del sistema, si esta activo
$ServerService='http://'.ClavyServer.':'.ClavyPort.'/'.ClavyDomine.'/rest/service/';
$service_url = $ServerService.'active';
$curl = curl_init($service_url);

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
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
$curl_response = curl_exec($curl);
if ($curl_response === false) {
    $info = curl_getinfo($curl);
    curl_close($curl);
	echo 'El sistema Clavy en '.$Server.' no esta activo, por favor pruebe de nuevo y contacte con el administrador si persiste';
  
}else
{

$rol=$visit->options->usuario->rol;

if ($rol==A)
	$Admin=true;
else
	$Admin=false;

if ($rol==C)
	$User=true;
else
	$User=false;
	
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
			echo "<input type=\"button\" id=\"importB\" name=Import1 onclick=\"document.location.href= 'load.php?delete=false';\" value=\"Cargar coleccion al sistema de actualizacion/exportacion\">";
		}
		else{
			if ($status['http_code']=='200')
			{
			echo "<p> Fecha de la ultima actualizacion o carga : ".$curl_response."</p>";
			}
			
			$IsLoadCollection=true;
		if ($Admin)
			echo "<input type=\"button\" id=\"importB\" name=Import1 onclick=\"document.location.href= 'load.php?delete=true';\" value=\"Cargar de nuevo la coleccion al sistema de actualizacion/exportacion\">";
			}
		}
	
	
}
echo "<br>";
echo "<br>";
echo "<br>";

//Fase 3 Recuperacion del XLS

if ($IsLoadCollection)
$disponible=enabled;
else
$disponible=disabled;


echo "<p>Exportacion en XLS</p>";

echo "<input type=\"button\" name=export1 id=\"exportAll\" onclick=\"document.location.href= 'exportC.php?StructureOnly=false';\" value=\"Exportar Coleccion a XLS\"".$disponible.">";

echo "<br>";
echo "<br>";

echo "<input type=\"button\" name=export1 id=\"exportOnly\" onclick=\"document.location.href= 'exportC.php?StructureOnly=true';\" value=\"Exportar Coleccion a XLS (Solo Estructura)\" ".$disponible.">";

echo "<br>";
echo "<br>";
echo "<br>";

//Fase 4 Carga del archivo

if ($Admin||!$User)
{
echo "<p>Actualiza sistema con un XLS</p>";

//$ServerService='http://'.ClavyServer.':'.ClavyPort.'/Clavy/rest/service/';
//$urlFile = $ServerService.'uploadoda2?userclavy='.Clavyuser.'&passwordclavy='.Clavyuserkey.'&KeyClavy='.Clavykey;
//echo "<form method=\"post\" action=\"".$urlFile."\" ENCTYPE=\"multipart/form-data\">
echo "<form id=\"uploadForm\" method=\"post\" action=\"upload.php\" ENCTYPE=\"multipart/form-data\">
  <input type=\"file\" id=\"uploadFile\" name=\"file\" accept=\".xls,.xlsx\">
  <input type=\"button\" id=\"submitButton\" onclick=\"preUpload();\" value=\"enviar\" name=\"enviar\" ".$disponible.">
</form>";

echo '<script>function preUpload(){'. 
'document.getElementById(\'submitButton\').disabled = true;'.
//'document.getElementById(\'uploadFile\').disabled = true;'.
'document.getElementById(\'exportAll\').disabled = true;'.
'document.getElementById(\'exportOnly\').disabled = true;'.
'document.getElementById(\'importB\').disabled = true;'.
'document.getElementById(\'uploadForm\').submit();'.
'}</script>';
}
}
 ?>

<?php
include_once(getcwd()."/bo_bottom.php");
?>