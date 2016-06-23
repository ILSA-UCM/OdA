<? 
include_once(getcwd()."/include.php");
$dict=$visit->util->getRequest();

//$visit->debuger->enable(true);
//var_dump($dict);
if ($op=="") {
}
else if ($op=="modificar_preferenciasmensajes") {


	$mensajes = new ClsMensajes();
	$mensajes->lang= $lang;
	$filas = $visit->dbBuilder->getTablaFiltrada($mensajes);
	$count_filas = count($filas);
	for ($i=0;$i<count($filas);$i++) {
		if (isset($dict["mensaje_". $filas[$i]->atributo])) {
			$filas[$i]->valor = $dict["mensaje_". $filas[$i]->atributo];
			$visit->dbBuilder->persist( $filas[$i] );
		}
	}

	$volverRecurso = "configuracion_mensajes.php?lang=".$lang;
	$volverListado = ""; 
	include(getcwd()."/inc_mensaje.php");
	exit();
	//$visit->util->redirect($volverListado);
}

else if ($op=="modificar_preferenciascabecera") {


	$mensajes = new ClsMensajes();
	$mensajes->lang= $lang;
	$filas = $visit->dbBuilder->getTablaFiltrada($mensajes);
	$count_filas = count($filas);
	for ($i=0;$i<count($filas);$i++) {
		if (isset($dict["cabecera_". $filas[$i]->atributo])) {
			$filas[$i]->valor = $dict["cabecera_". $filas[$i]->atributo];
			if ($filas[$i]->formato=="imagen"){
				if ($dict["cabecera_". $filas[$i]->atributo]!="") {
					$filas[$i]->valor=$dict["cabecera_". $filas[$i]->atributo];
				} else {
					$filas[$i]->valor=$dict["ubicacion_cabecera_". $filas[$i]->atributo];
				}
			}
			$visit->dbBuilder->persist( $filas[$i] );
		}
	}

	crearTablaEneRecursos(new ClsPreferenciasPresentacion(), "campospreferencias");
	
	$preferencias=new ClsPreferenciasPresentacion();
	$preferencias->atributo="seguridad_web";
	$preferencias=$visit->dbBuilder->getTablaFiltrada($preferencias);
	$preferencias=$preferencias[0];
	if(isset($dict["seguridad_web"]))
	{
		$preferencias->valor="S";		
		
	}else
		$preferencias->valor="N";

	$visit->dbBuilder->persist($preferencias);	
	

	$preferenciasArchivos = new ClsPreferenciasPresentacion();
	$preferenciasArchivos->atributo = "extension_archivos";
	$preferenciasArchivos = $visit->dbBuilder->getTablaFiltrada($preferenciasArchivos);
	if($preferenciasArchivos[0] != "" ){
		$preferenciasArchivos = $preferenciasArchivos[0];
	} 
	else{
		$preferenciasArchivos = new ClsPreferenciasPresentacion();
		$preferenciasArchivos->atributo = "extension_archivos";
	}
	//echo  $dict["extension_archivos_text"];
	
	if(isset($dict["extension_archivos_text"]))
	{
		if ($dict["extension_archivos_text"] != "")
		{
			//if (! ($preferenciasArchivos->hayStringValor($dict["extension_archivos_text"])) )
			if($preferenciasArchivos->valor == "")
			{
				$preferenciasArchivos->valor = $dict["extension_archivos_text"];
			}					
			else 
			{
				$preferenciasArchivos->valor.=";".$dict["extension_archivos_text"];	
			 }	
		}
	}	
	
	$visit->dbBuilder->persist($preferenciasArchivos);	

	//Cantidad de numeros decimales para la tabla numeric_data que visualizará en metadatos
	$preferenciasDecimales = new ClsPreferenciasPresentacion();
	$preferenciasDecimales->atributo = "numeric_decimal";
	$preferenciasDecimales = $visit->dbBuilder->getTablaFiltrada($preferenciasDecimales);
	if($preferenciasDecimales[0] != "" ){
		$preferenciasDecimales = $preferenciasDecimales[0];
	} 
	else{
		$preferenciasDecimales = new ClsPreferenciasPresentacion();
		$preferenciasDecimales->atributo = "numeric_decimal";
	}
	if(isset($dict["num_decimales"])){
		if($dict["num_decimales"] !=""){
			$preferenciasDecimales->valor = $dict["num_decimales"];
		}	
						
	}
	$visit->dbBuilder->persist($preferenciasDecimales);	
	
	$volverListado = "cabecera.php"; 
	/*$volverRecurso = "cabecera.php?lang=".$lang;
	
	include(getcwd()."/inc_mensaje.php");
	exit();
	*/
	$visit->util->redirect($volverListado);
} 
else if($op=="modificar_extension_archivo"){
	if(isset($dict["valor"])){
		$str = 	$dict["valor"];
		//echo $str;
		$preferenciasArchivos = new ClsPreferenciasPresentacion();
		$preferenciasArchivos->atributo = "extension_archivos";
		$preferenciasArchivos = $visit->dbBuilder->getTablaFiltrada($preferenciasArchivos);
		//echo $preferenciasArchivos[0]."<br>";
		if($preferenciasArchivos[0] != "" )
		{
			$preferenciasArchivos = $preferenciasArchivos[0];
			$res ="";
			$arrValor = array();
			//echo $preferenciasArchivos->valor."<br>";
			$arrValor = split( ";",$preferenciasArchivos->valor);
			foreach($arrValor as $key => $value)
			{
				//echo $value."--".$str."<br>";
				if($value != $str)
				{
					if($res == "")
					{
						$res=$value;
					} 
					else
					{
						$res.=";".$value;
					}
				}
			//echo"Res-- ".$res."<br>";
			}	
			$preferenciasArchivos->valor = $res;
			$visit->dbBuilder->persist($preferenciasArchivos);
		}	
	}
	$volverRecurso = "cabecera.php?lang=".$lang;
	$volverListado = ""; 
	include(getcwd()."/inc_mensaje.php");
	exit();
	
	
}
// COMANAGER 1.0: TABLA metodos_envio
else if ($op=="modificar_metodos_envio") {
	crearTablaEneRecursos(new ClsMetodosEnvio(), "camposmetodosenvio");


	


	$volverRecurso = "metodos_envio.php";
	$volverListado = "metodos_envio.php";
	include(dirname(__FILE__)."/inc_mensaje.php");
	exit();
} // COMANAGER 1.0: FIN TABLA metodos_envio

