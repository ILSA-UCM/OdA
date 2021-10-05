<?
function str_replace_first($from, $to, $subject)
{
    $from = '/'.preg_quote($from, '/').'/';



    return preg_replace($from, $to, $subject, 1);
}
?>

<?
//numero de decimales a mostar en los campos numericos
if($visit->options->numeric_decimal ==""){
	$preferenciasDecimales = new ClsPreferenciasPresentacion();
	$preferenciasDecimales->atributo = "numeric_decimal";
	$preferenciasDecimales = $visit->dbBuilder->getTablaFiltrada($preferenciasDecimales);
	$visit->options->numeric_decimal = $preferenciasDecimales[0]->valor;
}

//var_dump($filas);

$username = $_SESSION["name"];
$rol = $visit->dbBuilder->getUsuarioRol($username);

?>

<script type="text/javascript">
	function ajustarIframe(){
		var miIframe=document.getElementById("iframe_text");
		var anchoPagina = miIframe.contentWindow.document.body.scrollWidth;
		var alturaPagina=miIframe.contentWindow.document.body.scrollHeight;
		miIframe.style.height=alturaPagina;
		miIframe.style.width=anchoPagina;		
	}
</script>
<? if($seleccion == "1"){ $anchopestanna = "940px";}
	else{ $anchopestanna ="800px";}?>
	
<div class="cajadatos" style="width:<?=$anchopestanna?>;">		


	<? if($icono!=null){
		$margeSupico= "20px";
		$margenLatIco = "0px";
	}?>
	<div class="linea_dato_icono" style=" margin-left:<?=$margenLatIco?>;margin-top: <?=$margeSupico?>" >
		<div style="margin-bottom:10px; float:left;">
			<div class="cabecera_titulo_nivel1"  style="float:left;">Identificador:</div>
			<div class="cabecera_texto" style="float:left;">&nbsp;<?= $ov->id ?> </div>
		</div>
 	<?	$secn=$visit->dbBuilder->getSectionDataId(111);
 		$atrib= $visit->dbBuilder->obtenerAtributoValorTextFromSeccionOV("111",$ov->id); 
 		$hayIframe = strpos($atrib->value, "text/css");
 		if($hayIframe =="" ) $hayIframe =  strpos($atrib->value, "<style>");
 		//echo "iframe".$hayIframe."<br>";
 	?>
 		<div style="margin-bottom:10px; clear:both; float:left;">
 			<div class="cabecera_titulo_nivel1" style="float:left;" ><?=$secn->nombre?>:</div>
 			<? $ancho_cabecera_texto_nivel1 = "760px";
				if($seleccion != ""){
					$ancho_cabecera_texto_nivel1 = "910px";	
				}	
			?>
			<div class="cabecera_texto_nivel1_textData" style="width:<?=$ancho_cabecera_texto_nivel1?>; border:0px;">
			<? if($hayIframe > 0 ){?>
				  <iframe  id="iframe_text"   src="inc_textData_generico.php?SecId=111&ovId=<?=$ov->id?>"   align="middle" width="100%"  allowtransparency="true" background-color="transparent" height="273" frameBorder="0" class="iframe_textData"  onLoad="ajustarIframe()"><?=$atrib->value?></iframe>
			<? } else {?>
				<?=$atrib->value?>
			<? }?>
			</div>
		</div>
 	</div>
 	


<div class="clearfix"></div>


