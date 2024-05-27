document.addEventListener('DOMContentLoaded', function() {
    const tabs = document.querySelectorAll('.tab-button');
    
    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            const targetTab = this.getAttribute('data-tab');
            const tabContents = document.querySelectorAll('.tab-content');
            
            tabs.forEach(t => t.classList.remove('active'));
            tabContents.forEach(content => {
                if (content.id === targetTab) {
                    content.style.display = 'block';
                } else {
                    content.style.display = 'none'; 
                }
            });
            this.classList.add('active');
        });
    });
    
    var removeLinks = document.querySelectorAll('.remove-user');

    removeLinks.forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault();
                
            var userId = this.getAttribute('data-id');
                
            var confirmDelete = confirm("Are you sure you want to remove " + userId + "?");
                
            if (confirmDelete) {
                var xhr = new XMLHttpRequest();
                xhr.open('GET', 'removeUser.php?IDNo=' + userId, true);
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        location.reload();
                    } else {
                        console.error('Request failed. Status:', xhr.status);
                    }
                };
                xhr.send();
            }
        });
    });

    var searchInput = document.getElementById('search');
    var searchResults = document.getElementById('searchResults');

    searchInput.addEventListener('input', function() {
        var query = this.value.trim();

        if (query !== '') {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '../search.php');
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    searchResults.innerHTML = xhr.responseText;
                } else {
                    console.error('Request failed. Status:', xhr.status);
                }
            };
            xhr.send('query=' + encodeURIComponent(query));
        } else {
            searchResults.innerHTML = '';
        }
    });
    // Get the modal
    var modal = document.getElementById("userModal");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    };

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    };

    // Handle click event for "view" links
    var viewLinks = document.querySelectorAll('.view-user');
    viewLinks.forEach(function(link) {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            var userId = this.getAttribute('data-id');
            fetchUserData(userId);
        });
    });
    function fetchUserData(userId) {
        // Example AJAX call, replace with your implementation
        // Here, we are just displaying a sample message
        var modalContent = document.getElementById("modalContent");
        modalContent.innerHTML = "<p>Loading user data...</p>";

        // Make an AJAX request to fetch user data
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Replace modal content with fetched data
                    modalContent.innerHTML = xhr.responseText;
                    // Show the modal
                    modal.style.display = "block";
                } else {
                    // Display error message if request fails
                    modalContent.innerHTML = "<p>Failed to fetch user data.</p>";
                }
            }
        };
        xhr.open("GET", "modal_content.php?userId=" + userId, true);
        xhr.send();
    }

});