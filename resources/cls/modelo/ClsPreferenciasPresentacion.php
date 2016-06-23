<?
class ClsPreferenciasPresentacion extends ClsModelo {
	var $id, $atributo, $valor, $tipo, $etiqueta, $orden, $formato;

	function getNombreTabla() {
		return "preferencias_presentacion";
	}

	function getCamposUpdate() {
		return "atributo, valor, tipo, etiqueta, orden, formato";
	}

	var $_orderby="atributo, etiqueta, formato, orden, tipo, valor, id";

	function getOrderBy() {
		$res = $this->_orderby;
		return $res;
	}

	function getValoresUpdate() {
		global $visit;
		$res =	"atributo= ". $visit->util->getNullString( $this->atributo ) .",
				valor= ". $visit->util->getNullString( $this->valor ) .",
				tipo= ". $visit->util->getNullString( $this->tipo ) .",
				etiqueta= ". $visit->util->getNullString( $this->etiqueta ) .",
				orden= ". $visit->util->getNullInteger( $this->orden ) .",
				formato= ". $visit->util->getNullString( $this->formato );
				
		return $res;
	}

	function getValoresInsert() {
		global $visit;
		$res =	$visit->util->getNullString( $this->atributo ) .",".
				$visit->util->getNullString( $this->valor ) .",".
				$visit->util->getNullString( $this->tipo ) .",".
				$visit->util->getNullString( $this->etiqueta ) .",".
				$visit->util->getNullInteger( $this->orden ) .",".
				$visit->util->getNullString( $this->formato );
				
		return $res;
	}

	function construyeCadenaFiltro() {
		global $visit;
		$res ="";
		$res = $this->getSQLFiltro( "atributo", $this->atributo, $res);
		$res = $this->getSQLFiltro( "valor", $this->valor, $res);
		$res = $this->getSQLFiltro( "tipo", $this->tipo, $res);
		$res = $this->getSQLFiltro( "etiqueta", $this->etiqueta, $res);
		$res = $this->getSQLBusqueda( "orden", $this->orden, $res);
		$res = $this->getSQLFiltro( "formato", $this->formato, $res);
		
		return $res;
	}

	function newInstance() {
		return new ClsPreferenciasPresentacion();
	}

	/*
	 * Te devuelve un objeto Array con todos los campos.
	 */
	function getArrayCampos() {
		$arr = array(
			"id"=>$this->id,
			"atributo"=>$this->atributo,
			"valor"=>$this->valor,
			"tipo"=>$this->tipo,
			"etiqueta"=>$this->etiqueta,
			"orden"=>$this->orden,
			"formato"=>$this->formato
		);
		return $arr;
	}

	function setAll($cadena) {
		$this->id = $cadena;
		$this->atributo = $cadena;
		$this->valor = $cadena;
		$this->tipo = $cadena;
		$this->etiqueta = $cadena;
		$this->orden = $cadena;
		$this->formato = $cadena;
	}	

	function estableceCampo($key,$valor,$prefix) {
		if ($key==$prefix."id") $this->id = $valor;
		else if ($key==$prefix."atributo") $this->atributo = $valor;
		else if ($key==$prefix."valor") $this->valor = $valor;
		else if ($key==$prefix."tipo") $this->tipo = $valor;
		else if ($key==$prefix."etiqueta") $this->etiqueta = $valor;
		else if ($key==$prefix."orden") $this->orden = $valor;
		else if ($key==$prefix."formato") $this->formato = $valor;
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
	

	function getValoresNoticiasDestacadas() {
		$arr = array();
		$arr["1"]="Men� Izquierda";
		$arr["2"]="Men� Centro";
		$arr["3"]="Men� Derecha";
		return $arr;
	}

	function getValoresTarifaAplicable() {
		$arr = array();
		$arr["1"]="Por Pa�s";
		$arr["2"]="Por Usuario";
		return $arr;
	}

	function getValoresPresentacionSecciones(){
		$arr = array();
		$arr["S"]="Plegado";
		$arr["N"]="Desplegado";
		return $arr;
	}

	function getValoresPresentacionNavegacion(){
		$arr = array();
		$arr["S"]="Plegado";
		$arr["N"]="Desplegado";
		return $arr;
	}
	function getValoresAplicableGastosEnvio(){
		$arr = array();
		$arr["S"]="Si";
		$arr["N"]="No";
		return $arr;
	}

	function getMarcasMostrar(){
		$arr = array();
		$arr["S"]="Si";
		$arr["N"]="No";
		return $arr;
	}


	function getValoresNotificacion(){
		$arr = array();
		$arr["S"]="Si";
		$arr["N"]="No";
		return $arr;
	}

	function getValoresTipoPortada(){
		$arr = array();
		$arr["F"]="Flash";
		$arr["I"]="Im�genes";
		return $arr;
	}
	
	//elimina una cadena de caracteres de la variable $this->valor
	function eliminaStringValor($str){
		$res ="";
		$arrValor = array();
		$arrValor = split($this->valor, ";");
		foreach($arrValor as $key => $value)
		{
			if($value != $str)		{
				if($res == "") $res=$value;
				else
				{
					$res.=";".$value;
				}
			}
		}	
		$this->valor = $res;
	}
	
	//comprueba que no se repita la cadena de caracteres dentro de la variable $this->valor
	function hayStringValor($str){
		$arrValor = array();
		$arrValor = split($this->valor, ";");
		foreach($arrValor as $key => $value)
		{
			if($value == $str) return TRUE;
		
		}
		return FALSE;
	}
// COMANAGER 1.0: Fin Codigo personalizado

}
?>