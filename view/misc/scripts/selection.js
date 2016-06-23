var nombreCookieSelected = "lista_indice_sel";
var nombreCookieDeselected = "lista_indice_des";

function FixCookieDate (date) {
	var base = new Date(0);
	var skew = base.getTime(); // dawn of (Unix) time - should be 0
	if (skew > 0) // Except on the Mac - ahead of its time
	date.setTime (date.getTime() - skew);
}

function SetCookie (name,value,expires,path,domain,secure) {
	document.cookie = name + "=" + escape (value) +
	((expires) ? "; expires=" + expires.toGMTString() : "") +
	((path) ? "; path=" + path : "") +
	((domain) ? "; domain=" + domain : "") +
	((secure) ? "; secure" : "");
}

function getCookieVal (offset) {
	var endstr = document.cookie.indexOf (";", offset);
	if (endstr == -1)
	endstr = document.cookie.length;
	res = unescape(document.cookie.substring(offset, endstr));
	
	return res;
}

function getCookie (name) {
	var arg = name + "=";
	var alen = arg.length;
	var clen = document.cookie.length;
	var i = 0;
	while (i < clen) {
	var j = i + alen;
	if (document.cookie.substring(i, j) == arg) {
		return getCookieVal (j);
	}
	i = document.cookie.indexOf(" ", i) + 1;
	if (i == 0) break; 
	}
	return null;
}

function limpiarCookies(){
	SetCookie ("lista_indice_sel", "");
	SetCookie ("lista_indice_des", "");
}

function toggleNodo(item){
	if (item.checked)
		addNodo(item.name);
	else delNodo(item.name);
	var nodo = getElement("seleccion_cuenta_registros");
	if (nodo!=null) nodo.innerHTML=""+getCuentaSeleccionados();
}

function eliminaDelimitadores(valor) {
	while (valor.length>0 && valor.substring(0,1)==",") {
		valor = valor.substring(1);
	}
	while (valor.length>0 && valor.substring(valor.length-1)==",") {
		valor = valor.substring(0,valor.length-1);
	}		
	return valor;
}

function getString(valor) {
	var res;
	if (valor==null) res="";
	else res=valor;
	return res;
}
function addNodo(strId) {
	var listaSel = ","+getString(getCookie(nombreCookieSelected))+",";
	var listaDes = ","+getString(getCookie(nombreCookieDeselected))+",";

	var posSel;
	posSel =listaSel.indexOf(","+strId+",");
	if (posSel!=-1) {

	} else {
		listaSel = strId+listaSel;
		listaSel = eliminaDelimitadores(listaSel);			
		SetCookie( nombreCookieSelected, listaSel);
	}
	var posDes;
	posDes =listaDes.indexOf(","+strId+",");
	if (posDes!=-1) {
		listaDes = replaceSubstring( listaDes, ","+strId+",", "," );
		listaDes = eliminaDelimitadores(listaDes);
		SetCookie( nombreCookieDeselected, listaDes);
	} else {
	}
}

function delNodo(strId) {
	var listaSel = ","+getString(getCookie(nombreCookieSelected))+",";
	var listaDes = ","+getString(getCookie(nombreCookieDeselected))+",";
	var posDes;
	posDes =listaDes.indexOf(","+strId+",");
	if (posDes!=-1) {

	} else {
		listaDes = strId+listaDes;
		listaDes = eliminaDelimitadores(listaDes);
		SetCookie( nombreCookieDeselected, listaDes);
	}
	var posSel;
	
	posSel =listaSel.indexOf(","+strId+",");
	if (posSel!=-1) {
		listaSel = replaceSubstring( listaSel, ","+strId+",", "," );
		listaSel = eliminaDelimitadores(listaSel);
		SetCookie( nombreCookieSelected, listaSel);
	} else {
	}
	/*if (pos!=-1) {
		lista = replaceSubstring( lista, ","+strId+",", "," );
		SetCookie( nombreCookieDeselected, lista);
	}*/
}

function indiceLoad() {
	var i;
	var listaSeleccionados = getString(getCookie(nombreCookieSelected));
	var listaDeseleccionados = getString(getCookie(nombreCookieDeselected));

	var vSel = listaSeleccionados.split(",");
	var vDes = listaDeseleccionados.split(",");
	//alert(listaSeleccionados);
	//alert(listaDeseleccionados);
	for (i=0;i<vSel.length;i++) {
		if (vSel[i]!="") {
			if (document.SeleccionForm[vSel[i]]!=null) document.SeleccionForm[vSel[i]].checked=true;
		}
	}
	for (j=0;j<vDes.length;j++) {
		if (vDes[j]!="") {
			if (document.SeleccionForm[vDes[j]]!=null) document.SeleccionForm[vDes[j]].checked=false;
		}
	}
	var nodo = getElement("seleccion_cuenta_registros");
	cuenta = vSel.length;
	if (listaSeleccionados=="") cuenta=0;
	if (nodo!=null) nodo.innerHTML=cuenta;
}

function getCuentaSeleccionados() {
	var listaSeleccionados = getString(getCookie(nombreCookieSelected));
	var vSel = listaSeleccionados.split(",");
	cuenta = vSel.length;
	if (listaSeleccionados=="") cuenta=0;
	return cuenta;
}