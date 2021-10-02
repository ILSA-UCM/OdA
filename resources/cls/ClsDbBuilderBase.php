<?
class ClsDbBuilderBase {
	
	var $conn;
	var $visit;
	var $bdname;

	function ClsDbBuilderBase() {
	}

	function configure($mi_visit) {
		$this->visit = $mi_visit;
	}

	function configureADODB( $tipo, $dsn, $user, $password, $database) {
		ADOLoadCode($tipo);
		$this->conn=&ADONewConnection($tipo);
		$this->conn->setConnectionParameter('CharacterSet', 'UTF-8');
		$this->conn->Connect($dsn,$user,$password, $database);
		//$this->conn->PConnect($host.":".$dbname,$user,$password);		
	}	

	function configureAccess( $ruta ) {
		$this->bdname =$ruta;
		$tipo="ado_access";
		ADOLoadCode($tipo);

		$this->conn=&ADONewConnection($tipo);
		$myDSN="Provider=Microsoft.Jet.OLEDB.4.0;Persist Security Info=False;Charset=UTF8;Data Source=".$ruta;
		$this->conn->Connect($myDSN);
	}	

	function configureAccessPass( $ruta, $pass ) {
		$this->bdname =$ruta;
		$tipo="ado_access";
		ADOLoadCode($tipo);

		$this->conn=&ADONewConnection($tipo);
		$myDSN="Provider=Microsoft.Jet.OLEDB.4.0;Persist Security Info=False;Jet OLEDB:Database Password=".$pass.";Data Source=".$ruta;
		$this->conn->Connect($myDSN);
	}

	function configureFromDbBuilder( $dbBuilder ) {
		$this->conn=$dbBuilder->connection();
	}

	function connection() {
		return $this->conn;
	}	


	function execSQL($sql, $obj) {
		global $visit;
		$all = $this->conn->GetAll($sql);
		if ($all=="") {			
			$e = ADODB_Pear_Error();
			if ($e->message!="") {
				$visit->debuger->outErrorFile($e->message); 
				//exit();
			}
		}
		$collection = array();
		for ($i=0; $i<count($all); $i++) {
			$newObj = $obj->newInstance();
			$newObj->estableceCampos( $all[$i] );
			$collection[$i] = $newObj;
		}
		return $collection;
	}

	function execSQLLimit($sql, $obj, $offset, $count) {
		$rs = $this->conn->SelectLimit($sql, $count, $offset);
		$all = $rs->GetArray();
		$collection = array();
		for ($i=0; $i<count($all); $i++) {
			$newObj = $obj->newInstance();
			$newObj->estableceCampos( $all[$i] );
			$collection[$i] = $newObj;
		}
		return $collection;
	}	

	function &getTablaBusquedaGeneral($objeto, $texto) {
		$vpath = explode(" ", $texto);
		$where ="";
		for ($i=0; $i<count($vpath); $i++) {
			if ($vpath[$i]!="") {
				$objeto->setAll( $vpath[$i] );
				$res = $objeto->construyeCadenaBusquedaGeneral($res, $texto);
				if ($where!="") $where .=" AND ";
				$where .= $res;
			}
		}

		$orderBy = $objeto->getOrderBy();
		if ($where!="") $strWhere =" WHERE ". $where;
		if ($orderBy!="") $strOrderBy =" ORDER BY ". $orderBy;
		$sql ="SELECT ". $objeto->getCampos() ." FROM ". $objeto->getNombreTabla() . $strWhere . $strOrderBy;
		$this->visit->debuger->out("getTablaBusquedaGeneral: ". $objeto->getNombreTabla() ."-: $sql");
		$collection = $this->execSQL( $sql, $objeto );
		return $collection;
	}

	function &getTablaBusquedaGeneralCount($objeto, $texto) {
		$vpath = explode(" ", $texto);
		$where ="";
		for ($i=0; $i<count($vpath); $i++) {
			if ($vpath[$i]!="") {
				$objeto->setAll( $vpath[$i] );
				$res = $objeto->construyeCadenaBusquedaGeneral($res, $texto);
				if ($where!="") $where .=" AND ";
				$where .= $res;
			}
		}

		$orderBy = $objeto->getOrderBy();
		if ($where!="") $strWhere =" WHERE ". $where;		
		$sql ="SELECT COUNT(*) AS cuenta FROM ". $objeto->getNombreTabla() . $strWhere;
		$this->visit->debuger->out("getTablaBusquedaGeneralCount: ". $objeto->getNombreTabla() ."-: $sql");
		$collection = $this->conn->GetAll($sql);
		return $collection[0]["cuenta"];
	}
	
