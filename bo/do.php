<?
include_once(dirname(__FILE__)."/include.php");
$dict=$visit->util->getRequest();
$op = $dict["op"];

// COMANAGER 1.0: TABLA paginas
if ($op=="modificar_paginas") {
	if ($id!="") {
		$obj = $visit->dbBuilder->getPaginasId($id);
	} else {
		$obj = new ClsPaginas();
	}
	if (!$visit->options->tieneAcceso("form",$obj)) $visit->options->sinAcceso();
	$objPrevio = $obj;
	$obj->estableceCampos( $dict);
	if ($id=="") $obj->id="";

	$obj = $visit->dbBuilder->persist($obj);

	$volverRecurso = "cm_form_paginas.php?id=".$obj->id;
	// alfredo 140716  $volverListado = $session->lspaginas;
	$volverListado = $_SESSION["lspaginas"];
	include(dirname(__FILE__)."/inc_mensaje.php");
	exit();
} else if ($op=="eliminar_paginas") {
	if ($id!="") {
		$obj = new ClsPaginas();
		$obj->id = $id;
		if (!$visit->options->tieneAcceso("remove",$obj)) $visit->options->sinAcceso();
		$visit->dbBuilder->remove($obj);
		
		// alfredo 140716  $volverListado = $session->lspaginas;
		$volverListado = $_SESSION["lspaginas"];
		include(dirname(__FILE__)."/inc_mensaje.php");
		exit();
	}	
} 
else if ($op=="mover_paginas") {
	$obj = new ClsPaginas();
	$obj->_orderby="orden";
	$cols = $visit->dbBuilder->getTablaFiltrada($obj);
	$obj = $visit->dbBuilder->getPaginasId($id);
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
		$inc += 2;
	}
	$visit->util->redirect("cm_ls_paginas.php");
}  // COMANAGER 1.0: FIN TABLA paginas

// COMANAGER 1.0: TABLA section_data
else if ($op=="modificar_section_data") {
	if ($id!="") {
		$obj = $visit->dbBuilder->getSectionDataId($id);
	} else {
		$obj = new ClsSectionData();
	}
	if (!$visit->options->tieneAcceso("form",$obj)) $visit->options->sinAcceso();
	$objPrevio = $obj;
	$obj->estableceCampos( $dict);
	if ($id=="") $obj->id="";
	
	
	$obj = $visit->dbBuilder->persist($obj);

	if ($obj->tipo_valores==N) {
	$objN = new ClsNumericData();
	$objN->idseccion=$id;
	//$objN->value=$id;
	//$objN->idseccion=$id;
	$objN = $visit->dbBuilder->persist($objN);
	}
	if ($obj->tipo_valores==T) {
	$objT = new ClsTextData();
	$objT->idseccion=$id;
	//$objT->value=$id;
	//$objT->idseccion=$id;
	$objT = $visit->dbBuilder->persist($objT);
	}
	if ($obj->tipo_valores==C) {
	$objC = new ClsControlledData();
	$objC->idseccion=$id;
	//$objC->value=$id;
	//$objC->idseccion=$id;
	$objC = $visit->dbBuilder->persist($objC);
	}
	if ($obj->tipo_valores==F) {
	$objF = new ClsDateData();
	$objF->idseccion=$id;
	//$objC->value=$id;
	//$objC->idseccion=$id;
	$objF = $visit->dbBuilder->persist($objF);
	}

	$volverRecurso = "cm_form_section_data.php?id=".$obj->id;
	// alfredo 140716 $volverListado = $session->lssection_data;
	$volverListado = $_SESSION["lssection_data"];
	include(dirname(__FILE__)."/inc_mensaje.php");
	exit();
} else if ($op=="eliminar_section_data") {
	if ($id!="") {
		$obj = new ClsSectionData();
		$obj->id = $id;
		if (!$visit->options->tieneAcceso("remove",$obj)) $visit->options->sinAcceso();
		$visit->dbBuilder->remove($obj);
		
		// alfredo 140716 $volverListado = $session->lssection_data;
		$volverListado = $_SESSION["lssection_data"];
		include(dirname(__FILE__)."/inc_mensaje.php");
		exit();
	}	
} 
else if ($op=="mover_section_data") {
	$obj = new ClsSectionData();
	$obj->_orderby="orden";
	$cols = $visit->dbBuilder->getTablaFiltrada($obj);
	$obj = $visit->dbBuilder->getSectionDataId($id);
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
		$inc += 2;
	}
	$visit->util->redirect("cm_ls_section_data.php");
}else if ($op=="regenera_navegacion") {
	ClsSeccionesCache::eliminaCache();
	$visit->util->redirect("ov/cm_ls_virtual_object.php?idusuario");
}
/* Nuevo Elemento */
?>