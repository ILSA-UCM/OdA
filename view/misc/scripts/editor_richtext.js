function Ejecuta(editor, accion, opcion) {
	editor.focus();
	if (opcion=="removeFormat") {
		accion=opcion;
		opcion=null;
	}

	if (editor.document.queryCommandEnabled(accion)){
		if (opcion==null)
			editor.document.execCommand(accion);
		else 
			editor.document.execCommand(accion,"",opcion);
	}
	else {
		if ((accion != "undo") && (accion != "redo"))	
			window.alert("No se puede ejecutar la acción deseada sobre la selección actual.");
	}
  
	editor.focus();
}

function EjecutaSiSeleccion(editor, accion){
    if (editor.document.selection.type!="None") {
		Ejecuta(editor, accion);
    }
}

function Enlace (editor) {
    if (editor.document.selection.type=="None") {    	
		var vals = window.showModalDialog ("editor/enlaces.html", null,"scroll:no;status:no;dialogWidth:480px;dialogHeight:180px");
		
		if ((vals != null) && (vals["Address"] != "") && (vals["Texto"] != "")){
			editor.focus();
			var tr = editor.document.selection.createRange();
		    tr.pasteHTML("<A HREF=\""+ vals['Tipo'] + vals['Address']+"\">"+vals['Texto']+"</A> ");
			tr.select();
		}
	}
	else {
		var tr = editor.document.selection.createRange();
		var vals = window.showModalDialog ("editor/enlaces.html", tr.text, "scroll:no;status:no;dialogWidth:450px;dialogHeight:200px");
		if ((vals != null) && (vals["Address"] != "")){
		  Ejecuta(editor, "CreateLink",vals["Tipo"] + vals["Address"]);
		}
	}	
}
function Fuente (editor) {
	var vals = window.showModalDialog ("editor/fuente.html",null,"directories=no;location:no;menubar:no;resizable:no;scrollbar:no;status:no;toolbar:no;");
	if (vals != null){		
		if (vals["Fuente"]!="") {
			var tr = editor.document.selection.createRange();
			//Elimino del contenido de la selección los spanes con clase texto_titulo
			var cadena = tr.htmlText;
	        var re = new RegExp("<SPAN class=[^ >]*>","g");
	        var res = cadena.replace(re, "<SPAN class="+vals["Fuente"]+">");

		    tr.pasteHTML("<span class='"+ vals["Fuente"] +"'>"+res+"</span>");
			tr.select();			
		} 
	}
}

