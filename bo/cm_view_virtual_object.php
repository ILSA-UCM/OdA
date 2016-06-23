<? include_once(dirname(__FILE__)."/include.php");
$dict = $visit->util->getRequest();
$idov = $dict["idov"];
$pes = $dict["pes"];
$orden = $dict["orden"];

if (!$visit->options->tieneAcceso("E",$idov)) $visit->options->sinAcceso();

$preferencias_seguridad=$visit->dbBuilder->getPreferenciaFromAtributo("seguridad_web");
if($preferencias_seguridad->valor == S && !(isset($_SESSION["name"])))
{
	$visit->util->redirect("/oda2011/view/login.php");	
}

$icono= $visit->dbBuilder->getIconoFromOV($idov);

if ($idov!="" && $idov!="0") {
	$ov = $visit->dbBuilder->getVirtualObjectId($idov);
} else if(isset($orden)&&($orden!="")){	
	if(isset($_SESSION['authenticated'])&&($_SESSION['authenticated']== APP_NAME.$visit->options->usuario->id)){
		$idnuevo=$visit->dbBuilder->getSiguienteIdOVOrden($idov,$orden);
	} else {
		$idnuevo=$visit->dbBuilder->getSiguienteIdOVOrdenPublico($idov,$orden);
	}
	$ov = $visit->dbBuilder->getVirtualObjectId($idnuevo->idov);
	header ("location: cm_view_virtual_object.php"."?idov=".$idov."&&orden=".$orden);
} else if ($idov=="0") {
	if(isset($_SESSION['authenticated'])&&$_SESSION['authenticated']== APP_NAME.$visit->options->usuario->id){
			$idnuevo=$visit->dbBuilder->getSiguienteIdOV($idov);
	} else {
			$idnuevo=$visit->dbBuilder->getSiguienteIdOVPublico($idov);
	}
	$ov = $visit->dbBuilder->getVirtualObjectId($idnuevo->id);
	header ("location: cm_view_virtual_object.php"."?idov=".$idov."&");
} else{
	$idov =0;
	if(isset($_SESSION['authenticated'])&&$_SESSION['authenticated']== APP_NAME.$visit->options->usuario->id){
			$idnuevo=$visit->dbBuilder->getSiguienteIdOV($idov);
	} else {
			$idnuevo=$visit->dbBuilder->getSiguienteIdOVPublico($idov);
	}
	$ov = $visit->dbBuilder->getVirtualObjectId($idnuevo->id);
	header ("location: cm_view_virtual_object.php"."?idov=".$idnuevo->id);
}
$idov=$ov->id;
if ($ov=="") $existe="N";
if ($seleccion=="1") {	
	include_once(dirname(__FILE__)."/top_simple.php");
} else {
	include_once(dirname(__FILE__)."/top.php");
}
if ($pes=="") $pes="dat";


//numero de decimales a mostar en los campos numericos
if($visit->options->numeric_decimal ==""){
	$preferenciasDecimales = new ClsPreferenciasPresentacion();
	$preferenciasDecimales->atributo = "numeric_decimal";
	$preferenciasDecimales = $visit->dbBuilder->getTablaFiltrada($preferenciasDecimales);
	$visit->options->numeric_decimal = $preferenciasDecimales[0]->valor;
}
?>
<style type='text/css'  media='all'>
   @import './style.css';
</style>

