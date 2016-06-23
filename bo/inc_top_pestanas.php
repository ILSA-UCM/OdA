
<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<? $valores = $visit->options->getIdiomas();?>
		<td align="left" valign="top" >
			<BR>
			<table cellspacing="0" cellpadding="0"  >
				<!-- cabecera -->
				<!--  -->
				<tr>
					<td align="left" valign="top" >
						<table width="100%" cellspacing="2" cellpadding="0"  >
							<tr>
								<? while (list($k,$v)=each($valores)) { ?>
								<td  align="left" valign="top" width="80" style="border:1px solid #e6e6e6;">
								<IMG SRC="img/pc.gif" WIDTH="80" HEIGHT="1" BORDER="0" ALT=""><BR>
									
									
									<TABLE>
										<TR>
											<TD>
										
											<IMG SRC="../img/ico_bandera_<?= $k ?>.gif" WIDTH="19" HEIGHT="12" BORDER="0" ALT="ES">
											
											
											
											</TD>
											<TD>
											
											<? if ($lang==$k){ ?>
												<A class="submenulinkover" HREF="<?= $visit->util->construyeUrlMenosMas("",$visit->util->getRequest(),"lang","lang=".$k)?>"  >
												<B><U><?= $v?></U></B></A>
											<? }else{?>
												<A class="submenulink" HREF="<?= $visit->util->construyeUrlMenosMas("",$visit->util->getRequest(),"lang","lang=".$k)?>" onclick="
												var ir=false;
												if (revisarForm()) ir=true;
												else if (confirm('<?=utf8_encode("Ha modificado datos ¿Seguro que desea cambiar de idioma sin guardar?")?>')) ir=true;
												<? if ($k!="es" && $id=="") {?>
													alert('<?=utf8_encode("Debe guardar antes el recurso en el idioma Español")?>');
													return false;
												<? } ?>
												event.returnValue=ir;
												return ir;
												">
												<?= $v?>
											<? } ?>
											</A>
											</TD>
										</TR>
									</TABLE>
								</td>
								<? } ?>
								<td width="100%"></td>
							</tr>
						</table>
					</td>
					
				</tr> 
				<tr>
					
					<td  valign="top" style="padding:6px;padding-top:4px; border:1px solid #e6e6e6;">						
						
						