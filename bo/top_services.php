<?
	if(!isset($_SESSION['authenticated'])){
		if($_SESSION['authenticated']!= $visit->options->usuario->id || $visit->options->usuario->id ==null ){		
			if(basename($SCRIPT_NAME)!="login.php"){
				$visit->util->redirect($_parenDir."bo/usuarios/login.php");
			}
		}
	}
	//Acceso solo a administradores y superadministradores
	else if( $_SESSION["UserRolUser"] != "A" && $_SESSION["UserRolUser"] != "B"){
		$visit->util->redirect($_parenDir."bo/usuarios/login.php");
	}
	header('Content-type: text/html; charset=UTF-8')
?>
