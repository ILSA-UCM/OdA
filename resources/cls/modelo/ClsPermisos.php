<?
class ClsPermisos extends ClsModelo {
	var $id, $idusuario, $idov, $tipoPermiso;

	function getNombreTabla() {
		return "permisos";
	}

	function getCamposUpdate() {
		return "idusuario, idov, tipoPermiso";
	}

	var $_orderby="idusuario";

	function getOrderBy() {
		$res = $this->_orderby;
		return $res;
	}

	function getValoresUpdate() {
		global $visit;
		$res =	"idusuario= ". $visit->util->getNullInteger( $this->idusuario ) .",
				idov= ". $visit->util->getNullInteger( $this->idov ) .",
				tipoPermiso= ". $visit->util->getNullString( $this->tipoPermiso ) ;
		return $res;
	}

	function getValoresInsert() {
		global $visit;
		$res =	$visit->util->getNullInteger( $this->idusuario ) .",".
				$visit->util->getNullInteger( $this->idov ) .",".
				$visit->util->getNullString( $this->tipoPermiso );
				
		return $res;
	}

	function construyeCadenaFiltro() {
		global $visit;
		$res ="";
		$res = $this->getSQLBusqueda( "idusuario", $this->idusuario, $res);
		$res = $this->getSQLFiltro( "idov", $this->idov, $res);
		$res = $this->getSQLFiltro( "tipoPermiso", $this->tipoPermiso, $res);
		return $res;
	}

	function newInstance() {
		return new ClsPermisos();
	}

	/*
	 * Te devuelve un objeto Array con todos los campos.
	 */
	function getArrayCampos() {
		$arr = array(
			"id"=>$this->id,
			"idusuario"=>$this->idusuario,
			"idov"=>$this->idov,
			"tipoPermiso"=>$this->tipoPermiso
		);
		return $arr;
	}

	function setAll($cadena) {
		$this->id = $cadena;
		$this->idusuario = $cadena;
		$this->idov = $cadena;
		$this->tipoPermiso = $cadena;
	}	

	function estableceCampo($key,$valor,$prefix) {
		if ($key==$prefix."id") $this->id = $valor;
		else if ($key==$prefix."idusuario") $this->idusuario = $valor;
		else if ($key==$prefix."idov") $this->idov = $valor;
		else if ($key==$prefix."tipoPermiso") $this->tipoPermiso = $valor;
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
	function getValoresTipoPermiso() {
		$arr = array();
		$arr["E"]="Editar";
		$arr["C"]="Consultar";
		return $arr;
	}
}
?>