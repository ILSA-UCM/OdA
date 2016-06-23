<? 
include_once(dirname(__FILE__)."/include.php");
include_once("../../resources/pclzip.lib.php");//Librería para descomprimir archivos.
$dict=$visit->util->getRequest();

$op = $dict["op"];
$id = $dict["id"];
//var_dump($op);echo("top file   ");var_dump($id);


$fromlistado =$dict["fromlistado"];
$idov =$dict["idov"];
//ini_set("memory_limit","500M");
//var_dump($dict);
//$visit->debuger->enable(true);
///if($_POST==null) echo "Error Post Vars";
if ($op=="login") {
	$login = $dict["login"];	
	$password = $dict["pass"];

	// Pasamos el login y el nombre del usuario. Si es correcto devolvemos la lista de roles del sistema separados por ;. Si no, error.
	$user = $visit->dbBuilder->getUsuariosLogin( $login );
	if ($user=="") $encontrado=false;
	$url="index.php";
	if ( ($user->password == $dict["pass"]) && ($user->login==$dict["login"] ) ) {
		$encontrado = true;
		//  alfredo  140715  $session->idusuario = $user->id;
		$_SESSION["idusuario"] = $user->id;
		$url="index.php";
	} else {
		$encontrado=false;
		// alfredo  140715  $session->idusuario = "";
		$_SESSION["idusuario"] = "";
		$url="login.php";
	}
	$visit->util->redirect($url);
}
else if ($op=="logout") {
	//  alfredo 140715   $user = $visit->dbBuilder->getUsuariosId( $session->idusuario );
	$user = $visit->dbBuilder->getUsuariosId( $_SESSION["idusuario"] );
	//  alfredo  140715  $session->idusuario = "";
	$_SESSION["idusuario"] = "";
	session_destroy();
	$visit->util->redirect("login.php");
}

// COMANAGER 1.0: TABLA usuarios
else if ($op=="modificar_usuarios") {
	if ($id!="") {
		$obj = $visit->dbBuilder->getUsuariosId($id);
	} else {
		$obj = new ClsUsuarios();
	}
	$objPrevio = $obj;
	$obj->estableceCampos( $dict);
	if ($id=="") $obj->id="";
	
	
	$obj = $visit->dbBuilder->persist($obj);

	$volverRecurso = "cm_form_usuarios.php?id=".$obj->id;
	// alfredo 140707 	$volverListado = $session->lsusuarios;
	$volverlistado = $_SESSION['lsusuarios'];
	include(dirname(__FILE__)."/inc_mensaje.php");
	exit();
} else if ($op=="eliminar_usuarios") {
	if ($id!="") {
		$obj = new ClsUsuarios();
		$obj->id = $id;
	
		$visit->dbBuilder->remove($obj);
		// alfredo 140707 	$volverListado = $session->lsusuarios;
		$volverlistado = $_SESSION['lsusuarios'];
		include(dirname(__FILE__)."/inc_mensaje.php");
		exit();
	}	
} 
else if ($op=="mover_usuarios") {
	$obj = new ClsUsuarios();
	$obj->_orderby="orden";
	$cols = $visit->dbBuilder->getTablaFiltrada($obj);
	$obj = $visit->dbBuilder->getUsuariosId($id);
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
	$visit->util->redirect("cm_ls_usuarios.php");
}  // COMANAGER 1.0: FIN TABLA usuarios
else if ($op=="entrar_prehome") {
	// alfredo 140716  $session->idpaisentrega=$idpaisentrega;
	$_SESSION["idpaisentrega"]=$idpaisentrega;
	if ($idpaisentrega =="1") {
		$url ="index.php?lang=es";
	}else{
		$url ="index.php?lang=en";
	}
	$visit->util->redirect($url );
}



