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
  
  // Animations
  $(document).ready(function() {
    function isElementInView(elem) {
      var top_of_element = $(elem).offset().top;
      var bottom_of_element = $(elem).offset().top + $(elem).outerHeight();
      var bottom_of_screen = $(window).scrollTop() + $(window).innerHeight();
      var top_of_screen = $(window).scrollTop();
  
      return (bottom_of_screen > top_of_element) && (top_of_screen < bottom_of_element);
    }
  
    function checkSlide() {
      $('.slide-up, .slide-left, .slide-right').each(function() {
        if (isElementInView($(this))) {
          $(this).addClass('show');
        }
      });
    }
  
    $(window).on('scroll', checkSlide); // Check on scroll
    checkSlide(); // Check on page load
  });
  
  
  
  