	/*Construye una SQL que permita buscar cada palabra de la cadena de busqueda en los diferentes registros */
	function &getTablaFiltrada($objeto) {
		$orderBy = $objeto->getOrderBy();
		$where = $objeto->construyeCadenaFiltro();
		if ($where!="") $strWhere =" WHERE ". $where;
		if ($orderBy!="") $strOrderBy =" ORDER BY ". $orderBy;
		$sql ="SELECT ". $objeto->getCampos() ." FROM ". $objeto->getNombreTabla() . $strWhere . $strOrderBy;
		$this->visit->debuger->out("getTablaFiltrada: ". $objeto->getNombreTabla() ."-: $sql");
		$collection = $this->execSQL( $sql, $objeto );
		return $collection;
	}

	/*Construye una SQL que permita buscar cada palabra de la cadena de busqueda en los diferentes registros */
	function &getTablaFiltradaFromIds($objeto, $nombreCampoId, $strIds) {
		if ($strIds!="") {
			$orderBy = $objeto->getOrderBy();
			$strWhere =" WHERE ".$nombreCampoId." IN (".$strIds.")";
			if ($orderBy!="") $strOrderBy =" ORDER BY ". $orderBy;
			$sql ="SELECT ". $objeto->getCampos() ." FROM ". $objeto->getNombreTabla() . $strWhere . $strOrderBy;
			$this->visit->debuger->out("getTablaFiltradaFromIds: ". $objeto->getNombreTabla() ."-: $sql");
			$collection = $this->execSQL( $sql, $objeto );
		} else {
			$collection =array();
		}
		return $collection;
	}


	function &getTablaFiltradaFromIdsLang($objeto, $nombreCampoId, $strIds, $lang) {
		if ($strIds!="") {
			$orderBy = $objeto->getOrderBy();
			$strWhere =" WHERE ".$nombreCampoId." IN (".$strIds.") AND lang ='".$lang."'";
			if ($orderBy!="") $strOrderBy =" ORDER BY ". $orderBy;
			$sql ="SELECT ". $objeto->getCampos() ." FROM ". $objeto->getNombreTabla() . $strWhere . $strOrderBy;
			$this->visit->debuger->out("getTablaFiltradaFromIds: ". $objeto->getNombreTabla() ."-: $sql");
			$collection = $this->execSQL( $sql, $objeto );
		} else {
			$collection =array();
		}
		return $collection;
	}

	function getSqlBusqueda($objeto, $texto) {
		$vpath = explode(" ", $texto);
		$where ="";
		for ($i=0; $i<count($vpath); $i++) {
			if ($vpath[$i]!="") {
				$objeto->setAll( $vpath[$i] );
				$res = $objeto->construyeCadenaBusquedaGeneral($res, $vpath[$i]);
				if ($where!="") $where .=" AND ";
				$where .= $res;
			}
		}
		return $where;
	}

