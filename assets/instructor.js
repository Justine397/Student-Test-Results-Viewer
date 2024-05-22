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
});
