<?
include_once(dirname(__FILE__)."/include.php");

include_once(dirname(__FILE__)."/top.php");


$visit->debuger->enable(false);

		
$npag = $dict["npag"];
//var_dump($npag);

$paginacion = $dict["paginacion"];


//Coger la paginacion por el Post primero y luego por el get
//$paginacion = $_POST["paginacion"];
//if($paginacion != "") $paginacion = $_GET["paginacion"];

$id = $dict["id"];
//var_dump($id);

$orden = $dict["orden"];
//var_dump($orden);

$orden_tipo = $dict["orden_tipo"];
//var_dump($orden_tipo);

//Añadido JOAQUIN GAYOSO 27062016
if (!(isset($_GET["pag_inicial"])))
	$dict["pag_inicial"]=-1;
//Añadido JOAQUIN GAYOSO 27062016

//var_dump($dict);
if ($npag=="") { 
	$npag=1;
}
 


if($dict["pag_inicial"]=="-1"){  // alfredo 140831 
	//$dict=$visit->util->getRequest();
	$_SESSION['lsvirtual_object_busqueda']=str_replace("-1","0", $dict);
	}else{
		$dict=$visit->util->getRequest2superGlobal();
		//echo "dict(0)="; var_dump(array_slice($dict,0,25,true));
		}
		
// alfredo 140707  $session->lsvirtual_object= $visit->util->getUrlQuery("",$visit->util->getQueryString());
//$_SESSION['lsvirtual_object_busqueda']= $visit->util->getUrlQuery("",$visit->util->getQueryString());
//var_dump($_SESSION["lsvirtual_object_busqueda"]);

if($dict["pag_inicial"]=="-1"){ //alfredo 140831
		$urlName=$visit->util->construyeUrlMenosLista("","ls_ov_busqueda.php","npag");
		//echo " -------- URLNAME(-1)="; var_dump(substr($urlName, 0, 100));
		$urlPag=$visit->util->construyeUrlMenosLista("","ls_ov_busqueda.php","npag,paginacion");
		$urlOrden=$visit->util->construyeUrlMenosLista("","ls_ov_busqueda.php","orden,orden_tipo");
		$ordenar = $orden." ".$orden_tipo;
	}else{
			$urlName=$visit->util->construyeUrlMenosLista("","ls_ov_busqueda.php","npag");
			//echo " -------- URLNAME(0)="; var_dump(substr($urlName, 0, 100));
			$urlPag=$visit->util->construyeUrlMenosLista("","ls_ov_busqueda.php","npag,paginacion");
			$urlOrden=$visit->util->construyeUrlMenosLista("","ls_ov_busqueda.php","orden,orden_tipo");
			$ordenar = $orden." ".$orden_tipo;
			
		}
		
// echo "  super global=";var_dump($_SESSION['lsvirtual_object_busqueda']["paginacion"]);

if($dict["pag_inicial"]=="-1"){ 				//alfredo  140901
					$visit->options->paginacion=20;
					}else{
					$visit->options->paginacion=$dict["paginacion"];
					}//alfredo 140901
		
if ($paginacion!="") $visit->options->paginacion=$paginacion;

$visit->options->maxPaginasSiguientes=3;




//alfredo 140829  $urlName=$visit->util->construyeUrlMenosLista("",$visit->util->getRequest(),"npag");
// alfredo 140829 $urlPag=$visit->util->construyeUrlMenosLista("",$visit->util->getRequest(),"npag,paginacion");
// alfredo 140829 $urlOrden=$visit->util->construyeUrlMenosLista("",$visit->util->getRequest(),"orden,orden_tipo");
// alfredo 140829 $ordenar = $orden." ".$orden_tipo;
//var_dump($ordenar);
//var_dump(substr($urlName,0,800));
//var_dump($urlPag);
//var_dump($urlOrden);



