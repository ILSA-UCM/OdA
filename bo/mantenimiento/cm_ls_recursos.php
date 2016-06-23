<?
include_once(getcwd()."/include.php");
$titulopaginabo="Listado de Recursos";
$explicaciontitulopaginabo="Listado de recursos + archivos enlace a fichero no existente";
$visit->options->seccion = "Mantenimiento";
$visit->options->subseccion = "listado_recursos";
if (!$visit->options->tieneAcceso("form",$fila)) $visit->options->sinAcceso();
include_once(getcwd()."/bo_top.php");

// alfredo 140707  $session->lsrecursos= $visit->util->getUrlQuery("",$visit->util->getQueryString());
$_SESSION['lsrecursos_mantenimiento']=$visit->util->getUrlQuery("",$visit->util->getQueryString());

//var_dump($_SESSION['lsrecursos']);

$dict=$visit->util->getRequest();
$npag = $dict["npag"];
$paginacion = $dict["paginacion"];
$orden = $dict["orden"];
$orden_tipo = $dict["orden_tipo"];

//var_dump($session->lsrecursos);


if ($npag=="") { 
	$npag=1;
}


$visit->options->paginacion=20;
if ($paginacion!="") $visit->options->paginacion=$paginacion;
$visit->options->maxPaginasSiguientes=3;


$urlName=$visit->util->construyeUrlMenosLista("",$visit->util->getRequest(),"npag");
$urlPag=$visit->util->construyeUrlMenosLista("",$visit->util->getRequest(),"npag,paginacion");
$urlOrden=$visit->util->construyeUrlMenosLista("",$visit->util->getRequest(),"orden,orden_tipo");
$ordenar = $orden." ".$orden_tipo;


$recursos = new ClsResources();
if ($ordenar != " " ){
	$recursos->_orderby=$ordenar;
}

//$recursos = $visit->dbBuilder->getResources();



//var_dump($recursos);
$count = $visit->dbBuilder->getTablaFiltradaCount($recursos); 


	$inicio = ( $npag - 1 ) * $visit->options->paginacion + 1;
	if ($count==0) $inicio=0;
$recursos = $visit->dbBuilder->getTablaFiltradaLimit($recursos, $inicio - 1 ,$visit->options->paginacion);
//var_dump($recursos);
//$recursos= $visit->dbBuilder->getRecursos();
$i_maqueta= 0; //contador de filas para la maquetacion


$ruta ="../download/";
$rutaC="/download/";
$urlBase = dirname(__FILE__)."/..";
?>

