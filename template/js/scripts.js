// Use this file to add JavaScript to your project

// Home page header -> Select2 plugin in initialisation
$("#brand").select2({
    placeholder: "Brand",
  });
$("#model").select2({
    placeholder: "Model",
  });
$("#year").select2({
    placeholder: "Year",
  });

$("#sort").select2({
    placeholder: "Sort By",
  });

$("#blocksort").select2({
    placeholder: "Sort By",
  });

  // Home page car section filter script
  $(function () {

    $("#filter li").click(function () {

      var category = $(this).html();

      category = category.toLowerCase();

      $("#filter li").removeClass("active");

      $(this).addClass("active");

      $("#portfolio .car-card").fadeOut();

      $("#portfolio .car-card").each(function () {

        if ($(this).hasClass(category)) {
          $(this).fadeIn();
        }

      });

    });

  });

  // Brand slick slider
  $('.brand-carousel').slick({
    dots: false,
    infinite: true,
    speed: 300,
    slidesToShow: 6,
    slidesToScroll: 4,
    centerMode: true,
    arrows: true,
    autoplay: true,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3,
          infinite: true,
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
      // You can unslick at a given breakpoint now by adding:
      // settings: "unslick"
      // instead of a settings object
    ]
  });

  // Testimonial slick slider
  $('.testimonial-carousel').slick({
    dots: false,
    infinite: true,
    speed: 300,
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    autoplay: true,
  });

  const menuLinks = document.querySelectorAll(".menu-link");

menuLinks.forEach((link) => {
	link.addEventListener("click", () => {
		menuLinks.forEach((link) => {
			link.classList.remove("is-active");
		});
		link.classList.add("is-active");
	});
});


// video moda script
$(document).ready(function () {
  // open modal on page load
  // $("#myModal").modal("show");
  $("#myModal").on("shown.bs.modal", function (e) {
    const video = document.getElementById("videoModal");
    video.play();
  });
  // stop video on modal hide
  $("#myModal").on("hide.bs.modal", function (e) {
    const video = document.getElementById("videoModal");
    video.pause();
  });
});

// Price range slider
//-----JS for Price Range slider-----
$(function() {
	$( ".range-bar" ).slider({
	  range: true,
	  min: 0,
	  max: 3000000,
	  values: [ 0, 3000000 ],
	  slide: function( event, ui ) {
		$( ".filterAmount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
	  }
	});
	$( ".filterAmount" ).val( "$" + $( ".range-bar" ).slider( "values", 0 ) +
	  " - AED" + $( ".range-bar" ).slider( "values", 1 ) );
});


// Move to top script
window.onscroll = () => {
  toggleTopButton();
}
function scrollToTop(){
  window.scrollTo({top: 0, behavior: 'smooth'});
}

function toggleTopButton() {
  if (document.body.scrollTop > 0 ||
      document.documentElement.scrollTop > 0) {
    document.getElementById('back-to-up').classList.remove('d-none');
  } else {
    document.getElementById('back-to-up').classList.add('d-none');
  }
}
// move to top script ends

// View mode button activation script
$(".list-btn").on('click', function () {
  $(".list-btn").addClass('active');
  $(".flat-card-div").removeClass('block-card');
  $(".block-btn").removeClass('active');

});
$(".block-btn").on('click', function () {
  $(".flat-card-div").addClass('block-card');
  $(".block-btn").addClass('active');
  $(".list-btn").removeClass('active');
});
// View mode button activation script ends


// Search result list card lightbox with slider script
$(document).ready(function () {
  $('.js-gallery').slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      autoplay: true,
      prevArrow: '<span class="gallery-arrow mod-prev"><i class="fa-solid fa-chevron-left"></i></span>',
      nextArrow: '<span class="gallery-arrow mod-next"><i class="fa-solid fa-chevron-right"></i></span>'
  });

  $('.js-gallery').slickLightbox({
      src: 'src',
      itemSelector: '.js-gallery-popup img',
      background: 'rgba(0, 0, 0, .7)'
  });
});
// Search result list card lightbox with slider script ends