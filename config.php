<?php

session_start();

// Emular register_globals on
if(!ini_get('register_globals')){
$superglobales=array($_ENV,$_GET,$_POST,$_COOKIE,$_SERVER,$_FILES);
	if(isset($_SESSION)){
	array_unshift($superglobales,$_SESSION);
	}
	foreach($superglobales as $superglobal){
			extract($superglobal,EXTR_SKIP);
	}
}


//ini_set("register_globals","1");// 1 activa rgs
ini_set("magic_quotes","0");
ini_set("display_errors", "0"); // 0 no sacar errores por pantalla, 1 si
ini_set( 'default_charset', 'UTF-8' );
//error_reporting(E_ALL & ~(E_NOTICE | E_STRICT |E_DEPRECATED));
//error_reporting(E_ALL & (E_STRICT |E_DEPRECATED));
ini_set('session.auto_start','1');

/// ** Parámetros de la Base de Datos ** //
define('TZN_DB_HOST','DDDBBB');
define('TZN_DB_USER','USERNAME');       // Nombre del usuario de la base de datos
define('TZN_DB_PASS','PASSS');           // Contraseña del usuario de la base de datos
define('TZN_DB_BASE','DBNAME');  	    // Nombre de la base de datos 	
define('TZN_DB_CLASS','tzn_mysql.php');


//Joaquin 160504 Puesto el limite del PHP a infinito, sino hay busqueda que se cuelga
set_time_limit(0);
?>
<?php 
/// ** Nombre de la carpeta de la aplicación  ** //
	define('APP_NAME','FOLDERNAME');   //Nombre de subcarpeta que va a contener la aplicación.
				    //Si la aplicación está en la raíz del servidor dejar en blanco
?>
