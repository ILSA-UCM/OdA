﻿<? 
//numero de decimales a mostar en los campos numericos
if($visit->options->numeric_decimal ==""){
	$preferenciasDecimales = new ClsPreferenciasPresentacion();
	$preferenciasDecimales->atributo = "numeric_decimal";
	$preferenciasDecimales = $visit->dbBuilder->getTablaFiltrada($preferenciasDecimales);
	$visit->options->numeric_decimal = $preferenciasDecimales[0]->valor;
}
?>
<? if($seleccion == "1"){ $anchopestanna = "940px";}
	else{ $anchopestanna ="800px";}?>
	
<div class="cajadatos" style="width:<?=$anchopestanna?>;">		
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


<? $hayValores =false;?>
<? while (list ($clave, $sectionData) = each ($filas)) { ?>		
<?
	$caminoItems = $visit->util->obtenerCaminoCategoria($dictFilas, $idPadreActivo, $sectionData->id);
	//echo "**************/*/".$idActivo."<br>";
	//echo var_dump($sectionData)."<br>";
	$ancho = 50*(count($caminoItems)-2);
	$margen=$ancho."px";
	$varHastaLateral = 685;
	if($seleccion != ""){
		$varHastaLateral = 910;	
	}	
	$widthS = $varHastaLateral-($ancho)."px";
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
				$hayIframe = strpos($atrib->value, "text/css");
				if($hayIframe =="" ) $hayIframe =  strpos($atrib->value, "<style>");	
			}
			if($atrib!=null&&$atrib->value!="") { 
			$hayValores=true;
	?>
			<div class="linea_dato" style="margin-left:<?=$margen?>;">
					<div class="<?=$claseTitulo?>"  ><?= $secDat->nombre ?>:</div>
					&nbsp;
					<div class="<?=$claseTexto?>_textData" style="width:97%;" > 
						<? if($hayIframe > 0 ){?>
					 		<iframe src="inc_textData_generico.php?SecId=<?=$secDat->id?>&ovId=<?=$ov->id?>" class="iframe_textData"><?=$atrib->value?></iframe>
						<? } else {?>
							<?=$atrib->value?>
						<? }?>		
					</div>
					<div class="clearfix"></div>
				</div>
			<? } ?>
				
	<? //Sección de tipo NÚMERO
	} else if ($secDat->tipo_valores=="N") { 
		if ($ov->id!=0) {
			$atrib= $visit->dbBuilder->obtenerAtributoValorNumFromSeccionOV($secDat->id,$ov->id);
		} 				
		if($atrib!=null&&$atrib->value!="") { 
			$hayValores=true;	
	?>
			<div class="linea_dato"  style="margin-left:<?=$margen?>;">
				<div class="<?=$claseTitulo?>"  ><?= $secDat ->nombre ?>:</div>
				&nbsp;
				<div class="<?=$claseTexto?>">
					<? 
					$decimales = $visit->dbBuilder->getCantidadDecimales($secDat->id);
					$atribValue = round($atrib->value, $decimales); 
					?>
					<?=$atribValue?>
				</div>
				<div class="clearfix"></div>
			</div>
		<? } ?>					
	<?} else if ($secDat->tipo_valores=="F") { 
			if ($ov->id!=0) {
				$atrib= $visit->dbBuilder->obtenerAtributoValorDateFromSeccionOV($secDat->id,$ov->id);
			} 					
			if($atrib!=null&&$atrib->value!="") {
				$hayValores=true;
	?>
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
			if($atrib!=null&&$atrib->value!="") { 
				$hayValores=true;	
	?>
				<div class="linea_dato"  style="margin-left:<?=$margen?>;">
					<div class="<?=$claseTitulo?>"  ><?= $secDat->nombre ?>:</div>
					&nbsp;
					<div class="<?=$claseTexto?>" ><?=$atrib->value?></div>
					<div class="clearfix"></div>
				</div>
			<? } ?>

					
		<? 	} else if ($secDat->tipo_valores=="X" && $visit->dbBuilder->tieneHijosConValor($secDat->id,$ov->id)){ ?>
				<? $hayValores=true;?>
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
	
	<? if(!$hayValores){?>
		<div class="texto_sinValor" >El Objeto no tiene ning&uacute;n Metadato. </div>
		<div class="clearfix"></div>
	<?} ?>
</div>