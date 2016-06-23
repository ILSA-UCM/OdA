<? 

//********************************************
// 140727 alfredo RECURSOS AJENOS, para tener en cuenta que ahora en idresource_refered se guarda el id del recurso referenciado 
// (antes el id del ov referenciado) se cambia $recurso->idresource_refered por $recurso->idov_refered 
//********************************************


	include_once(dirname(__FILE__)."/include.php");
	
	$preferencias_seguridad=$visit->dbBuilder->getPreferenciaFromAtributo("seguridad_web");
	if($preferencias_seguridad->valor == S && !(isset($_SESSION["name"])))
	{
		$visit->util->redirect("/".APP_NAME."/view/login.php");	
	}

	$dict=$visit->util->getRequest();	
	$idov = $dict["idov"];	
	$recurso = $visit->dbBuilder->getRecursoFromId($dict["idrecurso"]);
	
	if (!$visit->options->tieneAcceso("E",$dict["idov"])) $visit->options->sinAcceso();
	include_once(dirname(__FILE__)."/top_simple.php");
	$username = $_SESSION["name"];
	$rol = $visit->dbBuilder->getUsuarioRol($username);	
	
?>
<script language="javascript">
	function zoomMas(id) {
		var imagen = document.getElementById(id);	
		var widthImg = imagen.width;
		var heightImg = imagen.height;
		if (imagen != null){
			imagen.height = heightImg * 1.5;
			imagen.width = widthImg * 1.5;
		}
	}

	function zoomMenos(id) {
		var imagen = document.getElementById(id);
		var widthImg = imagen.width;
		var heightImg = imagen.height;
		if (imagen != null){
			imagen.height = heightImg / 1.5;
			imagen.width = widthImg / 1.5;
		}
	}
