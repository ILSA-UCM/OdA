<?


$preferencias_seguridad=$visit->dbBuilder->getPreferenciaFromAtributo("seguridad_web");
$valores_sectionData=$visit->dbBuilder->getSectionData();
$dictFilasSectionData = $visit->util->getDict( $valores_sectionData );
$visit->options->sectionData=$dictFilasSectionData;
//var_dump($visit->options->sectionData);

//var_dump($dictFilasSectionData["284"]->nombre);

	if (($preferencias_seguridad->valor == "S")&&($_SESSION["idusuario"]=="")){
		$visit->util->redirect($_parenDir."view/login.php");
	}
	header('Content-type: text/html; charset=UTF-8') ;?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<HTML>
<HEAD>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<TITLE> <?= trad("datos_titulo") ?></TITLE>	
	<script language="JavaScript" type="text/JavaScript"></script>
	<script SRC="<?=$_parenDir?>bo/misc/scripts/func.js"></script>
	<script SRC="<?=$_parenDir?>bo/misc/scripts/ts_picker.js"></script>
	<script SRC="<?=$_parenDir?>view/js/jquery-1.6.2.min.js"></script>
	<script SRC="<?=$_parenDir?>view/js/jquery-ui-1.8.16.custom.min.js"></script>
	<script SRC="<?=$_parenDir?>view/js/combobox.js"></script>
	<script>appname="<?=APP_NAME?>"</script>
	<? include_once(dirname(__FILE__)."/analiticstracking.php");?>
	<link rel="stylesheet" href="<?=$_parenDir?>/view/css/smoothness/jquery-ui-1.8.16.custom.css">
    <link rel="stylesheet" href="<?=$_parenDir?>/view/css_light.css">

    <META NAME="Author" CONTENT="Universidad Complutense de Madrid">
	<META NAME="Keywords" CONTENT="<?= trad("datos_palabras")  ?>">
	<META NAME="Description" CONTENT="<?=trad("datos_descripcion") ?>">
</HEAD>

<STYLE>
	<?
		 include("css_light.php");
	?>
