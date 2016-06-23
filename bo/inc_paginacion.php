<TABLE  border="0" width="100%" cellpadding="0" cellspacing="0" >
	<TR>
		<TD width="30%" height="24" align="left" >&nbsp;[<?= $inicio ?>-<?= $visit->util->muestrahastareg($visit->options->paginacion,$count,$npag) ?>] de <?= $count ?>&nbsp;
			<? $valoresPaginacion=explode(",","20,40,60,100,200,400"); ?>
			<select name ="paginacion"  class="selectpeque" style="width:60px;" onChange="window.location.href=construyeUrlMenosMas(window.location.href,'paginacion,npag','paginacion='+formlistado<?= $n?>.paginacion.value)" >
				<? for ($i=0;$i<count($valoresPaginacion);$i++) { ?>
					<option value="<?= $valoresPaginacion[$i] ?>" <? if ($visit->options->paginacion==$valoresPaginacion[$i]) print "selected"; ?>><?= $valoresPaginacion[$i] ?>
				<? } ?>
				<option value ="999999" <? if ($paginacion=="999999") echo "selected"; ?> >Todas
			</select>
		</TD>
		
		<TD width="40%" align="center">
		
		<? $visit->util->imprimirPaginacion($visit->options->paginacion, $visit->options->maxPaginasSiguientes, $count, $npag, $urlName); ?>
		
		</TD>
		
		<TD width="30%" align="right" >
			<? if($accionnuevo!=""){ ?>
				<a href="<?= $accionnuevo?>"><IMG SRC="<?=$_parenDir?>/bo/img/boton_nuevo.gif" WIDTH="77" HEIGHT="21" BORDER="0" ALT=""></a>
			&nbsp;	
			<? } ?>			
		</TD>
		
	</TR>
</TABLE>