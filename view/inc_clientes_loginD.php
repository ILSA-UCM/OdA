<table cellpadding="0" cellspacing="0">
	<tr><td style="text-align:center; background:url(img/fondo_destacados.gif) no-repeat right top;background-color:#e5d2aa;border-left:1px solid <?=$bloque_borde?>;border-bottom:0px solid <?=$bloque_borde?>;border-right:1px solid <?=$bloque_borde?>;">
		<table width="100%" border="0" cellpadding="0" cellspacing="0"> 		
			<tr>			
				<td class="bloquetitulo" colspan="2">Cliente Registrado</td>
			</tr>
		</table>
	<tr><td class ="loginmarco" align="center">
	<? if ($visit->options->cliente->id!=""){ ?>		
		<table border="0" cellpadding="0" cellspacing="0"> 		
				<tr>
					<td class="login"><?= $visit->options->cliente->nombre. " ". $visit->options->cliente->apellidos?>&nbsp;&nbsp;<span style="font-size:9px;">&gt;&gt;</span></td>
					<td class="login"><IMG SRC="<?= $_parenDir ?>img/ico_perfil.gif" WIDTH="6" HEIGHT="9" BORDER="0" ALT=""></td>
					<td class="login"><A HREF="clientes/perfil_clientes.php?lang=<?= $lang?>" class="loginnavover"><B><?= trad("tit_mi_perfil")?></B></A>&nbsp;&nbsp;</td>
					<td class="login"><IMG SRC="<?= $_parenDir ?>img/ico_pedidos.gif" WIDTH="7" HEIGHT="9" BORDER="0" ALT=""></td>
					<td class="login"><A HREF="pedidos/pedidos_cliente.php?lang=<?= $lang?>"  class="loginnavover"><B><?= trad("tit_mis_pedidos")?></B></A>&nbsp;&nbsp;</td>
					<td class="login"><A HREF="clientes/do.php?op=logout&referer=<?=  $visit->util->getUrlQueryTotal("",$visit->util->getQueryString()) ?>"  class="loginnavover"><B><?= trad("tit_salir")?></B></A></td>			
				
										
				</tr>
			</table>
	<? }else{?>
		<FORM METHOD=POST name="form_acceso" ACTION="clientes/do.php"  onsubmdit="return compruebaCamposLogin()" style="display:inline;">

		<INPUT TYPE="hidden" name ="op" value="login">
		<INPUT TYPE="hidden" name ="lang" value="<?= $lang?>">
		<input type="hidden" name="referer" value="<?=  $visit->util->getUrlQueryTotal("",$visit->util->getQueryString()) ?>">
		<input type="hidden" name="pag" value="<?=  $SCRIPT_NAME ?>">
			<table border="0" cellpadding="0" cellspacing="0" id="id_registrado"> 		
				<tr>			
					<td class="login">:: <a href="<?= $_parenDir ?>clientes/registro_clientes.php?lang=<?= $lang?>" class="loginnav"><B><?= trad("accion_registrarse") ?></B></a></td>
				</tr>
				<tr>
					<td class="login">:: <a href="#" onclick="
						toggleOcultacion('id_loginD'); 
						toggleOcultacion('id_registrado'); 
						var nodo = getElement('id_loginD');
						if (this.className=='loginnavover') {							
							this.className='loginnav';
						} else {
							this.className='loginnavover';
						}
						return false;
						"  class="loginnav"><B><?= trad("tit_bloque_cliente_registrado") ?></B></a></td>
				</tr>
				</table>
				<table border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td>
						<!-- OCULTAR -->
						<table border="0" cellpadding="0" cellspacing="0" id="id_loginD" style="display:none;"> 		
							<tr>
								<td class="login"><?= trad("epigrafe_correo") ?></td>
							</tr>
							<tr>
								<td class="login"><input type="text" name="correo" class="loginpassword" style="border:1px solid #deb90e;"></td>
							</tr>
							<tr>				
								<td class="login"><?= trad("epigrafe_clave") ?></td>
							</tr>
							<tr>
								<td class="login"><input type="password" name="clave" class="loginpassword" style="border:1px solid #deb90e;"></td>
							</tr>
							<tr>		
								<td class="login" align="right"><br><INPUT TYPE="image" src="img/boton_entrar.gif" width="50" height="16" border="0" alt=""></td>
							</tr>
							<tr>	
								<td class="login" align="right"><a href="<?= $_parenDir ?>clientes/recordar_contrasenia.php?lang=<?= $lang?>" class="loginnavover"><?= trad("accion_recordar_clave") ?></a></td>
							</tr>
						</table>	
						<!-- OCULTAR -->
					</td>	
					<? if (($prefs["suscripcioncatalogo"]=="1") & ($prefs["suscripcioncatalogo_cab"]=="1") ){ ?>	
					<td class="login">:: <a href="<?= $_parenDir ?>solicitudes/form_solicitudes_catalogo.php?lang=<?= $lang?>" class="loginnav"><B><?= trad("form_solicitud_tit_enlace")?></B></a></td>
					<? } ?>	

					<? if (($prefs["suscripcionnewsletter"]=="1") && ($prefs["suscripcionnewsletter_cab"]=="1")){ ?>	
					<td class="login">:: <a href="<?= $_parenDir ?>solicitudes/form_suscripcion_boletin.php?lang=<?= $lang?>" class="loginnav"><B><?= trad("form_suscripcion_tit_enlace")?></B></a></td>
					<? } ?>
				</tr>
			</table>
		</FORM>
	<? } ?>
</td></tr>
</table>

	
