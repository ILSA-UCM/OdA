<?
class ClsNumericData extends ClsModelo {
	var $id, $idov, $idseccion, $value;

	function getNombreTabla() {
		return "numeric_data";
	}

	function getCamposUpdate() {
		return "idov, idseccion, idrecurso, value";
	}

	var $_orderby="idov, idseccion, idrecurso, value, id";

	function getOrderBy() {
		$res = $this->_orderby;
		return $res;
	}

	function getValoresUpdate() {
		global $visit;
		$res =	"idov= ". $visit->util->getNullInteger( $this->idov ) .",
				idseccion= ". $visit->util->getNullInteger( $this->idseccion ) .",
				idrecurso= ". $visit->util->getNullInteger( $this->idrecurso ) .",
				value= ". $visit->util->getNullString( $this->value );
				
		return $res;
	}

	function getValoresInsert() {
		global $visit;
		$res =	$visit->util->getNullInteger( $this->idov ) .",".
				$visit->util->getNullInteger( $this->idseccion ) .",".
				$visit->util->getNullInteger( $this->idrecurso ) .",".
				$visit->util->getNullString( $this->value );
				
		return $res;
	}

	function construyeCadenaFiltro() {
		global $visit;
		$res ="";
		$res = $this->getSQLBusqueda( "idov", $this->idov, $res);
		$res = $this->getSQLBusqueda( "idseccion", $this->idseccion, $res);
		$res = $this->getSQLBusqueda( "idseccion", $this->idrecurso, $res);
		$res = $this->getSQLFiltro( "value", $this->value, $res);
		
		return $res;
	}

	function newInstance() {
		return new ClsNumericData();
	}

	/*
	 * Te devuelve un objeto Array con todos los campos.
	 */
	function getArrayCampos() {
		$arr = array(
			"id"=>$this->id,
			"idov"=>$this->idov,
			"idseccion"=>$this->idseccion,
			"idrecurso"=>$this->idrecurso,
			"value"=>$this->value
		);
		return $arr;
	}

	function setAll($cadena) {
		$this->id = $cadena;
		$this->idov = $cadena;
		$this->idseccion = $cadena;
		$this->idrecurso = $cadena;
		$this->value = $cadena;
	}	

	function estableceCampo($key,$valor,$prefix) {
		if ($key==$prefix."id") $this->id = $valor;
		else if ($key==$prefix."idov") $this->idov = $valor;
		else if ($key==$prefix."idseccion") $this->idseccion = $valor;
		else if ($key==$prefix."idrecurso") $this->idrecurso = $valor;
		else if ($key==$prefix."value") $this->value = $valor;
		else if ($key==$prefix."cuenta") $this->cuenta= $valor;
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