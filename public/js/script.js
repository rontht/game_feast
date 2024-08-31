const sidebar = document.querySelector("#sidebar-icon");

sidebar.addEventListener("click", function() {
    document.querySelector("#sidebar").classList.toggle("expand");
});