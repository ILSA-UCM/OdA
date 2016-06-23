<? 
include("include.php");
//include("top_admin.php");
if ($REQUEST_METHOD=="POST") $dict = $_POST;
else if  ($REQUEST_METHOD=="GET") $dict = $_GET;
//var_dump($dict);
//$visit->debuger->enable(true);



// COMANAGER 1.0: TABLA pagina_imagenes
if ($op=="modificar_pagina_imagenes") {
	if ($id!="") {
		$obj = $visit->dbBuilder->getPaginaImagenesId($id);
	} else {
		$obj = new ClsPaginaImagenes();
	}
	if (!$visit->options->tieneAcceso("form",$obj)) $visit->options->sinAcceso();
	$objPrevio = $obj;
	$obj->estableceCampos( $dict);
	if ($id=="") $obj->id="";
	
	
	$obj = $visit->dbBuilder->persist($obj);


	if ($lang == "es" && $id==""){
		$obj2 = new ClsPaginaImagenes();
		$visit->dbBuilder->creaFilasFromLang($obj2,$obj,$dict);
		
		$objPrevio = $visit->dbBuilder->getPaginaImagenesId($obj->id);
		$objPrevio->idlangprincipal = $obj->id;
		$objPrevio->id = $obj->id;
		$objPrevio = $visit->dbBuilder->persist($objPrevio);
		
	}

	$volverRecurso = "cm_form_pagina_imagenes.php?id=".$objPrevio->idlangprincipal;
	// alfredo 140716  $volverListado = $session->lspagina_imagenes;
	$volverListado = $_SESSION["lspagina_imagenes"];
	include(dirname(__FILE__)."/inc_mensaje.php");
	exit();
} else if ($op=="eliminar_pagina_imagenes") {
	if ($id!="") {
		$obj = new ClsPaginaImagenes();
		$obj->id = $id;
		if (!$visit->options->tieneAcceso("remove",$obj)) $visit->options->sinAcceso();
		$visit->dbBuilder->removeFromlang($obj);
		//$visit->dbBuilder->remove($obj);
		
		// alfredo 140716  $volverListado = $session->lspagina_imagenes;
		$volverListado = $_SESSION["lspagina_imagenes"];
		include(dirname(__FILE__)."/inc_mensaje.php");
		exit();
	}	
} 
// COMANAGER 1.0: FIN TABLA pagina_imagenes

// COMANAGER 1.0: TABLA paginas
else if ($op=="modificar_paginas") {
	if ($id!="") {
		$obj = $visit->dbBuilder->getPaginasId($id);
	} else {
		$obj = new ClsPaginas();
	}
	if (!$visit->options->tieneAcceso("form",$obj)) $visit->options->sinAcceso();
	$objPrevio = $obj;
	$obj->estableceCampos( $dict);
	if ($id=="") $obj->id="";

	if ($visible=="S"){
		$obj->visible="S";
	}else{
		$obj->visible="N";
	}
	if ($_FILES["imagen"]["size"]>0) {
		$downloadHttpPrefix = "../../download/Image/";
		$visit->util->descargaArchivo($_FILES["imagen"], getcwd()."/".$downloadHttpPrefix );
		$obj->imagen=$downloadHttpPrefix. $_FILES["imagen"]["name"];
	} else {
		$obj->imagen=$ubicacion_imagen;
	}

	if ($_FILES["documento"]["size"]>0) {
		$downloadHttpPrefix = "../../download/";
		$visit->util->descargaArchivo($_FILES["documento"], getcwd()."/".$downloadHttpPrefix );
		$obj->documento=$downloadHttpPrefix. $_FILES["documento"]["name"];
	} else {
		$obj->documento=$ubicacion_documento;
	}

	$obj = $visit->dbBuilder->persist($obj);

	if ($lang == "es" && $id==""){
		
		$valores= $visit->options->getIdiomas();
		while (list($k,$v)=each($valores)) { 
			crearTablaRelacionEne($obj, new ClsContenidosPagina(), "campocontenidospagina", "idpagina", $k);
		}
	}else{
		crearTablaRelacionEne($obj, new ClsContenidosPagina(), "campocontenidospagina", "idpagina", $lang);
	}

	if ($lang == "es" && $id==""){
		$obj2 = new ClsPaginas();
		$visit->dbBuilder->creaFilasFromLang($obj2,$obj,$dict);
		
		$objPrevio = $visit->dbBuilder->getPaginasId($obj->id);
		$objPrevio->idlangprincipal = $obj->id;
		$objPrevio->id = $obj->id;
		$objPrevio = $visit->dbBuilder->persist($objPrevio);
		
	}
	if ($id!="")	$obj2 = $visit->dbBuilder->persistFromIdlangprincipal($obj);

	if ($cargar=="1") $visit->util->redirect("cm_form_paginas.php?id=".$objPrevio->idlangprincipal."&lang=".$lang);

	$volverRecurso = "cm_form_paginas.php?id=".$objPrevio->idlangprincipal."&lang=".$lang;
	
	// alfredo 140716  $volverListado = $session->lspaginas;
	$volverListado = $_SESSION["lspaginas"];
	include(getcwd()."/inc_mensaje.php");
	exit();
}


