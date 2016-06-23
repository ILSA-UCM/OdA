<?
$prefs = array (
	
	/*
	Logo que se muestra en el backoffice
	*/
	
	//"logo_bo"=>"../img/logoChasqui.jpg",

	/*
	Si el número de niveles de la derecha es 0 no se incluirá ese elemento
	*/

	/*
	 * La tabla de clientes tiene este número de digitos, y se le pone el sufijo y el prefijo especificado
	 */
	"num_digitos_numero_codigo_cliente"=> 4,
	"prefijo_codigo_cliente"=> "CLI",
	"sufijo_codigo_cliente"=> "A",

	/*
	 * La tabla de pedidos tiene este número de digitos, y se le pone el sufijo y el prefijo especificado
	 */
	"num_digitos_numero_codigo_pedido"=> 5,
	"prefijo_codigo_pedido"=> "PED",
	"sufijo_codigo_pedido"=> "B",

	/*
	 * PREFERENCIAS DEL TPV VIRTUAL DE SERMEPA
	 */
	 /*
	"URLTPVSERMEPA" => "https://sis.sermepa.es/sis/realizarPago",	//Pruebas: https://sis-i.sermepa.es:25443/sis/realizarPago
	"Ds_Merchant_MerchantCode" => "072399587",	//Pruebas: 999008881
	"Ds_Merchant_Password" => "gatoyperromorados12", //Pruebas: qwertyasdf0123456789
*/
	"URLTPVSERMEPA" => "https://sis-i.sermepa.es:25443/sis/realizarPago",	//Pruebas: https://sis-i.sermepa.es:25443/sis/realizarPago
	"Ds_Merchant_MerchantCode" => "072399587",	//Pruebas: 999008881
	"Ds_Merchant_Password" => "gatoyperromorados12", //Pruebas: qwertyasdf0123456789

	"Ds_Merchant_MerchantName" => "Schott-nyc",//Pruebas: "Comercio Pruebas"
	"Ds_Merchant_ProductDescription"=> "Pedido Schott",

	"Ds_Merchat_ConsumerLanguage" => "001",
	"Ds_Merchant_Terminal" => "002",
	"Ds_Merchant_Currency" => "978",

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



?>