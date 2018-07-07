<?
include_once(dirname(__FILE__)."/include.php");
include_once(dirname(__FILE__)."/top.php");
?>
<?


//$visit->debuger->enable(true);
///////////////////////////////////////////////// alfredo 180613
//var_dump($_GET); echo('++GET+++ ');echo "<br><br>";
if($_GET !=""){
		foreach($_GET as $key=>$value){
			if($key != "" && $value !=""){
				
				$_GET[$key]=str_replace("xxjj", "+", $value);
			}
		}
}
//var_dump($_GET); echo('++GET2+++ ');echo "<br><br>";

$dict=$visit->util->getRequest();

//var_dump($dict);echo('11dict11 ');echo "<br><br>";
/////////////////////////////////////////////////


$npag = $dict["npag"];
//var_dump($npag);echo('++npag+++ ');
//Coger la paginacion por el Post primero y luego por el get
$paginacion = $_POST["paginacion"];
if($paginacion == "") $paginacion = $_GET["paginacion"];
$paginacion = $dict["paginacion"];
$orden = $dict["orden"];
$orden_tipo = $dict["orden_tipo"];
$idpadre = $dict["idpadre"];
//var_dump($_SESSION);

if ($npag=="") { 
	$npag=1;
}


// alfredo 140707  $session->lsvirtual_object= $visit->util->getUrlQuery("",$visit->util->getQueryString());
$_SESSION['lsvirtual_object_clasificacion']= $visit->util->getUrlQuery("",$visit->util->getQueryString());

$visit->options->paginacion=10;
if ($paginacion!="") $visit->options->paginacion=$paginacion;
$visit->options->maxPaginasSiguientes=3;


$urlName=$visit->util->construyeUrlMenosLista("",$visit->util->getRequest(),"npag");
$urlPag=$visit->util->construyeUrlMenosLista("",$visit->util->getRequest(),"npag,paginacion");
$urlOrden=$visit->util->construyeUrlMenosLista("",$visit->util->getRequest(),"orden,orden_tipo");
$ordenar = $orden." ".$orden_tipo;
/*
 * Descomentar y sustituir para Metodo de obtenci�n de filas directo sin filtros.
 $count = $visit->dbBuilder->getVirtualObjectCount(); 
 $inicio = ( $npag - 1 ) * $visit->options->paginacion + 1;
 $filas = $visit->dbBuilder->getVirtualObjectLimit($inicio -1 ,$visit->options->paginacion);
*/

reset($dict);
 $criterios="";
 while (list($k,$v)=each($dict)) {
 
      $patron = "id_";
      if (substr($k,0,strlen($patron))==$patron) {
           $ids = $ids . "," . $v;
		   //$id=$v;
      }
	  $patron2 = "criterio_";
      if (substr($k,0,strlen($patron2))==$patron2) {
		   $idc= substr($k,strlen($patron2),strlen($k));
           if($v != "")
			$criterios = $criterios . " - " . $v;
		   $criterio=$v;
		   $controladosAnteriores[]=array($idc,$criterio);
		   //var_dump($controladosAnteriores);echo('--HHHH-- --');echo"<br><br>";
      }
	 
	  
 }
 $criterios=substr($criterios,2,strlen($criterios));
//var_dump($criterios);echo('FFFFFF ');

$virtualObject = new ClsVirtualObject();

if (trim($ordenar)!="") $virtualObject->_orderby = $ordenar;
$id = $dict["id"];

if ($id ==""){	
	if($visit->options->usuario->esRolUsuario()){
		$count =  $visit->dbBuilder->getOVsClasificacionUserCount("",$controladosAnteriores,"");
	}else if($visit->options->usuario->esRolAdmin()){
		$count =  $visit->dbBuilder->getOVsClasificacionAdminCount("",$controladosAnteriores,"");
	}else if($visit->options->usuario->esRolSuperAdmin()){
		$count =  $visit->dbBuilder->getOVsClasificacionCount("",$controladosAnteriores,"");
	}else{
		$count =  $visit->dbBuilder->getOVsClasificacionNoUserCount("",$controladosAnteriores,"");
		
	}
}else  { 
	if($visit->options->usuario->esRolUsuario()){
		$count =  $visit->dbBuilder->getOVsClasificacionUserCount($id,$controladosAnteriores,"");
	}else if($visit->options->usuario->esRolAdmin()){
		$count =  $visit->dbBuilder->getOVsClasificacionAdminCount($id,$controladosAnteriores,"");
	}else if($visit->options->usuario->esRolSuperAdmin()){
		$count =  $visit->dbBuilder->getOVsClasificacionCount($id,$controladosAnteriores,"");
	}else{
		$count =  $visit->dbBuilder->getOVsClasificacionNoUserCount($id,$controladosAnteriores,"");
		
	}
}
$inicio = ( $npag - 1 ) * $visit->options->paginacion + 1;
if ($count=="") $inicio=0;


