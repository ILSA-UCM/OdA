<?
$filasNav = $visit->dbBuilder->getNavegacionIzqda();


$valoresNav = &$filasNav;
$dictFilasNav = $visit->util->getDict( $valoresNav );
$sDictFilasNav = array();
while (list ($clave, $valor) = each ($dictFilasNav)) { 
	$nombre ="";
	$caminoItems = $visit->util->obtenerCaminoCategoria($dictFilasNav, "", $valor->id);
	$codigo="";
	if ($caminoItems[0]=="0") {
		for ($i=0;$i<count($caminoItems);$i++) {
			$nombre .= " >> ". $visit->util->numDigitos($dictFilasNav[$caminoItems[$i]]->orden,5) . "_" . $dictFilasNav[$caminoItems[$i]]->nombre;
			$codigo .= " >> ". $dictFilasNav[$caminoItems[$i]]->id;
		}
	}
	if ($nombre!="") {
		$sDictFilasNav[$nombre] = $valor;
		//print "\n<br>".$codigo."||||".$nombre;
	}
	
}
ksort( $sDictFilasNav );
$filasNav = &$sDictFilasNav;
//echo("ins_sec_log");
//var_dump($menuActual);
//$menuTraducido = $visit->dbBuilder->getFilaFromIdlangprincipal($menuActual,$_GET["menu"],$_GET["lang"]);
//$caminoItemsSeccionActual = $visit->util->obtenerCaminoCategoria($dictFilasNav, "", $menuTraducido->id);
//$seccionPrincipalActiva =$caminoItemsSeccionActual[1]; 

$dict=$visit->util->getRequest();
$idpadre= $dict["idpadre"];

if($idpadre!=""){
	$idsPadre=explode(',',$idpadre);
}
	//Array de migas de pan
	$migas = array();
	$caminoActivo = $visit->util->obtenerCaminoCategoria($dictFilasNav, "", $idpadre);
	$countFilas = count($filasNav);
	reset($filasNav);
	$linea = 0;
	$hayNavegables = $visit->dbBuilder->hayNavegables();
	while (list ($clave, $item) = each ($filasNav)) {
		$caminoItems = $visit->util->obtenerCaminoCategoria($dictFilasNav, "", $item->id);

		if($idsPadre){
			$countA = count($caminoActivo);
			for($i = 1; $i<=$countA ;$i++){
				if($caminoActivo[$i] == $item->id){
					$migas[$item->id] = $item->nombre;
				}
			}
		}
	}
?>