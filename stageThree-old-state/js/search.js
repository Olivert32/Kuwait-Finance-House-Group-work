// Get search bar
let searchInput = document.querySelector("#searchBar");
// Get table
let tableBody = document.querySelector("#table-body");

// Event to run function
searchInput.addEventListener("keyup", filterTable);

// Function for filter
function filterTable() {
  let filterValue = searchInput.value.toLowerCase();
  let rows = tableBody.getElementsByTagName("tr");

  for (let i = 0; i < rows.length; i++) {
    const cells = rows[i].getElementsByTagName("td");
    let match = false;

    for (let j = 0; j < cells.length; j++) {
      if (cells[j].innerHTML.toLowerCase().indexOf(filterValue) > -1) {
        match = true;
        break;
      }
    }

    if (match) {
      rows[i].style.display = "";
    } else {
      rows[i].style.display = "none";
    }
  }
}
