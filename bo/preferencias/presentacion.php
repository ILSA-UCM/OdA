<?
include_once(getcwd()."/include.php");
$titulopaginabo="Presentación";
$explicaciontitulopaginabo="Presentación de los menús de navegación";
$visit->options->seccion = "Preferencias";
$visit->options->subseccion = "Presentacion";
if (!$visit->options->tieneAcceso("form",$fila)) $visit->options->sinAcceso();
include_once(getcwd()."/bo_top.php");
$arrGrupos=array();

$mensajes = new ClsMensajes();
$mensajes->lang= $lang;
$mensajes->tipo= "cabecera";
$filas = $visit->dbBuilder->getTablaFiltrada($mensajes);
$count_filas = count($filas);
for ($i=0;$i<count($filas);$i++) {
	$arrGrupos[$filas[$i]->grupo][]=$filas[$i];
}
ksort($arrGrupos);
$grupos = array_keys($arrGrupos);
$count_grupos = count($grupos);

$preferencias = $visit->dbBuilder->getPreferenciaFromTipo("F");
?>
<script>
 function showColor(item) {
		var color = item.value;
		var nombre = item.id;
        document.getElementById(nombre).style.backgroundColor = color;
    }
</script>
<?
	$preferencia = $visit->dbBuilder->getPreferenciaFromAtributo("secciones_plegado");
	if (!$preferencia ) $preferencia = new ClsPreferenciasPresentacion();

	$preferencia2 = $visit->dbBuilder->getPreferenciaFromAtributo("recursos_plegado");
	if (!$preferencia2 ) $preferencia2 = new ClsPreferenciasPresentacion();
?>
<FORM METHOD=POST ACTION="do.php" name="formValor">
	<INPUT TYPE="hidden" NAME="op" value="modificar_preferencias_secciones">
	<INPUT TYPE="hidden" NAME="atributo" value="secciones_plegado">
	<INPUT TYPE="hidden" NAME="tipo" value="C">
	<INPUT TYPE="hidden" NAME="id" value="<?= $preferencia->id?>">
	<INPUT TYPE="hidden" NAME="valor" value="">
	<TABLE  border="0" width="100%" cellpadding="0" cellspacing="0" style="border:1px solid #d0d0d0;">
		<TR>
			<TD width="50%" height="24" align="left"  class="buscador">
				<B>Presentación de la clasificación de la Base de Datos:</B>
			</TD>
			<TD class="buscador">
			<? $valores = $preferencia->getValoresPresentacionSecciones(); ?>
			<select NAME="v" onchange="document.formValor.valor.value = this.value; document.formValor.submit();">
				<option value="">Seleccionar presentación de navegación
				<? while (list ($clave, $val) = each ($valores)) { ?>
					<option value="<?= $clave?>" <? if ($preferencia->valor==$clave) print 'selected'?>><?= $val?>
				<? } ?>	
			</TD>
		</TR>
	</TABLE>
	<br/>
	<TABLE  border="0" width="100%" cellpadding="0" cellspacing="0" style="border:1px solid #d0d0d0;">
		<TR>
			<TD width="50%" height="24" align="left"  class="buscador">
				<B>Presentación de los recursos del objeto:</B>
			</TD>
			<script>
				function cambiarHiddensRecursos(){
					document.formValor.op.value = "modificar_preferencias_recursos";
					document.formValor.atributo.value = "recursos_plegado";
					document.formValor.tipo.value = "C";
					document.formValor.id.value = "<?=$preferencia2->id?>";
				}
			</script>
			<TD  class="buscador">
			<? $valores2 = $preferencia2->getValoresPresentacionRecursos(); ?>
			<select NAME="v2" onchange="document.formValor.valor.value = this.value;cambiarHiddensRecursos();document.formValor.submit();">
				<option value="">Seleccionar presentación de navegación
				<? while (list ($clave2, $val2) = each ($valores2)) { ?>
					<option value="<?= $clave2?>" <? if ($preferencia2->valor==$clave2) print 'selected'?>><?= $val2?>
				<? } ?>	
			</TD>
		</TR>
	</TABLE>
</form>
<? include_once(getcwd()."/bo_bottom.php"); ?>