<!DOCTYPE HTML>
<html>
<head>
<title>Register</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="scripts/script.js"></script>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"/>
<link rel="stylesheet" href="styles/style.css">

</head>

<body>
<button class="w3-btn w3-round-large w3-blue w3-medium w3-padding-large" style="margin: auto;" onClick="showRegister();">Register!</button>

<div class="darkClass w3-animate-top" id="registeroverlay" style="display: none;" width="100%" height="100%">
<form action="submitreg.php<?php if (isset($_GET['r'])) { echo "?r=" . $_GET['r']; }?>" class="w3-panel w3-white w3-container w3-round-large w3-animate-top" style="width: 400px; margin: auto; " id="registerform" method="post">
<br><br>
<input type="text" style="margin: auto;border-bottom-color: orange;border-bottom-style: solid;border-bottom-width: 2px;" class="w3-animate-top w3-input" required name="username"/>
<h4 style="text-align: center;" class="w3-label w3-validate w3-animate-top">* Username: (Avoid @\/&?"'`)</h4>
<input type="text" style="margin: auto;border-bottom-color: orange;border-bottom-style: solid;border-bottom-width: 2px;" class="w3-animate-top w3-input" required name="email"/>
<h4 style="text-align: center;" class="w3-label w3-validate w3-animate-top">* E-mail:</h4>
<input type="password" style="margin: auto;border-bottom-color: orange;border-bottom-style: solid;border-bottom-width: 2px" class="w3-animate-top w3-input pass" required name="password"/>
<h4 style="text-align: center;" class="w3-label w3-validate w3-animate-top">* Password:</h4>
<input type="password" style="margin: auto;border-bottom-color: orange;border-bottom-style: solid;border-bottom-width: 2px" class="w3-animate-top w3-input pass" required name="passwordvalidate"/>
<h4 style="text-align: center;" class="w3-label w3-validate w3-animate-top">* Confirm Password:</h4>
<div class="g-recaptcha" **data-sitekey="<your google reCAPTCHA sitekey here>"** style="align: center;"></div>
<script src='https://www.google.com/recaptcha/api.js'></script>
<p></p>
<input type="Submit" class="w3-btn w3-round-large w3-blue w3-medium w3-padding-large w3-animate-top" style="margin: auto; display:block;" value="Register!">
</form>
</div>
</body>
</html>
