<? 
include_once(dirname(__FILE__)."/include.php");
$dict=$visit->util->getRequest();
$op = $dict["op"];
if ($op=="login") {
	$correo = $dict["login"];	
	$password = $dict["password"];
	// Pasamos el login y el nombre del usuario. Si es correcto devolvemos la lista de roles del sistema separados por ;. Si no, error.
	$user = $visit->dbBuilder->getUsuariosLogin( $correo );
	if ($user=="") $encontrado=false;
	session_start();

	// Añadida Seguridad en Login Porr Joaquin Gayoso-Cabada 02102021
	if ( password_verify($dict["password"], $user->password) && ($user->login==$dict["login"] ) ) {
	// Fin Añadida Seguridad en Login Porr Joaquin Gayoso-Cabada 02102021	
		
	//if ( ($user->password == $dict["password"]) && ($user->login==$dict["login"] ) ) {
		// alfredo 140715  $session->idusuario = $user->id;
		$_SESSION["idusuario"] = $user->id;
		$_SESSION['name'] = $user->login;
		$_SESSION['authenticated'] = APP_NAME.$user->id;		
		$_SESSION['userid'] = $user->id;
		$_SESSION['UserRolUser'] = $user->rol;
		$url="index.php";		
	} else
	{
		$encontrado=false;
		// alfredo 140715  $session->idusuario = "";
		$_SESSION["idusuario"] = "";
		$url="login.php?error=1";
	}
	if ($user!="")
		$user->actualizaUltimoAcceso();
	$visit->util->redirect($url);
}
else if ($op=="logout") {
	// alfredo 140715  $user = $visit->dbBuilder->getUsuariosId( $session->idusuario );
	$user = $visit->dbBuilder->getUsuariosId( $_SESSION["idusuario"]);
	if ($user->login!="") {
		$user->bloqueado="N";
		$visit->dbBuilder->persist($user);
	}
	//Capturo la informaci�n de sesi�n y la elimino
	// alfredo  140715  $session->idusuario = "";
	$_SESSION["idusuario"] = "";
	// empty the $_SESSION array
	  $_SESSION = array();
	  // invalidate the session cookie
	  if (isset($_COOKIE[session_name()])) {
		setcookie(session_name(), '', time()-86400, '/');
	  }
	// end session and redirect
	session_destroy();
	$visit->util->redirect("index.php");
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
	$obj->login= $dict["correo"];
	if ($id=="") $obj->id="";
	$obj = $visit->dbBuilder->persist($obj);
	//  alfredo  140715   $session->idusuario = $obj->id;
	$_SESSION["idusuario"] = $obj->id;
	$visit->util->redirect("index.php");
/*	$volverRecurso = "index.php?id=".$obj->id;
	$volverListado = $session->lsusuarios;
	include(dirname(__FILE__)."/inc_mensaje.php");*/
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
	// alfredo 140715   $session->idpaisentrega=$idpaisentrega;
	$_SESSION["idpaisentrega"]=$idpaisentrega;
	if ($idpaisentrega =="1") {
		$url ="index.php?lang=es";
	}else{
		$url ="index.php?lang=en";
	}
	$visit->util->redirect($url );
}



