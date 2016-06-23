<?
class ClsSqlMysql {
function SqlCreacion($tabla) {
		$res ='
			CREATE TABLE `'. $tabla->nombre_tabla. '` (
				`id` INTEGER (11) NOT NULL  AUTO_INCREMENT ,
			';
		for ($i=0;$i<count($tabla->campos);$i++) {
			$res.='
				`'. $tabla->campos[$i]->getNombreCampoBD() .'` '. $tabla->campos[$i]->getTipoDatos() .', 
			';
		}
		$res.='
				PRIMARY KEY (id)
			) 
			';
		return $res;
	}

	function getTipoDatos( $tipo ) {
		$res="";
		if ($tipo=="texto/fecha") {
			$res="char(8)";
		} else if ($tipo=="texto/fechahora") {
			$res="char(14)";
		} else if ($tipo=="texto") {
			$res="varchar(255)";
		} else if ($tipo=="memo") {
			$res="text";
		} else if ($tipo=="int") {
			$res="integer(11)";
		} else if ($tipo=="richtext") {
			$res="text";
		} else if ($tipo=="combo") {
			$res="varchar(255)";
		} else if ($tipo=="check") {
			$res="char(1)";
		} else if ($tipo=="download") {
			$res="varchar(255)";
		} else if ($tipo=="download_image") {
			$res="varchar(255)";
		} else {
			$res="varchar(255)";
		}
		return $res;
	}

	function getTipo() {
		return "mysql";
	}


}

class ClsSqlAccess {
	function SqlCreacion($tabla) {
		$res ='
			CREATE TABLE '. $tabla->nombre_tabla. ' (
				id  IDENTITY PRIMARY KEY
			';
		for ($i=0;$i<count($tabla->campos);$i++) {
			$res.=',
				'. $tabla->campos[$i]->getNombreCampoBD() .' '. $tabla->campos[$i]->getTipoDatos() .'
			';
		}
		$res.= '
			) 
			';
		return $res;
	}
	function getTipoDatos( $tipo ) {
		$res="";
		if ($tipo=="texto/fecha") {
			$res="char(8)";
		} else if ($tipo=="texto/fechahora") {
			$res="char(14)";
		} else if ($tipo=="texto") {
			$res="varchar(255)";
		} else if ($tipo=="memo") {
			$res="memo";
		} else if ($tipo=="int") {
			$res="integer";
		} else if ($tipo=="richtext") {
			$res="memo";
		} else if ($tipo=="combo") {
			$res="varchar(255)";
		} else if ($tipo=="check") {
			$res="char(1)";
		} else if ($tipo=="download") {
			$res="varchar(255)";
		} else if ($tipo=="download_image") {
			$res="varchar(255)";
		} else {
			$res="varchar(255)";
		}
		return $res;
	}

	function getTipo() {
		return "access";
	}
}

class ClsTabla extends ClsModelo {
	//El concepto ContaPlus es de 25 caracteres
	var $nombre_tabla, $configuracion, $prefijo_archivos, $prefijo_tablas, $filetop, $filebottom, $directorioview, $parametros, $tipo;

	//Campos de datos de esta tabla
	var $campos;

	// Posición del campo (util para poder usarlo en algunas funciones
	var $posicion;

	function getNombreTabla() {
		return "sam_tablas";
	}

	function getCampos() {
		return "id, " . $this->getCamposUpdate();
	}

	function getCamposUpdate() {
		return "nombre_tabla, configuracion, prefijo_archivos, prefijo_tablas, filetop, filebottom, directorioview, parametros, tipo";
	}

	function getOrderBy() {
		$res = "nombre_tabla";
		return $res;
	}

	function newInstance() {
		return new ClsTabla();
	}

	/*
	 * Te devuelve un objeto Array con todos los campos.
	 */
	function getArrayCampos() {
		$arr = array(
			"id"=>$this->id,
			"nombre_tabla"=>$this->nombre_tabla,
			"configuracion"=>$this->configuracion,
			"prefijo_archivos"=>$this->prefijo_archivos,
			"prefijo_tablas"=>$this->prefijo_tablas,
			"filetop"=>$this->filetop,
			"filebottom"=>$this->filebottom,
			"directorioview"=>$this->directorioview,
			"parametros"=>$this->parametros,
			"tipo"=>$this->tipo
		);
		return $arr;
	}

