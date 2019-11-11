function getXMLHTTPRequest() {
var req = false;
try {
/* for Firefox */
req = new XMLHttpRequest();
} catch (err) {
try {
/* for some versions of IE */
req = new ActiveXObject("Msxml2.XMLHTTP");
} catch (err) {
try {
/* for some other versions of IE */
req = new ActiveXObject("Microsoft.XMLHTTP");
} catch (err) {
req = false;
}
}
}
return req;
}

function setSub(a){
var xmlhttp = getXMLHTTPRequest();
//get input value
var id = a;
//set url and inner
var url = "process_kategorisasi.php?id=" + id;
var inner = "side-nav";
//open request
xmlhttp.open('GET', url, true);
xmlhttp.onreadystatechange = function() {
document.getElementById(inner).innerHTML = '<imgsrc="images/ajax_loader.png"/>';
setProduk(a,0);
if ((xmlhttp.readyState == 4) && (xmlhttp.status == 200)){
document.getElementById(inner).innerHTML = xmlhttp.responseText;
}
return false;
}
xmlhttp.send(null);
}

function setProduk(a,b){
var xmlhttp = getXMLHTTPRequest();
//get input value
var id = a;
var ids = b;
//set url and inner
var url = "proses_subkategorisasi.php?id="+id+"&ids=" + ids;
var inner = "barang";
//open request
xmlhttp.open('GET', url, true);
xmlhttp.onreadystatechange = function() {
document.getElementById(inner).innerHTML = '<imgsrc="images/ajax_loader.png"/>';
if ((xmlhttp.readyState == 4) && (xmlhttp.status == 200)){
document.getElementById(inner).innerHTML = xmlhttp.responseText;
}
return false;
}
xmlhttp.send(null);
}

function setCari(){
var xmlhttp = getXMLHTTPRequest();
//get input value
var key = document.getElementById('cari').value;
//set url and inner
var url = "process_cari.php?key="+key;
var inner = "barang";
//open request
xmlhttp.open('GET', url, true);
xmlhttp.onreadystatechange = function() {
document.getElementById(inner).innerHTML = '<imgsrc="images/ajax_loader.png"/>';
if ((xmlhttp.readyState == 4) && (xmlhttp.status == 200)){
document.getElementById(inner).innerHTML = xmlhttp.responseText;
}
return false;
}
xmlhttp.send(null);
}

function hideImg(){
	document.getElementById('banner').style.visibility='hidden';
}