<table cellspacing='0' cellpadding='10' width='500' height='100%' border="0" <? if($seleccion==1){?> style="background-image:url('img/bkficha.jpg');
"<?}?>>
<tr>
	<?
	/*
	$count=$visit->dbBuilder->getVirtualObjectCount();
	if($visit->options->usuario->id!=""){
		if(isset($orden)&&($orden!="")){
			$idsiguiente=$visit->dbBuilder->getSiguienteIdOVOrden($ov->id,$orden);
			$idanterior =$visit->dbBuilder->getAnteriorIdOVOrden($ov->id,$orden);
			$idultimo=$visit->dbBuilder->getUltimoIdOVOrden($ov->id,$orden);
		} else {
			$idsiguiente=$visit->dbBuilder->getSiguienteIdOV($ov->id);
			$idanterior =$visit->dbBuilder->getAnteriorIdOV($ov->id);
			$idultimo=$visit->dbBuilder->getUltimoIdOV($ov->id);
		}
	} else {
		if(isset($orden)&&($orden!="")){
			$idsiguiente=$visit->dbBuilder->getSiguienteIdOVOrdenPublico($ov->id);
			$idanterior =$visit->dbBuilder->getAnteriorIdOVOrdenPublico($ov->id);
			$idultimo=$visit->dbBuilder->getUltimoIdOVOrdenPublico($ov->id);
		} else {
			$idsiguiente=$visit->dbBuilder->getSiguienteIdOVPublico($ov->id);
			$idanterior =$visit->dbBuilder->getAnteriorIdOVPublico($ov->id);
			$idultimo=$visit->dbBuilder->getUltimoIdOVPublico($ov->id);
		}
	}
	*/
	?>
	<td>
	<?
	if(isset($_SESSION['authenticated'])&&$_SESSION['authenticated']== APP_NAME.$visit->options->usuario->id&&$visit->util->perteneceLista($visit->options->usuario->rol,"A,B,C")){
		if(isset($orden)&&($orden!="")){
			$objetos= $visit->dbBuilder->getTodosOVOrden($orden);
		} else {
			$objetos= $visit->dbBuilder->getTodosOV();
		}
	} else {
		if(isset($orden)&&($orden!="")){
			$objetos= $visit->dbBuilder->getTodosOVOrdenPublico($orden);
		} else {
			$objetos= $visit->dbBuilder->getTodosOVPublicos();
		}
		/*
		if(isset($_SESSION['authenticated'])&&$_SESSION['authenticated']== APP_NAME.$visit->options->usuario->id&&$visit->options->usuario->rol=="C"){
			$permisos = $visit->dbBuilder->getPermisosFromUsuario($visit->options->usuario->id);
			for($i=0;$i<count($permisos);$i++) {
					array_push($objetos,$visit->dbBuilder->getVirtualObjectId($permisos[$i]->idov));
			}
		}
		*/
	}
	$pos = -1;
	for ($yy=0;$yy<count($objetos);$yy++) {
		if($objetos[$yy]->id==$idov)
			$pos = $yy;
	}
	?>
	<table width='100%' cellspacing='0' cellpadding='0' style='padding-left:30px;padding-right:10px;' border="0">
	  <tr>
		<? if ($pos>0) { ?>
			<td align='left'><a href='cm_view_virtual_object.php?idov=<?=$objetos[0]->id?>&orden=<?=$orden?>&seleccion=<?=$seleccion?>'><IMG SRC="img/pag_inicio.gif" WIDTH="38" HEIGHT="18" BORDER="0" ALT=""></a></td>
		<? } else { ?>
			<td align='left'><IMG SRC="img/pag_inicio_desac.gif" WIDTH="38" HEIGHT="18" BORDER="0" ALT=""></td>
		<? } ?>
		<? if ($pos>0) { ?>
			<td align='left'><a href='cm_view_virtual_object.php?idov=<?=$objetos[$pos-1]->id?>&orden=<?=$orden?>&seleccion=<?=$seleccion?>'><IMG SRC="img/pag_anterior.gif" WIDTH="70" HEIGHT="18" BORDER="0" ALT="&nbsp;"></a></td>
		<? } else { ?>
			<td align='left'><IMG SRC="img/pag_anterior_desac.gif" WIDTH="70" HEIGHT="18" BORDER="0" ALT=""></td>
		<? } ?>
		<td align='center'>
			<div style="padding-top:10px;margin-top:30px; height:80px; width:400px; position: relative;">
					<SCRIPT LANGUAGE="JavaScript" SRC="./js/buscador_cm_view_virtual_object.js"> </script>
					<input id="entrada_buscador_vo" type="text"  size="50" onKeyUp="buscar_virtual_obj('entrada_buscador_vo','salida_buscador_vo');">
					<div  id="salida_buscador_vo" ></div>
			</div>
		<!--  
		<td align='center'>
			<select name="ovs" onChange="location='cm_view_virtual_object.php?idov='+this.options [this.selectedIndex].value+'&orden=<?=$orden?>&seleccion=<?=$seleccion?>'">
				<option value="" selected>Ir a OV</option>
			<?
				for ($j=0;$j<count($objetos);$j++) {
			?>				
				<option value="<?=$objetos[$j]->id?>">
					<?=$objetos[$j]->id?>
					/
					<?	
						$item = $visit->dbBuilder->getNombreFromIdOV($objetos[$j]->id);
						if(strlen($item->value)>20){
							print substr($item->value,0,20);
							print "...";
						} else {
							print $item->value;
						}
					?>
					/
					<?	
						$item = $visit->dbBuilder->getDescripcionFromIdOV($objetos[$j]->id);
						if(strlen($item->value)>40){
							print substr($item->value,0,40);
							print "...";
						} else {
							print $item->value;
						}
					?>
				</option>
			<? } ?>
			</select>
		 -->
		</td>
		<? if ($pos<count($objetos)-1) { ?>
			<td align='right'>
				<a href='cm_view_virtual_object.php?idov=<?=$objetos[$pos+1]->id?>&orden=<?=$orden?>&seleccion=<?=$seleccion?>'>
					<IMG SRC="img/pag_siguiente.gif" WIDTH="70" HEIGHT="18" BORDER="0" ALT="&nbsp;">
				</a>
			</td>
		<? } else { ?>
			<td align='right'><IMG SRC="img/pag_siguiente_desac.gif" WIDTH="70" HEIGHT="18" BORDER="0" ALT=""></td>
		<? } ?>
		<? $last = count($objetos)-1; ?>
		<? if ($idov<$objetos[$last]->id) { ?>
			<td align='right'>
				<a href='cm_view_virtual_object.php?idov=<?=$objetos[$last]->id;?>&orden=<?=$orden?>&seleccion=<?=$seleccion?>'>
					<IMG SRC="img/pag_fin.gif" WIDTH="38" HEIGHT="18" BORDER="0" ALT="">
				</a>
			</td>
		<? } else { ?>
			<td align='right'><IMG SRC="img/pag_fin_desac.gif" WIDTH="38" HEIGHT="18" BORDER="0" ALT=""></td>
		<? } ?>
	  </tr>
	  </table>
	 
	</td>
	</tr>
	<tr>	
		<td  align="center" style="padding-left:30px;padding-right:5px;">
			<? if ($existe!="N") { ?>
				<?  include_once(getcwd()."/inc_top_pestanas_ov.php"); ?>		
				<?  $sectionData = new ClsSectionData();
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
				<!-- if pestañas -->
				<? } else { ?>
					<? include("inc_datos_metadatos.php");?>
				<? } ?>
				<?  include_once(getcwd()."/inc_bottom_pestanas.php"); ?>
			<? } else { ?>
			<!-- El objeto no existe -->
			<? } ?>
		</td>
