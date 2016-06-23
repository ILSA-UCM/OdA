<? 
include("include.php");
//header ("location: login.php");



//Variables de la URL
$dict = $visit->util->getRequest();
$cop = $dict["cop"];
$path = $dict["path"];
$nombre_archivo= $dict["nombre_archivo"];
$destino = $dict["destino"];
$parametrosurl = $dict["parametrosurl"];
$files = $dict["files"];


//var_dump($dict);
//$visit->debuger->enable(true);
if ($op=="modificar_banco") {
	$objeto = new ClsBanco();
	$objPrevio = $objeto;
	$objeto->ruta= "/". $ruta;
	$obj = getTablaFiltradaRuta($objeto);
	if ($obj->id==""){
		$obj = new ClsBanco();
		$obj->ruta= "/". $ruta;
		$obj->descripcion= $descripcion;
		$obj = $visit->dbBuilder->persist($obj);
	}else{
		$obj->ruta= "/". $ruta;
		$obj->descripcion= $descripcion;
		$obj = $visit->dbBuilder->persist($obj);
	}
	
	if ($id!="") {
		$visit->util->redirect($HTTP_REFERER);
	} else {
		$visit->util->redirect("cm_view_banco.php?nombre_archivo=". $ruta);
	}	

} 
else if ($op== "cargar_archivo" ){
	//SUbir el archivo
	$origen = $dict["origen"];
	$nombre=$visit->util->getNombreArchivo($origen);
	if ($_FILES[$origen]["size"]>0) $downloadHttpPrefix = $destino."/";
	$origen="nombre_archivo";
	if ($_FILES[$origen]["size"]>0) {
		$downloadHttpPrefix = $destino."/";
		$visit->util->descargaArchivo($_FILES[$origen], getcwd()."/".$downloadHttpPrefix );
	}	
	//Si es un zip extraerlo y borrar el zip
	$extension = substr($_FILES["nombre_archivo"]["name"], strlen($_FILES["nombre_archivo"]["name"])-3, 3);
	if (strcmp($extension, "zip")==0) {

		/*if($visit->util->existeArchivoBR($id,$_FILES["nombre_archivo"]["name"]) ){
			//Almacenamos el archivo en un directorio temporal
				var_dump("archivo existente");exit();
			$path=  getcwd() . "/../../download/bancorecursos";

			mkdir($path."/".$nombreDirectorio);
			chmod($path."/".$nombreDirectorio,0777);

			$visit->util->descargaArchivo($_FILES["nombre_archivo"],$tmp);					

			$nombreArchivo =$_FILES["nombre_archivo"]["name"];					
			$url = "/oda2011/bo/ov/error.php?error=1&id=".$id."&name=".$nombreArchivo."&tipo=H";
			$visit->util->redirect($url);
		} else {*/

		$nombreDirectorio = $_FILES["nombre_archivo"]["name"];		
		$path = getcwd()."/".$downloadHttpPrefix;


		$archivo = new PclZip($path."/".$_FILES["nombre_archivo"]["name"]);

		//if(!mkdir($path.$nombreDirectorio."_".time(),0777)){
			$url = "/oda2011/bo/ov/error.php?";
			$visit->util->redirect($url);
		//} else {

			if($archivo->extract(PCLZIP_OPT_PATH,$path.$nombreDirectorio."_".time()) == 0 ){
				die("Error : ".$archivo->errorInfo(true));	
			}

		//}	

		unlink($path.$_FILES["nombre_archivo"]["name"]);
	}

	//Redirección
	if ($parametrosurl!=""){
		$visit->util->redirect($parametrosurl);
	}else{
		$visit->util->redirect("ls_recursos.php?path=".$destino);
	}
	
	//$visit->util->cerrarVentanaActualizarUrl("cm_ls_banco.php?path=".$destino);
}
else if($cop== "crear_carpeta" ){
	
	if ( $path=="") $path=getcwd ()."/../../download/bancorecursos/";
	mkdir ($path."/".$nombre_carpeta);
	chmod($path."/".$nombre_carpeta,0777);
	//$visit->util->redirect("ls_recursos.php?path=".$path);
	$visit->util->cerrarVentanaActualizarUrl("ls_recursos.php?path=".$path);
}
else if ($cop== "eliminar_archivos" ){
	$nombre_archivo= explode(",",$files);
	//Eliminamos el contenido de la cookie
	SetCookie("archivos_seleccionados");
	for ($i=0;$i<count($nombre_archivo);$i++) {	
		if (is_dir($nombre_archivo[$i])) {
			if (!@rmdir ($nombre_archivo[$i])) {
				include(getcwd()."/inc_mensaje.php");
				exit();
			}else{
				@rmdir ($nombre_archivo[$i]);
			}
		}else if (is_file($nombre_archivo[$i])){
			unlink ($nombre_archivo[$i]);
			
		}
		
	}
	$visit->util->redirect("ls_recursos.php?path=".$destino);
}
else if ($cop== "copiar_archivos" ){
	$nombre_archivo= explode(",",$files);

	for ($i=0;$i<count($nombre_archivo);$i++) {
		$nombre=$visit->util->getNombreArchivo($nombre_archivo[$i]);
		if (is_file($nombre_archivo[$i])) {
			copy ($nombre_archivo[$i],$destino."/".$nombre);
			/*$objprevio = new ClsBanco();
			$objprevio->ruta=$nombre_archivo[$i];
			$fila= getTablaFiltradaRuta($objprevio);
			$obj = new ClsBanco();
			$obj->ruta = $destino."/".$nombre;
			$obj->descripcion = $fila[0];
			$visit->dbBuilder->persist( $obj );*/
		
		}
	}
	$visit->util->redirect("ls_recursos.php?path=".$destino);
}
else if ($cop== "cortar_archivos" ){
	
	$nombre_archivo= explode(",",$files);
	for ($i=0;$i<count($nombre_archivo);$i++) {	
		$nombre=$visit->util->getNombreArchivo($nombre_archivo[$i]);
		//$objprevio = new ClsBanco();
		//$objprevio->ruta="/".$nombre_archivo[$i];
		//$fila= getTablaFiltradaRuta($objprevio);
		//$obj = new ClsBanco();
		//$obj->id= $fila->id ;
		//$obj->ruta = "/".$destino."/".$nombre;
		//$obj->descripcion = $fila->descripcion;
		//$visit->dbBuilder->persist( $obj );
		@rename($nombre_archivo[$i],$destino."/".$nombre);
		
	}
	//$files="";
	//Eliminamos el contenido de la cookie

	$expdate = (Time() - (60 * 24 * 60 * 60 * 1000)); // 24 hrs from now 
	SetCookie("archivos_seleccionados",files);
	//echo "<BR>".$expdate;
	//echo "dfd".$HTTP_COOKIE_VARS["archivos_seleccionados"]; 
	$visit->util->redirect("ls_recursos.php?path=".$destino);
} else if ($cop="eliminar_carpeta"){
	$nombre_archivo= explode(",",$files);
	//Eliminamos el contenido de la cookie
	SetCookie("archivos_seleccionados");
	for ($i=0;$i<count($nombre_archivo);$i++) {	
		if (is_dir($nombre_archivo[$i])) {
			$visit->util->rrmdir($nombre_archivo[$i]);
		}else if (is_file($nombre_archivo[$i])){
			unlink ($nombre_archivo[$i]);
		}
		
	}
	$visit->util->redirect("ls_recursos.php?path=".$destino);
}

?>