	function refinarWhere($objeto, $nwhere) {
		global $visit;	
		$where=$nwhere;
		if ($visit->options->busquedaGeneral!="") {
			$sqlBusqueda = $this->getSqlBusqueda($objeto->newInstance(), $visit->options->busquedaGeneral);
			if ($sqlBusqueda!="") {
				if ($where!="") $where = "(".$where.") AND (". $sqlBusqueda . ")";
				else $where = $sqlBusqueda;
			}
		}

		if ($visit->options->visible!="" && $objeto->getNombreTabla()=="articulos") {
			if ($where!= "") $where = "(".$where.") AND ";
			$where .= "  articulos.visible = '".$visit->options->visible."'";
		}
		if ($objeto->getNombreTabla()=="resources"){ 			
			
			//$where=" type != 'U'"; alfredo 140803

		}

		
		if ($visit->options->strIds!="") {
			if ($where!= "") $where = "(".$where.") AND ";
			$where .= "  id IN (".$visit->options->strIds.")";
		}

		if ($visit->options->precio_desde!="" && $visit->options->precio_hasta!=""  ) {
			
			if ($where!= "") $where = "(".$where.") AND ";
			$where .= "  precio1 BETWEEN '".$visit->options->precio_desde."' AND '".$visit->options->precio_hasta."'";
		}else if ($visit->options->precio_desde!="") {
			if ($where!= "") $where = "(".$where.") AND ";
			$where .= "  precio1 >= '".$visit->options->precio_desde."'";
		}else if ($visit->options->precio_hasta!=""){
			if ($where!= "") $where = "(".$where.") AND ";
			$where .= "  precio1 <= '".$visit->options->precio_hasta."'";
		}
	

	


		if ($visit->options->preciototal_desde!="" && $visit->options->preciototal_hasta!=""  ) {
			
			if ($where!= "") $where = "(".$where.") AND ";
			$where .= "  (precio_oferta BETWEEN '".$visit->options->preciototal_desde."' AND '".$visit->options->preciototal_hasta."') OR (precio BETWEEN '".$visit->options->preciototal_desde."' AND '".$visit->options->preciototal_hasta."')";
		}else if ($visit->options->preciototal_desde!="") {
			if ($where!= "") $where = "(".$where.") AND ";
			$where .= "  precio_oferta >= '".$visit->options->preciototal_desde."' OR precio  >= '".$visit->options->preciototal_desde;
		}else if ($visit->options->preciototal_hasta!=""){
			if ($where!= "") $where = "(".$where.") AND ";
			$where .= "  precio_oferta <= '".$visit->options->preciototal_hasta."' OR precio  <= '".$visit->options->preciototal_hasta;
		}



		if ($visit->options->fecha_desde!="" && $visit->options->fecha_hasta!=""  ) {
			if ($where!= "") $where = "(".$where.") AND ";
			$where .= "  SUBSTRING(fecha,1,8) BETWEEN '".$visit->options->fecha_desde."' AND '".$visit->options->fecha_hasta."'";
		}else if ($visit->options->fecha_desde!="") {
			if ($where!= "") $where = "(".$where.") AND ";
			$where .= "  SUBSTRING(fecha,1,8)  >= '".$visit->options->fecha_desde."'";
		}else if ($visit->options->fecha_hasta!=""){
			if ($where!= "") $where = "(".$where.") AND ";
			$where .= "  SUBSTRING(fecha,1,8)  <= '".$visit->options->fecha_hasta."'";
		}


	



		if ($visit->options->lang!="" && $visit->util->perteneceLista(" lang",$objeto->getCamposUpdate())) {
			
			if ($where!= "") $where = "(".$where.") AND ";
			$where .= " (lang = '".$visit->options->lang."')";
		}
		

		return $where;
	}

