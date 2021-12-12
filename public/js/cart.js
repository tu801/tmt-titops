/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!******************************!*\
  !*** ./resources/js/cart.js ***!
  \******************************/
$(document).ready(function () {
  $('.imgSlide').on('click', function (e) {
    var imgUrl = $(this).attr('data-img');
    $('#mainImg').html('<img src="' + imgUrl + '" class="img-fluid z-depth-1">');
  });
});
$('#tmtAddPdtForm').on('submit', function (e) {
  e.preventDefault();
  var url = $(this).attr('action');
  console.log($('#tmtAddPdtForm').serialize());
  var formData = new FormData();
  formData.append('_token', appToken);
  var pdtQuantity = $('#pdtQuantity').val();
  formData.append('quantity', pdtQuantity);
  var pdtId = $('#pdtId').val();
  formData.append('product', pdtId);
  var orderId = $('#order').val();
  formData.append('order', orderId);
  $.ajax({
    url: url,
    data: formData,
    dataType: "json",
    contentType: false,
    processData: false,
    type: "POST",
    success: function success(response) {
      if (response.error == 1) {
        swal({
          text: response.message,
          icon: "error"
        });
      } else {
        var order = response.data;

        if (orderId == 0) {
          $('#order').val(order.id);
          var cartHtml = '<div class="container">' + '<div class="shopping-cart" id="shpCart">' + order.cartHtml + '</div></div>';
          $('#cartContent').html(cartHtml);
          var cartCount = '<span class="badge" id="cartCount" >' + order.items.length + '</span>';
          $('#cartDropdown').append(cartCount);
        } else {
          $('#shpCart').html(order.cartHtml);
          $('#cartCount').html(order.items.length);
        }

        swal({
          icon: "success",
          text: response.message
        });
      }
    },
    error: function error(_xhr, _status, _error) {
      swal({
        icon: "error",
        text: "There was something wrong! Please refresh your browser and try again later"
      });
    }
  });
});
/******/ })()
;