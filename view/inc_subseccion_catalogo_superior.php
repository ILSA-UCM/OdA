<?
include_once(dirname(__FILE__)."/include.php");
$url= $visit->util->getUrlQuery("",$visit->util->getQueryString());
?>
<ul>
	<?
	$strIdsPrimerNivel = $visit->util->f1("0");
	$vStrIdsPrimerNivel = explode(",",$strIdsPrimerNivel );
	foreach($vStrIdsPrimerNivel as $k=>$item){
		if($item != ""){
			$fila = $visit->dbBuilder->getSectionDataId($item);
			$hijos_con_objetos = $visit->dbBuilder->hayHijosNavegablesClasificacion($fila->id, array());
			$objetos_con_valor = $fila->getHijosFromValor("");
			$tengo_objetos = count($objetos_con_valor)>0;
			/*
			* TODO falta por hacer para secciones de modelo metadatos (cuya idpadre es 2)
			* la función hay hijos navegables (alguna subfuncion) no funciona con ese tipo de secciones
			* PROBLEMA: en alguna de esas funciones se hace una consulta con id de seccion vacía
			*/
			if($tengo_objetos || $hijos_con_objetos){ ?>
				<li>
					<? //Calculo del enlace
					$enlaceClas= "/".APP_NAME."/view/ls_ov_clasificacion.php?id=".$fila->id."&paginacion=10&idpadre=".$idActual;
					?>
					<a href="<?= $enlaceClas ?>">
						<span><?= $fila->nombre ?></span>
					</a>
					<ul>
						<?if($fila->tipo_valores =="X"){
							imprimeHijosSup($fila->id, array(),$idActual,$margenLateral,$margenSuperior);
						}else{
							imprimeSusClasificados($fila->id, array(),$idActual,$margenLateral,$margenSuperior);
						}?>
					</ul>
				</li>
			<?}
		}
	}?>
</ul>


<? function imprimeHijosSup($idsec,$acum_navegacion,$idpadre,$margenLateral,$margenSuperior){
	global $visit;
	 $secListado= $visit->util->f1($idsec);	 
	 //var_dump($secHijas);
	 if($secListado != ""){
	 	$secHijas = explode(",",$secListado);
	 	foreach($secHijas as $clave=>$secHija){
	 		if($secHija != ""){
	 			$seccion = $visit->dbBuilder->getSectionDataId($secHija);
	 			if($seccion->tipo_valores=="X"){
	 				imprimeCabeceraX($seccion->id,$seccion->nombre,$idpadre,$acum_navegacion,$margenLateral,$margenSuperior);
	 			}
	 			else{
	 				if($visit->dbBuilder->isSeccionAccesible($seccion->id))
						imprimeCabeceraYClasificados($seccion->id, $seccion->nombre,$idpadre, $acum_navegacion,$margenLateral,$margenSuperior);
	 			}
	 		}
 		}
	 }else {
	 	imprimeSusClasificados($idsec, $acum_navegacion,$idpadre,$margenLateral,$margenSuperior);
	 }
}?>
<?
	function imprimeSusClasificados($idsec,$acum_navegacion,$idpadre,$margenLateral,$margenSuperior){
		global $visit;
		$acum_nuevo = $acum_navegacion;
		$seccion=$visit->dbBuilder->getSectionDataId($idsec);
		$url = $visit->util->construyeURLClasificacion($acum_navegacion,$idpadre,$seccion->id);
		$controlados = $seccion->getHijosFromValor($acum_navegacion);
		
		
	//Impresion de las cajas
	if ($controlados!=""){ 		
		if($controlados[0] != "" ){	//Atributos
			?><? 		
		foreach($controlados as $key=>$value){		
			if(($value->value!= "")){ 
				$acum_nuevo = $acum_navegacion;
				$acum_nuevo[$idsec]= $value->value;
				//var_dump($seccion->id);
				$enlace= $url."&criterio_".$seccion->id."=".$value->value."&value=".$value->idov;;				
				//Nombre del elemento controlado
				if(strlen($value->value)>20){
					$cadena = substr($value->value,0,20)."...";
				} else {
					$cadena = $value->value;
				}
				if ($seccion->tipo_valores == "N"){
					$numdec = $visit->dbBuilder->getCantidadDecimales($seccion->id);
					$cadena= round($cadena,$numdec)." (".$value->cuenta.")";
				}else if( $seccion->tipo_valores == "F" ){									
					$length=strlen($cadena);
					$ano=substr($cadena,0,$length-4);
					$mes=substr($cadena,$length-4,$length-6);
					$dia=substr($cadena,$length-2,$length);

					$cadena = $dia.'/'.$mes.'/'.$ano;
					$cadena = $cadena."(".$value->cuenta.")";	
				}else{
					$cadena= $cadena."(".$value->cuenta.")";					
				}
				$identificadorCaja=$seccion->id."_".str_replace(" ","-", substr($value->value,0,20));
				?>
					<li>
						<a href="<?=$enlace?>">
							<span><?=$cadena?></span>
						</a>
						<? //Hijos Navegables
						$hayNavegables = $visit->dbBuilder->hayHijosNavegablesClasificacion($seccion->id,$acum_nuevo);
						if($hayNavegables){?>
							<ul>
								<? imprimeHijosSup($idsec, $acum_nuevo,$idpadre,$margenLateral,$margenSuperior);?>
							</ul>
						<? } ?>
					</li>
				<? }
			 }
		}
	 }
	 return count($controlados);
}?>

