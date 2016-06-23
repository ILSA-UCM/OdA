<?
class ClsUtil {
	var $debuger, $dbBuilder;

	function redirect($url) {
		global $visit;
		if ($visit->debuger->enabled) {
			print "<a href='$url'>Continuar en $url</a>";
		} else {
			header("Location: $url");
		}
	}

	function perteneceCadena($valor, $lista) {
		$res=true;
		if($lista!=""&&$valor!="")
		$pos = strpos ($lista,$valor);
		if ($pos === false) $res = false;
		return $res;
	}

	function datetime2bbdd( $valor) {
		if ($valor=="") return "";
		$partes = explode(" ", $valor);
			$path = explode("/", $partes[0]);
			if (count($path)==1) $path = explode("-", $valor);
			if (count($path)>=1) $dia=$path[0];
			if (count($path)>=2) $mes=$path[1];
			if (count($path)>=3) $anio=$path[2];
			//Fuerza un a�o empezando por digito>0
			if (strlen($anio) < 4 ) {
				$res = sprintf ("2%03d%02d%02d", $anio, $mes, $dia);
			} else {
				$res = sprintf ("%04d%02d%02d", $anio, $mes, $dia);
			}
			$path = explode(":", $partes[1]);
			if (count($path)>=1) $hora=$path[0];
			if (count($path)>=2) $minuto=$path[1];
			if (count($path)>=3) $segundo=$path[2];
			//Fuerza un a�o empezando por digito>0
			$res .= sprintf ("%02d%02d%02d", $hora, $minuto, $segundo);
		return $res;
	}

	function date2bbdd( $valor) {
		if ($valor=="") return "";
		$path = explode("/", $valor);
		if (count($path)==1) $path = explode("-", $valor);
		if (count($path)>=1) $dia=$path[0];
		if (count($path)>=2) $mes=$path[1];
		if (count($path)>=3) $anio=$path[2];
		//Fuerza un a�o empezando por digito>0
		if (strlen($anio) < 4 ) {
			$res = sprintf ("2%03d%02d%02d", $anio, $mes, $dia);
		} else {
			$res = sprintf ("%04d%02d%02d", $anio, $mes, $dia);
		}
		
		return $res;
	}

	function getNullString($valor) {
		if ($valor=="") $res="NULL";
		else $res="'".$valor."'";
		return $res;
	}

	function getVacioString($valor) {
		if ($valor=="") $res="''";
		else $res="'".$valor."'";
		return $res;
	}

	function getNullInteger($valor) {
		if ($valor=="") $res="NULL";
		else $res=$valor;
		return $res;
	}

	function getInteger($valor) {
		if ($valor=="") $res="0";
		else $res=$valor;
		return $res;
	}

	function bbdd2date( $valor) {
		if (strlen($valor)>=8) 
			return substr($valor,6,2)."/".substr($valor,4,2)."/".substr($valor,0,4);
		else return $valor;
	}

	function bbdd2datetime( $valor) {
		if (strlen($valor)>=14) 
			return substr($valor,6,2)."/".substr($valor,4,2)."/".substr($valor,0,4)." ".substr($valor,8,2).":".substr($valor,10,2).":".substr($valor,12,2) ;
		else return "";
	}

	function getBool($val) {
		if ($val) return 1;
		else return 0;
	}
	function monedaFormat($val) {		
		return number_format($val, 2, ",", ".");
	}

	function unix2fecha($time) {
		return date("d/m/Y",$time);
	}
	function unix2fechatime($time) {
		return date("d/m/Y H:i:s",$time);
	}
	function bbdd2unix($str) {
		return $this->fecha2unix( $this->bbdd2date($str) );
	}
	function esFechaBbdd($str) {
		$result = false;
		if($str>19000000 && $str<=21000101) $result = true;
		return $result;
	}
	/*
	* Dada una fecha en formato 13/02/2002 o 13-02-2002 nos devuelve el timestamp unix correspondiente o
	*/
	function fecha2unix($strFecha) {
		$strFecha = str_replace("/"," ",$strFecha);
		$strFecha = str_replace("-"," ",$strFecha);

		$path = explode (" ", $strFecha);
		if 	(count($path)==3) {
			$res = mktime(0,0,0, intval($path[1]), intval($path[0]), intval($path[2]) );
/*			var_dump($path);
			var_dump($res);*/
		} elseif (count($path)==2) {
			$res = mktime(0,0,0, intval($path[1]), intval($path[0]), date("Y",time()) );
		} else {
			$res = mktime(0,0,0, 0,0,0);
		}

		return  $res;
	}

	//Dada una cadena la devuelve o &nbsp;
	function strTable( $str) {
		if ($str=="") return "&nbsp;";
		else return $str;
	}

	function closeWindow() {
		?>
			<html>
				<body onload="window.close()">
			</html>
		<?
	}

	function bbdd2frase($bbddtime) {
		$dia = intval(substr($bbddtime,6,2));
		$mes = intval(substr($bbddtime,4,2));
		$anio = intval(substr($bbddtime,0,4));
		$fecha = mktime (0,0,0,$mes,$dia,$anio);
		return $this->getFechaActual($fecha);
	}

	function date2str($timestamp) {
		$cadenaFecha = strftime("%Y%m%d",$timestamp);
		return $cadenaFecha;
	}

	function datetime2str($timestamp) {
		$cadenaFecha = strftime("%Y%m%d%H%M%S",$timestamp);
		return $cadenaFecha;
	}

	function unixdatetime2bbdd($timestamp) {
		$cadenaFecha = strftime("%Y%m%d%H%M%S",$timestamp);
		return $cadenaFecha;
	}

	function getHoraActual($timestamp) {
		$cadenaFecha = intVal(strftime("%H",$timestamp)) . ":". ucwords( strftime("%M",$timestamp) );
		return htmlentities($cadenaFecha);
	}

	function getHoraTotalActual($timestamp) {
		$cadenaFecha = intVal(strftime("%H",$timestamp)) . ":". ucwords( strftime("%M",$timestamp) ) . ":". ucwords( strftime("%S",$timestamp) );
		return htmlentities($cadenaFecha);
	}

	function unix2bbdd($timestamp) {
		$cadenaFecha = strftime("%Y",$timestamp) . strftime("%m",$timestamp) . strftime("%d",$timestamp);
		return htmlentities($cadenaFecha);
	}

	//Fecha actual
	function getFechaActual($timestamp) {
		$cadenaFecha = intVal(strftime("%d",$timestamp)) . " de ". ucwords( strftime("%B",$timestamp) ). " de " . strftime("%Y",$timestamp);
		if (true) {
			$cadenaFecha = str_replace ("Monday", "Lunes", $cadenaFecha);
			$cadenaFecha = str_replace ("Tuesday", "Martes", $cadenaFecha);
			$cadenaFecha = str_replace ("Wednesday", "Mi�rcoles", $cadenaFecha);
			$cadenaFecha = str_replace ("Thursday", "Jueves", $cadenaFecha);
			$cadenaFecha = str_replace ("Friday", "Viernes", $cadenaFecha);
			$cadenaFecha = str_replace ("Saturday", "S�bado", $cadenaFecha);
			$cadenaFecha = str_replace ("Sunday", "Domingo", $cadenaFecha);
			$cadenaFecha = str_replace ("January", "Enero", $cadenaFecha);
			$cadenaFecha = str_replace ("February", "Febrero", $cadenaFecha);
			$cadenaFecha = str_replace ("March", "Marzo", $cadenaFecha);
			$cadenaFecha = str_replace ("April", "Abril", $cadenaFecha);
			$cadenaFecha = str_replace ("May ", "Mayo ", $cadenaFecha);
			$cadenaFecha = str_replace ("June", "Junio", $cadenaFecha);
			$cadenaFecha = str_replace ("July", "Julio", $cadenaFecha);
			$cadenaFecha = str_replace ("August", "Agosto", $cadenaFecha);
			$cadenaFecha = str_replace ("September", "Septiembre", $cadenaFecha);
			$cadenaFecha = str_replace ("October", "Octubre", $cadenaFecha);
			$cadenaFecha = str_replace ("November", "Noviembre", $cadenaFecha);
			$cadenaFecha = str_replace ("December", "Diciembre", $cadenaFecha);
		} 
		return htmlentities($cadenaFecha);
	}

	function relinea( $txt) {
		return preg_replace("/(\015\012)|(\012\015)|(\015)|(\012)/","\012", $txt); 
	}

	function leer( $archivo ) {
		$contenido = implode('',file( $archivo ));
		return $contenido;
	}

	function escribir( $archivo, $file_text ) {
		$fp = fopen($archivo, "w"); 
		fwrite($fp, $file_text); 
		fclose($fp); 
	}

	//Coge el primer $inicio y el primer $fin de $texto y lo elimina devolviendo el resultado
	function extraerIntervalo($texto, $inicio, $fin) {
		$res="";
		$vPartes = explode( $inicio, $texto);
		$res = $vPartes[0];
		$vPartes = explode( $fin, $texto);
		for ($i=1;$i<count($vPartes);$i++) {
			$res .= $vPartes[$i];
		}
		return $res;
	}

