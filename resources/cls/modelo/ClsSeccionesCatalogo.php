<?
class ClsSeccionesCatalogo extends ClsModelo {
	var $id, $nombre, $tooltip, $visible, $idpadre, $orden, $nombreseo, $imagen, $contenido, $tipo_contenido, $lang, $idlangprincipal;

	function getNombreTabla() {
		return "secciones_catalogo";
	}

	function getCamposUpdate() {
		return "nombre, tooltip, visible, idpadre, orden, nombreseo, imagen, contenido, tipo_contenido, lang, idlangprincipal";
	}

	var $_orderby="contenido, idlangprincipal, idpadre, imagen, lang, nombre, nombreseo, orden, tipo_contenido, tooltip, visible, id";

	function getOrderBy() {
		$res = $this->_orderby;
		return $res;
	}

	function getValoresUpdate() {
		global $visit;
		$res =	"nombre= ". $visit->util->getNullString( $this->nombre ) .",
				tooltip= ". $visit->util->getNullString( $this->tooltip ) .",
				visible= ". $visit->util->getNullString( $this->visible ) .",
				idpadre= ". $visit->util->getNullInteger( $this->idpadre ) .",
				orden= ". $visit->util->getNullInteger( $this->orden ) .",
				nombreseo= ". $visit->util->getNullString( $this->nombreseo ) .",
				imagen= ". $visit->util->getNullString( $this->imagen ) .",
				contenido= ". $visit->util->getNullString( $this->contenido ) .",
				tipo_contenido= ". $visit->util->getNullString( $this->tipo_contenido ) .",
				lang= ". $visit->util->getNullString( $this->lang ) .",
				idlangprincipal= ". $visit->util->getNullString( $this->idlangprincipal );
				
		return $res;
	}

	function getValoresInsert() {
		global $visit;
		$res =	$visit->util->getNullString( $this->nombre ) .",".
				$visit->util->getNullString( $this->tooltip ) .",".
				$visit->util->getNullString( $this->visible ) .",".
				$visit->util->getNullInteger( $this->idpadre ) .",".
				$visit->util->getNullInteger( $this->orden ) .",".
				$visit->util->getNullString( $this->nombreseo ) .",".
				$visit->util->getNullString( $this->imagen ) .",".
				$visit->util->getNullString( $this->contenido ) .",".
				$visit->util->getNullString( $this->tipo_contenido ) .",".
				$visit->util->getNullString( $this->lang ) .",".
				$visit->util->getNullString( $this->idlangprincipal );
				
		return $res;
	}

	function construyeCadenaFiltro() {
		global $visit;
		$res ="";
		$res = $this->getSQLFiltro( "nombre", $this->nombre, $res);
		$res = $this->getSQLFiltro( "tooltip", $this->tooltip, $res);
		$res = $this->getSQLBusqueda( "visible", $this->visible, $res);
		$res = $this->getSQLBusqueda( "idpadre", $this->idpadre, $res);
		$res = $this->getSQLBusqueda( "orden", $this->orden, $res);
		$res = $this->getSQLFiltro( "nombreseo", $this->nombreseo, $res);
		$res = $this->getSQLFiltro( "imagen", $this->imagen, $res);
		$res = $this->getSQLFiltro( "contenido", $this->contenido, $res);
		$res = $this->getSQLBusqueda( "tipo_contenido", $this->tipo_contenido, $res);
		$res = $this->getSQLFiltro( "lang", $this->lang, $res);
		$res = $this->getSQLFiltro( "idlangprincipal", $this->idlangprincipal, $res);
		
		return $res;
	}

	function newInstance() {
		return new ClsSeccionesCatalogo();
	}

	/*
	 * Te devuelve un objeto Array con todos los campos.
	 */
	function getArrayCampos() {
		$arr = array(
			"id"=>$this->id,
			"nombre"=>$this->nombre,
			"tooltip"=>$this->tooltip,
			"visible"=>$this->visible,
			"idpadre"=>$this->idpadre,
			"orden"=>$this->orden,
			"nombreseo"=>$this->nombreseo,
			"imagen"=>$this->imagen,
			"contenido"=>$this->contenido,
			"tipo_contenido"=>$this->tipo_contenido,
			"lang"=>$this->lang,
			"idlangprincipal"=>$this->idlangprincipal
		);
		return $arr;
	}

	function setAll($cadena) {
		$this->id = $cadena;
		$this->nombre = $cadena;
		$this->tooltip = $cadena;
		$this->visible = $cadena;
		$this->idpadre = $cadena;
		$this->orden = $cadena;
		$this->nombreseo = $cadena;
		$this->imagen = $cadena;
		$this->contenido = $cadena;
		$this->tipo_contenido = $cadena;
		$this->lang = $cadena;
		$this->idlangprincipal = $cadena;
	}	

	function estableceCampo($key,$valor,$prefix) {
		if ($key==$prefix."id") $this->id = $valor;
		else if ($key==$prefix."nombre") $this->nombre = $valor;
		else if ($key==$prefix."tooltip") $this->tooltip = $valor;
		else if ($key==$prefix."visible") $this->visible = $valor;
		else if ($key==$prefix."idpadre") $this->idpadre = $valor;
		else if ($key==$prefix."orden") $this->orden = $valor;
		else if ($key==$prefix."nombreseo") $this->nombreseo = $valor;
		else if ($key==$prefix."imagen") $this->imagen = $valor;
		else if ($key==$prefix."contenido") $this->contenido = $valor;
		else if ($key==$prefix."tipo_contenido") $this->tipo_contenido = $valor;
		else if ($key==$prefix."lang") $this->lang = $valor;
		else if ($key==$prefix."idlangprincipal") $this->idlangprincipal = $valor;
	} 
	
	function getValoresTipoContenido() {
		$arr = array();
		$arr["T"]="Presenta únicamente la imagen y/o texto superior";
		$arr["A"]="Artículos";
		$arr["N"]="Novedades de sus secciones internas";
		$arr["O"]="Ofertas de sus secciones internas";
		return $arr;
	}
	function getValorTipoContenido() {
		$arr = $this->getValoresTipoContenido();
		$valor = $arr[$this->tipo_contenido];
		return $valor;
	}
	function request2bbdd() {
		global $visit;
	}

// COMANAGER 1.0: Codigo personalizado
	function getTitulo() {
		return $this->id;
	} 

	function getAvance() {
		global $visit;
		return $visit->util->acortaCadena( $this->id );
	} 

	function getValoresUpdateLang() {
		global $visit;
		$res =	"visible= ". $visit->util->getNullString( $this->visible ) .",
				idpadre= ". $visit->util->getNullInteger( $this->idpadre ) .",
				orden= ". $visit->util->getNullInteger( $this->orden ) .",
				tipo_contenido= ". $visit->util->getNullString( $this->tipo_contenido );
		return $res;
	}
// COMANAGER 1.0: Fin Codigo personalizado

}
?>