document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('search');
    const searchSuggestions = document.getElementById('search-suggestions');

    searchInput.addEventListener('input', function () {
        const query = this.value.trim();

        if (query === '') {
            searchSuggestions.innerHTML = '';
            searchSuggestions.classList.add('hidden');
            return;
        }

        fetch(`/search-events?q=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(data => {
                const suggestions = data.map(event => `<div class="suggestion">${event.event_name}</div>`).join('');
                searchSuggestions.innerHTML = suggestions;
                
                if (data.length > 4) {
                    searchSuggestions.classList.add('suggestions-scroll');
                } else {
                    searchSuggestions.classList.remove('suggestions-scroll');
                }
                
                searchSuggestions.classList.remove('hidden');
            })
            .catch(error => {
                console.error('Error fetching search suggestions:', error);
                searchSuggestions.innerHTML = '';
                searchSuggestions.classList.add('hidden');
            });
    });

    searchSuggestions.addEventListener('click', function (event) {
        if (event.target.classList.contains('suggestion')) {
            searchInput.value = event.target.textContent;
            searchSuggestions.innerHTML = '';
            searchSuggestions.classList.add('hidden');
            
            // Optionally, trigger your search form submission here
        }
    });

    document.addEventListener('click', function (event) {
        if (!searchSuggestions.contains(event.target)) {
            searchSuggestions.innerHTML = '';
            searchSuggestions.classList.add('hidden');
        }
    });
});
