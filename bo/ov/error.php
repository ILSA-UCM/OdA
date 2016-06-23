<? 
include(getcwd()."/include.php");
include_once(getcwd()."/bo_top.php");
$dict=$visit->util->getRequest();
$error = $dict["error"];
$id= $dict["id"];
$name = $dict["name"];
$tipo = $dict["tipo"];

?>

<TABLE  border="0" width="100%" height="300" cellpadding="0" cellspacing="0">
	<TR>
		<TD width="100%" align="center" valign="middle">

		<TABLE  border="0" width="300" height="150" cellpadding="0" cellspacing="0" style="border:1px solid #B7B7B7">
			<TR>
				<TD width="100%" align="center" valign="middle" bgcolor="#E9E9E9">
					<? if ($error=="") { ?>
					<? } else if ($error=="1") {?>
						&nbsp;El recurso ya existe. &iquest;Desea sobreescribir el archivo?&nbsp;
						<BR><BR><BR>
						<? if($tipo != ""){$writeTipo = "&tipo=".$tipo; }?>
						
						
						<!-- alfredo 140930  <A HREF="do.php?op=sobreescribir_recurso&idov=<?=$id?>&name=<?=$name?>&accion=S<?=$writeTipo?>">  -->
						<?if ("S"==$dict["from_view"]){?>
							<A HREF="do.php?op=sobreescribir_recurso&idov=<?=$id?>&name=<?=$name?>&accion=S<?=$writeTipo?>&from_view=S"> 
						<?} else if($dict["desde"]=="mantenimiento") {?>
							<A HREF="do.php?op=sobreescribir_recurso&idov=<?=$id?>&name=<?=$name?>&accion=S<?=$writeTipo?>&desde=mantenimiento"> 
						<?}else{?>
							<A HREF="do.php?op=sobreescribir_recurso&idov=<?=$id?>&name=<?=$name?>&accion=S<?=$writeTipo?>"> 
						<?}?>
						
						
						<IMG SRC="../img/boton_si.png" WIDTH="34" HEIGHT="24" BORDER="0" ALT="">
						</A>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<!-- alfredo 140930  <A HREF="do.php?op=sobreescribir_recurso&idov=<?=$id?>&name=<?=name?>&accion=N"> -->
						<?if ("S"==$dict["from_view"]){?>
							<A HREF="do.php?op=sobreescribir_recurso&idov=<?=$id?>&name=<?=$name?>&accion=N&from_view=S"> 
						<?} else if($dict["desde"]=="mantenimiento") {?>
							<A HREF="do.php?op=sobreescribir_recurso&idov=<?=$id?>&name=<?=$name?>&accion=N&desde=mantenimiento"> 
						<?}else{?>
							<A HREF="do.php?op=sobreescribir_recurso&idov=<?=$id?>&name=<?=$name?>&accion=N"> 
						<?}?>
						
						
						
							<IMG SRC="../img/boton_no.png" WIDTH="34" HEIGHT="24" BORDER="0" ALT="">
						</A>
					
					<? } elseif ($error=="2") {?>
						<!-- llamado desde el banco de recursos del bo, tras subir un zip e intentar descomprimirlo en una carpeta existente. --> 
						&nbsp;La carpeta de destino ya existe. &iquest;Desea sobreescribir el archivo?&nbsp;
						<BR><BR><BR>
						<? if($tipo != ""){$writeTipo = "&tipo=".$tipo; }?>
						<A HREF="do.php?op=sobreescribir_recurso&accion=S<?=$writeTipo?>">
						<IMG SRC="../img/boton_si.png" WIDTH="34" HEIGHT="24" BORDER="0" ALT="">
						</A>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<A HREF="do.php?op=sobreescribir_recurso&name=<?=name?>&accion=N">
							<IMG SRC="../img/boton_no.png" WIDTH="34" HEIGHT="24" BORDER="0" ALT="">
						</A>					
					<?}?>
					
				</TD>
			</TR>
		</TABLE>
		</TD>
	</TR>
</TABLE>



<br>
<? 
include_once(getcwd()."/bo_bottom.php");