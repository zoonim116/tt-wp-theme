var $ = require( "jquery" );
var slick = require('slick-carousel');
document.addEventListener('DOMContentLoaded', () => {

  jQuery('body').on('added_to_cart', function (a1, a2, a3){
    jQuery('.cart .navbar-end-menu__sub-cart').html(a2['div.widget_shopping_cart_content']);
    jQuery('.navbar-item li.cart .counter').html(a2['header-cart-count']);
    jQuery('.notification-area').html(a2['popup_notification']);
    $([document.documentElement, document.body]).animate({
      scrollTop: $(".notification-area").offset().top - 50
  }, 1000);
  });

  jQuery('body').on('removed_from_cart', function (a1, a2, a3){
    jQuery('.navbar-item li.cart .counter').html(a2['header-cart-count']);
    jQuery(document.body).trigger('wc_fragments_refreshed');
  });

  jQuery('body').on('wishlist_fragments_refreshed', function (){
    var data = {
      action: 'mini_wishlist_fragments_refreshed',
    };
    jQuery.post( tt_ajax.url, data, function(response) {
      $('.mini-wishlist .navbar-end-menu__sub-cart').html(response);
    });

    var data = {
      action: 'mini_wishlist_count_refreshed',
    };
    jQuery.post( tt_ajax.url, data, function(response) {
      $('.mini-wishlist .counter').html(response);
    });
  });

  $('.footer-title').on('click', function (){
    $(this).next().toggleClass('category-list-hidden');
  });

  $('.resselers-item .more-info .btn').on('click', function (e){
    e.preventDefault();
    $(this).next().removeClass('is-hidden');
    $(this).addClass('is-hidden');
  });

  jQuery('body').on('wc_fragments_refreshed', function (a1, a2, a3){
    $.post(
        woocommerce_params.ajax_url,
        {'action': 'tt_update_mini_cart'},
        function(response) {
          $('.navbar-end-menu__sub-cart').html(response);
        }
    );
  });

  $(document).on('click', '.wish_list .remove_from_wishlist_button',  function (e){
    e.preventDefault();
    var self = this;
    var data = {
      action: 'mini_remove_from_wishlist',
      sku: $(this).data('sku')
    };
    jQuery.post( tt_ajax.url, data, function(response) {
      jQuery( 'body' ).trigger( 'wishlist_fragments_refreshed');
      // $(self).closest('li').remove();
      // var total = JSON.parse(response).total;
      // if (total > 0) {
      //   $('.mini-wishlist .counter span').text(total);
      // } else {
      //   $('.mini-wishlist .counter span').remove();
      // }
    });
  });

  var filtersWasChanged = false;

  $('[name="woocommerce_checkout_place_order"]').on('click', function () {
    $('#payment.woocommerce-checkout-payment #place_order').trigger('click');
  });

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
  $('.more-btn.remove').click(function(event){
    event.preventDefault();
      $('form').addClass('remove');
    });

  $("form#filters-form :input").change(function() {
    filtersWasChanged = true;
  });

  $('.product-quantity input').on('blur', function () {
      $('.actions button[name="update_cart"]').trigger('click');
  });

  $('.form-head').click(function() {
    var elem = $(this).parent();
    $(this).parent().addClass('active');
    $(document).click(function(event) {
      var $target = $(event.target);
      if(!$target.closest(elem[0]).length &&
          $(elem[0]).is(":visible")) {
        $(elem[0]).removeClass('active');
        if (filtersWasChanged) {
          $('form#filters-form').submit();
        }
      }
    });
  });



  $(".navbar-burger").click(function() {
    // Toggle the "is-active" class on both the "navbar-burger" and the "navbar-menu"
    $(".navbar-burger").toggleClass("is-active");
    $(".navbar-menu").toggleClass("is-active");
  });

  $('[id^=steps-slider-]').each(function (index, stepsSlider) {
    var filterParam = $(stepsSlider).prev();
    var input0 = filterParam.find('.start_value');
    var input1 = filterParam.find('.end_value');
    var minVal = $(input0).val();
    var maxVal = $(input1).val();
    var inputs = [input0[0], input1[0]];
    if (null!==stepsSlider) {
      noUiSlider.create(stepsSlider, {
        start: [minVal, maxVal],
        connect: true,
        direction: 'rtl',
        range: {
          'min': parseFloat(minVal),
          'max': parseFloat(maxVal)
        }
      });

      stepsSlider.noUiSlider.on('update', function (values, handle) {
        inputs[handle].value = values[handle];
      });
    }
  });


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


  if (jQuery('div.balance').length > 0) {
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
    var self = this;
    var data = {
      action: 'add_to_wishlist',
      sku: $(this).data('sku')
    };
    jQuery.post( tt_ajax.url, data, function(response) {
      if (response == "OK") {
        jQuery( 'body' ).trigger( 'wishlist_fragments_refreshed');
        $(self).addClass('active');
      } else {
        alert(response);
      }

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
      // alert(response);
      window.location.reload();
    });
  });

  $('.home-slider').slick({
    infinite: true,
    dots: true,
    rtl: true,
    arrows: false,
    autoplay: true,
    autoplaySpeed: 5000,
  });

  $('.brands-list').slick({
    infinite: true,
    slidesToShow: 5,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 4000,
    dots: false,
    rtl: true,
    arrows: true,
    prevArrow: $('.our-brands .arrows-slider .prev'),
    nextArrow: $('.our-brands .arrows-slider .next'),
    responsive: [
      {
        breakpoint: 991,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 1
        }
      },
      {
        breakpoint: 767,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1
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
  });
  $('[id^=catalog-products-list-]').each(function (index, productList) {
    $(productList).slick({
      infinite: true,
      slidesToShow: 3,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 4000,
      dots: false,
      rtl: true,
      arrows: true,
      prevArrow: $(productList).next().find('.prev'),
      nextArrow: $(productList).next().find('.next'),
      responsive: [
        {
          breakpoint: 991,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1
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
    });
  });

});
