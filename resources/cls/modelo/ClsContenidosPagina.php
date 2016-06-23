<?
class ClsContenidosPagina extends ClsModelo {
	// Modificado getValoresTipo () y request2bbdd
	var $id, $idpagina, $tipo, $imagen, $imagen2, $contenido, $contenido2, $orden, $titulo, $titulo2;

	function getNombreTabla() {
		return "contenidos_pagina";
	}

	function getCamposUpdate() {
		return "idpagina, tipo, imagen, contenido, orden";
	}

	var $_orderby="idpagina, orden, imagen, tipo, id";

	function getOrderBy() {
		$res = $this->_orderby;
		return $res;
	}

	function getValoresUpdate() {
		global $visit;
		$res =	"idpagina= ". $visit->util->getNullInteger( $this->idpagina ) .",
				tipo= ". $visit->util->getNullString( $this->tipo ) .",
				imagen= ". $visit->util->getNullString( $this->imagen ) .",
				contenido= ". $visit->util->getNullString( $this->contenido ) .",
				orden= ". $visit->util->getNullInteger( $this->orden ) ;
				
		return $res;
	}

	function getValoresInsert() {
		global $visit;
		$res =	$visit->util->getNullInteger( $this->idpagina ) .",".
				$visit->util->getNullString( $this->tipo ) .",".
				$visit->util->getNullString( $this->imagen ) .",".
				$visit->util->getNullString( $this->contenido ) .",".
				$visit->util->getNullInteger( $this->orden ) ;
				
		return $res;
	}

	function construyeCadenaFiltro() {
		global $visit;
		$res ="";
		$res = $this->getSQLBusqueda( "idpagina", $this->idpagina, $res);
		$res = $this->getSQLBusqueda( "tipo", $this->tipo, $res);
		$res = $this->getSQLFiltro( "imagen", $this->imagen, $res);
		$res = $this->getSQLFiltro( "contenido", $this->contenido, $res);
		$res = $this->getSQLBusqueda( "orden", $this->orden, $res);
		
		return $res;
	}

	function newInstance() {
		return new ClsContenidosPagina();
	}

	/*
	 * Te devuelve un objeto Array con todos los campos.
	 */
	function getArrayCampos() {
		$arr = array(
			"id"=>$this->id,
			"idpagina"=>$this->idpagina,
			"tipo"=>$this->tipo,
			"imagen"=>$this->imagen,
			"contenido"=>$this->contenido,
			"orden"=>$this->orden,
		);
		return $arr;
	}

	function setAll($cadena) {
		$this->id = $cadena;
		$this->idpagina = $cadena;
		$this->tipo = $cadena;
		$this->imagen = $cadena;
		$this->contenido = $cadena;
		$this->orden = $cadena;
	}	

	function estableceCampo($key,$valor,$prefix) {
		if ($key==$prefix."id") $this->id = $valor;
		else if ($key==$prefix."idpagina") $this->idpagina = $valor;
		else if ($key==$prefix."tipo") $this->tipo = $valor;
		else if ($key==$prefix."imagen") $this->imagen = $valor;
		else if ($key==$prefix."contenido") $this->contenido = $valor;
		else if ($key==$prefix."orden") $this->orden = $valor;
	} 
	
	function getValoresTipo() {
		global $prefs;
		$arr = array();
		if ($prefs["creacion_paginas_imagen"]=='1') $arr["1"]="Imagen";
		if ($prefs["creacion_paginas_texto"]=='1') $arr["2"]="Texto";
		return $arr;
	}
	function getValorTipo() {
		$arr = $this->getValoresTipo();
		$valor = $arr[$this->tipo];
		return $valor;
	}
	
	function request2bbdd($arr,$prefix=""){
	  global $visit, $_FILES;
	   /*$imagen = $prefix."imagen";
	   
	   if ($_FILES[$imagen]["size"]>0) {
			
		$downloadHttpPrefix = "../../download/paginas/";
		$visit->util->descargaArchivo($_FILES[$imagen], getcwd()."/".$downloadHttpPrefix );
		$this->imagen= $downloadHttpPrefix. $_FILES[$imagen]["name"];
	   }else{
		$imagen = $prefix."imagen_ubicacion";
		$this->imagen= $arr[$imagen] ;
	 
	   }

	   $imagen2 = $prefix."imagen2";
	   
	   if ($_FILES[$imagen2]["size"]>0) {
			
			$downloadHttpPrefix = "../../download/paginas/";
			$visit->util->descargaArchivo($_FILES[$imagen2], getcwd()."/".$downloadHttpPrefix );
			$this->imagen2= $downloadHttpPrefix. $_FILES[$imagen2]["name"];
	   }else{
			$imagen2 = $prefix."imagen2_ubicacion";
			$this->imagen2= $arr[$imagen2] ;
	 
	   }*/

	   $imagen = $prefix."imagen";
	   
	   if ( $arr[$imagen]!="") {
		$this->imagen= $arr[$imagen];
	   }else{
		$imagen = $prefix."imagen_ubicacion";
		$this->imagen= $arr[$imagen] ;
	 
	   }

		/*
	   $imagen2 = $prefix."imagen2";
	   
	   if ( $arr[$imagen2]!="") {
			$this->imagen2= $arr[$imagen2];
	   }else{
			$imagen2 = $prefix."imagen2_ubicacion";
			$this->imagen2= $arr[$imagen2] ;
	 
	   }
	   */
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