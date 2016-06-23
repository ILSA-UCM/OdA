<?
class ClsLogger {
	var $enabled=false;
	var $ruta_log="./../../log/SqlPresist.log";

	static $singleton;
	static function get() {
		if ($singleton==NULL) {
			$singleton=new self();
		}
		return $singleton;
	}

	function Logger() {
		$this->enabled = true;
	}

	function log($val) {
		global $visit;

		if ($this->enabled) {	
			list($usec, $sec) = explode(" ", microtime());
			$t = time();
			$hora = $visit->util->getHoraTotalActual($t);
			$fecha = $visit->util->unix2bbdd ($t);
			$msg = $fecha ." " . $hora . "'". (intval($usec*1000)) .": ".$val;

			$save_path=dirname(__FILE__).$this->ruta_log;
			$fp = @fopen($save_path, "a"); #open for writing
			if ($fp) {
				fputs($fp, $msg."\n"); #write all of $data to our opened file
				fclose($fp); #close the file					
			}
		}
	}

	function logObjeto($obj){
		ob_start();
		print_r($obj);
		$contenido = ob_get_contents();
		ob_end_clean();
		$this->log($contenido);
	}

}
?>