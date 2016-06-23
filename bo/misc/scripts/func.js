// ********************* Funciones Para los menus que siempre te salgan en pantalla con el nombre tabla_desplazar
function getScrollY() {
  var scrOfX = 0, scrOfY = 0;
  if( typeof( window.pageYOffset ) == 'number' ) {
	scrOfY = window.pageYOffset;
	scrOfX = window.pageXOffset;
  } else if( document.body&&( document.body.scrollLeft || document.body.scrollTop ) ) {
	scrOfY = document.body.scrollTop;
	scrOfX = document.body.scrollLeft;
  } else if( document.documentElement&&( document.documentElement.scrollLeft || document.documentElement.scrollTop ) ) {
	scrOfY = document.documentElement.scrollTop;
	scrOfX = document.documentElement.scrollLeft;
  }
  ///return [ scrOfX, scrOfY ];
  return scrOfY;
}

function GetDivPosition()
{
  var strCook = document.cookie;
  if(strCook.indexOf("!~")!=0){
	var intS = strCook.indexOf("!~");
	var intE = strCook.indexOf("~!");
	var strPos = strCook.substring(intS+2,intE);
	///alert("GET-"+strPos);
	document.body.scrollTop = strPos;
  }	
}

function SetDivPosition(){
	var intY = getScrollY();
	document.title = intY;
	///alert("SET-"+intY);
	document.cookie = "yPos=!~" + intY + "~!";
}

function ResetDivPosition(){
	///var intY = getScrollY();
	var intY = 0;
	document.title = 0;
	document.cookie = "yPos=!~" + intY + "~!";
}

function getValor(item) {
		var res;
		var i;
		res="";
		if (item!=null) {
			if (item.value==null) {
				for (i=0;i<item.length;i++) {
					if (item[i].checked==true) {
							res=item[i].value;
					}
				}
			} else {
				res = item.value;
			}
		}
		return res;
}



function openWindow(url, ancho, alto) {
	strancho=ancho;
	stralto=alto;
	if (ancho==null) strancho = 600;
	if (alto==null) stralto = 360;
	window.open(url,"","resizable=yes,status=1,scrollbars=1,width="+strancho+",height="+stralto,false);
}

function esVacio(cadena) {
	if (trim(cadena)=="") return true;
	else return false;
}

function openWindowFoto(url,imagen) {
	
	var strancho;
	var stralto;
	//if (ancho==null) strancho = 530;
	//if (alto==null) stralto = 360;

	a = new Image();
	a.src=imagen;
	strancho = a.width+40;
	stralto = a.height+40;

	
	window.open(url+"?imagen="+imagen,"","resizable=yes,status=1,scrollbars=1,width="+strancho+",height="+stralto,false);
}


function openBigWindow(url) {
	window.open(url,"","resizable=yes,status=1,scrollbars=1,width=540,height=480",false);
}



function compruebaNum(valor) {
	var str = valor
	var validRegExp = /^[0-9]+([,][0-9]*)?$/i;
	res=true;
	// search email text for regular exp matches
	if (str.search(validRegExp) == -1) {
		res=false;
	} 

	if (esVacio(str)) {
		res=true;
	}
	return res; 	
}


function compruebaPrecio(valor) {
	var str = valor;
	str = replaceSubstring(str,".","");
	var validRegExp = /^([0-9])+([,][0-9]*)?$/i;
	res=true;
	// search email text for regular exp matches
	if (str.search(validRegExp) == -1) {
		res=false;
	} 
	return res; 	
}

function compruebaDecimal(valor) {
	var str = valor;
	str = replaceSubstring(str,".",",");
	var validRegExp = /^([0-9])+([,][0-9]*)?$/i;
	res=true;
	// search email text for regular exp matches
	if (str.search(validRegExp) == -1) {
		res=false;
	} 
	return res; 	
}
function strDecimal(valor) {
	var str = valor;
	//str = replaceSubstring(str,".",",");
	
	return str; 	
}
function getLeftToLast(cadena, delim, num) {
        var pos;
        var res=cadena;
        for(i=0;i<num;i++) {
                pos = res.lastIndexOf(delim);
                if (pos!=-1) {
                        res = res.substring(0,pos);
                }
        }
        return res;
}


