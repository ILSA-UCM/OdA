<? include_once(dirname(__FILE__)."/include.php");
$seleccion = $dict["seleccion"];
/*if ($seleccion=="1") {	
	include_once(dirname(__FILE__)."/top_simple.php");
} else {
	include_once(dirname(__FILE__)."/top.php");
}*/

$dict = $visit->util->getRequest();
$idov = $dict["idov"];
$pes = $dict["pes"];
$orden = $dict["orden"];
$idpadre =  $dict["idpadre"];
$seleccion = $dict["seleccion"];

if($seleccion != ""){ 	
	//Incluir estilos y el comboBox
 ?>
	<script language="JavaScript" type="text/JavaScript"></script>
	<script SRC="<?=$_parenDir?>bo/misc/scripts/func.js"></script>
	<script SRC="<?=$_parenDir?>bo/misc/scripts/ts_picker.js"></script>
	<script SRC="<?=$_parenDir?>view/js/jquery-1.6.2.min.js"></script>
	<script SRC="<?=$_parenDir?>view/js/jquery-ui-1.8.16.custom.min.js"></script>
	<script SRC="<?=$_parenDir?>view/js/combobox.js"></script>
	<link rel="stylesheet" href="<?=$_parenDir?>view/css/smoothness/jquery-ui-1.8.16.custom.css">	
	<style><? if (file_exists('italictop.conf'))
                    include_once("css_italic.php");
                else
                    include_once("css.php");
        ?></style>
	
	<META NAME="Author" CONTENT="Universidad Complutense de Madrid & Bernardo Chenlo">
	<META NAME="Keywords" CONTENT="<?= trad("datos_palabras")  ?>">
	<META NAME="Description" CONTENT="<?=trad("datos_descripcion") ?>">

    <? include_once("analiticstracking.php");?>

<? }

if (!$visit->options->tieneAcceso("E",$idov)) $visit->options->sinAcceso();

$preferencias_seguridad=$visit->dbBuilder->getPreferenciaFromAtributo("seguridad_web");
if($preferencias_seguridad->valor == S && !(isset($_SESSION["name"])))
{
	$visit->util->redirect("/".APP_NAME."/view/login.php");	
}
/*
if($idov !=""){
	$ov = $visit->dbBuilder->getVirtualObjectId($idov);
	if ($ov->id=="") {
		$existe="N";
		//Busqueda de un nuevo IDOV
		if($idov =="")$idov = 0;
		if($visit->util->esUserRegistrado()){
			$idnuevo=$visit->dbBuilder->getSiguienteIdOV($idov);
		}else{
			$idnuevo=$visit->dbBuilder->getSiguienteIdOVPublico($idov);
		}
		header("location: cm_view_virtual_object.php"."?idov=".$idnuevo->id."&idpadre=".$idpadre);
	}
}else{
	if($idov =="")$idov = 0;
		if($visit->util->esUserRegistrado()){
			$idnuevo=$visit->dbBuilder->getSiguienteIdOV($idov);
		}else{
			$idnuevo=$visit->dbBuilder->getSiguienteIdOVPublico($idov);
		}
		header("location: cm_view_virtual_object.php"."?idov=".$idnuevo->id."&idpadre=".$idpadre);
}


*/
$ov = $visit->options->controlaAccesoOV($idov);
$dict["idov"] = $ov->id;
$idov=$dict["idov"];


$idov=$ov->id;
$icono= $visit->dbBuilder->getIconoFromOV($idov);
if ($ov=="") {
	$existe="N";
}

if ($pes=="") $pes="dat";


//numero de decimales a mostar en los campos numericos
if($visit->options->numeric_decimal ==""){
	$preferenciasDecimales = new ClsPreferenciasPresentacion();
	$preferenciasDecimales->atributo = "numeric_decimal";
	$preferenciasDecimales = $visit->dbBuilder->getTablaFiltrada($preferenciasDecimales);
	$visit->options->numeric_decimal = $preferenciasDecimales[0]->valor;
}
 

