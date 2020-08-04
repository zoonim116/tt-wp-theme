var $ = require( "jquery" );
var slick = require('slick-carousel');

document.addEventListener('DOMContentLoaded', () => {
  var blogList = {
    infinite: true,
    slidesToShow: 3,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 4000,
    dots: true,
    rtl: true,
    arrows: false,
    responsive: [
      {
        breakpoint: 767,
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
    ]
  }
  $('.blog-list').slick(blogList);
  $('.new-products-list').slick(blogList);
  $('.appeared-products-list').slick(blogList);
  $('.removed-products-list').slick(blogList);

  $('.card-slider .slider-for').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    fade: true,
    asNavFor: '.card-slider .slider-nav',
    rtl: true,
    arrows: true,
    prevArrow: $('.arrows-slider .prev'),
    nextArrow: $('.arrows-slider .next'),
  });


  $('.card-slider .slider-nav').slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    asNavFor: '.card-slider .slider-for',
    dots: false,
    focusOnSelect: true,
    vertical: true,
    verticalScrolling: true,
    infinite: true,
    autoplay: true,
    autoplaySpeed: 5000,
    responsive: [
      {
        breakpoint: 767,
        settings: {
          slidesToShow: 2,
          vertical: false,
          verticalScrolling: false,
          rtl: true
        }
      }
    ]
  });

  $('.proposition-list').slick({
    infinite: true,
    dots: false,
    rtl: true,
    arrows: false,
    autoplay: true,
    autoplaySpeed: 5000,
  });



  $('.more-btn').click(function(){
    $('.nav-menu ul').toggleClass('active');
  });

  $('.form-head').click(function(){
    $(this).parent().toggleClass('active');
  });

  $(".navbar-burger").click(function() {
    // Toggle the "is-active" class on both the "navbar-burger" and the "navbar-menu"
    $(".navbar-burger").toggleClass("is-active");
    $(".navbar-menu").toggleClass("is-active");
  });

  var stepsSlider = document.getElementById('steps-slider');
  var input0 = document.getElementById('input-with-keypress-0');
  var input1 = document.getElementById('input-with-keypress-1');

  var inputs = [input0, input1];
  if (null!==stepsSlider) {
    noUiSlider.create(stepsSlider, {
      start: [20, 80],
      connect: true,
      direction: 'rtl',
      range: {
        'min': [0],
        '10%': [10, 10],
        '50%': [80, 50],
        '80%': 150,
        'max': 200
      }
    });

    stepsSlider.noUiSlider.on('update', function (values, handle) {
      inputs[handle].value = values[handle];
    });
  }



});
