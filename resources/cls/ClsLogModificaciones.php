<?
class ClsLogModificaciones extends ClsModelo {
	var $id, $idusuario, $fechaModificacion, $tipo, $idov;

	function getNombreTabla() {
		return "log_modificaciones";
	}

	function getCamposUpdate() {
		return "idusuario, fechaModificacion, tipo, idov";
	}

	var $_orderby="fechaModificacion DESC, idusuario";

	function getOrderBy() {
		$res = $this->_orderby;
		return $res;
	}

	function getValoresUpdate() {
		global $visit;
		$res =	"idusuario= ". $visit->util->getNullInteger( $this->idusuario ) .",
				fechaModificacion= ". $visit->util->getNullString( $this->fechaModificacion ) .",
				tipo= ". $visit->util->getNullString( $this->tipo ).",
				idov= ". $visit->util->getNullString( $this->idov ) ;
		return $res;
	}

	function getValoresInsert() {
		global $visit;
		$res =	$visit->util->getNullInteger( $this->idusuario ) .",".
				$visit->util->getNullString( $this->fechaModificacion ) .",".
				$visit->util->getNullString( $this->tipo ).",".
				$visit->util->getNullString( $this->idov );
				
		return $res;
	}

	function construyeCadenaFiltro() {
		global $visit;
		$res ="";
		$res = $this->getSQLBusqueda( "idusuario", $this->idusuario, $res);
		$res = $this->getSQLFiltro( "fechaModificacion", $this->fechaModificacion, $res);
		$res = $this->getSQLFiltro( "tipo", $this->tipo, $res);
		$res = $this->getSQLFiltro( "idov", $this->idov, $res);
		return $res;
	}

	function newInstance() {
		return new ClsLogModificaciones();
	}

	/*
	 * Te devuelve un objeto Array con todos los campos.
	 */
	function getArrayCampos() {
		$arr = array(
			"id"=>$this->id,
			"idusuario"=>$this->idusuario,
			"fechaModificacion"=>$this->fechaModificacion,
			"tipo"=>$this->tipo,
			"idov"=>$this->idov
		);
		return $arr;
	}

	function setAll($cadena) {
		$this->id = $cadena;
		$this->idusuario = $cadena;
		$this->fechaModificacion = $cadena;
		$this->tipo = $cadena;
		$this->idov = $cadena;
	}	

	function estableceCampo($key,$valor,$prefix) {
		if ($key==$prefix."id") $this->id = $valor;
		else if ($key==$prefix."idusuario") $this->idusuario = $valor;
		else if ($key==$prefix."fechaModificacion") $this->fechaModificacion = $valor;
		else if ($key==$prefix."tipo") $this->tipo = $valor;
		else if ($key==$prefix."idov") $this->idov = $valor;
	} 
	
	function getValoresModificacion() {
		$arr = array();
		$arr["E"]="Edición";
		$arr["V"]="Visualizacion";
		return $arr;
	}
	function getValorModificacion() {
		$arr = $this->getValoresModificacion();
		$valor = $arr[$this->tipo];
		return $valor;
	}
	
	function request2bbdd() {
		global $visit;
	}

	function getTitulo() {
		return $this->id;
	} 

	function getAvance() {
		global $visit;
		return $visit->util->acortaCadena( $this->id );
	} 

}
?>