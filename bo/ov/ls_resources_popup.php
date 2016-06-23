<? 
/* 
* Archivo generado dinámicamente por Content Manager
*/
include_once(dirname(__FILE__)."/include.php");
///if (!$visit->options->tieneAcceso("ls",new ClsResources())) $visit->options->sinAcceso();
include_once(dirname(__FILE__)."/top_simple.php");
//$visit->debuger->enable(true);

$dict=$visit->util->getRequest();
$npag = $dict["npag"];
$paginacion = $dict["paginacion"];
$orden = $dict["orden"];
$orden_tipo = $dict["orden_tipo"];
$propio=$dict["propio"];
$idov= $dict["idov"];
$id= $dict["id"];


if ($npag=="") $npag=1;
// alfredo  140716   $session->lsresources= $visit->util->getUrlQuery("",$visit->util->getQueryString());
$_SESSION["lsresources"]= $visit->util->getUrlQuery("",$visit->util->getQueryString());
$visit->options->paginacion=99999;
if ($paginacion!="") $visit->options->paginacion=$paginacion;
$visit->options->maxPaginasSiguientes=3;
$urlName=$visit->util->construyeUrlMenosLista("",$visit->util->getRequest(),"npag");
$urlPag=$visit->util->construyeUrlMenosLista("",$visit->util->getRequest(),"npag,paginacion");
$urlOrden=$visit->util->construyeUrlMenosLista("",$visit->util->getRequest(),"orden,orden_tipo");
$ordenar = $orden." ".$orden_tipo;
/*
* Descomentar y sustituir para Metodo de obtención de filas directo sin filtros.
$count = $visit->dbBuilder->getResourcesCount(); 
$inicio = ( $npag - 1 ) * $visit->options->paginacion + 1;
$filas = $visit->dbBuilder->getResourcesLimit($inicio -1 ,$visit->options->paginacion);
*/
$resources = new ClsResources();
if (trim($ordenar)!="") $resources->_orderby = $ordenar;
$count = $visit->dbBuilder->getTablaFiltradaCount($resources); 
$inicio = ( $npag - 1 ) * $visit->options->paginacion + 1;
if ($count==0) $inicio=0;
if ($idov!=""){
	if ($propios="S")
		$filas = $visit->dbBuilder->getRecursosPropiosFromOV($id);
	else
		$filas = $visit->dbBuilder->getRecursosFromOV($id);
} else {
	$filas = $visit->dbBuilder->getTablaFiltradaLimit($resources, $inicio - 1 ,$visit->options->paginacion);
}
// COMANAGER 1.0: Codigo personalizado
function getTitulo() {
	return $this->id;
} 
function getAvance() {
	global $visit;
	return $visit->util->acortaCadena( $this->id );
} 
// COMANAGER 1.0: Fin Codigo personalizado
?>	
<script>
	function getElement( id, ndoc) {
		var element;
		if (ndoc==null) doc=document;
		else doc=ndoc;
		//alert(id);
		if (doc.getElementById(id)==null) {
			element = doc.all[id];
		} else {
			element =doc.getElementById(id);
		}
		return element;
	}

	function asignarRecurso(id,nombre,idrec) {
		var nodo = getElement('idov_refered',window.opener.opener.document); //alfredo 140728
		nodo.value=id;
		var nodo2 = getElement('nombre_recurso_existente',window.opener.opener.document);
		nodo2.value=nombre;
		var nodo3 = getElement('idresource_refered',window.opener.opener.document); // alfredo 140728 cambio id_recurso_ref por idresource_refered
		nodo3.value=idrec;
	}
</script>

