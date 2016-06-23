<?
/*
 * Estructura a mostrar es bloque["id$tipovalor$nombre_seccion$nivel$browseable"]->filas de elementos
 */
$id =$dict["id"];
$idpadre = $dict["idpadre"];
$bloque = array();
if(!($id)){ $id = 0;}
/*
$strIdsPrimerNivel = $visit->util->f1($id);
$vStrIdsPrimerNivel = explode(",",$strIdsPrimerNivel );
$salida = explode(",",$strIdsPrimerNivel);
foreach ($salida as $j=>$v ){
	echo $v."<br>";

}

*/

/*** Controladores de una busqueda anterior ***/
$controladosAnteriores= array();
 reset($dict);
 $criterios="";
 //$acum_navegacion = array();
 while (list($k,$v)=each($dict)) {
      $patron = "id_";
      if (substr($k,0,strlen($patron))==$patron) {
           $ids = $ids . "," . $v;
		   //$id=$v;
      }
	  $patron2 = "criterio_";
      if (substr($k,0,strlen($patron2))==$patron2) {
		   $idc= substr($k,strlen($patron2),strlen($k));
           if($v != "")
			$criterios = $criterios . " - " . $v;
		   $criterio=$v;
		 //  $controladosAnteriores[]=array($idc,$criterio);
		 $acum_navegacion[$idc] = $criterio; 
       }
	 
	  
 }
 $criterios=substr($criterios,3,strlen($criterios));

 
// SI hay criterios , mostramos esa seccion
if($acum_navegacion != ""){	
	$criterioElimTemp = array_pop($acum_navegacion);
	$seccion=$visit->dbBuilder->getSectionDataId($dict["id"]);

	if($seccion->tipo_valores == "F"){									
		$length=strlen($criterioElimTemp);
		$ano=substr($criterioElimTemp,0,$length-4);
		$mes=substr($criterioElimTemp,$length-4,$length-6);
		$dia=substr($criterioElimTemp,$length-2,$length);

		$criterioElim = $dia.'/'.$mes.'/'.$ano;
	}elseif($seccion->tipo_valores == "N"){									
		$decimales = $visit->dbBuilder->getCantidadDecimales($seccion->id);
		$criterioElim= round($criterioElimTemp,$decimales);									 
	}else{
		$criterioElim= $criterioElimTemp;									 
	}

	//echo $seccion->nombre;
	if ($seccion->tipo_valores=="C") {
		$controlados=$visit->dbBuilder->getHijosFromValorControlado($id,$acum_navegacion);
	}  else if ($seccion->tipo_valores=="N") {
		$controlados=$visit->dbBuilder->getHijosFromValorNumerico($id,$acum_navegacion);
	}  else if ($seccion->tipo_valores=="T") {
		$controlados=$visit->dbBuilder->getHijosFromValorTexto($id,$acum_navegacion);
	}else if ($seccion->tipo_valores =="F"){
		$controlados=$visit->dbBuilder->getHijosFromFecha($id,$acum_navegacion);
	} else {
		$controlados=$visit->dbBuilder->getHijosFromValorControlado($id,$acum_navegacion);
		//array_push ($controlados,$contr);
	}
	
	/*
 	* Estructura a mostrar es bloque["id$tipovalor$nombre_seccion$nivel$browseable"]->filas de elementos
 	*/
	foreach($controlados as $key=>$value){	
		if($value->value != ""){
			$valores[] = $value->value;
		}
	}
	if($valores != ""){
		$filas[$seccion->id."&".$seccion->tipo_valores."&".$seccion->nombre."&0&".$seccion->browseable]=$controlados;
		$bloque[] = $filas;
	}
}
else{
	$strIdsPrimerNivel = $visit->util->clasificacionSectionDataPrimerNivel($id);
	$vStrIdsPrimerNivel = explode(",",$strIdsPrimerNivel );
/*
$salida = explode(",",$strIdsPrimerNivel);
foreach ($salida as $j=>$v ){
	echo $v."<br>";

}
*/


	if($strIdsPrimerNivel !=""){
		$clave = -1;
		$bloque = array();
		$secciones = explode(",",$strIdsPrimerNivel );	
		//var_dump($secciones);
		foreach($secciones as $key=>$valor){
			if($valor !=""){
				$sec = explode('&',$valor);
				$seccion_id =$sec[0]; 
				$seccion_tipo = $sec[1];	
				$seccion_nombre = $sec[2];	
				$seccion_nivel = $sec[3];
				$seccion_browseable = $sec[4];
				if($seccion_nivel == "0"){ $clave++;}
				$array_nivel = $bloque[$clave];
				$filas =array();
				if($seccion_browseable =="S"){	
					switch ($seccion_tipo) {
						case "C":
							$filas=$visit->dbBuilder->getHijosFromValorControlado($seccion_id ,"");
							break;
						case "F":
							$filas=$visit->dbBuilder->getHijosFromFecha($seccion_id ,"");
							break;	
						case "T":
							$filas=$visit->dbBuilder->getHijosFromValorTexto($seccion_id ,"");
							break;
						case "N":
							$filas=$visit->dbBuilder->getHijosFromValorNumerico($seccion_id ,"");			
							break;
						default:
							$filas=$visit->dbBuilder->getHijosFromValorTexto($seccion_id ,"");
					}
				}
				$array_nivel[$seccion_id."&".$seccion_tipo."&".$seccion_nombre."&".$seccion_nivel."&".$seccion_browseable]=$filas;
				$bloque[$clave]=$array_nivel;
			}
		}	
	}
}


