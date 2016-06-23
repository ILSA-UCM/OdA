<?
class ClsImagenes extends ClsModelo {
	var $id, $url, $idprueba, $descripcion;

	function getNombreTabla() {
		return "imagenes";
	}

	function getCamposUpdate() {
		return "url, idprueba, descripcion";
	}

	var $_orderby="id";

	function getOrderBy() {
		$res = $this->_orderby;
		return $res;
	}

	function getValoresUpdate() {
		global $visit;
		$res =	"url= ". $visit->util->getNullString( $this->url ) .",
				idprueba= ". $visit->util->getNullString( $this->idprueba ) .",
				descripcion= ". $visit->util->getNullString( $this->descripcion );
				
		return $res;
	}

	function getValoresInsert() {
		global $visit;
		$res =	$visit->util->getNullString( $this->url ) .",".
				$visit->util->getNullString( $this->idprueba ) .",".
				$visit->util->getNullString( $this->descripcion );
				
		return $res;
	}

	function construyeCadenaFiltro() {
		global $visit;
		$res ="";
		$res = $this->getSQLFiltro( "url", $this->url, $res);
		$res = $this->getSQLBusqueda( "idprueba", $this->idprueba, $res);
		$res = $this->getSQLFiltro( "descripcion", $this->descripcion, $res);
		
		return $res;
	}

	function newInstance() {
		return new ClsImagenes();
	}

	/*
	 * Te devuelve un objeto Array con todos los campos.
	 */
	function getArrayCampos() {
		$arr = array(
			"id"=>$this->id,
			"url"=>$this->url,
			"idprueba"=>$this->idprueba,
			"descripcion"=>$this->descripcion
		);
		return $arr;
	}

	function setAll($cadena) {
		$this->id = $cadena;
		
				$this->url = $cadena;
				$this->idprueba = $cadena;
				$this->descripcion = $cadena;
	}	

	function estableceCampos($arr,$prefix="") {
		$this->id = $arr[$prefix."id"];
				$this->url = $arr[$prefix."url"];
				$this->idprueba = $arr[$prefix."idprueba"];
				$this->descripcion = $arr[$prefix."descripcion"];
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