<?php
$navegador = getenv("HTTP_USER_AGENT");
if (preg_match("/MSIE/i", "$navegador")){
	$resultado = "IE";
}else if (preg_match("/Mozilla/i", "$navegador")){
	$resultado = "Mozilla";
}else{
	$resultado = "$navegador";
}
 

$filasNavHijos = $filasNav;
//Maquetacion para IE
if($resultado == "IE"){
		$margenSuperior = "-18px"; 
		$margenLateral = "130px";
	if( $profundidad =="0"){	
		$margenSuperior = "28px";
		$margenLateral = "0px";
	}
}else{
	$margenSuperior = "-18px"; 
	$margenLateral = "153px";
	//echo $idActual.",".$profundidad;
	if( $profundidad == "0"){	
		$margenSuperior = "28px";
		$margenLateral = "0px";
	}
}

?>

<ul>
	<? foreach ($filasNavHijos as $clave=>$hijo){ 	
		if(($hijo->idpadre == $idActual)){		
			//Calcula si tiene hijos
			$haySubHijos = $visit->dbBuilder->hayHijosArray($hijo->id,$filasNavHijos);
			//Calcula el enlace
			$enlace = $visit->util->getEnlaceFromMenu($hijo,$menu);
			$hayInterrogacion1 = strpos($enlace,'?');
			if($hayInterrogacion1){
				$caracterUnion1='&';
			}
			else{
				$caracterUnion1 = '?';
			}	
			
			if($hijo->tipo_contenido !="M" && $hijo->tipo_contenido !="U" ){
				$enlace =$enlace.$caracterUnion1."idpadre=".$hijo->id;								
			}
			?>
			<? if($haySubHijos) {?> <!-- RECURSIVO NIVELES -->
				 <li>
				 	<!-- alfredo 140907 <a href="<?=$enlace;?>" <? if($hijo->tipo_contenido =="M" || $hijo->tipo_contenido =="U" ){?> target="blank" <? }?> > -->
				 	<a href="<?=$enlace;?>" <? if($hijo->tipo_contenido =="M" || $hijo->tipo_contenido =="U" || $hijo->tipo_contenido =="A" ){?> target="blank" <? }?> > 
						<span ><?=$hijo->nombre?></span>
					</a>
				
				<? 	$idCopia= $idActual;
					$idActual = $hijo->id; 
					$caminoItems = $visit->util->obtenerCaminoCategoria($dictFilasNav, "", $hijo->id);
					$profundidad = count($caminoItems)-2; 
				 	include("inc_submenu_superior.php");
					$idActual = $idCopia;
				 ?>	
				</li>
			<? } else if($hijo->tipo_contenido =="C"  ){ ?>  <!-- CATALOGO -->
				<li>
					 <!-- alfredo 140907 <a href="<?=$enlace;?>" <? if($hijo->tipo_contenido =="M" || $hijo->tipo_contenido =="U" ){?> target="blank" <? }?> > -->
					 <a href="<?=$enlace;?>" <? if($hijo->tipo_contenido =="M" || $hijo->tipo_contenido =="U" || $hijo->tipo_contenido =="A" ){?> target="blank" <? }?> >
						<span><?=$hijo->nombre?></span>
					</a>
				
						<? $idCopia= $idActual;
						$idActual = $hijo->id; 
						$caminoItems = $visit->util->obtenerCaminoCategoria($dictFilasNav, "", $hijo->id);
						$profundidad = count($caminoItems)-2;					
						include('inc_subseccion_catalogo_superior.php') ;
						$idActual = $idCopia; ?>
				</li>

			<? } else {?> <!-- SIN HIJOS -->
				<li>
					<!-- alfredo 140907 <a href="<?=$enlace;?>" <? if($hijo->tipo_contenido =="M" || $hijo->tipo_contenido =="U" ){?> target="blank" <? }?> > -->
					<a href="<?=$enlace;?>" <? if($hijo->tipo_contenido =="M" || $hijo->tipo_contenido =="U" || $hijo->tipo_contenido =="A" ){?> target="blank" <? }?> >
						<span ><?=$hijo->nombre?></span>
					</a>
				</li>
			<? } ?>
		<? } ?>
	<? } ?>
</ul>
<!-- </div>  -->