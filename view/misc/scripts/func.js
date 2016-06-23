// ********************* Funciones Para los menus que siempre te salgan en pantalla con el nombre tabla_desplazar
function findScrollTop() {
	if (window.pageYOffset != null)
		return window.pageYOffset;
	if (document.body.scrollWidth != null)
		return document.body.scrollTop;
	return null;
}
var offsetTablaInicial = null;

function miOnScroll() {
	var top;
	//alert("scroll");
	if ( offsetTablaInicial==null) {
		offsetTablaInicial = document.all["tabla_desplazar"].offsetTop;
	} else {
		top = findScrollTop();
		if (top!=null) {
			if (top>offsetTablaInicial) {
				document.all["tabla_desplazar"].style.top = top;				
			} else {
				document.all["tabla_desplazar"].style.top = offsetTablaInicial;
			}
		}				
	}
}

function changeDisplay(id) {
	//Permite ocultar o ver un elemento:
	var nodo=document.all[id];
	if (nodo.style.display=="none") {
		nodo.style.display="block";
	} else {
		nodo.style.display="none";
	}
}

function openWindow(url, ancho, alto) {
	strancho=ancho;
	stralto=alto;
	if (ancho==null) strancho = 600;
	if (alto==null) stralto = 360;
	window.open(url,"","resizable=yes,status=1,scrollbars=1,width="+strancho+",height="+stralto,false);
}

