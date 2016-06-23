<? 

/* 
 * Archivo generado dinámicamente por Content Manager
*/

include_once(dirname(__FILE__)."/include.php");
if (!$visit->options->tieneAcceso("ls",new ClsVirtualObject())) $visit->options->sinAcceso();

//$visit->options->seccion = "OV";
//$visit->options->subseccion = "ObjetosVirtuales";


include_once(dirname(__FILE__)."/top_simple.php");

//$visit->debuger->enable(true);

if ($npag=="") { 
	$npag=1;
}

// alfredo 140707  $session->lsvirtual_object= $visit->util->getUrlQuery("",$visit->util->getQueryString());
$_SESSION['lsvirtual_object']= $visit->util->getUrlQuery("",$visit->util->getQueryString());

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

$usuario = new ClsUsuarios();


if (trim($ordenar)!="") $virtualObject->_orderby = $ordenar;
$count = $visit->dbBuilder->getTablaFiltradaCount($usuario); 
$inicio = ( $npag - 1 ) * $visit->options->paginacion + 1;
if ($count==0) $inicio=0;
$filas = $visit->dbBuilder->getTablaFiltradaLimit($usuario, $inicio - 1 ,$visit->options->paginacion);


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
function asignarOV(id){
	//alert(id);
window.opener.formulario.idov_refered.value=id;


}
function seleccionar(codigo) {
		
		var nodoa = getElement("a_"+codigo);
		var titulo = getInnerTextFromNodo(nodoa);

		opener.annadirUsuario(codigo,titulo);

		try
		{
			window.opener.cambio();
			window.opener.checkPublico();
		}
		catch (e)
		{
		}
		window.close();
	}
	
	function seleccionarLista(){
		
		var listaIds = window.opener.getElement('lista_usuarios_marcados').value;//getIdsChecked(document.formulario);
		var listaTitulos = window.opener.getElement('lista_nombres_usuarios_marcados').value;
		//getValueInputIfSetChecked(document.formulario,"editorial_");

		opener.annadirListaUsuarios(listaIds,listaTitulos);

		try
		{
			window.opener.cambio();
			window.opener.checkPublico();
		}
		catch (e)
		{
		}
		window.close();
	}

	function aniadirusuariolista(idusuario,nombreusuario){
		var listausuarios = window.opener.getElement('lista_usuarios_marcados');
		var listanombres = window.opener.getElement('lista_nombres_usuarios_marcados');
		
		if(listausuarios.value!=""){
			listausuarios.value += ";"+idusuario;
			listanombres.value += ";"+nombreusuario;
		}else{
			listausuarios.value = idusuario;
			listanombres.value = nombreusuario;

		}
	}

	function quitarusuariolista(idusuario,nombreusuario){
		var usuarios_seleccionados = window.opener.getElement('lista_usuarios_marcados').value;
		var nombre_usuarios_seleccionados = window.opener.getElement('lista_nombres_usuarios_marcados').value;


		usuarios_seleccionados=eliminaDeLista2(idusuario,usuarios_seleccionados);
		titulo_editoriales_seleccionadas=eliminaDeLista2(nombreusuario,nombre_usuarios_seleccionados);

		window.opener.getElement('lista_usuarios_marcados').value=usuarios_seleccionados;
		window.opener.getElement('lista_nombres_usuarios_marcados').value=nombre_usuarios_seleccionados;
	}
</script>
	<FORM METHOD=GET ACTION="<?= $visit->util->getNombreArchivo( $visit->util->getScriptName() ) ?>" name="formlistado" style="display:inline;">
		<input type="hidden" name="paginacion" value="<?= $visit->options->paginacion ?>">

		
		<TABLE width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
			<TR>
				<TD width="200" valign="bottom" align="left">
					<TABLE width="200" border="0" cellpadding="0" cellspacing="0"  background="img/filtros_tit_fondo.gif" style="border-left:1px solid #B1B1B1;border-right:1px solid #B1B1B1;border-top:1px solid #B1B1B1;" > 		
						<TR>
							<TD width="11"><IMG SRC="img/filtros_bullet_titulos.gif" WIDTH="11" HEIGHT="19" BORDER="0" ALT=""></TD>
							<TD valign="middle"  nowrap><span class="titcuadro">Listado de usuarios</span></TD>
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
		</TABLE>
</FORM>
<form name="form_generacion" action="do.php" method="POST"  style="display:inline;">