	//Coge el primer $inicio y el primer $fin y devuelve lo que haya entre medias
	function obtenerIntervalo($texto, $inicio, $fin) {
		$res="";
		$vPartes = explode( $inicio, $texto);
		for ($i=1;$i<count($vPartes);$i++) {
			$res .= $vPartes[$i];
		}
		$vPartes = explode( $fin, $res);
		if (count($vPartes)>0) {
			$res = $vPartes[0];
		}
		return $res;
	}
	function getIconoExtension($nombre) {
		
		$extension = strtolower($this->getExtension($nombre));
		if ($extension=="gif") $res="ico_gif.gif";
		else if ($extension=="jpg") $res="ico_jpg.gif";
		else if ($extension=="jpeg") $res="ico_jpg.gif";
		else if ($extension=="xls") $res="ico_xls.gif";
		else if ($extension=="pdf") $res="ico_pdf.gif";
		else if ($extension=="ppt") $res="ico_ppt.gif";
		else if ($extension=="doc") $res="ico_doc.gif";

		else {
			$res="ico_noext.gif";
		}
		return $res;
	}
	function esImagen($nombre){
		$result = false;
		$extension = strtolower($this->getExtension($nombre));
		if ($extension=="jpg") $result = true;
		else if ($extension=="gif") $result = true;
		else if ($extension=="png") $result = true;		
		return $result;
	}
	function esHTML($nombre){
		$result = false;
		$extension = strtolower($this->getExtension($nombre));
		if (($extension=="html")  || ($extension=="htm") )$result = true;		
		return $result;
	}
	/*devuelve la URL base para este archivo PHP concreto.*/
	function getUrlBase() {
		global $_SERVER, $_SERVER;
		$dict = $_SERVER;
		if ($dict=="") $dict = $_SERVER;
		$res = "http://".$dict["HTTP_HOST"].dirname($dict["REQUEST_URI"]);
	
		return $res;
	}


	//Funci�n que dado un texto, reemplaza la ocurrencia de 'cadenaOrigen por cadenaDestino. (La primera vez)
	function sustituir($texto, $cadenaOrigen, $cadenaDestino) {

	}

	function descargaArchivo($http_post_file, $dirBase ) {
		$destino = $dirBase ."/". $http_post_file['name'];
		$res = move_uploaded_file( $http_post_file['tmp_name'], $destino);
	}
	function copiarArchivo($fuente, $destino){
		if(file_exists($fuente)) $res = copy($fuente, $destino);	
	}
		