?>

<!-- MUESTRA DE ELEMENTOS -->

<? reset($bloque);?>
<?//var_dump($bloque);?>
<? $countcajas = 0;?>
<?foreach ($bloque as $k=>$vals){ ?>
	<? if($countcajas % 3 =="0") { ?><div class="clearfix"></div> <? }?>

	<?foreach ($vals as $clave=>$item){ 
		 $c= explode("&",$clave);
			$iden = $c[0];
			$tipoValor = $c[1];
			$nombre = $c[2];
			$nivel = $c[3];
			$browseable = $c[4];
			if($nivel == "0"){	$margen_sub = "80px";	}
			else { 	$margen_sub = "20px";	}
		if($visit->dbBuilder->isSeccionAccesible($iden)){
		?>	
	<div class="clasificacion_caja">
		
		<? 
			if($browseable =="S"){ ?>
			<? if($tipoValor == "T" || $tipoValor == "C" || $tipoValor == "N" || $tipoValor == "F"){ ?> <!-- ELEMENTO CON SOLO ETIQUETA -->
				<div class="clasificacion_linea" ><?=$nombre?></div>
				<div class="clasificacion_input">
					<select  class="selector" id="clasificacion_buscador_<?=$iden?>" onchange="window.location.href=this.options[this.selectedIndex].value">
					<? $url = $visit->util->construyeURLClasificacion($acum_navegacion,$idpadre,$iden);?>
					<? foreach($item as $key=>$value){ ?>
						<? if( $value->value != "") {?>	
							<?//echo $value->value;?>
							<? 
								$esSuperAdmin = $visit->options->usuario->esRolSuperadmin();
								if($esSuperAdmin){
									$numelems = $visit->dbBuilder->getValoresCount($iden,$value->value);	
								}else{
									$numelems = $visit->dbBuilder->getValoresCountNoPrivados($iden,$value->value);	
								}
								$cadenaSalida = substr($value->value,0,30);	
							?>			
							<option   style="width:300px;"  value="<?=$url?>&criterio_<?=$iden?>=<?=$value->value;?>&idpadre=<?=$idpadre?>&value=<?=$value->idov?>" >
								 
								 <?if( $tipoValor == "F" ){		
									$length=strlen($cadenaSalida);
									$ano=substr($cadenaSalida,0,$length-4);
									$mes=substr($cadenaSalida,$length-4,$length-6);
									$dia=substr($cadenaSalida,$length-2,$length);

									$cadenaSalida = $dia.'/'.$mes.'/'.$ano;
									$cadenaSalida = $cadenaSalida."(".$numelems.")";
								 }else if( $tipoValor == "N" ){									
									$numdec = $visit->dbBuilder->getCantidadDecimales($iden);
									$cadenaSalida= round($cadenaSalida,$numdec)."(".$numelems.")";
								 }else{
								 	$cadenaSalida = $cadenaSalida."(".$numelems.")";
								 }?>
								 <?=$cadenaSalida?> 

							</option> 		
						<? } ?>
					<? }?>
					</select>
				</div>
			<?} else{ ?>
				<div class="clasi_subtitulo" style="margin-left:<?=$margen_sub?>;" ><?=$nombre?></div>
			<? }?>
		<? }else{ ?>
			<div class="clasi_subtitulo" style="margin-left:<?=$margen_sub?>;" ><?=$nombre?></div>
		<?} ?>
</div>
	
	<? }?>
	<? }?>
<? $countcajas++;?>		
<? } ?>

<div class="clearfix"></div>

<script>

$('.selector').each(
	function(index,value){
		$(this).combobox({
			selected: function(){ window.location.href=(this.value);}
		});
	}
);
$(".selector" ).next().val("<?=$criterioElim?>"); 

/*

$('#entrada_buscador_vo1').combobox({
	selected: function(){ window.location.href='cm_view_virtual_object.php?idov='+(this.value);}
});

*/

</script>
