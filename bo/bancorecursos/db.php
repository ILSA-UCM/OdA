<?
	function &getTablaFiltradaRuta($objeto) {
		global $visit;
		$strWhere =" WHERE ruta = '". $objeto->ruta."'";
		$sql ="SELECT ". $objeto->getCampos() ." FROM ". $objeto->getNombreTabla() . $strWhere;
		$visit->debuger->out("getTablaFiltradaRuta: ". $objeto->getNombreTabla() ."-: $sql");
		$collection = $visit->dbBuilder->execSQL( $sql, $objeto );
		if (count($collection)<=0) $res = "";
		else $res = $collection[0];
		return $res;
	}
?>