	function getValoresUpdate() {
		global $visit;
		$res =	'nombre_tabla = '. $visit->util->getNullString( $this->nombre_tabla ) .',
				configuracion = '. $visit->util->getNullString( $this->configuracion ) .',
				prefijo_archivos = '. $visit->util->getNullString( $this->prefijo_archivos ) .',
				prefijo_tablas = '. $visit->util->getNullString( $this->prefijo_tablas ) .',
				filetop = '. $visit->util->getNullString( $this->filetop ) .',
				filebottom = '. $visit->util->getNullString( $this->filebottom ) .',
				directorioview = '. $visit->util->getNullString( $this->directorioview ) .',
				parametros = '. $visit->util->getNullString( $this->parametros ) .',
				tipo = '. $visit->util->getNullString( $this->tipo );
		return $res;
	}

	function getValoresInsert() {
		global $visit;
		$res =	$visit->util->getNullString( $this->nombre_tabla ) .',
				'. $visit->util->getNullString( $this->configuracion ) .',
				'. $visit->util->getNullString( $this->prefijo_archivos ) .',
				'. $visit->util->getNullString( $this->prefijo_tablas ) .',
				'. $visit->util->getNullString( $this->filetop ) .',
				'. $visit->util->getNullString( $this->filebottom ) .',
				'. $visit->util->getNullString( $this->directorioview ) .',
				'. $visit->util->getNullString( $this->parametros ) .',
				'. $visit->util->getNullString( $this->tipo );
		return $res;
	}

	function setAll($cadena) {
		$this->id = $cadena;
		$this->nombre_tabla = $cadena;
		$this->configuracion = $configuracion;
		$this->prefijo_archivos = $prefijo_archivos;
		$this->prefijo_archivos = $prefijo_archivos;
		$this->filetop = $filetop;
		$this->filebottom = $filebottom;
		$this->directorioview = $directorioview;
		$this->parametros = $parametros;
		$this->tipo = $cadena;
	}	

	function estableceCampos($arr) {
		$this->id = $arr["id"];
		$this->nombre_tabla = $arr["nombre_tabla"];
		$this->configuracion = $arr["configuracion"];
		$this->prefijo_tablas = $arr["prefijo_tablas"];
		$this->prefijo_archivos = $arr["prefijo_archivos"];
		$this->filetop = $arr["filetop"];
		$this->filebottom = $arr["filebottom"];
		$this->directorioview = $arr["directorioview"];
		$this->parametros = $arr["parametros"];
		$this->tipo = $arr["tipo"];
	}

	function tieneValorConfiguracion($valor) {
		global $visit;
		$res = false;
		if ($visit->util->perteneceLista($valor,$this->configuracion)) $res=true;
		return $res;
	}

	function esRelacion1n() {
		return $tabla->tieneValorConfiguracion("1N");
	}

	function SqlCreacion() {
		global $visit;
		$res = $visit->dbBuilder->generarSql->SqlCreacion( $this );
		return $res;
	}

	function getParametro($param) {
		$v = split("&", $this->parametros);
		$res="";
		for ($i=0;$i<count($v);$i++) {
			$pos = strlen($param)+1;
			if (substr($v[$i], 0, $pos)==$param."=") $res = substr($v[$i], $pos);
		}
		return $res;
	}

	function getNombreCls() {
		$v = split("_", $this->nombre_tabla);
		$res = "Cls";
		for ($i=0;$i<count($v); $i++) {
			$res.= strtoupper( substr($v[$i],0,1) ).substr($v[$i],1);
		}
		return $res;
	}

	function getNombreUcfirst() {
		$v = split("_", $this->nombre_tabla);		
		for ($i=0;$i<count($v); $i++) {
			$res.= strtoupper( substr($v[$i],0,1) ).substr($v[$i],1);
		}
		return $res;
	}

	function getNombreFuncionListado() {
		$v = split("_", $this->nombre_tabla);
		$res = "get";
		for ($i=0;$i<count($v); $i++) {
			$res.= strtoupper( substr($v[$i],0,1) ).substr($v[$i],1);
		}
		return $res;
	}

	function getNombreFuncionListadoLimit() {
		return $this->getNombreFuncionListado()."Limit";
	}

	function getNombreFuncionListadoCount() {
		return $this->getNombreFuncionListado()."Count";
	}

	function getNombreVariable() {
		$v = split("_", $this->nombre_tabla);
		$res = "";
		for ($i=0;$i<count($v); $i++) {
			if ($i==0) $res.= $v[$i];
			else $res.= strtoupper( substr($v[$i],0,1) ).substr($v[$i],1);
		}
		return $res;
	}

	function getNombreTablaEstaticos() {
		return $this->getTablaName()."_estaticos";
	}

	function getNombreBox() {
		return "box_".$this->nombre_tabla.".php";
	}

	function getNombreFuncionId() {
		$v = split("_", $this->nombre_tabla);
		$res = "get";
		for ($i=0;$i<count($v); $i++) {
			$res.= strtoupper( substr($v[$i],0,1) ).substr($v[$i],1);
		}
		$res.="Id";
		return $res;
	}

