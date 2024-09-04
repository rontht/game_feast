// Update rating base on the range selector
function updateRating(val) {
    document.getElementById('rating-display').value = val;
}

// Open Sidebar
const sidebar = document.querySelector("#sidebar-icon");
sidebar.addEventListener("click", function () {
    document.querySelector("#sidebar").classList.toggle("expand");
});

// // Open Add Menu
// const add_menu = document.querySelector("#add-menu-button");
// add_menu.addEventListener("click", function () {
//     document.querySelector("#add-container").classList.toggle("display");
// });

// Change between differen forms
function showForm(formNum) {
    id = "";
    if (formNum == 1) {
        id = "form_1"
    } else if (formNum == 2) {
        id = "form_2"
    } else if (formNum == 3) {
        id = "form_3"
    }
    // Find the selected form
    const selected_form = document.getElementById(id);
    if ( selected_form.classList.contains('display')) {
        // Just hide all forms if the forms are already opened
        document.querySelectorAll('.custom_form').forEach(form => form.classList.remove('display'));
    } else {
        // Hide all forms first
        document.querySelectorAll('.custom_form').forEach(form => form.classList.remove('display'));
        // Then show the selected form
        document.getElementById(id).classList.toggle('display');
    }
}