$username = $_SESSION["name"];
$rol = $visit->dbBuilder->getUsuarioRol($username);
//var_dump($rol);
//var_dump($_SESSION);
//Collecion del buscador
$visit->debuger->enable(true);
if($visit->util->esUserRegistrado()){
	if ($visit->util->esSuperAdmin()){
		$collection = $visit->dbBuilder->getDescripcionOV();
	}elseif($visit->util->esAdmin()){
		$collection = $visit->dbBuilder->getDescripcionOVNoPrivados();
	}else{
		$collection = $visit->dbBuilder->getDescripcionOVNoPrivados();
	}
}
else {
	 $collection = $visit->dbBuilder->getDescripcionOVPublicos();
}
$visit->debuger->enable(false);

	//if(isset($_SESSION['authenticated'])&&$_SESSION['authenticated']== APP_NAME.$visit->options->usuario->id&&$visit->util->perteneceLista($visit->options->usuario->rol,"A,B,C")){
		if ($visit->util->esSuperAdmin()){
			if(isset($orden)&&($orden!="")){
				$objetos= $visit->dbBuilder->getTodosOVOrden($orden);
			} else {
				$objetos= $visit->dbBuilder->getTodosOV();
			}
		}elseif ($visit->util->esAdmin()){
			if(isset($orden)&&($orden!="")){
				$objetos= $visit->dbBuilder->getTodosOVNoPrivadosOrden($orden);
			} else {
				$objetos= $visit->dbBuilder->getTodosOVNoPrivados();
			}
		}elseif ($visit->util->esUser()){
			if(isset($orden)&&($orden!="")){
				$objetos= $visit->dbBuilder->getTodosOVPublicosOrden($orden);
			} else {
				$objetos= $visit->dbBuilder->getTodosOVPublicos();
			}
		}else{
			if(isset($orden)&&($orden!="")){
				$objetos= $visit->dbBuilder->getTodosOVNoUserPublicosOrden($orden);
			} else {
				$objetos= $visit->dbBuilder->getTodosOVNoUserPublicos();
			}
		}
	/*} else {
		if(isset($orden)&&($orden!="")){
			$objetos= $visit->dbBuilder->getTodosOVPublicosOrden($orden);
		} else {
			$objetos= $visit->dbBuilder->getTodosOVPublicos();
		}
	}*/
	$pos = -1;
	for ($yy=0;$yy<count($objetos);$yy++) {
		if($objetos[$yy]->id==$idov)
			$pos = $yy;
	}
?>

<?//MAQUETACION VARIABLE 
$margenLateralDer = "35px";
if($seleccion == "1"){
	$margenLateralDer = "205px";
}
?>
<?
if ($seleccion=="1") {	
	include_once(dirname(__FILE__)."/top_simple.php");
} else {
	include_once(dirname(__FILE__)."/top.php");
}
?>





<!-- TITULO PAGINA -->
<? if($seleccion =="" ) { ?>
	<div class="titulopagina" <? if($icono->id != "") print "style='width:650px;'"?>>
		<?   print $visit->util->migaspan($idpadre,$migas); ?>
	</div> 
<?} ?>

<!-- BUSCADOR -->
<!-- COMENTAR EL BUSCADOR SI LA BASE DE DATOS TIENE M�S DE VARIOS MILES DE OBJETOS -->
<div class="caja_buscador" <? if($icono->id != "") print "style='width:650px;float:left;'"?>>
	<div class="buscador"> 
		<span>&nbsp; Buscar objetos &nbsp; </span>
		<select id="entrada_buscador_vo" style="width:500px;"   onChange="location='cm_view_virtual_object.php?idov'">
		<?	foreach ($collection as $key=>$value){	?>
			<? if($value != ""){
				if(strlen($value->value)>80){
					$strValor = substr($value->value,0,75)	;
					$strValor=$strValor."...";	
				} else{
					$strValor = $value->value;
				}
			}else{
				
			} ?>
			<option value="<?=$value->idov?>" ><?=$value->idov?> - <?=$strValor?></option>
		<? }?>
		</select>	
	</div>	
