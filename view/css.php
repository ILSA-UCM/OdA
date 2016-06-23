.big{ 
	padding:10px; 
	font-size:1.25em;
	color:#888888;
}	
.medium{ 
	padding:10px; 
	font-size:0.9em;
	color:#666666;
}	
.item{
	margin:0px 15px 20px 15px; 
	padding:10px; 
	font-size:1.15em;
	color:#888888;
	border-left:10px solid #003366;
	border-right:1px solid #888888;
	border-top:1px solid #888888;
	border-bottom:1px solid #888888;
	background-color:#FFFFFF;
	padding-right:30px;
}	
.item td{
	font-size:12px; 
}
span.metaniv1 {                                             
  font-family: Tahoma, Verdana, Arial, Helvetica, sans-serif;
  font-size: 1.25em;
  color: #000000;
  font-weight: bold;
}
span.metaa {                                             
  font-family: Tahoma, Verdana, Arial, Helvetica, sans-serif;
  font-size: 1.2em;
  color: #808080;
  font-weight: bold;
}
span.metab {                                             
  font-family: Tahoma, Verdana, Arial, Helvetica, sans-serif;
  font-size: 12px;
  color: #000066;
}

.menunivel1clasificacion {	
	font-size:11px; color:#6DB66D; 
	font-weight:bold; height:25px; 
	font-family:Tahoma;
	padding:4px ;padding-left:12px;
	/*border-bottom:1px solid #fbe18e;
 	border-top:1px solid #ffffb8;
 	*/
 	cursor:pointer; 
 }
.menunivel1clasificacionover {	
	font-size:11px; color:#6DB66D;
	 font-weight:bold;
	  height:25px;padding:4px;padding-left:12px; 
	  border-bottom:1px solid #fbe18e;
	  border-top:1px solid 	#ffffb8; 
	  cursor:pointer;
	  background-color:#FFFFFF;
}
/* 
 a.menunivel1clasificacionnav:link {	text-decoration: none; color:#FFF;}
a.menunivel1clasificacionnav:visited { text-decoration: none; color:#FFF;}
a.menunivel1clasificacionnav:hover { text-decoration: underline; color:#FFF;}
.white {color:#FFF;}

a.sectionvalor { color:navy; font-size:13px; font-family:Verdana,Arial,Sans-serif;}
a.sectionvalor:link { text-decoration:none; color:#FFF; }
a.sectionvalor:visited { text-decoration:none; color:#FFF; }
a.sectionvalor:hover {	text-decoration: none; color:orange; }
a.sectionvaloractual { color:navy; font-size:14px; font-family:Verdana,Arial,Sans-serif;}
a.sectionvaloractual:link { text-decoration:none; color:#A52A2A; }
a.sectionvaloractual:visited { text-decoration:none; color:#A52A2A; }
a.sectionvaloractual:hover {	text-decoration: none; color:white; }
a.sectionvalorn2:link { text-decoration:none; color:#c0c0c0; }
a.sectionvalorn2:visited { text-decoration:none; color:#c0c0c0; }
a.sectionvalorn2:hover {	text-decoration: none; color:orange; }
a.sectionvalorn3:link { text-decoration:none; color:#cfcfcf; }
a.sectionvalorn3:visited { text-decoration:none; color:#cfcfcf; }
a.sectionvalorn3:hover {	text-decoration: none; color:orange; }
a.sectionvalorn4:link { text-decoration:none; color:#e0e0e0; }
a.sectionvalorn4:visited { text-decoration:none; color:#e0e0e0; }
a.sectionvalorn4:hover {	text-decoration: none; color:orange; }
a.sectionvalorn5:link { text-decoration:none; color:#f0f0f0; }
a.sectionvalorn5:visited { text-decoration:none; color:#f0f0f0; }
a.sectionvalorn5:hover {	text-decoration: none; color:orange; }
a.sectionvalorn6:link { text-decoration:none; color:gray; }
a.sectionvalorn6:visited { text-decoration:none; color:gray; }
a.sectionvalorn6:hover {	text-decoration: none; color:orange; }
*/

