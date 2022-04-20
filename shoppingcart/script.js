
$(document).ready(function () {
  /* Set rates + misc */
  
  var shippingRate = 15.0;
  var fadeTime = 300;

  /* Assign actions */
  $(".product-quantity input").change(function () {
    updateQuantity(this);
  });

  $(".product-removal button").click(function () {
    removeItem(this);
  });

  /* Recalculate cart */
  function recalculateCart() {
    var subtotal = 0;

    /* Sum up row totals */
    $(".product").each(function () {
      subtotal += parseFloat($(this).children(".product-line-price").text());
    });

    /* Calculate totals */
    var tax = subtotal 
    var shipping = subtotal > 0 ? shippingRate : 0;
    var total = subtotal + shipping;

    /* Update totals display */
    $(".totals-value").fadeOut(fadeTime, function () {
      $("#cart-subtotal").html(subtotal.toFixed(3));
      $("#cart-tax").html(tax.toFixed(3));
      $("#cart-shipping").html(shipping.toFixed(3));
      $("#cart-total").html(total.toFixed(3));
      if (total == 0) {
        $(".checkout").fadeOut(fadeTime);
      } else {
        $(".checkout").fadeIn(fadeTime);
      }
      $(".totals-value").fadeIn(fadeTime);
    });
  }

  /* Update quantity */
  function updateQuantity(quantityInput) {
    /* Calculate line price */
    var productRow = $(quantityInput).parent().parent();
    var price = parseFloat(productRow.children(".product-price").text());
    var quantity = $(quantityInput).val();
    var linePrice = price * quantity;

    /* Update line price display and recalc cart totals */
    productRow.children(".product-line-price").each(function () {
      $(this).fadeOut(fadeTime, function () {
        $(this).text(linePrice.toFixed(3));
        recalculateCart();
        $(this).fadeIn(fadeTime);
      });
    });
  }

  /* Remove item from cart */
  function removeItem(removeButton) {
    /* Remove row from DOM and recalc cart total */
    var productRow = $(removeButton).parent().parent();
    productRow.slideUp(fadeTime, function () {
      productRow.remove();
      recalculateCart();
    });
  }
});


$('input.input-qty').each(function() {
  var $this = $(this),
    qty = $this.parent().find('.is-form'),
    min = Number($this.attr('min')),
    max = Number($this.attr('max'))
  if (min == 0) {
    var d = 0
  } else d = min
  $(qty).on('click', function() {
    if ($(this).hasClass('minus')) {
      if (d > min) d += -1
    } else if ($(this).hasClass('plus')) {
      var x = Number($this.val()) + 1
      if (x <= max) d += 1
    }
    $this.attr('value', d).val(d)
  })
})