</div>
<!-- FIN DEL BUSCADOR COMENTADO  -->

	
	<!-- ICONO -->
	<div class="vo_icono" > <!-- Imagen objeto Virtual --> 
	<? if ($ov->id!=null && $icono!=null) {?>
		<?
			$rutaicono = "../bo/download/iconos/".$visit->dbBuilder->getNombreIcono($icono->idov,$icono->name);
		?>
		<? if($icono!=NULL) { ?>
			<a href="#" onclick='window.open("mostrar_imagen.php?idrecurso=<?=$icono->id?>&idov=<?=$icono->idov?>","","width=1200,height=900,scrollbars=yes"); return false;'>
		<? } ?>
		<div class="sidebox">
			<div class="boxhead">Objeto Digital </div> 
			<div class="boxbody">
					<img src="<?=$rutaicono?>" width="119"  border="0">
			</div>
		</div>
		<? if($icono!=NULL) { ?>
			</a>
		<? } ?>
		<? if($icono!=NULL) { ?>
			<div class="ico_ver_mas" >
				<a href="#" onclick='window.open("mostrar_imagen.php?idrecurso=<?=$icono->id?>&idov=<?=$icono->idov?>","","width=1200,height=900,scrollbars=yes"); return false;'>
					<span><img src="/<?=APP_NAME?>/view/img/ico_lupa_azul.png" width="11" border="0"></span>
					<span>Ampliar</span>
				</a>	
			
			</div>
		<? } ?>
		
	<? } ?>
	
</div>

<? if ($idov!="") { //alfredo 140810 
		$idsrefered = $visit->dbBuilder->getFromReferedFromIdOV($idov);
		$stringids = "";
		for ($i=0;$i<count($idsrefered);$i++) { 
				if($idsrefered[$i]->idov!="")
				$stringids .= $idsrefered[$i]->idov.", ";
				}
		$stringids = substr($stringids,0,-2);
		} ?>
		
		
<div class="clearfix">  </div>



<div class="vo_titulo"> Objeto Digital <?=$idov?> </div>



<!-- PAGINACION -->
<!-- <div style="float:left; width:225px;margin:5px 132px 10px 132px; "> -->
<div style="float:left; width:225px;margin:5px 132px 10px 132px; ">

	 <!-- Imagenes Izquierda -->
		<? if ($pos>0) { ?>
			<div class="buscador_img_izq2"><a href='cm_view_virtual_object.php?idov=<?=$objetos[0]->id?>&orden=<?=$orden?>&seleccion=<?=$seleccion?>&idpadre=<?=$idpadre ?>'><IMG SRC="img/ico_doble_flecha_izqda.png" WIDTH="19" HEIGHT="8" BORDER="0" ALT=""></a></div> 
		<? } else { ?>
			<div class="buscador_img_izq2"><IMG SRC="img/ico_doble_flecha_izqda_gris.png" WIDTH="19" HEIGHT="8" BORDER="0" ALT=""></div>  
		<? } ?>
		<? if ($pos>0) { ?>
			<div class="buscador_img_izq">
				<a href='cm_view_virtual_object.php?idov=<?=$objetos[$pos-1]->id?>&orden=<?=$orden?>&seleccion=<?=$seleccion?>&idpadre=<?=$idpadre ?>'>
					<div class="img_pag_izq_act"></div> 
					<div class="text_paginacion">Anterior</div> 
				</a>
			</div>
		<? } else { ?>
			 <div class="buscador_img_izq">
			 	<div class="img_pag_izq_des"></div> 
			 	<div class="text_paginacion">Anterior</div> 
			 </div> 
			<? } ?>

	
	<div class="buscador_texto_izq" > / </div>
	
	 <!-- Imagenes Derecha -->
	<? if ($pos<count($objetos)-1) { ?>
			<div  class="buscador_img_dcha">
				<a href='cm_view_virtual_object.php?idov=<?=$objetos[$pos+1]->id?>&orden=<?=$orden?>&seleccion=<?=$seleccion?>&idpadre=<?=$idpadre ?>'>
					 <div class="text_paginacion">Siguiente</div>
					 <div class="img_pag_der_act"></div> 
				</a>
			</div>
		<? } else { ?>
			<div  class="buscador_img_dcha">  
			  <div class="text_paginacion">Siguiente</div>
			  <div class="img_pag_der_des"></div> 
			 </div>
		<? } ?>
				
		<? $last = count($objetos)-1; ?>
		<? if ($idov<$objetos[$last]->id) { ?>
			<div  class="buscador_img_dcha2">
				<a href='cm_view_virtual_object.php?idov=<?=$objetos[$last]->id;?>&orden=<?=$orden?>&seleccion=<?=$seleccion?>&idpadre=<?=$idpadre ?>'>
					<IMG SRC="img/ico_doble_flecha_dcha.png" WIDTH="18" HEIGHT="9" BORDER="0" ALT="">
				</a>
			</div>
		
		<? } else { ?>
		
			<div  class="buscador_img_dcha2">
				<IMG SRC="img/ico_doble_flecha_dcha_gris.png" WIDTH="18" HEIGHT="9" BORDER="0" ALT="">
			</div>
		
		<? } ?>	
		 
	
	<div class="clearfix"></div>
