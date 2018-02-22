var reg_text =
{
      "reg_email":document.getElementByID("email"),
      "reg_password":document.getElementByID("password"),
      "reg_first_name":document.getElementByID("first_name"),
      "reg_last_name":document.getElementByID("last_name")
};

var reg_text =
{
      "log_email":document.getElementByID("email"),
      "log_password":document.getElementByID("password"),
};

function login()
{
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			document.getElementById("status").innerHTML = xhttp.responseText;
		}
	};
	xhttp.open("POST", "login.php", true);
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
	xhttp.open("POST", "register.php", true);
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