// COMANAGER 1.0: FIN TABLA paginas

else if ($op=="anadir_imagenespaginas") {
	if ($id!="") {
		$obj = $visit->dbBuilder->getImagenespaginasId($id);
		$objPrevio = $obj;
		$obj->estableceCampos( $dict);
	} else {
		$obj = new ClsImagenespaginas();
		$objPrevio = $obj;
		$obj->estableceCampos( $dict);
		$obj->id="";
	}

	$downloadHttpPrefix = "../../download/bancorecursos/";			
	$obj->imagen = $downloadHttpPrefix. $imagen;
	$obj->orden =$orden;
	

	
	$obj->idpaginaimagenes= $idpaginaimagenes;
	$obj = $visit->dbBuilder->persist($obj);	



	if ($lang == "es" && $id==""){
	
		$obj2 = new ClsImagenespaginas();
		$visit->dbBuilder->creaFilasFromLang($obj2,$obj,$dict);
		
		$objPrevio = $visit->dbBuilder->getImagenespaginasId($obj->id);
		$objPrevio->idlangprincipal = $obj->id;
		$objPrevio->id = $obj->id;
		$objPrevio = $visit->dbBuilder->persist($objPrevio);
		
	}
	
	$visit->util->cerrarVentanaActualizarUrl("cm_form_pagina_imagenes.php?id=".$idpaginaimagenes."&lang=".$lang);

	
		//$visit->util->redirect("cm_popup_pagina_imagenes.php?id=".$idrecurso);
	
	/*if ($id!="") {
		$visit->util->redirect($HTTP_REFERER);
	} else {
		$visit->util->redirect("cm_popup_imagenes.php?id=". $obj->id);
	}	*/
}

else if ($op=="modificar_imagenespaginas"){
	$obj = new ClsImagenespaginas();
	crearImagenes($obj);
	$visit->util->redirect("cm_form_pagina_imagenes.php?id=".$idpaginaimagenes."&lang=".$lang);
	//include(getcwd()."/inc_mensaje.php");
	//exit();
} else if ($op=="eliminar_imagenespaginas") {
	if ($id!="") {
		$obj = new ClsImagenespaginas();
		$obj->id = $id;
		if (!$visit->options->tieneAcceso("remove",$obj)) $visit->options->sinAcceso();
		$visit->dbBuilder->removeFromlang($obj);
		//$visit->dbBuilder->remove($obj);
		$visit->util->redirect("cm_form_pagina_imagenes.php?id=".$idpaginaimagenes."&lang=".$lang);
		
		// alfredo 140716  $volverListado = $session->lspagina_imagenes;
		$volverListado = $_SESSION["lspagina_imagenes"];
		include(dirname(__FILE__)."/inc_mensaje.php");
		exit();
	}	
}

/* Nuevo Elemento */

function crearImagenes($obj) {
	global $dict,$visit,$_FILES;
	$arr = array();
	$menosId="";
	reset($dict);
	$patron = "campo_";
	while (list($k,$v)=each($dict)) {
		if (substr($k,0,strlen($patron))==$patron) {
			if (strpos($k,"_")==strrpos($k,"_")) {
				
				$i = substr($k,strlen($patron) );
				$imagen = new ClsImagenespaginas();
				$imagen = $visit->dbBuilder->getImagenespaginasId($dict['campo_'.$i.'_id']);
				$imagen->idpaginaimagenes = $dict["campo_" . $i . "_idpaginaimagenes"];
				$imagen->imagen = $dict["campo_" . $i . "_imagen"];
				$imagen->orden = $dict["campo_" . $i . "_orden"];
				$imagen->titulo = $dict["campo_" . $i . "_titulo"];
				$imagen->enlace = $dict["campo_" . $i . "_enlace"];
			
				//if ($imagen->imagen!="") {
					$imagen2 = $visit->dbBuilder->persist( $imagen );
					$menosId = $menosId . "," . $imagen2->id;
				//}
			}
		}
	}
	if ($menosId!="") $menosId = substr($menosId,1);

	return;
}

?>