// COMANAGER 1.0: TABLA section_data
else if ($op=="modificar_section_data") {
	if ($id!="") {
		$obj = $visit->dbBuilder->getSectionDataId($id);
		//echo("obj 1 id= "); var_dump($obj->id);
		$objRaizAnterior=$obj;
		while ($objRaizAnterior->idpadre!=0) { 	
		$objRaizAnterior = $visit->dbBuilder->getSectionDataId($objRaizAnterior->idpadre);
		//echo("obj Raiz Anterior id= "); var_dump($objRaizAnterior->id);
		}
	} else {
		$obj = new ClsSectionData();
	}

	if (!$visit->options->tieneAcceso("form",$obj)) $visit->options->sinAcceso();
	if ($dict["listado"]=="S"){
		$obj->visible= $dict["visible"];
		$obj = $visit->dbBuilder->persist($obj);
		$visit->util->redirect("cm_ls_section_data.php");
	} else {
		//$var_export($dict);
		/*foreach($dict as $key =>$value){
			echo $key."->".$value."<br>";			
		}*/
		///exit;
		$objPrevio = $obj;
		//echo("objPrevio-idpadr= ");var_dump($objPrevio->idpadre);echo("objPrevio-orden= ");var_dump($objPrevio->orden);
		//echo("objPrevio-TODO= ");var_dump($dict);
		//$pruebA=$visit->dbBuilder->getIdMetadatos(); echo(""); var_dump($pruebA);
		//alfredo prueba 140222
		
		$objPrevioIdPadre = $objPrevio->idpadre;
		$obj->estableceCampos( $dict);
		$obj->visible= $dict["visible"];
		$obj->vocabulario= $dict["vocabulario"];
		$obj->decimales= $dict["decimales"];
		$obj->browseable= $dict["browseable"];
		// alfredo 140813     *************************************************    if("N"==$dict["tipo_valores"]) $obj->browseable="N";
		$obj->extensible=$dict["extensible"];
		//echo("objPrevio-idpadr= ");var_dump($objPrevioIdPadre);
		if ($id==""){
			$obj->id="";
			$obj->orden = $visit->dbBuilder->getMaxOrdenSectionData($obj->idpadre) + 1;
		} else {
			//$obj->orden= $dict["orden"];
			//echo("dict[orden]=");var_dump($dict["orden"]);echo("dict[idpadre]=");var_dump($dict["idpadre"]);
			//$obj->orden = $visit->dbBuilder->getMaxOrdenSectionData($obj->idpadre) + 1;
			if($dict["idpadre"]==$objPrevioIdPadre){
			$obj->orden= $dict["orden"];//echo("padre invar= ");var_dump($obj->id);
			} else{ $objRaizNew=$obj;
					while ($objRaizNew->idpadre!=0){ 	
							$objRaizNew = $visit->dbBuilder->getSectionDataId($objRaizNew->idpadre);
							//echo("obj Raiz New id= "); var_dump($objRaizNew->id);
						}
					//echo("obj Raiz New FINAL id= "); var_dump($objRaizNew->id);
					//echo("obj Raiz Anterior FINAL id= "); var_dump($objRaizAnterior->id);
					if( (($objRaizNew->id==3)&&      (($objRaizAnterior->id==1)||($objRaizAnterior->id==2)))   ||
						(($objRaizAnterior->id==3)&& (($objRaizNew->id==1     )||($objRaizNew->id==2     )))        ) {
						//echo("CUIDADO- MAIN  Padre NO CAMBIA !!!!");?>
						<script>
						alert("No se pueden cambiar atributos de Datos/Metadatos a Recursos, ni viceversa.\n El padre del atributo no va a cambiar.");
						</script> 
						<?$obj->idpadre=$objPrevioIdPadre;
						} else{
								$obj->orden = $visit->dbBuilder->getMaxOrdenSectionData($obj->idpadre) + 1;
								//echo("padre varia obj id= ");var_dump($obj->id);
								}
				}
			
		}
		$obj = $visit->dbBuilder->persist($obj);

	 if ($dict["popup"]=="S") {?>
		<script>	
		 	window.opener.document.location.reload();
			window.close();
		</script>
	<? } else {
		$volverRecurso = "cm_form_section_data.php?id=".$obj->id;
		$volverListado = "cm_ls_section_data.php";
		include(dirname(__FILE__)."/inc_mensaje.php");
	 }
	}
	exit();
} else if ($op=="eliminar_section_data") {
	if ($id!="") {
		$obj = new ClsSectionData();
		$obj->id = $id;
		if (!$visit->options->tieneAcceso("remove",$obj)) $visit->options->sinAcceso();
		
		$filas=$visit->dbBuilder->getTodosContrFromIdSeccion($id);
		while (list ($clave, $contr) = each ($filas)) { 	
			$visit->dbBuilder->remove($contr);
		}
		
		$filas=$visit->dbBuilder->getTodosTextFromIdSeccion($id);
		while (list ($clave, $text) = each ($filas)) { 	
			$visit->dbBuilder->remove($text);
		}
		
		$filas=$visit->dbBuilder->getTodosNumFromIdSeccion($id);
		while (list ($clave, $num) = each ($filas)) { 	
			$visit->dbBuilder->remove($num);
		}
		
		$filas=$visit->dbBuilder->getTodosDateFromIdSeccion($id);
		while (list ($clave, $num) = each ($filas)) { 	
			$visit->dbBuilder->remove($num);
		}
		///Los hijos del nodo pasan a tener como padre al abuelo
		$act = $visit->dbBuilder->getSectionDataFromId($id);
		$visit->dbBuilder->actualizarPadreSectionData($id,$act->idpadre);
		
		$visit->dbBuilder->remove($obj);
	 
		
		if ($_SESSION["popup_section_data"]) {?>
		<script>	
		 	window.opener.document.location.reload();
			window.close();
		</script>
	<? } else {
		$volverRecurso = "cm_form_section_data.php?id=".$obj->id;
		$volverListado = "cm_ls_section_data.php";
		include(dirname(__FILE__)."/inc_mensaje.php");
	 }
	 
		
		
		//$volverListado = "cm_ls_section_data.php";
		//include(dirname(__FILE__)."/inc_mensaje.php");
		exit();
	}
} 
else if ($op=="mover_section_data") {
	$valor = $dict["valor"];
	$obj = new ClsSectionData();
	$obj = $visit->dbBuilder->getSectionDataId($id);
	$superior = $visit->dbBuilder->getSuperiorFromSectionData($obj->orden,$obj->idpadre);
	$inferior = $visit->dbBuilder->getInferiorFromSectionData($obj->orden,$obj->idpadre);
	//var_dump($superior);exit();
	if ($valor=="1") {		
		if($superior!=NULL){
			$orden = $obj->orden;
			$obj->orden = $superior->orden;
			$superior->orden = $orden;
			//var_dump($superior);exit();
			$visit->dbBuilder->persist($obj);
			$visit->dbBuilder->persist($superior);
		}
	} else {
		if($inferior!=NULL){
			$orden = $obj->orden;
			$obj->orden = $inferior->orden;
			$inferior->orden = $orden;
			$visit->dbBuilder->persist($obj);
			$visit->dbBuilder->persist($inferior);
		}
	}
	$visit->util->redirect("cm_ls_section_data.php");
}  
// COMANAGER 1.0: TABLA virtual_object
else if ($op=="modificar_virtual_object") {
	$log= new ClsLogModificaciones();
	$fecha=date("YmdHis");
	$log->fechaModificacion = $fecha;
	//modificar idusuario del logModificaciones
	if ($id!="") {
		$obj = $visit->dbBuilder->getVirtualObjectId($id);
		$log->tipo="M";
	} else {
		$obj = new ClsVirtualObject();
		$log->tipo="C";
	}	
	if (!$visit->options->tieneAcceso("form",$obj)) $visit->options->sinAcceso();
	$objPrevio = $obj;		
	$obj->estableceCampos($dict);
	if($dict["ispublic"]!="")
		$obj->ispublic = "S";
	else $obj->ispublic = "N";
	if($dict["isprivate"]!="")
		$obj->isprivate = "S";
	else $obj->isprivate = "N";
	if ($id=="") $obj->id="";
	$obj = $visit->dbBuilder->persist($obj);
	//Permisos admin
	$listaPermisos = $visit->dbBuilder->getListaPermisosFromUsuario($visit->options->usuario->id);
	$b1 = $visit->options->usuario->esRolAdmin();
	$b2 = $visit->util->perteneceCadena($id,$listaPermisos);
	$b3 = $listaPermisos=="";
	///echo "Es admin=".$b1."<br/>";
	///echo "Pertenece ".$id." a ".$listaPermisos." =".$b2."<br/>";
	///echo "Lista permisos vacía=".$b3."<br/>";
	///exit;
	if ($b1&&(!$b2||$b3||$id=="")){
		$permisoOV	= new ClsPermisos();
		$permisoOV->idusuario =  $visit->options->usuario->id;
		$permisoOV->idov = $obj->id;
		$permisoOV->tipoPermiso = "E";
		$permisoOV = $visit->dbBuilder->persist($permisoOV);
	}
	$sectionData = new ClsSectionData();
	$filas = $visit->dbBuilder->getTablaFiltrada($sectionData);
	$valores = &$filas;
	$dictFilas = $visit->util->getDict( $valores );
	$sDictFilas = array();
	while (list ($clave, $valor) = each ($dictFilas)) { 
		$nombre ="";
		$caminoItems = $visit->util->obtenerCaminoCategoria($dictFilas, "", $valor->id);
		for ($i=0;$i<count($caminoItems);$i++) $nombre .= " >> ". $visit->util->numDigitos($dictFilas[$caminoItems[$i]]->orden,5) . "_" . $dictFilas[$caminoItems[$i]]->nombre;
		$sDictFilas[$nombre] = $valor;
	}
	ksort( $sDictFilas );
	$filas = &$sDictFilas;
	/** GUARDO LAS SECCIONES DE DATOS Y METADATOS DEL O.V.**/
	$rec=$visit->dbBuilder->getIdRecurso();
	$idRecurso=$rec->id;
	while (list ($clave, $sectionData) = each ($filas)) { 		
		$i++;
		$caminoItemsStr = $visit->util->obtenerCaminoCategoriaStr($dictFilas, "", $sectionData->id);
			if ($sectionData->tipo_valores!="" && $sectionData->tipo_valores!="X"  ) {
				if (!$visit->util->isInStr($caminoItemsStr,$idRecurso) ) { 
					if (/*$dict["seccion_".$sectionData->id]!=""*/ true){
						if ($sectionData->tipo_valores=="C"){
							$obj2= $visit->dbBuilder->obtenerAtributoContrFromSeccionOV($sectionData->id,$id);
							if ($obj2 == null){
								if ($dict["seccion_".$sectionData->id]!=""){
									if( $dict["seccion_".$sectionData->id]!= "&SINVALOR&"){								
										$obj2=new ClsControlledData();
										if ($dict["seccion_".$sectionData->id]=="O"){
											$obj2->value=$dict["text_".$sectionData->id];
										} else {
											$obj2->value=$dict["seccion_".$sectionData->id];
										}
										$obj2->idseccion=$sectionData->id;
										$obj2->idov=$obj->id;
										$obj2 = $visit->dbBuilder->persist($obj2);
									}
								}
							} else if ($obj2->value!=$dict["seccion_".$sectionData->id]) {
								$visit->dbBuilder->remove($obj2);
								$obj3=new ClsControlledData();
								if ($dict["seccion_".$sectionData->id]=="O"){
									$obj3->value=$dict["text_".$sectionData->id];
								}else if($dict["seccion_".$sectionData->id]== "&SINVALOR&"){
										$obj3->value =null;
								} else {
									$obj3->value=$dict["seccion_".$sectionData->id];
								}
								$obj3->idseccion = $sectionData->id;	
								$obj3->idov=$obj->id;
								$obj3 = $visit->dbBuilder->persist($obj3);
							} else if ($obj2->value=="O" &&							
								$dict["text_".$sectionData->id]!="") { 
								$visit->dbBuilder->remove($obj2);
								$obj3=new ClsControlledData();
								$obj3->idseccion=$sectionData->id;
								$obj3->idov=$obj->id;
								$obj3->value=$dict["text_".$sectionData->id];
								$obj3 = $visit->dbBuilder->persist($obj3);
							}
						} else if ($sectionData->tipo_valores=="N"){							
							$valuenum = $dict["seccion_".$sectionData->id];
							$valuenum = str_replace(",", ".", $valuenum);
							if (strpos($dict["seccion_".$sectionData->id],"/")!=0){
								$valuenum = $visit->util->date2bbdd($dict["seccion_".$sectionData->id]);
							} 
							$obj2= $visit->dbBuilder->obtenerAtributoNumFromSeccionOV($sectionData->id,$id);
							if ($obj2 == null ){
								if ($dict["seccion_".$sectionData->id]!=""){
									$obj2=new ClsNumericData();
									$obj2->idseccion=$sectionData->id;
									$obj2->idov=$obj->id;
									$obj2->value=$valuenum;
									$obj2 = $visit->dbBuilder->persist($obj2);
								}
								
							} else if ($obj2->value!=$valuenum) { 
								$visit->dbBuilder->remove($obj2);
								$obj3=new ClsNumericData();
								$obj3->idseccion=$sectionData->id;
								$obj3->idov=$obj->id;
								$obj3->value=$valuenum;
								$obj3 = $visit->dbBuilder->persist($obj3);
								
							} else {
									if ($obj2 == null ){
										$obj2=new ClsNumericData();
										$obj2->idseccion=$sectionData->id;
										$obj2->idov=$obj->id;
										$obj2->value=$valuenum;
									} else if ($obj2->value != $obj->name){
										$obj2->value=$valuenum;
									}
									$obj2 = $visit->dbBuilder->persist($obj2);
									
							}
						} else if ($sectionData->tipo_valores=="T"){
							//echo "Seccion Data tipo texto ". $sectionData->id." : ".$dict["seccion_".$sectionData->id]."<br>";
							$obj2= $visit->dbBuilder->obtenerAtributoTextFromSeccionOV($sectionData->id,$id);							
							//echo "comparacion  del dict :". $obj2->value."   ".$dict["seccion_".$sectionData->id]."<br>";
							if ($obj2 == null ){
								if ($dict["seccion_".$sectionData->id]!=""){
									$obj2=new ClsTextData();
									$obj2->idseccion=$sectionData->id;
									$obj2->idov=$obj->id;
									$obj2->value=mysql_real_escape_string($dict["seccion_".$sectionData->id]);
									$obj2 = $visit->dbBuilder->persist($obj2);
								}
							} else if ($obj2->value!=$dict["seccion_".$sectionData->id]) { 								
								$visit->dbBuilder->remove($obj2);
								$obj3=new ClsTextData();
								$obj3->idseccion=$sectionData->id;
								$obj3->idov=$obj->id;
								$obj3->value= mysql_real_escape_string($dict["seccion_".$sectionData->id]);
								$obj3 = $visit->dbBuilder->persist($obj3);
							}												
						}
					else if ($sectionData->tipo_valores=="F"){
							//echo "Seccion Data tipo texto". $sectionData->id." : ".$dict["seccion_".$sectionData->id]."<br>";
							$obj2= $visit->dbBuilder->obtenerAtributoDateFromSeccionOV($sectionData->id,$id);
							//echo "comparacion  del dict :". $obj2->value."   ".$dict["seccion_".$sectionData->id]."<br>";
							//echo "fecha ".$visit->util->date2bbdd( $dict["seccion_".$sectionData->id])."<br>";
							if ($obj2 == null ){
								if ($dict["seccion_".$sectionData->id]!=""){
									$obj2=new ClsDateData();
									$obj2->idseccion=$sectionData->id;
									$obj2->idov=$obj->id;
									$obj2->value=$visit->util->date2bbdd( $dict["seccion_".$sectionData->id]);
									$obj2 = $visit->dbBuilder->persist($obj2);
								}
							} else if ($obj2->value!=$dict["seccion_".$sectionData->id]) { 								
								$visit->dbBuilder->remove($obj2);
								$obj3=new ClsDateData();
								$obj3->idseccion=$sectionData->id;
								$obj3->idov=$obj->id;
								$obj3->value=$visit->util->date2bbdd( $dict["seccion_".$sectionData->id]);
								$obj3 = $visit->dbBuilder->persist($obj3);
							}												
						}
					}
				} else {
					$seccionesRecursos = $seccionesRecursos.",".$sectionData->id;	
				}
			}//if
		} // while secciones
		$seccionesRecursos=  explode(",",$seccionesRecursos);
		 
		 //** Tratamiento de recursos existentes **//
		 
		 $recursos = $visit->dbBuilder->getRecursosFromOV($id);	
		 while (list ($clave, $recurso) = each ($recursos)) { 
				if($recurso->id=="") break;
		 		reset($seccionesRecursos);
				$arraysecciones= array();
				while (list ($clave, $idsec) = each ($seccionesRecursos)) { 
					$k++;
					$sec = $visit->dbBuilder->getSectionDataId($idsec);
					$arraysecciones[$sec->id]=$sec;
						if (/*$dict["seccion_".$sec->id."_recurso_".$recurso->id]!=""*/ true){
							if ($sec->tipo_valores=="C"){
								$obj2=new ClsControlledData();
								$obj2= $visit->dbBuilder->obtenerAtributoFromSeccionRecursoOV($obj2,$sec->id,$id,$recurso->id);
								//echo VAR_DUMP($obj2);
								if ($obj2 == null ){
									if($dict["seccion_".$sec->id."_recurso_".$recurso->id]!=""){
										if($dict["seccion_".$sec->id."_recurso_".$recurso->id]!= "&SINVALOR&"){
											$obj2=new ClsControlledData();
											if ($dict["seccion_".$sec->id."_recurso_".$recurso->id]=="O"){
												$obj2->value=$dict["text_".$sec->id."_recurso_".$recurso->id];
											} else {
												$obj2->value=$dict["seccion_".$sec->id."_recurso_".$recurso->id];
											}
											$obj2->idseccion=$sec->id;
											$obj2->idov=$obj->id;
											$obj2->idrecurso=$recurso->id;
											$obj2 = $visit->dbBuilder->persist($obj2);
										}
									}									
								} else if ($obj2->value!=$dict["seccion_".$sec->id."_recurso_".$recurso->id]) {
									$obj2->idov="";
									$visit->dbBuilder->persist($obj2);
									$obj3=new ClsControlledData();
									if ($dict["seccion_".$sec->id."_recurso_".$recurso->id]=="O"){
											$obj3->value=$dict["text_".$sec->id."_recurso_".$recurso->id];
									}else if($dict["seccion_".$sec->id."_recurso_".$recurso->id]== "&SINVALOR&"){
										$obj3->value = null;
									} else {
											$obj3->value=$dict["seccion_".$sec->id."_recurso_".$recurso->id];
									}
									$obj3->idseccion=$sec->id;
									$obj3->idov=$obj->id;
									$obj3->idrecurso=$recurso->id;
									$obj3 = $visit->dbBuilder->persist($obj3);

								} else if ($obj2->value=="O" && $dict["text_".$sec->id."_recurso_".$recurso->id]!="") {  ////Por si se hab�a metido una "O" y se quiere cambiar
									$obj2->idov="";
									$visit->dbBuilder->persist($obj2);
									$obj3=new ClsControlledData();
									$obj3->idseccion=$sec->id;
									$obj3->idov=$obj->id;
									$obj3->idrecurso=$recurso->id;
									$obj3->value=$dict["text_".$sec->id."_recurso_".$recurso->id];
									$obj3 = $visit->dbBuilder->persist($obj3);
								}
							} else if ($sec->tipo_valores=="N"){
									$obj2=new ClsNumericData();
									$obj2= $visit->dbBuilder->obtenerAtributoFromSeccionRecursoOV($obj2,$sec->id,$id,$recurso->id);
								if ($obj2 == null){
									if($dict["seccion_".$sec->id."_recurso_".$recurso->id]!=""){
										$obj2=new ClsNumericData();
										$obj2->idseccion=$sec->id;
										$obj2->idov=$obj->id;
										$obj2->idrecurso=$recurso->id;
										$obj2->value=$dict["seccion_".$sec->id."_recurso_".$recurso->id];
										$obj2 = $visit->dbBuilder->persist($obj2);
									}
								} else if ($obj2->value!=$dict["seccion_".$sec->id."_recurso_".$recurso->id]){
									$obj2->value=$dict["seccion_".$sec->id."_recurso_".$recurso->id];
									$obj2 = $visit->dbBuilder->persist($obj2);
								}
							} else if ($sec->tipo_valores=="T"){
								$obj2=new ClsTextData();
								$obj2= $visit->dbBuilder->obtenerAtributoFromSeccionRecursoOV($obj2,$sec->id,$id,$recurso->id);
								if ($obj2 == null ){
									if($dict["seccion_".$sec->id."_recurso_".$recurso->id]!=""){
										$obj2=new ClsTextData();
										$obj2->idseccion=$sec->id;
										$obj2->idov=$obj->id;
										$obj2->idrecurso=$recurso->id;
										$obj2->value=mysql_real_escape_string($dict["seccion_".$sec->id."_recurso_".$recurso->id]);
										$obj2 = $visit->dbBuilder->persist($obj2);
									}
								} else if ($obj2->value != $dict["seccion_".$sec->id."_recurso_".$recurso->id]) {
									$obj2->value=mysql_real_escape_string($dict["seccion_".$sec->id."_recurso_".$recurso->id]);
									$obj2 = $visit->dbBuilder->persist($obj2);
								}
							}else if($sec->tipo_valores =="F"){
								//echo "valor a guardar: ".$dict["seccion_".$sec->id."_recurso_".$recurso->id]."<br>";
								$obj2 = new ClsDateData();
								$obj2= $visit->dbBuilder->obtenerAtributoFromSeccionRecursoOV($obj2,$sec->id,$id,$recurso->id);
								if ($obj2 == null ){
									if($dict["seccion_".$sec->id."_recurso_".$recurso->id]!=""){
										$obj2=new ClsDateData();
										$obj2->idseccion=$sec->id;
										$obj2->idov=$obj->id;
										$obj2->idrecurso=$recurso->id;
										$obj2->value=$visit->util->date2bbdd($dict["seccion_".$sec->id."_recurso_".$recurso->id]);
										$obj2 = $visit->dbBuilder->persist($obj2);
									}
								} else if ($obj2->value != $dict["seccion_".$sec->id."_recurso_".$recurso->id]) {
									$obj2->value=$visit->util->date2bbdd($dict["seccion_".$sec->id."_recurso_".$recurso->id]);
									$obj2 = $visit->dbBuilder->persist($obj2);		
								}								
							}//else if
						
						} //if	
					} //while secciones	
					if("S"==($dict["visible_".$recurso->id."_hidden"])){
						$recurso->visible = "S";
					} else {
						$recurso->visible = "N";
					}
					$recurso->ordinal = $dict["ordinal_".$recurso->id];
					$recurso = $visit->dbBuilder->persist($recurso);
			}//while recursos
	
	/** Tratamiento de Nuevos Recursos **/
	if($id=="") $id = $obj->id;
	$tipo=$dict["tipo"];
	//echo "tipo".$tipo."<br>";
	if ($tipo!="") {
		$resource= new ClsResources();
			if ($tipo=="P"){				
				if($visit->util->existeArchivoBR($id,$_FILES["nombre_archivo"]["name"]) ){
					//Almacenamos el archivo en un directorio temporal
					$tmp = getcwd()."/../download/tmp/tmp-".$id;
					$visit->util->mkdir($tmp);
					$visit->util->descargaArchivo($_FILES["nombre_archivo"],$tmp);			
					
					$nombreArchivo =$_FILES["nombre_archivo"]["name"];
					
					
					
					// alfredo 140930  $url = "error.php?error=1&id=".$id."&name=".$nombreArchivo;
					if ("S"==$dict["from_view"]){
						$url = "error.php?error=1&id=".$id."&name=".$nombreArchivo."&from_view=S";
					} else if($dict["desde"]=="mantenimiento") {
						$url = "error.php?error=1&id=".$id."&name=".$nombreArchivo."&desde=mantenimiento";
					}else{
						$url = "error.php?error=1&id=".$id."&name=".$nombreArchivo;
					}
					
					
					$visit->util->redirect($url);
				} else{
				/** Recursos Propios **/ 
				$resource->idov=$id;
				///$resource->visible = $dict["visible"];
				///$resource->visible = "S";
				$resource->type=$tipo;
				if ($_FILES["nombre_archivo"]["size"]>0) {
					$path=  getcwd()."/../download";
					$visit->util->mkdir($path."/".$id);
					$visit->util->descargaArchivo($_FILES["nombre_archivo"],$path."/".$id);
					$resource->name=$_FILES["nombre_archivo"]["name"];
					$resource->name=$resource->asignarNombreRecurso();
					rename($path."/".$id."/".$_FILES["nombre_archivo"]["name"],$path."/".$id."/".$resource->name);
				} else {
					$resource->name=$ubicacion_documento;
				}
				
				$resource = $visit->dbBuilder->persist($resource);
				 reset($seccionesRecursos);
			//	 var_dump($arraysecciones);
				while (list ($clave, $idsec2) = each ($seccionesRecursos)) { 
							$k++;
							$sec2 = $arraysecciones[$idsec2];
				/** Guardo cada atributo (seccion) del nuevo recurso **/
							 if ($dict["seccion_".$sec2->id."_nuevo"]!=""){
										if ($sec2->tipo_valores=="C"){
											//echo VAR_DUMP($obj2);
												$obj2=new ClsControlledData();
												if($dict["seccion_".$sec2->id."_nuevo"]== "&SINVALOR&"){
													
												} else if ($dict["seccion_".$sec2->id."_nuevo"]=="O"){
														$obj2->value=$dict["text_".$sec2->id."_nuevo"];
												} else {
														$obj2->value=$dict["seccion_".$sec2->id."_nuevo"];
												}
												$obj2->idseccion=$sec2->id;
												$obj2->idov=$obj->id;
												$obj2->idrecurso=$resource->id;
												$obj2 = $visit->dbBuilder->persist($obj2);
										} else if ($sec2->tipo_valores=="N"){
												$obj2=new ClsNumericData();
												$obj2->idseccion=$sec2->id;
												$obj2->idov=$obj->id;
												$obj2->idrecurso=$resource->id;
												$obj2->value=$dict["seccion_".$sec2->id."_nuevo"];
												$obj2 = $visit->dbBuilder->persist($obj2);
										} else if ($sec2->tipo_valores=="T"){
												$obj2=new ClsTextData();
												$obj2->idseccion=$sec2->id;
												$obj2->idov=$obj->id;
												$obj2->idrecurso=$resource->id;
												$obj2->value=$dict["seccion_".$sec2->id."_nuevo"];
												$obj2 = $visit->dbBuilder->persist($obj2);
										} else if ($sec2->tipo_valores=="F"){
												$obj2=new ClsDateData();
												$obj2->idseccion=$sec2->id;
												$obj2->idov=$obj->id;
												$obj2->idrecurso=$resource->id;
												$obj2->value=$visit->util->date2bbdd($dict["seccion_".$sec2->id."_nuevo"]);
												$obj2 = $visit->dbBuilder->persist($obj2);
									}//else if
								} //if	
					}//while
				}
		//RECURSO URL


		} else if ($tipo=="U") {
				$resource->idov=$id;
				
				//var_dump($dict["idov_refered"]);
				///$resource->visible=$dict["visible"];
				$resource->type=$tipo;
				if ( $dict["nombre_url"]!=""){
					$resource->name=$dict["nombre_url"];
				} 
				///var_dump($resource);
				$resource = $visit->dbBuilder->persist($resource);
					/** Guardo cada atributo (seccion) del nuevo recurso **/
				$secRec=$visit->dbBuilder->getSeccionesFromIdPadre($idRecurso);
				
				while (list ($clave, $sec) = each ($secRec)) { 
								 if ($dict["seccion_".$sec->id."_nuevo"]!=""){
										if ($sec->tipo_valores=="C"){
												/*if($dict["seccion_".$sec->id."_nuevo"] == "~Sin asignar"){}
												else{
												*/		$obj2=new ClsControlledData();
														if ($dict["seccion_".$sec->id."_nuevo"]=="O"){
																$obj2->value=$dict["text_".$sec->id."_nuevo"];
														} else {
																$obj2->value=$dict["seccion_".$sec->id."_nuevo"];
														}
														$obj2->idseccion=$sec->id;
														$obj2->idov=$obj->id;
														$obj2->idrecurso=$resource->id;
														$obj2 = $visit->dbBuilder->persist($obj2);
												//}
										} else if ($sec->tipo_valores=="N"){
												$obj2=new ClsNumericData();
												$obj2->idseccion=$sec->id;
												$obj2->idov=$obj->id;
												$obj2->idrecurso=$resource->id;
												$obj2->value=$dict["seccion_".$sec->id."_nuevo"];
												$obj2 = $visit->dbBuilder->persist($obj2);
										} else if ($sec->tipo_valores=="T"){
												$obj2=new ClsTextData();
												$obj2->idseccion=$sec->id;
												$obj2->idov=$obj->id;
												$obj2->idrecurso=$resource->id;
												$obj2->value=mysql_real_escape_string($dict["seccion_".$sec->id."_nuevo"]);
												$obj2 = $visit->dbBuilder->persist($obj2);
										} else if ($sec->tipo_valores=="F"){
												$obj2=new ClsDateData();
												$obj2->idseccion=$sec->id;
												$obj2->idov=$obj->id;
												$obj2->idrecurso=$resource->id;
												$obj2->value=$visit->util->date2bbdd($dict["seccion_".$sec->id."_nuevo"]);
												$obj2 = $visit->dbBuilder->persist($obj2);
										}//else if
								} //if	
					}//while







			} else if ($tipo=="OV") {
				$resource->idov=$id;
				
				//var_dump($dict["idov_refered"]);
				///$resource->visible=$dict["visible"];
				$resource->type=$tipo;
				if ( $dict["idov_refered"]!=""){
					$resource->idov_refered=$dict["idov_refered"];
					$ov=$visit->dbBuilder->getVirtualObjectId($dict["idov_refered"]);
					if ($ov!="") $resource->name=$ov->name;
				} 
				///var_dump($resource);
				$resource = $visit->dbBuilder->persist($resource);
					/** Guardo cada atributo (seccion) del nuevo recurso **/
				$secRec=$visit->dbBuilder->getSeccionesFromIdPadre($idRecurso);
				
				while (list ($clave, $sec) = each ($secRec)) { 
								 if ($dict["seccion_".$sec->id."_nuevo"]!=""){
										if ($sec->tipo_valores=="C"){
												/*if($dict["seccion_".$sec->id."_nuevo"] == "~Sin asignar"){}
												else{
												*/		$obj2=new ClsControlledData();
														if ($dict["seccion_".$sec->id."_nuevo"]=="O"){
																$obj2->value=$dict["text_".$sec->id."_nuevo"];
														} else {
																$obj2->value=$dict["seccion_".$sec->id."_nuevo"];
														}
														$obj2->idseccion=$sec->id;
														$obj2->idov=$obj->id;
														$obj2->idrecurso=$resource->id;
														$obj2 = $visit->dbBuilder->persist($obj2);
												//}
										} else if ($sec->tipo_valores=="N"){
												$obj2=new ClsNumericData();
												$obj2->idseccion=$sec->id;
												$obj2->idov=$obj->id;
												$obj2->idrecurso=$resource->id;
												$obj2->value=$dict["seccion_".$sec->id."_nuevo"];
												$obj2 = $visit->dbBuilder->persist($obj2);
										} else if ($sec->tipo_valores=="T"){
												$obj2=new ClsTextData();
												$obj2->idseccion=$sec->id;
												$obj2->idov=$obj->id;
												$obj2->idrecurso=$resource->id;
												$obj2->value=mysql_real_escape_string($dict["seccion_".$sec->id."_nuevo"]);
												$obj2 = $visit->dbBuilder->persist($obj2);
										} else if ($sec->tipo_valores=="F"){
												$obj2=new ClsDateData();
												$obj2->idseccion=$sec->id;
												$obj2->idov=$obj->id;
												$obj2->idrecurso=$resource->id;
												$obj2->value=$visit->util->date2bbdd($dict["seccion_".$sec->id."_nuevo"]);
												$obj2 = $visit->dbBuilder->persist($obj2);
										}//else if
								} //if	
					}//while
	
			
			} else if ($tipo=="F") {
				
				/*** DUDAS // alfredo 140727   $resource->idresource_refered=$dict["idresource_refered"];
				$resource->idresource_refered=$dict["id_recurso_ref"]; // alfredo 140728  ???????????????????????????
				$resource->idov_refered=$dict["idresource_refered"]; //alfredo 140727 *****/
				
				$resource->idresource_refered=$dict["idresource_refered"]; //nuevo alfredo 140728
				$resource->idov_refered=$dict["idov_refered"]; // nuevo alfredo 140728
				
				$resource->idov=$id;
				$resource->type=$tipo;
				$resource->name=$dict["nombre_recurso_existente"];
				$resource = $visit->dbBuilder->persist($resource);
				$nuevaSeccionCont = new ClsControlledData();
				$seccionesRec= $visit->dbBuilder->getTodosFromIdRecurso($nuevaSeccionCont,$dict["id_recurso_ref"]);
				
				while (list ($clave, $seccionRec) = each ($seccionesRec)) { 
					//echo var_dump($seccionRec)."<br>";
					if ($seccionRec->value!="") {
						$nuevaSeccionCont = new ClsControlledData();
						$nuevaSeccionCont->idseccion=$seccionRec->idseccion;
						$nuevaSeccionCont->idov=$obj->id;
						$nuevaSeccionCont->idrecurso=$resource->id;
						if ($visit->util->normalizeString($seccionRec->value)=="propietario") {
							$nuevaSeccionCont->value="OV".$obj->id;
						} else $nuevaSeccionCont->value=$seccionRec->value;
						$nuevaSeccionCont = $visit->dbBuilder->persist($nuevaSeccionCont);
					}
				}
				$nuevaSeccionText = new ClsTextData();
				$seccionesRecText= $visit->dbBuilder->getTodosFromIdRecurso($nuevaSeccionText,$dict["id_recurso_ref"]);
				while (list ($clave, $seccionRecText) = each ($seccionesRecText)) {
					if ($seccionRecText->value!="") {
						$nuevaSeccionText = new ClsTextData();
						$nuevaSeccionText->idseccion=$seccionRecText->idseccion;
						$nuevaSeccionText->idov=$obj->id;
						$nuevaSeccionText->idrecurso=$resource->id;
						$nuevaSeccionText->value=$seccionRecText->value;
						$nuevaSeccionText = $visit->dbBuilder->persist($nuevaSeccionText);
					}
				}
				$nuevaSeccionNum = new ClsNumericData();
				$seccionesRecNum= $visit->dbBuilder->getTodosFromIdRecurso($nuevaSeccionNum,$dict["id_recurso_ref"]);
				while (list ($clave, $seccionRecNum) = each ($seccionesRecNum)) { 
					if ($seccionRecNum->value!="") {
						$nuevaSeccionNum = new ClsTextData();
						$nuevaSeccionNum->idseccion=$seccionRecNum->idseccion;
						$nuevaSeccionNum->idov=$obj->id;
						$nuevaSeccionNum->idrecurso=$resource->id;
						$nuevaSeccionNum->value=$seccionRecNum->value;
						$nuevaSeccionNum = $visit->dbBuilder->persist($nuevaSeccionNum);
					}
				}
	
			} else if ($tipo=="Z") {
					if ($_FILES["nombre_zip"]["size"]>0) {
						if($visit->util->existeArchivoBR($id,$_FILES["nombre_zip"]["name"]) ){
							//Almacenamos el archivo en un directorio temporal
							$tmp = getcwd()."/../download/tmp/tmp-".$id;
							$visit->util->mkdirNoIndex($tmp);  ///alfredo 140926
							$visit->util->descargaArchivo($_FILES["nombre_zip"],$tmp);					
							
							$nombreArchivo =$_FILES["nombre_zip"]["name"];					
							// $url = "error.php?error=1&id=".$id."&name=".$nombreArchivo."&tipo=H";
							// $url = "error.php?error=1&id=".$id."&name=".$nombreArchivo."&tipo=Z"; // alfredo 140930 
							
							// alfredo 140930 
							if ("S"==$dict["from_view"]){
								$url = "error.php?error=1&id=".$id."&name=".$nombreArchivo."&tipo=Z&from_view=S";
							} else if($dict["desde"]=="mantenimiento") {
								$url = "error.php?error=1&id=".$id."&name=".$nombreArchivo."&tipo=Z&desde=mantenimiento";
							}else{
								$url = "error.php?error=1&id=".$id."&name=".$nombreArchivo."&tipo=Z";
							}
							
							
							$visit->util->redirect($url);
						} else{
							$tmp = getcwd()."/../download/tmp-".time();
							///$tmp = getcwd()."/../download/tmp";
							$visit->util->mkdirNoIndex($tmp);  ///alfredo 140926
							$visit->util->descargaArchivo($_FILES["nombre_zip"],$tmp);
							$downloadHttpPrefix = "/download";
							$nombreDirectorio =$_FILES["nombre_zip"]["name"];		
							$path=  getcwd()."/../download";
							$visit->util->mkdirNoIndex($path."/".$id."/".$nombreDirectorio);  ///alfredo 140926
							//$comando= "unzip ".$tmp."/".$_FILES["nombre_zip"]["name"]." -d ".$tmp;
							$archivo=new PclZip($tmp."/".$_FILES["nombre_zip"]["name"]);
							if($archivo->extract(PCLZIP_OPT_PATH,$tmp) ==0 )
							{
								die("Error : ".$archivo->errorInfo(true));	
							}
							//exec($comando);
							//echo $comando."<br>";
							unlink($tmp."/".$_FILES["nombre_zip"]["name"]);
							$visit->dbBuilder->cargarRecursosZip($tmp,$path,$id,$nombreDirectorio);
							// alfredo 140928 copiar archivo index.php aqui? , situarlo en una carpeta index_php en iconos
							$visit->util->copiarArchivo("../download/iconos/index_php/index.php", "../download/".$id."/".$nombreDirectorio."/index.php");
							$visit->util->SureRemoveDir($tmp,true);
					}
				} // if 		 			
			} else if ($tipo=="H") {
				if ($_FILES["nombre_zipHtml"]["size"]>0) {
					if($visit->util->existeArchivoBR($id,$_FILES["nombre_zipHtml"]["name"]) ){
						//Almacenamos el archivo en un directorio temporal
						$tmp = getcwd()."/../download/tmp/tmp-".$id;
						$visit->util->mkdir($tmp);
						$visit->util->descargaArchivo($_FILES["nombre_zipHtml"],$tmp);					
						
						$nombreArchivo =$_FILES["nombre_zipHtml"]["name"];					
						// alfredo 140930 $url = "error.php?error=1&id=".$id."&name=".$nombreArchivo."&tipo=H";
						// alfredo 140930 
							if ("S"==$dict["from_view"]){
								$url = "error.php?error=1&id=".$id."&name=".$nombreArchivo."&tipo=H&from_view=S";
							} else if($dict["desde"]=="mantenimiento") {
								$url = "error.php?error=1&id=".$id."&name=".$nombreArchivo."&tipo=H&desde=mantenimiento";
							}else{
								$url = "error.php?error=1&id=".$id."&name=".$nombreArchivo."&tipo=H";
							}
						
						
						$visit->util->redirect($url);
					} else{			
							$tmp = getcwd()."/../download/tmp-".time();
							///$tmp = getcwd()."/../download/tmp";
							$visit->util->mkdir($tmp);
							$visit->util->descargaArchivo($_FILES["nombre_zipHtml"],$tmp);
							$downloadHttpPrefix = "/download";	
							$nombreDirectorio =$_FILES["nombre_zipHtml"]["name"];		
							$path=  getcwd()."/../download";
							$visit->util->mkdirNoIndex($path."/".$id."/".$nombreDirectorio); ///alfredo 140930
							//$comando= "unzip ".$tmp."/".$_FILES["nombre_zip"]["name"]." -d ".$tmp;
							$archivo=new PclZip($tmp."/".$_FILES["nombre_zipHtml"]["name"]);
							if($archivo->extract(PCLZIP_OPT_PATH,$tmp) ==0 )
							{
								die("Error : ".$archivo->errorInfo(true));	
							}
							unlink($tmp."/".$_FILES["nombre_zipHtml"]["name"]);
							$visit->dbBuilder->cargarRecursosZipHtml($tmp,$path,$id,$nombreDirectorio,0);
							// alfredo 140930 copiar archivo index.php aqui? , situarlo en una carpeta index_php en iconos
							$visit->util->copiarArchivo("../download/iconos/index_php/index.php", "../download/".$id."/".$nombreDirectorio."/index.php");
							$visit->util->SureRemoveDir($tmp,true);
						}//else
				} // if 
			}
	} // if tipo != ""
	//var_dump($log);
	//  alfredo  140715  $log->idusuario=$session->idusuario;
	$log->idusuario=$_SESSION["idusuario"];
	$log->idov=$obj->id;
	
	$visit->dbBuilder->persist($log);
	ClsSectionData::limpiaTablasData();
	if ("S"==$dict["from_view"]){
		// $visit->util->redirect("../../view/cm_view_virtual_object.php?idov=".$obj->id."&menu=229&lang=es"); alfredo 140731
		$volverRecurso = "../../view/cm_form_vo.php?id=".$obj->id."&desde=from_view";
		// alfredo 140910 $volverListado ="/".APP_NAME."/view/cm_view_virtual_object.php?idov=".$obj->id."&menu=229&lang=es";
		$volverListado ="/".APP_NAME."/view/cm_view_virtual_object.php?idov=".$obj->id."&seleccion=1";
		include(dirname(__FILE__)."/inc_mensaje.php");
		
	} else if($dict["desde"]=="mantenimiento") {
		$volverRecurso = "cm_form_virtual_object.php?id=".$obj->id."&desde=mantenimiento";
		//$volverListado ="/".APP_NAME."/bo/mantenimiento/".$session->lsrecursos; comentado alfredo 130404 a�ade linea siguiente
		//$volverListado ="/".APP_NAME."/bo/mantenimiento/cm_ls_recursos.php";
		// alfredo 140707   $volverListado ="/".APP_NAME."/bo/mantenimiento/".$session->lsrecursos;
		$volverListado ="/".APP_NAME."/bo/mantenimiento/".$_SESSION['lsrecursos_mantenimiento'];
		include(dirname(__FILE__)."/inc_mensaje.php");
		
	}else{
		$volverRecurso = "cm_form_virtual_object.php?id=".$obj->id;
		//$volverListado = $session->lsvirtual_object; comentado alfredo 130404 a�ade linea siguiente
		//$volverListado = "cm_ls_virtual_object.php";
		
		// alfredo 140707  $volver=$session->lsvirtual_object;
		$volverListado=$_SESSION['lsvirtual_object'];
		include(dirname(__FILE__)."/inc_mensaje.php");
	}
	exit();
	
	
} else if ($op=="eliminar_virtual_object") {
//var_dump($op);
	$log= new ClsLogModificaciones();
	$fecha=date("YmdHis");
	$log->fechaModificacion = $fecha;
	$log->tipo="B";
	//echo(">>"); var_dump($id);
	if ($id!="") {
		$obj = new ClsVirtualObject();
		$obj->id = $id;
	
		//if (!$visit->options->tieneAcceso("remove",$obj)) $visit->options->sinAcceso();
		//Borra su icono
		$obj->borraIcono();

		$filas=$visit->dbBuilder->getTodosContrFromIdOV($id);
		while (list ($clave, $contr) = each ($filas)) { 	
			$visit->dbBuilder->remove($contr);
		}
		$filas=$visit->dbBuilder->getTodosTextFromIdOV($id);
		while (list ($clave, $text) = each ($filas)) { 	
			$visit->dbBuilder->remove($text);
		}
		$filas=$visit->dbBuilder->getTodosTextFromIdOV($id);
		while (list ($clave, $text) = each ($filas)) { 	
			$visit->dbBuilder->remove($text);
		}
		$filas=$visit->dbBuilder->getTodosNumFromIdOV($id);
		while (list ($clave, $num) = each ($filas)) { 	
			$visit->dbBuilder->remove($num);
		}
		$filas=$visit->dbBuilder->getRecursosPropiosFromOV($id);
		while (list ($clave, $recursop) = each ($filas)) { 	
			$visit->dbBuilder->remove($recursop);
		}
		$filas=$visit->dbBuilder->getRecursosForeignFromOV($id);
		while (list ($clave, $recursof) = each ($filas)) { 	
			$visit->dbBuilder->remove($recursof);
		}
		$filas=$visit->dbBuilder->getRecursosOVFromOV($id);
		while (list ($clave, $recursoov) = each ($filas)) { 	
			$visit->dbBuilder->remove($recursoov);
		}
		$filas=$visit->dbBuilder->getRecursosForeignFromOVRefered($id);
		while (list ($clave, $recursoov) = each ($filas)) { 	
			$visit->dbBuilder->remove($recursoov);
		}

		$filas=$visit->dbBuilder->getTodosDateFromIdOV($id);
		while (list ($clave, $num) = each ($filas)) { 	
			$visit->dbBuilder->remove($num);
		}
		$permisoOV	= new ClsPermisos();
		$permisoOV = $visit->dbBuilder->getPermisosFromOV($id);
		$idspermisoOV = $visit->dbBuilder->getPermisosFromOV($id);
		while (list ($clave, $num) = each ($idspermisoOV)) { 	
			$num = $visit->dbBuilder->remove($num);
		}
		
		$resourcesOV	= new ClsResources();
		$resourcesOV = $visit->dbBuilder->getResourcesFromOV($id);
		
		while (list ($clave, $num) = each ($resourcesOV)) { 	
			$num = $visit->dbBuilder->remove($num);
		}

		$log->idov=$obj->id;
		//  alfredo  140715   $log->idusuario=$session->idusuario;
		$log->idusuario=$_SESSION["idusuario"];
		$visit->dbBuilder->remove($obj);
		$visit->dbBuilder->persist($log);

		///Eliminamos todos los archivos
		$dir = "../download/".$id."/";
		$visit->util->eliminaCarpeta($dir);
		if(is_dir($dir))
			rmdir($dir);

		//$volverListado = "cm_ls_virtual_object.php";
		// $volverListado = $session->lsvirtual_object; comentada alfredo 1303 27 y descomentada linea anterior
		// alfredo 140707  $volver=$session->lsvirtual_object;
		
		if ($from_mantenimiento=="S") { //alfredo 140807
		$volverListado = "../mantenimiento/".$_SESSION["lsrecursos_mantenimiento"];
		include(dirname(__FILE__)."/inc_mensaje.php");
		exit();
		}
		
		$volverListado=$_SESSION['lsvirtual_object'];
		include(dirname(__FILE__)."/inc_mensaje.php");
		exit();
	}
} 
else if($op=="duplicar_virtual_object"){
	$idovOriginal = $dict["idov"];
	$log= new ClsLogModificaciones();
	$fecha=date("YmdHis");
	$log->fechaModificacion = $fecha;
	$log->tipo="D";
	// alfredo  140715  $log->idusuario=$session->idusuario;
	$log->idusuario=$_SESSION["idusuario"];
	$log->idov=$idovOriginal;
	$visit->dbBuilder->persist($log);
	$log->id="";
	if($idovOriginal != ""){
		//CREACION DEL OBJETO
		$objOriginal = $visit->dbBuilder->getVirtualObjectId($idovOriginal);
		$obj = new ClsVirtualObject();
		$obj->ispublic = $objOriginal->ispublic;
		$obj->isprivate = $objOriginal->isprivate;
		$obj = $visit->dbBuilder->persist($obj);
		$idCopia = $obj->id;

		$permisos = new ClsPermisos();
		$permisos->idusuario = $_SESSION["userid"];
		$permisos->idov = $obj->id;
		$permisos->tipoPermiso="E";
		$permisos = $visit->dbBuilder->persist($permisos);

		$fecha=date("YmdHis");
		$log->tipo="C";
		$log->idov=$idCopia;
		$visit->dbBuilder->persist($log);
		
		//COPIA RECURSOS
		$recursosOrig = $visit->dbBuilder->getRecursosFromOV($idovOriginal);
		if($recursosOrig != ""){
			$path=  getcwd()."/../download";
			$visit->util->mkdir($path."/".$idCopia);
		}
		foreach ($recursosOrig as $key =>$value){
			//echo var_dump($value)."<br>";
			$idRecurso = $value->id;
			$value->id = "";
			$value->idov = $idCopia;
			if($value->type == "P" || $value->type == "H" || $value->type == "Z" ){
				//Copiar el archivo a la carpeta
				$path=  getcwd()."/../download";
				$pathFuente=  $path."/".$idovOriginal."/".$value->name;
				$pathDestino = $path."/".$idCopia."/".$value->name;
				$visit->util->copiarArchivo($pathFuente,$pathDestino);
			}
			$value->iconoov ="N";			
			$objRecurso = $visit->dbBuilder->persist($value);
			//copia section_data de cada recurso
			//Controled data
			$controlledDataOrig = new ClsControlledData();		
			$controlledDataOrig = $visit->dbBuilder->getTodasSectionFromIdovEIdRecurso($controlledDataOrig,$idovOriginal,$idRecurso);
			foreach ($controlledDataOrig as $k =>$v){
					//echo var_dump($value)."<br>";
					$v->id = "";
					$v->idov = $idCopia;
					$v->idrecurso = $objRecurso->id;
					$visit->dbBuilder->persist($v);
			}
			//Numeric data	
			$numericDataOrig = new ClsNumericData();	
			$numericDataOrig = $visit->dbBuilder->getTodasSectionFromIdovEIdRecurso($numericDataOrig,$idovOriginal,$idRecurso);
			foreach ($numericDataOrig as $k =>$v){
					//echo var_dump($value)."<br>";
						$v->id = "";
						$v->idov = $idCopia;
						$v->idrecurso = $objRecurso->id;
						$visit->dbBuilder->persist($v);
			}	
			//text data
			$textDataOrig = new ClsTextData();		
			$textDataOrig = $visit->dbBuilder->getTodasSectionFromIdovEIdRecurso($textDataOrig,$idovOriginal,$idRecurso);
			foreach ($textDataOrig as $k =>$v){
					//echo var_dump($value)."<br>";
					$v->id = "";
					$v->idov = $idCopia;
					$v->idrecurso = $objRecurso->id;
					$visit->dbBuilder->persist($v);
			}
			//date data
			$dateDataOrig = new ClsDateData();		
			$dateDataOrig = $visit->dbBuilder->getTodasSectionFromIdovEIdRecurso($dateDataOrig,$idovOriginal,$idRecurso);
			foreach ($dateDataOrig as $k =>$v){
					//echo var_dump($value)."<br>";
					$v->id = "";
					$v->idov = $idCopia;
					$v->idrecurso = $objRecurso->id;
					$visit->dbBuilder->persist($v);
			}
			
		}

		

		//COPIA SECTION DATAS
		$controlledDataOrig = $visit->dbBuilder->getTodosContrFromIdOV($idovOriginal); 
		foreach ($controlledDataOrig as $key =>$value){
			if($value->value != NULL || $value->value !=""){
				if($value->idrecurso ==""){
				//echo var_dump($value)."<br>";
					$value->id = "";
					$value->idov = $idCopia;
					$visit->dbBuilder->persist($value);
				}
			}
		}
		$numericDataOrig = $visit->dbBuilder->getTodosNumFromIdOV($idovOriginal); 
		foreach ($numericDataOrig as $key =>$value){
			if($value->value != NULL || $value->value !=""){
				//echo var_dump($value)."<br>";
				if($value->idrecurso ==""){
					$value->id = "";
					$value->idov = $idCopia;
					$visit->dbBuilder->persist($value);
				}
			}
		}
		$dateDataOrig = $visit->dbBuilder->getTodosDateFromIdOV($idovOriginal); 
		foreach ($dateDataOrig as $key =>$value){
			if($value->value != NULL || $value->value !=""){
				//echo var_dump($value)."<br>";
				if($value->idrecurso ==""){
					$value->id = "";
					$value->idov = $idCopia;
				 	$visit->dbBuilder->persist($value);	
				}		
			}
		}
		$textDataOrig = $visit->dbBuilder->getTodosTextFromIdOV($idovOriginal); 
		foreach ($textDataOrig as $key =>$value){
			if($value->value != NULL || $value->value !=""){
				//echo var_dump($value)."<br>";
				if($value->idrecurso ==""){
					$value->id = "";
					$value->idov = $idCopia;
					 $visit->dbBuilder->persist($value);
				}
			}
		}
		$volverRecurso = "cm_form_virtual_object.php?id=".$idCopia;
		// $volverListado = $session->lsvirtual_object; comentada alfredo 13 03 27 a�ade linea siguiente
	    //$volverListado = "cm_ls_virtual_object.php";
	     // alfredo 140707  $volver=$session->lsvirtual_object;
		// alfredo 140718  posible descuido $volver=$_SESSION['lsvirtual_object'];
		$volverListado=$_SESSION['lsvirtual_object'];
		include(dirname(__FILE__)."/inc_mensaje.php");
		exit();
	}
	
	$visit->util->redirect("cm_ls_virtual_object.php");
}