	/*Construye una SQL que permita buscar cada palabra de la cadena de busqueda en los diferentes registros */
	function &getTablaFiltradaLimit($objeto, $from, $count) {
	
		
		$orderBy = $objeto->getOrderBy();
		$where = $objeto->construyeCadenaFiltro();
		$where = $this->refinarWhere($objeto, $where);
		if ($where!="") $strWhere =" WHERE ". $where;
		if ($orderBy!="") $strOrderBy =" ORDER BY ". $orderBy;

		$v=explode(" ",$orderBy);
		$orden=$v[0];

		if ($objeto->getNombreTabla()=="clientes"){ 
			$campos = $objeto->getCampos();
			$campos = preg_replace("/id,/","clientes.id,", $campos);
			$campos = preg_replace("/, /"," ,clientes.", $campos);

	
		
			if ($where!="") $strWhere =" WHERE clientes. ". $where;
			$strGroupBy =" GROUP BY clientes.id ";
			$sql ="SELECT ". $campos .",COUNT(idcliente) as cuenta FROM ". $objeto->getNombreTabla() . " LEFT JOIN pedidos ON clientes.id=pedidos.idcliente " .$strWhere . $strGroupBy . $strOrderBy;

		}else if ($objeto->getNombreTabla()=="pagina_imagenes"){ 
			
			$campos = $objeto->getCampos();
			$campos = preg_replace("/id,/","pagina_imagenes.id,", $campos);
			$campos = preg_replace("/, /"," ,pagina_imagenes.", $campos);

	
		
			if ($where!="") $strWhere =" WHERE pagina_imagenes. ". $where;
			$strGroupBy =" GROUP BY pagina_imagenes.id ";
			$sql ="SELECT ". $campos .",COUNT(idpaginaimagenes) as cuenta FROM ". $objeto->getNombreTabla() . " LEFT JOIN imagenespaginas ON pagina_imagenes.id=imagenespaginas.idpaginaimagenes " .$strWhere . $strGroupBy . $strOrderBy;


		}else if ($objeto->getNombreTabla()=="tiendas" && $orden=="provincia" ){ 
			$campos = $objeto->getCampos();
			$campos = preg_replace("/id,/","tiendas.id,", $campos);
			$campos = preg_replace("/, /"," ,tiendas.", $campos);

	
			if ($where!="") $strWhere =" WHERE tiendas. ". $where;
				$strOrderBy = " ORDER BY provincias_pais.nombre ".$v[1];
			$sql ="SELECT ". $campos ." FROM ". $objeto->getNombreTabla() . " LEFT JOIN provincias_pais ON tiendas.provincia=provincias_pais.id " .$strWhere .  $strOrderBy;
			
		}else if ($objeto->getNombreTabla()=="noticias" && $orden=="idnavegacion" ){ 
			$campos = $objeto->getCampos();
			$campos = preg_replace("/id,/","noticias.id,", $campos);
			$campos = preg_replace("/, /"," ,noticias.", $campos);

	
			if ($where!="") $strWhere =" WHERE noticias. ". $where;
				$strOrderBy = " ORDER BY navegacion.nombre ".$v[1];
			$sql ="SELECT ". $campos ." FROM ". $objeto->getNombreTabla() . " LEFT JOIN navegacion ON noticias.idnavegacion=navegacion.id " .$strWhere .  $strOrderBy;
		

		}else if ($objeto->getNombreTabla()=="articulos" && $orden=="idseccion" ){ 
			$campos = $objeto->getCampos();
			$campos = preg_replace("/id,/","articulos.id,", $campos);
			$campos = preg_replace("/, /"," ,articulos.", $campos);
			
	
			if ($where!="") $strWhere =" WHERE articulos.". $where;
				$strOrderBy = " ORDER BY secciones_catalogo.nombre ".$v[1];
			$sql ="SELECT ". $campos ." FROM ". $objeto->getNombreTabla() . " LEFT JOIN secciones_catalogo ON articulos.idseccion=secciones_catalogo.id " .$strWhere .  $strOrderBy;
		}else if ($objeto->getNombreTabla()=="faqs" && $orden=="idnavegacion" ){ 
			$campos = $objeto->getCampos();
			$campos = preg_replace("/id,/","faqs.id,", $campos);
			$campos = preg_replace("/, /"," ,faqs.", $campos);

	
			if ($where!="") $strWhere =" WHERE faqs. ". $where;
				$strOrderBy = " ORDER BY navegacion.nombre ".$v[1];
			$sql ="SELECT ". $campos ." FROM ". $objeto->getNombreTabla() . " LEFT JOIN navegacion ON faqs.idnavegacion=navegacion.id " .$strWhere .  $strOrderBy;
			
		}else if ($objeto->getNombreTabla()=="pedidos" && $orden=="forma_pago" ){ 
			$campos = $objeto->getCampos();
			$campos = preg_replace("/id,/","pedidos.id,", $campos);
			$campos = preg_replace("/, /"," ,pedidos.", $campos);

	
			if ($where!="") $strWhere =" WHERE pedidos. ". $where;
				$strOrderBy = " ORDER BY metodos_pago.nombre ".$v[1];
			$sql ="SELECT ". $campos ." FROM ". $objeto->getNombreTabla() . " LEFT JOIN metodos_pago ON pedidos.forma_pago=metodos_pago.id " .$strWhere .  $strOrderBy;
			
		
		}else if ($objeto->getNombreTabla()=="visitas_flujocompra"){

			if ($where!="") $strWhere =" WHERE ". $where;
			$strGroupBy =" GROUP by  paso";
			$sql ="SELECT paso, SUM(contador) AS contador, fecha FROM ". $objeto->getNombreTabla() .$strWhere . $strGroupBy . $strOrderBy;
		
		}else if ($objeto->getNombreTabla()=="visitas_catalogo"){

			if ($where!="") $strWhere =" WHERE ". $where;
			$strGroupBy =" GROUP by  idrecurso";
			$sql ="SELECT idrecurso, SUM(contador) AS contador, fecha, nombre FROM ". $objeto->getNombreTabla() .$strWhere . $strGroupBy . $strOrderBy;

		}else if ($objeto->getNombreTabla()=="visitas_articulo"){

			if ($where!="") $strWhere =" WHERE ". $where;
			$strGroupBy =" GROUP by  idrecurso";
			$sql ="SELECT idrecurso, SUM(contador) AS contador, fecha, ref_articulo FROM ". $objeto->getNombreTabla() .$strWhere . $strGroupBy . $strOrderBy;
		}else{
			$sql ="SELECT ". $objeto->getCampos() ." FROM ". $objeto->getNombreTabla() . $strWhere . $strOrderBy;
		}
		$this->visit->debuger->out("getTablaFiltrada: ". $objeto->getNombreTabla() ."-: $sql");
		$collection = $this->execSQLLimit( $sql, $objeto, $from, $count );
		return $collection;
	}