<div style="float:right;"> <input type="button" value="eliminar seleccionados" onclick ="eliminar_multiples();" > </div>
<FORM METHOD=GET ACTION="<?= $visit->util->getNombreArchivo( $visit->util->getScriptName() ) ?>" name="formlistado" style="display:inline;">
<TABLE width="100%" border="0" cellpadding="4" cellspacing="0" style="border:1px solid #d0d0d0;" name="formlistado">
		<TR>
				<TD width="15%" height="24" align="left"  background="../img/backoffice_fondo_cab_tabla.jpg">&nbsp;[<?= $inicio ?>-<?= $visit->util->muestrahastareg($visit->options->paginacion,$count,$npag) ?>] de <?= $count ?>&nbsp;
					<? $valoresPaginacion= split(",","20,40,60,100,200,400"); ?>
					<select name ="paginacion"  class="selectpeque" style="width:60px;" onChange="window.location.href=construyeUrlMenosMas(window.location.href,'paginacion,npag','paginacion='+formlistado.paginacion.value)" >
						<? for ($i=0;$i<count($valoresPaginacion);$i++) { ?>
							<option value="<?= $valoresPaginacion[$i] ?>" <? if ($visit->options->paginacion==$valoresPaginacion[$i]) print "selected"; ?>><?= $valoresPaginacion[$i] ?>
						<? } ?>
						<option value ="999999" <? if ($paginacion=="999999") echo "selected"; ?> >Todas
					</select>
				</TD>
				
				<TD width="75%" nowrap background="../img/backoffice_fondo_cab_tabla.jpg" align="center">
				
				<? $visit->util->imprimirPaginacion($visit->options->paginacion, $visit->options->maxPaginasSiguientes, $count, $npag, $urlName); ?>
				
				</TD>
				<td background="../img/backoffice_fondo_cab_tabla.jpg"> </td>
				<td background="../img/backoffice_fondo_cab_tabla.jpg"> </td>
			</TR>
	
	<tr>
		<TD class="listadocabecera" nowrap colspan="1">Id Obj Digital
			<A HREF="<?= $visit->util->concatenaUrl($urlOrden,"orden=idov&orden_tipo=DESC") ?>">
			
				<IMG SRC="<? if ($ordenar=="idov DESC"){ 
					echo '../img/ls_flecha_arriba_sobre.gif';
				} else { 
					echo '../img/ls_flecha_arriba_normal.gif';
				} ?>
			" WIDTH="13" HEIGHT="6" BORDER="0" ALT=""></A>
			<A HREF="<?= $visit->util->concatenaUrl($urlOrden,"orden=idov&orden_tipo=ASC") ?>">
			
				<IMG SRC="<? if ($ordenar=="idov ASC"){ 
					echo '../img/ls_flecha_abajo_sobre.gif';
				} else { 
					echo '../img/ls_flecha_abajo_normal.gif';
				}?>" WIDTH="13" HEIGHT="6" BORDER="0" ALT=""></A>
		</TD>
		<TD class="listadocabecera" nowrap colspan="3">Recursos 
			<A HREF="<?= $visit->util->concatenaUrl($urlOrden,"orden=name&orden_tipo=DESC") ?>">
				<IMG SRC="<? if ($ordenar=="name DESC"){ 
					echo '../img/ls_flecha_arriba_sobre.gif';
				} else { 
					echo '../img/ls_flecha_arriba_normal.gif';
				} ?>
			" WIDTH="13" HEIGHT="6" BORDER="0" ALT=""></A>
			<A HREF="<?= $visit->util->concatenaUrl($urlOrden,"orden=name&orden_tipo=ASC") ?>">
				<IMG SRC="<? if ($ordenar=="name ASC"){ 
					echo '../img/ls_flecha_abajo_sobre.gif';
				} else { 
					echo '../img/ls_flecha_abajo_normal.gif';
				}?>" WIDTH="13" HEIGHT="6" BORDER="0" ALT=""></A></TD>
		</td> 
	</tr>
	
	
		<? //var_dump($recursos);  
			while( list($clave,$valor)=each($recursos)){ ?>
		<?		if ( ($i_maqueta % 2) != 0 ) {
				$lsregistros="listadopar";
			} else {
				$lsregistros="listadoimpar";
			}
		
			// *************** alfredo 140725 
			$tipoRecurso=$valor->getValorType().": ";
			
			
			// alfredo 140802
			//var_dump($valor->idov);
			
			
			
			//var_dump($valor->id); //alfredo 140802
			if ($valor->id!="") {
					$idsrefered = $visit->dbBuilder->getFromReferedFromIdOV($valor->id);
					$stringids = "";
					for ($i=0;$i<count($idsrefered);$i++) { 
							if($idsrefered[$i]->idov!="")
								$stringids .= $idsrefered[$i]->idov.", ";
						}
					$stringids = substr($stringids,0,-2);
					}
			// *************************
		?>
		
		<? if($valor->name =="" && $valor->idov_refered != ""){ // El recurso es un OV 
		  $recursoId = $visit->dbBuilder->getVirtualObjectId($valor->idov_refered);
		if($recursoId != ""){ ?>
				<tr>
					<td class="<?=$lsregistros ?>" style="width:50px;"> <a href="../ov/cm_form_virtual_object.php?id=<?=$valor->idov ?>&desde=mantenimiento"> <?=$valor->idov ?></a></td>
					<!-- alfredo 140725  <td class="<?=$lsregistros ?>"><?=$valor->idov_refered?></td>  -->
					<td class="<?=$lsregistros ?>"><? echo($tipoRecurso);?><?=$valor->idov_refered?></td>
					<td class="<?=$lsregistros ?>" style="width:20px;"> <input name = "check" id = "check-<?=$valor->id ?>" type="checkbox"></td>
					<TD class="<?= $lsregistros ?>" style="width:20px;">
						<?$id=$valor->id;?>
						<?if($id!=""){?>
							<A HREF="#" onclick="
								if (confirm('Seguro que desea eliminar el recurso')) {
										window.location.href='/<?=APP_NAME?>/bo/ov/do.php?op=eliminar_resources&id=<?= $valor->id ?>&idov=<?=$valor->idov ?>&from_mantenimiento=S';
								}
								event.returnValue=false;
								return false;
							" >
								<IMG SRC="../img/ico_eliminar.gif" WIDTH="14" HEIGHT="16" BORDER="0" ALT="">
							</A>
						<?}?>
					</td>
				
		<? $i_maqueta++; } ?>
		<? }else {  ?>
			<? if($valor->idov_refered != "") {//alfredo 140728 
				$rutaB = $ruta.$valor->idov_refered."/".$valor->name;// alfredo 140728 Recurso referenciado  
				$rutaImagen = $rutaC.$valor->idov_refered."/".$valor->name;} //alfredo 140728
				
			else {
				$rutaB = $ruta.$valor->idov."/".$valor->name; 
				$rutaImagen = $rutaC.$valor->idov."/".$valor->name; 
			}?>
			<? $rutacompleta= $rutaImagen;	
				$rutacompleta = $urlBase.$rutacompleta;
				
				if($valor->idov_refered=="") {$ovPropietario=$valor->idov."/";}else{$ovPropietario=$valor->idov_refered."/";}; //alfredo 140728
				
			if ( true ){ $i_maqueta++;?> 
			<tr>
					<td class="<?=$lsregistros ?>" style="width:20px;"> <a href="../ov/cm_form_virtual_object.php?id=<?=$valor->idov ?>&desde=mantenimiento"> <?=$valor->idov ?>
					
					<? //if($stringids!="") echo("Recurso referenciado desde los OD >> ".$stringids."   "); //alfredo 140802 ?>
					
						</a>
					</td>
					<td class="<?=$lsregistros ?>" <?if (!(file_exists($rutacompleta))&&($valor->type!="U") ){?> style="color:red;"<?}?>> <? echo($tipoRecurso);echo($ovPropietario);?><?=$valor->name ?>
					<b  style="color:green;"> <? if($stringids!="") echo("  <-- Recurso referenciado desde OD: ".$stringids." "); ?></b>
					</td>
					
					<td class="<?=$lsregistros ?>" style="width:20px;"> <input name = "check" id = "check-<?=$valor->id ?>" type="checkbox"></td>
					
					<!-- alfredo 140805 ***************************************************************
					<TD class="<?= $lsregistros ?>" style="width:30px;">
					<?$id=$valor->id;?>
						<?if($id!=""){?>
						 <A HREF="#" onclick="
							if (confirm('Seguro que desea eliminar el recurso ZZZZ URL Ajeno propio')) { 
									window.location.href='/<?=APP_NAME?>/bo/ov/do.php?op=eliminar_resources&id=<?= $valor->id ?>&idov=<?=$valor->idov ?>&from_mantenimiento=S';
									}
							
							
							event.returnValue=false;
							return false;
							" >
							<IMG SRC="../img/ico_eliminar.gif" WIDTH="14" HEIGHT="16" BORDER="0" ALT="">
							</A>
						<?}?>
					</td> 
					************************************************************************************  -->
					<TD class="<?= $lsregistros ?>" style="width:20px;">
					<?$id=$valor->id;?>
						<?if($id!=""){?>
						 <A HREF="#" onclick="
						 	if (confirm('Seguro que desea eliminar el recurso')) {
						 		<? if($stringids!=""){ ?>
									if (confirm('Este recurso est\u00e1 siendo referenciado desde el/los objeto/s <?=$stringids?>.\n<?=utf8_encode("¿Confirma la eliminación del recurso?")?>')) {
											window.location.href='/<?=APP_NAME?>/bo/ov/do.php?op=eliminar_resources&id=<?= $valor->id ?>&idov=<?=$valor->idov ?>&from_mantenimiento=S';
											}
									<?} else {?>
											window.location.href='/<?=APP_NAME?>/bo/ov/do.php?op=eliminar_resources&id=<?= $valor->id ?>&idov=<?=$valor->idov ?>&from_mantenimiento=S';
											<?}?>
							}
							event.returnValue=false;
							return false;
							" >
							<IMG SRC="../img/ico_eliminar.gif" WIDTH="14" HEIGHT="16" BORDER="0" ALT="">
							</A>
						<?}?>
					</td>
					
			<? }?>
			</tr>
		<? }  ?>
	<? } ?>	
</table>
</FORM>

<div style="float:right;"> <input type="button" value="eliminar seleccionados" onclick ="eliminar_multiples();" > </div>






<? include_once(getcwd()."/bo_bottom.php"); ?><script>
function eliminar_multiples(){
	if (confirm('Seguro que desea eliminar los recursos seleccionados?')) {
		if(confirm('Los recursos seleccionados se van a eliminar SIN COMPROBAR las referencias ')){
			ids ="";
			objetos = document.getElementsByName("check");
			for(i=0 ; i<objetos.length;i++){
				if(objetos[i].checked){
						ids+= ","+((objetos[i].id).split("-")[1]);
				}
			}
			ids = ids.substr(1);
			window.location.href='do.php?op=eliminar_recursos&id='+ids;
		}
	}
}

</script>