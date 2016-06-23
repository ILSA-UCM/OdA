<?php
	
function navegacionMenusStyle() { ?>
<style>
	/* Thanks to http://qrayg.com/experiment/cssmenus/# */
	
	/* Root = Horizontal, Secondary = Vertical */
	ul#navmenu-h {
	  margin: 0;
	  border: 0 none;
	  padding: 0;
	  width: 100%; /*For KHTML*/
	  list-style: none;
	  height: 24px;
	}
	
	ul#navmenu-h li {
	  margin: 0;
	  border: 0 none;
	  padding: 0;
	  float: left; /*For Gecko*/
	  display: inline;
	  list-style: none;
	  position: relative;
	  height: 24px;
	}
	
	ul#navmenu-h ul {
	  margin: 0;
	  border: 0 none;
	  padding: 0;
	  width: 160px;
	  list-style: none;
	  display: none;
	  position: absolute;
	  top: 24px;
	  left: 0;
	}
	
	ul#navmenu-h ul:after /*From IE 7 lack of compliance*/{
	  clear: both;
	  display: block;
	  font: 1px/0px serif;
	  content: ".";
	  height: 0;
	  visibility: hidden;
	}
	
	ul#navmenu-h ul li {
	  width: 160px;
	  float: left; /*For IE 7 lack of compliance*/
	  display: block !important;
	  display: inline; /*For IE*/
	}
	
	/* Root Menu */
	ul#navmenu-h a {
	  border-right-color: #00F;
	  border-bottom-color: #00F;
	  padding: 0 6px;
	  float: none !important; /*For Opera*/
	  float: left; /*For IE*/
	  display: block;
	  background: #000;
	  color: #FFF;
	  font: bold 10px/22px Verdana, Arial, Helvetica, sans-serif;
	  text-decoration: none;
	  height: auto !important;
	  height: 1%; /*For IE*/
	}

	/* Root Menu Hover Persistence */
	ul#navmenu-h a:hover,
	ul#navmenu-h li:hover a,
	ul#navmenu-h li.iehover a {
	  background: #05C;
	  color: #FFF;
	}
	
	/* 2nd Menu */
	ul#navmenu-h li:hover li a,
	ul#navmenu-h li.iehover li a {
	  border: 1px solid #FFF;
	  float: none;
	  background: #000;
	  color: #FFF;
	}
	
	/* 2nd Menu Hover Persistence */
	ul#navmenu-h li:hover li a:hover,
	ul#navmenu-h li:hover li:hover a,
	ul#navmenu-h li.iehover li a:hover,
	ul#navmenu-h li.iehover li.iehover a {
	  background: #05C;
	  color: #FFF;
	}
	
	/* 3rd Menu */
	ul#navmenu-h li:hover li:hover li a,
	ul#navmenu-h li.iehover li.iehover li a {
	  background: #000;
	  color: #FFF;
	}
	
	/* 3rd Menu Hover Persistence */
	ul#navmenu-h li:hover li:hover li a:hover,
	ul#navmenu-h li:hover li:hover li:hover a,
	ul#navmenu-h li.iehover li.iehover li a:hover,
	ul#navmenu-h li.iehover li.iehover li.iehover a {
	  background: #05C;
	  color: #FFF;
	}
	
	/* 4th Menu */
	ul#navmenu-h li:hover li:hover li:hover li a,
	ul#navmenu-h li.iehover li.iehover li.iehover li a {
	  background: #EEE;
	  color: #666;
	}
	
	/* 4th Menu Hover */
	ul#navmenu-h li:hover li:hover li:hover li a:hover,
	ul#navmenu-h li.iehover li.iehover li.iehover li a:hover {
	  background: #CCC;
	  color: #FFF;
	}
	
	ul#navmenu-h ul ul,
	ul#navmenu-h ul ul ul {
	  display: none;
	  position: absolute;
	  top: 0;
	  left: 160px;
	}
	
	/* Do Not Move - Must Come Before display:block for Gecko */
	ul#navmenu-h li:hover ul ul,
	ul#navmenu-h li:hover ul ul ul,
	ul#navmenu-h li.iehover ul ul,
	ul#navmenu-h li.iehover ul ul ul {
	  display: none;
	}
	
	ul#navmenu-h li:hover ul,
	ul#navmenu-h ul li:hover ul,
	ul#navmenu-h ul ul li:hover ul,
	ul#navmenu-h li.iehover ul,
	ul#navmenu-h ul li.iehover ul,
	ul#navmenu-h ul ul li.iehover ul {
	  display: block;
	}

</style>

<? }

