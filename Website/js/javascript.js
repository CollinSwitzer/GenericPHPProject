//Nav Bar functionality
function nav() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += "responsive";
    } else {
        x.className = "topnav";
    }
}

//Login Form Check
function loginForm() {
    var un = document.login.username.value;
    var pw = document.login.password.value;
    var username = "student";
    var password = "student";
    if ((un == username) && (pw == password)) {
        return true;
    }
    else {
        alert ("Login was unsuccessful, please check your username and password");
        return false;
    }
}