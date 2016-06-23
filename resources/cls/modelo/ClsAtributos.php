<?
class ClsAtributos extends ClsModelo {
	var $id, $nombre, $tipo, $formato, $valor, $activo, $lang, $idlangprincipal;

	function getNombreTabla() {
		return "atributos";
	}

	function getCamposUpdate() {
		return "nombre, tipo, formato, valor, activo, lang, idlangprincipal";
	}

	var $_orderby="activo, formato, idlangprincipal, lang, nombre, tipo, valor, id";

	function getOrderBy() {
		$res = $this->_orderby;
		return $res;
	}

	function getValoresUpdate() {
		global $visit;
		$res =	"nombre= ". $visit->util->getNullString( $this->nombre ) .",
				tipo= ". $visit->util->getNullString( $this->tipo ) .",
				formato= ". $visit->util->getNullString( $this->formato ) .",
				valor= ". $visit->util->getNullString( $this->valor ) .",
				activo= ". $visit->util->getNullString( $this->activo ) .",
				lang= ". $visit->util->getNullString( $this->lang ) .",
				idlangprincipal= ". $visit->util->getNullString( $this->idlangprincipal );
				
		return $res;
	}

	function getValoresInsert() {
		global $visit;
		$res =	$visit->util->getNullString( $this->nombre ) .",".
				$visit->util->getNullString( $this->tipo ) .",".
				$visit->util->getNullString( $this->formato ) .",".
				$visit->util->getNullString( $this->valor ) .",".
				$visit->util->getNullString( $this->activo ) .",".
				$visit->util->getNullString( $this->lang ) .",".
				$visit->util->getNullString( $this->idlangprincipal );
				
		return $res;
	}

	function construyeCadenaFiltro() {
		global $visit;
		$res ="";
		$res = $this->getSQLFiltro( "nombre", $this->nombre, $res);
		$res = $this->getSQLBusqueda( "tipo", $this->tipo, $res);
		$res = $this->getSQLBusqueda( "formato", $this->formato, $res);
		$res = $this->getSQLFiltro( "valor", $this->valor, $res);
		$res = $this->getSQLBusqueda( "activo", $this->activo, $res);
		$res = $this->getSQLFiltro( "lang", $this->lang, $res);
		$res = $this->getSQLFiltro( "idlangprincipal", $this->idlangprincipal, $res);
		
		return $res;
	}

	function newInstance() {
		return new ClsAtributos();
	}

	/*
	 * Te devuelve un objeto Array con todos los campos.
	 */
	function getArrayCampos() {
		$arr = array(
			"id"=>$this->id,
			"nombre"=>$this->nombre,
			"tipo"=>$this->tipo,
			"formato"=>$this->formato,
			"valor"=>$this->valor,
			"activo"=>$this->activo,
			"lang"=>$this->lang,
			"idlangprincipal"=>$this->idlangprincipal
		);
		return $arr;
	}

	function setAll($cadena) {
		$this->id = $cadena;
		$this->nombre = $cadena;
		$this->tipo = $cadena;
		$this->formato = $cadena;
		$this->valor = $cadena;
		$this->activo = $cadena;
		$this->lang = $cadena;
		$this->idlangprincipal = $cadena;
	}	

	function estableceCampo($key,$valor,$prefix) {
		if ($key==$prefix."id") $this->id = $valor;
		else if ($key==$prefix."nombre") $this->nombre = $valor;
		else if ($key==$prefix."tipo") $this->tipo = $valor;
		else if ($key==$prefix."formato") $this->formato = $valor;
		else if ($key==$prefix."valor") $this->valor = $valor;
		else if ($key==$prefix."activo") $this->activo = $valor;
		else if ($key==$prefix."lang") $this->lang = $valor;
		else if ($key==$prefix."idlangprincipal") $this->idlangprincipal = $valor;
	} 
	
	function getValoresTipo() {
		$arr = array();
		$arr["L"]="Libre";
		$arr["V"]="Lista de valores";
		return $arr;
	}
	function getValorTipo() {
		$arr = $this->getValoresTipo();
		$valor = $arr[$this->tipo];
		return $valor;
	}
	function getValoresFormato() {
		$arr = array();
		$arr["corto"]="Texto Corto (hasta 100 caracteres)";
		$arr["medio"]="Texto Medio (hasta 255 caracteres)";
		$arr["largo"]="Texto Largo (párrafo)";
		return $arr;
	}
	function getValorFormato() {
		$arr = $this->getValoresFormato();
		$valor = $arr[$this->formato];
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
		$res =	"tipo= ". $visit->util->getNullString( $this->tipo ) .",
				formato= ". $visit->util->getNullString( $this->formato ) .",
				valor= ". $visit->util->getNullString( $this->valor ) .",
				activo= ". $visit->util->getNullString( $this->activo );
		return $res;
	}
// COMANAGER 1.0: Fin Codigo personalizado

}
?>