<script type="text/javascript">
	function extiende_clasificacion_izq(clave){
		var selectorLista = "caja_izq_" + clave;
		var selectorImagen = "#imagen_" + clave;
		 $('div').each(function(){
	        //  alert($(this).attr('id'));   
	          if($(this).attr('id') == selectorLista){
	              if($(this).css('display') == 'none' ){
	              	$(this).show();                        
	              }
	              else{
	              	$(this).hide();                         
	              }
	          }
      	});
		if($(selectorImagen).length>0){
		  	if( $(selectorImagen).css('background-image').indexOf('ico_mas.png')>0  ){
			  		$(selectorImagen).removeClass("imagen_nav_izq_mas");
					$(selectorImagen).addClass("imagen_nav_izq_menos");
			}else if( $(selectorImagen).css('background-image').indexOf('ico_menos.png')>0  ){
			  		$(selectorImagen).removeClass("imagen_nav_izq_menos");
					$(selectorImagen).addClass("imagen_nav_izq_mas");
		   	}else if( $(selectorImagen).css('background-image').indexOf('flecha_expan.png')>0  ){
			  		$(selectorImagen).removeClass("imagen_nav_izq_flecha_expan");
					$(selectorImagen).addClass("imagen_nav_izq_flecha_noexpan");
		 	}else if( $(selectorImagen).css('background-image').indexOf('flecha_noexpan.png')>0  ){
		  		$(selectorImagen).removeClass("imagen_nav_izq_flecha_noexpan");
				$(selectorImagen).addClass("imagen_nav_izq_flecha_expan");
		 	}else if( $(selectorImagen).css('background-image').indexOf('flecha_expan_vacio.png')>0  ){
		  		$(selectorImagen).removeClass("imagen_nav_izq_flecha_expan_vacio");
				$(selectorImagen).addClass("imagen_nav_izq_flecha_noexpan_vacio");
			}else if( $(selectorImagen).css('background-image').indexOf('flecha_noexpan_vacio.png')>0  ){
				$(selectorImagen).removeClass("imagen_nav_izq_flecha_noexpan_vacio");
				$(selectorImagen).addClass("imagen_nav_izq_flecha_expan_vacio");
			}
		}
	}
</script>

<?
include_once(dirname(__FILE__)."/include.php");
global $visit;
$url= $visit->util->getUrlQuery("",$visit->util->getQueryString());
$controladosAnteriores= array();
$dict = $visit->util->getRequest();
 $idpadre = $item->id;
 $id = $dict["id"];
 //Calcular el camino de ids clasificacion activos
//$sectionDatas =$visit->dbBuilder->getSectionData();
$sectionDatas=$visit->dbBuilder->getSectionData();
$dictFilasSectionData = $visit->util->getDict( $sectionDatas );
$caminoClasificacion = $visit->util->obtenerCaminoClasificacion($sectionDatas,"1",$id);
$idActivo = explode(",",$caminoClasificacion);
$idUltimoActivo=$idActivo[count($idActivo)-1];
//var_dump($idActivo);
$strIdsPrimerNivel = $visit->util->f1("0");
$vStrIdsPrimerNivel = explode(",",$strIdsPrimerNivel );
$hayNavigation=$visit->dbBuilder->hayNavegables();
?>

