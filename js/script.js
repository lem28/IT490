// date and time
function makeArray()
{
	for(i = 0; i < makeArray.arguments.length; i++) this[i + 1] = makeArray.arguments[i];
}
function date()
{
	var months = new makeArray('january', 'february', 'march', 'april',
	'may', 'june', 'july', 'august',
	'september', 'october', 'november', 'december');
	var date = new Date();
	var day = date.getDate();
	var month = date.getMonth() + 1;
	var yy = date.getYear();
	var year = (yy < 1000) ? yy + 1900 : yy;
	document.getElementById('date').innerHTML = months[month] + " " + day + ", " + year;
}
function startTime()
{
	var today = new Date();
	var h = today.getHours();
	var m = today.getMinutes();
	var s = today.getSeconds();
	m = checkTime(m);
	s = checkTime(s);
	document.getElementById('time').innerHTML = h + ":" + m + ":" + s;
	var t = setTimeout(function()
	{
		startTime()
	}, 500);
}
function checkTime(i)
{
	if(i < 10)
	{
		i = "0" + i
	};
	return i;
}
function init()
{
	date();
	startTime();
}
// AJAX solution
var reg_text =
{
	"reg_username":document.getElementById("reg_usr") ,
	"reg_password":document.getElementById("reg_pwd") ,
	"reg_firstName":document.getElementById("first_name") ,
	"reg_lastName":document.getElementById("last_name") ,
	"reg_email":document.getElementById("email")
};

var log_text =
{
	"log_username":document.getElementById("log_usr") ,
	"log_password":document.getElementById("log_pwd")
};

function login()
{
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			document.getElementById("status").innerHTML = xhttp.responseText;
		}
	};
	xhttp.open("POST", "../php/handler.php?r=login", true);
	xhttp.send(JSON.stringify(log_text));
}

function register()
{
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			document.getElementById("status").innerHTML = xhttp.responseText;
		}
	};
	xhttp.open("POST", "../php/handler.php?r=register", true);
	xhttp.send(JSON.stringify(reg_text));
}

function logout()
{
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			document.getElementById("status").innerHTML = xhttp.responseText;
		}
	};
	xhttp.open("POST", "../php/handler.php?r=logout", true);
	xhttp.send();
}

function upload()
{
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			document.getElementById("status").innerHTML = xhttp.responseText;
		}
	};
	xhttp.open("POST", "../php/handler.php?r=upload", true);
	xhttp.send();
}

function browse()
{
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			document.getElementById("status").innerHTML = xhttp.responseText;
		}
	};
	xhttp.open("POST", "../php/handler.php?r=browse", true);
	xhttp.send();
}
