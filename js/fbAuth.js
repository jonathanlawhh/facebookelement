window.fbAsyncInit = function() {
  FB.init({
    appId            : '163775414129183',
    autoLogAppEvents : true,
    xfbml            : true,
    version          : 'v2.12'
  });
};

(function(d, s, id){
   var js, fjs = d.getElementsByTagName(s)[0];
   if (d.getElementById(id)) {return;}
   js = d.createElement(s); js.id = id;
   js.src = "https://connect.facebook.net/en_US/sdk.js";
   fjs.parentNode.insertBefore(js, fjs);
 }(document, 'script', 'facebook-jssdk'));
function loginFB(){
var a = document.getElementById("authStatus");
var b = document.getElementById("authID");
a.innerHTML = "Authentication status : Pending...";
FB.getLoginStatus(function(response) {
  if (response.status === 'connected') {
    var accessToken = response.authResponse.accessToken;
    getMyInfo();
    getFriendsList();
    console.log('Logged in.');
    b.removeAttribute("style"); b.innerHTML = accessToken;
    document.getElementById('authIDin').value = accessToken;
  }
  else {
    FB.login();
    a.innerHTML = "Please press authenticate one more time to verify";
  }
}, {scope:'user_friends',return_scopes: true});
}

getMyInfo = function() {
  FB.api('/me', function(a) {
    document.getElementById("authStatus").innerHTML = "Authentication status : Hello " + a.name + ", thank you. Below is your auth ID"
  });
};

getFriendsList = function() {
  FB.api('/me/friends/', function(a) {
    var ft = document.getElementById("friendTxt");
    console.log(a);
    ft.removeAttribute("style");
    ft.innerHTML = "One of my friend : " + a.name;
  });
};