else if ($op=="mover_virtual_object") {
	$obj = new ClsVirtualObject();
	$obj->_orderby="orden";
	$cols = $visit->dbBuilder->getTablaFiltrada($obj);
	$obj = $visit->dbBuilder->getVirtualObjectId($id);
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
	$visit->util->redirect("cm_ls_virtual_object.php");
} 
else if($op=="sobreescribir_recurso"){	
	$idov = $dict["idov"];
	$name = $dict["name"];
	$accion = $dict["accion"];
	$tipo = $dict["tipo"];
	//$recurso = $visit->dbBuilder->getRecursosFromOVNombre($idov,$name);
	$tempDirectorio = "../download/tmp/tmp-".$idov;

	if($accion =="S") {
		$extension = $visit->util->getExtension($name);
		if($extension == "zip"){		
			//Elimino el antiguo directorio
				$directorioRecurso = "../download/".$idov."/".$name;
				$visit->util->SureRemoveDir($directorioRecurso,true);
				$visit->util->mkdir($directorioRecurso);	
				$obj = $visit->dbBuilder->getResourcesIdov($idov);
				//eliminar los recursos de ese directorio
				foreach($obj as $k=>$item){				
					if(strpos($item->name,$name)=== false){}
					else{
						$visit->dbBuilder->remove($item);
					}
				}
				//Descomprimo y cargo los nuevos recursos
				$archivo=new PclZip($tempDirectorio."/".$name);
				if($archivo->extract(PCLZIP_OPT_PATH,$tempDirectorio) ==0 )			{
					die("Error : ".$archivo->errorInfo(true));	
				}
				unlink($tempDirectorio."/".$name);
				$pathBase ="../download";
				if($tipo == "Z"){
					$visit->dbBuilder->cargarRecursosZip($tempDirectorio,$pathBase,$idov,$name);
				}else if($tipo =="H"){
					$visit->dbBuilder->cargarRecursosZipHTML($tempDirectorio,$pathBase,$idov,$name);
				}
		}else {
			$tmpA = "../download/tmp/tmp-".$idov."/".$name;
			$pathA = "../download/".$idov."/".$name;
			$visit->util->copiarArchivo($tmpA,$pathA);
		}
		
	}
	unlink($tmpA);
	$visit->util->SureRemoveDir($tempDirectorio,true);
	
	// alfredo 140930  $visit->util->redirect("cm_form_virtual_object.php?id=".$idov);
	if ("S"==$dict["from_view"]){
		$visit->util->redirect("../../view/cm_form_vo.php?id=".$idov."&desde=from_view");
	} else if($dict["desde"]=="mantenimiento") {
		$visit->util->redirect("cm_form_virtual_object.php?id=".$idov."&desde=mantenimiento");
	}else{
		$visit->util->redirect("cm_form_virtual_object.php?id=".$idov);
	}
	
	
}

