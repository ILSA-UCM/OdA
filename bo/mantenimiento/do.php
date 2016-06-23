<? 
include_once(getcwd()."/include.php");

$dict=$visit->util->getRequest();
$urlBase = dirname(__FILE__);

//$visit->debuger->enable(true);
//var_dump($dict);
if ($op=="") {
}
else if($op=="eliminar_recursos"){
	$ids= explode("," , $dict["id"]);
	$obj = new ClsResources();
	//$ruta= str_replace ("/","\\",$ruta);
	//$ruta = dirname(__FILE__).$ruta;
	//$ruta= str_replace ("\mantenimiento","",$ruta);
	//var_dump($ruta);
	foreach($ids as $calve => $valor){
		if ($valor!="") {
			//$obj->id = $valor;			
			$obj = $visit->dbBuilder->getResourcesId($valor);
			$ruta = "../download/".$obj->idov."/".$obj->name;
			if($obj->idresources_refered==""){
				unlink($urlBase."/".$ruta);
			}
			//var_dump($ruta);exit();
			if (!$visit->options->tieneAcceso("remove",$obj)) $visit->options->sinAcceso();
			$visit->dbBuilder->remove($obj);
			
		}
	}
	
	
	/*$volverRecurso = "cabecera.php?lang=".$lang;
	$volverListado = ""; 
	include(getcwd()."/inc_mensaje.php");
	exit();*/
	
	// alfredo 140707  $visit->util->redirect($session->lsrecursos);
	$visit->util->redirect($_SESSION['lsrecursos']);
	
	
}