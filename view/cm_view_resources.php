<? 
/* 
 * Archivo generado dinámicamente por Content Manager
*/
include_once(dirname(__FILE__)."/include.php");
if ($id!="") {
	$fila = $visit->dbBuilder->getResourcesId($id);
} else {
	$fila = new ClsResources();
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
            idov:
          </td>
          <td width="320">
            <?= $fila->idov ?>
          </td>
        </tr>
				
					<tr bgcolor="#FFFFFF" valign="top">
          <td width="140">
            ordinal:
          </td>
          <td width="320">
            <?= $fila->ordinal ?>
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
            iconoov:
          </td>
          <td width="320">
            
					<? if ($filas[$i]->iconoov=="S"){  ?> 
							<IMG SRC="img/ico_checked_si.gif" WIDTH="12" HEIGHT="12" BORDER="0" ALT="">  
					<?	}else{ ?>
							<IMG SRC="img/ico_checked_no.gif" WIDTH="12" HEIGHT="12" BORDER="0" ALT="">
					<? } ?>
			
          </td>
        </tr>
				
					<tr bgcolor="#FFFFFF" valign="top">
          <td width="140">
            name:
          </td>
          <td width="320">
            <?= $fila->name ?>
          </td>
        </tr>
				
					<tr bgcolor="#FFFFFF" valign="top">
          <td width="140">
            idov_refered:
          </td>
          <td width="320">
            <?= $fila->idov_refered ?>
          </td>
        </tr>
				
					<tr bgcolor="#FFFFFF" valign="top">
          <td width="140">
            idresource_refered:
          </td>
          <td width="320">
            <?= $fila->idresource_refered ?>
          </td>
        </tr>
				
					<tr bgcolor="#FFFFFF" valign="top">
          <td width="140">
            type:
          </td>
          <td width="320">
            <?= $fila->getValorType($fila->type) ?>
          </td>
        </tr>
				
			
      </table>
    </div>
		
	
  
	
<? 

?>
<? include_once(dirname(__FILE__)."/bottom.php"); ?>