/*
 * Descomentar y sustituir para Metodo de obtenciÃ³n de filas directo sin filtros.
 $count = $visit->dbBuilder->getVirtualObjectCount(); 
 $inicio = ( $npag - 1 ) * $visit->options->paginacion + 1;
 $filas = $visit->dbBuilder->getVirtualObjectLimit($inicio -1 ,$visit->options->paginacion);
*/

$virtualObject = new ClsVirtualObject();

if (trim($ordenar)!="") $virtualObject->_orderby = $ordenar;

if(!$visit->util->esSuperAdmin()){
	//FILTRADO OBJETOS USUARIOS NO REGISTRADO
	$virtualObject->refinar->noprivate = "S";

	if(!$visit->util->esUserRegistrado()){
		$virtualObject->refinar->ispublic="S";
	}

}


/// chapuza alfredo 140901 ************************************************************************
// deber’a bastar con calcular count, pero si se hace la bœsqueda sin especificar ninguna seccion deberia de dar el total de OVs
// a que tiene acceso ese tipo de usuario pero da todos los OVs 
// La chapuza sirve para contar correctamente la totalidad de OVs a que tiene acceso el tipo de usuario
// Tengo que usuar un l’mite para la BD que fijo en 10.000.000

// echo "------id USUARIO="; var_dump($dict["idusuario"]);
// substituido por la chapuza 140901   
//$count =$visit->dbBuilder->getTablaBusquedaOVsCount($virtualObject,$dict);
//echo "------COUNT="; var_dump($count);

				function fichaAccesible($ov){
				global $visit;
					/*$cond1 = "S"==$ov->ispublic;
					$cond2 = $visit->util->perteneceLista($visit->options->usuario->rol,"A,B");
					$cond3 =	"C"==$visit->options->usuario->rol&&$visit->util->inArray($visit->dbBuilder->getPermisosFromUsuario($visit->options->usuario->id),$ov->id);
					return $cond1||$cond2||$cond3;*/
				return $visit->dbBuilder->isOVAccesibleBusqueda($ov);
				}

				$limiteBD=10000000;
				$filas_todas = $visit->dbBuilder->getTablaBusquedaOVsLimit($virtualObject, $inicio - 1 , $limiteBD, $dict);
				//$filas_todas = $visit->dbBuilder->getTablaBusquedaOVsCount($virtualObject,$dict);
				$cuenta=0;
				for ($j=0;$j<count($filas_todas);$j++) { 	
				//CONTROL USUARIOS REGISTRADOS
				$registrado=(($visit->util->esUserRegistrado()&&("N"==$filas_todas[$j]->isprivate)));

				if( ("S"==$filas_todas[$j]->ispublic)||$registrado||$visit->util->esSuperAdmin()  ){
					$accesible = fichaAccesible($filas_todas[$j])>0;
					if(accesible) $cuenta++;
					}
				}
				//echo"------CUENTA=";var_dump($cuenta);
				$count=$cuenta;
				
/// FIN chapuza alfredo 140901 ************************************************************************


