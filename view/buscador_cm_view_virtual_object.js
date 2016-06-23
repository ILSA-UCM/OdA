function xmlhttp(){
	// creando objeto XMLHttpRequest de Ajax
	var obXHR;
	try {
		obXHR=new XMLHttpRequest();
	} catch(err) {
		try {
			obXHR=new ActiveXObject("Msxml2.XMLHTTP");
			} 
			catch(err) {
				try {
					obXHR=new ActiveXObject("Microsoft.XMLHTTP");
				}	
				catch(err) {
					obXHR=false;
				}
			}		
		}
	return obXHR;
}

	function buscar_virtual_obj(){
		var query = document.getElementById('entrada_buscador_vo').value;
		var A = document.getElementById('salida_buscador_vo');
		var ajax = xmlhttp();
		ajax.open("GET","busqueda_cm_view_virtual_object.php?q="+encodeURIComponent(query),true);
		ajax.onreadystatechange=function(){
			if(ajax.readyState==4){
				A.innerHTML = ajax.responseText;
			}
		}		
		ajax.send(null);
		return false;
    }
	

