<? 


include_once(dirname(__FILE__)."/include.php");


include_once(dirname(__FILE__)."/top.php");
$fila = new ClsSectionData();
$filas = $visit->dbBuilder->getTablaFiltrada($fila);


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


$preferencia = $visit->dbBuilder->getPreferenciaFromAtributo("secciones_plegado");
if (!$preferencia ) $preferencia = new ClsPreferenciasPresentacion();
?>	
<? while (list ($clave, $fila) = each ($filas)) { ?>		
		<?
			$i++;
			if ( ($i % 2) != 0 ) {
				$lsregistros="listadopar";
			} else {
				$lsregistros="listadoimpar";
			}
			$caminoItems = $visit->util->obtenerCaminoCategoria($dictFilas, "", $fila->id);
			$ancho=18*(count($caminoItems)-2);
		?>
			<tr>
				<TD class="<?= $lsregistros ?>" nowrap>
					<IMG SRC="<?=$_parenDir?>bo/img/pc.gif" WIDTH="<?= $ancho ?>" HEIGHT="1" BORDER="0" ALT="">
					<a href="cm_form_section_data.php?id=<?= $fila->id ?>"><IMG SRC="<?=$_parenDir?>bo/img/ico_editar.gif" WIDTH="13" HEIGHT="16" BORDER="0" ALT=""></a>
					<a href="cm_form_section_data.php?id=<?= $fila->id ?>"
							title="<?= $fila->tooltip ?>"
						>
						<B><?= $fila->nombre ?></B></a>
				</TD>
			
			</tr>
			
		<? } ?>
	</table>



	<?
include_once(getcwd()."/bottom.php");
?>