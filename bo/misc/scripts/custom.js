function changeAdmin(valor) {
	var ss = document.styleSheets;
	var valor;
	if (valor) {
		ss["style_admin_off"].disabled=valor;
		ss["style_admin_on"].disabled=!valor;
		valor="1";
	} else {
		ss["style_admin_off"].disabled=valor;
		ss["style_admin_on"].disabled=!valor;
		valor="0";
	}
	var expdate = new Date ();
	FixCookieDate (expdate); // Correct for Mac date bug - call only once for given Date object!
	expdate.setTime (expdate.getTime() + (24 * 60 * 60 * 1000)); // 24 hrs from now 
	SetCookie ("edicion", valor, expdate);
	SetCookie ("otro", valor, expdate);
}

// Funciones para establecer Cookies mediante JS 
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
	return unescape(document.cookie.substring(offset, endstr));
}

function getCookie (name) {
	var arg = name + "=";
	var alen = arg.length;
	var clen = document.cookie.length;
	var i = 0;
	while (i < clen) {
	var j = i + alen;
	if (document.cookie.substring(i, j) == arg)
	return getCookieVal (j);
	i = document.cookie.indexOf(" ", i) + 1;
	if (i == 0) break; 
	}
	return null;
}