function Fuente2 (editor) {
	var nodo, nodoIni, nodoFin , tr, tr2, trInicial, trFinal;
	var vals = window.showModalDialog ("editor/fuente.html",null,"directories=no;location:no;menubar:no;resizable:no;scrollbar:no;status:no;toolbar:no;");
	if (vals != null){		
		if (vals["Fuente"]!="") {
			if (editor.document.selection.type!="None") {
				tr = editor.document.selection.createRange();
				tr.expand();
				texto = tr.htmlText;
				nuevoTexto = texto;
				debug( "Fuente - tr.htmlText: " + texto );

				//Quito los spanes para comparar:
				var re = new RegExp("<.?SPAN( )?([^ >]*)>","g");
				nuevoTexto = nuevoTexto.replace(re, "");
				//Si no tiene marcas utilizo SPANS, busco el padre.
				if (nuevoTexto.indexOf("<")<0) {
					encontrado = false;
				} else {
					encontrado = true;
				}
				if (!encontrado) {
					tr.pasteHTML("<span class='"+ vals["Fuente"] +"'>"+nuevoTexto+"</span>");
					//tr.move("character",0)
				} else {
					tr2 = tr.duplicate();
					tr2.move("character",0)
					nodoIni = tr2.parentElement();
					while (nodoIni.tagName=="SPAN") {
						nodoIni= nodoIni.parentElement;
					}

					trInicial = editor.document.selection.createRange();
					trInicial.moveToElementText(nodoIni);
					trInicial.setEndPoint("EndToStart", tr);

					debug( "Fuente - Parrafo inicial: *" + trInicial.htmlText +"* de *"+tr.htmlText);
					htmlInicial = trInicial.htmlText;

					
					tr2 = tr.duplicate();
					tr2.collapse(false);
					nodoFin = tr2.parentElement();
					while (nodoFin.tagName=="SPAN") {
						nodoFin = nodoFin.parentElement;
					}

					debug( "Fuente - Nodo Final: *" + nodoFin.outerHTML );

					trFinal = editor.document.selection.createRange();
					trFinal.moveToElementText(nodoFin);				
					trFinal.setEndPoint("StartToEnd", tr);
					htmlFinal = trFinal.htmlText;
					debug( "Fuente - Parrafo Final: *" + trFinal.htmlText +"* de *"+tr.htmlText );

					var re = new RegExp("<.?SPAN( )?([^ >]*)>","g");
					texto = texto.replace(re, "");

					var re = new RegExp("<P( )?([^ >]*)>","g");
					texto = texto.replace(re, "<P$1$2><SPAN CLASS='"+ vals["Fuente"] +"'>");

					var re = new RegExp("</P>","g");
					texto = texto.replace(re, "</SPAN></P>");

					var re = new RegExp("<LI( )?([^ >]*)>","g");
					texto = texto.replace(re, "<LI$1$2><SPAN CLASS='"+ vals["Fuente"] +"'>");

					var re = new RegExp("</LI>","g");
					texto = texto.replace(re, "</SPAN></LI>");

					var re = new RegExp("<OL( )?([^ >]*)>","g");
					texto = texto.replace(re, "<OL$1$2><SPAN CLASS='"+ vals["Fuente"] +"'>");

					var re = new RegExp("</OL>","g");
					texto = texto.replace(re, "</SPAN></OL>");

					var re = new RegExp("<UL( )?([^ >]*)>","g");
					texto = texto.replace(re, "<UL$1$2><SPAN CLASS='"+ vals["Fuente"] +"'>");

					var re = new RegExp("</UL>","g");
					texto = texto.replace(re, "</SPAN></UL>");

					//Añado el comienzo del parrafo a el párrafo
					pos = texto.indexOf(">");
					texto = texto.substr(0,pos+1)+ htmlInicial +texto.substr(pos+1)

					pos = texto.lastIndexOf("</");
					texto = texto.substr(0,pos)+ htmlFinal +texto.substr(pos)

					debug( "Fuente - Texto Final: " + texto +"\ny nodo.innerHTML=");

					//nodoIni.outerHTML=texto;
					//nodoFin.outerHTML="";
					trInicial.setEndPoint("EndToEnd", trFinal);
					trInicial.pasteHTML(texto);
				}
					//trInicial.select();

					//tr.pasteHTML(texto);
					//nodo.innerHTML = htmlInicial;

					//debug();
				/*} else {
					//debug("Fuente: "+texto);
					tr.move("character",0);
					pini = tr.parentElement();
					//Itero por los parrafos hasta que encuentre el fin y lo establezco
					pini.className = vals["Fuente"];

					//debug("Fuente: P="+pini.outerHTML);

					//tr.pasteHTML("<span class='"+ vals["Fuente"] +"'>");
				}*/

			}
		} 
	}
}
function getXML(url) {
    var xmlDoc;
    xmlDoc = new ActiveXObject("MSXML2.DOMDocument")
    xmlDoc.async=false;
    xmlDoc.load(url);
    return xmlDoc;
}

function debug(cadena) {
	//getXML("http://trinity.red.vsf.es:91/editor/debug.asp?msg="+cadena);
}


function insertaTabla(editor){
	editor.focus();	
	var vals = window.showModalDialog ("editor/tabla.html",null,"directories=no;location:no;menubar:no;resizable:no;scrollbar:no;status:no;toolbar:no;");
	if (vals != null){
		var cadTabla = construyeCadenaTabla(vals);
		var tr = editor.document.selection.createRange();
		tr.pasteHTML(cadTabla);
		tr.select();	
	}	
}

