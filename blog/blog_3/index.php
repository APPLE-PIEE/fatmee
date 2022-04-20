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
              <a href="#!" class="blog_post-link-item">Blog_3 </a>
            </div>
            <div class="">
              <p class="blog_post-time global-text show-on-scroll">22 tháng 12 năm 2021</p>
              <h2 class="blog_post-heading global-heading global-heading--big show-on-scroll">
                Khám phá khu phố Tàu giữa lòng Sài Gòn
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
                src="../../assets/images/blog-images/blog3.jpg"
                alt="blog-3"
                class="blog_post-image-img"
              />
            </div>
            <div class="blog_post-text">
              <div class="blog_post-social">
                <a href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Ffatme.tk%2Fblog%2Fblog_3%2F" class="blog_post-social-item" target="_blank">
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
                  Khu phố Tàu Thành phố Hồ Chí Minh, nằm ở trung tâm quận 5, có vẻ yên tĩnh vào buổi
                  sáng nhưng nhộn nhịp vào ban đêm. Người Việt Nam có một trích dẫn vui nhộn "Thức
                  ăn tốt nhất là Thực phẩm Trung Quốc, vợ tốt nhất là Vợ Nhật Bản, và ngôi nhà tốt
                  nhất là Nhà Tây.". Vì vậy, những gì thú vị về thực phẩm Trung Quốc? Điều gì khiến
                  nó trở nên hấp dẫn? Ngày nay, LyHoangDong Blog sẽ khám phá ra câu trả lời cho bạn
                  theo cách rất riêng: một tour thực phẩm Trung Quốc tại các nhà hàng Trung Quốc
                  ngay tại trung tâm của Sài Gòn năng động này.
                </p>
                <p class="global-heading global-heading--normal">Vịt quay Bắc Kinh</p>
                <p class="global-text">
                  Chúng tôi bắt đầu chuyến lưu diễn với một món ăn nổi tiếng từ Trung Quốc: Vịt quay
                  Bắc Kinh. Chúng tôi thực sự không có ý tưởng vịt nướng rang như thế nào ở Bắc
                  Kinh, nhưng nếu họ hiển thị thức ăn của họ như hình dưới đây, bạn sẽ không vội
                  vàng bên trong và đặt hàng ngay lập tức? Onetrip chắc chắn sẽ. Yum!
                </p>
                <img
                  src="../../assets/images/blog-images/vit-quay.jpg"
                  alt=""
                  class="blog_post-text-img"
                />
                <p class="global-text">
                  Tại Việt Nam, người ta thường đến các cửa hàng này để lấy vịt rang, vì vậy hầu hết
                  trong số họ không có bàn ghế để khách hàng ngồi xuống. Họ chỉ có một cái giá lớn
                  phủ kiếng, nơi họ có thể treo lên những con vịt nướng ngon miệng bên trong.
                </p>
                <p class="global-text">
                  Cách họ nấu vịt rất thú vị để xem. Năm vịt hấp được treo trên một cái nồi đất sét
                  khổng lồ đã được thắp sáng bên trong. Sau đó, sau khoảng 30 đến 45 phút, chúng tôi
                  có vịt tốt nhất trong thị trấn. Bạn có tự hỏi tại sao những con vịt đó có cái nhìn
                  màu cam ngon, crunchy? Đó là bởi vì họ đang nướng với mật ong. m thanh hấp dẫn
                  phải không?
                </p>
                <p class="global-text">
                  Nhà hàng Onetrip đã cho bạn thấy trong video rất cũ và đã có mặt trong hơn 60 năm.
                  Vịt của chúng mềm, ngon ngọt và ngon miệng cùng với một loại sốt đặc. Đó là lý do
                  tại sao ngay cả khi họ không thực hiện tiếp thị, họ vẫn luôn có đám đông từ sáng
                  sớm cho đến đêm. Người chủ cũ đã được sinh ra tại Quảng Châu, Trung Quốc đã đến
                  Việt Nam, cưới một phụ nữ Việt Nam và mở cửa hàng này. Con gái của anh bây giờ
                  điều hành công việc gia đình cho anh ta.
                </p>
                <p class="global-text">
                  Chúng tôi thường ăn vịt nướng với bánh bao hoặc cơm nếp. Nhưng chúng tôi nghĩ rằng
                  bạn chỉ có thể muốn thưởng thức vịt của chính nó gây ra hương vị của nó là tuyệt
                  vời như vậy mà bạn sẽ không bao giờ muốn ngừng ăn! Một điểm tích cực cho resto này
                  là nhà bếp vô cùng của họ. Nó sạch sẽ và hoàn toàn mở để mọi người có thể nhìn
                  thấy mọi thứ đang diễn ra bên trong. Bạn không phải lo lắng về chất lượng thực
                  phẩm, Onetrip luôn cho bạn thấy tốt nhất.
                </p>
                <p class="global-text">
                  Thông tin chung: <br />
                  Tên nhà hàng : Vịt quay Quốc Kỳ <br />
                  Địa chỉ: 471 Trần Phú, Phường 7, Quận 5, TP.HCM <br />
                  Giờ mở cửa: 7 giờ sáng - 10 giờ tối <br />
                </p>
                <p class="global-heading global-heading--normal">Mì tươi làm bằng tay</p>
                <p class="global-text">
                  Cách xử lý tiếp theo cũng không kém đặc biệt: mì khô khô. Onetrip sẽ đưa bạn đến
                  một cửa hàng phở gia đình, trong một con hẻm nhỏ, nơi họ có một siêu đặc biệt để
                  làm khô mì của họ. Hãy cùng kiểm tra nào.
                </p>
                <img
                  src="../../assets/images/blog-images/mi-tuoi.jpg"
                  alt=""
                  class="blog_post-text-img"
                />
                <p class="global-text">
                  Hình ảnh ấn tượng đầu tiên bạn sẽ nhìn thấy ngay khi bạn vào cửa hàng này là một
                  giỏ hàng bằng gỗ cũ được làm bởi chủ sở hữu đầu tiên. Trong 70 năm, con gái ông đã
                  không bao giờ muốn thay thế nó bằng một chiếc xe đẩy hiện đại, vì vậy bà chỉ cố
                  gắng khắc phục nó nếu có bất cứ điều gì phá vỡ.
                </p>
                <p class="global-text">
                  Bạn có thể tìm thấy tất cả các loại mì ở đây nấu trong những cách khác nhau. Tất
                  cả mọi thứ từ char siu đến mì wonton phục vụ khô hoặc trong một món súp ăn liền.
                  Và mỗi người trong số họ là siêu ngon theo cách Trung Quốc. Bạn biết mì là đặc
                  biệt soooo khi họ vẫn nhai. Ngay cả khi chúng ta ăn chúng chậm, chúng sẽ không bao
                  giờ trở thành bong bóng.
                </p>
                <p class="global-text">
                  Trong khi chúng tôi ở đây, chúng tôi đã ra lệnh cho hai bát mì khô khô, và chúng
                  tôi lại một lần nữa họ lại cảm thấy xấu hổ. Người nấu nướng chuẩn bị cho món
                  noodle thật dễ dàng, nhưng trên thực tế, nó cần rất nhiều sự khéo léo. Họ chỉ cần
                  ném mì vào nước đun sôi trong một thời gian ngắn, sau đó kéo chúng ra với một
                  chiếc cào lớn. Sau đó, họ sử dụng một đôi đũa lớn để chạm vào cào, vì vậy mì ăn
                  liền và nhảy lên cho đến khi khô. Thật là một kỹ thuật khéo léo. Kiểm tra nó trong
                  video. Hương vị mặn của thịt heo xông khói pha trộn với tôm giòn và nước sốt hàu
                  tạo nên sự kết hợp hoàn hảo trong miệng của bạn. Súp ăn liền cũng rất ngon, vì vậy
                  ngay cả khi khách hàng đặt hàng mì khô, họ thường muốn có một bát súp bên cạnh.
                  Súp có mặn và ngọt cùng một lúc. Bạn có thể ngửi thấy mùi thịt heo ngon và hương
                  vị hành xanh đang trôi nổi từ bát.
                </p>
                <p class="global-text">
                  Hương vị mặn của thịt heo xông khói pha trộn với tôm giòn và nước sốt hàu tạo nên
                  sự kết hợp hoàn hảo trong miệng của bạn.
                </p>
                <p class="global-text">
                  Resto này mở cửa rất sớm vào buổi sáng và không đóng cửa cho đến 1 giờ sáng. Nơi
                  luôn đầy người, những người đi với nụ cười lớn và túi mì ngon. Onetrip không thể
                  chỉ thưởng thức món ăn ngon miệng này, vì vậy chúng tôi quyết định chia sẻ địa
                  điểm tuyệt vời với khách hàng tương lai của chúng tôi.
                </p>
                <p class="global-text">
                  Thông tin chung: <br />
                  Tên nhà hàng: Thiệu Kỳ <br />
                  Địa chỉ: 66/5 Lê Đại Hành, Phường 7, Quận 11, TP.HCM <br />
                  Giờ hoạt động: 7:00 AM - 1:00 AM <br />
                </p>
                <p class="global-heading global-heading--normal">Há cảo</p>
                <img
                  src="../../assets/images/blog-images/ha-cao.jpg"
                  alt=""
                  class="blog_post-text-img"
                />
                <p class="global-text">
                  Và cuối cùng nhưng không kém phần quan trọng, hãy có một số bánh bao tại một trong
                  những nhà hàng kiểu Trung Quốc nhất. Nếu bạn là người yêu đồ ăn Trung Quốc, chắc
                  chắn bạn không thể bỏ qua nơi này. Tại sao chúng ta lại nghĩ đến nơi này có phong
                  cách? Đó là bởi vì tất cả nhân viên đều có đồng phục Trung Quốc rất đặc biệt. Họ
                  cũng rất chu đáo và thân thiện với khách hàng. Vì vậy, mặc dù giá cả khá cao so
                  với các quán ăn trên đường phố, nhưng nó vẫn là lựa chọn đầu tiên cho những ai
                  muốn thưởng thức thức ăn ngon trong khung cảnh sang trọng hơn.
                </p>
                <p class="global-text">
                  Nhà hàng này có hơn 20 loại bánh bao để bạn lựa chọn. Mỗi loại khác nhau được đặt
                  trong một giỏ nhỏ hấp mà làm cho một bảng đầy bánh bao một cảnh tuyệt đẹp. Nhưng
                  chúng không chỉ đẹp Mỗi một trong số họ có một hương vị độc đáo.
                </p>
                <p class="global-text">
                  Bánh bao Char Siu được đánh giá cao vì thịt lợn của họ ngon miệng bên trong. Tôm
                  tôm hấp sẽ không chỉ gây ấn tượng với sự xuất hiện của họ mà còn bởi vì thịt tôm
                  mềm, mềm. Có nhiều món ăn khác như cua shumai, thịt heo chiên với bánh puffley,
                  bánh bao với thịt lợn và rau mùi tây Trung Quốc, và bánh cuốn với sốt hàu ...
                </p>
                <p class="global-text">
                  Đến nước Mỹ mà bỏ qua món kem thì thật đáng tiếc. Mỗi địa phương đều có một loại
                  kem riêng của mình nhưng nhìn chung chúng đều đặc biệt ngon. Kem Mỹ được coi là
                  một trong những món tráng miệng ngon nhất trên toàn thế giới.
                </p>
                <p class="global-text">
                  Thông tin chung: <br />
                  Tên nhà hàng: Dimsum Mỹ Thức - Tiến Phát <br />
                  Địa chỉ: 18 Kỳ Hòa, Phường 11, Quận 5, TP.HCM <br />
                  Giờ hoạt động: 6:00 AM - 12:30 CH <br />
                </p>
                <p class="global-text">
                  Sau khi xem video và đọc bài báo, bạn có nhận được lý do tại sao tất cả mọi người
                  yêu thực phẩm Trung Quốc? Nếu bạn đang đi du lịch hoặc sinh sống ở Việt Nam, bạn
                  sẽ may mắn vì không phải đi xa hơn để thưởng thức một số món đặc sản Trung Quốc
                  tuyệt vời. Bạn có thể lấy chúng ngay tại những con phố ẩm thực Sài Gòn. Đừng ngần
                  ngại liên hệ Onetrip nếu bạn muốn biết những địa điểm tốt nhất trong thị trấn.
                  Chúng tôi đã sẵn sàng và chờ đợi để đưa bạn lên một chuyến tham quan Trung Quốc về
                  Thực phẩm sẽ làm nổ tung tâm trí của bạn.
                </p>
                <p class="global-text">
                  Tác giả: LyHoangDong Blog <br />
                  Link dẫn đến bài viết gốc:
                  <a target="_blank" href="https://lyhoangdong.weebly.com/am-thuc-duong-pho/pho-tau"
                    >https://lyhoangdong.weebly.com/am-thuc-duong-pho/pho-tau
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
