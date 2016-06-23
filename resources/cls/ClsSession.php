<?

class ClsSession {
	var $roles
		, $idusuario
		, $cart
		, $idpaisentrega
		, $idtabla;  //Para guardar el id de la tabla donde se guarda esta sesión

	function ClsSession() {
		$this->init();
	}

	function init() {
		$this->idusuario="";
		$this->roles="";
	}

}


?>