// COMANAGER 1.0: FIN TABLA virtual_object



else if ($op=="asignar_recurso_existente"){
		if ($idov!="" && $idrecurso!="") {
		$objC =new ClsControlledData();
		$objsC = $visit->dbBuilder->getTodosFromIdRecurso($objC,$idrecurso);
		while (list ($clave, $contr) = each ($objsC)) { 	
			$contr->idov=$idov;
			$contr = $visit->dbBuilder->persist($contr);
		}
		$objT =new ClsTextData();
		$objsT = $visit->dbBuilder->getTodosFromIdRecurso($objT,$idrecurso);
		while (list ($clave, $text) = each ($objsT)) { 	
			$text->idov=$idov;
			$text = $visit->dbBuilder->persist($text);
		}
		$objN =new ClsNumericData();
		$objsN = $visit->dbBuilder->getTodosFromIdRecurso($objN,$idrecurso);
		while (list ($clave, $num) = each ($objsN)) { 	
			$num->idov=$idov;
			$num = $visit->dbBuilder->persist($num);
		}
		
		}
}

// COMANAGER 1.0: TABLA controlled_data
else if ($op=="modificar_controlled_data") {
	if ($id!="") {
		$obj = $visit->dbBuilder->getControlledDataId($id);
	} else {
		$obj = new ClsControlledData();
	}
	if (!$visit->options->tieneAcceso("form",$obj)) $visit->options->sinAcceso();
	$objPrevio = $obj;
	$obj->estableceCampos( $dict);
	if ($id=="") $obj->id="";
	
	
	$obj = $visit->dbBuilder->persist($obj);

	$volverRecurso = "cm_form_controlled_data.php?id=".$obj->id;
	$volverListado = $_SESSION["lscontrolled_data"];
	// alfrdo 140715 $volverListado = $session->lscontrolled_data;
	include(dirname(__FILE__)."/inc_mensaje.php");
	exit();
} else if ($op=="eliminar_controlled_data") {
	if ($id!="") {
		$obj = new ClsControlledData();
		$obj->id = $id;
		if (!$visit->options->tieneAcceso("remove",$obj)) $visit->options->sinAcceso();
		$visit->dbBuilder->remove($obj);
		// alfredo  140715  $volverListado = $session->lscontrolled_data;
		$volverListado = $_SESSION["lscontrolled_data"];
		include(dirname(__FILE__)."/inc_mensaje.php");
		exit();
	}	
} 
else if ($op=="mover_controlled_data") {
	$obj = new ClsControlledData();
	$obj->_orderby="orden";
	$cols = $visit->dbBuilder->getTablaFiltrada($obj);
	$obj = $visit->dbBuilder->getControlledDataId($id);
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
	$visit->util->redirect("cm_ls_controlled_data.php");
}  // COMANAGER 1.0: FIN TABLA controlled_data
// COMANAGER 1.0: TABLA numeric_data
else if ($op=="modificar_numeric_data") {
	if ($id!="") {
		$obj = $visit->dbBuilder->getNumericDataId($id);
	} else {
		$obj = new ClsNumericData();
	}
	if (!$visit->options->tieneAcceso("form",$obj)) $visit->options->sinAcceso();
	$objPrevio = $obj;
	$obj->estableceCampos( $dict);
	if ($id=="") $obj->id="";
	
	
	$obj = $visit->dbBuilder->persist($obj);

	$volverRecurso = "cm_form_numeric_data.php?id=".$obj->id;
	
	// alfredo 140716  $volverListado = $session->lsnumeric_data;
	$volverListado = $_SESSION["lsnumeric_data"];
	include(dirname(__FILE__)."/inc_mensaje.php");
	exit();
} else if ($op=="eliminar_numeric_data") {
	if ($id!="") {
		$obj = new ClsNumericData();
		$obj->id = $id;
		if (!$visit->options->tieneAcceso("remove",$obj)) $visit->options->sinAcceso();
		$visit->dbBuilder->remove($obj);
		
		// alfredo 140716  $volverListado = $session->lsnumeric_data;
		$volverListado = $_SESSION["lsnumeric_data"];
		include(dirname(__FILE__)."/inc_mensaje.php");
		exit();
	}	
}  // COMANAGER 1.0: FIN TABLA numeric_data


