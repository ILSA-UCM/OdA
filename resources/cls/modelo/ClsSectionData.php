<?
class ClsSectionData extends ClsModelo {
	var $id, $idpadre, $nombre, $codigo, $tooltip, $visible, $orden, $browseable, $tipo_valores, $extensible, $vocabulario, $decimales;

	function getNombreTabla() {
		return "section_data";
	}

	function getCamposUpdate() {
		return "idpadre, nombre, codigo, tooltip, visible, orden,  browseable, tipo_valores, extensible, vocabulario, decimales";
	}

	var $_orderby="orden, browseable, codigo, idpadre, nombre, tipo_valores, tooltip, visible, id";

	function getOrderBy() {
		$res = $this->_orderby;
		return $res;
	}

	function getValoresUpdate() {
		global $visit;
		$res =	"idpadre= ". $visit->util->getNullInteger( $this->idpadre ) .",
				nombre= ". $visit->util->getNullString( $this->nombre ) .",
				codigo= ". $visit->util->getNullString( $this->codigo ) .",
				tooltip= ". $visit->util->getNullString( $this->tooltip ) .",
				visible= ". $visit->util->getNullString( $this->visible ) .",
				orden= ". $visit->util->getNullInteger( $this->orden ) .",
				browseable= ". $visit->util->getNullString( $this->browseable ) .",
				tipo_valores= ". $visit->util->getNullString( $this->tipo_valores ).",
				extensible= ". $visit->util->getNullString( $this->extensible ).",
				vocabulario= ". $visit->util->getNullInteger( $this->vocabulario ).",
				decimales= ". $visit->util->getNullInteger( $this->decimales );

		return $res;
	}

	function getValoresInsert() {
		global $visit;
		$res =	$visit->util->getNullInteger( $this->idpadre ) .",".
				$visit->util->getNullString( $this->nombre ) .",".
				$visit->util->getNullString( $this->codigo ) .",".
				$visit->util->getNullString( $this->tooltip ) .",".
				$visit->util->getNullString( $this->visible ) .",".
				$visit->util->getNullInteger( $this->orden ) .",".
				$visit->util->getNullString( $this->browseable ) .",".
				$visit->util->getNullString( $this->tipo_valores ).",".
				$visit->util->getNullString( $this->extensible ).",".
				$visit->util->getNullInteger( $this->vocabulario ).",".
				$visit->util->getNullInteger( $this->decimales );
				
		return $res;
	}

	function construyeCadenaFiltro() {
		global $visit;
		$res ="";
		$res = $this->getSQLBusqueda( "idpadre", $this->idpadre, $res);
		$res = $this->getSQLFiltro( "nombre", $this->nombre, $res);
		$res = $this->getSQLFiltro( "codigo", $this->codigo, $res);
		$res = $this->getSQLFiltro( "tooltip", $this->tooltip, $res);
		$res = $this->getSQLBusqueda( "visible", $this->visible, $res);
		$res = $this->getSQLBusqueda( "orden", $this->orden, $res);
		$res = $this->getSQLBusqueda( "browseable", $this->browseable, $res);
		$res = $this->getSQLBusqueda( "tipo_valores", $this->tipo_valores, $res);
		$res = $this->getSQLBusqueda( "extensible", $this->extensible, $res);
		$res = $this->getSQLBusqueda( "vocabulario", $this->vocabulario, $res);
		$res = $this->getSQLBusqueda( "decimales", $this->decimales, $res);
		
		return $res;
	}

	function newInstance() {
		return new ClsSectionData();
	}

	/*
	 * Te devuelve un objeto Array con todos los campos.
	 */
	function getArrayCampos() {
		$arr = array(
			"id"=>$this->id,
			"idpadre"=>$this->idpadre,
			"nombre"=>$this->nombre,
			"codigo"=>$this->codigo,
			"tooltip"=>$this->tooltip,
			"visible"=>$this->visible,
			"orden"=>$this->orden,
			"browseable"=>$this->browseable,
			"tipo_valores"=>$this->tipo_valores,
			"extensible"=>$this->extensible,
			"vocabulario"=>$this->vocabulario,
			"decimales"=>$this->decimales
		);
		return $arr;
	}

