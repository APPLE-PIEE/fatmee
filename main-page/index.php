<?php
include'../connect/connect.php';
if(!empty($_SESSION['email'])){
  $email = $_SESSION['email'];
  $taikhoan1=mysqli_query($conn,"SELECT * FROM khachhang WHERE email='$email'");
  foreach($taikhoan1 as $key=>$value)  {
    $ten=$value['HOTEN'].' '.'★';
    $tach_ten = explode(" ", $ten);
    if ($tach_ten[1]=='★'){
      $account=$tach_ten[0];
    } else if ($tach_ten[2]=='★'){
      $account=$tach_ten[0].' '.$tach_ten[1];
    } else  {
      $account=$tach_ten[1].' '.$tach_ten[2];
    }
  }


  $dsgiohang=mysqli_query($conn,"SELECT * FROM giohang WHERE email_khachhang='$email'"); 
  $dsyeuthich=mysqli_query($conn,"SELECT * FROM yeuthich WHERE email_khachhang='$email'");
}


?>

<html>
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="shortcut icon"
      href="../assets/images/main-images/logo-main.png"
      type="image/x-icon"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600;1,700&display=swap"
      rel="stylesheet"
    />
    <!-- css link -->

    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css"
    />
    <!-- my css -->
    <link rel="stylesheet" href="../assets/css/main-page/app.css" />
    <title>FATMe</title>
  </head>
  <body>
    <div class="totop">
      <a href="#" class="goto-top"></a>
    </div>
    <div class="wrapper">
      <header class="header">
        <div class="navigation">
          <a href="#"
            ><img class="header-logo" srcset="../assets/images/main-images/logo.png 2x"
          /></a>
          <input type="checkbox" name="" id="toggle-check" class="toggle-check" />
          <ul class="menu">
            <div class="menu-item toggle-close">
              <label for="toggle-check"
                ><img src="../assets/images/main-images/menu-close.png" alt="Close"
              /></label>
            </div>
            <li class="menu-item"><a class="menu-link" href="#">Trang chủ</a></li>
            <li class="menu-item">
              <a class="menu-link" href="../mon-an/index.php">Món ăn</a>
            </li>
            <li class="menu-item"><a class="menu-link" href="../blog/index.php">Blog</a></li>
            <li class="menu-item">
              <a class="menu-link" href="../service/index.php">Dịch vụ</a>
            </li>
            <li class="menu-item"><a class="menu-link" href="../contact/index.php">Liên hệ</a></li>

            <?php if (empty($_SESSION['email'])){ ?>
              <li class="auth">
              <a class="button button--secondary auth-login" href="../login/index.php">Đăng nhập</a>
              <a class="button button--primary auth-signup" href="../register/index.php">Đăng ký</a>
            </li>
            <?php } else {?>
              <li class="auth">
              <div class="auth-like">
                <div class="auth-like-top">
                  <img
                    class="heart"
                    src="../assets/images/main-images/icon-heart.png"
                    alt="heart"
                  />
                  <img
                    class="arrow-down"
                    src="../assets/images/main-images/icon-arrow-down.png"
                    alt="arrow-down"
                  />
                </div>
                <ul class="auth-like-dropdown">
                <?php 
                
                function formatMoney1($number, $fractional=false){
                  if ($fractional) {
                      $number = sprintf('%.2f', $number);
                  }
                  while (true) {
                      $replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
                      if ($replaced != $number) {
                          $number = $replaced;
                      } else {
                          break;
                      }
                  }
                  return $number;
              }
                
                foreach($dsyeuthich as $key=>$value) { ?>
                  <li class="dropdown-item auth-like-dropdown-item">
                        <img
                          src="../assets/images/food/<?php echo $value['IMAGE']?>"
                          alt="Hình thức ăn"
                          class="dropdown-item-image"
                        />
                        <div class="dropdown-item-text">
                          <div class="dropdown-item-text-desc"><?php echo $value['THELOAI']?></div>
                          <div class="dropdown-item-text-title"><?php echo $value['TENMONAN']?></div>
                          <div class="dropdown-item-text-price"><?php echo formatMoney1($value['GIA'])?></div>
                        </div>
                        <div class="dropdown-item-right">
                          <a href="../mon-an/xoa_thich.php?id=<?php echo $value['id_monan']?>">
                            <img class="trash"src="../assets/images/main-images/icon-trash.png" alt="trash"/>
                          </a>
                            <img class="heart"src="../assets/images/main-images/icon-heart-fill.png"alt="heart"/>
                        </div>
                    </li>
                  <?php }?>
                  <?php
                  $tongtien1=0;
                    foreach($dsyeuthich as $key=>$value)  {
                    $tongtien1=$tongtien1+$value['GIA'];
                  }?>
                    <li class="auth-shoppingcart-dropdown-item">
                      <?php if ($tongtien1==0){ ?>
                        <span class="shoppingcart-alert">
                          Danh sách yêu thích của bạn đang trống !
                        </span>
                            <?php }else {?>
                            <?php }?>



                </ul>
              </div>
              <div class="auth-shoppingcart">
                <div class="auth-shoppingcart-top">
                  <img
                    class="shoppingcart"
                    src="../assets/images/main-images/icon-shoppingcart-header.png"
                    alt="shopping cart"
                  />
                  <img
                    class="arrow-down"
                    src="../assets/images/main-images/icon-arrow-down.png"
                    alt="arrow-down"
                  />
                </div>
                <ul class="auth-shoppingcart-dropdown">
                <?php

                function formatMoney($number, $fractional=false){
                  if ($fractional) {
                      $number = sprintf('%.2f', $number);
                  }
                  while (true) {
                      $replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
                      if ($replaced != $number) {
                          $number = $replaced;
                      } else {
                          break;
                      }
                  }
                  return $number;
              }

                foreach($dsgiohang as $key=>$value)  { ?>
                  <li class="dropdown-item auth-shoppingcart-dropdown-item" >
                      <img src="../assets/images/food/<?php echo $value['IMAGE']?>" alt="Hình thức ăn"
                        class="dropdown-item-image">
                        <div class="dropdown-item-text">
                          <div class="dropdown-item-text-desc"><?php echo $value['THELOAI']?></div>
                          <div class="dropdown-item-text-title"><?php echo $value['TENMONAN']?></div>

                          <div class="dropdown-item-text-price"><span class="price"><?php echo formatMoney($value['GIA'])?></span>đ</div>
                        </div>
                        <div class="dropdown-item-right">
                        <a href="../mon-an/xoa.php?id=<?php echo $value['id_monan']; ?>">
                          <img class="trash" src="../assets/images/main-images/icon-trash.png" alt="trash"/>
                        </a>
                        <img
                          class="heart"
                          src="../assets/images/main-images/icon-heart-fill.png"
                          alt="heart"
                        />
                      </div>
                  </li>
                <?php }?>
                  <?php
                  $tongtien=0;
                    foreach($dsgiohang as $key=>$value)  {
                    $tongtien=$tongtien+$value['GIA']*$value['SOLUONG'];
                  }?>
                    <li class="auth-shoppingcart-dropdown-item">
                      <?php if ($tongtien==0){ ?>
                        <span class="shoppingcart-alert">
                          Giỏ hàng của bạn đang trống !
                        </span>
                            <?php } else {?>
                              <a class="auth-shoppingcart-dropdown-link" href="../shoppingcart/index.php">
                              <span class="sum">
                          Tổng tiền: <span class="sum-price"><?php echo formatMoney($tongtien) ?></span>đ
                        </span>
                        <span>Thanh toán</span>
                        </a>
                            <?php }?>

                    </li>
                </ul>
              </div>
              <div class="auth-user">
                <div class="auth-user-top">
                  <img src="../assets/images/main-images/icon-user.png" alt="user" />
                    <span class="auth-username"><?php echo $account?></span>
                  <img
                    class="arrow-down"
                    src="../assets/images/main-images/icon-arrow-down.png"
                    alt="arrow-down"
                  />
                </div>
                <ul class="auth-user-dropdown">
                  <li class="auth-user-dropdown-item">
                    <a class="auth-user-dropdown-link" href="../profile/index.php">Tài khoản</a>
                  </li>
                  <li class="auth-user-dropdown-item">
                    <a class="auth-user-dropdown-link" href="dx.php">Đăng xuất</a>
                  </li>
                </ul>
              </div>
            </li>
            <?php }?>
          </ul>
          <label for="toggle-check" class="toggle"
            ><img src="../assets/images/main-images/menu.png" alt="Menu"
          /></label>
          <label for="toggle-check" class="overlay"></label>
        </div>
        <div class="header-main container">
          <div class="header-content">
            <span class="global-caption show-on-scroll">Chúng tôi</span>
            <h1 class="global-heading global-heading--huge header-heading show-on-scroll">
              Food At The Moment everytime
            </h1>
            <p class="global-text header-desc show-on-scroll">
              Chúng tôi là công ty cung cấp dịch vụ vận chuyển thức ăn chuyên nghiệp với nhiều
              thương hiệu nổi tiếng.
            </p>
            <div class="header-actions">


            <?php if (empty($_SESSION['email'])){ ?>
              <a class="button button--primary" href="../login/index.php">Đăng nhập</a>
            <?php } else {?>
              <a class="button button--primary" href="../mon-an/index.php">Khám phá</a>
            <?php }?>
              <a class="watch-video button button--secondary btn-watch" href="#!">
                <div class="watch-icon">
                  <img class="watchimg" srcset="../assets/images/main-images/icon-play.png 2x" />
                </div>
                <span>Xem Video</span></a
              >
            </div>
          </div>
          <div class="header-image show-on-scroll">
            <video id="introVideo" class="video" loop controls poster="../assets/images/main-images/img-header.png">
              <source src="./video/videofatme.mp4" type="video/mp4" />
            </video>
            <button id="play-pause" class="btn-watch btn-watch1">
              <div class="watch-icon watch-icon1">
                <img class="watchimg" srcset="../assets/images/main-images/icon-play.png 2x" />
              </div>
            </button>
          </div>
        </div>
      </header>
      <main>
        <!-- brand -->
        <section class="brand">
          <div class="brand-item"><img src="../assets/images/main-images/brand-baemin.png" /></div>
          <div class="brand-item"><img src="../assets/images/main-images/brand-grab.png" /></div>
          <div class="brand-item">
            <img src="../assets/images/main-images/brand-shopeefood.png" />
          </div>
          <div class="brand-item"><img src="../assets/images/main-images/brand-gojek.png" /></div>
          <div class="brand-item"><img src="../assets/images/main-images/brand-loship.png" /></div>
        </section>
        <!-- service -->
        <section class="service">
          <div class="container">
            <div class="service-header">
              <span class="global-caption service-caption show-on-scroll">CHÚNG TÔI LÀM GÌ</span>
              <h2 class="global-heading global-heading--big service-heading show-on-scroll">
                Liên kết các cửa hàng với bạn nhanh chóng
              </h2>
              <p class="global-text service-desc show-on-scroll">
                Hướng đến việc tiện lợi khi ở nhà mà cũng có đồ ăn mọi lúc mọi nơi, chúng tôi sẽ là
                người giúp các bạn thực hiện việc đó dễ dàng hơn.
              </p>
            </div>
            <div class="service-list">
              <div class="service-item show-on-scroll">
                <div class="service-icon">
                  <img src="../assets/images/main-images/icon-food.png" />
                </div>
                <h3 class="global-heading global-heading--normal service-title">
                  Thực phẩm đa dạng
                </h3>
                <p class="global-text service-text">
                  Chúng tôi đảm bảo thức ăn luôn được tươi mới, thơm ngon.
                </p>
              </div>
              <div class="service-item show-on-scroll">
                <div class="service-icon">
                  <img src="../assets/images/main-images/icon-delivery.png" />
                </div>
                <h3 class="global-heading global-heading--normal service-title">
                  Miễn phí vận chuyển
                </h3>
                <p class="global-text service-text">
                  Miễn phí vận chuyển 1 đơn hàng đầu tiên trong ngày.
                </p>
              </div>
              <div class="service-item show-on-scroll">
                <div class="service-icon">
                  <img src="../assets/images/main-images/icon-restaurant.png" />
                </div>
                <h3 class="global-heading global-heading--normal service-title">
                  Hơn 100 nghìn nhà hàng
                </h3>
                <p class="global-text service-text">
                  Nhiều sự lựa chọn, cho các bạn đặt đồ ăn thoải mái nhé.
                </p>
              </div>
            </div>
          </div>
        </section>
        <!-- who -->
        <section class="who">
          <div class="container">
            <div class="who-container">
              <div class="who-image">
                <img srcset="../assets/images/main-images/img-who.png 2x" />
              </div>
              <div class="who-content">
                <span class="global-caption show-on-scroll">Ai muốn gì?</span>
                <h2 class="global-heading global-heading--big show-on-scroll">
                  Vươn tầm sánh bước cùng các bạn mọi nơi
                </h2>
                <p class="global-text show-on-scroll">
                  Bất cứ nơi đâu, với 1 cuộc điện thoại chúng tôi sẽ phục vụ cho bạn những món ngon trọn hương vị
                </p>
                <?php if (empty($_SESSION['email'])){ ?>
                  <a class="button button--primary" href="../register/index.php">Nhấn đăng ký</a>
            <?php } else {?>
              <a class="button button--primary" href="../service/index.php">Xem thêm</a>
            <?php }?>
              </div>
            </div>
          </div>
        </section>
        <!-- mission -->
        <section class="mission">
          <div class="container">
            <div class="mission-container">
              <div class="mission-header">
                <span class="global-caption mission-caption show-on-scroll"
                  >Chúng tôi tôi có gì?</span
                >
                <h2 class="global-heading global-heading--big mission-heading show-on-scroll">
                  Các nhà sáng lập của chúng tôi
                </h2>
                <p class="global-text show-on-scroll">
                  Thông tin của những thành viên đã hợp tác tạo ra FatMe nếu có câu hỏi gì bạn có thể liên hệ trực tiếp cho họ nhé !!!
                </p>
              </div>
              <div class="mission-list">
                <div class="mission-item show-on-scroll">
                  <div class="mission-icon">
                    <img src="../assets/images/avatar_mainpage/win.jpg" />
                  </div>
                  <h3 class="global-heading global-heading--normal mission-title">
                    Lã Mai Win
                  </h3>
                  <p class="global-text mission-text">
                    19522550
                  </p>
                  <p class="global-text">
                    Gia Lai
                  </p>
                  <a class="button button--secondary mission-button" href="https://www.facebook.com/100005212668434">
                    <img src="../assets/images/main-images/messenger.png" alt="">
                    Liên hệ</a>
                </div>
                <div class="mission-item show-on-scroll">
                  <div class="mission-icon">
                    <img src="../assets/images/avatar_mainpage/phung.jpg" />
                  </div>
                  <h3 class="global-heading global-heading--normal mission-title">
                    Nguyễn Minh Phụng
                  </h3>
                  <p class="global-text mission-text">
                    19522049
                  </p>
                  <p class="global-text">
                    Quảng Ngãi
                  </p>
                  <a class="button button--secondary mission-button" href="https://www.facebook.com/100008231018356">
                    <img src="../assets/images/main-images/messenger.png" alt="">
                    Liên hệ</a>
                </div>
                <div class="mission-item show-on-scroll">
                  <div class="mission-icon">
                    <img src="../assets/images/avatar_mainpage/tuan.jpg" />
                  </div>
                  <h3 class="global-heading global-heading--normal mission-title">
                    Nguyễn Minh Tuấn
                  </h3>
                  <p class="global-text mission-text">
                    19522471
                  </p>
                  <p class="global-text">
                    Khánh Hòa
                  </p>
                  <a class="button button--secondary mission-button" href="https://www.facebook.com/100005694195660">
                    <img src="../assets/images/main-images/messenger.png" alt="">
                    Liên hệ</a>
                </div>
                <div class="mission-item show-on-scroll">
                  <div class="mission-icon">
                    <img src="../assets/images/avatar_mainpage/theu.jpg" />
                  </div>
                  <h3 class="global-heading global-heading--normal mission-title">
                    Bùi Thị Thêu
                  </h3>
                  <p class="global-text mission-text">
                    19522254
                  </p>
                  <p class="global-text">
                    Hải Dương
                  </p>
                  <a class="button button--secondary mission-button" href="https://www.facebook.com/100019172957606">
                    <img src="../assets/images/main-images/messenger.png" alt="">
                    Liên hệ</a>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- review -->
        <section class="review">
          <div class="container">
            <div class="review-container">
              <div class="review-list">
                <img class="review-bg" srcset="../assets/images/main-images/review-bg.png 2x" />
                <div>
                  <div class="review-card show-on-scroll">
                    <div class="review-avatar">
                      <img src="../assets/images/avatar_mainpage/avatar1.jpeg " />
                    </div>
                    <h3 class="review-name">Nguyễn Minh Tuấn</h3>
                    <span class="review-job">CEO of IE104</span>
                    <p class="review-desc">
                      Từ khi sử dụng các dịch vụ của FatMe tôi đã tiết kiệm được rất nhiều thời gian cho việc nghĩ hôm nay ăn gì, nấu gì, vừa hợp túi tiền lại còn đảm bảo về chất lượng. Quá tuyệt vời
                    </p>
                    <div class="review-rating">
                      <img srcset="../assets/images/main-images/icon-star.png 2x" /><span>4.5</span>
                    </div>
                    <div class="review-quote">
                      <img srcset="../assets/images/main-images/icon-quote.png 2x" />
                    </div>
                  </div>
                  <div class="review-card show-on-scroll">
                    <div class="review-avatar">
                      <img src="../assets/images/avatar_mainpage/avatar2.jpeg" />
                    </div>
                    <h3 class="review-name">Lã Mai Win</h3>
                    <span class="review-job">CEO of IE104</span>
                    <p class="review-desc">
                      FatMe đã giúp tôi rất nhiều trong việc tổ chức các buổi party gia đình hay cho đồng nghiệp, chất lượng thì quá tuyệt vời, chăm sóc khách hàng cực kì chu đáo. Tôi sẽ tiếp tục ủng hộ và sử dụng FatMe
                    </p>
                    <div class="review-rating">
                      <img srcset="../assets/images/main-images/icon-star.png 2x" /><span>4.5</span>
                    </div>
                    <div class="review-quote">
                      <img srcset="../assets/images/main-images/icon-quote.png 2x" />
                    </div>
                  </div>
                </div>
                <div>
                  <div class="review-card show-on-scroll">
                    <div class="review-avatar">
                      <img src="../assets/images/avatar_mainpage/avatar3.jpeg" />
                    </div>
                    <h3 class="review-name">Nguyễn Tuấn Minh</h3>
                    <span class="review-job">CEO of IE104</span>
                    <p class="review-desc">
                      Nếu bạn cảm thấy việc nấu ăn cho gia đình là 1 cực hình thì hay tìm đến FatMe, ở đây họ sẽ giải quyết tất cả những vấn đề về bếp núc của bạn trong vài phút.
                    </p>
                    <div class="review-rating">
                      <img srcset="../assets/images/main-images/icon-star.png 2x" /><span>4.5</span>
                    </div>
                    <div class="review-quote">
                      <img srcset="../assets/images/main-images/icon-quote.png 2x" />
                    </div>
                  </div>
                </div>
              </div>
              <div class="review-content">
                <span class="global-caption show-on-scroll">Đã làm những gì</span>
                <h2 class="global-heading global-heading--big show-on-scroll">Phản hồi tích cực</h2>
                <p class="global-text show-on-scroll">
                  Bạn có thể xem thêm các phản hồi khác tại đây
                </p>
                <div class="review-number show-on-scroll">
                  <div class="review-check">
                    <img srcset="../assets/images/main-images/icon-check.png 2x" />
                  </div>
                  <span class="review-count">450+</span><span>Phản hồi từ khách hàng</span>
                </div>

                <?php if (empty($_SESSION['email'])){ ?>
                  <a class="button button--primary" href="../register/index.php">Nhấn đăng ký</a>
            <?php } else {?>
              <a class="button button--primary" href="../contact/index.php">Liên hệ với chúng tôi</a>
            <?php }?>
              </div>
            </div>
          </div>
        </section>
        <!-- blog -->
        <section class="blog">
          <div class="container">
            <div class="blog-header">
              <h2 class="global-heading global-heading--big show-on-scroll">
                Các Blog mới nhất đến từ FatMe
              </h2>
              <p class="global-text show-on-scroll">
                Đừng bỏ lỡ blog mới nhất cùa FatMe nhé
              </p>
            </div>
            <!-- blog list -->
            <div class="blog-list slider-responsive">
              <div class="post-item show-on-scroll">
                <a href="../blog/blog_1/index.php" class="post-media">
                  <img src="../assets/images/blog-images/blog1.jpg" alt="" class="post-image" />
                </a>
                <div class="post-content">
                  <a href="#" class="post-category">Shop</a>
                  <h3>
                    <a href="../blog/blog_1/index.php" class="post-title"
                      >Những món ăn nhất định phải thử một lần khi sống trong đời</a
                    >
                  </h3>
                  <p class="post-desc">Tác giả: Blog Ẩm Thực</p>
                </div>
              </div>
              <div class="post-item show-on-scroll">
                <a href="../blog/blog_2/index.php" class="post-media">
                  <img src="../assets/images/blog-images/blog2.jpg" alt="" class="post-image" />
                </a>
                <div class="post-content">
                  <a href="#" class="post-category">Shop</a>
                  <h3>
                    <a href="../blog/blog_2/index.php" class="post-title"
                      >Người Nhật Bản ăn gì vào đêm trăng rằm?</a
                    >
                  </h3>
                  <p class="post-desc">Tác giả: Blog Ẩm Thực</p>
                </div>
              </div>
              <div class="post-item show-on-scroll">
                <a href="../blog/blog_3/index.php" class="post-media">
                  <img src="../assets/images/blog-images/blog3.jpg" alt="" class="post-image" />
                </a>
                <div class="post-content">
                  <a href="#" class="post-category">Shop</a>
                  <h3>
                    <a href="../blog/blog_3/index.php" class="post-title"
                      >Khám phá khu phố Tàu giữa lòng Sài Gòn</a
                    >
                  </h3>
                  <p class="post-desc">Tác giả: LyHoangDong Blog</p>
                </div>
              </div>
              <div class="post-item show-on-scroll">
                <a href="../blog/blog_4/index.php" class="post-media">
                  <img src="../assets/images/blog-images/blog4.jpg" alt="" class="post-image" />
                </a>
                <div class="post-content">
                  <a href="#" class="post-category">Shop</a>
                  <h3>
                    <a href="../blog/blog_4/index.php" class="post-title"
                      >Chỉ Với 30k Thì Ăn Gì Ở Sài Gòn?
                    </a>
                  </h3>
                  <p class="post-desc">Tác giả: lyhoangdong.weebly.com</p>
                </div>
              </div>
              <div class="post-item show-on-scroll">
                <a href="../blog/blog_5/index.php" class="post-media">
                  <img src="../assets/images/blog-images/blog5.jpg" alt="" class="post-image" />
                </a>
                <div class="post-content">
                  <a href="#" class="post-category">Shop</a>
                  <h3>
                    <a href="../blog/blog_5/index.php" class="post-title"
                      >[Bạn Có Biết] TOP 8 loại quả đắt đỏ nhất thế giới</a
                    >
                  </h3>
                  <p class="post-desc">
                    Tác giả: Kiên Nguyễn Blog, Đinh Tùng – Blogchiasekienthuc.com
                  </p>
                </div>
              </div>
              <div class="post-item show-on-scroll">
                <a href="../blog/blog_6/index.php" class="post-media">
                  <img src="../assets/images/blog-images/blog6.png" alt="" class="post-image" />
                </a>
                <div class="post-content">
                  <a href="#" class="post-category">Shop</a>
                  <h3>
                    <a href="../blog/blog_6/index.php" class="post-title"
                      >Food stylist – Những người nghệ sĩ biến hóa trên bàn ăn</a
                    >
                  </h3>
                  <p class="post-desc">Tác giả: Liam Production</p>
                </div>
              </div>
              <div class="post-item show-on-scroll">
                <a href="../blog/blog_7/index.php" class="post-media">
                  <img src="../assets/images/blog-images/blog7.jpeg" alt="" class="post-image" />
                </a>
                <div class="post-content">
                  <a href="#" class="post-category">Shop</a>
                  <h3>
                    <a href="../blog/blog_7/index.php" class="post-title"
                      >Cách làm “ROSÉ ROLL CAKE” – Bánh cuộn kem phômai bằng chảo
                    </a>
                  </h3>
                  <p class="post-desc">Tác giả: Esheep Kitchen</p>
                </div>
              </div>
              <div class="post-item show-on-scroll">
                <a href="../blog/blog_8/index.php" class="post-media">
                  <img src="../assets/images/blog-images/blog8.jpg" alt="" class="post-image" />
                </a>
                <div class="post-content">
                  <a href="#" class="post-category">Shop</a>
                  <h3>
                    <a href="../blog/blog_8/index.php" class="post-title"
                      >6 lợi ích của việc nấu ăn tại nhà
                    </a>
                  </h3>
                  <p class="post-desc">Tác giả: bepxua</p>
                </div>
              </div>
              <div class="post-item show-on-scroll">
                <a href="../blog/blog_9/index.php" class="post-media">
                  <img src="../assets/images/blog-images/blog9.jpg" alt="" class="post-image" />
                </a>
                <div class="post-content">
                  <a href="#" class="post-category">Shop</a>
                  <h3>
                    <a href="../blog/blog_9/index.php" class="post-title"
                      >Chế Độ Ăn Keto Là Gì? Cơ Bản Dành Cho Người Mới Bắt Đầu
                    </a>
                  </h3>
                  <p class="post-desc">Tác giả: benben123</p>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- subscribe -->
        <section class="subscribe">
          <div class="container subscribe-container">
            <div class="subscribe-main">
              <div class="subscribe-content">
                <h2 class="global-haeding subscribe-heading show-on-scroll">
                  Nhận thông báo mới nhất
                </h2>
                <p class="global-text subscribe-desc show-on-scroll">
                  Nhập gmail để không bỏ lỡ những thông báo mới nhất và các ưu đãi hấp dẫn đến từ FATMe nhé !!!
                </p>
              </div>
              <div class="subscribe-form">
                <div class="subscribe-field">
                  <input class="subscribe-input" type="text" placeholder="Email..." />
                </div>
                <button class="button button--primary">Đăng ký</button>
              </div>
            </div>
          </div>
        </section>
      </main>
    </div>
    <footer class="footer">
      <div class="container">
        <div class="footer-container">
          <div class="footer-column">
            <a href="#" class="footer-logo">
              <img srcset="../assets/images/main-images/logo.png 2x" alt="" />
            </a>
            <p class="footer-desc text">Yêu là phải nói, đói là phải ăn, gọi FATMe thật nhanh, giao tận tay khách</p>
            <div class="social">
              <a href="https://www.facebook.com/FootAtTheMoment/" target="_blank" class="social-item">
                <img srcset="../assets/images/main-images/facebook.png 2x" alt="" />
              </a>
              <a href="#" class="social-item">
                <img srcset="../assets/images/main-images/twitter.png 2x" alt="" />
              </a>
              <a href="#" class="social-item">
                <img srcset="../assets/images/main-images/instagram.png 2x" alt="" />
              </a>
            </div>
          </div>
          <div class="footer-column">
            <h3 class="footer-heading heading-small">Món ăn</h3>
            <ul class="footer-links">
              <li class="footer-item">
                <a href="../mon-an/index.php#category" class="footer-link">Thể loại</a>
              </li>
              <li class="footer-item">
                <a href="../mon-an/index.php#category" class="footer-link">Có thể bạn thích</a>
              </li>
              <li class="footer-item">
                <a href="../mon-an/index.php#category" class="footer-link">Mọi người ăn gì</a>
              </li>
            </ul>
          </div>
          <div class="footer-column">
            <h3 class="footer-heading heading-small">Blog</h3>
            <ul class="footer-links">
              <li class="footer-item">
                <a href="../blog/index.php" class="footer-link">Tin hot</a>
              </li>
              <li class="footer-item">
                <a href="../blog/index.php#blog" class="footer-link">Blog mới gần đây</a>
              </li>
              <li class="footer-item">
                <a href="../blog/index.php#blog" class="footer-link">Blog có thể bạn thích</a>
              </li>
              <li class="footer-item">
                <a href="../blog/blog_1/index.php" class="footer-link">Blog 1</a>
              </li>
              <li class="footer-item">
                <a href="../blog/blog_2/index.php" class="footer-link">Blog 2</a>
              </li>
            </ul>
          </div>
          <div class="footer-column">
            <h3 class="footer-heading heading-small">Liên hệ</h3>
            <ul class="footer-links">
              <li class="footer-item">
                <a href="mailto:congtyfatme@gmail.com" class="footer-link-none"
                  >congtyfatme@gmail.com</a
                >
              </li>
              <li class="footer-item">
                <a href="tel:+84971292838" class="footer-link-none">(84+) 971 29 28 38</a>
              </li>
              <li class="footer-item">
                <span class="footer-link-none"
                  >Khu phố 6, P.Linh Trung, Tp.Thủ Đức, Tp.Hồ Chí Minh.</span
                >
              </li>
            </ul>
          </div>
        </div>
        <div class="copyright">All Right Reserved by Us! Copyright FATMe 2021</div>
      </div>
    </footer>
    <!-- script link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.0/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mediaelement/5.0.4/mediaelement-and-player.min.js"></script> -->
    <!-- script -->
    <script src="../assets/js/main.js"></script>
  </body>
</html>
