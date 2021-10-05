
<? include_once("pestanaNames.php")?>

<div style="margin-bottom: -1px;">
	<div <? if ($pes=="dat") { ?> class="pestanasuperioractiva" <? } else { ?> class="pestanasuperiorinactiva" <? } ?> >
		<A  HREF="<?= $visit->util->construyeUrlMenosMas("",$visit->util->getRequest(),"pes","pes=dat")?>"  >
			<span class="text_pestana">&nbsp;<?=$Datos?></span>
		
		</A>
	</div>
	<div <? if ($pes=="rec") { ?> class="pestanasuperioractiva" <? } else { ?> class="pestanasuperiorinactiva" <? } ?> >
		<A  HREF="<?= $visit->util->construyeUrlMenosMas("",$visit->util->getRequest(),"pes","pes=rec")?>"  >
			<span>&nbsp;<?=$Recursos?>&nbsp;</span>
		</A>
	</div>
	
	<div <? if ($pes=="met") { ?> class="pestanasuperioractiva" <? } else { ?> class="pestanasuperiorinactiva" <? } ?>>
		<A   HREF="<?= $visit->util->construyeUrlMenosMas("",$visit->util->getRequest(),"pes","pes=met")?>"  >
			<span>&nbsp;<?=$Metadatos?>&nbsp;</span>
		</A>
	</div>
</div>







