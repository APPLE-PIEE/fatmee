<?php
include'../../connect/connect.php';

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
  $dsyeuthich=mysqli_query($conn,"SELECT * FROM yeuthich WHERE email_khachhang='$email'");
  $dsgiohang=mysqli_query($conn,"SELECT * FROM giohang WHERE email_khachhang='$email'"); 
}

?>

<html>
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="shortcut icon"
      href="../../assets/images/main-images/logo-main.png"
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
    <link rel="stylesheet" href="../../assets/css/main-page/app.css" />
    <link rel="stylesheet" href="../../assets/css/blog/app.css" />
    <title>FATMe - Blog</title>
  </head>
  <body>
    <div class="totop">
      <a href="#" class="goto-top"></a>
    </div>
    <div class="wrapper">
      <header class="header">
        <div class="navigation">
          <a href="../../main-page/index.php"
            ><img class="header-logo" srcset="../../assets/images/main-images/logo.png 2x"
          /></a>
          <input type="checkbox" name="" id="toggle-check" class="toggle-check" />
          <ul class="menu">
            <div class="menu-item toggle-close">
              <label for="toggle-check"
                ><img src="../../assets/images/main-images/menu-close.png" alt="Close"
              /></label>
            </div>
            <li class="menu-item"><a class="menu-link" href="../../main-page/index.php">Trang chủ</a></li>
            <li class="menu-item">
              <a class="menu-link" href="../../mon-an/index.php">Món ăn</a>
            </li>
            <li class="menu-item"><a class="menu-link link-active" href="../../blog/index.php">Blog</a></li>
            <li class="menu-item"><a class="menu-link" href="../../service/index.php">Dịch vụ</a></li>
            <li class="menu-item"><a class="menu-link" href="../../contact/index.php">Liên hệ</a></li>
            <?php if (empty($_SESSION['email'])){ ?>
                <li class="auth">
                    <a class="button button--secondary auth-login" href="../../login/index.php">Đăng nhập</a>
                    <a class="button button--primary auth-signup" href="../../register/index.php">Đăng ký</a>
                </li>
            <?php } else {?>
              <li class="auth">
              <div class="auth-like">
                <div class="auth-like-top">
                  <img
                    class="heart"
                    src="../../assets/images/main-images/icon-heart.png"
                    alt="heart"
                  />
                  <img
                    class="arrow-down"
                    src="../../assets/images/main-images/icon-arrow-down.png"
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
                          src="../../assets/images/food/<?php echo $value['IMAGE']?>"
                          alt="Hình thức ăn"
                          class="dropdown-item-image"
                        />
                        <div class="dropdown-item-text">
                          <div class="dropdown-item-text-desc"><?php echo $value['THELOAI']?></div>
                          <div class="dropdown-item-text-title"><?php echo $value['TENMONAN']?></div>
                          <div class="dropdown-item-text-price"><?php echo formatMoney1($value['GIA'])?></div>
                        </div>
                        <div class="dropdown-item-right">
                          <a href="../../mon-an/xoa_thich.php?id=<?php echo $value['id_monan']?>">
                            <img class="trash"src="../../assets/images/main-images/icon-trash.png" alt="trash"/>
                          </a>
                            <img class="heart"src="../../assets/images/main-images/icon-heart-fill.png"alt="heart"/>
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
                    src="../../assets/images/main-images/icon-shoppingcart-header.png"
                    alt="shopping cart"
                  />
                  <img
                    class="arrow-down"
                    src="../../assets/images/main-images/icon-arrow-down.png"
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
                      <img src="../../assets/images/food/<?php echo $value['IMAGE']?>" alt="Hình thức ăn"
                        class="dropdown-item-image">
                        <div class="dropdown-item-text">
                          <div class="dropdown-item-text-desc"><?php echo $value['THELOAI']?></div>
                          <div class="dropdown-item-text-title"><?php echo $value['TENMONAN']?></div>

                          <div class="dropdown-item-text-price"><span class="price"><?php echo formatMoney($value['GIA'])?></span>đ</div>
                        </div>
                        <div class="dropdown-item-right">
                        <a href="xoa.php?id=<?php echo $value['id_monan']; ?>">
                          <img class="trash" src="../../assets/images/main-images/icon-trash.png" alt="trash"/>
                        </a>
                        <img
                          class="heart"
                          src="../../assets/images/main-images/icon-heart-fill.png"
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
                              <a class="auth-shoppingcart-dropdown-link" href="../../shoppingcart/index.php">
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
                  <img src="../../assets/images/main-images/icon-user.png" alt="user" />
                    <span class="auth-username"><?php echo $account?></span>
                  <img
                    class="arrow-down"
                    src="../../assets/images/main-images/icon-arrow-down.png"
                    alt="arrow-down"
                  />
                </div>
                <ul class="auth-user-dropdown">
                  <li class="auth-user-dropdown-item">
                    <a class="auth-user-dropdown-link" href="../../profile/index.php">Tài khoản</a>
                  </li>
                  <li class="auth-user-dropdown-item">
                    <a class="auth-user-dropdown-link" href="../mon-an/dx.php">Đăng xuất</a>
                  </li>
                </ul>
              </div>
            </li>
            <?php }?>
          </ul>
          <label for="toggle-check" class="toggle"
            ><img src="../../assets/images/main-images/menu.png" alt="Menu"
          /></label>
          <label for="toggle-check" class="overlay"></label>
        </div>
      </header>
      <!-- blog_post -->
      <section class="blog_post">
        <div class="blog_post-container container">
          <div class="blog_post-header">
            <div class="blog_post-link">
              <a href="../../blog/index.php" class="blog_post-link-item menu-link">Blog </a>
              <img src="../../assets/images/main-images/icon-arrow-right.png" alt="" class="" />
              <a href="#!" class="blog_post-link-item">Blog_1 </a>
            </div>
            <div class="">
              <p class="blog_post-time global-text show-on-scroll">22 tháng 12 năm 2021</p>
              <h2 class="blog_post-heading global-heading global-heading--big show-on-scroll">
                Những món ăn nhất định phải thử một lần khi sống trong đời
              </h2>
              <p class="blog_post-desc global-text show-on-scroll"></p>
              <div class="blog_post-category">
                <a href="#" class="post-category">The newest</a>
                <a href="#" class="post-category">Shop</a>
                <a href="#" class="post-category">Tin tức</a>
                <a href="#" class="post-category">Công nghệ</a>
              </div>
            </div>
          </div>
          <div class="blog_post-content">
            <div class="blog_post-image">
              <img
                src="../../assets/images/blog-images/blog1.jpg"
                alt="blog-1"
                class="blog_post-image-img"
              />
            </div>
            <div class="blog_post-text">
              <div class="blog_post-social">
                <a href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Ffatme.tk%2Fblog%2Fblog_1%2F" class="blog_post-social-item" target="_blank">
                  <img srcset="../../assets/images/main-images/facebook.png 2x" alt="" />
                </a>
                <a href="#" class="blog_post-social-item">
                  <img srcset="../../assets/images/main-images/twitter.png 2x" alt="" />
                </a>
                <a href="#" class="blog_post-social-item">
                  <img srcset="../../assets/images/main-images/instagram.png 2x" alt="" />
                </a>

              </div>
              <div class="blog_post-text-content">
                <p class="global-text">
                  Một chiếc bánh crepe mỏng được quấn quanh khoai tây nghiền cay và sau đó được ngâm
                  trong hỗn hợp các nguyên liệu truyền thống của Ấn Độ như tương ớt dừa. khi bạn đến
                  Ấn Độ và thưởng thức món ăn này bạn sẽ thấy vị giác của mình được nâng lên một tầm
                  cao mới.
                </p>
                <p class="global-text">
                  Một trong những cách tốt nhất để trải nghiệm văn hóa của một dân tộc là đến nơi đó
                  và ăn một bữa ăn truyền thống. Hãy đến những quốc gia này và thưởng thức những món
                  ăn truyền thống ngon nhất của họ.
                </p>
                <p class="global-heading global-heading--normal">1. Tôm hùm, Thái Lan</p>
                <img
                  src="../../assets/images/blog-images/tom-hum.jpg"
                  alt=""
                  class="blog_post-text-img"
                />
                <p class="global-text">
                  Hãy thử ngay món tôm hùm này của Thái Lan, các đầu bếp tài năng trên toàn thế giới
                  đã sáng tạo ra vô số món ăn thơm ngon, bổ dưỡng từ những con tôm hùm tươi ngọt
                  này.
                </p>
                <p class="global-heading global-heading--normal">2. MasalaDosa, Ấn Độ</p>
                <img
                  src="../../assets/images/blog-images/masaladosa.jpg"
                  alt=""
                  class="blog_post-text-img"
                />
                <p class="global-text">
                  Một chiếc bánh crepe mỏng được quấn quanh khoai tây nghiền cay và sau đó được ngâm
                  trong hỗn hợp các nguyên liệu truyền thống của Ấn Độ như tương ớt dừa. khi bạn đến
                  Ấn Độ và thưởng thức món ăn này bạn sẽ thấy vị giác của mình được nâng lên một tầm
                  cao mới.
                </p>
                <p class="global-heading global-heading--normal">3. Kem, Mỹ</p>
                <img
                  src="../../assets/images/blog-images/kem-my.jpg"
                  alt=""
                  class="blog_post-text-img"
                />
                <p class="global-text">
                  Đến nước Mỹ mà bỏ qua món kem thì thật đáng tiếc. Mỗi địa phương đều có một loại
                  kem riêng của mình nhưng nhìn chung chúng đều đặc biệt ngon. Kem Mỹ được coi là
                  một trong những món tráng miệng ngon nhất trên toàn thế giới.
                </p>
                <p class="global-heading global-heading--normal">4. Cá chip khoai tây chiên, Anh</p>
                <img
                  src="../../assets/images/blog-images/ca-chip.jpg"
                  alt=""
                  class="blog_post-text-img"
                />
                <p class="global-text">
                  Mặc dù các nhà hàng ở mọi cấp độ đều tự đặt món cá chiên khoai tây trong thực đơn
                  của mình, nhưng nơi tốt nhất để tìm món chiên sâu này là trên đường phố. Món ăn
                  này nó được phổ biến đầu tiên bởi tầng lớp lao động, điều đó có nghĩa là món ăn sẽ
                  trở nên ngon nhất khi không thêm bất cứ thứ gì ngoại trừ một ít giấm và sốt chua
                  ngọt.
                </p>
                <p class="global-heading global-heading--normal">5. Nasi goreng, Indonesia</p>
                <img
                  src="../../assets/images/blog-images/nasi-goreng.jpg"
                  alt=""
                  class="blog_post-text-img"
                />
                <p class="global-text">
                  Không ai có thể phản đối một đia cơm chiên, trứng, gà và tôm chất lượng cao, ngon
                  tuyệt vời như thế này. Nasi goreng được coi là cơm chiên ngon nhất thế giới và du
                  khách đến Indonesia í tai bỏ qua món ăn đơn giản mà hấp dẫn này.
                </p>
                <p class="global-heading global-heading--normal">6. Cheeseburger, Mỹ</p>
                <img
                  src="../../assets/images/blog-images/cheeseburger.jpg"
                  alt=""
                  class="blog_post-text-img"
                />
                <p class="global-text">
                  Một chiếc bánh crepe mỏng được quấn quanh khoai tây nghiền cay và sau đó được ngâm
                  trong hỗn hợp các nguyên liệu truyền thống của Ấn Độ như tương ớt dừa. khi bạn đến
                  Ấn Độ và thưởng thức món ăn này bạn sẽ thấy vị giác của mình được nâng lên một tầm
                  cao mới.
                </p>
                <p class="global-heading global-heading--normal">7. Rendang, Indonesia</p>
                <img
                  src="../../assets/images/blog-images/rendang.jpg"
                  alt=""
                  class="blog_post-text-img"
                />
                <p class="global-text">
                  Thường được phục vụ trong các dịp lễ nghi và với khách quý, Rendang là một món
                  thịt bò mà không chỉ tuyệt vời, nó còn siêu dễ làm. Thịt bò băm nhỏ được ninh nhừ
                  trong nước cốt dừa và rất nhiều gia vị bao gồm tỏi, nghệ, ớt… thực khách đã thưởng
                  thức thì không thể chê được điểm gì.
                </p>
                <p class="global-heading global-heading--normal">8. Ramen, Nhật Bản</p>
                <img
                  src="../../assets/images/blog-images/ramen.jpg"
                  alt=""
                  class="blog_post-text-img"
                />
                <p class="global-text">
                  Ramen là món ăn truyền thống của Nhật Bản, ngoài việc là một món ăn ngon nó còn
                  mang lại niềm vui cho thực khách cũng như đầu bếp. Khi ăn bạn càng húp mì càng to
                  thì càng vui, bởi những tiếng xì xụp đó cũng là một lời khen dành cho đầu bếp.
                </p>
                <p class="global-heading global-heading--normal">9. Pad Thái, Thái Lan</p>
                <img
                  src="../../assets/images/blog-images/pad-thai.jpg"
                  alt=""
                  class="blog_post-text-img"
                />
                <p class="global-text">
                  Món ăn cực kỳ phổ biến ở Thái Lan này là sự pha trộn hấp dẫn của các loại gia vị
                  được cung cấp bởi bột me. Nó cũng bao gồm vô số các loại rau, thịt và rất nhiều
                  loại thực phẩm tuyệt vời khác.
                </p>
                <p class="global-heading global-heading--normal">10. Tacos, Mexico</p>
                <img
                  src="../../assets/images/blog-images/tacos.jpg"
                  alt=""
                  class="blog_post-text-img"
                />
                <p class="global-text">
                  Ở Mexico, họ làm tacos rất chính xác, xếp một ít thịt bò băm nhuyễn vào một cái
                  bánh tortilla thủ công và trộn chúng trong hành, ngò, salsa, cùng nhiều loại gia
                  vị khác. Món ăn sẽ khiến thực khách quên đi sự mệt mỏi sau một buổi tham quan mệt
                  nhoài.
                </p>
                <p class="global-heading global-heading--normal">11. Lasagna, Ý</p>
                <img
                  src="../../assets/images/blog-images/lasagna.jpg"
                  alt=""
                  class="blog_post-text-img"
                />
                <p class="global-text">
                  Bạn có thể nghĩ rằng món ăn phổ biến nhất ở Ý sẽ là pizza, nhưng bạn đã sai. Món
                  mì truyền thống được xếp lớp với thịt và phô mai ricotta để tạo ra một giấc mơ mới
                  nướng trên đĩa này mới là món ăn được ưa thích nhất.
                </p>
                <p class="global-heading global-heading--normal">12. Sushi, Nhật Bản</p>
                <img
                  src="../../assets/images/blog-images/sushi.jpg"
                  alt=""
                  class="blog_post-text-img"
                />
                <p class="global-text">
                  Chắc chắn, bạn có thể đã ăn sushi ở nhiều nơi. Nó cũng ngày càng phổ biến ở Hoa Kỳ
                  vì một lý do đơn giản: nó rất ngon. Tất nhiên, bất kể nó được phục vụ ở đâu, bạn
                  chỉ có sushi thực sự khi bạn đến thăm Nhật Bản và nếm thử món cá cuộn cơm sống
                  này.
                </p>
                <p class="global-text">
                  Tác giả: Blog Ẩm thực <br />
                  Link dẫn đến bài viết gốc:
                  <a target="_blank"
                    href="https://www.blogamthuc.com/nhung-mon-an-nhat-dinh-phai-thu-mot-lan-khi-song-trong-doi.html"
                    >https://www.blogamthuc.com/nhung-mon-an-nhat-dinh-phai-thu-mot-lan-khi-song-trong-doi.html</a
                  >
                </p>
              </div>
            </div>
          </div>
          <p class="post-title-heading">Có thể bạn thích</p>
          <div class="blog-list slider-responsive">
            <div class="post-item show-on-scroll">
              <a href="../blog_2/index.php" class="post-media">
                <img src="../../assets/images/blog-images/blog2.jpg" alt="" class="post-image" />
              </a>
              <div class="post-content">
                <a href="#" class="post-category">Shop</a>
                <h3>
                  <a href="../blog_2/index.php" class="post-title"
                    >Người Nhật Bản ăn gì vào đêm trăng rằm?</a
                  >
                </h3>
                <p class="post-desc">Tác giả: Blog Ẩm Thực</p>
              </div>
            </div>
            <div class="post-item show-on-scroll">
              <a href="../blog_3/index.php" class="post-media">
                <img src="../../assets/images/blog-images/blog3.jpg" alt="" class="post-image" />
              </a>
              <div class="post-content">
                <a href="#" class="post-category">Shop</a>
                <h3>
                  <a href="../blog_3/index.php" class="post-title"
                    >Khám phá khu phố Tàu giữa lòng Sài Gòn</a
                  >
                </h3>
                <p class="post-desc">Tác giả: LyHoangDong Blog</p>
              </div>
            </div>
            <div class="post-item show-on-scroll">
              <a href="../blog_4/index.php" class="post-media">
                <img src="../../assets/images/blog-images/blog4.jpg" alt="" class="post-image" />
              </a>
              <div class="post-content">
                <a href="#" class="post-category">Shop</a>
                <h3>
                  <a href="../blog_4/index.php" class="post-title"
                    >Chỉ Với 30k Thì Ăn Gì Ở Sài Gòn?
                  </a>
                </h3>
                <p class="post-desc">Tác giả: lyhoangdong.weebly.com</p>
              </div>
            </div>
            <div class="post-item show-on-scroll">
              <a href="../blog_5/index.php" class="post-media">
                <img src="../../assets/images/blog-images/blog5.jpg" alt="" class="post-image" />
              </a>
              <div class="post-content">
                <a href="#" class="post-category">Shop</a>
                <h3>
                  <a href="../blog_5/index.php" class="post-title"
                    >[Bạn Có Biết] TOP 8 loại quả đắt đỏ nhất thế giới</a
                  >
                </h3>
                <p class="post-desc">
                  Tác giả: Kiên Nguyễn Blog, Đinh Tùng – Blogchiasekienthuc.com
                </p>
              </div>
            </div>
            <div class="post-item show-on-scroll">
              <a href="../blog_6/index.php" class="post-media">
                <img src="../../assets/images/blog-images/blog6.png" alt="" class="post-image" />
              </a>
              <div class="post-content">
                <a href="#" class="post-category">Shop</a>
                <h3>
                  <a href="../blog_6/index.php" class="post-title"
                    >Food stylist – Những người nghệ sĩ biến hóa trên bàn ăn</a
                  >
                </h3>
                <p class="post-desc">Tác giả: Liam Production</p>
              </div>
            </div>
            <div class="post-item show-on-scroll">
              <a href="../blog_7/index.php" class="post-media">
                <img src="../../assets/images/blog-images/blog7.jpeg" alt="" class="post-image" />
              </a>
              <div class="post-content">
                <a href="#" class="post-category">Shop</a>
                <h3>
                  <a href="../blog_7/index.php" class="post-title"
                    >Cách làm “ROSÉ ROLL CAKE” – Bánh cuộn kem phômai bằng chảo
                  </a>
                </h3>
                <p class="post-desc">Tác giả: Esheep Kitchen</p>
              </div>
            </div>
            <div class="post-item show-on-scroll">
              <a href="../blog_8/index.php" class="post-media">
                <img src="../../assets/images/blog-images/blog8.jpg" alt="" class="post-image" />
              </a>
              <div class="post-content">
                <a href="#" class="post-category">Shop</a>
                <h3>
                  <a href="../blog_8/index.php" class="post-title"
                    >6 lợi ích của việc nấu ăn tại nhà
                  </a>
                </h3>
                <p class="post-desc">Tác giả: bepxua</p>
              </div>
            </div>
            <div class="post-item show-on-scroll">
              <a href="../blog_9/index.php" class="post-media">
                <img src="../../assets/images/blog-images/blog9.jpg" alt="" class="post-image" />
              </a>
              <div class="post-content">
                <a href="#" class="post-category">Shop</a>
                <h3>
                  <a href="../blog_9/index.php" class="post-title"
                    >Chế Độ Ăn Keto Là Gì? Cơ Bản Dành Cho Người Mới Bắt Đầu
                  </a>
                </h3>
                <p class="post-desc">Tác giả: benben123</p>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- subcribe -->
      <section class="subscribe">
        <div class="container subscribe-container">
          <div class="subscribe-main">
            <div class="subscribe-content">
              <h2 class="global-haeding subscribe-heading show-on-scroll">
                Nhận thông báo mới nhất
              </h2>
              <p class="global-text subscribe-desc show-on-scroll">
                Nhập gmail để không bỏ lỡ những thông báo mới nhất và các ưu đãi hấp dẫn đến từ Fatme nhé !!!
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
    </div>
    <!-- footer -->
    <footer class="footer">
      <div class="container">
        <div class="footer-container">
          <div class="footer-column">
            <a href="#" class="footer-logo">
              <img srcset="../../assets/images/main-images/logo.png 2x" alt="" />
            </a>
            <p class="footer-desc text">Yêu là phải nói, đói là phải ăn, gọi FatMe thật nhanh, giao tận tay khách</p>
            <div class="social">
              <a href="https://www.facebook.com/FootAtTheMoment/" target="_blank" class="social-item">
                <img srcset="../../assets/images/main-images/facebook.png 2x" alt="" />
              </a>
              <a href="#" class="social-item">
                <img srcset="../../assets/images/main-images/twitter.png 2x" alt="" />
              </a>
              <a href="#" class="social-item">
                <img srcset="../../assets/images/main-images/instagram.png 2x" alt="" />
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
                <a href="../index.php" class="footer-link">Tin hot</a>
              </li>
              <li class="footer-item">
                <a href="../index.php#blog" class="footer-link">Blog mới gần đây</a>
              </li>
              <li class="footer-item">
                <a href="../index.php#blog" class="footer-link">Blog có thể bạn thích</a>
              </li>
              <li class="footer-item">
                <a href="../blog_1/index.php#" class="footer-link">Blog 1</a>
              </li>
              <li class="footer-item">
                <a href="../blog_2/index.php#" class="footer-link">Blog 2</a>
              </li>
            </ul>
          </div>
          <div class="footer-column">
            <h3 class="footer-heading heading-small">Liên hệ</h3>
            <ul class="footer-links">
              <li class="footer-item">
                <a href="mailto:TongCongTyFATMe@gmail.com" class="footer-link-none"
                  >TongCongTyFATMe@gmail.com</a
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
    <!-- script -->
    <script src="../../assets/js/main.js"></script>
    <script src="../../assets/js/blog.js"></script>
  </body>
</html>
