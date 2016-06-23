<!-- INCLUDE SECCIONES BACKOFFICE -->
<table border="0" height="31"  cellpadding="0" cellspacing="0">
	<tr>
		<? 
		$strAdicional="";
		if ($visit->util->perteneceLista($visit->util->getScriptName(),"cm_ls_section_data.php,cm_form_section_data.php,cm_view_section_data.php")) {
			$strAdicional='class="boactivo"';
		}
		?>		
		<td class="boseccion"><a href="cm_ls_section_data.php" <?= $strAdicional ?>>section_data</a></td>
	</tr>
</table>
<!-- FIN INCLUDE SECCIONES BACKOFFICE -->
