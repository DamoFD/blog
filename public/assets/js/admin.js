document.addEventListener("DOMContentLoaded", function () {
    var menuToggle = document.querySelector(".menu-toggle");
    var navItems = document.querySelectorAll(".nav-item");
  
    // Mobile Nav Toggle
    if (menuToggle) {
      menuToggle.addEventListener("click", function () {
        var nav = document.querySelector(".nav");
        nav.classList.toggle("mobile-nav");
        this.classList.toggle("is-active");
      });
  
      navItems.forEach(function (navItem) {
        navItem.addEventListener("click", function () {
          var nav = document.querySelector(".nav");
          nav.classList.toggle("mobile-nav");
          menuToggle.classList.toggle("is-active");
        });
      });
    }
  });