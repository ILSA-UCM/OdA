<?
class ClsBanco extends ClsModelo {
	var $id, $ruta, $descripcion;

	function getNombreTabla() {
		return "banco";
	}

	function getCamposUpdate() {
		return "ruta, descripcion";
	}

	var $_orderby="id";

	function getOrderBy() {
		$res = $this->_orderby;
		return $res;
	}

	function getValoresUpdate() {
		global $visit;
		$res =	"ruta= ". $visit->util->getNullString( $this->ruta ) .",
				descripcion= ". $visit->util->getNullString( $this->descripcion );
				
		return $res;
	}

	function getValoresInsert() {
		global $visit;
		$res =	$visit->util->getNullString( $this->ruta ) .",".
				$visit->util->getNullString( $this->descripcion );
				
		return $res;
	}

	function construyeCadenaFiltro() {
		global $visit;
		$res ="";
		$res = $this->getSQLFiltro( "ruta", $this->ruta, $res);
		$res = $this->getSQLFiltro( "descripcion", $this->descripcion, $res);
		
		return $res;
	}

	function newInstance() {
		return new ClsBanco();
	}

	/*
	 * Te devuelve un objeto Array con todos los campos.
	 */
	function getArrayCampos() {
		$arr = array(
			"id"=>$this->id,
			"ruta"=>$this->ruta,
			"descripcion"=>$this->descripcion
		);
		return $arr;
	}

	function setAll($cadena) {
		$this->id = $cadena;
		$this->ruta = $cadena;
		$this->descripcion = $cadena;
	}	

	function estableceCampos($arr) {
		$this->id = $arr["id"];
		$this->ruta = $arr["ruta"];
		$this->descripcion = $arr["descripcion"];
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
