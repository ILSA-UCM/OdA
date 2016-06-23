<?
class ClsNavegacion extends ClsModelo {

	var $id, $nombre, $tooltip, $idpadre, $visible, $orden, $tipo_contenido, $idpagina, $tipo, $nombreseo, $imagen, $contenido,  $url, $tiene_contenido, $protocolo, $ventanaexterna;

	function getNombreTabla() {
		return "navegacion";
	}

	function getCamposUpdate() {
		return "nombre, tooltip, idpadre, visible, orden, tipo_contenido, idpagina, tipo, nombreseo, imagen, contenido,  url, tiene_contenido, protocolo, ventanaexterna";
	}

	var $_orderby="orden, visible DESC, id, nombreseo";

	function getOrderBy() {
		$res = $this->_orderby;
		return $res;
	}

	function getValoresUpdate() {
		global $visit;
		$res =	"nombre= ". $visit->util->getNullString( $this->nombre ) .",
				tooltip= ". $visit->util->getNullString( $this->tooltip ) .",
				idpadre= ". $visit->util->getNullInteger( $this->idpadre ) .",
				visible= ". $visit->util->getNullString( $this->visible ) .",
				orden= ". $visit->util->getNullInteger( $this->orden ) .",
				tipo_contenido= ". $visit->util->getNullString( $this->tipo_contenido ) .",
				idpagina= ". $visit->util->getNullInteger( $this->idpagina ) .",
				tipo= ". $visit->util->getNullString( $this->tipo ) .",
				nombreseo= ". $visit->util->getNullString( $this->nombreseo ) .",
				imagen= ". $visit->util->getNullString( $this->imagen ) .",
				contenido= ". $visit->util->getNullString( $this->contenido ) .",
				url= ". $visit->util->getNullString( $this->url ) .",
				tiene_contenido= ". $visit->util->getNullString( $this->tiene_contenido ) .",
				protocolo= ". $visit->util->getNullString( $this->protocolo ) .",
				ventanaexterna= ". $visit->util->getNullString( $this->ventanaexterna ) ;
				
		return $res;
	}

	function getValoresInsert() {
		global $visit;
		$res =	$visit->util->getNullString( $this->nombre ) .",".
				$visit->util->getNullString( $this->tooltip ) .",".
				$visit->util->getNullInteger( $this->idpadre ) .",".
				$visit->util->getNullString( $this->visible ) .",".
				$visit->util->getNullInteger( $this->orden ) .",".
				$visit->util->getNullString( $this->tipo_contenido ) .",".
				$visit->util->getNullInteger( $this->idpagina ) .",".
				$visit->util->getNullString( $this->tipo ) .",".
				$visit->util->getNullString( $this->nombreseo ) .",".
				$visit->util->getNullString( $this->imagen ) .",".
				$visit->util->getNullString( $this->contenido ) .",".
				$visit->util->getNullString( $this->url ) .",".
				$visit->util->getNullString( $this->tiene_contenido ) .",".
				$visit->util->getNullString( $this->protocolo ) .",".
				$visit->util->getNullString( $this->ventanaexterna ) ;
		return $res;
	}

	function construyeCadenaFiltro() {
		global $visit;
		$res ="";
		$res = $this->getSQLFiltro( "nombre", $this->nombre, $res);
		$res = $this->getSQLFiltro( "tooltip", $this->tooltip, $res);
		$res = $this->getSQLBusqueda( "idpadre", $this->idpadre, $res);
		$res = $this->getSQLBusqueda( "visible", $this->visible, $res);
		$res = $this->getSQLBusqueda( "orden", $this->orden, $res);
		$res = $this->getSQLBusqueda( "tipo_contenido", $this->tipo_contenido, $res);
		$res = $this->getSQLBusqueda( "idpagina", $this->idpagina, $res);
		$res = $this->getSQLBusqueda( "tipo", $this->tipo, $res);
		$res = $this->getSQLFiltro( "nombreseo", $this->nombreseo, $res);
		$res = $this->getSQLFiltro( "imagen", $this->imagen, $res);
		$res = $this->getSQLFiltro( "contenido", $this->contenido, $res);
		$res = $this->getSQLFiltro( "url", $this->url, $res);
		$res = $this->getSQLBusqueda( "tiene_contenido", $this->tiene_contenido, $res);
		$res = $this->getSQLBusqueda( "protocolo", $this->protocolo, $res);
		$res = $this->getSQLBusqueda( "ventanaexterna", $this->ventanaexterna, $res);
		
		return $res;
	}

	function newInstance() {
		return new ClsNavegacion();
	}

	/*
	 * Te devuelve un objeto Array con todos los campos.
	 */
	function getArrayCampos() {
		$arr = array(
			"id"=>$this->id,
			"nombre"=>$this->nombre,
			"tooltip"=>$this->tooltip,
			"idpadre"=>$this->idpadre,
			"visible"=>$this->visible,
			"orden"=>$this->orden,
			"tipo_contenido"=>$this->tipo_contenido,
			"idpagina"=>$this->idpagina,
			"tipo"=>$this->tipo,
			"nombreseo"=>$this->nombreseo,
			"imagen"=>$this->imagen,
			"contenido"=>$this->contenido,
			"url"=>$this->url,
			"tiene_contenido"=>$this->tiene_contenido,
			"protocolo"=>$this->protocolo,
			"ventanaexterna"=>$this->ventanaexterna
		);
		return $arr;
	}