function trim(inputString) {
   // Removes leading and trailing spaces from the passed string. Also removes
   // consecutive spaces and replaces it with one space. If something besides
   // a string is passed in (null, custom object, etc.) then return the input.
   if (typeof inputString != "string") { return inputString; }
   var retValue = inputString;
   var ch = retValue.substring(0, 1);
   while (ch == " ") { // Check for spaces at the beginning of the string
      retValue = retValue.substring(1, retValue.length);
      ch = retValue.substring(0, 1);
   }
   ch = retValue.substring(retValue.length-1, retValue.length);
   while (ch == " ") { // Check for spaces at the end of the string
      retValue = retValue.substring(0, retValue.length-1);
      ch = retValue.substring(retValue.length-1, retValue.length);
   }
   while (retValue.indexOf("  ") != -1) { // Note that there are two spaces in the string - look for multiple spaces within the string
      retValue = retValue.substring(0, retValue.indexOf("  ")) + retValue.substring(retValue.indexOf("  ")+1, retValue.length); // Again, there are two spaces in each of the strings
   }
   return retValue; // Return the trimmed string back to the user
} // Ends the "trim" function




function replaceSubstring(inputString, fromString, toString) {
   // Goes through the inputString and replaces every occurrence of fromString with toString
   var temp = inputString;
   if (fromString == "") {
      return inputString;
   }
   if (toString.indexOf(fromString) == -1) { // If the string being replaced is not a part of the replacement string (normal situation)
      while (temp.indexOf(fromString) != -1) {
         var toTheLeft = temp.substring(0, temp.indexOf(fromString));
         var toTheRight = temp.substring(temp.indexOf(fromString)+fromString.length, temp.length);
         temp = toTheLeft + toString + toTheRight;
      }
   } else { // String being replaced is part of replacement string (like "+" being replaced with "++") - prevent an infinite loop
      var midStrings = new Array("~", "`", "_", "^", "#");
      var midStringLen = 1;
      var midString = "";
      // Find a string that doesn't exist in the inputString to be used
      // as an "inbetween" string
      while (midString == "") {
         for (var i=0; i < midStrings.length; i++) {
            var tempMidString = "";
            for (var j=0; j < midStringLen; j++) { tempMidString += midStrings[i]; }
            if (fromString.indexOf(tempMidString) == -1) {
               midString = tempMidString;
               i = midStrings.length + 1;
            }
         }
      } // Keep on going until we build an "inbetween" string that doesn't exist
      // Now go through and do two replaces - first, replace the "fromString" with the "inbetween" string
      while (temp.indexOf(fromString) != -1) {
         var toTheLeft = temp.substring(0, temp.indexOf(fromString));
         var toTheRight = temp.substring(temp.indexOf(fromString)+fromString.length, temp.length);
         temp = toTheLeft + midString + toTheRight;
      }
      // Next, replace the "inbetween" string with the "toString"
      while (temp.indexOf(midString) != -1) {
         var toTheLeft = temp.substring(0, temp.indexOf(midString));
         var toTheRight = temp.substring(temp.indexOf(midString)+midString.length, temp.length);
         temp = toTheLeft + toString + toTheRight;
      }
   } // Ends the check to see if the string being replaced is part of the replacement string or not
   return temp; // Send the updated string back to the user
} // Ends the "replaceSubstring" function


//Esta es las correcta 
function getElement( id, ndoc) {
	var element;
	if (ndoc==null) doc=document;
	else doc=ndoc;
	//alert(id);
	if (doc.getElementById(id)==null) {
		//element = doc.all[id];
	} else {
		element =doc.getElementById(id);
	}
	return element;
}


function toggleOcultacion(partner) {
	var table = getElement(partner);
	if (table!=null) {
		if (table.style.display=="none") table.style.display="block";
		else table.style.display="none";
	}
}

