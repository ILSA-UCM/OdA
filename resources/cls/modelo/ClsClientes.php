<?
class ClsClientes extends ClsModelo {
	var $id, $codigo, $correo, $clave, $nombre, $apellidos, $dni, $cli_direccion, $cli_numero, $cli_tiene_num, $cli_piso, $cli_localidad, $cli_provincia, $cli_cod_postal, $cli_pais, $telefono1, $telefono2, $boletin, $tarifa, $nosconoce_por, $catalogo, $cli_id_provincia, $descuento, $fecha_alta, $es_superadmin;

	function getNombreTabla() {
		return "clientes";
	}

	function getCamposUpdate() {
		return "codigo, correo, clave, nombre, apellidos, dni, cli_direccion, cli_numero, cli_tiene_num, cli_piso, cli_localidad, cli_provincia, cli_cod_postal, cli_pais, telefono1, telefono2, boletin, tarifa, nosconoce_por, catalogo, cli_id_provincia, descuento, fecha_alta, es_superadmin";
	}

	var $_orderby="codigo, apellidos, boletin, catalogo, clave, cli_cod_postal, cli_direccion, cli_id_provincia, cli_localidad, cli_numero, cli_pais, cli_piso, cli_provincia, cli_tiene_num, correo, descuento, dni, es_superadmin, fecha_alta, nombre, nosconoce_por, tarifa, telefono1, telefono2, id";

	function getOrderBy() {
		$res = $this->_orderby;
		return $res;
	}

	function getValoresUpdate() {
		global $visit;
		$res =	"codigo= ". $visit->util->getNullString( $this->codigo ) .",
				correo= ". $visit->util->getNullString( $this->correo ) .",
				clave= ". $visit->util->getNullString( $this->clave ) .",
				nombre= ". $visit->util->getNullString( $this->nombre ) .",
				apellidos= ". $visit->util->getNullString( $this->apellidos ) .",
				dni= ". $visit->util->getNullString( $this->dni ) .",
				cli_direccion= ". $visit->util->getNullString( $this->cli_direccion ) .",
				cli_numero= ". $visit->util->getNullString( $this->cli_numero ) .",
				cli_tiene_num= ". $visit->util->getNullString( $this->cli_tiene_num ) .",
				cli_piso= ". $visit->util->getNullString( $this->cli_piso ) .",
				cli_localidad= ". $visit->util->getNullString( $this->cli_localidad ) .",
				cli_provincia= ". $visit->util->getNullString( $this->cli_provincia ) .",
				cli_cod_postal= ". $visit->util->getNullString( $this->cli_cod_postal ) .",
				cli_pais= ". $visit->util->getNullString( $this->cli_pais ) .",
				telefono1= ". $visit->util->getNullString( $this->telefono1 ) .",
				telefono2= ". $visit->util->getNullString( $this->telefono2 ) .",
				boletin= ". $visit->util->getNullString( $this->boletin ) .",
				tarifa= ". $visit->util->getNullInteger( $this->tarifa ) .",
				nosconoce_por= ". $visit->util->getNullString( $this->nosconoce_por ) .",
				catalogo= ". $visit->util->getNullString( $this->catalogo ) .",
				cli_id_provincia= ". $visit->util->getNullString( $this->cli_id_provincia ) .",
				descuento= ". $visit->util->getNullInteger( $this->descuento ) .",
				fecha_alta= ". $visit->util->getNullString( $this->fecha_alta ) .",
				es_superadmin= ". $visit->util->getNullString( $this->es_superadmin );
				
		return $res;
	}

