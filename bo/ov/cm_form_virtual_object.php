<?

error_reporting (E_ALL ^ E_NOTICE);

/* 
 * Archivo generado din�micamente por Content Manager
*/
//select idseccion,value from controlled_data group by idseccion,value order by idseccion;
include_once(dirname(__FILE__)."/include.php");
include_once("../../FCKeditor/fckeditor.php") ;
$dict = $visit->util->getRequest();
//$visit->debuger->enable(true);
$visit->options->seccion = "OV";
$visit->options->subseccion = "ObjetosVirtuales";
//$session->lsvirtual_object  = "cm_ls_virtual_object.php";
//$session->lsvirtual_object = "javascript:window.history.back()";   140206  alfredo a�ade en linea sigiente   && !id==""
if ((!($visit->dbBuilder->tienePermisoUsuarioSobreOV("E",$id,$_SESSION["userid"])) && !$visit->options->usuario->esRolSuperadmin() && !$id=="")) {
	$visit->util->redirect("cm_ls_virtual_object.php");
}

//  140723  alfredo
$esSuperadmin=false;
$esSuperadmin=$_SESSION["UserRolUser"] == "A";
//echo(" >>>>>>>>> ");var_dump($esSuperadmin);

// $volver=$session->lsvirtual_object;  comentado por alfredo 13 03 27 y a�adida siguiente linea
//$volver="../ov/cm_ls_virtual_object.php";
// alfredo 140707  $volver=$session->lsvirtual_object;
$volver=$_SESSION['lsvirtual_object'];


if($dict["desde"]=="mantenimiento"){
	// $volver="../mantenimiento/".$session->lsrecursos; comentado por alfredo 13 03 27 y a�adida siguiente linea 
	 //$volver="../mantenimiento/cm_ls_recursos.php";
	 
	 // alfredo 140707   $volver="../mantenimiento/".$session->lsrecursos;
	 $volver="../mantenimiento/".$_SESSION['lsrecursos_mantenimiento'];
}


if ($id=="") {
	$fila = new ClsVirtualObject();
	} else {
	$fila = $visit->dbBuilder->getVirtualObjectId($id);
}
if (!$visit->options->tieneAcceso("form",$fila)) $visit->options->sinAcceso();
include_once(dirname(__FILE__)."/bo_top.php");


//Extension archivos permitidos
$extension = new ClsPreferenciasPresentacion();
$extension->atributo = "extension_archivos";
$extension = $visit->dbBuilder->getTablaFiltrada($extension);
if($extension[0] != "" )
{
	$extension = $extension[0];
	//Pasar variable a javaScript
	$extension_permitida_php = $extension->valor;
	echo "<script> extension_permitida_php = '$extension_permitida_php'; </script>";
}

?>
<script>
	var dato=0;
	function revisarForm() {
		return (dato!=1 );
	}

	function cambio(item) {
		dato=1;
		if("isprivate"==item.id){
			if(item.checked){
				document.getElementById("ispublic").checked = false;
				document.getElementById("ispublic").disabled = true;
			}else{
				document.getElementById("ispublic").disabled = false;
			}
		}
		return true;
	}

	function compruebaCampos() {
		var vall = window.document.formulario;
		var nombre;
		var msgError=false;
		var newLine = "\n";
		var strError="";
		var patron, campo, res;
		// var res; comentado por alfredo 13 03 27
		var inputs = document.getElementsByTagName("input");
		for(var i=0; i<inputs.length; i++){
			
			if(inputs[i].getAttribute('type')=='checkbox'){
				var ident = inputs[i].id+"_hidden";
				if (inputs[i]["checked"]){
					vall[ident].value="S";
				} else {
					vall[ident].value="N";
				}
			}
			if(inputs[i].getAttribute('type')=='text'){	
				if(inputs[i].getAttribute('class')=='inputtext_numeric'){
					 res = compruebaNumerico(inputs[i].value);
					if(res ==false){ return false;}
				}
				if(inputs[i].getAttribute('class')=='inputtext_date'){
					res = compruebaFecha(inputs[i].value);
					if(res== false) {return false;}
				}
			}
		}

		if (strError!="") {
			alert("Compruebe que ha rellenado los siguientes campos:\n"+strError);
			return false;
		} else if(document.formulario.nombre_archivo.value == "" && document.getElementById('propio').style.display == "block")
		{
			alert("Debe vincular un archivo con el nuevo recurso");
			return false;
		} else if(document.formulario.nombre_url.value == "" && document.getElementById('recurso_url').style.display == "block")
		{
			alert("Debe introducir una deirecci�n url v&aacute;lida");
			return false;
		}else if(document.formulario.ovtext.value == "" && document.getElementById('ov').style.display == "block")
		{
			alert("Debe seleccionar un objeto digital existente");
			return false;		
		}else if(document.formulario.nombre_recurso_existente.value == "" && document.getElementById('nombre_existente').style.display == "block")
		{
			alert("Debe seleccionar un nuevo recurso existente");
			return false;
		}else
			return true;	
		return true;	
	}

	function MostrarEstadoDeArchivo(nombreArchivo)
	{
	   var fso, s = "./download"+<?=id?>+"/"+nombreArchivo;
	   fso = new ActiveXObject("Scripting.FileSystemObject");
	   if (fso.FileExists(nombreArchivo))
	      s += " existe.";
	   else
	   s += " no existe.";
	   return(s);
	}
	
	function compruebaZip(){
		if (document.formulario.nombre_zip.value!=""){
			extension = document.formulario.nombre_zip.value;
			extension = extension.substring(extension.length-3, extension.length);
			//alert(extension);
			if (extension!="zip") {
				alert("El archivo a cargar no es v\u00e1lido. Compruebe que su extensi\u00f3n es .zip");
				return false;
			}
		}
		return true;
	}
	function compruebaZipHtml(){
		var extension = document.formulario.nombre_zipHtml.value;
		extension =  extension.substring(extension.lastIndexOf(".")+1);
		if (extension!="zip" && extension!="html") {
			alert("El archivo a cargar no es v\u00e1lido. Compruebe que su extensi\u00f3n es .zip o .html");
			return false;
		}

	}
	
	function habilitarText(id,valor){
		var vall = getElement(id);
		if (valor=="O")  
			vall.style.display = "block";
		 else 
			vall.style.display="none";
		
	}
	function habilitarFile(id){
		var vall = getElement(id);
		if (vall.style.display == "none")  
			vall.style.display = "block";
		 //else 
			//vall.style.display="block";
		
	}

	function deshabilitarFile(id){
		var vall = getElement(id);
		vall.style.display="none";
		
	}
	function deshabilitarText(id){
		var vall = getElement(id);
		vall.style.display="none";
		
	}
	function compruebaFecha(valor){
		if(valor != ""){
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
				return false;
				
			}
		}
		return true;		
	}
	
	function compruebaNumerico(valor){
		if(valor != ""){
			if (!esNumerico(valor)) {
				alert("El valor de este campo debe ser num\u00e9rico");
				return false;
			}
		}
		return true;
	}
	
	function toggleInputText(n){
		var pre = n.substring(0,2);
		var e1 = "it" + n.substring(2);
		var e2 = "fc" + n.substring(2);
		if(document.getElementById && document.getElementById(n)!=null)
			nodeState = document.getElementById(n).className;
		if(nodeState=='collapsed'){
			if("fc"==pre){
				document.getElementById(e1).className = "collapsed";
				document.getElementById(e2).className = "expanded";
			} else {
				document.getElementById(e2).className = "collapsed";
				document.getElementById(e1).className = "expanded";
			}
		} else {
			if("it"==pre){
				document.getElementById(e1).className = "collapsed";
				document.getElementById(e2).className = "expanded";
			} else {
				document.getElementById(e2).className = "collapsed";
				document.getElementById(e1).className = "expanded";
			}
		}
	}

	function cambiaTipoValor(value){
		document.getElementById("tipo").value= value;
	}
