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
                    fetchGrades(content.id); // Fetch grades when the tab is clicked
                } else {
                    content.style.display = 'none'; 
                }
            });
            this.classList.add('active');
        });
    });

    // Function to fetch and display grades based on the tab ID (year)
    function fetchGrades(tabId) {
        var year = tabId.charAt(tabId.length - 1); // Extract year from tabId
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    var gradesTab = document.getElementById(tabId).querySelector('tbody'); // Get the tbody element inside the tab
                    gradesTab.innerHTML = ''; // Clear previous content
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

    // Fetch grades for the default tab (1st year) when the page loads
    fetchGrades('gradesTab1'); 
});
