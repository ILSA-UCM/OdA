


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
					
					

//TD.principal		{	vertical-align:top; background: url(<?= $_parenDir."html/view/".$imagen_superpuesta ?>) no-repeat;}

/* CABECERA */
.header		{   
			margin-left: 20px;
		    margin-right: 0;
		    padding-top:10px;
		   
		    /* background: url('/<?=APP_NAME?>/view/img/cabecera.png') no-repeat;*/
		    vertical-align:top; 
		 
		  
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
	    /*TAMA�O MAXIMO IMAGNES */
	    max-width:810px;
   		width: expression(this.width > 790 ? 790: true);
}


/* LOGIN */

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

	    
TD.principalprehome	{	vertical-align:top; background: url(<?= $_parenDir."html/view/".$imagen_superpuesta  ?>) no-repeat;}



TD.navderecha		{	width:<?= $prefs["tam_ancho_derecha"] ?>px; vertical-align:top; padding-left:8px;padding-right:4px;
						background-color:<?=$interior_fondo?>; border-right:1px solid #000000;}

/* NAVEGACI�N */


.menuinferiortabla	{	height:18px; border-left:1px solid <?= $interior_borde?>;  border-bottom:1px solid <?= $interior_borde?>;}


/* ENLACES DE NAVEGACI�N */

/* ENLACES DE NAVEGACION  NUEVO*/
.maxHeight{
	max-height: 400px;
     /* max-height para IE6 */
    height: expresion(this.scrollHeight > 401? "400px": "auto");
	overflow-x:hidden;
	overflow-y:auto;
	width:100%;

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


/* Introducido por javi  */
.menurecursostabla	{	text-align:left; background-color:<?=$interior_fondo?> ;
						border: 3px solid #5168B8;padding-left:4px;}




/* DESTACADOS */
.destacadolateraltabla	{	background:url(<?= $_parenDir ?>img/fondo_destacados.gif) no-repeat right top; background-color:#e5d2aa; 
							border-left:1px solid <?=$bloque_borde?>; border-bottom:1px solid <?=$bloque_borde?>;border-right:1px solid <?=$bloque_borde?>;}

.destacadodoblebloque	{	height:20px;color:#ffffff;font-weight:normal;font-size:10px; padding-left:6px;
							background:url(<?= $_parenDir ?>img/noticias-destacadas-filas.gif) no-repeat right;}

.destacadotriplebloque	{	height:20px;color:#ffffff;font-weight:normal;font-size:10px; padding-left:6px;
							background:url(<?= $_parenDir ?>img/noticias-destacadas-filas.gif) no-repeat right;}

/* ENLACES DE DESTACADOS */


/* FIN DESTACADOS */

/* VARIOS */

/*ARTICULOS*/

.lsproductoimagen		{	background-color:;vertical-align:top; width:<?= $prefs["tam_imagen_listado"]+10 ?>px;}


.productobloque			{	height:20px;color:#ffffff;font-weight:normal;font-size:10px; padding-left:6px;
							background:url(<?= $_parenDir ?>img/noticias-destacadas-filas.gif) no-repeat right;}

/*NOTICAS*/

/*FAQS*/

/*PAGINAS*/


/* VARIO */
.historial				{	height:20px;color:#ffffff;font-weight:normal;font-size:10px; padding-left:6px;
							background:url(<?= $_parenDir ?>img/historial-logo01.gif) no-repeat right;}

.noticiasfometit		{	height:20px;color:#ffffff;font-weight:normal;font-size:10px; padding-left:6px;
							background:url(<?= $_parenDir ?>img/noticias-destacadas-filas.gif) no-repeat right;}


/* CARRITO - PROCESO DE COMPRA*/

INPUT.boton				{	font-size: 10px; font-family:  Verdana, Arial, Helvetica, sans-serif; color:#000000; 
							border:1px solid #000000;background: url(<?= $_parenDir ?>img/fondo_boton.gif); height:16px;padding:0px; cursor:pointer;} 


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


#input_entrada_buscador_vo{
	width: 375px;
	height:<? if($seleccion=="1"){?>25px <? }else{?>19px<?}?>;	
	overflow-y:auto;
	overflow-x:hidden;
}

.vo_icono{
	/*margin : 10px 289px;	*/
	float:right;
	margin-top:<?if($seleccion != ""){ ?>15px; <? } else{?>-20px;<? }?>
	margin-right:<?if($seleccion != ""){ ?>205px; <? } else{?>10px;<? }?>
	/*border-right:2px dotted #999999;*/
}




 /* PESTA�AS*/
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
}




.pestanasuperiorinactiva:hover{
	margin-bottom:-1px;
	background:url('/<?=APP_NAME?>/view/img/pestana.png');
	
}


/********************/
/* PESTA�A RECURSOS */
/********************/

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

/* BUSQUEDAS */
.boton_buscar{
	background:url('/<?=APP_NAME?>/view/img/btn_buscar.png') no-repeat;
	width:75px;
	height:26px;
	border:0;
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



/*** CLEARFIX ***/

/* CLASIFICACION */




/**MAQUETACION COMBOBOX **/


/*****************/
/**TABLA BUSCADOR**/
/*****************/

