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

    document.getElementById('instOverlay').addEventListener('click', function() {
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
    var modalContent = document.getElementById("modalContentInst");
    var span = document.getElementsByClassName("close")[0];

    span.onclick = function() {
        modal.style.display = "none";
    };

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    };

    document.querySelectorAll('.view-user').forEach(function(link) {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            var userId = this.getAttribute('data-id');
            fetchUserData(userId);
        });
    });

    function fetchUserData(userId) {
        modalContent.innerHTML = "<p>Loading user data...</p>";
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    modalContent.innerHTML = xhr.responseText;
                    modal.style.display = "block";

                    window.numericUserId = userId;

                    const modifyBtn = document.getElementById('modifyBtn');
                    if (modifyBtn) {
                        modifyBtn.addEventListener('click', modifyGrades);
                    } else {
                        console.error('Button with id "modifyBtn" not found.');
                    }
                } else {
                    modalContent.innerHTML = "<p>Failed to fetch user data.</p>";
                }
            }
        };
        xhr.open("GET", "modal_contentInst.php?userId=" + userId, true);
        xhr.send();
    }

    function modifyGrades() {
        var table = document.getElementById('gradesTable');
        if (!table) {
            console.error('Table with id "gradesTable" not found.');
            return;
        }

        var data = [];
        for (var i = 1; i < table.rows.length; i++) {
            var row = table.rows[i];
            var rowData = [];
            for (var j = 0; j < row.cells.length; j++) {
                rowData.push(row.cells[j].innerText);
            }
            rowData.push(window.numericUserId); 
            data.push(rowData);
        }

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'update_grades.php', true);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    console.log(xhr.responseText);
                    alert('Grades updated successfully');
                } else {
                    console.error('Error:', xhr.statusText);
                    alert('Failed to update grades');
                }
            }
        };
        xhr.send(JSON.stringify(data));
    }
});