<BR>
<TABLE width="100%" align="center" border="1">
	<input type="hidden" name="cargar" value="">
	<? for ($i=0;$i<count($filas);$i++ ) { ?>
		<div id=campocontenidosboletin_1_span style="display:none">
		<TR>
			<input type="hidden" name="campocontenidospagina_<?= $i?>" value="">
			<input type="hidden" name="campocontenidospagina_<?= $i?>_id" value="<?= $filas[$i]->id?>">
			<input type="hidden" name="campocontenidospagina_<?= $i?>_orden" value="<?= $filas[$i]->orden?>">
			<input type="hidden" name="campocontenidospagina_<?= $i?>_lang" value="<?= $lang?>">
			<TD align="left" >
				<? if ($noExiste!="1") { //echo(" noExiste >> "); var_dump($noExiste);?>
					<table border="0" ALIGN="left">
						 <tr>
							<td>	<A  href="do.php?op=mover_contenidos_pagina&id=<?= $filas[$i]->id?>&idpagina=<?= $fila->id ?>&valor=1&modo=<?= $modo?>&idpaginaprincipal=<?= $id?>&lang=<?= $lang?>"><img SRC="<?=$_parenDir?>bo/img/flecha_up.gif" border="0"></A></td>
							<td>	<A  href="do.php?op=mover_contenidos_pagina&id=<?= $filas[$i]->id?>&idpagina=<?= $fila->id ?>&valor=-1&modo=<?= $modo?>&idpaginaprincipal=<?= $id?>&lang=<?= $lang?>"><img SRC="<?=$_parenDir?>bo/img/flecha_down.gif" border="0"></A></td>
						</tr>
						<tr>
							<td  colspan="2">
								<A  href="do.php?op=eliminar_contenidos_pagina&id=<?= $filas[$i]->id?>&idpagina=<?= $fila->id ?>&modo=<?= $modo?>&idpaginaprincipal=<?= $id?>&lang=<?= $lang?>"><img SRC="<?=$_parenDir?>bo/img/ico_eliminar.gif" border="0"></A>
							</td>
						 </tr>
					</table>
				<? }?>
			</TD>
			<td>
			<? //if ($filas[$i]->tipo=="1") { ?><!-- Imagen anulado por alfredo 140214 -->
			<?if (false) { ?><!-- Imagen -->
				<TABLE width="100%" align="center" border="1">
					<tr bgcolor="#FFFFFF" valign="top">
										
						<td  class="popuptitcampo">
							Tipo:<BR>
							<? $valores = $obj->getValoresTipo(); 
							//echo("valores >> ");var_dump($valores);?>
							
							<? while (list ($clave, $val) = each ($valores)) { ?>
								<input name="campocontenidospagina_<?= $i?>_tipo" type="radio" value="<?= $clave ?>" <? if ($clave==$filas[$i]->tipo) print "checked"; ?> onClick="formulario.cargar.value='1';
										document.formulario.submit();"><?= $val ?>
							<? } ?>
							
						</td>
					</tr>
					<tr bgcolor="#FFFFFF" valign="top"  id="campocontenidospagina_<?= $i?>_imagen">
						<td class="popuptitcampo">
							Imagen: <BR>
								
							<table border="0" cellpadding="0" cellspacing="0">
								<? if ($filas[$i]->imagen!="") {?>
									<tr id ="campocontenidospagina_<?= $i?>_srcimagen">
										<td >
											<INPUT TYPE="hidden" NAME="campocontenidospagina_<?= $i?>_imagen_ubicacion" value ="<?= $filas[$i]->imagen?>">
											<IMG SRC="<?= $visit->util->getUrlArchivo($filas[$i]->imagen)?>"  width="200"  BORDER="0" ALT=""><br>				
											<a name="campocontenidospagina_<?= $i?>_imagena" href="#" onclick="
													var str=getLeftToLast( this.name,'_',1 );
													document.formulario[str+'_imagen_ubicacion'].value='';
													getElement(str+'_srcimagen').style.display='none';
													return false;"
													><IMG id ="img_eliminar_imagen" SRC="<?=$_parenDir?>bo/img/ico_menos.gif" WIDTH="9" HEIGHT="9" BORDER="0" ALT=""></A>
										</TD>
									</tr>
								<? } ?>
								<tr>
									<td align="left">
										<iframe id="iframeOculto" name="iframeOculto" style="width:0px; height:0px; border: 0px"></iframe>
										<!-- Boton que redirecciona el IFRAME hacia -->
										 <input name="campocontenidospagina_<?= $i?>_imagen" type="text" id="campocontenidospagina_<?= $i?>_imagen" class="inputcorto" style="width:200px;" onChange="cambio()">
										 <input type="button" value="Seleccionar imagen" onClick="window.open ('<?=$_parenDir?>bo/bancorecursos/ls_recursos.php?seleccionar=si&campocontenedor=campocontenidospagina_<?= $i?>_imagen', '', 'height=600,width=800,location=no,menubar=no,resizable,scrollbars=no,status,toolbar=no');" class="boton"> 
									</td>

								</tr>
							</table>
									
						</td>
					</tr>
				</TABLE>
			<? //}else if ($filas[$i]->tipo=="2") { ?> <!-- Texto obligado por alfredo 140214-->
			<? }else if (true) { ?> <!-- Texto -->
				<TABLE width="100%" align="center" border="1">
					<tr bgcolor="#FFFFFF" valign="top">
										
					 <td  class="popuptitcampo">
							Tipo:<BR>
							<? $valores = $obj->getValoresTipo(); ?>
							
								<? //while (list ($clave, $val) = each ($valores)) { echo("clave> "); var_dump($clave); echo("val>> "); var_dump($val); alfredo 140214?>
								<? $clave=2 ; $val="Texto"; ?>
									<input name="campocontenidospagina_<?= $i?>_tipo" type="radio" value="<?= $clave ?>" 
									<? if ($clave==$filas[$i]->tipo) print "checked"; ?> onClick="formulario.cargar.value='1'; 
											document.formulario.submit();"><?= $val ?>
								<?//alfredo 140214 } ?>
						</td>
					</tr>
					<tr bgcolor="#FFFFFF" valign="top">
						<td width="140" class="popuptitcampo" valign="top">
							Contenido:<BR>
							<?
								$oFCKeditor = new FCKeditor('campocontenidospagina_'.$i.'_contenido') ;
								$oFCKeditor->BasePath = $_parenDir."FCKeditor/";
								$oFCKeditor->Width		= '750' ;
								$oFCKeditor->Height		= '650' ;
								$oFCKeditor->Value = $visit->util->cambiaEtiqueta($filas[$i]->contenido,"SPAN", "FONT");
								$oFCKeditor->Create() ;
							?> 
						</td>
					</tr>
				</TABLE>
			<? } else if ($filas[$i]->tipo=="3") { ?> <!-- Imagen  + texto 2 columna -->
				<TABLE width="100%" align="center" border="1">
					<tr bgcolor="#FFFFFF" valign="top">			
						<td  class="popuptitcampo">
							Tipo:<BR>
							<? $valores = $obj->getValoresTipo(); ?>
							<? //while (list ($clave, $val) = each ($valores)) {  anulado alfredo 140214 ?>
							<? $clave=2 ; $val="Texto"; ?>
								<input name="campocontenidospagina_<?= $i?>_tipo" type="radio" value="<?= $clave ?>" <? if ($clave==$filas[$i]->tipo) print "checked"; ?> onClick="formulario.cargar.value='1';
										document.formulario.submit();"><?= $val ?>
							<? //} ?>
						</td>
					</tr>
					<tr bgcolor="#FFFFFF" valign="top" >
						<td  class="popuptitcampo">		
							<table border="1" cellpadding="0" cellspacing="0">
								<tr>
									<td class="popuptitcampo" valign="top">
											<?=utf8_encode("Título:")?>
											<input name="campocontenidospagina_<?= $i?>_titulo" type="text" size="30" maxlength="255" value="<?= $filas[$i]->titulo ?>" onchange="cambio(this)"><BR>
											Contenido:<BR>
											<?
												$oFCKeditor = new FCKeditor('campocontenidospagina_'.$i.'_contenido') ;
												$oFCKeditor->BasePath = $_parenDir."FCKeditor/";
												$oFCKeditor->Width		= '320' ;
												$oFCKeditor->Height		= '360' ;
												$oFCKeditor->Value = $visit->util->cambiaEtiqueta($filas[$i]->contenido,"SPAN", "FONT");
												$oFCKeditor->Create() ;
											?> 
										</td>
										<td  class="popuptitcampo" valign="top">
											<?=utf8_encode("Título:")?>
											<input name="campocontenidospagina_<?= $i?>_titulo2" type="text" size="30" maxlength="255" value="<?= $filas[$i]->titulo ?>" onchange="cambio(this)"><BR>
											Contenido:<BR>
								
											<?
												$oFCKeditor = new FCKeditor('campocontenidospagina_'.$i.'_contenido2') ;
												$oFCKeditor->BasePath = $_parenDir."FCKeditor/";
												$oFCKeditor->Width		= '320' ;
												$oFCKeditor->Height		= '360' ;
												$oFCKeditor->Value = $visit->util->cambiaEtiqueta($filas[$i]->contenido2,"SPAN", "FONT");
												$oFCKeditor->Create() ;
											?> 
										</td>	
								</tr>
								<tr>
										<td >
											<? if ($filas[$i]->imagen!="") {?>
												<INPUT TYPE="hidden" NAME="campocontenidospagina_<?= $i?>_imagen_ubicacion" value ="<?= $filas[$i]->imagen?>">
												<IMG id ="campocontenidospagina_<?= $i?>_srcimagen" SRC="<?= $visit->util->getUrlArchivo($filas[$i]->imagen)?>" WIDTH="102"  BORDER="0" ALT=""><br>
												
												<a name="campocontenidospagina_<?= $i?>_imagena" href="#" onclick="
													var str=getLeftToLast( this.name,'_',1 );
													document.formulario[str+'_imagen_ubicacion'].value='';
													getElement(str+'_srcimagen').style.display='none';
													return false;"
													><IMG id ="img_eliminar_imagen" SRC="<?=$_parenDir?>bo/img/ico_menos.gif" WIDTH="9" HEIGHT="9" BORDER="0" ALT=""></A>
					
											<? }else{ ?>
												<IMG SRC="<?=$_parenDir?>bo/img/pc.gif" WIDTH="62"  BORDER="0" ALT="">
											<? } ?>
										</td>
											<td >
											<? if ($filas[$i]->imagen2!="") {?>
												<INPUT TYPE="hidden" NAME="campocontenidospagina_<?= $i?>_imagen2_ubicacion" value ="<?= $filas[$i]->imagen2?>">
												<IMG id ="campocontenidospagina_<?= $i?>_srcimagen2" SRC="<?= $visit->util->getUrlArchivo($filas[$i]->imagen2)?>" WIDTH="102"  BORDER="0" ALT=""><br>
												
												<a name="campocontenidospagina_<?= $i?>_imagena" href="#" onclick="
													var str=getLeftToLast( this.name,'_',1 );
													document.formulario[str+'_imagen2_ubicacion'].value='';
													getElement(str+'_srcimagen2').style.display='none';
													return false;"
													><IMG id ="img_eliminar_imagen" SRC="<?=$_parenDir?>bo/img/ico_menos.gif" WIDTH="9" HEIGHT="9" BORDER="0" ALT=""></A>
					
											<? }else{ ?>
												<IMG SRC="<?=$_parenDir?>bo/img/pc.gif" WIDTH="62"  BORDER="0" ALT="">
											<? } ?>
										</td>
								</tr>
								<tr >
									<td align="left" colsdpan="3">Actualizar:<BR>
										<iframe id="iframeOculto" name="iframeOculto" style="width:0px; height:0px; border: 0px"></iframe>

										<!-- Boton que redirecciona el IFRAME hacia -->
										 <input name="campocontenidospagina_<?= $i?>_imagen" type="text" id="campocontenidospagina_<?= $i?>_imagen" class="inputcorto" style="width:150px;" onChange="cambio()">
										 <input type="button" value="Seleccionar imagen" onClick="window.open ('<?=$_parenDir?>bo/bancorecursos/ls_recursos.php?seleccionar=si&campocontenedor=campocontenidospagina_<?= $i?>_imagen', '', 'height=600,width=800,location=no,menubar=no,resizable,scrollbars=no,status,toolbar=no');" class="boton">
									</td>
									<td align="left" colsdpan="3">Actualizar:<BR>
										<iframe id="iframeOculto" name="iframeOculto" style="width:0px; height:0px; border: 0px"></iframe>

										<!-- Boton que redirecciona el IFRAME hacia -->
										 <input name="campocontenidospagina_<?= $i?>_imagen2" type="text" id="campocontenidospagina_<?= $i?>_imagen2" class="inputcorto" style="width:150px;" onChange="cambio()">
										 <input type="button" value="Seleccionar imagen" onClick="window.open ('<?=$_parenDir?>bo/bancorecursos/ls_recursos.php?seleccionar=si&campocontenedor=campocontenidospagina_<?= $i?>_imagen2', '', 'height=600,width=800,location=no,menubar=no,resizable,scrollbars=no,status,toolbar=no');" class="boton">
									</td>
								</tr>
							</table>
						</tr>	
					
					
				</TABLE>			
										 
			<? }else if ($filas[$i]->tipo=="4") { ?><!-- texto 2 columna -->
				<TABLE width="100%" align="center" border="1">
					<tr bgcolor="#FFFFFF" valign="top">
										
						<td  class="popuptitcampo">
							Tipo:<BR>
							<? $valores = $obj->getValoresTipo(); ?>
							
							<? while (list ($clave, $val) = each ($valores)) { ?>
							<? // $clave=2 ; $val="Texto"; ?>
								<input name="campocontenidospagina_<?= $i?>_tipo" type="radio" value="<?= $clave ?>" <? if ($clave==$filas[$i]->tipo) print "checked"; ?> onClick="formulario.cargar.value='1';
										document.formulario.submit();"><?= $val ?>
							<? } ?>
							
						</td>
					</tr>
					<tr bgcolor="#FFFFFF" valign="top" >
						<td  class="popuptitcampo">		
							<table border="1" cellpadding="2" cellspacing="0">
								<tr>
								
									<td  class="popuptitcampo" valign="top">
										<?=utf8_encode("Título:")?>
										<input name="campocontenidospagina_<?= $i?>_titulo" type="text" size="30" maxlength="255" value="<?= $filas[$i]->titulo ?>" onchange="cambio(this)"><BR>
										Contenido:<BR>
							
										<?
											$oFCKeditor = new FCKeditor('campocontenidospagina_'.$i.'_contenido') ;
											$oFCKeditor->BasePath = $_parenDir."FCKeditor/";
											$oFCKeditor->Width		= '350' ;
											$oFCKeditor->Height		= '360' ;
											$oFCKeditor->Value = $visit->util->cambiaEtiqueta($filas[$i]->contenido,"SPAN", "FONT");
											$oFCKeditor->Create() ;
										?>
									</td>

									<td  class="popuptitcampo" valign="top">
										<?=utf8_encode("Título:")?>
										<input name="campocontenidospagina_<?= $i?>_titulo2" type="text" size="30" maxlength="255" value="<?= $filas[$i]->titulo ?>" onchange="cambio(this)"><BR>
										Contenido:<BR>
							
										<?
											$oFCKeditor = new FCKeditor('campocontenidospagina_'.$i.'_contenido2') ;
											$oFCKeditor->BasePath = $_parenDir."FCKeditor/";
											$oFCKeditor->Width		= '350' ;
											$oFCKeditor->Height		= '360' ;
											$oFCKeditor->Value = $visit->util->cambiaEtiqueta($filas[$i]->contenido2,"SPAN", "FONT");
											$oFCKeditor->Create() ;
										?> 
										
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			<? }else if ($filas[$i]->tipo=="5") { ?> <!-- Imagen  + texto  -->
				<TABLE width="100%" align="center" border="1">
					<tr bgcolor="#FFFFFF" valign="top">
										
						<td  class="popuptitcampo">
							Tipo:<BR>
							<? $valores = $obj->getValoresTipo(); ?>
							
							<? //while (list ($clave, $val) = each ($valores)) { anulado por alfredo 140214?>
							<? $clave=2 ; $val="Texto"; ?>
								<input name="campocontenidospagina_<?= $i?>_tipo" type="radio" value="<?= $clave ?>" <? if ($clave==$filas[$i]->tipo) print "checked"; ?> onClick="formulario.cargar.value='1';
										document.formulario.submit();"><?= $val ?>
							<? //} ?>
							
						</td>
					</tr>
					<tr bgcolor="#FFFFFF" valign="top" >
						<td  class="popuptitcampo">		
							<table border="1" cellpadding="0" cellspacing="0">
								<tr>
								
										<td  class="popuptitcampo" valign="top">
											<?=utf8_encode("Título:")?>
											<input name="campocontenidospagina_<?= $i?>_titulo" type="text" size="30" maxlength="255" value="<?= $filas[$i]->titulo ?>" onchange="cambio(this)"><BR>
											Contenido:<BR>
								
											<?
												$oFCKeditor = new FCKeditor('campocontenidospagina_'.$i.'_contenido') ;
												$oFCKeditor->BasePath = $_parenDir."FCKeditor/";
												$oFCKeditor->Width		= '600' ;
												$oFCKeditor->Height		= '360' ;
												$oFCKeditor->Value = $visit->util->cambiaEtiqueta($filas[$i]->contenido,"SPAN", "FONT");
												$oFCKeditor->Create() ;
											?> 
											 <!-- <textarea name="campocontenidospagina_1_texto" style="width:495px; height=200px;" onchange="cambio(this)"><?= $fila->texto?></textarea> -->
										</td>

										
								</tr>
								<? if ($filas[$i]->imagen!="") {?>
									<tr>
									
										<td >
											
												<INPUT TYPE="hidden" NAME="campocontenidospagina_<?= $i?>_imagen_ubicacion" value ="<?= $filas[$i]->imagen?>">
												<IMG id ="campocontenidospagina_<?= $i?>_srcimagen" SRC="<?= $visit->util->getUrlArchivo($filas[$i]->imagen)?>" WIDTH="62"  BORDER="0" ALT=""><br>
												
												<A name="campocontenidospagina_<?= $i?>_imagena" href="#" onclick="
													var str=getLeftToLast( this.name,'_',1 );
													document.formulario[str+'_imagen_ubicacion'].value='';
													getElement(str+'_srcimagen').style.display='none';
													return false;"
													><IMG id ="img_eliminar_imagen" SRC="<?=$_parenDir?>bo/img/ico_menos.gif" WIDTH="9" HEIGHT="9" BORDER="0" ALT=""></A>
					
											
										<td>
									</tr>
								<? } ?>
								<tr >
									<td align="left" colspan="3">Actualizar:<BR>
										<iframe id="iframeOculto" name="iframeOculto" style="width:0px; height:0px; border: 0px"></iframe>

										<!-- Boton que redirecciona el IFRAME hacia -->
										 <input name="campocontenidospagina_<?= $i?>_imagen" type="text" id="campocontenidospagina_<?= $i?>_imagen" class="inputcorto" style="width:150px;" onChange="cambio()">
										 <input type="button" value="Seleccionar imagen" onClick="window.open ('<?=$_parenDir?>bo/bancorecursos/ls_recursos.php?seleccionar=si&campocontenedor=campocontenidospagina_<?= $i?>_imagen', '', 'height=600,width=800,location=no,menubar=no,resizable,scrollbars=no,status,toolbar=no');" class="boton">

										<!-- <input type="file" name="campocontenidospagina_<?= $i?>_imagen" size="20" onChange="cambio()" class="inputclass"> -->
									</td>
									
								</tr>
							</table>
							</td>
						</tr>	
					</table>
									
									
			<? } ?>	
									
								</td>
							</tr>
	
						</div>
<? } ?>
		<tr>
			<TD align="left" colspan="2">
						<img onclick="toggleOcultacion('div_tipo');
						return false;
						"  SRC="<?=$_parenDir?>bo/img/ico_mas.gif">
			</TD>
		</tr>
		<tr>
			<td  class="popuptitcampo" rowspan colspan="2">
				<div id="div_tipo" name="div_tipo" style="display:none">
					Tipo:<BR>
					<? $valores = $obj->getValoresTipo(); ?>
					
						<? //while (list ($clave, $val) = each ($valores)) { ?>
						<? $clave=2 ; $val="Texto"; ?>
							<input name="campocontenidospagina_<?= $i?>_tipo" type="radio" value="<?= $clave ?>" <? if ($clave==$filas[$i]->tipo) print "checked"; ?> onClick="
										if (esVacio(getValor(document.formulario[ 'titulo' ]))){
											alert('Debe asignar un t\u00edtulo para la p\u00e1gina');
										} else {
											formulario.cargar.value='1';
											document.formulario.submit();
										}
										event.returnValue=false;
										return false;
									"><?= $val ?>
						<? //} ?>
				</div>	
				</td>
		</tr>
		<input type="hidden" name="campocontenidospagina_<?= $i?>" value=""> 
		<input type="hidden" name="campocontenidospagina_<?= $i?>_orden" value="100"> 	
</TABLE>
<BR>