<?

class ClsOptions {
	var $rolUsuario;
	var $usuario;
	var $fechaTrabajo;
	var $regCount;
	var $currentNumber;
	var $esAuxiliar;
	var $dictConfiguraciones;
	var $operadorTablaFiltrada;
	var	$urlBotonNuevo; //URL de un nuevo elemnto
	var $numeric_decimal;//numero de decimales para la tabla numeric_decimal
	var $secciones;
	var $sectionData;

	function ClsOptions() {
		$this->operadorTablaFiltrada="AND";
	}
	
	function getLang() {
		global $_GET;
		$res= $this->lang;
		if ($res=="") {
			$res=$_GET["lang"];
		}
		return $res;
	}

	/* 
	* Puede ser view, form, ls o remove
	* Miraré si el campo permisos tiene lsobjeto, formobjeto, etcetera. Si es administrador, 
	* puede hacer todo.
	* Si el usuario no está da acceso al entorno.
	*/
	/*
	function tieneAcceso($strTipo, $obj) {
		global $visit;
		$res=false;		
		if ($visit->options->usuario!="") {
			if ($visit->options->usuario->esRolAdmin()&&"ls"==$strTipo&&$obj->getNombreTabla()=="virtual_object") {
				$res=true;
			} else if ($visit->options->usuario->esRolAdmin()&&"form"==$strTipo) {
				$res=true;
			} else if ($visit->options->usuario->esRolSuperadmin()) {
				$res=true;
			} else {
				if ($strTipo) {
					if ($visit->util->perteneceLista($strTipo.get_class($obj), $visit->options->usuario->permisos )) $res=true;
				}
			}
		} else {
			//Si el usuario no está establecido no le dejo pasar
			$res=false;
		}
		return $res;
	}

	function sinAcceso() {
		global $visit;
		$visit->util->redirect("../usuarios/login.php");
		exit();
	}
*/

	function tieneAcceso($strTipo, $obj) {
		/*global $visit;
		$res=false;		
		$ov = $visit->dbBuilder->getOVFromId($obj);
		if($obj=="0"||$ov->ispublic=="S"){
				$res=true;
		} else {
			if ($visit->options->usuario!="") {
				if ($visit->options->usuario->esRolAdmin()&&"ls"==$strTipo&&$obj->getNombreTabla()=="virtual_object") {
					$res=true;
				} else if ($visit->options->usuario->esRolAdmin()&&"form"==$strTipo) {
					$res=true;
				} else if ($visit->options->usuario->esRolSuperadmin()) {
					$res=true;
				} else {
					if ($strTipo) {
						$permisos = $visit->dbBuilder->getPermisosFromUsuario($visit->options->usuario->id);
						if ($visit->util->perteneceLista($obj, $permisos)) $res=true;
					}
				}
			} else {
				//Si el usuario no está establecido no le dejo pasar
				$res=false;
			}
		}
		return $res;*/
		return true;
	}

	function sinAcceso() {
		global $visit;
		$visit->util->redirect("../index.php");
		exit();
	}

	function getIdiomas() {
		global $visit;
		
		$lang["es"]="Espa&ntilde;ol";
		//$lang["en"]="English";
		//$lang["po"]="Portugal";
		return $lang;
	}

	/* Número máximo de atributos que se van a poder gestionar (deben ser campos en la tabla articulos)*/
	function getNumeroAtributos() {
		$res=10;
		return $res;
	}

	function getTipoFormularios(){
		global $visit;
		$arr = array();
		$arr["R"]="Registro";
		$arr["BU"]="Buscador";
		if ($visit->prefs["suscripcionnewsletter"]=="1") $arr["B"]="Suscripción Boletín";
		if ($visit->prefs["suscripcioncatalogo"]=="1") $arr["C"]="Solicitud Catálogo";
	
		return $arr;
	}

