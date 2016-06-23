<?
class ClsPaginas extends ClsModelo {
	var $id, $titulo, $visible, $contenido, $documento;

	function getNombreTabla() {
		return "paginas";
	}

	function getCamposUpdate() {
		return "titulo, visible, contenido, documento";
	}

	var $_orderby="titulo, contenido, documento, visible, id";

	function getOrderBy() {
		$res = $this->_orderby;
		return $res;
	}

	function getValoresUpdate() {
		global $visit;
		$res =	"titulo= ". $visit->util->getNullString( $this->titulo ) .",
				visible= ". $visit->util->getNullString( $this->visible ) .",
				contenido= ". $visit->util->getNullString( $this->contenido ) .",
				documento= ". $visit->util->getNullString( $this->documento );
				
		return $res;
	}

	function getValoresInsert() {
		global $visit;
		$res =	$visit->util->getNullString( $this->titulo ) .",".
				$visit->util->getNullString( $this->visible ) .",".
				$visit->util->getNullString( $this->contenido ) .",".
				$visit->util->getNullString( $this->documento );
				
		return $res;
	}

	function construyeCadenaFiltro() {
		global $visit;
		$res ="";
		$res = $this->getSQLFiltro( "titulo", $this->titulo, $res);
		$res = $this->getSQLBusqueda( "visible", $this->visible, $res);
		$res = $this->getSQLFiltro( "contenido", $this->contenido, $res);
		$res = $this->getSQLFiltro( "documento", $this->documento, $res);
		
		return $res;
	}

	function newInstance() {
		return new ClsPaginas();
	}

	/*
	 * Te devuelve un objeto Array con todos los campos.
	 */
	function getArrayCampos() {
		$arr = array(
			"id"=>$this->id,
			"titulo"=>$this->titulo,
			"visible"=>$this->visible,
			"contenido"=>$this->contenido,
			"documento"=>$this->documento
		);
		return $arr;
	}

	function setAll($cadena) {
		$this->id = $cadena;
		$this->titulo = $cadena;
		$this->visible = $cadena;
		$this->contenido = $cadena;
		$this->documento = $cadena;
	}	

	function estableceCampo($key,$valor,$prefix) {
		if ($key==$prefix."id") $this->id = $valor;
		else if ($key==$prefix."titulo") $this->titulo = $valor;
		else if ($key==$prefix."visible") $this->visible = $valor;
		else if ($key==$prefix."contenido") $this->contenido = $valor;
		else if ($key==$prefix."documento") $this->documento = $valor;
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
		$res =	"visible= ". $visit->util->getNullString( $this->visible ).",
				documento= ". $visit->util->getNullString( $this->documento );
		return $res;
	}
// COMANAGER 1.0: Fin Codigo personalizado

}
?>