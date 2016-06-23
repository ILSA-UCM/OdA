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
?>
<? include_once(dirname(__FILE__)."/../resources/include.php"); ?>