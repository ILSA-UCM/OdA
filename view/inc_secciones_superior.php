<?
include_once(dirname(__FILE__)."/inc_secciones_logica.php");
?>
<script type="text/javascript" src="/<?=APP_NAME?>/view/misc/scripts/ddsmoothmenu.js"></script>
<link rel="stylesheet" type="text/css" href="/<?=APP_NAME?>/view/css/menu_sup/ddsmoothmenu.css" />


<script type="text/javascript">

	ddsmoothmenu.init({
		mainmenuid: "nav_sup", //menu DIV id
		orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
		classname:'ddsmoothmenu', //class added to menu's outer DIV
		contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
	})
	
	$(document).ready(function (){
		$("#nav_sup").removeClass("oculto");
	});

</script>

<div id="nav_sup" class="nav_sup oculto">
	<ul>
		<?
		$idpadre = $dict["idpadre"];
		$caminoActivo = $visit->util->obtenerCaminoCategoria($dictFilasNav, "", $idpadre);
		$idspadre = $caminoActivo[1];
		//Imprime recursivamente una tabla desde su nodo $idactual hasta su nodo $idfinal
		// Si $idactual=="" y $idfinal="" imprime solo el primer nivel
		// Si $idfinal==-1 imprime todo lo de debajo a partir de $idactual.
		// Si no sólo se expanden los nodos de $caminoItems
		reset($filasNav);
		$countFilas = count($filasNav);
		while (list ($clave, $item) = each ($filasNav)) {
			$idActual = $item->id;
			$caminoItems = $visit->util->obtenerCaminoCategoria($dictFilasNav, "", $item->id);
			//var_dump($caminoItems)."####@";
			$ancho=18*(count($caminoItems)-2);
			$enlace = $visit->util->getEnlaceFromMenu($item,$menu);
			$profundidad = count($caminoItems)-2;
			//Calcula si tiene Hijos
			$hayHijos = $visit->dbBuilder->hayHijosArray($item->id, $filasNav);
			if (($item->tipo_contenido=="C" && $presentacionCatalogo=="N") || ($item->tipo_contenido=="C" && $item->idlangprincipal == $menuActual->id) || ($item->tipo_contenido=="C" && ($seccion!="" || $seccionp!=""))) {
				$esCatalogo=true;
			}

			//Cambia a blanco el fondo
			$activo = "inactivo";
			if(($idspadre == $item->id)&&($visit->dbBuilder->isOVVisible($item->id))){
				$activo = "activo";
			}

			//Creacion del enlace con idpadre
			$enlace = $visit->util->getEnlaceFromMenu($item,$menu);
			$hayInterrogacion = strpos($enlace,'?');
			if($hayInterrogacion){
				$caracterUnion='&';
			} else {
				$caracterUnion = '?';
			}?>
			<? if ($profundidad==0){ ?> <!-- NIVEL 0 -->
				<? //Calcula el enlace
					if($item->tipo_contenido !="M" && $item->tipo_contenido !="U" ){
						$enlace =$enlace.$caracterUnion."idpadre=".$item->id;	
					}
				?>
				<? if($activo =="activo"){?>
					 <li >
						<!-- alfredo 140907 <a href="<?=$enlace;?>"  <? if($item->tipo_contenido =="M" || $item->tipo_contenido =="U" ){?> target="_blank" <? }?> > -->
						<a href="<?=$enlace;?>"  <? if($item->tipo_contenido =="M" || $item->tipo_contenido =="U" || $item->tipo_contenido =="A" ){
							
							//Reparado JOAQUIN GAYOSO 27/03/2017 ahora si tiene en cuenta el concepto ventana externa
				if ($item->tipo_contenido =="M" || $item->ventanaexterna == "S")
					echo "target=\"_blank\"" ; 
				//Reparado JOAQUIN GAYOSO 27/03/2017 
							
						}?> > 
							<span class="pestana_sup_centro" style=" background-color: #FFFFFF; color:#1159AE;padding:5px;">&nbsp;<?=$item->nombre?>&nbsp;</span>
						</a>
						<? if($item->tipo_contenido =="C"){
							$idCopia= $idActual;
							$idActual = $item->id;
							$caminoItems = $visit->util->obtenerCaminoCategoria($dictFilasNav, "", $item->id);
							$profundidad = count($caminoItems)-2;
							include('inc_subseccion_catalogo_superior.php') ;
							$idActual = $idCopia;
						} ?>
						<? if($hayHijos) {
							include("inc_submenu_superior.php"); 
						}?>
					</li>
				<? } else {?>
					<li>
						<!-- alfredo 140907 <a href="<?=$enlace;?>" <? if($item->tipo_contenido =="M" || $item->tipo_contenido =="U" ){?> target="_blank" <? }?> > -->
						<a href="<?=$enlace;?>" <? if($item->tipo_contenido =="M" || $item->tipo_contenido =="U" || $item->tipo_contenido =="A" ){

//Reparado JOAQUIN GAYOSO 27/03/2017 ahora si tiene en cuenta el concepto ventana externa
				if ($item->tipo_contenido =="M" || $item->ventanaexterna == "S")
					echo "target=\"_blank\"" ; 
				//Reparado JOAQUIN GAYOSO 27/03/2017 

						}?> >	
							<span class="pestana_sup_centro">&nbsp;<?=$item->nombre?>&nbsp; </span>
						</a>
						<? if($item->tipo_contenido =="C"){
							$idCopia= $idActual;
							$idActual = $item->id;
							$caminoItems = $visit->util->obtenerCaminoCategoria($dictFilasNav, "", $item->id);
							$profundidad =0;
							include('inc_subseccion_catalogo_superior.php') ;
							$idActual = $idCopia;
						} ?>
						<? if($hayHijos) {
							include("inc_submenu_superior.php"); 
						}?>
					</li>
				<? } ?>
			<? } ?>
		<? } ?> <!-- FIN DE LINEA -->
	</ul>
</div>

<script>
	function enciende_sup(clave){
		var selectorLista = "#nivel_sup_" + clave;
		$(selectorLista).show();
	}
	function apaga_sup(clave){
		var selectorLista = "#nivel_sup_" + clave;
		$(selectorLista).hide();
	}
	function extiende_sup(clave){
		var selectorLista = "#nivel_sup_" + clave;
			if( $(selectorLista).css('display') == 'none' ){
				$(selectorLista).show();
			}
			else if($(selectorLista).css('display') =='block'){
				$(selectorLista).hide();
			}
	}
</script>