	function getValoresInsert() {
		global $visit;
		$res =	$visit->util->getNullString( $this->codigo ) .",".
				$visit->util->getNullString( $this->correo ) .",".
				$visit->util->getNullString( $this->clave ) .",".
				$visit->util->getNullString( $this->nombre ) .",".
				$visit->util->getNullString( $this->apellidos ) .",".
				$visit->util->getNullString( $this->dni ) .",".
				$visit->util->getNullString( $this->cli_direccion ) .",".
				$visit->util->getNullString( $this->cli_numero ) .",".
				$visit->util->getNullString( $this->cli_tiene_num ) .",".
				$visit->util->getNullString( $this->cli_piso ) .",".
				$visit->util->getNullString( $this->cli_localidad ) .",".
				$visit->util->getNullString( $this->cli_provincia ) .",".
				$visit->util->getNullString( $this->cli_cod_postal ) .",".
				$visit->util->getNullString( $this->cli_pais ) .",".
				$visit->util->getNullString( $this->telefono1 ) .",".
				$visit->util->getNullString( $this->telefono2 ) .",".
				$visit->util->getNullString( $this->boletin ) .",".
				$visit->util->getNullInteger( $this->tarifa ) .",".
				$visit->util->getNullString( $this->nosconoce_por ) .",".
				$visit->util->getNullString( $this->catalogo ) .",".
				$visit->util->getNullString( $this->cli_id_provincia ) .",".
				$visit->util->getNullInteger( $this->descuento ) .",".
				$visit->util->getNullString( $this->fecha_alta ) .",".
				$visit->util->getNullString( $this->es_superadmin );
				
		return $res;
	}

	function construyeCadenaFiltro() {
		global $visit;
		$res ="";
		$res = $this->getSQLFiltro( "codigo", $this->codigo, $res);
		$res = $this->getSQLFiltro( "correo", $this->correo, $res);
		$res = $this->getSQLFiltro( "clave", $this->clave, $res);
		$res = $this->getSQLFiltro( "nombre", $this->nombre, $res);
		$res = $this->getSQLFiltro( "apellidos", $this->apellidos, $res);
		$res = $this->getSQLFiltro( "dni", $this->dni, $res);
		$res = $this->getSQLFiltro( "cli_direccion", $this->cli_direccion, $res);
		$res = $this->getSQLFiltro( "cli_numero", $this->cli_numero, $res);
		$res = $this->getSQLBusqueda( "cli_tiene_num", $this->cli_tiene_num, $res);
		$res = $this->getSQLFiltro( "cli_piso", $this->cli_piso, $res);
		$res = $this->getSQLFiltro( "cli_localidad", $this->cli_localidad, $res);
		$res = $this->getSQLFiltro( "cli_provincia", $this->cli_provincia, $res);
		$res = $this->getSQLFiltro( "cli_cod_postal", $this->cli_cod_postal, $res);
		$res = $this->getSQLBusqueda( "cli_pais", $this->cli_pais, $res);
		$res = $this->getSQLFiltro( "telefono1", $this->telefono1, $res);
		$res = $this->getSQLFiltro( "telefono2", $this->telefono2, $res);
		$res = $this->getSQLBusqueda( "boletin", $this->boletin, $res);
		$res = $this->getSQLBusqueda( "tarifa", $this->tarifa, $res);
		$res = $this->getSQLFiltro( "nosconoce_por", $this->nosconoce_por, $res);
		$res = $this->getSQLBusqueda( "catalogo", $this->catalogo, $res);
		$res = $this->getSQLBusqueda( "cli_id_provincia", $this->cli_id_provincia, $res);//
		$res = $this->getSQLBusqueda( "descuento", $this->descuento, $res);
		$res = $this->getSQLBusqueda( "fecha_alta", $this->fecha_alta, $res);
		$res = $this->getSQLBusqueda( "es_superadmin", $this->es_superadmin, $res);
		
		return $res;
	}

	function newInstance() {
		return new ClsClientes();
	}

	/*
	 * Te devuelve un objeto Array con todos los campos.
	 */
	function getArrayCampos() {
		$arr = array(
			"id"=>$this->id,
			"codigo"=>$this->codigo,
			"correo"=>$this->correo,
			"clave"=>$this->clave,
			"nombre"=>$this->nombre,
			"apellidos"=>$this->apellidos,
			"dni"=>$this->dni,
			"cli_direccion"=>$this->cli_direccion,
			"cli_numero"=>$this->cli_numero,
			"cli_tiene_num"=>$this->cli_tiene_num,
			"cli_piso"=>$this->cli_piso,
			"cli_localidad"=>$this->cli_localidad,
			"cli_provincia"=>$this->cli_provincia,
			"cli_cod_postal"=>$this->cli_cod_postal,
			"cli_pais"=>$this->cli_pais,
			"telefono1"=>$this->telefono1,
			"telefono2"=>$this->telefono2,
			"boletin"=>$this->boletin,
			"tarifa"=>$this->tarifa,
			"nosconoce_por"=>$this->nosconoce_por,
			"catalogo"=>$this->catalogo,
			"cli_id_provincia"=>$this->cli_id_provincia,
			"descuento"=>$this->descuento,
			"fecha_alta"=>$this->fecha_alta,
			"es_superadmin"=>$this->es_superadmin
		);
		return $arr;
	}