function esVacio(cadena) {
	if (trim(cadena)=="") return true;
	else return false;
}

// Funciones de expansión de popups
// Funciones de expansión de popups
// Funciones de expansión de popups
// Funciones de expansión de popups
// Funciones de expansión de popups
// Funciones de expansión de popups

var urlXml, idpadre, strIdNodo, id, inputNodeValue, strIdElement, nEsforzado;
strIdNodo="";
urlXml="";

function mostrarTr(strid, strelemento, doc) {
	var res=false;
	var nodo2 = getElement("seccion_"+strelemento, doc);
	if (nodo2!=null) {
		if (nodo2.style.display=="block") res=true;
	}
	return res;
}



function expandirNavegacionNueva() {

	var nodo, display;
	nodo = getElement("navegacion_nueva");
	if (nodo!=null) {
		display = nodo.style.display;	
		if ( (display=="block") || (display=="") ) {
			nodo.style.display="none";
			nodo.innerHTML="";
		} else {			
			nodo.style.display="block";
			nodo = getElement("navegacion_nueva");
			if (nodo!=null) {
				//nodo.innerHTML="Cargando datos ...";
				urlXml="xml_html_form_navegacion";
				strIdNodo="navegacion_nueva";
				url="xml_html_form_navegacion.php";
				getXml(url);
			}
		}
	}

	//Mostrar la tr
	var res=false;
	var nodo2 = getElement("navegacion_nueva");
	if (nodo2!=null) {
		if (nodo2.style.display=="block") res=true;
	}
	return res;

}



function getXml(url, doc) {
	var nodo = getElement("xmlisland",doc);
	nodo.src=url;
	//alert (url);
}

function loadXml() {
	var res;
	var doc = document;
	var xmlNode = xmlisland.XMLDocument;
	//alert("loadXml: "+xmlNode.text);

	if (urlXml=="xml_html_form_navegacion") {
		
		nodo = getElement(strIdNodo);
		if (nodo!=null) {
			nodo.innerHTML=xmlNode.text;
		}
	}
	urlXml="";

}



//Nvegacion
function mostrarTrNavegacion(strid, strelemento, doc) {
	var res=false;
	var nodo2 = getElement("navegacion_"+strelemento, doc);
	
	if (nodo2!=null) {
		if (nodo2.style.display=="block") res=true;
	}
	return res;
}

function expandirNavegacion(stroculto, strelemento, strid, strMenu,doc) {
	var nodo, display;
	
	nodo = getElement("navegacion_"+strelemento,doc);
	if (nodo!=null) {
		display = nodo.style.display;		
		if ( (display=="block") || (display=="") ) {
			nodo.style.display="none";
			nodo.innerHTML="";
		} else {			
			nodo.style.display="block";
			nodo = getElement("navegacion_"+strelemento,doc);
			if (nodo!=null) {
				nodo.innerHTML="Cargando datos ...";
				urlXml="xml_html_form_navegacion";
				strIdNodo="navegacion_"+strelemento;
				url="xml_html_form_navegacion.php?id="+strid+"&idoculto=th_"+stroculto+"&idelemento="+strelemento+"&idmenu="+strMenu;
				getXml(url);
			}
		}
	}
	mostrarTrNavegacion(stroculto, strelemento, doc);
}



function getXml(url, doc) {
	var nodo = getElement("xmlisland",doc);
	nodo.src=url;
	//alert(nodo.src);
}

function cambioForm(indice) {
	document["formulario_"+indice]["cambio"].value="1";
}
function revisarFormulario(indice) {
	//alert (indice);
	if (document["formulario_"+indice]["cambio"].value=="1" ){
		return false;
	}else{
		return true;
	}
}

function revisarSeccion(indice) {
	if (document["formulario_"+indice]["cambio"].value=="1" ) {
		return false;
	} else{
		return true;
	}
}





function perteneceLista(valor,lista) {
        var res=false;
        pos =(","+lista+",").indexOf(","+valor+",");
        if (pos!=-1) {
                res=true;
        }
        return res;
}