<style>
/* Show only to IE PC \*/
* html .boxhead h2 {height: 1%;} /* For IE 5 PC */

.sidebox {
	margin: 0 auto; /* center for now */
	width: 20em; /* ems so it will grow */
	background: url(img/sbbody-r.gif) no-repeat bottom right;
	font-size: 100%;
}
.boxhead {
	background: url(img/sbhead-r.gif) no-repeat top right;
	margin: 0;
	padding: 0;
	text-align: center;
}
.boxhead h2 {
	background: url(img/sbhead-l.gif) no-repeat top left;
	margin: 0;
	padding: 22px 30px 5px;
	color: white; 
	font-weight: bold; 
	font-size: 1.2em; 
	line-height: 1em;
	text-shadow: rgba(0,0,0,.4) 0px 2px 5px; /* Safari-only, but cool */
}
.boxbody {
	background: url(img/sbbody-l.gif) no-repeat bottom left;
	margin: 0;
	padding: 5px 30px 31px;
}

</style>
	<? if ($ov->id!=null && $icono!=null) {?>
		<td align="left" valign="top" style="padding-top:15px;">
			<table cellspacing="0" cellpadding="5" border="0">
				<tr>
					<td align="center" valign="middle">
						<?
						$rutaicono = "";
						if($icono==NULL) {
							$rutaicono = "img/ico_ov.gif";
						} else if($icono->idov_refered!="") {//alfredo 140728
							$idovicono = $icono->idov_refered; //alfredo 140728
							$rutaicono = "../bo/download/".$icono->idov_refered."/".$icono->name;//alfredo 140728
						} else {
							$idovicono = $ov->id;
							$rutaicono = "../bo/download/".$ov->id."/".$icono->name;
						}
						?>
						<? if($icono!=NULL) { ?>
							<a href="#" onclick='window.open("mostrar_imagen.php?idrecurso=<?=$icono->id?>&idov=<?=$idovicono?>","","width=800,height=400,scrollbars=yes"); return false;'>
						<? } ?>
							<div class="sidebox">
								<div class="boxhead"><h2>Objeto Virtual</h2></div>
								<div class="boxbody">
									<div style="width:150px; overflow-y:hidden;">
										<img src="<?=$rutaicono?>" width="150" border="0">
									</div>
								</div>
							</div>
						<? if($icono!=NULL) { ?>
							</a>
						<? } ?>
					</td>
				</tr>
			</table>
		<td>
	<? } ?>
	</tr> 
	<tr>
		<td width='100%' align="center">
		<br>	
		<table cellspacing='0' cellpadding='0' width='100%'>
			<tr>
				<td align='left'>
					<? if ($visit->options->usuario->esRolSuperadmin() ) { ?>
						<a href='cm_form_vo.php'>Nuevo</a>
					<? } ?>
						<IMG SRC="/img/pc.gif" WIDTH="50px" HEIGHT="1" BORDER="0" ALT="">
						<b>Objeto Virtual <?=$idov?></b>
				</td>
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
				<td align='right'>
					<? //  alfredo 140715  if(($visit->options->usuario->esRolAdmin()&&$visit->dbBuilder->tienePermisoUsuarioSobreOV("E",$ov->id,$session->idusuario))||$visit->options->usuario->esRolSuperadmin()){
					if(($visit->options->usuario->esRolAdmin()&&$visit->dbBuilder->tienePermisoUsuarioSobreOV("E",$ov->id,$_SESSION["idusuario"]))||$visit->options->usuario->esRolSuperadmin()){?>
						<a href='cm_form_vo.php?id=<?=$idov?>'>Editar</a>
					<? } ?>
					</td>
			</tr>
		</table>
		</td>
	</tr>
	<? if ($existe!="N" && !$seleccion=="1") { ?>
	<tr>
	  <td>
	  <table width='100%' cellspacing='0' cellpadding='0' style='padding-left:30px;padding-right:10px;'>
	  <tr>
		<? if ($pos>0) { ?>
			<td align='left'><a href='cm_view_virtual_object.php?idov=<?=$objetos[0]->id?>&orden=<?=$orden?>&seleccion=<?=$seleccion?>'><IMG SRC="img/pag_inicio.gif" WIDTH="38" HEIGHT="18" BORDER="0" ALT=""></a></td>
		<? } else { ?>
			<td align='left'><IMG SRC="img/pag_inicio_desac.gif" WIDTH="38" HEIGHT="18" BORDER="0" ALT=""></td>
		<? } ?>
		<? if ($pos>0) { ?>
			<td align='left'><a href='cm_view_virtual_object.php?idov=<?=$objetos[$pos-1]->id?>&orden=<?=$orden?>&seleccion=<?=$seleccion?>'><IMG SRC="img/pag_anterior.gif" WIDTH="70" HEIGHT="18" BORDER="0" ALT="&nbsp;"></a></td>
		<? } else { ?>
			<td align='left'><IMG SRC="img/pag_anterior_desac.gif" WIDTH="70" HEIGHT="18" BORDER="0" ALT=""></td>
		<? } ?>
		<td align='center'>
			<div style="padding-top:10px;margin-top:30px; height:80px; width:400px; ">
					<SCRIPT LANGUAGE="JavaScript" SRC="./js/buscador_cm_view_virtual_object.js"> </script>
					<input id="entrada_buscador_vo1" type="text"  size="50" onKeyUp="buscar_virtual_obj('entrada_buscador_vo1','salida_buscador_vo1');">
					<div  id="salida_buscador_vo1" ></div>
			</div>
		<!--  
		<td align='center'>
			<select name="ovs" onChange="location='cm_view_virtual_object.php?idov='+this.options [this.selectedIndex].value+'&orden='<?=$orden?>">
				<option value="" selected>Ir a OV</option>
			<?
				for ($j=0;$j<count($objetos);$j++) {
			?>				
				<option value="<?=$objetos[$j]->id?>">
					<?=$objetos[$j]->id?>
					/
					<?	
						$item = $visit->dbBuilder->getNombreFromIdOV($objetos[$j]->id);
						if(strlen($item->value)>20){
							print substr($item->value,0,20);
							print "...";
						} else {
							print $item->value;
						}
					?>
					/
					<?	
						$item = $visit->dbBuilder->getDescripcionFromIdOV($objetos[$j]->id);
						if(strlen($item->value)>40){
							print substr($item->value,0,40);
							print "...";
						} else {
							print $item->value;
						}
					?>
				</option>
			<? } ?>
			</select>
		-->	
		</td>
		<? if ($pos<count($objetos)-1) { ?>
			<td align='right'>
				<a href='cm_view_virtual_object.php?idov=<?=$objetos[$pos+1]->id?>&orden=<?=$orden?>&seleccion=<?=$seleccion?>'>
					<IMG SRC="img/pag_siguiente.gif" WIDTH="70" HEIGHT="18" BORDER="0" ALT="&nbsp;">
				</a>
			</td>
		<? } else { ?>
			<td align='right'><IMG SRC="img/pag_siguiente_desac.gif" WIDTH="70" HEIGHT="18" BORDER="0" ALT=""></td>
		<? } ?>
		<? $last = count($objetos)-1; ?>
		<? if ($pos<count($objetos)-1) { ?>
			<td align='right'>
				<a href='cm_view_virtual_object.php?idov=<?=$objetos[$last]->id ?>&orden=<?=$orden?>&seleccion=<?=$seleccion?>'>
					<IMG SRC="img/pag_fin.gif" WIDTH="38" HEIGHT="18" BORDER="0" ALT="">
				</a>
			</td>
		<? } else { ?>
			<td align='right'><IMG SRC="img/pag_fin_desac.gif" WIDTH="38" HEIGHT="18" BORDER="0" ALT=""></td>
		<? } ?>
	  </tr>
	  </table>
	</td>
	</tr>
	 <? } ?>
	
</table>
<? 
if ($seleccion=="1") {
	include_once(dirname(__FILE__)."/bottom_simple.php");
} else {
include_once(dirname(__FILE__)."/bottom.php"); 
}
?>