<FORM METHOD=GET ACTION="<?= $visit->util->getNombreArchivo( $visit->util->getScriptName() ) ?>" name="formlistado" style="display:inline;">
	<input type="hidden" name="paginacion" value="<?= $visit->options->paginacion ?>">
	<!-- <TABLE  border="0" width="100%" cellpadding="0" cellspacing="0" style="border:1px solid #CCCCCC;">
		<TR>
			<TD width="30%" height="24" align="left"  background="img/backoffice_fondo_cab_tabla.jpg">&nbsp;[<?= $inicio ?>-<?= $visit->util->muestrahastareg($visit->options->paginacion,$count,$npag) ?>] de <?= $count ?>&nbsp;
				<? $valoresPaginacion=explode(",","20,40,60,100,200,400"); ?>
				<select name ="paginacion"  class="selectpeque" style="width:60px;" onChange="window.location.href=construyeUrlMenosMas(window.location.href,'paginacion,npag','paginacion='+formlistado.paginacion.value)" >
					<? for ($i=0;$i<count($valoresPaginacion);$i++) { ?>
						<option value="<?= $valoresPaginacion[$i] ?>" <? if ($visit->options->paginacion==$valoresPaginacion[$i]) print "selected"; ?>><?= $valoresPaginacion[$i] ?>
					<? } ?>
					<option value ="999999" <? if ($paginacion=="999999") echo "selected"; ?> >Todas
				</select>
			</TD>
			<TD width="40%" nowrap background="img/backoffice_fondo_cab_tabla.jpg" align="center">
				<? $visit->util->imprimirPaginacion($visit->options->paginacion, $visit->options->maxPaginasSiguientes, $count, $npag, $urlName); ?>
			</TD>
		</TR>
	</TABLE> -->
