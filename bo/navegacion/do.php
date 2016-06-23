<? 
include_once(getcwd()."/include.php");
$dict = $visit->util->getRequest();
$id =  $dict["id"];
$idpagina = $dict["idpagina"];
$tipocontenidos = $dict["tipocontenidos"];


//$visit->debuger->enable(true);
//var_dump($dict);
if ($op=="") {
}

// COMANAGER 1.0: TABLA navegacion
else if ($op=="modificar_navegacion") {
	if ($id!="") {
		$obj = $visit->dbBuilder->getNavegacionId($id);
		$objPrevio = $obj;
		$obj->estableceCampos( $dict);
	} else {
		$obj = new ClsNavegacion();
		$objPrevio = $obj;
		$obj->estableceCampos($dict);
		$obj->id="";
		$obj->tipo ="I";
	}
		
	if ($idpagina!="" && $tipocontenidos!="N"){
		$obj->idpagina=$idpagina;
	}
	$obj->nombreseo=$visit->util->getCadenaSeo( $dict["nombre"] );
	
	if ($dict["imagen"] != "") {
		$obj->imagen=$dict["imagen"];
	} else {
		$obj->imagen=$dict["ubicacion_imagen"];
	}
	if ($dict["visible"] != "S") $obj->visible ="N";
	if ($dict['ventanaexterna']!="S")  {
		$obj->ventanaexterna ="N";
	} else {
		$obj->ventanaexterna ="S";
	}
	if ($dict["idpaginaimagenes"] != "S"  && $dict["tipo_contenido"]=="I") $obj->idpagina = $dict["idpaginaimagenes"];
	if ($dict["tiene_contenido"]=="N"){
		$obj->tipo_contenido ="";
		$obj->url ="";
		$obj->ventanaexterna ="";
	}
	$obj = $visit->dbBuilder->persist($obj);

	$volverRecurso = "cm_form_navegacion.php?id=".$obj->id."&tipo=".$dict["tipo"];
	$volverListado = "cm_ls_navegacion.php";
	include(getcwd()."/inc_mensaje.php");
	exit();
	//$visit->util->redirect($volverListado);
} else if ($op=="eliminar_navegacion") {
	if ($id!="") {
		$obj = new ClsNavegacion();
		$obj->id = $id;

		$visit->dbBuilder->remove($obj);


		$volverListado = "cm_ls_navegacion.php";		
		$visit->util->redirect($volverListado);
		//include(getcwd()."/inc_mensaje.php");
		//exit();
	}	
} 
else if ($op=="mover_navegacion") {
	$valor= $dict["valor"];
	$obj = $visit->dbBuilder->getNavegacionId($id);
	$objFiltro = new ClsNavegacion();
	$objFiltro->idpadre=$obj->idpadre;
	$objFiltro->tipo=$obj->tipo;
	$objFiltro->lang=$obj->lang;
	$objFiltro->_orderby="orden";
	$cols = $visit->dbBuilder->getTablaFiltrada($objFiltro);
	$inc = 2;
	for($i=0;$i<count($cols);$i++) {
		$cols[$i]->orden = $inc;
		if ($obj->id==$cols[$i]->id) {
			if ($valor=="1") {
				$cols[$i]->orden = $inc-3;
			} else {
				$cols[$i]->orden = $inc+3;
			}
		}
		$visit->dbBuilder->persist( $cols[$i] );
		
		$visit->dbBuilder->updateIdlangprincipal( $cols[$i] );
		//print "<br>".$cols[$i]->nombre . " ". $cols[$i]->orden . " ". $cols[$i]->idpadre;
		$inc += 2;
	}
	//exit();
	$visit->util->redirect("cm_ls_navegacion.php?tipo=".$obj->tipo."&lang=". $lang );
}  // COMANAGER 1.0: FIN TABLA navegacion

// COMANAGER 1.0: TABLA preferencias_presentacion
else if ($op=="modificar_preferencias_presentacion") {
	if ($id!="") {
		$obj = $visit->dbBuilder->getPreferenciasPresentacionId($id);
	} else {
		$obj = new ClsPreferenciasPresentacion();
	}
	if (!$visit->options->tieneAcceso("form",$obj)) $visit->options->sinAcceso();
	$objPrevio = $obj;
	$obj->estableceCampos( $dict);
	if ($id=="") $obj->id="";
	
	
	$obj = $visit->dbBuilder->persist($obj);

	$visit->util->redirect("cm_ls_navegacion.php?tipo=".$tiponav);
	
}  
// COMANAGER 1.0: FIN TABLA preferencias_presentacion
/* Nuevo Elemento */

/*
function getIdPrimerHijo($obj) {
	global $visit;
	$res="";
	$hijo = $visit->dbBuilder->getPrimerHijoVisible($obj->id);
	if ($hijo=="") return "";
	if ($hijo->tipo_contenido=="H") {
		$res = getIdPrimerHijo($hijo);
	} else {
		$res = $hijo->id;
	}
	return $res;
}

function recalcularPrimerHijo($id) {

}
*/
