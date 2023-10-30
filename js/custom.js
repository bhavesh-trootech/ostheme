// var jQueryslider = jQuery('.slider');

// if (jQueryslider.length) {
//   var currentSlide;
//   var slidesCount;
//   var sliderCounter = document.createElement('div');
//   sliderCounter.classList.add('slider__counter');
  
//   var updateSliderCounter = function(slick, currentIndex) {
//     currentSlide = slick.slickCurrentSlide() + 1;
//     slidesCount = slick.slideCount;
//     jQuery(sliderCounter).text(currentSlide + '/' +slidesCount)
//   };

//   jQueryslider.on('init', function(event, slick) {
//     jQueryslider.append(sliderCounter);
//     updateSliderCounter(slick);
//   });

//   jQueryslider.on('afterChange', function(event, slick, currentSlide) {
//     updateSliderCounter(slick, currentSlide);
//   });

//   jQueryslider.slick();
// }


// Home-page slider JS
var jQueryslider = jQuery('.slider');

if (jQueryslider.length) {
  var currentSlide;
  var slidesCount;
  var sliderCounter = document.createElement('div');
  sliderCounter.classList.add('slider__counter');

  jQueryslider.on('init', function(event, slick) {
    jQueryslider.find(".slider-image").next().find(".elementor-widget-container").append(sliderCounter);
    updateSliderCounter(slick);
  });

  var updateSliderCounter = function(slick, currentIndex) {
    currentSlide = slick.slickCurrentSlide() + 1;
    slidesCount = slick.slideCount;
    jQueryslider.find(".slider-image").next().find(".elementor-widget-container .slider__counter").text(currentSlide + '/' + slidesCount);
  };

  jQueryslider.on('afterChange', function(event, slick, currentSlide) {
    updateSliderCounter(slick, currentSlide);
  });

  jQueryslider.slick({
    autoplay: true, // Add this option to enable autoplay
    autoplaySpeed: 3000, // Adjust the speed (in milliseconds) as needed
    speed: 1000
  });
}



// sticky header JS
jQuery(window).on("load scroll", function() {
  var height = jQuery(window).scrollTop();
  if (height >= 80) {
     jQuery('.mega-menu').addClass('sticky-header');
  } else {
    jQuery('.mega-menu').removeClass('sticky-header');
  }
});



// interactive cursor JS
var cursor = document.querySelector(".cursor");
document.addEventListener("mousemove" ,function(e){
  cursor.style.cssText = "left: " + e.clientX + "px; top: " + e.clientY + "px;";
})

jQuery(document).ready(function(){
  // jQuery(".osa-image-col > div").hover(function(){
  //   jQuery(".cursor").toggleClass("circle");
  // });

  jQuery(".osa-image-col > div .projectImg").hover(function(){
    jQuery(".cursor").toggleClass("circle");
  });

  jQuery(".osa-image-col > div .projectTitle").hover(function(){
    jQuery(".cursor").toggleClass("circle");
  });

  // jQuery(".osa-image-col > div .projectTitle a").hover(function(){
  //   jQuery(".cursor").toggleClass("circle");
  // });
});