	/*Construye una SQL que permita buscar cada palabra de la cadena de busqueda en los diferentes registros */
	function &getTablaFiltradaCount($objeto) {
		$where = $objeto->construyeCadenaFiltro();
		$where = $this->refinarWhere($objeto, $where);
		if ($where!="") $strWhere =" WHERE ". $where;
		$sql ="SELECT COUNT(*) AS cuenta FROM ". $objeto->getNombreTabla() . $strWhere;
		$this->visit->debuger->out("getTablaFiltradaCount-". $objeto->getNombreTabla() ."-: $sql");
		$collection = $this->conn->GetAll($sql);
		return $collection[0]["cuenta"];
	}

	/*Construye una SQL que permita buscar cada palabra de la cadena de busqueda en los diferentes registros */
	function &getTablaFiltradaDistinct($objeto,$campo) {
		$where = $objeto->construyeCadenaFiltro();
		$where = $this->refinarWhere($objeto, $where);
		if ($where!="") $strWhere =" WHERE ". $where;
		$sql ="SELECT DISTINCT(".$campo.") FROM ". $objeto->getNombreTabla() . $strWhere;
		$this->visit->debuger->out("getTablaFiltradaDistinct-". $objeto->getNombreTabla() ."-: $sql");
		$filas = $this->conn->GetAll($sql);
		$arr=array();
		for ($i=0;$i<count($filas);$i++) {
			$valor = $filas[$i][$campo];
			if ($valor!="") $arr[] = $valor;
		}
		return $arr;
	}

	/*Construye una SQL que permita buscar cada palabra de la cadena de busqueda en los diferentes registros */
	function &getTablaFiltradaDistinctMultiple($objeto,$campo) {
		$where = $objeto->construyeCadenaFiltro();
		$where = $this->refinarWhere($objeto, $where);
		$arrCampos = $objeto->getArrayCampos();
		if ($arrCampos[$campo]!="") { 
			$filas=array();
			$filas[]=$arrCampos[$campo];
		} else {
			if ($where!="") $strWhere =" WHERE ". $where;
			$sql ="SELECT DISTINCT(".$campo.") FROM ". $objeto->getNombreTabla() . $strWhere;
			$this->visit->debuger->out("getTablaFiltradaDistinct-". $objeto->getNombreTabla() ."-: $sql");
			$filas = $this->conn->GetAll($sql);
			$arr=array();
			for ($i=0;$i<count($filas);$i++) {
				$valorM = $filas[$i][$campo];
				$v = explode(",",$valorM);
				for ($j=0;$j<count($v);$j++) {
					$valor = $v[$j];
					if ($valor!="") $arr[$valor]="";
				}
			}
			ksort($arr);
			$filas = array_keys($arr);
		}
		return $filas;
	}

	/*Construye una SQL que permita buscar cada palabra de la cadena de busqueda en los diferentes registros */
	function &getTablaBusqueda($objeto) {
		$orderBy = $objeto->getOrderBy();
		$where = $objeto->construyeCadenaFiltro();
		if ($where!="") $strWhere =" WHERE ". $where;
		if ($orderBy!="") $strOrderBy =" ORDER BY ". $orderBy;
		$sql ="SELECT ". $objeto->getCampos() ." FROM ". $objeto->getNombreTabla() . $strWhere . $strOrderBy;
		$this->visit->debuger->out("getTablaFiltrada: ". $objeto->getNombreTabla() ."-: $sql");
		$collection = $this->execSQL( $sql, $objeto );
		return $collection;
	}

	/*Construye una SQL que permita buscar cada palabra de la cadena de busqueda en los diferentes registros */
	function &getTablaBusquedaLimit($objeto, $from, $count) {
		$orderBy = $objeto->getOrderBy();
		$where = $objeto->construyeCadenaFiltro();
		if ($where!="") $strWhere =" WHERE ". $where;
		if ($orderBy!="") $strOrderBy =" ORDER BY ". $orderBy;
		$sql ="SELECT ". $objeto->getCampos() ." FROM ". $objeto->getNombreTabla() . $strWhere . $strOrderBy;
		$this->visit->debuger->out("getTablaFiltrada: ". $objeto->getNombreTabla() ."-: $sql");
		$collection = $this->execSQLLimit( $sql, $objeto, $from, $count );
		return $collection;
	}

