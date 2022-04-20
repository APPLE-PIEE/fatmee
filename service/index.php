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
  $dsyeuthich=mysqli_query($conn,"SELECT * FROM yeuthich WHERE email_khachhang='$email'");
  $dsgiohang=mysqli_query($conn,"SELECT * FROM giohang WHERE email_khachhang='$email'"); 
}


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="../assets/images/main-images/logo-main.png" type="image/x-icon" />
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
    <link rel="stylesheet" href="../assets/css/service/service.css">
    <title>FATMe - Dịch vụ</title>
  </head>
  <body>
    <div class="totop">
      <a href="../main-page/index.php" class="goto-top"></a>
    </div>
    <header class="header">
      <div class="navigation">
        <a href="../main-page/index.php"
          ><img class="header-logo" srcset="../assets/images/main-images/logo.png 2x"
        /></a>
        <input type="checkbox" name="" id="toggle-check" class="toggle-check" />
        <ul class="menu">
            <div class="menu-item toggle-close">
              <label for="toggle-check"
                ><img src="../assets/images/main-images/menu-close.png" alt="Close"
              /></label>
            </div>
            <li class="menu-item"><a class="menu-link" href="../main-page/index.php">Trang chủ</a></li>
            <li class="menu-item">
              <a class="menu-link" href="../mon-an/index.php">Món ăn</a>
            </li>
            <li class="menu-item"><a class="menu-link" href="../blog/index.php">Blog</a></li>
            <li class="menu-item">
              <a class="menu-link link-active" href="../service/index.php">Dịch vụ</a>
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
                        <a href="xoa.php?id=<?php echo $value['id_monan']; ?>">
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

    </header>

    <div class="service_container">
        <div class="service_header">
            <div class="header_content">
                <div class="right">
                    <h2>TIỆC TRỌN GÓI LƯU ĐỘNG</h2>
                    <h2>TẠI NHÀ – TIỆC OUTSIDE</h2>
                    <hr>
                    <ul>
                      <li>Tiệc từ 1 bàn đến 300 bàn </li>
                      <li> Tất cả các loại tiệc từ đơn giản đến phức tạp, từ bình dân đến cao cấp</li>
                      <li>Tổ chức tiệc tại khu vực TPHCM và các tỉnh lân cận: Long An, Tiền Giang, Bến Tre, Tây Ninh, Bình Dương, Đồng Nai, Vũng Tàu</li>
                      <li> Tiệc BBQ mới là đẳng cấp, năng lực đáp ứng lên đến 100 bàn</li>
                    </ul>
                    <h2>Tiêu chuẩn các loại dịch vụ  tiệc của FatMe:</h2>
                    <ul>
                      <li>Tiêu chuẩn Standard: Phổ biến nhất vì ưu điểm chi phí thấp và mặt bằng chật hẹp</li>
                      <li>Tiêu chuẩn VIP: Thích hợp các tiệc quan trọng: tiệc cưới, tiệc Công ty, liên hoan...</li>
                      <li> Tiêu Chuẩn Supper VIP: Tiệc cao cấp, tương đương các nhà hàng 4 sao</li>
                    </ul>
                </div>
                <div class="left">
                    <img src="../assets/images/service-img/header.png" alt="">
                </div>
            </div>


        </div>
        <div class="body_service">
            <div class="step_1">
              <h2>Bước 1: Chọn để tham khảo giá</h2>
              <ul>
                <li>
                  <div class="show_step">
                    <div class="name_tag">
                      <img src="../assets/images/service-img/standard.png" alt="standar">
                      <div class="name_header">
                        <h3>STANDARD</h3>
                      </div>
                    </div>
                    <div class="content_tag">
                      <p>Ghế innox không tựa lưng</p>
                      <p>Màu sắc tự chọn</p>
                    </div>
                    <input onclick="change()" type="button" value="Chọn gói STANDARD" id="changeOne"></input>
                  </div>
                </li>
                <li>
                  <div class="show_step">
                    <div class="name_tag">
                      <img src="../assets/images/service-img/vip.png" alt="standar">
                      <div class="name_header">
                        <h3>VIP</h3>
                      </div>
                    </div>
                    <div class="content_tag">
                      <p>Ghế Tựa Lưng, Trùm Áo Cột Nơ</p>
                      <p>Màu sắc tự chọn</p>
                      <p>Ly Có Chân</p>
                    </div>
                    <input onclick="change1()" type="button" value="Chọn gói VIP" id="changeTwo"></input>
                  </div>
                </li>
                <li>
                  <div class="show_step">
                    <div class="name_tag">
                      <img src="../assets/images/service-img/suppervip.png" alt="standar">
                      <div class="name_header">
                        <h3>SUPER VIP</h3>
                      </div>
                    </div>
                    <div class="content_tag">
                      <p>Ghế Tựa Lưng, Trùm Áo Cột Nơ</p>
                      <p>Màu sắc tự chọn</p>
                      <p>Ly Có Chân</p>
                      <p>Bàn Ăn, Khăn Ăn, Hoa Tươi</p>
                    </div>
                    <input onclick="change2()" type="button" value="Chọn gói SUPER VIP" id="changeThree"></input>
                  </div>
                </li>
              </ul>
            </div>
            <div class="step_2">
              <h2>Bước 2: Nhập để tham khảo giá</h2>
                <ul>
                  <li>
                    <label for="">Ngày bắt đầu</label>
                    <input type="datetime-local" id="time">
                    <p id="showTime"></p>
                  </li>
                  <li>
                    <label for="">Địa chỉ</label>
                   <input type="text" id="location" placeholder="Nhập địa chỉ">
                   <p id="showLcation"></p>
                  </li>
                  <li>
                    <label for="">Số khách</label>
                    <input type="number" id="numCus" placeholder="Nhập số khách tham dự">
                    <p id="showCus"></p>
                  </li>
                  <li>
                    <label for="">Số bàn</label>
                    <input type="number" id="numDesk" placeholder="Nhập số bàn">
                    <p id="showDesk"></p>
                  </li>
                </ul>
            </div>
            <div class="step_3">
               <h2>Bước 3: Tạo Menu món ăn</h2>
               <p class="global-heading--normal">
                Món khai vị
              </p>
              <div class="blog-list slider-responsive">
                <div class="blog-item show-on-scroll">
                  <div class="blog-image img-responsive">
                    <img src="../assets/images/service-img/Chả.jpeg" />
                  </div>
                  <div class="blog-content">
                    <h3 class="blog-title">Chả Hoàng Kim</h3>
                    <p class="blog-desc">
                      Giá: 100 000đ
                    </p>
                  </div>
                </div>
                <div class="blog-item show-on-scroll">
                  <div class="blog-image">
                    <img src="../assets/images/service-img/chaooc.jpeg" />
                  </div>
                  <div class="blog-content">
                    <h3 class="blog-title">Chả Ốc</h3>
                    <p class="blog-desc">
                      Giá: 120 000đ
                    </p>
                  </div>
                </div>
                <div class="blog-item show-on-scroll">
                  <div class="blog-image">
                    <img src="../assets/images/service-img/khaivi.jpeg" />
                  </div>
                  <div class="blog-content">
                    <h3 class="blog-title">Khai Vị Song Hỷ</h3>
                    <p class="blog-desc">
                     150 000đ
                    </p>

                  </div>
                </div>
                <div class="blog-item show-on-scroll">
                  <div class="blog-image">
                    <img src="../assets/images/service-img/khaivitamhop.jpeg" />
                  </div>
                  <div class="blog-content">
                    <h3 class="blog-title">Khai Vị Tam Hợp</h3>
                    <p class="blog-desc">
                      180 000đ
                    </p>

                  </div>
                </div>
                <div class="blog-item show-on-scroll">
                  <div class="blog-image">
                    <img src="../assets/images/service-img/goi.jpeg" />
                  </div>
                  <div class="blog-content">
                    <h3 class="blog-title">Gỏi Củ Hũ Dừa Tôm Thịt</h3>
                    <p class="blog-desc">
                      100 000đ
                    </p>
                  </div>
                </div>
                <div class="blog-item show-on-scroll">
                  <div class="blog-image">
                    <img src="../assets/images/service-img/goiganbo.jpeg" />
                  </div>
                  <div class="blog-content">
                    <h3 class="blog-title">Gỏi Gân Bò</h3>
                    <p class="blog-desc">
                      200 000đ
                    </p>
                  </div>
                </div>
              </div>


            <p class="global-heading--normal">
              Món súp bổ dưỡng
            </p>
            <div class="blog-list slider-responsive">
              <div class="blog-item show-on-scroll">
                <div class="blog-image img-responsive">
                  <img src="../assets/images/service-img/lautom.jpeg" />
                </div>
                <div class="blog-content">
                  <h3 class="blog-title">Lẩu Tôm Sú Chua Cay</h3>
                  <p class="blog-desc">
                    Giá: 250 000đ
                  </p>
                </div>
              </div>
              <div class="blog-item show-on-scroll">
                <div class="blog-image">
                  <img src="../assets/images/service-img/comchien.jpeg" />
                </div>
                <div class="blog-content">
                  <h3 class="blog-title">Cơm Chiên Tôm</h3>
                  <p class="blog-desc">
                    Giá: 95 000đ
                  </p>
                </div>
              </div>
              <div class="blog-item show-on-scroll">
                <div class="blog-image">
                  <img src="../assets/images/service-img/sup.jpeg" />
                </div>
                <div class="blog-content">
                  <h3 class="blog-title">Súp Đông Cô Gà Xé</h3>
                  <p class="blog-desc">
                  200 000đ
                  </p>

                </div>
              </div>
              <div class="blog-item show-on-scroll">
                <div class="blog-image">
                  <img src="../assets/images/service-img/supsodiep.jpeg" />
                </div>
                <div class="blog-content">
                  <h3 class="blog-title">Súp Sò Điệp Tóc Tiên</h3>
                  <p class="blog-desc">
                    220 000đ
                  </p>

                </div>
              </div>
              <div class="blog-item show-on-scroll">
                <div class="blog-image">
                  <img src="../assets/images/service-img/laucamang.png" />
                </div>
                <div class="blog-content">
                  <h3 class="blog-title">Lẩu Cá Măng Chua</h3>
                  <p class="blog-desc">
                    220 000đ
                  </p>
                </div>
              </div>
            </div>
            <p class="global-heading--normal">
              Món chiên nướng - hấp dẫn
            </p>
            <div class="blog-list slider-responsive">
              <div class="blog-item show-on-scroll">
                <div class="blog-image img-responsive">
                  <img src="../assets/images/service-img/bachiquay.jpeg" />
                </div>
                <div class="blog-content">
                  <h3 class="blog-title">Ba Chỉ Quay Sốt Balsamic</h3>
                  <p class="blog-desc">
                    Giá: 250 000đ
                  </p>
                </div>
              </div>
              <div class="blog-item show-on-scroll">
                <div class="blog-image">
                  <img src="../assets/images/service-img/tomsurang.jpeg" />
                </div>
                <div class="blog-content">
                  <h3 class="blog-title">Tôm Sú Rang Muối HongKong</h3>
                  <p class="blog-desc">
                    Giá: 180 000đ
                  </p>
                </div>
              </div>
              <div class="blog-item show-on-scroll">
                <div class="blog-image">
                  <img src="../assets/images/service-img/tomsuumuoi.jpeg" />
                </div>
                <div class="blog-content">
                  <h3 class="blog-title">Tôm Sú Ủ Muối</h3>
                  <p class="blog-desc">
                  150 000đ
                  </p>

                </div>
              </div>
              <div class="blog-item show-on-scroll">
                <div class="blog-image">
                  <img src="../assets/images/service-img/cadieuhong.png" />
                </div>
                <div class="blog-content">
                  <h3 class="blog-title">Cá Diêu Hồng Sốt Chanh Dây</h3>
                  <p class="blog-desc">
                    250 000đ
                  </p>

                </div>
              </div>
              <div class="blog-item show-on-scroll">
                <div class="blog-image">
                  <img src="../assets/images/service-img/caloc.jpeg" />
                </div>
                <div class="blog-content">
                  <h3 class="blog-title">Cá Lóc Quay Me - Bánh Hỏi</h3>
                  <p class="blog-desc">
                    190 000đ
                  </p>
                </div>
              </div>
            </div>
            <p class="global-heading--normal">
              Món hấp - Sang trọng
            </p>
            <div class="blog-list slider-responsive">
              <div class="blog-item show-on-scroll">
                <div class="blog-image img-responsive">
                  <img src="../assets/images/service-img/gata.jpeg" />
                </div>
                <div class="blog-content">
                  <h3 class="blog-title">Gà Ta Hấp Cách Thuỷ</h3>
                  <p class="blog-desc">
                    Giá: 200 000đ
                  </p>
                </div>
              </div>
              <div class="blog-item show-on-scroll">
                <div class="blog-image">
                  <img src="../assets/images/service-img/gahap.jpeg" />
                </div>
                <div class="blog-content">
                  <h3 class="blog-title">Gà Hấp Nước Mắm</h3>
                  <p class="blog-desc">
                    Giá: 250 000đ
                  </p>
                </div>
              </div>

            </div>
            <p class="global-heading--normal">
              Món nấu - Kì công
            </p>
            <div class="blog-list slider-responsive">
              <div class="blog-item show-on-scroll">
                <div class="blog-image img-responsive">
                  <img src="../assets/images/service-img/bonau.jpeg" />
                </div>
                <div class="blog-content">
                  <h3 class="blog-title">Bò Nấu Tiêu Xanh</h3>
                  <p class="blog-desc">
                    Giá: 300 000đ
                  </p>
                </div>
              </div>
              <div class="blog-item show-on-scroll">
                <div class="blog-image">
                  <img src="../assets/images/service-img/lauvit.jpeg" />
                </div>
                <div class="blog-content">
                  <h3 class="blog-title">Lẩu Vịt Nấu Chao</h3>
                  <p class="blog-desc">
                    Giá: 280 000đ
                  </p>
                </div>
              </div>

            </div>

            </div>
            <div class="step_4">
              <h2>Bước 4: Thanh toán</h2>
              <label for="">Tổng tiền phải thanh toán: </label>
              <input type="number" placeholder="500 000đ" disabled><br>
              <label for="">Thanh toán bằng</label>
              <select name="" id="">
                <option value="">Mastercard</option>
                <option value="">Momo</option>
                <option value="">Banking</option>
              </select>
              <button onclick="submit()">Xác nhận</button>
            </div>
        </div>
    </div>
   <br><br><br><br><br>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
    <script src="./js/service.js"></script>
    <script src="../assets/js/main.js"></script>

  </body>
</html>
