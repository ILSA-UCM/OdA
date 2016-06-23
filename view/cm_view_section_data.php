<? 
/* 
 * Archivo generado dinámicamente por Content Manager
*/
include_once(dirname(__FILE__)."/include.php");
if ($id!="") {
	$fila = $visit->dbBuilder->getSectionDataId($id);
} else {
	$fila = new ClsSectionData();
}
if (!$visit->options->tieneAcceso("view",$fila)) $visit->options->sinAcceso();
include_once(dirname(__FILE__)."/top.php");
?>

    
		
		
		<div id="filas_listado">
      <table border="0" width="460" cellpadding="0" cellspacing="0" bgcolor="">
        <tr>
          <td bgcolor="#000000" height="20" align="center">
            <b><font color="#FFFFFF">Gestión de
            Recursos</font></b>
          </td>
        </tr>
      </table>
      <table width="460" border="0" cellpadding="3" cellspacing="1" bgcolor="#7AC522">
        
				
					<tr id="fila_listado" bgcolor="#FFFFFF" valign="top">
          <td width="140">
            idpadre:
          </td>
          <td width="320">
            <?= $fila->idpadre ?>
          </td>
        </tr>
				
					<tr bgcolor="#FFFFFF" valign="top">
          <td width="140">
            nombre:
          </td>
          <td width="320">
            <?= $fila->nombre ?>
          </td>
        </tr>
				
					<tr bgcolor="#FFFFFF" valign="top">
          <td width="140">
            codigo:
          </td>
          <td width="320">
            <?= $fila->codigo ?>
          </td>
        </tr>
				
					<tr bgcolor="#FFFFFF" valign="top">
          <td width="140">
            tooltip:
          </td>
          <td width="320">
            <?= $fila->tooltip ?>
          </td>
        </tr>
				
					<tr bgcolor="#FFFFFF" valign="top">
          <td width="140">
            visible:
          </td>
          <td width="320">
            
					<? if ($filas[$i]->visible=="S"){  ?> 
							<IMG SRC="img/ico_checked_si.gif" WIDTH="12" HEIGHT="12" BORDER="0" ALT="">  
					<?	}else{ ?>
							<IMG SRC="img/ico_checked_no.gif" WIDTH="12" HEIGHT="12" BORDER="0" ALT="">
					<? } ?>
			
          </td>
        </tr>
				
					<tr bgcolor="#FFFFFF" valign="top">
          <td width="140">
            orden:
          </td>
          <td width="320">
            <?= $fila->orden ?>
          </td>
        </tr>
				
					<tr bgcolor="#FFFFFF" valign="top">
          <td width="140">
            lang:
          </td>
          <td width="320">
            <?= $fila->lang ?>
          </td>
        </tr>
				
					<tr bgcolor="#FFFFFF" valign="top">
          <td width="140">
            idlangprincipal:
          </td>
          <td width="320">
            <?= $fila->idlangprincipal ?>
          </td>
        </tr>
				
					<tr bgcolor="#FFFFFF" valign="top">
          <td width="140">
            browseable:
          </td>
          <td width="320">
            
					<? if ($filas[$i]->browseable=="S"){  ?> 
							<IMG SRC="img/ico_checked_si.gif" WIDTH="12" HEIGHT="12" BORDER="0" ALT="">  
					<?	}else{ ?>
							<IMG SRC="img/ico_checked_no.gif" WIDTH="12" HEIGHT="12" BORDER="0" ALT="">
					<? } ?>
			
          </td>
        </tr>
				
					<tr bgcolor="#FFFFFF" valign="top">
          <td width="140">
            tipo_valores:
          </td>
          <td width="320">
            <?= $fila->getValorTipoValores($fila->tipo_valores) ?>
          </td>
        </tr>
				
			
      </table>
    </div>
		
	
  
	
<? 

?>
<? include_once(dirname(__FILE__)."/bottom.php"); ?>