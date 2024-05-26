function setRememberMe() {
    var idNo = document.getElementById("idNo").value;
    var password = document.getElementById("password").value;
    var rememberMe = document.getElementById("rememberMe").checked;

    if (rememberMe) {
        localStorage.setItem("idNo", idNo);
        localStorage.setItem("password", password);
        localStorage.setItem("rememberMe", true);
    } else {
        localStorage.removeItem("idNo");
        localStorage.removeItem("password");
        localStorage.setItem("rememberMe", false);
    }
}

function loadRememberMe() {
    var rememberMe = localStorage.getItem("rememberMe");

    if (rememberMe && rememberMe === "true") {
        var idNo = localStorage.getItem("idNo");
        var password = localStorage.getItem("password");
        document.getElementById("idNo").value = idNo;
        document.getElementById("password").value = password;
        document.getElementById("rememberMe").checked = true;
    }
}

window.onload = function() {
    loadRememberMe();
};


document.getElementById("loginBTN").addEventListener("submit", function() {
    setRememberMe();
});