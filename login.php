<!DOCTYPE HTML>
<html>
<head>
<script src="/scripts/jquery-3.1.1.min.js"></script>
<script src="/scripts/script.js"></script>
<title>Login</title>
<link rel="stylesheet" href="/styles/w3.css">
<link rel="stylesheet" href="/styles/style.css">

</head>

<body>

<div class="darkClass w3-animate-top" id="loginoverlay" width="100%" height="100%">
<form action="sublogin.php<?php if (isset($_GET['r'])) { echo "?r=" . $_GET['r']; }?>" class="w3-panel w3-white w3-container w3-round-large w3-animate-top" style="width: 400px; margin: auto; " id="loginform" method="post">
<br><br>
<input type="text" style="margin: auto;border-bottom-color: orange;border-bottom-style: solid;border-bottom-width: 2px;" class="w3-animate-top w3-input" required name="loginas"/>
<h4 style="text-align: center;" class="w3-label w3-validate w3-animate-top">* Username/Email:</h4>
<input type="password" style="margin: auto;border-bottom-color: orange;border-bottom-style: solid;border-bottom-width: 2px;" class="w3-animate-top w3-input" required name="password"/>
<h4 style="text-align: center;" class="w3-label w3-validate w3-animate-top">* Password:</h4>
<div class="g-recaptcha" data-sitekey="<sitekey>"></div>
<script src='https://www.google.com/recaptcha/api.js'></script>
<input type="Submit" class="w3-btn w3-round-large w3-blue w3-medium w3-padding-large w3-animate-top" style="margin: auto; display:block;" value="Login!">
<h5 style="text-align: center;">No Account? <a href="register.php">Register</a></h5>
</form>
</div>
</body>
</html>