function construyeCadenaTabla(vals){
	var cadBor;
	var strAux = "<TABLE ";
	
	// El borde.
	if (vals["Borde"] == "0") {
		strAux += "BORDER='1' ";
		cadBor = "STYLE='border-style:dotted; font:10pt arial,sans-serif' ";
		strAux += cadBor;
	}
	else {
		strAux += "BORDER='" + vals["Borde"] + "' ";
		strAux += "STYLE='font:10pt arial,sans-serif' ";
		cadBor = "";
	}
	
	// El ancho.
	strAux += "WIDTH='" + vals["Ancho"] + vals["Medida"] + "' ";
	
	// El espacio entre celdas.
	if (vals["EspacioCelda"] != "")
		strAux += "CELLSPACING='" + vals["EspacioCelda"] + "' ";
		
	// El relleno de la celda.
	if (vals["EspacioCelda"] != "")
		strAux += "CELLPPADING='" + vals["EspacioCelda"] + "' ";

	// Final inicio tabla.
	strAux += ">";
	
	// Las filas y columnas.
	numFilas = parseInt(vals["Filas"]);
	numColumnas = parseInt(vals["Columnas"]);
	for(i = 0;(i < numFilas); i++) {
		strAux += "<TR>";
		for(j = 0;(j < numColumnas); j++) {
			strAux += "<TD " + cadBor + "></TD>";
		}
		strAux += "</TR>";
	}
	
	// Final de tabla.
	strAux += "</TABLE>";
	return strAux;
}


  var ventana=null, i=0;

  function abrirVentana(nombre){
    if (ventana!=null) {
	     if (!ventana.closed) ventana.close();
    }
    ventana=window.open(nombre,"ventana"+(i++),"screenX=10, screenY=10,width=400,height=300,menubar=0,directories=0,status=0,scrollbars=1,alwaysRaised=1");
  }
  
function Imagen(editor, nombreCampo){
	//Obtengo el ultimo id de la lista de elementos de imagenes
	var nodes = window.parent.document.getElementById(nombreCampo+"_lineas_imagenes").getElementsByTagName("TR");
	var numeroFila = nodes[ nodes.length-1 ].getAttribute("id").substring( (nombreCampo+"_imagen_fila_").length,100);
	var nombreFile = nombreCampo+"_imagen_"+numeroFila+"_myfile";

	debug("Imagen: "+nombreFile);

	window.top.nombreFile = nombreFile;
	var miarray=new Array(self, nombreFile)
	var val = window.showModalDialog ("editor/imagen.html?id="+8, miarray ,"scroll:no;status:no;dialogWidth:450px;dialogHeight:200px");
	if (val!=null) {
		var nombreUrl=null;
		var alineacion = val[2];
		var texto_alternativo=  val[3];
		if (val[0]=="url") {
			nombreUrl = val[1];
		} else if (val[0]=="file") {
			var nombreFile = val[1];
			nombreUrl = "download/"+nombreFile;
		}
		if (nombreUrl!=null) {
			editor.focus();
			if (editor.document.queryCommandEnabled('InsertImage','vValue')){
				//editor.document.execCommand('InsertImage','bUserInformation');
				editor.document.execCommand('InsertImage', false , nombreUrl );
				// Buscamos la imagen que no tiene id: es la insertada.
				for(var i=0;(i < editor.document.images.length); i++){
					var id = editor.document.images.item(i).id;
					if (id == "") {// Le ponemos id.				
						editor.document.images.item(i).id = dameClave();
						editor.document.images.item(i).align = alineacion;
						editor.document.images.item(i).alt = texto_alternativo;
					}
				}
			}
		}
	}
}

function Fondo(editor) {
	colorDialog.CancelError = true;
	try {
		colorDialog.ShowColor();
	}catch (e){
		var vals = window.showModalDialog ("editor/color.html",null,"directories=no;location:no;menubar:no;resizable:no;scrollbar:no;status:no;toolbar:no;");
		if (vals != null)
			Ejecuta('BackColor', vals['Color']);
		else 
			return;
	}
	var color = colorDialog.Color;
	Ejecuta('BackColor', color);
}

function dameClave(editor){
	var fecha = new Date();
	return "img" + fecha.getDate() + fecha.getMonth() + fecha.getYear() + fecha.getHours() + fecha.getMinutes() + fecha.getSeconds();
}


function confirmarEliminacionImagen() {
	return confirm('¿Está usted seguro que no desea subir esta imagen al servidor?');
}

