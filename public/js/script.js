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
    if (selected_form.classList.contains('display')) {
        // Just hide all forms
        document.querySelectorAll('.custom_form').forEach(card => card.classList.remove('display'));
    } else {
        // Hide all forms
        document.querySelectorAll('.custom_form').forEach(card => card.classList.remove('display'));
        // Show the selected form
        document.getElementById(id).classList.toggle('display');
    }
}


// From Bootstrap
(() => {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }

            form.classList.add('was-validated')
        }, false)
    })
})()