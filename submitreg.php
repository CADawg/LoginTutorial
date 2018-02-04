<title>Register</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="scripts/script.js"></script>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"/>
<link rel="stylesheet" href="styles/style.css">

<noscript>
<div class="w3-container w3-red">
<span onclick="this.parentElement.style.display='none'"
class="w3-button w3-display-topright" class="w3-red">&times;</span>
  <h3 id="register_issue_heading">Error: For full functionality of this site it is necessary to enable JavaScript.</h3>
  <p id="register_issue_content">Here are the <a href="http://www.enable-javascript.com/" tarPOST="_blank"> instructions how to enable JavaScript in your web browser</a>.</p>
</div>
</noscript>
<div class="darkClass w3-animate-top" id="registeroverlay" style="display:none;" width="100%" height="100%">
<div class="w3-container w3-red">
  <h3 id="register_issue_heading">Generic Error While Registering.</h3>
  <p id="register_issue_content">Try Again?</p>
</div> <div id="registerclose"></div>
<form action="submitreg.php" class="w3-panel w3-white w3-container w3-round-large w3-animate-top" style="width: 400px; margin: auto; display:none;" id="registerform" method="post">
<input type="text" style="margin: auto;border-bottom-color: orange;border-bottom-style: solid;border-bottom-width: 2px;" class="w3-animate-top w3-input" required name="username"/>
<h4 style="text-align: center;" class="w3-label w3-validate w3-animate-top">* Username: (Avoid @\/&?`"')</h4>
<input type="text" style="margin: auto;border-bottom-color: orange;border-bottom-style: solid;border-bottom-width: 2px;" class="w3-animate-top w3-input" required name="email"/>
<h4 style="text-align: center;" class="w3-label w3-validate w3-animate-top">* E-mail:</h4>
<input type="password" style="margin: auto;border-bottom-color: orange;border-bottom-style: solid;border-bottom-width: 2px" class="w3-animate-top w3-input pass" required name="password"/>
<h4 style="text-align: center;" class="w3-label w3-validate w3-animate-top">* Password:</h4>
<input type="password" style="margin: auto;border-bottom-color: orange;border-bottom-style: solid;border-bottom-width: 2px" class="w3-animate-top w3-input pass" required name="passwordvalidate"/>
<h4 style="text-align: center;" class="w3-label w3-validate w3-animate-top">* Confirm Password:</h4>
<div class="g-recaptcha" data-sitekey="<recaptcha sitekey>" style="align: center; margin: 0 auto;"></div>
<script src='https://www.google.com/recaptcha/api.js'></script>
<input type="Submit" class="w3-btn w3-round-large w3-blue w3-medium w3-padding-large w3-animate-top" style="margin: auto; display:block;" value="Register!"></div>
<!--Register Form Code End-->
<?php
/*Includes Code*/
include 'scripts/DatabaseConnect.php';
include 'scripts/passwordHandler.php';
require_once 'scripts/captchalib.php';
// your secret key
$secret = "<recaptcha secret>";
// empty response
$response = null;
// check secret key
$reCaptcha = new ReCaptcha($secret);
// if submitted check response
if (isset($_POST["g-recaptcha-response"])) {
if (strlen($_POST["g-recaptcha-response"]) > 0 and $_POST["g-recaptcha-response"] != null) {
    $response = $reCaptcha->verifyResponse(
        $_SERVER["REMOTE_ADDR"],
        $_POST["g-recaptcha-response"]
);}
if ($response != null && $response->success) {
if (isset($_POST['password']) and isset($_POST['passwordvalidate'])) {
	if (strlen($_POST['passwordvalidate']) > 0 or strlen($_POST['password']) > 0) {
			if ($_POST['password'] == $_POST['passwordvalidate']) {
			//Passwords Match
			$hashed_password_for_submission = hashPass($_POST['password']);
			if (isset($_POST['username'])) {
			if (strpos($_POST['username'],'@') === False and strpos($_POST['username'],'\\') === False and strpos($_POST['username'],'/') === False and strpos($_POST['username'],'"') === False and strpos($_POST['username'],"'") === False and  strpos($_POST['username'],"?") === False and strpos($_POST['username'],"&") === False and strpos($_POST['username'],"/") === False and strpos($_POST['username'],'`') === False)  {
			$username_ready = strtolower($_POST['username']);
			if (isset($_POST['email'])) {
			$email = strtolower($_POST["email"]);
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				echo '<script type="text/javascript">
				showRegister();
				errorHead("E-Mail is invalid!");
				errorContent("E-mail is of an invalid format / wasn\'t entered!");
				</script>';
			} else {/*Hey, does it exist already?
					USERNAME ONLY. Password idc*/
						if (emailExists($email)) {
							echo '<script type="text/javascript">
							showRegister();
							errorHead("E-Mail already exists in our database!");
							errorContent("Log in / Use a different email!");
							</script>';
						} else {
							if (usernameExists($username_ready)) {
								echo '<script type="text/javascript">
							showRegister();
							errorHead("Username already exists!");
							errorContent("Log in / Choose a different username!");
							</script>';
							} else {
								if ((strlen($username_ready)) < 255 and (strlen($username_ready)) >= 5 and (strlen($email)) < 255) {
								echo '
								<div class="w3-container w3-green">
								<h3>Congratulations!</h3>
								<p>You have successfully signed up to the site! Click <a href="index.php">here</a>!</p>
								</div>
								';
								/*Completely Ready*/
								$config = include 'scripts/config.php';
								newRecord($username_ready,$hashed_password_for_submission,$email,$_POST['username']);
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
									$mees = strlen($username_ready);
									echo '<script type="text/javascript">
									showRegister();
									errorHead("E-mail or Password is too long or username too short!");
									errorContent("The limit on these are 255 characters, and username can\'t be less than or equal to 4 Characters. Want a 4 Letter Name Or Less? E-mail: users@dogefund.me <a href=\"mailto:users@dogefund.me?subject=Aquiring%20A%20Short%20Username:%20<Username>\">MailTo Link</a>");
									</script>';}
								}
						}
					}
			} else {
				echo '<script type="text/javascript">
				showRegister();
				errorHead("You didn\'t enter an email!");
				errorContent("You Must Enter An email!");
				</script>';}
			} else {
				echo '<script type="text/javascript">
				showRegister();
				errorHead("Your username contained a dissalowed character.");
				errorContent("You Were Warned, This ISN\'T Allowed.");
				</script>';
			}
			} else {
				echo '<script type="text/javascript">
				showRegister();
				errorHead("You didn\'t enter a username!");
				errorContent("You Must Enter A Username!");
				</script>';}
			} else {
			//Passwords exist and are of a length of one or more but don't match
			echo '<script type="text/javascript">
				showRegister();
				errorHead("Passwords Don\'t Match!");
				errorContent("Password and Confirm Password Fields are not the same, please try again!");
				</script>';
		}
	} else {
		//One or more password fields unFilled
		echo '<script type="text/javascript">
		showRegister();
		errorHead("No Password Entered")
		errorContent("Either you didn\'t fill out Password/Confirm Password/Both")
		</script>';
	}
} else {
		//One or more password fields unFilled
		echo '<script type="text/javascript">
		showRegister();
		errorHead("No Password Entered")
		errorContent("Either you didn\'t fill out Password/Confirm Password/Both")
		</script>';
}
} else {
	echo '<script type="text/javascript">
		showRegister();
		errorHead("Invalid Captcha Response")
		errorContent("Please complete the captcha!")
		</script>';
} } else {
	echo '<script type="text/javascript">
		showRegister();
		errorHead("Invalid Captcha Response")
		errorContent("Please complete the captcha!")
		</script>';
}
?>