// COMANAGER 1.0: TABLA metodos_pago
else if ($op=="modificar_metodos_pago") {
	crearTablaEneRecursos(new ClsMetodosPago(), "camposmetodospago");

	$visit->util->redirect("metodos_pago.php?lang=".$lang);
} // COMANAGER 1.0: FIN TABLA metodos_envio

else if ($op=="modificar_tarifas") {
	crearTablaEneRecursos(new ClsTarifas(), "campostarifas");
	crearTablaEneRecursos(new ClsPreferenciasPresentacion(), "campospreferencias");
	$visit->util->redirect("tarifas.php");
}


// COMANAGER 1.0: TABLA tarifa_pais
else if ($op=="modificar_tarifa_pais") {
	
		if ($id!="") {
			$obj = $visit->dbBuilder->getTarifaPaisId($id);
		} else {
			$obj = new ClsTarifaPais();
		}
		if (!$visit->options->tieneAcceso("form",$obj)) $visit->options->sinAcceso();
		$objPrevio = $obj;
		$obj->estableceCampos( $dict);
		if ($id=="") $obj->id="";
		
		
		$obj = $visit->dbBuilder->persist($obj);

	$visit->util->redirect("tarifa_pais.php");
	$volverRecurso = "cm_form_tarifa_pais.php?id=".$obj->id;
	$volverListado = $_SESSION["lstarifa_pais"];
	include(dirname(__FILE__)."/inc_mensaje.php");
	exit();
} else if ($op=="eliminar_tarifa_pais") {
	if ($id!="") {
		$obj = new ClsTarifaPais();
		$obj->id = $id;
		if (!$visit->options->tieneAcceso("remove",$obj)) $visit->options->sinAcceso();
		$visit->dbBuilder->remove($obj);
		$volverListado = $_SESSION["lstarifa_pais"];
		include(dirname(__FILE__)."/inc_mensaje.php");
		exit();
	}	
} else if ($op=="modificar_preferencias_secciones") {
	if ($id!="") {
		$obj = $visit->dbBuilder->getPreferenciasPresentacionId($id);		
	} else {
		$obj = new ClsPreferenciasPresentacion();
	}
	if (!$visit->options->tieneAcceso("form",$obj)) $visit->options->sinAcceso();
	$objPrevio = $obj;
	$obj->estableceCampos( $dict);
	if ($id=="") $obj->id="";
	$obj = $visit->dbBuilder->persist($obj);
	$visit->util->redirect("presentacion.php");

} else if ($op=="modificar_preferencias_recursos") {
	if ($id!="") {
		$obj = $visit->dbBuilder->getPreferenciasPresentacionId($id);
	} else {
		$obj = new ClsPreferenciasPresentacion();
	}
	if (!$visit->options->tieneAcceso("form",$obj)) $visit->options->sinAcceso();
	$objPrevio = $obj;
	$obj->estableceCampos( $dict);
	if ($id=="") $obj->id="";	
	$obj = $visit->dbBuilder->persist($obj);
	$visit->util->redirect("presentacion.php");

} else if ($op=="modificar_preferencias_metodos_envio") {
	crearTablaEneRecursos(new ClsPreferenciasPresentacion(), "campospreferencias");

	$mensajes = new ClsMensajes();
	$mensajes->lang= $lang;
	$filas = $visit->dbBuilder->getTablaFiltrada($mensajes);
	$count_filas = count($filas);
	for ($i=0;$i<count($filas);$i++) {
		if (isset($dict["mensaje_". $filas[$i]->atributo])) {
			$filas[$i]->valor = $dict["mensaje_". $filas[$i]->atributo];
			$visit->dbBuilder->persist( $filas[$i] );
		}
	}

	$visit->util->redirect("metodos_envio.php?lang=".$lang);
} 
else if ($op=="modificar_preferencias_notificacion_mail") {
	crearTablaEneRecursos(new ClsPreferenciasPresentacion(), "campospreferencias");

	

	$visit->util->redirect("notificaciones_mail.php?lang=".$lang);
} 