function construyeUrlMenosMas(url,lista,itemsMas) {
	var res,urlBase,resto,w,x,i,atributo,valor,nresto;
	var v = url.split("?");
	if (v.length==1) {
		res = url+"?"+itemsMas;
	} else {
		nresto="";
		urlBase = v[0];
		resto = v[1];
		w = resto.split("&");
		for (i=0;i<w.length;i++) {
			if (w[i]!=""){
				x = w[i].split("=");
				atributo = x[0];
				valor="";
				if (x.length>0) valor = x[1];
				if (valor!="") {
					if (!perteneceLista(atributo,lista)) {
						nresto = nresto + "&" + atributo + "=" + valor;
					}
				}
			}
		}
		nresto += "&" + itemsMas;
		if (nresto!="") nresto=nresto.substring(1);
		res = urlBase + "?" + nresto;
	}
	return res;
}

function eliminarCampo(nodo) {
	
	var nodoPadre = getPadreConId(nodo);
	
	if (confirm('¿Seguro que desea eliminar este elemento?')) {
		var nodo = nodoPadre;
		nodo.parentNode.removeChild( nodo );		
	}
	return false;
}

function nuevoCampo(nodo,strTitle,nuevoTexto ) {
	var res = nuevoTexto;
	var re;
	re = new RegExp('<([^>]*='+strTitle+'_)([0-9]*)','g'); 
	res = res.replace(re, '<$1'+idCampos);
	re = new RegExp('<([^>]*="'+strTitle+'_)([0-9]*)','g'); 
	res = res.replace(re, '<$1'+idCampos);

	re = new RegExp('Campo ([0-9]*):','g'); 
	res = res.replace(re, 'Campo '+idCampos);
	
	var strSpan = nodo.id.substring(0, nodo.id.length-4 ) + "span";
	var span = getElement( strSpan );
	elem = document.createElement("div");
	elem.id = strTitle+"_" + idCampos+ "_span";
	idCampos++; 
	elem.innerHTML = res;
	//alert(res);
	span.parentNode.appendChild( elem );
	return idCampos-1;
}

/* Dado un nodo te devuelve el identificador del primer nodo padre que tenga el campo id*/
function getIdentificadorPadre(nodo) {
	var nodoPadre = getPadreConId(nodo);
	var res=nodoPadre.id;
	return res;
}

/* Dado un nodo te devuelve el indice del identificador del primer nodo padre que tenga el campo id
Si el padre es campo_1_algo te devolvería 1
*/
function getIdentificadorPadreIndice(nodo) {
	var nodoPadre = getPadreConId(nodo);
	var v = nodoPadre.id.split("_");
	var res="";
	res = v[1];
	return res;
}

/* Dado un nodo te devuelve el nodo del primer nodo padre que tenga el campo id*/
function getPadreConId(nodo) {
	var res=null;
	if (nodo.id!=null) {
		if (nodo.id!="") {
			res = nodo;
		}
	}
	if (res==null) res = getPadreConId(nodo.parentNode);
	return res;
}



function esNumerico(str){
	var validRegExpDec = /^[0-9]+((\,|\.)[0-9]+)*$/i;
	var validRegExpFecha = /^\d\d\/\d\d\/\d\d\d\d$/i;
	res=false;
	if(esVacio(str)) res=false;
	else if (str.search(validRegExpDec) != -1 || str.search(validRegExpFecha) != -1) {
		res = true;
	} 
	return res; 
}


function esMail(valor){
	if (valor == "" || (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(valor))){

		return (true)
	} else {

		return (false);
	}
}

function selectAll(valor) {
	var f = document.form_generacion;
	res="";
	patron="set_";
	for(i=0;i<f.all.length;i++) {	
		var campo = f[i];
		if (campo!=null) {
			var nombreCampo = campo.name;
			if (nombreCampo.substring(0, patron.length)==patron) {
				campo.checked = valor;
			}
		}
	}
}

