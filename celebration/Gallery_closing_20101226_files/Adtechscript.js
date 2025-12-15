//OAS-Adtech migration script
//Created 2/26/08 by SSS-GMTI 
//Updated Regex change to determine the dynamic ads 3/31/2008 by sss-gmti
//Updated OAS_sitepage value to ignore the ending "/" and also updated new placement id 5/8/2008 by sss-gmti
//5/15/2008 -sss- updated the script tag so that link scanning software dont interpret the script tag.
//11/01/2008 -TGW/JLS/SSS - added AD_IFRAME_ROTATE and related routines 
//Script is mainly used to migrate from  OAS to Adtech.Still the calls will use OAS_AD function itself. 
//01/19/2009-YT-added CheckM8 JS functions
//09/23/2009 - AKlein - replaced default placement code (133600) with adtechdefaultplacement var

//Variable inizialization 
/*dictionary to hold references to adregions for updating populate by AD_IFRAME*/
var ad_regions = {};
/*array of ad positions populated by AD_IFRAME*/
var adpos_arr = new Array();
/*for those ad positions which won't have the dimensions in the name, can be specified here or appended to in code elsewhere  ex: ad_sizes["launchpad"]="600x280"; */
var ad_sizes = {};
/*default rotate interval in seconds for AD IFRAME Rotate */
var default_rotate=180;
/*minimum rotate interval in seconds for AD IFRAME Rotate*/
var min_rotate=60;

//Initial setup 
if (adtech_selected !=1){
	OAS_version = 11;
	if (navigator.userAgent.indexOf('Mozilla/3') != -1 || navigator.userAgent.indexOf('Mozilla/4.0 WebTV') != -1)
		OAS_version = 10;
	if (OAS_version >= 11)
		document.write('<scr'+'ipt language="javascript1.1" SRC="' + OAS_url + 'adstream_mjx.ads/' + OAS_sitepage + '/1' + OAS_rns + '@' + OAS_listpos + '?' + OAS_query +'"></scri'+'pt>');
}
else {
	var adtech_enabled = 0;	
	if (adtech_global_control ==1){
		var randomnumber = Math.round(Math.random()*3 + 1);
		if( randomnumber >  (4- adtech_throttle)){
			adtech_enabled = 1; 
			var keyword_counter=0;
			var keyvaluepair_counter=0;
			var g_keywordstring="";
			var g_keyvaluepairstring="";
			var g_sitepage=OAS_sitepage;
			//Add the query paramter to key value pair 
			AddKeyvaluepair(OAS_query);
			if (window.adgroupid == undefined) {
				window.adgroupid = Math.round(Math.random() * 1000000);
			}
			g_sitepage = g_sitepage.replace(/\/$/,''); 
		}
	}
}

//This the OAS_Ad which is being used by both OAS and Adtech to make calls. 
function OAS_AD(pos) {
 	if (adtech_selected !=1){
		if (OAS_version >= 11)
			OAS_RICH(pos);
		else
			OAS_NORMAL(pos);
	}
	else {
		//verify whether the Adtech was enabled in "Initial setup" section
		if(adtech_enabled==1){
			var posReg = RegExp(/(\d+)x(\d+)_(.*)/);
			var sizepos ="";
			var adtech_creativesize = "";
			var g_keywordtag ="";
			var g_keyvaluepairtag ="";

			if (pos.match(posReg)){
				adtech_creativesize = "-1";
				sizepos= pos.replace(/_\w$/, '');
				adtech_pos = "size="+sizepos+";";
			}
			else {
				adtech_creativesize = "0";
				adtech_pos = "";
			}
			if (g_keywordstring!= "")
				g_keywordtag ="key="+g_keywordstring+";";
			if (g_keyvaluepairstring != "")
				g_keyvaluepairtag=g_keyvaluepairstring+";";
			document.write('<scr'+'ipt language="javascript1.1" src="http://'+adtechserver+'/addyn/3.0/'+adtechnetworkid +'/' + adtechdefaultplacement + '/0/'+ adtech_creativesize +'/ADTECH;'+ adtech_pos +'alias='+ g_sitepage+'_'+pos+';cookie=info;loc=100;target=_blank;'+g_keywordtag+g_keyvaluepairtag+'grp='+window.adgroupid+';misc='+new Date().getTime()+'"></scri'+'pt>');	
		}
	}
}

//This function is only used by adtech to add the keyvaluepair to a variable. 
function AddKeyvaluepair(key){
    var querySplit = key.split("&");
	var keywordFound = 0;
	for(i = 0; i < querySplit.length ; i++){
		//Check whether the key is in key-value pair 
	    var keyvaluepairsplit = querySplit[i].split("=");			
		if (keyvaluepairsplit!="" && keyvaluepair_counter < 8){
			for (var j =0;j<adtech_keyvalue_Array.length;j++){
				if(adtech_keyvalue_Array[j].toLowerCase() == keyvaluepairsplit[0].toLowerCase()){
					keywordFound =1;
					break;
				}
			} //if found add the keyvalue pair to a string 
			if(keywordFound ==1){
				if (g_keyvaluepairstring=="")
					g_keyvaluepairstring= "kv"+querySplit[i];
			    else
					g_keyvaluepairstring = g_keyvaluepairstring +";" + "kv"+querySplit[i];
				keyvaluepair_counter++;
			}
			keywordFound=0;
		}
	}
}

