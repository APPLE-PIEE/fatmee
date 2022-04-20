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
              <a href="#!" class="blog_post-link-item">Blog_5 </a>
            </div>
            <div class="">
              <p class="blog_post-time global-text show-on-scroll">24 tháng 12 năm 2021</p>
              <h2 class="blog_post-heading global-heading global-heading--big show-on-scroll">
                [Bạn Có Biết] Top 8 loại quả đắt đỏ nhất thế giới
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
                src="../../assets/images/blog-images/blog5.jpg"
                alt="blog-5"
                class="blog_post-image-img"
              />
            </div>
            <div class="blog_post-text">
              <div class="blog_post-social">
                <a href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Ffatme.tk%2Fblog%2Fblog_5%2F" class="blog_post-social-item" target="_blank">
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
                  Người đời có câu “đừng bao giờ dạy người giàu cách tiêu tiền”, câu nói này dường
                  như là luôn đúng trong hầu hết các trường hợp.
                </p>
                <p class="global-text">
                  Nhiều lúc bạn sẽ chẳng thể hiểu nổi cách sống và cách tiêu tiền của họ, bởi vì có
                  nhiều thứ được bán với mức giá mà đến cả những người có sức tưởng tượng phong phú
                  nhất cũng khó mà tưởng tượng nổi.
                </p>
                <p class="global-text">
                  Ví dụ như trong bài viết ngày hôm nay, blogchiasekienthuc.com sẽ giới thiệu cho
                  các bạn top 8 loại quả đắt đỏ nhất thế giới. Nào, chúng ta cùng bắt đầu ngay nhé.
                </p>
                <p class="global-heading global-heading--normal">1. Xoài Taiyo No Tamago</p>
                <p class="global-text">
                  Đầu tiên trong danh sách, chúng ta sẽ đến với Đất nước mặt trời mọc, nơi đây không
                  được thiên nhiên ưu ái nhưng bằng một cách thần kỳ nào đó, người dân Nhật Bản lại
                  tạo ra được những loại trái cây rất ngon và nổi tiếng thế giới.
                </p>
                <p class="global-text">
                  Và để minh chứng cho điều đó thì loại quả đầu tiên đó chính là
                  <b>Xoài Taiyo No Tamago.</b> Tên của loại quả này có nghĩa là “Những quả trứng bên
                  trong mặt trời”, và đúng như tên gọi của nó thì loại xoài này có hình thù của quả
                  trứng.
                </p>
                <p class="global-text">
                  Nó có màu đỏ khác hoàn toàn so với các loại xoài khác mà chúng ta vẫn thường hay
                  nhìn thấy.
                </p>
                <img
                  src="../../assets/images/blog-images/trai-cay.jpg"
                  alt=""
                  class="blog_post-text-img"
                />
                <img
                  src="../../assets/images/blog-images/xoai1.jpg"
                  alt=""
                  class="blog_post-text-img"
                />
                <p class="global-text">
                  Và điều mà chúng ta quan tâm nhất đó chính là số tiền cần bỏ ra để mua được loại
                  xoài bắt mắt đến từ “xứ sở hoa Anh Đào” này. Vâng! Trung bình nó có giá lên tới
                  3.000$/1 quả, tức là hơn 69 triệu đồng Việt Nam ◔◡◔
                </p>
                <p class="global-text">
                  Đặc biệt, trong một phiên đấu giá, một cặp “Trứng mặt trời” đã chạm mức giá
                  500.000 Yên – tương đương với 104 triệu VNĐ ⊙﹏⊙
                </p>
                <img
                  src="../../assets/images/blog-images/xoai2.jpg"
                  alt=""
                  class="blog_post-text-img"
                />
                <p class="global-text">
                  Lý do mà nó có giá đắt tới như vậy là vì quá trình trồng trọt hết sức tỉ mỉ, những
                  quả quả xoài này được bao bọc bởi một lớp lưới nhỏ để cho ánh sáng mặt trời có thể
                  len lỏi đến mọi ngóc ngách, để cho khi chín thì quả xoài có màu sắc đều nhau.
                </p>
                <p class="global-text">
                  Đặc biệt khi thu hoạch người ta sẽ không hái xoài bằng tay mà để tự rụng, tiêu
                  chuẩn mỗi quả nặng ít nhất 500g.
                </p>
                <p class="global-heading global-heading--normal">2. Dưa hấu đen Densuke</p>
                <p class="global-text">
                  Tiếp theo lại là một loại quả nữa đến từ đất nước <b>Nhật Bản</b>, đó chính là dưa
                  hấu đen – loại quả chỉ có duy nhất ở vùng Hokkaido.
                </p>
                <img
                  src="../../assets/images/blog-images/dua-hau-den1.jpg"
                  alt=""
                  class="blog_post-text-img"
                />
                <p class="global-text">
                  Nó được gọi là dưa hấu đen bởi vì loại dưa này có vỏ màu tối sẫm, gần như là màu
                  đen và hầu như là không có một vết xước nào trên vỏ.
                </p>
                <p class="global-text">
                  Người nhật xem loại quả này như là một món quà quý giá, bởi vì nó không những đặc
                  biệt về mặt hình thức bên ngoài mà khi thưởng thức, loại dưa này còn rất ngọt, ăn
                  rất ngon và rất mát.
                </p>
                <p class="global-text">
                  Vì thế nó được bán trong những chiếc hộp sang trọng nhằm tô lên sự đắt đỏ của loại
                  quả này.
                </p>
                <p class="global-text">
                  Vì thế nó được bán trong những chiếc hộp sang trọng nhằm tô lên sự đắt đỏ của loại
                  quả này.
                </p>
                <img
                  src="../../assets/images/blog-images/dua-hau-den2.jpg"
                  alt=""
                  class="blog_post-text-img"
                />
                <p class="global-text">
                  Loại dưa này có giá vào khoảng 140.000.000 VNĐ/1 quả, sở dĩ nó có giá thành đắt
                  như vậy một phần là do sự độc lạ về hình thức bề ngoài, chất lượng quả ăn ngon.
                </p>
                <p class="global-text">
                  Và một phần nữa cũng là do sự quý hiếm của loại quả này, trung bình một năm cả
                  vùng chỉ thu hoạch được khoảng 10.000 quả. Đặc biệt đã từng có một quả
                  <b>Dưa hấu đen Densuke</b> được bán với giá 6.100 USD ᵔᴥᵔ
                </p>
                <p class="global-heading global-heading--normal">3. Dưa vàng Yubari</p>
                <p class="global-text">
                  Như mình đã nói ở trên, <b>Nhật bản</b> là quốc gia mà mẹ thiên nhiên không dành
                  nhiều ưu đãi về đất đai cũng như địa hình, nhưng ngược lại nơi đây lại có nhiều
                  loại trái cây ngon và nổi tiếng nhất thế giới. Và <b>Dưa vàng Yubari</b> là một
                  minh chứng thêm cho điều đó.
                </p>
                <img
                  src="../../assets/images/blog-images/dua-hau-vang1.jpg"
                  alt=""
                  class="blog_post-text-img"
                />
                <p class="global-text">
                  Dưa vàng Yubari hay còn có cái tên gọi khác là Yubari King, là giống dưa quý hiếm
                  được trồng tại vùng Yubari – Hokkaido của Nhật bản. Quay ngược lại thời gian một
                  chút nhé, trước đây chỉ những vị vua chúa mới được thưởng thức loại dưa đặc biệt
                  này.
                </p>
                <p class="global-text">
                  Còn ngày nay, với công nghệ tiên tiến hơn, giống dưa này được phổ biến hơn và được
                  dành cho giới nhà giàu, mình xin nhắc lại là chỉ cho giới nhà giàu thôi nhé! (>‿♥)
                </p>
                <p class="global-text">
                  Trước khi giới thiệu về giá cả thì mình sẽ review qua về loại dưa này ha.
                </p>
                <p class="global-text">
                  Trước hết về mặt hình thức, nó có một đặc điểm rất đặc trưng đó là, ruột màu vàng
                  cam rất hấp dẫn, thân tròn, lưới xếp đều khít nhìn rất bắt mắt. Không những thế,
                  vị của loại dưa này cũng rất ngon, khi ăn vị ngọt và thơm như tan hoàn toàn trong
                  miệng khiến cho nhiều chuyên gia ẩm thực cũng phải công nhận rằng vị của loại dưa
                  này là trên cả tuyệt vời.
                </p>
                <img
                  src="../../assets/images/blog-images/dua-hau-vang2.jpg"
                  alt=""
                  class="blog_post-text-img"
                />
                <p class="global-text">
                  Bởi vì hình thức bề ngoài bắt mắt, chất lượng tuyệt vời kết hợp với sự quý hiếm đã
                  làm cho dưa Yubari trở thành loại dưa đắt nhất thế giới, khi từng được bán đấu giá
                  với mức 550 triệu đồng/1kg.
                </p>
                <p class="global-heading global-heading--normal">4. Nho Ruby Roman</p>
                <p class="global-text">
                  Thị trường <b>Nhật Bản</b> có hàng trăm giống nho cao cấp, nhưng duy nhất chỉ có
                  một loại mà khiến người ta bỏ ra hàng trăm USD chỉ để mua một quả nho ●﹏●
                </p>
                <img
                  src="../../assets/images/blog-images/nho1.jpg"
                  alt=""
                  class="blog_post-text-img"
                />
                <p class="global-text">
                  Loại nho này được trồng tại tỉnh Ishikawa – Nhật Bản, hiện được xem là một trong
                  những loại trái cây đắt nhất thế giới. Năm 2016 chủ siêu thị ở miền Tây Nhật Bản
                  đã trả 11.000 USD tức là hơn 253 triệu đồng cho một chùm nho 30 quả.
                </p>
                <p class="global-text">
                  Thực tế, loại nho này đã được trồng 10 năm tại tỉnh Ishikawa và có độ ngọt lên đến
                  18 độ. Và ở thị trường Miền Nam loại nho này được bán với giá 11 triệu/1 chùm nho
                  có khoảng mười mấy trái, tức là hơn 700.000 VNĐ cho một trái nho.
                </p>
                <p class="global-text">
                  Ở Việt Nam thì loại nho này cũng được <b>“Bố già Trấn Thành”</b> quay video thưởng
                  thức.
                </p>
                <img
                  src="../../assets/images/blog-images/nho2.jpg"
                  alt=""
                  class="blog_post-text-img"
                />
                <p class="global-heading global-heading--normal">5. Dứa Heligan</p>
                <p class="global-text">
                  Rời xa đất nước Nhật Bản, chúng ta cùng đến với đất nước được mệnh danh là
                  <b>Xứ sở sương mù</b> ha. Bạn có tin nổi không khi mình nói tại Anh cũng có thể
                  trồng được dứa. Chắc chắn là không rồi, bởi vì dứa là loại cây nhiệt đới thì làm
                  sao có thể trồng tại nước Anh lạnh lẽo như vậy được.
                </p>
                <p class="global-text">
                  Nhưng không, tại nhà vườn Lost Garden Of Heligan ở nước Anh đã trồng và bán ra một
                  quả dứa với mức giá 10.000 bảng Anh tương đương với 300 triệu đồng.
                </p>
                <img
                  src="../../assets/images/blog-images/dua-heligan.jpg"
                  alt=""
                  class="blog_post-text-img"
                />
                <p class="global-text">
                  Loại dứa này có vị cực thơm ngon và không hề bị xơ. Sở dĩ nó có giá đắt như vậy là
                  bởi vì chi phí chăm sóc rất đắt đỏ. Do điều kiện thời tiết ở đây lạnh nên nhà vườn
                  này đã phải mất đến 2 năm trồng và chăm sóc cẩn thận.
                </p>
                <p class="global-text">
                  Đặc biệt, trong thời gian chăm sóc, nhà vườn đã không dùng đến phân hóa học hay
                  thuốc trừ sâu mà chỉ dùng phân ngựa với phương pháp ủ bằng nhiệt mới có thể thu
                  hoạch được loại dứa này.
                </p>
                <p class="global-text">
                  Chi phí mà nhà vườn đã bỏ ra để chăm sóc cho 8 cây dứa tại vườn lên đến 1600 USD,
                  tức là gần 37 triệu đồng một cây.
                </p>
                <p class="global-text">
                  Mình cũng không biết nó ăn có khác gì quả dứa 10k tại Việt Nam hay không mà nó đắt
                  dữ vậy trời 🙂
                </p>
                <p class="global-heading global-heading--normal">6. Ớt Charapita</p>
                <p class="global-text">
                  Tiếp theo trong danh sách này là một loại quả nhưng nó không phải dùng để ăn, mà
                  là dùng nhiều trong các món ăn, và được xem như là một trong những loại gia vị đắt
                  đỏ nhất hành tinh.
                </p>
                <p class="global-text">
                  Vâng, đó chính là Ớt Charapita, loại ớt này có tổ tiên ở Peru – Châu Mỹ nhưng lại
                  được trồng phổ biến ở nước Áo. Loại ớt này khi bày bán sẽ có giá thấp nhất là
                  25.800 USD/1kg, tương đương với 570 triệu đồng. Tuy có mức giá trên trời là vậy
                  nhưng loại ớt này có hình dạng nhỏ bé như hạt ngô, khi chín có màu vàng và cuống
                  dài.
                </p>
                <img
                  src="../../assets/images/blog-images/ot-charapita.png"
                  alt=""
                  class="blog_post-text-img"
                />
                <p class="global-text">
                  Nhắc đến ớt là chúng ta sẽ nhăn mặt vì nghĩ đến độ cay của nó, và ớt Charapita
                  cũng không ngoại lệ. Thậm chí nó còn cay đến mức, người ta khuyến cáo không nên ăn
                  tươi.
                </p>
                <p class="global-text">
                  Tuy nhiên, khi đã sấy khô và trải qua các quá trình để chế biến thành gia vị, loại
                  ớt này lại mang hương vị nhẹ nhàng và độc đáo. Mặc dù có giá cắt cổ nhưng loại ớt
                  này lại được nhiều nhà hàng nổi tiếng thế giới săn đón.
                </p>
                <p class="global-heading global-heading--normal">7. Sầu riêng Kanyao</p>
                <p class="global-text">
                  Sầu riêng được xem như là loại quả gây tranh cãi nhất trên thế giới bởi vì nó đã
                  chia thế giới thành 2 nửa, một phần ăn được và cảm thấy loại quả này rất ngon,
                  phần còn lại không thể chịu nổi cái mùi của loại quả này.
                </p>
                <p class="global-text">
                  Chắc hẳn các bạn ai cũng đã từng xem qua các video mà người nước ngoài thử thách
                  ăn trái sầu riêng và kết quả là nôn lên nôn xuống khiến chúng ta không nhịn nổi
                  cười.
                </p>
                <p class="global-text">
                  Loại quả này ở Việt Nam có giá rơi vào khoảng 200.000-250.000/1kg, khá là đắt
                  nhưng cũng chẳng là gì so với loại sầu riêng có tên là Kanyao.
                </p>
                <img
                  src="../../assets/images/blog-images/sau-rieng.jpg"
                  alt=""
                  class="blog_post-text-img"
                />
                <p class="global-text">
                  Loại sầu riêng này được đánh giá là ngon và đắt nhất thế giới. Nó chỉ được trồng tại trang trại Pa Toi Lung Mu ở Thái Lan, trung bình nó có giá vào khoảng 15 triệu/1 quả.
                </p>
                <p class="global-text">
                  Nhưng vào năm 2019, 1 quả sầu riêng Kanyao được định mức giá lên tới 48.000$ tương đương với 1.1 tỷ đồng ಠ_ಠ
                </p>
                <p class="global-heading global-heading--normal">8. Vải thiều “gia lục”</p>
                <p class="global-text">
                  Cuối cùng, chúng ta cùng ghé thăm anh bạn hàng xóm Trung Quốc, tại Miền Nam của anh bạn “Tàu Khựa” có một loại quả được mệnh danh là đắt nhất thế giới tính tới thời điểm hiện tại.

                </p>
                <p class="global-text">
                  Chắc hẳn các bạn ai cũng đã từng xem qua các video mà người nước ngoài thử thách
                  ăn trái sầu riêng và kết quả là nôn lên nôn xuống khiến chúng ta không nhịn nổi
                  cười.
                </p>
                <p class="global-text">
                  Nó có tên là Vải thiều “gia lục”, vỏ của quả này có 2 màu đặc trưng là đỏ và xanh lá cây, được chia theo tỷ lệ 6:4 khá bắt mắt.
                </p>
                <img
                  src="../../assets/images/blog-images/vai-thieu.jpg"
                  alt=""
                  class="blog_post-text-img"
                />
                <p class="global-text">
                  Đặc biệt, đặc sản đến từ miền Nam Trung Quốc này không được bán theo cân mà bán theo quả các bạn ạ. Thật dị và độc đáo phải không, và thật sốc hơn nữa khi biết rằng một quả vải “gia lục” đã từng được bán đấu giá lên tới 1,8 tỷ đồng.
                </p>
                <p class="global-heading global-heading--normal">9. Lời kết</p>
                <p class="global-text">
                  Như vậy là mình đã giới thiệu đến các bạn TOP 8 loại quả đắt đỏ nhất thế giới rồi nhé. Nếu là bạn, bạn có bỏ ngần ấy tiền ra chỉ để thưởng thức một trong các loại quả này không hay là sử dụng vào mục đích khác.
                </p>
                <p class="global-text">
                  Mình nói là NẾU thôi, chứ thực ra là câu hỏi này hơi khó. Và mình đoán là có đến 99,99% người sẽ bảo điên mới mua như vậy 🙂 Vì chúng ta chưa giàu đến mức độ đó nên cũng rất khó để đưa ra được nhận định công bằng 😀
                </p>
                <p class="global-text">
                  Ngoài những loại quả mình nêu bên trên ra, nếu bạn biết loại quả nào đắt giá hơn từng được bán ra thì đừng ngần ngại comment để mọi người cùng thảo luận nhé. Chúc các bạn thành công!
                </p>
                <p class="global-text">
                  Tác giả: Kiên Nguyễn Blog, Đinh Tùng – Blogchiasekienthuc.com <br />
                  Link dẫn đến bài viết gốc:
                  <a target="_blank"
                    href="https://blogchiasekienthuc.com/kien-thuc/8-loai-qua-dat-do-nhat-the-gioi.html"
                    >https://blogchiasekienthuc.com/kien-thuc/8-loai-qua-dat-do-nhat-the-gioi.html
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
              <a href="../blog_4/index.php" class="post-media">
                <img src="../../assets/images/blog-images/blog4.jpg" alt="" class="post-image" />
              </a>
              <div class="post-content">
                <a href="#" class="post-category">Shop</a>
                <h3>
                  <a href="../blog_4/index.php" class="post-title"
                    >Chỉ Với 30k Thì Ăn Gì Ở Sài Gòn?</a
                  >
                </h3>
                <p class="post-desc">
                  Tác giả: lyhoangdong.weebly.com
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