function selectInverted() {
	var f = document.form_generacion;
	res="";
	patron="set_";
	for(i=0;i<f.all.length;i++) {	
		var campo = f[i];
		if (campo!=null) {
			var nombreCampo = campo.name;
			if (nombreCampo.substring(0, patron.length)==patron) {
				campo.checked = !campo.checked;
				if(campo.checked){
					addNodo(nombreCampo);
				} else {
					delNodo(nombreCampo);
				}
			}
		}
	}
}

var strNodos="<?= $strIds ?>";
var strPrimerNivel="<?= $strPrimerNivel ?>";

	function hide() {
	}

	var nombreCookieSelected = "lista_indice_sel";
	var nombreCookieDeselected = "lista_indice_des";

	function toggleNodo(item){
		if (item.checked)
			addNodo(item.name);
		else delNodo(item.name);
	}

	function addNodo(strId) {
		var listaSel = getCookie(nombreCookieSelected);
		var listaDes = getCookie(nombreCookieDeselected);
		if (listaSel==null) {
			listaSel=",";
		}
		if (listaDes==null) {
			listaDes=",";
		}
		var posSel;
		posSel =listaSel.indexOf(","+strId+",");
		if (posSel!=-1) {

		} else {
			listaSel = ","+strId+listaSel;
			SetCookie( nombreCookieSelected, listaSel);
		}
		var posDes;
		posDes =listaDes.indexOf(","+strId+",");
		if (posDes!=-1) {
			listaDes = replaceSubstring( listaDes, ","+strId+",", "," );
			SetCookie( nombreCookieDeselected, listaDes);
		} else {
		}
	}

	function delNodo(strId) {
		var listaDes = getCookie(nombreCookieDeselected);
		var listaSel = getCookie(nombreCookieSelected);
		if (listaDes==null) {
			listaDes=",";
		}
		if (listaSel==null) {
			listaSel=",";
		}	
		var posDes;
		posDes =listaDes.indexOf(","+strId+",");
		if (posDes!=-1) {

		} else {
			listaDes = ","+strId+listaDes;
			SetCookie( nombreCookieDeselected, listaDes);
		}
		var posSel;
		
		posSel =listaSel.indexOf(","+strId+",");
		if (posSel!=-1) {
			listaSel = replaceSubstring( listaSel, ","+strId+",", "," );
			SetCookie( nombreCookieSelected, listaSel);
		} else {
		}

		/*if (pos!=-1) {
			lista = replaceSubstring( lista, ","+strId+",", "," );
			SetCookie( nombreCookieDeselected, lista);
		}*/
	}

	
/* Separa la cadena por el delimitador y coge la cadena a partir de la derecha num veces*/
function getRightToLast(cadena, delim, num) {
        var pos;
        var res="";
        var tmp=cadena;
        for(i=0;i<num;i++) {
                pos = tmp.lastIndexOf(delim);
                if (pos!=-1) {
                        res = tmp.substring(pos) + res;
                        tmp = tmp.substring(0,pos);
                } else {
                        res = tmp + res;
                        tmp = "";
                }
        }
        if (res.length>=delim.length) {
                if (res.substring(0,delim.length)==delim) {
                        res = res.substring(delim.length);
                }
        }
        return res;
} 



function eliminarRecurso(tipo) {
	
		var ubicacion="ubicacion_"+tipo;
		document.formulario[ubicacion].value="";
		getElement('id_ubicacion_'+tipo).style.display='none';
	



}
function eliminarImagenes(indice) {
		
		
	nombre ="ubicacion_"+indice;
	document.formulario[ nombre ].value="";

	getElement('img_eliminar_'+indice).style.display='none';

			
}


