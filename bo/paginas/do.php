<? 
include("include.php");

$dict = $visit->util->getRequest();


	$valor = $dict["valor"];
	$idpagina = $dict["idpagina"];
	$idpaginaprincipal = $dict["idpaginaprincipal"];
	$modo =$dict["modo"];
	$documento = $dict["documento"];

//$visit->debuger->enable(true);

// COMANAGER 1.0: TABLA paginas
if ($op=="modificar_paginas") {
	$lang = "es";
	if ($id!="") {
		$obj = $visit->dbBuilder->getPaginasId($id);
	} else {
		$obj = new ClsPaginas();
	}
	if (!$visit->options->tieneAcceso("form",$obj)) $visit->options->sinAcceso();
	$objPrevio = $obj;
	$obj->estableceCampos( $dict);
	if ($id=="") $obj->id="";

	if ($dict["visible"]=="S"){
		$obj->visible="S";
	}else{
		$obj->visible="N";
	}
	

	if ($documento!="") {
		$obj->documento=$documento;
	} else {
		$obj->documento=$ubicacion_documento;
	}

	$obj = $visit->dbBuilder->persist($obj);

	crearTablaRelacionEne($obj, new ClsContenidosPagina(), "campocontenidospagina", "idpagina", $lang);

	if ($lang == "es" && $id==""){
		$obj2 = new ClsPaginas();
		$visit->dbBuilder->creaFilasFromLang($obj2,$obj,$dict);
		
		$objPrevio = $visit->dbBuilder->getPaginasId($obj->id);
		$objPrevio->idlangprincipal = $obj->id;
		$objPrevio->id = $obj->id;
		$objPrevio = $visit->dbBuilder->persist($objPrevio);
		
		$visit->dbBuilder->persistFromIdlangprincipal($objPrevio);
		
	}
	if ($id!=""){
		$obj2 = $visit->dbBuilder->persistFromIdlangprincipal($obj);
	}

	if ($cargar=="1") $visit->util->redirect("cm_form_paginas.php?id=".$objPrevio->id);

	$volverRecurso = "cm_form_paginas.php?id=".$objPrevio->id;
	$volverListado = $_SESSION["lspaginas"];
	// alfredo  140716   $volverListado ="cm_ls_paginas.php";
	include(getcwd()."/inc_mensaje.php");
	exit();
} else if ($op=="eliminar_paginas") {
	if ($id!="") {
		$obj = new ClsPaginas();
		$obj->id = $id;
		if (!$visit->options->tieneAcceso("remove",$obj)) $visit->options->sinAcceso();
		$visit->dbBuilder->remove($obj);
		///$visit->dbBuilder->removeFromlang($obj);
		//$volverListado = $session->lspaginas;
		//include(getcwd()."/inc_mensaje.php");
		//exit();
		$visit->util->redirect("cm_ls_paginas.php?lang=".$lang);
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
	$visit->util->redirect("cm_ls_paginas.php?lang=".$lang);
}
// COMANAGER 1.0: FIN TABLA paginas


// COMANAGER 1.0: TABLA contenidos_boletin
else if ($op=="modificar_contenidos_pagina") {
	if ($id!="") {
		$obj = $visit->dbBuilder->getContenidosPaginaId($id);
	} else {
		$obj = new ClsContenidosPagina();
	}
	if (!$visit->options->tieneAcceso("form",$obj)) $visit->options->sinAcceso();
	$objPrevio = $obj;
	$obj->estableceCampos( $dict);
	if ($id=="") $obj->id="";
		
	if ($_FILES["imagen"]["size"]>0) {
		$downloadHttpPrefix = "download/";
		$visit->util->descargaArchivo($_FILES["imagen"], getcwd()."/".$downloadHttpPrefix );
		$obj->imagen=$downloadHttpPrefix. $_FILES["imagen"]["name"];
	} else {
		$obj->imagen=$objPrevio->imagen;
	}
				
	
	$obj = $visit->dbBuilder->persist($obj);

	$volverRecurso = "cm_form_contenidos_pagina.php?id=".$obj->id;
	// alfredo 140716   $volverListado = $session->lscontenidos_pagina;
	$volverListado = $_SESSION["lscontenidos_pagina"];
	include(getcwd()."/inc_mensaje.php");
	exit();
} else if ($op=="eliminar_contenidos_pagina") {
	if ($id!="") {
		$obj = new ClsContenidosPagina();
		$obj->id = $id;
		if (!$visit->options->tieneAcceso("remove",$obj)) $visit->options->sinAcceso();
		$visit->dbBuilder->remove($obj);
		// alfredo 140716  $volverListado = $session->lscontenidos_pagina;
		$volverListado = $_SESSION["lscontenidos_pagina"];
		$visit->util->redirect("cm_form_paginas.php?id=". $idpaginaprincipal."&modo=".$modo."&lang=". $lang);
		//include(getcwd()."/inc_mensaje.php");
		//exit();
	}	
} 
else if ($op=="mover_contenidos_pagina") {
	
	
	$obj = new ClsContenidosPagina();
	$obj->_orderby="orden";
	$obj->idpagina=$idpagina;
	$cols = $visit->dbBuilder->getTablaFiltrada($obj);
	//$obj = $visit->dbBuilder->getContenidosPaginaId($id);
	$obj->id = $dict["id"];
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
	$visit->util->redirect("cm_form_paginas.php?id=". $idpaginaprincipal."&modo=".$modo."&lang=". $lang);
}  // COMANAGER 1.0: FIN TABLA contenidos_boletin

/* Nuevo Elemento */

function crearTablaRelacionEne($objPadre, $objCopia, $npatron, $idcamporelacionado, $lang) {
	global $dict,$visit,$_FILES;
	$arr = array();
	$menosId="";
	$patron=$npatron."_";
	//$visit->debuger->enable(true);
	//var_dump($dict);
	reset($dict);
	while (list($k,$v)=each($dict)) {
		
		if (substr($k,0,strlen($patron))==$patron) {
			
			if (strpos($k,"_")==strrpos($k,"_")) {
				
				$i = substr($k,strlen($patron) );
				$prefijo = $patron.$i."_";
				$obj = $objCopia->newInstance();
				$dict[$prefijo.$idcamporelacionado]=$objPadre->id;				
				$obj->estableceCampos($dict, $prefijo);
				$obj->request2bbdd($dict, $prefijo);
				$obj->lang =$lang;

				//if ($i!="1") {
				if ($obj->tipo!="" ) {
					$obj = $visit->dbBuilder->persist( $obj );
					$menosId = $menosId . "," . $obj->id;
				}
			}
		}
	}
	if ($menosId!="") $menosId = substr($menosId,1);
	$visit->dbBuilder->borrarTablaRelacionEneMenos($objPadre, $objCopia, $idcamporelacionado, $menosId);
	//exit();
	return;
}

?>