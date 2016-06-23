<?
class ClsRequestProcessor {
	var $util;

	function ClsRequestProcessor() {
		$this->util = new ClsUtil();
	}

	/*
	 * Función que dado unas variables POST, construye un objeto empresa correcto 
	 */
	function createEmpresa($query, $empresa) {
		global $visit;
		$marcado_borrar = $empresa->marcado_borrar;
		$idusuario = $empresa->idusuario;
		$es_publico = $empresa->es_publico;

		$empresa->estableceCampos( $query );
		if ($visit->options->usuario->puedeBorrar() ) {
			//Si elegimos un usuario, el campo es_publico es falso
			if ($empresa->idusuario>0) {
				$empresa->es_publico="N";
			}
		} else {
			//si el usuario no es el propietario no le permito cambiar el permiso
			if ($visit->options->usuario->id != $idusuario) {
				$empresa->es_publico = $es_publico;
				$empresa->idusuario = $idusuario;
			} else {
				//Si si es el propietario, y le marco publico, ya no lo es
				if ($empresa->es_publico!="N") $empresa->idusuario=0;
				else $empresa->idusuario = $idusuario;
			}
			//Conservo el marcado_borrar que hubiese
			$empresa->marcado_borrar = $marcado_borrar;			
		}
		return $empresa;
	}

	function createContacto($query, $contacto) {
		global $visit;
		$marcado_borrar = $contacto->marcado_borrar;
		$idusuario = $contacto->idusuario;
		$es_publico = $contacto->es_publico;

		$contacto->estableceCampos( $query );
		$contacto->onomastica = $visit->util->date2bbdd($contacto->onomastica);
		if ($contacto->idempresa >0) $contacto->empresa="";
		if ($contacto->idcentro >0) $contacto->centro="";
		if ($visit->options->usuario->puedeBorrar() ) {
			//Si elegimos un usuario, el campo es_publico es falso
			if ($contacto->idusuario>0) {
				$contacto->es_publico="N";
			}
		} else {
			//si el usuario no es el propietario no le permito cambiar el permiso
			if ($visit->options->usuario->id != $idusuario) {
				$contacto->es_publico = $es_publico;
				$contacto->idusuario = $idusuario;
			} else {
				//Si si es el propietario, y le marco publico, ya no lo es
				if ($contacto->es_publico!="N") $contacto->idusuario=0;
				else $contacto->idusuario = $idusuario;
			}
			//Conservo el marcado_borrar que hubiese
			$empresa->marcado_borrar = $marcado_borrar;			
		}
		return $contacto;
	}

	function createCentro($query, $centro) {
		global $visit;
		$marcado_borrar = $centro->marcado_borrar;
		$idusuario = $centro->idusuario;
		$es_publico = $centro->es_publico;

		$centro->estableceCampos( $query );
		if ($visit->options->usuario->puedeBorrar() ) {
			//Si elegimos un usuario, el campo es_publico es falso
			if ($centro->idusuario>0) {
				$centro->es_publico="N";
			}
		} else {
			//si el usuario no es el propietario no le permito cambiar el permiso
			if ($visit->options->usuario->id != $idusuario) {
				$centro->es_publico = $es_publico;
				$centro->idusuario = $idusuario;
			} else {
				//Si si es el propietario, y le marco publico, ya no lo es
				if ($centro->es_publico!="N") $centro->idusuario=0;
				else $centro->idusuario = $idusuario;
			}
			//Conservo el marcado_borrar que hubiese
			$centro->marcado_borrar = $marcado_borrar;			
		}
		return $centro;
	}