	function existeArchivoBR($id,$nombreArchivo){
		$res = false;
		$fuente = "../download/".$id."/".$nombreArchivo;
		//var_dump($fuente);
		if(file_exists($fuente)) $res = true; 
		//var_dump($res);
		return $res;
	}

/******************************
 *
 * FUNCIONES DE REPAGINACION
 *
 ******************************/
 function muestrahastareg ($paginacion,$count,$npag){
	if ($count==0) {
		$res=0;
	} else {
		$totalpags=ceil($count/$paginacion);
		if ($npag==1){
				if (($count<= $paginacion)){
					$hasta=$count;
				}else{
					$hasta=$paginacion;
				}
		}elseif($totalpags==$npag){			
			$ult_pag=$count%$paginacion;
			$hasta=$count;
			//$desde=$hasta-$ult_pag + 1;
		}elseif ($paginacion>=$count){
			//$desde=1;
			$hasta=$count;
		}else{	
			$hasta=$paginacion * $npag;
			//$desde=$hasta-$paginacion +1;
		}							
		$res=$hasta;		
	}
	return $res;
}

function getValorInicialPaginacion($paginacion, $maxPaginasSiguientes, $count , $nPagActual) {
	$numPaginas=  floor  ( ($count - 1) / $paginacion ) + 1;
	if ($numPaginas<=$maxPaginasSiguientes*2) { 
		$valorInicial = 1;
		$valorFinal = $numPaginas;
	} else {
		$valorInicial= $nPagActual - $maxPaginasSiguientes;
		$valorFinal=$nPagActual + $maxPaginasSiguientes;
		if ($valorInicial < 1) {
			$valorInicial = 1;
			$valorFinal = $valorInicial + $maxPaginasSiguientes*2 - 1;
		}
		if ($valorFinal > $numPaginas) {
			$valorFinal = $numPaginas;
			$valorInicial = $valorFinal - $maxPaginasSiguientes*2 + 1;
		}
	}
	return $valorInicial;
}

function getValorFinalPaginacion($paginacion, $maxPaginasSiguientes, $count , $nPagActual) {
	$numPaginas=  floor  ( ($count - 1) / $paginacion ) + 1;
	if ($numPaginas<=$maxPaginasSiguientes*2) { 
		$valorInicial = 1;
		$valorFinal = $numPaginas;
	} else {
		$valorInicial= $nPagActual - $maxPaginasSiguientes;
		$valorFinal=$nPagActual + $maxPaginasSiguientes;
		if ($valorInicial < 1) {
			$valorInicial = 1;
			$valorFinal = $valorInicial + $maxPaginasSiguientes*2 - 1;
		}
		if ($valorFinal > $numPaginas) {
			$valorFinal = $numPaginas;
			$valorInicial = $valorFinal - $maxPaginasSiguientes*2 + 1;
		}
	}
	return $valorFinal;
}

function getValorUltimaPagina($paginacion, $maxPaginasSiguientes, $count , $nPagActual) {
	$numPaginas=  floor  ( ($count - 1) / $paginacion ) + 1;
	return $numPaginas;
}

function gerArrayPaginacion($paginacion, $maxPaginasSiguientes, $count, $nPagActual, $urlName ) {
	//$paginacion = 
	//Valor numerico del mensaje a partir del cual empieza la pagina $npag
	

	//$productos = $visit->dbBuilder->getProductosSeccionLimit($cat, $npag, $paginacion );  

	//Calculamos el numero de paginas actual
	$valorInicial = $this->getValorInicialPaginacion($paginacion, $maxPaginasSiguientes, $count , $nPagActual);
	$valorFinal = $this->getValorFinalPaginacion($paginacion, $maxPaginasSiguientes, $count , $nPagActual);
	$numPaginas=  floor  ( ($count - 1) / $paginacion ) + 1;
	
	$paginas = array();
	for ($i=$valorInicial; $i<=$valorFinal; $i++) {
		if ($i==$nPagActual) {
			$paginas[$i] = "";
		} else {
			$paginas[$i] = $this->concatenaUrl($urlName,"npag=" . $i);
		}
	}
	return $paginas;
}

function imprimirPaginacionSimple($paginacion, $maxPaginasSiguientes, $count, $nPagActual, $urlName ) {
	$paginas = $this->gerArrayPaginacion($paginacion, $maxPaginasSiguientes, $count, $nPagActual, $urlName );
	$valorFinal = $this->getValorFinalPaginacion($paginacion, $maxPaginasSiguientes, $count ,$nPagActual);

	if ($nPagActual>1) {
		print "[<a href='". $this->concatenaUrl($urlOrden,"npag=" . ($nPagActual-1)) . "'>&lt;&lt; Prev. </a>]";
	}

	$inicio = true;
	while (list ($key, $val) = each ($paginas)) {
		$npagina = $key;
		if ($inicio) {
			if ($npagina>1) {
				print " ...";
			} else {
				print " - ";
			}
			$inicio = false;
		}
		$url = $paginas[$key];
		if ($url==NULL) {
			print  "[<font color='#cc0000'><b>" . $npagina . "</b></font>]";
		} else {
			print  "[<a href='" . $url . "'>" . $npagina . "</a>]";
		}
	}
	if ($numPaginas>$valorFinal) {
		print "... ";
	} else {
		print " - ";
	}

	//Si no estamos en la ultima
	if ($nPagActual<$valorFinal) {
		print "[<a class='enlace_simple' href='". $this->concatenaUrl($urlOrden,"npag=" . ($nPagActual+1)) . "'> Next &gt;&gt;</a>]";
	}
}

function imprimirPaginacion($paginacion, $maxPaginasSiguientes, $count, $nPagActual, $urlName ) {
	if ($count==0) {
	} else {
		$ultimaPagina = $this->getValorUltimaPagina($paginacion, $maxPaginasSiguientes, $count , $nPagActual);
		$paginas = $this->gerArrayPaginacion($paginacion, $maxPaginasSiguientes, $count, $nPagActual, $urlName );
		$valorFinal = $this->getValorFinalPaginacion($paginacion, $maxPaginasSiguientes, $count ,$nPagActual);
		$valorInicial = $this->getValorInicialPaginacion($paginacion, $maxPaginasSiguientes, $count ,$nPagActual);
		print "<TABLE cellpadding='0' cellspacing='0'><TR><TD nowrap>";
		if ($nPagActual>1) {
			print " <a href='". $this->concatenaUrl($urlName,"npag=" . ($valorInicial)) . "'><IMG SRC='../img/bo_pag_inicial_activo.gif' BORDER='0' ALT=''><a>";
			print "<a href='". $this->concatenaUrl($urlName,"npag=" . ($nPagActual-1)) . "'><IMG SRC='../img/bo_pag_anterior_activo.gif' BORDER='0' ALT=''></a>";
		}
		$inicio = true;
		if($nPagActual==1) {
			print " <IMG SRC='../img/bo_pag_inicial_inactivo.gif' BORDER='0' ALT=''>";
			print " <IMG SRC='../img/bo_pag_anterior_inactivo.gif'  BORDER='0' ALT=''>";
			
		}
		print "</TD><TD nowrap>";
		while (list ($key, $val) = each ($paginas)) {
			$npagina = $key;
			if ($inicio) {
				if ($npagina>1) {
					print " ...";
				} else {
					print " - ";
				}
				$inicio = false;
			}
			$url = $paginas[$key];
			if ($url==NULL) {
				print  "<span class='paginacion'><b>&nbsp;<U>" . $npagina . "</U>&nbsp;</b></span>";
			} else {
				print  "&nbsp;<a href='" . $url . "' class='paginacion'>" . $npagina . "</a>&nbsp;";
			}
		}
		if ($numPaginas>$valorFinal) {
			print "... ";
		} else {
			print " - ";
		}
		print "</TD><TD nowrap>";
		//Si no estamos en la ultima
		if ($nPagActual<$valorFinal) {
			print "<a class='paginacion' href='". $this->concatenaUrl($urlName,"npag=" . ($nPagActual+1)) . "'><IMG SRC='../img/bo_pag_siguiente_activo.gif' BORDER='0' ALT=''></a>";
			print " <a href='". $this->concatenaUrl($urlName,"npag=" . ($ultimaPagina)) . "'><IMG SRC='../img/bo_pag_final_activo.gif' BORDER='0' ALT=''><a>";
		}
		if ($nPagActual==$valorFinal ) {
			print " <IMG SRC='../img/bo_pag_siguiente_inactivo.gif' BORDER='0' ALT=''>";
			print " <IMG SRC='../img/bo_pag_final_inactivo.gif'  BORDER='0' ALT=''>";
		}
		print "</TD></TR></TABLE>";
	}
}

function imprimirPaginacionBusqueda($paginacion, $maxPaginasSiguientes, $count, $nPagActual, $urlName ) {
	if ($count==0) {
	} else {
		$ultimaPagina = $this->getValorUltimaPagina($paginacion, $maxPaginasSiguientes, $count , $nPagActual);
		$paginas = $this->gerArrayPaginacion($paginacion, $maxPaginasSiguientes, $count, $nPagActual, $urlName );
		$valorFinal = $this->getValorFinalPaginacion($paginacion, $maxPaginasSiguientes, $count ,$nPagActual);
		$valorInicial = $this->getValorInicialPaginacion($paginacion, $maxPaginasSiguientes, $count ,$nPagActual);
		print "<div class='paginacion_paginas'>";
		while (list ($key, $val) = each ($paginas)) {
			$npagina = $key;
			if ($inicio) {
				if ($npagina>1) {
					print " ...";
				} else {
					print " - ";
				}
				$inicio = false;
			}
			$url = $paginas[$key];
			if($npagina==$valorFinal){
				if ($url==NULL) {
					print  "<span class='paginacion_busqueda_pag'><b>&nbsp;" . $npagina . "&nbsp;</b></span> ";
				} else {
					print  "&nbsp;<a href='" . $url . "' class='paginacion_busqueda_apg'>" . $npagina . "</a>&nbsp;";
				}	
			}
			else{
				if ($url==NULL) {
					print  "<span class='paginacion_busqueda_pag'><b>&nbsp;" . $npagina . "&nbsp;</b></span> /";
				} else {
					print  "&nbsp;<a href='" . $url . "' class='paginacion_busqueda_apg'>" . $npagina . "</a>&nbsp;/";
				}
			}
		}
		print "</div>";
		print "<div class='paginacion_paginas_img'>";
			if ($nPagActual>1) {
				print " <a href='". $this->concatenaUrl($urlName,"npag=" . ($valorInicial)) . "'><IMG SRC='./img/ico_doble_flecha_izqda.png' BORDER='0' ALT=''>  <a>";
				print "&nbsp";
				print "<a href='". $this->concatenaUrl($urlName,"npag=" . ($nPagActual-1)) . "'><IMG SRC='./img/ico_flecha_izqda.png' BORDER='0' ALT=''>  &nbsp; Anterior</a>";
			}
			$inicio = true;
			if($nPagActual==1) {
				print " <IMG SRC='./img/ico_doble_flecha_izqda_gris.png' BORDER='0' ALT=''>";
				print "&nbsp";
				print " <IMG SRC='./img/ico_flecha_izqda_gris.png'  BORDER='0' ALT=''> &nbsp; Anterior";
				
			}
	
			if ($numPaginas>$valorFinal) {
				print "... ";
			} else {
				print " /";
			}

			//Si no estamos en la ultima
			if ($nPagActual<$valorFinal) {
				print "<a  href='". $this->concatenaUrl($urlName,"npag=" . ($nPagActual+1)) . "'> Siguiente &nbsp; <IMG SRC='./img/ico_flecha_dcha.png' BORDER='0' ALT=''></a>";
				print "&nbsp";
				print " <a href='". $this->concatenaUrl($urlName,"npag=" . ($ultimaPagina)) . "'><IMG SRC='./img/ico_doble_flecha_dcha.png' BORDER='0' ALT=''><a>";
			}
			if ($nPagActual==$valorFinal ) {
				print "  Siguiente  &nbsp;<IMG SRC='./img/ico_flecha_dcha_gris.png' BORDER='0' ALT=''>";
				print "&nbsp";
				print " <IMG SRC='./img/ico_doble_flecha_dcha_gris.png'  BORDER='0' ALT=''>";
			}
		print "</div>";
	}
}

function imprimirPaginacionArticulos($paginacion, $maxPaginasSiguientes, $count, $nPagActual, $urlName ) {
	if ($count==0) {
	} else {
		$ultimaPagina = $this->getValorUltimaPagina($paginacion, $maxPaginasSiguientes, $count , $nPagActual);
		$paginas = $this->gerArrayPaginacion($paginacion, $maxPaginasSiguientes, $count, $nPagActual, $urlName );
		$valorFinal = $this->getValorFinalPaginacion($paginacion, $maxPaginasSiguientes, $count ,$nPagActual);
		$valorInicial = $this->getValorInicialPaginacion($paginacion, $maxPaginasSiguientes, $count ,$nPagActual);
			
		print "<TD width='34%' class='paginacion' align='center'>";
		$inicio=true;
		while (list ($key, $val) = each ($paginas)) {
			$npagina = $key;
			if (!$inicio) {
				print "�";
			}
			if ($inicio) {
				$inicio = false;
			}
			$url = $paginas[$key];
			if ($url==NULL) {
				print  "<span class='paginaactiva'><b>&nbsp;<U>" . $npagina . "</U>&nbsp;</b></span> ";
			} else {
				print  "&nbsp;<a href='" . $url . "' class='enlacepag'>" . $npagina . "</a>&nbsp;";
			}
		}
		print "</TD><TD nowrap width='33%'  class='paginacion' align='right'>";

		if ($nPagActual>1) {
			
			print "<a href='". $this->concatenaUrl($urlName,"npag=" . ($nPagActual-1)) . "' class='enlacepag'>Anterior</a>";
		}
		$inicio = true;
		if($nPagActual==1) {
			
			print " Anterior";
			
		}
		print "&nbsp;|&nbsp;";
		//Si no estamos en la ultima
		if ($nPagActual<$valorFinal) {
			print "<a href='". $this->concatenaUrl($urlName,"npag=" . ($nPagActual+1)) . "' class='enlacepag'>Siguiente</a>";
			
		}
		if ($nPagActual==$valorFinal ) {
			print " Siguiente";
		
		}
		print "</TD>";
	}
}

//Si existe el elemento en el array devuelve true
function inArray($arr, $nombre) {
	reset($arr);
	$res=false;
	while ( (list ($key, $val) = each ($arr)) && !$res) {
		if ($val==$nombre) $res=true;
	}
	return $res;
}

function isInStr($lista, $valor) {
	$res=true;
	$pos = strpos (";".$lista.";", ";".$valor.";");
	if ($pos === false) $res = false;
	return $res;
}

function perteneceLista($valor, $lista) {
	$res=true;
	$pos = strpos (",".$lista.",", ",".$valor.",");
	if ($pos === false) $res = false;
	return $res;
}


function getDict($filas) {
	$dictFilas = array();
	for ($i=0;$i<count($filas);$i++) {
		$dictFilas[$filas[$i]->id]=$filas[$i];
	}
	return $dictFilas;
}

function getIds($filas) {
	$strIds = "";
	for ($i=0;$i<count($filas);$i++) {
		$strIds.=",".$filas[$i]->id;
	}
	if ($strIds!="") $strIds = substr($strIds,1);
	return $strIds;
}

//Comprueba que no tiene ..s ni /
function aseguraArchivo( $archivo) {
	$res=$archivo;
	$contenido="";
	while ($res!=$contenido) {
		$contenido=$res;
		$res = preg_replace("/\.\./","", $contenido);
	}
	return $res;
}

//Dado un array de objetos categorias, un nodo inicial y un nodo final del arbol, obtiene el camino total, separados por ; EJ: ;1;2;3;
function obtenerCaminoCategoriaStr(&$dictFilas, $idactual, $idfinal) {
	global $visit;
	//$visit->debuger->out ("obtenerCaminoCategoriaStr: (".$idactual.",".$idfinal.")");
	$res="";
	//if ($idfinal=="5") exit();
	if ($idfinal==$idactual) return ";";
	else {		
		if ($dictFilas[$idfinal]->idpadre==$idfinal)  {			
			//Protejo si un padre es si mismo.
			$res = $idfinal. ";";
		} else {
			$llamada = $this->obtenerCaminoCategoriaStr($dictFilas, $idactual, $dictFilas[$idfinal]->idpadre);
			if ($llamada=="-1") $res = "-1";
			else $res = $llamada . $idfinal. ";";
		}
	}
	return $res;
	//$visit->debuger->out ("/obtenerCaminoCategoriaStr: (".$idactual.",".$idfinal.")");
}

//Dado un array de objetos categorias, un nodo inicial y un nodo final del arbol, obtiene el camino total en array
function obtenerCaminoCategoria(&$dictFilas, $idactual, $idfinal) {
	$str = $this->obtenerCaminoCategoriaStr($dictFilas, $idactual, $idfinal);
	$str = substr( $str, 1, strlen($str)-2);
	return explode(";",$str);
}

//Dado un array de objetos categorias, un nodo inicial y un nodo final del arbol, obtiene el camino total en array
function obtenerCaminoClasificacion(&$dictFilas, $idinicial,$idfinal){
	global $visit;
	$res = "";
	foreach($dictFilas as $key=> $value){
		if($value->id == $idfinal){
			 if($value->id  != $idinicial){
			 	$res=$visit->util->obtenerCaminoClasificacion($dictFilas,$idinicial,$value->idpadre );
			 }
 			if($res !="") $res.=",";
	 		$res = $res.$value->id;
		}	
	}
	return $res;
}

//Constuye la URL para la clasificacion
function construyeURLClasificacion($array_criterios,$idpadre,$idseccion){
	//$res = "/view/ls_ov_clasificacion.php?idpadre=".$idpadre."&id=".$idseccion;
	$res = "/".APP_NAME."/view/ls_ov_clasificacion.php?idpadre=".$idpadre."&id=".$idseccion;
	if($array_criterios !=""){
		foreach($array_criterios as $key=>$value){
			if($key != "" && $value !=""){
				$res.="&criterio_".$key."=".$value;		
			}
		}
	}
	return $res;
}

