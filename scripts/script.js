function errorHead(error) {
	document.getElementById("register_issue_heading").innerHTML = error;
}

function errorContent(errorCont) {
	document.getElementById("register_issue_content").innerHTML = errorCont;
}

function hideregister() {
	document.getElementById("registeroverlay").style.display = 'none';
	document.getElementById("registerform").style.display = 'none';
	document.getElementById("registerclose").style.display = 'none';
}

function showRegister() {
	document.getElementById("registeroverlay").style.display = 'block';
	document.getElementById("registerform").style.display = 'block';
	document.getElementById("registerclose").style.display = 'block';
}


function hidelogin() {
	document.getElementById("loginoverlay").style.display = 'none';
	document.getElementById("loginform").style.display = 'none';
	document.getElementById("loginclose").style.display = 'none';
}

function showlogin() {
	document.getElementById("loginoverlay").style.display = 'block';
	document.getElementById("loginform").style.display = 'block';
	document.getElementById("loginclose").style.display = 'block';
}

function LerrorHead(error) {
	document.getElementById("login_issue_heading").innerHTML = error;
	document.getElementById("login_issue_heading").innerHTML = error;
}

function LerrorContent(errorCont) {
	document.getElementById("login_issue_content").innerHTML = errorCont;
}