	/*Construye una SQL que permita buscar cada palabra de la cadena de busqueda en los diferentes registros */
	function &getTablaBusquedaCount($objeto) {
		$where = $objeto->construyeCadenaFiltro();
		if ($where!="") $strWhere =" WHERE ". $where;
		$sql ="SELECT COUNT(*) AS cuenta FROM ". $objeto->getNombreTabla() . $strWhere;
		$this->visit->debuger->out("getTablaFiltradaCount-". $objeto->getNombreTabla() ."-: $sql");
		$collection = $this->conn->GetAll($sql);
		return $collection[0]["cuenta"];
	}

	function obtenerIds($col) {
		$arr = array();
		for ($i=0;$i<count($col);$i++) {
			$arr[$i] = $col[$i]->id;
		}
		return $arr;
	}

	function &getTablaLimit($objeto, $from, $size) {
		$orderBy = $objeto->getOrderBy();
		$where = $objeto->construyeCadenaBusqueda();
		if ($where!="") $strWhere =" WHERE ". $where;
		if ($orderBy!="") $strOrderBy =" ORDER BY ". $orderBy;
		$sql ="SELECT ". $objeto->getCampos() ." FROM ". $objeto->getNombreTabla() . $strWhere . $strOrderBy. " LIMIT 1,1";
		$this->visit->debuger->out("getTablaLimit-". $objeto->getNombreTabla() ."-: $sql");
		$collection = $this->execSQL( $sql, $objeto );
		return $collection;
	}

	function &getTablaCount($objeto) {
		$where = $objeto->construyeCadenaBusqueda();
		if ($where!="") $strWhere =" WHERE ". $where;
		$sql ="SELECT COUNT(*) AS cuenta FROM ". $objeto->getNombreTabla() . $strWhere;
		$this->visit->debuger->out("getTablaCount-". $objeto->getNombreTabla() ."-: $sql");
		$collection = $this->conn->GetAll($sql);
		return $collection[0]["cuenta"];
	}

	function persist2( $objeto) {
		$nobjeto = $objeto;
		$ret = $this->conn->Replace( $objeto->getNombreTabla(), $objeto->getTypedArrayCampos(), 'id', $autoquote = true);
		if ($objeto->id=="") {
			$nobjeto->id = $this->conn->Insert_ID();
		}
		return $nobjeto;
	}

	function persist( $objeto) {
		$logger = new ClsLogger();
		$nobjeto = $objeto;
		if ($objeto->id=="") {
			$sql = "INSERT INTO " . $objeto->getNombreTabla() ."(" . $objeto->getCamposUpdate() . ") VALUES (" . $objeto->getValoresInsert() . " )";
			$this->visit->debuger->out("persist-". $objeto->getNombreTabla() ."-: $sql");
			$ret = $this->conn->Execute( $sql );
			$id = $this->conn->Insert_ID();
			if ($id==false) {
				//print "FALSE";
				$sql="SELECT MAX(id) AS id FROM ". $objeto->getNombreTabla();
				$collection = $this->execSQL( $sql, $objeto );
				//var_dump($collection);
				$nobjeto->id=$collection[0]->id;
			} else {
				$nobjeto->id=$id;
			} 
		} else {
			$sql = "UPDATE " . $objeto->getNombreTabla() ." SET " . $objeto->getValoresUpdate() . " WHERE id=" . $objeto->id ;
			$this->visit->debuger->out("persist-". $objeto->getNombreTabla() ."-: $sql");
			$ret = $this->conn->Execute( $sql );
		}
		$logger->enabled=true;
		$logger->log($sql);
		$logger->false=true;
		return $nobjeto;
	}


	function persistFromIdlangprincipal( $objeto) {
		$nobjeto = $objeto;
		
		$sql = "UPDATE " . $objeto->getNombreTabla() ." SET " . $objeto->getValoresUpdateLang() . " WHERE idlangprincipal=" . $objeto->idlangprincipal;
		$this->visit->debuger->out("persist-". $objeto->getNombreTabla() ."-: $sql");
		$ret = $this->conn->Execute( $sql );
		
		return $nobjeto;
	}