$inicio = ( $npag - 1 ) * $visit->options->paginacion + 1;
$filas="";
if ($count==0) {
	$inicio=0;
} else {
	$filas = $visit->dbBuilder->getTablaBusquedaOVsLimit($virtualObject, $inicio - 1 ,$visit->options->paginacion,$dict);
	
	
	
	
		//var_dump($filas); 
		//var_dump("ENV*** "); var_dump($_ENV["seccion_id"]); //alfredo 140711
		//var_dump("    IDS CONTROL -->");var_dump($_SESSION["idsControlados"]); 
		$_SESSION["idsControlados"]="";
		//var_dump("    IDS NUMERIC -->");var_dump($_SESSION["idsNumeric"]); 
		$_SESSION["idsNumeric"]="";
		//var_dump("    IDS FECHAS -->");var_dump($_SESSION["idsFechas"]); 
		$_SESSION["idsFechas"]="";
		//var_dump("    IDS TEXT -->");var_dump($_SESSION["idsText"]); 
		$_SESSION["idsText"]="";
		//	var_dump("    MIS-IDS -->");var_dump($_SESSION["MIS-IDS"]); 
		$_SESSION["MIS-IDS"]="";
		//	var_dump("    refinadaSTR -->");var_dump($_SESSION["refinadaSTR"]);
		$_SESSION["refinadaSTR"]="";
		//	var_dump("    STRWHERE -->");var_dump($_SESSION["STRWHERE"]); 
		$_SESSION["STRWHERE"]="";
		
		$_SESSION['valores_buscados']=NULL;
	
						//var_dump("b*** "); var_dump($_ENV["seccion_id"]); //alfredo 140711
						
						$_SESSION['campos_buscados']=$_ENV["seccion_id"]; //alfredo 140824
						
						$campo_buscado = 1;
						// alfredo 140824   while($campo_buscado<=$_ENV["seccion_id"][0]) { //alfredo 140824
						while($campo_buscado<$_ENV["seccion_id"][0]) {
						
						$id=$_ENV["seccion_id"][$campo_buscado];  
						
						//$item->id=$filas[$j]->id;
						
						//var_dump($_ENV["seccion_id"][$campo_buscado]);
						
						$indice_valor="seccion_".$_ENV["seccion_id"][$campo_buscado];  //alfredo 140824 
						
						//var_dump(">>>");var_dump($indice_valor);var_dump($dict[$indice_valor]); //alfredo 140824
						
						//$_SESSION['valores_buscados'][$campo_buscado]=$dict[$indice_valor]; //alfredo 140824
						$_SESSION['valores_buscados'][$_ENV["seccion_id"][$campo_buscado]]=$dict[$indice_valor];
						
						$campo_buscado++;
						}
						
	
}
//var_dump($filas);

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



<div class="titulopagina">  <? print $visit->util->migaspan($idpadre,$migas);?>  > Resultados B&uacute;squeda<!-- Insertar la busqueda --></div>

<TABLE  border="0" cellpadding="20" cellspacing="0" width='100%' height="30" >
		<tr>
			<!-- <td align='center'><a href='buscador.php?menu=241&lang=es'>Refinar b&uacute;squeda <br clear="left"> (a&ntilde;adir o quitar campos a la b&uacute;squeda)<a></td> -->
			<td align='center'><a href='buscador.php?refinar=1 '>Refinar b&uacute;squeda <br clear="left"> (a&ntilde;adir o quitar campos a la b&uacute;squeda)<a></td>
		</tr>
		
	</table>
	
	
<? // alfredo 140923    if ($filas!="" && $count > 0) { ?>

