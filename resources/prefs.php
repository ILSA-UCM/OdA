<?
$prefs = array (

/* TAMAÑO DE ESTRUCTURA */
	"tam_ancho_global"=> "1152",//Dos píxeles de más si tiene borde
	"tam_ancho_izda"=> "300",
	"tam_ancho_interior_izda"=> "185",
	"tam_ancho_contenidos"=> "645",
	"tam_ancho_interior_contenidos"=> "645",
	"tam_ancho_derecha"=> "0",
	"tam_ancho_interior_derecha"=> "0",

/* TAMAÑO DE IMAGENES PARA LOS DESTACADOS */

	"tam_img_destacado_izda"=> "140",
	"tam_img_destacado_dcha"=> "127",
	"tam_img_destacado_centro"=> "452",

	
/* MENUS */

	"menu_superior"=> "0",
	"menu_izquierda"=> "1",
	"menu_inferior"=> "1",
	"menu_derecha"=> "0",
	"registro_login_rapido"=> "1",
	"buscador"=> "0",


/* TARIFAS ASOCIADAS A PAISES */

	"tarifas_asociadas_paises"=> "S",

/* CONTENIDOS PÁGINAS */
	"creacion_paginas_imagen"=>"1",
	"creacion_paginas_texto"=>"1",

	

	
	"dummy"=> 1





);

function setArray($key,$value){
	$this->prefs[$key] = $value;
}

?>