</script>
<script>
		window.onload = function()
		{
		  GetDivPosition();
		}
	</script>
	
	<? if ($id!="") {
		$idsrefered = $visit->dbBuilder->getFromReferedFromIdOV($id);
		$stringids = "";
		for ($i=0;$i<count($idsrefered);$i++) { 
				if($idsrefered[$i]->idov!="")
				$stringids .= $idsrefered[$i]->idov.", ";
				}
		$stringids = substr($stringids,0,-2);							
		}?>
		
		
<iframe id="frame_cargadatos" src="blank.jsp" name="frame_cargadatos" width="0" height="0" style="visibility:hidden"></iframe>
<TABLE  border="0" width="100%" cellpadding="0" cellspacing="0" style="border-top:1px solid #CCCCCC;border-left:1px solid #CCCCCC;border-right:1px solid #CCCCCC;">
	<TR>
		<TD height="24" align="left" background="img/backoffice_fondo_cab_tabla.jpg">
		&nbsp;<B>Datos del Objeto Digital <?=$id?></B><?if($stringids!="") echo(" <<  Referenciado desde el OD: ".$stringids."   ");?></TD>		
	</TR>
</TABLE>

<form accept-charset="utf-8" name="formulario" action="do.php" method="POST" ENCTYPE="multipart/form-data" onsubmit="return compruebaCampos();">
<input type="hidden" name="desde" value="<?=$dict["desde"]?>"/>
<TABLE  border="0" width="100%" cellpadding="0" cellspacing="10" style="border:1px solid #CCCCCC;">
			<TR>				
				<TD align="left" width="33%">
				<!-- comprobarExtension() alfredo 140914 -->
						<input type="image" onclick="
						if (compruebaCampos()) {
						   if(comprobarExtension()){
							if (compruebaZip()){
								SetDivPosition();
								document.formulario.submit();
							}
						  }
						}
						event.returnValue=false;
						return false;
						" SRC="img/boton_guardar.gif" WIDTH="84" HEIGHT="21" BORDER="0" ALT="">
				</TD>
				<TD align="center" width="34%">
				<A HREF="<?= $volver ?>" onclick="
						var ir=false;
						if (revisarForm()) ir=true;
						else if (confirm('<?=utf8_encode("Ha modificado datos. Seguro que desea volver?")?>')) ir=true;
						event.returnValue=ir;
						return ir;
						"><IMG SRC="img/boton_volver2.gif" WIDTH="84" HEIGHT="21" BORDER="0" ALT="Guardar"></A>
				</TD>				
				
				<!-- alfredo 140807 *****************************************************
				<TD align="right" width="33%">
					&nbsp;
					<? if ($id!="") { ?>
						<? 
							$idsrefered = $visit->dbBuilder->getFromReferedFromIdOV($id);
							$stringids = "";
							for ($i=0;$i<count($idsrefered);$i++) { 
								if($idsrefered[$i]->idov!=""){
									$stringids .= $idsrefered[$i]->idov." ,";
								}
							}
							$stringids = substr($stringids,0,-2);							
							
							//echo(" >>obj1>> ");var_dump($stringids);
						?>
						<A id="eliminar_recurso" HREF="#" onclick="
							if (confirm('<?=utf8_encode("Seguro que desea eliminar este objeto?")?>')) {
							<? if($stringids!=""){ ?>
									if (confirm('El/los objeto/s <?=$stringids?> est\u00e1/n utilizando como recurso ajeno el objeto y/o alg\u00fan recurso propio del objeto que se dispone a borrar.\n <?=utf8_encode("�CONFIRMA la eliminaci�n del objeto?")?>')) 
								 		{
								<? } ?>
										window.location.href='do.php?op=eliminar_virtual_object&id=<?= $fila->id ?>';
							<? //if($stringids!=""){ ?>
								}
							<? //} ?>
							}
							event.returnValue=false;
							return false;
							"><IMG SRC="img/boton_eliminar.gif" WIDTH="84" HEIGHT="21" BORDER="0" ALT=""></A>
					<? } ?>
				</TD>
				*****************************************************************************  -->
				<?if($dict["desde"]=="mantenimiento"){$procedencia="from_mantenimiento";}else{$procedencia="fromlistado";}; ?>
				<TD align="right" width="33%">
					&nbsp;
					<? if ($id!="") { ?>
						<? 
							$idsrefered = $visit->dbBuilder->getFromReferedFromIdOV($id);
							$stringids = "";
							for ($i=0;$i<count($idsrefered);$i++) { 
								if($idsrefered[$i]->idov!="")
									$stringids .= $idsrefered[$i]->idov." ,";
							}
							$stringids = substr($stringids,0,-2);							
							
							//echo(" >>obj2>> ");var_dump($stringids);
						?>
						<A id="eliminar_vo" HREF="#" onclick="
							if (confirm('<?=utf8_encode("Seguro que desea eliminar este objeto?")?>')) {
							<? if($stringids!=""){ ?>
								if (confirm('El/los objeto/s <?=$stringids?> est\u00e1/n utilizando como recurso ajeno este objeto y/o alg\u00fan recurso propio del objeto que se dispone a borrar.\n <?=utf8_encode("�CONFIRMA la eliminaci�n del objeto?")?>')) {
							<? } ?>
								window.location.href='do.php?op=eliminar_virtual_object&id=<?= $fila->id ?>&<?=$procedencia?>=S';	
							<? if($stringids!=""){ ?>
								}
							<? } ?>
							}
							event.returnValue=false;
							return false;
							"><IMG SRC="img/boton_eliminar.gif" WIDTH="84" HEIGHT="21" BORDER="0" ALT=""></A>
					<? } ?>
				</TD>
				
			</TR>
		</TABLE>
	<input type="hidden" name="op" value="modificar_virtual_object">
	<input type="hidden" name="id" value="<?= $fila->id ?>">
	 
<table width="100%" border="0" cellpadding="3" cellspacing="1"  style="border:1px solid #CCCCCC;">
	<tr>
		<td class="popuptitcampo">
			<b>P&uacute;blico:</b>
		</td>
		<td class="popupcampo">
			<input type="checkbox" id="ispublic" name="ispublic" value="S" <? if ($fila->isprivate=="S") print "disabled";  ?> <? if ($fila->ispublic=="S") print "checked"; ?>>
			<input type="hidden" id="ispublic_hidden" name="ispublic_hidden" value="<?=$fila->ispublic?>">
		</td>
	</tr>	
