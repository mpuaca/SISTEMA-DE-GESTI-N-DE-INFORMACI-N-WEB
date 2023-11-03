(function ($) {
  "use strict";

  // Spinner
  var spinner = function () {
    setTimeout(function () {
      if ($("#spinner").length > 0) {
        $("#spinner").removeClass("show");
      }
    }, 1);
  };
  spinner();

  // Back to top button
  $(window).scroll(function () {
    if ($(this).scrollTop() > 300) {
      $(".back-to-top").fadeIn("slow");
    } else {
      $(".back-to-top").fadeOut("slow");
    }
  });
  $(".back-to-top").click(function () {
    $("html, body").animate({ scrollTop: 0 }, 1500, "easeInOutExpo");
    return false;
  });

  // Sidebar Toggler
  $(".sidebar-toggler").click(function () {
    $(".sidebar, .content").toggleClass("open");
    return false;
  });

  // Progress Bar
  $(".pg-bar").waypoint(
    function () {
      $(".progress .progress-bar").each(function () {
        $(this).css("width", $(this).attr("aria-valuenow") + "%");
      });
    },
    { offset: "100%" }
  );

// Cierra el menú desplegable cuando se hace clic en un enlace
$(".navbar-nav a").on("click", function () {
  $(".navbar-collapse").collapse("hide");
});

  // Testimonials carousel
  $(".testimonial-carousel").owlCarousel({
    autoplay: true,
    smartSpeed: 1000,
    items: 1,
    dots: true,
    loop: true,
    nav: false,
  });
  
})(jQuery);

$(document).ready(function() {
    // Obtén la URL actual de la página
    var currentUrl = window.location.href;

    // Encuentra todos los enlaces dentro de la barra lateral y los menús desplegables
    $('.navbar-nav a, .dropdown-menu a').each(function() {
        // Compara la URL del enlace con la URL actual
        if (this.href === currentUrl) {
            // Agrega la clase "active" al enlace activo
            $(this).addClass('active');

            // Si es un enlace dentro de un menú desplegable, también activa el menú
            $(this).parents('.dropdown-menu').prev('.dropdown-toggle').addClass('active');
        }
    });
});
$(document).ready(function() {
  // Obtén la URL actual de la página
  var currentUrl = window.location.href;

  // Encuentra todos los enlaces dentro de la barra de navegación
  $('.nav-link').each(function() {
      // Compara la URL del enlace con la URL actual
      if (this.href === currentUrl) {
          // Agrega la clase "active" al enlace activo
          $(this).addClass('active');
      }
  });
});