	function setAll($cadena) {
		$this->id = $cadena;
		$this->idpadre = $cadena;
		$this->nombre = $cadena;
		$this->codigo = $cadena;
		$this->tooltip = $cadena;
		$this->visible = $cadena;
		$this->orden = $cadena;
		$this->browseable = $cadena;
		$this->tipo_valores = $cadena;
		$this->extensible = $cadena;
		$this->vocabulario = $cadena;
		$this->decimales = $cadena;

	}	

	function estableceCampo($key,$valor,$prefix) {
		if ($key==$prefix."id") $this->id = $valor;
		else if ($key==$prefix."idpadre") $this->idpadre = $valor;
		else if ($key==$prefix."nombre") $this->nombre = $valor;
		else if ($key==$prefix."codigo") $this->codigo = $valor;
		else if ($key==$prefix."tooltip") $this->tooltip = $valor;
		else if ($key==$prefix."visible") $this->visible = $valor;
		else if ($key==$prefix."orden") $this->orden = $valor;
		else if ($key==$prefix."browseable") $this->browseable = $valor;
		else if ($key==$prefix."tipo_valores") $this->tipo_valores = $valor;
		else if ($key==$prefix."extensible") $this->extensible = $valor;
		else if ($key==$prefix."vocabulario") $this->vocabulario = $valor;
		else if ($key==$prefix."decimales") $this->decimales = $valor;
	} 
	
	function getValoresTipoValores() {
		$arr = array();
		$arr["N"]="Num&eacute;rico";
		$arr["F"]="Fecha";
		$arr["T"]="Texto";
		$arr["C"]="Controlado";
		return $arr;
	}
	function getValorTipoValores() {
		$arr = $this->getValoresTipoValores();
		$valor = $arr[$this->tipo_valores];
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
// COMANAGER 1.0: Fin Codigo personalizado
	function getTablaGenericaIdCache($id){
		global $visit;

		return $visit->options->secciones[$this->id];
	}

	static function getSeccionesFromIdPadreCache($idpadre){
		global $visit;
		$secciones = $visit->options->secciones;
		$res = array();
		foreach ($secciones as $key => $seccion) {
			if($seccion->idpadre==$idpadre){
				$res[] = $seccion;
			}
		}
		return $res;
	}

	static function getSeccionesNavegablesFromIdPadreVisiblesCache($idpadre){
		global $visit;
		$secciones = $visit->options->secciones;
		$res = array();
		foreach ($secciones as $key => $seccion) {
			if($seccion->visible=="S" && $seccion->idpadre==$idpadre){
				$res[] = $seccion;
			}
		}

		return $res;
	}
	static function limpiaTablasData(){
		global $visit;
		$array_tablas = array(
			"ClsControlledData",
			"ClsNumericData",
			"ClsTextData",
			"ClsDateData"
			);
		foreach ($array_tablas as $model) {
			$obj = new $model;
			$sql = "DELETE FROM ".$obj->getNombreTabla()." WHERE value IS NULL";
			$visit->dbBuilder->executeNonQuery($sql);
		}
	}

	function getHijosFromValor($acum_navegacion){
		global $visit;
		$controlados="";
		if ($this->tipo_valores=="C") {
			$controlados=$visit->dbBuilder->getHijosFromValorControlado($this->id,$acum_navegacion);
		}  else if ($this->tipo_valores=="N") {
			$controlados=$visit->dbBuilder->getHijosFromValorNumerico($this->id,$acum_navegacion);
		}  else if ($this->tipo_valores=="T") {
			$controlados=$visit->dbBuilder->getHijosFromValorTexto($this->id,$acum_navegacion);
		}else if ($this->tipo_valores=="F") {
			$controlados=$visit->dbBuilder->getHijosFromFecha($this->id,$acum_navegacion);
		//}else if ($this->tipo_valores =="X"){	
		} else {
			$controlados=$visit->dbBuilder->getHijosFromValorControlado($this->id,$acum_navegacion);
		}
		return $controlados;
	}
}
?>