if($visit->options->usuario->rol==NULL){
	$objetos = $visit->dbBuilder->getOVsClasificacionNoUserLimit($id,$controladosAnteriores, $inicio - 1 ,$visit->options->paginacion);
	
}


if($visit->options->usuario->esRolUsuario()){
	$objetos = $visit->dbBuilder->getOVsClasificacionUserLimit($id,$controladosAnteriores, $inicio - 1 ,$visit->options->paginacion);
}
if($visit->options->usuario->esRolAdmin()){
	$objetos = $visit->dbBuilder->getOVsClasificacionAdminLimit($id,$controladosAnteriores, $inicio - 1 ,$visit->options->paginacion);
}
if($visit->options->usuario->esRolSuperadmin()){
	$objetos = $visit->dbBuilder->getOVsClasificacionLimit($id,$controladosAnteriores, $inicio - 1 ,$visit->options->paginacion);
}
//CONTROL USUARIOS REGISTRADOS
/*if(!$visit->util->esUserRegistrado()){
		//FILTRADO OBJETOS USUARIOS NO REGISTRADO		
		foreach ($objetos as $key=>$value ){
			if($value->ispublic != "S"){
				$count--;
			}
		}
	}
*/

	
// COMANAGER 1.0: Codigo personalizado
	function getTitulo() {
		return $this->id;
	} 

	function getAvance() {
		global $visit;
		return $visit->util->acortaCadena( $this->id );
	} 
// COMANAGER 1.0: Fin Codigo personalizado
?>

	<script>
		window.onload = function()
		{
		  GetDivPosition();
		}
	</script>
	
<div class="titulopagina">	<?   print $visit->util->migaspan($idpadre,$migas); ?></div>

<div class="campos_clasificacion"> 
	<?  include ( dirname(__FILE__)."/inc_clasificacion_campos.php");?> 