	function libre($size) {
		$res="";
		for ($i=0;$i<$size;$i++) $res.=" ";
		return $res;
	}

	function right($cadena, $size) {
		return substr($cadena, strlen($cadena)-$size);
	}

	function numDigitos($numero, $size) {
		$res=$numero;
		for ($i=0;$i<$size;$i++) $res="0".$res;
		return $this->right($res,$size);
	}

	function repetirCadena($patron, $size) {
		$res="";
		for ($i=0;$i<$size;$i++) $res.=$patron;
		return $res;
	}

	function dosCeros($numero) {		
		return $this->numDigitos($numero,2);
	}


function isWindowsServer() {
	$patron="Windows";
	if (substr(php_uname(), 0, strlen($patron))==$patron) $res=true;
	else $res=false;
	return $res;
}

function construyeUrlMenos($nombre, $dict, $menos) {
	$dict[$menos]="";
	return $this->construyeUrl($nombre, $dict);
}


function construyeUrlMenosLista($nombre, $dict, $menos) {
	$v = explode(",",$menos);
	for ($i=0;$i<count($v);$i++) {
		$dict[$v[$i]]="";
	}
	return $this->construyeUrl($nombre, $dict);
}



function construyeUrl( $nombre, $dict) {

	global $SCRIPT_NAME;
	if ($nombre=="") $nombre = basename ($SCRIPT_NAME );
	$res = array();
	while (list ($clave, $valor) = each ($dict)) {
		if ($valor!="")	$res[$clave]= $clave."=".$valor;
	}
	$query = implode("&",$res);
	if ($query!="") $query="?".$query;
	else {
		$query.="?1=1";
	}
	return $nombre.$query;
}

function getScriptName() {
	global $SCRIPT_NAME;
	$nombre = basename ($SCRIPT_NAME );
	return $nombre;
}

function concatenaUrl($url, $resto) {
	$pos = strpos($url,"?");
	/////Añadido Joaquin Gayoso 13/06/2016
	$url= strip_tags($url);
	//Fin Añadido Joaquin Gayoso XSS 
	
	if ($pos===false) {
		$res = $url."?".$resto;
	} else {
		if ($pos==strlen($url)-1) {
			$res = $url.$resto;
		} else {
			$res = $url."&".$resto;
		}
	}
	//print $url."-".$resto."-".$res;
	return $res;
}

function construyeDictUrl( $queryString ) {
	$pos = strpos($queryString,"?");
	$query = substr($queryString, $pos+1);
	$v = explode("&", $query);
	$arr = array();
	for ($i=0;$i<count($v);$i++) {
		$pos = strpos($v[$i],"=");
		if ($pos===FALSE) {
			$atributo = $v[$i];
			$valor="";
		} else {
			$atributo = substr($v[$i], 0, $pos);
			$valor = substr($v[$i], $pos+1);
		}
		$arr[$atributo]=$valor;
	}
	return $arr;
}

function getExtension($archivo) {
	//$pos = strrpos($archivo, ".");
	$res ="";
	//$res = substr($archivo, $pos+1);
	$res = substr(strrchr($archivo, '.'), 1);
	return $res;
}
function getExtensionArchivo($archivo) {
	$res=$archivo;
	$pos = strrpos($archivo,".");
	if ($pos>0) {
		$res= substr($archivo,$pos+1);
	}
	return $res;
}

function acortaCadena( $m_asunto, $tamanioOptimo="" ) {
	if ($tamanioOptimo=="") $tamanioOptimo = 35;
	//Como mucho cojo 45 letras
	$miStrTotal = substr($m_asunto, 0, $tamanioOptimo+10);

	if ( strlen($m_asunto) <= $tamanioOptimo) $acortaCadena = $m_asunto;
	else {
		//El mensaje es mayor que 35 y debemos cortar.
		$miStrResto = substr($miStrTotal, $tamanioOptimo);
		$pos = strpos($miStrResto, " ");
		if ($pos===FALSE) {
			//Si no lo encuentro devuelvo la cadena tal cual
			$acortaCadena = $miStrTotal;
		} else {
			//Si encontramos el espacio corto
			$acortaCadena = substr ( $miStrTotal, 0, $pos+$tamanioOptimo ) . " ...";
		}
	}
	return $acortaCadena;
}

function cerrarVentanaActualizar() {
?><html>
<body onload="opener.location.reload();window.close()"></body>
</html>
<?
	exit();
}


function cerrarVentanaActualizarUrl($url) {
?><html>
<body onload="opener.location.href='<?= $url ?>';window.close()"></body>
</html>
<?
	exit();
}


function cerrarVentana() {
?><html>
<body onload="window.close()"></body>
</html>
<?
	exit();
}

function getRequest() {
	global $_GET,$_POST;
	$dict=$_GET;
	if (count($dict)==0) $dict = $_POST;
	return $dict;
}

	function getNombreDirectorio($archivo) {
		$res=$archivo;
		$archivo = strtr($archivo,"\\","/");
		$res = dirname($archivo);
		return $res;
	}

	function getNombreArchivo($archivo) {
		$res=$archivo;
		$archivo = strtr($archivo,"\\","/");
		$pos = strrpos($archivo,"/");
		if ($pos>0) {
			$res= substr($archivo,$pos+1);
		}
		return $res;
	}

	function getNombreArchivoSinExtension($archivo) {
		$res=$this->getNombreArchivo($archivo);
		$pos = strrpos($res,".");
		if ($pos>0) {
			$res= substr($res,0,$pos);
		}
		return $res;
	}

	function getLastPart($texto,$cad) {
		$res=$texto;
		$pos = strrpos($res,$cad);
		if ($pos===FALSE) {
		} else {
			$res= substr($res,$pos+strlen($cad));
		}
		return $res;
	}

	function getFirstPart($texto,$cad) {
		$res=$texto;
		$pos = strpos($res,$cad);
		if ($pos===FALSE) {
		} else {
			$res= substr($res,0,$pos);
		}
		return $res;
	}

