<? 
include_once(getcwd()."/include.php");
$dict=$visit->util->getRequest();
$op = $dict["op"];

if ($op=="") {
	echo utf8_encode("Operación no válida");
	exit();
}
else if ($op=="login") {
	// Pasamos el login y el nombre del usuario. Si es correcto devolvemos la lista de roles del sistema separados por ;. Si no, error.
	$user = $visit->dbBuilder->getUsuariosLogin( $dict["login"] );
	if ($user=="") $encontrado=false;
	session_start();
	
	// Añadida Seguridad en Login Porr Joaquin Gayoso-Cabada 02102021
	if ( password_verify($dict["password"], $user->password) && ($user->login==$dict["login"] ) ) {
	// Fin Añadida Seguridad en Login Porr Joaquin Gayoso-Cabada 02102021	
	
	//if ( ($user->password == $dict["password"]) && ($user->login==$dict["login"] ) ) {
		// alfredo 140715   $session->idusuario = $user->id;
		$_SESSION["idusuario"] = $user->id;
		$_SESSION['name'] = $user->login;
		$_SESSION['authenticated'] = APP_NAME.$user->id;
		$_SESSION['userid'] = $user->id;
		$_SESSION['UserRolUser'] = $user->rol;
		$url="../ov/cm_ls_virtual_object.php?idusuario";		
	} else {
		$encontrado=false;
		//  alfredo 140715   $session->idusuario = "";
		$_SESSION["idusuario"] = "";
		$url="login.php?error=1";
	}
	// $visit->util->redirect($url); alfredo 140130
	if ($user!="")  $user->actualizaUltimoAcceso();
	$visit->util->redirect($url);
	
}

else if ($op=="entrar") {
	$correo = $dict["login"];	
	$password=$dict["password"];

	// Pasamos el login y el nombre del usuario. Si es correcto devolvemos la lista de roles del sistema separados por ;. Si no, error.
	$user = $visit->dbBuilder->getUsuariosLogin( $login );
	if ($user=="") $encontrado=false;
	
	if ( ($user->password == $dict["password"]) && ($user->correo==$dict["correo"] ) ) {
		$encontrado=true;
		//  alfredo  140715     $session->idusuario = $user->id;
		$_SESSION["idusuario"] = $user->id;
	} else {
		$encontrado=false;
		//  alfredo  140715  $session->idusuario = "";
		$_SESSION["idusuario"] = "";
	}
	$visit->util->redirect($HTTP_REFERER);
}

else if ($op=="logout") {
	//  alfredo  140715    $user = $visit->dbBuilder->getUsuariosId( $session->idusuario );
	$user = $visit->dbBuilder->getUsuariosId( $_SESSION["idusuario"] );
	if ($user->login!="") {
		$user->bloqueado="N";
		$visit->dbBuilder->persist($user);
	}

	//Capturo la información de sesión y la elimino
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
	$visit->util->redirect("login.php");
}

// COMANAGER 1.0: TABLA 
// COMANAGER 1.0: TABLA usuarios
else if ($op=="modificar_usuarios") {
	if ($id!="") {
		$obj = $visit->dbBuilder->getUsuariosId($id);
	} else {
		$obj = new ClsUsuarios();
	}
	$existeCorreo = false;
	$existeLogin = false;
	$userLogin = $visit->dbBuilder->getUsuariosLogin( $login );
	if ( $userLogin->login==$login  && $userLogin->id != $id) {$existeLogin=true; //alfredo 140207
								include(getcwd()."/inc_mensaje.php");
								exit();
	}
	if (!$visit->options->tieneAcceso("form",$obj)) $visit->options->sinAcceso();
	$objPrevio = $obj;
	$obj->estableceCampos( $dict);
	
	//Encriptado Joaquin Gayoso-Cabada 02102021
	$p_hashed = password_hash($obj->password, PASSWORD_BCRYPT);
	$obj->password = $p_hashed;
	//Fin Encriptado Joaquin Gayoso-Cabada 02102021
	
	
	if ($id=="") $obj->id="";
	$obj = $visit->dbBuilder->persist($obj);
	$visit->dbBuilder->eliminarPermisosFromUser($id);
	if ( $dict["permisos"]!="") {
		$v = explode(",",$dict["permisos"]);
		for ($i=0; $i<count($v); $i++) {
			$idovPermiso = $v[$i];			
			$objetoExistente = $visit->dbBuilder->getVirtualObjectId($idovPermiso);
			if($objetoExistente!=null){
				if ($idovPermiso!="") {
					$obj = new ClsPermisos();
					$obj->idusuario = $id;
					$obj->idov = $idovPermiso;
					$obj->tipoPermiso = $dict["tipoPermisos"];
					$obj = $visit->dbBuilder->persist($obj);
				}
			}
		}
	} 

	if (!$existeCorreo && !$existeLogin) $obj = $visit->dbBuilder->persist($obj);
	if($id ==""){
		$id=$obj->id;
	}
	$volverRecurso = "cm_form_usuarios.php?id=".$id;
	// alfredo 140706 	$volverListado = $session->lsusuarios;
	$volverListado = $_SESSION['lsusuarios'];
	include(getcwd()."/inc_mensaje.php");
	exit();
} else if ($op=="eliminar_usuarios") {
	if ($id!="") {
		$obj = new ClsUsuarios();
		$obj->id = $id;
		if (!$visit->options->tieneAcceso("remove",$obj)) $visit->options->sinAcceso();
		$visit->dbBuilder->remove($obj);
		$permisos = $visit->dbBuilder->getPermisosFromUsuario($id);
		for ($i=0;$i<count($permisos);$i++){
			$visit->dbBuilder->remove($permisos[$i]);
			
		}
		
		// alfredo 140706 	$volverListado = $session->lsusuarios;
		$volverListado = $_SESSION['lsusuarios'];
		include(getcwd()."/inc_mensaje.php");
		exit();
	}	
} 
  // COMANAGER 1.0: FIN TABLA usuarios
/* Nuevo Elemento */
else if ($op=="asignar_permisos") {
	//echo "llego";
	$idov = $dict["idov"];
	$tipoPermiso = $dict["tipoPermiso"];
	$obj2= $visit->dbBuilder->getVirtualObjectId($idov);
	//if (!$visit->options->tieneAcceso("form",$obj)) $visit->options->sinAcceso();
	if ($obj2!="") {
		$idusuarios =  explode(",",$dict["usuarios"]);
		//echo $idusuarios;
		$visit->dbBuilder->eliminarPermisosSobreOV($tipoPermiso,$idov);
		while (list ($clave, $idusu) = each ($idusuarios)) {
			//$permiso= $visit->dbBuilder->tienePermisoUsuarioSobreOV($tipoPermiso,$idov,$idusu);
			if (!$permiso) {
			$obj = new ClsPermisos();
			$obj->estableceCampos($dict);
			$obj->idusuario=$idusu;
			$obj = $visit->dbBuilder->persist($obj);
			}
		}
	} else {
		echo "objeto virtual inexistente";
	}
	$url="admin_permisos.php?id=".$idov;
	$visit->util->redirect($url);
	exit();
}