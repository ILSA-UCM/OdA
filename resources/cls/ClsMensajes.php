<?
class ClsMensajes extends ClsModelo {
	var $id, $orden, $lang, $atributo, $valor, $grupo, $formato, $tipo, $etiqueta;

	function getNombreTabla() {
		return "mensajes";
	}

	function getCamposUpdate() {
		return "orden, lang, atributo, valor, grupo, formato, tipo, etiqueta";
	}

	var $_orderby="orden, atributo, etiqueta, formato, grupo, lang, tipo, valor, id";

	function getOrderBy() {
		$res = $this->_orderby;
		return $res;
	}

	function getValoresUpdate() {
		global $visit;
		$res =	"orden= ". $visit->util->getNullInteger( $this->orden ) .",
				lang= ". $visit->util->getNullString( $this->lang ) .",
				atributo= ". $visit->util->getNullString( $this->atributo ) .",
				valor= ". $visit->util->getNullString( $this->valor ) .",
				grupo= ". $visit->util->getNullString( $this->grupo ) .",
				formato= ". $visit->util->getNullString( $this->formato ) .",
				tipo= ". $visit->util->getNullString( $this->tipo ) .",
				etiqueta= ". $visit->util->getNullString( $this->etiqueta );
				
		return $res;
	}

	function getValoresInsert() {
		global $visit;
		$res =	$visit->util->getNullInteger( $this->orden ) .",".
				$visit->util->getNullString( $this->lang ) .",".
				$visit->util->getNullString( $this->atributo ) .",".
				$visit->util->getNullString( $this->valor ) .",".
				$visit->util->getNullString( $this->grupo ) .",".
				$visit->util->getNullString( $this->formato ) .",".
				$visit->util->getNullString( $this->tipo ) .",".
				$visit->util->getNullString( $this->etiqueta );
				
		return $res;
	}

	function construyeCadenaFiltro() {
		global $visit;
		$res ="";
		$res = $this->getSQLBusqueda( "orden", $this->orden, $res);
		$res = $this->getSQLFiltro( "lang", $this->lang, $res);
		$res = $this->getSQLFiltro( "atributo", $this->atributo, $res);
		$res = $this->getSQLFiltro( "valor", $this->valor, $res);
		$res = $this->getSQLFiltro( "grupo", $this->grupo, $res);
		$res = $this->getSQLFiltro( "formato", $this->formato, $res);
		$res = $this->getSQLFiltro( "tipo", $this->tipo, $res);
		$res = $this->getSQLFiltro( "etiqueta", $this->etiqueta, $res);
		
		return $res;
	}

	function newInstance() {
		return new ClsMensajes();
	}

	/*
	 * Te devuelve un objeto Array con todos los campos.
	 */
	function getArrayCampos() {
		$arr = array(
			"id"=>$this->id,
			"orden"=>$this->orden,
			"lang"=>$this->lang,
			"atributo"=>$this->atributo,
			"valor"=>$this->valor,
			"grupo"=>$this->grupo,
			"formato"=>$this->formato,
			"tipo"=>$this->tipo,
			"etiqueta"=>$this->etiqueta
		);
		return $arr;
	}

	function setAll($cadena) {
		$this->id = $cadena;
		$this->orden = $cadena;
		$this->lang = $cadena;
		$this->atributo = $cadena;
		$this->valor = $cadena;
		$this->grupo = $cadena;
		$this->formato = $cadena;
		$this->tipo = $cadena;
		$this->etiqueta = $cadena;
	}	

	function estableceCampo($key,$valor,$prefix) {
		if ($key==$prefix."id") $this->id = $valor;
		else if ($key==$prefix."orden") $this->orden = $valor;
		else if ($key==$prefix."lang") $this->lang = $valor;
		else if ($key==$prefix."atributo") $this->atributo = $valor;
		else if ($key==$prefix."valor") $this->valor = $valor;
		else if ($key==$prefix."grupo") $this->grupo = $valor;
		else if ($key==$prefix."formato") $this->formato = $valor;
		else if ($key==$prefix."tipo") $this->tipo = $valor;
		else if ($key==$prefix."etiqueta") $this->etiqueta = $valor;
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
// COMANAGER 1.0: Fin Codigo personalizado

}
?>