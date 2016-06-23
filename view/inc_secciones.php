
<?

//$visit->debuger->enable(true);
$idpadre=$menu;
if ($menuActual->idpadre!="0") $idpadre= $menuActual->idpadre;
$navSecundaria = $visit->dbBuilder->getNavegacionSecundaria($idpadre);

 ?>
 <table width="150" border="0" cellpadding="0" cellspacing="0" style="border-top:1px solid #b4afac;border-left:1px solid #b4afac;border-right:1px solid #b4afac;"> 		
	<tr>
		
		<td class="bloquemenu"><?=$menuActual->nombre?></td>
	</tr>
</table>
<table width="150" border="0" cellpadding="0" cellspacing="0" style="border-left:1px solid #b4afac;border-right:1px solid #b4afac;"> 	
	<TR>
		<? if (count($navSecundaria)>0){ ?>			
			<?for ($i=0;$i<count($navSecundaria);$i++){?>
				<tr>
					<? 
						$enlace = $visit->util->getEnlaceFromMenu($navSecundaria[$i],$menu);
						if ($menu==$navSecundaria[$i]->idlangprincipal) {
							$class="menuover";											
						}else {$class="menu"; } ?>

					<td class="menuweb" onmouseover="this.className='menuwebover';"	onmouseout="this.className='menuweb';"
					onclick="window.location.href = '<?= $enlace?>'"><?= $navSecundaria[$i]->nombre?></td>  
				</TR>
			<? } ?>
		<? } ?>
	</TR>
</TABLE>

 
 


	


