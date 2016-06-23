<?
class ClsModelo {
	//Los campos de busqueda son id,
	function construyeCadenaBusqueda() {
		$res ="";
		if ($this->id!="") {
			if ($res!="") $res.=" AND ";
			$res.="id=". $this->id;
		}
		return $res;
	}

	//Para construir WHERES por defecto
	function construyeCadenaFiltro() {
		return "";
	}

	function refinarWhere($nwhere) {
		return $nwhere;
	}

	function construyeCadenaBusquedaGeneral($res, $palabra) {
		global $visit;
		$operadorOld=$visit->options->operador;
		$visit->options->operadorTablaFiltrada="OR";
	//	$where = $this->construyeCadenaFiltro();
		$where = $this->construyeCadenaFiltroBusqueda();
		$visit->options->operadorTablaFiltrada=$operadorOld;
		if ($where!="") {
			if ($res!="") $res = "(".$res.") AND ";
			$res .= $where;
		}
		return $res;
	}

	function getCampos() {
		return "id, " . $this->getCamposUpdate();
	}

	function getCamposUpdate() {
		return "";
	}

	// Va construyendo elementos de la busqueda
	function getSQLFiltro( $nombreCampo, $valorCampo, $concat) {
		global $visit;
		$op = $visit->options->operadorTablaFiltrada;
		$res = $concat;
		if ($valorCampo!="") {
			$vpath = explode(" ", $valorCampo);
			for ($i=0; $i<count($vpath); $i++) {
				if ($res!="") $res.=" $op ";
				$res.=$nombreCampo." LIKE '%". $vpath[$i] ."%' ";
			}
		}
		return $res;
	}

	// Va construyendo elementos de la busqueda
	function getSQLBusqueda( $nombreCampo, $valorCampo, $concat) {
		global $visit;
		$op = $visit->options->operadorTablaFiltrada;
		$res = $concat;
		if ($valorCampo!="") {
			$vpath = explode(" ", $valorCampo);
			for ($i=0; $i<count($vpath); $i++) {
				if ($res!="") $res.=" $op ";
				$res.=$nombreCampo." = '". $vpath[$i] ."' ";
			}
		}
		return $res;
	}


	// Va construyendo elementos de la busqueda
	function getSQLBusquedaInt( $nombreCampo, $valorCampo, $concat) {
		global $visit;
		$op = $visit->options->operadorTablaFiltrada;
		$res = $concat;
		if ($valorCampo!="") {
			$vpath = explode(" ", $valorCampo);
			for ($i=0; $i<count($vpath); $i++) {
				if (is_numeric($vpath[$i])) {
					if ($res!="") $res.=" $op ";
					$res.=$nombreCampo." = '". $vpath[$i] ."' ";
				}
			}
		}
		return $res;
	}

	function getSQLBusquedaLista( $nombreCampo, $valorCampo, $concat) {
		global $visit;
		$op = $visit->options->operadorTablaFiltrada;
		$res = $concat;
		if ($valorCampo!="") {
			if ($res!="") $res.=" $op ";
			$res.="CONCAT(',',".$nombreCampo.",',') LIKE '%,".$valorCampo .",%' ";
			//$res.="CONCAT(', ',".$nombreCampo.",',') LIKE '%, ".$valorCampo ."%' ";
		}
		return $res;
	}

	// Va construyendo elementos de la busqueda
	function getSQLBusquedaBool( $nombreCampo, $valorCampo, $concat) {
		global $visit;
		$op = $visit->options->operadorTablaFiltrada;

		$res = $concat;
		if ($valorCampo=="S") {
			if ($res!="") $res.=" $op ";
			$res.=$nombreCampo." = 'S' ";
		} else if ($valorCampo=="N") {
			if ($res!="") $res.=" $op ";
			$res.=" " . $nombreCampo." <> 'S' ";
		}
		return $res;
	}

	function getLeftJoin() {
		return "";
	}

	function request2bbdd() {
	}

	function estableceCampos($arr,$prefix="") {
		if ($arr!="") {
			reset($arr);
			while (list($k,$v)=each($arr)) {
				$this->estableceCampo($k,$v,$prefix);
			}
		}
	}

}
?>