	function elimina($char, $cadena) {
		$res = implode("",explode($char,$cadena));
		return $res;		
	}


	function appendToFile($file, $msg) {
		$save_path=$file;
		$fp = fopen($save_path, "a"); #open for writing
		fputs($fp, $msg."\n"); #write all of $data to our opened file
		fclose($fp); #close the file					
	}

	function var_dump($res) {
		$contenido="";
		ob_start();
		var_dump($res);
		$contenido = ob_get_contents(); 
		ob_end_clean();
		return $contenido;
	}

	function getReal($valor) {
		if ($valor=="") $res="0";
		if ($valor=="NaN") $res="0";
		else $res=$valor;
		$res=strtr($res,",",".");
		return $res;
	}

	function real2moneda($val, $decimales) {
		return number_format($val, $decimales, ",", ".");
	}

	function real2str($val, $decimales) {
		return number_format($val, $decimales, ",", "");
	}

	function getIdsFromFilas(&$filas,$campo) {
		$arrIds= array();
		for ($i=0;$i<count($filas);$i++) {
			$clave = eval('return $filas[$i]->'.$campo.';');
			if ($clave!="") $arrIds[$clave]="1";
		}
		$keys = array_keys($arrIds);
		$strIds = implode(",",$keys);
		return $strIds;
	}

	/* Esta funcion es �til para visualizaciones de inputs. Adem�s si es vacio mete espacio */
	function mostrar($cadena) {
		$res=htmlspecialchars($cadena);
		return $res;
	}

	/* Esta funcion es �til para visualizaciones de inputs para que las " no corrompan los datos*/
	function encapsulaComillas($cadena) {
		return htmlspecialchars($cadena);
	}

	/* Esta funcion es �til para visualizaciones de inputs para que las " no corrompan los datos*/
	function encapsulaInput($cadena) {
		return htmlspecialchars($cadena);
	}


	function mostrarJsTextarea($val) {
		$res=$val;
		$res=nl2br($res);
		$v = explode("<br />",$res);
		$salida="";
		for ($i=0;$i<count($v);$i++) {
			$salida.=trim( $v[$i])."\\n";
		}
		$salida = preg_replace("/\"/","\\\"", $salida);
		$salida = preg_replace("/\'/","\\\'", $salida); 
		return $salida;
	}


	function getTaxonomiaAdicional($dict) {
		$res="";
		while (list($k,$v)=each($dict)) {
			$patron="taxonomias_valor_";
			if (substr($k, 0, strlen($patron))==$patron) {
				$res = $res . "," . $v;
			}
		}
		if ($res!="") $res = substr($res,1);
		return $res;
	}

	function normalizeString($cadena) {
		$res = strtolower(strtr($cadena,"áéíóúüÁÉÍÓÚÜçÇõÕñÑ","aeiouuaeiouuccoonN"));
		return $res;	
	}

	function getCadenaSeo($cadena) {
		$res = $this->normalizeString($cadena);
		$res = strtolower($res);
		$res = strtr($res," ","_");
		return $res;	
	}

	function getUrlQuery($script,$query) {
		global $SCRIPT_NAME;
		$nombre = $script;
		if ($nombre=="") $nombre = basename ($SCRIPT_NAME );

		if ($query!="") $query="?".$query;
		return $nombre.$query;

	}


	function getUrlQueryTotal($script,$query) {
		global $SCRIPT_NAME;
		$nombre = $script;
		if ($nombre=="") $nombre = $SCRIPT_NAME ;

		/////Añadido Joaquin Gayoso 13/06/2016
	$query= strip_tags($query);
	//Fin Añadido Joaquin Gayoso XSS 
	
		if ($query!="") $query="?".$query;
		return $nombre.$query;

	}

	function getQueryString() {
		global $_SERVER;
		return $_SERVER["QUERY_STRING"];
	}

	function esUrlHTTP($cadena) {
		$res=true;
		$strHttp = "http://";
		$pos = strpos (strtolower($cadena), $strHttp);
		if ($pos===false) $res=false;
		return $res;
	}

	function getUrlHTTP($cadena) {
		$res=true;
		$strHttp = "http://";
		$pos = strpos (strtolower($cadena), $strHttp);
		if ($pos===false) $res=false;
		if ($res) {
			$res=$cadena;
		} else {
			$res="http://".$cadena;
		}
		return $res;
	}

	/*
	 * Funci�n que nos permite proteger nobres de archivos para mostraros con HTML:
	 * Ejemplo: Men�s/banco imagenes/cami�n.jpg lo trasformaria a algo as� Men%FAs/banco%20imagenes/cami%FEn.jpg
	 * De esta forma se puede utilizar en un <img>
	*/
	function getUrlArchivo($archivo) {
		if ($this->esUrlHTTP($archivo)) {
			$imagen = $archivo;
		} else {
			$v = explode("/",$archivo);
			for ($i=0;$i<count($v);$i++) {
				$v[$i] = rawurlencode($v[$i]);
			}
			$imagen = implode( $v, "/");
		}
		return $imagen;
	}

	function getValorMultiple($nombre, $arr) {
		$res=array();
		while (list ($clave, $val) = each ($arr)) {		
			if ($this->perteneceLista( $clave,  $nombre )) {
				$res[] = $val;
			}
		}
		return $res;
	}

	function mkdir($directorio) {		
		if (file_exists($directorio)) {
			
		} else {
			$dirPadre = $this->getNombreDirectorio($directorio)."/";
			$this->mkdir($dirPadre);
			mkdir($directorio);
			chmod($directorio,0777);
		}
	}


	function generatePassword($size) {
		$res="";
		for ($i=0;$i<$size;$i++) {
			$c = rand(ord('A'),ord('Z')+10);
			if ($c<=ord('Z')) $c=chr($c);
			else {
				$c = "". $c-ord('Z');
			}
			$res=$res.$c;
		}
		return $res;
	}

	function getLeftToDelim($cadena,$delim,$n) {
    	$res="";
    	while ($n>0) {
    		$pos = strpos($cadena,$delim );
    		if ($pos===FALSE) {
    			$res = $res . $cadena;
    			$cadena = "";
    		} else {
    			if ($n==1) $res = $res . substr($cadena,0,$pos );
    			else $res = $res . substr($cadena,0,$pos+1 );
    			$cadena = substr($cadena,$pos+1);
    		}
    		$n--;
    	}
    	return $res;
	}

	function invierte($cadena) {
		$res="";
		for($i=0;$i<strlen($cadena);$i++) {
			$c = substr($cadena,$i,1);
			$res =$c.$res; 
		}
		return $res;
	}

	function getRightToDelim($cadena,$delim,$n) {
		$res = $this->invierte($cadena);
		$res = $this->getLeftToDelim($res,$delim,$n);
		$res = $this->invierte($res);
		return $res;
	}

	function parteLista($cadena,$delim) {
		$res=explode($delim,$cadena);
		return $res;
	}


	/*devuelve la URL base para este archivo PHP concreto.*/
	function getUrlBaseRewrite() {
		global $_SERVER, $_SERVER;
		$dict = $_SERVER;
		if ($dict=="") $dict = $_SERVER;
		$res = "http://".$dict["HTTP_HOST"];
		$q = $dict["QUERY_STRING"];
		$pathbase = substr($dict["REQUEST_URI"],0,strlen($dict["REQUEST_URI"])-strlen($q));
		$res.=$pathbase;
		return $res;
	}


	
	function cambiaEtiqueta($texto, $et1, $et2) {
		$contenido = preg_replace("/<".$et1."([^>]*)>/i", "<".$et2."$1>", $texto);
		$contenido = preg_replace("/<\\/".$et1."([^>]*)>/i", "</".$et2."$1>", $contenido);
		return $contenido;
	}

	function getArrayDict($filas,$campo) {
		$dictFilas = array();
		for ($i=0;$i<count($filas);$i++) {
			$clave = eval('return $filas[$i]->'.$campo.';');
			$dictFilas[$clave][]=$filas[$i];
		}
		return $dictFilas;
	}

	function getArrayDictCount($filas,$campo) {
		$dictFilas = array();
		for ($i=0;$i<count($filas);$i++) {
			$clave = $filas[$i][$campo];
			$dictFilas[$clave]=$filas[$i];
		}
		return $dictFilas;
	}

	function bbdd2formatoDecimal($valor) {
		if ($valor=="") $res="";
		else $res = number_format($valor,2, ",", ".");
		return $res;
	}
	function formatoDecimal2bbdd($valor) {
		//$res= number_format($valor,2, ",", ".");
		$res = str_replace(".",",",$valor);
		
		$res = str_replace(",",".",$res);
		

		return  $res;
	}

