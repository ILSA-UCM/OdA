<?
	$pajar = $_SERVER["PHP_SELF"];
	$aguja = "/paginas/";
	$otroNivel = false;
	if($visit->util->strripos($pajar,$aguja))
		$otroNivel = true;
?>

<? if ( (isset($_SESSION['authenticated'])) && ($_SESSION['authenticated']== APP_NAME.$_SESSION["idusuario"])&&($_SESSION["idusuario"]!="") ){ ?>		

			<table border="0" cellpadding="0" cellspacing="0"> 		
					<tr>
						<td class="login">
							<?= $visit->options->usuario->nombre. " ". $visit->options->usuario->apellidos?>&nbsp;&nbsp;<span style="font-size:9px;">&gt;&gt;</span>
						</td>
						<td class="login">
							<a href="<?=$_parenDir?>view/do.php?op=logout">
								<img src="<?=$_parenDir?>img/boton_salir.gif" width="50" height="16" border="0" alt="logout">
							</a>
							<!-- <IMG SRC="<?= $_parenDir ?>img/ico_perfil.gif" WIDTH="6" HEIGHT="9" BORDER="0" ALT=""> -->
	
						</td>
						<!-- <td class="login"><A HREF="clientes/perfil_clientes.php?lang=<?= $lang?>" class="loginnavover"><B><?= trad("tit_mi_perfil")?></B></A>&nbsp;&nbsp;</td> -->
						<td class="login">
							<A HREF="do.php?op=logout&referer=<?=  $visit->util->getUrlQueryTotal("",$visit->util->getQueryString()) ?>"  class="loginnavover"><B><?= trad("tit_salir")?></B></A>
						</td>			
					</tr>
			</table>

	<? }else{?>

		<FORM METHOD=POST name="form_acceso" <? if($otroNivel){ ?> ACTION="../do.php" <? } else { ?> ACTION="do.php" <? } ?> onsubmit="" style="display:inline;">

		<INPUT TYPE="hidden" name ="op" value="login">
		<INPUT TYPE="hidden" name ="lang" value="<?= $lang?>">
		<input type="hidden" name="referer" value="<?=  $visit->util->getUrlQueryTotal("",$visit->util->getQueryString()) ?>">
		<input type="hidden" name="pag" value="<?=  $SCRIPT_NAME ?>">
			<table border="0" cellpadding="0" cellspacing="0"> 		
				<tr>			
					<!-- <td class="login">:: <a href="registro_clientes.php?lang=<?= $lang?>" class="loginnav"><B><?= trad("accion_registrarse") ?></B></a></td>	 -->
					<td class="login">:: <a href="#" onclick="
						toggleOcultacion('id_login'); 
						var nodo = getElement('id_login');
						if (this.className=='loginnavover') {							
							this.className='loginnav';
						} else {
							this.className='loginnavover';
						}
						return false;
						"  class="loginnav"><B>Usuarios registrados</B></a></td>	
					</tr>
					<tr>				
					<td>
						<!-- OCULTAR -->
						<table border="0" cellpadding="0" cellspacing="0" id="id_login" style="display:none; margin-top:5px; "> 		
							<tr>
								<td class="login">&nbsp;</td>
								<td class="login"><input type="text" name="login" class="loginpassword" style="border:1px solid #deb90e;"></td>						
								<td class="login"><?= trad("epigrafe_clave") ?></td>
								<td class="login"><input type="password" name="password" class="loginpassword" style="border:1px solid #deb90e;"></td>				
								<td class="login">
									<? if($otroNivel){ ?> 
										<INPUT TYPE="image" src="../img/boton_entrar.gif" width="50" height="16" border="0" alt="">
									<? } else { ?> 
										<INPUT TYPE="image" src="img/boton_entrar.gif" width="50" height="16" border="0" alt="">
									<? } ?>									
								</td>
								<!-- <td class="login"><a href="<?= $_parenDir ?>recordar_contrasenia.php?lang=<?= $lang?>" class="loginnavover"><?= trad("accion_recordar_clave") ?></a></td> -->
							</tr>
						</table>	
						<!-- OCULTAR -->
					</td>	
					
				</tr>
			</table>
		</FORM>

	<? } ?>