<? while (list ($clave, $sectionData) = each ($filas)) { ?>		
<?
	$caminoItems = $visit->util->obtenerCaminoCategoria($dictFilas, $idPadreActivo, $sectionData->id);
	//echo "**************/*/".$idActivo."<br>";
	//echo var_dump($sectionData)."<br>";
	if($sectionData->id=="111")continue;
	$ancho = 50*(count($caminoItems)-2);
	$margen=$ancho."px";
	$varHastaLateral = 685;
	if($seleccion != ""){
		$varHastaLateral = 910;	
	}	
	$width = $varHastaLateral-($ancho)."px";
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

		<?
//
	$Italicos=array();

	if (in_array($secDat->nombre,$Italicos))
	{
	if($ancho == 0 ){
		$claseTexto="italico cabecera_texto_nivel1";
	}else{
		$claseTexto="italico cabecera_texto_nivel2";
		}
	}

	//
?>

	<?// Secci�n de tipo TEXTO
	 if ($secDat->tipo_valores=="T") { 
			if ($ov->id!=0) {
				$atrib= $visit->dbBuilder->obtenerAtributoValorTextFromSeccionOV($secDat->id,$ov->id);
				$hayIframe = strpos($atrib->value, "text/css");
				
			}
			if($atrib!=null&&$atrib->value!="") { ?>
			<div class="linea_dato" style="margin-left:<?=$margen?>;">
					<div class="<?=$claseTitulo?>"  ><?= $secDat->nombre ?>:</div>
					&nbsp;
					<div class="<?=$claseTexto?>_textData" style="width:97%"> 
						<? if($hayIframe > 0 ){?>
					 		<iframe src="inc_textData_generico.php?SecId=<?=$secDat->id?>&ovId=<?=$ov->id?>" class="iframe_textData"><?=$atrib->value?></iframe>
						<? } else {?>



						<?

						//NEgrita Cursiva Links Joaquin Inicio
                              $text=$atrib->value;

                              $text = " ".$text;

                              $text = preg_replace('(((f|ht){1}tp://)[-a-zA-Z0-9@:%_+.~#?&//=]+)','<a href="\1" target="_blank">\1 </a>', $text);

                              $text = preg_replace('(((f|ht){1}tps://)[-a-zA-Z0-9@:%_+.~#?&//=]+)','<a href="\1" target="_blank">\1</a>', $text);

                              $text = preg_replace('([[:space:]()[{}])(www.[-a-zA-Z0-9@:%_+.~#?&//=]+)','\1<a href="http://\2" target="_blank">\2</a>', $text);

                              $text = preg_replace('([_.0-9a-z-]+@([0-9a-z][0-9a-z-]+.)+[a-z]{2,3})','<a href="mailto:\1" target="_blank">\1</a>', $text);


							  $mystring = $text;
							  $findme   = '$';

							  $pos = strpos($mystring, $findme);

							  $acti=false;


							  while ($pos !== false)
							  {


								  if ($acti==false)
									  $repa="<i>";
								  else
									  $repa="</i>";



								  $text=str_replace_first('$', $repa, $text);

								  $mystring = $text;
								  $findme   = '$';

							      $pos = strpos($mystring, $findme);

								  if ($acti == true)
									  $acti=false;
								  else
									  $acti=true;

							  }




							  $mystring = $text;
							  $findme   = '%';

							  $pos = strpos($mystring, $findme);

							  $actb=false;


							  while ($pos !== false)
							  {

								  if ($actb == false)
									  $repa="<b>";
								  else
									  $repa="</b>";




								  $text=str_replace_first('%', $repa, $text);


								  $mystring = $text;
								  $findme   = '%';

							      $pos = strpos($mystring, $findme);

								  if ($actb == true)
									  $actb=false;
								  else
									  $actb=true;

							  }

							  if ($actb==true)
								  $text=$text.'</b>';


							   if ($acti==true)
								  $text=$text.'</i>';


							  //NEgrita Cursiva Links Joaquin Fin
                              ?>
                            <? if (!file_exists(extended.conf)){?>
                                <?=$atrib->value?>
                            <? }else{?>
                                <?=nl2br($text);?>
                            <?}?>
						<? }?>						  
					</div>
					<div class="clearfix"></div>
				</div>
			<? } ?>
				
	<? //Secci�n de tipo N�MERO
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

					
		<? 	} else if ($secDat->tipo_valores=="X"  && $visit->dbBuilder->tieneHijosConValor($secDat->id,$ov->id)){ ?>
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
	
	<div class="clearfix"></div>
</div>

