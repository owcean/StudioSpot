document.addEventListener("DOMContentLoaded", function () {
    const menuToggle = document.getElementById("menu-toggle");
    const navMenu = document.getElementById("nav-menu");

    menuToggle.addEventListener("click", function () {
        console.log("Hamburger clicked!"); // Debugging log
        navMenu.classList.toggle("active");
        console.log(navMenu.classList); // Tingnan kung nadadagdag ang 'active'
    });
});