else if ($op=="modificar_section_data") {
	if ($id!="") {
		$obj = $visit->dbBuilder->getSectionDataId($id);
	} else {
		$obj = new ClsSectionData();
	}
	if ($dict["listado"]=="S"){
		$obj->visible= $dict["visible"];
		$obj = $visit->dbBuilder->persist($obj);
		$visit->util->redirect("cm_ls_section_data.php");

	} else {
	//	var_dump($dict);
	//	exit;
		$objPrevio = $obj;
		$obj->estableceCampos( $dict);
		$obj->visible= $dict["visible"];
		$obj->browseable=$dict["browseable"];
		$obj->extensible=$dict["extensible"];
		if ($id=="") $obj->id="";
		
		
		$obj = $visit->dbBuilder->persist($obj);

		if ($obj->tipo_valores=="N") {
		$objN = new ClsNumericData();
		$objN->idseccion=$id;
		//$objN->value=$id;
		//$objN->idseccion=$id;
		$objN = $visit->dbBuilder->persist($objN);
		}
		if ($obj->tipo_valores=="T") {
		$objT = new ClsTextData();
		$objT->idseccion=$id;
		//$objT->value=$id;
		//$objT->idseccion=$id;
		$objT = $visit->dbBuilder->persist($objT);
		}
		if ($obj->tipo_valores=="C") {
		$objC = new ClsControlledData();
		$objC->idseccion=$id;
		//$objC->value=$id;
		//$objC->idseccion=$id;
		$objC = $visit->dbBuilder->persist($objC);
		}
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
		$visit->dbBuilder->remove($obj);
		// alfredo 140716  $volverListado = $session->lssection_data;
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
}  // COMANAGER 1.0: FIN TABLA section_data


else if ($op=="eliminar_virtual_object") {
	$log= new ClsLogModificaciones();
	$fecha=date("YmdHis");
	$log->fechaModificacion = $fecha;
	$log->tipo="B";
	if ($id!="") {
		$obj = new ClsVirtualObject();
		$obj->id = $id;
	
		if (!$visit->options->tieneAcceso("remove",$obj)) $visit->options->sinAcceso();
		$filas=$visit->dbBuilder->getTodosContrFromIdOV($id);
		
		while (list ($clave, $contr) = each ($filas)) { 	
			$visit->dbBuilder->remove($contr);
			}
		
		$filas=$visit->dbBuilder->getTodosTextFromIdOV($id);
		while (list ($clave, $text) = each ($filas)) { 	
			$visit->dbBuilder->remove($text);
		}
		$filas=$visit->dbBuilder->getTodosNumFromIdOV($id);
		while (list ($clave, $num) = each ($filas)) { 	
			$visit->dbBuilder->remove($num);
		}

		$visit->dbBuilder->remove($obj);
		$visit->dbBuilder->persist($log);

		$volverListado = "cm_ls_virtual_object.php";
		include(dirname(__FILE__)."/inc_mensaje.php");
		exit();
	}	

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
}  // COMANAGER 1.0: FIN TABLA virtual_object



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
	// alfredo  140715  $volverListado = $session->lscontrolled_data;
	$volverListado = $_SESSION["lscontrolled_data"];
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
	// alfredo 140716   $volverListado = $session->lstext_data;
	$volverListado = $_SESSION["lstext_data"];
	include(dirname(__FILE__)."/inc_mensaje.php");
	exit();
} else if ($op=="eliminar_text_data") {
	if ($id!="") {
		$obj = new ClsTextData();
		$obj->id = $id;
		if (!$visit->options->tieneAcceso("remove",$obj)) $visit->options->sinAcceso();
		$visit->dbBuilder->remove($obj);
		
		// alfredo 140716   $volverListado = $session->lstext_data;
		$volverListado = $_SESSION["lstext_data"];
		include(dirname(__FILE__)."/inc_mensaje.php");
		exit();
	}	
}  // COMANAGER 1.0: FIN TABLA text_data



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
} else if ($op=="eliminar_resources") {
	if ($id!="") {
		$obj = new ClsResources();
		$obj->id = $id;
		if (!$visit->options->tieneAcceso("remove",$obj)) $visit->options->sinAcceso();
		$visit->dbBuilder->remove($obj);
		
		// alfredo 140716  $volverListado = $session->lsresources;
		$volverListado = $_SESSION["lsresources"];
		include(dirname(__FILE__)."/inc_mensaje.php");
		exit();
	}	
}/* else if ($op=="modificar_usuarios") {


	$session->popup_errores=array();
	if ($id!="") {
		$obj = $visit->dbBuilder->getUsuariosId($id);
	} else {
		$obj = new ClsUsuarios();
	}
	//if (!$visit->options->tieneAcceso("form",$obj)) $visit->options->sinAcceso();
	$objPrevio = $obj;
	$obj->estableceCampos( $dict);
	$obj->login= $dict["correo"];
	if ($id=="") $obj->id="";
	$url = "perfil_clientes.php?lang=".$lang;
	$objCorreo = $visit->dbBuilder->getUsuariosCorreo( $correo );
	if ( $objCorreo->correo==$correo && $objCorreo->id != $id) {
		$existeCorreo=true;
		$session->popup_clientes="";
		$session->popup_clientes=$obj;		
		$session->popup_errores["signatura"]="Ya existe un usuario con este correo";
		$url = $desde."?error=1&lang=".$lang;				
			
	}else{
		
		$obj = $visit->dbBuilder->persist($obj);
		$session->idcliente = $obj->id;
		if ($id=="") {
			$obj->codigo = $prefs["prefijo_codigo_cliente"].
							$visit->util->numDigitos($obj->id, $prefs["num_digitos_numero_codigo_cliente"]).
							$prefs["sufijo_codigo_cliente"];
			
			$obj = $visit->dbBuilder->persist($obj);
		}
	
	}
	
	if(!$existeCorreo && $id==""){


		if (conf("notificacion_int_alta")!="") {
			ob_start();
			include(dirname(__FILE__)."/notificacion_nuevo_alta.php");
			$strMensajes="Este gestor de correo no puede visualizar el pedido"; 
			$htmlMensajes = ob_get_contents(); 
			ob_end_clean();

			$subject= conf("notificacion_ext_asunto_alta");
			$to= conf("notificacion_int_alta");
			$from = conf("notificacion_ext_desde_alta");

			envioMail($to,$from,$subject,$strMensajes,$htmlMensajes);

			
		}

		if (conf("notificacion_ext_desde_alta")!="") {
			ob_start();
			include(dirname(__FILE__)."/agradecimiento_nuevo_alta.php");
			$strMensajes="Este gestor de correo no puede visualizar el pedido"; 
			$htmlMensajes = ob_get_contents(); 
			ob_end_clean();

			$subject= conf("notificacion_ext_asunto_alta");
			$to= $correo;
			$from = conf("notificacion_ext_desde_alta");
			envioMail($to,$from,$subject,$strMensajes,$htmlMensajes);

		
			
		}


			
	}

	
$visit->util->redirect($url);
} */else if ($op=="eliminar_usuarios") {
	if ($id!="") {
		$obj = new ClsUsuarios();
		$obj->id = $id;
		$visit->dbBuilder->remove($obj);
		include(dirname(__FILE__)."/inc_mensaje.php");
		exit();
	}	
} 
 // COMANAGER 1.0: FIN TABLA usuarios

 else if ($op=="recordar_contrasena"){
	$correo = $dict["correo"];	
	

	// Pasamos el login y el nombre del usuario. Si es correcto devolvemos la lista de roles del sistema separados por ;. Si no, error.
	$user = $visit->dbBuilder->getClientesCorreo( $correo );
	if ($user=="") $encontrado=false;


	if ( ($user->correo==$dict["correo"]) ) {
		$url="recordar_contrasenia.php?envio=S";
		include("correo_recordar_contrasena.php");
		//include("correoadmin_recordar_contrasena.php");
	} else {
		$encontrado=false;
		$url="recordar_contrasenia.php?error=S";
	}
	$visit->util->redirect($url);

} else if ($op=="modificar_virtual_object") {
	$log= new ClsLogModificaciones();
	$fecha=date("YmdHis");
	$log->fechaModificacion = $fecha;
	//modificar idusuario del logModificaciones
	if ($id!="") {
		$obj = $visit->dbBuilder->getVirtualObjectId($id);
		$log->tipo="M";
	} else {
		$obj = new ClsVirtualObject();
		$nuevo=true;
		$log->tipo="C";
	}
	//if (!$visit->options->tieneAcceso("form",$obj)) $visit->options->sinAcceso();
	$objPrevio = $obj;
	$obj->estableceCampos( $dict);
	if ($id=="") $obj->id="";
	$obj = $visit->dbBuilder->persist($obj);
	if ($nuevo) {
		$permiso= new ClsPermisos();
		// alfredo  140715  $permiso->idusuario= $session->idusuario;
		$permiso->idusuario= $_SESSION["idusuario"];
		$permiso->tipoPermiso="E";
		$permiso->idov=$obj->id;
		$permiso = $visit->dbBuilder->persist($permiso);
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
		//if ($sectionData->codigo=="recursos") $idRecurso= $sectionData->id;	
	
			if ($sectionData->tipo_valores!="" && $sectionData->tipo_valores!="X"  ) {
							//if ($sectionData->idpadre!=$idRecurso){
							if (!$visit->util->isInStr($caminoItemsStr,$idRecurso) ) { 
										if ($dict["seccion_".$sectionData->id]!=""){
											if ($sectionData->tipo_valores=="C"){
												$obj2= $visit->dbBuilder->obtenerAtributoContrFromSeccionOV($sectionData->id,$id);
												//echo VAR_DUMP($obj2);
												if ($obj2 == null){
													$obj2=new ClsControlledData();
													if ($dict["seccion_".$sectionData->id]=="O"){
															$obj2->value=$dict["text_".$sectionData->id];
													} else {
															$obj2->value=$dict["seccion_".$sectionData->id];
													}
												$obj2->idseccion=$sectionData->id;
												$obj2->idov=$obj->id;
												$obj2 = $visit->dbBuilder->persist($obj2);
												} else if ($obj2->value!=$dict["seccion_".$sectionData->id]) {
													$visit->dbBuilder->remove($obj2);
													$obj3=new ClsControlledData();
													if ($dict["seccion_".$sectionData->id]=="O"){
															$obj3->value=$dict["text_".$sectionData->id];
													} else {
															$obj3->value=$dict["seccion_".$sectionData->id];
													}
													$obj3->idseccion=$sectionData->id;
													$obj3->idov=$obj->id;
													$obj3 = $visit->dbBuilder->persist($obj3);

												} else if ($obj2->value=="O" && $dict["text_".$sectionData->id]!="") {  ////Por si se hab�a metido una "O" y se quiere cambiar
													$visit->dbBuilder->remove($obj2);
													$obj3=new ClsControlledData();
													$obj3->idseccion=$sectionData->id;
													$obj3->idov=$obj->id;
													$obj3->value=$dict["text_".$sectionData->id];
													$obj3 = $visit->dbBuilder->persist($obj3);
												}
											} else if ($sectionData->tipo_valores=="N"){
												$val= $visit->dbBuilder->obtenerAtributoNumFromSeccionOV($sectionData->id,$id);
												if ($val->value == null || $val->value!=$dict["seccion_".$sectionData->id]){
													$obj2=new ClsNumericData();
													$obj2->idseccion=$sectionData->id;
													$obj2->idov=$obj->id;
													$obj2->value=$dict["seccion_".$sectionData->id];
													$obj2 = $visit->dbBuilder->persist($obj2);
												}
												
											} else if ($sectionData->tipo_valores=="T"){
												$obj2= $visit->dbBuilder->obtenerAtributoTextFromSeccionOV($sectionData->id,$id);
													if ($sectionData->nombre!="T�tulo"){
														//echo VAR_DUMP($obj2);
														if ($obj2 == null ){
															$obj2=new ClsTextData();
															$obj2->idseccion=$sectionData->id;
															$obj2->idov=$obj->id;
															$obj2->value=$dict["seccion_".$sectionData->id];
															$obj2 = $visit->dbBuilder->persist($obj2);
														} else if ($obj2->value!=$dict["seccion_".$sectionData->id]) { 
															$visit->dbBuilder->remove($obj2);
															$obj3=new ClsTextData();
															$obj3->idseccion=$sectionData->id;
															$obj3->idov=$obj->id;
															$obj3->value=$dict["seccion_".$sectionData->id];
															$obj3 = $visit->dbBuilder->persist($obj3);
														}
													} else {
														if ($obj2 == null ){
															$obj2=new ClsTextData();
															$obj2->idseccion=$sectionData->id;
															$obj2->idov=$obj->id;
															$obj2->value=$obj->name;
														} else if ($obj2->value != $obj->name) {
															$obj2->value=$obj->name;
														}
														$obj2 = $visit->dbBuilder->persist($obj2);
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
				 reset($seccionesRecursos);
				 $arraysecciones= array();
				while (list ($clave, $idsec) = each ($seccionesRecursos)) { 
					$k++;
					$sec = $visit->dbBuilder->getSectionDataId($idsec);
					$arraysecciones[$sec->id]=$sec;
						if ($dict["seccion_".$sec->id."_recurso_".$recurso->id]!=""){
							if ($sec->tipo_valores=="C"){
								$obj2=new ClsControlledData();
								$obj2= $visit->dbBuilder->obtenerAtributoFromSeccionRecursoOV($obj2,$sec->id,$id,$recurso->id);
								//echo VAR_DUMP($obj2);
								if ($obj2 == null){
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
								} else if ($obj2->value!=$dict["seccion_".$sec->id."_recurso_".$recurso->id]) {
									$visit->dbBuilder->remove($obj2);
									$obj3=new ClsControlledData();
									if ($dict["seccion_".$sec->id."_recurso_".$recurso->id]=="O"){
											$obj3->value=$dict["text_".$sec->id."_recurso_".$recurso->id];
									} else {
											$obj3->value=$dict["seccion_".$sec->id."_recurso_".$recurso->id];
									}
									$obj3->idseccion=$sec->id;
									$obj3->idov=$obj->id;
									$obj3->idrecurso=$recurso->id;
									$obj3 = $visit->dbBuilder->persist($obj3);

								} else if ($obj2->value=="O" && $dict["text_".$sec->id."_recurso_".$recurso->id]!="") {  ////Por si se hab�a metido una "O" y se quiere cambiar
									$visit->dbBuilder->remove($obj2);
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
									$obj2=new ClsNumericData();
									$obj2->idseccion=$sec->id;
									$obj2->idov=$obj->id;
									$obj2->idrecurso=$recurso->id;
									$obj2->value=$dict["seccion_".$sec->id."_recurso_".$recurso->id];
									$obj2 = $visit->dbBuilder->persist($obj2);
								} else if ($obj2->value!=$dict["seccion_".$sec->id."_recurso_".$recurso->id]){
									$obj2->value=$dict["seccion_".$sec->id."_recurso_".$recurso->id];
									$obj2 = $visit->dbBuilder->persist($obj2);
								}
							} else if ($sec->tipo_valores=="T"){
								$obj2=new ClsTextData();
								$obj2= $visit->dbBuilder->obtenerAtributoFromSeccionRecursoOV($obj2,$sectionData->id,$id,$recurso->id);
								if ($obj2 == null ){
									$obj2=new ClsTextData();
									$obj2->idseccion=$sec->id;
									$obj2->idov=$obj->id;
									$obj2->idrecurso=$recurso->id;
									$obj2->value=$dict["seccion_".$sec->id."_recurso_".$recurso->id];
									$obj2 = $visit->dbBuilder->persist($obj2);
								} else if ($obj2->value != $dict["seccion_".$sec->id."_recurso_".$recurso->id]) {
									$obj2->value=$dict["seccion_".$sec->id."_recurso_".$recurso->id];
									$obj2 = $visit->dbBuilder->persist($obj2);
								}
									
							}//else if
						} //if	
					} //while secciones	
			}//while recursos
				
	/** Tratamiento de Nuevos Recursos **/

	$tipo=$dict["tipo"];
	
	if ($tipo!="") {
		
		$resource= new ClsResources();
		if ($tipo=="P"){
			
			/** Recursos Propios **/ 
			$resource->idov=$id;
			$resource->visible=$dict["visible"];
			$resource->type=$tipo;
			if ($_FILES["nombre_archivo"]["size"]>0) {
				//$downloadHttpPrefix = "/download";

				$path=  getcwd()."/../download";
				echo "<br> path : ".$path."<br>";
				exit;
				$visit->util->mkdir($path."/".$id);
				$visit->util->descargaArchivo($_FILES["nombre_archivo"],$path."/".$id);
				$resource->name=$_FILES["nombre_archivo"]["name"];

				/*$b = file_exists( $path."/".$id );	
				print "b=".$b;
				print "cwd=".$path."/".$id;
				exit();*/
			} else {
				$resource->name=$ubicacion_documento;
			}
			echo "llego<br>";
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
											if ($dict["seccion_".$sec2->id."_nuevo"]=="O"){
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
									}//else if
							} //if	
				}//while

		} else if ($tipo=="OV") {
			$resource->idov=$id;
			$resource->visible=$dict["visible"];
			$resource->type=$tipo;
			if ( $dict["idov_refered"]!=""){
				$resource->idov_refered=$dict["idov_refered"];
				$ov=$visit->dbBuilder->getVirtualObjectId($dict["idov_refered"]);
				if ($ov!="") $resource->name=$ov->name;
			} 
			$resource = $visit->dbBuilder->persist($resource);
				/** Guardo cada atributo (seccion) del nuevo recurso **/
			$secRec=$visit->dbBuilder->getSeccionesFromIdPadre($idRecurso);
			while (list ($clave, $sec) = each ($secRec)) { 
							 if ($dict["seccion_".$sec->id."_nuevo"]!=""){
									if ($sec->tipo_valores=="C"){
										//echo VAR_DUMP($obj2);
											$obj2=new ClsControlledData();
											if ($dict["seccion_".$sec->id."_nuevo"]=="O"){
													$obj2->value=$dict["text_".$sec->id."_nuevo"];
											} else {
													$obj2->value=$dict["seccion_".$sec->id."_nuevo"];
											}
											$obj2->idseccion=$sec->id;
											$obj2->idov=$obj->id;
											$obj2->idrecurso=$resource->id;
											$obj2 = $visit->dbBuilder->persist($obj2);
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
											$obj2->value=$dict["seccion_".$sec->id."_nuevo"];
											$obj2 = $visit->dbBuilder->persist($obj2);
									}//else if
							} //if	
				}//while

		
		} else if ($tipo=="F") {
			
			$resource->idresource_refered=$dict["idresource_refered"];
			$resource->idov=$id;
			$resource->type=$tipo;
			$resource->visible="S";
			$resource->name=$dict["nombre_recurso_existente"];
			$resource = $visit->dbBuilder->persist($resource);
			$nuevaSeccionCont = new ClsControlledData();
			$seccionesRec= $visit->dbBuilder->getTodosFromIdRecurso($nuevaSeccionCont,$dict["id_recurso_ref"]);
			//var_dump($seccionesRec);
			
			while (list ($clave, $seccionRec) = each ($seccionesRec)) { 
				if ($seccionRec->value!="") {
					$nuevaSeccionCont = new ClsControlledData();
					$nuevaSeccionCont->idseccion=$seccionRec->idseccion;
					$nuevaSeccionCont->idov=$obj->id;
					$nuevaSeccionCont->idrecurso=$resource->id;
					if ($visit->util->normalizeString($seccionRec->value)=="propietario") {
					$nuevaSeccionCont->value="OV".$obj->id;
					} else $nuevaSeccionCont->value=$seccionRec->value;
					//var_dump($nuevaSeccionCont);
					//exit;
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
					//var_dump($nuevaSeccionText);
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
					//var_dump($nuevaSeccionNum);
					$nuevaSeccionNum = $visit->dbBuilder->persist($nuevaSeccionNum);
				}
			}

		}
		

	}
	//var_dump($log);
	//  alfredo  140715   $log->idusuario=$session->idusuario;
	$log->idusuario=$_SESSION["idusuario"];
	$visit->dbBuilder->persist($log);
	$url2 = "cm_view_virtual_object.php?idov=".$obj->id;
	$visit->util->redirect($url2);
	exit();
}



// COMANAGER 1.0: FIN TABLA resources
/* Nuevo Elemento */