	function enviarMail($contenido,$correo) {
		global $visit, $obj;

		$to=$correo;
		$subject= $obj->titulo;
		
		//$contenido = $contenido. $bccCorreos;

		$hdrs = array(
					  'From'    =>  conf("notificacion_ext_desde_suscripcion"),
					  //'Bcc' => $bccCorreos,
					  'Subject' => $subject
					  );
		$crlf = "\n";
		$mime = new Mail_mime($crlf);

		$mime->setTXTBody($contenido);
		$mime->setHTMLBody($contenido);

		$body = $mime->get();
		$hdrs = $mime->headers($hdrs);

		$mail =& Mail::factory('mail');
		$mail->send($to, $hdrs, $body);	
	}

	function controlaAccesoOV($idov){
		global $visit;
		if ($idov!="" && $idov!="0") {
			if(isset($_SESSION['authenticated'])&&($_SESSION['authenticated']== APP_NAME.$visit->options->usuario->id)){
				if($visit->dbBuilder->isOVAccesible($idov)){
					$ov = $visit->dbBuilder->getVirtualObjectId($idov);
				}else{
					if ($visit->util->esSuperAdmin()){
						$idnuevo=$visit->dbBuilder->getSiguienteIdOV($idov);
					}elseif($visit->util->esAdmin()){
						$idnuevo=$visit->dbBuilder->getSiguienteIdOVNoPrivado($idov);
					}else{
						$idnuevo=$visit->dbBuilder->getSiguienteIdOVPublico($idov);
					}
					$idov = $idnuevo->id;
					$ov = $visit->dbBuilder->getVirtualObjectId($idov);			
					header("location: cm_view_virtual_object.php"."?idov=".$idnuevo->id."&idpadre=".$idpadre."&seleccion=".$seleccion);
				}
			}else {
				
				if($visit->dbBuilder->isOVAccesible($idov)){
					$ov = $visit->dbBuilder->getVirtualObjectId($idov);
				}else{
					$idnuevo=$visit->dbBuilder->getSiguienteIdOVPublico($idov);	
					header("location: cm_view_virtual_object.php"."?idov=".$idnuevo->id."&idpadre=".$idpadre."&seleccion=".$seleccion);
				}
			}
			
		} else if(isset($orden)&&($orden!="")){	
			if(isset($_SESSION['authenticated'])&&($_SESSION['authenticated']== APP_NAME.$visit->options->usuario->id)){
				$idnuevo=$visit->dbBuilder->getSiguienteIdOVOrden($idov,$orden);
			} else {
				$idnuevo=$visit->dbBuilder->getSiguienteIdOVOrdenPublico($idov,$orden);
			}
			$ov = $visit->dbBuilder->getVirtualObjectId($idnuevo->idov);
			header("location: cm_view_virtual_object.php"."?idov=".$idov."&orden=".$orden."&idpadre=".$idpadre);
		} else if ($idov=="0") {
			if(isset($_SESSION['authenticated'])&&$_SESSION['authenticated']== APP_NAME.$visit->options->usuario->id){
					$idnuevo=$visit->dbBuilder->getSiguienteIdOV($idov);
			} else {
					$idnuevo=$visit->dbBuilder->getSiguienteIdOVPublico($idov);
			}
			$ov = $visit->dbBuilder->getVirtualObjectId($idnuevo->id);
			header ("location: cm_view_virtual_object.php"."?idov=".$idov."&idpadre=".$idpadre);
		} else{
			$idov=0;
			if(isset($_SESSION['authenticated'])&&$_SESSION['authenticated']== APP_NAME.$visit->options->usuario->id){
				if ($visit->util->esSuperAdmin()){
					$idnuevo=$visit->dbBuilder->getSiguienteIdOV($idov);
				}elseif($visit->util->esAdmin()){
					$idnuevo=$visit->dbBuilder->getSiguienteIdOVNoPrivado($idov);
				}else{
					$idnuevo=$visit->dbBuilder->getSiguienteIdOVPublico($idov);
				}
			} else {
					$idnuevo=$visit->dbBuilder->getSiguienteIdOVPublico($idov);
			}

			$ov = $visit->dbBuilder->getVirtualObjectId($idnuevo->id);
			$dict["idov"] = $ov->id;
			$idov=$dict["idov"];
			header ("location: cm_view_virtual_object.php"."?idov=".$idnuevo->id."&idpadre=".$idpadre."&seleccion=".$seleccion);
		}

		return $ov;
	}
}
?>