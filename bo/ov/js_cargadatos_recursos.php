<?
include_once(dirname(__FILE__)."/include.php");
$obj = new ClsControlledData();
$filas= getTodosFromIdRecurso($obj,$id);
?>


<script>
var f = top.document.formulario;

<? while (list ($clave, $fila) = each ($filas)) { ?>		
	f.seccion_"<?= $fila->id ?>_nuevo".value =nombre;
	f.web.value=web;
	f.fundadaEn.value=fundacion;
	f.nif.value=cif;
	f.campodir_1_direccion.value=direccion;
	f.campodir_1_telefono.value=telefono;
	f.campodir_1_email.value=email;
	f.campodir_1_codigopostal.value=codpostal;
	f.campodir_1_fax.value=fax;
	f.campodir_1_comentario.value=comentario;

 <? } ?> 
	var idCampos=1;

	
	
		
	if(f.campoidgremio_0_text != null)
		f.campoidgremio_0_text.value="";

	var lista = f.cuentagremios.value + ";";
	while ( lista != "" && lista != ";") {
		try {
			var elem = lista.substring(0,lista.indexOf(";"));
			var nodoViejo = top.document.getElementById("campoidgremio_"+elem+"_text");
			nodoViejo.value = "";
			var nodoSpan = top.document.getElementById("campoidgremio_"+elem+"_span");
			var strCuenta = eliminaDeLista2(elem,f.cuentagremios.value);
			f.cuentagremios.value = strCuenta;
			eliminarCampo(nodoSpan,"idgremio","si");
			lista = lista.substring(lista.indexOf(";")+1);
		} catch (e) {
		}
	}
	



	  </script>
