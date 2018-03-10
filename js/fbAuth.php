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
fclose($p);
$i = 0; ?>
getFriendsList = function() {
  FB.api('/me/friends?fields=name,gender', function(a) {
    var ft = document.getElementById("friendTxt");
    console.log(a);
    ft.removeAttribute("style");
    var fS = a.data.length;
    for (i = 0; i < fS; i++) { table.push(i,a.data[i].name,a.data[i].gender,<?php echo $posi[$i]; $i++; ?>,); }
    fS = Math.floor(Math.random() * fS);
    ft.innerHTML = "Total number of friends : " + a.summary.total_count + "<br>A random friend : " + a.data[fS].name;
    return fS;
  });
};

function loadFBdata(){
	$( ".mainclass" ).remove();
  document.getElementById("3dpage") || $("#outerBody").load("fb.php");
}
</script>