</FORM>
<form name="form_generacion" action="do.php" method="POST"  style="display:inline;">
	<TABLE class="lstabla" width="100%" cellpadding="0" cellspacing="0">
	<tr>
		<td align="center" style="padding-top:20px;">
			<h3>Listado de Recursos del Objeto Virtual <?=$id?></h3>
			<hr/>
		</td>
	</tr>
	<? for ($i=0;$i<count($filas);$i++) { ?>
	<?
		if ( ($i % 2) == 0 ) {
			$lsregistros="lsregistrospar";
		} else {
			$lsregistros="lsregistrosimpar";
		}
	?>
	<? $recurso = $filas[$i];?>
	<table class="item" border="0" cellspacing="0" cellpadding="0" width="500px">					
					<tr class="<?= $lsregistros ?>">
						<td height="30px" class="popupcampo" nowrap>
							<i><?= $recurso->getValorType() ?></i>
							&nbsp;-&nbsp;
							<a href="#" onclick="asignarRecurso(<?= $id ?>,'<?=$filas[$i]->name?>',<?=$filas[$i]->id?>);window.opener.close();window.close();return false">
								Seleccionar: <?echo(" ".$recurso->name);?>
							</a>
						</td>
						<td rowspan="10" colspan="2" align="right" rowspan="10">
							<? if ($recurso->name!="OV") {
								if ($recurso->type=="P" ) {
									if ($visit->util->esImagen($recurso->name)) {
						 ?>
									<a href="../download/<?=$id?>/<?=$recurso->name?>" target="_blank">
										<div style="width:75px; overflow-y:hidden;">
											<img src="../download/<?=$id?>/<?=$recurso->name?>" width="75px" border="0">
										</div>			
									</a>
								<? } else if (substr($recurso->name,strlen($recurso->name)-4, strlen($recurso->name))==".pdf"){ ?>
									<a href="../download/<?=$id?>/<?=$recurso->name?>" target="_blank"><IMG SRC='img/icon_pdf.gif' WIDTH="50" HEIGHT="50" BORDER="0" ALT=""></a>
								<? } else if ((substr($recurso->name,strlen($recurso->name)-4, strlen($recurso->name))==".htm")||
								              (substr($recurso->name,strlen($recurso->name)-5, strlen($recurso->name))==".html")){ //alfredo 140719 ?>
									<a href="../bo/download/<?=$id?>/<?=$recurso->name?>" target="_blank"><IMG SRC='img/ico_html.png' WIDTH="40" HEIGHT="40" BORDER="0" ALT=""></a>
								<? } else if ((substr($recurso->name,strlen($recurso->name)-4, strlen($recurso->name))==".doc")||
							                  (substr($recurso->name,strlen($recurso->name)-5, strlen($recurso->name))==".docx")){ //alfredo 140719 ?>
									<a href="../download/<?=$id?>/<?=$recurso->name?>" target="_blank"><IMG SRC='img/icon_word.gif' WIDTH="50" HEIGHT="50" BORDER="0" ALT=""></a>
								<? } else { ?>
									<a href="../download/<?=$id?>/<?=$recurso->name?>" target="_blank"><IMG SRC='img/icon_text.gif' WIDTH="37" HEIGHT="47" BORDER="0" ALT=""></a>
								<? } ?>		
							<? } else if ($recurso->type=="F"){
									if ($visit->util->esImagen($recurso->name)) { ?>
										<a href="../download/<?=$recurso->idov_refered //alfredo 140728?>/<?=$recurso->name?>" target="_blank">
											<div style="width:75px; overflow-y:hidden;">
												<IMG SRC='../download/<?=$recurso->idov_refered //alfredo 140728?>/<?=$recurso->name?>' WIDTH="75" BORDER="0" ALT="">
											</div>
										</a>
									<? } else if (substr($recurso->name,strlen($recurso->name)-4, strlen($recurso->name))==".pdf"){ ?>
									<a href="../download/<?=$recurso->idov_refered //alfredo 140728?>/<?=$recurso->name?>" target="_blank"><IMG SRC='img/icon_pdf.gif' WIDTH="50" HEIGHT="50" BORDER="0" ALT=""></a>
									<? } else if ((substr($recurso->name,strlen($recurso->name)-4, strlen($recurso->name))==".htm")||
								                  (substr($recurso->name,strlen($recurso->name)-5, strlen($recurso->name))==".html")){ //alfredo 140719 ?>
									<a href="../bo/download/<?=$recurso->idov_refered //alfredo 140728?>/<?=$recurso->name?>" target="_blank"><IMG SRC='img/ico_html.png' WIDTH="40" HEIGHT="40" BORDER="0" ALT=""></a>
								<? } else if ((substr($recurso->name,strlen($recurso->name)-4, strlen($recurso->name))==".doc") ||
							                  (substr($recurso->name,strlen($recurso->name)-5, strlen($recurso->name))==".docx")){ //alfredo 140719 ?>
										<a href="../download/<?=$recurso->idov_refered //alfredo 140728?>/<?=$recurso->name?>" target="_blank"><IMG SRC='img/icon_word.gif' WIDTH="50" HEIGHT="50" BORDER="0" ALT=""></a>
									<? } else { ?>
										<a href="../download/<?=$recurso->idov_refered //alfredo 140728?>/<?=$recurso->name?>" target="_blank"><IMG SRC='img/icon_text.gif' WIDTH="37" HEIGHT="47" BORDER="0" ALT=""></a>
									<? } ?>
							<? }else if ($recurso->type=="H"){ ?>
										<a href="../download/<?=$id?>/<?=$recurso->name?>" target="_blank">
										<IMG SRC='img/ico_html.png' WIDTH="45"  height="45" BORDER="0" ALT="">
										</a>
							<? } else { ?>
								<a href="#"  onclick='window.open("cm_view_virtual_object.php?idov=<?=  $recurso->idov_refered ?>&seleccion=1","","width=600,height=650,scrollbars=yes"); return false;'>
									<div style="width:75px; overflow-y:hidden;">
										<? 
											$iconoOV= $visit->dbBuilder->getIconoFromOV($recurso->idov_refered); 
											$rutaiconoOV = "../bo/download/".$recurso->idov_refered."/".$iconoOV->name
										?>
										<IMG SRC='<?=$rutaiconoOV?>' WIDTH="75" BORDER="0" ALT="">
									</div>
								</a>
							<? } ?>
						<? } ?>
						</td>
					</tr>
					<? 
						$seccionesRecursos = $visit->dbBuilder->getSeccionesNavegablesFromIdPadre("3");
						while (list ($clave, $idsec2) = each ($seccionesRecursos)) { ?>	
						<?	if($idsec2->visible=="S"){	?>
						<tr class="<?= $lsregistros ?>">	
							<?
							$idrecurso = $recurso->id;
							$idov = $id;
							$idseccion = $idsec2->id;
							$tipo = $idsec2->tipo_valores;
							if("T"==$tipo)
								$v = $visit->dbBuilder->getTextDataFromSectionResourceOV($idov,$idrecurso,$idseccion);
							else if("N"==$tipo)
								$v = (string) $visit->dbBuilder->getNumericDataFromSectionResourceOV($idov,$idrecurso,$idseccion);
							else if("C"==$tipo)
								$v = (string) $visit->dbBuilder->getControlledDataFromSectionResourceOV($idov,$idrecurso,$idseccion);
							?>
							<td colspan="2" style="padding-right:70px; padding-bottom:10px;">
								<? if ($v!="" &&  $visit->util->normalizeString($v)!= "~sin asignar" ) {?>
									<b><?= $idsec2->nombre	?>:&nbsp;</b>
									<?= $v ?>
								<? } ?>
							</td>		
						 </tr>
						 <?
							$seccionesRecursosN2 = $visit->dbBuilder->getSeccionesNavegablesFromIdPadre($idsec2->id);
							while (list ($clave3, $idsec3) = each ($seccionesRecursosN2)) { ?>
							<tr class="<?= $lsregistros ?>">	
								<?
								$idrecurso = $recurso->id;
								$idov = $id;
								$idseccion = $idsec3->id;
								$tipo = $idsec3->tipo_valores;
								if("T"==$tipo)
									$v = $visit->dbBuilder->getTextDataFromSectionResourceOV($idov,$idrecurso,$idseccion);
								else if("N"==$tipo)
									$v = (string) $visit->dbBuilder->getNumericDataFromSectionResourceOV($idov,$idrecurso,$idseccion);
								else if("C"==$tipo)
									$v = (string) $visit->dbBuilder->getControlledDataFromSectionResourceOV($idov,$idrecurso,$idseccion);
								?>
								<td colspan="2">
									<img src="img/pc.gif" height="1px" width="20px" border="0" />
									<? if ($v!="" &&  $visit->util->normalizeString($v)!= "~sin asignar" ) {?>
										<b><?= $idsec3->nombre	?>:&nbsp;</b>
										<?= $v ?>
									<?}?>
								</td>
							</tr>
								<?
								$seccionesRecursosN3 = $visit->dbBuilder->getSeccionesNavegablesFromIdPadre($idsec3->id);
								while (list ($clave4, $idsec4) = each ($seccionesRecursosN3)) { ?>
								<tr>	
									<?
									$idrecurso = $recurso->id;
									$idov = $id;
									$idseccion = $idsec4->id;
									$tipo = $idsec3->tipo_valores;
									if("T"==$tipo)
										$v = $visit->dbBuilder->getTextDataFromSectionResourceOV($idov,$idrecurso,$idseccion);
									else if("N"==$tipo)
										$v = (string) $visit->dbBuilder->getNumericDataFromSectionResourceOV($idov,$idrecurso,$idseccion);
									else if("C"==$tipo)
										$v = (string) $visit->dbBuilder->getControlledDataFromSectionResourceOV($idov,$idrecurso,$idseccion);
									?>
									<td colspan="2">
										<img src="img/pc.gif" height="1px" width="40px" border="0" />
										<? if ($v!="" &&  $visit->util->normalizeString($v)!= "~sin asignar" ) {?>
											<b><?= $idsec4->nombre	?>:&nbsp;</b>
											<?= $v ?>
										<?}?>
									</td>
								</tr>
								<? } // while ?>
							<? } // while ?>
							<?}?>
						 <? } // while ?>
					
					<hr>
				<? } ?>
				</table>
</form>
<? include_once(dirname(__FILE__)."/bottom_simple.php"); ?>