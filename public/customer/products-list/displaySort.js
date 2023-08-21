const dropdownToggle = document.querySelector(".dropdown-toggle");
const dropdownItems = document.querySelectorAll(".dropdown-item");

// Check if the sort option is stored in localStorage
const selectedSort = localStorage.getItem("selectedSort");
if (selectedSort) {
    dropdownToggle.textContent = "Sort by " + selectedSort;
}

dropdownItems.forEach((item) => {
    item.addEventListener("click", () => {
        const selectedOption = item.textContent;
        dropdownToggle.textContent = "Sort by " + selectedOption;

        // Store the selected option in localStorage
        localStorage.setItem("selectedSort", selectedOption);
    });
});

function changeSortOrder(order) {
    const urlParams = new URLSearchParams(window.location.search);
    const currentSort = urlParams.get("sort");
    window.location.href = `{{ route('customerListProducts') }}?sort=${currentSort}&order=${order}`;
}
