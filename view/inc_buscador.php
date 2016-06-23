
<SCRIPT>
	
	function compruebaCamposBusqueda() {
		var vall = document.form_busqueda;
		var nombre ="q";
		if ( esVacio(getValor(vall[ nombre ]))){
	
			alert ("<?=utf8_encode("Debe especificar un parámetro de búsqueda")?>");
			return false;
		}else{
			return true;
		}
			
	}
	
</SCRIPT>
<FORM  method="GET" name="form_busqueda" action="catalogo/ls_catalogo.php" onsubmit="
														if (compruebaCamposBusqueda()){ 
															document.form_busqueda.submit();
														}
														event.returnValue=false;
														return false;">
	<INPUT TYPE="hidden" NAME="lang" VALUE="<?= $lang?>">
	<TABLE  width="<?= $prefs["tam_ancho_interior_izda"] ?>" cellpadding="0" cellspacing="0" border="0" >
		<TR>
			<TD style="height:18; background:#5168B8">
			&nbsp;</TD>
		</TR>
	</TABLE>
	<TABLE  width="<?= $prefs["tam_ancho_interior_izda"] ?>" cellpadding="0" cellspacing="0" border="0">
			<TR>
				<!--  class="destacadolateralimagen"  -->
				<TD style="text-align:center; background-color:#FAF9E5;border-left:1px solid <?=$bloque_borde?>;border-bottom:1px solid <?=$bloque_borde?>;border-right:1px solid <?=$bloque_borde?>;">
					<table width="100%" border="0" cellpadding="0" cellspacing="0"> 		
						<tr>			
							<td class="bloquetitulo" colspan="2"><?= trad("bloque_buscador")?></td>
						</tr>
					</table>
					<table width="100%" border="0" cellpadding="0" cellspacing="0" class="bloqueinterior"> 
						<tr>			
							<td class="bloqueinteriortexto" colspan="2">
								<? $valores = $visit->dbBuilder->getSeccionesCatalogoSuperior();?>
								<select name="seccionp" class="buscador">
									<option value="">En toda la web
									<? for($i=0;$i<count( $valores);$i++){ ?>
										<option value="<?= $valores[$i]->id?>" <? if ($seccionp==$valores[$i]->id) print 'selected'?>><?= $valores[$i]->nombre?>
									<? } ?>
								</select>							
							</td>							
						</tr>
						<tr>
							<td  class="bloqueinteriortexto" style="padding-bottom:4px;"><input type="text" name="q" value="<?= $q?>" class="buscador"></td>	
							<td  class="bloqueinteriortexto" style="padding-bottom:4px;"><img src="upload/ico_buscar.gif" width="26" height="20" border="0" alt=""  onclick="
																		if (compruebaCamposBusqueda()){ 
																			document.form_busqueda.submit();
																		}
																		event.returnValue=false;
																		return false;"></td>
						</tr>										
					</table>				
				</TD>
			</TR>
		</TABLE>	
</form>
<img src="<?= $_parenDir ?>view/img/pc.gif" width="1" height="8" border="0" alt=""><br>

