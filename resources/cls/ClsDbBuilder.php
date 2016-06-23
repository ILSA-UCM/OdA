<?

class ClsDbBuilder extends ClsDbBuilderBase {

	var $generarSql;

	/* CONTENT MANAGER: No quitar lineas */	

		// COMANAGER 1.0: TABLA paginas

	function &getPaginas() {

		$e = new ClsPaginas();		

		return $this->getTablaGenerica($e);

	}		

	function &getPaginasLimit($offset, $count) {

		$e = new ClsPaginas();

		return $this->getTablaGenericaLimit($e, $offset, $count);

	}

	function &getPaginasCount() {

		$e = new ClsPaginas();

		return $this->getTablaGenericaCount($e);

	}

	function &getPaginasId($id) {

		$e = new ClsPaginas();

		$e->id = $id;

		return $this->getTablaGenericaId($e);

	}



	function &getPaginasIdlangprincipal($id,$lang) {

		$e = new ClsPaginas();

		$e->idlangprincipal = $id;

		$e->lang = $lang;

		return $this->getTablaGenericaIdlangprincipal($e);

	}

	

	// COMANAGER 1.0: FIN TABLA paginas

	// COMANAGER 1.0: TABLA navegacion

	function &getNavegacion() {

		$e = new ClsNavegacion();		

		return $this->getTablaGenerica($e);

	}		

	function &getNavegacionLimit($offset, $count) {

		$e = new ClsNavegacion();

		return $this->getTablaGenericaLimit($e, $offset, $count);

	}

	function &getNavegacionCount() {

		$e = new ClsNavegacion();

		return $this->getTablaGenericaCount($e);

	}

	function &getNavegacionId($id) {

		$e = new ClsNavegacion();

		$e->id = $id;

		return $this->getTablaGenericaId($e);

	}



	function &getNavegacionIdlangprincipal($id,$lang) {

		$e = new ClsNavegacion();

		$e->idlangprincipal = $id;

		$e->lang = $lang;

		return $this->getTablaGenericaIdlangprincipal($e);

	}

	function getNavegacionTipo($tipo){

		$e = new ClsNavegacion();

		$sql ="SELECT ". $e->getCampos() ." FROM ". $e->getNombreTabla() . " WHERE tipo_contenido='" . $tipo."'";

		$this->visit->debuger->out("getTablaGenericaId: $sql");

		$collection = $this->execSQL( $sql, $e );

		if (count($collection)<=0) $res = "";

		else $res = $collection[0];

		return $res;

	}

	

	// COMANAGER 1.0: TABLA usuarios

	function &getUsuarios() {

		$e = new ClsUsuarios();		

		return $this->getTablaGenerica($e);

	}		

	function &getUsuariosLimit($offset, $count) {

		$e = new ClsUsuarios();

		return $this->getTablaGenericaLimit($e, $offset, $count);

	}

	function &getUsuariosCount() {

		$e = new ClsUsuarios();

		return $this->getTablaGenericaCount($e);

	}

	function &getUsuariosId($id) {

		$e = new ClsUsuarios();

		$e->id = $id;

		return $this->getTablaGenericaId($e);

	}



	function &getUsuariosLogin($login) {

		$e = new ClsUsuarios();

		$e->login = $login;

		$res="";

		if ($login!="") {

			$col = $this->getTablaFiltrada($e);

			$res = $col[0];

		}

		return $res;

	}



	function &getUsuariosCorreo($correo) {

		$e = new ClsUsuarios();

		$e->correo = $correo;

		$res="";

		if ($correo!="") {

			$col = $this->getTablaFiltrada($e);

			$res = $col[0];

		}

		return $res;

	}

	//Dado un nombre del usuario devuelve el rol

	function &getUsuarioRol($name) {

		$e = new ClsUsuarios();

		$e->login = $name;

		$res="";

		if ($name!="") {

			$col = $this->getTablaFiltrada($e);

			$res = $col[0];

		}

		return $res->rol;

	}

	

	// COMANAGER 1.0: FIN TABLA metodos_envio

	// COMANAGER 1.0: TABLA mensajes

	function &getMensajes() {

		$e = new ClsMensajes();		

		return $this->getTablaGenerica($e);

	}		

	function &getMensajesLimit($offset, $count) {

		$e = new ClsMensajes();

		return $this->getTablaGenericaLimit($e, $offset, $count);

	}

	function &getMensajesCount() {

		$e = new ClsMensajes();

		return $this->getTablaGenericaCount($e);

	}

	function &getMensajesId($id) {

		$e = new ClsMensajes();

		$e->id = $id;

		return $this->getTablaGenericaId($e);

	}

	

	

	// COMANAGER 1.0: FIN TABLA metodos_pago

	// COMANAGER 1.0: TABLA cadenas_busqueda

	function &getCadenasBusqueda() {

		$e = new ClsCadenasBusqueda();		

		return $this->getTablaGenerica($e);

	}		

	function &getCadenasBusquedaLimit($offset, $count) {

		$e = new ClsCadenasBusqueda();

		return $this->getTablaGenericaLimit($e, $offset, $count);

	}

	function &getCadenasBusquedaCount() {

		$e = new ClsCadenasBusqueda();

		return $this->getTablaGenericaCount($e);

	}

	function &getCadenasBusquedaId($id) {

		$e = new ClsCadenasBusqueda();

		$e->id = $id;

		return $this->getTablaGenericaId($e);

	}

	

	

	

	// COMANAGER 1.0: FIN TABLA destacados

	// COMANAGER 1.0: TABLA preferencias_presentacion

	function &getPreferenciasPresentacion() {

		$e = new ClsPreferenciasPresentacion();		

		return $this->getTablaGenerica($e);

	}		

	function &getPreferenciasPresentacionLimit($offset, $count) {

		$e = new ClsPreferenciasPresentacion();

		return $this->getTablaGenericaLimit($e, $offset, $count);

	}

	function &getPreferenciasPresentacionCount() {

		$e = new ClsPreferenciasPresentacion();

		return $this->getTablaGenericaCount($e);

	}

	function &getPreferenciasPresentacionId($id) {

		$e = new ClsPreferenciasPresentacion();

		$e->id = $id;

		return $this->getTablaGenericaId($e);

	}

	

	// COMANAGER 1.0: TABLA section_data

	function &getSectionData() {

		$e = new ClsSectionData();		

		return $this->getTablaGenerica($e);

	}		

	function &getSectionDataLimit($offset, $count) {

		$e = new ClsSectionData();

		return $this->getTablaGenericaLimit($e, $offset, $count);

	}

	function &getSectionDataCount() {

		$e = new ClsSectionData();

		return $this->getTablaGenericaCount($e);

	}

	function &getSectionDataId($id) {

		$e = new ClsSectionData();

		$e->id = $id;

		return $this->getTablaGenericaId($e);

	}

	function &getSectionDataFromId($id){

		$e = new ClsSectionData();

		$sql = "SELECT ". $e->getCampos() ." FROM ". $e->getNombreTabla() . " WHERE id='".$id."' ORDER BY orden";

		$collection = $this->execSQL($sql,$e);

 		return $collection[0];

	}

	

	// COMANAGER 1.0: FIN TABLA section_data

	

	

	// COMANAGER 1.0: TABLA permisos

	function &getPermisos() {

		$e = new ClsPermisos();		

		return $this->getTablaGenerica($e);

	}		

	function &getPermisosLimit($offset, $count) {

		$e = new ClsPermisos();

		return $this->getTablaGenericaLimit($e, $offset, $count);

	}

	function &getPermisosCount() {

		$e = new ClsPermisos();

		return $this->getTablaGenericaCount($e);

	}

	function &getPermisosObjectId($id) {

		$e = new ClsPermisos();

		$e->id = $id;

		return $this->getTablaGenericaId($e);

	}

	// COMANAGER 1.0: FIN TABLA virtual_object

	// COMANAGER 1.0: TABLA virtual_object

	function &getVirtualObject() {

		$e = new ClsVirtualObject();		

		return $this->getTablaGenerica($e);

	}		

	function &getVirtualObjectLimit($offset, $count) {

		$e = new ClsVirtualObject();

		return $this->getTablaGenericaLimit($e, $offset, $count);

	}

	function &getVirtualObjectCount() {

		$e = new ClsVirtualObject();

		return $this->getTablaGenericaCount($e);

	}

	function &getVirtualObjectId($id) {

		$e = new ClsVirtualObject();

		$e->id = $id;

		return $this->getTablaGenericaId($e);

	}

	// COMANAGER 1.0: FIN TABLA virtual_object

	

	// COMANAGER 1.0: TABLA controlled_data

	function &getControlledData() {

		$e = new ClsControlledData();		

		return $this->getTablaGenerica($e);

	}		

	function &getControlledDataLimit($offset, $count) {

		$e = new ClsControlledData();

		return $this->getTablaGenericaLimit($e, $offset, $count);

	}

	function &getControlledDataCount() {

		$e = new ClsControlledData();

		return $this->getTablaGenericaCount($e);

	}

	function &getControlledDataId($id) {

		$e = new ClsControlledData();

		$e->id = $id;

		return $this->getTablaGenericaId($e);

	}

	

	// COMANAGER 1.0: FIN TABLA controlled_data

	

	// COMANAGER 1.0: TABLA numeric_data

	function &getNumericData() {

		$e = new ClsNumericData();		

		return $this->getTablaGenerica($e);

	}		

	function &getNumericDataLimit($offset, $count) {

		$e = new ClsNumericData();

		return $this->getTablaGenericaLimit($e, $offset, $count);

	}

	function &getNumericDataCount() {

		$e = new ClsNumericData();

		return $this->getTablaGenericaCount($e);

	}

	function &getNumericDataId($id) {

		$e = new ClsNumericData();

		$e->id = $id;

		return $this->getTablaGenericaId($e);

	}

	

	// COMANAGER 1.0: FIN TABLA numeric_data

	

	// COMANAGER 1.0: TABLA text_data

	function &getTextData() {

		$e = new ClsTextData();		

		return $this->getTablaGenerica($e);

	}		

	function &getTextDataLimit($offset, $count) {

		$e = new ClsTextData();

		return $this->getTablaGenericaLimit($e, $offset, $count);

	}

	function &getTextDataCount() {

		$e = new ClsTextData();

		return $this->getTablaGenericaCount($e);

	}

	function &getTextDataId($id) {

		$e = new ClsTextData();

		$e->id = $id;

		return $this->getTablaGenericaId($e);

	}

	

	// COMANAGER 1.0: FIN TABLA text_data

	

	// COMANAGER 1.0: TABLA resources

	function &getResources() {

		$e = new ClsResources();		

		return $this->getTablaGenerica($e);

	}		

	function &getResourcesLimit($offset, $count) {

		$e = new ClsResources();

		return $this->getTablaGenericaLimit($e, $offset, $count);

	}

	function &getResourcesCount() {

		$e = new ClsResources();

		return $this->getTablaGenericaCount($e);

	}

	function &getResourcesId($id) {

		$e = new ClsResources();

		$e->id = $id;

		return $this->getTablaGenericaId($e);

	}

	function &getResourcesIdov($idov) {

		$e = new ClsResources();

		$e->idov = $idov;

		$sql ="SELECT ". $e->getCampos() ." FROM ". $e->getNombreTabla() . " WHERE idov=" . $e->idov;

		$this->visit->debuger->out("getTablaFiltrada: ". $e->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $e );

		return $collection;

	}

	

	// COMANAGER 1.0: FIN TABLA resources

	/* Nuevo Elemento */	



	function getNavegacionFromTipo($tipo){

		global $visit;

		$objeto = new ClsNavegacion();

		$where = $objeto->construyeCadenaFiltro();

		$strWhere =" WHERE visible='S' AND tipo='".$tipo."'";

		$strOrderBy =" ORDER BY orden";

		$sql ="SELECT ". $objeto->getCampos() ." FROM ". $objeto->getNombreTabla() . $strWhere . $strOrderBy;

		$this->visit->debuger->out("getNavegacionFromTipo: ". $objeto->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $objeto );

		return $collection;

	}



		function getNavegacionPrincipal(){

		global $visit;

		$objeto = new ClsNavegacion();

		$strWhere =" WHERE visible = 'S' AND idpadre = '0' AND tipo = 'I'";

		$strOrderBy =" ORDER BY orden";

		$sql ="SELECT ". $objeto->getCampos() ." FROM ". $objeto->getNombreTabla() . $strWhere . $strOrderBy;

		$this->visit->debuger->out("getNavegacionPrincipal: ". $objeto->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $objeto );

		return $collection;

	}

	

	function getNavegacionSecundaria($menu){

		global $visit;

		$objeto = new ClsNavegacion();

		$strWhere =" WHERE   visible = 'S' AND idpadre = '".$menu."'  AND tipo = 'I' ";

		$strOrderBy =" ORDER BY orden";

		$sql ="SELECT ". $objeto->getCampos() ." FROM ". $objeto->getNombreTabla() . $strWhere . $strOrderBy;

		$this->visit->debuger->out("getNavegacionSecundaria: ". $objeto->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $objeto );

		return $collection;

	}





	function getNavegacionDerecha(){

		global $visit;

		$objeto = new ClsNavegacion();

		$strWhere =" WHERE   visible = 'S'   AND tipo = 'D' ";

		$strOrderBy =" ORDER BY orden";

		$sql ="SELECT ". $objeto->getCampos() ." FROM ". $objeto->getNombreTabla() . $strWhere . $strOrderBy;

		$this->visit->debuger->out("getNavegacionSecundaria: ". $objeto->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $objeto );

		return $collection;

	}



	function getNavegacionIzqda(){

		global $visit;

		$objeto = new ClsNavegacion();

		$strWhere =" WHERE  tipo = 'I'";

		//PERMISOS USUARIOS

		if($_SESSION["UserRolUser"]==""){

			$strWhere.= " AND visible='S' ";

		}

		$strOrderBy =" ORDER BY orden";

		$sql ="SELECT ". $objeto->getCampos() ." FROM ". $objeto->getNombreTabla() . $strWhere . $strOrderBy;

		$this->visit->debuger->out("getNavegacionSecundaria: ". $objeto->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $objeto );

		return $collection;

	}



	//Devuelve true si hay alguna seccion con acceso clasificado

	function hayNavegacionBBDD(){

		global $visit;

		$secciones = $this->getNavegacion();

		foreach($secciones as $k=>$v){

			if($v->tipo_contenido=="C"){

				return true;

			}

		}

		return false;

		

	}



	function &getCountArticulosFromCampo($campo) {

		global $visit;

		$objeto = new ClsArticulos();

		$orderBy = $objeto->getOrderBy();	

		$sql ="SELECT COUNT(*) AS cuenta, ".$campo." FROM ". $objeto->getNombreTabla() ." where lang='es' GROUP BY ".$campo;

		$this->visit->debuger->out("getCountArticulosFromCampo: ". $objeto->getNombreTabla() ."-: $sql");

		$collection = $this->conn->GetAll($sql);

		return $collection;

	}





	function &getContenidosPaginaFromIdpagina($idpagina) {

		global $visit;

		$e = new ClsContenidosPagina();		

		$sql ="SELECT ". $e->getCampos() ." FROM ". $e->getNombreTabla() . " WHERE idpagina=".$visit->util->getNullInteger($idpagina)." ORDER BY orden";

		$this->visit->debuger->out("getContenidosPaginaFromIdpagina: $sql");

		$collection = $this->execSQL( $sql, $e);

		return $collection;		

	}



	function &getMensajeValorFromLangAtributo($lang, $atributo) {

		$e = new ClsMensajes();		

		$sql ="SELECT ". $e->getCampos() ." FROM ". $e->getNombreTabla() . " WHERE lang='".$lang."' AND atributo='".$atributo."'";

		$this->visit->debuger->out("getMensajeValorFromLangAtributo: $sql");

		$collection = $this->execSQL( $sql, $e);		

		$res=$collection[0]->valor;

		return $res;		

	}



	function &getNumPedidoFromAnio() {

		$e = new ClsPedidosNumeracion();		

		$anio = date("Y");

		$sql ="SELECT MAX( num_pedido) AS pedido FROM ". $e->getNombreTabla() . " WHERE anio='".$anio."'";

		$this->visit->debuger->out("getNumPedidoFromAnio-". $e->getNombreTabla() ."-: $sql");

		$collection = $this->conn->GetAll($sql);

		$res = $collection[0]["pedido"] +1 ;

		if ($res=="") $res="1";

		//Guardo el nuevo pedido

		$e->anio=$anio;

		$e->num_pedido=$res;

		$this->persist($e);

		return $res;

			

	}



	function borrarTablaEneMenos($obj, $strMenos) {		

		if ($strMenos=="") {

			$sql = "DELETE FROM " . $obj->getNombreTabla() ;

		} else {

			$sql = "DELETE FROM " . $obj->getNombreTabla() . " WHERE id NOT IN (" . $strMenos . ")";

		}

		$this->visit->debuger->out("borrarTablaEneMenos: $sql");

		$this->conn->Execute( $sql );

		return;

	}

	



	function borrarTablaPreferenciasEneMenos($obj, $strMenos,$tipo ) {		

		if ($strMenos=="") {

			$sql = "DELETE FROM " . $obj->getNombreTabla(). " WHERE  tipo='".$tipo."'";

		} else {

			$sql = "DELETE FROM " . $obj->getNombreTabla() . " WHERE id NOT IN (" . $strMenos . ") AND tipo='".$tipo."'";

		}

		$this->visit->debuger->out("borrarTablaEneMenos: $sql");

		$this->conn->Execute( $sql );

		return;

	}



	

	function borrarTablaMetodosPagoEneMenos($obj, $strMenos, $lang) {		

		if ($strMenos=="") {

			$sql = "DELETE FROM " . $obj->getNombreTabla(). " WHERE  lang='".$lang."'";

		} else {

			$sql = "DELETE FROM " . $obj->getNombreTabla() . " WHERE id NOT IN (" . $strMenos . ") AND lang='".$lang."'";

		}

		$this->visit->debuger->out("borrarTablaEneMenos: $sql");

		$this->conn->Execute( $sql );

		return;

	}



	/*Obtiene todos los pedidos en el intervalo de fechas escogido. Sólo los campos que se necesitan para el informe de pedidos*/

	function &getPedidosFiltroFechas($idcliente, $fini, $ffin) {

		$e = new ClsPedidos();

		$strAdicional ="";

		if ($idusuario!="") {

			$strAdicional = "idcliente='$idcliente' AND ";

		}

		$campos="num_pedido, num_articulos, fecha, preciosiniva, preciototal, precioconiva, forma_pago, gastos_envio";

		$sql ="SELECT $campos FROM ". $e->getNombreTabla() . " WHERE fecha>='".$fini."' AND fecha<='".$ffin."'";

		$this->visit->debuger->out("getPedidosFiltroFechas-". $e->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $e);		

		return $collection;

			

	}



	function &getModContadorFromBusquedas($obj) {

		global $visit;

		$sql ="SELECT ". $obj->getCampos() ." FROM ". $obj->getNombreTabla() . " WHERE texto= '". $obj->texto. "'";

		$this->visit->debuger->out("persist- getModContadorFromBusquedas -: $sql");

		$collection = $this->execSQL( $sql, $obj );

		if (count($collection)<=0) $res = "";

		else $res = $collection[0];



		if ($res->id==""){	

			$sql = "INSERT INTO " . $obj->getNombreTabla() ."(" . $obj->getCamposUpdate() . ") VALUES (" . $obj->getValoresInsert() . " )";

		}else{

			$sql = "UPDATE " . $obj->getNombreTabla() ." SET contador = contador + 1   WHERE id=" . $res->id ;

		}

		$this->visit->debuger->out("persist- estadisticas_tipo -: $sql");

		$ret = $this->conn->Execute( $sql );

		

	}



	function getFilaFromIdlangprincipal($obj, $valorCampo, $lang){

		/*

		global $visit;

		

		$where ="  idlangprincipal = '".$valorCampo."' AND lang ='".$lang."'";

		

		$strWhere =" WHERE ". $where;

		$sql ="SELECT ". $obj->getCampos() ." FROM ". $obj->getNombreTabla() . $strWhere ;

		$this->visit->debuger->out("getFilaFromIdlangprincipal: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $obj );

		return $collection[0];

		*/

		return NULL;

	}





	function creaFilasFromLang($obj,$objPadre, $dict,$prefix=""){

		global $visit;

		//$lang= array("va","en");

		$valores= $visit->options->getIdiomas();

		while (list($k,$v)=each($valores)) { 

			if ($k!="es"){ 

				$obj->estableceCampos( $dict,$prefix);

				$obj =  $objPadre;

				$obj->id="";

				$obj->idlangprincipal =  $objPadre->id;

				$obj->lang = $k;

				if ( $obj->getNombreTabla()=="noticias"){					

					$obj->fecha = $visit->util->date2bbdd($obj->fecha);

				} else if ($obj->getNombreTabla()=="articulos"){

					for ($j=1;$j<11;$j++) {

						$campo = "atributo".$j;

						$obj->$campo = $objPadre->$campo;

					}

					$obj->colores = $objPadre->colores;

				} else if ($obj->getNombreTabla()=="secciones_catalogo"){

					$obj->nombreseo=$visit->util->getCadenaSeo( $dict["nombre"] );

				} else if ($obj->getNombreTabla()=="imagenespaginas"){

					$fila = $this->getFilaFromIdlangprincipal( new ClsPaginaImagenes(), $objPadre->idpaginaimagenes, $k);

					$obj->idpaginaimagenes = $fila->id;

				}

				/*if ($objPadre->idpagina!="") {

					$fila = $this->getFilaFromIdlangprincipal( new ClsPaginas(), $objPadre->idpagina, $k);

					$obj->idpagina = $fila->id;

				}*/

				if ($objPadre->idpadre!="") {					

					$fila = $this->getFilaFromIdlangprincipal( new ClsNavegacion(), $objPadre->idpadre, $k);					

					$obj->idpadre = $fila->id;

					if ( $obj->idpadre=="") $obj->idpadre = "0";					

				}

				if($objPadre->idnavegacion!=""){

					$fila = $this->getFilaFromIdlangprincipal( new ClsNavegacion(), $objPadre->idnavegacion, $k);

					$obj->idpadre = $fila->id;

				}				

				$obj = $this->persist($obj);				

			}

		}

	}

	

	



	function updateIdlangprincipal($objeto){

		global $visit;

		$sql = "UPDATE " . $objeto->getNombreTabla() ." SET orden = '".$objeto->orden."' WHERE idlangprincipal='" . $objeto->idlangprincipal."' AND lang <> '".$objeto->lang."'" ;

		$this->visit->debuger->out("updateIdlangprincipal-". $objeto->getNombreTabla() ."-: $sql");

		$ret = $this->conn->Execute( $sql );

	}	

	/*

	 * Devuelve si el Idpadre tiene hijos. Necesita del array dictFilasNav

	 */

	function hayHijosArray($idP, $arr1){

		global $visit;

		//reset($arr1);

		$res = false;

		foreach($arr1 as $key=>$value){

			if($value->idpadre == $idP) {

				return true;				

			}

		}

		return $res;

	}

		

	/*

	 * Devuelve si el Idpadre tiene hijos filtrando según el Rol del usuario. 

	 * Necesita del array dictFilasNav

	 */

	function hayHijosRolArray($idP, $arr1){

		global $visit;

		//reset($arr1);



		$userId = $visit->options->usuario->id;

		$permisos = $this->getPermisosFromUsuario($userId);

		$permisosId = array();

		for($i=0;$i<count($permisos);$i++) {

				array_push($permisosId,$permisos[$i]->idov);

		}

		//$admin = $visit->options->usuario->rol=="B";

		//$superadmin = $visit->options->usuario->rol=="A";



		foreach($arr1 as $key=>$value){

			if( ($value->idpadre == $idP) && $visit->util->inArray($permisosId,$idP) ) {

				return true;

			}

		}

		return false;

	}



	/*

	* Obtiene el objeto del primer hijo visible de este padre

	*/

	function getPrimerHijoVisible($idpadre) {

		global $visit;

		$objeto = new ClsNavegacion();

		$strWhere =" WHERE  visible = 'S' and idpadre='" .$idpadre. "'";

		$strOrderBy =" ORDER BY orden";

		$sql ="SELECT ". $objeto->getCampos() ." FROM ". $objeto->getNombreTabla() . $strWhere . $strOrderBy;

		$this->visit->debuger->out("getPrimerHijoVisible: ". $objeto->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $objeto,0,1 );

		return $collection[0];

	}



	function getPrimerHijoNavegacion($id) {

		global $visit;

		$res="";

		$hijo = $this->getPrimerHijoVisible($id);

		if ($hijo=="") return "";

		if ($hijo->tipo_contenido=="H") {

			$res = $this->getPrimerHijoNavegacion($hijo);

		} else {

			$res = $hijo;

		}

		return $res;

	}



	/*

	* Obtiene el objeto del primer hijo visible de este padre

	*/

	function getPrimerHijoCatalogoVisible($idpadre) {

		global $visit;

		$objeto = new ClsSeccionesCatalogo();

		$strWhere =" WHERE  visible = 'S' and idpadre='" .$idpadre. "'";

		$strOrderBy =" ORDER BY orden";

		$sql ="SELECT ". $objeto->getCampos() ." FROM ". $objeto->getNombreTabla() . $strWhere . $strOrderBy;

		$this->visit->debuger->out("getPrimerHijoCatalogoVisible: ". $objeto->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $objeto,0,1 );

		return $collection[0];

	}



	function getPrimerHijoCatalogo($id) {

		global $visit;

		$res="";

		$hijo = $this->getPrimerHijoCatalogoVisible($id);

		if ($hijo=="") return "";

		if ($hijo->tipo_contenido=="H") {

			$res = $this->getPrimerHijoCatalogo($hijo);

		} else {

			$res = $hijo;

		}

		return $res;

	}





	

	function &getCountImagenesFromPagina($id, $lang) {

		global $visit;	

		$objeto= new ClsImagenespaginas ();

		$strWhere =" WHERE  idpaginaimagenes='".$id."' AND lang='".$lang."'";

		$strOrderBy =" ORDER BY ORDEN";

		$sql ="SELECT COUNT(*) AS CUENTA FROM ". $objeto->getNombreTabla() . $strWhere . $strOrderBy;

		$this->visit->debuger->out("&getCountImagenesFromPagina: $sql");		

		$collection = $this->conn->GetAll($sql);

		return $collection[0]["CUENTA"];

	}





