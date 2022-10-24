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
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<TITLE></TITLE>
<LINK REL="stylesheet" TYPE="text/css" HREF="<?=$_parenDir?>bo/backoffice.css"></link>
<!-- SCRIPTS NECESARIOS -->
<script language="JavaScript" type="text/JavaScript"></script>
<script src="misc/scripts/ts_picker.js"></script>
<script src="misc/scripts/func.js"></script>

<script src="misc/scripts/custom.js"></script>
<!-- CALENDARIO -->
<script src="misc/scripts/ts_picker.js"></script>

<META NAME="Author" CONTENT="VARADERO SOFTWARE FACTORY">
<META NAME="Keywords" CONTENT="">
<META NAME="Description" CONTENT="">
</HEAD>
<body bgcolor="#EFEFEF" link="#003399" alink="#003399" vlink="#003399" <?= $visit->template->bodyStr ?>>
<center>
