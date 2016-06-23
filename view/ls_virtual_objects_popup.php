<? 
include_once(dirname(__FILE__)."/include.php");
///if (!$visit->options->tieneAcceso("ls",new ClsVirtualObject())) $visit->options->sinAcceso();
include_once(dirname(__FILE__)."/top_simple.php");

$dict=$visit->util->getRequest();
$npag = $dict["npag"];
$paginacion = $dict["paginacion"];
$orden = $dict["orden"];
$orden_tipo = $dict["orden_tipo"];
$recOV=$dict["recOV"];
$idov= $dict["idov"];

if ($npag=="") { 
	$npag=1;
}
//$session->lsvirtual_object= $visit->util->getUrlQuery("",$visit->util->getQueryString());
//  OJO  alfredo 140707  $session->lsvirtual_object= $visit->util->getUrlQuery("",$visit->util->getQueryString());
$_SESSION['lsvirtual_object']= $visit->util->getUrlQuery("",$visit->util->getQueryString());
$visit->options->paginacion = 20;
if ($paginacion!="") $visit->options->paginacion=$paginacion;
$visit->options->maxPaginasSiguientes=3;


$urlName=$visit->util->construyeUrlMenosLista("",$visit->util->getRequest(),"npag");
$urlPag=$visit->util->construyeUrlMenosLista("",$visit->util->getRequest(),"npag,paginacion");
$urlOrden=$visit->util->construyeUrlMenosLista("",$visit->util->getRequest(),"orden,orden_tipo");
$ordenar = $orden." ".$orden_tipo;
/*
 * Descomentar y sustituir para Metodo de obtención de filas directo sin filtros.
 $count = $visit->dbBuilder->getVirtualObjectCount(); 
 $inicio = ( $npag - 1 ) * $visit->options->paginacion + 1;
 $filas = $visit->dbBuilder->getVirtualObjectLimit($inicio -1 ,$visit->options->paginacion);
*/

$virtualObject = new ClsVirtualObject();

if ($id==""){
	if (trim($ordenar)!="") $virtualObject->_orderby = $ordenar;
	$count = $visit->dbBuilder->getTablaFiltradaCount($virtualObject); 
	$inicio = ( $npag - 1 ) * $visit->options->paginacion + 1;
	$filas = $visit->dbBuilder->getTablaFiltradaLimit($virtualObject, $inicio - 1 ,$visit->options->paginacion);
} else {
	$filas[0] = $visit->dbBuilder->getVirtualObjectId($id);
	$count=1;

}
$inicio = ( $npag - 1 ) * $visit->options->paginacion + 1;
if ($count==0) $inicio=0;

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
		//element = doc.all[id];
	} else {
		element =doc.getElementById(id);
	}
	return element;
}

function asignarOV(id){
	window.opener.document.formulario.idov_refered.value=id;
	
	var nodo = getElement('ovtext',window.opener.document);
	nodo.value=id;
}

function perteneceLista(valor,lista) {
        var res=false;
        pos =(","+lista+",").indexOf(","+valor+",");
        if (pos!=-1) {
                res=true;
        }
        return res;
}

function construyeUrlMenosMas(url,lista,itemsMas) {
	var res,urlBase,resto,w,x,i,atributo,valor,nresto;
	var v = url.split("?");
	if (v.length==1) {
		res = url+"?"+itemsMas;
	} else {
		nresto="";
		urlBase = v[0];
		resto = v[1];
		w = resto.split("&");
		for (i=0;i<w.length;i++) {
			if (w[i]!=""){
				x = w[i].split("=");
				atributo = x[0];
				valor="";
				if (x.length>0) valor = x[1];
				if (valor!="") {
					if (!perteneceLista(atributo,lista)) {
						nresto = nresto + "&" + atributo + "=" + valor;
					}
				}
			}
		}
		nresto += "&" + itemsMas;
		if (nresto!="") nresto=nresto.substring(1);
		res = urlBase + "?" + nresto;
	}
	return res;
}
</script>
<FORM METHOD=GET ACTION="<?= $visit->util->getNombreArchivo( $visit->util->getScriptName() ) ?>" name="formlistado" style="display:inline;">
<input type="hidden" name="paginacion" value="<?= $visit->options->paginacion ?>">
<table>
	<tr>
		<td class="popuptitcampo">
			Identificador de Objeto Virtual:
		</td>
		<td  class="popupcampo">
			<input name="idovBusqueda" type="text" size="20" maxlength="8" value="<?=$id?>" >&nbsp;&nbsp;[ <a href="#" onclick="window.location.href='ls_virtual_objects_popup.php?idov=<?= $idov ?>&recOV=<?= $recOV?>&id='+document.formlistado.idovBusqueda.value; return false;">buscar</a> ]
		</td>		
	</tr>