<? if ($filas!="collection" && $count > 0) { ?>
	
	<div> <!-- PAGINACION -->
	<FORM METHOD="POST" ACTION="ls_ov_busqueda.php" name="formlistado" style="display:inline;">
	<input type="hidden" name="pag_inicial" value="0"/>
			<? foreach($dict as $clave=>$valor){
					if($clave != "npag"){ ?>
					<input  type="hidden" name="<?=$clave?>" value="<?=$valor?>" /> 	
				<? }
			 } ?>
			 

			 
			<div class="busqueda_paginacion_sup"> <!-- PAGINACION -->
			
				<div class="paginacion_resultados">
					<?= $inicio ?>-<?= $visit->util->muestrahastareg($visit->options->paginacion,$count,$npag) ?> de <?= $count ?> resultados &nbsp;
				</div>
				<!-- 
				<span style="margin-right:15px;" 
					<? if ($orden=="name") { ?>
						class="camposlsactivo"
					<? } else { ?>
						class="camposls"
					<? } ?>
					><b>Objeto Virtual</b>
					<A HREF="<?= $visit->util->concatenaUrl($urlOrden,"orden=id&orden_tipo=DESC") ?>"><IMG SRC="
						<? if ($ordenar=="id DESC"){ 
							echo 'img/ls_flecha_arriba_sobre.gif';
						} else { 
							echo 'img/ls_flecha_arriba_normal.gif';
						} ?>
						" WIDTH="13" HEIGHT="6" BORDER="0" ALT="">
					</A>
					<A HREF="<?= $visit->util->concatenaUrl($urlOrden,"orden=id&orden_tipo=ASC") ?>"><IMG SRC="
						<? if ($ordenar=="id ASC"){ 
							echo 'img/ls_flecha_abajo_sobre.gif';
						} else { 
							echo 'img/ls_flecha_abajo_normal.gif';
						}
						?>" WIDTH="13" HEIGHT="6" BORDER="0" ALT="">
					</A>
				</span>			
				 -->
				<div class="paginacion_select" >
					<? $valoresPaginacion= split(",","20,40,60,100,200,400"); ?>
					<select name ="paginacion"  class="selectpeque" style="width:60px;" onChange="form.submit()" >
						<? for ($i=0;$i<count($valoresPaginacion);$i++) { ?>
							<option id="paginacion" value="<?= $valoresPaginacion[$i] ?>" <? if ($visit->options->paginacion==$valoresPaginacion[$i]) print "selected"; ?>><?= $valoresPaginacion[$i] ?>
						<? } ?>
					</select>
				</div>
				<div class="paginacion_enlaces">
					<? $_SESSION['lsvirtual_object_busqueda']["paginacion"]=$visit->options->paginacion; //alfredo 140901
					$visit->util->imprimirPaginacionBusqueda($visit->options->paginacion, $visit->options->maxPaginasSiguientes, $count, $npag, $urlName); ?> 
				</div>
				<div class="clearfix"></div>
			</div>
			<!-- <div style="border-bottom:2px dotted #666666; margin-top:10px;"></div>  -->
		</FORM>	
	
	</div>
	<?

//			function fichaAccesible($ov){ alfredo 140901

			
	
		//LISTADO DE ARCHIVOS
		//var_dump($filas);
		// $_SESSION['valores_buscados']=NULL;   alfredo 140828 
					
		
		
			for ($j=0;$j<count($filas);$j++) { 	
				//CONTROL USUARIOS REGISTRADOS
				//var_dump($filas[$j]);
				$registrado=(($visit->util->esUserRegistrado()&&("N"==$filas[$j]->isprivate)));



				if( ("S"==$filas[$j]->ispublic)||$registrado||$visit->util->esSuperAdmin()  ){
					$accesible = fichaAccesible($filas[$j])>0;
					
					if ( ($i % 2) != 0 ) {
					$lsregistros="lsregistrospar";
					} else {
					$lsregistros="lsregistrosimpar";
					}
			?>
			<div class="fila_busqueda">
				<div class="imagen_busqueda_campos"> <!-- alfredo 140811   ICONO -->
					<?
						$icono= $visit->dbBuilder->getIconoFromOV($filas[$j]->id);
						if($icono ==NULL){
							 $rutaicono = "img/ico_ov.gif";
						}else {
							$rutaicono = "../bo/download/iconos/".$visit->dbBuilder->getNombreIcono($icono->idov,$icono->name);
						}
					?>
					<? if  ($accesible) { ?>
						<a href="#" onclick='window.open("cm_view_virtual_object.php?idov=<?=  $filas[$j]->id ?>&seleccion=1","","width=1000,height=850,scrollbars=yes"); return false;'>
					<? } ?>	
						<div style="width:80px; overflow-y:hidden;">
							<img src="<?=$rutaicono?>" width="80px" border="0">
						</div>
					<? if  ($accesible) { ?>
						</a>
					<? } ?>	
				</div> <!-- FIN ICONO -->
				
	
				<div class="busqueda_id"> <!-- IDENTIFICADOR -->
					<? if  ($accesible) { ?>
						<a href="#" onclick='window.open("cm_view_virtual_object.php?idov=<?=  $filas[$j]->id ?>&seleccion=1","","width=800,height=850,scrollbars=yes"); return false;'>
					<? } ?>
						<b>ID </b>&nbsp;<?=$filas[$j]->id?>
					<? if  ($accesible) { ?>
						</a>
					<? } ?>
					&nbsp;-&nbsp;
					<? if("S"==$filas[$j]->ispublic){ ?>
						<font style="color:green;">
							Acceso P&uacute;blico
						</font>
					<? } else if($accesible && "N"==$filas[$j]->isprivate){ ?>
						<font style="color:red;">
							S&oacute;lo usuarios registrados
						</font>
					<? } else if($visit->util->esSuperAdmin()){?>
						<font style="color:red;">
							Acceso privado
						</font>
					<? } ?>
					
				</div>
				<div class="busqueda_datos">
					<div>	<!-- NOMBRE -->
						<?	$descripcion = $visit->dbBuilder->obtenerAtributoValorContrFromSeccionOV(112,$filas[$j]->id);
							$descripcion= strip_tags($descripcion->value);
				
							$nombre = $visit->dbBuilder->obtenerAtributoValorTextFromSeccionOV(111,$filas[$j]->id);
							$nombre=strip_tags($nombre->value);
						?>
							<? 	$seccion=$visit->dbBuilder->getSectionDataId(111);?>
							<span class="busqueda_datos_titulo"> <? echo $seccion->nombre;?> : &nbsp; </span>
							<span class="busqueda_datos_texto">
								<? if(strlen($nombre)>500){ 							
							 		print substr($nombre,0,500);
									print "...";
									
								 } else { 
									print $nombre;
									
								 } ?>
							
							</span>
					</div>
					<div><!--  DESCRIPCION -->
						<? $seccion=$visit->dbBuilder->getSectionDataId(112);
						if($descripcion!=""){ //alfredo 140712 
						?>
						<span class="busqueda_datos_titulo"><? echo $seccion->nombre; ?>:&nbsp; </span>
						<span class="busqueda_datos_texto">
							<? if(strlen($descripcion)>500){
								print substr($descripcion,0,500);
								print "...";
								
								} else {
								print $descripcion;
								
									}
								
							}?>	
						
						</span>	
					</div>	
					
					
					
					<? 	// ****************************************************************
						//*****************************************************************
								//var_dump($id); $id = $filas[$j]->id; var_dump($id); var_dump($item->id);
					
					
						/********************************************************************************************** alfredo 140828 ***/
								//var_dump("b*** "); var_dump($_ENV["seccion_id"]); //alfredo 140711
						
								// 140828   $_SESSION['campos_buscados']=$_ENV["seccion_id"]; //alfredo 140824 
			 
					foreach($dict as $clave=>$valor){
							$id=str_replace("seccion_","", $clave);
							if(in_array($id, $_ENV["seccion_id"], true)){
							//		var_dump(" >>>"); var_dump($id);
							//		}else{}
			 				//} 
					
								// alfredo 140824   while($campo_buscado<=$_ENV["seccion_id"][0]) { //alfredo 140824
					// 140829 $campo_buscado = 1;
					// 140829 while($campo_buscado<$_ENV["seccion_id"][0]) {
						
						// 140829 $id=$_ENV["seccion_id"][$campo_buscado]; 
						
					$item->id=$filas[$j]->id; //id del objeto, j recorre los objetos
						
								//var_dump("item->id "); var_dump($item->id);
								//var_dump($_ENV["seccion_id"][$campo_buscado]);
						
						// 140829 $indice_valor="seccion_".$_ENV["seccion_id"][$campo_buscado];  //alfredo 140824 
						
								// var_dump($indice_valor);var_dump($dict[$indice_valor]); //alfredo 140824
						
								//$_SESSION['valores_buscados'][$campo_buscado]=$dict[$indice_valor]; //alfredo 140824
								// $_SESSION['valores_buscados'][$_ENV["seccion_id"][$campo_buscado]]=$dict[$indice_valor];
						/********************************************************************************************/
						
						
						$margen=$dict["margen".$id];
						
						if($id != "" && $id != "111" && $id != "112"){ ?>
						
						<div> <!--  DESCRIPCION campo buscado -->
							<? 	
								$seccion=$visit->dbBuilder->getSectionDataId($id); 
								if($seccion->tipo_valores == "C")$descripcion = $visit->dbBuilder->obtenerAtributoValorContrFromSeccionOV($id,$item->id);
								if($seccion->tipo_valores == "T")$descripcion = $visit->dbBuilder->obtenerAtributoValorTextFromSeccionOV($id,$item->id);
								if($seccion->tipo_valores == "N")$descripcion = $visit->dbBuilder->obtenerAtributoValorNumFromSeccionOV($id,$item->id);
								if($seccion->tipo_valores == "F")$descripcion = $visit->dbBuilder->obtenerAtributoValorDateFromSeccionOV($id,$item->id);
								$descripcion=$descripcion->value;
								
								
								
								if($seccion->tipo_valores == "F"){									
									$length=strlen($descripcion);
									$ano=substr($descripcion,0,$length-4);
									$mes=substr($descripcion,$length-4,$length-6);
									$dia=substr($descripcion,$length-2,$length);

									$descripcion = $dia.'/'.$mes.'/'.$ano;
								}elseif($seccion->tipo_valores == "N"){	
									$decimales = $visit->dbBuilder->getCantidadDecimales($seccion->id);
									$descripcion = round($descripcion, $decimales); 									
								}
							?>
							<span class="busqueda_datos_titulo" style="margin-left:<?=$margen?>;"><? echo $seccion->nombre; ?>:&nbsp; </span>
							<span class="busqueda_datos_texto">
							
								<? if(strlen($descripcion)>500){
									print substr($descripcion,0,500);
									print "...";
								} else {
									print $descripcion;
								}
							?>	
							</span>									
						</div>	
					<? } //  FIN DEL IF segundo
					//$campo_buscado++;
						} // FIN DEL IF primero
					}  // FIN DEL WHILE que recorre secciones buscadas alfredo 140828
					?>
					<div class="clearfix"></div>	
				
				</div>
				<?if($accesible){?>
				<div class="busqueda_ver_mas">						
					<a href="#" onclick='window.open("cm_view_virtual_object.php?idov=<?=  $filas[$j]->id ?>&seleccion=1","_blank","width=1024,height=850,scrollbars=yes"); return false;'>
						[Ver m&aacute;s]
					</a>
				</div>	
				<?}?>
			<div class="clearfix"></div>	
		</div> <!-- FiN DE UNA FILA -->
		<? }?> 
			<? }
			?> <!-- FIN DEL FOR que recorre los objetos -->
			
			
	
	
	
<div class="busqueda_paginacion_inf"> <!-- PAGINACION -->
			<div class="paginacion_resultados">
				<?= $inicio ?>-<?= $visit->util->muestrahastareg($visit->options->paginacion,$count,$npag) ?> de <?= $count ?> resultados &nbsp;
			</div>
			<div class="paginacion_enlaces">
				<? $visit->util->imprimirPaginacionBusqueda($visit->options->paginacion, $visit->options->maxPaginasSiguientes, $count, $npag, $urlName); ?>
			</div>
	<div class="clearfix"></div>
</div>

<? } else {?>
	<TABLE  border="0" cellpadding="20" cellspacing="0" width='100%' height="200" >
		<tr>
			<td align='center'><b>No se han encontrado resultados</b></td>
		</tr>
		<!--  <tr>
			<td align='center'><a href='buscador.php?menu=241&lang=es'>Refinar b&uacute;squeda<a></td>
		</tr> -->
		
	</table>
<? } ?>
<?
include_once(dirname(__FILE__)."/bottom.php");