//This function is only used by adtech to add the keywords to a variable. 
function AddKeyword(key){
    if (keyword_counter < 8){
		if (g_keywordstring=="")
			g_keywordstring= key;
		else
			g_keywordstring = g_keywordstring +"+" + key;
		keyword_counter++;
	}
}

//This function is called from the age to add an AdTech iframe ad
function OAS_AD_IFRAME(pos){
 
	var posReg = RegExp(/(\d+)x(\d+)_(.*)/);
	if (pos.match(posReg)){
		var ht_wd = pos.split("x");
		var wd = ht_wd[1].split("_");
		document.write("<IFRAME class=\"ad-frame\" WIDTH=\""+ht_wd[0]+"\" HEIGHT=\""+wd+"\" SCROLLING=\"No\" FRAMEBORDER=\"0\" MARGINHEIGHT=\"0\" MARGINWIDTH=\"0\"  src=\"\" id=\""+pos+"\">ad goes here when panel becomes active<\/IFRAME>");
	}
	else 
		document.write("<IFRAME class=\"ad-frame\" SCROLLING=\"No\" FRAMEBORDER=\"0\" MARGINHEIGHT=\"0\" MARGINWIDTH=\"0\"  src=\"\" id=\""+pos+"\">ad goes here when panel becomes active<\/IFRAME>");
}

/*builds the ad urls from the various bases and whatever params*/
function adtech_urls(pos,i_keyword){
	var iframe_src_base = "http://"+adtechserver+"/adiframe/3.0/";
	var script_src_base = "http://"+adtechserver+"/addyn/3.0/";
	var link_src_base = "http://"+adtechserver+"/adlink/3.0/";
	var img_src_base = "http://"+adtechserver+"/adserv/3.0/";
	if(adtech_enabled==1){
		var posReg = RegExp(/(\d+)x(\d+)_(.*)/);
		var sizepos ="";
		var adtech_creativesize = "";
		var g_keywordtag ="";
		var g_keyvaluepairtag ="";

		if (pos.match(posReg)){
			adtech_creativesize = "-1";
			sizepos= pos.replace(/_\w$/, '');
			adtech_pos = "size="+sizepos+";";
		}
		else {
			adtech_creativesize = "0";
			adtech_pos = "";
		}
		if (g_keywordstring!= "") {
			if (i_keyword!= "" && i_keyword!=undefined)
				g_keywordtag ="key="+i_keyword+"+"+g_keywordstring+";";
			else
				g_keywordtag ="key="+g_keywordstring+";";
		}
		else
			if (i_keyword!= "" && i_keyword!=undefined)
				g_keywordtag ="key="+i_keyword+";";
				
		if (g_keyvaluepairstring != "")
			g_keyvaluepairtag=g_keyvaluepairstring+";";
		var data = adtechnetworkid +"/" + adtechdefaultplacement + "/0/"+ adtech_creativesize +"/ADTECH;"+ adtech_pos +"alias="+ g_sitepage+"_"+pos+";cookie=info;loc=100;target=_blank;"+g_keywordtag+g_keyvaluepairtag+"grp="+window.adgroupid+";misc="+new Date().getTime();	
			
		return {iframe:iframe_src_base + data,
			script:script_src_base + data,
			link:link_src_base + data,
			img:img_src_base + data
		};
	}else{
		return {iframe:"",
			script:"",
			link:"",
			img:""
		};
	}
}

/*sets iframe src to pre-determined url thus refrshing the iframe*/
function placeAD(pos,i_keyword){
	ad_regions[pos].src = adtech_urls(pos,i_keyword).iframe;
}
            
/*gets size for ad pos looking up in ad_sizes dictionary*/
function resolveSize(pos){
	if(ad_sizes==undefined)
		return {width: undefined, height: undefined};

	/*look for var like*/
	pos_size_str = ad_sizes[pos];
	result = "";
	if (pos_size_str != undefined) {
		new_pos = pos_size_str+ "_" + pos;
		result = getAdDimensions(new_pos);
	}
	else {
		result = {width: undefined, height: undefined};
	}
	return result;
}

