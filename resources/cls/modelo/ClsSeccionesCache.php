<?
class ClsSeccionesCache{
	var $ruta_cache;

	function ClsSeccionesCache(){
		$this->ruta_cache = dirname(__FILE__)."/cache";
	}

	function newInstance() {
		return new ClsSeccionesCache();
	}

	static function getSeccionesSuperior($rol){
		$obj = new ClsSeccionesCache();
		if(!$obj->existeCache($rol)){
			print $obj->regeneraCache($rol);
		}else{
			readfile($obj->ruta_cache."/menu_superior".$rol.".html");
		}
	}

	static function getSeccionesIzqda($rol){
		$obj = new ClsSeccionesCache();
		if(!$obj->existeCache($rol)){
			print $obj->regeneraCache($rol);
		}else{
			readfile($obj->ruta_cache."/menu_izqda".$rol.".html");
		}
	}

	

	function regeneraCache($rol){
		global $visit;

		$prefijo = "/../../../view";

		include(dirname(__FILE__).$prefijo."/inc_secciones_logica.php");
		file_put_contents ($this->ruta_cache."/menu_cache".$rol.".check",date('YmdHis'));
		ob_start();
		include(dirname(__FILE__).$prefijo."/inc_secciones_superior.php");
		$secciones = ob_get_contents();
		ob_end_clean();
		ob_start();
		include(dirname(__FILE__).$prefijo."/inc_secciones_izqda.php");
		$secciones_izda = ob_get_contents();
		ob_end_clean();
		file_put_contents ( $this->ruta_cache."/menu_superior".$rol.".html" , $secciones);
		file_put_contents ( $this->ruta_cache."/menu_izqda".$rol.".html" , $secciones_izda);

		return $secciones;
	}

	function existeCache($rol){
		$res = false;
		$file = $this->ruta_cache."/menu_cache".$rol.".check";
		$file_menu = $this->ruta_cache."/menu_superior".$rol.".html";
		$file_menu_izda = $this->ruta_cache."/menu_izqda".$rol.".html";

		if (file_exists($file) && filesize($file_menu)>0 && filesize($file_menu_izda)>0) {
			$res = true;
		}
		return $res;
	}

	static function eliminaCache(){
		global $visit;

		$obj = new ClsSeccionesCache();
		$user = new ClsUsuarios();
		$roles = $user->getValoresRol();

		unlink( $obj->ruta_cache."/menu_cache.check");
		foreach ($roles as $clave => $valor) {
			unlink( $obj->ruta_cache."/menu_cache".$clave.".check");
		}
	}
}?>