document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.querySelector('.search-input input');
    const tableRows = document.querySelectorAll('table tbody tr');

    searchInput.addEventListener('input', () => {
        const query = searchInput.value.toLowerCase();

        tableRows.forEach(row => {
            const cells = row.querySelectorAll('td');
            const lawyerId = cells[0].textContent.toLowerCase();
            const name = cells[1].textContent.toLowerCase();
            const email = cells[2].textContent.toLowerCase();

            if (lawyerId.includes(query) || name.includes(query) || email.includes(query)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
});
