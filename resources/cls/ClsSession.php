<?

class ClsSession {
	var $roles
		, $idusuario
		, $cart
		, $idpaisentrega
		, $idtabla;  //Para guardar el id de la tabla donde se guarda esta sesi�n

	function ClsSession() {
		$this->init();
	}

	function init() {
		$this->idusuario="";
		$this->roles="";
	}

}


?>