</div>


<div class="vo_datos">  <!--  Metadatos -->
	<? if ($existe!="N") { 
		  include_once(getcwd()."/inc_top_pestanas_ov.php"); 		
		  $sectionData = new ClsSectionData();
			$filas = $visit->dbBuilder->getTablaFiltrada($sectionData);
			$count = count($filas);
			if ($count==0) $inicio=0;
			if ($pes=="" || $pes== "dat") {
			$datos=$visit->dbBuilder->getIdDatos();
			$idPadreActivo=$datos->idpadre;
			$idActivo=$datos->id;
			} else if ($pes=="rec") {
				$recurso=$visit->dbBuilder->getIdRecurso();
				$idPadreActivo=$recurso->idpadre;
				$idActivo=$recurso->id;
			} else if ($pes=="met") {
				$metadatos=$visit->dbBuilder->getIdMetadatos();
				$idPadreActivo=$metadatos->idpadre;
				$idActivo=$metadatos->id;
			}
			$valores = &$filas;
			$dictFilas = $visit->util->getDict( $valores );
			$sDictFilas = array();
			$listaSeccionesFila="0";
									
			while (list ($clave, $valor) = each ($dictFilas)) { 
				$nombre ="";
				$caminoItems = $visit->util->obtenerCaminoCategoria($dictFilas, "", $valor->id);
				for ($i=0;$i<count($caminoItems);$i++) $nombre .= " >> ". $visit->util->numDigitos($dictFilas[$caminoItems[$i]]->orden,5) . "_" . $dictFilas[$caminoItems[$i]]->nombre;
				$sDictFilas[$nombre] = $valor;
			}
			ksort( $sDictFilas );
			$filas = &$sDictFilas;
			$idPrim=$idActivo;					
		?>
		<? if ($pes== "rec") { ?>
			<?  include_once(getcwd()."/inc_pestanna_recursos.php"); ?>
		<? } else if ($pes=="" || $pes=="dat"){ ?>
				<? include("inc_pestanna_datos.php");?>
		<? } else if ($pes=="met"){ ?>
				<? include("inc_pestanna_metadatos.php");?>
		<?//  include_once(getcwd()."/inc_bottom_pestanas.php"); ?>
		<? } else { ?>
			<!-- El objeto no existe -->
		<? } ?>
	<? } ?>

</div>

<div class="clearfix"></div>

<div class="vo_caja_editar"> <!-- Modificar datos si es SUPERADMIN -->
	<? if ($visit->options->usuario->esRolSuperadmin()) { ?>
		<a href='cm_form_vo.php?idpadre=<?=$idpadre?>&idvuelta=<?=$idov?>'>Nuevo</a>
	<? } ?>
	<!-- <IMG SRC="/img/pc.gif" WIDTH="50px" HEIGHT="1" BORDER="0" ALT="">  -->
	<b>Objeto Digital <?=$idov?> </b>
	
				
				<!-- <td align='center'>
					Ordenar por:&nbsp;
					<? 
						$seccion111 = $visit->dbBuilder->getSectionDataId(111);
						$seccion112 = $visit->dbBuilder->getSectionDataId(112);				
					?>
					<select name="ovs_orden" onChange="location='cm_view_virtual_object.php?idov=0&&orden='+this.options [this.selectedIndex].value+'&'">
						<option value="">-- Ordenar por --</option>
						<option value="" <?if($orden==""){?> selected<?}?>>Identificador</option>
						<option value="111" <?if($orden=="111"){?> selected<?}?>><?=$seccion111->nombre?></option>
						<option value="112" <?if($orden=="112"){?> selected<?}?>><?=$seccion112->nombre?></option>
				</td> -->
				
	<? if((/*$visit->options->usuario->esRolAdmin()&&*/$visit->dbBuilder->tienePermisoUsuarioSobreOV("E",$idov,$_SESSION["userid"]))||$visit->options->usuario->esRolSuperadmin()){?>
		<a href='cm_form_vo.php?id=<?=$idov?>&idpadre=<?=$idpadre?>&idvuelta=<?=$idov?>'>Editar</a>
	<? } ?>
