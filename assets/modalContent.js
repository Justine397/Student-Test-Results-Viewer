document.addEventListener('DOMContentLoaded', function() {
    // Find the form element
    var form = document.getElementById('changeInfoForm');

    // Add event listener for form submission
    form.addEventListener('submit', function(event) {
        // Prevent default form submission behavior
        event.preventDefault();

        // Gather form data
        var formData = new FormData(form);

        // Send AJAX request to PHP script
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '../admin/changeUserData.php', true);
        xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 400) {
                // Success response from server
                var response = xhr.responseText;
                // Handle response here, you can update UI or show messages
                alert(response); // For example, show an alert with the response message
                // Optionally, you can reset the form after successful submission
                form.reset();
            } else {
                // Error response from server
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
