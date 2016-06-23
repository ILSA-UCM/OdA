<?
class ClsVirtualObject extends ClsModelo {
	var $id, $ispublic, $isprivate, $name;

	function getNombreTabla() {
		return "virtual_object";
	}

	function getCamposUpdate() {
		return "ispublic, isprivate";
	}

	var $_orderby="id, ispublic, isprivate";

	function getOrderBy() {
		$res = $this->_orderby;
		return $res;
	}

	function getValoresUpdate() {
		global $visit;
		$res =	"ispublic= ". $visit->util->getNullString( $this->ispublic ) .",
				isprivate= ". $visit->util->getNullString( $this->isprivate );
				
		return $res;
	}

	function getValoresInsert() {
		global $visit;
		$res =	$visit->util->getNullString( $this->ispublic ) .",".
				$visit->util->getNullString( $this->isprivate );	

		return $res;
	}

	function construyeCadenaFiltro() {
		global $visit;
		$res = "";
		$res = $this->getSQLBusqueda( "ispublic", $this->ispublic, $res);
		$res = $this->getSQLFiltro( "isprivate", $this->isprivate, $res);

		return $res;
	}

	function newInstance() {
		return new ClsVirtualObject();
	}

	/*
	 * Te devuelve un objeto Array con todos los campos.
	 */
	function getArrayCampos() {
		$arr = array(
			"id"=>$this->id,
			"ispublic"=>$this->ispublic,
			"isprivate"=>$this->isprivate
		);
		return $arr;
	}

	function setAll($cadena) {
		$this->id = $cadena;
		$this->ispublic = $cadena;
		$this->isprivate = $cadena;
	}	

	function estableceCampo($key,$valor,$prefix) {
		if ($key==$prefix."id") $this->id = $valor;
		else if ($key==$prefix."ispublic") $this->ispublic = $valor;
		else if ($key==$prefix."isprivate") $this->isprivate = $valor;
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

	function refinarWhere($where) {
		global $visit;

		$nwhere = "";

		if ($this->refinar->noprivate!="") {
			if ($nwhere!= "") $nwhere = $nwhere." AND ";
			$nwhere .= " isprivate!='S' ";
		}

		if ($this->refinar->noprivate_nopublic!="") {
			if ($nwhere!= "") $nwhere = $nwhere." AND ";
			$nwhere .= " (isprivate!='N' AND  ispublic!='N' )";
		}

		if ($this->refinar->ispublic!="") {
			if ($nwhere!= "") $nwhere = $nwhere." AND ";
			$nwhere .= " ispublic='S' ";
		}

		if ($nwhere!=""){
			if($where!=""){
				$nwhere = $where." AND ( ".$nwhere." )";
			}
		}
		else{
			$nwhere = $where;
		}
		return $nwhere;
	}

	function borraIcono(){
		global $visit;
		$icono = $visit->dbBuilder->getIconoFromOV($this->id);
		//Borra su icono
		$visit->dbBuilder->borraUnIcono($icono->id);
	}
}
?>