</STYLE>
<?
	$preferencias_seguridad=$visit->dbBuilder->getPreferenciaFromAtributo("seguridad_web");

	if (($preferencias_seguridad->valor == "S")&&($_SESSION["idusuario"]=="")){
		$visit->util->redirect($_parenDir."view/login.php");	
	}else{
?>
	<body class="classBody">
	<? /*
		// Para el men� superior
		include_once("inc_navegacion_menus.php");
		$visit->options->visible="S";
		$colspan_num="2";
	*/
	
	?>

    <?include_once("imagenes_cabecera_size.php");?>

	<div class="header">
		<a href="<?= $_parenDir ?>view/paginas/view_paginas.php?id=1"> 
			<IMG SRC="<?= $_parenDir."html/view/".trad("datos_imagen")?>" WIDTH="<?=$i_width?>" height="<?=$i_height?>" BORDER="0" ALT="<?= trad("datos_tienda_titulo") ?>">
			 
		</a>
	</div>
	
	<? /*
		var_dump($_SESSION);
		echo "<br>";
		*/
	?>
	
	<? if ($prefs["registro_login_rapido"]=="1") { ?>
		<div class="login_superior">
			<? include_once("inc_clientes_login.php");?>
		</div>
	<? } ?>	
	<div class="clearfix"></div>
	<!-- MENU SUPERIOR -->
	<?include_once(dirname(__FILE__)."/inc_secciones_logica.php");?>
	<div class= "menu_superior" >  
		<?//include_once("inc_secciones_superior.php");?>
		<?=ClsSeccionesCache::getSeccionesSuperior($visit->options->usuario->rol);?>
		<div class="clearfix"></div>
	</div>  
	
	<div class="clearfix"></div>
	<div class="navizquierda">	
		<? //include_once("inc_secciones_izqda.php");?>
		<?=ClsSeccionesCache::getSeccionesIzqda($visit->options->usuario->rol);?>
		<script>
			<?
			$caminoActivo = $visit->util->obtenerCaminoCategoria($dictFilasNav, "", $dict["idpadre"]);
			$idseccion = array();
			$criterio = array();
			foreach ($dict as $key => $value) {
				if(strpos($key, "criterio_")!==false){
					$partes = explode("_", $key);
					$idseccion[] = $partes[1];
					$criterio[] = str_replace(" ", "-", $value);
				}
			}
			$sectionDatas=$visit->dbBuilder->getSectionData();
			$caminoClasificacion = $visit->util->obtenerCaminoClasificacion($sectionDatas,"",$dict["id"]);
			$caminoActivoSeccion = explode(",",$caminoClasificacion);
			?>
			$(function(){
				//Logica de menus navegacion
				<?for($i=1;$i<count($caminoActivo);$i++){?>
					extiende("<?=$caminoActivo[$i]?>");
					$('.nav_<?=$caminoActivo[$i]?>').removeClass("nav_izq_nivel0_inactivo");
					$('.nav_<?=$caminoActivo[$i]?>').addClass("nav_izq_nivel0_activo");
					$('.hijosnav_<?=$caminoActivo[$i]?>').removeClass("nav_izq_clasificacion_inactivo");
					$('.hijosnav_<?=$caminoActivo[$i]?>').addClass("nav_izq_clasificacion_activo");
					$('.hijosnav_<?=$caminoActivo[$i]?>').show();

						$('.nav_<?=$caminoActivo[$i]?>').removeClass("nav_izq_nivel1_inactivo");
						$('.nav_<?=$caminoActivo[$i]?>').addClass("nav_izq_nivel1_activo");

				<?}?>
				//Logica de secciones_data
				<?for($i=1;$i<count($caminoActivoSeccion);$i++){?>
					extiende_clasificacion_izq("<?=$caminoActivoSeccion[$i]?>");
					$('.sec_<?=$caminoActivoSeccion[$i]?>').removeClass("nav_izq_clasificacion_inactivo");
					$('.sec_<?=$caminoActivoSeccion[$i]?>').addClass("nav_izq_clasificacion_activo");
					$('.hijossec_<?=$caminoActivoSeccion[$i]?>').show();
				<?}?>
				//Logica criterios
				$(".sec_<?=htmlspecialchars($dict['id'], ENT_QUOTES, 'UTF-8');?> .value_<?=htmlspecialchars($dict['value'], ENT_QUOTES, 'UTF-8');?>").removeClass("criterio_inactivo");
				$(".sec_<?=htmlspecialchars($dict['id'], ENT_QUOTES, 'UTF-8');?> .value_<?=htmlspecialchars($dict['value'], ENT_QUOTES, 'UTF-8');?>").addClass("criterio_activo");
				$(".sec_<?=htmlspecialchars($dict['id'], ENT_QUOTES, 'UTF-8');?> .value_<?=htmlspecialchars($dict['value'], ENT_QUOTES, 'UTF-8');?> .enlace_value:first").addClass("enlace_value_activo");
				$(".sec_<?=htmlspecialchars($dict['id'], ENT_QUOTES, 'UTF-8');?> .extiendehijosvalue_<?=htmlspecialchars($dict['value'], ENT_QUOTES, 'UTF-8');?>").click();
				//Desactivo algun criterio del mismo OV que sea hijo de la selección
				$(".sec_<?=htmlspecialchars($dict['id'], ENT_QUOTES, 'UTF-8');?> .value_<?=htmlspecialchars($dict['value'], ENT_QUOTES, 'UTF-8');?>").find(".criterio").each(function(i){
					$(this).removeClass("criterio_activo");
					$(this).addClass("criterio_inactivo");
				});
				//Activo todos los criterios que esten por encima de la selección dentro de la misma sección
				$(".sec_<?=htmlspecialchars($dict['id'], ENT_QUOTES, 'UTF-8');?> .value_<?=htmlspecialchars($dict['value'], ENT_QUOTES, 'UTF-8');?>").parents(".criterio").each(function(i){
					$(this).removeClass("criterio_inactivo");
					$(this).addClass("criterio_activo");
					$(this).find(".enlace_value:first").addClass("enlace_value_activo");
					$(this).find(".extiendehijosvalue:first").click();
				});
			});
		</script>
	</div>
	<div class="contenido">



<?}?>						