	function createConsumo($query, $consumo) {
		global $visit;
		$marcado_borrar = $consumo->marcado_borrar;
		$idusuario = $consumo->idusuario;
		$es_publico = $consumo->es_publico;

		$consumo->estableceCampos( $query );
		if ($visit->options->usuario->puedeBorrar() ) {
			//Si elegimos un usuario, el campo es_publico es falso
			if ($consumo->idusuario>0) {
				$consumo->es_publico="N";
			}
		} else {
			//si el usuario no es el propietario no le permito cambiar el permiso
			if ($visit->options->usuario->id != $idusuario) {
				$consumo->es_publico = $es_publico;
				$consumo->idusuario = $idusuario;
			} else {
				//Si si es el propietario, y le marco publico, ya no lo es
				if ($consumo->es_publico!="N") $consumo->idusuario=0;
				else $consumo->idusuario = $idusuario;
			}
			//Conservo el marcado_borrar que hubiese
			$consumo->marcado_borrar = $marcado_borrar;			
		}
		return $consumo;
	}

	function getArray( $url ) {
		$path = explode("&",substr($url,1));
		$arr = array();
		for ($i=0;$i<count($path);$i++) {
			$path2 = explode("=",$path[$i]);
			$arr[$path2[0]] = $path2[1];
		}
		return $arr;
	}

	/* Dado parametros construye el filtro aplicado al cliente */
	function getFiltroEmpresa( $dict ) {
		global $visit, $session;
		$empresaFiltro = new ClsEmpresa();
		
		$dict = $this->getArray( $session->filtroEmpresa );
		$empresaFiltro->estableceCampos($dict);
		if (!$visit->options->usuario->puedeBorrar() ) {
			$empresaFiltro->marcado_borrar="N";
		}

		return $empresaFiltro;
	}

	function getFiltroContacto($dict ) {
		global $visit, $session;
		$contactoFiltro = new ClsContacto();

		$dict = $this->getArray( $session->filtroContacto );
		$contactoFiltro->estableceCampos($dict);
		if (!$visit->options->usuario->puedeBorrar() ) {
			$contactoFiltro->marcado_borrar="N";
		}
		return $contactoFiltro;
	}

	/* Dado parametros construye el filtro aplicado al cliente */
	function getFiltroCentro( $dict ) {
		global $visit, $session;
		$objFiltro = new ClsCentro();

		$dict = $this->getArray( $session->filtroCentro );
		$objFiltro->estableceCampos($dict);
		if (!$visit->options->usuario->puedeBorrar() ) {
			$objFiltro->marcado_borrar="N";
		}
		return $objFiltro;
	}

	/* Dado parametros construye el filtro aplicado al cliente */
	function getFiltroConsumo( $dict ) {
		global $visit, $session;
		$objFiltro = new ClsConsumo();

		$dict = $this->getArray( $session->filtroConsumo );
		$objFiltro->estableceCampos($dict);
		if (!$visit->options->usuario->puedeBorrar() ) {
			$objFiltro->marcado_borrar="N";
		}
		return $objFiltro;
	}

	/* Dado parametros construye el filtro aplicado al cliente */
	function getURLFiltroEmpresa( $dict ) {
		$dict["idempresa"]="";
		return $this->getFiltroDict($dict);
	}

	/* Dado parametros construye el filtro aplicado al contacto */
	function getURLFiltroContacto( $dict ) {
		$dict["idcontacto"]="";
		return $this->getFiltroDict($dict);
	}

	/* Dado parametros construye el filtro aplicado al cliente */
	function getURLFiltroCentro( $dict ) {
		$dict["idcentro"]="";
		return $this->getFiltroDict($dict);
	}

	/* Dado parametros construye el filtro aplicado al cliente */
	function getURLFiltroConsumo( $dict ) {
		$dict["idconsumo"]="";
		return $this->getFiltroDict($dict);
	}

	//Nunca filtramos por el id de una tabla
	//pos tampoco porque se usa para los movimientos entre registros
	function getFiltroDict($dict) {
		$dict["id"]="";
		$dict["pos"]="";
		$dict["op"]="";
		$dict["eliminar"]="";
		$url="";
		while ( list($key, $val) = each($dict) ) { 
			if ($val!="") $url .= "&$key=$val";
		}
		return	$url;
	}

}


?>