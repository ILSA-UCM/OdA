var img_expanded  = './misc/scripts/Expanded.png';
var img_collapsed = './misc/scripts/Collapsed.png';
var img_blank = './misc/scripts/blank.png';
var img_leaf = './misc/scripts/LeafRowHandle.png';

new Image(9,9),src = img_expanded; // caching
new Image(9,9),src = img_collapsed; // caching
new Image(9,9),src = img_blank; // caching
new Image(9,9),src = img_leaf; // caching

function hover(iNode, over) {

    if (over) {
        t = document.getElementById(iNode).alt;
        
        if (t == '*') {
            document.getElementById(iNode).src=img_leaf;
        } else if (t == 'V') {
            document.getElementById(iNode).src=img_expanded;
        } else {
            document.getElementById(iNode).src=img_collapsed;
        }
    
    } else {
        document.getElementById(iNode).src=img_blank;
    }
}

function expand(ioNode) {
	ioWedge = "i" + ioNode.substr(1);

	if (document.getElementById && document.getElementById(ioNode) !=  null) {

		document.getElementById(ioNode).className='expanded';
		if (document.getElementById(ioWedge) !=  null) {		
			document.getElementById(ioWedge).src=img_expanded;
			document.getElementById(ioWedge).title='collapse';
			document.getElementById(ioWedge).alt='V';
		}
	}
}

function collapse(ioNode) {
	ioWedge = "i" + ioNode.substr(1);
	if (document.getElementById && document.getElementById(ioNode) != null) {
		document.getElementById(ioNode).className='collapsed';
		if (document.getElementById(ioWedge) !=  null) {		
			document.getElementById(ioWedge).src=img_collapsed;
			document.getElementById(ioWedge).title='expand';
			document.getElementById(ioWedge).alt='>';
		}
	}
}

function ioSwitch(ioNode,fully) {
	if (document.getElementById && document.getElementById(ioNode) !=  null) {
		nodeState = document.getElementById(ioNode).className;
	}
    if (nodeState == 'collapsed') {
        if (fully) {
            expandAll();
        } else {
    		addNodo(ioNode.substr(1));
			expand(ioNode);
        }
	}

	else {
        if (fully) {
            collapseAll();
        } else {
			delNodo(ioNode.substr(1));
			collapse(ioNode);
        }
	}
}

function expandAll() {
	if (document.getElementsByTagName) {
		nodeList = document.getElementsByTagName('div');

		for (var i = 0; i < nodeList.length; i++) {
			if (nodeList.item(i).className == 'expanded' || nodeList.item(i).className == 'collapsed') {
				expand(nodeList.item(i).id);	
			}
		}
	} else {
		alert ("Sorry, don't know how to make this run in your browser.");
	}
}

function collapseAll() {
	if (document.getElementsByTagName) {
		nodeList = document.getElementsByTagName('div');
		for (var i = 0; i < nodeList.length; i++) {
	
			if (nodeList.item(i).className == 'expanded' || nodeList.item(i).className == 'collapsed') {
				collapse(nodeList.item(i).id);	
			}
		}
	} else {
		alert ("Sorry, don't know how to make this run in your browser.");
	}
}

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
	SetCookie (nombreCookieSelected, "");
	SetCookie (nombreCookieDeselected, "");
}

/*
function toggleNodo(item){
	if (item.checked)
		addNodo(item.name);
	else delNodo(item.name);
	var nodo = getElement("seleccion_cuenta_registros");
	if (nodo!=null) nodo.innerHTML=""+getCuentaSeleccionados();
}
*/

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
	//alert(strId);
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
	}
}

function delNodo(strId) {
	//alert(strId);
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
	}
}

function indiceLoad() {
	if(getCookie(nombreCookieSelected)==null)
		SetCookie (nombreCookieSelected, "");
	if(getCookie(nombreCookieDeselected)==null)
		SetCookie(nombreCookieDeselected, "");
	var listaSeleccionados = getString(getCookie(nombreCookieSelected));
	var listaDeseleccionados = getString(getCookie(nombreCookieDeselected));
	var vSel = listaSeleccionados.split(",");
	var vDes = listaDeseleccionados.split(",");
	//alert("Seleccionados: " + listaSeleccionados);
	//alert("Deseleccionados: " + listaDeseleccionados);
	for (i=0;i<vSel.length;i++) {
		if (vSel[i]!="") {
			var p = "p"+vSel[i];
			if (document.getElementById(p)!=null) expand(p);
		}
	}
	for (j=0;j<vDes.length;j++) {
		if (vDes[j]!="") {
			var p = "p"+vDes[j];
			if (document.getElementById(p)!=null) collapse(p);
		}
	}
}

function isCollapsed(id){
	var result = false;
	for (j=0;j<vDes.length;j++) {
		if (vDes[j]!="") {
			if(vDes[j]==id) result = true;
		}
	}
	return result;
}

function getCuentaSeleccionados() {
	var listaSeleccionados = getString(getCookie(nombreCookieSelected));
	var vSel = listaSeleccionados.split("%2C");
	cuenta = vSel.length;
	if (listaSeleccionados=="") cuenta=0;
	return cuenta;
}