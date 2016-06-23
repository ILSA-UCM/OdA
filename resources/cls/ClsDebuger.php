<?
class ClsDebuger {
	var $enabled;

	function ClsDebuger() {
	}

	function configure() {
		$this->enabled = true;
		//$this->m_enabled = false;
	}

	function enable($val) {
		$this->enabled = $val;
	}

	function out2($val) {
		if ($this->enabled) {
			print $val . "<br style='padding-bottom:15px;'>\n";
		}
	}

	function out($val) {
		global $visit;
		list($usec, $sec) = explode(" ", microtime());
		$t = time();
		$hora = $visit->util->getHoraTotalActual($t);
		$fecha = $visit->util->unix2bbdd ($t);
		$val = $fecha ." " . $hora . "'". (intval($usec*1000)) ."- ".$val."<br style='padding-bottom:15px;'>\n";
		if ($this->enabled) {
			print $val;
		}
		$this->outErrorFile($val);
	}

	function outErrorFile($val) {
		global $visit;

		list($usec, $sec) = explode(" ", microtime());
		$t = time();
		$hora = $visit->util->getHoraTotalActual($t);
		$fecha = $visit->util->unix2bbdd ($t);
		$msg = $fecha ." " . $hora . "'". (intval($usec*1000)) .": ".$val;
		if ($this->enabled) {
			//print $msg."<br style='padding-bottom:15px;'>\n";
		}
		if (false) {			
			$save_path=dirname(__FILE__)."/../../log/errors.log";
			$fp = fopen($save_path, "a"); #open for writing
			fputs($fp, $msg."\n"); #write all of $data to our opened file
			fclose($fp); #close the file					
		}
	}

}
?>