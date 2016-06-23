<? 
/* 
 * Archivo generado dinámicamente por Content Manager
*/
include_once(dirname(__FILE__)."/include.php");
if ($id!="") {
	$fila = $visit->dbBuilder->getTextDataId($id);
} else {
	$fila = new ClsTextData();
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
            idseccion:
          </td>
          <td width="320">
            <?= $fila->idseccion ?>
          </td>
        </tr>
				
					<tr bgcolor="#FFFFFF" valign="top">
          <td width="140">
            value:
          </td>
          <td width="320">
            <?= $fila->value ?>
          </td>
        </tr>
				
			
      </table>
    </div>
		
	
  
	
<? 

?>
<? include_once(dirname(__FILE__)."/bottom.php"); ?>