<?if($visit->util->esSuperAdmin()){?>
	<tr>
		<td class="popuptitcampo">
			<b>Privado:</b>
		</td>
		<td class="popupcampo">
			<input type="checkbox" id="isprivate" name="isprivate" value="S" <? if ($fila->isprivate=="S") print "checked"; ?> onChange="cambio(this)">
			<input type="hidden" id="isprivate_hidden" name="isprivate_hidden" value="<?=$fila->isprivate?>">
		</td>
	</tr>
<?}?>
	<!-- <tr>
		<td class="popuptitcampo">
			Nombre:
		</td>
		<td  class="popupcampo">
			<input name="name" type="text" size="40" maxlength="255" value="<?= $visit->util->encapsulaInput( $fila->name) ?>" onchange="cambio(this)">
		</td>
	</tr> -->
	<?
	$sectionData = new ClsSectionData();
	$filas = $visit->dbBuilder->getTablaFiltrada($sectionData);
	$count = count($filas);
	if ($count==0) $inicio=0;

	$valores = &$filas;
	$dictFilas = $visit->util->getDict( $valores );
	$sDictFilas = array();
	while (list ($clave, $valor) = each ($dictFilas)) { 
		$nombre ="";
		$caminoItems = $visit->util->obtenerCaminoCategoria($dictFilas, "", $valor->id);
		for ($i=0;$i<count($caminoItems);$i++) $nombre .= " >> ". $visit->util->numDigitos($dictFilas[$caminoItems[$i]]->orden,5) . "_" . $dictFilas[$caminoItems[$i]]->nombre;
		$sDictFilas[$nombre] = $valor;
	}
	
	ksort( $sDictFilas ); 
	$filas = &$sDictFilas;

	
	$idRecurso=$visit->dbBuilder->getIdRecurso();
	$atribsNum=$visit->dbBuilder->obtenerAtributosNumFromOV($id);
	$dictAtribsNum= $visit->util->getDictIdSeccion( $atribsNum );
	$atribsDate = $visit->dbBuilder->obtenerAtributosDateFromOV($id);
	$dictAtribsDate = $visit->util->getDictIdSeccion( $atribsDate );
	$atribsCont=$visit->dbBuilder->obtenerAtributosContFromOV($id);
	$dictAtribsCont= $visit->util->getDictIdSeccion( $atribsCont );
	$atribsText=$visit->dbBuilder->obtenerAtributosTextFromOV($id);
	$dictAtribsText= $visit->util->getDictIdSeccion( $atribsText );	
	$dictAtribsTextRec= $visit->util->getDictIdSeccionIdRecurso( $atribsText );
	$dictAtribsNumRec= $visit->util->getDictIdSeccionIdRecurso( $atribsNum );
	$dictAtribsContRec= $visit->util->getDictIdSeccionIdRecurso( $atribsCont );
	$dictAtribsDateRec= $visit->util->getDictIdSeccionIdRecurso( $atribsDate );
	//$todosAtribsCont = $visit->dbBuilder->obtenerTodosAtribsContr();
	while (list ($clave, $sectionData) = each ($filas)) { ?>		
		<?
			if($sectionData->visible != "S" && !$visit->util->esSuperAdmin()){ continue;}
			$i++;
			if ( ($i % 2) != 0 ) {
				$lsregistros="listadopar";
			} else {
				$lsregistros="listadoimpar";
			}
			$caminoItemsStr = $visit->util->obtenerCaminoCategoriaStr($dictFilas, "", $sectionData->id);
			$caminoItems =  substr( $caminoItemsStr, 1, strlen($caminoItemsStr)-2);
			$caminoItems =  preg_split(";",$caminoItems);
			$ancho=18*(count($caminoItems)-2);
			
		?>
		<?  
			//echo $idRecurso->id."...".$caminoItemsStr."...".$sectionData->nombre."<br>"; 
			$valorAtrib="";

		if (!$visit->util->isInStr($caminoItemsStr,$idRecurso->id) ) { ?>
			<tr>
			
			<td class="popuptitcampo" valign="top">
					<IMG SRC="../img/pc.gif" WIDTH="<?= $ancho ?>" HEIGHT="1" BORDER="0" ALT="">
					<? if ($sectionData->nombre!= "" && $sectionData->idpadre>0 && $esSuperadmin) 
					 // alfredo 140723 if ($sectionData->nombre!= "" && $sectionData->extensible=="S" && $sectionData->idpadre>0) 
					 {?>
					<a href='#' onclick='window.open("popup_form_section_data.php?idpadre=<?= $sectionData->id?>","","width=680,height=500,scrollbars=yes");return false' > 
					<img src="img/ico_mas.gif" width="9" height="9" border="0" alt="Nueva Seccion">
					  </a> <? } ?>
				<? if ($sectionData->idpadre==0) { ?> <h2><b>-&nbsp;<?= $sectionData->nombre ?></b></h2><? } else { ?><b><?= $sectionData->nombre ?></b><?}?>
			</td>
			<? 
					if ($sectionData->tipo_valores=="T") { 
						if ($id!=0) {
								$atrib= $dictAtribsText[$sectionData->id];
								if($atrib!=null) $valorAtrib=$atrib->value;
							
						} 
						if ($valorAtrib=="") {
							///$valorAtrib="~Sin asignar";
						}
					
					?>
					<td class="popupcampo">
						<div id="it<?=$sectionData->id?>" class="expanded"> 
							<textarea id="seccion_<?= $sectionData->id ?>" name="seccion_<?= $sectionData->id ?>" rows="7" cols="30" onchange="cambio(this)" class="textarea"><?=$valorAtrib?></textarea>
						</div>
					</td>
					<? } else if ($sectionData->tipo_valores=="N" ) { 
						if ($id!=0) {
								$atrib= $dictAtribsNum[$sectionData->id];
								if($atrib!=null) $valorAtrib=$atrib->value;	
						}
						
						$valuenum = str_replace(".", ",", $valorAtrib);
						//$valuenum = str_replace(",00","",$valuenum);
					?>
					<td  class="popupcampo">
						<input name="seccion_<?= $sectionData->id ?>" type="text" size="40" maxlength="255" value="<?= $valuenum ?>"
						 onchange="cambio(this);compruebaNumerico(this.value)" class="inputtext_numeric"></input>
					</td>
					<? } else if ($sectionData->tipo_valores=="F" ) { 
						if ($id!=0) {
								$atrib= $dictAtribsDate[$sectionData->id];
								if($atrib!=null) $valorAtrib=$atrib->value;	
						} 
						if ($valorAtrib=="") {
							///$valorAtrib="~Sin asignar";
						}
					?>
					<td  class="popupcampo">
						<?
							$valuenum = $visit->util->bbdd2date($valorAtrib);
							$valuenum = str_replace(".", ",", $valuenum);
							$valuenum = str_replace(",00","",$valuenum);
						?>
						<input name="seccion_<?= $sectionData->id ?>" type="text" size="40" maxlength="255" value="<?= $valuenum ?>"
						 onchange="cambio(this);compruebaFecha(this.value)" class="inputtext_date">
						<a href="javascript:show_calendar('document.formulario.seccion_<?= $sectionData->id ?>', document.formulario.seccion_<?= $sectionData->id ?>.value);"><img src="../img/cal.gif" width="16" height="16" border="0" alt="Pinche aqu&iacute; para introducir una fecha"></a>
					</td>
					<? } else if ($sectionData->tipo_valores=="C"){ ?>
						<? if ($id!=0) {
							$atrib= $dictAtribsCont[$sectionData->id]; 
							if($atrib!=null) $valorAtrib=$atrib->value;
						}?>
							<td  class="popupcampo">
								<p>
								<? $valores = $visit->dbBuilder->getAtributosContrFromIdSeccion($sectionData->id); 
								?>
								
								</p>
								<select name="seccion_<?= $sectionData->id ?>" class="selectmedio" onchange="cambio(this); habilitarText('annadir_'+<?= $sectionData->id ?>, this.value); " >
									<option value="&SINVALOR&" <? if ($valor->value==$valorAtrib ) print "selected" ?>>-- <?= $sectionData->nombre  ?> --
									<? 
									//Ordenacion del array por los valores
									$cadena = array();
									while (list ($clave2, $valor) = each ($valores)) {
										$cadena[]= $valor->value;
									}
									if(count($cadena) >0){
										usort($cadena,"strnatcasecmp");
									}
									$haySA = false; 
									while (list ($clave2, $valor) = each ($cadena)) { ?>
										<? if("~Sin asignar"==$valor) $haySA = true; ?>
										<? if(""!=$valor){ ?>
											<option value="<?= $valor ?>" <? if ($valor==$valorAtrib ) print "selected" ?> >	<?= $valor  ?>
										<? } ?>
									<? } ?>
									<? /*
									$haySA = false; 
									while (list ($clave2, $valor) = each ($valores)) { ?>
										<? if("~Sin asignar"==$valor->value) $haySA = true; ?>
										<? if(""!=$valor->value){ ?>
											<option value="<?= $valor->value ?>" <? if ($valor->value==$valorAtrib ) print "selected" ?> >	<?= $valor->value  ?>
										<? } ?>
									<? } ?>
									*/ ?>
									<? if(!$haySA){ ?>
										<option value="~Sin asignar">~Sin asignar
									<? } ?>
									<option value="O">Otro 
									
								</select>
								<div id='annadir_<?= $sectionData->id ?>' style="display:none" >
								<table cellspacing='0' cellpadding='0' >
									<tr>
									<td><input name="text_<?= $sectionData->id ?>" type="text" size="20" maxlength="255" value="" onchange="cambio(this);">&nbsp;&nbsp;
									</td>
									</tr>
								</table>
								</div>
							</td>
						<? } ?>
			<? } else {
					$seccionesRecursos = $seccionesRecursos.",".$sectionData->id;
				}  ?>
		<? } //while secciones?>
		
			 </tr>
			 <? 
			
			$seccionesRecursos=  preg_split(",",$seccionesRecursos);?>
			<tr>
			<td class="popuptitcampo"></br><span><h3><b>- Modelo de Datos de los Recursos</b></h3></span>
			<IMG SRC="../img/pc.gif" WIDTH="<?= $ancho ?>" HEIGHT="1" BORDER="0" ALT=""><? if ($sectionData->idpadre==0) { ?> <b><?= $sectionData->nombre ?></b><? } else { ?><?= $sectionData->nombre ?><?}?>
			</td>
			 <tr>
				<td colspan='2' >
				<?	
				 if ($id!="") {
					$recursos = $visit->dbBuilder->getRecursosFromOV($id);
					$listaValores="";
					$icono = $visit->dbBuilder->getIconoFromOV($id);
					$icononombre = "";
					if($icono!=NULL) $icononombre = $icono->name; 
					while (list ($clave, $recurso) = each ($recursos)) { ?>
						<?$lista_recursos[]=$recurso->name?>
					<table cellspacing='0'  cellpadding='1'>
							  <tr>
									<td height='20' style="padding-top:30px;font-size:1em;">
										<i><?= $recurso->getValorType() ?></i>
									</td>
							  </tr>
							   <tr>
									<td width='150'><IMG SRC="../img/pc.gif" WIDTH="20" HEIGHT="1" BORDER="0" ALT="">
										<? if("OV"==$recurso->type){ ?>
											<b>ID del Objeto:</b>
										<? } else {?>
											<b>Archivo:</b>
										<? } ?>
									</td>
									
									<? if ($recurso->id!="") {
											$idsrefered = $visit->dbBuilder->getFromReferedFromIdOV($recurso->id);
											$stringids = "";
											for ($i=0;$i<count($idsrefered);$i++) { 
												if($idsrefered[$i]->idov!="")
														$stringids .= $idsrefered[$i]->idov.", ";
														}
												$stringids = substr($stringids,0,-2);
											}
											?>
									
									<td width='225' class="popupcampo">
										<? if("OV"==$recurso->type){ ?>
											<b><?= $recurso->idov_refered ?></b>
										<? } else { ?>
											<b><span class="recurso_nombre"><?= $recurso->name ?></span> &nbsp;</b>
											<? if($stringids!="") echo(" << Recurso referenciado desde el OD: ".$stringids."");?>
										<? } ?>
									</td>
									<td class="popupcampo"  align='center'>
										
									</td>
									<!--  alfredo 140805  **********************************************
									<TD >&nbsp;
										<A HREF="#" onclick="
											if (confirm('<?=utf8_encode("Seguro que desea eliminar este recurso?")?>')) {
											<? if($stringids!=""){ ?>
													if (confirm('Este recurso est\u00e1 siendo referenciado desde el/los objeto/s <?=$stringids?>.\n <?=utf8_encode("�Confirma la eliminaci�n del recurso?")?>')) {
											<? } ?>
													window.location.href='do.php?op=eliminar_resources&id=<?= $recurso->id ?>&idov=<?=$id?>&fromlistado=S';
											<? if($stringids!=""){ ?>
													} 
											<? } ?>
											}
											event.returnValue=false;
											return false;
										" >
											<? //echo(">>r ".$recurso->id." >>ovr ".$recurso->idov_refered." >>rr ".$recurso->idresource_refered." << "); ?>
											Eliminar
										</A>
									</td>
									*****************************************************  -->
									<?if($dict["desde"]=="mantenimiento"){$procedencia="from_mantenimiento";}else{$procedencia="fromlistado";}; ?>
									<TD >&nbsp;
										<A HREF="#" onclick="
											if (confirm('<?=utf8_encode("Seguro que desea eliminar este recurso?")?>')) {
												<? if($stringids!=""){ ?>
													if (confirm('Este recurso est\u00e1 siendo referenciado desde el/los objeto/s <?=$stringids?>.\n<?=utf8_encode("�Confirma la eliminaci�n del recurso?")?>')) {
													window.location.href='do.php?op=eliminar_resources&id=<?= $recurso->id ?>&idov=<?=$id?>&<?=$procedencia?>=S';
													}
												<?} else {?>
												window.location.href='do.php?op=eliminar_resources&id=<?= $recurso->id ?>&idov=<?=$id?>&<?=$procedencia?>=S';
												<?}?>
											}
											event.returnValue=false;
											return false;
										" > Eliminar
										</A>
									</td>
									
									<td>
										<? if($visit->util->esImagen($recurso->name) && $recurso->type!='U'){ ?>
										&nbsp;<a <?if($icononombre!=$recurso->name){?>style="color:red" <?}else{?>style="color:green"<?}?> href="#" onclick="SetDivPosition(); window.location.href='do.php?op=modificar_icono&idrec=<?= $recurso->id ?>&idov=<?=$id?>'; return false;">
											<?if($icononombre!=$recurso->name){?>
												Icono
												<img src="../img/pc.gif" width="100" height="0" border="0">
											<? } else { ?>
												Icono actual&nbsp;&nbsp;
											<? } ?>
										</a>
										<? } else { ?>
												<img src="../img/pc.gif" width="64	" height="0" border="0">
										<? } ?>
										Visible:&nbsp;<input type="checkbox" id="visible_<?=$recurso->id?>" <?if("S"==$recurso->visible){?> checked<?}?> >
										<input type="hidden" id="visible_<?=$recurso->id?>_hidden" name="visible_<?=$recurso->id?>_hidden">
										<select id="ordinal_<?=$recurso->id?>" name="ordinal_<?=$recurso->id?>">
											<? for($i=1;$i<=count($recursos);$i++){ ?>
												<option value="<?=$i?>" <?if($i==$recurso->ordinal){?> selected="selected"<?}?>>
													<?=$i?>
												</option>
											<?}?>
										</select>
									</td>
								</tr>
								<? if("F"==$recurso->type){ ?>
								<tr>
									<td width='40'><IMG SRC="../img/pc.gif" WIDTH="20" HEIGHT="1" BORDER="0" ALT="">
									</td>
									<td>
										Pertenece al Objeto Digital <?=$recurso->idov_refered // alfredo 140727 ?>
									</td>
								</tr>
								<? } ?>
								<?
								/*if ($recurso->type=="F") $rec= $visit->dbBuilder->getRecursosFromOVNombre($recurso->idresource_refered,$recurso->name);
								else $rec=$recurso;*/
								$rec=$recurso;
								
									//$secRec= $visit->dbBuilder->getSeccionesFromIdPadre($idRecurso->id);
									
									$k=0;
									$valores=array();
									reset($seccionesRecursos);
									///if("Objeto Virtual"==$recurso->getValorType()) $seccionesRecursos = array();
									while (list ($clave, $idsec) = each ($seccionesRecursos)) { 
										$k++;
										if ($idsec!=$idRecurso->id ) {
										$sec = $visit->dbBuilder->getSectionDataId($idsec);
										
										
										if ($sec->nombre!="" && $sec->nombre!="Nombre") { ?>	
										<?
											$caminoItemsStrRec = $visit->util->obtenerCaminoCategoriaStr($dictFilas, "", $sec->id);
											$caminoItemsRec =  substr( $caminoItemsStrRec, 1, strlen($caminoItemsStrRec)-2);
											$caminoItemsRec =  preg_split(";",$caminoItemsRec);
											$anchoRec=18*(count($caminoItemsRec)-2);
										?>

										<tr>
											<td class="popuptitcampo">
											<IMG SRC="../img/pc.gif" WIDTH="<?= $anchoRec ?>" HEIGHT="1" BORDER="0" ALT="">
												<b><?= $sec->nombre ?>:</b>&nbsp;
											</td>
											<? if ($sec->tipo_valores=="T") { ?>
											<?	
												$valorAtrib="";
												if ($id!=0) {
													$obj= $dictAtribsTextRec[$sec->id."_".$rec->id]; 
													if($obj!=null) $valorAtrib=$obj->value;
										
												} ?>
												<td  class="popupcampo" colspan='4'>
													<textarea id="seccion_<?=$sec->id?>_recurso_<?=$rec->id ?>" name="seccion_<?=$sec->id?>_recurso_<?=$rec->id ?>" rows="7" cols="94" onchange="cambio(this)" class="textarea_recurso"><?=$valorAtrib?></textarea>
												</td>
											<? } else if($sec->tipo_valores=="F") {?>		
											<?	
												$valorAtrib="";
												if ($id!=0) {
													$obj= $dictAtribsDateRec[$sec->id."_".$rec->id]; 
													if($obj!=null) $valorAtrib=$visit->util->bbdd2date($obj->value);
												} ?>
												<td  class="popupcampo">
													<input name="seccion_<?=$sec->id?>_recurso_<?=$rec->id ?>" class="inputtext_date" type="text" size="20" maxlength="255" value="<?= $valorAtrib ?>"  onchange="cambio(this);compruebaFecha(this.value)">
													<a href="javascript:show_calendar('document.formulario.seccion_<?=$sec->id?>_recurso_<?=$rec->id ?>', document.formulario.seccion_<?=$sec->id?>_recurso_<?=$rec->id ?>.value);"><img src="../img/cal.gif" width="16" height="16" border="0" alt="Pinche aqu&iacute; para introducir una fecha"></a>

												</td>
													
											<? } else if ($sec->tipo_valores=="C"){ ?>
												<? 
												$valorAtribC ="";	
												if ($id!=0) {
													$objC= $dictAtribsContRec[$sec->id."_".$rec->id]; 
													if($objC!=null) $valorAtribC=$objC->value;
													if($valorAtribC=="") $valorAtribC = null;
													
												}?>
												<td  class="popupcampo">
														<select name="seccion_<?= $sec->id ?>_recurso_<?=$rec->id?>" class="selectmedio" onchange="cambio(this); habilitarText('annadir_<?= $sec->id ?>_recurso_<?=$rec->id?>', this.value); " >
																	
																	<option value="&SINVALOR&" <? if($valor==null){ ?> selected<? } ?>>-- <?= $sec->nombre  ?> --
																	<? 
																	//if (!$visit->util->perteneceLista( $sec->id, $listaValores)) {
																	//	$listaValores.=$sec->id.",";
																	// alfredo 140926	$valores= $visit->dbBuilder->getAtributosContrFromIdSeccionRec($sec->id);
																		$valores= $visit->dbBuilder->getAtributosContrFromIdSeccion($sec->id);
																
																	//}
																	//reset($valores);
																	//$vals=array();
																	//$vals=$valores[$k];
																	//Ordenacion del array por los valores
																		$cadena = array();
																		while (list ($clave2, $valor) = each ($valores)) {
																			$cadena[]= $valor->value;
																		}
																		if(count($cadena) >0){
																			usort($cadena,"strnatcasecmp");
																		}
																		$haySA = false; 
																		while (list ($clave2, $valor) = each ($cadena)) { ?>
																			<? if("~Sin asignar"==$valor) $haySA = true; ?>
																			<? if(""!=$valor){ ?>
																				<option value="<?= $valor ?>" <? if ($valor==$valorAtribC ) print "selected" ?> >	<?= $valor  ?>
																			<? } ?>
																		<? } ?>
																	<option value="O">Otro
														</select>
														<div id='annadir_<?= $sec->id ?>_recurso_<?=$rec->id?>' style="display:none" >
														<table cellspacing='0' cellpadding='0' >
															<tr>
															<td><input name="text_<?= $sec->id ?>_recurso_<?=$rec->id?>" type="text" size="20" maxlength="255" value="" onchange="cambio(this);">&nbsp;&nbsp;
															</td>
															</tr>
														</table>
														</div>
												</td>
								
											<? } else if  ($sec->tipo_valores=="N"){ ?>
												<?	
												$valorAtribN ="";
												if ($id!=0) {
													$objN= $dictAtribsNumRec[$sec->id."_".$rec->id];
													if($objN!=null) $valorAtribN=$objN->value;
													
												} ?>
												<td  class="popupcampo">
												<input name="seccion_<?= $sec->id ?>_recurso_<?=$rec->id?>" class="inputetext_numeric" type="text" size="20" maxlength="255" value="<?= $valorAtribN ?>"
												 onchange="cambio(this);compruebaNumerico(this.value);">
												</td>
											<? } ?>
										</tr>
										<? } ?>
									<? } // if (sec->nombre!=""0) ?>
									<? } // if (idsec!=idRecurso) ?>
								  <!-- <tr>
									<td width='36'>&nbsp;</td>
									<td class="popuptitcampo">Ordinal&nbsp;</td>
									<td class="popupcampo">
										<input name="ordinal_recurso_<?= $recurso->id ?>" type="text" size="20" maxlength="255" value="<?= $recurso->ordinal ?>" onchange="cambio(this);" >
									</td>
								  </tr>
								  <tr>
									<td width='36'>&nbsp;</td>
									<td class="popuptitcampo">Visible&nbsp;</td>
									<td  class="popupcampo">
									<input type="checkbox" name="visible_recurso_<?= $recurso->id ?>" value="S" <? if ($recurso->visible=="S") print "checked"; ?> onchange="cambio(this)">
									</td>

									
								  </tr> -->
								 
							</table>
					<? } ?>
				<? } ?>
				</td>
			 </tr>
			 <tr>
				<td class="popupcampo" colspan='2'>
						<table cellspacing='0' cellpadding='2'>
							<tr>
								<td colspan="12" align="center" style="color:green; font-size:12px;padding-bottom:15px;">
									<span id="mensaje_carga" style="display:none;">
										Una vez seleccionado el archivo .zip, pulse en Guardar para terminar de cargar el zip con todos los recursos.
									</span>
									<span id="mensaje_carga_html" style="display:none;">
										Una vez seleccionado el archivo .zip, pulse en Guardar para terminar de cargar el zip con el html y la carpeta de archivos.
									</span>
								</td>
							</tr>
							<tr>
								<td width='36'>&nbsp;</td>
								<td nowrap>
									<a href='#' onclick='habilitarText("mensaje_carga","N");deshabilitarText("mensaje_carga");deshabilitarText("mensaje_carga_html");deshabilitarFile("campos");deshabilitarFile("ov");deshabilitarText("recurso_url");deshabilitarFile("zip");deshabilitarFile("nombre_existente");deshabilitarFile("zipHtml");habilitarFile("propio");cambiaTipoValor("P");return false'>Nuevo recurso propio</a>
								</td>
								<td>
									&nbsp;|&nbsp;
								</td>								
								<td nowrap>
									<a href='#' onclick='habilitarText("mensaje_carga","N");deshabilitarText("mensaje_carga");deshabilitarText("mensaje_carga_html");deshabilitarFile("campos");deshabilitarFile("ov");deshabilitarFile("zip");deshabilitarFile("propio");deshabilitarFile("nombre_existente");deshabilitarFile("zipHtml");habilitarFile("recurso_url");cambiaTipoValor("U");return false'>Nuevo recurso url</a>
								</td>
								<td>
									&nbsp;|&nbsp;
								</td>								
								<td nowrap>
			   <!-- alfredo 140927  <a href='#' onclick='habilitarText("mensaje_carga","N");deshabilitarText("mensaje_carga");deshabilitarText("mensaje_carga_html");deshabilitarFile("propio");deshabilitarText("recurso_url");deshabilitarFile("zip");deshabilitarFile("zipHtml");deshabilitarFile("nombre_existente");deshabilitarFile("campos");habilitarFile("ov");habilitarFile("campos");window.open("ls_virtual_objects_popup.php?idov=<?= $id?>&recOV=S","","width=680,height=800,scrollbars=yes"); cambiaTipoValor("OV");return false'>Objeto Digital existente </a> -->
									<a href='#' onclick='habilitarText("mensaje_carga","N");deshabilitarText("mensaje_carga");deshabilitarText("mensaje_carga_html");deshabilitarFile("propio");deshabilitarText("recurso_url");deshabilitarFile("zip");deshabilitarFile("zipHtml");deshabilitarFile("nombre_existente");deshabilitarFile("campos");habilitarFile("ov");window.open("ls_virtual_objects_popup.php?idov=<?= $id?>&recOV=S","","width=680,height=800,scrollbars=yes"); cambiaTipoValor("OV");return false'>Objeto Digital existente </a>
								</td>
								<td>
									&nbsp;|&nbsp;
								</td>								
								<td nowrap> 
									<a href='#' onclick='habilitarText("mensaje_carga","N");deshabilitarText("mensaje_carga");deshabilitarText("mensaje_carga_html");deshabilitarFile("propio");deshabilitarText("recurso_url");deshabilitarFile("zip");deshabilitarFile("zipHtml");deshabilitarFile("ov");deshabilitarFile("campos");habilitarFile("nombre_existente");window.open("ls_virtual_objects_popup.php?idov=<?= $id?>&recOV=N","","width=680,height=800,scrollbars=yes");cambiaTipoValor("F");return false;'>Nuevo recurso existente</a>
								</td>
								<td>
									&nbsp;|&nbsp;
								</td>								
								<td nowrap> 
									<a href='#' onclick='deshabilitarFile("ov");deshabilitarFile("propio");deshabilitarFile("campos");deshabilitarFile("nombre_existente");habilitarFile("zip");deshabilitarText("recurso_url");deshabilitarFile("zipHtml");habilitarText("mensaje_carga","O");deshabilitarText("mensaje_carga_html");cambiaTipoValor("Z");return false;'>Cargar zip</a>
								</td>
								<td>
									&nbsp;|&nbsp;
								</td>								
								<td nowrap> 
									<a href='#' onclick='deshabilitarFile("ov");deshabilitarFile("propio");deshabilitarFile("campos");deshabilitarFile("nombre_existente");deshabilitarFile("zip");deshabilitarText("recurso_url");habilitarFile("zipHtml");habilitarText("mensaje_carga_html","O");deshabilitarText("mensaje_carga");cambiaTipoValor("H");return false;'>Cargar zip html</a>
								</td>
							</tr>
							<tr>
							<td height='20'>&nbsp;</td>
							</tr>
							
						</table>
					<input id='tipo' name='tipo' type='hidden' value=''>
					 <input id='idov_refered' name='idov_refered' type='hidden' value=''> 
					<input id='id_recurso_ref' name='id_recurso_ref' type='hidden' value=''>
					<input id='idresource_refered' name='idresource_refered' type='hidden' value=''>
					<div id='nombre_existente' name='nombre_existente' style="display:none" >
						<table cellspacing='0'  cellpadding='0' width='80%' align='center'>
						  <tr>
							<td valign="top" align="right" width='195'>
								Recurso Existente
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							</td>
							<td>
								<input id="nombre_recurso_existente" name="nombre_recurso_existente" type="text" size="40" maxlength="255" onchange="cambio(this);" readonly>
								<br/><br/>
							</td>
						  </tr>
						</table>
					</div>			
					<div id='propio' style="display:none" >
					 <? if($extension_permitida_php =="" ){?><div style= "margin:0px 0px 5px 100px;"><b><?=utf8_encode("No hay ninguna extensi�n definida. Acuda a preferencias para definir extensiones.")?></b> </div> 
					 <? } else{ ?><div style= "margin:0px 0px 5px 210px;"><?="Extensiones permitidas: ".$extension_permitida_php; ?></div><? }?>
					 	
						<table cellspacing='0'  cellpadding='0' width='80%' align='center'>
						
						  <tr>
							<td width='153'>&nbsp;</td>
							<td>
							<input id="nombre_archivo" name="nombre_archivo" type="file" size="40" maxlength="255" onchange="comprobarExtension();cambio(this);<?php // comprobarRecurso();?>"><br/><br/>
							</td>
						  </tr>
						  <tr>
						  	<td><span id="error_archivo_recurso"></span></td>
						  </tr>
						</table>
					</div>
					<div id='recurso_url' style="display:none" >
					 <div style= "margin:0px 0px 5px 100px;"> Introduce la direcci&oacute;n url: </div>					 	
						<table cellspacing='0'  cellpadding='0' width='80%' align='center'>
						
						  <tr>
							<td width='153'>&nbsp;</td>
							<td>
								<!-- type="url" es HTML5--> 
								<input id="nombre_url" name="nombre_url" type="url" size="40" maxlength="255" onchange="cambio(this);comprobarUrl();"><br/><br/>
							</td>
						  </tr>
						  <tr>
						  	<td><span id="error_url_recurso"></span></td>
						  </tr>
						</table>
					</div>
					<div id='ov' style="display:none" >
						<table cellspacing='0' border="0" cellpadding='0' width='80%' align='center'>
						  <tr>
							<td align="right" width='195'>
								<b>ID del objeto</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							</td>
							<td>
								<input id="ovtext" name="ovtext" type="text" size="20" maxlength="255" onchange="cambio(this);">
								<br/><br/>
							</td>
						  </tr>
						</table>
					</div>
					<div id='zip'  style="display:none" >
						<table cellspacing='0'  cellpadding='0' width='80%' align='center'>
						  <tr>
							<td width='153'>&nbsp;</td>
							<td>
								<input id="nombre_zip" name="nombre_zip" type="file" size="40" maxlength="255" onchange="compruebaZip();cambio(this);">
							</td>
						  </tr>
						</table>
					</div>					
					<div id='zipHtml'  style="display:none" >
						<table cellspacing='0'  cellpadding='0' width='80%' align='center'>
						  <tr>
							<td width='153'>&nbsp;</td>
							<td>
								<input id="nombre_zipHtml" name="nombre_zipHtml" type="file" size="40" maxlength="255" onchange="compruebaZipHtml();cambio(this);">
							</td>
						  </tr>
						</table>
					</div>
					
					<div id='campos' style='display:none' >
						<table cellspacing='0'  cellpadding='0' width='80%' align='center'>
						<? 
						//$secRec= $visit->dbBuilder->getSeccionesFromIdPadre($sectionData->id);
						reset($seccionesRecursos);
						while (list ($clave, $idsec2) = each ($seccionesRecursos)) { ?>		
							<?
							$i++;
								if ($idsec2!=$idRecurso->id ) {
									$sec2 = $visit->dbBuilder->getSectionDataId($idsec2);
										if ($sec2->nombre!="" && $visit->util->normalizeString($sec2->nombre)!="propietario") {
											?>
											<?
												$caminoItemsStrRec = $visit->util->obtenerCaminoCategoriaStr($dictFilas, "", $sec2->id);
												$caminoItemsRec =  substr( $caminoItemsStrRec, 1, strlen($caminoItemsStrRec)-2);
												$caminoItemsRec =  preg_split(";",$caminoItemsRec);
												$anchoRec=18*(count($caminoItemsRec)-2);
											?>
											<tr>
												<td class="popuptitcampo">
												<IMG SRC="../img/pc.gif" WIDTH="<?= $anchoRec ?>" HEIGHT="1" BORDER="0" ALT="">
													<?= $sec2->nombre ?>&nbsp;
													
												</td>
												
												<? if ($sec2->tipo_valores=="T") { ?>
												
													<td  class="popupcampo" colspan='4'>
														<!-- <input name="seccion_<?=$sec2->id?>_nuevo" type="text" size="40" maxlength="255" value="" onchange="cambio(this)"> -->
														<textarea id="seccion_<?=$sec2->id?>_nuevo" name="seccion_<?=$sec2->id?>_nuevo" rows="7" cols="30" onchange="cambio(this)"  value="" class="textarea"></textarea>
													</td>
												<? } else if ($sec2->tipo_valores=="F") { ?>
												
												<td  class="popupcampo">
													<input name="seccion_<?=$sec2->id?>_nuevo" type="text" size="20" maxlength="255"  onchange="cambio(this);compruebaFecha(this.value)">
													<a href="javascript:show_calendar('document.formulario.seccion_<?=$sec2->id?>_nuevo', document.formulario.seccion_<?=$sec2->id?>_nuevo.value);"><img src="../img/cal.gif" width="16" height="16" border="0" alt="Pinche aqu&iacute; para introducir una fecha"></a>

												</td>
												
												<? } else if ($sec2->tipo_valores=="C") { ?>
													<td  class="popupcampo">
													<select name="seccion_<?= $sec2->id ?>_nuevo" class="selectmedio" onchange="cambio(this); habilitarText('annadir_<?= $sec2->id ?>_nuevo', this.value); " >
																<option value="" >-- <?= $sec2->nombre  ?> --
																<? 
																
																$valores2= $visit->dbBuilder->getAtributosContrFromIdSeccion($sec2->id,$recurso->id);	
																
																//Ordenacion del array por los valores
																$cadena2 = array();
																while (list ($clave2, $valor2) = each ($valores2)) {
																	$cadena2[]= $valor2->value;
																		}
																		if(count($cadena2) >0){
																			usort($cadena2,"strnatcasecmp");
																		}
																		$haySA = false; 
																		while (list ($clave2, $valor2) = each ($cadena2)) { ?>
																			<? if("~Sin asignar"==$valor2) $haySA = true; ?>
																			<? if(""!=$valor2){ ?>
																				<option value="<?= $valor2 ?>">	<?= $valor2  ?>
																			<? } ?>
																		<? } ?>
																<option value="O">Otro
																<option value="~Sin Asignar" > ~Sin Asignar
													</select>
													<div id='annadir_<?= $sec2->id ?>_nuevo' style="display:none" >
													<table cellspacing='0' cellpadding='0' >
														<tr>
														<td><input id="text_<?= $sec2->id ?>_nuevo" name="text_<?= $sec2->id ?>_nuevo" type="text" size="20" maxlength="255" value="" onchange="cambio(this);">&nbsp;&nbsp;
														</td>
														</tr>
													</table>
													</div>
												</td>
									
												<? } else if  ($sec2->tipo_valores=="N"){ ?>
													
													<td  class="popupcampo">
													<input  id="seccion_<?= $sec2->id ?>_nuevo" name="seccion_<?= $sec2->id ?>_nuevo"  class="inputetext_numeric" type="text" size="20" maxlength="255" value=""
													 onchange="cambio(this);compruebaNumerico(this.value)">
													</td>
												<? } // else if ?>
											</tr>
											
										<? } ?>
								<? } ?>
						<? } // while ?>
						<!-- <tr>
							<td class="popuptitcampo">
								Visible:
							</td>
							<td  class="popupcampo">
								<input type="checkbox" name="visible" value="S" onchange="cambio(this)">
							</td>
						</tr> -->
						<!-- <tr>
							 <td class="popuptitcampo">
								Nombre:
							</td>
							<td  class="popupcampo">
								<input name="nombre_recurso" type="text" size="40" maxlength="255" value="" onchange="cambio(this)">
							</td> 
						</tr> -->
						</table>
					</div>				
				</td>
	</tr>
	
	<!-- <tr>
		<td align='center' colspan='2'><a href='#' onclick='window.open("popup_form_section_data.php?idov=<?= $id?>&recOV=S","","width=680,height=500,scrollbars=yes");return false' >Nueva Secci&oacute;n </a></td>
	</tr> -->
	
							<? if ($id=="") { ?>
							<tr>
								<td colspan="12" align="center" style="color:green; font-size:12px;padding-bottom:15px;">
									<span >
										<b>SI ES UN OBJETO DE NUEVA CREACI&Oacute;N PULSE GUARDAR ANTES DE A&Ntilde;ADIR RECURSOS.</b>
									</span>
								</td>
							</tr> 
							<?}?>
							
	</table>
		<TABLE  border="0" width="100%" cellpadding="0" cellspacing="10" style="border-left:1px solid #CCCCCC;border-right:1px solid #CCCCCC;border-bottom:1px solid #CCCCCC;">
			<TR>				
				<TD align="left" width="33%">
						<!-- comprobarExtension() alfredo 140914 -->
						<input type="image" onclick="
						if (compruebaCampos()) {
						  if(comprobarExtension()){
							if (compruebaZip()){
								SetDivPosition();
								window.document.formulario.submit();
							}
						  }
						}
						event.returnValue=false;
						return false;
						" SRC="img/boton_guardar.gif" WIDTH="84" HEIGHT="21" BORDER="0" ALT="Guardar">
				</TD>
				<TD align="center" width="34%">
					<A HREF="<?= $volver ?>" onclick="
						var ir=false;
						if (revisarForm()) ir=true;
						else if (confirm('<?=utf8_encode("Ha modificado datos Seguro que desea volver?")?>')) ir=true;
						event.returnValue=ir;
						return ir;
						"><IMG SRC="img/boton_volver2.gif" WIDTH="84" HEIGHT="21" BORDER="0" ALT="Volver"></A>
				</TD>				
				<TD align="right" width="33%">
					&nbsp;
					<? if ($id!="") { ?>
						<? 
							$idsrefered = $visit->dbBuilder->getFromReferedFromIdOV($id);
							$stringids = "";
							for ($i=0;$i<count($idsrefered);$i++) { 
								if($idsrefered[$i]->idov!="")
									$stringids .= $idsrefered[$i]->idov." ,";
							}
							$stringids = substr($stringids,0,-2);							
							
							//echo(" >>obj2>> ");var_dump($stringids);
						?>
						<A id="eliminar_vo" HREF="#" onclick="
							if (confirm('<?=utf8_encode("Seguro que desea eliminar este objeto?")?>')) {
							<? if($stringids!=""){ ?>
								if (confirm('El/los objeto/s <?=$stringids?> est\u00e1/n utilizando como recurso ajeno\n este objeto y/o alg\u00fan recurso propio del objeto que se dispone a borrar.\n <?=utf8_encode("�Confirma la eliminaci�n del objeto?")?>')) {
							<? } ?>
								window.location.href='do.php?op=eliminar_virtual_object&id=<?= $fila->id ?>&<?=$procedencia?>=S';	
							<? if($stringids!=""){ ?>
								}
							<? } ?>
							}
							event.returnValue=false;
							return false;
							"><IMG SRC="img/boton_eliminar.gif" WIDTH="84" HEIGHT="21" BORDER="0" ALT=""></A>
					<? } ?>
				</TD>
			</TR>
		</TABLE>