/*writes out iframe to be used for ads if dimensions is not specified it will attempt to resolve it either from the pos name itself or looking it up in a dictionary*/	
function AD_IFRAME(pos,dimensions){
	if(dimensions==undefined)
		dimensions = getAdDimensions(pos);
	if (dimensions.width == undefined) 
		dimensions = resolveSize(pos);
	if(dimensions.width==undefined)
		dimensions = getAdDimensions(dimensions + "_unknown");

	size = dimensions.width != undefined ? "width=\"" + dimensions.width + "\" height=\"" + dimensions.height + "\"" : "";
	iframeid = "_" + pos.replace(/ /g,"");
	document.write("<IFRAME class=\"ad-frame\"" + size + "  SCROLLING=\"No\" FRAMEBORDER=\"0\" MARGINHEIGHT=\"0\" MARGINWIDTH=\"0\"  src=\"\" id=\"" + iframeid + "\">ad goes here when panel becomes active<\/IFRAME>");
	ad_regions[pos] = $(iframeid);
	adpos_arr.push(pos);
}

/*does everything it can do to determine widthxheight from ad pos*/
function getAdDimensions(pos){
	var posReg = RegExp(/([0-9]+)x([0-9]+)_(.*)/);
	var sizepos = "";

	if (pos.match(posReg)) {
		sizepos = pos.split("_")[0];
		arrDim = sizepos.toUpperCase().split('X');
		if (arrDim.length >= 1) 
			return {width: arrDim[0],height: arrDim[1]};
		else 
			return {width: undefined,height: undefined};
	}
	else {
		return {width: undefined,height: undefined};
	}
}
            
/*writes out AD_IFRAME with a configured rotate interval*/	
function AD_IFRAME_ROTATE(adpos,dimensions,rotate){
	/*create iframe*/
	AD_IFRAME(adpos,dimensions != undefined ? getAdDimensions(dimensions + "_") : dimensions);
	/*initially place ad*/
	placeAD(adpos);
	/* set/fix rotate rate*/
	if(rotate==undefined)
		rotate = default_rotate;
	else{
		if(rotate<min_rotate)
			rotate = min_rotate;
	}
	/*from prototype.js*/
	new PeriodicalExecuter(function(pe){placeAD(adpos,"rotate");}, rotate);
}
/*  Ad function to refresh the ad on event based*/
function AD_IFRAME_REFRESH(adpos,dimensions){
	AD_IFRAME(adpos,dimensions != undefined ? getAdDimensions(dimensions + "_") : dimensions);
	/*initially place ad*/
	placeAD(adpos);
	}
	
/* ==================================================================== */
/* Defines function settings for CheckM8                       */
/* ==================================================================== */
function subs_count(fullString,subString){
		var _c = 0;
		for (var i=0;i<fullString.length;i++) {
			if (subString == fullString.substr(i,subString.length))
			_c++;
		}
		return _c;
}

/*Function used to extract the domain from the URL*/
function xtractDomain(){
		var para = document.URL;
		var domain = "";
		var re = /((http|ftp):\/)?\/?([^:\/\s]+)(\/)((\w+)*)?(\/)?([\w\-\.]+[^#?\s]+)?(.*)?(#[\w\-]+)?$/;
		var firstDomain = para.replace(re, "$3");
		var dotCount = subs_count(firstDomain,".");
		
		if (dotCount == "1"){
			var ra = /(.*\w)\.(.*\w)/;
			domain = firstDomain.replace(ra, "$1");
		};

		if (dotCount == "2"){
			var ra = /(.*\w)\.(.*\w)\.(.*\w)/;
			domain = firstDomain.replace(ra, "$2");
		};
		
		if (dotCount == "3"){
			var ra = /(.*\w)\.(.*\w)\.(.*\w)\.(.*\w)/;
			domain = firstDomain.replace(ra, "$3");
		};
		return domain;

}

/*Function used to extract the section from SSTS(OAS_SitePage)*/
function xtractSection(para){
		var re = /([^:\/\s]+)(\/)((\w+)*)?(\/)?([\w\-\.]+[^#?\s]+)?(.*)?(#[\w\-]+)?$/;
		var section = para.replace(re, "$3");
		
		return section;
}

/*Function used to extract the last string from SSTS(OAS_SitePage) NOT USED YET*/
function xtractFile(para){
		var slashCount = subs_count(para,"/");
		var m = para.match(/(.*)[\/\\]([^\/\\]+\.\w+)$/);
		var file = "";
		
		if(slashCount!='0'){file=m[2]} 
		else {file = ""};
		
		return file;
}

/*Function holding Assosiative Array (Hash)*/
function matchSections(sec){
		var combineSections = new Object();
		
		combineSections['umbrella'] = 'Home';
		combineSections['money'] = 'Business';
		combineSections['business'] = 'Business';
		combineSections['entertainment'] =	'Entertainment';
		combineSections['life']	= 'Entertainment';
		combineSections['news']	= 'News';
		combineSections['sports'] =	'Sports';
		combineSections['travel'] =	'Travel';
		
		if (typeof(combineSections[sec]) == 'undefined'){
		return "";
		} else {return combineSections[sec];}
		
}