	function setAll($cadena) {
		$this->id = $cadena;
		$this->nombre = $cadena;
		$this->tooltip = $cadena;
		$this->idpadre = $cadena;
		$this->visible = $cadena;
		$this->orden = $cadena;
		$this->tipo_contenido = $cadena;
		$this->idpagina = $cadena;
		$this->tipo = $cadena;
		$this->nombreseo = $cadena;
		$this->imagen = $cadena;
		$this->contenido = $cadena;
		$this->url = $cadena;
		$this->tiene_contenido = $cadena;
		$this->protocolo = $cadena;
		$this->ventanaexterna = $cadena;
	}	

	function estableceCampo($key,$valor,$prefix) {
		if ($key==$prefix."id") $this->id = $valor;
		else if ($key==$prefix."nombre") $this->nombre = $valor;
		else if ($key==$prefix."tooltip") $this->tooltip = $valor;
		else if ($key==$prefix."idpadre") $this->idpadre = $valor;
		else if ($key==$prefix."visible") $this->visible = $valor;
		else if ($key==$prefix."orden") $this->orden = $valor;
		else if ($key==$prefix."tipo_contenido") $this->tipo_contenido = $valor;
		else if ($key==$prefix."idpagina") $this->idpagina = $valor;
		else if ($key==$prefix."tipo") $this->tipo = $valor;
		else if ($key==$prefix."nombreseo") $this->nombreseo = $valor;
		else if ($key==$prefix."imagen") $this->imagen = $valor;
		else if ($key==$prefix."contenido") $this->contenido = $valor;
		else if ($key==$prefix."url") $this->url = $valor;
		else if ($key==$prefix."tiene_contenido") $this->tiene_contenido = $valor;
		else if ($key==$prefix."protocolo") $this->protocolo = $valor;
		else if ($key==$prefix."ventanaexterna") $this->ventanaexterna = $valor;
	} 
	
	function getValoresTipoContenido() { // MODIFICADO
		global $visit;
		$arr = array();
		$arr["H"]="Ninguno - Al primero de sus secciones internas";
		$arr["P"]="P&aacute;ginas";
		$arr["U"]="Url";
		$arr["A"]="Acceso a Base de Datos";
		$arr["C"]="Clasificaci&oacute;n de la Base de Datos";
		$arr["B"]="B&uacute;squeda";
		$arr["M"]="Mantenimiento";
		return $arr;
	}
	function getValorTipoContenido() {
		$arr = $this->getValoresTipoContenido();
		$valor = $arr[$this->tipo_contenido];
		return $valor;
	}
	function getValoresTipo() {
		$arr = array();
		$arr["I"]="Menu Izquierda";
		$arr["B"]="Menu Inferior";
		$arr["D"]="Menu Derecha";
		return $arr;
	}
	function getValorTipo() {
		$arr = $this->getValoresTipo();
		$valor = $arr[$this->tipo];
		return $valor;
	}
	function getValoresTieneContenido() {
		$arr = array();
		$arr["S"]="Si";
		$arr["N"]="No";
		return $arr;
	}
	function getValorTieneContenido() {
		$arr = $this->getValoresTieneContenido();
		$valor = $arr[$this->tiene_contenido];
		return $valor;
	}
	function getValoresProtocolo() {
		$arr = array();
		$arr["http://"]="http://";
		$arr["https://"]="https://";
		$arr["ftp://"]="ftp://";
		$arr["ftps://"]="ftps://";
		$arr[""]="otro";
		return $arr;
	}
	function getValorProtocolo() {
		$arr = $this->getValoresProtocolo();
		$valor = $arr[$this->protocolo];
		return $valor;
	}
	function request2bbdd() {
		global $visit;
	}

// COMANAGER 1.0: Codigo personalizado
	function getValoresTipoCustom() {
		global $prefs;
		$arr = array();
		$arr["I"]="Men&uacute; Izquierda";
		///$arr["B"]="Men&uacute; Inferior";
		
		return $arr;
	}


	function getTitulo() {
		return $this->id;
	} 

	function getAvance() {
		global $visit;
		return $visit->util->acortaCadena( $this->id );
	} 
	function getValoresUpdateLang() {
		global $visit;
		$res =	"idpadre= ". $visit->util->getNullInteger( $this->idpadre ) .",
				visible= ". $visit->util->getNullString( $this->visible ) .",
				orden= ". $visit->util->getNullInteger( $this->orden ) .",
				tipo_contenido= ". $visit->util->getNullString( $this->tipo_contenido ) .",
				idpagina= ". $visit->util->getNullInteger( $this->idpagina ) .",
				tipo= ". $visit->util->getNullString( $this->tipo ) .",
				tiene_contenido= ". $visit->util->getNullString( $this->tiene_contenido ) .",
				protocolo= ". $visit->util->getNullString( $this->protocolo ).",
				url= ". $visit->util->getNullString( $this->url ) .",
				ventanaexterna= ". $visit->util->getNullString( $this->ventanaexterna ) ;
		return $res;
	}
// COMANAGER 1.0: Fin Codigo personalizado

}
?>