	function getCarpetas($path, $orden="nombre"){
	
		global $visit;
		
		$handle = opendir($path); 
		$arr = array();
		$sep = chr(254); 
		while($file=readdir($handle)){
			if (is_dir("$path/$file")) { 
				$key="    ".$file;
				//print "***". $file;
			} else {
				if ($orden=="nombre") {
					$key=$file;
				} else if ($orden=="size") {
					$key = $visit->util->numDigitos(ceil( filesize($path."/".$file)/1024 ),10) . $sep.$file;
				} else if ($orden=="fecha") {
					$key=date("Y/m/d", fileatime($path."/".$file)) . $sep.$file;
					//print "<br>***". $file;
				}
				//print "<br>***". $file;
			}
			$key = strtolower($key);
			$arr[ $key ] = $file;
		}  
		ksort($arr);
		$filenames = array_values($arr);
//			$filenames[]=$file;   
//			$visit->debuger->out($file);			
		//var_dump($filenames);
		//natcasesort ($filenames);
	
		return $filenames;

	}

	/* Obtiene el nombre de esta pagina web sin http:// */
	function getUrlHostNombre() {
		global $_SERVER, $_SERVER;
		$dict = $_SERVER;
		if ($dict=="") $dict = $_SERVER;
		$res = $dict["HTTP_HOST"];
		return $res;
	}

	function getUrlHost() {
		global $_SERVER, $_SERVER;
		$dict = $_SERVER;
		if ($dict=="") $dict = $_SERVER;
		$res = "http://".$dict["HTTP_HOST"];	
		
		return $res;
	}
	function getParentDir(){
		global $visit,$_SERVER, $_SERVER, $SCRIPT_NAME;
		
		//echo 	$_parenDir;
		if ($_parenDir=="") $_parenDir = join(array_slice(explode( "/" ,dirname($_SERVER['PHP_SELF'])),0,-1),"/"); 
		if ($_parenDir=="") $_parenDir = dirname($_SERVER['PHP_SELF']);
		
		return $_parenDir.'/';
	}
	
	function getEnlaceFromMenu($fila, $menu){
		global $visit;
		//var_dump($fila);
		$_parenDir = $this->getUrlHost();
		if(APP_NAME!=""){
			$_parenDir = $_parenDir."/".APP_NAME;
		}
		if ($fila->tipo_contenido =="H") {
			$hijo = $visit->dbBuilder->getPrimerHijoNavegacion($fila->id);
			$enlace = $this->getEnlaceFromMenu($hijo, $menu);
		} else if ($fila->tipo_contenido =="P"){			
			$enlace = $_parenDir."/view/paginas/view_paginas.php?id=". $fila->idpagina;
		}else if ($fila->tipo=="I" && $fila->tipo_contenido==NULL){
			$enlace = $_parenDir."/view/generico.php?id=".$fila->id;
		} else if ($fila->tipo_contenido =="U"){
			$enlace = $fila->protocolo.$fila->url;
		} else if ($fila->tipo_contenido =="B"){
			$enlace = $_parenDir."/view/buscador.php";
		} else if ($fila->tipo_contenido =="C"){
			//$idprimer = $visit->dbBuilder->getPrimerHijoOrden($fila->id);	
			//$enlace = $_parenDir."/view/ls_ov_clasificacion.php?id=".$idprimer[0]->id;
			//$enlace = $_parenDir."/view/generico.php";
			$enlace = $_parenDir."/view/ls_ov_clasificacion.php?paginacion=10";
		} else if ($fila->tipo_contenido =="A"){
			$enlace = $_parenDir."/view/cm_view_virtual_object.php";
		} else if ($fila->tipo_contenido =="M"){
			$enlace = $_parenDir."/bo/";
		}

		return $enlace;		
	}

	function getNombreMes($fecha) {
		$mes = substr($fecha,4,2);
		if ($mes=="01") $res="Enero";
		if ($mes=="02") $res="Febrero";
		if ($mes=="03") $res="Marzo";
		if ($mes=="04") $res="Abril";
		if ($mes=="05") $res="Mayo";
		if ($mes=="06") $res="Junio";
		if ($mes=="07") $res="Julio";
		if ($mes=="08") $res="Agosto";
		if ($mes=="09") $res="Septiembre";
		if ($mes=="10") $res="Octubre";
		if ($mes=="11") $res="Noviembre";
		if ($mes=="12") $res="Diciembre";
		return $res;
	}

	function getAnio($fecha) {
		return substr($fecha,0,4);
	}

	function getMes($fecha) {
		return substr($fecha,4,2);
	}

	function getDia($fecha) {
		return substr($fecha,6,2);
	}


	function getParametroSeo($campo) {
		//var_dump($_POST);
		$dict = $this->getRequest();
		$valor = $dict[$campo];
		$res = $this->getLeftToDelim($valor,"_",1);
		return $res;
	}

	function construyeUrlMenosMas($nombre, $dict, $menos, $mas) {
		$v = explode(",",$menos);
		for ($i=0;$i<count($v);$i++) {
			$dict[$v[$i]]="";
		}
		$res = $this->construyeUrl($nombre, $dict);
		$res = $res . "&". $mas;
		return $res;
	}


	
	function getLiteralesLista($lista,$dict) {
		//echo var_dump($lista);
		if ($lista!=""){
			
			$v = explode(",",$lista);
			for ($i=0;$i<count($v);$i++){
				$literales = $literales.",".$dict[$v[$i]]->nombre;

			}

			if ($literales!="") $literales = substr($literales,1);
		}
		return $literales;
	}

	function bbdddatetime2unix($strbbdd) {
		$res="";
		if (strlen($strbbdd)>=14) {
			$dia=intval(substr($strbbdd,6,2));
			$mes=intval(substr($strbbdd,4,2));
			$anio=intval(substr($strbbdd,0,4));
			$hora=intval(substr($strbbdd,8,2));
			$minuto=intval(substr($strbbdd,10,2));
			$segundo=intval(substr($strbbdd,12,2));
			$res = mktime($hora, $minuto, $segundo, $mes, $dia, $anio );
		}
		return  $res;
	}