</table>
<? if ($filas!="")  { ?>		
	<!-- alfredo 140717 <TABLE width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF"> -->
	<TABLE width="95%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
		<TR>
			<TD width="200" valign="bottom" align="left">
				<TABLE width="200" border="0" cellpadding="0" cellspacing="0"  background="img/filtros_tit_fondo.gif" style="border-left:1px solid #B1B1B1;border-right:1px solid #B1B1B1;border-top:1px solid #B1B1B1;" > 		
					<TR>
						<TD width="11"><IMG SRC="img/filtros_bullet_titulos.gif" WIDTH="11" HEIGHT="19" BORDER="0" ALT=""></TD>
						<TD valign="middle"  nowrap><span class="titcuadro">Listado de objetos virtuales</span></TD>
						<TD width="3"><IMG SRC="img/pc.gif" WIDTH="3" HEIGHT="17" BORDER="0" ALT=""></TD>						
					</TR>	
				</TABLE>				
			</TD>
			<TD align="center" valign="bottom">
				&nbsp;
			</TD>
		</TR>
	</TABLE>
	<!-- alfredo 140717 <TABLE  border="0" width="100%" cellpadding="0" cellspacing="0" style="border:1px solid #CCCCCC;"> -->
	<TABLE  border="0" width="95%" cellpadding="0" cellspacing="0" style="border:1px solid #CCCCCC;">
		<TR>
			<TD width="5%" height="24" align="left"  background="img/backoffice_fondo_cab_tabla.jpg">&nbsp;[<?= $inicio ?>-<?= $visit->util->muestrahastareg($visit->options->paginacion,$count,$npag) ?>] de <?= $count ?>&nbsp;
				<? $valoresPaginacion=split(",","20,40,60,100,200,400"); ?>
				<select name ="pag"  class="selectpeque" style="width:60px;" onChange="window.location.href=construyeUrlMenosMas(window.location.href,'paginacion,npag','paginacion='+this.value)" >
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
	</TABLE>
</FORM>
<form name="form_generacion" action="do.php" method="POST"  style="display:inline;">
<!-- alfredo 140717  <TABLE class="lstabla" width="100%"  cellpadding="0" cellspacing="0"> -->
<TABLE class="lstabla" width="70%"  cellpadding="0" cellspacing="0">
	<!-- CAMPOS -->
	<style>
		.lscabecera { font-size:12px; background-color: #ECFFFD;}
	</style>
	<TR>
		<!-- alfredo  140717  <TD width="30px" class="lscabecera" -->
		<TD width="10px" class="lscabecera"
				<? if ($orden=="name") { ?>
					class="camposlsactivo"
				<? } else { ?>
					class="camposls"
				<? } ?>
				>Identificador&nbsp;
				<!-- <A HREF="<?= $visit->util->concatenaUrl($urlOrden,"orden=name&orden_tipo=DESC") ?>"><IMG SRC="
				<? if ($ordenar=="name DESC"){ 
					echo 'img/ls_flecha_arriba_sobre.gif';
				} else { 
					echo 'img/ls_flecha_arriba_normal.gif';
				} ?>
				" WIDTH="13" HEIGHT="6" BORDER="0" ALT=""></A><BR><A HREF="<?= $visit->util->concatenaUrl($urlOrden,"orden=name&orden_tipo=ASC") ?>"><IMG SRC="
				<? if ($ordenar=="name ASC"){ 
					echo 'img/ls_flecha_abajo_sobre.gif';
				} else { 
					echo 'img/ls_flecha_abajo_normal.gif';
				}
				?>" WIDTH="13" HEIGHT="6" BORDER="0" ALT=""></A> -->
		</TD>
		<!-- <TD class="lscabecera"  colspan="0" width='100'> -->
		<TD class="lscabecera"  colspan="0" width='10'>
				<? 
				$seccion=$visit->dbBuilder->getSectionDataId(111);
				echo $seccion->nombre;
				?> 
		</TD>
		<!-- <TD class="lscabecera"  colspan="0" width='100'> -->
		<TD class="lscabecera"  colspan="0" width='10'>
				<? 
				$seccion=$visit->dbBuilder->getSectionDataId(112);
				echo $seccion->nombre; 
				?>&nbsp;&nbsp;
		</TD>					
		<!-- <TD class="lscabecera" width="60px" -->
		<TD class="lscabecera" width="10px"
				<? if ($orden=="ispublic") { ?>
					class="camposlsactivo"
				<? } else { ?>
					class="camposls"
				<? } ?>
				>P&uacute;blico&nbsp;
				<!-- <A HREF="<?= $visit->util->concatenaUrl($urlOrden,"orden=ispublic&orden_tipo=DESC") ?>"><IMG SRC="
				<? if ($ordenar=="ispublic DESC"){ 
					echo 'img/ls_flecha_arriba_sobre.gif';
				} else { 
					echo 'img/ls_flecha_arriba_normal.gif';
				} ?>
				" WIDTH="13" HEIGHT="6" BORDER="0" ALT=""></A><BR><A HREF="<?= $visit->util->concatenaUrl($urlOrden,"orden=ispublic&orden_tipo=ASC") ?>"><IMG SRC="
				<? if ($ordenar=="ispublic ASC"){ 
					echo 'img/ls_flecha_abajo_sobre.gif';
				} else { 
					echo 'img/ls_flecha_abajo_normal.gif';
				}
				?>" WIDTH="13" HEIGHT="6" BORDER="0" ALT=""></A> -->
		</TD>
		<TD class="lscabecera" width="10px"
				<? if ($orden=="isprivate") { ?>
					class="camposlsactivo"
				<? } else { ?>
					class="camposls"
				<? } ?>
				>Privado&nbsp;
		</TD>
	</TR>
	<? for ($i=0;$i<count($filas);$i++) { ?>
	<?
		if ($filas[$i]->ispublic=="N"&&$visit->options->usuario->esRolAdmin()&&!$visit->util->perteneceCadena($filas[$i]->id,$visit->dbBuilder->getListaPermisosFromUsuario($visit->options->usuario->id))) {
			continue;
		}
		if ( ($i % 2) != 0 ) {
			$lsregistros="lsregistrospar";
		} else {
			$lsregistros="lsregistrosimpar";
		}
	?>
	<? if($idov!=$filas[$i]->id){ //alfredo 140802 ?>
		<tr>	
			<TD class="<?= $lsregistros ?>"><a href='#' <? if ($recOV=="N") { ?> onclick='window.open("ls_resources_popup.php?id=<?=$filas[$i]->id ?>&idov=<?=$idov?>&propios=S","","width=1000,height=800,scrollbars=yes");return false;' <? } else { ?> onclick='asignarOV(<?= $filas[$i]->id?>);window.close();return false;' <? } ?>> OV  <?= $filas[$i]->id ?></a></TD>
			<TD class="<?= $lsregistros ?>" nowrap>
				<?	
					$item = $visit->dbBuilder->getNombreFromIdOV($filas[$i]->id);
					if(strlen($item->value)>50){
						print substr($item->value,0,50);
						print "...";
					} else {
						print $item->value;
					}
				?>
			</td>
			<TD class="<?= $lsregistros ?>" nowrap>
				<?	
					$item = $visit->dbBuilder->getDescripcionFromIdOV($filas[$i]->id);
					if(strlen($item->value)>15){
						print substr($item->value,0,15);
						print "...";
					} else {
						print $item->value;
					}
				?>
			</td>
			<TD class="<?= $lsregistros ?>"><B>
						<? if ($filas[$i]->ispublic=="S"){  ?> 
								<IMG SRC="img/ico_checked_si.gif" WIDTH="12" HEIGHT="12" BORDER="0" ALT="">  
						<?	}else{ ?>
								<IMG SRC="img/ico_checked_no.gif" WIDTH="12" HEIGHT="12" BORDER="0" ALT="">
						<? } ?>
				</B>
			</TD>
			<TD class="<?= $lsregistros ?>"><B>
						<? if ($filas[$i]->isprivate=="S"){  ?> 
								<IMG SRC="img/ico_checked_si.gif" WIDTH="12" HEIGHT="12" BORDER="0" ALT="">  
						<?	}else{ ?>
								<IMG SRC="img/ico_checked_no.gif" WIDTH="12" HEIGHT="12" BORDER="0" ALT="">
						<? } ?>
				</B>
			</TD>
		</tr>
		<? } ?>
	<? } ?>
</table>
<!-- alfredo 14717 <TABLE  width="100%" cellpadding="0" cellspacing="0" style="border:1px solid #CCCCCC;"> -->
<TABLE  width="95%" cellpadding="0" cellspacing="0" style="border:1px solid #CCCCCC;">
	<TR>
		<TD width="10%" height="24" align="left"  background="img/backoffice_fondo_cab_tabla.jpg">&nbsp;[<?= $inicio ?>-<?= $visit->util->muestrahastareg($visit->options->paginacion,$count,$npag) ?>] de <?= $count ?>&nbsp;
			<? $valoresPaginacion=split(",","20,40,60,100,200,400"); ?>
		</TD>
		<TD width="75%" nowrap background="img/backoffice_fondo_cab_tabla.jpg" align="center">		
			<? $visit->util->imprimirPaginacion($visit->options->paginacion, $visit->options->maxPaginasSiguientes, $count, $npag, $urlName); ?>
		</TD>
	</TR>
</TABLE>
<? } else { ?>
	</FORM>
	<table cellspacing='0' cellpadding='0' width='100%'>
	<tr>
		<td align='center'>No se han encontrado Objetos Virtuales con ese identificador</td>
	</tr>
	</table>
<? } ?>
<? include_once(dirname(__FILE__)."/bottom_simple.php"); ?>