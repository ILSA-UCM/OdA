<? include_once(dirname(__FILE__)."/include.php");
//$visit->debuger->enable(true);
if ($id!="") {
	$fila = $visit->dbBuilder->getVirtualObjectId($id);
} else {
	$fila = new ClsVirtualObject();
}
if (!$visit->options->tieneAcceso("view",$fila)) $visit->options->sinAcceso();
include_once(dirname(__FILE__)."/top.php");
?>


		
<?  include_once(getcwd()."/inc_top_pestanas_ov.php"); ?>		
		
      <table width="460" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFCC">
      	
	<? if ($pes=="" || $pes== "dat") {?>
		<tr bgcolor="#FFFFCC" valign="top">
          <td width="140">
           <b>Nombre</b>
          </td>
          <td width="320">
            <?= $fila->name ?>
          </td>

        </tr>
	<? } ?>
				<?
				
			$sectionData = new ClsSectionData();
			$filas = $visit->dbBuilder->getTablaFiltrada($sectionData);
			$count = count($filas);
			if ($count==0) $inicio=0;
			if ($pes=="" || $pes== "dat") {
			$datos=$visit->dbBuilder->getIdDatos();
			$idActivo=$datos->id;
			} else if ($pes=="rec") {
				$recurso=$visit->dbBuilder->getIdRecurso();
				$idActivo=$recurso->id;
			} else if ($pes=="met") {
				$metadatos=$visit->dbBuilder->getIdMetadatos();
				$idActivo=$metadatos->id;
			}
			
			//echo "**************/*/".$idDatos; 
			$valores = &$filas;
			$dictFilas = $visit->util->getDict( $valores );
			$sDictFilas = array();
			$listaSeccionesFila="0";
			while (list ($clave, $valor) = each ($dictFilas)) { 
				$nombre ="";
				$caminoItems = $visit->util->obtenerCaminoCategoria($dictFilas, "", $valor->id);
				for ($i=0;$i<count($caminoItems);$i++) $nombre .= " >> ". $visit->util->numDigitos($dictFilas[$caminoItems[$i]]->orden,5) . "_" . $dictFilas[$caminoItems[$i]]->nombre;
				$sDictFilas[$nombre] = $valor;
			}
			ksort( $sDictFilas );
			$filas = &$sDictFilas;
				$idPrim=$idActivo;
			//$filas = $visit->dbBuilder->getTablaFiltrada($sectionData);
			while (list ($clave, $sectionData) = each ($filas)) { ?>		
				<?
					$i++;
					if ( ($i % 2) != 0 ) {
						$lsregistros="listadopar";
					} else {
						$lsregistros="listadoimpar";
					}
					$caminoItems = $visit->util->obtenerCaminoCategoria($dictFilas, "", $sectionData->id);
					$ancho=18*(count($caminoItems)-2);
					$idPrim=$caminoItems[count($caminoItems)-1];
				if ($caminoItems[1]==$idActivo) { ?>
					<? while (list ($clave, $idSec) = each ($caminoItems)) { 
							if (!$visit->util->perteneceLista( $idSec, $listaSeccionesFila)) {
							$listaSeccionesFila.=",".$idSec.",";
							$secDat = $visit->dbBuilder->getSectionDataId($idSec);
							 
					?>
							<? if ($secDat->tipo_valores=="T") { 
											if ($id!=0) {
													$atrib= $visit->dbBuilder->obtenerAtributoValorTextFromSeccionOV($secDat->id,$id);
											} 
										if($atrib!=null) {

											if ($atrib->value!="") { ?>
										<tr   bgcolor="#FFFFCC">
											<td class="popuptitcampo" nowrap>
												<b><?= $secDat->nombre ?></b>
											</td>
											<td class="popuptitcampo">
												<?=$atrib->value?>
											</td>
										</tr>
											<? } ?>
										<? } ?>
								<? } else if ($secDat->tipo_valores=="N") { 
											if ($id!=0) {
													$atrib= $visit->dbBuilder->obtenerAtributoValorNumFromSeccionOV($secDat->id,$id);
											} 
										
										if($atrib!=null) {
											if ($atrib->value!="") {?>
											<tr   bgcolor="#FFFFCC">
												<td class="popuptitcampo" nowrap>
													<b><?= $secDat ->nombre ?></b>
												</td>
												<td class="popuptitcampo">
													<?=$atrib->value?>
												</td>
											</tr>
											<? } ?>
										<? } ?>
								<? } else if ($secDat->tipo_valores=="C") { 
											if ($id!=0) {
													$atrib= $visit->dbBuilder->obtenerAtributoValorContrFromSeccionOV($secDat->id,$id);
												
												
											} 
										
										if($atrib!=null) {
											if ($atrib->value!="") {?>
											<tr   bgcolor="#FFFFCC">
											<td class="popuptitcampo" nowrap>
												<b><?= $secDat->nombre ?></b>
											</td>
											<td class="popuptitcampo">
												<?=$atrib->value?>
											</td>
											</tr>
											<? } ?>
										<? } ?>
								<? } ?>
							<? } ?>	
								
						<? } ?>
					<? } ?>
				<? } ?>
      </table>
    
		
	<?  include_once(getcwd()."/inc_bottom_pestanas.php"); ?>
  
	

<? include_once(dirname(__FILE__)."/bottom.php"); ?>