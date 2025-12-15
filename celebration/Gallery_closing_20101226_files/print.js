__ADTECH_CODE__ = "";
__theDocument = document;
__theWindow = window;
__bCodeFlushed = false;

function __flushCode() {
	if (!__bCodeFlushed) {
		var span = parent.document.createElement("SPAN");
		span.innerHTML = __ADTECH_CODE__;
		window.frameElement.parentNode.appendChild(span);
		__bCodeFlushed = true;
	}
}

if (typeof inFIF != "undefined") {
	document.write = function(str) {
		__ADTECH_CODE__ += str;
	};
	
	document.writeln = function(str) { document.write(str + "\n"); };

	__theDocument = parent.document;
	__theWindow = parent;
}
document.write("\n");
var sd = "";var dat= new Date(); if(typeof GDN == 'object') { if(GDN.Cookie.Exists(GDN.Cookies.GCION.Name)) { var ckie = GDN.Cookies.GCION.Get(); if(ckie.Yob()){sd += '&age=' + (dat.getFullYear() - ckie.Yob());} if(ckie.Gender()){(ckie.Gender()==1)?(sd +='&gender=f'):(sd += '&gender=m')}; } } sd += "&keyword=6423";
var cb = Math.random();
var d = document;
d.write('<script language="JavaScript" type="text/javascript"');
d.write('src="http://optimized-by.rubiconproject.com/a/4275/4799/6718-9.js?cb='+cb+sd+'">');
d.write('<\/scr'+'ipt>');
document.write("\n");
function cleanUp() {
	if (typeof __parent.swappedRefs == "undefined") {
		__parent.swappedRefs = new Array();
	}
		
	while (__parent.swappedRefs.length > 0) {
		var ref = __parent.swappedRefs.pop();
		if (ref != "swappedRefs") {
			__parent[ref] = null;
		}
	}
}

if (typeof inFIF != "undefined" && inFIF == true) {
	__parent = window.parent;
	window.onunload = cleanUp;
	cleanUp();

	
	for (var ref in window) {
		if ((typeof __parent[ref] == "undefined" || __parent[ref] == null) 
					&& ref != "frameElement" && ref != "event" && ref != "swappedRefs" && ref != "onunload") {
			try {__parent[ref] = window[ref]; __parent.swappedRefs.push(ref);} catch (e) {}
		}
	}	
}	




if (typeof inFIF != "undefined" && inFIF) {
	__flushCode();
}

if (typeof inFIF != "undefined" && inFIF == true) {
try {parent.write = write;
} catch (e) {}try {parent.writeln = writeln;
} catch (e) {}try {parent.__flushCode = __flushCode;
} catch (e) {}}

var adcount_1204325_1_=new Image();
adcount_1204325_1_.src="http://gannett.gcion.com/adcount/3.0/5111/1204325/0/154/AdId=157485;BnId=1;ct=315884081;st=510;adcid=1;itime=456213418;reqtype=5";
