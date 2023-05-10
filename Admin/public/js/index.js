document.querySelector('.design-widht').style.display = 'none';
document.querySelector('.delete-btn').addEventListener('click', function(event) {
    event.preventDefault();
    var designWidht = document.querySelector('.design-widht');
    if (designWidht.style.display === 'none') {
        designWidht.style.display = 'block';
    } else {
        designWidht.style.display = 'none';
    }
});

document.querySelector('.design-widht1').style.display = 'none';
document.querySelector('.src-btn').addEventListener('click', function(event) {
    event.preventDefault();
    var designWidht = document.querySelector('.design-widht1');
    if (designWidht.style.display === 'none') {
        designWidht.style.display = 'block';
    } else {
        designWidht.style.display = 'none';
    }
});

document.querySelector('.design-widht2').style.display = 'none';
document.querySelector('.edit-btn').addEventListener('click', function(event) {
    event.preventDefault();
    var designWidht = document.querySelector('.design-widht2');
    if (designWidht.style.display === 'none') {
        designWidht.style.display = 'block';
    } else {
        designWidht.style.display = 'none';
    }
});




const searchByRollNo = document.getElementById("search-by-rollNo");
const searchByName = document.getElementById("search-by-name");
const searchByBatch = document.getElementById("search-by-batch");
const searchButton = document.getElementById("search-button");

searchButton.addEventListener("click", function(event) {
  event.preventDefault();
  const rows = document.querySelectorAll(".student-table2 tbody tr");

  for (const row of rows) {
    const rollNo = row.querySelector("td:nth-child(2)").textContent;
    const name = row.querySelector(".name").textContent;
    const batch = row.querySelector("td:nth-child(5)").textContent;

    if (rollNo.includes(searchByRollNo.value) &&
        name.includes(searchByName.value) &&
        batch.includes(searchByBatch.value)) {
      row.style.display = "";
    } else {
      row.style.display = "none";
    }
  }
});





// Get the search input element
const $searchInput = $('#search-input');

// Add an event listener for when the user types in the search input
$searchInput.on('input', (event) => {
  // Get the entered roll number
  const rollNo = $(event.target).val();

  // Find the element with the matching roll number
  const $rowElement = $(`[id="${rollNo}"]`);

  // If the element exists, scroll to it
  if ($rowElement.length) {
    $('html, body').animate({
      scrollTop: $rowElement.offset().top
    }, 500);
  }
});

