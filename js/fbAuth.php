<script>
window.fbAsyncInit = function() {
  FB.init({
    appId            : '163775414129183',
    autoLogAppEvents : true,
    xfbml            : true,
    version          : 'v2.12'
  });
};

(function(a, b, c) {
  var d = a.getElementsByTagName(b)[0];
  a.getElementById(c) || (a = a.createElement(b), a.id = c, a.src = "https://connect.facebook.net/en_US/sdk.js", d.parentNode.insertBefore(a, d));
})(document, "script", "facebook-jssdk");

function loginFB() {
 var b = document.getElementById("authStatus"), c = document.getElementById("authID");
 b.innerHTML = "Authentication status : Pending...";
 FB.getLoginStatus(function(a) {
   "connected" === a.status ? (a = a.authResponse.accessToken, getMyInfo(), getFriendsList(), c.removeAttribute("style"), c.innerHTML = a, document.getElementById("authIDin").value = a) : b.innerHTML = "Please press the Log in With Facebook to continue";
 });
 }

getMyInfo = function() {
  FB.api('/me', function(a) {
    document.getElementById("authStatus").innerHTML = "Authentication status : Hello " + a.name + ", thank you. Below is your auth ID"
    $('#loadFBbtn').removeAttr('disabled');
  });
};

var table = [];
<?php
$posi = array();
$p = fopen("position.txt", "r");
while(!feof($p)) { array_push($posi,fgets($p)); }
fclose($p); ?>
var val =[<?php foreach($posi as $a){echo trim($a) . ',';}; ?>];
var p1 = 0; var p2 = 1;
getFriendsList = function() {
  FB.api('/me/friends?fields=first_name,gender', function(a) {
    var ft = document.getElementById("friendTxt");
    ft.removeAttribute("style");
    console.log(a);
    var fS = a.data.length;
    var posiL = val.length/2;
    for (i = 0; i < fS; i++) { if(posiL<i){ break; } table.push(i,a.data[i].first_name,a.data[i].gender,val[p1],val[p2],); p1+=2; p2+=2;}
    rS = Math.floor(Math.random() * fS);
    ft.innerHTML = "Total number of friends : " + a.summary.total_count + "<br>Number of friends using this app : " + fS + "<br>A random friend using this app : " + a.data[rS].first_name;
    return fS;
  });
};

function loadFBdata(){
	$( ".mainclass" ).remove();
  document.getElementById("3dpage") || $("#outerBody").load("fb.php");
}
</script>