// COMANAGER 1.0: TABLA date_data
else if ($op=="modificar_date_data") {
	if ($id!="") {
		$obj = $visit->dbBuilder->getNumericDataId($id);
	} else {
		$obj = new ClsNumericData();
	}
	if (!$visit->options->tieneAcceso("form",$obj)) $visit->options->sinAcceso();
	$objPrevio = $obj;
	$obj->estableceCampos( $dict);
	if ($id=="") $obj->id="";
	
	
	$obj = $visit->dbBuilder->persist($obj);

	$volverRecurso = "cm_form_numeric_data.php?id=".$obj->id;
	
	// alfredo 140716  $volverListado = $session->lsnumeric_data;
	$volverListado = $_SESSION["lsnumeric_data"];
	include(dirname(__FILE__)."/inc_mensaje.php");
	exit();
} else if ($op=="eliminar_numeric_data") {
	if ($id!="") {
		$obj = new ClsNumericData();
		$obj->id = $id;
		if (!$visit->options->tieneAcceso("remove",$obj)) $visit->options->sinAcceso();
		$visit->dbBuilder->remove($obj);
		
		// alfredo 140716  $volverListado = $session->lsnumeric_data;
		$volverListado = $_SESSION["lsnumeric_data"];
		include(dirname(__FILE__)."/inc_mensaje.php");
		exit();
	}	
}  // COMANAGER 1.0: FIN TABLA numeric_data

