<? 
//numero de decimales a mostar en los campos numericos
if($visit->options->numeric_decimal ==""){
	$preferenciasDecimales = new ClsPreferenciasPresentacion();
	$preferenciasDecimales->atributo = "numeric_decimal";
	$preferenciasDecimales = $visit->dbBuilder->getTablaFiltrada($preferenciasDecimales);
	$visit->options->numeric_decimal = $preferenciasDecimales[0]->valor;
}
?>
<div class="cajadatos">
<? if ($pes== "dat") {?>
	<div class="linea_dato" style="margin-left:0px;">
		<div class="cabecera_titulo" >Identificador:</div>
		<div class="cabecera_texto">&nbsp;<?= $ov->id ?> </div>
		<div class="clearfix"></div>
 	</div>
<? } ?>
<? 
$username = $_SESSION["name"];
$rol = $visit->dbBuilder->getUsuarioRol($username);	?>



<? while (list ($clave, $sectionData) = each ($filas)) { ?>		
<?
	$caminoItems = $visit->util->obtenerCaminoCategoria($dictFilas, $idPadreActivo, $sectionData->id);
	//echo "**************/*/".$idActivo."<br>";
	//echo var_dump($sectionData)."<br>";
	$ancho = 50*(count($caminoItems)-2);
	$margen=$ancho."px";
	$width = 690-($ancho)."px";
	//definimos el estilo dependiendo del nivel
	if($ancho == 0 ){
		$claseTitulo="cabecera_titulo_nivel1";
		$claseTexto="cabecera_texto_nivel1";
	}else{
		$claseTitulo="cabecera_titulo_nivel2";
		$claseTexto="cabecera_texto_nivel2";
	}
		
	if ($caminoItems[0]==$idActivo) { ?>
		<? while (list ($clave, $idSec) = each ($caminoItems)) { 
			if (!$visit->util->perteneceLista( $idSec, $listaSeccionesFila)) {
			$listaSeccionesFila.=",".$idSec.",";
			$secDat = $dictFilas[$idSec];
			//$visit->dbBuilder->getSectionDataId($idSec);	
			if($rol !="A"){
			 if($secDat->visible!="S") $secDat=NULL;
			}
		?>
				
	<? // Sección de tipo TEXTO
		if ($secDat->tipo_valores=="T") { 
			if ($ov->id!=0) {
				$atrib= $visit->dbBuilder->obtenerAtributoValorTextFromSeccionOV($secDat->id,$ov->id);
			}
			if($atrib!=null&&$atrib->value!="") { ?>
			<div class="linea_dato" style="margin-left:<?=$margen?>;">
					<div class="<?=$claseTitulo?>"  ><?= $secDat->nombre ?>:</div>
					&nbsp;
					<div class="<?=$claseTexto?>_textData" style="width:<?=$width ?>"> 
						<?=$atrib->value?>
						<? /*  <iframe src="<?=$atrib->value?>><?=$atrib->value?></iframe> */?>
					</div>
					<div class="clearfix"></div>
				</div>
			<? } ?>
				
	<? //Sección de tipo NÚMERO
	} else if ($secDat->tipo_valores=="N") { 
		if ($ov->id!=0) {
			$atrib= $visit->dbBuilder->obtenerAtributoValorNumFromSeccionOV($secDat->id,$ov->id);
		} 				
		if($atrib!=null&&$atrib->value!="") { ?>
			<div class="linea_dato"  style="margin-left:<?=$margen?>;">
				<div class="<?=$claseTitulo?>"  ><?= $secDat ->nombre ?>:</div>
				&nbsp;
				<div class="<?=$claseTexto?>">
					<? 
					$decimales = $visit->dbBuilder->getCantidadDecimales($secDat->id);
					$atribValue = round($atrib->value, $decimales); 
					?>					<?=$atribValue?>
				</div>
				<div class="clearfix"></div>
			</div>
		<? } ?>					
	<?} else if ($secDat->tipo_valores=="F") { 
			if ($ov->id!=0) {
				$atrib= $visit->dbBuilder->obtenerAtributoValorDateFromSeccionOV($secDat->id,$ov->id);
			} 					
			if($atrib!=null&&$atrib->value!="") { ?>
				<div class="linea_dato"  style="margin-left:<?=$margen?>;">
					<div class="<?=$claseTitulo?>" ><?= $secDat ->nombre ?>:</div>
					&nbsp;
					<div class="<?=$claseTexto?>" ><?=$visit->util->bbdd2date($atrib->value) ?></div>
					<div class="clearfix"></div>
				</div>
			<? } ?>
			
	<? } else if ($secDat->tipo_valores=="C") { 
			if ($ov->id!=0) {
					$atrib= $visit->dbBuilder->obtenerAtributoValorContrFromSeccionOV($secDat->id,$ov->id);	
			} 	
			if($atrib!=null&&$atrib->value!="") { ?>
				<div class="linea_dato"  style="margin-left:<?=$margen?>;">
					<div class="<?=$claseTitulo?>"  ><?= $secDat->nombre ?>:
					</div>
					&nbsp;
					<div class="<?=$claseTexto?>" ><?=$atrib->value?></div>
					<div class="clearfix"></div>
				</div>
			<? } ?>

					
		<? 	} else if ($secDat->tipo_valores=="X" && $visit->dbBuilder->tieneHijosConValor($secDat->id,$ov->id)){ ?>
				<? //var_dump($ancho);?>
				<div style="margin-left:<?=$margen?>">
					<? if($margen=="0px" ){ $classimg="img_ov_negrox";}
					else{ $classimg="img_ov_grisx";}?>
					<div class="<?=$classimg?>" ></div>
					<div class="<?=$claseTitulo?>_x"  ><?= $secDat->nombre ?></div>
					<div class="clearfix"></div>
					
				</div>
				<div class="clearfix"></div>
				
				
				
						<? } //else if ?>
					<? } // while caminoItems?>
				<? } // if idactivo?>
		<? } // while filas ?>
	<? } // else (pes!=rec)?>
</div>