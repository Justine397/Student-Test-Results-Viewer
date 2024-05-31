document.addEventListener('DOMContentLoaded', function() {
    var form = document.getElementById('changeInfoForm');

    form.addEventListener('submit', function(event) {
        event.preventDefault();

        var formData = new FormData(form);

        var xhr = new XMLHttpRequest();
        xhr.open('POST', '../admin/changeUserData.php', true);
        xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 400) {
                var response = xhr.responseText;
                alert(response);
                form.reset();
            } else {
                console.error("Server returned error: " + xhr.status);
            }
        };
        xhr.onerror = function() {
            // Connection error
            console.error("Connection error");
        };
        xhr.send(formData);
    });
});