/* Nuevo Elemento */
function crearTablaEneRecursos($objCopia, $npatron) {
	global $dict,$visit,$_FILES;
	$arr = array();
	$menosId="";
	$patron=$npatron."_";
	//$visit->debuger->enable(true);
	//var_dump($dict);
	reset($dict);
	while (list($k,$v)=each($dict)) {
		
		if (substr($k,0,strlen($patron))==$patron) {
			
			if (strpos($k,"_")==strrpos($k,"_")) {
				
				$i = substr($k,strlen($patron) );
				$prefijo = $patron.$i."_";
				$obj = $objCopia->newInstance();
				$dict[$prefijo.$idcamporelacionado]=$objPadre->id;				
				$obj->estableceCampos($dict, $prefijo);
				$obj->request2bbdd($dict, $prefijo);
				
				

				if ( $obj->nombre!="" || $obj->atributo!="") {
					
					if ($obj->getNombreTabla()=="metodos_pago") $visit->dbBuilder->persistFromIdlangprincipalCampo($obj,"activo");
					$obj = $visit->dbBuilder->persist( $obj );
					$menosId = $menosId . "," . $obj->id;
				}
			}
		}
	}
	if ($menosId!="") $menosId = substr($menosId,1);
	if ($obj->getNombreTabla()=="preferencias_presentacion") {
		$visit->dbBuilder->borrarTablaPreferenciasEneMenos( $objCopia, $menosId,$obj->tipo);
	}else if ($obj->getNombreTabla()=="metodos_pago") {
		$visit->dbBuilder->borrarTablaMetodosPagoEneMenos( $objCopia, $menosId,$obj->lang);
	}else{
		
		$visit->dbBuilder->borrarTablaEneMenos( $objCopia, $menosId);
	}
	//exit();
	return;
}