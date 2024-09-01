const sidebar = document.querySelector("#sidebar-icon");
const add_game = document.querySelector("#add-game");
const add_dev = document.querySelector("#add-dev")

function updateRating(val) {
    document.getElementById('rating-display').value = val;
}

sidebar.addEventListener("click", function() {
    document.querySelector("#sidebar").classList.toggle("expand");
});

add_game.addEventListener("click", function() {
    document.querySelector("#add-container").classList.toggle("display");
});

add_dev.addEventListener("click", function() {
    document.querySelector("#add-container").classList.toggle("display");
});

// Testing
// var is_opened = false;
// var game_mode = false;
// var dev_mode = false;
// if (is_opened == true) {
//     // as form is already opened. just open the game mode
// } else if (is_opened == true & game_mode == true) {
//     // close everything
//     is_opened = false;
//     game_mode = false;
//     dev_mode = false;
// } else {
//     // open the form and game mode
//     is_opened = true;
//     game_mode = true;
//     dev_mode = false;
// }