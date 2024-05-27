document.addEventListener('DOMContentLoaded', function() {
    const modalContent = document.getElementById("modalContentInst");

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
        xhr.open("GET", "modal_contentInst.php?userId=" + userId, true);
        xhr.send();
    }
    function modifyGrades() {
        var table = document.getElementById('gradesTable');
        var data = [];
        for (var i = 1; i < table.rows.length; i++) {
            var row = table.rows[i];
            var rowData = [];
            for (var j = 0; j < row.cells.length; j++) {
                rowData.push(row.cells[j].innerText);
            }
            data.push(rowData);
        }
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'update_grades.php', true);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    console.log(xhr.responseText);
                } else {
                    console.error('Error:', xhr.statusText);
                }
            }
        };
        xhr.send(JSON.stringify(data));
    }
});
