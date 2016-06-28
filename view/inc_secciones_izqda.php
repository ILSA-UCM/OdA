<?include_once(dirname(__FILE__)."/inc_secciones_logica.php");?>

<script>
    function extiende(clave){
    	var selectorLista = "nivel_izq_" + clave;
    	var selectorImagen = "#imagen_" + clave;
            $('li').each(function(){
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
        $(".hijosnav_"+clave).show();
        if($(selectorImagen).length>0){
	        if( $(selectorImagen).css('background-image').indexOf('ico_mas.png')>0  ){
	        	$(selectorImagen).removeClass("imagen_nav_izq_mas");
	        	$(selectorImagen).addClass("imagen_nav_izq_menos");
	        	
	        }    
	        else{
	        	$(selectorImagen).removeClass("imagen_nav_izq_menos");
	        	$(selectorImagen).addClass("imagen_nav_izq_mas");
	        }
	    }
    }

    function extiende_clasificacion_principal(clave){
    	var selectorLista = "clasificacion_principal_izq_" + clave;
    	var selectorImagen = "#imagen_" + clave;
            $('ul').each(function(){  
                if($(this).attr('id') == selectorLista){
	                if($(this).css('display') == 'none' ){
	                	$(this).show();                        
	                }
	                else{
	                	$(this).hide();                         
	                }
                }
            });        
        
        if( $(selectorImagen).css('background-image').indexOf('ico_mas.png')>0  ){
        	$(selectorImagen).removeClass("imagen_nav_izq_mas");
        	$(selectorImagen).addClass("imagen_nav_izq_menos");
        }    
        else{
        	$(selectorImagen).removeClass("imagen_nav_izq_menos");
        	$(selectorImagen).addClass("imagen_nav_izq_mas");
        }
    }
</script>

<? //Nuevo de IDPadre
$dict=$visit->util->getRequest();
$idpadre= $dict["idpadre"];

if($idpadre!=""){
	$idsPadre=explode(',',$idpadre);
}
//Array de migas de pan
$migas = array();

$caminoActivo = $visit->util->obtenerCaminoCategoria($dictFilasNav, "", $idpadre);
?>

<ul class="navegacion_izq">
	<?$countFilas = count($filasNav);
	//Imprime recursivamente una tabla desde su nodo $idactual hasta su nodo $idfinal
	// Si $idactual=="" y $idfinal="" imprime solo el primer nivel
	// Si $idfinal==-1 imprime todo lo de debajo a partir de $idactual.
	// Si no s�lo se expanden los nodos de $caminoItems
	reset($filasNav);
	$linea = 0;
	$hayNavegables = $visit->dbBuilder->hayNavegables();
	while (list ($clave, $item) = each ($filasNav)) {
		$caminoItems = $visit->util->obtenerCaminoCategoria($dictFilasNav, "", $item->id);
		$keys = array_values($caminoItems);
		$ancho=18*(count($caminoItems)-2);
		$profundidad = count($caminoItems)-2;
		//Creacion del enlace con idpadre
		$enlace = $visit->util->getEnlaceFromMenu($item,$menu);
		$hayInterrogacion = strpos($enlace,'?');
		if($hayInterrogacion){$caracterUnion='&';}
		else{$caracterUnion = '?';}	

		//Muestra a los hijos y los activos en negrita
		$mostrar=false;
		$activo = "inactivo";
		$imagenmostrar="mas";
		$listaVisible = "invisible";
		if($idsPadre){
			$countA = count($caminoActivo);
			for($i = 1; $i<=$countA ;$i++){
				if($caminoActivo[$i] == $item->id){
					//$activo="activo";
					$migas[$item->id] = $item->nombre;
					$mostrar = true;
					//$imagenmostrar="menos";
					//$listaVisible = "visible";
				}
				if($caminoActivo[$i] == $item->idpadre){
					$mostrar = true;
					//	$imagenmostrar="menos";
				}
			}
		}

		//Muestra el icono mas si tiene hijos
		$tieneHijos = $visit->dbBuilder->hayHijosArray($item->id, $filasNav);
		//Mostrar el catalogo clasificacion
		$muestraCatalogo="inactivo";
		if($item->tipo_contenido=="C" && $activo =="activo"){	
			//$muestraCatalogo="activo";
		}

		if (($item->tipo_contenido=="C" && $presentacionCatalogo=="N") || ($item->tipo_contenido=="C" && $item->idlangprincipal == $menuActual->id) || ($item->tipo_contenido=="C" && ($seccion!="" || $seccionp!=""))) {
			$esCatalogo=true;
		}

		$margenIzq= ($profundidad*20)."px";
		$string_jerarquia = "";
		?>
		<?if($item->idpadre== 0){?> <!-- NIVEL 0 -->
			<? if($linea != 0) { ?> 
				<li class="nav_linea_separacion"> </li>
			 <? }?>
			<? //Calcula el enlace
				if($item->tipo_contenido !="M" && $item->tipo_contenido !="U" ){
					$enlace =$enlace.$caracterUnion."idpadre=".$item->id;	
				}
			?>
			<li class="nav_izq_nivel0_<?=$activo?>  nav_<?=$item->id?> hijonav_<?=$item->idpadre?>" id="nivela_<?=$item->id?>" style="margin-left:<?=$margenIzq?>;">
				<? if(($tieneHijos && $item->tipo_contenido !="C") || ( ($hayNavegables || $tieneHijos) && $item->tipo_contenido=="C" )){ ?>
					<div class="imagen_nav_izq_<?=$imagenmostrar?>  extiendehijosnav_<?=$item->id?>" id="imagen_<?=$item->id?>" onclick="extiende(<?=$item->id?>);"  ></div>
				<? }?>
				<!-- alfredo 140907 <a href="<?=$enlace;?>" class="enlacenav_<?=$item->id?>" <? if($item->tipo_contenido =="M" || $item->tipo_contenido =="U" ){?> target="_blank" <? }?> > -->
				<a href="<?=$enlace;?>" class="enlacenav_<?=$item->id?>" <? if($item->tipo_contenido =="M" || $item->tipo_contenido =="U" || $item->tipo_contenido =="A" ){ 
				
				//Reparado JOAQUIN GAYOSO 28/06/2016 ahora si tiene en cuenta el concepto ventana externa
				if ($item->ventanaexterna == "S")
					echo "target=\"_blank\"" ; 
				//Reparado JOAQUIN GAYOSO 28/06/2016
				
				}?> > 
					<?=$item->nombre?> 
				</a>
				<?
				if($item->tipo_contenido =="C" && $hayNavegables){?>
					<ul class="nav_izq_clasificacion_<?=$muestraCatalogo?> nav_izq_clasificacion_<?=$listaVisible?> hijosnav_<?=$item->id?>" id="clasificacion_principal_izq_<?=$item->id?>">
						<? include(dirname(__FILE__)."/inc_submenu_secciones.php");?>
					</ul>
				<? } ?>
			</li>
		<?}else if($mostrar){?> <!-- OTROS NIVELES MOSTRADOS-->
			<? 	//Calcula el enlace
				if($item->tipo_contenido !="M" && $item->tipo_contenido !="U" ){
					$enlace =$enlace.$caracterUnion."idpadre=".$item->id;
				}
			?>
			<li class="nav_izq_nivel1_<?=$activo?> nav_<?=$item->id?> hijonav_<?=$item->idpadre?>" id="nivel_izq_<?=$caminoItems[$profundidad]?>" style="margin-left:<?=$margenIzq?>;display:none;">
				<?if(($tieneHijos && $item->tipo_contenido !="C") || ( ($hayNavegables || $tieneHijos) && $item->tipo_contenido=="C" )){ ?>
					<div class="imagen_nav_izq_<?=$imagenmostrar?> extiendehijosnav_<?=$item->id?>" id="imagen_<?=$item->id?>" onclick="extiende(<?=$item->id?>);"  ></div>
				<? }?>
				<!-- alfredo 140907 <a href="<?=$enlace;?>" class="enlacenav_<?=$item->id?>" <? if($item->tipo_contenido =="M" || $item->tipo_contenido =="U" ){?> target="blank" <? }?> > -->
				<a href="<?=$enlace;?>" class="enlacenav_<?=$item->id?>" <? if($item->tipo_contenido =="M" || $item->tipo_contenido =="U" || $item->tipo_contenido =="A" ){
				
				//Reparado JOAQUIN GAYOSO 28/06/2016 ahora si tiene en cuenta el concepto ventana externa
				if ($item->ventanaexterna == "S")
					echo "target=\"_blank\"" ; 
				//Reparado JOAQUIN GAYOSO 28/06/2016

				}?> > 	
					<?=$item->nombre?> 
				</a>
				<? if($item->tipo_contenido =="C" && $hayNavegables){?>
					<ul class="nav_izq_clasificacion_<?=$muestraCatalogo?> nav_izq_clasificacion_<?=$listaVisible?> hijosnav_<?=$item->id?>" id="clasificacion_principal_izq_<?=$item->id?>">
						<? include(dirname(__FILE__)."/inc_submenu_secciones.php");?>
					</ul>
				<? } ?>
			</li>
		<? } else {?>  <!-- OTROS NIVELES NO MOSTRADOS-->
			<? 	//Calcula el enlace
				if($item->tipo_contenido !="M" && $item->tipo_contenido !="U" ){
					$enlace =$enlace.$caracterUnion."idpadre=".$item->id;
				}
			?>
			<li class="nav_izq_nivel1_<?=$activo?> nav_<?=$item->id?> hijonav_<?=$item->idpadre?>" id="nivel_izq_<?=$caminoItems[$profundidad]?>" style="margin-left:<?=$margenIzq?>;display:none;">
				<?if(($tieneHijos && $item->tipo_contenido !="C") || ( ($hayNavegables || $tieneHijos) && $item->tipo_contenido=="C" )){ ?>
					<div  id="imagen_<?=$item->id?>" class="imagen_nav_izq_<?=$imagenmostrar?> extiendehijosnav_<?=$item->id?>" onclick="extiende(<?=$item->id?>);" style="background-image:url('/<?=APP_NAME?>/view/img/<?=$imagenmostrar?>') no-repeat;">
					</div>
				<?}?>
				<!-- alfredo 140907  <a href="<?=$enlace;?>" class="enlacenav_<?=$item->id?>" <? if($item->tipo_contenido =="M" || $item->tipo_contenido =="U" ){?> target="blank" <? }?> > -->
				<a href="<?=$enlace;?>" class="enlacenav_<?=$item->id?>" <? if($item->tipo_contenido =="M" || $item->tipo_contenido =="U" || $item->tipo_contenido =="A" ){

				//Reparado JOAQUIN GAYOSO 28/06/2016 ahora si tiene en cuenta el concepto ventana externa
				if ($item->ventanaexterna == "S")
					echo "target=\"_blank\"" ; 
				//Reparado JOAQUIN GAYOSO 28/06/2016

				}?> > 	
					<?=$item->nombre?> 
				</a>
				<? if($item->tipo_contenido =="C" && $hayNavegables){?>
					<ul class="nav_izq_clasificacion_<?=$muestraCatalogo?> nav_izq_clasificacion_<?=$listaVisible?> hijosnav_<?=$item->id?>" id="clasificacion_principal_izq_<?=$item->id?>">
						<? include(dirname(__FILE__)."/inc_submenu_secciones.php");?>
					</ul>
				<? } ?>
			</li>
		<?}?>
		<?$linea++;?>
	<?}?>	<!-- FIN DE UNA LINEA -->
</ul>