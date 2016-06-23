<?
include_once(dirname(__FILE__)."/include.php");


$dict = $visit->util->getRequest();
$where ="idseccion='111'";
$obj= new ClsTextData();
//Ejecutar funcion busqueda
    if(isset($_GET['q']) && !eregi('^ *$',$_GET['q'])){
		$q = mysql_real_escape_string($_GET['q']); //para ejecutar consulta
        $busqueda = htmlentities($q); //para mostrar en pantalla
		$strWhere = " WHERE (value LIKE '%$q%' OR idov LIKE '%$q%') AND ".$where." ORDER BY IDOV" ; 
	   
      }else{
			$strWhere =" WHERE ".$where." ORDER BY IDOV" ; 
        }
	
        
		$sql = "SELECT ".$obj->getCampos()." FROM ".$obj->getNombreTabla().$strWhere;	
		$collection = $visit->dbBuilder->execSQL( $sql, $obj );
		

//contar el numero de elementos
$count =0;		
foreach ($collection as $key=>$value){
	if($value->idov !="" && $value->value !="") { $count++;}
}

//Mostrar los resultados
/*
if ($count >= 5) {$count =5;}
if($count > 0){
	echo "<select name=\"ovs\" size=\"'.$count.' \" onChange=\"location='cm_view_virtual_object.php?idov='+this.options [this.selectedIndex].value\">";
	foreach ($collection as $key=>$value){
		if($value->idov !="" && $value->value !=""){
			echo "<option   value='". $value->idov."' >".$value->idov."  ". substr($value->value,0,50)."</option>";
		}
	}
	
	echo "</select>";
}
*/


if ($count >= 5) {$count=5;}
if($count > 0 && $_GET['q'] != "" ){
	$tam=$count * 15 + 10;
	echo "<div  class =\"busqueda_bloque\" style='height:".$tam."px;'>";
	foreach ($collection as $key=>$value){
		if($value->idov !="" && $value->value !=""){
			echo "<div class=\"busqueda_linea\" onclick=\"location.href='cm_view_virtual_object.php?idov=".$value->idov."'\" >".substr(($value->idov."  ". $value->value),0,50)."</div>";
		}
	}
	
}

	
?>