// COMANAGER 1.0: TABLA text_data
else if ($op=="modificar_text_data") {
	if ($id!="") {
		$obj = $visit->dbBuilder->getTextDataId($id);
	} else {
		$obj = new ClsTextData();
	}
	if (!$visit->options->tieneAcceso("form",$obj)) $visit->options->sinAcceso();
	$objPrevio = $obj;
	$obj->estableceCampos( $dict);
	if ($id=="") $obj->id="";
	
	
	$obj = $visit->dbBuilder->persist($obj);

	$volverRecurso = "cm_form_text_data.php?id=".$obj->id;
	
	//  alfredo 140716  $volverListado = $session->lstext_data;
	$volverListado = $_SESSION["lstext_data"];
	include(dirname(__FILE__)."/inc_mensaje.php");
	exit();
} else if ($op=="eliminar_text_data") {
	if ($id!="") {
		$obj = new ClsTextData();
		$obj->id = $id;
		if (!$visit->options->tieneAcceso("remove",$obj)) $visit->options->sinAcceso();
		$visit->dbBuilder->remove($obj);
		
		//  alfredo 140716  $volverListado = $session->lstext_data;
		$volverListado = $_SESSION["lstext_data"];
		include(dirname(__FILE__)."/inc_mensaje.php");
		exit();
	}
} else if ($op=="modificar_select") {
	$obj = new ClsControlledData();
	if (!$visit->options->tieneAcceso("form",$obj)) $visit->options->sinAcceso();
	$objPrevio = $obj;
	//$obj->estableceCampos( $dict);
	$obj->idseccion=$idseccion;
	//echo "****".$idseccion;
	$obj->value=$dict["text_".$idseccion];
	$obj = $visit->dbBuilder->persist($obj);
	//if ($id=="") $obj->id="";

	$obj2= new ClsVirtualObject();
	$obj2->estableceCampos( $dict);
	// alfredo 140716  $session->popup_virtual_object="";
	//                 $session->popup_virtual_object=$obj2;		
	$_SESSION["popup_virtual_object"]="";
	$_SESSION["popup_virtual_object"]=$obj2;
	
	$volverRecurso = "cm_form_controlled_data.php?id=".$obj->id;
	// alfredo 140715  $volverListado = $session->lscontrolled_data;
	$volverListado = $_SESSION["lscontrolled_data"];
	$visit->util->redirect("cm_ls_virtual_objects.php");
//	include(dirname(__FILE__)."/inc_mensaje.php");
	exit();
}
  // COMANAGER 1.0: FIN TABLA text_data
