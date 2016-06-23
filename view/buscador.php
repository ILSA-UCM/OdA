<?
include_once(dirname(__FILE__)."/include.php");
include_once(dirname(__FILE__)."/top.php");

$idpadre = $dict["idpadre"];
$refinar=0;					//alfredo 140827 
$refinar = $dict["refinar"];
//var_dump($refinar); 
if($refinar!=1) {$_SESSION['valores_buscados']="";}
$_SESSION['lsvirtual_object_busqueda']="";

//var_dump($refinar);
//var_dump($dict);
?>

<script>
	var dato=0;
	function revisarForm() {
		return (dato!=1 );
	}
	function cambio(item) {
		dato=1;
	}



	function compruebaFecha(valor){
		var error = false;
		if(valor.length==10){
			if(!esNumerico(valor.substring(0,1))) {error = true;}
			if(!esNumerico(valor.substring(3,4))) {error = true;}
			if(!esNumerico(valor.substring(6,9))) {error = true;}
		}
		else {
			error = true;
		}

		if(error)
		{ 
			alert("El valor de este campo debe estar en el formato fecha DD/MM/YYYY");
		}
	}

</script>


<div class="titulopagina">	<?   print $visit->util->migaspan($idpadre,$migas); ?></div>
<form name="formulario" action="ls_ov_busqueda.php" method="POST" ENCTYPE="multipart/form-data" onsubmit="return false">
	<input type="hidden" name="idpadre" value="<?=$idpadre?>"/>
	<input type="hidden" name="pag_inicial" value="-1"/>
	<!--
	<table cellspacing='0' cellpadding='0' width='100%' >
		<tr>
			<td align='left' width="345px" colspan="2"> 
			<?// if (isset($_SESSION['authenticated'])&&$_SESSION['authenticated']== APP_NAME.$visit->options->usuario->id) { ?>
				<input name="misOVs" type="checkbox" size="5" maxlength="255" value="S" onchange="cambio(this);">Buscar sólo en mis objetos digitales
			<?// } ?>
			</td>
			<input type="hidden" name="idusuario" value=<?= $session->idusuario ?>>
		<tr>
	</table>
	-->
	
	<div class="busc_img">
		<INPUT class="boton_buscar" TYPE=BUTTON OnClick="document.formulario.submit();return false;" VALUE="">
	</div>
			
	<div class="tabla_buscador">
		
		
	<table width="92%" border="0" cellpadding="3" cellspacing="1" >	
		<?
		$sectionData = new ClsSectionData();
		if(!($visit->util->esSuperAdmin())) {
			$sectionData->visible = "S";			
		}
		$filas = $visit->dbBuilder->getTablaFiltrada($sectionData);
		
		//var_dump($filas);
		
		$count = count($filas);
		if ($count==0) $inicio=0;
		$valores = &$filas;
		$dictFilas = $visit->util->getDict( $valores );
		$sDictFilas = array();
		while (list ($clave, $valor) = each ($dictFilas)) { 
			$nombre ="";
			$caminoItems = $visit->util->obtenerCaminoCategoria($dictFilas, "", $valor->id);
			for ($i=0;$i<count($caminoItems);$i++)
				{ $nombre .= " >> ". $visit->util->numDigitos($dictFilas[$caminoItems[$i]]->orden,5) . "_" . $dictFilas[$caminoItems[$i]]->nombre;
				//var_dump($dictFilas[$caminoItems[$i]]->nombre);
				//var_dump($dictFilas[$caminoItems[$i]]->valor);
				}
			$sDictFilas[$nombre] = $valor;
			
		}
		//var_dump("ENV-busca*** "); var_dump($_ENV["seccion_id"]); //alfredo 140711
		//var_dump(" campos-buscados>> "); var_dump($_SESSION['campos_buscados']);  // alfredo 140824
		//var_dump(" valores-buscados>> "); var_dump($_SESSION['valores_buscados']);//  // alfredo 140824
		
		//var_dump($sDictFilas);
		
		ksort( $sDictFilas );
		//var_dump($sDictFilas);
		
		$filas = &$sDictFilas;
		$idRecurso=$visit->dbBuilder->getIdRecurso();
		$atribsNum=$visit->dbBuilder->obtenerAtributosNumFromOV($id);
		$dictAtribsNum= $visit->util->getDictIdSeccion( $atribsNum );
		$atribsCont=$visit->dbBuilder->obtenerAtributosContFromOV($id);
		$dictAtribsCont= $visit->util->getDictIdSeccion( $atribsCont );
		$atribsText=$visit->dbBuilder->obtenerAtributosTextFromOV($id);
		$dictAtribsText= $visit->util->getDictIdSeccion( $atribsText );
		$dictAtribsTextRec= $visit->util->getDictIdSeccionIdRecurso( $atribsText );
		$dictAtribsNumRec= $visit->util->getDictIdSeccionIdRecurso( $atribsNum );
		$dictAtribsContRec= $visit->util->getDictIdSeccionIdRecurso( $atribsCont );
		
		//$todosAtribsCont = $visit->dbBuilder->obtenerTodosAtribsContr();
		//echo $idRecurso."....................";
		
	    
		while (list ($clave, $sectionData) = each ($filas)) { ?>		
			<?	
				//var_dump($sectionData->nombre);var_dump($sectionData->id);var_dump($sectionData->valor);
				
				$caminoItemsStr = $visit->util->obtenerCaminoCategoriaStr($dictFilas, "", $sectionData->id);
				//var_dump($sectionData);
				
				$caminoItems =  substr( $caminoItemsStr, 1, strlen($caminoItemsStr)-2);
				$caminoItems =  explode(";",$caminoItems);
				$ancho=20*(count($caminoItems)-2);	
				$margen = $ancho."px";	
				//var_dump(">>>");var_dump($margen);var_dump("<<<");
				
			if ($sectionData->codigo!="recursos" && !$visit->util->isInStr($caminoItemsStr,$idRecurso->id) ) { ?>
					<? if ($sectionData->id==1||$sectionData->id==2) { ?> 
	
					<? } ?>
					<tr>
					<td class="popuptitcampo" nowrap >
						<IMG SRC="<?=$_parenDir?>bo/img/pc.gif" WIDTH="<?= $ancho ?>" HEIGHT="1" BORDER="0" ALT="">
						<? if ($sectionData->idpadre==0) { ?> 
							<div class="busc_titulo_principal" ><?= $sectionData->nombre ?></div>
						<? } else { ?>
							<div class="busc_titulo" style="margin-left:<?=$margen?>;"><?= $sectionData->nombre ?></div>
						<?}?>
					</td>
					
					
					
					<? if ($sectionData->tipo_valores=="T") { ?>
							<td  class="popupcampo">
							<? //var_dump($sectionData->id);
							if($refinar){$valor_buscado=$_SESSION['valores_buscados'][$sectionData->id];}else{$valor_buscado="";} //alfredo 140827?>
								<input class="busc_input" name="seccion_<?= $sectionData->id ?>" type="text" size="100" maxlength="255" value="<?=$valor_buscado?>"
								 onchange="cambio(this)">
								 <!-- alfredo 140829 <input type="hidden" name="margen<?= $sectionData->id ?>" value="<?=$margen?>"/> -->
								 <input type="hidden" name="margen<?= $sectionData->id ?>" value="<?=$margen?>"/>
							</td>
	
					<? } else if ($sectionData->tipo_valores=="N" ) { ?>
							<td  class="popupcampo">
							<? //var_dump($sectionData->id);
							if($refinar){$valor_buscado=$_SESSION['valores_buscados'][$sectionData->id];}else{$valor_buscado="";} //alfredo 140827?>
								<select name="seccion_<?= $sectionData->id ?>_ope" class="selectcorto"  >
								<option value="EQ"> = 
								<option value="LT"> < 
								<option value="BT"> > 
								<option value="LEQ"> <= 
								<option value="BEQ"> >=
								</select>
								<input class="inputlargo" name="seccion_<?= $sectionData->id ?>" type="text" size="60" maxlength="255" value="<?=$valor_buscado?>"
								 onchange="cambio(this); ">
								 <!-- alfredo 140829 <input type="hidden" name="margen<?= $sectionData->id ?>" value="<?=$margen?>"/> -->
								 <input type="hidden" name="margen<?= $sectionData->id ?>" value="<?=$margen?>"/>
								 
							</td>
							
					<? } else if ($sectionData->tipo_valores=="F" ) { ?>
							<td  class="popupcampo">
							<? //var_dump($sectionData->id);
							if($refinar){$valor_buscado=$_SESSION['valores_buscados'][$sectionData->id];}else{$valor_buscado="";} //alfredo 140827?>
								<select name="seccion_<?= $sectionData->id ?>_ope" class="selectcorto"  >
								<option value="EQ"> = 
								<option value="LT"> < 
								<option value="BT"> > 
								<option value="LEQ"> <= 
								<option value="BEQ"> >=
								</select>
								 <a  href="javascript:show_calendar('document.formulario.seccion_<?= $sectionData->id ?>', document.formulario.seccion_<?= $sectionData->id ?>.value);">
								 	<img   src="/<?=APP_NAME?>/view/img/cal.gif" width="16" height="16" border="0" alt="Pinche aqu&iacute; para introducir una fecha">
								 </a>
								<input class="selectfecha" name="seccion_<?= $sectionData->id ?>" type="text" size="60" maxlength="255" value="<?=$valor_buscado?>"
								 onchange="cambio(this);compruebaFecha(this.value);">
								<!-- alfredo 140829 <input type="hidden" name="margen<?= $sectionData->id ?>" value="<?=$margen?>"/> -->
								<input type="hidden" name="margen<?= $sectionData->id ?>" value="<?=$margen?>"/>
							</td>
				
					<? } else if ($sectionData->tipo_valores=="C"){?>
								<td  class="popupcampo">
								
								
									
									<select name="seccion_<?= $sectionData->id ?>_ope" class="selectcorto"  >
										<option value="EQ"> = 
										<option value="LT"> < 
										<option value="BT"> > 
										<option value="LEQ"> <= 
										<option value="BEQ"> >=
									</select>
									
									<? //var_dump($sectionData->nombre);
								if($refinar){ //alfredo 140827 
										if(in_array($sectionData->id,$_SESSION['campos_buscados'],true)){//refinar y campo buscado anteriormente
											$valor_buscado=$_SESSION['valores_buscados'][$sectionData->id];
											?>
										<select class="selectlargo" name="seccion_<?= $sectionData->id ?>" class="selectmedio"  >
													<!-- alfredo 140827 <option value="" >-- <?= $sectionData->nombre  ?> --   -->
													
													<option value="<?= $valor_buscado?>" > <?= $valor_buscado?>
													<? 
													$valores= $visit->dbBuilder->getAtributosContrFromIdSeccion($sectionData->id);
													$cadena = array();
													while (list ($clave2, $valor) = each ($valores)) {
														$cadena[]= $valor->value;
													}
													usort($cadena,"strnatcasecmp");?>
													<option value="<?= $valor ?>"  >	<?= "--".$sectionData->nombre."--" ?>
													
													<? while (list ($clave2, $valor) = each ($cadena)) { ?>					
														
															<option value="<?= $valor ?>"  >	<?= $valor  ?>
														
													<? } ?>	
													
													<!-- <option value="<?= $valor ?>"  >	<?= "--".$sectionData->nombre."--" ?> -->
													
													<? /*while (list ($clave2, $valor) = each ($valores)) { ?>					
														
															<option value="<?= $valor->value ?>"  >	<?= $valor->value  ?>
														
													<? } */?>		
										</select>&nbsp;
										<?
											} else{ // refinar y resto de campos no buscados anteriormente 
											$valor_buscado=$sectionData->nombre;
											?>
										<select class="selectlargo" name="seccion_<?= $sectionData->id ?>" class="selectmedio"  >
													<!-- alfredo 140827 <option value="" >-- <?= $sectionData->nombre  ?> --   -->
													
													<option value="" > -- <?= $valor_buscado  ?> --
													<? 
													$valores= $visit->dbBuilder->getAtributosContrFromIdSeccion($sectionData->id);
													$cadena = array();
													while (list ($clave2, $valor) = each ($valores)) {
														$cadena[]= $valor->value;
													}
													usort($cadena,"strnatcasecmp");
													while (list ($clave2, $valor) = each ($cadena)) { ?>					
														
															<option value="<?= $valor ?>"  >	<?= $valor  ?>
														
													<? } ?>	
													
													<!-- <option value="<?= $valor ?>"  >	<?= "alfredo OJO 140827" ?> -->
													
													<? /*while (list ($clave2, $valor) = each ($valores)) { ?>					
														
															<option value="<?= $valor->value ?>"  >	<?= $valor->value  ?>
														
													<? } */?>		
										</select>&nbsp;
										<?
											}
										} else{ // busqueda normal -sin refinar-
										$valor_buscado=$sectionData->nombre;
										?>
										<select class="selectlargo" name="seccion_<?= $sectionData->id ?>" class="selectmedio"  >
													<!-- alfredo 140827 <option value="" >-- <?= $sectionData->nombre  ?> --   -->
													
													<option value="" > -- <?= $valor_buscado  ?> --
													<? 
													$valores= $visit->dbBuilder->getAtributosContrFromIdSeccion($sectionData->id);
													$cadena = array();
													while (list ($clave2, $valor) = each ($valores)) {
														$cadena[]= $valor->value;
													}
													usort($cadena,"strnatcasecmp");
													while (list ($clave2, $valor) = each ($cadena)) { ?>					
														
															<option value="<?= $valor ?>"  >	<?= $valor  ?>
														
													<? } ?>	
													
													<!--<option value="<?= $valor ?>"  >	<?= "alfredo OJO 140827" ?> -->
													
													<? /*while (list ($clave2, $valor) = each ($valores)) { ?>					
														
															<option value="<?= $valor->value ?>"  >	<?= $valor->value  ?>
														
													<? } */?>		
										</select>&nbsp;
										<?
										}?>
										
										
										
										<div id='annadir_<?= $sectionData->id ?>' style="display:none" >
										
										<table cellspacing='0' cellpadding='0' >
											<tr>
											<td><input  name="text_<?= $sectionData->id ?>" type="text" size="50" maxlength="255" value="<?= $valor_buscado?>" onchange="cambio(this);">&nbsp;&nbsp;
											<!-- alfredo 140829 <input type="hidden" name="margen<?= $sectionData->id ?>" value="<?=$margen?>"/> -->
											<input type="hidden" name="margen<?= $sectionData->id ?>" value="<?=$margen?>"/>
											</td>
											</tr>
										</table>
										</div>
										
									</td>
					<? } ?>
					</tr>
			<? } ?>
		<? } ?>
	
	</table>
	
	<div class="busc_img">
		<INPUT style="margin-top:10px;" class="boton_buscar"  TYPE=BUTTON OnClick="document.formulario.submit();return false;" VALUE="">
	</div>
	
</form>

</div>
<? include_once(dirname(__FILE__)."/bottom.php"); ?>