	function &getTablaImagenesFromPaginaLimit($id, $lang, $from, $count) {

		global $visit;

		

		$objeto= new ClsImagenespaginas ();

		$strWhere =" WHERE  idpaginaimagenes='".$id."' AND lang='".$lang."'";

		$strOrderBy =" ORDER BY  orden IS NULL, orden";

		$sql ="SELECT ". $objeto->getCampos() ." FROM ". $objeto->getNombreTabla() . $strWhere . $strOrderBy;

		$this->visit->debuger->out("getTablaImagenesFromPagina: ". $objeto->getNombreTabla() ."-: $sql");

		$collection = $this->execSQLLimit( $sql, $objeto, $from, $count );

		return $collection;

	}





	function &getSuscripcionesBoletinFromCorreo($correo) {

		$e = new ClsSuscripcionesBoletin();

		$e->correo = $correo;

		$res="";

		if ($correo!="") {

			$col = $this->getTablaFiltrada($e);

			$res = $col[0];

		}

		return $res;

	}



	function &getContenidosboletinFromIdboletin($idboletin, $localizacion) {

		$e = new ClsContenidosboletin();

		if ( $localizacion!=""){ 

			$sql ="SELECT ". $e->getCampos() ." FROM ". $e->getNombreTabla() . " WHERE idboletin='".$idboletin."' AND localizacion ='".$localizacion."' ORDER BY orden";

		}else{

			$sql ="SELECT ". $e->getCampos() ." FROM ". $e->getNombreTabla() . " WHERE idboletin='".$idboletin."'";

		}

		$this->visit->debuger->out("getNoticiasBoletinFromIdboletines: $sql");

		$collection = $this->execSQL( $sql, $e);

		return $collection;		

	}

	







	function &getNumeroBoletin() {

		global $visit;

		$e = new ClsBoletines();

		$sql ="SELECT ". $e->getCampos() ." FROM ". $e->getNombreTabla() . " ORDER BY numero DESC";

		$collection = $this->execSQL( $sql, $e );

		$this->visit->debuger->out("getNumeroPresupuesto-". $e->getNombreTabla() ."-: $sql");

		return $collection[0]->numero;

	}





	function getCorreosFromListas($e) {

		global $visit;

		$res="";

		$op="OR";

		$obj = new ClsSuscripcionesBoletin();

		$v=explode(",",$e->listas);

		for ($i=0;$i<count($v);$i++) {

			$valor = $v[$i];			

			if ($valor!="") {

				if ($res!="") $res .= " $op ";

				$res .= "CONCAT(',',listas,',') LIKE '%,".$valor.",%'";

			}

		}



		/*if ($res!="") {

			if ($res!= "") $res = "(".$res.") AND ";

			$res .= " confirmado = 'S'";

		}*/



		$strWhere = " WHERE ". $res;

		$sql ="SELECT id,correo,confirmado,guid FROM ". $obj->getNombreTabla() . $strWhere . " ORDER by id";

		$this->visit->debuger->out("&getCorreosFromListas: $sql");



		$collection = $this->execSQL( $sql, $obj );		

		return $collection;

	}

	



	function persistJerarquiaMenosIdlangprincipal( $objeto, $idlangprincipal) {

		$nobjeto = $objeto;

		

		$sql = "UPDATE " . $objeto->getNombreTabla() ." SET es_jerarquia='N' WHERE idlangprincipal <> " . $idlangprincipal;

		$this->visit->debuger->out("persist-". $objeto->getNombreTabla() ."-: $sql");

		$ret = $this->conn->Execute( $sql );

		

		return $nobjeto;

	}



	function getJerarquiaFromAtributosJerarquia($lang) {

		

		$e = new ClsAtributosJerarquia();		

		$sql ="SELECT ". $e->getCampos() ." FROM ". $e->getNombreTabla() . " WHERE es_jerarquia='S' AND lang='".$lang."'";

		$this->visit->debuger->out("getJerarquiaFromAtributosJerarquia: $sql");

		$collection = $this->execSQL( $sql, $e);

		return $collection[0];		

	}



	function computeAtributosCompartidos($id){

		global $visit;

		$obj= new ClsSectionData();

		$where ="  vocabulario = '".$id."'";

		$strWhere =" WHERE ". $where;

		$sql ="SELECT id FROM ". $obj->getNombreTabla() . $strWhere ;

		$idseccions = $this->execSQL( $sql, $obj );

		$collection = array();

		for($i=0;$i<count($idseccions);$i++){

			$seccion_it = $idseccions[$i];

			///echo $seccion_it->id."<br>";

			$collection_it = $this->getAtributosContrFromIdSeccionRec($seccion_it->id);

			$collection = array_merge($collection, $collection_it);

		}



		return $collection;

	}

	function getAtributosContrFromIdSeccion($id){

		global $visit;

		$seccion = $this->getSectionDataFromId($id);

		$collection = array();

		if($seccion->vocabulario==0){

			$collection = $this->getAtributosContrFromIdSeccionRec($id);

		} else if($seccion->vocabulario==1){

			$collection_propios = $this->getAtributosContrFromIdSeccionRec($id);

			$collection_otros = $this->computeAtributosCompartidos($id);

			if(!is_array($collection_propios)){

				$collection_propios = array();

			}

			if(!is_array($collection_otros)){

				$collection_otros = array();

			}

			$collection = array_merge($collection_propios, $collection_otros);

			$collection = $visit->util->elimina_duplicados($collection,"value");



		} else {

			$collection_propios = $this->getAtributosContrFromIdSeccionRec($seccion->id);

			/*

			echo "<br>--------PROPIOS----------<br>";

			while (list ($clave2, $valor) = each ($collection_propios)) { 

				echo $valor->value."<br>";

			}

			*/

			$collection_otros = $this->computeAtributosCompartidos($seccion->vocabulario);

			/*

			echo "<br>--------OTROS----------<br>";

			while (list ($clave2, $valor) = each ($collection_otros)) { 

				echo $valor->value."<br>";

			}

			*/

			if(!is_array($collection_propios)){

				$collection_propios = array();

			}

			if(!is_array($collection_otros)){

				$collection_otros = array();

			}

			$collection = array_merge($collection_propios, $collection_otros);

			$collection_compartidor = $this->getAtributosContrFromIdSeccionRec($seccion->vocabulario);

			$collection = array_merge($collection, $collection_compartidor);



			$collection = $visit->util->elimina_duplicados($collection,"value");

		}

		if(!is_array($collection)){

			$collection = array();

		}

		return $collection;

	}

