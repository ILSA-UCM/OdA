<? 
include_once("include.php"); 
include_once(getcwd()."/top.php"); 
//$visit->debuger->enable(true);
$dict = $visit->util->getRequest();
$id = $dict["id"];
if (!isset($id)) $id="";
if ($id=="") $visit->util->redirect($_parenDir."index.php");
$fila = $visit->dbBuilder->getPaginasId($id);

$filas = new ClsContenidosPagina();
$filas = $visit->dbBuilder->getContenidosPaginaFromIdpagina($id);

//var_dump($fila);

if($fila->titulo != "") {
	$titulopag =  " > ". $fila->titulo;
}
///if (!$fila) $fila = $visit->dbBuilder->getPaginasId($id);
//$visit->options->detalle = $fila->titulo;


?>

<script type="text/javascript">
	function ajustarIframeContenidoPagina(){
		var miIframe=document.getElementById("iframe_pag");
		var divContenido=document.getElementById("contenidoIframe");
		var anchoPagina = miIframe.contentWindow.document.body.scrollWidth;
		var alturaPagina = miIframe.contentWindow.document.body.scrollHeight;
		//alert(alturaPagina);
		divContenido.style.height=alturaPagina;
			
	}
</script>


<? /* foreach( $filas as $key => $value){
		$filas = $value;
	}*/
 ?>
 
 
<div class = "titulopagina"> 	<?   print $visit->util->migaspan($idpadre,$migas); ?><?=$titulopag; ?></div> 
		
<div class=" contenidopagina">
	
	<?  if($fila->documento != ""){?>
		<div id="contenidoIframe" class="contenidoIframe_pagina">
			<iframe id="iframe_pag" src="<?=$fila->documento?>" frameborder=0 width='100%' height='100%' ></iframe>		
		</div>
	<? } ?>	
					<? 
						for ($i=0;$i<count($filas);$i++) {
							if ($filas[$i]->tipo=="1") { 

								include(getcwd()."/inc_imagen.php"); 

							}else if($filas[$i]->tipo=="2"){
							
								include(getcwd()."/inc_contenido.php");
								
							}else if($filas[$i]->tipo=="3"){
								
								include(getcwd()."/inc_imagen_contenido2.php");

							}else if($filas[$i]->tipo=="4"){

								include(getcwd()."/inc_contenido2.php");

							}else if($filas[$i]->tipo=="5"){

								include(getcwd()."/inc_imagen_contenido.php");

							} 
							print "<BR>";

						} 
					?>
			
</div>
		
<? include_once(getcwd()."/bottom.php"); ?>