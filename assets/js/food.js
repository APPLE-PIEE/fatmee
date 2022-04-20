$(".slider-responsive-banner").slick({
  arrows: false,
  infinite: true,
  slidesToScroll: 1,
  adaptiveHeight: true,
  autoplay: false,
  autoplaySpeed: 4000,
  speed: 1000,
});
$(".slider-responsive-banner-list").slick({
  slidesToShow: 3,
  arrows: false,
  infinite: true,
  slidesToScroll: 2,
  autoplay: true,
  autoplaySpeed: 5000,
  variableWidth: true,
  speed: 1000,
  responsive: [
    {
      breakpoint: 1200,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
      },
    },
    {
      breakpoint: 767,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        variableWidth: false,
      },
    },
  ],
});
$(".slider-responsive-category-list").slick({
  slidesToShow: 4,
  arrows: false,
  infinite: true,
  slidesToScroll: 2,
  responsive: [
    {
      breakpoint: 1200,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
      },
    },
    {
      breakpoint: 1023,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
      },
    },
    {
      breakpoint: 767,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
      },
    },
  ],
});
$(".slider-responsive-product-list").slick({
  infinite: false,
  speed: 300,
  slidesToShow: 1,
  variableWidth: true,
});

// get class heart click to change innerhtml image and get back
$(".heart").click(function () {
  if ($(this).attr("src") == "../assets/images/main-images/icon-heart.png") {
    $(this).attr("src", "../assets/images/main-images/icon-heart-fill.png");
  } else {
    $(this).attr("src", "../assets/images/main-images/icon-heart.png");
  }
});

$("input.input-qty").each(function () {
  var $this = $(this),
    qty = $this.parent().find(".is-form"),
    min = Number($this.attr("min")),
    max = Number($this.attr("max"));
  if (min == 0) {
    var d = 0;
  } else d = min;
  $(qty).on("click", function () {
    if ($(this).hasClass("minus")) {
      if (d > min) d += -1;
    } else if ($(this).hasClass("plus")) {
      var x = Number($this.val()) + 1;
      if (x <= max) d += 1;
    }
    $this.attr("value", d).val(d);
  });
});
function adu(){
  location.href = "../../TongcongtyFATme/mon-an/monan1/index.php";
}
document.getElementById("gaga").onclick=function(){adu();};

function openCity(evt, cityName) {
  var i, x, tablinks;
  x = document.getElementsByClassName("city");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < x.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" focus", ""); 
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " focus";
}