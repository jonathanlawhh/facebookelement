<html lang="en">
<head>
	<title>Facebook Element</title>
	<meta name="theme-color" content="#0d47a1">
  <link rel="stylesheet" href="css/materialize.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <script type="text/javascript" src="js/materialize.min.js" async></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" async></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
	  body { display: flex; min-height: 100vh; flex-direction: column; }
	  main {  flex: 1 0 auto; }
		::selection { background: #d81b60; color:#ffffff;}
		::-moz-selection { background: #d81b60; color:#ffffff; }
  </style>
</head>
<?php include("js/fbAuth.php"); ?>
<div id="outerBody">
<body>
  <main class="mainclass">
    <nav class="blue darken-3">
      <div class="nav-wrapper container">
        <a href="auth.php" class="brand-logo center">FB Auth Page</a>
      </div>
    </nav>
    <div class="container" style="margin-top:40px;">
      <ul class="collapsible popout">
        <li>
          <div class="collapsible-header"><i class="material-icons">sync</i>Purpose</div>
          <div class="collapsible-body"><span>As Facebook API only allows the display of friends authenticated to this application, this authentication page is used to authenticate those friends.<br>
          The aim of this application is to get a list of friends and display it in a 3D visualization framework.</span></div>
        </li>
        <li>
          <div class="collapsible-header"><i class="material-icons">whatshot</i>Additional Information</div>
          <div class="collapsible-body"><span>This app is registered as 'piupiu'. You can find this application in your authorized applications settings at Facebook settings section and revoke it anytime as you wish.
          <br>A column to delete your authentication/revoke this application will be provided. The authentication process will be done with Facebook API, so ensure popup is enabled for this site.</span></div>
        </li>
        <li>
          <div class="collapsible-header"><i class="material-icons">remove_red_eye</i>Privacy and data collection</div>
          <div class="collapsible-body"><span>All information including your email, username or passwords are not stored on this site. Also, no data collection activity will take place.
						Only your profile and friends first name,gender will be retrieved and destroyed after the session ends.</span></div>
        </li>
      </ul>

      <div class="row" style="margin-top:10px;">
        <div class="col s12">
          <div class="card hoverable">
            <div class="card-content">
              <span class="card-title">Let's go!</span>
              <div class="divider"></div><br>
              <p id="authStatus">Authentication status : Not started<br>
							Click Login/Continue with Facebook to start</p><br>
              <p id="authID" class="truncate" style="display:none"></p><br>
							<div style="margin-bottom:20px;" class="fb-login-button" data-max-rows="1" data-size="medium" data-button-type="login_with" data-show-faces="true"
									 data-auto-logout-link="false" data-use-continue-as="true" data-scope="user_friends" onlogin="loginFB();"></div><br>
          </div>
        </div>
      </div>
		</div>

      <div class="row" style="margin-top:10px;">
        <div class="col s12">
          <div class="card hoverable">
            <div class="card-content">
              <span class="card-title">Friend Element</span>
              <div class="divider"></div><br>
              <p>This will display a 3D visualization of user friends.</p><br>
              <p id="friendTxt" style="display:none"></p><br>
              <a class="waves-effect waves-light btn" style="margin-top:10px;" href="dummy.php" target="_blank">Dummy data</a>
              <a class="waves-effect waves-light btn" style="margin-top:10px;" id="loadFBbtn" onclick="loadFBdata();" disabled>Facebook data</a>
            </div>
          </div>
        </div>
      </div>

      <div class="row" style="margin-top:10px;">
        <div class="col s12">
          <div class="card hoverable">
            <div class="card-content">
              <span class="card-title">Delete/Revoke this authentication</span>
              <div class="divider"></div><br>
              <p>Your auth ID is automatically copied here<br>
              Pressing remove will revoke this application on your account</p><br>
              <input id="authIDin" type="text" class="validate">
              <a class="waves-effect waves-light btn red darken-3" onclick="deleteAuth();"><i class="material-icons left">delete_forever</i>Remove</a>
            </div>
          </div>
        </div>
      </div>

    </div>
  </main>
  <footer class="page-footer grey darken-3">
    <div class="footer-copyright grey darken-4">
      <div class="container">Developed by jonathan law</div>
    </div>
  </footer>
</body>
</div>
</html>
<script>
function deleteAuth() {
  var a = "https://graph.facebook.com/me/permissions?method=delete&access_token=" + document.getElementById("authIDin").value;
  window.open(a, "_blank");
}
function initialize() {
	M.Collapsible.init(document.querySelectorAll('.collapsible'), {});
}
window.addEventListener ? window.addEventListener("load", initialize, !1) : window.attachEvent ? window.attachEvent("onload", initialize) : window.onload = initialize;
</script>