	function getDictIdSeccion($filas) {
		$dictFilas = array();
		for ($i=0;$i<count($filas);$i++) {
			$dictFilas[$filas[$i]->idseccion]=$filas[$i];
		}
		return $dictFilas;
	}
	function getDictIdSeccionIdRecurso($filas) {
		$dictFilas = array();
		for ($i=0;$i<count($filas);$i++) {
			//echo var_dump($filas[$i])."***";
			$dictFilas[$filas[$i]->idseccion."_".$filas[$i]->idrecurso]=$filas[$i];
			//echo var_dump($dictFilas[$filas[$i]->idseccion."_".$filas[$i]->idrecurso])."<br>";
		}
		return $dictFilas;
	}
	function imprimeNavegacionRecursos($idseccion, $acum_navegacion, $nivel, $url, $idov) {
	global $visit,$_GET;
		$dictFilasSectionData = $visit->options->sectionData;
		
		$seccion=$dictFilasSectionData[$idseccion];
	//$seccion=$visit->dbBuilder->getSectionDataId($idseccion);
	if ($seccion->tipo_valores=="C") {
		$controlados=$visit->dbBuilder->getHijosFromValorControladoOV($idseccion, $acum_navegacion, $idov);
		//var_dump($controlados);
	}  else if ($seccion->tipo_valores=="N") {
		$controlados=$visit->dbBuilder->getHijosFromValorNumericoOV($idseccion, $acum_navegacion, $idov);
	}  else if ($seccion->tipo_valores=="T") {
		$controlados=$visit->dbBuilder->getHijosFromValorTextoOV($idseccion, $acum_navegacion, $idov);
	}  else if ($seccion->tipo_valores=="F") {
		$controlados=$visit->dbBuilder->getHijosFromValorFechaOV($idseccion, $acum_navegacion, $idov);
	} 
	//Busco las secciones hijas de este idseccion que tengan navegable=S
   //$seccionesNavegables=$visit->dbBuilder->getSeccionesNavegablesFromIdPadre($idseccion);//explode(",",f1($idseccion));//
   $seccionesNavegables= explode(",",$this->buscaBrowseables($idseccion));
	if ($controlados!=null){
		for($i=0;$i<count($controlados);$i++) { ?>
			<?
				$clase="menurecursosimpar";
				//if ($nivel%2==0) $clase="menuseccionespar";
			?>
			<tr>
				<td class="<?= $clase ?>" onmouseover="this.className='<?= $clase ?>over';" onmouseout="this.className='<?= $clase ?>';" nowrap>
					<?
					for ($k=0;$k<$nivel;$k++) {
						print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
					}
					$urlNueva = $url . "&criterio_".$idseccion."=".$controlados[$i]->value."&count=".$controlados[$i]->cuenta;
					?>
					<a class="<?=$clase?>nav" href='<?= $urlNueva ?>'>
						<?=$controlados[$i]->value ?> 
					</a>(<?= $controlados[$i]->cuenta ?>)
				</td>
			</tr>
			<?
			for ($j=0;$j<count($seccionesNavegables);$j++) {
				//$filaSeccion = $visit->dbBuilder->getSectionDataId($seccionesNavegables[$j]);
				$filaSeccion=$dictFilasSectionData[$seccionesNavegables[$j]];
				if ($filaSeccion != "") {

					if ($_GET["criterio_".$idseccion]==$controlados[$i]->value && $filaSeccion->nombre!="") { ?>
						<tr>
							<td class="menurecursos" onmouseover="this.className='menurecursosover';" onmouseout="this.className='menurecursos';" nowrap>
							<?
							for ($k=0;$k<$nivel;$k++) {
								print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
							}
							print "&nbsp;&nbsp;&nbsp;&nbsp;";
							print "- ".$filaSeccion->nombre;
							?>
							</td>
						</tr>
						<?
						$navegacion = $acum_navegacion;
						$navegacion[]= array($idseccion, $controlados[$i]->value);
						
						$this->imprimeNavegacionRecursos($filaSeccion->id, $navegacion, $nivel+1, $urlNueva, $idov);
					}
				}
			  
			}
		} 
	} 
}



//Devuelve todas las categorias browseables (hijas de idsec) menos idsec.
function f1($idsec){
	global $visit;
	$dictFilasSectionData = $visit->options->sectionData;
	if ($idsec=="3") $res="";
	else {
		//$seccion=$visit->dbBuilder->getSectionDataId($idsec);
		$seccion=$dictFilasSectionData[$idsec];
		$rol = $visit->dbBuilder->getUsuarioRol($_SESSION["name"]);
		if($rol == "A"){
			$secciones= $visit->dbBuilder->getSeccionesFromIdPadre($idsec);
		}else{
			$secciones= $visit->dbBuilder->getSeccionesNavegablesFromIdPadreVisibles($idsec);
		}
		for ($j=0;$j<count($secciones);$j++) {
			if ($secciones[$j]->browseable=="S") {
				$nuevosValores = $secciones[$j]->id;
				if ($res!="") $res= $res.",";
				$res .= $nuevosValores;
			} else {
				$nuevosValores = $visit->util->f1($secciones[$j]->id);
				if ($nuevosValores!="") {
					if ($res!="") $res= $res.",";
					$res = $res.$nuevosValores;
				}
			}			
		}
	}
	///echo "idsec(".$idsec.")=".$res."******/*****/****<br>";
	return $res;
	
	/* ANTIGUO
	 global $visit;
	if ($idsec=="3") $res="";
	if($idsec == "0"){
		$seccion=$visit->dbBuilder->getSectionDataId($idsec);
		$secciones= $visit->dbBuilder->getSeccionesFromIdPadre($idsec);
		for ($j=0;$j<count($secciones);$j++) {
			if ($secciones[$j]->browseable=="S") {
				$nuevosValores = $secciones[$j]->id;
				if ($res!="") $res= $res.",";
				$res .= $nuevosValores;
			} else {
				$nuevosValores = $visit->util->f1($secciones[$j]->id);
				if ($nuevosValores!="") {
					if ($res!="") $res= $res.",";
					$res = $res.$nuevosValores;
				}
			}
		}		
	}else {
		$seccion=$visit->dbBuilder->getSectionDataId($idsec);
		$secciones= $visit->dbBuilder->getSeccionesFromIdPadre($idsec);
		for ($j=0;$j<count($secciones);$j++) {
			if ($secciones[$j]->browseable=="S") {
				$nuevosValores = $secciones[$j]->id;
				if ($res!="") $res= $res.",";
				$res .= $nuevosValores;
			} else {
				$nuevosValores =  $visit->util->f1($secciones[$j]->id);
				if ($nuevosValores!="") {
					if ($res!="") $res= $res.",";
					$res.=$secciones[$j]->id;;
				}
			}			
		}
	}
	///echo "idsec(".$idsec.")=".$res."**********<br>";
	return $res;
	*/
	
}
//Devuelve las section data hijos del primer nivel
function clasificacionSectionDataPrimerNivel($idsec){
	global $visit;
	$dictFilasSectionData = $visit->options->sectionData;
	if ($idsec=="3") $res="";
	else if($idsec =="0"){
			$nivelInicial = -1;
			$res = $visit->util->clasificacionSectionDataPrimerNivelREC($idsec,$nivelInicial);
		
	}else{
		$nivelInicial = 0;
		//$seccion=$visit->dbBuilder->getSectionDataId($idsec);
		$seccion=$dictFilasSectionData[$idsec];
		$num_valores = $visit->dbBuilder->seccionTieneValoresCount($seccion->id);
		if($visit->util->esSuperAdmin()||$seccion->visible =="S" )	{
			if($seccion->browseable == "S" && $num_valores>0 ){//seccion propia con valores
				if($seccion->idpadre != 0){
					$nuevosValores = $seccion->id."&".$seccion->tipo_valores."&".$seccion->nombre."&".$nivel."&".$seccion->browseable;
				}
				if ($res!="") $res= $res.",";
				$res .= $nuevosValores;	
			}else{	
				$res = $visit->util->clasificacionSectionDataPrimerNivelREC($idsec,$nivelInicial);
			}
		}
	}
	return $res;
}

//Metodo Recursico de sectionData primer Nivel

function clasificacionSectionDataPrimerNivelREC($idsec,$nivel){
	global $visit;
	$dictFilasSectionData = $visit->options->sectionData;
	$res ="";
	if ($idsec=="3") $res="";
	else {		
		//$seccion=$visit->dbBuilder->getSectionDataId($idsec);
		$seccion=$dictFilasSectionData[$idsec];
		$secciones= $visit->dbBuilder->getSeccionesFromIdPadre($idsec);
		foreach ($secciones as $clave=>$valor){
			if(!$visit->util->esSuperAdmin() && $valor->visible !="S" ){
				continue;
			}
			$num_valores = $visit->dbBuilder->seccionTieneValoresCount($valor->id);	
			if($valor->browseable == "S" && $num_valores>0 && $valor->tipo_valores != "X"){//seccion propia con valores
				if($valor->idpadre != 0){
					$nuevosValores = $valor->id."&".$valor->tipo_valores."&".$valor->nombre."&".$nivel."&".$valor->browseable;
				}
				if ($res!="") $res= $res.",";
				$res .= $nuevosValores;		
				/*$resHijos = $visit->util->clasificaSectionDataREC($valor->id,$nivel+1);
				if($resHijos !=""){
					if ($res!="") $res= $res.",";
					$res = $res.$resHijos;
				}
				*/
			}else{ //seccion sin valores propios, depende del hijo
				if($nivel <= 0 ){
					if($valor->idpadre != 0){
						$nuevosValores = $valor->id."&".$valor->tipo_valores."&".$valor->nombre."&".$nivel."&".$valor->browseable;
					}
					$resHijos = $visit->util->clasificacionSectionDataPrimerNivelREC($valor->id,$nivel+1);
					if($resHijos !=""){
						if ($res!="") $res= $res.",";
						$res .= $nuevosValores;
						if ($res!="") $res= $res.",";
						$res = $res.$resHijos;
					}
				}
			}
			
		}
	return $res;
	}
}


//Metodo de llamada al clasificaSectionDataREC inicial
function clasificacionSectionData($idsec){
	global $visit;
	if ($idsec=="3") $res="";
	else if($idsec =="0"){
		$nivelInicial = -1;
		$res = $visit->util->clasificaSectionDataREC($idsec,$nivelInicial);
	}else{
		$nivelInicial = 0;
		$res = $visit->util->clasificaSectionDataREC($idsec,$nivelInicial);
	}
	return $res;
}

//Metodo recursivo que devuelve todas las categorias (hijas de idsec)
function clasificaSectionDataREC($idsec,$nivel){
	global $visit;
	$dictFilasSectionData = $visit->options->sectionData;
	$res ="";
	if ($idsec=="3") $res="";
	else {		
		$seccion=$dictFilasSectionData[$idsec];
		//$seccion=$visit->dbBuilder->getSectionDataId($idsec);
		$secciones= $visit->dbBuilder->getSeccionesFromIdPadre($idsec);
		foreach ($secciones as $clave=>$valor){
			$num_valores = $visit->dbBuilder->seccionTieneValoresCount($valor->id);	
			if($valor->browseable == "S" /*&& $num_valores>0*/  && $valor->tipo_valores != "X"){//seccion propia con valores
				if($valor->idpadre != 0){
					$nuevosValores = $valor->id."&".$valor->tipo_valores."&".$valor->nombre."&".$nivel."&".$valor->browseable;
				}
				if ($res!="") $res= $res.",";
				$res .= $nuevosValores;		
				$resHijos = $visit->util->clasificaSectionDataREC($valor->id,$nivel+1);
				if($resHijos !=""){
					if ($res!="") $res= $res.",";
					$res = $res.$resHijos;
				}
			}else{ //seccion sin valores propios, depende del hijo
				if($valor->idpadre != 0){
					$nuevosValores = $valor->id."&".$valor->tipo_valores."&".$valor->nombre."&".$nivel."&".$valor->browseable;
				}
				$resHijos = $visit->util->clasificaSectionDataREC($valor->id,$nivel+1);
				if($resHijos !=""){
					if ($res!="") $res= $res.",";
					$res .= $nuevosValores;
					if ($res!="") $res= $res.",";
					$res = $res.$resHijos;
				}
			}
			
		}
		
		
		
		/*
		$seccion=$visit->dbBuilder->getSectionDataId($idsec);
		$secciones= $visit->dbBuilder->getSeccionesFromIdPadre($idsec);
		$count = count($secciones);
		if($seccion->browseable =="S" && $nivel  == 0 && $seccion->tipo_valores != "X"){
			$nuevosValores = $seccion->id."&".$seccion->tipo_valores."&".$seccion->nombre."&".$nivel."&".$seccion->browseable;
			if ($res!="") $res= $res.",";
			$res .= $nuevosValores;		
		}
	
		for ($j=0;$j<$count;$j++) {
			if($secciones[$j]->idpadre !="0"){
				$nuevosValores = $secciones[$j]->id."&".$secciones[$j]->tipo_valores."&".$secciones[$j]->nombre."&".$nivel."&".$secciones[$j]->browseable;
			}
			//Llamada Recursiva
			$resHijos = $visit->util->clasificaSectionDataREC($secciones[$j]->id,$nivel+1);
			 // echo ($resHijos)."--";
			 // echo $secciones[$j]->browseable;
			
			if($secciones[$j]->browseable =="S"){
				if ($res!="") $res= $res.",";
				$res .= $nuevosValores;
				if($resHijos !=""){
					if ($res!="") $res= $res.",";
					$res .= $resHijos;}
				
			}
			else if($resHijos !="") {
				if ($res!="") $res= $res.",";
				$res .= $nuevosValores;
				$res .= ",".$resHijos;
			}	
				
		}
		*/
	}
	///echo "idsec(".$idsec.")=".$res."******/*****/****<br>";
	
	return $res;
}
/*
//Devuelve todas las categorias browseables (hijas de idsec) menos idsec.
function todaClasificacion($idsec){
	global $visit;
	if ($idsec=="3") $res="";
	else {
		$seccion=$visit->dbBuilder->getSectionDataId($idsec);
		$secciones= $visit->dbBuilder->getSeccionesFromIdPadre($idsec);
		for ($j=0;$j<count($secciones);$j++) {
			if ($secciones[$j]->browseable=="S") {
				$nuevosValores = $secciones[$j]->id."-".$secciones[$j]->tipo_valores."-".$secciones[$j]->nombre;
				if ($res!="") $res= $res.",";
				$res .= $nuevosValores;
			} else {
				$nuevosValores = $visit->util->todaClasificacion($secciones[$j]->id);
				if ($nuevosValores!="") {
					if ($res!="") $res= $res.",";
					$res = $res.$nuevosValores;
				}
			}			
		}
	}
	///echo "idsec(".$idsec.")=".$res."******//****<br>";
	return $res;
}
*/
	//Devuelve todas las categorias browseables (hijas de idsec) menos idsec.
	function buscaBrowseables($idsec){
		global $visit;
		$dictFilasSectionData = $visit->options->sectionData;
		if ($idsec=="") $res="";
		else {
			//$seccion=$visit->dbBuilder->getSectionDataId($idsec);
			$seccion=$dictFilasSectionData[$idsec];
			$secciones= $visit->dbBuilder->getSeccionesFromIdPadre($idsec);
			for ($j=0;$j<count($secciones);$j++) {
				if ($secciones[$j]->browseable=="S") {
					$nuevosValores = $secciones[$j]->id;
					if ($res!="") $res= $res.",";
					$res .= $nuevosValores;
				} else {
					$nuevosValores = $this->buscaBrowseables($secciones[$j]->id);
					if ($nuevosValores!="") {
						if ($res!="") $res= $res.",";
						$res = $res.$nuevosValores;
					}
				}			
			}
		}
		//echo "idsec(".$idsec.")=".$res."******/*****/****<br>";
		return $res;
	}
	function eliminaCarpeta( $carpeta ){ 
		if ( is_dir( $carpeta ) ){
			$directorio = opendir($carpeta); 
			while ($archivo = readdir($directorio)){ 
				if( $archivo !='.' && $archivo !='..' ){ 
				//comprobamos si es un directorio o un archivo 
					if ( is_dir( $carpeta.$archivo ) ){ 
					//si es un directorio, volvemos a llamar a la funci�n para que elimine el contenido del mismo 
					$this->eliminaCarpeta( $carpeta.$archivo.'/' ); 
					rmdir($carpeta.$archivo); //borrar el directorio cuando est� vac�o 
					} else { 
					//si no es un directorio, (Hay que mirar la fecha de creaci�n) lo borramos 
					//echo $carpeta.$archivo."<br>";
					$fecha = date("YmdHis", filemtime($carpeta."/".$archivo));
			//		$fechaActual =  obtenerFechaActual
				//	echo $fecha."<br>";
					
					unlink($carpeta.$archivo); 
					} 
				} 
			} 
			closedir($directorio); 
		} else {

		}
	} 
// borrar directorio y contenido
	function rrmdir($dir) {
		if (is_dir($dir)) {
			$objects = scandir($dir); 
		     foreach ($objects as $object) { 
		       if ($object != "." && $object != "..") { 
		        	if (filetype($dir."/".$object) == "dir"){
		         		$this->rrmdir($dir."/".$object); 
		        	}else unlink($dir."/".$object); 
		       } 
		     } 
		     reset($objects); 
		     rmdir($dir);
		} 
	}

function stripos($haystack, $needle, $offset = 0) {
   // first we need also the php4 compatible function for stripos()
   return strpos(strtolower($haystack), strtolower($needle),$offset);
}

function strripos($haystack, $needle) {
   $iter = $this->stripos($haystack, $needle);
   $pos = -1;
   while ($iter !== false) {
       $pos = $iter + ($pos+1);
       $iter = $this->stripos(substr($haystack,$pos+1), $needle);
     }
     return ($pos != -1) ? $pos : false;
}
	
function noOtroNivel(){
	$result = false;
	$pajar = $_SERVER["PHP_SELF"];
	$aguja = "/paginas/";
	$pos1 = $this->strripos($pajar,$aguja);
	$aguja = "index.php";
	$pos2 = $this->strripos($pajar,$aguja);
	$aguja = "buscador.php";
	$pos3 = $this->strripos($pajar,$aguja);
	$aguja = "cm_view_virtual_object.php";
	$pos4 = $this->strripos($pajar,$aguja);
	$aguja = "ls_ov_busqueda.php";
	$pos5 = $this->strripos($pajar,$aguja);
	if($pos1==false&&$pos2==false&&$pos3==false&&$pos4==false&&$pos5==false){
		$result = true;
	} else {
		$result = false;
	}
	return $result;
}
	