function construyeUrlMenosMas(url,lista,itemsMas) {
	var res,urlBase,resto,w,x,i,atributo,valor,nresto;
	var v = url.split("?");
	if (v.length==1) {
		res = url+"?"+itemsMas;
	} else {
		nresto="";
		urlBase = v[0];
		resto = v[1];
		w = resto.split("&");
		for (i=0;i<w.length;i++) {
			if (w[i]!=""){
				x = w[i].split("=");
				atributo = x[0];
				valor="";
				if (x.length>0) valor = x[1];
				if (valor!="") {
					if (!perteneceLista(atributo,lista)) {
						nresto = nresto + "&" + atributo + "=" + valor;
					}
				}
			}
		}
		nresto += "&" + itemsMas;
		if (nresto!="") nresto=nresto.substring(1);
		res = urlBase + "?" + nresto;
	}
	return res;
}


function perteneceLista(valor,lista) {
        var res=false;
        pos =(","+lista+",").indexOf(","+valor+",");
        if (pos!=-1) {
                res=true;
        }
        return res;
}

function numDigitos( valor, ancho) {
		var res, i;
		res = valor +"";
		for (i=(res+"").length; i<ancho; i++) {
			res ="0"+ res;
		}
		return res;
	}


function cambiaValorTipocontenidos(item) {


	var nodoPagina = getElement("div_paginas");
	nodoPagina.style.display="none";

	var nodoFormularios = getElement("div_formularios");
	nodoFormularios.style.display="none";


	//var nodoPaginaImagenes = getElement("div_paginas_imagenes");
	//nodoPaginaImagenes.style.display="none";

	var nodoNav = getElement("div_navegacion");
	if (nodoNav!=null) {
		nodoNav.style.display="block";
	}

	var nodoUrl = getElement("div_url");
	nodoUrl.style.display="none";

	//var nodoOrdenNoticias = getElement("div_ordennoticias");
	//nodoOrdenNoticias.style.display="none";

//	var nodoCatalogo = getElement("div_catalogo");
//	nodoCatalogo.style.display="none";
	
	//if (item.selected) {
		if (item =="P" ) nodoPagina.style.display="block";
		///if (item =="C" ) nodoPagina.style.display="block";
		/*else if (item =="C" ){
			nodoNav.style.display="none";
			nodoCatalogo.style.display="block";
		}*/
		if (item =="S") nodoNav.style.display="none";
		if (item =="U" ) nodoUrl.style.display="block";
		//if (item =="I" ) nodoPaginaImagenes.style.display="block";
		//if (item =="FO" ) nodoFormularios.style.display="block";
		//if (item =="N" ) nodoOrdenNoticias.style.display="block";
		
		
	//}
}

function cambiaTienecontenidos(item) {
	var tipocontenido = document.formulario.tipo_contenido.value;
	var nodoPagina = getElement("div_paginas");
	var nodoPaginaImagenes = getElement("div_paginas_imagenes");
	var nodoUrl = getElement("div_url");
	var nodoContenidos = getElement("div_tipocontenidos");
	var nodoCatalogo = getElement("div_catalogo");
	nodoContenidos.style.display="block";
	var nodoFormularios = getElement("div_formularios");
	var nodoOrdenNoticias = getElement("div_ordennoticias");
	if (item =="C") {
		window.document.formulario.tipo_contenido.value = "C";
		window.document.formulario.tiene_contenido.value = "S";
		nodoContenidos.style.display="none";
		nodoUrl.style.display="none";
		nodoPagina.style.display="none";
	} else if (item =="A") {
		window.document.formulario.tipo_contenido.value = "A";
		window.document.formulario.tiene_contenido.value = "S";
		nodoContenidos.style.display="none";
		nodoUrl.style.display="none";
		nodoPagina.style.display="none";
	} else {
		if (item =="S" ){
			nodoContenidos.style.display="block";
			if (tipocontenido=="U")
			{
				nodoUrl.style.display="block";
			}
			if (tipocontenido=="P")
			{
				nodoPagina.style.display="block";
			}
		} else {
			nodoContenidos.style.display="none";
			nodoUrl.style.display="none";
			nodoPagina.style.display="none";
		}
	}
}