	function persistFromIdlangprincipalCampo( $objeto,$campo) {
		$nobjeto = $objeto;
		
		$sql = "UPDATE " . $objeto->getNombreTabla() ." SET " . $campo . "='".$objeto->$campo."' WHERE idlangprincipal=" . $objeto->idlangprincipal;
		$this->visit->debuger->out("persist-". $objeto->getNombreTabla() ."-: $sql");
		$ret = $this->conn->Execute( $sql );
		
		return $nobjeto;
	}


	function persistFromIdlangprincipalLang( $objeto,$lang) {
		$nobjeto = $objeto;
		
		$sql = "UPDATE " . $objeto->getNombreTabla() ." SET " . $objeto->getValoresUpdateLang() . " WHERE idlangprincipal=" . $objeto->idlangprincipal ." AND lang='".$lang."'";
		$this->visit->debuger->out("persist-". $objeto->getNombreTabla() ."-: $sql");
		$ret = $this->conn->Execute( $sql );
		
		return $nobjeto;
	}

	function persistOrder( $objeto) {
		$nobjeto = $objeto;
		if ($objeto->id=="") {
			$sql = "INSERT INTO " . $objeto->getNombreTabla() ."(" . $objeto->getCamposUpdate() . ") VALUES (" . $objeto->getValoresInsert() . " )";
			$this->visit->debuger->out("persist-". $objeto->getNombreTabla() ."-: $sql");
			$ret = $this->conn->Execute( $sql );
			$id = $this->conn->Insert_ID();
			if ($id==false) {
				//print "FALSE";
				$sql="SELECT MAX(id) AS id FROM ". $objeto->getNombreTabla();
				$collection = $this->execSQL( $sql, $objeto );
				//var_dump($collection);
				$nobjeto->id=$collection[0]->id;
			} else {
				$nobjeto->id=$id;
			} 
		} else {
			$sql = "UPDATE " . $objeto->getNombreTabla() ." SET orden=" . $objeto->orden. " WHERE id=" . $objeto->id ;
			$this->visit->debuger->out("persist-". $objeto->getNombreTabla() ."-: $sql");
			$ret = $this->conn->Execute( $sql );
		}
		return $nobjeto;
	}

	function remove( $objeto) {
		$sql = "DELETE FROM ". $objeto->getNombreTabla() ." WHERE id=". $objeto->id;
		//echo $sql;
		$this->visit->debuger->out("persist-". $objeto->getNombreTabla() ."-: $sql");
		$this->conn->Execute($sql);
		return;
	}
	
	//Devuelve todas las ClsAuxProducto
	function &getTablas() {
		$e = new ClsTabla();		
		return $this->getTablaGenerica($e);
	}

	//Devuelve todas las ClsAuxProducto
	function &getCamposFromIdTabla($idtabla) {
		$e = new ClsCampo();
		$e->idtabla=$idtabla;
		$sql ="SELECT ". $e->getCampos() ." FROM ". $e->getNombreTabla() . " WHERE idtabla=". $e->idtabla ." ORDER BY ". $e->getOrderBy();
		$this->visit->debuger->out("getCamposByIdTabla: $sql");
		$collection = $this->execSQL( $sql, $e );
		return $collection;
	}

	//Devuelve todas las ClsAuxProducto
	function &getTablaGenerica($e) {
		$sql ="SELECT ". $e->getCampos() ." FROM ". $e->getNombreTabla() . " ORDER BY ". $e->getOrderBy();
		$this->visit->debuger->out("getTablaGenerica: $sql");
		$collection = $this->execSQL( $sql, $e );
		return $collection;
	}

	//Devuelve todas las ClsAuxProducto
	function &getTablaGenericaLimit($e, $from, $count) {
		$sql ="SELECT ". $e->getCampos() ." FROM ". $e->getNombreTabla() . " ORDER BY ". $e->getOrderBy();
		$this->visit->debuger->out("getTablaGenericaLimit: $sql");
		$collection = $this->execSQLLimit( $sql, $e, $from, $count );
		return $collection;
	}

	//Devuelve todas las ClsAuxProducto
	function &getTablaGenericaCount($e) {
		$sql ="SELECT COUNT(*) AS CUENTA FROM ". $e->getNombreTabla();
		$this->visit->debuger->out("getTablaGenericaCount: $sql");
		$rs = $this->conn->Execute( $sql );
		$arr = $rs->getArray();		
		return $arr[0]["CUENTA"];	
	}

	//Devuelve todas las ClsAuxProducto
	function &getTablaGenericaId($e) {
		$sql ="SELECT ". $e->getCampos() ." FROM ". $e->getNombreTabla() . " WHERE id=" . $e->id;
		$this->visit->debuger->out("getTablaGenericaId: $sql");
		$collection = $this->execSQL( $sql, $e );
		if (count($collection)<=0) $res = "";
		else $res = $collection[0];
		return $res;
	}

