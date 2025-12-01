// let menu = document.getElementById('topNavBar');
// let offset = menu.offsetHeight;
// window.onscroll = function () {
//   if (window.scrollY > offset - 10) {
//     menu.classList.add("sticky");
//   } else if (window.scrollY < offset - 20) {
//     menu.classList.remove("sticky");
//   }
// }
jQuery(document).ready(function($){
  $('.rgc_content_box_two_col p').each(function () {
    if ($(this).text().trim().length === 0) {
      $(this).css('padding-bottom', '0');
    }
  });
  // our services owl slider
  $('.our-service-slider').owlCarousel({
    loop: false,
    margin: 30,
    autoplay: false,
    center: false,
    autoWidth: false,
    autoplayHoverPause: true,
    autoplayTimeout: 6000,
    autoplaySpeed: 6000,
    animateIn: "linear",
    animateOut: "linear",
    nav: true,
    dots: false,
    navText: [
      '<i class="fa-solid fa-chevron-left"></i>',
      '<i class="fa-solid fa-chevron-right">'
    ],
    responsive: {
      0: {
        items: 1,
      },
      400: {
        items: 2,
      },
      600: {
        items: 2,
      },
      1000: {
        items: 3,
      },
      1920: {
        items: 3
      }
    }
  });
});


document.addEventListener("DOMContentLoaded", function () {
    const currentUrl = window.location.href;
    const menuLinks = document.querySelectorAll("#menu-header-menu a");

    menuLinks.forEach(link => {
        if (link.href === currentUrl) {
            // Add active class to the clicked link
            link.classList.add("active");

            // If inside dropdown → also activate parent li
            const parentItem = link.closest(".nav-item");
            if (parentItem) {
                parentItem.classList.add("active-parent");
            }
        }
    });
});