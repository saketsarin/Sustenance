var x = document.getElementById("login");
var y = document.getElementById("register");
var z = document.getElementById("btn");

function showRegister() {
    x.style.left = "-400px";
    y.style.left = "50px";
    z.style.left = "110px";
}

function showLogin() {
    x.style.left = "50px";
    y.style.left = "450px";
    z.style.left = "0";
}

function showPass() {
    var pass = document.getElementById("pass");
    if (pass.type === "password") {
      pass.type = "text";
    } else {
      pass.type = "password";
    }
  }
  