function habilitaFilesImagenes(campo) {
/*	var nodes = document.getElementById(campo+"_lineas_imagenes").getElementsByTagName("TR");
	var numeroFila, num;
	for (i=1; i<nodes.length ; i++) {
		numeroFila = nodes[ i ].getAttribute("id").substring( (campo+"_imagen_fila_").length,100);
		num = parseInt(numeroFila);
		document.getElementById(campo+"_imagen_"+num+"_myfile").disabled = false;
	}*/
}


// Borra la fila idFila de la tabla idTabla.
function borraFila(idTabla, idFila){
	// Buscamos la tabla y buscamos su cuerpo.
	var tbody = tablaYCuerpo(idTabla);
	// Buscamos la fila a borrar.
	var fila = document.getElementById(idFila);
	if (fila != null) {
		tbody.removeChild(fila);
	}
}


function nuevoNumero(idTabla, prefijo) {
		var nodes = document.getElementById(idTabla).getElementsByTagName("TR");
		var numeroFila = nodes[ nodes.length-1 ].getAttribute("id").substring( (prefijo + "fila_").length,100);

		var num = parseInt(numeroFila) + 1;
		return num;
}

// Añade una nueva fila a la tabla de identificador id,
// siempre que la fila numFila sea la última fila y 
// esté sin modificar.
function ponFilaPrefijo (idTabla, numFila, prefijo, elementos) {
	//var elementos = new String("borrar nombre tamanio idtipo destacado url file");
	var re = / /
	var elementosDeFila= elementos.split (re);

	var i, strElemento;
	// Nos aseguramos de que hay que insertar una fila
	// (estamos en la última fila y está sin modificar).
	var imagen = document.getElementById(prefijo + numFila + "_borrar");
	if ((imagen != null) && (imagen.style.visibility == 'hidden')){
		// Hacemos visible la imagen.
		//imagen.style.visibility = 'visible';

		// Buscamos la tabla y buscamos su cuerpo.
		var tbody = tablaYCuerpo(idTabla);
		// Buscamos un identificador para la nueva fila.


		// Buscamos un identificador para la nueva fila.
		var num = nuevoNumero(idTabla, prefijo);

		// Creamos las celdas, las añadimos a una fila, 
		// y la fila a la tabla.
		var fila = document.createElement("TR");
		fila.setAttribute("id", prefijo+"fila_"+num);

		var re1 = /\d+_/g;
		var re2 = /_\d+/g;
		var re3 = /,\d+/g;
	//	var re4 = /value=\d+/g;
		
		for (i=0; i<elementosDeFila.length; i++) {
			strElemento=elementosDeFila[i];
			var td = document.createElement("TD");
			var elemCopia = document.getElementById(prefijo+numFila+"_"+strElemento);
			var valorOld = elemCopia.getAttribute("value");
			elemCopia.setAttribute("value", "");
			str = document.getElementById(prefijo+numFila+"_"+strElemento).outerHTML;
			newStr = str.replace(re1, num+"_").replace(re2, "_"+num).replace(re3, ","+num);
			td.innerHTML = newStr;
			fila.appendChild(td);
			elemCopia.setAttribute("value", valorOld);
		}
		debug("ponFilaPrefijo - Append: "+fila.outerHTML);
		tbody.appendChild(fila);

		//Hacemos visibles los elementos de la fila que aparece
		for (i=0; i<elementosDeFila.length; i++) {
			strElemento=elementosDeFila[i];
			//alert(numFila+"_"+strElemento);
			document.getElementById(prefijo+numFila+"_"+strElemento).style.visibility = 'visible';
		}
	}
}


// Función para buscar una tabla y su cuerpo
function tablaYCuerpo (id){
	// Buscamos la tabla y buscamos su cuerpo.
	var tabla = document.getElementById(id);
	if (tabla == null){
		window.alert("Error al buscar la tabla.");
		return null;
	}
	var aux = tabla.firstChild;
	while((aux != null) && (aux.tagName != "TBODY"))
		aux = aux.nextSibling;
	if (aux == null){
		window.alert("Error al encontrar el TBODY.");
		return null;
	}
	return aux;
}