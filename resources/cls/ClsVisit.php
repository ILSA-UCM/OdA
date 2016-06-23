<?
class ClsVisit {
	var $debuger, $options, $util, $requestProcessor, $dbBuilder, $template, $prefs;

	function ClsVisit() {
		$this->options = new ClsOptions();
		$this->template = new ClsTemplate();
		$this->util = new ClsUtil();
		$this->requestProcessor = new ClsRequestProcessor();
		$this->debuger = new ClsDebuger();
		$this->debuger->configure();
		$this->dbBuilder = new ClsDbBuilder();
		$this->dbBuilder->configure($this);
		$this->prefs="";
	}
}
?>