function cambiaEstadoDestacado(item) {
	
	var nodoNavegacion = getElement("id_navegacion");
	nodoNavegacion.style.display="none";
	var nodoUrl = getElement("id_enlace");
	nodoUrl.style.display="none";
	var nodoArticulo = getElement("id_articulo");
	nodoArticulo.style.display="none";

	var nodoNoticia = getElement("id_noticia");
	nodoNoticia.style.display="none";

	var nodoCatalogo = getElement("id_catalogo");
	nodoCatalogo.style.display="none";

	var nodoFormularios = getElement("id_formularios");
	nodoFormularios.style.display="none";
	if (item.checked) {
		if (item.value=="M") nodoNavegacion.style.display="block";
		if (item.value=="U") {
			nodoUrl.style.display="block";
		}	
		if (item.value=="A") {
			nodoArticulo.style.display="block";
		}	

		if (item.value=="N") {
			nodoNoticia.style.display="block";
		}	

		if (item.value=="F") {
			nodoFormularios.style.display="block";
		}	

		if (item.value=="C") {
			nodoCatalogo.style.display="block";
		}	
		
	
	}
}


function cambiaEstadoDestacadoDoble(item) {
	
	var nodoNavegacion = getElement("id_navegacion_"+item.id);
	nodoNavegacion.style.display="none";
	var nodoUrl = getElement("id_enlace_"+item.id);
	nodoUrl.style.display="none";

	var nodoArticulo = getElement("id_articulo_"+item.id);
	nodoArticulo.style.display="none";

	var nodoNoticia = getElement("id_noticia_"+item.id);
	nodoNoticia.style.display="none";

	var nodoCatalogo = getElement("id_catalogo_"+item.id);
	nodoCatalogo.style.display="none";

	var nodoFormularios = getElement("id_formularios_"+item.id);
	nodoFormularios.style.display="none";

	if (item.checked) {
		if (item.value=="M") nodoNavegacion.style.display="block";
		if (item.value=="U") {
			nodoUrl.style.display="block";
		}
		
		if (item.value=="A") {
			nodoArticulo.style.display="block";
		}	

		if (item.value=="N") {
			nodoNoticia.style.display="block";
		}	

		if (item.value=="C") {
			nodoCatalogo.style.display="block";
		}	
		if (item.value=="F") {
			nodoFormularios.style.display="block";
		}
		
	
	}
}

function cambiaTipoImagen(item) {
	

	var nodoDimensiones = getElement("id_dimensiones");
	nodoDimensiones.style.display="none";
	if (item.checked) {
	//	if (item.value=="I") nodoNavegacion.style.display="block";
		if (item.value=="F") {
			nodoDimensiones.style.display="block";
		}	
		
	
	}
}

function cambiaTipoImagenDoble(item) {
	

	var nodoDimensiones = getElement("id_dimensiones_"+item.id);
	nodoDimensiones.style.display="none";
	if (item.checked) {
	//	if (item.value=="I") nodoNavegacion.style.display="block";
		if (item.value=="F") {
			nodoDimensiones.style.display="block";
		}	
		
	
	}
}
function eliminarTienda(strid) {
	//alert(strid);
	var nodo = getElement("mostrar_tiendas_"+strid);
	nodo.outerHTML="";


	var valorPrevio = document.formulario.tiendas.value;
	var v = valorPrevio.split(",");
	var res="";
	var i;
	for (i=0;i<v.length;i++) {
		if (v[i]!="") {
			if (v[i]!=strid) {
				res = res +","+v[i];
			}
		}
	}
	if (res!="") res=res.substring(1);
	document.formulario.tiendas.value = res;
}


function eliminarArticulo(strid) {
	//alert(strid);
	var nodo = getElement("mostrar_articulos_"+strid);
	nodo.outerHTML="";


	var valorPrevio = document.formulario.articulos.value;
	var v = valorPrevio.split(",");
	var res="";
	var i;
	for (i=0;i<v.length;i++) {
		if (v[i]!="") {
			if (v[i]!=strid) {
				res = res +","+v[i];
			}
		}
	}
	if (res!="") res=res.substring(1);
	document.formulario.articulos.value = res;
}