	function elimina_duplicados($array, $campo){
		foreach ($array as $sub){
			$cmp[] = $sub->$campo;
		}
		if(!is_array($cmp)){
			$cmp = array();
		}
		$unique = array_unique($cmp);
		foreach ($unique as $k => $campo){
			$resultado[] = $array[$k];
		}
	  	if(!is_array($resultado)){
			$resultado = array();
		}
		sort($resultado);
		return $resultado;
	}

	function SureRemoveDir($dir, $DeleteMe) {
		if(!$dh = @opendir($dir)) return;
		while (false !== ($obj = readdir($dh))) {
			if($obj=='.' || $obj=='..') continue;
			if (!@unlink($dir.'/'.$obj)) $this->SureRemoveDir($dir.'/'.$obj, true);
		}

		closedir($dh);
		if ($DeleteMe){
			@rmdir($dir);
		}
	}

	//Funcion de redondeo
	function redondeo ($numero, $decimales) {
   		$factor = pow(10, $decimales);
   		return (round($numero*$factor)/$factor); 
	} 
	/*
    *Construye ( las miguitas de pan)el titulo de la pagina 
    *obtiene el nombre del idPadre, creando el titulo de la pagina. Necesita un array tipo "id=>nombre"
    */
    function migaspan($idPadre, $array){
        $res ="";
        $ids = explode(',',$idPadre);
        $icount = 0;
        foreach($array as $clave =>$nombre){
            if($icount == 0){
                $res = $nombre;
            }
            else{
                $res = $res." > ".$nombre;
            }
            $icount++;
        }
        return $res;
    }
	/*
	 * FUNCION QUE DEVUELVE SI EL USUARIO ESTA REGISTRADO
	 */
    function esUserRegistrado(){
    	if($_SESSION["UserRolUser"] != ""){
    		return true;
    	}
    	return false;
    }
    function esSuperAdmin(){
    	if($_SESSION["UserRolUser"] == "A"){
    		return true;
    	}
    	return false;
    }
    function esAdmin(){
    	if($_SESSION["UserRolUser"] == "B"){
    		return true;
    	}
    	return false;
    }
	 function esUser(){
    	if($_SESSION["UserRolUser"] == "C"){
    		return true;
    	}
    	return false;
    }
}
?>