	//Devuelve todas las ClsTabla
	function &getTabla($id) {
		$e = new ClsTabla();
		$e->id = $id;
		return $this->getTablaGenericaId($e);
	}

	//Devuelve todas las ClsAuxProducto
	function &getComTablaByNombre($nombre_tabla) {
		global $visit;
		$e = new ClsTabla();
		$e->nombre_tabla = $nombre_tabla;
		$sql ="SELECT ". $e->getCampos() ." FROM ". $e->getNombreTabla() . " WHERE nombre_tabla=" . $visit->util->getNullString( $e->nombre_tabla );
		$this->visit->debuger->out("getTablaGenericaId: $sql");
		$collection = $this->execSQL( $sql, $e );
		if (count($collection)<=0) $res = "";
		else $res = $collection[0];
		return $res;
	}

	//Devuelve todas las ClsAuxProducto
	function &getTablasConPrefijo($prefijo) {
		global $visit;
		$e = new ClsCampo();
		$sql ="SELECT ". $e->getCampos() ." FROM ". $e->getNombreTabla() . " WHERE valores LIKE '" .$prefijo ."%';";
		$this->visit->debuger->out("getTablasConPrefijo: $sql");
		$filas= $this->execSQL( $sql, $e );
		$strIds = "";
		for ($i=0;$i<count($filas);$i++) {
			$strIds .=",".$filas[$i]->idtabla;
		}
		$collection=array();
		if ($strIds!="") {
			$strIds = substr($strIds,1);
			$e = new ClsTabla();
			$sql ="SELECT ". $e->getCampos() ." FROM ". $e->getNombreTabla() . " WHERE id IN (" . $strIds .")";
			$this->visit->debuger->out("getTablasConPrefijo: $sql");
			$collection = $this->execSQL( $sql, $e );
		}
		return $collection;
	}

	function deleteCamposFromTabla($id) {
		$objeto = new ClsCampo();
		$objeto->idtabla = $id;
		$sql = "DELETE FROM ". $objeto->getNombreTabla() ." WHERE idtabla=".$objeto->idtabla;
		$this->conn->Execute($sql);
	}

	function getInsertSql($obj) {
		$sql = "INSERT INTO " . $obj->getNombreTabla() . " (" . $obj->getCampos() . ") VALUES (" . $obj->id . ", " . $obj->getValoresInsert() . ")";
		return $sql;
	}

	function borrarTablaRelacionEneMenos($objPadre, $obj, $nombreCampo, $strMenos) {		
		if ($strMenos=="") {
			$sql = "DELETE FROM " . $obj->getNombreTabla() . " WHERE $nombreCampo='" . $objPadre->id . "'";
		} else {
			$sql = "DELETE FROM " . $obj->getNombreTabla() . " WHERE $nombreCampo='" . $objPadre->id . "' AND id NOT IN (" . $strMenos . ")";
		}
		$this->visit->debuger->out("borrarTablaRelacionEneMenos: $sql");
		$this->conn->Execute( $sql );
		return;
	}


	function borrarTablaBoletinRelacionEneMenos($objPadre, $obj, $nombreCampo, $strMenos,$localizacion) {		
		if ($strMenos=="") {
			$sql = "DELETE FROM " . $obj->getNombreTabla() . " WHERE $nombreCampo='" . $objPadre->id . "' AND localizacion='".$localizacion."'";
		} else {
			$sql = "DELETE FROM " . $obj->getNombreTabla() . " WHERE $nombreCampo='" . $objPadre->id . "' AND id NOT IN (" . $strMenos . ") AND localizacion='".$localizacion."'";
		}
		$this->visit->debuger->out("borrarTablaRelacionEneMenos: $sql");
		$this->conn->Execute( $sql );
		return;
	}



	function &getModTablaCursoContador($objeto,$idcurso) {
		$sql = "UPDATE " . $objeto->getNombreTabla() ." SET contador = contador + 1  WHERE id=" . $idcurso ;
		$this->visit->debuger->out("persist-". $objeto->getNombreTabla() ."-: $sql");
		$ret = $this->conn->Execute( $sql );
	}

	function executeNonQuery($sql) {
		$this->visit->debuger->out("executeNonQuery-: $sql");
		return $this->conn->Execute($sql);
	}

}
?>