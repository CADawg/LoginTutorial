<?php session_start(); ?>
<!DOCTYPE HTML>
<html>
<head>
<script src="/Auth/scripts/jquery-3.1.1.min.js"></script>
<script src="/Auth/scripts/script.js"></script>
<title>Login</title>
<link rel="stylesheet" href="/Auth/styles/w3.css">
<link rel="stylesheet" href="/Auth/styles/style.css">

</head>

<body>
<h1>You Have Successfully Logged In!</h1>
<div class="darkClass w3-animate-top" id="loginoverlay" style="display:none;" width="100%" height="100%">
<div class="w3-container w3-red">
  <h3 id="login_issue_heading">Generic Error While Logging In.</h3>
  <p id="login_issue_content">Try Again?</p>
</div> <div id="loginclose"></div>
<form action="sublogin.php<?php if (isset($_GET['r'])) { echo "?r=" . $_GET['r']; }?>" class="w3-panel w3-white w3-container w3-round-large w3-animate-top" style="width: 400px; margin: auto; display:none;" id="loginform" method="post">
<input type="text" style="margin: auto;border-bottom-color: orange;border-bottom-style: solid;border-bottom-width: 2px;" class="w3-animate-top w3-input" required name="loginas"/>
<h4 style="text-align: center;" class="w3-label w3-validate w3-animate-top">* Username/Email:</h4>
<input type="password" style="margin: auto;border-bottom-color: orange;border-bottom-style: solid;border-bottom-width: 2px;" class="w3-animate-top w3-input" required name="password"/>
<h4 style="text-align: center;" class="w3-label w3-validate w3-animate-top">* Password:</h4>
<div class="g-recaptcha" data-sitekey="your sitekey"></div>
<script src='https://www.google.com/recaptcha/api.js'></script>
<input type="Submit" class="w3-btn w3-round-large w3-blue w3-medium w3-padding-large w3-animate-top" style="margin: auto; display:block;" value="Login!">
<h5 style="text-align: center;">No Account? <a href="/register/">Register</a></h5><h5 style="text-align: center;"><a href="/">Go Home!</a></h5>
<?php

$uccessful_login = False;

include 'scripts/DatabaseConnect.php';
include 'scripts/passwordHandler.php';

$isUsername = false;
$isEmail = false;
require_once 'scripts/captchalib.php';
$secret = "Your secret recaptcha key";
$response = null;
$reCaptcha = new ReCaptcha($secret);
if (isset($_POST["g-recaptcha-response"])) {
if (strlen($_POST["g-recaptcha-response"]) > 0 and $_POST["g-recaptcha-response"] != null) {
    $response = $reCaptcha->verifyResponse(
        $_SERVER["REMOTE_ADDR"],
        $_POST["g-recaptcha-response"]
);};
if ($response != null && $response->success) {
if (isset($_POST['loginas']) and isset($_POST['password'])) {
if (usernameExists(strtolower($_POST['loginas']))) {
	$isUsername = True;
} else if (emailExists(strtolower($_POST['loginas']))) {
	$isEmail = True;
} else {
	echo '<script>LerrorHead("Wrong Login / Password");LerrorContent("The credentials you have supplied are invalid!");</script>';
};} else { 
	echo '<script>LerrorHead("Sorry, You Haven\'t Entered The Username/Password");LerrorContent("The Username and password are not set.");</script>';
};} else {
	echo '<script>LerrorHead("Invalid Captcha!");LerrorContent("The Captcha Response Was Incorrect / Not Filled");</script>';
};

 if ($isEmail or $isUsername) {
	if ($isEmail) {
		$accountArray = splitVar(getrelatedinfoe(strtolower($_POST['loginas'])));
	}
	if ($isUsername) {
		$accountArray = splitVar(getrelatedinfo(strtolower($_POST['loginas'])));
	}
	if (strtolower($_POST['loginas']) == $accountArray[1] or strtolower($_POST['loginas']) == $accountArray[2]) {
		if(password_verify($_POST['password'],$accountArray[0])) {
		$_SESSION['login'] = $accountArray[2];
		$_SESSION['email'] = $accountArray[1];
		$uccessful_login = True;
		if (isset($_GET['r'])) {
			$r = $_GET['r'];
			$config = include 'scripts/config.php';
			$goto = '<meta http-equiv="refresh" content="0; url=http://' . $config->domain . "/" . $r . '" />';
			echo $goto;
			echo "<p><a href='http://$config->domain/$r'>Redirect</a></p>";
		} else {
			$config = include 'scripts/config.php';
			$goto = '<meta http-equiv="refresh" content="0; url=http://' . $config->domain . '" />';
			echo $goto;
			echo "<p><a href='http://$config->domain'>Redirect</a></p>";
		}
		} else {
			echo '<script>LerrorHead("Wrong Login / Password");LerrorContent("The credentials you have supplied are invalid!");</script>';
		}
	};
}; };
?>
<?php if (!$uccessful_login) {echo '<script>showlogin();</script>';} ?>
</form>
</div></div>
</body>
</html>