.sectionatributo { font-size:13px; font-family:Arial,Sans-serif; line-height:190%; font-weight:bold; color:#330033;}
/*
//a:link				{	text-decoration: none; color: #971605; }
//a:visited			{	text-decoration: none; color: #971605; }
//a:hover				{	text-decoration: underline; color: #971605; }



a.docenlace:link	{	text-decoration: none; color: #666666; } 
a.docenlace:visited {	text-decoration: none; color: #666666; }
a.docenlace:hover	{	text-decoration: none; color: #971605; }

a.navprehome:link	{	text-decoration: none; color: #ffffff; } 
a.navprehome:visited {	text-decoration: none; color: #ffffff; }
a.navprehome:hover	{	text-decoration: none; color: #ffffff; }


*/

a:link			{	text-decoration: none; }
a:visited		{	text-decoration: none; }
a:hover			{	text-decoration: none; }

/* GENERALES */
BODY				{	font-size: 10px; 
						font-family: Verdana, Helvetica, Arial, sans-serif; color: #000000; 
						margin:10px auto 0px auto; 
						padding-left: 0px; 
						border: 0px; l
						line-height: 1.4em;
						/*width:<?= $prefs["tam_ancho_global"] ?>;*/
						width:1152px;
						background:#E8E8E8;
						 
						/* background: url(<?= $_parenDir."html/view/".$imagen_fondo_global ?>); */
						background-image: linear-gradient(top, #FFFFFF 35%, #E8E8E8 75%);
						background-image: -o-linear-gradient(top, #FFFFFF 35%, #E8E8E8 75% );
						background-image: -moz-linear-gradient(top, #FFFFFF 35%, #E8E8E8 75%);
						background-image: -webkit-linear-gradient(top, #FFFFFF 35%, #E8E8E8 75% );
						background-image: -ms-linear-gradient(top, #FFFFFF 35%, #E8E8E8 75%);
						-pie-background: linear-gradient(#FFFFFF, #E8E8E8);
						background-repeat: no-repeat;
						behavior: url(/<?=APP_NAME?>/view/css/pie/PIE.php);
						
					}
.classBody				{	
						font-size: 10px; 
						font-family: Verdana, Helvetica, Arial, sans-serif; color: #000000; 
						margin:10px auto 0px auto; 
						padding-left: 0px; 
						border: 0px; l
						line-height: 1.4em;
						/*width:<?= $prefs["tam_ancho_global"] ?>;*/
						width:1152px;
						background:#E8E8E8;
						 
						/* background: url(<?= $_parenDir."html/view/".$imagen_fondo_global ?>); */
						background-image: linear-gradient(top, #FFFFFF 35%, #E8E8E8 75%);
						background-image: -o-linear-gradient(top, #FFFFFF 35%, #E8E8E8 75% );
						background-image: -moz-linear-gradient(top, #FFFFFF 35%, #E8E8E8 75%);
						background-image: -webkit-linear-gradient(top, #FFFFFF 35%, #E8E8E8 75% );
						background-image: -ms-linear-gradient( #FFFFFF, #E8E8E8);
						-pie-background: linear-gradient(#FFFFFF, #E8E8E8);
						background-repeat: no-repeat;
						behavior: url(/<?=APP_NAME?>/view/css/pie/PIE.htc);
						
					}
					
					
TD					{	font-size: 10px; font-family: Verdana, Helvetica, Arial, sans-serif; color: #000000; 
						border: 0px; line-height: 1.4em;}
P					{	font-family: Verdana, Helvetica, Arial, sans-serif; 
						margin-top:0px;margin-bottom:0px; padding: 0px; border: 0px; line-height: 1.4em;}
DIV					{	font-size: 10px; font-family: Verdana, Helvetica, Arial, sans-serif; color: #000000; 
						border: 0px; line-height: 1.4em;}
/*
UL					{	font-size: 10px; font-family: Verdana, Helvetica, Arial, sans-serif; color: #000000; 
						margin-top: 4px; margin-bottom: 4px; border: 0px; line-height: 1.4em; text-align:justify;}
LI					{	font-size: 10px; font-family: Verdana, Helvetica, Arial, sans-serif; color: #000000; 
						margin-top: 4px; margin-bottom: 4px; line-height: 1.4em;  text-align:justify;}
OL					{	font-size: 10px; font-family: Verdana, Helvetica, Arial, sans-serif; color: #000000; 
						margin-top: 4px; margin-bottom: 4px; border: 0px; line-height: 1.4em;  text-align:justify;}
*/

FONT				{	font-size: 10px;}
INPUT				{	font-size: 10px; font-family: Verdana, Helvetica; color: #000000; }
SELECT				{	font-size: 10px; font-family: Verdana, Helvetica; color: #000000; border: 1px solid #7F9DB9;}
TEXTAREA			{	font-size: 10px; font-family: Verdana, Helvetica; color: #000000; border: 1px solid #7F9DB9;}

FORM				{	display:inline;}

.imagencabecera		{	border:1px solid #171717; background-color:#171717;} 

//TD.principal		{	vertical-align:top; background: url(<?= $_parenDir."html/view/".$imagen_superpuesta ?>) no-repeat;}

/* CABECERA */
.header		{   
			margin-left: 20px;
		    margin-right: 0;
		    padding-top:10px;
		   
		    /* background: url('/<?=APP_NAME?>/view/img/cabecera.png') no-repeat;*/
		    vertical-align:top; 
		 
		  
	    }
	    
.login_superior { 
			margin:5px 5px 5px 950px;
}


			
.menu_superior {
		clear:both;
		min-height: 29px;    
    	height: expresion(this.scrollHeight < 30? "29px": "auto");
    	/* height:29px;*/
		width:1172px;/*<?= $prefs["tam_ancho_global"] ?>;*/
		background: url('/<?=APP_NAME?>/view/img/menu_superior_1px.png') repeat-x top  #1165AD;
		margin-bottom:20px;
		margin-left:-10px;		
}

/* MENU IZQUIERDA*/	
.navizquierda	{
			/*width: <?= $prefs["tam_ancho_izda"] ?>;*/
			width: 245px;
			float:left;
			margin-left:-10px;
			margin-right:10px;
			overflow-x:auto;
			overflow-y:hidden;
			padding-left:0px;
			margin-left:0px;
			
}	


.navizquierda ul {
	padding-left:10px;
	margin-left:0px;
	margin-top:0px;
	padding-top:0px;
}
/* CUADRO CENTRAL */
.contenido{		
		padding:10px;
		float:left;
		width:850px;
		margin-left:20px;
		background-color:#FFFFFF;
		border: solid 1px #CCCCCC; 
		/*BORDES REDONDEADOS*/
	    -webkit-border-radius: 10px;
	    -moz-border-radius: 10px;
	    -ms-border-radius: 10px;
	    border-radius: 10px;
	    behavior: url(/<?=APP_NAME?>/view/css/pie/PIE.php);
	    /*SOMBRA BORDES */
	    box-shadow: 0 0 5px 5px #AEAEAE;
	    -webkit-box-shadow: 0 0 5px 5px #AEAEAE;
	    -moz-box-shadow:  0 0 5px 5px #AEAEAE;
	    
	
}
.contenido img{
	    /*TAMAÑO MAXIMO IMAGNES */
	    max-width:810px;
   		width: expression(this.width > 790 ? 790: true);
}
.contenido a:link{
	text-decoration:none;
	color:#1165AE;
}
.contenido a:visited{
	text-decoration:none;
	color:#1165AE;
}
.contenido a:hover{
	text-decoration:none;
	color:#1165AE;
}

/* LOGIN */

.login				{	font-size:10px; color:#000000; padding-left:8px;}
.etiqueta			{	display: inline-block;font-size: 13px; color:#1165AE;margin-right: 8px; margin-top: 10px;text-align: center;width: 87px;}
#enviar				{	float: right;padding:5px;}
.formLogin			{	display: block;	height:120px; margin: 50px auto 30px auto; width:265px; } 

a.loginnav:link		{	text-decoration: none;color:#5168B8; }
a.loginnav:visited	{	text-decoration: none;color:#5168B8; }
a.loginnav:hover	{	text-decoration: underline;color:#5168B8; }

a.loginnavover:link		{	text-decoration: underline;color:#5168B8; }
a.loginnavover:visited	{	text-decoration: underline;color:#5168B8; }
a.loginnavover:hover	{	text-decoration: underline;color:#5168B8; }
.boton_login{
		margin-right: 11px;
		margin-top: 20px;
		width:65px;
		height:29px;
		font-size: 13px;
		color:#FFFFFF;
		background-color:#1165AE;
		-webkit-border-radius: 10px;
	    -moz-border-radius: 10px;
	    -ms-border-radius: 10px;
	    border-radius: 10px;
	    behavior: url(/<?=APP_NAME?>/view/css/pie/PIE.php);
	    
}

.contenido_login{
		
		background-color:#FFFFFF;
		margin:20px auto;
		height:250px;
		width:550px;
		border: solid 1px #CCCCCC; 
		/*BORDES REDONDEADOS*/
	    -webkit-border-radius: 10px;
	    -moz-border-radius: 10px;
	    -ms-border-radius: 10px;
	    border-radius: 10px;
	    /*SOMBRA BORDES */
	    box-shadow: 0 0 5px 5px #AEAEAE;
	    -webkit-box-shadow: 0 0 5px 5px #AEAEAE;
	    -moz-box-shadow:  0 0 5px 5px #AEAEAE;
	     behavior: url(/<?=APP_NAME?>/view/css/pie/PIE.php);
}
	
/*  BOTTOM */
.bottom {
	clear:both;
	padding-top:50px;
	text-align:center;
}	
.bottom_img{
	margin:5px;
}		
.bottom_text{
	 margin:5px;
}
	    
TD.principalprehome	{	vertical-align:top; background: url(<?= $_parenDir."html/view/".$imagen_superpuesta  ?>) no-repeat;}

TABLE.princpalinterior {}
/*
TD.navizquierda		{	width:25%;vertical-align:top; padding-left:4px;padding-right:4px;
						background-color:<?=$interior_fondo?>; border-left:1px solid <?= $interior_borde?>; border-right:1px solid <?= $interior_borde?>;border-bottom:1px solid <?= $interior_borde?>;}
*/
/*
TD.contenido		{	width:<?= $prefs["tam_ancho_contenidos"] ?>px; 
						vertical-align:top; 
						background-color:#FFFFFF;
						border: solid 1px #CCCCCC; /*BORDES REDONDEADOS*/
    					-webkit-border-radius: 10px;
    					-moz-border-radius: 10px;
    					 -ms-border-radius: 10px;
    					border-radius: 10px;
    					/*SOMBRA BORDES */
    					box-shadow: 5px 5px 0 #333;
						-webkit-box-shadow: 5px 5px 0 #333;
   						-moz-box-shadow: 5px 5px 0 #333;
						// background-color:<?= $interior_fondo ?>; border-bottom:1px solid <?= $interior_borde?>;border-right:1px solid <?= $interior_borde?>;border-bottom:1px solid <?= $interior_borde?>;
						
					}
*/
TD.navderecha		{	width:<?= $prefs["tam_ancho_derecha"] ?>px; vertical-align:top; padding-left:8px;padding-right:4px;
						background-color:<?=$interior_fondo?>; border-right:1px solid #000000;}

/* NAVEGACIÓN */

.menusuperiortabla	{	height:16px;}
.menusuperior		{	font-size:10px; color:#ffffff; height:20px; padding-left:8px; padding-right:8px; cursor:pointer;}
.menusuperiorover	{	font-size:10px; color:#ffffff; height:20px; padding-left:8px; padding-right:8px; cursor:pointer;}

.menuinferiortabla	{	height:18px; border-left:1px solid <?= $interior_borde?>;  border-bottom:1px solid <?= $interior_borde?>;}
.menuinferior		{	font-size:10px; color:#ffffff; height:20px; padding-left:8px; padding-right:8px; cursor:pointer;font-weight=bold;}
.menuinferiorover	{	font-size:10px; color:#ffffff; height:20px; padding-left:8px; padding-right:8px; cursor:pointer;}

.menucabeceratabla	{	height:16px; background-color:#971605;}
.menucabecera		{	font-size:10px; color:#ffffff; height:20px; padding-left:8px; padding-right:8px; cursor:pointer;}
.menucabeceraover	{	font-size:10px; color:#ffffff; height:20px; padding-left:8px; padding-right:8px; cursor:pointer; font-weight:bold;}


.menuizquierdatabla	{	text-align:center;}
.menunivel0			{	font-size:12px; color:#1165AE; font-weight:bold; height:25px;  padding:4px;
						border-bottom:1px dotted #1165AE; cursor:pointer;}
.menunivel0over		{	font-size:12px; color:#1165AE; font-weight:bold; height:25px;  padding:4px;
						cursor:pointer;}
.menunivel0act		{	font-size:12px; color:#1165AE; font-weight:bold; height:25px;  padding-left:4px;
						border-bottom:1px solid #fbe18e;border-top:1px solid #ffffb8; cursor:pointer; }

.menunivel1			{	font-size:12px; color:#1165AE; font-weight:none; height:25px;  padding:4px;padding-left:14px; font-weight:bold;
						//border-bottom:1px solid #1165AE;
						}
.menunivel1over		{	font-size:12px; color:#1165AE; font-weight:bold; height:25px;  padding:4px;padding-left:14px;
						border-bottom:1px solid #fbe18e;
						border-top:1px solid #ffffb8; cursor:pointer;text-decoration:underline;}
.menunivel1act		{	font-size:12px; color:#1165AE; font-weight:bold; height:25px;  padding:4px;padding-left:14px;
						//border-bottom:1px solid #fbe18e;border-top:1px solid #ffffb8;
						 cursor:pointer;;}


.menunivel2			{	font-size:12px; color:#1165AE; font-weight:none; height:25px;  padding:4px;padding-left:24px;
						//border-bottom:1px solid #1165AE;
						}
.menunivel2over		{	font-size:12px; color:#1165AE; font-weight:none; height:25px;  padding:4px;padding-left:24px;
						border-bottom:1px solid #fbe18e;border-top:1px solid #ffffb8; cursor:pointer;}
.menunivel2act		{	font-size:12px; color:#1165AE; font-weight:bold; height:25px;  padding:4px;padding-left:24px;
						//border-bottom:1px solid #fbe18e;
						//border-top:1px solid #ffffb8;
						 cursor:pointer; font-family: italic;}

.linea_puntos{
	border-bottom:1px dotted #1165AE;
}

/* ENLACES DE NAVEGACIÓN */

/* ENLACES DE NAVEGACION  NUEVO*/
.maxHeight{
	max-height: 400px;
     /* max-height para IE6 */
    height: expresion(this.scrollHeight > 401? "400px": "auto");
	overflow-x:hidden;
	overflow-y:auto;
	width:100%;

}
.navegacion_izq {
	/*margin-left:0px;*/
	
}

.navegacion_izq li{
	padding:10px 0px; 	
	list-style:none;
	font-family:Tahoma;
	color:#1165AE;
	font-size:13px;
	
}
/*
.nav_izq_clasificacion_inactivo  li,.nav_izq_clasificacion_activo li{
	padding-top:10px;
	padding-bottom:0px;
	
}
*/

.navegacion_izq .nav_linea_separacion {
	display:block;
	margin:0;
	padding:0;
	border-bottom:2px dotted #1165AE;
	font-size:0px;
}
.nav_izq_nivel0_activo{
	font-weight:bold;
}
.nav_izq_nivel0_inactivo{

}
.nav_izq_nivel1_activo{
	font-weight:bold;
	display:block;
}

.nav_izq_nivel1_inactivo{
	display:none;

}

.navegacion_izq a:visited {
	font-family:Tahoma;
	color:#1165AE;
	font-size:13px;
	text-decoration:none;
	color:#1165AE;
}
.navegacion_izq a:hover {
	font-family:Tahoma;
	color:#1165AE;
	font-size:13px;
	text-decoration:none;
	color:#1165AE;
}
.navegacion_izq a:link {
	font-family:Tahoma;
	color:#1165AE;
	font-size:13px;
	text-decoration:none;
	color:#1165AE;
}
.imagen_nav_izq_mas{
	background:url('/<?=APP_NAME?>/view/img/ico_mas.png') no-repeat;
	float:left;
	width:9px;
	height:7px;
	margin-top:5px;
	
	padding-right:2px;
	cursor:pointer;
}
.imagen_nav_clasi_izq_mas{
	background:url('/<?=APP_NAME?>/view/img/ico_mas.png') no-repeat;
	float:left;
	width:9px;
	height:7px;
	margin-top:10px;
	padding-right:3px;
	cursor:pointer;
	margin-left:-3px;
}
.imagen_nav_clasi_izq_menos{
	background:url('/<?=APP_NAME?>/view/img/ico_menos.png') no-repeat;
	float:left;
	width:6px;
	height:7px;
	padding-right:3px;
	margin-top:13px;
	cursor:pointer;
	margin-left:-3px;
}
.imagen_nav_izq_menos{
	background:url('/<?=APP_NAME?>/view/img/ico_menos.png') no-repeat;
	float:left;
	width:9px;
	height:7px;
	padding-right:2px;
	margin-top:8px;
	cursor:pointer;
}
.nav_izq_clasificacion_activo a{
	font-weight:bold;
}
.nav_izq_clasificacion_inactivo a{
	font-weight:normal;
}
.nav_izq_clasificacion_activo .criterio_inactivo a.enlace_value{
	font-weight:normal;
}
.nav_izq_clasificacion_activo .criterio_activo a.enlace_value_activo{
	font-weight:bold;
}

.nav_izq_clasificacion_visible{
	display:block;
}
.nav_izq_clasificacion_invisible{
	display:none;
}

.nav_izq_class_lista_activo{
	margin-left:-20px;
	display:block;
}

.nav_izq_class_lista_inactivo{
margin-left:-20px;
	display:none;
}

.caja{
	/*border:1px solid #333;*/
	margin-left:10px;
	/*max-height:250px;
	overflow:auto;*/
	margin-left:12px;
}
.elemento_texto{
	margin-top:5px;
	margin-bottom:5px;
	margin-left:10px;
}
.elemento_cabecera{
	color:#94C0E6;
	font-family:Tahoma;
	font-weight:normal;
	font-size:12px;
}
.enlace_menuIzq_inactivo{
	font-weight:normal;
}
.enlace_menuIzq_activo{
	font-weight:bold;
}
.imagen_nav_izq_flecha_expan_vacio{
	background:url('/<?=APP_NAME?>/view/img/flecha_expan_vacio.png') no-repeat;
	width:9px;
	height:8px;
	float:left;
	margin-top:4px;
}
.imagen_nav_izq_flecha_noexpan_vacio{
	background:url('/<?=APP_NAME?>/view/img/flecha_noexpan_vacio.png') no-repeat;
	width:8px;
	height:9px;
	float:left;
	margin-top:4px;
}
.imagen_nav_izq_flecha_noexpan{
	background:url('/<?=APP_NAME?>/view/img/flecha_noexpan.png') no-repeat;
	width:8px;
	height:9px;
	float:left;
	margin-top:4px;
}
.imagen_nav_izq_flecha_expan{
	background:url('/<?=APP_NAME?>/view/img/flecha_expan.png') no-repeat;
	width:9px;
	height:8px;
	float:left;
	margin-top:4px;
}


.imagen_nav_izq_circulo_vacio{
	background:url('/<?=APP_NAME?>/view/img/ico_circulo_vacio.png') no-repeat;
	width:8px;
	height:9px;
	float:left;
	margin-top:4px;
}
.imagen_nav_izq_circulo{
	background:url('/<?=APP_NAME?>/view/img/ico_circulo.png') no-repeat;
	width:8px;
	height:9px;
	float:left;
	margin-top:4px;
}


/*************/
/* NAVEGACION SUPERIOR */
/**************/
.nav_sup{
	align:center;
	margin: 0 auto;
	float:left;
	display:block;
	width:100%;
}
.oculto{
	display:none;
}


.linea_subnivel{
	float:left;
	clear:both;
	border:1px solid #8DE7FB;
	background:#147DB6;
	color:#FFFFFF ;
	font-weight:normal ;	
	padding:3px;
	z-index:999999;
	width:150px;
	display:block;
}
.menu_sup_listadoclasificacion{
	border:1px dotted #333;

}

.linea_subnivel:hover{
	float:left;
	clear:both;
	border:1px solid #8DE7FB;
	background:#0A4B81;
	color:#FFFFFF ;
	font-weight:normal ;	
	padding:3px;
	width:150px;

}

a.menusuperiornav:link		{	text-decoration: none; color:#ffffff;}
a.menusuperiornav:visited	{	text-decoration: none; color:#ffffff;}
a.menusuperiornav:hover		{	text-decoration: none; color:#deb90e;}

a.menucabeceranav:link		{	text-decoration: none; color:#ffffff;}
a.menucabeceranav:visited	{	text-decoration: none; color:#ffffff;}
a.menucabeceranav:hover		{	text-decoration: none; color:#deb90e;}

a.menucabeceranavact:link		{	text-decoration: none; color:#deb90e;}
a.menucabeceranavact:visited	{	text-decoration: none; color:#deb90e;}
a.menucabeceranavqct:hover		{	text-decoration: none; color:#deb90e;}

a.menuinferiornav:link		{	text-decoration: none; color:#ffffff;}
a.menuinferiornav:visited	{	text-decoration: none; color:#ffffff;}
a.menuinferiornav:hover		{	text-decoration: none; color:#deb90e;}

a.menunivel0nav:link		{	text-decoration: none; color:#1165AE;}
a.menunivel0nav:visited		{	text-decoration: none; color:#1165AE;}
a.menunivel0nav:hover		{	text-decoration: underline; color:#1165AE;}

a.menunivel0navact:link		{	text-decoration: none; color:#1165AE;}
a.menunivel0navact:visited	{	text-decoration: none; color:#1165AE;}
a.menunivel0navact:hover	{	text-decoration: none; color:#1165AE;}

a.menunivel1nav:link		{	text-decoration: none; color:#1165AE;}
a.menunivel1nav:visited		{	text-decoration: none; color:#1165AE;}
a.menunivel1nav:hover		{	text-decoration: underline; color:#1165AE;}

a.menunivel1navact:link		{	text-decoration: none; color:#1165AE;}
a.menunivel1navact:visited	{	text-decoration: none; color:#1165AE;}
a.menunivel1navact:hover	{	text-decoration: underline; color:#1165AE;}

a.menunivel2nav:link		{	text-decoration: none; color:#1165AE;}
a.menunivel2nav:visited		{	text-decoration: none; color:#1165AE;}
a.menunivel2nav:hover		{	text-decoration: underline; color:#1165AE;}

a.menunivel2navact:link		{	text-decoration: none; color:#1165AE;}
a.menunivel2navact:visited	{	text-decoration: none; color:#1165AE;}
a.menunivel2navact:hover	{	text-decoration: underline; color:#1165AE;}

a.menuseccionesnivel0:link		{	text-decoration: none; color:#336699;}
a.menuseccionesnivel0:visited	{	text-decoration: none; color:#336699;}
a.menuseccionesnivel0:hover		{	text-decoration: underline; color:#336699;}

/* Introducido por javi  */
.menurecursostabla	{	text-align:left; background-color:<?=$interior_fondo?> ;
						border: 3px solid #5168B8;padding-left:4px;}

.menusecciones					{	font-size:11px; color:#FFFFFF; font-weight:bold; height:25px;  padding:4px ;padding-left:14px;
									border-bottom:1px solid #fbe18e;border-top:1px solid #ffffb8; cursor:pointer;}
.menuseccionesover				{	font-size:11px; color:#FFFFFF; font-weight:bold; height:25px;  padding:4px ;padding-left:14px;
									border-bottom:1px solid #fbe18e;border-top:1px solid #ffffb8; cursor:pointer;}
.menuseccionesact				{	font-size:11px; color:#FFFFFF; font-weight:bold; height:25px;  padding:4px ;padding-left:14px;
									border-bottom:1px solid #fbe18e;border-top:1px solid #ffffb8; cursor:pointer;}

.menuseccionesnivel0			{	font-size:12px; color:#FFFFFF; font-weight:bold; height:25px;  padding:4px;
									border-bottom:1px solid #fbe18e;border-top:1px solid #ffffb8; cursor:pointer;}
.menuseccionesnivel0over		{	font-size:12px; color:#FFFFFF; font-weight:bold; height:25px;  padding:4px;
									border-bottom:1px solid #fbe18e;border-top:1px solid #ffffb8; cursor:pointer;background-color:#5168B8;text-decoration:underline;}
.menuseccionesnivel0act			{	font-size:12px; color:#FFFFFF; font-weight:bold; height:25px;  padding-left:4px;
									border-bottom:1px solid #fbe18e;border-top:1px solid #ffffb8; cursor:pointer;background-color:#5168B8; }


.menuseccionesimpar				{	font-size:11px; color:#6DB66D; font-weight:bold; height:25px;  padding:4px ;padding-left:12px;
									border-bottom:1px solid #fbe18e;border-top:1px solid #ffffb8; cursor:pointer;}
.menuseccionesimparover			{	font-size:11px; color:#6DB66D; font-weight:bold; height:25px;padding:4px;padding-left:12px;
									border-bottom:1px solid #fbe18e;border-top:1px solid #ffffb8; cursor:pointer;background-color:#667AC1;}
.menuseccionesimparact			{	font-size:11px; color:#6DB66D; font-weight:bold; height:25px;padding:4px;padding-left:12px;
									border-bottom:1px solid #fbe18e;border-top:1px solid #ffffb8; cursor:pointer;background-color:#667AC1; }

.menurecursos					{	font-size:11px; color:#667AC1; font-weight:bold; height:25px;  padding:4px ;padding-left:1px;
									border-bottom:1px solid #fbe18e;border-top:1px solid #ffffb8;cursor:pointer;}
.menurecursosover				{	font-size:11px; color:#667AC1; font-weight:bold; height:25px;padding:4px;padding-left:1px;
									border-bottom:1px solid #fbe18e;border-top:1px solid #ffffb8; cursor:pointer;background-color:#FFFFCC}
.menurecursosact				{	font-size:11px; color:#667AC1; font-weight:bold; text-decoration:underline; height:25px; padding:4px;										border-bottom:1px solid #fbe18e;border-top:1px solid #ffffb8;padding-left:1px;background-color:#FFFFCC										cursor:pointer; }

.menurecursosimpar				{	font-size:11px; color:#6DB66D; font-weight:bold; height:25px;  padding:4px ;padding-left:1px;
									border-bottom:1px solid #fbe18e;border-top:1px solid #ffffb8;cursor:pointer;}
.menurecursosimparover			{	font-size:11px; color:#6DB66D; font-weight:bold; height:25px;padding:4px;padding-left:1px;
									border-bottom:1px solid #fbe18e;border-top:1px solid #ffffb8; cursor:pointer;background-color:#FFFFCC}
.menurecursosimparact			{	font-size:11px; color:#6DB66D; font-weight:bold; text-decoration:underline; height:25px; padding:4px;										border-bottom:1px solid #fbe18e;border-top:1px solid #ffffb8;padding-left:1px;background-color:#FFFFCC										cursor:pointer; }


.menuseccionespar				{	font-size:11px; color:#336633; font-weight:bold; height:25px;  padding:4px ;padding-left:14px;
									border-bottom:1px solid #fbe18e;border-top:1px solid #ffffb8; cursor:pointer;}
.menuseccionesparover			{	font-size:11px; color:#336633; font-weight:bold; height:25px;padding:4px;padding-left:14px;
									border-bottom:1px solid #fbe18e;border-top:1px solid #ffffb8; cursor:pointer;background-color:#667AC1;}
.menuseccionesparact			{	font-size:11px; color:#336633; font-weight:bold; height:25px;padding:4px;padding-left:14px;
									border-bottom:1px solid #fbe18e;border-top:1px solid #ffffb8; cursor:pointer;background-color:#667AC1; }

.menuseccionesnivel3			{	font-size:11px; color:#71830A; font-weight:bold; height:25px;  padding:4px ;padding-left:14px;
									border-bottom:1px solid #fbe18e;border-top:1px solid #ffffb8; cursor:pointer;}
.menuseccionesnivel3over		{	font-size:11px; color:#71830A; font-weight:bold; height:25px;padding:4px;padding-left:14px;
									border-bottom:1px solid #fbe18e;border-top:1px solid #ffffb8; cursor:pointer;background-color:#5168B8;}
.menuseccionesnivel3act			{	font-size:11px; color:#71830A; font-weight:bold; height:25px;padding:4px;padding-left:14px;
									border-bottom:1px solid #fbe18e;border-top:1px solid #ffffb8; cursor:pointer;background-color:#5168B8; }


a.menurecursosimparnav:link			{	text-decoration: none; color:#667AC1;;}
a.menurecursosimparnav:visited		{	text-decoration: none; color:#667AC1;;}
a.menurecursosimparnav:hover		{	text-decoration: underline; color:#667AC1;;}

a.menuseccionesnivel0nav:link		{	text-decoration: none; color:#000000;}
a.menuseccionesnivel0nav:visited	{	text-decoration: none; color:#E4E2B8;}
a.menuseccionesnivel0nav:hover		{	text-decoration: underline; color:#E4E2B8;}


a.menuseccionesimparnav:link		{	text-decoration: none; color:#FFFFFF;}
a.menuseccionesimparnav:visited	{	text-decoration: none; color:#FFFFFF;}
a.menuseccionesimparnav:hover		{	text-decoration: underline; color:#FFFFFF;}

a.menuseccionesparnav:link		{	text-decoration: none; color:#E25C77;}
a.menuseccionesparnav:visited	{	text-decoration: none; color:#E25C77;}
a.menuseccionesparnav:hover		{	text-decoration: underline; color:#E25C77;}

a.menuseccionesnivel3nav:link		{	text-decoration: none; color:#FFFFFF;}
a.menuseccionesnivel3nav:visited	{	text-decoration: none; color:#FFFFFF;}
a.menuseccionesnivel3nav:hover		{	text-decoration: underline; color:#FFFFFF;}

a.menuseccionesnivel4:link		{	text-decoration: none; color:#006699;}
a.menuseccionesnivel4:visited	{	text-decoration: none; color:#006699;}
a.menuseccionesnivel4:hover		{	text-decoration: underline; color:#006699;}

/*

.textonormal					{ font-size:11px; color:#71830A;font-family: Verdana, Helvetica, Arial, sans-serif; color: #000000;}
*/
a.textonormalnav:link					{ color:#5168B8;}
a.textonormalnav:visited					{ color:#5168B8;}
a.textonormalnav:hover					{ color:#5168B8;}
/* Fin introducido por javi  */


		

/* BLOQUES BUSCADOR, CLIENTES, COMPRA ACTUAL */
.bloquetitulo		{	font-size:10px; color:#5168B8; font-weight:bold;  padding-left:4px;padding-right:4px;padding-top:2px;
						padding-bottom:2px;text-align:center; border-bottom:1px solid #fbe18e;}
.bloqueinterior		{	border-top:1px solid #5168B8;}
.bloqueinteriortexto{	font-size:10px; color:#5168B8; height:20px; padding-left:4px;padding-right:4px;padding-top:4px;}

SELECT.buscador		{	width:130px;background-color:#ffffff;border:1px solid #d4d4d4;text-align:left;font-size:10px;}
INPUT.buscador		{	width:100px;background-color:#ffffff;border:1px solid #d4d4d4;text-align:left;font-size:10px;}
INPUT.loginpassword	{	width:70px;background-color:#e0e0e0;border:1px solid #d4d4d4;text-align:left;font-size:10px;}
INPUT.compraactual	{	width:40px;background-color:#e0e0e0;border:1px solid #d4d4d4;text-align:left;font-size:10px;}


/* DESTACADOS */
.destacadolateraltabla	{	background:url(<?= $_parenDir ?>img/fondo_destacados.gif) no-repeat right top; background-color:#e5d2aa; 
							border-left:1px solid <?=$bloque_borde?>; border-bottom:1px solid <?=$bloque_borde?>;border-right:1px solid <?=$bloque_borde?>;}
.destacadolateraltitulo	{	text-align:center; 	padding:4px; font-size:10px; color:#6d3605; font-weight:bold;}
.destacadolateralimagen	{	text-align:center;padding-bottom:4px;}
.destacadolateraltexto	{	font-size:10px; text-align:center; padding-top:0px;padding-bottom:4px;padding-left:8px;padding-right:8px; 
							color:#6d3605; font-weight:normal;}

.destacadodoblebloque	{	height:20px;color:#ffffff;font-weight:normal;font-size:10px; padding-left:6px;
							background:url(<?= $_parenDir ?>img/noticias-destacadas-filas.gif) no-repeat right;}
.destacadodobletabla	{	border-top:1px solid #ffffff; border-left:1px solid #ffffff;border-bottom:1px solid #8f9ba8; 
							border-right:1px solid #8f9ba8;	background-color:#f5f5f5;}
.destacadodobleimagen	{	color:#000000; vertical-align:top;}
.destacadodobletitulo	{	font-size:10px; color:#000000; font-weight:bold; padding-top:0px; padding-bottom:0px; padding-left:8px;										padding-right:8px; }
.destacadodobletexto	{	color:#000000; vertical-align:top; padding-left:8px; padding-right:8px; padding-bottom:4px;  font-weight:normal;}

.destacadotriplebloque	{	height:20px;color:#ffffff;font-weight:normal;font-size:10px; padding-left:6px;
							background:url(<?= $_parenDir ?>img/noticias-destacadas-filas.gif) no-repeat right;}
.destacadotripletabla	{	border-top:1px solid #ffffff; border-left:1px solid #ffffff;border-bottom:1px solid #8f9ba8; 
							border-right:1px solid #8f9ba8;	background-color:#f5f5f5;}
.destacadotripleimagen	{	color:#000000; vertical-align:top;}
.destacadotripletitulo	{	font-size:10px; color:#000000; font-weight:bold; padding-top:0px; padding-bottom:4px; padding-left:8px;										padding-right:8px; }
.destacadotripletexto	{	color:#000000; vertical-align:top; padding:6px;	font-weight:normal;}

/* ENLACES DE DESTACADOS */

a.destacadolateralnav:link		{	text-decoration: none; color:#6d3605;}
a.destacadolateralnav:visited	{	text-decoration: none; color:#6d3605;}
a.destacadolateralnav:hover		{	text-decoration: underline; color:#6d3605;}

a.destacadodoblenav:link	{	text-decoration: none; color:#000000;}
a.destacadodoblenav:visited	{	text-decoration: none; color:#000000;}
a.destacadodoblenav:hover	{	text-decoration: underline; color:#6d3605;}

a.destacadotriplenav:link	{	text-decoration: none; color:#000000;}
a.destacadotriplenav:visited	{	text-decoration: none; color:#000000;}
a.destacadotriplenav:hover	{	text-decoration: underline; color:#6d3605;}


/* FIN DESTACADOS */

/* VARIOS */
.paginaactiva			{	font-size:11px; color:#fe9601;border-bottom:1px solid #feba01;padding-bottom:4px;} 
.paginacion				{	font-size:10px; color:#9f9f9f;border-bottom:1px solid #feba01;padding-bottom:4px;} 


/*ARTICULOS*/

.lsproductotr			{	background-color:; padding:;}

.lsproductotexto		{	background-color:;padding-left:10px; vertical-align:top;}
.lsproductoimagen		{	background-color:;vertical-align:top; width:<?= $prefs["tam_imagen_listado"]+10 ?>px;}

.lsproductotitulo		{	font-size:11px; line-height: 1.4em; color:#000000; font-weight:bold;}
.lsproductomarca		{	font-size:10px; line-height: 1.4em; color:#000000; font-weight:normal;}
.lsproductodescripcion	{	font-size:10px; line-height: 1.4em; color:#000000;}
.lsproductoprecio		{	font-size:10px; line-height: 1.4em; color:#000000; font-weight:normal;}

.productobloque			{	height:20px;color:#ffffff;font-weight:normal;font-size:10px; padding-left:6px;
							background:url(<?= $_parenDir ?>img/noticias-destacadas-filas.gif) no-repeat right;}
.separacionproducto		{	background-color:#e6e6e6;}
.productotitulo			{	font-size:11px; line-height: 1.4em; color:#000000; font-weight:bold;}
.productoreferencia		{	font-size:10px; line-height: 1.4em; color:#000000; font-weight:normal;}
.productodescripcion	{	font-size:10px; line-height: 1.4em; color:#000000;}
.productoimagen			{	border:1px solid #E2E2E2;}

.productotablaprecio	{	font-weight:normal; color:#16284c; border:1px solid #7f9ce0; padding:4px;}
.productoprecio			{	font-weight:bold; color:#16284c; padding:4px;vertical-align:top;}
.productocesta			{	font-weight:normal; color:#16284c; padding:4px;width:220px;vertical-align:top; text-align:right;}

/*NOTICAS*/
.bloquenoticiasdestacadas	{	font-size:11px; color: #ffffff; background-color:#fe9601; 
								font-weight:bold; height:20px;	padding-left:4px; padding-right:4px;}
.noticiabloque				{	padding:4px;}
.noticiatitulo				{	font-size:11px; color:#000000; font-weight:bold;}
.noticiaresumenhome			{	font-size:10px; color:#666666; font-weight:normal;}
.noticiaresumen				{	font-size:11px; color:#666666; font-weight:normal;}
.noticiafecha				{	font-size:10px; color:#000000; font-weight:normal;}
.noticiacontenido			{	font-size:11px; color:#000000; font-weight:normal;}

/*FAQS*/
.faqsbloque					{	}
.faqsnumero					{	font-size:10px;  font-weight:normal; color:#BBBBBB; vertical-align:top;}
.faqspregunta				{	font-size:10px;  font-weight:bold; vertical-align:top; padding-bottom:2px;}
.faqspregunta2				{	font-size:10px;  font-weight:normal; vertical-align:top;}
.faqsrespuesta				{	padding:4px; font-size:10px;  font-weight:normal; border:1px solid #CECECE;}

a.faqsnav:link				{	text-decoration: none; color:#971605;}
a.faqsnav:visited			{	text-decoration: none; color:#971605;}
a.faqsnav:hover				{	text-decoration: underline; color:#971605;}

/*PAGINAS*/
.titulopagina				{	font-family:Tahoma;font-size:12px; color:#1165AE; font-weight:bold;border-bottom:2px dotted #999999;
								padding-top:10px;padding-left:10px;padding-right:10px;padding-bottom:3px; margin:3px;}
.contenidopagina			{	padding:0px;}
.contenidoIframe_pagina {
		height:640px;
}

.puntos_inf					{	margin: 0px 5px 0px 5px; border-bottom:1px dotted #999999; width:95%;

}

/* VARIO */
.historial				{	height:20px;color:#ffffff;font-weight:normal;font-size:10px; padding-left:6px;
							background:url(<?= $_parenDir ?>img/historial-logo01.gif) no-repeat right;}

.noticiasfometit		{	height:20px;color:#ffffff;font-weight:normal;font-size:10px; padding-left:6px;
							background:url(<?= $_parenDir ?>img/noticias-destacadas-filas.gif) no-repeat right;}


/* CARRITO - PROCESO DE COMPRA*/
.gridcarrito			{	padding-left:4px;padding-right:4px;height:20px;color:#ffffff;font-weight:bold;font-size:10px;
							background-color: #313f42; border-top:1px solid #971605; border-bottom:1px solid #971605;}
.itemcarritopar			{	padding:4px;color:#000000;font-weight:normal;font-size:10px;background-color: #ffffff;
							border-bottom:1px solid #D6D6D6;border-right:1px solid #F2F2F2;}
.itemcarritoimpar		{	padding:4px;color:#000000;font-weight:normal;font-size:10px;background-color: #F2F2F2;
							border-bottom:1px solid #D6D6D6;border-right:1px solid #ffffff;}
.comprapasoactivo		{	font-size:10px;font-weight:bold;height:23px;background-color:#feba01; color:#000000;}
.comprapasonoactivo		{	font-size:10px;font-weight:bold;height:23px;background-color:#feba01; color:#ffffff;}
.epigrafeform			{	font-size: 10px; font-family:  Verdana, Arial, Helvetica, sans-serif; color: #000000;}
.formvalor				{	font-size: 10px; font-family:  Verdana, Arial, Helvetica, sans-serif; color: #000000;}
.bloqueform				{	font-size: 11px; font-family:  Verdana, Arial, Helvetica, sans-serif; color: #971605;
							border-bottom:1px solid #E2E2E2;font-size:11px;font-weight:bold;}
INPUT.formlargo			{	font-size: 10px;width:280px;}
INPUT.formmedio			{	font-size: 10px;width:90px;}
INPUT.formcorto			{	font-size: 10px;width:45px;}
INPUT.boton				{	font-size: 10px; font-family:  Verdana, Arial, Helvetica, sans-serif; color:#000000; 
							border:1px solid #000000;background: url(<?= $_parenDir ?>img/fondo_boton.gif); height:16px;padding:0px; cursor:pointer;} 
.pasosbloque			{	border-bottom:1px solid #B1B1B1;font-size:11px;font-weight:bold;color:#971605;padding-top:3px;}
.explicacioncompra		{	font-size: 10px; font-family:  Verdana, Arial, Helvetica, sans-serif; color: #666666; text-align:center}
.ayuda					{	font-size: 10px; font-family:  Verdana, Arial, Helvetica, sans-serif; color: #666666; text-align:center}
.req					{	color:#990000;}

.formtitulo				{	background-color:#000000;color:#ffffff;font-size:11px;font-weight:bold;text-align:right;vertical-align:bottom;
							padding-right:6px;padding-bottom:3px;}

.transition { position:absolute; left: 0px; width: 505px;  height:340px;  filter:progid:DXImageTransform.Microsoft.Fade(duration=2.0,overlap=1.0) }

.prehome						{ color:#ffffff;}


/* FICHA DATOS */

.boxhead{
	margin:0;
	border: 1px solid #9A9A9A;
	width:110px;
	height:10px;
	background: #116DB0;
	
	-webkit-border-radius: 8px 8px 0px 0px;
	-moz-border-radius: 8px 8px 0px 0px;
	-ms-border-radius: 8px 8px 0 0;
	border-radius: 8px 8px 0px 0px;	
	behavior: url(/<?=APP_NAME?>/view/css/pie/PIE.php);
	text-align: center; 
	color: white; 
	padding:2px 4px 4px 4px;
	font-weight: bold; 
	font-size: 9px;
	font-family:Tahoma;
	
	-webkit-box-shadow: #666 0px 0px 10px;
	-moz-box-shadow: #666 0px 0px 10px;
	box-shadow: #666 0px 0px 10px;
	behavior: url(/<?=APP_NAME?>/view/css/pie/PIE.php);
	
}

.boxbody {
	margin:0;	
	width:119px; 
	/*height:60px;*/
	overflow-y:hidden;
	-webkit-border-radius:  0px 0px 8px 8px;
	-moz-border-radius:  0px 0px 8px 8px ;
	-ms-border-radius:0px 0px 8px 8px ;
	border-radius: 0px 0px 8px 8px ;
	-webkit-box-shadow: #666 0px 0px 10px;
	-moz-box-shadow: #666 0px 0px 10px;
	box-shadow: #666 0px 0px 10px;
	behavior: url(/<?=APP_NAME?>/view/css/pie/PIE.php);
}
.sidebox {
	//margin: 0 auto; /* center for now */
	margin: 0px 10px 3px 10px;
}

.caja_buscador{
	margin:10px;
	border-bottom:2px dotted #999999;
}
.buscador {
	/*float:left; */
	margin:30px;
}
.buscador_img_izq{
	margin-top:3px;
	float:left;
	/*margin-right:5px;*/
	float:left;
	/*width:50px;*/
}
.img_pag_izq_act{
	float:left;
	background:url('img/ico_flecha_izqda.png') no-repeat;
	width:8px;
	height:9px;
	border:0;
	margin-top:3px;
	margin-right:2px;
}
.img_pag_izq_des{
	float:left;
	background:url('img/ico_flecha_izqda_gris.png') no-repeat;
	width:8px;
	height:9px;
	border:0;
	margin-top:3px;
	margin-right:2px;
}
.text_paginacion {
	float:left;
}
.img_pag_der_act{
	float:left;
	background:url('img/ico_flecha_dcha.png') no-repeat;
	width:8px;
	height:9px;
	border:0;
	margin-top:4px;
	margin-left:2px;
}

.img_pag_der_des{
	float:left;
	background:url('img/ico_flecha_dcha_gris.png') no-repeat;
	width:8px;
	height:9px;
	border:0;
	margin-top:3px;
	margin-left:2px;
}

.buscador_img_izq2{
	margin-top:6px;
	margin-right:15px;
	float:left;
}
.buscador_texto_izq{
	margin-left:5px;
	margin-right:5px;
	padding-top:3px;
	float:left;
}
.buscador_img_dcha{
	margin-top:2px;
	float:left;
}
.buscador_img_dcha2{
	margin-left:15px;
	margin-top:3px;
	float:left;
}

#input_entrada_buscador_vo{
	width: 375px;
	height:<? if($seleccion=="1"){?>25px <? }else{?>19px<?}?>;	
	overflow-y:auto;
	overflow-x:hidden;
}
#btn_entrada_buscador_vo.ui-button-text {
	padding: 0px;	
}

.vo_icono{
	/*margin : 10px 289px;	*/
	float:right;
	margin-top:<?if($seleccion != ""){ ?>15px; <? } else{?>-20px;<? }?>
	margin-right:<?if($seleccion != ""){ ?>205px; <? } else{?>10px;<? }?>
	/*border-right:2px dotted #999999;*/
}
.ico_ver_mas{
	margin-left:35px;
	font-weight: bold; 
	font-size: 10px;
	font-family:Tahoma; 
	margin-bottom:5px;
	
}

.vo_datos{
	float:left;
	margin-left:10px;
}

.vo_titulo{
	margin: 5px 0px 10px 10px;
  	font-family:Verdana;
  	font-size: 12px;
	font-weight:bold;
	color:#1165AE;
	float:left;
	width:150px;
}

 /* PESTAÑAS*/
.cajadatos{
	clear:both;
	padding-left:10px;
	margin-top:-1px;
	padding-top:10px;
	border: solid 1px #CCCCCC; 
    -webkit-border-radius:0px 0px 10px  10px;
    -moz-border-radius: 0px 0px 10px  10px;
    -ms-border-radius:0px 0px 10px  10px;
    border-radius: 0px 0px 10px  10px;   
    background:white;

    behavior: url(/<?=APP_NAME?>/view/css/pie/PIE.php);
}
.linea_dato_icono{
	float:left;
}

.linea_dato{
	margin-top:10px;
	margin-bottom:10px;
	margin-right:10px;
	clear:both;
	text-align:left;

}


.cabecera_titulo_rec{
  	font-family:Verdana;
  	font-size: 12px;
	/*font-weight:bold;*/
	float:left;
}
.cabecera_texto_rec{
	float:left;
  	font-family:Verdana;
  	font-size: 12px;
	/*font-weight:bold;*/
}
.texto_sinValor{
  	font-family:Verdana;
  	font-size: 12px;
	font-weight:bold;
	padding:10px;
}
.cabecera_titulo{
	float:left;
	clear:both;
  	font-family:Verdana;
  	font-size: 12px;
	font-weight:bold;
}
.cabecera_texto{
	float:left;
  	font-family:Verdana;
  	font-size: 12px;
	font-weight:bold;
	margin-left:10px;
}

.cabecera_titulo_nivel1, .cabecera_titulo_nivel1_x{
	float:left;
	/*clear:both;*/
	text-align:left;
  	font-family:Verdana;
  	font-size: 12px;
	font-weight:bold;
	margin-bottom:0px;
	text-align:left;
}

.cabecera_texto_nivel1{
		float:left;
	  font-family: Verdana;
	  font-size: 13px;
	  margin-left: 20px;
	  font-style:italic;
	  color:#333;
	  text-align:left;
}
.cabecera_texto_nivel1_textData{
	/*float:left;*/
  	font-family: Verdana;
  	font-size: 13px;
  	color:#333;
  	margin-left:20px;
	overflow-x:hidden;
  	overflow-y:auto;
  	z-index:1;
    max-height: 273px;
     /* max-height para IE6 */
    height: expresion(this.scrollHeight > 277? "276px": "auto");
    font-style:italic;
    text-align:left;

}
.iframe_textData{
	border:0;
	width:100%;
	min-height: 12px;
	max-height: 276px;
	float:left;
	scroll:hidden;
     /* max-height para IE6 */
    height: expresion(this.scrollHeight > 277? "276px": "auto");
	z-index:1;
  	margin-top:-7px;
  	color:#333;
  	
}

.cabecera_titulo_nivel2, .cabecera_titulo_nivel2_x{
	float:left;
	/*clear:both;*/
	font-family: Verdana;
  	font-size: 12px;
  	text-align:left;
}
.cabecera_texto_nivel2{
	float:left;
  	font-family: Verdana;
  	font-size: 13px;
  	margin-left:20px;
  	font-style:italic;
  	color:#333;
  	text-align:left;
}

.cabecera_texto_nivel2_textData{
	/*float:left;*/
  	font-family: Verdana;
  	font-size: 12px;
  	color:#333;
  	overflow-x:hidden;
  	overflow-y:auto;
  	z-index:1;
  	margin-left:20px;
    max-height: 273px;
     /* max-height para IE6 */
    height: expresion(this.scrollHeight > 277? "273px": "auto");
    text-align:left;
    clear:both;
    

}
.img_ov_negrox{
	background:url('/<?=APP_NAME?>/view/img/LeafRowHandle.png') no-repeat transparent;
	width:9px;
	height:9px;
	float:left;
	clear:both;
	border:0;
	margin:5px;
}
.img_ov_grisx{
	background:url('/<?=APP_NAME?>/view/img/LeafRowHandle_gris.png') no-repeat transparent;
	width:9px;
	height:9px;
	float:left;
	clear:both;
	border:0;
	margin:5px;
}
.cabecera_titulo_x{
  font-family: Verdana;
  font-size: 12px;
  font-weight:bold;
  float:left;
}

.pestannas{
	background-color: #DBE3E6;
    height: 34px;
}
.pestannas ul{
	height: 34px;
    letter-spacing: normal;
    list-style-type: none;
    margin: 0;
    outline: medium none;
    padding: 0px 0 0 25px;
    text-align: center;
    word-spacing: normal;
}
.pestannas ul li {
    float: left;
    height: 34px;
    margin-right: 10px;
    width: auto;
}

.pestannas ul li a:hover, .pestannas ul li a.actual {
    background-position: center bottom;
    color: A0A0A0;
}

.pestannas ul li a {
    background: url("../img/pestanna_cent.gif") repeat-x scroll center top transparent;
    color: #194879;
    display: block;
    height: 34px;
    width: 150px;
}

.pestannas ul li a:hover span, .pestannas ul li a.actual span {
    background-position: left bottom;
    cursor: pointer;
}

.pestannas ul li a span {
    background: url("../img/pestanna_izq.gif") no-repeat scroll left top transparent;
    display: block;
    height: 34px;
}

.pestannas ul li a:hover span span, .pestannas ul li a.actual span span {
    background-position: right bottom;
}

.pestannas ul li a span span {
    background: url("../img/pestanna_der.gif") no-repeat scroll right top transparent;
    height: 34px;
    line-height: 40px;
    padding-left: 0;
}

.pestanasuperioractiva{
	margin-bottom:-2px;
	float:left;
	width:98px;
	height:13px;
	padding:3px;
	 font-weight:bold;
	 font-family: Verdana;
  	font-size: 11px;
	 color:#E25C77;
	background:url('/<?=APP_NAME?>/view/img/pestana.png') no-repeat;	
}
.pestanasuperiorinactiva{
	margin-bottom:-1px;
	float:left;
	width:98px;
	height:13px;
	padding:3px;
	font-family: Verdana;
  	font-size: 11px;
  	font-weight:bold;
  	color:#666666;
	background:url('/<?=APP_NAME?>/view/img/pestana_des.png') no-repeat;
}s

.pestanasuperioractiva a:link,.pestanasuperioractiva a:visited,.pestanasuperioractiva a:hover{
	padding:3px;
	color:#1165AD;
	font-family:Verdana;
	font-size:11px;
	font-weight:bold;
	text-decoration:none;
}
 .pestanasuperiorinactiva a:link,.pestanasuperiorinactiva a:visited{
	padding:3px;
	color:#8D8D8D;
	font-family:Verdana;
	font-size:11px;
	font-weight:bold;
}


.pestanasuperiorinactiva:hover{
	margin-bottom:-1px;
	background:url('/<?=APP_NAME?>/view/img/pestana.png');
	
}

.text_pestana{
	padding-top:3px;
	margin-top:3px;
	clear:both;
}

/********************/
/* PESTAÑA RECURSOS */
/********************/
.recurso_elem{
	padding:10px;
	margin-bottom:15px;
	
}
.recurso_pestana_sup{
	margin-bottom:-5px;
	margin-left:10px;
	padding:5px 10px;
	width:300px;
	border:1px solid #CCCCCC;
	-webkit-border-radius: 8px;
	-moz-border-radius: 8px;
	border-radius: 8px;
	-webkit-box-shadow: #666 0px 2px 3px;
	-moz-box-shadow: #666 0px 2px 3px;
	box-shadow: #666 0px 2px 3px;
	background: #FFFFFF;
	behavior: url(/<?=APP_NAME?>/view/css/pie/PIE.php);
	
	
}
.recurso_pestana_inferior{
/*	margin-top:-5px;*/
	border:1px solid #CCCCCC;
	-webkit-border-radius: 8px;
	-moz-border-radius: 8px;
	border-radius: 8px;
	-webkit-box-shadow: #666 0px 2px 3px;
	-moz-box-shadow: #666 0px 2px 3px;
	box-shadow: #666 0px 2px 3px;
	background: #FFFFFF;
	behavior: url(/<?=APP_NAME?>/view/css/pie/PIE.php);
	width:750px;
	padding:10px;
}

.imagen_recurso{	
	position:relative;
	/*float:left;*/
	width:100; 
	overflow-y:hidden;
	margin-left:10px;
	padding:10px;	
	border:0;
}


.recurso_bloque_hijo{
	width:550px;
	float:left;
	clear:both;
	padding:10px;

}
.tipo_recurso{
	width:125px;
	float:left;
	font-family: Tahoma;
  	font-size: 12px;
  	/*font-weight:bold;*/
	
}

.vo_caja_editar{
	float:left;
	margin:20px 30px 10px 20px;
	width:300px;
	
}
.linea_dato_recurso{
	clear:both;
	margin-top:5px;
	margin-bottom:10px;
	margin-right:10px;
	/*width:450px;*/
}

.cab_recurso_titulo_nivel1{
	clear:both;
	width:200px;
	margin-left:10px;
	font-family:Verdana;
  	font-size: 12px;
	
	float:left;
	
}
.cab_recurso_texto_nivel1{
	clear:both;
	width:175px;
	margin-left:10px;
	font-family:Verdana;
  	font-size: 12px;
	float:left;
	
}



.textonormal					{ font-size:11px; color:#71830A;font-family: Verdana, Helvetica, Arial, sans-serif; color: #000000;}



/*
.busqueda_bloque {	position: absolute; display: block; width:368px; overflow:auto; border:1px solid #D3D9DF; align:left; z-index: 100; background-color: #FFFFFF; padding:5px; left:10px}
.busqueda_linea	{	width:350px; text-align:left;   background-color: #FFFFFF; z-index: -1; cursor:pointer; }
.busqueda_linea:hover	{	width:350px; overflow: hidden;  text-align:left; background-color: #e1eafe; z-index: -1;}



#input_entrada_buscador_vo1{
	width: 375px;	
	height:25px;
}



#btn_entrada_buscador_vo1 .ui-button-text {
	padding: 0px;	
}

*/


/* BUSQUEDAS */
.boton_buscar{
	background:url('/<?=APP_NAME?>/view/img/btn_buscar.png') no-repeat;
	width:75px;
	height:26px;
	border:0;
}

.imagen_busqueda{
	paddign:5px;
	float:left;
	/*float:right;*/
	margin-right:10px;
	margin-bottom:10px;
}

/* alfredo 140811 */
.imagen_busqueda_campos{
	paddign:5px;
	float:right;
	margin-left:10px;
	margin-right:10px;
	margin-bottom:10px;
}

.busqueda_id{
	font-family: Tahoma;
  	font-size: 12px;
  	font-weight:bold;
  	color:#1165AE;
}
.busqueda_datos{
	margin-right:100px;
	margin-left:10px;

  	
}

.clasificacion_datos{
	margin-right:-190px;
	margin-left:10px;

  	
}

.busqueda_datos_titulo{
    margin-right:3px;
  	font-size: 12px;
	font-weight:bold;
	font-family: Tahoma;
}
.busqueda_datos_texto{
  	
  	font-size: 12px;
	font-family: Tahoma;
	
}

.busqueda_ver_mas{
	clear:both;
	margin-left:750px;
	margin-top:-20px;
	width:160px;
	font-family: Verdana;
  	font-size: 11px;
  	font-weight:bold;
	color:#1165AE;
}

.clasificacion_ver_mas{
	clear:both;
	margin-left:10px;
	margin-top:-20px;
	width:160px;
	font-family: Verdana;
  	font-size: 11px;
  	font-weight:bold;
	color:#1165AE;
}

.paginacion_busqueda_pag{
	font-size:10px; color:#9f9f9f; padding-bottom:4px;
	width:100px;
}
.paginacion_paginas{
	width:150px;
	margin-left:150px;
	float:left;

}
.paginacion_paginas_img{
	width:200px;
	margin-left:130px;
	float:left;
}
.paginacion_select{
	float:left;
	position:absolute;
	margin-left:160px;
}
.paginacion_resultados{
	float:left;
	width:150px;
	margin-left:10px;
}
.paginacion_enlaces{
	float:left;
}
.fila_busqueda{
	padding:10px;
	border-bottom:2px dotted #999999;
}
.busqueda_paginacion_sup{
	margin-top:10px;
	margin-bottom:10px;
	padding:5px 10px 5px 10px;
	border-bottom: 2px dotted #999999;
	background: #FFFFFF;
	behavior: url(/<?=APP_NAME?>/view/css/pie/PIE.php);
	padding-bottom:10px;
}
.busqueda_paginacion_inf{
	margin-bottom:10px;
	padding:5px 10px 50px 10px;
}


/*** CLEARFIX ***/

.clearfix:after
{
    content: " ";
    display: block;
    height: 0;
    clear: both;
    visibility: hidden;
}

#fecha.clearfix
{
    display: inherit;
}

/* Hides from IE-mac \*/
* html .clearfix {height: 1%;}
.clearfix {display: block;}

/* CLASIFICACION */

.campos_clasificacion{
	border-bottom:2px dotted #999999;
	padding:10px;
}
.clasificacion_inputs_unicos{
	padding:10px;
	width:100%;
	margin:10px auto;
}
.selector{
	height: 25px;
    width: 150px;

}
.clasificacion_elem{
	float:left;
	font-family:tahoma;
	font-size:10px;
}
.clasificacion_linea{
	clear:both;
	width:80px;
	float:left;
	height:12px;
   	vertical-align: middle;
	text-align:right;
	margin:auto 0;
	font-family:tahoma;
	font-size:10px;
}
.clasificaicon_input{
	float:left;
	padding-left:5px;
	width:180px;
	margin-bottom:5px;
	
}
.clasi_subtitulo{
	clear:both;
	padding: 8px 5px 8px 0px;
	font-size:10px;
	font-weight:bold;
	width:180px;
}


.clasificacion_caja{
	float:left;
	width: 265px;	
	margin:0px 10px 25px 0px;
}


/**MAQUETACION COMBOBOX **/
.ui-autocomplete-input{
	height: 19px;
}
.ui-button {
	
	z-index:1;
}

ui-button
        {
            margin-left: -1px !important;
            margin-top: 5px;
            margin-right: auto;
        }
        .ui-button-icon-only .ui-button-text
        {
            padding: 1px !important;
            height: 16px !important;
        }
        .ui-autocomplete-input
        {
            padding-top: 2px !important;
            padding-right: auto !important;
            padding-bottom: 2px !important;
            padding-left: 0px !important;
            border-top: 1px solid #ADADAD !important;
            border-bottom: 1px solid #E7E7E7 !important;
            border-left: 1px solid #E7E7E7 !important;
            text-indent: 3px !important;
        }
        
        .ui-button-icon-only
        {
            width: 23px !important;
            height: 25px !important;
        }
        
       

/*****************/
/**TABLA BUSCADOR**/
/*****************/

.tabla_buscador{
	width:830px;

}
.busc_img{	
	float:right;
}
.busc_titulo_principal{
	font-family:Verdana;
	font-size:13px;
	font-weight:bold;
	padding-top:10px;
}
.busc_titulo{
	font-family:Tahoma;
	font-size:12px;
	margin-left:10px;
}

.selectcorto {
	width:45px;

}
.selectlargo{
	width:400px;

}
.inputlargo{
	width:400px;
}
.selectfecha{
	width:375px;
}
.img_cal{
	padding-top:2px;
}

.busc_input{
	width:495px;
}
