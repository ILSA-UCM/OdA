<?
include_once(dirname(__FILE__)."/include.php");

include_once(dirname(__FILE__)."/top.php");

$visit->debuger->enable(false);
$dict=$visit->util->getRequest();
$npag = $dict["npag"];
$paginacion = $dict["paginacion"];
//Coger la paginacion por el Post primero y luego por el get
//$paginacion = $_POST["paginacion"];
//if($paginacion != "") $paginacion = $_GET["paginacion"];


$orden = $dict["orden"];
$orden_tipo = $dict["orden_tipo"];


//var_dump($dict);
if ($npag=="") { 
	$npag=1;
}

// alfredo 140707  $session->lsvirtual_object= $visit->util->getUrlQuery("",$visit->util->getQueryString());
$_SESSION['lsvirtual_object_busqueda']= $visit->util->getUrlQuery("",$visit->util->getQueryString());

$visit->options->paginacion=20;
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

if (trim($ordenar)!="") $virtualObject->_orderby = $ordenar;
$count =$visit->dbBuilder->getTablaBusquedaOVsCount($virtualObject,$dict); 

$inicio = ( $npag - 1 ) * $visit->options->paginacion + 1;
$filas="";
if ($count==0) {
	$inicio=0;
} else {
	$filas = $visit->dbBuilder->getTablaBusquedaOVsLimit($virtualObject, $inicio - 1 ,$visit->options->paginacion,$dict);
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
 <!-- <FORM METHOD="POST" ACTION="<?= $visit->util->getNombreArchivo( $visit->util->getScriptName() ) ?>" name="formlistado" style="display:inline;"> 	-->	
	<!-- <input type="hidden" name="paginacion" value="<?= $visit->options->paginacion ?>"> -->
	<FORM METHOD="POST" ACTION="ls_ov_busqueda.php" name="formlistado" style="display:inline;"> 		
	<? foreach($dict as $clave=>$valor){
			if($clave != "npag"){ ?>
			<input  type="hidden" name="<?=$clave?>" value="<?=$valor?>" />	
		<? }
	 } ?>
<? if ($filas!="") { ?>
		<TABLE width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
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
					
				</TD>
				
			</TR>
		</TABLE>

		<TABLE  border="0" width="100%" cellpadding="0" cellspacing="0" style="border:1px solid #CCCCCC;">
			<TR>
				<TD width="30%" height="24" align="left"  background="img/backoffice_fondo_cab_tabla.jpg">&nbsp;[<?= $inicio ?>-<?= $visit->util->muestrahastareg($visit->options->paginacion,$count,$npag) ?>] de <?= $count ?>&nbsp;
					<? $valoresPaginacion= split(",","20,40,60,100,200,400"); ?>
					<select name ="paginacion"  class="selectpeque" style="width:60px;" onChange="form.submit()" >
						<? for ($i=0;$i<count($valoresPaginacion);$i++) { ?>
							<option id="paginacion" value="<?= $valoresPaginacion[$i] ?>" <? if ($visit->options->paginacion==$valoresPaginacion[$i]) print "selected"; ?>><?= $valoresPaginacion[$i] ?>
						<? } ?>
					</select>
				</TD>
				
				<TD width="40%" nowrap background="img/backoffice_fondo_cab_tabla.jpg" align="center">
				<? $visit->util->imprimirPaginacion($visit->options->paginacion, $visit->options->maxPaginasSiguientes, $count, $npag, $urlName); ?>
				
				</TD>
				
			</TR>
		</TABLE>
</FORM>
<form name="form_generacion" action="do.php" method="POST"  style="display:inline;">

<TABLE class="lstabla" width="100%"  cellpadding="5" cellspacing="0">
	<!-- CAMPOS -->
	<TR>
		
		<TD class="lscabecera" >
			<!-- CAMPO -->
			<TABLE  border="0" cellpadding="0" cellspacing="0" width='250'>
				<TR>
						<TD nowrap width='100'
							<? if ($orden=="name") { ?>
								class="camposlsactivo"
							<? } else { ?>
								class="camposls"
							<? } ?>
							><b>Objeto Virtual&nbsp;</b></TD>
						<TD nowrap ><A HREF="<?= $visit->util->concatenaUrl($urlOrden,"orden=id&orden_tipo=DESC") ?>"><IMG SRC="
							<? if ($ordenar=="id DESC"){ 
								echo 'img/ls_flecha_arriba_sobre.gif';
							} else { 
								echo 'img/ls_flecha_arriba_normal.gif';
							} ?>
							" WIDTH="13" HEIGHT="6" BORDER="0" ALT=""></A><BR><A HREF="<?= $visit->util->concatenaUrl($urlOrden,"orden=id&orden_tipo=ASC") ?>"><IMG SRC="
							<? if ($ordenar=="id ASC"){ 
								echo 'img/ls_flecha_abajo_sobre.gif';
							} else { 
								echo 'img/ls_flecha_abajo_normal.gif';
							}
							?>" WIDTH="13" HEIGHT="6" BORDER="0" ALT=""></A></TD>
					</TR>
			</TABLE>				
			<!-- FIN CAMPO -->
		</TD>
		
		
		<td class="lscabecera" width='20'>
			&nbsp;
		</td>
	</tr>

	

	<?
		function fichaAccesible($ov){		
			global $visit;
			$cond1 = "S"==$ov->ispublic;
			$cond2 = $visit->util->perteneceLista($visit->options->usuario->rol,"A,B");
			$cond3 =	"C"==$visit->options->usuario->rol&&$visit->util->inArray($visit->dbBuilder->getPermisosFromUsuario($visit->options->usuario->id),$ov->id);
			
			return $cond1||$cond2||$cond3;
		}
	
		for ($j=0;$j<count($filas);$j++) { ?>
	<?
		$accesible = fichaAccesible($filas[$j] );
		if ( ($i % 2) != 0 ) {
			$lsregistros="lsregistrospar";
		} else {
			$lsregistros="lsregistrosimpar";
		}
	?>
		<tr>
			<TD class="<?= $lsregistros ?>">
			<table cellspacing='0'  cellpadding='3' width='100%' style="border-bottom:1px solid #466BB1; padding-right:50px; padding-left:50px;">
				<tr>
					<td align='left'>
						<? if  ($accesible) { ?>
							<a href="#" onclick='window.open("cm_view_virtual_object.php?idov=<?=  $filas[$j]->id ?>&seleccion=1","","width=800,height=600,scrollbars=yes"); return false;'>
						<? } ?>
								<b>ID</b>&nbsp;<?=$filas[$j]->id?>
						<? if  ($accesible) { ?>
							</a>
						<? } ?>
						&nbsp;-&nbsp;
						<? if("S"==$filas[$j]->ispublic){ ?>
							<font style="color:green;">
								Acceso P&uacute;blico
							</font>
						<? } else { ?>
							<font style="color:red;">
								S&oacute;lo usuarios registrados
							</font>
						<? } ?>
					</td>
					<?
						$icono= $visit->dbBuilder->getIconoFromOV($filas[$j]->id);
						$rutaicono = "";
						if($icono==NULL) {
							$rutaicono = "img/ico_ov.gif";
						} else if($icono->idov_refered!="") { //alfredo 140728
							$rutaicono = "../bo/download/".$icono->idov_refered."/".$icono->name;//alfredo 140728
						} else {
							$rutaicono = "../bo/download/".$filas[$j]->id."/".$icono->name;
						}
					?>
					<td  width="55" rowspan='3' align='center'>
						<? if  ($accesible) { ?>
							<a href="#" onclick='window.open("cm_view_virtual_object.php?idov=<?=  $filas[$j]->id ?>&seleccion=1","","width=1000,height=600,scrollbars=yes"); return false;'>
						<? } ?>	
							<div style="width:80px; overflow-y:hidden;">
								<img src="<?=$rutaicono?>" width="80px" border="0">
							</div>	
						<? if  ($accesible) { ?>
							</a>
						<? } ?>
					</td>
				</tr>
				<?
				$descripcion = $visit->dbBuilder->obtenerAtributoValorContrFromSeccionOV(112,$filas[$j]->id);
				$descripcion=$descripcion->value;

				$nombre = $visit->dbBuilder->obtenerAtributoValorTextFromSeccionOV(111,$filas[$j]->id);
				$nombre=$nombre->value;
				?>
				<tr>
					<td>
						<b>
						<? 
						$seccion=$visit->dbBuilder->getSectionDataId(111);
						echo $seccion->nombre;
						?>:
						</b>&nbsp;
						<? if(strlen($nombre)>255){
								print substr($nombre,0,255);
								print "...";
							} else {
								print $nombre;
							}
						?>
					</td>
				</tr>
				<tr>
					<td>
						<b><? 
						$seccion=$visit->dbBuilder->getSectionDataId(112);
						echo $seccion->nombre;
						?>:</b>&nbsp;
						<? if(strlen($descripcion)>255){
								print substr($descripcion,0,255);
								print "...";
							} else {
								print $descripcion;
							}
						?>	
					</td>	
				</tr>
			</table>
		</td>
		</tr>
	<? } ?>
</table>

<TABLE  width="100%" cellpadding="0" cellspacing="0" style="border:1px solid #CCCCCC;">
	<TR>
		<TD width="30%" height="24" align="left"  background="img/backoffice_fondo_cab_tabla.jpg">&nbsp;[<?= $inicio ?>-<?= $visit->util->muestrahastareg($visit->options->paginacion,$count,$npag) ?>] de <?= $count ?>&nbsp;
			<? $valoresPaginacion=split(",","20,40,60,100,200,400"); ?>
		</TD>
		
		<TD width="40%" nowrap background="img/backoffice_fondo_cab_tabla.jpg" align="center">
		
		<? $visit->util->imprimirPaginacion($visit->options->paginacion, $visit->options->maxPaginasSiguientes, $count, $npag, $urlName); ?>
		
		</TD>
		
	</TR>
</TABLE>
<? } else {?>
	<TABLE  border="0" cellpadding="20" cellspacing="0" width='100%' height="200" >
				<TR>
					<td valign='center' align='center'>
					<table cellspacing='0' cellpadding='0' border='1' width='100%' height="100%">
					<tr>
						<td align='center'><b>No se han encontrado resultados</b></td>
					<tr>
					<tr>
						<td align='center'><a href='buscador.php?menu=241&lang=es'>Refinar búsqueda<a></td>
					<tr>
					</table>
					</td>
				</TR>
	</table>
<? } ?>
<?
include_once(dirname(__FILE__)."/bottom.php");