function openLogin() {
	var url="popup_login.php";
	window.open(url,"","resizable=0,status=0,scrollbars=0,width=200,height=140",false);
	//window.open(url,"","",false);
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

function getElement( id, ndoc) {
	var element;
	if (ndoc==null) doc=document;
	else doc=ndoc;
	if (doc.getElementById==null) {
		element = doc.all[id];
	} else {
		element =doc.getElementById(id);
	}
	return element;
}

function toggleOcultacion(partner) {
	alert(partner);
	var table = getElement(partner);
	if (table!=null) {
		if (table.style.display=="none") table.style.display="block";
		else table.style.display="none";
	}
}

function mostrarOcultacion(partner) {
	var table = getElement(partner);
	table.style.display="block";	
}

function ocultarOcultacion(partner) {
	var table = getElement(partner);
	table.style.display="none";	
}

function urlencode(ch) {
   ch = escape(ch);
   ch = ch.replace(/[+]/g,"%2B");
   return  ch;
}

function esVacio2(s) {
		var res=false;
		if (s==null) res=true;
		else {
				if (s=="") res=true;
		}
		return res;
}

function esVacio(cadena) {
	if (trim(cadena)=="") return true;
	else return false;
}

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

function numDigitos( valor, ancho) {
	var res, i;
	res = valor +"";
	for (i=(res+"").length; i<ancho; i++) {
		res ="0"+ res;
	}
	return res;
}

function selectAll(f, valor) {
	var res, patron;
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

function getValor(item) {
		var res;
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


function set(nombre, valor) {
        var mivalor = valor;
        var strEval = "window.top."+nombre+"=valor;"
        eval(strEval);
}

function get(variable) {
        var strEval, res;
        strEval = "window.top."+variable;
        res = eval(strEval);
        if (res==undefined) res="";
    return res;
}


function setOpener(nombre, valor) {
        var mivalor = valor;
        var strEval = "window.opener.top."+nombre+"=valor;"
        eval(strEval);
}

function getOpener(variable) {
        var strEval, res;
        strEval = "window.opener.top."+variable;
        res = eval(strEval);
        if (res==undefined) res="";
    return res;
}

function setRadio(nombre, valor) {
		var res,item ;
		item = document.formulario[nombre];
		if (item!=null) {
				if (item.length!=null) {
						for (i=0;i<item.length;i++) {
								if (item[i].value==valor) {
										item[i].checked=true;
								}
						}
				} else {
					if (item.value==valor) item.checked=true;
				}
		}
		return res;
}

function resetRadio(nombre) {
	var res,item ;
	item = document.formulario[nombre];
	if (item!=null) {
		if (item.length!=null) {
			for (i=0;i<item.length;i++) {					
				item[i].checked=false;
			}
		}
	}
}

function perteneceLista2(valor,lista) {
        var res=false;
        pos =(";"+lista+";").indexOf(";"+valor+";");
        if (pos!=-1) {
                res=true;
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
/* Separa la cadena por el delimitador y coge la cadena a partir de la izquierda num veces*/
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


function eliminarImagen(tipo) {
	var ubicacion="ubicacion_"+tipo;
	document.formulario[ubicacion].value="";
	getElement('img_ubicacion_'+tipo).style.display='none';
	getElement('img_eliminar_'+tipo).style.display='none';
	return false;
}


/** Para mostrar n elementos */
/** Para mostrar n elementos */
/** Para mostrar n elementos */
	var idCampos=2;

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

function eliminarCampo(nodo) {
	var nodoPadre = getPadreConId(nodo);
	if (confirm('¿Seguro que desea eliminar este elemento?')) {
		var nodo = nodoPadre;
		nodo.parentNode.removeChild( nodo );		
	}
	return false;
}

	function getIdentificadorPadre(nodo) {
		var nodoPadre = getPadreConId(nodo);
		var res=nodoPadre.id;
		return res;
	}

	function getIdentificadorPadreIndice(nodo) {
		var nodoPadre = getPadreConId(nodo);
		var v = nodoPadre.id.split("_");
		var res="";
		res = v[1];
		return res;
	}

	function getPadreConId(nodo) {
		var res=null;
		//alert(nodo);
		if (nodo.id!=null) {
			if (nodo.id!="") {
				res = nodo;
			}
		}
		if (res==null) res = getPadreConId(nodo.parentNode);
		return res;
	}

	function eliminarCampo(nodo,strTitle) {
		var nodoPadre = getPadreConId(nodo);
		if (confirm('¿Seguro que desea eliminar este elemento?')) {
			var nodo = nodoPadre;
			nodo.parentNode.removeChild( nodo );		
		}
		return false;
	}


function aniadirQuery(url, resto) {
	var res;
	if (url.indexOf('?')==-1) {
		res = url +'?'+resto;
	} else {
		res = url +'&'+resto;
	}
	return res;
}

function str2double(str) {
	var dvalue;
	dvalue = parseFloat(replaceSubstring( replaceSubstring(str,".",""),",",".") );
	return dvalue;

}

//Pasa un valor real a cadena con 2 decimales y separador de miles.
function double2moneda (numero) {
	//1. Redondeo a 2 decimales
	var cadena = Math.round( numero * 100)+"";
	if (cadena.length==1) {
		cadena = "0"+cadena+"0";
	} else if (cadena.length==2) {
		cadena = "0"+cadena;
	}
	//alert(numero+" ::: "+cadena+" :: "+cadena.length);
	var res = cadena.substring( 0, cadena.length-2) + "," + cadena.substring( cadena.length-2, cadena.length);
	//alert("Cadena="+cadena+"; res="+res+"; numero="+numero+"; otro="+cadena.substring( cadena.length-2, cadena.length));

	var parteEntera = res.substring( 0, res.length-3);
	var num = "";
	var lon = parteEntera.length;
	for (j = 0; j < lon; j++){
		if ((j % 3 == 0) && (j > 0))
			num = "." + num;
		num = parteEntera.charAt(lon - j - 1) + num;
	}
	res = num + res.substring( res.length-3, res.length);
	return res;
}

function FormatNumber(num,decimalNum,bolLeadingZero,bolParens,bolCommas)
/**********************************************************************
	IN:
		NUM - the number to format
		decimalNum - the number of decimal places to format the number to
		bolLeadingZero - true / false - display a leading zero for
										numbers between -1 and 1
		bolParens - true / false - use parenthesis around negative numbers
		bolCommas - put commas as number separators.
 
	RETVAL:
		The formatted number!
 **********************************************************************/
{ 
        if (isNaN(parseInt(num))) return "NaN";

	var tmpNum = num;
	var iSign = num < 0 ? -1 : 1;		// Get sign of number
	
	// Adjust number so only the specified number of numbers after
	// the decimal point are shown.
	tmpNum *= Math.pow(10,decimalNum);
	tmpNum = Math.round(Math.abs(tmpNum))
	tmpNum /= Math.pow(10,decimalNum);
	tmpNum *= iSign;					// Readjust for sign


	// Create a string object to do our formatting on
	var tmpNumStr = new String(tmpNum);

	// See if we need to strip out the leading zero or not.
	if (!bolLeadingZero && num < 1 && num > -1 && num != 0)
		if (num > 0)
			tmpNumStr = tmpNumStr.substring(1,tmpNumStr.length);
		else
			tmpNumStr = "-" + tmpNumStr.substring(2,tmpNumStr.length);
		
	// See if we need to put in the commas
	if (bolCommas && (num >= 1000 || num <= -1000)) {
		var iStart = tmpNumStr.indexOf(".");
		if (iStart < 0) {
			iStart = tmpNumStr.length;
		}

		iStart -= 3;
		while (iStart >= 1) {
			tmpNumStr = tmpNumStr.substring(0,iStart) + "," + tmpNumStr.substring(iStart,tmpNumStr.length)
			iStart -= 3;
		}	
	}

	// See if we need to use parenthesis
	if (bolParens && num < 0)
		tmpNumStr = "(" + tmpNumStr.substring(1,tmpNumStr.length) + ")";

	var pos = tmpNumStr.indexOf(".");
	if (pos<0) {
		tmpNumStr = tmpNumStr+".";
		for (i=0;i<decimalNum;i++) {
			tmpNumStr+="0";
		}
	} else {
		//alert(tmpNumStr + "===" + decimalNum + "*" + tmpNumStr.length + "*" + pos );
		for (;tmpNumStr.length-pos<decimalNum+1;i++) {
			tmpNumStr+="0";
		}
	}
	res = replaceSubstring(tmpNumStr,".",",");
	if (decimalNum==0) {
		alert( res.substring(res.length-1) );
		if (res.substring(tmpNumStr.length-1)==",") {
			res = res.substring(0,res.length-1);
		}
	}
	return res	// Return our formatted string!
}


	//function to check valid email address
	function isValidDigit(str){
		var validRegExp = /^[0-9]+$/i;
		res=true;
		// search email text for regular exp matches
		if (str.search(validRegExp) == -1) {
			res=false;
		} 
		return res; 
	}

function esNumericoDecimal(str){
	var validRegExp = /^[0-9]+(\,[0-9]+)?$/i;
	res=true;
	// search email text for regular exp matches
	if (str.search(validRegExp) == -1) {
		res=false;
	} 
	return res; 
}

function esNumerico(str){
	var validRegExp = /^[0-9]+$/i;
	res=true;
	// search email text for regular exp matches
	if (str.search(validRegExp) == -1) {
		res=false;
	} 
	return res; 
}

function numDigitos(numero, numDigitos) {
	var res=""+numero;
	while (res.length<numDigitos) {
		res = "0"+res;
	}
	return res;
}

function compruebaFecha(strFecha) {
	var res=false;
	var mmddaaaa = strFecha.substring(4,6) +"/"+ strFecha.substring(6,8) +"/"+ strFecha.substring(0,4);	
	if (isDate(mmddaaaa)) {
		res=true;
	} else {

	}
	return res;
}



/*** FUNCIONES DE FECHA ***/
/*** FUNCIONES DE FECHA ***/
/*** FUNCIONES DE FECHA ***/

var dtCh= "/";
var minYear=1000;
var maxYear=3000;

function isInteger(s){
	var i;
    for (i = 0; i < s.length; i++){   
        // Check that current character is number.
        var c = s.charAt(i);
        if (((c < "0") || (c > "9"))) return false;
    }
    // All characters are numbers.
    return true;
}

function stripCharsInBag(s, bag){
	var i;
    var returnString = "";
    // Search through string's characters one by one.
    // If character is not in bag, append to returnString.
    for (i = 0; i < s.length; i++){   
        var c = s.charAt(i);
        if (bag.indexOf(c) == -1) returnString += c;
    }
    return returnString;
}

function daysInFebruary (year){
	// February has 29 days in any year evenly divisible by four,
    // EXCEPT for centurial years which are not also divisible by 400.
    return (((year % 4 == 0) && ( (!(year % 100 == 0)) || (year % 400 == 0))) ? 29 : 28 );
}
function DaysArray(n) {
	for (var i = 1; i <= n; i++) {
		this[i] = 31
		if (i==4 || i==6 || i==9 || i==11) {this[i] = 30}
		if (i==2) {this[i] = 29}
   } 
   return this
}

function isDate(dtStr){
	var daysInMonth = DaysArray(12)
	var pos1=dtStr.indexOf(dtCh)
	var pos2=dtStr.indexOf(dtCh,pos1+1)
	var strMonth=dtStr.substring(0,pos1)
	var strDay=dtStr.substring(pos1+1,pos2)
	var strYear=dtStr.substring(pos2+1)
	strYr=strYear
	if (strDay.charAt(0)=="0" && strDay.length>1) strDay=strDay.substring(1)
	if (strMonth.charAt(0)=="0" && strMonth.length>1) strMonth=strMonth.substring(1)
	for (var i = 1; i <= 3; i++) {
		if (strYr.charAt(0)=="0" && strYr.length>1) strYr=strYr.substring(1)
	}
	month=parseInt(strMonth)
	day=parseInt(strDay)
	year=parseInt(strYr)
	if (pos1==-1 || pos2==-1){
		//alert("The date format should be : mm/dd/yyyy")
		return false
	}
	if (strMonth.length<1 || month<1 || month>12){
		//alert("Please enter a valid month")
		return false
	}
	if (strDay.length<1 || day<1 || day>31 || (month==2 && day>daysInFebruary(year)) || day > daysInMonth[month]){
		//alert("Please enter a valid day")
		return false
	}
	if (strYear.length != 4 || year==0 || year<minYear || year>maxYear){
		//alert("Please enter a valid 4 digit year between "+minYear+" and "+maxYear)
		return false
	}
	if (dtStr.indexOf(dtCh,pos2+1)!=-1 || isInteger(stripCharsInBag(dtStr, dtCh))==false){
		//alert("Please enter a valid date")
		return false
	}
return true
}

function ValidateForm(){
	var dt=document.frmSample.txtDate
	if (isDate(dt.value)==false){
		dt.focus()
		return false
	}
    return true
 }


	
/*** FIN FUNCIONES DE FECHA ***/
/*** FIN FUNCIONES DE FECHA ***/
/*** FIN FUNCIONES DE FECHA ***/