<b> <div> <?if($rol!="" && $stringids!="") {?> Referenciado desde OD: <?=$stringids?><?} // alfredo 140810?> </div> </b>
</div>

<!-- PAGINACION -->

<div style="float:right; width: 225px;margin-top:10px;margin-right:<?=$margenLateralDer?>;">
	<div> <!-- Imagenes Izquierda -->
		<? if ($pos>0) { ?>
			<div class="buscador_img_izq2"><a href='cm_view_virtual_object.php?idov=<?=$objetos[0]->id?>&orden=<?=$orden?>&seleccion=<?=$seleccion?>&idpadre=<?=$idpadre ?>'><IMG SRC="img/ico_doble_flecha_izqda.png" WIDTH="19" HEIGHT="8" BORDER="0" ALT=""></a></div> 
		<? } else { ?>
			<div class="buscador_img_izq2"><IMG SRC="img/ico_doble_flecha_izqda_gris.png" WIDTH="19" HEIGHT="8" BORDER="0" ALT=""></div>  
		<? } ?>
		<? if ($pos>0) { ?>
			<div class="buscador_img_izq">
				<a href='cm_view_virtual_object.php?idov=<?=$objetos[$pos-1]->id?>&orden=<?=$orden?>&seleccion=<?=$seleccion?>&idpadre=<?=$idpadre ?>'>
					<div class="img_pag_izq_act"></div> 
					<div class="text_paginacion">Anterior</div> 
				</a>
			</div>
		<? } else { ?>
			 <div class="buscador_img_izq">
			 	<div class="img_pag_izq_des"></div> 
			 	<div class="text_paginacion">Anterior</div> 
			 </div> 
			<? } ?>
	</div>
	
	<span class="buscador_texto_izq" > / </span>
	
	<div > <!-- Imagenes Derecha -->
	<? if ($pos<count($objetos)-1) { ?>
			<div  class="buscador_img_dcha">
				<a href='cm_view_virtual_object.php?idov=<?=$objetos[$pos+1]->id?>&orden=<?=$orden?>&seleccion=<?=$seleccion?>&idpadre=<?=$idpadre ?>'>
					 <div class="text_paginacion">Siguiente</div>
					 <div class="img_pag_der_act"></div> 
				</a>
			</div>
		<? } else { ?>
			<div  class="buscador_img_dcha">  
			  <div class="text_paginacion">Siguiente</div>
			  <div class="img_pag_der_des"></div> 
			 </div>
		<? } ?>
		
		<? $last = count($objetos)-1; ?>
		<? if ($idov<$objetos[$last]->id) { ?>
			<div  class="buscador_img_dcha2">
				<a href='cm_view_virtual_object.php?idov=<?=$objetos[$last]->id;?>&orden=<?=$orden?>&seleccion=<?=$seleccion?>&idpadre=<?=$idpadre ?>'>
					<IMG SRC="img/ico_doble_flecha_dcha.png" WIDTH="18" HEIGHT="9" BORDER="0" ALT="">
				</a>
			</div>
		
		<? } else { ?>
		
			<span  class="buscador_img_dcha2"><IMG SRC="img/ico_doble_flecha_dcha_gris.png" WIDTH="18" HEIGHT="9" BORDER="0" ALT=""></span>
		
		<? } ?>	
		 
	</div>
	<div class="clearfix"></div>

</div>

 <div class="clearfix"></div>
<div id="share"></div>
<script>
$('#entrada_buscador_vo').combobox({
	selected: function(){ window.location.href='cm_view_virtual_object.php?idov='+(this.value)+'&idpadre=<?=$idpadre?>&seleccion=<?=$seleccion?>';}
});
$("#entrada_buscador_vo" ).next().val("");

</script>

<? 
if ($seleccion=="1") {
	include_once(dirname(__FILE__)."/bottom_simple.php");
} else {
include_once(dirname(__FILE__)."/bottom.php"); 
}
?>

<?php
if (file_exists("noShare.debug")) {

?>

    <script src="minishare-0.0.1.js"></script>
    <script>

        $( document ).ready(function() {

            $.miniShare( {
                message: "Comparte esta Ficha",
                done_message: "Gracias por Compartir"
            });
        });
    </script>

   <?php
}

?>



