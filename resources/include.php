<?
//Localizaci�n de librer�as
set_include_path(get_include_path() . PATH_SEPARATOR . dirname(__FILE__)."/lib");


include_once(dirname(__FILE__)."/adodb5/adodb.inc.php");
include_once(dirname(__FILE__)."/adodb5/adodb-errorpear.inc.php");
$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
include_once(dirname(__FILE__)."/../config.php");
include_once(dirname(__FILE__)."/classes.php");
$visit = new ClsVisit();

include_once(dirname(__FILE__)."/inc_lang.php");
include_once(dirname(__FILE__)."/conf.php");
include_once(dirname(__FILE__)."/prefs.php");

$_parenDir = $visit->util->getUrlHost();
if(APP_NAME!=""){
	$_parenDir = $_parenDir."/".APP_NAME."/";
}

$visit->options->type="mysqli";
//Configuración local
if (file_exists( dirname(__FILE__)."/../../include.php")) {
	include_once(dirname(__FILE__)."/../../include.php");
	$visit->dbBuilder->configureADODB($visit->options->type,$visit->options->bdserver,$visit->options->bduser,$visit->options->bdpass,$visit->options->database);
} else {
	$visit->dbBuilder->configureADODB($visit->options->type,TZN_DB_HOST,TZN_DB_USER,TZN_DB_PASS,TZN_DB_BASE);
}

mysqli_set_charset('utf8');

#mysql_set_charset('utf8');

$visit->dbBuilder->generarSql = new ClsSqlMysql();
$visit->prefs = &$prefs;

$visit->debuger->enable(false);
$visit->dbBuilder->conn->debug = false;

//session_name(APP_NAME.$visit->options->usuario->id);
session_name(APP_NAME.$visit->options->usuario->id);
// alfredo 140628
//if ( !session_is_registered( "session" ) ) {
if ( !isset($_SESSION["session"]) ) {
$session = new ClsSession();
//	session_register("session");
$_SESSION["session"]=$session;
//echo">>>>>>>>>>>>>>>>>";echo $_SESSION;
}

if ($lang =="") $lang= "es";
$visit->options->lang = $lang;

$visit->options->usuario = $visit->dbBuilder->getUsuariosId( $_SESSION["idusuario"] );

//
//ini_set("display_errors", 1);
$dict = $visit->util->getRequest();
if ($dict != "")
{
	$id = $dict["id"];
	$op = $dict["op"];
}

$visit->options->secciones = $visit->dbBuilder->getSectionData();
$visit->options->secciones = $visit->util->getDict($visit->options->secciones);
//var_dump($dict);
?>