	function getNombreFuncionFrom($from) {
		$v = split("_", $this->nombre_tabla);
		$res = "get";
		for ($i=0;$i<count($v); $i++) {
			$res.= strtoupper( substr($v[$i],0,1) ).substr($v[$i],1);
		}
		$res.="From".$from;
		return $res;
	}

	function getNombreArchivo() {
		return $this->nombre_tabla;
	}

	function getTablaName() {
		return $this->prefijo_tablas . $this->nombre_tabla;
	}

	function getNombreTablaTexto() {
		return $this->nombre_tabla;
	}

	function getNombreArchivoListado() {
		return $this->prefijo_archivos."ls_".$this->nombre_tabla.".php";
	}

	function getNombreArchivoPopup() {
		return $this->prefijo_archivos."form_".$this->nombre_tabla.".php";
	}	

	function getNombreArchivoIncLsEne() {
		return "inc_".$this->prefijo_archivos."ls_".$this->nombre_tabla.".php";
	}

	function getNombreArchivoIncPopupEne() {
		return "inc_".$this->prefijo_archivos."popup_".$this->nombre_tabla.".php";
	}	

	function getNombreArchivoView() {
		return $this->prefijo_archivos."view_".$this->nombre_tabla.".php";
	}	

	function getNombreArchivoArbolCategoria() {
		return $this->prefijo_archivos."cat_".$this->nombre_tabla.".php";
	}	

	//Dada la tabla actual y una nueva tabla (con el campo auxiliar posicion)
	function SqlActualizacionFrom($tablaNueva) {
		global $visit;

		$sql ="";
		$valores = array();
		//Creo un array con los campos 0..n-1 son los que existian antes. del n-1 ... X son los nuevos.

		//var_dump($this->campos);
		
		//Miro el último elemento de posición creado  
		$posicionMaxima = $tablaNueva->campos[count($tablaNueva->campos)-1]->posicion;
		if ($posicionMaxima<count($this->campos)) $posicionMaxima = count($this->campos);
		for ($i=0;$i<$posicionMaxima; $i++) {
			//Si era un elemento existente
			print "<br>\n".$i ."--". count ($this->campos) ;
			if ($i<count ($this->campos) ) {
				//Busco si esa posición está en el nuevo que hemos creado. Si no está es que lo hemos borrado
				$posEncontrado=-1;
				for($j=0;$j<count($tablaNueva->campos); $j++) {
					if ( $tablaNueva->campos[$j]->posicion == $i+1 ) {
						$posEncontrado=$j;
					}
				}
				//Si existe miro si ha cambiado el nombre
				if ($posEncontrado>=0) {
					$valores[$i]="="; //Actualizo
					if ($tablaNueva->campos[$posEncontrado]->getNombreCampoBD() != $this->campos[$i]->getNombreCampoBD()) $valores[$i]="A"; //Actualizo
					if ($tablaNueva->campos[$posEncontrado]->tipo != $this->campos[$i]->tipo) $valores[$i]="A"; //Actualizo

					if ($valores[$i]=="A") {
						$sql.=", CHANGE COLUMN `" . $this->campos[$i]->getNombreCampoBD(). "` `". $tablaNueva->campos[$posEncontrado]->getNombreCampoBD() . "` ". $tablaNueva->campos[$posEncontrado]->getTipoDatos();
					}
				} else {
					//Elimino	
					$valores[$i]="E";
					$sql.=", DROP COLUMN `" . $this->campos[$i]->getNombreCampoBD(). "`";
				}
			} else {
				//Si existe esta posicion nueva, creo el campo nuevo
				$posEncontrado=-1;
				for($j=0;$j<count($tablaNueva->campos); $j++) {
					if ( $tablaNueva->campos[$j]->posicion == $i+1 ) {
						$posEncontrado=$j;
					}
				}
				if ($posEncontrado>=0) {
					$valores[$i]="C";
					$sql.=", ADD COLUMN `". $tablaNueva->campos[$posEncontrado]->getNombreCampoBD() . "` ". $tablaNueva->campos[$posEncontrado]->getTipoDatos();
				} else {
					$valores[$i]="";
				}
			}
		}
		if ($visit->dbBuilder->generarSql->getTipo()=="access") {
			$vsql = split(",",substr($sql,1));
			for ($i=0;$i<count($vsql);$i++) {
				if ($vsql[$i]!="") $vsql[$i] = "ALTER TABLE ". $this->getTablaName() ." " . $vsql[$i];
			}
		} else {
			if ($sql!="") $sql = "ALTER TABLE ". $this->getTablaName() ." " . substr($sql,1);
			$vsql[0] = $sql;
		}
		return $vsql;
	}


}

?>