	function setAll($cadena) {
		$this->id = $cadena;
		$this->codigo = $cadena;
		$this->correo = $cadena;
		$this->clave = $cadena;
		$this->nombre = $cadena;
		$this->apellidos = $cadena;
		$this->dni = $cadena;
		$this->cli_direccion = $cadena;
		$this->cli_numero = $cadena;
		$this->cli_tiene_num = $cadena;
		$this->cli_piso = $cadena;
		$this->cli_localidad = $cadena;
		$this->cli_provincia = $cadena;
		$this->cli_cod_postal = $cadena;
		$this->cli_pais = $cadena;
		$this->telefono1 = $cadena;
		$this->telefono2 = $cadena;
		$this->boletin = $cadena;
		$this->tarifa = $cadena;
		$this->nosconoce_por = $cadena;
		$this->catalogo = $cadena;
		$this->cli_id_provincia = $cadena;
		$this->descuento = $cadena;
		$this->fecha_alta = $cadena;
		$this->es_superadmin = $cadena;
	}	

	function estableceCampo($key,$valor,$prefix) {
		if ($key==$prefix."id") $this->id = $valor;
		else if ($key==$prefix."codigo") $this->codigo = $valor;
		else if ($key==$prefix."correo") $this->correo = $valor;
		else if ($key==$prefix."clave") $this->clave = $valor;
		else if ($key==$prefix."nombre") $this->nombre = $valor;
		else if ($key==$prefix."apellidos") $this->apellidos = $valor;
		else if ($key==$prefix."dni") $this->dni = $valor;
		else if ($key==$prefix."cli_direccion") $this->cli_direccion = $valor;
		else if ($key==$prefix."cli_numero") $this->cli_numero = $valor;
		else if ($key==$prefix."cli_tiene_num") $this->cli_tiene_num = $valor;
		else if ($key==$prefix."cli_piso") $this->cli_piso = $valor;
		else if ($key==$prefix."cli_localidad") $this->cli_localidad = $valor;
		else if ($key==$prefix."cli_provincia") $this->cli_provincia = $valor;
		else if ($key==$prefix."cli_cod_postal") $this->cli_cod_postal = $valor;
		else if ($key==$prefix."cli_pais") $this->cli_pais = $valor;
		else if ($key==$prefix."telefono1") $this->telefono1 = $valor;
		else if ($key==$prefix."telefono2") $this->telefono2 = $valor;
		else if ($key==$prefix."boletin") $this->boletin = $valor;
		else if ($key==$prefix."tarifa") $this->tarifa = $valor;
		else if ($key==$prefix."nosconoce_por") $this->nosconoce_por = $valor;
		else if ($key==$prefix."catalogo") $this->catalogo = $valor;
		else if ($key==$prefix."cli_id_provincia") $this->cli_id_provincia = $valor;
		else if ($key==$prefix."descuento") $this->descuento = $valor;
		else if ($key==$prefix."fecha_alta") $this->fecha_alta = $valor;
		else if ($key==$prefix."es_superadmin") $this->es_superadmin = $valor;
				// OJO!!! no lo genera el commanager
		else if ($key==$prefix."cuenta") $this->cuenta = $valor;
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
		return $visit->util->acortaCadena( $this->tipo );
	} 

	function getNombreApellidos() {
		$res = $this->nombre;
		if ($this->apellidos!="") $res.=" " . $this->apellidos;
		return $res;
	}

// COMANAGER 1.0: Fin Codigo personalizado

}
?>