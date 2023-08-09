document.addEventListener('DOMContentLoaded', function () {
    const filterButton = document.getElementById('filterButton');
    const sortMenu = document.getElementById('sortMenu');
    const eventItems = document.querySelectorAll('.bg-white');

    filterButton.addEventListener('click', function () {
        sortMenu.classList.toggle('hidden');
    });

    document.addEventListener('click', function (event) {
        if (!filterButton.contains(event.target) && !sortMenu.contains(event.target)) {
            sortMenu.classList.add('hidden');
        }
    });

    function sortEventsByName() {
        const sortedItems = Array.from(eventItems).sort((a, b) => {
            const nameA = a.querySelector('.text-xl').textContent.toLowerCase();
            const nameB = b.querySelector('.text-xl').textContent.toLowerCase();
            return nameA.localeCompare(nameB);
        });

        eventItems.forEach(item => item.remove());
        sortedItems.forEach(item => document.querySelector('.grid').appendChild(item));
    }

    function sortEventsByDate() {
        const sortedItems = Array.from(eventItems).sort((a, b) => {
            const dateA = new Date(a.querySelector('.text-gray-600').textContent.split(' | ')[0]);
            const dateB = new Date(b.querySelector('.text-gray-600').textContent.split(' | ')[0]);
            return dateA - dateB;
        });

        eventItems.forEach(item => item.remove());
        sortedItems.forEach(item => document.querySelector('.grid').appendChild(item));
    }

    document.getElementById('sortByName').addEventListener('click', function (event) {
        event.preventDefault();
        sortEventsByName();
        sortMenu.classList.add('hidden');
    });

    document.getElementById('sortByDate').addEventListener('click', function (event) {
        event.preventDefault();
        sortEventsByDate();
        sortMenu.classList.add('hidden');
    });
});