</form>
<script>
	function comprobarRecurso()
	{
		extension=document.formulario.nombre_archivo.value;
		extension = extension.substring(extension.length-3, extension.length);
		if(extension == "png" || extension == "jpg")
		{
			document.getElementById('error_archivo_recurso').style.display="none";	
		}else
		{
			document.getElementById('error_archivo_recurso').style.display="inline";
			document.getElementById('error_archivo_recurso').innerHTML='<?=utf8_encode("Extensi�n no v�lida")?>';
			document.formulario.nombre_archivo.value="";
		}
						
	}	

	function comprobarExtension(){		
		if(document.formulario.nombre_archivo.value!=""){
		extension=document.formulario.nombre_archivo.value;
		extension =  extension.substring(extension.lastIndexOf(".")+1);
		//extension = extension.substring(extension.length-3, extension.length);
		extensiones_permitdas = extension_permitida_php.split(";");
		if(extensiones_permitdas !=""){
			permitida = false;
			for (var i = 0; i < extensiones_permitdas.length; i++) {
				if (extensiones_permitdas[i].toUpperCase() == extension.toUpperCase()) {
			         permitida = true;
			         return true;
			         break;
			     }
			}
			if(!permitida)
				{alert("Extensi\u00f3n no v\u00e1lida.\nLas extensiones permitidas son  "+ extension_permitida_php);
				return false;}	
		}
		}
		return true;
	}

	//TODO
	function comprobarUrl(){		
		url=document.formulario.nombre_url.value;
		return true
	}

</script>		
<? include_once(dirname(__FILE__)."/bo_bottom.php"); ?>
