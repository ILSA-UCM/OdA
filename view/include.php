<? 
	function striposX($haystack, $needle, $offset = 0) {
	   // first we need also the php4 compatible function for stripos()
	   return strpos(strtolower($haystack), strtolower($needle),$offset);
	}

	function strriposX($haystack, $needle) {
	   $iter = striposX($haystack, $needle);
	   $pos = -1;
	   while ($iter !== false) {
		   $pos = $iter + ($pos+1);
		   $iter = striposX(substr($haystack,$pos+1), $needle);
		 }
		 return ($pos != -1) ? $pos : false;
	}
	function noOtroNivel(){
		$result = false;
		$pajar = $_SERVER["PHP_SELF"];
		$aguja = "/paginas/";
		$pos = strriposX($pajar,$aguja);
		if($pos==false){
			$result = true;
		} else {
			$result = false;
		}
		return $result;
	}
	if(noOtroNivel()){
		include_once ("../resources/include.php"); 
	} else {
		include_once ("../../resources/include.php"); 
	}
?>