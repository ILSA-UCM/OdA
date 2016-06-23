<?

	function conf($atributo,$lang="") {
		global $visit;
		$res = "";
		$res = $visit->dbBuilder->getValorPreferenciaFromAtributo($atributo,$lang);
		return $res;
	}



?>