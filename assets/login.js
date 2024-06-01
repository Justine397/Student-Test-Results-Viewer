function setRememberMe() {
    var idNo = document.getElementsByName("idNo")[0].value;
    var password = document.getElementsByName("password")[0].value;
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
        document.getElementsByName("idNo")[0].value = idNo;
        document.getElementsByName("password")[0].value = password;
        document.getElementById("rememberMe").checked = true;
    }
}

window.onload = function() {
    loadRememberMe();
};

document.querySelector("form").addEventListener("submit", function(event) {
    setRememberMe();
});
