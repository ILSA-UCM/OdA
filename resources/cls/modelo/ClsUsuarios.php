<?
class ClsUsuarios extends ClsModelo {
	var $id, $nombre, $apellidos, $correo, $login, $password, $rol, $ultimo_acceso ;

	function getNombreTabla() {
		return "usuarios";
	}

	function getCamposUpdate() {
		return "nombre, apellidos, correo, login, password, rol, ultimo_acceso";
	}

	var $_orderby="apellidos, correo, login, nombre, password, rol, ultimo_acceso, id";

	function getOrderBy() {
		$res = $this->_orderby;
		return $res;
	}

	function getValoresUpdate() {
		global $visit;
		$res =	"nombre= ". $visit->util->getNullString( $this->nombre ) .",
				apellidos= ". $visit->util->getNullString( $this->apellidos ) .",
				correo= ". $visit->util->getNullString( $this->correo ) .",
				login= ". $visit->util->getNullString( $this->login ) .",
				password= ". $visit->util->getNullString( $this->password ) .",
				rol= ". $visit->util->getNullString( $this->rol ) .",
				ultimo_acceso= ". $visit->util->getNullString( $this->ultimo_acceso );
				
		return $res;
	}

	function getValoresInsert() {
		global $visit;
		$res =	$visit->util->getNullString( $this->nombre ) .",".
				$visit->util->getNullString( $this->apellidos ) .",".
				$visit->util->getNullString( $this->correo ) .",".
				$visit->util->getNullString( $this->login ) .",".
				$visit->util->getNullString( $this->password ) .",".
				$visit->util->getNullString( $this->rol ) .",".
				$visit->util->getNullString( $this->ultimo_acceso );
				
		return $res;
	}

	function construyeCadenaFiltro() {
		global $visit;
		$res ="";
		$res = $this->getSQLFiltro( "nombre", $this->nombre, $res);
		$res = $this->getSQLFiltro( "apellidos", $this->apellidos, $res);
		$res = $this->getSQLFiltro( "correo", $this->correo, $res);
		$res = $this->getSQLBusqueda( "login", $this->login, $res);
		$res = $this->getSQLFiltro( "password", $this->password, $res);
		$res = $this->getSQLBusqueda( "rol", $this->rol, $res);
		$res = $this->getSQLBusqueda( "ultimo_acceso", $this->ultimo_acceso, $res);

		return $res;
	}

	function newInstance() {
		return new ClsUsuarios();
	}

	/*
	 * Te devuelve un objeto Array con todos los campos.
	 */
	function getArrayCampos() {
		$arr = array(
			"id"=>$this->id,
			"nombre"=>$this->nombre,
			"apellidos"=>$this->apellidos,
			"correo"=>$this->correo,
			"login"=>$this->login,
			"password"=>$this->password,
			"rol"=>$this->rol,
			"ultimo_acceso"=>$this->ultimo_acceso
		);
		return $arr;
	}

	function setAll($cadena) {
		$this->id = $cadena;
		$this->nombre = $cadena;
		$this->apellidos = $cadena;
		$this->correo = $cadena;
		$this->login = $cadena;
		$this->password = $cadena;
		$this->rol = $cadena;
		$this->ultimo_acceso = $cadena;
	}	

	function estableceCampo($key,$valor,$prefix) {
		if ($key==$prefix."id") $this->id = $valor;
		else if ($key==$prefix."nombre") $this->nombre = $valor;
		else if ($key==$prefix."apellidos") $this->apellidos = $valor;
		else if ($key==$prefix."correo") $this->correo = $valor;
		else if ($key==$prefix."login") $this->login = $valor;
		else if ($key==$prefix."password") $this->password = $valor;
		else if ($key==$prefix."rol") $this->rol = $valor;
		else if ($key==$prefix."ultimo_acceso") $this->ultimo_acceso = $valor;
	} 
	
	function getValoresRol() {
		$arr = array();
		$arr["A"]="Superadministrador";
		$arr["B"]="Administrador";
		$arr["C"]="Usuario";
		return $arr;
	}
	function getValorRol() {
		$arr = $this->getValoresRol();
		$valor = $arr[$this->rol];
		return $valor;
	}
	function getValorUltimoAcceso() {
		global $visit;
		$valor = $this->ultimo_acceso;
		$valor = $visit->util->bbdd2datetime($valor);
		return $valor;
	}
	function request2bbdd() {
		global $visit;
	}
	//actualizamos el campo ultimo_acceso de bd
	function actualizaUltimoAcceso(){
		global $visit;

		$this->ultimo_acceso = date("YmdHis");

		$sql = "UPDATE ".$this->getNombreTabla()." SET ultimo_acceso = ".$this->ultimo_acceso." WHERE id=".$this->id;
		
		$visit->dbBuilder->conn->Execute($sql);
	}

// COMANAGER 1.0: Codigo personalizado
	function esRolSuperadmin() {
		$res=false;
		if ($this->rol=="A") $res = true;
		return $res;
	}
	
	function esRolAdmin() {
		$res=false;
		if ($this->rol=="B") $res = true;
		return $res;
	}
	
	function esRolUsuario() {
		$res=false;
		if ($this->rol=="C") $res = true;
		return $res;
	}
	
	function construyeCadenaFiltroBusqueda(){
		global $visit;
		$res ="";
		$res = $this->getSQLFiltro( "apellidos", $this->apellidos, $res);
		$res = $this->getSQLFiltro( "nombre", $this->nombre, $res);
		$res = $this->getSQLFiltro( "rol", $this->rol, $res);
		return $res;
	} 

	function puedeRegenerarNav(){
		return $this->esRolAdmin() || $this->esRolSuperadmin();
	}
// COMANAGER 1.0: Fin Codigo personalizado

}
?>