</script>
	<TABLE align="center" border="2" cellpadding="0" cellspacing="0" class="tabla_mostrar_imagen" >
		<TR>
			<TD >
				<TABLE border="0" cellpadding="0" cellpadding="0" style="border-right:1px dotted #1165AE; padding-right:15px;">
					<TR>
						<TD COLSPAN="2" align="center" >	
							<div id="divImagen" style="overflow-y:hidden;">
							<? if($recurso->idov_refered!="") {	// alfredo 140727 			
								$rutaicono = "../bo/download/".$recurso->idov_refered."/".$recurso->name; // alfredo 140727
							}  else {
								$rutaicono = "../bo/download/".$recurso->idov."/".$recurso->name;
							}?>
								<img id="Imagen" src="<?=$rutaicono?>"  width='675' border="0">
							</div>
						<TD>
					</TR>
					<TR>
						<TD align="left" style="padding:20px 0 0 70px;" >
							<A HREF="#" onclick="zoomMenos('Imagen');">
								<IMG NAME="ZoomMenosR" SRC="img/ZoomMenosR.png" WIDTH="40" HEIGHT="24" BORDER=0 ALT="Zoom menos">
							</A>
						</TD>
						<TD align="right" style="padding:20px 70px 0 0;">
							<A HREF="#" onclick="zoomMas('Imagen');">
								<IMG NAME="ZoomMasR" SRC="img/ZoomMasR.png" WIDTH="40" HEIGHT="24" BORDER=0 ALT="Zoom mas">
							</A>
						</TD>
					</TR>

				</TABLE>
			</TD>
			<style>
				.tabla_mostrar_imagen{
					padding:10px;
					background-color:#FFFFFF;
					border: solid 1px #CCCCCC; 
					/*BORDES REDONDEADOS*/
				    -webkit-border-radius: 10px;
				    -moz-border-radius: 10px;
				    -ms-border-radius: 10px;
				    border-radius: 10px;
				    behavior: url(/<?=APP_NAME?>/view/css/pie/PIE.php);
				    /*SOMBRA BORDES */
				    box-shadow: 0 0 5px 5px #AEAEAE;
				    -webkit-box-shadow: 0 0 5px 5px #AEAEAE;
				    -moz-box-shadow:  0 0 5px 5px #AEAEAE;
				    
				}
				table.contacts
				{
				
				border: 1px solid #CCCCCC;
				border-collapse: collapse;
				border-spacing: 0;
				font-size: 16px;
				height: 135px;
				width: 265px;
				}


				td.contactDept
				{ 
				
			    behavior: url(/<?=APP_NAME?>/view/css/pie/PIE.php);
			    border: solid 1px #CCCCCC; 			
				font-family: Verdana;
				font-weight: bold;
				font-size: 14px;
				background-color: #1165AE;
				color: #FFFFFF;
				padding:3px;
				}


				td.contact
				{ border-bottom: 1px #1165AE dotted;
				text-align: left;
				font-family: Verdana, sans-serif, Arial;
				font-weight: normal;
				font-size: .7em;
				color: #404040;
				background-color: #ffffff;
				padding-top: 4px;
				padding-bottom: 4px;
				padding-left: 8px;
				padding-right: 5px; }
				
			
				
			</style>
			<TD  width="330px" style="padding-left:30px;">
				<TABLE border="0" cellspacing="0" cellpadding="0" class="contacts">
					<TR>
						<TD align="center" class="contactDept">
							<span class="etiqDatos">DATOS DE LA IMAGEN</span><BR>
						</TD>
					</TR>
					<TR>
						<TD class="contact">
							<b>Tipo (recurso):</b>&nbsp;Imagen
						</TD>
					</TR>
					<TR>
						<TD class="contact">
							<b>Fichero:</b>&nbsp;<?= $recurso->name ?>
						</TD>
					</TR>
				
					<!-- Primer nivel -->
						<? 
							$seccionesRecursos = $visit->dbBuilder->getSeccionesNavegablesFromIdPadre("3");
							
							while (list ($clave, $idsec2) = each ($seccionesRecursos)) { 
								if($rol == "A"){
									$condicion =true;
								}
								else{
									$condicion = ($idsec2->visible=="S");
								}
								if($condicion){	?>
								
								<?
								$idrecurso = $recurso->id;
								// alfredo 140927   $idov = $dict["idov"];
								$idov=$recurso->idov;
								
								$idseccion = $idsec2->id;
								$tipo = $idsec2->tipo_valores;
								if("T"==$tipo)
									$v = $visit->dbBuilder->getTextDataFromSectionResourceOV($idov,$idrecurso,$idseccion);
								else if("N"==$tipo)
									$v = (string) $visit->dbBuilder->getNumericDataFromSectionResourceOV($idov,$idrecurso,$idseccion);
								else if("C"==$tipo)
									$v = (string) $visit->dbBuilder->getControlledDataFromSectionResourceOV($idov,$idrecurso,$idseccion);
								else if("F"==$tipo)
									$v = (string) $visit->dbBuilder->getDateDataFromSectionResourceOV($idov,$idrecurso,$idseccion);
								?>
								
									<? if("X"!=$idsec2->tipo_valores&&$v!=null){	?>
									<tr>
									<td class="contact">
										<b><?= $idsec2->nombre	?>:&nbsp;</b>
											<?= $v?>
									</td>
								 </tr>
										<? } else if($visit->dbBuilder->tieneHijosConValor($idseccion,$idov)){ ?>
												<tr>
													<td class="contact">
														- <b><?= $idsec2->nombre ?>&nbsp;</b>
													</td>
											 	</tr>
										<? } ?>
							
					
							 <!-- Hijos de nodo -->
							 <?
								$seccionesRecursosN2 = $visit->dbBuilder->getSeccionesNavegablesFromIdPadre($idsec2->id);
								while (list ($clave3, $idsec3) = each ($seccionesRecursosN2)) { ?>
								<tr>	
									<?
									$idrecurso = $recurso->id;
									// alfredo  140927  $idov = $dict["idov"];
									$idov=$recurso->idov;
									
									$idseccion = $idsec3->id;
									$tipo = $idsec3->tipo_valores;
									if("T"==$tipo)
										$v = $visit->dbBuilder->getTextDataFromSectionResourceOV($idov,$idrecurso,$idseccion);
									else if("N"==$tipo)
										$v = (string) $visit->dbBuilder->getNumericDataFromSectionResourceOV($idov,$idrecurso,$idseccion);
									else if("C"==$tipo)
										$v = (string) $visit->dbBuilder->getControlledDataFromSectionResourceOV($idov,$idrecurso,$idseccion);
									?>
									<td class="contact">
										<img src="img/pc.gif" height="1px" width="20px" border="0" />
										<?// if ($v!=null ) {?>
											<? if("X"!=$idsec3->tipo_valores&&$v!=null){	?>
												<b><?= $idsec3->nombre	?>:&nbsp;</b>
												<?= $v ?>
											<? } else if($visit->dbBuilder->tieneHijosConValor($idseccion,$idov)){ ?>
												<b><?=$idsec3->nombre	?>&nbsp;</b>
											<? } ?>
									<?//}?>
									</td>
								</tr>
									<?
									$seccionesRecursosN3 = $visit->dbBuilder->getSeccionesNavegablesFromIdPadre($idsec3->id);
									while (list ($clave4, $idsec4) = each ($seccionesRecursosN3)) { ?>
									<tr>	
										<?
										$idrecurso = $recurso->id;
										
										// alfredo  140927  $idov = $dict["idov"];
										$idov=$recurso->idov;
									
										$idseccion = $idsec4->id;
										$tipo = $idsec3->tipo_valores;
										if("T"==$tipo)
											$v = $visit->dbBuilder->getTextDataFromSectionResourceOV($idov,$idrecurso,$idseccion);
										else if("N"==$tipo)
											$v = (string) $visit->dbBuilder->getNumericDataFromSectionResourceOV($idov,$idrecurso,$idseccion);
										else if("C"==$tipo)
											$v = (string) $visit->dbBuilder->getControlledDataFromSectionResourceOV($idov,$idrecurso,$idseccion);
										?>
										<td class="contact">
											<img src="img/pc.gif" height="1px" width="40px" border="0" />
											<?// if ($v!=null ) {?>
												<? if("X"!=$idsec4->tipo_valores&&$v!=null){	?>
													<b><?= $idsec4->nombre	?>:&nbsp;</b>
													<?= $v ?>
												<? } else if($visit->dbBuilder->tieneHijosConValor($idseccion,$idov)){ ?>
													<b><?= $idsec4->nombre	?>&nbsp;</b>
											<? } ?>
									<?//}?>
										</td>
									</tr>
									<? } // while ?>
								<? } // while ?>
								<?}?>
							 <? } // while ?>
				</TABLE>

			</TD>
		</TR>
			
			</TD>

		</TR>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<TR>
			<TD colspan="2" align="center" style="margin-top:10px;">	
				<img src="./img/pc.gif" height="20px"/>
				<A HREF="javascript:window.close();">
					<IMG SRC="./img/btn_cerrar.png" WIDTH="71" HEIGHT="22" BORDER=0 ALT="Cerrar la ventana">
				</A>
			</TD>
		</TR>
	</TABLE>
<? include_once(dirname(__FILE__)."/bottom_simple.php"); ?>