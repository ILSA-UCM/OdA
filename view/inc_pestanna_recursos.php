<? 
//$dict = $visit->util->getRequest(); 
//********************************************
// 140727 alfredo RECURSOS AJENOS, para tener en cuenta que ahora en idresource_refered se guarda el id del recurso referenciado 
// (antes el id del ov referenciado) se cambia $recurso->idresource_refered por $recurso->idov_refered 
//********************************************

if($visit->util->esSuperAdmin()){
	$recursos = $visit->dbBuilder->getRecursosFromOV($dict["idov"]);
}
else{ 
	$recursos = $visit->dbBuilder->getRecursosVisiblesFromOV($dict["idov"]);
}
 
?>	
<? if($seleccion == "1"){ $anchopestanna = "940px";}
	else{ $anchopestanna ="800px";}?>
	
<div class="cajadatos" style="width:<?=$anchopestanna?>;">				
<? if($recursos[0]==NULL){ ?>
		<div class="texto_sinValor">El Objeto Digital <?=$id?> no tiene recursos asociados.</div>
<? }  else { ?>
	<? foreach ($recursos as $clave => $recurso){ ?>	
	
	<? //var_dump($recurso)."<br>"; ?>
	
	<? // ********************************************************************************************alfredo 140810 ?>
		<? if ($recurso->id!="") {
											$idsreferedR = $visit->dbBuilder->getFromReferedFromIdOV($recurso->id);
											$stringidsR = "";
											for ($i=0;$i<count($idsreferedR);$i++) { 
													if($idsreferedR[$i]->idov!="")
													$stringidsR .= $idsreferedR[$i]->idov.", ";
											}
											$stringidsR = substr($stringidsR,0,-2);
											}
											//if($stringidsR!="") echo("Recurso referenciado desde el OD: ".$stringidsR."   ");?>
		
		
	<div class="recurso_elem">
		<div class="recurso_pestana_sup">
			<div class="tipo_recurso"><?= $recurso->getValorType() ?>
			</div>
			
			<? if($recurso->idresource_refered!=""){ // alfredo 140727 ?>
				&nbsp;
				
					<!-- <div class="cabecera_titulo_rec"> -> Recurso del objeto:</div> 
					<div class="cabecera_texto_rec"> <?=$recurso->idov_refered //alfredo 140727 ?></div>-->
				    <div class="cabecera_texto_rec"><?echo("Pertenece al OD: ".$recurso->idov_refered." ");//alfredo 140810 ?></div>
				
			<? // } else if($recurso->idov_refered!="") { ?>
			<?} else if($stringidsR!="" && $rol!="") {?>
			<div class="cabecera_texto_rec"><?echo("Referenciado desde OD: ".$stringidsR." ");//alfredo 140810 ?></div>
			<? } else { ?>
				&nbsp;&nbsp;
				<div class="cabecera_texto_rec"><?=$recurso->idov_refered?></div>
			<? } ?>	
			
		<div class="clearfix"></div>
		</div>	
			
		<div class="recurso_pestana_inferior">
			<div class="recurso_bloque_hijo">
			<!-- Primer nivel -->
			
			<? if($recurso->name != ""){?>
				<div class="linea_dato_recurso clearfix">
					<span class="cabecera_titulo_nivel2">Nombre del recurso: &nbsp;</span>
					<?if($recurso->getValorType()=="Recurso URL"){?>
						<?
							$url = $recurso->name;
							$url_protocol = substr($url, 0, 4);
							if(strtolower($url_protocol)!="http"){
								$url = "http://".$url;
							}
						?>
						<span class="cabecera_texto_nivel1"><a target="_blank" href="<?=$url ?>"><?=$recurso->name ?></a> </span>
					<?}else{?>
					<span class="cabecera_texto_nivel1"><?=$recurso->name ?></span>
					<?}?>
					<div class="clearfix"></div>
				</div>
			<? }?>
			<? if($rol == "A"){
				$seccionesRecursos = $visit->dbBuilder->getSeccionesNavegablesFromIdPadre("3");
			}
			else {
				$seccionesRecursos = $visit->dbBuilder->getSeccionesNavegablesFromIdPadreVisibles("3");
			}
			while (list ($clave, $idsec2) = each ($seccionesRecursos)) { ?>	
			<?
				$caminoItemsStr = $visit->util->obtenerCaminoCategoriaStr($dictFilas, "", $idsec2->id);
				$caminoItems =  substr( $caminoItemsStr, 1, strlen($caminoItemsStr)-2);
				$caminoItems =  split(";",$caminoItems);
				$ancho=18*(count($caminoItems)-2);
			?>

			<? if(true/*$idsec2->visible =="S" */){
				$idrecurso = $recurso->id;
				$idov = $dict["idov"];
				
				$idseccion = $idsec2->id;
				$tipo = $idsec2->tipo_valores;
				if("T"==$tipo)
					$v = $visit->dbBuilder->getTextDataFromSectionResourceOV($idov,$idrecurso,$idseccion);
				else if("N"==$tipo){ //alfredo 140129
					$v = $visit->dbBuilder->getNumericDataFromSectionResourceOV($idov,$idrecurso,$idseccion);
					//var_dump($v);
					if($v!=null&&$v!="") {
						$decimales = $visit->dbBuilder->getCantidadDecimales($idsec2->id);
						//var_dump($decimales);
						$v = round($v, $decimales);
						//var_dump($v);
						}
					}
				else if("C"==$tipo)
					$v = (string) $visit->dbBuilder->getControlledDataFromSectionResourceOV($idov,$idrecurso,$idseccion);
				else if("F"==$tipo){ //alfredo
					$v = (string) $visit->dbBuilder->getDateDataFromSectionResourceOV($idov,$idrecurso,$idseccion);
					$v = $visit->util->bbdd2date($v);
					}
				?>
				<? if("X"!=$tipo&&$v!=null&&$v!=""){?>
					<div class="linea_dato_recurso clearfix">
						<span class="cabecera_titulo_nivel2"><?= $idsec2->nombre?>:&nbsp;</span>
						<span class="cabecera_texto_nivel1"><?=$v?> </span>
						<div class=clearfix"></div>
					</div>
				<? } else if($visit->dbBuilder->tieneHijosConValorSimple($idseccion,$idov,$idrecurso)){ ?>
					<div class="linea_dato_recurso clearfix">
					<? if ($v!=""||"X"==$idsec2->tipo_valores){//alfredo 140127?> 
						<span class="cabecera_titulo_nivel2"><?= $idsec2->nombre?>:&nbsp;</span>
						<?} //alfredo?>
						<div class=clearfix"></div>
					</div>
				<? } ?>
					
	
				 <!-- Hijos de nodo -->
				 <?
					$seccionesRecursosN2 = $visit->dbBuilder->getSeccionesNavegablesFromIdPadre($idsec2->id);
					while (list ($clave3, $idsec3) = each ($seccionesRecursosN2)) { ?>
						<?
							$caminoItemsStr = $visit->util->obtenerCaminoCategoriaStr($dictFilas, "", $idsec3->id);
							$caminoItems =  substr( $caminoItemsStr, 1, strlen($caminoItemsStr)-2);
							$caminoItems =  split(";",$caminoItems);
							$ancho=18*(count($caminoItems)-2);
						?>
						<?
						$idrecurso = $recurso->id;
						$idov = $dict["idov"];
						$idseccion = $idsec3->id;
						$tipo = $idsec3->tipo_valores;
						if("T"==$tipo)
							$v = $visit->dbBuilder->getTextDataFromSectionResourceOV($idov,$idrecurso,$idseccion);
						else if("N"==$tipo){ //alfredo 140129
							$v = $visit->dbBuilder->getNumericDataFromSectionResourceOV($idov,$idrecurso,$idseccion);
							//var_dump($v);
							if($v!=null&&$v!="") {
								$decimales = $visit->dbBuilder->getCantidadDecimales($idsec3->id);
								//var_dump($decimales);
								$v = round($v, $decimales);
								//var_dump($v);
								}
							}	
						else if("C"==$tipo)
							$v = (string) $visit->dbBuilder->getControlledDataFromSectionResourceOV($idov,$idrecurso,$idseccion);
						else if("F"==$tipo){ //alfredo
								$v = (string) $visit->dbBuilder->getDateDataFromSectionResourceOV($idov,$idrecurso,$idseccion);
								$v = $visit->util->bbdd2date($v);
								}
						?>
						<div class="linea_dato_recurso clearfix">
							<?// if ($v!=null ) {?>
								<? if("X"!=$idsec3->tipo_valores&&$v!=null&&$v!=""){	?>
									<IMG SRC="../img/pc.gif" WIDTH="<?= $ancho ?>" HEIGHT="1" BORDER="0" ALT="" style="float:left;">
									<span class="cabecera_titulo_nivel2">
										<?= $idsec3->nombre	?>:&nbsp;
									</span>
									<span class="cabecera_texto_nivel1"><?= $v ?></span>
								<? } else if($visit->dbBuilder->tieneHijosConValorSimple($idseccion,$idov,$idrecurso)){ ?>
									<IMG SRC="../img/pc.gif" WIDTH="<?= $ancho ?>" HEIGHT="1" BORDER="0" ALT="" style="float:left;">
									<span class="cabecera_titulo_nivel2">
									<? if ($v!=""||"X"==$idsec3->tipo_valores){//alfredo 140127?>
										<span class="cabecera_titulo_nivel2"><?= $idsec3->nombre?>&nbsp;</span>
										<?} //alfredo?>
									</span>
								<? } ?>
							<?//}?>
						</div>
						<?
						$seccionesRecursosN3 = $visit->dbBuilder->getSeccionesNavegablesFromIdPadre($idsec3->id);
						while (list ($clave4, $idsec4) = each ($seccionesRecursosN3)) { ?>
							<?
								$caminoItemsStr = $visit->util->obtenerCaminoCategoriaStr($dictFilas, "", $idsec4->id);
								$caminoItems =  substr( $caminoItemsStr, 1, strlen($caminoItemsStr)-2);
								$caminoItems =  split(";",$caminoItems);
								$ancho=18*(count($caminoItems)-2);
							?>
							<? 
							$idrecurso = $recurso->id;
							$idov = $dict["idov"];
							$idseccion = $idsec4->id;
							$tipo = $idsec4->tipo_valores; ///alfredo cambia 3 por 4
							if("T"==$tipo)
								$v = $visit->dbBuilder->getTextDataFromSectionResourceOV($idov,$idrecurso,$idseccion);
							else if("N"==$tipo){ //alfredo 140129
								$v = $visit->dbBuilder->getNumericDataFromSectionResourceOV($idov,$idrecurso,$idseccion);
								//var_dump($v);
								if($v!=null&&$v!="") {
									$decimales = $visit->dbBuilder->getCantidadDecimales($idsec4->id);
									//var_dump($decimales);
									$v = round($v, $decimales);
									//var_dump($v);
									}
								}		
							else if("C"==$tipo)
								$v = (string) $visit->dbBuilder->getControlledDataFromSectionResourceOV($idov,$idrecurso,$idseccion);
							else if("F"==$tipo){// alfredo
								$v = (string) $visit->dbBuilder->getDateDataFromSectionResourceOV($idov,$idrecurso,$idseccion);
								$v = $visit->util->bbdd2date($v);
								}
							?>	
							<div class="linea_dato_recurso clearfix">
								<IMG SRC="../img/pc.gif" WIDTH="<?= $ancho ?>" HEIGHT="1" BORDER="0" ALT="" style="float:left;">
								<?// if ($v!=null ) {?>
									<? if("X"!=$idsec4->tipo_valores&&$v!=null&&$v!=""){	?>
										<span class="cabecera_titulo_nivel2"><?= $idsec4->nombre	?>:&nbsp;</span>
										<span class="cabecera_texto_nivel1"><?= $v ?></span>
									<? } else if($visit->dbBuilder->tieneHijosConValorSimple($idseccion,$idov,$idrecurso)){ ?>
										<span class="cabecera_titulo_nivel2">- <?= $idsec4->nombre?>&nbsp;</span>
								<? } ?>
							</div>
						<? } // while ?>
					<? } // while ?>
				
			<? } //IF?> 
		<? } ?> <!-- FIN DE LOS RECURSOS HIJO -->
				
				</div>
				 <!-- IMAGEN DEL RECURSO -->
					
					<? if ($recurso->name!="OV") {
							if ($recurso->type=="P" ) {
								if ($visit->util->esImagen($recurso->name)) { ?>
								<div class="imagen_recurso">
									<a href="#" onclick='window.open("mostrar_imagen.php?idrecurso=<?=$recurso->id?>&idov=<?=$recurso->idov?>","","width=1000,height=700,scrollbars=yes"); return false;'>
											<?if (file_exists("../bo/download/".$ov->id."/".$recurso->name)){ ?>
												<img src="../bo/download/<?=$ov->id?>/<?=$recurso->name?>" width="75px"  border="0">		
											<? }else{?>
												<img src="/<?=APP_NAME?>/view/img/ico_ov.gif" width="75px" height="75" border="0">
											<? }?>
									</a>
								</div>
								<? } else if (substr($recurso->name,strlen($recurso->name)-4, strlen($recurso->name))==".pdf"){ ?>
									<div class="imagen_recurso">
										<a href="../bo/download/<?=$ov->id?>/<?=$recurso->name?>" target="_blank">
											<IMG SRC='img/icon_pdf.gif' WIDTH="40" HEIGHT="40" BORDER="0" ALT="">
										</a>
									</div>
									<? } else if ((substr($recurso->name,strlen($recurso->name)-4, strlen($recurso->name))==".htm")||
								                  (substr($recurso->name,strlen($recurso->name)-5, strlen($recurso->name))==".html")){ // alfredo 140719?>
								<div class="imagen_recurso">
									<a href="../bo/download/<?=$ov->id?>/<?=$recurso->name?>" target="_blank">
											<IMG SRC='img/ico_html.png' WIDTH="40" HEIGHT="40" BORDER="0" ALT=""></a>
								</div>
								<? } else if ((substr($recurso->name,strlen($recurso->name)-4, strlen($recurso->name))==".doc")||
								              (substr($recurso->name,strlen($recurso->name)-5, strlen($recurso->name))==".docx")){ //alfredo 140127?>
									<div class="imagen_recurso">
										<a href="../bo/download/<?=$ov->id?>/<?=$recurso->name?>" target="_blank"><IMG SRC='img/icon_word.gif' WIDTH="40" HEIGHT="40" BORDER="0" ALT=""></a>
									</div>
								<? } else { ?>
									<div class="imagen_recurso">
										<a href="../bo/download/<?=$ov->id?>/<?=$recurso->name?>" target="_blank"><IMG SRC='img/icon_text.gif' WIDTH="30" HEIGHT="40" BORDER="0" ALT=""></a>
									</div>
								<? } ?>		
					<? } else if ($recurso->type=="F"){
						if ($visit->util->esImagen($recurso->name)) { ?>
							<a href="#" onclick='window.open("mostrar_imagen.php?idrecurso=<?=$recurso->id?>&idov=<?=$recurso->idov_refered // alfredo 140727?>","","width=1000,height=700,scrollbars=yes"); return false;'>
								<div class="imagen_recurso">
								<?if (file_exists("../bo/download/".$recurso->idov_refered."/".$recurso->name)){ // alfredo 140727 ?>
										<IMG SRC='../bo/download/<?=$recurso->idov_refered // alfredo 140727 ?>/<?=$recurso->name?>' WIDTH="75" BORDER="0" ALT="">
								<? }else{?>
										<img src="/<?=APP_NAME?>/view/img/ico_ov.gif" width="75px" height="75" border="0">
								<? }?>
									
								</div>
							</a>
							<? } else if (substr($recurso->name,strlen($recurso->name)-4, strlen($recurso->name))==".pdf"){ ?>
								<div class="imagen_recurso">
									<a href="../bo/download/<?=$recurso->idov_refered // alfredo 140727 ?>/<?=$recurso->name?>" target="_blank"><IMG SRC='img/icon_pdf.gif' WIDTH="40" HEIGHT="40" BORDER="0" ALT=""></a>
								</div>
							<? } else if ((substr($recurso->name,strlen($recurso->name)-4, strlen($recurso->name))==".htm")||
								          (substr($recurso->name,strlen($recurso->name)-5, strlen($recurso->name))==".html")){ //alfredo 140719 ?>
								<div class="imagen_recurso">
									<a href="../bo/download/<?=$recurso->idov_refered // alfredo 140727 ?>/<?=$recurso->name?>" target="_blank"><IMG SRC='img/ico_html.png' WIDTH="40" HEIGHT="40" BORDER="0" ALT=""></a>
								</div>
							<? } else if ((substr($recurso->name,strlen($recurso->name)-4, strlen($recurso->name))==".doc")||
							              (substr($recurso->name,strlen($recurso->name)-5, strlen($recurso->name))==".docx")){ //alfredo 140127 ?>
								<div class="imagen_recurso">
									<a href="../bo/download/<?=$recurso->idov_refered // alfredo 140727 ?>/<?=$recurso->name?>" target="_blank"><IMG SRC='img/icon_word.gif' WIDTH="40" HEIGHT="40" BORDER="0" ALT=""></a>
								</div>
							<? } else { ?>
								<div class="imagen_recurso">
									<a href="../bo/download/<?=$recurso->idov_refered //alfredo 140727 ?>/<?=$recurso->name?>" target="_blank">
									<IMG SRC='img/icon_tex.gif' WIDTH="30" HEIGHT="40" BORDER="0" ALT=""></a>
								</div>
							<? } ?>
						<? }else if ($recurso->type=="H"){ ?>
								<div class="imagen_recurso">
									<a href="#" onclick='window.open("/<?=APP_NAME?>/bo/download/<?=$recurso->idov?>/<?=$recurso->name?>","","width=1000,height=700,scrollbars=yes"); return false;'>
										<IMG SRC='/<?=APP_NAME?>/view/img/ico_html.png' WIDTH="45"  height="45" BORDER="0" ALT="">
									</a>
									</div>
						<? }else if ($recurso->type=="U"){ ?>
								<div class="imagen_recurso">
									<?
										$url = $recurso->name;
										$url_protocol = substr($url, 0, 4);
										if(strtolower($url_protocol)!="http"){
											$url = "http://".$url;
										}
									?>
									<a href="#" onclick='window.open("<?=$url?>"); return false;'>
										<IMG SRC='/<?=APP_NAME?>/view/img/html_ico.png' WIDTH="45"  height="45" BORDER="0" ALT="">
									</a>
									</div>			
								
							
						<? } else { ?>
								
								<div class="imagen_recurso">
									<a href="#"  onclick='window.open("cm_view_virtual_object.php?idov=<?=  $recurso->idov_refered ?>&seleccion=1","","width=1000,height=700,scrollbars=yes"); return false;'>
										<? 
											$iconoOV= $visit->dbBuilder->getIconoFromOV($recurso->idov_refered); 
											//var_dump($iconoOV);
											if($iconoOV->idov_refered !=""){//alfredo 140728
												$rutaiconoOV ="../bo/download/".$iconoOV->idov_refered."/".$iconoOV->name;//alfredo 140728
											}
											else{
												$rutaiconoOV = "../bo/download/".$recurso->idov_refered."/".$iconoOV->name;
												//var_dump($rutaiconoOV);
												if($iconoOV=="")
													$rutaiconoOV = "../img/ico_ov.gif"; 
											}
										?>
										<? //var_dump($rutaiconoOV);?>
								<?if ( file_exists($rutaiconoOV) ){ ?>
												<IMG SRC='<?=$rutaiconoOV?>' WIDTH="75" BORDER="0" ALT="">
								<? }else{?>
										<img src="/<?=APP_NAME?>/view/img/ico_ov.gif" width="75px" height="75" border="0">
								<? }?>
									</a>	
									</div>
								
							<? } ?>
						<? } ?> 		
				
				<div class="clearfix"></div>
				</div>
	</div>	
	
		<? } ?> <!-- FIN DE UN OBJETO -->
	<? } ?>
</div>