function eliminarNoticia(strid) {
	//alert(strid);
	var nodo = getElement("mostrar_noticias_"+strid);
	nodo.outerHTML="";


	var valorPrevio = document.formulario.noticias.value;
	var v = valorPrevio.split(",");
	var res="";
	var i;
	for (i=0;i<v.length;i++) {
		if (v[i]!="") {
			if (v[i]!=strid) {
				res = res +","+v[i];
			}
		}
	}
	if (res!="") res=res.substring(1);
	document.formulario.idnoticia.value = res;
}

function eliminarArticuloDestacados(strid,n) {
	//alert(strid);
	var nodo = getElement("mostrar_articulos_"+strid);
	nodo.outerHTML="";


	var valorPrevio = document.formulario["camposdestacados_"+n+"_articulos"].value;
	var v = valorPrevio.split(",");
	var res="";
	var i;
	for (i=0;i<v.length;i++) {
		if (v[i]!="") {
			if (v[i]!=strid) {
				res = res +","+v[i];
			}
		}
	}
	if (res!="") res=res.substring(1);
	document.formulario["camposdestacados_"+n+"_articulos"].value = res;
}


function eliminarNoticiaDestacados(strid,n) {
	//alert(strid);
	var nodo = getElement("mostrar_noticias_"+strid);
	nodo.outerHTML="";


	var valorPrevio = document.formulario["camposdestacados_"+n+"_noticias"].value;
	var v = valorPrevio.split(",");
	var res="";
	var i;
	for (i=0;i<v.length;i++) {
		if (v[i]!="") {
			if (v[i]!=strid) {
				res = res +","+v[i];
			}
		}
	}
	if (res!="") res=res.substring(1);
	document.formulario["camposdestacados_"+n+"_noticias"].value = res;
}

function camposSeleccionados() {

	var f = document.form_generacion;
	patron="set_";
	for(i=0;i<f.all.length;i++) {	
		var campo = f[i];
		if (campo!=null) {
			var nombreCampo = campo.name;
			if( nombreCampo.substring(0, patron.length)==patron && campo.checked == true){
				return true;
				break;
			}
		}
	}
}
function getElementDoc( ndoc, id) {
	var doc;
	doc = ndoc;
	if (doc==null) doc = document;
	var element;
	if (doc.getElementById==null) {
		element = doc.all[id];
	} else {
		element =doc.getElementById(id);
	}
	//alert("getElementDoc:"+id+"="+element+";");
	return element;
}
function eliminarDeListaMultiple(nombreCampo, codigo){
	var campo = "mostrar_" + nombreCampo + "_"+codigo;
	var oDiv = getElement(campo);
	//alert(campo);
	oDiv.style.display = "none";
	var nodo = getElement(nombreCampo);
	var lista=nodo.value;
	lista = eliminaDeLista(codigo, lista);
	nodo.value=lista;
	return lista.length==0;
}
function eliminaDeLista(strId, lista) {
	var listaSel = ","+lista+",";
	var posSel;
	posSel = listaSel.indexOf(","+strId+",");
	if (posSel!=-1) {
		listaSel = replaceSubstring( listaSel,","+strId+",", "," );
	}
			
	if (listaSel.charAt(0)==",") {
		listaSel = listaSel.substring(1,listaSel.length);
	} 	

	if (listaSel.charAt(listaSel.length-1)==",") {
		listaSel = listaSel.substring(0,listaSel.length-1);
	} 	

	return listaSel;
}
function eliminaDeLista2(valor,lista) {
	var posSel;
	var listaSel = ";"+lista+";";
	posSel =listaSel.indexOf(";"+valor+";");
	if (posSel!=-1) {
		listaSel = replaceSubstring( listaSel, ";"+valor+";", ";" );
	} else {
	}
	if (listaSel.indexOf(";")==0) listaSel=listaSel.substring(1);
	if (listaSel.lastIndexOf(";")==listaSel.length-1) listaSel=listaSel.substring(0,listaSel.length-1);
	return listaSel;
}
