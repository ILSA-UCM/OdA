<? 
include_once(dirname(__FILE__)."/include.php");
//$visit->debuger->enable(true);
if ($id!="") {
	$fila = $visit->dbBuilder->getVirtualObjectId($id);
} else {
	$fila = new ClsVirtualObject();
}
if (!$visit->options->tieneAcceso("view",$fila)) $visit->options->sinAcceso();
include_once(dirname(__FILE__)."/top.php");
?>

    
		
		
		<div id="filas_listado">
      <table border="0" width="460" cellpadding="0" cellspacing="0" bgcolor="">
        <tr>
          <td bgcolor="#000000" height="20" align="center">
            <b><font color="#FFFFFF">Gesti&oacute;n de
            Recursos</font></b>
          </td>
        </tr>
      </table>
      <table width="460" border="0" cellpadding="3" cellspacing="1" bgcolor="#000000">
        
				
					<tr id="fila_listado" bgcolor="#FFFFFF" valign="top">
         
        </tr>
				
					<tr bgcolor="#FFFFFF" valign="top">
          <td width="140">
            Nombre:
          </td>
          <td width="320">
            <?= $fila->name ?>
          </td>

        </tr>
		<?
	$sectionData = new ClsSectionData();
	$filas = $visit->dbBuilder->getTablaFiltrada($sectionData);
	$count = count($filas);
	if ($count==0) $inicio=0;
	$recurso=$visit->dbBuilder->getIdRecurso();
	$idRecurso=$recurso->id;
	$metadatos=$visit->dbBuilder->getIdMetadatos();
	$idMetadatos=$metadatos->id;
	$datos=$visit->dbBuilder->getIdDatos();
	$idDatos=$datos->id;
	//echo "**************/*/".$idDatos; 
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
		if ($caminoItems[1]==$idDatos) { ?>
			<? while (list ($clave, $idSec) = each ($caminoItems)) { 
					$secDat = $visit->dbBuilder->getSectionDataId($idSec);
			?>
					<tr bgcolor="#FFFFFF">
					echo "<td>".$secDat->tipo_valores."--</td>";
						<? if ($secDat->tipo_valores=="T") { 
									if ($id!=0) {
											$atrib= $visit->dbBuilder->obtenerAtributoValorTextFromSeccionOV($secDat->id,$id);
									} 
								if($atrib!=null) {
									if ($atrib->value!="") { ?>
									<td class="popuptitcampo" nowrap>
										<IMG SRC="<?=$_parenDir?>bo/img/pc.gif" WIDTH="<?= $ancho + 100?>" HEIGHT="1" BORDER="0" ALT=""><? if ($secDat->idpadre==0) { ?> <b><?= $secDat->nombre ?></b><? } else { ?><?= $secDat->nombre ?><?}?>
									</td>
									<td class="popuptitcampo">
										<?=$atrib->value?>
									</td>
									<? } ?>
								<? } ?>
						<? } else if ($secDat->tipo_valores=="N") { 
									if ($id!=0) {
											$atrib= $visit->dbBuilder->obtenerAtributoValorNumFromSeccionOV($secDat->id,$id);
									} 
								
								if($atrib!=null) {
									if ($atrib->value!="") {?>
									<td class="popuptitcampo" nowrap>
										<IMG SRC="<?=$_parenDir?>bo/img/pc.gif" WIDTH="<?= $ancho ?>" HEIGHT="1" BORDER="0" ALT=""><? if ($secDat->idpadre==0) { ?> <b><?= $secDat ->nombre ?></b><? } else { ?><?= $secDat->nombre ?><?}?>
									</td>
									<td class="popuptitcampo">
										<?=$atrib->value?>
									</td>
									<? } ?>
								<? } ?>
						<? } else if ($secDat->tipo_valores=="F") { 
									if ($id!=0) {
											$atrib= $visit->dbBuilder->obtenerAtributoValorNumFromSeccionOV($secDat->id,$id);
									} 
								
								if($atrib!=null) {
									if ($atrib->value!="") {?>
									<td class="popuptitcampo" nowrap>
										<IMG SRC="<?=$_parenDir?>bo/img/pc.gif" WIDTH="<?= $ancho ?>" HEIGHT="1" BORDER="0" ALT=""><? if ($secDat->idpadre==0) { ?> <b><?= $secDat ->nombre ?></b><? } else { ?><?= $secDat->nombre ?><?}?>
									</td>
									<td class="popuptitcampo">
										<?=$atrib->value?>
									</td>
									<? } ?>
								<? } ?>
						<? } else if ($secDat->tipo_valores=="C") { 
									if ($id!=0) {
											$atrib= $visit->dbBuilder->obtenerAtributoValorContrFromSeccionOV($secDat->id,$id);
										
										
									} 
								
								if($atrib!=null) {
									if ($atrib->value!="") {?>
									<td class="popuptitcampo" nowrap>
										<IMG SRC="<?=$_parenDir?>bo/img/pc.gif" WIDTH="<?= $ancho ?>" HEIGHT="1" BORDER="0" ALT=""><? if ($secDat->idpadre==0) { ?> <b><?= $secDat->nombre ?></b><? } else { ?><?= $secDat->nombre ?><?}?>
									</td>
									<td class="popuptitcampo">
										<?=$atrib->value?>
									</td>
									<? } ?>
								<? } ?>
						<? } ?>
						</tr>
				<? } ?>
			<? } ?>
		<? } ?>
      </table>
    </div>
		
	
  
	
<? 

?>
<? include_once(dirname(__FILE__)."/bottom.php"); ?>