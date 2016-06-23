<?
//$visit->debuger->enable(true);


$idpadre=$menu;
if ($menuActual->idpadre!="0") $idpadre= $menuActual->idpadre;
$filas = $visit->dbBuilder->getNavegacionIzqda();
//var_dump($filas);

$valores = &$filas;
$dictFilas = $visit->util->getDict( $valores );
$sDictFilas = array();
while (list ($clave, $valor) = each ($dictFilas)) { 
	$nombre ="";
	$caminoItems = $visit->util->obtenerCaminoCategoria($dictFilas, "", $valor->id);
	$codigo="";
	if ($caminoItems[0]=="0") {
		for ($i=0;$i<count($caminoItems);$i++) {
			$nombre .= " >> ". $visit->util->numDigitos($dictFilas[$caminoItems[$i]]->orden,5) . "_" . $dictFilas[$caminoItems[$i]]->nombre;
			$codigo .= " >> ". $dictFilas[$caminoItems[$i]]->id;
		}
	}
	if ($nombre!="") {
		$sDictFilas[$nombre] = $valor;
		//print "\n<br>".$codigo."||||".$nombre;
	}
	
}
ksort( $sDictFilas );
$filas = &$sDictFilas;

$presentacion = $visit->dbBuilder->getPreferenciaFromAtributo("navegacion_I_plegada");
$presentacion = $presentacion->valor;


$presentacionCatalogo = $visit->dbBuilder->getPreferenciaFromAtributo("secciones_plegado");
$presentacionCatalogo = $presentacionCatalogo->valor;

?>
<TABLE   border="0" width="100%" cellpadding="0" cellspacing="0">
	<TR>
		<TD style="height:18; background:url(img/destacados_color03.gif) repeat-x ">
		&nbsp;</TD>
	</TR>
</TABLE>
<TABLE   border="0" width="100%" cellpadding="0" cellspacing="0">
	<TR>
		<!--  class="destacadolateralimagen"  -->
		<TD width="100%" style="text-align:center; background:url(img/fondo_destacados.gif) no-repeat right top;background-color:#e5d2aa;border-left:1px solid #000000;border-bottom:1px solid #000000;">
	
			<table width="100%" border="0" cellpadding="0" cellspacing="0"> 
				
				<?
				$currFilas=0;
				$countFilas = count($filas);
				//Imprime recursivamente una tabla desde su nodo $idactual hasta su nodo $idfinal
				// Si $idactual=="" y $idfinal="" imprime solo el primer nivel
				// Si $idfinal==-1 imprime todo lo de debajo a partir de $idactual.
				// Si no sólo se expanden los nodos de $caminoItems
				while (list ($clave, $item) = each ($filas)) {
					$caminoItems = $visit->util->obtenerCaminoCategoria($dictFilas, "", $item->id);
					//var_dump($caminoItems)."####@";
					$ancho=18*(count($caminoItems)-2);
					$enlace = $visit->util->getEnlaceFromMenu($item,$menu);
					//var_dump($item);
					//$keys = array_values($caminoItems);

					//echo var_dump($keys);

				?>
						<tr>
							<TD>										
								<? if (count($caminoItems)-2==0 ){ ?>
								<!-- SI ES VIENE DE NIVEL <>0 -->
									<? if ($currFilas>0) { ?>										
											</td>
										</tr>
									</table>							
									<? } ?>
									<table  border="0" cellpadding="0" cellspacing="0" width='100%'><!-- AQUI -->
									<tr>
										<td>
											<!-- NIVEL 1 -->
											<table width="100%" border="0" cellpadding="0" cellspacing="0" style=""> 		
												<tr>									
													<td class="bloquemenu" onclick="window.location.href = '<?= $enlace ?>'" class='nav'><?=$item->nombre ?></td>
												</tr>
											</table>
											<!-- FIN NIVEL 1 -->
								<? } else if ((count($caminoItems)-2==1 && $presentacion=="N") || ($visit->util->perteneceLista($item->idpadre,$strMenus)) || $menuActual->id == $item->idpadre) { ?>

									<? if($item->id == $menuActual->id || $item->idlangprincipal == $menuActual->idlangprincipal ){?> 
										<table border="0" cellpadding="0" cellspacing="0" width="100%">
											<tr>
												<td class="menuweb"  onmouseover="this.className='menuwebover';" onmouseout="this.className='menuweb';" onclick="window.location.href = '<?= $enlace?>'"><B><I><?= $item->nombre ?></I></B></td>
											</tr>
										</table>
									<? }else{ ?>
										<table border="0" cellpadding="0" cellspacing="0" width="100%">
											<tr>
												<td class="menuweb"  onmouseover="this.className='menuwebover';" onmouseout="this.className='menuweb';" onclick="window.location.href = '<?= $enlace?>'"><?= $item->nombre?></td>	
											</tr>
										</table>
									<? }?>
									
								<? } else if ((count($caminoItems)-2==2 && $presentacion=="N") || ($visit->util->perteneceLista($item->idpadre,$strMenus)) || $menuActual->id == $item->idpadre){ ?>
									
									<? if( $item->idlangprincipal == $menuActual->idlangprincipal   ){?>						
										<table border="0" cellpadding="0" cellspacing="0" width="100%">
											<tr>
												<td class="submenuweb"  onmouseover="this.className='submenuwebover';" onmouseout="this.className='submenuweb';" onclick="window.location.href = '<?= $enlace?>'"><B><I><?= $item->nombre ?></I></B></td>
											</tr>
										</table>
									<? }else{ ?>
										<table border="0" cellpadding="0" cellspacing="0" width="100%">
											<tr>
												<td class="submenuweb"  onmouseover="this.className='submenuwebover';" onmouseout="this.className='submenuweb';" onclick="window.location.href = '<?= $enlace?>'"><?= $item->nombre?></td>	
											</tr>
										</table>
									<? }?>
								<? } ?>					
								<!-- SI ES VIENE DE NIVEL <>0 -->
								<? if ($countFilas==$currFilas+1) { ?>					
										</td>
									</tr>
								</table>							
								<? } ?>
							</TD>
						</TR>
					<?
						$currFilas++;
					?>
				<? } ?>
			</TABLE>
		</TD>
	</TR>
</TABLE>