	function getAtributosContrFromIdSeccionRec($id){

		global $visit;

		$obj= new ClsControlledData();

		$where ="  idov>0 AND idseccion = ".$id;

		$strWhere =" WHERE ". $where;

		$sql ="SELECT distinct value FROM ". $obj->getNombreTabla() . $strWhere ;

		$this->visit->debuger->out("getAtributosFromIdSeccion: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $obj );

		return $collection;

	}

	// Dada una sección, devuelve todos sus atributos Controlled

	function getTodosContrFromIdSeccion($id){

		global $visit;

		$obj= new ClsControlledData();

		$where ="  idseccion = '".$id."'";

		$strWhere =" WHERE ". $where;

		$sql ="SELECT ".$obj->getCampos()." FROM ". $obj->getNombreTabla() . $strWhere ;

		$this->visit->debuger->out("getAtributosFromIdSeccion: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $obj );

		return $collection;

	}

	// Dada una sección, devuelve todos sus atributos Text

	function getTodosTextFromIdSeccion($id){

		global $visit;

		$obj= new ClsTextData();

		$where ="  idseccion = '".$id."'";

		$strWhere =" WHERE ". $where;

		$sql ="SELECT ".$obj->getCampos()." FROM ". $obj->getNombreTabla() . $strWhere ;

		$this->visit->debuger->out("getAtributosFromIdSeccion: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $obj );

		return $collection;

	}

	// Dada una sección, devuelve todos sus atributos Numericos

	function getTodosNumFromIdSeccion($id){

		global $visit;

		$obj= new ClsNumericData();

		$where ="  idseccion = '".$id."'";

		$strWhere =" WHERE ". $where;

		$sql ="SELECT ".$obj->getCampos()." FROM ". $obj->getNombreTabla() . $strWhere ;

		$this->visit->debuger->out("getAtributosFromIdSeccion: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $obj );

		return $collection;

	}

	// Dada una sección, devuelve todos sus atributos Date

	function getTodosDateFromIdSeccion($id){

		global $visit;

		$obj= new ClsDateData();

		$where ="  idseccion = '".$id."'";

		$strWhere =" WHERE ". $where;

		$sql ="SELECT ".$obj->getCampos()." FROM ". $obj->getNombreTabla() . $strWhere ;

		$this->visit->debuger->out("getAtributosFromIdSeccion: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $obj );

		return $collection;

	}

	// Dada una sección, devuelve todos sus atributos Controlled

	function getTodosContrFromIdOV($id){

		global $visit;

		$obj= new ClsControlledData();

		$where ="  idov = '".$id."'";

		$strWhere =" WHERE ". $where;

		$sql ="SELECT ".$obj->getCampos()." FROM ". $obj->getNombreTabla() . $strWhere ;

		$this->visit->debuger->out("getAtributosFromIdOV: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $obj );

		return $collection;

	}

	// Dada una sección, devuelve todos sus atributos Datos

	function getTodosDateFromIdOV($id){

		global $visit;

		$obj= new ClsDateData();

		$where ="  idov = '".$id."'";

		$strWhere =" WHERE ". $where;

		$sql ="SELECT ".$obj->getCampos()." FROM ". $obj->getNombreTabla() . $strWhere ;

		$this->visit->debuger->out("getAtributosFromIdOV: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $obj );

		return $collection;

	}

	

	// Dada un objeto virtual, devuelve todos sus atributos Text

	function getTodosTextFromIdOV($id){

		global $visit;

		$obj= new ClsTextData();

		$where ="  idov = '".$id."'";

		$strWhere =" WHERE ". $where;

		$sql ="SELECT ".$obj->getCampos()." FROM ". $obj->getNombreTabla() . $strWhere ;

		$this->visit->debuger->out("getTodosTextFromIdOV: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $obj );

		return $collection;

	}

	// Dada un objeto virtual, devuelve todos sus atributos Numericos

	function getTodosNumFromIdOV($id){

		global $visit;

		$obj= new ClsNumericData();

		$where ="  idov = '".$id."'";

		$strWhere =" WHERE ". $where;

		$sql ="SELECT ".$obj->getCampos()." FROM ". $obj->getNombreTabla() . $strWhere ;

		$this->visit->debuger->out("getTodosNumFromIdOV: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $obj );

		return $collection;

	}

	// Dada un recurso, devuelve todos sus atributos, de la clase del objeto que se pase como parámetro

	function getTodosFromIdRecurso($obj,$id){

		global $visit;

		$where ="  idrecurso = '".$id."'";

		$strWhere =" WHERE ". $where;

		$sql ="SELECT ".$obj->getCampos()." FROM ". $obj->getNombreTabla() . $strWhere ;

		$this->visit->debuger->out("getAtributosFromIdSeccion: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $obj );

		return $collection;

	}

	// Dada una section data, devuelve todos las secciones que tengan ese idov y ese idrecurso

	function getTodasSectionFromIdovEIdRecurso($obj,$idov, $idRecurso){

		global $visit;

		$where =" idov = ".$idov." AND idrecurso = ".$idRecurso;

		$strWhere =" WHERE ". $where;

		$sql ="SELECT ".$obj->getCampos()." FROM ". $obj->getNombreTabla() . $strWhere ;

		//echo $sql."<br>";

		$this->visit->debuger->out("getAtributosFromIdSeccion: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $obj );

		return $collection;

	}

	

	function obtenerAtributoContrFromSeccionOV($idSec,$idOv){

		global $visit;

		$obj= new ClsControlledData();

		$where ="  idseccion =  ".$idSec." AND idov = ".$idOv;

		$strWhere =" WHERE ". $where;

		$sql ="SELECT ".$obj->getCampos()." FROM ". $obj->getNombreTabla() . $strWhere ;

		$this->visit->debuger->out("getAtributoContrFromSeccionOV: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $obj );

		return $collection[0];

	}	

	/*function obtenerAtributoContrFromSeccionRecursoOV($idSec,$idOv,$idRec){

		global $visit;

		$obj= new ClsControlledData();

		$where ="  idseccion =  ".$idSec." AND idov = ".$idOv." AND idrecurso=".$idRec;

		$strWhere =" WHERE ". $where;

		$sql ="SELECT ".$obj->getCampos()." FROM ". $obj->getNombreTabla() . $strWhere ;

		$this->visit->debuger->out("obtenerAtributoContrFromSeccionRecursoOV: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $obj );

		return $collection[0];

	}

	*/

	function obtenerAtributoTextFromSeccionOV($idSec,$idOv){

		global $visit;

		$obj= new ClsTextData();

		$where ="  idseccion = ".$idSec." AND idov = ".$idOv;

		$strWhere =" WHERE ". $where;

		$sql ="SELECT ".$obj->getCampos()." FROM ". $obj->getNombreTabla() . $strWhere ;

		$this->visit->debuger->out("getAtributoTextFromSeccionOV: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $obj );

		return $collection[0];

	}	

	

	/*

		function obtenerAtributoTextFromSeccionRecursoOV($idSec,$idOv,$idRec){

		global $visit;

		$obj= new ClsTextData();

		$where ="  idseccion =  ".$idSec." AND idov = ".$idOv." AND idrecurso=".$idRec;

		$strWhere =" WHERE ". $where;

		$sql ="SELECT ".$obj->getCampos()." FROM ". $obj->getNombreTabla() . $strWhere ;

		$this->visit->debuger->out("getAtributoContrFromSeccionOV: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $obj );

		return $collection[0];

	}	

	*/

	function obtenerAtributoDateFromSeccionOV($idSec,$idOv){

		global $visit;

		$obj= new ClsDateData();

		$where ="  idseccion = ".$idSec." AND idov = ".$idOv;

		$strWhere =" WHERE ". $where;

		$sql ="SELECT ".$obj->getCampos()." FROM ". $obj->getNombreTabla() . $strWhere ;

		$this->visit->debuger->out("getAtributoDateFromSeccionOV: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $obj );

		return $collection[0];

	}	

	

	function obtenerAtributoNumFromSeccionOV($idSec,$idOv){

		global $visit;

		$obj= new ClsNumericData();

		$where ="  idseccion = ".$idSec." AND idov = ".$idOv;

		$strWhere =" WHERE ". $where;

		$sql ="SELECT ".$obj->getCampos()." FROM ". $obj->getNombreTabla() . $strWhere ;

		$this->visit->debuger->out("obtenerAtributoNumFromSeccionOV: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $obj );

		return $collection[0];

	}

		function obtenerAtributoFromSeccionRecursoOV($obj,$idSec,$idOv,$idRec){

		global $visit;

		//$obj= new ClsNumericData();

		$where ="  idseccion =  ".$idSec." AND idov = ".$idOv." AND idrecurso=".$idRec;

		$strWhere =" WHERE ". $where;

		$sql ="SELECT ".$obj->getCampos()." FROM ". $obj->getNombreTabla() . $strWhere ;

		$this->visit->debuger->out("obtenerAtributoFromSeccionRecursoOV: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $obj );

		return $collection[0];

	}	



/*		function obtenerAtributoNumFromSeccionRecursoOV($idSec,$idOv,$idRec){

		global $visit;

		$obj= new ClsNumericData();

		$where ="  idseccion =  ".$idSec." AND idov = ".$idOv." AND idrecurso=".$idRec;

		$strWhere =" WHERE ". $where;

		$sql ="SELECT ".$obj->getCampos()." FROM ". $obj->getNombreTabla() . $strWhere ;

		$this->visit->debuger->out("getAtributoContrFromSeccionOV: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $obj );

		return $collection[0];

	}	

*/

	function obtenerAtributoValorContrFromSeccionOV($idSec,$idOv){

		global $visit;

		$obj= new ClsControlledData();

		$where ="  idseccion =  ".$idSec." AND idov = ".$idOv;

		$strWhere =" WHERE ". $where;

		$sql ="SELECT distinct value FROM ". $obj->getNombreTabla() . $strWhere ;

		$this->visit->debuger->out("obtenerAtributoValorContrFromSeccionOV: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $obj ); 

		return $collection[0];

	}

	

	function obtenerAtributoValorTextFromSeccionOV($idSec,$idOv){

		global $visit;

		$obj= new ClsTextData();

		$where ="  idseccion = ".$idSec." AND idov = ".$idOv. " AND value is not null";

		$strWhere =" WHERE ". $where;

		$sql ="SELECT distinct value FROM ". $obj->getNombreTabla() . $strWhere ;

		$this->visit->debuger->out("getAtributoTextFromSeccionOV: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $obj );

		return $collection[0];

	}	

	function obtenerAtributoValorTextFromSeccionRecursoOV($idSec,$idOv,$idRec){

		global $visit;

		$obj= new ClsTextData();

		$where ="  idseccion = ".$idSec." AND idov = ".$idOv." AND idrecurso = ".$idRec;

		$strWhere =" WHERE ". $where;

		$sql ="SELECT distinct value FROM ". $obj->getNombreTabla() . $strWhere ;

		$this->visit->debuger->out("obtenerAtributoValorTextFromSeccionRecursoOV: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $obj );

		return $collection[0];

	}

	function obtenerAtributoValorContrFromSeccionRecursoOV($idSec,$idOv,$idRec){

		global $visit;

		$obj= new ClsControlledData();

		$where ="  idseccion = ".$idSec." AND idov = ".$idOv." AND idrecurso = ".$idRec;

		$strWhere =" WHERE ". $where;

		$sql ="SELECT distinct value FROM ". $obj->getNombreTabla() . $strWhere ;

		$this->visit->debuger->out("obtenerAtributoValorContrFromSeccionRecursoOV: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $obj );

		return $collection[0];

	}

	function obtenerAtributoValorNumFromSeccionRecursoOV($idSec,$idOv,$idRec){

		global $visit;

		$obj= new ClsNumericData();

		$where ="  idseccion = ".$idSec." AND idov = ".$idOv." AND idrecurso = ".$idRec;

		$strWhere =" WHERE ". $where;

		$sql ="SELECT distinct value FROM ". $obj->getNombreTabla() . $strWhere ;

		$this->visit->debuger->out("obtenerAtributoValorNumFromSeccionRecursoOV: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $obj );

		return $collection[0];

	}

	function obtenerAtributoValorNumFromSeccionOV($idSec,$idOv){

		global $visit;

		$obj= new ClsNumericData();

		$where ="  idseccion = ".$idSec." AND idov = ".$idOv;

		$strWhere =" WHERE ". $where;

		$sql ="SELECT distinct value FROM ". $obj->getNombreTabla() . $strWhere ;

		$this->visit->debuger->out("obtenerAtributoValorNumFromSeccionOV: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $obj );

		return $collection[0];

	}

	function obtenerAtributoValorDateFromSeccionOV($idSec,$idOv){

		global $visit;

		$obj= new ClsDateData();

		$where ="  idseccion = ".$idSec." AND idov = ".$idOv;

		$strWhere =" WHERE ". $where;

		$sql ="SELECT distinct value FROM ". $obj->getNombreTabla() . $strWhere ;

		$this->visit->debuger->out("obtenerAtributoValorDateFromSeccionOV: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $obj );

		return $collection[0];

	}

	

	function getRecursoFromId($id){

		global $visit;

		$obj= new ClsResources();

		$where =" id = ".$id;

		$strWhere =" WHERE ". $where;

		$sql ="SELECT ".$obj->getCampos()." FROM ". $obj->getNombreTabla() . $strWhere . " ORDER BY ordinal, type DESC, visible";

		$this->visit->debuger->out("getRecursoFromId: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $obj );

		return $collection[0];

	}

	function getRecursosFromOV($idOv){

		global $visit;

		$obj= new ClsResources();

		$where =" idov = ".$idOv;

		$strWhere =" WHERE ". $where;

		$sql ="SELECT ".$obj->getCampos()." FROM ". $obj->getNombreTabla() . $strWhere . " ORDER BY ordinal, type DESC, visible";

		$this->visit->debuger->out("getRecursosFromOV: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $obj );

		return $collection;

	}

	function getRecursosVisiblesFromOV($idOv){

		global $visit;

		$obj= new ClsResources();

		$where =" idov = ".$idOv." AND visible='S' ";

		$strWhere =" WHERE ". $where;

		$sql ="SELECT ".$obj->getCampos()." FROM ". $obj->getNombreTabla() . $strWhere . " ORDER BY ordinal, type DESC, visible";

		$this->visit->debuger->out("getRecursosFromOV: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $obj );

		return $collection;

	}

	

		function getRecursosFromOVNombre($idOv,$nombre){

		global $visit;

		$obj= new ClsResources();

		$where =" idov = ".$idOv." AND name='".$nombre."'";

		$strWhere =" WHERE ". $where;

		$sql ="SELECT ".$obj->getCampos()." FROM ". $obj->getNombreTabla() . $strWhere ;

		$this->visit->debuger->out("getRecursosFromOVNombre: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $obj );

		return $collection[0];

	}

	function getRecursosPropiosFromOV($idOv){

		global $visit;

		$obj= new ClsResources();

		// alfredo 140720   $where =" idov = ".$idOv." AND type= 'P' ";

		 $where =" idov = ".$idOv." AND (type= 'P' OR type= 'H') ";

		$strWhere =" WHERE ". $where;

		$sql ="SELECT ".$obj->getCampos()." FROM ". $obj->getNombreTabla() . $strWhere ;

		$this->visit->debuger->out("getRecursosPropiosFromOV: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $obj );

		return $collection;

	}

	function getRecursosForeignFromOV($idOv){

		global $visit;

		$obj= new ClsResources();

		$where =" idov_refered='".$idOv."' AND type= 'F' "; //alfredo 140728

		$strWhere =" WHERE ". $where;

		$sql ="SELECT ".$obj->getCampos()." FROM ". $obj->getNombreTabla() . $strWhere ;

		$this->visit->debuger->out("getRecursosForeignFromOV: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $obj );

		return $collection;

	}

	function getRecursosForeignFromOVRefered($idOv){

		global $visit;

		$obj= new ClsResources();

		$where =" idov_refered='".$idOv."' AND type= 'OV' ";

		$strWhere =" WHERE ". $where;

		$sql ="SELECT ".$obj->getCampos()." FROM ". $obj->getNombreTabla() . $strWhere ;

		$this->visit->debuger->out("getRecursosForeignFromOV: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $obj );

		return $collection;

	}

	function getRecursosOVFromOV($idOv){

		global $visit;

		$obj= new ClsResources();

		$where =" idov = ".$idOv." AND type= 'OV' ";

		$strWhere =" WHERE ". $where;

		$sql ="SELECT ".$obj->getCampos()." FROM ". $obj->getNombreTabla() . $strWhere ;

		$this->visit->debuger->out("getRecursosOVFromOV: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $obj );

		return $collection;

	}

	function getSeccionesFromIdPadre($id){

		global $visit;

		if($visit->options->secciones==""){

			$obj= new ClsSectionData();

			$where =" idpadre = ".$id;

			$strWhere =" WHERE ". $where;

			$sql ="SELECT ".$obj->getCampos()." FROM ". $obj->getNombreTabla() . $strWhere . " ORDER BY orden";

			$this->visit->debuger->out("getSeccionesFromIdPadre: ". $obj->getNombreTabla() ."-: $sql");

			$collection = $this->execSQL( $sql, $obj );

		}else{

			$collection = ClsSectionData::getSeccionesFromIdPadreCache($id);

		}



		return $collection;

	}

	function getSeccionesNavegablesFromIdPadre($id){

		global $visit;

		$obj= new ClsSectionData();

		$where =" idpadre = ".$id;

		$strWhere =" WHERE ". $where;

		$sql ="SELECT ".$obj->getCampos()." FROM ". $obj->getNombreTabla() . $strWhere ." ORDER BY orden";

		$this->visit->debuger->out("getSeccionesNavegablesFromIdPadre: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $obj );		

		return $collection;

	}

	

	function getSeccionesNavegablesFromIdPadreVisibles($id){

		global $visit;



		if($visit->options->secciones==""){

			$obj= new ClsSectionData();

			$where =" visible='S' AND idpadre = ".$id;

			$strWhere =" WHERE ". $where;

			$sql ="SELECT ".$obj->getCampos()." FROM ". $obj->getNombreTabla() . $strWhere ." ORDER BY orden";

			$this->visit->debuger->out("getSeccionesNavegablesFromIdPadreVisibles: ". $obj->getNombreTabla() ."-: $sql");

			$collection = $this->execSQL( $sql, $obj );		

		}else{

			$collection = ClsSectionData::getSeccionesNavegablesFromIdPadreVisiblesCache($id);

		}



		return $collection;

	}



	function getIdRecurso(){

		global $visit;

		$obj= new ClsSectionData();

		$where =" codigo = 'recursos' ";

		$strWhere =" WHERE ". $where;

		$sql ="SELECT ".$obj->getCampos()." FROM ". $obj->getNombreTabla() . $strWhere ;

		$this->visit->debuger->out("getIdRecurso: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $obj );

		return $collection[0];

	

	}

	function getIdMetadatos(){

		global $visit;

		$obj= new ClsSectionData();

		$where =" codigo = 'lom' ";

		$strWhere =" WHERE ". $where;

		$sql ="SELECT ".$obj->getCampos()." FROM ". $obj->getNombreTabla() . $strWhere ;

		$this->visit->debuger->out("getIdRecurso: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $obj );

		return $collection[0];

	

	}

	function getIdDatos(){

		global $visit;

		$obj= new ClsSectionData();

		$where =" codigo = 'datos' ";

		$strWhere =" WHERE ". $where;

		$sql ="SELECT ".$obj->getCampos()." FROM ". $obj->getNombreTabla() . $strWhere ;

		$this->visit->debuger->out("getIdRecurso: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $obj );

		return $collection[0];

	

	}

	function getIdClasificacion(){

		global $visit;

		$obj= new ClsSectionData();

		$where =" nombre = 'clasificacion' ";

		$strWhere =" WHERE ". $where;

		$sql ="SELECT ".$obj->getCampos()." FROM ". $obj->getNombreTabla() . $strWhere ;

		$this->visit->debuger->out("getIdClasificacion: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $obj );

		return $collection[0];

	

	}

	function getIdSeccion(){

		global $visit;

		$obj= new ClsSectionData();

		$where =" nombre = 'seccion' ";

		$strWhere =" WHERE ". $where;

		$sql ="SELECT ".$obj->getCampos()." FROM ". $obj->getNombreTabla() . $strWhere ;

		$this->visit->debuger->out("getIdSeccion: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $obj );

		return $collection[0];

	

	}

	function getTodosOV(){

		$obj=new ClsVirtualObject();

		$sql = "SELECT ".$obj->getCampos()." FROM ".$obj->getNombreTabla()." ORDER BY id";

		$this->visit->debuger->out("getTodosOV: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $obj );

		return $collection;

	}

	function getTodosOVOrden($orden){

		$obj = new ClsTextData();

		$sql = "SELECT * FROM text_data INNER JOIN virtual_object ON (virtual_object.id = text_data.idov) AND (text_data.idseccion='".$orden."') ORDER BY value";

		$this->visit->debuger->out("getTodosOVPublicosOrden: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $obj );

		return $collection;

	}

	function getSiguienteIdOV($id){

		$obj=new ClsVirtualObject();

		$sql = "SELECT  id FROM virtual_object WHERE id>".$id." order by id ";

		$this->visit->debuger->out("getSiguienteOV: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $obj );

		return $collection[0];

	}

	function getSiguienteIdOVOrden($id,$orden){

		$obj = new ClsTextData();

		$sql = "SELECT * FROM text_data INNER JOIN virtual_object ON (virtual_object.id = text_data.idov) AND (text_data.idseccion='".$orden."') WHERE virtual_object.id>".$id." ORDER BY value";

		$this->visit->debuger->out("getSiguienteIdOVOrden: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $obj );

		return $collection[0];

	}

	function getAnteriorIdOV($id){

		$obj=new ClsVirtualObject();

		$sql = "SELECT  id FROM virtual_object WHERE id<".$id." order by id desc";

		$this->visit->debuger->out("getSiguienteOV: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $obj );

		return $collection[0];

	}

	function getAnteriorIdOVOrden($id,$orden){

		$obj = new ClsTextData();

		$sql = "SELECT * FROM text_data INNER JOIN virtual_object ON (virtual_object.id = text_data.idov) AND (text_data.idseccion='".$orden."') WHERE virtual_object.id<".$id." ORDER BY value desc";

		///echo $sql;

		$this->visit->debuger->out("getSiguienteIdOVOrden: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $obj );

		return $collection[0];

	}

	function getAnteriorIdOVOrdenPublico($id,$orden){

		$obj = new ClsTextData();

		$sql = "SELECT * FROM text_data INNER JOIN virtual_object ON (virtual_object.id = text_data.idov) AND (text_data.idseccion='".$orden."') WHERE virtual_object.id<".$id." AND virtual_object.ispublic='S' ORDER BY value desc";

		$this->visit->debuger->out("getSiguienteIdOVOrden: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $obj );

		return $collection[0];

	}

	function getUltimoIdOV($id){

		$obj=new ClsVirtualObject();

		$sql = "SELECT   id FROM virtual_object order by id desc";

		$this->visit->debuger->out("getSiguienteOV: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $obj );

		return $collection[0];

	}

	function getUltimoIdOVOrden($id,$orden){

		$obj = new ClsTextData();

		$sql = "SELECT * FROM text_data INNER JOIN virtual_object ON (virtual_object.id = text_data.idov) AND (text_data.idseccion='".$orden."') ORDER BY value desc";

		$this->visit->debuger->out("getUltimoIdOVOrden: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $obj );

		return $collection[0];

	}

	function getUltimoIdOVOrdenPublico($id,$orden){

		$obj = new ClsTextData();

		$sql = "SELECT * FROM text_data INNER JOIN virtual_object ON (virtual_object.id = text_data.idov) AND (text_data.idseccion='".$orden."') virtual_object.ispublic='S' AND isprivate='N' ORDER BY value desc";

		$this->visit->debuger->out("getUltimoIdOVOrden: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $obj );

		return $collection[0];

	}

	function getTodosOVPublicos(){

		$obj=new ClsVirtualObject();

		$sql = "SELECT ".$obj->getCampos()." FROM ".$obj->getNombreTabla()." WHERE isprivate='N' ORDER BY id";	

		$this->visit->debuger->out("getTodosOVPublicos: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $obj );

		

		return $collection;

	}

	function getTodosOVNoUserPublicos(){

		$obj=new ClsVirtualObject();

		$sql = "SELECT ".$obj->getCampos()." FROM ".$obj->getNombreTabla()." WHERE ispublic='S' AND isprivate='N' ORDER BY id";	

		$this->visit->debuger->out("getTodosOVNoUserPublicos: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $obj );

		return $collection;

	}

	function getTodosOVNoPrivados(){

		$obj=new ClsVirtualObject();

		$sql = "SELECT ".$obj->getCampos()." FROM ".$obj->getNombreTabla()." WHERE isprivate='N' ORDER BY id";	

		$this->visit->debuger->out("getTodosOVPublicos: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $obj );

		return $collection;

	}

	function getTodosOVPublicosOrden($orden){

		$obj = new ClsTextData();

		$sql = "SELECT * FROM text_data INNER JOIN virtual_object ON (virtual_object.id = text_data.idov) AND (text_data.idseccion='".$orden."')  WHERE  virtual_object.isprivate='N'";

		$this->visit->debuger->out("getTodosOVPublicosOrden: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $obj );

		return $collection;

	}

	function getTodosOVNoUserPublicosOrden($orden){

		$obj = new ClsTextData();

		$sql = "SELECT * FROM text_data INNER JOIN virtual_object ON (virtual_object.id = text_data.idov) AND (text_data.idseccion='".$orden."')  WHERE virtual_object.ispublic='N' AND virtual_object.isprivate='N'";

		$this->visit->debuger->out("getTodosOVPublicosOrden: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $obj );

		return $collection;

	}



	function getTodosOVNoPrivadosOrden($orden){

		$obj = new ClsTextData();

		$sql = "SELECT * FROM text_data INNER JOIN virtual_object ON (virtual_object.id = text_data.idov) AND (text_data.idseccion='".$orden."')  WHERE virtual_object.isprivate='N'";

		$this->visit->debuger->out("getTodosOVPublicosOrden: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $obj );

		return $collection;

	}

	function getSiguienteIdOVPublico($id){

		$obj=new ClsVirtualObject();

		$sql = "SELECT  id FROM virtual_object WHERE id>".$id." AND isprivate='N' order by id ";

		$this->visit->debuger->out("getSiguienteIdOVPublico: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $obj );

		return $collection[0];

	}



	function getSiguienteIdOVPublicoNoUser($id){

		$obj=new ClsVirtualObject();

		$sql = "SELECT  id FROM virtual_object WHERE id>".$id." AND ispublic='S' AND isprivate='N' order by id ";

		$this->visit->debuger->out("getSiguienteIdOVPublico: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $obj );

		return $collection[0];

	}

	function getSiguienteIdOVNoPrivado($id){

		$obj=new ClsVirtualObject();

		$sql = "SELECT  id FROM virtual_object WHERE id>".$id." AND isprivate='N' order by id ";

		$this->visit->debuger->out("getSiguienteIdOVPublico: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $obj );

		return $collection[0];

	}

	function getSiguienteIdOVOrdenPublico($id,$orden){

		$obj=new ClsVirtualObject();

		$sql = "SELECT * FROM text_data INNER JOIN virtual_object ON (virtual_object.id = text_data.idov) AND (text_data.idseccion='".$orden."') WHERE virtual_object.id>".$id." AND ispublic='S' AND isprivate='N' ORDER BY value";

		$this->visit->debuger->out("getSiguienteIdOVPublico: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $obj );

		return $collection[0];

	}

	function getSiguienteIdOVOrdenNoPrivado($id,$orden){

		$obj=new ClsVirtualObject();

		$sql = "SELECT * FROM text_data INNER JOIN virtual_object ON (virtual_object.id = text_data.idov) AND (text_data.idseccion='".$orden."') WHERE virtual_object.id>".$id." AND isprivate='N' ORDER BY value";

		$this->visit->debuger->out("getSiguienteIdOVPublico: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $obj );

		return $collection[0];

	}

	function getAnteriorIdOVPublico($id){

		$obj=new ClsVirtualObject();

		$sql = "SELECT  id FROM virtual_object WHERE id<".$id." AND ispublic='S' AND isprivate='N' order by id desc";

		$this->visit->debuger->out("getAnteriorIdOVPublico: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $obj );

		return $collection[0];

	}

	function getAnteriorIdOVNoPrivado($id){

		$obj=new ClsVirtualObject();

		$sql = "SELECT  id FROM virtual_object WHERE id<".$id." AND isprivate='N' order by id desc";

		$this->visit->debuger->out("getAnteriorIdOVPublico: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $obj );

		return $collection[0];

	}

	function getUltimoIdOVPublico($id){

		$obj=new ClsVirtualObject();

		$sql = "SELECT id FROM virtual_object WHERE ispublic='S'AND isprivate='N' order by id desc";

		$this->visit->debuger->out("getUltimoIdOVPublico: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $obj );

		return $collection[0];

	}

	function getUltimoIdOVNoPrivado($id){

		$obj=new ClsVirtualObject();

		$sql = "SELECT id FROM virtual_object WHERE isprivate='N' order by id desc";

		$this->visit->debuger->out("getUltimoIdOVPublico: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $obj );

		return $collection[0];

	}	

	function getIconoFromOV($idov){

		global $visit;

		$obj=new ClsResources();

		$sql = "SELECT  * FROM resources where iconoov='S' and idov=".$idov." order by id ";

		$this->visit->debuger->out("getIconoFromOV: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $obj );

		/*$icono = $collection[0];

		if($icono->idresource_refered !=""){

			$res = $visit->dbBuilder->getIconoFromOV($icono->idresource_refered);			

		}

		else{

			$res = $collection[0];

		}*/

		return $collection[0];

	}

	function obtenerAtributosNumFromOV($idOv){

		global $visit;

		$obj= new ClsNumericData();

		$where ="  idov = ".$idOv;

		$strWhere =" WHERE ". $where;

		$sql ="SELECT * FROM ". $obj->getNombreTabla() . $strWhere ;

		$this->visit->debuger->out("getAtributosNumFromOV: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $obj );

		return $collection;

	}

	function obtenerAtributosDateFromOV($idOv){

		global $visit;

		$obj= new ClsDateData();

		$where ="  idov = ".$idOv;

		$strWhere =" WHERE ". $where;

		$sql ="SELECT * FROM ". $obj->getNombreTabla() . $strWhere ;

		$this->visit->debuger->out("getAtributosDateFromOV: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $obj );

		return $collection;

	}

	function obtenerAtributosTextFromOV($idOv){

		global $visit;

		$obj= new ClsTextData();

		$where ="  idov = ".$idOv;

		$strWhere =" WHERE ". $where;

		$sql ="SELECT * FROM ". $obj->getNombreTabla() . $strWhere ;

		$this->visit->debuger->out("obtenerAtributosTextFromOV: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $obj );

		return $collection;

	}

	function obtenerAtributosContFromOV($idOv){

		global $visit;

		$obj= new ClsControlledData();

		$where ="  idov = ".$idOv;

		$strWhere =" WHERE ". $where;

		$sql ="SELECT * FROM ". $obj->getNombreTabla() . $strWhere ;

		$this->visit->debuger->out("obtenerAtributosContFromOV: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $obj );

		return $collection;

	}

	//Obtiene el nombre de los objetos virtuales publicos

	function getDescripcionOVPublicos(){

		global $visit;		   

		$obj= new ClsTextData(); 

		$sql = "SELECT * FROM text_data T INNER JOIN  virtual_object V ON T.idseccion= 111 AND T.idov=V.id AND V.ispublic = 'S' AND V.isprivate!='S' order by T.idov ";

		$collection = $visit->dbBuilder->execSQL( $sql, $obj );

		return $collection;

	}	

	//Obtiene el nombre de los objetos virtuales no privados

	function getDescripcionOVNoPrivados(){

		global $visit;		   

		$obj= new ClsTextData(); 

		$sql = "SELECT * FROM text_data T INNER JOIN  virtual_object V ON T.idseccion= 111 AND T.idov=V.id AND V.isprivate!='S' order by T.idov ";

		$collection = $visit->dbBuilder->execSQL( $sql, $obj );

		return $collection;

	}

	function getDescripcionOV(){

		global $visit;		   

		$obj= new ClsTextData(); 

		$sql = "SELECT * FROM text_data T INNER JOIN  virtual_object V ON T.idseccion= 111 AND T.idov=V.id  order by T.idov ";

		$collection = $visit->dbBuilder->execSQL( $sql, $obj );

		return $collection;

	}

	

	function  getPreferenciaFromAtributoValor($atributo,$valor){

		$e = new ClsPreferenciasPresentacion();

		$sql ="SELECT COUNT(*) AS cuenta  FROM ". $e->getNombreTabla() . " WHERE atributo='".$atributo."' AND valor='".$valor."'";

		$this->visit->debuger->out("getPreferenciaFromRecurso: $sql");

		$collection = $this->conn->GetAll($sql);

		$res = $collection[0]["cuenta"] ;

		if ($res>0) return true;

		else return false;

	}



	function  getPreferenciaFromTipo($tipo){

		$e = new ClsPreferenciasPresentacion();

		$sql ="SELECT ". $e->getCampos() ."   FROM ". $e->getNombreTabla() . " WHERE tipo='".$tipo."' ORDER BY orden";

		$this->visit->debuger->out("getPreferenciaFromRecurso: $sql");

		$collection = $this->execSQL( $sql, $e );

		$res = $collection;

		return $res;

	}



	function  getPreferenciaFromTipoLang($tipo,$lang){

		$e = new ClsPreferenciasPresentacion();

		$sql ="SELECT ". $e->getCampos() ."   FROM ". $e->getNombreTabla() . " WHERE tipo='".$tipo."' AND (lang='".$lang."' OR lang IS NULL) ORDER BY orden";

		$this->visit->debuger->out("getPreferenciaFromRecurso: $sql");

		$collection = $this->execSQL( $sql, $e );

		$res = $collection;

		return $res;

	}





	function  getPreferenciaFromAtributo($atributo){

		$e = new ClsPreferenciasPresentacion();

		$sql ="SELECT ". $e->getCampos() ." FROM ". $e->getNombreTabla() . " WHERE atributo='".$atributo."'";

		$this->visit->debuger->out("getPreferenciaFromRecurso: $sql");

		$collection = $this->execSQL( $sql, $e );

		$res = $collection[0];

		return $res;

	}

	function  getValorPreferenciaFromAtributo($atributo,$lang){

		$e = new ClsPreferenciasPresentacion();

		if ($lang=="") {

			$sql ="SELECT ". $e->getCampos() ." FROM ". $e->getNombreTabla() . " WHERE atributo='".$atributo."'";

		}else{

			$sql ="SELECT ". $e->getCampos() ." FROM ". $e->getNombreTabla() . " WHERE atributo='".$atributo."' AND lang='".$lang."'";

		}

		$this->visit->debuger->out("getPreferenciaFromRecurso: $sql");

		$collection = $this->execSQL( $sql, $e );

		$res = $collection[0]->valor;

		return $res;

	}

	

		function obtenerTodosAtribsContr(){

		global $visit;

		/*

		$obj= new ClsControlledData();

		$where =" group by idseccion, value order by idseccion ";

		$sql ="SELECT idseccion,value FROM ". $obj->getNombreTabla() . $strWhere ;

		$sql2= "SELECT distinct idseccion from controlled_data";

		$this->visit->debuger->out("obtenerTodosAtribsContr: ". $obj->getNombreTabla() ."-: $sql");

		global $visit;

		$rs = $this->conn->Execute($sql);  

		$rs2= $this->conn->Execute($sql2);

		if ($rs2) {

			if ($rs) {

				while ($arr2 = $rs2->FetchRow()) {

					 $idsec = $arr2["idseccion"];

					 $linea="";

					 while ($arr = $rs->FetchRow()) {

								$idseccion = $arr["idseccion"];

								$value = $arr["value"];

								$linea .= $value.",";

								$collection[$idsec] =$linea;

								echo var_dump($collection)."<br>";

								

						 }

				}

			}

		}

*/

/*

		$obj= new ClsControlledData();

		$where =" group by idseccion, value order by idseccion,value ";

		$sql ="SELECT idseccion,value FROM ". $obj->getNombreTabla() . $strWhere ;

		$this->visit->debuger->out("obtenerTodosAtribsContr: ". $obj->getNombreTabla() ."-: $sql");

		$rs = $this->conn->Execute($sql);  

		$col=array();

		if ($rs) {

			while ($arr = $rs->FetchRow()) {

				$idsec = $arr["idseccion"];

				if ($col[ $arr["idseccion"] ]=="") $col[ $arr["idseccion"] ]=array();

				$col[ $arr["idseccion"] ][]=$arr["value"];

				//print $idsec;

			}

		}

		var_dump($col);

		*/

		//$collection = $this->execSQL( $sql, $obj );

		//echo var_dump($collection);

		return $collection;

	}



	//Devuelve si hay hijos con valor

	function hayHijosNavegablesClasificacion($idsec,$acum_navegacion){

		global $visit;		

		$dictFilasSectionData = $visit->options->sectionData;

		if($idsec!= ""){

			$seccionesNavegabl= explode(",",$visit->util->f1($idsec));

			foreach($seccionesNavegabl as $k=>$secHija){

				//$seccion=$visit->dbBuilder->getSectionDataId($secHija);

				$seccion=$dictFilasSectionData[$secHija];

				//var_dump($seccion);

				if($seccion->id!=""){

					if ($seccion->tipo_valores=="C") {

						$controlados=$visit->dbBuilder->getHijosFromValorControlado($seccion->id,$acum_navegacion);

					}  else if ($seccion->tipo_valores=="N") {

						$controlados=$visit->dbBuilder->getHijosFromValorNumerico($seccion->id,$acum_navegacion);

					}  else if ($seccion->tipo_valores=="T") {

						$controlados=$visit->dbBuilder->getHijosFromValorTexto($seccion->id,$acum_navegacion);

					}else if ($seccion->tipo_valores =="F"){

						$controlados = $visit->dbBuilder->getHijosFromFecha($seccion->id,$acum_navegacion);	

					}else if ($seccion->tipo_valores =="X"){	

						$res = $visit->dbBuilder->hayHijosNavegablesClasificacion($seccion->id,$acum_navegacion);	

						if($res) return true;

					}else{

						$controlados=$visit->dbBuilder->getHijosFromValorControlado($seccion->id,$acum_navegacion);

					}

					if($controlados != ""){

						foreach($controlados as $k1 =>$v1){

							if($v1->value != ""){

								return true;

							}

						}

					}

					//print $seccion->id."****";exit();

					$res = $visit->dbBuilder->hayHijosNavegablesClasificacion($seccion->id,$acum_navegacion);

				}

				if($res) return true;

							

			}

	

		}

		return false;	

	}

	

	//Dada una clasificacion Devuelve si tiene algun valor o si  hay hijos con valor

	function hayNavegablesClasificacion($idsec,$acum_navegacion){

		global $visit;

		$dictFilasSectionData = $visit->options->sectionData;

		$seccion=$dictFilasSectionData[$idsec];

		//$seccion=$this->getSectionDataId($idsec);	

		if($idsec!= ""){

			if ($seccion->tipo_valores=="C") {

					$controlados=$visit->dbBuilder->getHijosFromValorControlado($idsec,$acum_navegacion);

			}  else if ($seccion->tipo_valores=="N") {

					$controlados=$visit->dbBuilder->getHijosFromValorNumerico($idsec,$acum_navegacion);

			}  else if ($seccion->tipo_valores=="T") {

					$controlados=$visit->dbBuilder->getHijosFromValorTexto($idsec,$acum_navegacion);

			}  else if ($seccion->tipo_valores=="F") {

					$controlados=$visit->dbBuilder->getHijosFromFecha($idsec,$acum_navegacion);

			}else if ($seccion->tipo_valores =="X"){	

					$seccionesNavegabl= explode(",",$visit->util->f1($idsec));

					foreach ($seccionesNavegabl as $k=>$v){

						$res = $visit->dbBuilder->hayNavegablesClasificacion($v,$acum_navegacion);

						if($res) return true;

						}					

			}else{

				$controlados=$visit->dbBuilder->getHijosFromValorControlado($idsec,$acum_navegacion);

			}

			if($controlados != ""){

				foreach($controlados as $k1 =>$v1){

					if($v1->value != ""){

						return true;

					}

				}

			}	

			return false;

		}

	}

	

	// DEvuelve el valor de los controlados de una seccion

	function getHijosFromTodosControlados($idsec,$controladoresAnteriores){

		//$seccion=$this->getSectionDataId($idsec);

		$dictFilasSectionData = $visit->options->sectionData;

		$seccion=$dictFilasSectionData[$idsec];

		if ($seccion->tipo_valores=="C") {

			$controlados=$visit->dbBuilder->getHijosFromValorControlado($seccion->id,$controladoresAnteriores);

		}  else if ($seccion->tipo_valores=="N") {

			$controlados=$visit->dbBuilder->getHijosFromValorNumerico($seccion->id,$controladoresAnteriores);

		}  else if ($seccion->tipo_valores=="T") {

			$controlados=$visit->dbBuilder->getHijosFromValorTexto($seccion->id,$controladoresAnteriores);

		}  else if ($seccion->tipo_valores=="F") {

			$controlados=$visit->dbBuilder->getHijosFromFecha($seccion->id,$controladoresAnteriores);

		//}else if ($seccion->tipo_valores =="X"){	

		} else {

			$controlados=$visit->dbBuilder->getHijosFromValorControlado($seccion->id,$controladoresAnteriores);

		}

		return $controlados;

	}

	

/*

	* Dado una id seccion y un array de pares atributo valor que indican los valores de las secciones

	* Devuelve los valores controlados que cumplen las condiciones

	*/

	/*function getHijosFromValorControlado($idsec,$controladosAnteriores){

		global $visit;

		if(!is_array($visit->options->hijosValorControlado)){

			$visit->options->hijosValorControlado = array();

		}

		if(!isset($visit->options->hijosValorControlado[$idsec])){

			$obj= new ClsControlledData();

			$idsAnteriores="";

			if ($controladosAnteriores!=""){

				//var_dump($controladosAnteriores);

				while (list ($clave, $temp) = each ($controladosAnteriores)) {

					//if ($temp[0]!=null &&  $temp[1]!=null ){

					//	$idSeccion=$temp[0];

					//	$valorSeccion=$temp[1];

					if ($temp!=null &&  $clave!=null){ 

						$idSeccion = $clave;

						$valorSeccion =$temp;

						$seccion=$this->getSectionDataId($idSeccion);					

						if ($seccion->tipo_valores=="C") {

							$sqlData= "select * from controlled_data where idseccion=".$idSeccion." and value='".$valorSeccion."' " ;

						}  else if ($seccion->tipo_valores=="N") {

							$sqlData= "select * from numeric_data where idseccion=".$idSeccion." and value='".$valorSeccion."' " ;

						}  else if ($seccion->tipo_valores=="T") {

							$sqlData= "select * from text_data where idseccion=".$idSeccion." and value='".$valorSeccion."' " ;

						}  else if ($seccion->tipo_valores=="F") {

							$sqlData= "select * from date_data where idseccion=".$idSeccion." and value='".$valorSeccion."' " ;

						}  

						//echo $sqlData."***************";

						if ($idsAnteriores!="") $sqlData.= " AND idov in (".$idsAnteriores.") ";

						$temps = $this->conn->GetAll($sqlData);//var_dump($sqlData);

						$idsAnterioresCopia="";

						while (list ($claveC, $tempC) = each ($temps)) {

							$idsAnterioresCopia.= $tempC["idov"].",";

							

						}

						if ($idsAnterioresCopia!="") {

						$idsAnteriores = substr( $idsAnterioresCopia, 0, strlen($idsAnterioresCopia)-1);

						}

					}

				}

			}

			//$idsAnteriores = $visit->eliminaRepeticionesLista($idsAnteriores);

			$where =$obj->getNombreTabla().".idseccion = ".$idsec ;

			if ($idsAnteriores!="") $where.= " AND ".$obj->getNombreTabla().".idov in (".$idsAnteriores.") ";

			

			//SI NO HAY USUARIO REGISTRADO NO MOSTRAR LOS VISIBLES

			if($_SESSION["UserRolUser"] == ""){

				$strWhere =" ON ". $where;

				$strWhere = $strWhere. " AND virtual_object.ispublic = 'S' ";

				//EVITAR VALORES A NULL

				$strWhere = $strWhere. " AND ".$obj->getNombreTabla().".value IS NOT NULL ";

				$sql ="SELECT distinct value, count(*) as cuenta FROM ". $obj->getNombreTabla()." INNER JOIN virtual_object " . $strWhere." AND ".$obj->getNombreTabla().".idov=virtual_object.id  group by value order by value " ;

			} else{

				$strWhere =" WHERE ". $where;

				$superadmin = $visit->options->usuario->rol=="A";

				if (!$superadmin){

					$strWhere = " INNER JOIN virtual_object". $strWhere. " AND virtual_object.isprivate = 'N' AND ".$obj->getNombreTabla().".idov=virtual_object.id ";

				}

				//EVITAR VALORES A NULL

				$strWhere = $strWhere. " AND ".$obj->getNombreTabla().".value IS NOT NULL ";

				$sql ="SELECT distinct value, count(*) as cuenta FROM ". $obj->getNombreTabla(). $strWhere." group by value order by value " ;

			}

			//echo $sql;

			$this->visit->debuger->out("getHijosFromValorControlado: ". $obj->getNombreTabla() ."-: $sql");var_dump($sql);

			$collection = $this->execSQL( $sql, $obj );

			

			$visit->options->hijosValorControlado[$idsec] = $collection;

		}

		return $visit->options->hijosValorControlado[$idsec];

	}*/

function getHijosFromValorControlado($idsec,$controladosAnteriores){

		global $visit;

		$obj= new ClsControlledData();

		$idsAnteriores="";

		if ($controladosAnteriores!=""){

			//var_dump($controladosAnteriores);

			while (list ($clave, $temp) = each ($controladosAnteriores)) {

				/*if ($temp[0]!=null &&  $temp[1]!=null ){

					$idSeccion=$temp[0];

					$valorSeccion=$temp[1];*/

				if ($temp!=null &&  $clave!=null){ 

					$idSeccion = $clave;

					$valorSeccion =$temp;

					$seccion=$this->getSectionDataId($idSeccion);					

					if ($seccion->tipo_valores=="C") {

						$sqlData= "select * from controlled_data where idseccion=".$idSeccion." and value='".$valorSeccion."' " ;

					}  else if ($seccion->tipo_valores=="N") {

						$sqlData= "select * from numeric_data where idseccion=".$idSeccion." and value='".$valorSeccion."' " ;

					}  else if ($seccion->tipo_valores=="T") {

						$sqlData= "select * from text_data where idseccion=".$idSeccion." and value='".$valorSeccion."' " ;

					}  else if ($seccion->tipo_valores=="F") {

						$sqlData= "select * from date_data where idseccion=".$idSeccion." and value='".$valorSeccion."' " ;

					}  

					//echo $sqlData."***************";

					if ($idsAnteriores!="") $sqlData.= " AND idov in (".$idsAnteriores.") ";

					$temps = $this->conn->GetAll($sqlData);

					$idsAnterioresCopia="";

					while (list ($claveC, $tempC) = each ($temps)) {

						$idsAnterioresCopia.= $tempC["idov"].",";

						

					}

					if ($idsAnterioresCopia!="") {

					$idsAnteriores = substr( $idsAnterioresCopia, 0, strlen($idsAnterioresCopia)-1);

					}

				}

			}

		}

		//$idsAnteriores = $visit->eliminaRepeticionesLista($idsAnteriores);

		$where =$obj->getNombreTabla().".idseccion = ".$idsec ;

		if ($idsAnteriores!="") $where.= " AND ".$obj->getNombreTabla().".idov in (".$idsAnteriores.") ";

		

		//SI NO HAY USUARIO REGISTRADO NO MOSTRAR LOS VISIBLES

		if($_SESSION["UserRolUser"] == ""){

			$strWhere =" ON ". $where;

			$strWhere = $strWhere. " AND virtual_object.ispublic = 'S' ";

			//EVITAR VALORES A NULL

			$strWhere = $strWhere. " AND ".$obj->getNombreTabla().".value IS NOT NULL ";

			$sql ="SELECT distinct value, count(*) as cuenta, MIN(idov) as idov FROM ". $obj->getNombreTabla()." INNER JOIN virtual_object " . $strWhere." AND ".$obj->getNombreTabla().".idov=virtual_object.id  group by value order by value " ;

		} else{

			$strWhere =" WHERE ". $where;

			$superadmin = $visit->options->usuario->rol=="A";

			if (!$superadmin){

				$strWhere = " INNER JOIN virtual_object". $strWhere. " AND virtual_object.isprivate = 'N' AND ".$obj->getNombreTabla().".idov=virtual_object.id ";

			}

			//EVITAR VALORES A NULL

			$strWhere = $strWhere. " AND ".$obj->getNombreTabla().".value IS NOT NULL ";

			$sql ="SELECT distinct value, count(*) as cuenta, MIN(idov) as idov FROM ". $obj->getNombreTabla(). $strWhere." group by value order by value " ;

		}

		//echo $sql;

		$this->visit->debuger->out("getHijosFromValorControlado: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $obj );

		

		return $collection;

	}



	/*

	* Dado una id seccion y un array de pares atributo valor que indican los valores de las secciones

	* Devuelve los valores numericos que cumplen las condiciones

	*/

	

	/*********************alfredo 14 01 22*****************************/

	function getHijosFromValorNumerico($idsec,$controladosAnteriores){

		global $visit;

		$dictFilasSectionData = $visit->options->sectionData;

		$obj = new ClsNumericData();

		$idsAnteriores="";

		if ($controladosAnteriores!=""){

			//var_dump($controladosAnteriores);

			while (list ($clave, $temp) = each ($controladosAnteriores)) {

					/*if ($temp[0]!=null &&  $temp[1]!=null ){

					$idSeccion=$temp[0];

					$valorSeccion=$temp[1];*/

				if ($temp!=null &&  $clave!=null){ 

					$idSeccion = $clave;

					$valorSeccion =$temp;

					//$seccion=$this->getSectionDataId($idSeccion);

					$seccion=$dictFilasSectionData[$idSeccion];

					if ($seccion->tipo_valores=="C") {

						$sqlData= "select * from controlled_data where idseccion=".$idSeccion." and value='".$valorSeccion."' " ;

					}  else if ($seccion->tipo_valores=="N") {

						$sqlData= "select * from numeric_data where idseccion=".$idSeccion." and value='".$valorSeccion."' " ;

					}  else if ($seccion->tipo_valores=="T") {

						$sqlData= "select * from text_data where idseccion=".$idSeccion." and value='".$valorSeccion."' " ;

					}  else if ($seccion->tipo_valores=="F") {

						$sqlData= "select * from date_data where idseccion=".$idSeccion." and value='".$valorSeccion."' " ;

					}  

					//echo $sqlData."***************";

					if ($idsAnteriores!="") $sqlData.= " AND idov in (".$idsAnteriores.") ";

					$temps = $this->conn->GetAll($sqlData);

					$idsAnterioresCopia="";

					if(!is_array($temps)){

						$temps = array();

					}

					while (list ($clave, $tempC) = each ($temps)) {

						$idsAnterioresCopia.= $tempC["idov"].",";

						

					}

					if ($idsAnterioresCopia!="") {

					$idsAnteriores = substr( $idsAnterioresCopia, 0, strlen($idsAnterioresCopia)-1);

					}

				}

			}

		}			

		$where =" idseccion = ".$idsec ;

		if ($idsAnteriores!=""){

			$where.= " AND idov in (".$idsAnteriores.") ";

			}

		//SI NO HAY USUARIO REGISTRADO NO MOSTRAR LOS VISIBLES

		//

		if($visit->util->esUserRegistrado()){			

			$strWhere =" WHERE ". $where;

			$admin = $visit->options->usuario->rol=="B";

			$superadmin = $visit->options->usuario->rol=="A";

			if (!$superadmin){

				$strWhere = " INNER JOIN virtual_object". $strWhere. " AND virtual_object.isprivate = 'N' AND ".$obj->getNombreTabla().".idov=virtual_object.id ";

			}

			//EVITAR VALORES A NULL

			$strWhere = $strWhere. " AND ".$obj->getNombreTabla().".value IS NOT NULL ";

			$sql ="SELECT distinct value, count(*) as cuenta, MIN(idov) as idov FROM ". $obj->getNombreTabla(). $strWhere." group by value order by value " ;

		} else{

			$strWhere =" ON ". $where;

			$strWhere = $strWhere. " AND virtual_object.ispublic = 'S' ";

			//EVITAR VALORES A NULL

			$strWhere = $strWhere. " AND ".$obj->getNombreTabla().".value IS NOT NULL ";

			$sql ="SELECT distinct value, count(*) as cuenta, MIN(idov) as idov FROM ". $obj->getNombreTabla()." INNER JOIN virtual_object " . $strWhere." AND ".$obj->getNombreTabla().".idov=virtual_object.id  group by value order by value " ;	

		}

		$this->visit->debuger->out("getHijosFromValorNumerico: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $obj );

		return $collection;

		}

	

	/*****************************************************************/





/*

	* Dado una id seccion y un array de pares atributo valor que indican los valores de las secciones

	* Devuelve los valores numericos que cumplen las condiciones

	*/

	

	/********************** alfredo 140121 **********************/

	function getHijosFromFecha($idsec,$controladosAnteriores){

		global $visit;

		$dictFilasSectionData = $visit->options->sectionData;

		$obj= new ClsDateData();

		$idsAnteriores="";

		if ($controladosAnteriores!=""){

			//var_dump($controladosAnteriores);

			while (list ($clave, $temp) = each ($controladosAnteriores)) {

					/*if ($temp[0]!=null &&  $temp[1]!=null ){

					$idSeccion=$temp[0];

					$valorSeccion=$temp[1];*/

				if ($temp!=null &&  $clave!=null){ 

					$idSeccion = $clave;

					$valorSeccion =$temp;

					//$seccion=$this->getSectionDataId($idSeccion);

					$seccion=$dictFilasSectionData[$idSeccion];

					if ($seccion->tipo_valores=="C") {

						$sqlData= "select * from controlled_data where idseccion=".$idSeccion." and value='".$valorSeccion."' " ;

					}  else if ($seccion->tipo_valores=="N") {

						$sqlData= "select * from numeric_data where idseccion=".$idSeccion." and value='".$valorSeccion."' " ;

					}  else if ($seccion->tipo_valores=="T") {

						$sqlData= "select * from text_data where idseccion=".$idSeccion." and value='".$valorSeccion."' " ;

					}  else if ($seccion->tipo_valores=="F") {

						$sqlData= "select * from date_data where idseccion=".$idSeccion." and value='".$valorSeccion."' " ;

					//}  else if ($seccion->tipo_valores=="T") {

					//	$sqlData= "select * from date_data where idseccion=".$temp[0]." and value='".$temp[1]."' " ;

					}  

					//echo $sqlData."***************";

					if ($idsAnteriores!="") $sqlData.= " AND idov in (".$idsAnteriores.") ";

					$temps = $this->conn->GetAll($sqlData);

					$idsAnterioresCopia="";

					if(!is_array($temps)){

						$temps = array();

					}

					while (list ($clave, $tempC) = each ($temps)) {

						$idsAnterioresCopia.= $tempC["idov"].",";

						

					}

					if ($idsAnterioresCopia!="") {

					$idsAnteriores = substr( $idsAnterioresCopia, 0, strlen($idsAnterioresCopia)-1);

					}

				}

			}

		}			

		$where =" idseccion = ".$idsec ;

		if ($idsAnteriores!=""){

			$where.= " AND idov in (".$idsAnteriores.") ";

			//

		}

		//SI NO HAY USUARIO REGISTRADO NO MOSTRAR LOS VISIBLES

		//Control de usuarios

		if($visit->util->esUserRegistrado()){			

			$strWhere =" WHERE ". $where;

			$admin = $visit->options->usuario->rol=="B";

			$superadmin = $visit->options->usuario->rol=="A";

			if (!$superadmin){

				$strWhere = " INNER JOIN virtual_object". $strWhere. " AND virtual_object.isprivate = 'N' AND ".$obj->getNombreTabla().".idov=virtual_object.id ";

			}

			//EVITAR VALORES A NULL

			$strWhere = $strWhere. " AND ".$obj->getNombreTabla().".value IS NOT NULL ";

			$sql ="SELECT distinct value, count(*) as cuenta, MIN(idov) as idov FROM ". $obj->getNombreTabla(). $strWhere." group by value order by value " ;

		} else{

			$strWhere =" ON ". $where;

			$strWhere = $strWhere. " AND virtual_object.ispublic = 'S' ";

			//EVITAR VALORES A NULL

			$strWhere = $strWhere. " AND ".$obj->getNombreTabla().".value IS NOT NULL ";

			$sql ="SELECT distinct value, count(*) as cuenta, MIN(idov) as idov FROM ". $obj->getNombreTabla()." INNER JOIN virtual_object " . $strWhere." AND ".$obj->getNombreTabla().".idov=virtual_object.id  group by value order by value " ;	

		}

		$this->visit->debuger->out("getHijosFromFecha: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $obj );

		return $collection;

		}

	/*******************************************/

	

	function getHijosFromValorTexto($idsec,$controladosAnteriores){

		global $visit;

		$dictFilasSectionData = $visit->options->sectionData;

		$obj= new ClsTextData();

		$idsAnteriores="";

		if ($controladosAnteriores!=""){

			//var_dump($controladosAnteriores);

			while (list ($clave, $temp) = each ($controladosAnteriores)) {

					/*if ($temp[0]!=null &&  $temp[1]!=null ){

					$idSeccion=$temp[0];

					$valorSeccion=$temp[1];*/

				if ($temp!=null &&  $clave!=null){ 

					$idSeccion = $clave;

					$valorSeccion =$temp;

					//$seccion=$this->getSectionDataId($idSeccion);

					$seccion=$dictFilasSectionData[$idSeccion];

					if ($seccion->tipo_valores=="C") {

						$sqlData= "select * from controlled_data where idseccion=".$idSeccion." and value='".$valorSeccion."' " ;

					}  else if ($seccion->tipo_valores=="N") {

						$sqlData= "select * from numeric_data where idseccion=".$idSeccion." and value='".$valorSeccion."' " ;

					}  else if ($seccion->tipo_valores=="T") {

						$sqlData= "select * from text_data where idseccion=".$idSeccion." and value='".$valorSeccion."' " ;

					}  else if ($seccion->tipo_valores=="F") {

						$sqlData= "select * from date_data where idseccion=".$idSeccion." and value='".$valorSeccion."' " ;

					}  

					if ($idsAnteriores!="") $sqlData.= " AND idov in (".$idsAnteriores.") ";

					$temps = $this->conn->GetAll($sqlData);

					$idsAnterioresCopia="";

					if(!is_array($temps)){

						$temps = array();

					}

					while (list ($clave, $tempC) = each ($temps)) {

						$idsAnterioresCopia.= $tempC["idov"].",";

						

					}

					if ($idsAnterioresCopia!="") {

					$idsAnteriores = substr( $idsAnterioresCopia, 0, strlen($idsAnterioresCopia)-1);

					}

				}

			}

		}			

		$where =" idseccion = ".$idsec ;

		if ($idsAnteriores!=""){

			$where.= " AND idov in (".$idsAnteriores.") ";

			///$where.= " AND value !='~Sin asignar'";

		}

		//Control de usuarios

		if($visit->util->esUserRegistrado()){			

			$strWhere =" WHERE ". $where;

			$admin = $visit->options->usuario->rol=="B";

			$superadmin = $visit->options->usuario->rol=="A";

			if (!$superadmin){

				$strWhere = " INNER JOIN virtual_object". $strWhere. " AND virtual_object.isprivate = 'N' AND ".$obj->getNombreTabla().".idov=virtual_object.id ";

			}

			//EVITAR VALORES A NULL

			$strWhere = $strWhere. " AND ".$obj->getNombreTabla().".value IS NOT NULL ";

			$sql ="SELECT distinct value, count(*) as cuenta, MIN(idov) as idov FROM ". $obj->getNombreTabla(). $strWhere." group by value order by value " ;

		} else{

			$strWhere =" ON ". $where;

			$strWhere = $strWhere. " AND virtual_object.ispublic = 'S' ";

			//EVITAR VALORES A NULL

			$strWhere = $strWhere. " AND ".$obj->getNombreTabla().".value IS NOT NULL ";

			$sql ="SELECT distinct value, count(*) as cuenta, MIN(idov) as idov FROM ". $obj->getNombreTabla()." INNER JOIN virtual_object " . $strWhere." AND ".$obj->getNombreTabla().".idov=virtual_object.id  group by value order by value " ;	

		}

		$this->visit->debuger->out("getHijosFromValorTexto: ". $obj->getNombreTabla() ."-: $sql");

		///echo "<br><br>";

		///var_dump($sql);	

		///echo "<br><br>";

		//var_dump($sql);

		$collection = $this->execSQL( $sql, $obj );

		return $collection;

	}

	/// Dentro de un recurso

	function getHijosFromValorControladoOV($idsec,$controladosAnteriores,$idov){

		global $visit;

		$dictFilasSectionData = $visit->options->sectionData;

		$obj= new ClsControlledData();

		$idsAnteriores="";

		if ($controladosAnteriores!=""){

			while (list ($clave, $temp) = each ($controladosAnteriores)) {

					/*if ($temp[0]!=null &&  $temp[1]!=null ){

					$idSeccion=$temp[0];

					$valorSeccion=$temp[1];*/

				if ($temp!=null &&  $clave!=null){ 

					$idSeccion = $clave;

					$valorSeccion =$temp;

					//$seccion=$this->getSectionDataId($idSeccion);

					$seccion=$dictFilasSectionData[$idSeccion];

					if ($seccion->tipo_valores=="C") {

						$sqlData= "select * from controlled_data where idseccion=".$idSeccion." and value='".$valorSeccion."' and idov=".$idov ;

					}  else if ($seccion->tipo_valores=="N") {

						$sqlData= "select * from numeric_data where idseccion=".$idSeccion." and value='".$valorSeccion."' and idov=".$idov ;

					}  else if ($seccion->tipo_valores=="T") {

						$sqlData= "select * from text_data where idseccion=".$idSeccion." and value='".$valorSeccion."' and idov=".$idov ;

					}  else if ($seccion->tipo_valores=="F") {

						$sqlData= "select * from date_data where idseccion=".$idSeccion." and value='".$valorSeccion."' and idov=".$idov ;

					}  

					///echo $sqlData."CCCCCCCCCCCCCCCCcc";

					if ($idsAnteriores!="") $sqlData.= " AND idov in (".$idsAnteriores.") ";

					$temps = $this->conn->GetAll($sqlData);

					$idsAnterioresCopia="";

					//var_dump($temps);

					while (list ($clave, $tempC) = each ($temps)) {

						$recurso= $this->getResourcesId($tempC["idrecurso"]);

						if ($recurso->visible=="S") {

						$idsAnterioresCopia.= $tempC["idov"].",";

						}

						

					}

					if ($idsAnterioresCopia!="") {

					$idsAnteriores = substr( $idsAnterioresCopia, 0, strlen($idsAnterioresCopia)-2);

					}

				}

			}

		}

		$recursosPublicos = $this->getRecursosVisiblesFromOV($idov);

		$idsRecursosPublicosCopia = "";

		while (list ($clave, $rp) = each ($recursosPublicos)) {

		

		$idsRecursosPublicosCopia .=  $rp->id.",";

		}

		if ($idsRecursosPublicosCopia!="") {

				$idsRecursosPublicos = substr( $idsRecursosPublicosCopia, 0, strlen($idsRecursosPublicosCopia)-1);

		}

		//var_dump($recursosPublicos);

		$where =" idseccion = ".$idsec ;

		if ($idsRecursosPublicos!="") $where.= " AND idrecurso in (".$idsRecursosPublicos.") ";

		if ($idsAnteriores!="") $where.= " AND idov in (".$idsAnteriores.") ";

		else $where .= " AND idov = ".$idov ;

		$strWhere =" WHERE ". $where;

				//EVITAR VALORES A NULL

		$strWhere = $strWhere. " AND value IS NOT NULL ";

		$sql ="SELECT value, count(*) as cuenta, MIN(idov) as idov FROM ". $obj->getNombreTabla() . $strWhere." group by value order by value " ;

		$this->visit->debuger->out("getHijosFromValorControlado: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $obj );

		//var_dump($collection);

		return $collection;

	}



	/*

	* Dado una id seccion y un array de pares atributo valor que indican los valores de las secciones

	* Devuelve los valores numericos (dentro de un OV) que cumplen las condiciones

	*/

	function getHijosFromValorNumericoOV($idsec,$controladosAnteriores,$idov){

		global $visit;

		$dictFilasSectionData = $visit->options->sectionData;

		$obj= new ClsNumericData();

		$idsAnteriores="";

		if ($controladosAnteriores!=""){

			//var_dump($controladosAnteriores);

			while (list ($clave, $temp) = each ($controladosAnteriores)) {

				/*if ($temp[0]!=null &&  $temp[1]!=null ){

					$idSeccion=$temp[0];

					$valorSeccion=$temp[1];*/

				if ($temp!=null &&  $clave!=null){ 

					$idSeccion = $clave;

					$valorSeccion =$temp;

					//$seccion=$this->getSectionDataId($idSeccion);

					$seccion=$dictFilasSectionData[$idSeccion];

					if ($seccion->tipo_valores=="C") {

						$sqlData= "select * from controlled_data where idseccion=".$idSeccion." and value='".$valorSeccion."' and idov=".$idov ;

					}  else if ($seccion->tipo_valores=="N") {

						$sqlData= "select * from numeric_data where idseccion=".$idSeccion." and value='".$valorSeccion."' and idov=".$idov ;

					}  else if ($seccion->tipo_valores=="T") {

						$sqlData= "select * from text_data where idseccion=".$idSeccion." and value='".$valorSeccion."' and idov=".$idov ;

					}  else if ($seccion->tipo_valores=="F") {

						$sqlData= "select * from date_data where idseccion=".$idSeccion." and value='".$valorSeccion."' and idov=".$idov ;

					}  

					///echo $sqlData."NNNNNNNNNNNN";

					if ($idsAnteriores!="") $sqlData.= " AND idov in (".$idsAnteriores.") ";

					$temps = $this->conn->GetAll($sqlData);

					$idsAnterioresCopia="";

					while (list ($clave, $tempC) = each ($temps)) {

						$recurso= $this->getResourcesId($tempC["idrecurso"]);

						if ($recurso->visible=="S") {

						$idsAnterioresCopia.= $tempC["idov"].",";

						}

						

					}

					if ($idsAnterioresCopia!="") {

					$idsAnteriores = substr( $idsAnterioresCopia, 0, strlen($idsAnterioresCopia)-2);

					}

				}

			}

		}			

		$where =" idseccion = ".$idsec ;

		if ($idsAnteriores!="") $where.= " AND idov in (".$idsAnteriores.") ";

		else $where .= " AND idov = ".$idov ;

		$strWhere =" WHERE ". $where;

				//EVITAR VALORES A NULL

		$strWhere = $strWhere. " AND value IS NOT NULL ";

		$sql ="SELECT value, count(*) as cuenta, MIN(idov) as idov FROM ". $obj->getNombreTabla() . $strWhere." group by value order by value " ;

		// alfredo 4 01 22   $this->visit->debuger->out("getHijosFromValorControlado: ". $obj->getNombreTabla() ."-: $sql");

		$this->visit->debuger->out("getHijosFromValorNumerico: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $obj );

		return $collection;

	}



	function getHijosFromValorTextoOV($idsec,$controladosAnteriores,$idov){

		global $visit;

		$dictFilasSectionData = $visit->options->sectionData;

		$obj= new ClsTextData();

		$idsAnteriores="";

		if ($controladosAnteriores!=""){

			//var_dump($controladosAnteriores);

			while (list ($clave, $temp) = each ($controladosAnteriores)) {

				/*if ($temp[0]!=null &&  $temp[1]!=null ){

					$idSeccion=$temp[0];

					$valorSeccion=$temp[1];*/

				if ($temp!=null &&  $clave!=null){ 

					$idSeccion = $clave;

					$valorSeccion =$temp;

					//$seccion=$this->getSectionDataId($idSeccion);

					$seccion=$dictFilasSectionData[$idSeccion];

					if ($seccion->tipo_valores=="C") {

						$sqlData= "select * from controlled_data where idseccion=".$temp[0]." and value='".$temp[1]."' and idov=".$idov ;

					}  else if ($seccion->tipo_valores=="N") {

						$sqlData= "select * from numeric_data where idseccion=".$temp[0]." and value='".$temp[1]."' and idov=".$idov ;

					}  else if ($seccion->tipo_valores=="T") {

						$sqlData= "select * from text_data where idseccion=".$temp[0]." and value='".$temp[1]."' and idov=".$idov ;

					}  else if ($seccion->tipo_valores=="F") {

						$sqlData= "select * from date_data where idseccion=".$temp[0]." and value='".$temp[1]."' and idov=".$idov ;

					}  

					//echo $sqlData."***************";

					if ($idsAnteriores!="") $sqlData.= " AND idov in (".$idsAnteriores.") ";

					$temps = $this->conn->GetAll($sqlData);

					$idsAnterioresCopia="";

					while (list ($clave, $tempC) = each ($temps)) {

						$recurso= $this->getResourcesId($tempC["idrecurso"]);

						if ($recurso->visible=="S") {

						$idsAnterioresCopia.= $tempC["idov"].",";

						}

						

					}

					if ($idsAnterioresCopia!="") {

					$idsAnteriores = substr( $idsAnterioresCopia, 0, strlen($idsAnterioresCopia)-2);

					}

				}

			}

		}			

		$where =" idseccion = ".$idsec ;

		if ($idsAnteriores!="") $where.= " AND idov in (".$idsAnteriores.") ";

		else $where .= " AND idov = ".$idov ;

		$strWhere =" WHERE ". $where;

				//EVITAR VALORES A NULL

		$strWhere = $strWhere. " AND value IS NOT NULL ";

		$sql ="SELECT value, count(*) as cuenta, MIN(idov) as idov FROM ". $obj->getNombreTabla() . $strWhere." group by value order by value " ;

		//$this->visit->debuger->out("getHijosFromValorControlado: ". $obj->getNombreTabla() ."-: $sql");

		$this->visit->debuger->out("getHijosFromValorTexto: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $obj );

		

		return $collection;

	}

	

	/*

	* Dado una id seccion y un array de pares atributo valor que indican los valores de las secciones

	* Devuelve los valores numericos (dentro de un OV) que cumplen las condiciones

	*/

	function getHijosFromValorFechaOV($idsec,$controladosAnteriores,$idov){

		global $visit;

		$dictFilasSectionData = $visit->options->sectionData;

		$obj= new ClsNumericData();

		$idsAnteriores="";

		if ($controladosAnteriores!=""){

			//var_dump($controladosAnteriores);

			while (list ($clave, $temp) = each ($controladosAnteriores)) {

				/*if ($temp[0]!=null &&  $temp[1]!=null ){

					$idSeccion=$temp[0];

					$valorSeccion=$temp[1];*/

				if ($temp!=null &&  $clave!=null){ 

					$idSeccion = $clave;

					$valorSeccion =$temp;

					//$seccion=$this->getSectionDataId($idSeccion);

					$seccion=$dictFilasSectionData[$idSeccion];

					if ($seccion->tipo_valores=="C") {

						$sqlData= "select * from controlled_data where idseccion=".$idSeccion." and value='".$valorSeccion."' and idov=".$idov ;

					}  else if ($seccion->tipo_valores=="N") {

						$sqlData= "select * from numeric_data where idseccion=".$idSeccion." and value='".$valorSeccion."' and idov=".$idov ;

					}  else if ($seccion->tipo_valores=="T") {

						$sqlData= "select * from text_data where idseccion=".$idSeccion." and value='".$valorSeccion."' and idov=".$idov ;

					}  else if ($seccion->tipo_valores=="F") {

						$sqlData= "select * from date_data where idseccion=".$idSeccion." and value='".$valorSeccion."' and idov=".$idov ;

					}  

					///echo $sqlData."NNNNNNNNNNNN";

					if ($idsAnteriores!="") $sqlData.= " AND idov in (".$idsAnteriores.") ";

					$temps = $this->conn->GetAll($sqlData);

					$idsAnterioresCopia="";

					while (list ($clave, $tempC) = each ($temps)) {

						$recurso= $this->getResourcesId($tempC["idrecurso"]);

						if ($recurso->visible=="S") {

						$idsAnterioresCopia.= $tempC["idov"].",";

						}

						

					}

					if ($idsAnterioresCopia!="") {

					$idsAnteriores = substr( $idsAnterioresCopia, 0, strlen($idsAnterioresCopia)-2);

					}

				}

			}

		}			

		$where =" idseccion = ".$idsec ;

		if ($idsAnteriores!="") $where.= " AND idov in (".$idsAnteriores.") ";

		else $where .= " AND idov = ".$idov ;

		$strWhere =" WHERE ". $where;

				//EVITAR VALORES A NULL

		$strWhere = $strWhere. " AND value IS NOT NULL ";

		$sql ="SELECT value, count(*) as cuenta, MIN(idov) as idov FROM ". $obj->getNombreTabla() . $strWhere." group by value order by value " ;

		$this->visit->debuger->out("getHijosFromValorFecha: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $obj );

		return $collection;

	}



	/* Recibe como parámetro los criterios de una búsqueda y devuelve los OVs que cumplen esos criterios*/

	 function getTablaBusquedaOVsCount($objeto,$dict){

		global $visit;



		$orderBy = $objeto->getOrderBy();

		$whereControlled = "";

		$whereNumeric = "";

		$whereText = "";

		$whereFecha  = "";

		$strWhere = "";

		$sectionData = new ClsSectionData();

		$filas = $this->getTablaFiltrada($sectionData);

		$secVacias=true;

		while (list ($clave, $fila) = each ($filas)) {

			if ($dict["seccion_".$fila->id]!="") {

				$secVacias =false;

				if ($fila->tipo_valores=="C") {

					$operador = $dict["seccion_".$fila->id."_ope"];

					if ($operador=="LT"){

						$op = "<";

					} else if ($operador=="BT"){

						$op = ">";

					} else if ($operador=="LEQ"){

						$op = "<=";

					} else if ($operador=="BEQ"){

						$op = ">=";

					} else {

						$op = "=";

					}

					if ($whereControlled!="") $whereControlled = $whereControlled." AND  ";

					//$whereControlled = $whereControlled." (idseccion =".$fila->id." and value ".$op." '".$dict["seccion_".$fila->id]."')  ";

					$whereControlled = $whereControlled." idov IN (SELECT idov FROM controlled_data WHERE idseccion =".$fila->id." and value ".$op." '".$dict["seccion_".$fila->id]."')  ";



				} else if ($fila->tipo_valores=="N")	{ 

					// $valornum = str_replace(",",".",$dict["seccion_".$fila->id]);
					$dict["seccion_".$fila->id] = str_replace(",",".",$dict["seccion_".$fila->id]); //alfredo 140827
					
					if ($whereNumeric!="")	$whereNumeric = $whereNumeric." AND  ";

					$operador= $dict["seccion_".$fila->id."_ope"];

					$comp = "'".$dict["seccion_".$fila->id]."'";

					if ($operador=="LT"){

						$op= "<";

					} else if ($operador=="BT"){

						$op= ">";

					} else if ($operador=="LEQ"){

						$op= "<=";

					} else if ($operador=="BEQ"){

						$op= ">=";

					} else {

						//operador igual, no tener en cuenta los decimales

						$op = "LIKE";

						$comp = "'".$dict["seccion_".$fila->id]."%'";

					}

					//if ($whereNumeric!="") $whereNumeric = $whereNumeric." OR  ";

					//$whereNumeric = $whereNumeric." (idseccion =".$fila->id." and value ".$op." ".$comp." )  ";

					$whereNumeric = $whereNumeric." idov IN (SELECT idov FROM numeric_data WHERE idseccion =".$fila->id." and value ".$op." ".$comp." )  ";

				}else if ($fila->tipo_valores=="F")	{ 

					if (strpos($valornum,"/") !=-1)

						$valorfecha = $visit->util->date2bbdd($dict["seccion_".$fila->id]);

					if ($whereFecha!="")	$whereFecha = $whereFecha." AND  ";

					$operador= $dict["seccion_".$fila->id."_ope"];

					$op = "=";

					if ($operador=="LT"){

						$op= "<";

					} else if ($operador=="BT"){

						$op= ">";

					} else if ($operador=="LEQ"){

						$op= "<=";

					} else if ($operador=="BEQ"){

						$op= ">=";

					}

					//if ($whereFecha!="") $whereFecha = $whereFecha." OR  ";

					//$whereFecha = $whereFecha." (idseccion =".$fila->id." and value ".$op." ".$valorfecha.")  ";	

					$whereFecha = $whereFecha." idov IN (SELECT idov FROM date_data WHERE idseccion =".$fila->id." and value ".$op." ".$valorfecha.")  ";	

					

				} else if ($fila->tipo_valores=="T")	{ 

					if ($whereText!="")	$whereText = $whereText." AND  ";

					//$whereText = $whereText." (idseccion =".$fila->id." and value like '%".$dict["seccion_".$fila->id]."%')  ";

					$whereText = $whereText." idov IN (SELECT idov FROM text_data WHERE idseccion =".$fila->id." and value like '%".$dict["seccion_".$fila->id]."%')  ";

				}

			

			}

		}





		if ($whereControlled!=""){

			$sqlControlados = "SELECT idov from controlled_data WHERE ". $whereControlled;		

			$colecControlados = $this->conn->GetAll($sqlControlados);

			$idsControlados="";

			while (list ($clave, $contr) = each ($colecControlados)) {

				$idsControlados .= $contr["idov"].","; 

			}

			

			if ($idsControlados!="") { 

				$idsControlados =	substr( $idsControlados, 0, strlen($idsControlados)-1);

				$strWhere = $strWhere." id in (". $idsControlados.") ";

			} 	else return 0; //alfredo 140826

		}//print "<hr>".$sqlControlados;

			if ($whereNumeric!="") {

			$sqlNumeric = "select idov from numeric_data WHERE ". $whereNumeric;

			$colecNumeric =  $this->conn->GetAll($sqlNumeric);

			$idsNumeric="";

			while (list ($clave, $nums) = each ($colecNumeric)) {

				$idsNumeric .= $nums["idov"].","; 

			}

			

			if ($idsNumeric!="") { 

				$idsNumeric =	substr( $idsNumeric, 0, strlen($idsNumeric)-1);

				if ($strWhere!="") $strWhere = $strWhere." AND ";

				$strWhere = $strWhere." id in (". $idsNumeric.") ";

				

			} 	else return 0; //alfredo 140826

			

		}



		if($whereFecha != ""){

			$sqlFecha = "select idov FROM date_data WHERE ". $whereFecha;

			$colecFechas = $this->conn->GetAll($sqlFecha);

			

			$idsFechas ="";

			while (list ($clave, $fechs) = each ($colecFechas)) {

				$idsFechas .= $fechs["idov"].","; 

			}

			

			if ($idsFechas!="") { 

				$idsFechas =	substr( $idsFechas, 0, strlen($idsFechas)-1);

				if ($strWhere!="") $strWhere = $strWhere." AND ";

				$strWhere = $strWhere." id in (". $idsFechas.") ";

				

			} 	else return 0; //alfredo 140826

		}

			//print "<hr>".$sqlFecha;	

		if ($whereText!="") {

			$sqlText = "select idov from text_data WHERE ". $whereText;

			$colecText =  $this->conn->GetAll($sqlText);

			$idsText="";

			while (list ($clave, $texts) = each ($colecText)) {

				if($texts["idov"] != "")

					$idsText .= $texts["idov"].","; 

			}

			

			if ($idsText!="") { 

				$idsText =	substr( $idsText, 0, strlen($idsText)-1);

				if ($strWhere!="") $strWhere = $strWhere." AND ";

				$strWhere = $strWhere." id in (". $idsText.") ";

				

			} 	else return 0; //alfredo 140826

		}

		

		if ($orderBy!="") $strOrderBy =" ORDER BY ". $orderBy;

		//var_dump($dict);

		if ($dict["misOVs"]=="S"){

			$userId = $dict["idusuario"];

			//echo "user ID = ". $userId;

			$misOVs = $this->getPermisosFromUsuario($userId);

			$misIds="";

			while (list ($clave, $per) = each ($misOVs)) {

				if (!$visit->util->perteneceLista($per->idov,$misIds)){

					$misIds .= $per->idov.","; 

				}

			}

			if ($misIds!="") { 

				$misIds =	substr( $misIds, 0, strlen($misIds)-1);

				if ($strWhere!="") $strWhere = $strWhere." AND ";

				$strWhere = $strWhere." id in (". $misIds.") ";

			}

		}


		if ($strWhere!="") { //alfredo 140826
		
			$strWhere = $objeto->refinarWhere($strWhere);


		}


		if ($strWhere!="") {

				$strWhere= " WHERE ".$strWhere;

				

		} 

		

		if ($secVacias || $strWhere!="" ){

				$sql ="SELECT COUNT(*) AS CUENTA FROM  ". $objeto->getNombreTabla() . $strWhere . $strOrderBy;

				//echo "<br>SQL 2:  ".$sql."<br>";

				$this->visit->debuger->out("getTablaBusquedaOVsCount: ". $objeto->getNombreTabla() ."-: $sql");

				$collection = $this->conn->GetAll($sql);//var_dump($sql);

				return $collection[0]["CUENTA"];

				

		} else return 0;

	 }

	

	 

	 function getObjetosEdicionFromUsuario($idusuario){		

		$misOVs = $this->getPermisosFromUsuario($idusuario);

		$misIds="";

		while (list ($clave, $per) = each ($misOVs)) {

			$misIds .= $per->idov.", "; 

		}

		$misIds = substr($misIds,0,-1);

	

		return $misIds;

	 }



	 /********  alfredo 140714   function getTablaBusquedaOVsLimit($objeto,$from,$count,$dict){

		global $visit;

		$orderBy = $objeto->getOrderBy();

		$whereControlled = "";

		$whereNumeric = "";

		$whereText = "";

		$strWhere="";

		

		$sectionData = new ClsSectionData();

		//$visit->debuger->enable(true);

		$filas = $this->getTablaFiltrada($sectionData);

		$secVacias=true;

		while (list ($clave, $fila) = each ($filas)) {

			if ($dict["seccion_".$fila->id]!="") {

				$secVacias=false;

				if ($fila->tipo_valores=="C") {

					$operador= $dict["seccion_".$fila->id."_ope"];

					$op = "=";

					if ($operador=="LT"){

						$op= "<";

					} else if ($operador=="BT"){

						$op= ">";

					} else if ($operador=="LEQ"){

						$op= "<=";

					} else if ($operador=="BEQ"){

						$op= ">=";

					}

					if ($whereControlled!="") $whereControlled = $whereControlled." AND  ";

					//$whereControlled = $whereControlled." (idseccion =".$fila->id." and value".$op." '".$dict["seccion_".$fila->id]."')  ";

					$whereControlled = $whereControlled." idov IN (SELECT idov FROM controlled_data WHERE idseccion =".$fila->id." and value ".$op." '".$dict["seccion_".$fila->id]."')  ";

				} else if ($fila->tipo_valores=="N")	{ 

					if ($whereNumeric!="")	$whereNumeric = $whereNumeric." AND  ";

					$operador= $dict["seccion_".$fila->id."_ope"];

					$temp = " '".$dict["seccion_".$fila->id]."%' ";	

					if ($operador=="LT"){

						$op= "<";

					} else if ($operador=="BT"){

						$op= ">";

					} else if ($operador=="LEQ"){

						$op= "<=";

					} else if ($operador=="BEQ"){

						$op= ">=";

					} else {

						//no hay que tener cuenta los decimales

						$op = " LIKE ";

						$temp = "'".$dict["seccion_".$fila->id]."%'";	

					}

					//if ($whereNumeric!="") $whereNumeric = $whereNumeric." OR  ";

					//$whereNumeric = $whereNumeric." ( idseccion = ".$fila->id." AND value ".$op." ".$temp." )  ";

					$whereNumeric = $whereNumeric." idov IN (SELECT idov FROM numeric_data WHERE idseccion = ".$fila->id." AND value ".$op." ".$temp." )  ";

				}else if ($fila->tipo_valores=="F")	{ 

					

					if (strpos($valornum,"/") !=-1)

						$valorfecha = $visit->util->date2bbdd($dict["seccion_".$fila->id]);

					if ($whereFecha!="")	$whereFecha = $whereFecha." AND  ";

					$operador= $dict["seccion_".$fila->id."_ope"];

					$op = "=";

					if ($operador=="LT"){

						$op= "<";

					} else if ($operador=="BT"){

						$op= ">";

					} else if ($operador=="LEQ"){

						$op= "<=";

					} else if ($operador=="BEQ"){

						$op= ">=";

					}

					//if ($whereFecha!="") $whereFecha = $whereFecha." OR  ";

					//$whereFecha = $whereFecha." (idseccion =".$fila->id." and value".$op." ".$valorfecha.")  ";	

					$whereFecha = $whereFecha." idov IN (SELECT idov FROM date_data WHERE idseccion =".$fila->id." and value".$op." ".$valorfecha.")  ";	

				} else if ($fila->tipo_valores=="T")	{ 

					if ($whereText!="")	$whereText = $whereText." AND ";

					//$whereText = $whereText." (idseccion =".$fila->id." and value like '%".$dict["seccion_".$fila->id]."%')  ";

					$whereText = $whereText." idov IN (SELECT idov FROM text_data WHERE idseccion =".$fila->id." and value like '%".$dict["seccion_".$fila->id]."%')  ";

				}

			

			}

		}

		

		if ($whereControlled!=""){

			$sinResultados = false;

			$sqlControlados = "select DISTINCT idov from controlled_data WHERE ". $whereControlled;

			$colecControlados = $this->conn->GetAll($sqlControlados);

			$idsControlados="";

			while (list ($clave, $contr) = each ($colecControlados)) {

				$idsControlados .= $contr["idov"].","; 

			}

			if ($idsControlados!="") { 

				$idsControlados =	substr( $idsControlados, 0, strlen($idsControlados)-1);

				$strWhere = $strWhere." id in (". $idsControlados.") ";

			}

		}

				

		if ($whereNumeric!="") {

			$sinResultados = false;

			$sqlNumeric = "select idov from numeric_data WHERE ". $whereNumeric;

			$colecNumeric =  $this->conn->GetAll($sqlNumeric);



			$idsNumeric="";

			while (list ($clave, $nums) = each ($colecNumeric)) {

				$idsNumeric .= $nums["idov"].","; 

			}



			if ($idsNumeric!="") { 

				$idsNumeric =	substr( $idsNumeric, 0, strlen($idsNumeric)-1);

				if ($strWhere!="") $strWhere = $strWhere." AND ";

				$strWhere = $strWhere." id in (". $idsNumeric.") ";

				$sinResultadosNum = false;

			} 				



		}



	 	if($whereFecha != ""){

			$sqlFecha = "select idov FROM date_data WHERE ". $whereFecha;

			$colecFechas = $this->conn->GetAll($sqlFecha);

			

			$idsFechas ="";

			while (list ($clave, $fechs) = each ($colecFechas)) {

				$idsFechas .= $fechs["idov"].","; 

			}

			

			if ($idsFechas!="") { 

				$idsFechas =	substr( $idsFechas, 0, strlen($idsFechas)-1);

				if ($strWhere!="") $strWhere = $strWhere." AND ";

				$strWhere = $strWhere." id in (". $idsFechas.") ";

				

			} 			

		}		

		if ($whereText!="") {

			$sinResultados = false;

			$sqlText = "select idov from text_data WHERE ". $whereText;

			$colecText =  $this->conn->GetAll($sqlText);

			$idsText="";

			while (list ($clave, $texts) = each ($colecText)) {

				if($texts["idov"] != "")

					$idsText .= $texts["idov"].","; 

			}

			

			if ($idsText!="") { 

				$idsText =	substr( $idsText, 0, strlen($idsText)-1);

				if ($strWhere!="") $strWhere = $strWhere." AND ";

				$strWhere = $strWhere." id in (". $idsText.") ";

				$sinResultadosText = false;

			} 

		}

		if ($orderBy!="") $strOrderBy =" ORDER BY ". $orderBy;

		if ($dict["misOVs"]=="S"){

			

			$misOVs = $this->getPermisosFromUsuario($dict["idusuario"]);

			$misIds="";

			while (list ($clave, $per) = each ($misOVs)) {

				$permiso= new ClsPermisos();

				$permiso = $per;

				$misIds .= $per->idov.","; 

			}

			if ($misIds!="") { 

				$misIds =	substr( $misIds, 0, strlen($misIds)-1);

				if ($strWhere!="") $strWhere = $strWhere." AND ";

				$strWhere = $strWhere." id in (". $misIds.") ";

			}

		}

		

		$strWhere = $objeto->refinarWhere($strWhere);

		if ($strWhere!="") {

				$strWhere= " WHERE ".$strWhere;

				

		}



		if ($secVacias || $strWhere!=""){

			$sql ="SELECT ". $objeto->getCampos() ." FROM ". $objeto->getNombreTabla() . $strWhere . $strOrderBy;

			$this->visit->debuger->out("getTablaBusquedaOVsLimit: ". $objeto->getNombreTabla() ."-: $sql");

			//var_dump($sql);

			$collection = $this->execSQLLimit( $sql, $objeto, $from, $count );

		}		

		return $collection;

	 }

alfredo   140714   **************************************/

	 function getCuentaOVSeccionValor($idSec,$valor){

		$objeto= new ClsControlledData();

		$strWhere = "idseccion=".$idSec." AND value='".$valor."'";

		if ($orderBy!="") $strOrderBy =" ORDER BY ". $orderBy;

		if ($strWhere!="") $strWhere= " WHERE ".$strWhere;

		$sql ="SELECT COUNT(*) AS CUENTA FROM  ". $objeto->getNombreTabla() . $strWhere . $strOrderBy;

		$this->visit->debuger->out("getTablaBusquedaOVsCount: ". $objeto->getNombreTabla() ."-: $sql");

		$collection = $this->conn->GetAll($sql);

		return $collection[0]["CUENTA"];

	 }

	 //devuelve true si una sección tiene subsecciones y false e.o.c.

	 function tieneHijosSeccion($idSec){

		$objeto= new ClsSectionData();

		$strWhere = "idpadre=".$idSec;

		//if ($orderBy!="") $strOrderBy =" ORDER BY ". $orderBy;

		if ($strWhere!="") $strWhere= " WHERE ".$strWhere;

		$sql ="SELECT COUNT(*) AS CUENTA FROM  ". $objeto->getNombreTabla() . $strWhere ;

		$this->visit->debuger->out("tieneHijosSeccion: ". $objeto->getNombreTabla() ."-: $sql");

		$collection = $this->conn->GetAll($sql);

		return $collection[0]["CUENTA"]>0;

	 }

  

function getTablaBusquedaOVsLimit($objeto,$from,$count,$dict){
		global $visit;
		$orderBy = $objeto->getOrderBy();
		$whereControlled = "";
		$whereNumeric = "";
		$whereText = "";
		$whereFecha  = "";
		$strWhere="";
		
		$sectionData = new ClsSectionData();
		//$visit->debuger->enable(true);
		$filas = $this->getTablaFiltrada($sectionData);
		$secVacias=true;
		
		
		
		
		
		//****************************************************************
		$i=1;
		while (list ($clave, $fila) = each ($filas)) {
			if ($dict["seccion_".$fila->id]!="") {
			
			
			//alfredo 140711
			$_ENV["seccion_id"][$i]=$fila->id;
			//var_dump($_ENV["seccion_id"][$i]);
			$i=$i+1;
			//************************************************************
			
			
			
			
			$secVacias=false;
				if ($fila->tipo_valores=="C") {
					$operador= $dict["seccion_".$fila->id."_ope"];
					$op = "=";
					if ($operador=="LT"){
						$op= "<";
					} else if ($operador=="BT"){
						$op= ">";
					} else if ($operador=="LEQ"){
						$op= "<=";
					} else if ($operador=="BEQ"){
						$op= ">=";
					}
					if ($whereControlled!="") $whereControlled = $whereControlled." AND  ";
					//$whereControlled = $whereControlled." (idseccion =".$fila->id." and value".$op." '".$dict["seccion_".$fila->id]."')  ";
					$whereControlled = $whereControlled." idov IN (SELECT idov FROM controlled_data WHERE idseccion =".$fila->id." and value ".$op." '".$dict["seccion_".$fila->id]."')  ";
				
				} else if ($fila->tipo_valores=="N")	{ 
					$dict["seccion_".$fila->id] = str_replace(",",".",$dict["seccion_".$fila->id]); //alfredo 140827
					if ($whereNumeric!="")	$whereNumeric = $whereNumeric." AND  ";
					$operador= $dict["seccion_".$fila->id."_ope"];
					$temp = " '".$dict["seccion_".$fila->id]."%' ";	
					if ($operador=="LT"){
						$op= "<";
					} else if ($operador=="BT"){
						$op= ">";
					} else if ($operador=="LEQ"){
						$op= "<=";
					} else if ($operador=="BEQ"){
						$op= ">=";
					} else {
						//no hay que tener cuenta los decimales
						$op = " LIKE ";
						$temp = "'".$dict["seccion_".$fila->id]."%'";	
					}
					//if ($whereNumeric!="") $whereNumeric = $whereNumeric." OR  ";
					//$whereNumeric = $whereNumeric." ( idseccion = ".$fila->id." AND value ".$op." ".$temp." )  ";
					$whereNumeric = $whereNumeric." idov IN (SELECT idov FROM numeric_data WHERE idseccion = ".$fila->id." AND value ".$op." ".$temp." )  ";
				
				}else if ($fila->tipo_valores=="F")	{ 
					
					if (strpos($valornum,"/") !=-1)
						$valorfecha = $visit->util->date2bbdd($dict["seccion_".$fila->id]);
					if ($whereFecha!="")	$whereFecha = $whereFecha." AND  ";
					$operador= $dict["seccion_".$fila->id."_ope"];
					$op = "=";
					if ($operador=="LT"){
						$op= "<";
					} else if ($operador=="BT"){
						$op= ">";
					} else if ($operador=="LEQ"){
						$op= "<=";
					} else if ($operador=="BEQ"){
						$op= ">=";
					}
					//if ($whereFecha!="") $whereFecha = $whereFecha." OR  ";
					//$whereFecha = $whereFecha." (idseccion =".$fila->id." and value".$op." ".$valorfecha.")  ";	
					$whereFecha = $whereFecha." idov IN (SELECT idov FROM date_data WHERE idseccion =".$fila->id." and value".$op." ".$valorfecha.")  ";	
				
				} else if ($fila->tipo_valores=="T")	{ 
					if ($whereText!="")	$whereText = $whereText." AND ";
					//$whereText = $whereText." (idseccion =".$fila->id." and value like '%".$dict["seccion_".$fila->id]."%')  ";
					$whereText = $whereText." idov IN (SELECT idov FROM text_data WHERE idseccion =".$fila->id." and value like '%".$dict["seccion_".$fila->id]."%')  ";
				}
			
			}
		}
		
		$_ENV["seccion_id"][0]=$i; //alfredo 140712
		
		if ($whereControlled!=""){
			$sinResultados = false;
			$sqlControlados = "select DISTINCT idov from controlled_data WHERE ". $whereControlled;
			$colecControlados = $this->conn->GetAll($sqlControlados);
			$idsControlados="";
			while (list ($clave, $contr) = each ($colecControlados)) {
				$idsControlados .= $contr["idov"].","; 
			}
			if ($idsControlados!="") {
				$idsControlados =	substr( $idsControlados, 0, strlen($idsControlados)-1);
				$strWhere = $strWhere." id in (". $idsControlados.") ";
				$_SESSION["idsControlados"]=$strWhere;
			}else{return collection;} //alfredo 140826
		}
				
		if ($whereNumeric!="") {
			$sinResultados = false;
			$sqlNumeric = "select idov from numeric_data WHERE ". $whereNumeric;
			$colecNumeric =  $this->conn->GetAll($sqlNumeric);

			$idsNumeric="";
			while (list ($clave, $nums) = each ($colecNumeric)) {
				$idsNumeric .= $nums["idov"].","; 
			}

			if ($idsNumeric!="") { 
				$idsNumeric =	substr( $idsNumeric, 0, strlen($idsNumeric)-1);
				if ($strWhere!="") $strWhere = $strWhere." AND ";
				$strWhere = $strWhere." id in (". $idsNumeric.") ";
				$sinResultadosNum = false;
				$_SESSION["idsNumeric"]=$strWhere;
			}else{return collection;} //alfredo 140826 				

		}

	 	if($whereFecha != ""){
			$sqlFecha = "select idov FROM date_data WHERE ". $whereFecha;
			$colecFechas = $this->conn->GetAll($sqlFecha);
			
			$idsFechas ="";
			while (list ($clave, $fechs) = each ($colecFechas)) {
				$idsFechas .= $fechs["idov"].","; 
			}
			
			if ($idsFechas!="") { 
				$idsFechas =	substr( $idsFechas, 0, strlen($idsFechas)-1);
				if ($strWhere!="") $strWhere = $strWhere." AND ";
				$strWhere = $strWhere." id in (". $idsFechas.") ";
				$_SESSION["idsFechas"]=$strWhere;
			}else{return collection;} //alfredo 140826 			
		}		
		if ($whereText!="") {
			$sinResultados = false;
			$sqlText = "select idov from text_data WHERE ". $whereText;
			$colecText =  $this->conn->GetAll($sqlText);
			$idsText="";
			while (list ($clave, $texts) = each ($colecText)) {
				if($texts["idov"] != "")
					$idsText .= $texts["idov"].","; 
			}
			
			if ($idsText!="") { 
				$idsText =	substr( $idsText, 0, strlen($idsText)-1);
				if ($strWhere!="") $strWhere = $strWhere." AND ";
				$strWhere = $strWhere." id in (". $idsText.") ";
				$sinResultadosText = false;
				$_SESSION["idsText"]=$strWhere;
			} else{return collection;} //alfredo 140826
		}
		if ($orderBy!="") $strOrderBy =" ORDER BY ". $orderBy;
		if ($dict["misOVs"]=="S"){
			
			$misOVs = $this->getPermisosFromUsuario($dict["idusuario"]);
			$misIds="";
			while (list ($clave, $per) = each ($misOVs)) {
				$permiso= new ClsPermisos();
				$permiso = $per;
				$misIds .= $per->idov.","; 
			}
			if ($misIds!="") { 
				$misIds =	substr( $misIds, 0, strlen($misIds)-1);
				if ($strWhere!="") $strWhere = $strWhere." AND ";
				$strWhere = $strWhere." id in (". $misIds.") ";
			}
		}
			
		//var_dump("MIS-IDS-->"); var_dump($strWhere); //alfredo 140712 
		//$secVacias=$strWhere;	
		$_SESSION["MIS-IDS"]=$strWhere;
		
		if ($strWhere!="") {
				$strWhere = $objeto->refinarWhere($strWhere);
				$_SESSION["refinadaSTR"]=$strWhere;
		}
		
		if ($strWhere!="") {
				$strWhere= " WHERE ".$strWhere;
				//var_dump("STRWHERE-->"); var_dump($strWhere);//alfredo 140712
				$_SESSION["STRWHERE"]=$strWhere;
		}

		//if($strWhere==""){$collection=""; return $collection;}
		
		if ($secVacias || $strWhere!=""){   
		//if (!$secVacias && $strWhere!=""){ //alfredo 140712
			
			$sql ="SELECT ". $objeto->getCampos() ." FROM ". $objeto->getNombreTabla() . $strWhere . $strOrderBy;
			$this->visit->debuger->out("getTablaBusquedaOVsLimit: ". $objeto->getNombreTabla() ."-: $sql");
			// var_dump("VACIA-->"); var_dump($secVacias); var_dump($sql);

			$collection = $this->execSQLLimit( $sql, $objeto, $from, $count );
			//var_dump("COLECCION-->");var_dump($collection);
		}		
		return $collection;
	 }
	 

function getOVsClasificacionNoUserLimit($idsec,$controladosAnteriores,$from,$count){

		global $visit;

		$dictFilasSectionData = $visit->options->sectionData;

		

		$obj= new ClsVirtualObject();

		$idsAnteriores="";

		if ($controladosAnteriores!=""){

			//var_dump($controladosAnteriores);

			while (list ($clave, $temp) = each ($controladosAnteriores)) {

				if ($temp[0]!=null &&  $temp[1]!=null ){

					$idSeccion=$temp[0];

					$valorSeccion=$temp[1];

					//$seccion=$this->getSectionDataId($idSeccion);

					$seccion=$dictFilasSectionData[$idSeccion];

					if ($seccion->tipo_valores=="C") {

						$sqlData= "select * from controlled_data where idseccion=".$temp[0]." and value='".$temp[1]."' " ;

					}  else if ($seccion->tipo_valores=="N") {

						$sqlData= "select * from numeric_data where idseccion=".$temp[0]." and value='".$temp[1]."' " ;

					}  else if ($seccion->tipo_valores=="T") {

						$sqlData= "select * from text_data where idseccion=".$temp[0]." and value='".$temp[1]."' " ;

					}  else if ($seccion->tipo_valores=="F") {

						$sqlData= "select * from date_data where idseccion=".$temp[0]." and value='".$temp[1]."' " ;

					}  

					

					if ($idsAnteriores!="") $sqlData.= " AND idov in (".$idsAnteriores.") ";

					$sqlData = $sqlData." AND VALUE IS NOT NULL ";

					$temps = $this->conn->GetAll($sqlData); 

					

					$idsAnterioresCopia="";

					while (list ($clave, $tempC) = each ($temps)) {

						$idsAnterioresCopia.= $tempC["idov"].",";

						

					}

					if ($idsAnterioresCopia!="") {

					$idsAnteriores = substr( $idsAnterioresCopia, 0, strlen($idsAnterioresCopia)-1);

					}

				}

			}

		}			

		//Filtrado para solo contar los objetos que tengan valos en la seccición idsec		

		if($idsec!=""){

			//$seccion=$this->getSectionDataId($idsec);

			$seccion=$dictFilasSectionData[$idsec];

			if ($seccion->tipo_valores=="C") {

				$sqlData= "select * from controlled_data where idseccion=".$idsec ;

			}  else if ($seccion->tipo_valores=="N") {

				$sqlData= "select * from numeric_data where idseccion=".$idsec ;

			}  else if ($seccion->tipo_valores=="T") {

				$sqlData= "select * from text_data where idseccion=".$idsec ;

			}  else if ($seccion->tipo_valores=="F") {

				$sqlData= "select * from date_data where idseccion=".$idsec ;

			}  

			

			if ($idsAnteriores!="") $sqlData.= " AND idov in (".$idsAnteriores.") ";

			$sqlData = $sqlData." AND VALUE IS NOT NULL ";

			$temps = $this->conn->GetAll($sqlData);

			

			$idsAnterioresCopia="";

			if(!is_array($temps)){

				$temps = array();

			}

			while (list ($clave, $tempC) = each ($temps)) {

				$idsAnterioresCopia.= $tempC["idov"].",";

				

			}

			if ($idsAnterioresCopia!="") {

				$idsAnteriores = substr( $idsAnterioresCopia, 0, strlen($idsAnterioresCopia)-1);

			}

		}

		//$where =" idseccion = ".$idsec ;

		

		if ($idsAnteriores!=""){

			$where= " id in (".$idsAnteriores.") ";

		} else {

			$where= " id in (select distinct id from virtual_object) ";

		}

		$strWhere =" WHERE ". $where;

		$sql ="SELECT * FROM ". $obj->getNombreTabla() .$strWhere ." AND (ispublic ='S' AND isprivate='N')"." order by id " ;

		

		$this->visit->debuger->out("getOVsClasificacionLimit: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQLLimit( $sql, $obj, $from, $count );

		

		//$collection = $this->conn->GetAll($sql);

		return $collection;

	}











	 function getOVsClasificacionUserLimit($idsec,$controladosAnteriores,$from,$count){

		global $visit;

		$dictFilasSectionData = $visit->options->sectionData;

		$obj= new ClsVirtualObject();

		$idsAnteriores="";

		if ($controladosAnteriores!=""){

			//var_dump($controladosAnteriores);

			while (list ($clave, $temp) = each ($controladosAnteriores)) {

				if ($temp[0]!=null &&  $temp[1]!=null ){

					$idSeccion=$temp[0];

					$valorSeccion=$temp[1];

					//$seccion=$this->getSectionDataId($idSeccion);

					$seccion=$dictFilasSectionData[$idSeccion];

					if ($seccion->tipo_valores=="C") {

						$sqlData= "select * from controlled_data where idseccion=".$temp[0]." and value='".$temp[1]."' " ;

					}  else if ($seccion->tipo_valores=="N") {

						$sqlData= "select * from numeric_data where idseccion=".$temp[0]." and value='".$temp[1]."' " ;

					}  else if ($seccion->tipo_valores=="T") {

						$sqlData= "select * from text_data where idseccion=".$temp[0]." and value='".$temp[1]."' " ;

					}  else if ($seccion->tipo_valores=="F") {

						$sqlData= "select * from date_data where idseccion=".$temp[0]." and value='".$temp[1]."' " ;

					}  

					

					if ($idsAnteriores!="") $sqlData.= " AND idov in (".$idsAnteriores.") ";

					$sqlData = $sqlData." AND VALUE IS NOT NULL ";

					$temps = $this->conn->GetAll($sqlData); 

					

					$idsAnterioresCopia="";

					while (list ($clave, $tempC) = each ($temps)) {

						$idsAnterioresCopia.= $tempC["idov"].",";

						

					}

					if ($idsAnterioresCopia!="") {

					$idsAnteriores = substr( $idsAnterioresCopia, 0, strlen($idsAnterioresCopia)-1);

					}

				}

			}

		}			

		//Filtrado para solo contar los objetos que tengan valos en la seccición idsec		

		if($idsec!=""){

			//$seccion=$this->getSectionDataId($idsec);

			$seccion=$dictFilasSectionData[$idsec];

			if ($seccion->tipo_valores=="C") {

				$sqlData= "select * from controlled_data where idseccion=".$idsec ;

			}  else if ($seccion->tipo_valores=="N") {

				$sqlData= "select * from numeric_data where idseccion=".$idsec ;

			}  else if ($seccion->tipo_valores=="T") {

				$sqlData= "select * from text_data where idseccion=".$idsec ;

			}  else if ($seccion->tipo_valores=="F") {

				$sqlData= "select * from date_data where idseccion=".$idsec ;

			}  

			

			if ($idsAnteriores!="") $sqlData.= " AND idov in (".$idsAnteriores.") ";

			$sqlData = $sqlData." AND VALUE IS NOT NULL ";

			$temps = $this->conn->GetAll($sqlData);

			

			$idsAnterioresCopia="";

			while (list ($clave, $tempC) = each ($temps)) {

				$idsAnterioresCopia.= $tempC["idov"].",";

				

			}

			if ($idsAnterioresCopia!="") {

				$idsAnteriores = substr( $idsAnterioresCopia, 0, strlen($idsAnterioresCopia)-1);

			}

		}

		//$where =" idseccion = ".$idsec ;

		

		if ($idsAnteriores!=""){

			$where= " id in (".$idsAnteriores.") ";

		} else {

			$where= " id in (select distinct id from virtual_object) ";

		}

		$strWhere =" WHERE ". $where;

		$sql ="SELECT * FROM ". $obj->getNombreTabla() .$strWhere ." AND ((ispublic ='S' AND isprivate='N') OR (ispublic ='N' AND isprivate='N'))"." order by id " ;

		

		$this->visit->debuger->out("getOVsClasificacionLimit: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQLLimit( $sql, $obj, $from, $count );

		

		//$collection = $this->conn->GetAll($sql);

		return $collection;

	}



	function getOVsClasificacionAdminLimit($idsec,$controladosAnteriores,$from,$count){

		global $visit;

		$obj= new ClsVirtualObject();

		$dictFilasSectionData = $visit->options->sectionData;

		$idsAnteriores="";

		if ($controladosAnteriores!=""){

			//var_dump($controladosAnteriores);

			while (list ($clave, $temp) = each ($controladosAnteriores)) {

				if ($temp[0]!=null &&  $temp[1]!=null ){

					$idSeccion=$temp[0];

					$valorSeccion=$temp[1];

					//$seccion=$this->getSectionDataId($idSeccion);

					$seccion=$dictFilasSectionData[$idSeccion];

					if ($seccion->tipo_valores=="C") {

						$sqlData= "select * from controlled_data where idseccion=".$temp[0]." and value='".$temp[1]."' " ;

					}  else if ($seccion->tipo_valores=="N") {

						$sqlData= "select * from numeric_data where idseccion=".$temp[0]." and value='".$temp[1]."' " ;

					}  else if ($seccion->tipo_valores=="T") {

						$sqlData= "select * from text_data where idseccion=".$temp[0]." and value='".$temp[1]."' " ;

					}  else if ($seccion->tipo_valores=="F") {

						$sqlData= "select * from date_data where idseccion=".$temp[0]." and value='".$temp[1]."' " ;

					}  

					

					if ($idsAnteriores!="") $sqlData.= " AND idov in (".$idsAnteriores.") ";

					$sqlData = $sqlData." AND VALUE IS NOT NULL ";

					$temps = $this->conn->GetAll($sqlData);

					

					$idsAnterioresCopia="";

					while (list ($clave, $tempC) = each ($temps)) {

						$idsAnterioresCopia.= $tempC["idov"].",";

						

					}

					if ($idsAnterioresCopia!="") {

					$idsAnteriores = substr( $idsAnterioresCopia, 0, strlen($idsAnterioresCopia)-1);

					}

				}

			}

		}			

		//Filtrado para solo contar los objetos que tengan valos en la seccición idsec		

		if($idsec!=""){

			//$seccion=$this->getSectionDataId($idsec);

			$seccion=$dictFilasSectionData[$idsec];

			if ($seccion->tipo_valores=="C") {

				$sqlData= "select * from controlled_data where idseccion=".$idsec ;

			}  else if ($seccion->tipo_valores=="N") {

				$sqlData= "select * from numeric_data where idseccion=".$idsec ;

			}  else if ($seccion->tipo_valores=="T") {

				$sqlData= "select * from text_data where idseccion=".$idsec ;

			}  else if ($seccion->tipo_valores=="F") {

				$sqlData= "select * from date_data where idseccion=".$idsec ;

			}  

			

			if ($idsAnteriores!="") $sqlData.= " AND idov in (".$idsAnteriores.") ";

			$sqlData = $sqlData." AND VALUE IS NOT NULL ";

			$temps = $this->conn->GetAll($sqlData);

			

			if(!is_array($temps)){

				$temps = array();

			}

			$idsAnterioresCopia="";

			while (list ($clave, $tempC) = each ($temps)) {

				$idsAnterioresCopia.= $tempC["idov"].",";

				

			}

			if ($idsAnterioresCopia!="") {

				$idsAnteriores = substr( $idsAnterioresCopia, 0, strlen($idsAnterioresCopia)-1);

			}

		}

		//$where =" idseccion = ".$idsec ;

		

		if ($idsAnteriores!=""){

			$where= " id in (".$idsAnteriores.") ";

		} else {

			$where= " id in (select distinct id from virtual_object) ";

		}

		$strWhere =" WHERE ". $where;

		$sql ="SELECT * FROM ". $obj->getNombreTabla() .$strWhere ." AND isprivate='N' "." order by id " ;

		

		$this->visit->debuger->out("getOVsClasificacionLimit: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQLLimit( $sql, $obj, $from, $count );

		

		//$collection = $this->conn->GetAll($sql);

		return $collection;

	}



function getOVsClasificacionLimit($idsec,$controladosAnteriores,$from,$count){

		global $visit;

	$dictFilasSectionData = $visit->options->sectionData;

		$obj= new ClsVirtualObject();

		$idsAnteriores="";

		if ($controladosAnteriores!=""){

			//var_dump($controladosAnteriores);

			while (list ($clave, $temp) = each ($controladosAnteriores)) {

				if ($temp[0]!=null &&  $temp[1]!=null ){

					$idSeccion=$temp[0];

					$valorSeccion=$temp[1];

					//$seccion=$this->getSectionDataId($idSeccion);

					$seccion=$dictFilasSectionData[$idSeccion];

					if ($seccion->tipo_valores=="C") {

						$sqlData= "select * from controlled_data where idseccion=".$temp[0]." and value='".$temp[1]."' " ;

					}  else if ($seccion->tipo_valores=="N") {

						$sqlData= "select * from numeric_data where idseccion=".$temp[0]." and value='".$temp[1]."' " ;

					}  else if ($seccion->tipo_valores=="T") {

						$sqlData= "select * from text_data where idseccion=".$temp[0]." and value='".$temp[1]."' " ;

					}  else if ($seccion->tipo_valores=="F") {

						$sqlData= "select * from date_data where idseccion=".$temp[0]." and value='".$temp[1]."' " ;

					}

					if ($idsAnteriores!="") $sqlData.= " AND idov in (".$idsAnteriores.") ";

					$temps = $this->conn->GetAll($sqlData);

					

					$idsAnterioresCopia="";

					while (list ($clave, $tempC) = each ($temps)) {

						$idsAnterioresCopia.= $tempC["idov"].",";

						

					}

					if ($idsAnterioresCopia!="") {

					$idsAnteriores = substr( $idsAnterioresCopia, 0, strlen($idsAnterioresCopia)-1);

					}

				}

			}

		}			

		//Filtrado para solo contar los objetos que tengan valos en la seccición idsec		

		if($idsec!=""){

			//$seccion=$this->getSectionDataId($idsec);

			$seccion=$dictFilasSectionData[$idsec];

			if ($seccion->tipo_valores=="C") {

				$sqlData= "select * from controlled_data where idseccion=".$idsec ;

			}  else if ($seccion->tipo_valores=="N") {

				$sqlData= "select * from numeric_data where idseccion=".$idsec ;

			}  else if ($seccion->tipo_valores=="T") {

				$sqlData= "select * from text_data where idseccion=".$idsec ;

			}  else if ($seccion->tipo_valores=="F") {

				$sqlData= "select * from date_data where idseccion=".$idsec ;

			}  

			

			if ($idsAnteriores!="") $sqlData.= " AND idov in (".$idsAnteriores.") ";

			$sqlData = $sqlData." AND VALUE IS NOT NULL ";

			$temps = $this->conn->GetAll($sqlData);

			

			$idsAnterioresCopia="";

			if(!is_array($temps)){

				$temps = array();

			}

			while (list ($clave, $tempC) = each ($temps)) {

				$idsAnterioresCopia.= $tempC["idov"].",";

				

			}

			if ($idsAnterioresCopia!="") {

				$idsAnteriores = substr( $idsAnterioresCopia, 0, strlen($idsAnterioresCopia)-1);

			}

		}

		//$where =" idseccion = ".$idsec ;

		

		if ($idsAnteriores!=""){

			$where= " id in (".$idsAnteriores.") ";

		} else {

			$where= " id in (select distinct id from virtual_object) ";

		}

		$strWhere =" WHERE ". $where;

		$sql ="SELECT * FROM ". $obj->getNombreTabla() .$strWhere ." order by id " ;

	

		$this->visit->debuger->out("getOVsClasificacionLimit: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQLLimit( $sql, $obj, $from, $count );

		

		//$collection = $this->conn->GetAll($sql);

		return $collection;

	}



	function getRecursosClasificacionLimit($idsec,$idov,$controladosAnteriores,$from,$count){

		global $visit;

		$dictFilasSectionData = $visit->options->sectionData;

		$obj= new ClsResources();

		$idsAnteriores="";

		if ($controladosAnteriores!=""){

			//var_dump($controladosAnteriores);

			while (list ($clave, $temp) = each ($controladosAnteriores)) {

				if ($temp[0]!=null &&  $temp[1]!=null ){

					$idSeccion=$temp[0];

					$valorSeccion=$temp[1];

					//$seccion=$this->getSectionDataId($idSeccion);

					$seccion=$dictFilasSectionData[$idSeccion];

					if ($seccion->tipo_valores=="C") {

						$sqlData= "select * from controlled_data where idseccion=".$temp[0]." and value='".$temp[1]."' and idov=".$idov ;

					}  else if ($seccion->tipo_valores=="N") {

						$sqlData= "select * from numeric_data where idseccion=".$temp[0]." and value='".$temp[1]."' and idov=".$idov ;

					}  else if ($seccion->tipo_valores=="T") {

						$sqlData= "select * from text_data where idseccion=".$temp[0]." and value='".$temp[1]."' and idov=".$idov ;

					}  else if ($seccion->tipo_valores=="F") {

						$sqlData= "select * from date_data where idseccion=".$temp[0]." and value='".$temp[1]."' and idov=".$idov ;

					}  

					

					if ($idsAnteriores!="") $sqlData.= " AND idrecurso in (".$idsAnteriores.") ";

					$temps = $this->conn->GetAll($sqlData);

					$idsAnterioresCopia="";

					while (list ($clave, $tempC) = each ($temps)) {

						$idsAnterioresCopia.= $tempC["idrecurso"].",";

					}

					if ($idsAnterioresCopia!="") {

					$idsAnteriores = substr( $idsAnterioresCopia, 0, strlen($idsAnterioresCopia)-1);

					}

				}

			}

		}

		//$where =" idseccion = ".$idsec ;

		

		if ($idsAnteriores!="") $where= " id in (".$idsAnteriores.") ";

		if ($where!="") {

			$strWhere =" WHERE ". $where;

			$sql ="SELECT * FROM ". $obj->getNombreTabla() . $strWhere." AND (visible='S') order by id " ;

			$this->visit->debuger->out("getRecursosClasificacionLimit: ". $obj->getNombreTabla() ."-: $sql");

			

			$collection = $this->execSQLLimit( $sql, $obj, $from, $count );

			//$collection = $this->conn->GetAll($sql);

			return $collection;

		} else return "";

	}



	function getOVsClasificacionCount($idsec,$controladosAnteriores,$controlado){

		global $visit;

		$dictFilasSectionData = $visit->options->sectionData;

		$obj= new ClsVirtualObject();

		$idsAnteriores="";

		if ($controladosAnteriores!=""){

			while (list ($clave, $temp) = each ($controladosAnteriores)) {

				if ($temp[0]!=null &&  $temp[1]!=null ){

					$idSeccion=$temp[0];

					$valorSeccion=$temp[1];

					//$seccion=$this->getSectionDataId($idSeccion);

					$seccion=$dictFilasSectionData[$idSeccion];

					if ($seccion->tipo_valores=="C") {

						$sqlData= "select * from controlled_data where idseccion=".$temp[0]." and value='".$temp[1]."' " ;

					}  else if ($seccion->tipo_valores=="N") {

						$sqlData= "select * from numeric_data where idseccion=".$temp[0]." and value='".$temp[1]."' " ;

					}  else if ($seccion->tipo_valores=="T") {

						$sqlData= "select * from text_data where idseccion=".$temp[0]." and value='".$temp[1]."' " ;

					}  else if ($seccion->tipo_valores=="F") {

						$sqlData= "select * from date_data where idseccion=".$temp[0]." and value='".$temp[1]."' " ;

					}  

					

					if ($idsAnteriores!="") $sqlData.= " AND idov in (".$idsAnteriores.") ";

					$temps = $this->conn->GetAll($sqlData);

					

					$idsAnterioresCopia="";

					while (list ($clave, $tempC) = each ($temps)) {

						$idsAnterioresCopia.= $tempC["idov"].",";

						

					}

					if ($idsAnterioresCopia!="") {

						$idsAnteriores = substr( $idsAnterioresCopia, 0, strlen($idsAnterioresCopia)-1);

					}

				}

			}

		}	



		//Filtrado para solo contar los objetos que tengan valos en la seccición idsec		

		if($idsec!=""){

			//$seccion=$this->getSectionDataId($idsec);

			$seccion=$dictFilasSectionData[$idsec];

			if ($seccion->tipo_valores=="C") {

				$sqlData= "select * from controlled_data where idseccion=".$idsec ;

			}  else if ($seccion->tipo_valores=="N") {

				$sqlData= "select * from numeric_data where idseccion=".$idsec ;

			}  else if ($seccion->tipo_valores=="T") {

				$sqlData= "select * from text_data where idseccion=".$idsec ;

			}  else if ($seccion->tipo_valores=="F") {

				$sqlData= "select * from date_data where idseccion=".$idsec ;

			}  

			

			if ($idsAnteriores!="") $sqlData.= " AND idov in (".$idsAnteriores.") ";

			$sqlData=$sqlData." AND VALUE IS NOT NULL";

			$temps = $this->conn->GetAll($sqlData);

			if(!is_array($temps)){

				$temps = array();

			}

			$idsAnterioresCopia="";

			while (list ($clave, $tempC) = each ($temps)) {

				$idsAnterioresCopia.= $tempC["idov"].",";

				

			}

			if ($idsAnterioresCopia!="") {

				$idsAnteriores = substr( $idsAnterioresCopia, 0, strlen($idsAnterioresCopia)-1);

			}

		}



		//$where = $where. " AND idsec = ".$idsec;

		

		if ($idsAnteriores!=""){

			$where= " id in (".$idsAnteriores.") ";

		} else {

			$where= " id in (select distinct id from virtual_object) ";

		}

		

		/*if($idsec!=""){

			$where = $where." AND id IN 

					 (SELECT idov FROM text_data WHERE idseccion=".$idsec.

					") OR id IN (SELECT idov FROM numeric_data WHERE idseccion=".$idsec.

					") OR id IN (SELECT idov FROM controlled_data WHERE idseccion=".$idsec.

					") OR id IN (SELECT idov FROM date_data WHERE idseccion=".$idsec.") ";

		}*/



		$strWhere =" WHERE ". $where;		



		$sql ="SELECT COUNT(*) as CUENTA FROM ". $obj->getNombreTabla() . $strWhere." order by id " ;

		$this->visit->debuger->out("getOVsClasificacionCount: ". $obj->getNombreTabla() ."-: $sql");



		$collection = $this->conn->GetAll($sql);

		return $collection[0]["CUENTA"];

		

	}



function getOVsClasificacionNoUserCount($idsec,$controladosAnteriores,$controlado){

		global $visit;

		$dictFilasSectionData = $visit->options->sectionData;

		$obj= new ClsVirtualObject();

		$idsAnteriores="";

		if ($controladosAnteriores!=""){

			//var_dump($controladosAnteriores);

			while (list ($clave, $temp) = each ($controladosAnteriores)) {

				if ($temp[0]!=null &&  $temp[1]!=null ){

					$idSeccion=$temp[0];

					$valorSeccion=$temp[1];

					//$seccion=$this->getSectionDataId($idSeccion);

					$seccion=$dictFilasSectionData[$idSeccion];

					if ($seccion->tipo_valores=="C") {

						$sqlData= "select * from controlled_data where idseccion=".$temp[0]." and value='".$temp[1]."' " ;

					}  else if ($seccion->tipo_valores=="N") {

						$sqlData= "select * from numeric_data where idseccion=".$temp[0]." and value='".$temp[1]."' " ;

					}  else if ($seccion->tipo_valores=="T") {

						$sqlData= "select * from text_data where idseccion=".$temp[0]." and value='".$temp[1]."' " ;

					}  else if ($seccion->tipo_valores=="F") {

						$sqlData= "select * from date_data where idseccion=".$temp[0]." and value='".$temp[1]."' " ;

					}  

					

					if ($idsAnteriores!="") $sqlData.= " AND idov in (".$idsAnteriores.") ";

					$temps = $this->conn->GetAll($sqlData);

					

					$idsAnterioresCopia="";

					while (list ($clave, $tempC) = each ($temps)) {

						$idsAnterioresCopia.= $tempC["idov"].",";

						

					}

					if ($idsAnterioresCopia!="") {

					$idsAnteriores = substr( $idsAnterioresCopia, 0, strlen($idsAnterioresCopia)-1);

					}

				}

			}

		}



		//Filtrado para solo contar los objetos que tengan valos en la seccición idsec		

		if($idsec!=""){

			//$seccion=$this->getSectionDataId($idsec);

			$seccion=$dictFilasSectionData[$idsec];

			if ($seccion->tipo_valores=="C") {

				$sqlData= "select * from controlled_data where idseccion=".$idsec ;

			}  else if ($seccion->tipo_valores=="N") {

				$sqlData= "select * from numeric_data where idseccion=".$idsec ;

			}  else if ($seccion->tipo_valores=="T") {

				$sqlData= "select * from text_data where idseccion=".$idsec ;

			}  else if ($seccion->tipo_valores=="F") {

				$sqlData= "select * from date_data where idseccion=".$idsec ;

			}  

			

			if ($idsAnteriores!="") $sqlData.= " AND idov in (".$idsAnteriores.") ";

			$sqlData=$sqlData." AND VALUE IS NOT NULL";

			$temps = $this->conn->GetAll($sqlData);

			

			$idsAnterioresCopia="";

			if(!is_array($temps)){

				$temps = array();

			}

			while (list ($clave, $tempC) = each ($temps)) {

				$idsAnterioresCopia.= $tempC["idov"].",";

				

			}

			if ($idsAnterioresCopia!="") {

				$idsAnteriores = substr( $idsAnterioresCopia, 0, strlen($idsAnterioresCopia)-1);

			}

		}

			

		//$where =" idseccion = ".$idsec ;

		

		if ($idsAnteriores!=""){

			$where= " id in (".$idsAnteriores.") ";

		} else {

			$where= " id in (select distinct id from virtual_object) ";

		}

		$strWhere =" WHERE ". $where;

		

		$sql ="SELECT COUNT(*) as CUENTA FROM ". $obj->getNombreTabla() .$strWhere ." AND (ispublic ='S' AND isprivate='N')"." order by id " ;	

		$this->visit->debuger->out("getOVsClasificacionCount: ". $obj->getNombreTabla() ."-: $sql");		

		$collection = $this->conn->GetAll($sql);

		return $collection[0]["CUENTA"];

		

	}



function getOVsClasificacionUserCount($idsec,$controladosAnteriores,$controlado){

		global $visit;

		$dictFilasSectionData = $visit->options->sectionData;

		$obj= new ClsVirtualObject();

		$idsAnteriores="";

		if ($controladosAnteriores!=""){

			//var_dump($controladosAnteriores);

			while (list ($clave, $temp) = each ($controladosAnteriores)) {

				if ($temp[0]!=null &&  $temp[1]!=null ){

					$idSeccion=$temp[0];

					$valorSeccion=$temp[1];

					//$seccion=$this->getSectionDataId($idSeccion);

					$seccion=$dictFilasSectionData[$idSeccion];

					if ($seccion->tipo_valores=="C") {

						$sqlData= "select * from controlled_data where idseccion=".$temp[0]." and value='".$temp[1]."' " ;

					}  else if ($seccion->tipo_valores=="N") {

						$sqlData= "select * from numeric_data where idseccion=".$temp[0]." and value='".$temp[1]."' " ;

					}  else if ($seccion->tipo_valores=="T") {

						$sqlData= "select * from text_data where idseccion=".$temp[0]." and value='".$temp[1]."' " ;

					}  else if ($seccion->tipo_valores=="F") {

						$sqlData= "select * from date_data where idseccion=".$temp[0]." and value='".$temp[1]."' " ;

					}  

					

					if ($idsAnteriores!="") $sqlData.= " AND idov in (".$idsAnteriores.") ";

					$temps = $this->conn->GetAll($sqlData);

					

					$idsAnterioresCopia="";

					while (list ($clave, $tempC) = each ($temps)) {

						$idsAnterioresCopia.= $tempC["idov"].",";

						

					}

					if ($idsAnterioresCopia!="") {

					$idsAnteriores = substr( $idsAnterioresCopia, 0, strlen($idsAnterioresCopia)-1);

					}

				}

			}

		}



		//Filtrado para solo contar los objetos que tengan valos en la seccición idsec		

		if($idsec!=""){

			//$seccion=$this->getSectionDataId($idsec);

			$seccion=$dictFilasSectionData[$idsec];

			if ($seccion->tipo_valores=="C") {

				$sqlData= "select * from controlled_data where idseccion=".$idsec ;

			}  else if ($seccion->tipo_valores=="N") {

				$sqlData= "select * from numeric_data where idseccion=".$idsec ;

			}  else if ($seccion->tipo_valores=="T") {

				$sqlData= "select * from text_data where idseccion=".$idsec ;

			}  else if ($seccion->tipo_valores=="F") {

				$sqlData= "select * from date_data where idseccion=".$idsec ;

			}  

			

			if ($idsAnteriores!="") $sqlData.= " AND idov in (".$idsAnteriores.") ";

			$sqlData=$sqlData." AND VALUE IS NOT NULL";

			$temps = $this->conn->GetAll($sqlData);

			

			$idsAnterioresCopia="";

			while (list ($clave, $tempC) = each ($temps)) {

				$idsAnterioresCopia.= $tempC["idov"].",";

				

			}

			if ($idsAnterioresCopia!="") {

				$idsAnteriores = substr( $idsAnterioresCopia, 0, strlen($idsAnterioresCopia)-1);

			}

		}

			

		//$where =" idseccion = ".$idsec ;

		

		if ($idsAnteriores!=""){

			$where= " id in (".$idsAnteriores.") ";

		} else {

			$where= " id in (select distinct id from virtual_object) ";

		}

		$strWhere =" WHERE ". $where;

		

		$sql ="SELECT COUNT(*) as CUENTA FROM ". $obj->getNombreTabla() .$strWhere ." AND ((ispublic ='S' AND isprivate='N') OR (ispublic ='N' AND isprivate='N'))"." order by id " ;	

		$this->visit->debuger->out("getOVsClasificacionCount: ". $obj->getNombreTabla() ."-: $sql");		

		$collection = $this->conn->GetAll($sql);

		return $collection[0]["CUENTA"];

		

	}





function getOVsClasificacionAdminCount($idsec,$controladosAnteriores,$controlado){

		global $visit;

		$dictFilasSectionData = $visit->options->sectionData;

		$obj= new ClsVirtualObject();

		$idsAnteriores="";

		if ($controladosAnteriores!=""){

			//var_dump($controladosAnteriores);

			while (list ($clave, $temp) = each ($controladosAnteriores)) {

				if ($temp[0]!=null &&  $temp[1]!=null ){

					$idSeccion=$temp[0];

					$valorSeccion=$temp[1];

					//$seccion=$this->getSectionDataId($idSeccion);

					$seccion=$dictFilasSectionData[$idSeccion];

					if ($seccion->tipo_valores=="C") {

						$sqlData= "select * from controlled_data where idseccion=".$temp[0]." and value='".$temp[1]."' " ;

					}  else if ($seccion->tipo_valores=="N") {

						$sqlData= "select * from numeric_data where idseccion=".$temp[0]." and value='".$temp[1]."' " ;

					}  else if ($seccion->tipo_valores=="T") {

						$sqlData= "select * from text_data where idseccion=".$temp[0]." and value='".$temp[1]."' " ;

					}  else if ($seccion->tipo_valores=="F") {

						$sqlData= "select * from date_data where idseccion=".$temp[0]." and value='".$temp[1]."' " ;

					}  

					

					if ($idsAnteriores!="") $sqlData.= " AND idov in (".$idsAnteriores.") ";

					$temps = $this->conn->GetAll($sqlData);

					

					$idsAnterioresCopia="";

					while (list ($clave, $tempC) = each ($temps)) {

						$idsAnterioresCopia.= $tempC["idov"].",";

						

					}

					if ($idsAnterioresCopia!="") {

					$idsAnteriores = substr( $idsAnterioresCopia, 0, strlen($idsAnterioresCopia)-1);

					}

				}

			}

		}			

		//Filtrado para solo contar los objetos que tengan valos en la seccición idsec		

		if($idsec!=""){

			//$seccion=$this->getSectionDataId($idsec);

			$seccion=$dictFilasSectionData[$idsec];

			if ($seccion->tipo_valores=="C") {

				$sqlData= "select * from controlled_data where idseccion=".$idsec ;

			}  else if ($seccion->tipo_valores=="N") {

				$sqlData= "select * from numeric_data where idseccion=".$idsec ;

			}  else if ($seccion->tipo_valores=="T") {

				$sqlData= "select * from text_data where idseccion=".$idsec ;

			}  else if ($seccion->tipo_valores=="F") {

				$sqlData= "select * from date_data where idseccion=".$idsec ;

			}  

			

			if ($idsAnteriores!="") $sqlData.= " AND idov in (".$idsAnteriores.") ";

			$sqlData=$sqlData." AND VALUE IS NOT NULL";

			$temps = $this->conn->GetAll($sqlData);

			

			if(!is_array($temps)){

				$temps = array();

			}

			$idsAnterioresCopia="";

			while (list ($clave, $tempC) = each ($temps)) {

				$idsAnterioresCopia.= $tempC["idov"].",";

				

			}

			if ($idsAnterioresCopia!="") {

				$idsAnteriores = substr( $idsAnterioresCopia, 0, strlen($idsAnterioresCopia)-1);

			}

		}

		//$where =" idseccion = ".$idsec ;

		

		if ($idsAnteriores!=""){

			$where= " id in (".$idsAnteriores.") ";

		} else {

			$where= " id in (select distinct id from virtual_object) ";

		}

		$strWhere =" WHERE ". $where;

		

		$sql ="SELECT COUNT(*) as CUENTA FROM ". $obj->getNombreTabla() .$strWhere ." AND isprivate='N' "." order by id " ;

		$this->visit->debuger->out("getOVsClasificacionCount: ". $obj->getNombreTabla() ."-: $sql");		

		$collection = $this->conn->GetAll($sql);

		return $collection[0]["CUENTA"];

		

	}





/*/////////////@@@@@@@@@@@@@@@@@@@@@@@@////////////////////*/

	function getOVsFromSeccionCount($idsec,$tipo_valor){

		global $visit;

		if ($tipo_valor=="C") {

			$sqlData= "select count(idov) as CUENTA from controlled_data where idseccion=".$idsec ;

		}  else if ($tipo_valor=="N") {

			$sqlData= "select count(idov) as CUENTA from numeric_data where idseccion=".$idsec ;

		}  else if ($tipo_valor=="T") {

			$sqlData= "select count(idov) as CUENTA from text_data where idseccion=".$idsec ;

		}  

		$this->visit->debuger->out("getOVsFromSeccionCount: ". $sqlData ."-: $sql");

		$collection = $this->conn->GetAll($sqlData);

		return $collection[0]["CUENTA"];

		

	}





		 //devuelve true si el usuario con idusuario pasado como parámetro tiene permisos de tipo permiso, para el idov pasado

		 //como parámetro y false e.o.c.

	

	 function tienePermisoUsuarioSobreOV($permiso,$idov,$idUsuario){

		$objeto= new ClsPermisos();

		$strWhere = "idusuario=".$idUsuario." and tipoPermiso='".$permiso."' and idov=".$idov;

		//if ($orderBy!="") $strOrderBy =" ORDER BY ". $orderBy;

		if ($strWhere!="") $strWhere= " WHERE ".$strWhere;

		$sql ="SELECT COUNT(*) AS CUENTA FROM  ". $objeto->getNombreTabla() . $strWhere ;

		$this->visit->debuger->out("tienePermisoUsuarioSobreOV: ". $objeto->getNombreTabla() ."-: $sql");

		$collection = $this->conn->GetAll($sql);

		//echo "************* ".$sql,"<br>";

		return $collection[0]["CUENTA"]>0;

	 }

	  function eliminarPermisosSobreOV($permiso,$idov){

		$objeto= new ClsPermisos();

		$strWhere = " tipoPermiso='".$permiso."' and idov=".$idov;

		//if ($orderBy!="") $strOrderBy =" ORDER BY ". $orderBy;

		if ($strWhere!="") $strWhere= " WHERE ".$strWhere;

		$sql ="DELETE FROM  ". $objeto->getNombreTabla() . $strWhere ;

		$this->visit->debuger->out("tienePermisoUsuarioSobreOV: ". $objeto->getNombreTabla() ."-: $sql");

		//echo "************* ".$sql,"<br>";

		$this->conn->Execute( $sql );

			

	 }

	 function eliminarPermisosFromUser($idusuario){

		$objeto= new ClsPermisos();

		$strWhere = " idusuario=".$idusuario;

		//if ($orderBy!="") $strOrderBy =" ORDER BY ". $orderBy;

		if ($strWhere!="") $strWhere= " WHERE ".$strWhere;

		$sql ="DELETE FROM  ". $objeto->getNombreTabla() . $strWhere ;

		$this->conn->Execute( $sql );

			

	 }

	 function getPermisosFromOV($idov){

		$objeto= new ClsPermisos();

		$strWhere = " idov=".$idov;

		//if ($orderBy!="") $strOrderBy =" ORDER BY ". $orderBy;

		if ($strWhere!="") $strWhere= " WHERE ".$strWhere;

		$sql ="SELECT * FROM  ". $objeto->getNombreTabla() . $strWhere ;

		$this->visit->debuger->out("getPermisosFromOV: ". $objeto->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $objeto );

		//echo "************* ".$sql,"<br>";

		return $collection;

	 }



	 function getResourcesFromOV($idov){

		$objeto= new ClsResources();

		$strWhere = " idov=".$idov;

		//if ($orderBy!="") $strOrderBy =" ORDER BY ". $orderBy;

		if ($strWhere!="") $strWhere= " WHERE ".$strWhere;

		$sql ="SELECT * FROM  ". $objeto->getNombreTabla() . $strWhere ;

		$this->visit->debuger->out("getPermisosFromOV: ". $objeto->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $objeto );

		//echo "************* ".$sql,"<br>";

		return $collection;

	 }

	 function getPermisosFromUsuario($idusuario){

		$objeto = new ClsPermisos();

		$strWhere = " idusuario = ".$idusuario;

		//if ($orderBy!="") $strOrderBy =" ORDER BY ". $orderBy;

		if ($strWhere!="") $strWhere= " WHERE ".$strWhere." ORDER BY id";

		$sql ="SELECT * FROM  ". $objeto->getNombreTabla() . $strWhere ;

		$this->visit->debuger->out("getPermisosFromOV: ". $objeto->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $objeto );

		//echo "************* ".$sql,"<br>";exit();

		return $collection;

	 }

	 

	  function getPermisosFromUsuarioOrderbyIdov($idusuario){

		//alfredo 140130

		$objeto = new ClsPermisos();

		$strWhere = " idusuario = ".$idusuario;

		//if ($orderBy!="") $strOrderBy =" ORDER BY ". $orderBy;

		if ($strWhere!="") $strWhere= " WHERE ".$strWhere." ORDER BY idov";

		$sql ="SELECT * FROM  ". $objeto->getNombreTabla() . $strWhere ;

		$this->visit->debuger->out("getPermisosFromOV: ". $objeto->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $objeto );

		//echo "************* ".$sql,"<br>";exit();

		return $collection;

	 }

	 

	 function getListaPermisosFromUsuario($idusuario){

		$objeto= new ClsPermisos();

		$strWhere = " idusuario=".$idusuario;

		//if ($orderBy!="") $strOrderBy =" ORDER BY ". $orderBy;

		if ($strWhere!="") $strWhere= " WHERE ".$strWhere." ORDER BY id";

		$sql ="SELECT idov FROM  ". $objeto->getNombreTabla() . $strWhere ;

		$this->visit->debuger->out("getPermisosFromOV: ". $objeto->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL( $sql, $objeto );

		$result = "";

		for ($i=0;$i<count($collection);$i++) {

			$result .= $collection[$i]->idov.",";

		}

		return $result;

	 }



	 /* 

	 * Un objeto es Visible si:

	 *  user: no es privado 

	 *  admin: no es privado

	 *  superadmin: siempre

	 */

	 function isOVVisible($id){

		if($_SESSION["UserRolUser"] == "A"){

			return true;

		}else {

			$objeto = new ClsVirtualObject();

			$sql ="SELECT * FROM  ". $objeto->getNombreTabla() ." WHERE id=" . $id ." AND isprivate!='S'";

			$collection = $this->execSQL( $sql, $objeto );

			return count($collection)>0;

		}

		return false;

	 }



	 /* 

	 * Un objeto es Accesible si:

	 *  user: no es privado y es público 

	 *  admin: no es privado

	 *  superadmin: siempre

	 */

	 function isOVAccesible($id){

		 

		if($_SESSION["UserRolUser"] == "A"){

			return true;

		}elseif($_SESSION["UserRolUser"] == "B"){

			$objeto = new ClsVirtualObject();

			$sql ="SELECT * FROM  ". $objeto->getNombreTabla() ." WHERE id=" . $id ." AND isprivate!='S'";

			$collection = $this->execSQL( $sql, $objeto );

			return count($collection)>0;

		}elseif($_SESSION["UserRolUser"] == "C"){

			$objeto = new ClsVirtualObject();

			$sql ="SELECT * FROM  ". $objeto->getNombreTabla() ." WHERE id=" . $id ." AND isprivate!='S'";

			$collection = $this->execSQL( $sql, $objeto );

			return count($collection)>0;

		}else {

			$objeto = new ClsVirtualObject();

			$sql ="SELECT * FROM  ". $objeto->getNombreTabla() ." WHERE id=" . $id ." AND isprivate!='S'  AND ispublic!='N'";

			$collection = $this->execSQL( $sql, $objeto );

			return count($collection)>0;

		}

		return false;

	 }



	 function isOVAccesibleBusqueda($id){

		

		if($_SESSION["UserRolUser"] == "A"){

			return true;

		}elseif($_SESSION["UserRolUser"] == "B"){

			$objeto = new ClsVirtualObject();

			$sql ="SELECT * FROM  ". $objeto->getNombreTabla() ." WHERE id=" . $id->id ." AND isprivate='N'";

			$collection = $this->execSQL( $sql, $objeto );

			return count($collection)>0;

		}elseif($_SESSION["UserRolUser"] == "C"){

			$objeto = new ClsVirtualObject();

			$sql ="SELECT * FROM  ". $objeto->getNombreTabla() ." WHERE id=" . $id->id ." AND isprivate='N'";

			$collection = $this->execSQL( $sql, $objeto );

			return count($collection)>0;

		}else {

			$objeto = new ClsVirtualObject();

			$sql ="SELECT * FROM  ". $objeto->getNombreTabla() ." WHERE id=" . $id->id ." AND isprivate='N'  AND ispublic='S'";

			$collection = $this->execSQL( $sql, $objeto );

			return count($collection)>0;

		}

		return false;

	 }

	 /*comprueba si una seccion esta en algun ojeto accesible

	 se puede optimizar mucho*/

	 function isSeccionAccesible($idSeccion){

		global $visit;

		$strWhere = " WHERE idseccion=".$idSeccion;

		$sql2 ="( id IN (SELECT idov FROM text_data " . $strWhere.

				") OR id IN (SELECT idov FROM numeric_data " . $strWhere.

				") OR id IN (SELECT idov FROM controlled_data " . $strWhere.

				") OR id IN (SELECT idov FROM date_data " . $strWhere.") )";

		$admin = $visit->options->usuario->rol=="B";

		$superadmin = $visit->options->usuario->rol=="A";

		if($superadmin){

			return true;

		}else{

			//si es admin o usuario 

			$objeto = new ClsVirtualObject();

			$sql ="SELECT * FROM  ". $objeto->getNombreTabla() ." WHERE " . $sql2 ." AND isprivate!='S'";

			$collection = $this->execSQL( $sql, $objeto );

			return count($collection)>0;

		}

		return false;

	 }



	 function getOVFromId($id){

		$objeto = new ClsVirtualObject();

		$sql ="SELECT * FROM  ". $objeto->getNombreTabla() ." WHERE id=" . $id;

		$collection = $this->execSQL( $sql, $objeto );

		return $collection[0];

	 }

	 function getOVFromIdAdmin($id){

		$objeto = new ClsVirtualObject();

		$sql ="SELECT * FROM  ". $objeto->getNombreTabla() ." WHERE id=" . $id ." AND (isprivate!='S' OR isprivate IS NULL)";

		$collection = $this->execSQL( $sql, $objeto );

		return $collection[0];

	 }

	 function getOVFromIdUser($id){

		$objeto = new ClsVirtualObject();

		$sql ="SELECT * FROM  ". $objeto->getNombreTabla() ." WHERE id=" . $id ." AND isprivate!='S' AND ispublic!='N'";

		$collection = $this->execSQL( $sql, $objeto );

		return $collection[0];

	 }



	 function modificarIcono($idrec,$idov) {

		$obj=new ClsResources();

		$sql = "SELECT  id FROM resources where iconoov='S' and idov=".$idov." order by id ";

		$collection = $this->execSQL( $sql, $obj );

		if($idrec==$collection[0]->id){

			$sql0 = "UPDATE resources SET iconoov='N' WHERE id=" . $idrec . " AND idov=" . $idov;

			$ret = $this->conn->Execute( $sql0 );

		} else {

			$sql1 = "UPDATE resources SET iconoov='S' WHERE id=" . $idrec . " AND idov=" . $idov;

			$ret = $this->conn->Execute( $sql1 );

			$sql2 = "UPDATE resources SET iconoov='N' WHERE id!=" . $idrec . " AND idov=" . $idov;

			$ret = $this->conn->Execute( $sql2 );

		}

		return $sql1." ".$sql2;

	}

	//Construye el numbre del icono

	function getNombreIcono($idov,$name){

		global $visit;

		$nombreIco ="";

		if(name != ""){

			$extension= $visit->util->getExtension($name);

			$nombreIco = $idov.".".$extension;			

		}

		//echo "<br>".$nombreIco."<br>";

		return $nombreIco;

	}

	//Borra el icono de un recurso  si existe 

	function borraUnIcono($id){

		$recurso = $this->getResourcesId($id);

		if($recurso->name != "" && $recurso->iconoov=="S"){

			$path = getcwd()."/../download/iconos";

			$nombreIco = $this->getNombreIcono($recurso->idov,$recurso->name);

			if(file_exists($path."/".$nombreIco)){

				unlink($path."/".$nombreIco);

			}

		}

		

	}

	

	//Borra todos los iconos de una carpeta

	function limpiaIconos($idov){

		$obj=new ClsResources();

		$sql = "SELECT * FROM resources where iconoov='S' and idov=".$idov." order by id ";

		$collection = $this->execSQL( $sql, $obj );		

		$path = getcwd()."/../download/iconos";

		foreach ($collection as $clave=>$item){

			if($item->name != ""){			

				$nombreIco = $this->getNombreIcono($item->idov,$item->name);

				if(file_exists($path."/".$nombreIco)){

					unlink($path."/".$nombreIco);

				}

			}

		}

	}

	//crea la imagen icono

	function crearImagenIcono($idov,$id){

		$recurso = $this->getResourcesId($id);

			

		if($recurso->name != "" ){

			//Hacer Imagen Icono 

			if($recurso->iconoov =="S"){

				$image = new ClsSimpleImage();

				if($recurso->idov_refered != ""){//alfredo 140728 Recurso Ajeno	

					$pathAjeno =  getcwd()."/../download/".$recurso->idov_refered;//alfredo 140728

					$image->load($pathAjeno."/".$recurso->name);					

				}else {	//Recurso Propio

					$path = getcwd()."/../download/".$idov;

					$image->load($path."/".$recurso->name);	

				}

				echo $nombreIco;

				$nombreIco = $this->getNombreIcono($recurso->idov,$recurso->name);   				

  				$image->resizeToWidth(120);

  				$pathIcono = getcwd()."/../download/iconos";

   				$image->save($pathIcono."/".$nombreIco);

			}

			

		}		

	}

	function countHijosNavegacion($id){

		$objeto= new ClsNavegacion();

		$strWhere = "idpadre=".$id;

		//if ($orderBy!="") $strOrderBy =" ORDER BY ". $orderBy;

		if ($strWhere!="") $strWhere= " WHERE ".$strWhere;

		$sql ="SELECT COUNT(*) AS CUENTA FROM  ". $objeto->getNombreTabla() . $strWhere ;

		$this->visit->debuger->out("tieneHijosNavegacion: ". $objeto->getNombreTabla() ."-: $sql");

		$collection = $this->conn->GetAll($sql);

		return $collection[0]["CUENTA"];

	 }

	function getPrimerHijoOrden($id){

		global $visit;

		$e = new ClsSectionData();

		$sql ="SELECT Min(orden) AS ORDEN FROM section_data WHERE idpadre='".$id."' AND visible='S' AND browseable='S'";

		$collectionaux = $this->conn->GetAll($sql);

		///$inorden = $collectionaux [0]["ORDEN"];

		///$sql ="SELECT * FROM section_data WHERE orden='".$inorden."' AND idpadre='".$id."'";

		$sql ="SELECT * FROM section_data WHERE  idpadre='".$id."'";

		$this->visit->debuger->out("getPrimerHijoOrden: $sql");

		$collection = $this->execSQL( $sql, $e);

		$res=$collection;

		return $res;	

	}

	function getMaxOrdenSectionData($idpadre){

		$e = new ClsSectionData();

		$sql = "SELECT MAX(orden) as cuenta FROM ". $e->getNombreTabla() . " WHERE idpadre='".$idpadre."' ORDER BY orden";

		$collection = $this->conn->GetAll($sql);

		return $collection[0]["cuenta"];

	}

	function actualizarPadreSectionData($id,$idabuelo){

		$e = new ClsSectionData();

		///Averiguar orden

		$maxOrden =  $this->getMaxOrdenSectionData($idabuelo);

		///Actualizar todos

		$sql = "SELECT ". $e->getCampos() ." FROM ". $e->getNombreTabla() . " WHERE idpadre='".$id."' ORDER BY orden";

		$collection = $this->execSQL($sql,$e);

		for($i=0;$i<count($collection);$i++){	

			$vaux = 1+$maxOrden+$i; 

			$sql1 = "UPDATE ".$e->getNombreTabla()." SET idpadre=".$idabuelo.", orden=".$vaux." WHERE id=".$collection[$i]->id;

			$ret = $this->conn->Execute($sql1);

		}

		return $sql1;

	}

	function &getTextDataFromSectionResourceOV($idov,$idrecurso,$idseccion){

		$e = new ClsTextData();

		$sql = "SELECT ". $e->getCampos() ." FROM ". $e->getNombreTabla() . " WHERE idov='".$idov."' AND idrecurso='".$idrecurso."' AND idseccion='".$idseccion."'";

		$collection = $this->execSQL($sql,$e);

 		$e = $collection[0];

 		return $e->value;

	}

	function &getNumericDataFromSectionResourceOV($idov,$idrecurso,$idseccion){

		$e = new ClsNumericData();

		$sql = "SELECT ". $e->getCampos() ." FROM ". $e->getNombreTabla() . " WHERE idov='".$idov."' AND idrecurso='".$idrecurso."' AND idseccion='".$idseccion."'";

		$collection = $this->execSQL($sql,$e);

 		$e = $collection[0];

 		return $e->value;

	}

	function &getControlledDataFromSectionResourceOV($idov,$idrecurso,$idseccion){

		

		$e = new ClsControlledData();

		$sql = "SELECT ". $e->getCampos() ." FROM ". $e->getNombreTabla() . " WHERE idov='".$idov."' AND idrecurso='".$idrecurso."' AND idseccion='".$idseccion."'";

		$collection = $this->execSQL($sql,$e);

 		$e = $collection[0];

 		return $e->value;

	}

	function &getDateDataFromSectionResourceOV($idov,$idrecurso,$idseccion){

		$e = new ClsDateData();

		$sql = "SELECT ". $e->getCampos() ." FROM ". $e->getNombreTabla() . " WHERE idov='".$idov."' AND idrecurso='".$idrecurso."' AND idseccion='".$idseccion."'";

		$collection = $this->execSQL($sql,$e);

 		$e = $collection[0];

 		return $e->value;

	}

	function getVirtualObjectFromId($id){

		global $visit;

		$obj= new ClsVirtualObject();

		$where ="  id = '".$id."'";

		$strWhere =" WHERE ". $where;

		$sql ="SELECT ".$obj->getCampos()." FROM ". $obj->getNombreTabla() . $strWhere ;

		$this->visit->debuger->out("getVirtualObjectFromId: ". $obj->getNombreTabla() ."-: $sql");

		$collection = $this->execSQL($sql,$obj);

 		$e = $collection[0];

 		return $e;

	}

	function tieneHijosConValor($id,$idov){

		global $visit;

		$result = false;

		///Cojo los extensibles

		$obj= new ClsSectionData();

		$where ="  idpadre = '".$id."'";

		$strWhere =" WHERE ". $where;

		$sql ="SELECT ".$obj->getCampos()." FROM ". $obj->getNombreTabla() . $strWhere ;

		$hijos = $this->execSQL($sql,$obj);

		///Uno por uno vamos comprobando hasta encontrar un hijo no vacío

		$i = 0;

		while ($i<count($hijos)&&!$result) {

			$atribT = $this->obtenerAtributoValorTextFromSeccionOV($hijos[$i]->id,$idov);

			$atribN = $this->obtenerAtributoValorNumFromSeccionOV($hijos[$i]->id,$idov);

			$atribC = $this->obtenerAtributoValorContrFromSeccionOV($hijos[$i]->id,$idov);

			$atribD = $this->obtenerAtributoValorDateFromSeccionOV($hijos[$i]->id,$idov);

			$vacioT = strtolower(strtr($atribT->value,"áéíóúüÁÉÍÓÚÜ","aeiouuaeiou"))=="~sin asignar";

			if($atribT->value==""/*||$vacioT*/){

				$vacioT = true;

			} else {

				$vacioT = false;

			}

			

			$vacioN = strtolower(strtr($atribN->value,"áéíóúüÁÉÍÓÚÜ","aeiouuaeiou"))=="~sin asignar";

			if($atribN->value==""/*||$vacioN*/){

				$vacioN = true;

			} else {

				$vacioN = false;

			}



			$vacioC = strtolower(strtr($atribC->value,"áéíóúüÁÉÍÓÚÜ","aeiouuaeiou"))=="~sin asignar";

			if($atribC->value==""/*||$vacioC*/){

				$vacioC = true;

			} else {

				$vacioC = false;

			}



			$vacioD = strtolower(strtr($atribD->value,"áéíóúüÁÉÍÓÚÜ","aeiouuaeiou"))=="~sin asignar";

			if($atribD->value==""/*||$vacioD*/){

				$vacioD = true;

			} else {

				$vacioD = false;

			}



			if (!$vacioT||!$vacioN||!$vacioC||!$vacioD){

				$result = true;

			} else {

				$result = $visit->dbBuilder->tieneHijosConValor($hijos[$i]->id,$idov);

			}

			$i++;

		}

		return $result;

	}	

	function tieneHijosConValorSimple($idseccion,$idov,$idrecurso){

		global $visit;

		$result = false;

		///Cojo los extensibles

		$obj= new ClsSectionData();

		$where ="  idpadre = '".$idseccion."'";

		$strWhere =" WHERE ". $where;

		$sql ="SELECT ".$obj->getCampos()." FROM ". $obj->getNombreTabla() . $strWhere ;



		$hijos = $this->execSQL($sql,$obj);

		///Uno por uno vamos comprobando hasta encontrar un hijo no vacío

		$i = 0;

		while (($i<count($hijos))&&!$result) {

			$tipo = $hijos[$i]->tipo_valores;

			if("T"==$tipo){

				$v = $this->getTextDataFromSectionResourceOV($idov,$idrecurso,$hijos[$i]->id);

			}else if("N"==$tipo){

				$v = (string) $this->getNumericDataFromSectionResourceOV($idov,$idrecurso,$hijos[$i]->id);

			}else if("C"==$tipo){

				$v = (string) $this->getControlledDataFromSectionResourceOV($idov,$idrecurso,$hijos[$i]->id);

			}else if("F"==$tipo){

				$v = (string) $this->getDateDataFromSectionResourceOV($idov,$idrecurso,$hijos[$i]->id);

			}

			$result=($v!="");

			$i++;

		}

		return $result;



	}	

	function esBug($id){

		global $visit;

		$where ="  idseccion = '".$id."'";

		$strWhere =" WHERE ". $where;

		$obj1 = new ClsControlledData();

		$obj2 = new ClsTextData();

		$obj3 = new ClsNumericData();

		$sql1 ="SELECT ".$obj1->getCampos()." FROM ". $obj1->getNombreTabla() . $strWhere ;

		$collection = $this->execSQL($sql1,$obj1);

 		$e1 = $collection[0];

		$result = false;

		if($e1->value!=""){

			$result = true;

		} else {

			$sql2 ="SELECT ".$obj2->getCampos()." FROM ". $obj2->getNombreTabla() . $strWhere ;

			$collection = $this->execSQL($sql2,$obj2);

			$e2 = $collection[0];

			if($e2->value!=""){

				$result = true;

			} else {

				$sql3 ="SELECT ".$obj3->getCampos()." FROM ". $obj3->getNombreTabla() . $strWhere ;

				$collection = $this->execSQL($sql3,$obj3);

				$e3 = $collection[0];

				if($e3->value!="")

					$result = true;

			}

 		}

		

		return $result;

	}

	function getFromReferedFromIdOV($id){

		global $visit;

		$obj= new ClsResources();

		$where ="  idresource_refered = '".$id."' OR idov_refered = '".$id."'";

		$strWhere =" WHERE ". $where;

		$sql ="SELECT distinct idov FROM ". $obj->getNombreTabla() . $strWhere ;

		$collection = $this->execSQL($sql,$obj);

 		return $collection;	

	}

	function getDescripcionFromIdOV($id){

		global $visit;

		$obj= new ClsControlledData();

		$where ="  idov = '".$id."' AND idseccion='112'";

		$strWhere =" WHERE ". $where;

		$sql ="SELECT ".$obj->getCampos()." FROM ". $obj->getNombreTabla() . $strWhere ;

		$collection = $this->execSQL($sql,$obj);

 		return $collection[0];	

	}

	function getNombreFromIdOV($id){

		global $visit;

		$obj= new ClsTextData();

		$where ="  idov = '".$id."' AND idseccion='111'";

		$strWhere =" WHERE ". $where;

		$sql ="SELECT ".$obj->getCampos()." FROM ". $obj->getNombreTabla() . $strWhere ;

		$collection = $this->execSQL($sql,$obj);

 		return $collection[0];	

	}

	function setActualControlledData($id,$idov){

		global $visit;

		$obj= new ClsControlledData();

		$sql = "UPDATE " . $obj->getNombreTabla() ." SET idov = ".$idov." WHERE id="."'".$id."'"; 

		///echo $sql."<br>";

		$ret = $this->conn->Execute( $sql );

		$sql = "UPDATE " . $obj->getNombreTabla() ." SET idov = NULL WHERE id!="."'".$id."'"; 

		///echo $sql."<br>";

		$ret = $this->conn->Execute( $sql );

	}

	function getSuperiorFromSectionData($orden,$idpadre) {

		global $visit;

		$obj= new ClsSectionData();

		$where = "  orden<".$orden." AND idpadre = '".$idpadre."' ORDER BY orden DESC";

		$strWhere =" WHERE ". $where;

		$sql ="SELECT ".$obj->getCampos()." FROM ". $obj->getNombreTabla() . $strWhere ;

		$collection = $this->execSQL($sql,$obj);

 		return $collection[0];

	}

	function getInferiorFromSectionData($orden,$idpadre) {

		global $visit;

		$obj= new ClsSectionData();

		$where = "  orden>".$orden." AND idpadre = '".$idpadre."' ORDER BY orden";

		$strWhere =" WHERE ". $where;

		$sql ="SELECT ".$obj->getCampos()." FROM ". $obj->getNombreTabla() . $strWhere ;

		$collection = $this->execSQL($sql,$obj);

 		return $collection[0];

	}

	function getUrlClasif($seccion){

		global $visit;

		$objeto = new ClsSectionData();

		$result="";

		$result = "/".APP_NAME."/view/ls_ov_clasificacion.php?id=".$seccion->id;

		$sec = $seccion; 

		if($seccion->tipo_valores=="X"){

			$secciones = $this->getSeccionesFromIdPadre($seccion->id);

			$sec = $secciones[0];

			$result .= "&criterio_".$seccion->id."=&count=";

			while ($sec->tipo_valores=="X"&&$sec!=null){

				$secciones = $this->getSeccionesFromIdPadre($sec->id);

				$sec = $secciones[0];

				$result .= "&criterio_".$sec->id."=&count=";

			}

			if($sec->tipo_valores=="T"){

				$sql ="SELECT COUNT(*) AS cuenta, value AS valor FROM  text_data where idseccion='".$sec->id."' AND value!='' GROUP BY value"; 

			} else if($sec->tipo_valores=="C"){

				$sql ="SELECT COUNT(*) AS cuenta, value AS valor FROM  controlled_data where idseccion='".$sec->id."' AND value!='' GROUP BY value";

			} else if($sec->tipo_valores=="N"){

				$sql ="SELECT COUNT(*) AS cuenta, value AS valor FROM  numeric_data where idseccion='".$sec->id."' AND value!='' GROUP BY value";

			} else if($sec->tipo_valores=="F"){

				$sql ="SELECT COUNT(*) AS cuenta, value AS valor FROM  date_data where idseccion='".$sec->id."' AND value!='' GROUP BY value";

			} 

		} else if($seccion->tipo_valores=="T"){

			$sql ="SELECT COUNT(*) AS cuenta, value AS valor FROM  text_data where idseccion='".$seccion->id."' AND value!='' GROUP BY value"; 

		} else if($seccion->tipo_valores=="C"){

			$sql ="SELECT COUNT(*) AS cuenta, value AS valor FROM  controlled_data where idseccion='".$seccion->id."' AND value!='' GROUP BY value";

		} else if($seccion->tipo_valores=="N"){

			$sql ="SELECT COUNT(*) AS cuenta, value AS valor FROM  numeric_data where idseccion='".$seccion->id."' AND value!='' GROUP BY value";

		} else if($seccion->tipo_valores=="F"){

			$sql ="SELECT COUNT(*) AS cuenta, value AS valor FROM  date_data where idseccion='".$seccion->id."' AND value!='' GROUP BY value";

		}

		$collection = $this->conn->GetAll($sql);

		$result .=  "&criterio_".$sec->id."=".$collection[0]['valor']."&count=".$collection[0]['cuenta'];



		return $result;

	}

	function getValoresVocabulario(){

		global $visit;

		$obj= new ClsSectionData();

		$where = " vocabulario=1";

		$strWhere =" WHERE ". $where;

		$sql ="SELECT ".$obj->getCampos()." FROM ". $obj->getNombreTabla() . $strWhere ;

		$collection = $this->execSQL($sql,$obj);

 		return $collection;

	}

	function getCantidadDecimales($idrec){

		global $visit;

		$obj= new ClsSectionData();

		$strWhere =" WHERE decimales IS NOT NULL AND tipo_valores = 'N' AND id = '".$idrec."'";

		$sql = "SELECT decimales FROM ". $obj->getNombreTabla() . $strWhere ;

		$collection = $this->execSQL($sql,$obj);

 		return $collection[0]->decimales;

	}

	function hayNavegables(){

		$e = new ClsSectionData();

		$sql ="SELECT COUNT(*) AS cuenta  FROM ". $e->getNombreTabla() . " WHERE browseable='S'";		

		$collection = $this->conn->GetAll($sql);

		$res = $collection[0]["cuenta"] ;

		if ($res>0) return true;

		else return false;		

	}

	

	//Funcion que devuelve si una seccionData tiene valores

	function seccionTieneValoresCount($idsec){

		$dictFilasSectionData = $visit->options->sectionData;

		if ($idsec!="") {

			global $visit;

			//$seccion = $visit->dbBuilder->getSectionDataId($idsec);

			$seccion=$dictFilasSectionData[$idsec];

			if($seccion->tipo_valores == "X") $res = 0;

			if($seccion->tipo_valores == "C")$res = $visit->dbBuilder->getHijosFromValorControladoCount($seccion->id);

			if($seccion->tipo_valores == "T")$res = $visit->dbBuilder->getHijosFromValorTextoCount($seccion->id);

			if($seccion->tipo_valores == "N")$res = $visit->dbBuilder->getHijosFromValorNumericoCount($seccion->id);

			if($seccion->tipo_valores == "F")$res= $visit->dbBuilder->getHijosFromFechaCount($seccion->id);

			

			return $res;		

		}

		return false;



	}

	

	function getHijosFromValorControladoCount($idsec){

		$sql = "SELECT COUNT(DISTINCT VALUE ) AS cuenta FROM controlled_data WHERE  idseccion =". $idsec;

		$collection = $this->conn->GetAll($sql);

		$res = $collection[0]["cuenta"] ;

		return $res;

	}



	/*calcula el numero de atributos de una secciondata*/

	function getHijosFromValorTextoCount($idsec){

		$sql = "SELECT COUNT(DISTINCT VALUE ) AS cuenta FROM text_data WHERE  idseccion =". $idsec;

		$collection = $this->conn->GetAll($sql);

		$res = $collection[0]["cuenta"] ;

		return $res;

	}

	

	function getHijosFromValorNumericoCount($idsec){

		$sql = "SELECT COUNT(DISTINCT VALUE ) AS cuenta FROM numeric_data WHERE  idseccion =". $idsec;

		$collection = $this->conn->GetAll($sql);

		$res = $collection[0]["cuenta"] ;

		return $res;

	}

	

	function getHijosFromFechaCount($idsec){

		$sql = "SELECT COUNT(DISTINCT VALUE ) AS cuenta FROM date_data WHERE  idseccion =". $idsec;

		$collection = $this->conn->GetAll($sql);

		$res = $collection[0]["cuenta"] ;

		return $res;

	}



	function getValoresCount($idsec,$valor){

		global $visit;

		$dictFilasSectionData = $visit->options->sectionData;

		//$seccion = $visit->dbBuilder->getSectionDataId($idsec);

		$seccion=$dictFilasSectionData[$idsec];

		if($seccion->tipo_valores == "X") $res = 0;

		if($seccion->tipo_valores == "C")$res = $visit->dbBuilder->getHijosFromValorControladoCountValor($seccion->id,$valor);

		if($seccion->tipo_valores == "T")$res = $visit->dbBuilder->getHijosFromValorTextoCountValor($seccion->id,$valor);

		if($seccion->tipo_valores == "N")$res = $visit->dbBuilder->getHijosFromValorNumericoCountValor($seccion->id,$valor);

		if($seccion->tipo_valores == "F")$res= $visit->dbBuilder->getHijosFromFechaCountValor($seccion->id,$valor);

		return $res;	

		

	}

	//Calcula el numero de elementos de con value= valor

	function getHijosFromValorControladoCountValor($idsec,$valor){

		if($idsec!=""){

			$sql = "SELECT COUNT(1) AS cuenta FROM controlled_data WHERE idseccion =". $idsec ." AND value LIKE  '".$valor."'";

		}else{

			$sql = "SELECT COUNT(1) AS cuenta FROM controlled_data WHERE value LIKE  '".$valor."'";

		}

		$collection = $this->conn->GetAll($sql);

		$res = $collection[0]["cuenta"] ;

		return $res;

	

	}

	function getHijosFromValorTextoCountValor($idsec, $valor){

		if($idsec!=""){

			$sql = "SELECT COUNT(1) AS cuenta FROM text_data WHERE idseccion =". $idsec." AND value LIKE  '".$valor."'";

		}else{

			$sql = "SELECT COUNT(1) AS cuenta FROM text_data WHERE value LIKE  '".$valor."'";

		}

		$collection = $this->conn->GetAll($sql);

		$res = $collection[0]["cuenta"] ;

		return $res;

	}

	

	function getHijosFromValorNumericoCountValor($idsec, $valor){

		if($idsec!=""){

			$sql = "SELECT COUNT(1) AS cuenta FROM numeric_data WHERE  idseccion =". $idsec." AND value LIKE  '".$valor."'";

		}else{

			$sql = "SELECT COUNT(1) AS cuenta FROM numeric_data WHERE  value LIKE  '".$valor."'";

		}

		$collection = $this->conn->GetAll($sql);

		$res = $collection[0]["cuenta"] ;

		return $res;

	}

	function getHijosFromFechaCountValor($idsec,$valor){

		if($idsec!=""){

			$sql = "SELECT COUNT(1) AS cuenta FROM date_data WHERE  idseccion =". $idsec." AND value LIKE  '".$valor."'";

		}else{

			$sql = "SELECT COUNT(1) AS cuenta FROM date_data WHERE value LIKE  '".$valor."'";

		}

		$collection = $this->conn->GetAll($sql);

		$res = $collection[0]["cuenta"] ;

		return $res;

	}



	function getValoresCountNoPrivados($idsec,$valor){

		global $visit;

		$dictFilasSectionData = $visit->options->sectionData;

		

		$seccion=$dictFilasSectionData[$idsec];

		//$seccion = $visit->dbBuilder->getSectionDataId($idsec);

		if($seccion->tipo_valores == "X") $res = 0;

		if($seccion->tipo_valores == "C")$res = $visit->dbBuilder->getHijosFromValorControladoCountValorNoPrivados($seccion->id,$valor);

		if($seccion->tipo_valores == "T")$res = $visit->dbBuilder->getHijosFromValorTextoCountValorNoPrivados($seccion->id,$valor);

		if($seccion->tipo_valores == "N")$res = $visit->dbBuilder->getHijosFromValorNumericoCountValorNoPrivados($seccion->id,$valor);

		if($seccion->tipo_valores == "F")$res= $visit->dbBuilder->getHijosFromFechaCountValorNoPrivados($seccion->id,$valor);

		return $res;	

	}



	//Calcula el numero de elementos de con value= valor

	function getHijosFromValorControladoCountValorNoPrivados($idsec,$valor){

		if($idsec!=""){

			$sql = "SELECT COUNT(1) AS cuenta FROM controlled_data INNER JOIN virtual_object ON (virtual_object.id = controlled_data.idov) WHERE  idseccion =". $idsec ." AND value LIKE  '".$valor."' AND virtual_object.isprivate = 'N'";

		}else{

			$sql = "SELECT COUNT(1) AS cuenta FROM controlled_data INNER JOIN virtual_object ON (virtual_object.id = controlled_data.idov) WHERE value LIKE  '".$valor."' AND virtual_object.isprivate = 'N' ";

		}

		$collection = $this->conn->GetAll($sql);

		$res = $collection[0]["cuenta"] ;

		return $res;;

	

	}

	function getHijosFromValorTextoCountValorNoPrivados($idsec, $valor){

		if($idsec!=""){

			$sql = "SELECT COUNT(1) AS cuenta FROM text_data INNER JOIN virtual_object ON (virtual_object.id = text_data.idov) WHERE  idseccion =". $idsec ." AND value LIKE  '".$valor."' AND virtual_object.isprivate = 'N'";

		}else{

			$sql = "SELECT COUNT(1) AS cuenta FROM text_data WHERE  idseccion =". $idesc." AND value LIKE  '".$valor."' AND virtual_object.isprivate = 'N' ";

		}

		$collection = $this->conn->GetAll($sql);

		$res = $collection[0]["cuenta"] ;

		return $res;

	}

	

	function getHijosFromValorNumericoCountValorNoPrivados($idsec, $valor){

		if($idsec!=""){

			$sql = "SELECT COUNT(1) AS cuenta FROM numeric_data INNER JOIN virtual_object ON (virtual_object.id = numeric_data.idov) WHERE  idseccion =". $idsec ." AND value LIKE  '".$valor."' AND virtual_object.isprivate = 'N'";

		}else{

			$sql = "SELECT COUNT(1) AS cuenta FROM numeric_data WHERE  idseccion =". $idsec." AND value LIKE  '".$valor."' AND virtual_object.isprivate = 'N'";

		}

		$collection = $this->conn->GetAll($sql);

		$res = $collection[0]["cuenta"] ;

		return $res;

	}

	function getHijosFromFechaCountValorNoPrivados($idsec,$valor){

		if($idsec!=""){

			$sql = "SELECT COUNT(1) AS cuenta FROM date_data INNER JOIN virtual_object ON (virtual_object.id = date_data.idov) WHERE  idseccion =". $idsec ." AND value LIKE  '".$valor."' AND virtual_object.isprivate = 'N'";

		}else{

			$sql = "SELECT COUNT(1) AS cuenta FROM date_data WHERE  idseccion =". $idsec." AND value LIKE  '".$valor."' AND virtual_object.isprivate = 'N'";

		}

		$collection = $this->conn->GetAll($sql);

		$res = $collection[0]["cuenta"] ;

		return $res;

	}



	function getRecursos() {

		$objeto = new ClsResources ();

		//$sql ="SELECT * FROM resources WHERE type != 'U'"; alfredo 140803
		$sql ="SELECT * FROM resources";

		

		$collection = $this->execSQL( $sql, $objeto );

		

		return $collection;

	}





	function cargarRecursos($tmp,$path,$id){		

		$handle = opendir($tmp);

		while ($archivo = readdir($handle)){ 

			if ($archivo{0}!='.'){

			//comprobamos si es un directorio o un archivo 

				if ( is_dir($tmp."/".$archivo) ){ 					

					$this->cargarRecursos($tmp."/".$archivo,$path,$id);

				} else { 

					$resource = new ClsResources();

					$resource->idov= $id;

					$resource->visible="S";

					$resource->type="P";

					$resource->name=$archivo;

					$resource->ordinal = 1;

					$resource = $this->persist($resource);

					copy($tmp."/".$archivo,$path."/".$id."/".$archivo);

				} 

			}

		} 

	}



	function cargarRecursosZipHtml($tmp,$path,$id,$directorio,$count){	

		global $visit;	

		$handle = opendir($tmp);

		while ($archivo = readdir($handle)){ 

			if ($archivo{0}!='.'){

				//Comprobamos si es un HTML o un directorio

				if($visit->util->esHTML($archivo) && $count == 0 ){

					$resource = new ClsResources();

					$resource->idov= $id;

					$resource->visible="S";

					$resource->type="H";

					$resource->name=$directorio."/".$archivo;

					$resource->ordinal = 1;

					$resource = $this->persist($resource);					

					copy($tmp."/".$archivo,$path."/".$id."/".$directorio."/".$archivo);

				}

			

				else if ( is_dir($tmp."/".$archivo) ){ 		

					$directorioaux = $directorio."/".$archivo;

					mkdir($path."/".$id."/".$directorioaux);

					$this->cargarRecursosZipHtml($tmp."/".$archivo,$path,$id,$directorioaux,$count+1);

				} else { 					

					/*$resource = new ClsResources();

					$resource->idov= $id;

					$resource->visible="S";

					$resource->type="H";

					$resource->name=$archivo;

					$resource->ordinal = 1;

					$resource = $this->persist($resource);

					*/

					copy($tmp."/".$archivo,$path."/".$id."/".$directorio."/".$archivo);

				} 

			}

		} 

	}

	function getSectionDataTable(){

		$e = new ClsSectionData();

		$col = $this->getTablaFiltrada($e);		

		return $col;



	}







	function cargarRecursosZip($tmp,$path,$id,$directorio){		

		$handle = opendir($tmp);

		while ($archivo = readdir($handle)){ 

			if ($archivo{0}!='.'){

			//comprobamos si es un directorio o un archivo	

			echo "<br>" ;

				if ( is_dir($tmp."/".$archivo) ){ 					

					$this->cargarRecursosZip($tmp."/".$archivo,$path,$id,$directorio);

				} else { 

					$resource = new ClsResources();

					$resource->idov= $id;

					$resource->visible="S";

					$resource->type="P";

					$resource->name=$directorio."/".$archivo;

					$resource->ordinal = 1;

					$resource = $this->persist($resource);

					copy($tmp."/".$archivo,$path."/".$id."/".$directorio."/".$archivo);

				} 

			}

		} 

	}

}

?>

