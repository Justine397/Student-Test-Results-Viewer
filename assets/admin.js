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

    document.getElementById('adminOverlay').addEventListener('click', function() {
        document.getElementById('file-input').click();
    });
    
    document.getElementById('file-input').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const formData = new FormData(document.getElementById('uploadForm'));
            fetch('../uploadProfilePic.php', {
                method: 'POST',
                body: formData
            }).then(response => response.json())
              .then(data => {
                  if (data.success) {
                      document.getElementById('userImage').src = '../assets/images/upload/' + data.filename;
                  } else {
                      alert('Failed to upload image');
                  }
              })
              .catch(error => {
                  console.error('Error:', error);
              });
        }
    });

    var modal = document.getElementById("userModal");

    var span = document.getElementsByClassName("close")[0];

    span.onclick = function() {
        modal.style.display = "none";
    };

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    };

    var viewLinks = document.querySelectorAll('.view-user');
    viewLinks.forEach(function(link) {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            var userId = this.getAttribute('data-id');
            fetchUserData(userId);
        });
    });
    function fetchUserData(userId) {
        var modalContent = document.getElementById("modalContent");
        modalContent.innerHTML = "<p>Loading user data...</p>";

        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    modalContent.innerHTML = xhr.responseText;
                    modal.style.display = "block";
                } else {
                    modalContent.innerHTML = "<p>Failed to fetch user data.</p>";
                }
            }
        };
        xhr.open("GET", "modal_content.php?userId=" + userId, true);
        xhr.send();
    }

    document.getElementById('changeInfoForm').addEventListener('submit', function(event) {
        event.preventDefault();
    
        var formData = new FormData(this);
    
        fetch('update_user.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            alert(data);
        })
        .catch(error => console.error('Error:', error));
    });
    
});