/*
 * 	action.js
 * 		- modal dialog
 */ 



function loadingMask(msg)
{
	document.getElementById("messageText").innerHTML = msg;
	
	var img = document.createElement('img');
	img.src = "http://cache-01.cleanprint.net/media/pfviewer/images/loader.gif";
	
	img.width = 66;
	img.height = 66;

	document.getElementById("messageImage").appendChild(img);
	
	document.getElementById("loadingMaskDiv").style.display ='block';
	document.getElementById("loadingMaskMessageDiv").style.display ='block';
}

function errorMask(msg)
{
	document.getElementById("messageText").innerHTML = msg;
	
	var img = document.createElement('img');
	img.src = "http://cache-01.cleanprint.net/media/pfviewer/images/warnImg.jpg";
	img.width = 81;
	img.height = 66;

	document.getElementById("messageImage").appendChild(img);
	
	document.getElementById("loadingMaskDiv").style.display ='block';
	document.getElementById("loadingMaskMessageDiv").style.display ='block';
}


function removeLoadingMask()
{
	document.getElementById("loadingMaskDiv").style.display ='none';
	document.getElementById("loadingMaskMessageDiv").style.display ='none';
	document.getElementById("messageImage").innerHTML = "";
}
