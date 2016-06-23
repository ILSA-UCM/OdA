<?
class ClsPaginaImagenes extends ClsModelo {
	var $id, $titulo, $lang, $idlangprincipal, $cuenta;

	function getNombreTabla() {
		return "pagina_imagenes";
	}

	function getCamposUpdate() {
		return "titulo, lang, idlangprincipal";
	}

	var $_orderby="idlangprincipal, lang, titulo, id";

	function getOrderBy() {
		$res = $this->_orderby;
		return $res;
	}

	function getValoresUpdate() {
		global $visit;
		$res =	"titulo= ". $visit->util->getNullString( $this->titulo ) .",
				lang= ". $visit->util->getNullString( $this->lang ) .",
				idlangprincipal= ". $visit->util->getNullString( $this->idlangprincipal );
				
		return $res;
	}

	function getValoresInsert() {
		global $visit;
		$res =	$visit->util->getNullString( $this->titulo ) .",".
				$visit->util->getNullString( $this->lang ) .",".
				$visit->util->getNullString( $this->idlangprincipal );
				
		return $res;
	}

	function construyeCadenaFiltro() {
		global $visit;
		$res ="";
		$res = $this->getSQLFiltro( "titulo", $this->titulo, $res);
		$res = $this->getSQLFiltro( "lang", $this->lang, $res);
		$res = $this->getSQLFiltro( "idlangprincipal", $this->idlangprincipal, $res);
		
		return $res;
	}

	function newInstance() {
		return new ClsPaginaImagenes();
	}

	/*
	 * Te devuelve un objeto Array con todos los campos.
	 */
	function getArrayCampos() {
		$arr = array(
			"id"=>$this->id,
			"titulo"=>$this->titulo,
			"lang"=>$this->lang,
			"idlangprincipal"=>$this->idlangprincipal
		);
		return $arr;
	}

	function setAll($cadena) {
		$this->id = $cadena;
		$this->titulo = $cadena;
		$this->lang = $cadena;
		$this->idlangprincipal = $cadena;
	}	

	function estableceCampo($key,$valor,$prefix) {
		if ($key==$prefix."id") $this->id = $valor;
		else if ($key==$prefix."titulo") $this->titulo = $valor;
		else if ($key==$prefix."lang") $this->lang = $valor;
		else if ($key==$prefix."idlangprincipal") $this->idlangprincipal = $valor;
		// OJO!!! no lo genera el commanager
		else if ($key==$prefix."cuenta") $this->cuenta = $valor;

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