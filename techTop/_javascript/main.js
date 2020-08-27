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

  if ($('.catalog-products-list').length > 0) {
    var infScroll = new InfiniteScroll('.catalog-products-list', {
      // options
      path: ".woocommerce-pagination a.next",
      append: ".catalog-products-list .catalog-products-item",
      history: false,
      button: '.open-more a',
      scrollThreshold: false,
    });
  }

  // $('.catalog-products-list').infiniteScroll();

  //Unbind load more on scroll
  $(window).unbind('.infscr');

  $(".open-more a").click( function() {
    $(document).trigger('retrieve.infscr');
  });

  if ($('.nav-menu-balance').length > 0) {
    var data = {
      action: 'get_b2b_user_balance',
    };
    jQuery.post( tt_ajax.url, data, function(response) {
      $('.nav-menu-balance').html(response);
    });
  }

  if ($('div.balance').length > 0) {
    var data = {
      action: 'get_b2b_user_balance',
    };
    jQuery.post( tt_ajax.url, data, function(response) {
      $('div.balance p:last-child').html(response);
    });
  }

  $('.show-pass').on('click', function (e) {
      e.preventDefault();
      $(this).toggleClass('show-text');
      var type = $(this).prevAll('.input').first().attr('type');
      if (type === 'password') {
        $(this).prevAll('.input').first().attr('type', 'text');
      } else {
        $(this).prevAll('.input').first().attr('type', 'password');
      }
  });

  jQuery( '#change-password' ).validate({
    onsubmit: true,
    rules: {
      currPass: {
        required: true,
        minlength: 6
      },
      newPass: {
        required: true,
        minlength: 6
      },
      confPass: {
        required: true,
        minlength: 6,
        equalTo: "#newPass"
      }
    }
  });

  $('#change-password .btn-orange').on('click', function (e){
      e.preventDefault();
      if (jQuery('#change-password').valid()) {
        var data = {
          action: 'update_password',
          currPass: $('#change-password #currPass').val(),
          newPass: $('#change-password #newPass').val()
        };
        jQuery.post( tt_ajax.url, data, function(response) {
          $('#change-password .success').text('');
          $('#change-password .errors').text('');
          if (response == 'OK') {
            $('#change-password .success').text('סיסמא שונתה');
          } else {
            $('#change-password .errors').text(response);
          }
        });
      }
  });

  $('#billing-info .btn-orange').on('click', function (e){
      e.preventDefault();
    var data = {
      action: 'update_billing_info',
      Name: $('#billing-info #Name').val(),
      Phone: $('#billing-info #Phone').val(),
      EMail: $('#billing-info #EMail').val(),
      Address: $('#billing-info #Address').val(),
      City: $('#billing-info #City').val(),
      Country: $('#billing-info #Country').val()
    };
    jQuery.post( tt_ajax.url, data, function(response) {
      if (response === 'OK') {
        window.location.href = $('#billing-info .button-group a:last-child').attr('href');
      } else {
        $('#billing-info .errors').text(response);
      }
    });
  });

  $('#billing-address .btn-orange').on('click', function (e){
    e.preventDefault();
    var data = {
      action: 'update_billing_info',
      BName: $('#billing-address #BName').val(),
      BAddress: $('#billing-address #BAddress').val(),
      BCity: $('#billing-address #BCity').val(),
      BRegion: $('#billing-address #BRegion').val(),
      BZip: $('#billing-address #BZip').val(),
      BPhone: $('#billing-address #BPhone').val(),
      Name: $('#billing-address #Name').val(),
      Phone: $('#billing-address #Phone').val(),
      EMail: $('#billing-address #EMail').val(),
      Address: $('#billing-address #Address').val(),
      City: $('#billing-address #City').val(),
      Country: $('#billing-address #Country').val()
    };
    jQuery.post( tt_ajax.url, data, function(response) {
      if (response === 'OK') {
        window.location.href = $('#billing-address .button-group a:last-child').attr('href');
      } else {
        $('#billing-address .errors').text(response);
      }
    });
  });

  $('.btn-group .like').on('click', function (e){
    e.preventDefault();
    var data = {
      action: 'add_to_wishlist',
      sku: $(this).data('sku')
    };
    jQuery.post( tt_ajax.url, data, function(response) {
      alert(response);
    });
  });

  $('[name="wishlist_sorting"]').on('change', function (e){
    e.preventDefault();
    window.location.search = '?sort=' + $('[name="wishlist_sorting"] option:selected').val();
  });

  $('.wishlist.active').on('click', function (e){
    e.preventDefault();
    var data = {
      action: 'remove_from_wishlist',
      sku: $(this).data('sku')
    };
    jQuery.post( tt_ajax.url, data, function(response) {
      alert(response);
      window.location.reload();
    });
  });

});