</div>
<?  

 
 ?>

 <?if($count!=0){?>
 
 
<div class="busqueda_paginacion_sup"> <!-- PAGINACION -->
	<FORM METHOD=GET  ACTION="<?= $visit->util->getNombreArchivo( $visit->util->getScriptName() ) ?>" name="formlistado" style="display:inline;">
		<div class="paginacion_resultados">
			<? if($inicio!=0){ ?>
				<?= $inicio ?>-<?= $visit->util->muestrahastareg($visit->options->paginacion,$count,$npag) ?> de <?= $count ?> resultados
			<? } ?>
		</div>
		<div class="paginacion_select" >
			<? $valoresPaginacion= explode(",","10,20,40,60,100,200,400"); ?>
			<select name ="paginacion"  class="selectpeque" style="width:60px;" onChange="window.location.href=construyeUrlMenosMas(window.location.href,'paginacion,npag','paginacion='+formlistado.paginacion.value)" >
				<? for ($i=0;$i<count($valoresPaginacion);$i++) { ?>
					<option value="<?= $valoresPaginacion[$i] ?>" <? if ($visit->options->paginacion==$valoresPaginacion[$i]) print "selected"; ?>><?= $valoresPaginacion[$i] ?>
				<? } ?>				
			</select>
		</div>
		<div class="paginacion_enlaces">
			<? $visit->util->imprimirPaginacionBusqueda($visit->options->paginacion, $visit->options->maxPaginasSiguientes, $count, $npag, $urlName); ?>
		</div>	
	</FORM>
<div class="clearfix"></div>
</div>
<?}else{?>
</br>
<h3 style="margin-left:40%;">No hay objetos a mostrar</h3>
<?}?>
<div> <!-- FICHAS -->
	<form name="form_generacion" action="do.php" method="POST"  style="display:inline;">
		<?		
			
		/* Estas fichas se mostrarán pero no serán accesibles 
		*  para su visualización avanzada (botón "ver mas")
		*/
		function fichaAccesible($ov){
			global $visit;
			$ispublic = "S"==$ov->ispublic;
			//$cond2 = $visit->util->perteneceLista($visit->options->usuario->rol,"A,B");
			$isprivate = "S"==$ov->isprivate;
			$superadmin = $visit->options->usuario->rol=="A";

			return ($isprivate&&$superadmin)||($ispublic&&!$isprivate);
		}
		
		/* Estas fichas son sólo visibles sólo para superadmin 
		*/
		function fichaPrivada($ov){
			global $visit;
			$isprivate = "S"==$ov->isprivate;

			return $isprivate;
		}

		/* Estas fichas son sólo visibles (sólo oculta las privadas)
		*/
		function fichaVisible($ov){
			global $visit;
			$isprivate = "S"==$ov->isprivate;
			$superadmin = $visit->options->usuario->rol=="A";

			return (!$isprivate)||($isprivate&&$superadmin);
			;
		}
	
		function fichaPermiso($ov){
			global $visit;
			$ispublic = "S"==$ov->ispublic;
			$admin = $visit->options->usuario->rol=="B";
			$superadmin = $visit->options->usuario->rol=="A";
			//isprivate=='S' sólo es visible para superadmin
			$isprivate = "S"==$ov->isprivate;
			$permisos = $visit->dbBuilder->getPermisosFromUsuario($visit->options->usuario->id);
			$permisosId = array();
			for($i=0;$i<count($permisos);$i++) {
					array_push($permisosId,$permisos[$i]->idov);
			}
			$permiso=$visit->util->inArray($permisosId,$ov->id);

			return ($superadmin||
				(!$ispublic&&$admin)||
				$permiso);
		}

		$i=0;
	/*	for ($j=0;$j<count($filas);$j++) { 
		
			$inventario= $visit->dbBuilder->obtenerAtributoValorContrFromSeccionOV(99,$filas[$j]->id);
			$inventario=$inventario->value;
		
			$descripcion = $visit->dbBuilder->obtenerAtributoValorContrFromSeccionOV(112,$filas[$j]->id);
			$descripcion=$descripcion->value;

			$nombre = $visit->dbBuilder->obtenerAtributoValorTextFromSeccionOV(111,$filas[$j]->id);
			$nombre=$nombre->value;

			$accesible = fichaAccesible($filas[$j] );
			$conpermiso = fichaPermiso($filas[$j] );
		*/?>	
		<? 
			foreach ($objetos as $clave=>$item){ 
			//var_dump($item);	

			
			if(($visit->util->esUserRegistrado()||(  "N"==$item->ispublic || "N"==$item->isprivate  ))){
			
			if($item->isprivate=="S"){
				
				if($visit->options->usuario->esRolSuperAdmin()){
					
					$visible = true;
					$accesible = true;
					$conpermiso = false;
					$privada = true;
					
				}/*else{
					$visible = false;
					$accesible = false;
					$conpermiso = false;
					$privada = true;
				}*/
			}
			if($item->ispublic=="S"){
				
				if($visit->util->esUserRegistrado()){
					$visible = true;
					$accesible = true;
					$conpermiso = true;
					$privada = false;
				}else{
					$visible = true;
					$accesible = true;
					$conpermiso = true;
					$privada = false;
				}
			}
		
			if((  "N"==$item->ispublic && "N"==$item->isprivate  )){
				if($visit->util->esUserRegistrado()){
					$visible = true;
					$accesible = false;
					$conpermiso = true;
					$privada = false;
				}else{
					$visible = false;
					$accesible = false;
					$conpermiso = false;
					$privada = true;
				}
			}

					if ($visible) {
		?>
				<div class="fila_busqueda">
					<div class="imagen_busqueda"> <!--  ICONO DE LA FICHA -->
						<?	$recurso= $visit->dbBuilder->getIconoFromOV($item->id);
							$rutaicono = "";
							if($recurso==NULL) {
								$rutaicono = "img/ico_ov.gif";
							}
							else{
								$rutaicono = "../bo/download/iconos/".$visit->dbBuilder->getNombreIcono($recurso->idov,$recurso->name);
							}
								/*
								 *
							if($recurso==NULL) {
								$rutaicono = "img/ico_ov.gif";
							} else if($recurso->idresource_refered!="") {
								$rutaicono = "../bo/download/".$recurso->idresource_refered."/".$recurso->name;
							} else {
								$rutaicono = "../bo/download/".$item->id."/".$recurso->name;
							}
							*/
							
						?>
						<? if  ($accesible||$conpermiso) { ?>
							<a href="#" onclick='window.open("cm_view_virtual_object.php?idov=<?=  $item->id ?>&seleccion=1","","width=1000,height=850,scrollbars=yes"); return false;'>
						<? } ?>
							<div style="width:80px; overflow-y:hidden;">
							<? if( file_exists($rutaicono)){?>
								<img src="<?=$rutaicono?>" width="80px" border="0"></img>
							<? } else{?>
								<img src="./img/ico_ov.gif" width="50px" border="0"></img>
								<? }?>
							</div>	
						<? if  ($accesible||$conpermiso) { ?>
							</a>
						<? } ?>
					</div>
					
					<div style="float:left; width:560px;">
						<div class="busqueda_id"> <!-- FICHA  IDENTIFICADOR -->
							<? if  ($accesible||$conpermiso) { ?>
								<a href="#" onclick='window.open("cm_view_virtual_object.php?idov=<?=  $item->id ?>&seleccion=1","","width=1024,height=850,scrollbars=yes"); return false;'>
							<? } ?>
							<b>ID </b>&nbsp;<?=$item->id?>
							<? if  ($accesible||$conpermiso) { ?>
								</a>
							<? } ?>
							&nbsp;-&nbsp;
							<? if  ($accesible) {
										if ($privada) { ?>
										<font style="color:royalblue;">
											Acceso Privado
										</font>
										<? }else{ ?>
										<font style="color:blue;">
											Acceso P&uacute;blico
										</font>
							<? 		}
							   } else if  ($conpermiso) { ?>
								<font style="color:royalblue;">
									Usuarios Registrados
								</font>
							<? } else { ?>
								<font style="color:red;">
									S&oacute;lo usuarios registrados
								</font>
							<? } ?>
							<div class="clearfix"></div>
						</div>
						<div class="clasificacion_datos">
							<div>	<!-- NOMBRE -->
								<?	$nombre = $visit->dbBuilder->obtenerAtributoValorTextFromSeccionOV(111,$item->id);
									$nombre = $nombre->value;
								?>
								<? 	$seccion=$visit->dbBuilder->getSectionDataId(111);?>
								<span class="busqueda_datos_titulo"> <? echo $seccion->nombre;?> : &nbsp; </span>
								<span class="busqueda_datos_texto">
									<? if(strlen($nombre)>500){ 							
								 		print substr($nombre,0,500);
										print "...";				
									 } else { 
										print $nombre; 
									 } ?>
								</span>
							</div>
							<? if($id != "" && $id != "111"){ ?>
								<div><!--  DESCRIPCION -->
							<? 	
									$seccion=$visit->dbBuilder->getSectionDataId($id); 
									if($seccion->tipo_valores == "C")$descripcion = $visit->dbBuilder->obtenerAtributoValorContrFromSeccionOV($id,$item->id);
									if($seccion->tipo_valores == "T")$descripcion = $visit->dbBuilder->obtenerAtributoValorTextFromSeccionOV($id,$item->id);
									if($seccion->tipo_valores == "N")$descripcion = $visit->dbBuilder->obtenerAtributoValorNumFromSeccionOV($id,$item->id);
									if($seccion->tipo_valores == "F")$descripcion = $visit->dbBuilder->obtenerAtributoValorDateFromSeccionOV($id,$item->id);
									$descripcion=$descripcion->value;
									if($seccion->tipo_valores == "F"){									
										$length=strlen($descripcion);
										$ano=substr($descripcion,0,$length-4);
										$mes=substr($descripcion,$length-4,$length-6);
										$dia=substr($descripcion,$length-2,$length);

										$descripcion = $dia.'/'.$mes.'/'.$ano;
									}elseif($seccion->tipo_valores == "N"){	
										$decimales = $visit->dbBuilder->getCantidadDecimales($seccion->id);
										$descripcion = round($descripcion, $decimales); 								
									}
									?>
									<span class="busqueda_datos_titulo"><? echo $seccion->nombre; ?>:&nbsp; </span>
									<span class="busqueda_datos_texto">
										<? if(strlen($descripcion)>500){
											print substr($descripcion,0,500);
											print "...";
										} else {
											print $descripcion;
										}?>	
									</span>									
								</div>	
							<? } ?>
							<div class="clearfix"></div>
						</div>	
						<div class="clearfix"></div>					
					</div>
					
				<div class="clearfix"></div>	
				<? if  ($accesible||$conpermiso) { ?>
				<div class="clasificacion_ver_mas">					
					<a href="#" onclick='window.open("cm_view_virtual_object.php?idov=<?=  $item->id ?>&seleccion=1","","width=1024,height=850,scrollbars=yes"); return false;'>
						[Ver m&aacute;s]
					</a>							
				</div>
				<?}?>
							
				</div><!-- FIN DE UNA FILA -->
				<div class="clearfix"></div>	
		<? 		}
			}
		?>
		
	<? } ?>
	<div class="clearfix"></div>
</div>
<div class="clearfix"></div>
<?if($count!=0){?>
<div class="busqueda_paginacion_inf"> <!-- PAGINACION -->
			<div class="paginacion_resultados">
				<?= $inicio ?>-<?= $visit->util->muestrahastareg($visit->options->paginacion,$count,$npag) ?> de <?= $count ?> resultados &nbsp;
			</div>
			<div class="paginacion_enlaces">
				<? $visit->util->imprimirPaginacionBusqueda($visit->options->paginacion, $visit->options->maxPaginasSiguientes, $count, $npag, $urlName); ?>
			</div>
	<div class="clearfix"></div>
</div>
<?}?>
<?include_once(dirname(__FILE__)."/bottom.php"); ?>