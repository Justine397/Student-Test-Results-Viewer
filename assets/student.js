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
                    fetchGrades(content.id); 
                } else {
                    content.style.display = 'none'; 
                }
            });
            this.classList.add('active');
        });
    });

    function fetchGrades(tabId) {
        var year = tabId.charAt(tabId.length - 1); 
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    var gradesTab = document.getElementById(tabId).querySelector('tbody'); 
                    gradesTab.innerHTML = ''; 
                    response.forEach(function(grade) {
                        var row = document.createElement('tr');
                        row.innerHTML = '<td>' + grade.instructor_name + '</td>' +
                                        '<td>' + grade.subject + '</td>' +
                                        '<td>' + grade.first_semester_grade + '</td>' +
                                        '<td>' + grade.second_semester_grade + '</td>' +
                                        '<td>' + grade.final_grade + '</td>';
                        gradesTab.appendChild(row);
                    });
                } else {
                    console.error('Failed to fetch grades. Status:', xhr.status);
                }
            }
        };
        xhr.open('GET', 'fetch_grades.php?year=' + year, true);
        xhr.send();
    }

    document.getElementById('studentOverlay').addEventListener('click', function() {
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

    fetchGrades('gradesTab1'); 
});