<TABLE class="lstabla" width="100%"  cellpadding="0" cellspacing="0">
	<!-- CAMPOS -->
	<TR>
		
	
		<TD class="lscabecera" >
			<!-- CAMPO -->
			<TABLE  border="0" cellpadding="0" cellspacing="0" width='250'>
				<TR>
						<td width="13" height="16" class="cablistadom">&nbsp;</td>
						<TD nowrap width='20'
							<? if ($orden=="name") { ?>
								class="camposlsactivo"
							<? } else { ?>
								class="camposls"
							<? } ?>
							>Nombre&nbsp;</TD>
						<TD nowrap ><A HREF="<?= $visit->util->concatenaUrl($urlOrden,"orden=name&orden_tipo=DESC") ?>"><IMG SRC="
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
							?>" WIDTH="13" HEIGHT="6" BORDER="0" ALT=""></A></TD>
					</TR>
			</TABLE>				
			<!-- FIN CAMPO -->
		</TD>
		<!-- <TD class="lscabecera"  colspan="0" width='80'>
			
			<TABLE  border="0" cellpadding="0" cellspacing="0">
				<TR>
						<TD nowrap 
							<? if ($orden=="ispublic") { ?>
								class="camposlsactivo"
							<? } else { ?>
								class="camposls"
							<? } ?>
							>Es publico&nbsp;</TD>
						<TD nowrap ><A HREF="<?= $visit->util->concatenaUrl($urlOrden,"orden=ispublic&orden_tipo=DESC") ?>"><IMG SRC="
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
							?>" WIDTH="13" HEIGHT="6" BORDER="0" ALT=""></A></TD>
					</TR>
			</TABLE>				
			
		</TD> -->
			
		
	</tr>



	<? for ($i=0;$i<count($filas);$i++) { ?>
	<?
		if ( ($i % 2) != 0 ) {
			$lsregistros="lsregistrospar";
		} else {
			$lsregistros="lsregistrosimpar";
		}
	?>
		<tr>
			<td class="<?= $lsregistros ?>" width ="16px">
							<input type="checkbox" onClick="
							if(this.checked==true){
								aniadirusuariolista(<?= $filas[$i]->id ?>,'<?= $filas[$i]->nombre ?> <?= $filas[$i]->apellidos?>');
							}else{
								quitarusuariolista(<?= $filas[$i]->id ?>,'<?= $filas[$i]->nombre ?> <?= $filas[$i]->apellidos?>');
							};return true;" id="set_<?= $filas[$i]->id ?>" name="set_<?= $filas[$i]->id ?>" value="<?= $filas[$i]->id?>" >
			</TD>
			
			<TD class="<?= $lsregistros ?>"><?=$filas[$i]->apellidos ?>, <?= $filas[$i]->nombre ?></TD>
			<!-- <TD class="<?= $lsregistros ?>"><B>
						<? if ($filas[$i]->ispublic=="S"){  ?> 
								<IMG SRC="img/ico_checked_si.gif" WIDTH="12" HEIGHT="12" BORDER="0" ALT="">  
						<?	}else{ ?>
								<IMG SRC="img/ico_checked_no.gif" WIDTH="12" HEIGHT="12" BORDER="0" ALT="">
						<? } ?>
				</B>
			</TD> -->
			
			
		</tr>
	<? } ?>
</table>
<TABLE  width="100%" cellpadding="0" cellspacing="0" style="border:1px solid #CCCCCC;">
	<TR>
		<TD width="30%" height="24" align="left"  background="img/backoffice_fondo_cab_tabla.jpg">&nbsp;[<?= $inicio ?>-<?= $visit->util->muestrahastareg($visit->options->paginacion,$count,$npag) ?>] de <?= $count ?>&nbsp;
			<? $valoresPaginacion=explode(",","20,40,60,100,200,400"); ?>
		</TD>
		
		<TD width="40%" nowrap background="img/backoffice_fondo_cab_tabla.jpg" align="center">
		
		<? $visit->util->imprimirPaginacion($visit->options->paginacion, $visit->options->maxPaginasSiguientes, $count, $npag, $urlName); ?>
		
		</TD>
		
	</TR>
</TABLE>
<table cellspacing='0' cellpadding='0' width= '100%' >
			<tr>
				<td align='left'>
					<span class="acciong">
					
							[<a href='#'  onclick="seleccionarLista(); return false;"  	class='botonaccion'>
							Asignar seleccionadas
							</a>]
					
					</span>
				</td>
			 <td align="right">
				
						<span class="acciong">
							[<a href='#' class='botonaccion' onclick='
							window.close();
							return false;'>Cerrar ventana</a>]
						</span>
			
			 </td>
		   </tr>
		</table>
	<script>
			var listamarcadas = window.opener.getElement('lista_usuarios_marcados').value;
			var usuarios = listamarcadas.explode(";");
						
			for(i=0;i<usuarios.length-1;i++){
				check_usuario = getElement("set_" + usuarios[i]);
				if(check_usuario != null){
					check_usuario.checked=true;
				}
			}
	</script>

<?include_once(dirname(__FILE__)."/bottom_simple.php");?>