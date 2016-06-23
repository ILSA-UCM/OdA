<?
class ClsResources extends ClsModelo {
	var $id, $idov, $ordinal, $visible, $iconoov, $name, $idov_refered, $idresource_refered, $type;

	function getNombreTabla() {
		return "resources";
	}

	function getCamposUpdate() {
		return "idov, ordinal, visible, iconoov, name, idov_refered, idresource_refered, type";
	}

	var $_orderby="iconoov, idov, idov_refered, idresource_refered, name, ordinal, type, visible, id";

	function getOrderBy() {
		$res = $this->_orderby;
		return $res;
	}

	function getValoresUpdate() {
		global $visit;
		$res =	"idov= ". $visit->util->getNullInteger( $this->idov ) .",
				ordinal= ". $visit->util->getNullInteger( $this->ordinal ) .",
				visible= ". $visit->util->getNullString( $this->visible ) .",
				iconoov= ". $visit->util->getNullString( $this->iconoov ) .",
				name= ". $visit->util->getNullString( $this->name ) .",
				idov_refered= ". $visit->util->getNullInteger( $this->idov_refered ) .",
				idresource_refered= ". $visit->util->getNullInteger( $this->idresource_refered ) .",
				type= ". $visit->util->getNullString( $this->type );
				
		return $res;
	}

	function getValoresInsert() {
		global $visit;
		$res =	$visit->util->getNullInteger( $this->idov ) .",".
				$visit->util->getNullInteger( $this->ordinal ) .",".
				$visit->util->getNullString( $this->visible ) .",".
				$visit->util->getNullString( $this->iconoov ) .",".
				$visit->util->getNullString( $this->name ) .",".
				$visit->util->getNullInteger( $this->idov_refered ) .",".
				$visit->util->getNullInteger( $this->idresource_refered ) .",".
				$visit->util->getNullString( $this->type );
				
		return $res;
	}

	function construyeCadenaFiltro() {
		global $visit;
		$res ="";
		$res = $this->getSQLBusqueda( "idov", $this->idov, $res);
		$res = $this->getSQLBusqueda( "ordinal", $this->ordinal, $res);
		$res = $this->getSQLBusqueda( "visible", $this->visible, $res);
		$res = $this->getSQLBusqueda( "iconoov", $this->iconoov, $res);
		$res = $this->getSQLFiltro( "name", $this->name, $res);
		$res = $this->getSQLBusqueda( "idov_refered", $this->idov_refered, $res);
		$res = $this->getSQLBusqueda( "idresource_refered", $this->idresource_refered, $res);
		$res = $this->getSQLBusqueda( "type", $this->type, $res);
		
		return $res;
	}

	function newInstance() {
		return new ClsResources();
	}

	/*
	 * Te devuelve un objeto Array con todos los campos.
	 */
	function getArrayCampos() {
		$arr = array(
			"id"=>$this->id,
			"idov"=>$this->idov,
			"ordinal"=>$this->ordinal,
			"visible"=>$this->visible,
			"iconoov"=>$this->iconoov,
			"name"=>$this->name,
			"idov_refered"=>$this->idov_refered,
			"idresource_refered"=>$this->idresource_refered,
			"type"=>$this->type
		);
		return $arr;
	}

	function setAll($cadena) {
		$this->id = $cadena;
		$this->idov = $cadena;
		$this->ordinal = $cadena;
		$this->visible = $cadena;
		$this->iconoov = $cadena;
		$this->name = $cadena;
		$this->idov_refered = $cadena;
		$this->idresource_refered = $cadena;
		$this->type = $cadena;
	}	

	function estableceCampo($key,$valor,$prefix) {
		if ($key==$prefix."id") $this->id = $valor;
		else if ($key==$prefix."idov") $this->idov = $valor;
		else if ($key==$prefix."ordinal") $this->ordinal = $valor;
		else if ($key==$prefix."visible") $this->visible = $valor;
		else if ($key==$prefix."iconoov") $this->iconoov = $valor;
		else if ($key==$prefix."name") $this->name = $valor;
		else if ($key==$prefix."idov_refered") $this->idov_refered = $valor;
		else if ($key==$prefix."idresource_refered") $this->idresource_refered = $valor;
		else if ($key==$prefix."type") $this->type = $valor;
	} 
	
	function getValoresType() {
		$arr = array();
		$arr["P"]="Recurso propio";
		$arr["F"]="Recurso ajeno";
		$arr["OV"]="Recurso Objeto Digital";
		$arr["U"] = "Recurso URL";
		$arr["H"] = "Recurso propio";
		
		return $arr;
	}
	function getValorType() {
		$arr = $this->getValoresType();
		$valor = $arr[$this->type];
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
	
	function asignarNombreRecurso()
	{
		global $visit;
		$ext =  substr($this->name,strrpos($this->name,"."));
		$nombre =  substr($this->name,0,strrpos($this->name,"."));
		//$ext=substr($this->name,strlen($this->name)-4);
		//$nombre=substr($this->name,0,strlen($this->name)-4);
		return $nombre.$ext;
		//return $nombre.time().$ext;
	}
// COMANAGER 1.0: Fin Codigo personalizado

}
?>