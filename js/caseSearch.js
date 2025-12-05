document.addEventListener("DOMContentLoaded", () => {
    const searchInput = document.getElementById("searchText");
    const filterType = document.getElementById("filterType");
    const filterStatus = document.getElementById("filterStatus");
    const filterPriority = document.getElementById("filterPriority");
    const rows = document.querySelectorAll("tbody tr:not(#noResultsRow)");
    const noResultsRow = document.getElementById("noResultsRow");
    const clearFiltersBtn = document.getElementById("clearFiltersBtn");

    function filterTable() {
        let searchValue = searchInput.value.toLowerCase();
        let typeValue = filterType.value.toLowerCase();
        let statusValue = filterStatus.value.toLowerCase();
        let priorityValue = filterPriority.value.toLowerCase();

        let visibleCount = 0;

        rows.forEach(row => {
            let caseId = row.cells[0].innerText.toLowerCase();
            let type = row.cells[1].innerText.toLowerCase();
            let title = row.cells[2].innerText.toLowerCase();
            let judge = row.cells[3].innerText.toLowerCase();
            let status = row.cells[5].innerText.toLowerCase();
            let priority = row.cells[6].innerText.toLowerCase();

            let matchesSearch = 
                caseId.includes(searchValue) || 
                title.includes(searchValue) || 
                judge.includes(searchValue);

            let matchType = !typeValue || type === typeValue;
            let matchStatus = !statusValue || status === statusValue;
            let matchPriority = !priorityValue || priority === priorityValue;

            if (matchesSearch && matchType && matchStatus && matchPriority) {
                row.style.display = "";
                visibleCount++;
            } else {
                row.style.display = "none";
            }
        });

        noResultsRow.style.display = visibleCount === 0 ? "" : "none";
    }

    if (clearFiltersBtn) {
        clearFiltersBtn.addEventListener("click", () => {
            searchInput.value = "";
            filterType.value = "";
            filterStatus.value = "";
            filterPriority.value = "";
            filterTable();
        });
    }

    searchInput.addEventListener("input", filterTable);
    filterType.addEventListener("change", filterTable);
    filterStatus.addEventListener("change", filterTable);
    filterPriority.addEventListener("change", filterTable);
});