<?for($k=0;$k<count($vStrIdsPrimerNivel);$k++){?>
	<?
	$expandido = false;
	//$fila = $visit->dbBuilder->getSectionDataId($vStrIdsPrimerNivel[$k]); 
	$fila=$dictFilasSectionData[$vStrIdsPrimerNivel[$k]];
	$visibleHijo ="invisible";
	$act = "inactivo";
	$imagenmostrar = "mas";	
	if($fila->id == $idActivo[1]) { 
		//$act = "activo";
		//$imagenmostrar = "menos";
		//$visibleHijo ="visible";
		$migas[$fila->id] = $fila->nombre; //Miga de pan (creada en inc_seccion_izq)	
		if($idUltimoActivo ==  $seccion_id){$nivelAMostrar = 2;}
		else{$nivelAMostrar = 0;}
	}
	//Comprobar si hay secciones hijas
	$navegables= explode(",",$visit->util->f1($fila->id));
	$hayNavegables = $visit->dbBuilder->hayHijosNavegablesClasificacion($fila->id,"");
	$objetos_con_valor = $fila->getHijosFromValor("");
	$tengo_objetos = count($objetos_con_valor)>0;

	//if(($fila->idpadre!=1)
	//echo $fila->id;
	// alfredo 2013 0706  id!=1 en vez de 112
	if($tengo_objetos || $hayNavegables){?>	
		<li class="nav_izq_clasificacion_<?=$act?> sec_<?=$fila->id?> hijosec_<?=$fila->idpadre?> hijonav_<?=$item->id?>" id="clasificacion_izq_<?=$fila->id?>"  style="padding-bottom:8px;">
			<div class="maxHeight">
				<? if($hayNavigation){ ?>
					<? $enlace= "/".APP_NAME."/view/ls_ov_clasificacion.php?id=".$fila->id."&paginacion=10&idpadre=".$item->id;?>
					<? if($hayNavegables){?>
						<span class="imagen_nav_izq_<?=$imagenmostrar?> extiendehijossec_<?=$fila->id?>" id="imagen_<?=$fila->id?>" onclick="extiende_clasificacion_izq(<?=$fila->id?>);" ></span>
					<? }?>
					<a href="<?= $enlace ?>" class="enlacesec_<?=$fila->id?>"> 
						<span class="nombre_seccion"><?= $fila->nombre ?></span>
					</a>
				<? } else { ?>
					<span>- Ninguna sección navegable</span>
				<? } ?>
				<?if ($hayNavigation) {
					imprimeNavegacion($fila->id, array(), 1, $idpadre,$visibleHijo,$fila->id,$idActivo,$dictFilasSectionData);
				}?>
			</div>
		</li>
	<?}?>
<?}?>
<div class="clearfix"></div>
<?
function imprimeNavegacion($idseccion, $acum_navegacion, $nivel,$idpadre,$visible,$idActivador,$caminoIds,$arSectionData) {
	global $visit;
	$dict = $visit->util->getRequest();
	$url = $visit->util->construyeURLClasificacion($acum_navegacion,$idpadre,$idseccion);
	$margenIzq = ($nivel*10)."px";
	$controlados = array();

	$seccion=$arSectionData[$idseccion];
	if ($seccion->tipo_valores=="C") {
		$controlados=$visit->dbBuilder->getHijosFromValorControlado($idseccion,$acum_navegacion);
	}  else if ($seccion->tipo_valores=="N") {
		$controlados=$visit->dbBuilder->getHijosFromValorNumerico($idseccion,$acum_navegacion);
	}  else if ($seccion->tipo_valores=="T") {
		$controlados=$visit->dbBuilder->getHijosFromValorTexto($idseccion,$acum_navegacion);
	}  else if ($seccion->tipo_valores=="F") {
		$controlados=$visit->dbBuilder->getHijosFromFecha($idseccion,$acum_navegacion);
	//}else if ($seccion->tipo_valores =="X"){
	} else {
		$controlados=$visit->dbBuilder->getHijosFromValorControlado($idseccion,$acum_navegacion);
	}
	$seccionesNavegables= explode(",",$visit->util->f1($idseccion));

	if ($controlados!=""){
		if($controlados[0] != "" ){?>
			<div class="caja nav_izq_clasificacion_<?=$visible?> sec_<?=$seccion->id?> hijosec_<?=$seccion->idpadre?>" id="caja_izq_<?=$idActivador?>">
				<?if ($nivel > 1 )
					if($visit->dbBuilder->isSeccionAccesible($seccion->id)){/*Pintar la cabrecera*/?>
				 		<div class="elemento_cabecera cabecerasec_<?=$seccion->id?>">- <?=$seccion->nombre?></div>
				 	<?}?>
					<?$isSeccionAccesible=$visit->dbBuilder->isSeccionAccesible($seccion->id);?>
					<?$decimales= $visit->dbBuilder->getCantidadDecimales($idseccion);?>
					<? foreach($controlados as $key=>$value){
						if($isSeccionAccesible)
						if($value->value!= "" && $seccion->tipo_valores != "X"){ 
							$acum_nuevo = $acum_navegacion;
							$acum_nuevo[$idseccion]= $value->value;
							$enlace= $url."&criterio_".$idseccion."=".$value->value."&value=".$value->idov;
							//Hijos Navegables
							$hayNavegables = $visit->dbBuilder->hayHijosNavegablesClasificacion($idseccion,$acum_nuevo);

							//Nombre del elemento controlado
							if(strlen($value->value)>20){
								$cadena = substr($value->value,0,20)."...";
							} else {
								$cadena = $value->value;
							}
							if ($seccion->tipo_valores == "N"){
								$numdec = $decimales;
								$cadena= round($cadena,$numdec)." (".$value->cuenta.")";
							}else if( $seccion->tipo_valores == "F" ){
								$length=strlen($cadena);
								$ano=substr($cadena,0,$length-4);
								$mes=substr($cadena,$length-4,$length-6);
								$dia=substr($cadena,$length-2,$length);

								$cadena = $dia.'/'.$mes.'/'.$ano;
								$cadena = $cadena."(".$value->cuenta.")";									
							}else{
								$cadena= $cadena."(".$value->cuenta.")";					
							}
							//creamos el identificador de la caja siguiente	y la clase activa o inactiva actual			
							$identificadorCaja= $idseccion."-".str_replace(" ", "-",$value->value);
							$identificadorCaja = $visit->util->normalizeString($identificadorCaja);
							$activo = "inactivo";
							if($dict["criterio_".$idseccion]==$value->value){
								//$activo = "activo";
							}?>
							<div class="elemento_texto value_<?=$value->idov?> criterio criterio_inactivo" id="criterio_<?=str_replace(" ", "-", $value->value)?>">
								<?if($hayNavegables){
									if($activo =="activo"){?>
										<div  onclick="extiende_clasificacion_izq('<?=$identificadorCaja?>');" class="imagen_nav_izq_flecha_expan extiendehijosvalue_<?=$value->idov?> extiendehijosvalue" id="imagen_<?=$identificadorCaja?>">
											<!-- <img src="./img/ico_flecha_dcha.png" alt=""/> -->
										</div>
									<? }else{ ?>
										<div  onclick="extiende_clasificacion_izq('<?=$identificadorCaja?>');" class="imagen_nav_izq_flecha_noexpan_vacio extiendehijosvalue_<?=$value->idov?> extiendehijosvalue" id="imagen_<?=$identificadorCaja?>">
											<!-- <img src="./img/ico_flecha_dcha.png" alt=""/> -->
										</div>
									<? }?>
								<?}else{
									if($activo =="activo"){?>
										<div class="imagen_nav_izq_circulo extiendehijosvalue_<?=$value->idov?> extiendehijosvalue" id="imagen_<?=$identificadorCaja?>">
											<!-- <img src="./img/ico_circulo.png" alt=""/> -->
										</div>
									<?} else { ?>
										<div class="imagen_nav_izq_circulo_vacio extiendehijosvalue_<?=$value->idov?> extiendehijosvalue" id="imagen_<?=$identificadorCaja?>">
											<!-- <img src="./img/ico_circulo.png" alt=""/> -->
										</div>
									<?} ?>
								<?}?>
								<span>
									<a href="<?=$enlace?>" class="enlace_value enlacevalue_<?=$value->idov?>">
									 	<span class=""><?=$cadena?></span>
									</a>
								</span>
								<? //Mostrar los hijos (si hay)
								if($hayNavegables){	
									//Calcular si el siguiente es visible
									$visibleHijo ="invisible";
									if($dict["criterio_".$idseccion]==$value->value){
										//$visibleHijo = "visible";
									}
									reset($seccionesNavegables);
									foreach($seccionesNavegables as $k=>$secHija){
										if($secHija != "") 	imprimeNavegacion($secHija, $acum_nuevo, $nivel+1, $idpadre,$visibleHijo,$identificadorCaja,$caminoIds,$arSectionData) ;
									}
								}?>
							</div>
						<?}//FIN DE UN ELEMENTO
					} //FIN DE TODOS LOS ELEMENTOS?>
					<div class="clearfix"></div>
			</div>
		<?}else if($seccion->tipo_valores = "X"){//Si no hay elementos pero si hay secciones hijas. Mostrar los hijos (si hay)
			if($visit->dbBuilder->hayHijosNavegablesClasificacion($idseccion, $acum_navegacion)){
				if($nivel > 1){?>
					<div class="caja nav_izq_clasificacion_<?=$visible?> sec_<?=$seccion->id?> hijosec_<?=$seccion->idpadre?>" id="caja_izq_<?=$idActivador?>">
						<div class="elemento_cabecera cabecerasec_<?=$seccion->id?>">- <?=$seccion->nombre?></div>
				<?}
				reset($seccionesNavegables);
				foreach($seccionesNavegables as $k=>$secHija){
					if($secHija != ""){
						imprimeNavegacion($secHija, $acum_navegacion, $nivel+1, $idpadre,$visible,$idActivador,$caminoIds,$arSectionData) ;
					}
				}
				if($nivel > 1){?>
					</div>
				<?}
			}
		}
	}
}?>