<?
	function imprimeCabeceraX($idsec,$nombre,$idpadre,$acum_navegacion,$margenLateral,$margenSuperior){
		global $visit;
		//Creacion del ID para el div
		if($acum_navegacion != ""){
			$arr_nuevo = $acum_navegacion;
			$identificadorCaja = $idsec."_".substr(array_pop($arr_nuevo),0,20);
		}else{
			$identificadorCaja = $idsec;
		}
		?>
		<li>
			<a href="#" style="cursor:default;font-weight: normal;"><?=$nombre?></a>
			<? //Hijos Navegables
			$hayNavegables = $visit->dbBuilder->hayNavegablesClasificacion($idsec,$acum_navegacion,$margenLateral,$margenSuperior);
			if($hayNavegables){?>
				<ul>
					<? imprimeHijosSup($idsec, $acum_navegacion,$idpadre,$margenLateral,$margenSuperior);?>
				</ul>
			<? } ?>
		</li>
	<?}?>
<?
	function imprimeCabeceraYClasificados($idsec,$nombre,$idpadre, $acum_navegacion,$margenLateral,$margenSuperior){
		global $visit;
		//Creacion del ID para el div
		if($acum_navegacion != ""){
			$arr_nuevo = $acum_navegacion;
			$identificadorCaja = $idsec."_".substr(array_pop($arr_nuevo),0,20);
		}else{
			$identificadorCaja = $idsec;
		}?>
		<?
		ob_start();
		$num_hijos = imprimeSusClasificados($idsec, $acum_navegacion,$idpadre,$margenLateral,$margenSuperior);
		$contenido .= ob_get_contents(); 
		ob_end_clean();
		?>
		<?if($num_hijos>0){?>
			<li>
				<a href="#" style="cursor:default; font-weight: normal;"><?=$nombre?></a>
				<ul>
					<?=$contenido?>
				</ul>
			</li>
		<?}?>
	<?}?>



<script>
	function enciende_sup_class(clave){
		var selectorLista = "#clasificacion_sup_" + clave;
		//alert(selectorLista);
		$(selectorLista).show();
	}
	function apaga_sup_class(clave){
		var selectorLista = "#clasificacion_sup_" + clave;
		$(selectorLista).hide();
	}
</script>