// COMANAGER 1.0: TABLA resources
else if ($op=="modificar_resources") {
	if ($id!="") {
		$obj = $visit->dbBuilder->getResourcesId($id);
	} else {
		$obj = new ClsResources();
	}
	if (!$visit->options->tieneAcceso("form",$obj)) $visit->options->sinAcceso();
	$objPrevio = $obj;
	$obj->estableceCampos( $dict);
	if ($id=="") $obj->id="";
	$obj = $visit->dbBuilder->persist($obj);

	$volverRecurso = "cm_form_resources.php?id=".$obj->id;
	// alfredo 140716  $volverListado = $session->lsresources;
	$volverListado = $_SESSION["lsresources"];
	include(dirname(__FILE__)."/inc_mensaje.php");
	exit();
// COMANAGER 1.0: TABLA preferencias_presentacion
} else if ($op=="modificar_icono"){
	$idrec = $dict["idrec"];
	$idov = $dict["idov"];
	if ($idrec!=""&&$idov!="") {
		$visit->dbBuilder->limpiaIconos($idov);
		$sql = $visit->dbBuilder->modificarIcono($idrec,$idov);	
		$visit->dbBuilder->crearImagenIcono($idov,$idrec);
		if ("S"==$dict["from_view"]){
			// alfredo 140728$visit->util->redirect("../../view/cm_view_virtual_object.php?idov=".$obj->id);
			$visit->util->redirect("../../view/cm_form_vo.php?id=".$idov."&idvuelta=".$idov);
		} else {
			$visit->util->redirect("cm_form_virtual_object.php?id=".$idov);
		}
	}			 
} else if ($op=="eliminar_resources") {
	if ($id!="") {
		$path=  getcwd()."/../download"."/".$idov;
		$obj2 = $visit->dbBuilder->getResourcesId($id);

		// elimino el archivo f�sico. Si es HTML borro todo el directorio
		//echo $path."/".$obj2->name;
		if($visit->util->esHTML($obj2->name)){
			$posB = strpos($obj2->name, "/");
			if ($posB === false) {//No hay directorio
				if ( is_file($path."/".$obj2->name) ){ 
					unlink($path."/".$obj2->name);
				}
			}else {
				$directorioRecurso = $path."/".substr($obj2->name, 0,$posB);
				$visit->util->SureRemoveDir($directorioRecurso, true);
			}				
		}
		else if ( is_file($path."/".$obj2->name) ){ 
			unlink($path."/".$obj2->name);
		}
		//Eliminar el icono si existe
		$visit->dbBuilder->borraUnIcono($obj2->id);
		
		$dir = $path."/".$obj2->name;
		///echo $dir;
		///$start = strriposX($dir, ".");
		///$dir = substr_replace($dir, "", $start, strlen($dir));
		///$dir = $dir."_files/";

		//if ( is_dir($dir) ){ 
		//$visit->util->eliminaCarpeta($dir);
		//rmdir($dir);
		//}
		

		$obj2->id = $id;
		if (!$visit->options->tieneAcceso("remove",$obj2)) $visit->options->sinAcceso();

		// elimino el elemento de la tabla recursos

		$visit->dbBuilder->remove($obj2);
		
		// elimino las secciones del recurso de las tablas controlled_data, text_data y numeric_data

		$obj=new ClsControlledData();
		$filas=$visit->dbBuilder->getTodosFromIdRecurso($obj,$id);
		while (list ($clave, $contr) = each ($filas)) { 	
			$visit->dbBuilder->remove($contr);
		}
		$obj=new ClsTextData();
		$filas=$visit->dbBuilder->getTodosFromIdRecurso($obj,$id);
		while (list ($clave, $text) = each ($filas)) { 	
			$visit->dbBuilder->remove($text);
		}
		$obj=new ClsNumericData();
		$filas=$visit->dbBuilder->getTodosFromIdRecurso($obj,$id);
		while (list ($clave, $num) = each ($filas)) { 	
			$visit->dbBuilder->remove($num);
		}
		$obj=new ClsDateData();
		$filas=$visit->dbBuilder->getTodosFromIdRecurso($obj,$id);
		while (list ($clave, $num) = each ($filas)) { 	
			$visit->dbBuilder->remove($num);
		}
				
		// alfredo 140716 $volverListado ="cm_ls_virtual_object.php";// $session->lsresources;
		
		if ("S"==$dict["from_view"]){// $visit->util->redirect("../../view/cm_form_vo.php?id=".$idov."&idvuelta=".$idov); alfredo 140730
		$volverListado="../../view/cm_form_vo.php?id=".$idov."&idvuelta=".$idov;
		include(dirname(__FILE__)."/inc_mensaje.php");
		exit();}// alfredo 140728 
		if ($fromlistado=="S") { //$visit->util->redirect("cm_form_virtual_object.php?id=".$idov); alfredo 140730
		$volverListado="cm_form_virtual_object.php?id=".$idov;
		include(dirname(__FILE__)."/inc_mensaje.php");
		exit();}
		if ($from_mantenimiento=="S") { //$visit->util->redirect("/".APP_NAME."/bo/mantenimiento/cm_ls_recursos.php?id=".$idov); alfredo 140730
		$volverListado = "../mantenimiento/".$_SESSION["lsrecursos_mantenimiento"];
		//var_dump($volverListado);
		include(dirname(__FILE__)."/inc_mensaje.php");
		exit();
		}
		$volverListado = $_SESSION["lsresources"];
		include(dirname(__FILE__)."/inc_mensaje.php");
		exit();
		
	}
	// alfredo 140716  $volverListado ="cm_ls_virtual_object.php";// $session->lsresources;
	$volverListado = $_SESSION["lsresources"];
	include(dirname(__FILE__)."/inc_mensaje.php");
}