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
                const suggestions = data.map(event => `<div>${event.event_name}</div>`).join('');
                searchSuggestions.innerHTML = suggestions;
                searchSuggestions.classList.remove('hidden');
            })
            .catch(error => {
                console.error('Error fetching search suggestions:', error);
                searchSuggestions.innerHTML = '';
                searchSuggestions.classList.add('hidden');
            });
    });

    document.addEventListener('click', function (event) {
        if (!searchSuggestions.contains(event.target)) {
            searchSuggestions.innerHTML = '';
            searchSuggestions.classList.add('hidden');
        }
    });
});