function navegacionMenus($visit) {
///* Quitar barras para comentar

	// Controlar barra de navegación
	$expand = $_GET['expand'];
	$faceta = isset($_GET['faceta']) ? $_GET['faceta'] : "";
	$from = $_GET['from'];
	$mainId = $_GET['id'];
	
	
	// Si no existe el vector de navegación
	if(!isset($_SESSION['menu_navegacion'])){
		$par = array(0,"");
		$_SESSION['menu_navegacion'] = array($par);
	}
	
	// Corregir el vector
	if($from < count($_SESSION['menu_navegacion']) - 1){
		$aux = array_chunk($_SESSION['menu_navegacion'], $from + 1);
		$_SESSION['menu_navegacion'] = $aux[0];
	}
	
	// Expandir
	$par = array($expand, $faceta);
	array_push($_SESSION['menu_navegacion'], $par);
	
	// Pintar barra
	echo('<ul id="navmenu-h">');
	
		// Recorrer la navegación
		$url = "";
		$restringidos = array();
		
		for($i = 0; $i < count($_SESSION['menu_navegacion']); $i++){
			// Obtener id de la sección
			$id = $_SESSION['menu_navegacion'][$i][0];
			$facetaActual = $_SESSION['menu_navegacion'][$i][1];
			$facetaParentesis = $facetaActual == "" ? "" : '('.$facetaActual.')';
			
			// Para mostrar los objetos virtuales que correspondan
			if($i >= 2) {
				array_push($restringidos, array($id, $facetaActual));
				$url = $url."&criterio_".$id."=".$facetaActual;
			}
			
			// Para el primero
			if($i == 0){
				// Primer menu, siempre disponible
				echo('<li style="color:#FFFFFF;"><a href="#">&raquo;</a>');
				
				// Primer paso de la clasificación
				$query = "SELECT id, nombre FROM section_data WHERE browseable = 'S' AND (idpadre = 1 OR idpadre = 2) ORDER BY nombre";
				$rs = $visit->dbBuilder->conn->Execute($query);
			
				echo('<ul>');
				
					while($row = $rs->FetchRow()){
						// Id de la subsección
						$subsId = $row['id'];
						
						// Obtener facetas
						// Controlado
						if ($row['tipo_valores'] == "C") {
							$facetas = $visit->dbBuilder->getHijosFromValorControlado($subsId, $restringidos);
							
						// Numéricos
						}  else if ($row['tipo_valores'] == "N") {
							$facetas = $visit->dbBuilder->getHijosFromValorNumerico($subsId, $restringidos);
							
						// Texto (y otros)
						} else {
							$facetas = $visit->dbBuilder->getHijosFromValorTexto($subsId, $restringidos);
						}
						
						// Imprimir subsección y facetas
						echo('<li><a href="generico.php?id='.$row['id'].'&expand='.$row['id'].'&from='.$i.'">'.$row['nombre'].' '.(count($facetas) ? '&raquo;' : '').'</a>');
						
						// Lista de facetas
						echo('<ul>');
						
							for($j = 0; $j < count($facetas); $j++){
								// Título
								if($j == 0) echo('<li><a href="#">Valores</a></li>');
								
								// Valores
								if($facetas[$j]->cuenta){
									$miCriterio = $url.'&criterio_'.$subsId.'='.$facetas[$j]->value;
									echo('<li><a href="ls_ov_clasificacion.php?id='.$mainId.'&expand='.$row['id'].'&faceta='.$facetas[$j]->value.'&from='.$i.$miCriterio.'">'.$facetas[$j]->value.' ('.$facetas[$j]->count.')</a></li>');
								}
						}
							
						echo('</ul>');
						echo('</li>');
						
					}			
					
				echo('</ul>');
				echo('</li>');
			
			// Resto
			} else {	
				// Obtener nombre del taxón
				$query = "SELECT nombre FROM section_data WHERE id = $id ORDER BY nombre";
				$rs = $visit->dbBuilder->conn->Execute($query);
				$row = $rs->FetchRow();
				
				echo('<li><a href="#">'.$row['nombre'].' '.$facetaParentesis.($i != count($_SESSION['menu_navegacion']) - 1 ? ' &raquo;' : '').'</a>');
				
				// Obtener clasificaciones
				$query = "SELECT id, nombre, tipo_valores FROM section_data WHERE browseable = 'S' AND idpadre = $id ORDER BY nombre";
				$rs = $visit->dbBuilder->conn->Execute($query);
			
				echo('<ul>');
			
				while($row = $rs->FetchRow()){
					// Id de la subsección
					$subsId = $row['id'];
					
					// Obtener facetas
					// Controlado
					if ($row['tipo_valores'] == "C") {
						$facetas = $visit->dbBuilder->getHijosFromValorControlado($subsId, $restringidos);
						
					// Numéricos
					}  else if ($row['tipo_valores'] == "N") {
						$facetas = $visit->dbBuilder->getHijosFromValorNumerico($subsId, $restringidos);
						
					// Texto (y otros)
					} else {
						$facetas = $visit->dbBuilder->getHijosFromValorTexto($subsId, $restringidos);
					}
					
					// Imprimir subsección y facetas
					echo('<li><a href="ls_ov_clasificacion.php?id='.$mainId.'&expand='.$row['id'].'&from='.$i.'">'.$row['nombre'].' '.(count($facetas) ? '&raquo;' : '').'</a>');
					
					// Lista de facetas
					echo('<ul>');
						for($j = 0; $j < count($facetas); $j++){
							// Título
							if($j == 0) echo('<li><a href="#">Valores</a></li>');
							
							// Valores
							if($facetas[$j]->cuenta){
								$miCriterio = $url.'&criterio_'.$subsId.'='.$facetas[$j]->value.'&count='.$facetas[$j]->cuenta;
								echo('<li><a href="ls_ov_clasificacion.php?id='.$mainId.'&expand='.$row['id'].'&faceta='.$facetas[$j]->value.'&from='.$i.$miCriterio.'">'.$facetas[$j]->value.' ('.$facetas[$j]->cuenta.')</a></li>');
							}
						}
						
					echo('</ul>');
					echo('</li>');
					
				}			
				
			echo('</ul>');	
			echo('</li>');	
			}
			
				if(!isset($expand)){
					echo('</ul>');
					return;
				}
		}
	echo('</ul>');
//*/
}
	
?>