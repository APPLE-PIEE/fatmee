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
              <a href="#!" class="blog_post-link-item">Blog_2 </a>
            </div>
            <div class="">
              <p class="blog_post-time global-text show-on-scroll">22 tháng 12 năm 2021</p>
              <h2 class="blog_post-heading global-heading global-heading--big show-on-scroll">
                Người Nhật Bản ăn gì vào đêm trăng rằm?
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
                src="../../assets/images/blog-images/blog2.jpg"
                alt="blog-2"
                class="blog_post-image-img"
              />
            </div>
            <div class="blog_post-text">
              <div class="blog_post-social">
                <a href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Ffatme.tk%2Fblog%2Fblog_2%2F" class="blog_post-social-item" target="_blank">
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
                  Món bánh dango được người Nhật ăn quanh năm, thường dùng cùng nước trà. Nhưng
                  riêng vào ngày Trung thu, Tsukimi-dango được người Nhật lựa chọn để cúng trăng và
                  thể hiện sự biết ơn với tổ tiên.
                </p>
                <p class="global-text">
                  Trung thu Nhật Bản – hay còn được gọi là ngày lễ cúng trăng Ostukimi (月見) – là
                  dịp lễ vào rằm Tháng Tám hàng năm của xứ sở hoa anh đào. Mỗi mùa trăng về, người
                  Nhật lại ăn một món bánh truyền thống rất hấp dẫn, đó là món bánh Tsukimi-dango –
                  một loại bánh gạo dẻo thơm ngọt, dễ thương rất đậm chất Nhật Bản.
                </p>
                <p class="global-heading global-heading--normal">Bánh Tsukimi-dango</p>

                <p class="global-text">
                  Dango là tên gọi chung của các loại bánh được làm từ bột gạo (mochiko), có khá
                  nhiều đặc điểm chung với món bánh mochi Nhật Bản khá phổ biến ở Việt Nam.
                </p>
                <img
                  src="../../assets/images/blog-images/dango-trang.jpg"
                  alt=""
                  class="blog_post-text-img"
                />
                <p class="global-text">
                  Món bánh dango được người Nhật ăn quanh năm, thường dùng cùng nước trà. Nhưng
                  riêng vào ngày Trung thu, Tsukimi-dango được người Nhật lựa chọn để cúng trăng và
                  thể hiện sự biết ơn với tổ tiên.
                </p>
                <p class="global-text">
                  Bánh Tsukimi-dango rất dễ làm, gần giống như món bánh trôi nước của Việt Nam vậy.
                  Với hình dáng nhỏ, vừa miệng ăn, vị ngọt lịm, dẻo và dai, Tsukimi-dango là món ăn
                  vặt yêu thích của đông đảo trẻ em lẫn người lớn Nhật Bản.
                </p>
                <img
                  src="../../assets/images/blog-images/dango-vang.jpg"
                  alt=""
                  class="blog_post-text-img"
                />
                <p class="global-text">
                  Một cách ăn Tsukimi-dango phổ biến là nướng sơ rồi phết nước đường và bột đậu nành
                  kinako
                </p>
                <p class="global-text">
                  Không chỉ có vị bột ngọt ngậy hấp dẫn, ngày nay, người Nhật còn chế biến món bánh
                  này với rất nhiều hương vị hấp dẫn như trà xanh, đậu đỏ, dừa, socola, …
                </p>
                <img
                  src="../../assets/images/blog-images/dango-mau.jpg"
                  alt=""
                  class="blog_post-text-img"
                />
                <p class="global-text">
                  Bánh Tsukimi-dango được tạo màu từ các nguyên liệu tự nhiên như đậu đỏ, trà xanh,
                  xoài, trứng, …
                </p>
                <p class="global-text">
                  Tsukimi-dango còn được kết hợp với nhiều món ăn khác như kem, hoa quả, … tạo thành
                  các món ăn vặt đặc sắc, góp phần làm phong phú nền ẩm thực Nhật Bản. Đến với nước
                  Nhật, bạn có thể dễ dàng bắt gặp các quán ăn vặt với vô vàn những món
                  Tsukimi-dango sáng tạo, hấp dẫn.
                </p>
                <img
                  src="../../assets/images/blog-images/dango-ly.jpg"
                  alt=""
                  class="blog_post-text-img"
                />
                <p class="global-heading global-heading--normal">
                  Truyền thuyết về bánh Tsukimi-dango
                </p>
                <p class="global-text">
                  Nếu như Trung thu Việt Nam có câu chuyện chị Hằng, câu chuyện chú Cuội phổ biến
                  trong dân gian thì cung trăng Nhật Bản cũng có một nhân vật đại diện thú vị không
                  kém. Đó chính là loài thỏ ngọc – những chú thỏ màu trắng, dễ thương rất được trẻ
                  em xứ sở hoa anh đào yêu thích.
                </p>
                <img
                  src="../../assets/images/blog-images/dango-tho.png"
                  alt=""
                  class="blog_post-text-img"
                />
                <p class="global-text">
                  Theo truyền thuyết Nhật Bản, bánh Tsukimi-dango được làm bởi các chú thỏ trên cung
                  trăng. Hàng năm cứ đến ngày trăng rằm, các chú thỏ đó lại cùng nhau giã bột làm
                  bánh để ăn mừng.
                </p>
                <img
                  src="../../assets/images/blog-images/dango-tra.jpg"
                  alt=""
                  class="blog_post-text-img"
                />
                <p class="global-text">
                  Chính vì vậy, hình ảnh các chú thỏ giã bột, ăn bánh trên mặt trăng đã trở thành
                  một hình ảnh ngộ nghĩnh mà quen thuộc trong tâm trí người Nhật.
                </p>
                <img
                  src="../../assets/images/blog-images/dango-tho-trang.jpg"
                  alt=""
                  class="blog_post-text-img"
                />
                <p class="global-text">
                  Thỏ ngọc và bánh Tsukimi-dango đã trở thành hình tượng quen thuộc trong văn hóa
                  Trung thu của người Nhật
                </p>
                <p class="global-text">
                  Có rất nhiều truyền thuyết được truyền tai nhau rằng vì sao thỏ lại là loài vật
                  được sinh sống bất tử trên mặt trăng. Thế nhưng, điểm chung của tất cả các truyền
                  thuyết ấy đều là ngợi ca sự hi sinh, tình nghĩa và dũng khí của loài thỏ. Thật
                  không khó để nhận thấy thỏ là một loài vật rất được yêu mến và gần gũi với người
                  dân Nhật Bản.
                </p>
                <p class="global-heading global-heading--normal">
                  Cúng bánh Tsukimi-dango trong đêm rằm Trung thu
                </p>
                <p class="global-text">
                  Vào đêm rằm Trung thu, người Nhật thường xếp những viên bánh tsukimi-dango tròn
                  nhỏ thành hình tháp, đặt trên kệ gỗ. Bên cạnh trang trí bình cỏ susuki, đôi khi họ
                  còn bày thêm một số loại hoa quả.
                </p>
                <img
                  src="../../assets/images/blog-images/dango-2-ruou.jpg"
                  alt=""
                  class="blog_post-text-img"
                />
                <p class="global-text">
                  Sau khi hoàn thành mâm cúng, họ bày bánh trái ra vị trí có thể ngắm trăng rõ nhất
                  trong nhà, thường là hiên nhà hoặc bên bậu cửa sổ. Đặt như vậy là bởi người Nhật
                  muốn có thể vừa ăn bánh, vừa thưởng trăng một cách trọn vẹn nhất. Đối với người
                  Nhật, lễ hội Ostukimi mà không có bánh Tsukimi-dango và ngắm trăng thì sẽ không
                  trọn vẹn, hạnh phúc.
                </p>
                <img
                  src="../../assets/images/blog-images/dango-1-ruou.jpg"
                  alt=""
                  class="blog_post-text-img"
                />
                <p class="global-text">
                  Theo quan niệm Nhật Bản, bánh Tsukimi-dango được làm ra để dâng lên thần linh,
                  cúng bái tổ tiên, cha mẹ đã mất và cầu mong cho mùa mang bội thu, cuộc sống an
                  bình. Ở một số nơi còn cho rằng, nếu có trẻ em đi qua tự ý lấy bánh tsukimi-dango
                  đã cúng xong là điều may mắn, gia đình sẽ gặp nhiều điềm lành.
                </p>
                <img
                  src="../../assets/images/blog-images/dango-2-tho.jpg"
                  alt=""
                  class="blog_post-text-img"
                />
                <p class="global-text">
                  Bánh Tsukimi-dango có mùi vị dẻo, dai, thơm thơm ngọt ngọt, mang đậm bản sắc ẩm
                  thực và văn hóa của xứ sở hoa anh đào xinh đẹp. Trung thu sắp đến gần, hãy thử vào
                  bếp làm một đĩa bánh Tsukimi-dango cho mùa trăng rằm thêm phần khác lạ, thú vị và
                  độc đáo nhé.
                </p>
                <p class="global-text">
                  Tác giả: Blog Ẩm thực <br />
                  Link dẫn đến bài viết gốc:
                  <a target="_blank" href="https://www.blogamthuc.com/nguoi-nhat-ban-an-gi-vao-dem-trang-ram.html"
                    >https://www.blogamthuc.com/nguoi-nhat-ban-an-gi-vao-dem-trang-ram.html
                  </a>
                </p>
              </div>
            </div>
          </div>
          <p class="post-title-heading">Có thể bạn thích</p>
          <div class="blog-list slider-responsive">
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
