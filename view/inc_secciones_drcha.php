<?
//$visit->debuger->enable(true);
$idpadre=$menu;
if ($menuActual->idpadre!="0") $idpadre= $menuActual->idpadre;
$filas = $visit->dbBuilder->getNavegacionDerecha();


$valores = &$filas;
$dictFilas = $visit->util->getDict( $valores );
$sDictFilas = array();
while (list ($clave, $valor) = each ($dictFilas)) { 
	$nombre ="";
	$caminoItems = $visit->util->obtenerCaminoCategoria($dictFilas, "", $valor->id);
	for ($i=0;$i<count($caminoItems);$i++) $nombre .= " >> ". $visit->util->numDigitos($dictFilas[$caminoItems[$i]]->orden,5) . "_" . $dictFilas[$caminoItems[$i]]->nombre;
	$sDictFilas[$nombre] = $valor;
}
ksort( $sDictFilas );
$filas = &$sDictFilas;


$presentacion = $visit->dbBuilder->getPreferenciaFromAtributo("navegacion_D_plegada");
$presentacion = $presentacion->valor;


?>
<? if (count($filas)!=0 ){ ?>

<TABLE   border="0" width="<?= $prefs["tam_ancho_interior_derecha"] ?>" cellpadding="0" cellspacing="0">
	<TR>
		<TD style="height:18; background:url(<?= $_parenDir ?>img/destacados_color03.gif) repeat-x ">
		&nbsp;</TD>
	</TR>
</TABLE>
<TABLE   border="0" width="<?= $prefs["tam_ancho_interior_derecha"] ?>" cellpadding="0" cellspacing="0">
	<TR>
		<!--  class="destacadolateralimagen"  -->
		<TD style="text-align:center; background:url(<?= $_parenDir ?>img/fondo_destacados.gif) no-repeat right top;background-color:#e5d2aa;border-left:1px solid #000000;border-bottom:1px solid #000000;">

			<table width="140" border="0" cellpadding="0" cellspacing="0"> 
				
				<?
				$currFilas=0;
				$countFilas = count($filas);
				//Imprime recursivamente una tabla desde su nodo $idactual hasta su nodo $idfinal
				// Si $idactual=="" y $idfinal="" imprime solo el primer nivel
				// Si $idfinal==-1 imprime todo lo de debajo a partir de $idactual.
				// Si no sólo se expanden los nodos de $caminoItems
				while (list ($clave, $item) = each ($filas)) {
					$caminoItems = $visit->util->obtenerCaminoCategoria($dictFilas, "", $item->id);
					$ancho=18*(count($caminoItems)-2);
					$enlace = $visit->util->getEnlaceFromMenu($item,$menu);

				?>
						<tr>
							<TD>					
							
								<? if (count($caminoItems)-2==0 ){ ?><!-- Nivel 1 -->
								<!-- SI ES VIENE DE NIVEL <>0 -->
									<? if ($currFilas>0) { ?>					
										</td>
										</tr>
										</table>
										<!-- <IMG SRC="<?= $_parenDir ?>img/pc.gif" WIDTH="1" HEIGHT="6" BORDER="0" ALT=""><BR> -->
									<? } ?>

								<table  border="0" cellpadding="0" cellspacing="0" width='100%'>
								<tr>
									<td>
										<table width="140" border="0" cellpadding="0" cellspacing="0"> 		
											<tr>		
												<td class="bloquemenu"  onclick="window.location.href = '<?= $visit->util->concatenaUrl($urlMenu,"menu=".$item->idlangprincipal) ?>'"><?=$item->nombre ?>a</td>
											</tr>
										</table>
										
								<? } else if ((count($caminoItems)-2==1 && $presentacion=="N") || ($visit->util->perteneceLista($item->idpadre,$strMenus)) || $menuActual->id == $item->idpadre) { ?>
								
									<? if($item->idlangprincipal == $menuActual->idlangprincipal  ){				
										$clase1="menunivel1activo";
										}else{ 
										$clase1="menunivel1";
										}?>
											<table border="0" cellpadding="0" cellspacing="0" width='100%'>
												<tr>
													<td class="nivel1"  onmouseover="this.className='nivel1over';" onmouseout="this.className='nivel1';" onclick="window.location.href = '<?= $enlace ?>'"><a class="<?= $clase1 ?>" href="<?= $enlace ?>" ><?=$item->nombre ?> </a></td>
												</tr>
											</table>

										
								
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
<? } ?>