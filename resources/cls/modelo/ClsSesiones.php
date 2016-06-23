<?
class ClsSesiones extends ClsModelo {
	var $id, $idsession, $timestamp, $data;

	function getNombreTabla() {
		return "sesiones";
	}

	function getCamposUpdate() {
		return "idsession, timestamp, data";
	}

	var $_orderby="id";

	function getOrderBy() {
		$res = $this->_orderby;
		return $res;
	}

	function getValoresUpdate() {
		global $visit;
		$res =	"idsession= ". $visit->util->getNullString( $this->idsession ) .",
				timestamp= ". $visit->util->getNullInteger( $this->timestamp ) .",
				data= ". $visit->util->getNullString( $this->data );
				
		return $res;
	}

	function getValoresInsert() {
		global $visit;
		$res =	$visit->util->getNullString( $this->idsession ) .",".
				$visit->util->getNullInteger( $this->timestamp ) .",".
				$visit->util->getNullString( $this->data );
				
		return $res;
	}

	function construyeCadenaFiltro() {
		global $visit;
		$res ="";
		$res = $this->getSQLFiltro( "idsession", $this->idsession, $res);
		$res = $this->getSQLFiltro( "timestamp", $this->timestamp, $res);
		$res = $this->getSQLFiltro( "data", $this->data, $res);
		
		return $res;
	}

	function newInstance() {
		return new ClsSesiones();
	}

	/*
	 * Te devuelve un objeto Array con todos los campos.
	 */
	function getArrayCampos() {
		$arr = array(
			"id"=>$this->id,
			"idsession"=>$this->idsession,
			"timestamp"=>$this->timestamp,
			"data"=>$this->data
		);
		return $arr;
	}

	function setAll($cadena) {
		$this->id = $cadena;
		
				$this->idsession = $cadena;
				$this->timestamp = $cadena;
				$this->data = $cadena;
	}	

	function estableceCampos($arr) {
		$this->id = $arr["id"];
				$this->idsession = $arr["idsession"];
				$this->timestamp = $arr["timestamp"];
				$this->data = $arr["data"];
	} 
	
	


}
?>