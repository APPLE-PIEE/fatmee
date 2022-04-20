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
} ?>
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
            <li class="menu-item">
              <a class="menu-link" href="../../main-page/index.php">Trang chủ</a>
            </li>
            <li class="menu-item">
              <a class="menu-link" href="../../mon-an/index.php">Món ăn</a>
            </li>
            <li class="menu-item">
              <a class="menu-link link-active" href="../../blog/index.php">Blog</a>
            </li>
            <li class="menu-item">
              <a class="menu-link" href="../../service/index.php">Dịch vụ</a>
            </li>
            <li class="menu-item">
              <a class="menu-link" href="../../contact/index.php">Liên hệ</a>
            </li>
            <?php if (empty($_SESSION['email'])){ ?>
            <li class="auth">
              <a class="button button--secondary auth-login" href="../../login/index.php"
                >Đăng nhập</a
              >
              <a class="button button--primary auth-signup" href="../../register/index.php"
                >Đăng ký</a
              >
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
              <a href="#!" class="blog_post-link-item">Blog_4 </a>
            </div>
            <div class="">
              <p class="blog_post-time global-text show-on-scroll">24 tháng 12 năm 2021</p>
              <h2 class="blog_post-heading global-heading global-heading--big show-on-scroll">
                Khám phá khu phố Tàu giữa lòng Sài Gòn
              </h2>
              <p class="blog_post-desc global-text show-on-scroll"></p>
              <div class="blog_post-category">
                <a href="#" class="post-category">The newest</a>
                <a href="#" class="post-category">Tin tức</a>
              </div>
            </div>
          </div>
          <div class="blog_post-content">
            <div class="blog_post-image">
              <img
                src="../../assets/images/blog-images/blog4.jpg"
                alt="blog-4"
                class="blog_post-image-img"
              />
            </div>
            <div class="blog_post-text">
              <div class="blog_post-social">
                <a href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Ffatme.tk%2Fblog%2Fblog_4%2F" class="blog_post-social-item" target="_blank">
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
                  Với 30k, bạn có thể ăn món gì ở Sài Gòn? Một câu hỏi tưởng chừng rất dễ trả lời
                  nhưng lại khiến nhiều bạn lúng túng. Cùng lyhoangdong.weebly.com khám phá ngay và
                  luôn những món ngon nức tiếng nhưng giá cực hạt dẻ để “phải đi và nếm thử” cho
                  bằng hết nhé!
                </p>
                <p class="global-heading global-heading--normal">1. Vương quốc bánh mì</p>
                <p class="global-text">
                  Đầu tiên và nhất định nên thử, đó chính là bánh mì. Dù đây là một món ăn quá quen thuộc và phổ biến ở nhiều vùng nhưng chỉ với 30k thì nó là lựa chọn đầu tiên. Nếu bạn đã quen thuộc với những nẻo đường nhộn nhịp thì bạn cũng sẽ dễ dàng nhận thấy nhiều lò bánh mì luôn tỏa ra hương thơm ngát, cái mùi của bột mì được nướng vừa tới, quyện đều trong không khí, làm cho ai đi qua cũng ngơ ngẩn, đặc biệt là “những chiếc bụng đói”.
                </p>
                <img
                  src="../../assets/images/blog-images/banh-mi.jpg"
                  alt=""
                  class="blog_post-text-img"
                />
                <p class="global-text">
                  Tại mỗi lò bánh mì, người ta thường có thêm quầy bán tại chỗ với nhiều loại nhân khác nhau như thịt xông khói, trứng ốp la, chả lụa, chà bông, cá hộp,… đủ mọi hương vị để lựa chọn. Giá dao động từ 10 – 20k là bạn đã có một ổ bánh mì giòn tan, đầy ắp nhân để thưởng thức.
                </p>

                <p class="global-heading global-heading--normal">2. Bánh tráng trộn</p>
                <p class="global-text">
                  Nếu đã lỡ mê ẩm thực bình dân Sài Gòn thì chắc rằng không thể bỏ qua bánh tráng trộn, món ăn vặt dễ tìm và giá cả vô cùng ổn.
                </p>
                <p class="global-text">
                  Bánh tráng trộn có rất nhiều hương vị khác nhau, có thập cẩm (xoài, khô bò, đậu phộng, rau răm, ...), bánh trạng mỡ hành (Chỉ có hành lá phí thơm với bơ), bánh tráng hành phi (Hành phi thơm lừng với muối, dầu điều), bánh tráng cuộn (trứng cút, xoài, tép, …), …
                </p>
                <img
                  src="../../assets/images/blog-images/banh-trang-tron.jpg"
                  alt=""
                  class="blog_post-text-img"
                />
                <p class="global-text">
                  Chi phí mà bạn bỏ ra không quá cao, chỉ từ 10k – 20k là có một bịch bánh tráng đầy ú nụ để nhâm nhi, tám chuyện cùng bạn bè và cũng no cái bụng.
                </p>
                <p class="global-heading global-heading--normal">3. Trà sữa béo thơm</p><p class="global-text">
                  Đã liệt kê bánh tráng trộn thì không thể bỏ qua trà sữa – thức uống làm mưa làm gió trong giới ẩm thực lâu nay. Sài Gòn là nơi hội tụ hàng trăm các tiệm trà sữa lớn nhỏ, từ các thương hiệu bình dân đến các thương hiệu cao cấp từ nhiều nước trên thế giới.
                </p>
                <img
                  src="../../assets/images/blog-images/tra-sua-beo.jpg"
                  alt=""
                  class="blog_post-text-img"
                />
                <p class="global-text">
                  Nếu với 30k, có thể bạn sẽ không thưởng thức được một ly trà sữa của các thương hiệu danh giá nhưng để có ngay một ly trà sữa bự cùng lớp topping ú nụ thì trà sữa nhà làm là một gợi ý. Do không bị đánh nặng về thương hiệu và mặt bằng nên trà sữa nhà làm có giá rẻ hơn mà vẫn đảm bảo đủ hương vị để bạn chọn lựa.
                </p>
                <p class="global-text">
                  Giá cả cho một ly trà sữa nhà làm có thể dao động từ 15 – 25k đã bao gồm các loại topping như thạch củ năng, bánh flan, trân châu, thạch dừa, …
                </p>
                <p class="global-heading global-heading--normal">4. Các loại đồ chiên đa dạng</p><p class="global-text"></p>
                <p class="global-text">
                  Cá viên chiên, bò viên chiên, hoành thánh chiên có phải rất quen thuộc? Đây là một trong những gợi ý gửi đến bạn. Với 30k bạn có thể gọi cho mình một phần chiên thập cẩm đủ cho một người ăn.
                </p>
                <img
                  src="../../assets/images/blog-images/do-chien.jpg"
                  alt=""
                  class="blog_post-text-img"
                />
                <p class="global-text">
                  Các món chiên ở trên rất phù hợp để cả nhóm bạn cùng nhau ăn và tám chuyện. Thêm vào đó, nó còn thường được ăn kèm với rau củ như dưa leo, đồ chua, … nên bạn không hề lo bị nóng trong người.
                </p>
                <p class="global-heading global-heading--normal">5. Phá lấu bò
                </p>
                <p class="global-text">
                  Một món ăn bình dân nhưng không hề thiếu sức hút với thực khách tại Sài Gòn, đó chính là phá lấu bò.
                </p>
                <img
                  src="../../assets/images/blog-images/pha-lau.jpg"
                  alt=""
                  class="blog_post-text-img"
                />
                <p class="global-text">
                  Phá lấu bò được chế biến khá công phu, khi ăn có vị béo và thơm của nước cốt dừa, quyện với các gia vị nêm nếm độc đáo, thường được ăn kèm với bánh mì hoặc mì tôm. Giá một chén phá lấu cộng thêm một ổ bánh mì giòn rụm ăn kèm thường từ 20 – 25k, tuy nhiên, cũng có một vài chỗ mức giá cao hơn, thường là khi bạn ăn ở những quận trung tâm hoặc quán nổi tiếng. Bạn nên cân nhắc hoặc hỏi giá trước khi quyết định ghé ăn nhé!
                </p>
                <p class="global-text">
                  Với 5 món ăn, thức uống độc đáo trên, bạn có thể no bụng chỉ với 30k đấy! Hy vọng những gợi ý trên đã giúp bạn có thêm lựa chọn ẩm thực ngon miệng dù có ít chi phí.
                </p>
                <p class="global-text">
                  Tác giả: lyhoangdong.weebly.com <br />
                  Link dẫn đến bài viết gốc:
                  <a target="_blank" href="https://lyhoangdong.weebly.com/am-thuc-duong-pho/an-gi-o-sai-gon-voi-30k"
                    >https://lyhoangdong.weebly.com/am-thuc-duong-pho/an-gi-o-sai-gon-voi-30k
                  </a>
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
              <a href="../blog_1/index.php" class="post-media">
                <img src="../../assets/images/blog-images/blog1.jpg" alt="" class="post-image" />
              </a>
              <div class="post-content">
                <a href="#" class="post-category">Shop</a>
                <h3>
                  <a href="../blog_1/index.php" class="post-title"
                    >Những món ăn nhất định phải thử một lần khi sống trong đời</a
                  >
                </h3>
                <p class="post-desc">Tác giả: Blog Ẩm thực</p>
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
                    >Khám phá khu phố Tàu giữa lòng Sài Gòn
                  </a>
                </h3>
                <p class="post-desc">Tác giả: LyHoangDong Blog</p>
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
                Nhập gmail để không bỏ lỡ những thông báo mới nhất và các ưu đãi hấp dẫn đến từ
                Fatme nhé !!!
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
