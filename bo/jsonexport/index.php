<?php 

include_once ("../../resources/include.php"); 
include_once ("../top_services.php"); 
?>

<?php


function Conectarse() 
{ 

   if (!($link=mysqli_connect(TZN_DB_HOST,TZN_DB_USER,TZN_DB_PASS,TZN_DB_BASE))) 
   { 
      echo "Error conectando a la base de datos."; 
      exit(); 
   } 

   mysqli_query($link,"SET NAMES 'utf8'");
   return $link; 
}

$id=$visit->options->usuario->id;
$rol=$visit->options->usuario->rol;

if ($rol=="A")
	$Admin=true;
else
	$Admin=false;

if ($rol=="C")
	$User=true;
else
	$User=false;


if (!Admin)
{
	echo "{}";
	die();
}

$link=Conectarse(); 

	$arraySalida = array();


	//VO

	$arrayVO = array();
	$result=mysqli_query($link,"SELECT * FROM virtual_object"); 
	while($row = mysqli_fetch_array($result))
	{
		$arrayVO[] = $row;

	}
	
	$arraySalida["virtual_object"]=$arrayVO;
	
	//RESOURCE/FILES
	
	$arrayFI = array();
	$result=mysqli_query($link,"SELECT * FROM resources"); 
	while($row = mysqli_fetch_array($result))
	{
		$arrayFI[] = $row;

	}
	
	$arraySalida["resources"]=$arrayFI;
	
	
	//SECTION DATA
	
	$arraySD = array();
	$result=mysqli_query($link,"SELECT * FROM section_data"); 
	while($row = mysqli_fetch_assoc($result))
	{
		$arraySD[] = $row;

	}
	
	$arraySalida["section_data"]=$arraySD;
	
	//TEXT_DATA
	
	$arrayTD = array();
	$result=mysqli_query($link,"SELECT * FROM text_data"); 
	while($row = mysqli_fetch_assoc($result))
	{
		$arrayTD[] = $row;

	}
	
	$arraySalida["text_data"]=$arrayTD;
	
	//CONTROLLED_DATA
	
	$arrayCD = array();
	$result=mysqli_query($link,"SELECT * FROM controlled_data"); 
	while($row = mysqli_fetch_assoc($result))
	{
		$arrayCD[] = $row;

	}
	
	$arraySalida["controlled_data"]=$arrayCD;
	
	//DATE_DATA
	
	$arrayDD = array();
	$result=mysqli_query($link,"SELECT * FROM date_data"); 
	while($row = mysqli_fetch_assoc($result))
	{
		$arrayDD[] = $row;

	}
	
	$arraySalida["date_data"]=$arrayDD;
	
	//NUMERIC_DATA
	
	$arrayND = array();
	$result=mysqli_query($link,"SELECT * FROM numeric_data"); 
	while($row = mysqli_fetch_assoc($result))
	{
		$arrayND[] = $row;

	}
	
	$arraySalida["numeric_data"]=$arrayND;

	echo json_encode($arraySalida);

//echo "{\"Soy\": \"Admin\"}";

 ?>
