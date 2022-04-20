<?php

include"../../connect/connect.php";
if(empty($_SESSION['email'])){
    header("location: ../../login/index.php");
  }else {
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
        <link rel="stylesheet" href="../../assets/css/food/type_food.css">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <title>FATMe - Món Ăn </title>
      </head>
  <body>
    <div class="totop">
      <a href="#" class="goto-top"></a>
    </div>
    <div class="wrapper">
        <header class="header">
            <div class="navigation">
            <a href="../../main-page/index-main.php"
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
        <div class="type_food_container">
          <div class="search">
            <input type="text" id="search" placeholder="Bạn muốn tìm ...">
            <button>Tìm kiếm</button>
            <select name="" id="">
              <option value="">Gần đây nhất</option>
              <option value="">Giá giảm dần</option>
              <option value="">Giá tăng dần</option>
              <option value="">Mới nhất</option>
            </select>
          </div>
          <div class="title">
            <p>Thể loại món ăn</p>
            <button class="btn_tittle w3-button tablink" onclick="openCity(event, 'anVat')">Ăn Vặt</button>
            <button class="btn_tittle w3-button tablink" onclick="openCity(event, 'anNhanh')">Ăn nhanh</button>
            <button class="btn_tittle w3-button tablink" onclick="openCity(event, 'com')">Cơm</button>
            <button class="btn_tittle w3-button tablink" onclick="openCity(event, 'monNuoc')">Món nước</button>
            <button class="btn_tittle w3-button tablink" onclick="openCity(event, 'doChay')">Đồ chay</button>
            <button class="btn_tittle w3-button tablink" onclick="openCity(event, 'trangMieng')">Tráng miệng</button>
          </div>

          <div class="content">
            <div id="anVat" class="w3-container city" >
              <div class="food-container">
                <div>
                    <img class="img" src="../../assets/images/food/mochi.jpeg" alt="">
                    <div class="content_food">
                        <a href="https://loship.vn/mochisweetsvincomb?pItem=60158035">Hộp Nama Mochi Trà Xanh</a>
                    </div>
                    <div class="price">
                        <p>110 000đ</p>
                    </div>
                </div>
                <div>
                    <img class="img" src="../../assets/images/food/suachua.png" alt="">
                   <div class="content_food">
                    <a href="https://loship.vn/shenlongsuachuanepcam22?pItem=16838670">Sữa Chua Nếp Cẩm</a>
                   </div>
                    <div class="price">
                        <p>18 000đ</p>
                    </div>
                </div>
                <div>
                    <img class="img" src="../../assets/images/food/banhbachtuocphomai.jpeg" alt="">
                    <div class="content_food">
                        <a href="https://loship.vn/takoyakihatachingonguyen?pItem=62235175">Takoyaki Phô Mai</a>
                    </div>
                    <div class="price">
                        <p>25 000đ</p>
                    </div>
                </div>
                <div>
                    <img class="img" src="../../assets/images/food/banhca.webp" alt="">
                   <div class="content_food">
                       <a href="https://loship.vn/khanhduyenbanhcanuongtaiyaki?pItem=63500567">Bánh Cá Nhân Phomai Trứng Muối</a>
                    </div>
                    <div class="price">
                        <p>14 000đ</p>
                    </div>
                </div>
                <div>
                    <img class="img" src="../../assets/images/food/banhsukem.jpeg" alt="">
                   <div class="content_food">
                    <a href="https://loship.vn/banhsukemchewyjuniorvincomcenter?pItem=59568089">Bánh Su Kem Strawberry Cheese</a>
                   </div>
                    <div class="price">
                        <p>27 000đ</p>
                    </div>
                </div>
              </div>
              <div class="food-container">
                <div>
                    <img class="img" src="../../assets/images/food/banhtrangtronkim.jpeg" alt="">
                    <div class="content_food">
                        <a href="https://loship.vn/mochisweetsvincomb?pItem=60158035">Bánh tráng trộn và bánh tráng cuốn bơ</a>
                    </div>
                    <div class="price">
                        <p>50 000đ</p>
                    </div>
                </div>
                <div>
                    <img class="img" src="../../assets/images/food/banhcrepe.jpeg" alt="">
                   <div class="content_food">
                    <a href="https://loship.vn/lamphatbanhcrepeandbanhbonglan?pItem=59395630">Bánh Crepe Sầu Riêng + Bánh Trứng
                    </a>
                   </div>
                    <div class="price">
                        <p>105 000đ</p>
                    </div>
                </div>
                <div>
                    <img class="img" src="../../assets/images/food/banhmiphomai.jpeg" alt="">
                    <div class="content_food">
                        <a href="https://loship.vn/lamphatbanhcrepeandbanhbonglan?pItem=59395629">Bánh Mì Mini Phô Mai Tan Chảy</a>
                    </div>
                    <div class="price">
                        <p>70 000đ</p>
                    </div>
                </div>
                <div>
                    <img class="img" src="../../assets/images/food/crepesaurieng.jpeg" alt="">
                   <div class="content_food">
                       <a href="https://loship.vn/lamphatbanhcrepeandbanhbonglan?pItem=59395627">Bánh Crepe Sầu Riêng</a>
                    </div>
                    <div class="price">
                        <p>80 000đ</p>
                    </div>
                </div>
                <div>
                    <img class="img" src="../../assets/images/food/bonglantrungmuoi.jpeg" alt="">
                   <div class="content_food">
                    <a href="https://loship.vn/lamphatbanhcrepeandbanhbonglan?pItem=59395638">Bánh Bông Lan Trứng Muối Phú Sĩ</a>
                   </div>
                    <div class="price">
                        <p>55 000đ</p>
                    </div>
                </div>
            </div>
            <div class="food-container">
                <div>
                    <img class="img" src="../../assets/images/food/xienque.jpeg" alt="">
                    <div class="content_food">
                        <a href="https://loship.vn/xienquecavienthokoon?pItem=63661405">Ngũ Quả Đong Đầy</a>
                    </div>
                    <div class="price">
                        <p>50 000đ</p>
                    </div>
                </div>
                <div>
                    <img class="img" src="../../assets/images/food/phattaiphatloc.jpeg" alt="">
                   <div class="content_food">
                    <a href="https://loship.vn/xienquecavienthokoon?pItem=63661407">Phát Tài Phát Lộc</a>
                   </div>
                    <div class="price">
                        <p>75 000đ</p>
                    </div>
                </div>
                <div>
                    <img class="img" src="../../assets/images/food/vansunhuy.jpeg" alt="">
                    <div class="content_food">
                        <a href="https://loship.vn/xienquecavienthokoon?pItem=63661413">Vạn Sự Như Ý</a>
                    </div>
                    <div class="price">
                        <p>200 000đ</p>
                    </div>
                </div>
                <div>
                    <img class="img" src="../../assets/images/food/chaosa.jpeg" alt="">
                   <div class="content_food">
                       <a href="https://loship.vn/xienquecavienthokoon?pItem=63661424">Chạo Sả</a>
                    </div>
                    <div class="price">
                        <p>12 000đ</p>
                    </div>
                </div>
                <div>
                    <img class="img" src="../../assets/images/food/phomaique.jpeg" alt="">
                   <div class="content_food">
                    <a href="https://loship.vn/xienquecavienthokoon?pItem=63661430">Phô Mai Que</a>
                   </div>
                    <div class="price">
                        <p>12 000đ</p>
                    </div>
                </div>
            </div>
            </div>

            <div id="anNhanh" class="w3-container city" style="display:none">
              <div class="food-container">
                <div>
                    <img class="img" src="../../assets/images/food/burgermac.png" alt="">
                    <div class="content_food">
                        <a href="https://mcdonalds.vn/thuc-don/bo-pho-mai-dac-biet-4.html">Bò Phô Mai Đặc Biệt</a>
                    </div>
                    <div class="price">
                        <p>45 000đ</p>
                    </div>
                </div>
                <div>
                    <img class="img" src="../../assets/images/food/bomienglon.png" alt="">
                   <div class="content_food">
                    <a href="https://mcdonalds.vn/thuc-don/burger-bo-mieng-lon-phomai-7.html">Bò Miếng Lớn Phô Mai</a>
                   </div>
                    <div class="price">
                        <p>69 000đ</p>
                    </div>
                </div>
                <div>
                    <img class="img" src="../../assets/images/food/burgergamac.png" alt="">
                    <div class="content_food">
                        <a href="https://mcdonalds.vn/thuc-don/burger-phile-ga-cay-dac-biet-11.html">Burger Phi Lê Gà Cay Đặc Biệt</a>
                    </div>
                    <div class="price">
                        <p>79 000đ</p>
                    </div>
                </div>
                <div>
                    <img class="img" src="../../assets/images/food/burgergathuong.png" alt="">
                   <div class="content_food">
                       <a href="https://mcdonalds.vn/thuc-don/burger-ga-37.html">Burger Gà</a>
                    </div>
                    <div class="price">
                        <p>32 000đ</p>
                    </div>
                </div>
                <div>
                    <img class="img" src="../../assets/images/food/burgerca.png" alt="">
                   <div class="content_food">
                    <a href="https://mcdonalds.vn/thuc-don/burger-phi-le-ca-pho-mai-89.html">Burger Phi Lê Cá Phô Mai</a>
                   </div>
                    <div class="price">
                        <p>49 000đ</p>
                    </div>
                </div>
            </div>
            <div class="food-container">
                <div>
                    <img class="img" src="../../assets/images/food/combogaranmac.png" alt="">
                    <div class="content_food">
                        <a href="https://mcdonalds.vn/thuc-don/20-mieng-ga-mcnuggets%E2%84%A2-12.html">20 Miếng Gà McNuggets</a>
                    </div>
                    <div class="price">
                        <p>115 000đ</p>
                    </div>
                </div>
                <div>
                    <img class="img" src="../../assets/images/food/2minegga.png" alt="">
                   <div class="content_food">
                    <a href="https://mcdonalds.vn/thuc-don/phan-an-2-mieng-ga-ran-55.html">Phần Ăn 2 Miếng Gà Rán
                    </a>
                   </div>
                    <div class="price">
                        <p>86 000đ</p>
                    </div>
                </div>
                <div>
                    <img class="img" src="../../assets/images/food/3miengcanhga.png" alt="">
                    <div class="content_food">
                        <a href="https://mcdonalds.vn/thuc-don/3-mieng-canh-ga-mcwings%E2%84%A2-20.html">3 Miếng Cánh Gà McWings</a>
                    </div>
                    <div class="price">
                        <p>69 000đ</p>
                    </div>
                </div>
                <div>
                    <img class="img" src="../../assets/images/food/3miengca.png" alt="">
                   <div class="content_food">
                       <a href="https://mcdonalds.vn/thuc-don/4-mieng-ga-mcnuggets-114.html">4 Miếng Gà McNuggets</a>
                    </div>
                    <div class="price">
                        <p>36 000đ</p>
                    </div>
                </div>
                <div>
                    <img class="img" src="../../assets/images/food/5miengga.png" alt="">
                   <div class="content_food">
                    <a href="https://mcdonalds.vn/thuc-don/5-mieng-ga-ran-48.html">5 Miếng Gà Rán</a>
                   </div>
                    <div class="price">
                        <p>55 000đ</p>
                    </div>
                </div>
            </div>
            <div class="food-container">
                <div>
                    <img class="img" src="../../assets/images/food/bạnhtao.png" alt="">
                    <div class="content_food">
                        <a href="https://mcdonalds.vn/thuc-don/banh-tao-nuong-32.html">Bánh Táo Nướng</a>
                    </div>
                    <div class="price">
                        <p>25 000đ</p>
                    </div>
                </div>
                <div>
                    <img class="img" src="../../assets/images/food/khoaitaychiennho.png" alt="">
                   <div class="content_food">
                    <a href="https://mcdonalds.vn/thuc-don/khoai-tay-chien-size-nho-206-kcal-14.html">Khoai Tây Chiên Nhỏ</a>
                   </div>
                    <div class="price">
                        <p>16 000đ</p>
                    </div>
                </div>
                <div>
                    <img class="img" src="../../assets/images/food/khoaitaychiennho.png" alt="">
                   <div class="content_food">
                       <a href="https://mcdonalds.vn/thuc-don/khoai-tay-chien-size-vua-16.html">Khoai Tây Chiên Vừa</a>
                    </div>
                    <div class="price">
                        <p>26 000đ</p>
                    </div>
                </div>
                <div>
                    <img class="img" src="../../assets/images/food/khoaitaychiennho.png" alt="">
                   <div class="content_food">
                       <a href="https://mcdonalds.vn/thuc-don/khoai-tay-chien-size-lon-17.html">Khoai Tây Chiên Lớn</a>
                    </div>
                    <div class="price">
                        <p>36 000đ</p>
                    </div>
                </div>
                <div>
                    <img class="img" src="../../assets/images/food/kemdau.png" alt="">
                   <div class="content_food">
                    <a href="https://mcdonalds.vn/thuc-don/kem-mcsundae%E2%84%A2-sot-dau-34.html">Kem McSundae Sốt Dâu</a>
                   </div>
                    <div class="price">
                        <p>29 000đ</p>
                    </div>
                </div>
            </div>
            </div>

            <div id="com" class="w3-container city" style="display:none">
              <div class="food-container">
                <div>
                    <img class="img" src="../../assets/images/food/comtam.jpeg" alt="">
                    <div class="content_food">
                        <a href="https://loship.vn/cophungcomtambinhdan?pItem=7082219">Cơm Bì Ốp La
                        </a>
                    </div>
                    <div class="price">
                        <p>24 000đ</p>
                    </div>
                </div>
                <div>
                    <img class="img" src="../../assets/images/food/comtrung.jpeg" alt="">
                   <div class="content_food">
                    <a href="https://loship.vn/cophungcomtambinhdan?pItem=7082217">Cơm Chả Trứng
                    </a>
                   </div>
                    <div class="price">
                        <p>24 000đ</p>
                    </div>
                </div>
                <div>
                    <img class="img" src="../../assets/images/food/comsuon.jpeg" alt="">
                    <div class="content_food">
                        <a href="https://loship.vn/cophungcomtambinhdan?pItem=7082214">Cơm Sườn Nướng
                        </a>
                    </div>
                    <div class="price">
                        <p>29 000đ</p>
                    </div>
                </div>
                <div>
                    <img class="img" src="../../assets/images/food/suonbicha.jpeg" alt="">
                   <div class="content_food">
                       <a href="https://loship.vn/cophungcomtambinhdan?pItem=7082215">Cơm Sườn Bì Chả
                    </a>
                    </div>
                    <div class="price">
                        <p>43 000đ</p>
                    </div>
                </div>
                <div>
                    <img class="img" src="../../assets/images/food/xiumai.jpeg" alt="">
                   <div class="content_food">
                    <a href="https://loship.vn/cophungcomtambinhdan?pItem=7082218">Cơm Xíu Mại
                    </a>
                   </div>
                    <div class="price">
                        <p>24 000đ</p>
                    </div>
                </div>
            </div>
            <div class="food-container">
                <div>
                    <img class="img" src="../../assets/images/food/comech.jpeg" alt="">
                    <div class="content_food">
                        <a href="https://loship.vn/comtamnhohoangdieu?pItem=55196">Cơm Ếch Xào Xả Ớt
                        </a>
                    </div>
                    <div class="price">
                        <p>61 000đ</p>
                    </div>
                </div>
                <div>
                    <img class="img" src="../../assets/images/food/cakhoto.jpeg" alt="">
                   <div class="content_food">
                    <a href="https://loship.vn/comtamnhohoangdieu?pItem=55195">Cơm Cá Hú Kho Tộ
                    </a>
                   </div>
                    <div class="price">
                        <p>42 000đ</p>
                    </div>
                </div>
                <div>
                    <img class="img" src="../../assets/images/food/comchaca.jpeg" alt="">
                    <div class="content_food">
                        <a href="https://loship.vn/comtamnhohoangdieu?pItem=55194">Cơm Chả Cá Thác Lát Thì Là
                        </a>
                    </div>
                    <div class="price">
                        <p>43 000đ</p>
                    </div>
                </div>
                <div>
                    <img class="img" src="../../assets/images/food/combaroi.jpeg" alt="">
                   <div class="content_food">
                       <a href="https://loship.vn/comtamnhohoangdieu?pItem=55192">Cơm Ba Rọi Nướng Muối Ớt
                    </a>
                    </div>
                    <div class="price">
                        <p>43 000đ</p>
                    </div>
                </div>
                <div>
                    <img class="img" src="../../assets/images/food/comga.jpeg" alt="">
                   <div class="content_food">
                    <a href="https://loship.vn/comtamnhohoangdieu?pItem=55191">Cơm Đùi Gà Nướng Tỏi
                    </a>
                   </div>
                    <div class="price">
                        <p>43 000đ</p>
                    </div>
                </div>
            </div>
            <div class="food-container">
                <div>
                    <img class="img" src="../../assets/images/food/cotlet.jpeg" alt="">
                    <div class="content_food">
                        <a href="https://loship.vn/comtamnhohoangdieu?pItem=55189">Cơm Sườn Cốt Lết Nướng
                        </a>
                    </div>
                    <div class="price">
                        <p>55 000đ</p>
                    </div>
                </div>
                <div>
                    <img class="img" src="../../assets/images/food/comlapxuong.jpeg" alt="">
                   <div class="content_food">
                    <a href="https://loship.vn/comtamnhohoangdieu?pItem=55199">Cơm Lạp Xưởng
                    </a>
                   </div>
                    <div class="price">
                        <p>43 000đ</p>
                    </div>
                </div>
                <div>
                    <img class="img" src="../../assets/images/food/commucnhoithit.jpeg" alt="">
                    <div class="content_food">
                        <a href="https://loship.vn/comtamnhohoangdieu?pItem=55198">Cơm Mực Nhồi Thịt
                        </a>
                    </div>
                    <div class="price">
                        <p>61 000đ</p>
                    </div>
                </div>
                <div>
                    <img class="img" src="../../assets/images/food/comthitxaxiu.jpeg" alt="">
                   <div class="content_food">
                       <a href="https://loship.vn/comsuonnuongthenguyenmacdinhchi?pItem=56724058">Cơm Thịt Quay Xá Xíu
                    </a>
                    </div>
                    <div class="price">
                        <p>65 000đ</p>
                    </div>
                </div>
                <div>
                    <img class="img" src="../../assets/images/food/thitkhotrung.jpeg" alt="">
                   <div class="content_food">
                    <a href="https://loship.vn/comsuonnuongthenguyenmacdinhchi?pItem=56724056">Cơm Thịt Kho Trứng
                    </a>
                   </div>
                    <div class="price">
                        <p>49 000đ</p>
                    </div>
                </div>
            </div>
            </div>
            <div id="monNuoc" class="w3-container city" style="display:none">
              <div class="food-container">
                <div>
                    <img class="img" src="../../assets/images/food/bunbohue.jpeg" alt="">
                    <div class="content_food">
                        <a href="https://loship.vn/bunbocotuyen?pItem=60257838">Bún Bò Huế Thập Cẩm
                        </a>
                    </div>
                    <div class="price">
                        <p>57 000đ</p>
                    </div>
                </div>
                <div>
                    <img class="img" src="../../assets/images/food/bunbotruyenthong.jpeg" alt="">
                   <div class="content_food">
                    <a href="https://loship.vn/bunbocotuyen?pItem=61741872">Bún Bò Truyền Thống
                    </a>
                   </div>
                    <div class="price">
                        <p>50 000đ</p>
                    </div>
                </div>
                <div>
                    <img class="img" src="../../assets/images/food/bunrieucua.jpeg" alt="">
                    <div class="content_food">
                        <a href="https://loship.vn/bunrieucanhbuncuadongcoba?pItem=63019307">Bún Riêu Đặc Biệt( Cua + Chả + Ốc + Giò )
                        </a>
                    </div>
                    <div class="price">
                        <p>50 000đ</p>
                    </div>
                </div>
                <div>
                    <img class="img" src="../../assets/images/food/bunrieugioheo.jpeg" alt="">
                   <div class="content_food">
                       <a href="https://loship.vn/bunrieunguyencanhchan2?pItem=60460336">Bún Riêu Giò Heo
                    </a>
                    </div>
                    <div class="price">
                        <p>48 000đ</p>
                    </div>
                </div>
                <div>
                    <img class="img" src="../../assets/images/food/bunrieuoc.jpeg" alt="">
                   <div class="content_food">
                    <a href="https://loship.vn/bunrieunguyencanhchan2?pItem=60460326">Bún Riêu Ốc
                    </a>
                   </div>
                    <div class="price">
                        <p>48 000đ</p>
                    </div>
                </div>
            </div>
            <div class="food-container">
                <div>
                    <img class="img" src="../../assets/images/food/bunmam.jpeg" alt="">
                    <div class="content_food">
                        <a href="https://loship.vn/bunmamvui?pItem=59329990">Bún Mắm
                        </a>
                    </div>
                    <div class="price">
                        <p>94 000đ</p>
                    </div>
                </div>
                <div>
                    <img class="img" src="../../assets/images/food/banhcanhnhatrang.jpeg" alt="">
                   <div class="content_food">
                    <a href="https://loship.vn/cobemonngonnhatrang?pItem=6903205">Bánh Canh Nha Trang
                    </a>
                   </div>
                    <div class="price">
                        <p>64 000đ</p>
                    </div>
                </div>
                <div>
                    <img class="img" src="../../assets/images/food/buncasua.jpeg" alt="">
                    <div class="content_food">
                        <a href="https://loship.vn/cobemonngonnhatrang?pItem=6903202">Bún Cá Sứa
                        </a>
                    </div>
                    <div class="price">
                        <p>75 000đ</p>
                    </div>
                </div>
                <div>
                    <img class="img" src="../../assets/images/food/bunvit.png" alt="">
                   <div class="content_food">
                       <a href="https://loship.vn/bunvitcothuan?pItem=35782232">Bún Măng Vịt
                    </a>
                    </div>
                    <div class="price">
                        <p>40 000đ</p>
                    </div>
                </div>
                <div>
                    <img class="img" src="../../assets/images/food/bunthai.jpeg" alt="">
                   <div class="content_food">
                    <a href="https://loship.vn/buncaythai2thuannguyenthaihoc?pItem=59493316">Bún Cay Hải Sản
                    </a>
                   </div>
                    <div class="price">
                        <p>43 000đ</p>
                    </div>
                </div>
            </div>
            <div class="food-container">
                <div>
                    <img class="img" src="../../assets/images/food/micaykimchi.jpeg" alt="">
                    <div class="content_food">
                        <a href="https://loship.vn/micaysasinhoaphuong?pItem=61499525">Combo Mì Kim Chi Bạch Tuộc + Nước Ngọt - 1 Phần
                        </a>
                    </div>
                    <div class="price">
                        <p>68 000đ</p>
                    </div>
                </div>
                <div>
                    <img class="img" src="../../assets/images/food/mibo.jpeg" alt="">
                   <div class="content_food">
                    <a href="https://loship.vn/micaysasinhoaphuong?pItem=61499524">Combo Mì Kim Chi Bò + Coca - 1 Phần
                    </a>
                   </div>
                    <div class="price">
                        <p>68 000đ</p>
                    </div>
                </div>
                <div>
                    <img class="img" src="../../assets/images/food/mitom.jpeg" alt="">
                    <div class="content_food">
                        <a href="https://loship.vn/micaysasinhoaphuong?pItem=61499521">Combo Mì Kim Chi Hải Sản + Coca-Cola - 1 Phần
                        </a>
                    </div>
                    <div class="price">
                        <p>68 000đ</p>
                    </div>
                </div>
                <div>
                    <img class="img" src="../../assets/images/food/mikimchi.jpeg" alt="">
                   <div class="content_food">
                       <a href="https://loship.vn/micaysasinhoaphuong?pItem=61499520">Combo Mì Kim Chi Cá + Nước Ngọt - 1 Phần
                    </a>
                    </div>
                    <div class="price">
                        <p>68 000đ</p>
                    </div>
                </div>
                <div>
                    <img class="img" src="../../assets/images/food/mibomy.jpeg" alt="">
                   <div class="content_food">
                    <a href="https://loship.vn/micaysasinhoaphuong?pItem=61499522">Combo Mì Kim Chi Bò Mỹ + Nước Ngọt - 1 Phần
                    </a>
                   </div>
                    <div class="price">
                        <p>68 000đ</p>
                    </div>
                </div>
            </div>
            </div>
            <div id="doChay" class="w3-container city" style="display:none">
              <div class="food-container">
                <div>
                    <img class="img" src="../../assets/images/food/chaonam.jpeg" alt="">
                    <div class="content_food">
                        <a href="https://loship.vn/vyshealthythuanchayeatcleanfoodandjuicelethanhton?pItem=59466889">Cháo Nấm Mối
                        </a>
                    </div>
                    <div class="price">
                        <p>124 000đ</p>
                    </div>
                </div>
                <div>
                    <img class="img" src="../../assets/images/food/comrau.jpeg" alt="">
                   <div class="content_food">
                    <a href="https://loship.vn/vyshealthythuanchayeatcleanfoodandjuicelethanhton?pItem=59466886">Cơm Trộn Nấm Mối & Rau Củ Ngũ Sắc
                    </a>
                   </div>
                    <div class="price">
                        <p>124 000đ</p>
                    </div>
                </div>
                <div>
                    <img class="img" src="../../assets/images/food/duanam.jpeg" alt="">
                    <div class="content_food">
                        <a href="https://loship.vn/vyshealthythuanchayeatcleanfoodandjuicelethanhton?pItem=59466892">Dừa Ấp Nấm Mối
                        </a>
                    </div>
                    <div class="price">
                        <p>124 000đ</p>
                    </div>
                </div>
                <div>
                    <img class="img" src="../../assets/images/food/namxao.jpeg" alt="">
                   <div class="content_food">
                       <a href="https://loship.vn/vyshealthythuanchayeatcleanfoodandjuicelethanhton?pItem=59466885">Nấm Mối Đen Xào Bơ Tỏi
                    </a>
                    </div>
                    <div class="price">
                        <p>124 000đ</p>
                    </div>
                </div>
                <div>
                    <img class="img" src="../../assets/images/food/namnuong.jpeg" alt="">
                   <div class="content_food">
                    <a href="https://loship.vn/vyshealthythuanchayeatcleanfoodandjuicelethanhton?pItem=59466887">Nấm Mối Nướng Hạt Dẻ Cười
                    </a>
                   </div>
                    <div class="price">
                        <p>124 000đ</p>
                    </div>
                </div>
            </div>
            <div class="food-container">
                <div>
                    <img class="img" src="../../assets/images/food/nammuoiot.jpeg" alt="">
                    <div class="content_food">
                        <a href="https://loship.vn/vyshealthythuanchayeatcleanfoodandjuicelethanhton?pItem=59466891">Nấm Mối Nướng Muối Ớt
                        </a>
                    </div>
                    <div class="price">
                        <p>124 000đ</p>
                    </div>
                </div>
                <div>
                    <img class="img" src="../../assets/images/food/namlachuoi.jpeg" alt="">
                   <div class="content_food">
                    <a href="https://loship.vn/vyshealthythuanchayeatcleanfoodandjuicelethanhton?pItem=59466888">Nấm Mối Nướng Lá Chuối - Món Quà Của Đất
                    </a>
                   </div>
                    <div class="price">
                        <p>124 000đ</p>
                    </div>
                </div>
                <div>
                    <img class="img" src="../../assets/images/food/namxaolalot.jpeg" alt="">
                    <div class="content_food">
                        <a href="https://loship.vn/vyshealthythuanchayeatcleanfoodandjuicelethanhton?pItem=59466890">Nấm Mối Xào Lá Lốt
                        </a>
                    </div>
                    <div class="price">
                        <p>124 000đ</p>
                    </div>
                </div>
                <div>
                    <img class="img" src="../../assets/images/food/salat.jpeg" alt="">
                   <div class="content_food">
                       <a href="https://loship.vn/slaai350g?pItem=60997841">Slaai Buddha - Salad Thuần Chay - Free Topping Đậu Hủ Nhật
                    </a>
                    </div>
                    <div class="price">
                        <p>59 000đ</p>
                    </div>
                </div>
                <div>
                    <img class="img" src="../../assets/images/food/comchay.jpeg" alt="">
                   <div class="content_food">
                    <a href="https://loship.vn/nhahangdimai?pItem=105759">Cơm Chiên Rau Củ (Chay)
                    </a>
                   </div>
                    <div class="price">
                        <p>118 000đ</p>
                    </div>
                </div>
            </div>
            <div class="food-container">
                <div>
                    <img class="img" src="../../assets/images/food/rongbien.jpeg" alt="">
                    <div class="content_food">
                        <a href="https://loship.vn/nhahangchaybodengocxanh?pItem=6854470">Canh Rong Biển
                        </a>
                    </div>
                    <div class="price">
                        <p>64 000đ</p>
                    </div>
                </div>
                <div>
                    <img class="img" src="../../assets/images/food/chaonam2.jpeg" alt="">
                   <div class="content_food">
                    <a href="https://loship.vn/nhahangchaybodengocxanh?pItem=6854447">Cháo Nấm
                    </a>
                   </div>
                    <div class="price">
                        <p>64 000đ</p>
                    </div>
                </div>
                <div>
                    <img class="img" src="../../assets/images/food/michay.jpeg" alt="">
                    <div class="content_food">
                        <a href="https://loship.vn/quanchay103?pItem=6947392">Mì Chay
                        </a>
                    </div>
                    <div class="price">
                        <p>54 000đ</p>
                    </div>
                </div>
                <div>
                    <img class="img" src="../../assets/images/food/comnuocdua.jpeg" alt="">
                   <div class="content_food">
                       <a href="https://loship.vn/theracharoommonthai?pItem=37651">Cơm Nước Dừa Chay
                    </a>
                    </div>
                    <div class="price">
                        <p>91 000đ</p>
                    </div>
                </div>
                <div>
                    <img class="img" src="../../assets/images/food/kimchichay.jpeg" alt="">
                   <div class="content_food">
                    <a href="https://loship.vn/theracharoommonthai?pItem=37653">Kim Chi Chay
                    </a>
                   </div>
                    <div class="price">
                        <p>91 000đ</p>
                    </div>
                </div>
            </div>
            </div>
            <div id="trangMieng" class="w3-container city" style="display:none">
              <div class="food-container">
                <div>
                    <img class="img" src="../../assets/images/food/raucau.jpeg" alt="">
                    <div class="content_food">
                        <a href="https://loship.vn/trasuaandhacaoxiumai?pItem=17469054">Rau Câu Thập Cẩm
                        </a>
                    </div>
                    <div class="price">
                        <p>35 000đ</p>
                    </div>
                </div>
                <div>
                    <img class="img" src="../../assets/images/food/raucaunho.jpeg" alt="">
                   <div class="content_food">
                    <a href="https://loship.vn/trasuaandhacaoxiumai?pItem=17469053">Rau Câu Nho Nhãn
                    </a>
                   </div>
                    <div class="price">
                        <p>35 000đ</p>
                    </div>
                </div>
                <div>
                    <img class="img" src="../../assets/images/food/raucaudua.jpeg" alt="">
                    <div class="content_food">
                        <a href="https://loship.vn/trasuaandhacaoxiumai?pItem=17469051">Rau Câu Cốt Dừa
                        </a>
                    </div>
                    <div class="price">
                        <p>35 000đ</p>
                    </div>
                </div>
                <div>
                    <img class="img" src="../../assets/images/food/flan.jpeg" alt="">
                   <div class="content_food">
                       <a href="https://loship.vn/trasuaandhacaoxiumai?pItem=35899363">Bánh Flan Sữa Tươi 5 Bánh
                    </a>
                    </div>
                    <div class="price">
                        <p>60 000đ</p>
                    </div>
                </div>
                <div>
                    <img class="img" src="../../assets/images/food/raucauflan.jpeg" alt="">
                   <div class="content_food">
                    <a href="https://loship.vn/trasuaandhacaoxiumai?pItem=36989805">Rau Câu Nhân Flan
                    </a>
                   </div>
                    <div class="price">
                        <p>35 000đ</p>
                    </div>
                </div>
            </div>

            <div class="food-container">
                <div>
                    <img class="img" src="../../assets/images/food/chedauxanh.jpeg" alt="">
                    <div class="content_food">
                        <a href="https://loship.vn/chenambobepdamay?pItem=60320004">Chè Đậu Xanh Đánh - 1 Ly
                        </a>
                    </div>
                    <div class="price">
                        <p>25 000đ</p>
                    </div>
                </div>
                <div>
                    <img class="img" src="../../assets/images/food/chedaudo.jpeg" alt="">
                   <div class="content_food">
                    <a href="https://loship.vn/chenambobepdamay?pItem=60320005">Chè Đậu Đỏ - 1 Ly
                    </a>
                   </div>
                    <div class="price">
                        <p>25 000đ</p>
                    </div>
                </div>
                <div>
                    <img class="img" src="../../assets/images/food/chedauvang.jpeg" alt="">
                    <div class="content_food">
                        <a href="https://loship.vn/chenambobepdamay?pItem=60320008">Chè Đậu Đà Lạt - 1 Ly
                        </a>
                    </div>
                    <div class="price">
                        <p>25 000đ</p>
                    </div>
                </div>
                <div>
                    <img class="img" src="../../assets/images/food/chedauxanhbanhlot.jpeg" alt="">
                   <div class="content_food">
                       <a href="https://loship.vn/trasuatencent?pItem=62243597">Chè Đậu Xanh Bánh Lọt - 1 Ly
                    </a>
                    </div>
                    <div class="price">
                        <p>25 000đ</p>
                    </div>
                </div>
                <div>
                    <img class="img" src="../../assets/images/food/traicaytuoi.jpeg" alt="">
                   <div class="content_food">
                    <a href="https://loship.vn/kemboandtraicayto251nguyenthiminhkhai?pItem=63176053">Kem Trái Cây
                    </a>
                   </div>
                    <div class="price">
                        <p>31 000đ</p>
                    </div>
                </div>
            </div>
            <div class="food-container">
                <div>
                    <img class="img" src="../../assets/images/food/suasaurieng.jpeg" alt="">
                    <div class="content_food">
                        <a href="https://loship.vn/kemboandtraicayto251nguyenthiminhkhai?pItem=63176050">Kem Bơ Sầu Riêng
                        </a>
                    </div>
                    <div class="price">
                        <p>36 000đ</p>
                    </div>
                </div>
                <div>
                    <img class="img" src="../../assets/images/food/traicayto.jpeg" alt="">
                   <div class="content_food">
                    <a href="https://loship.vn/kemboandtraicayto251nguyenthiminhkhai?pItem=63176054">Trái Cây Tô Lớn Sầu Riêng
                    </a>
                   </div>
                    <div class="price">
                        <p>64 000đ</p>
                    </div>
                </div>
                <div>
                    <img class="img" src="../../assets/images/food/traicay12mon.jpeg" alt="">
                    <div class="content_food">
                        <a href="https://loship.vn/kemboandtraicayto251nguyenthiminhkhai?pItem=63176057">Trái Cây Tô 12 Món
                        </a>
                    </div>
                    <div class="price">
                        <p>27 000đ</p>
                    </div>
                </div>
                <div>
                    <img class="img" src="../../assets/images/food/traicaytosaurieng.jpeg" alt="">
                   <div class="content_food">
                       <a href="https://loship.vn/trasuatencent?pItem=62243537">Trái Cây Tô Sầu Riêng
                    </a>
                    </div>
                    <div class="price">
                        <p>32 000đ</p>
                    </div>
                </div>
                <div>
                    <img class="img" src="../../assets/images/food/kemboduatuoi.jpeg" alt="">
                   <div class="content_food">
                    <a href="https://loship.vn/kemboandtraicayto251nguyenthiminhkhai?pItem=63176052">Kem Bơ Dừa Khô + Tươi
                    </a>
                   </div>
                    <div class="price">
                        <p>31 000đ</p>
                    </div>
                </div>
            </div>
            </div>
          </div>

        </div>
    </div>
    <footer class="footer">
      <div class="container">
        <div class="footer-container">
          <div class="footer-column">
            <a href="index.html" class="footer-logo">
              <img srcset="../../assets/images/main-images/logo.png 2x" alt="" />
            </a>
            <p class="footer-desc text">Yêu là phải nói, đói là phải ăn, gọi FatMe thật nhanh, giao tận tay khách</p>
            <div class="social">
              <a href="#" class="social-item">
                <img srcset="../../assets/images/main-images/facebook.png 2x" alt="" />
              </a>
              <a href="#" class="social-item">
                <img srcset="../../assets/images/main-images/twitter.png 2x" alt="" />
              </a>
              <a href="#" class="social-item">
                <img srcset="../../assets/images/main-images/instagram.png 2x" alt="" />
              </a>
              <a href="#" class="social-item">
                <img srcset="../../assets/images/main-images/apple.png 2x" alt="" />
              </a>
            </div>
          </div>
          <div class="footer-column">
            <h3 class="footer-heading heading-small">Dịch vụ</h3>
            <ul class="footer-links">
              <li class="footer-item">
                <a href="#" class="footer-link">Tên dịch vụ</a>
              </li>
              <li class="footer-item">
                <a href="#" class="footer-link">Tên dịch vụ</a>
              </li>
              <li class="footer-item">
                <a href="#" class="footer-link">Tên dịch vụ</a>
              </li>
              <li class="footer-item">
                <a href="#" class="footer-link">Tên dịch vụ</a>
              </li>
              <li class="footer-item">
                <a href="#" class="footer-link">Tên dịch vụ</a>
              </li>
            </ul>
          </div>
          <div class="footer-column">
            <h3 class="footer-heading heading-small">Món ăn</h3>
            <ul class="footer-links">
              <li class="footer-item">
                <a href="#" class="footer-link">Làm gì đó</a>
              </li>
              <li class="footer-item">
                <a href="#" class="footer-link">Làm gì đó</a>
              </li>
              <li class="footer-item">
                <a href="#" class="footer-link">Làm gì đó</a>
              </li>
              <li class="footer-item">
                <a href="#" class="footer-link">Làm gì đó</a>
              </li>
              <li class="footer-item">
                <a href="#" class="footer-link">Làm gì đó</a>
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
    <!-- script -->
    <script src="../../assets/js/main.js"></script>
    <script src="../../assets/js/food.js"></script>
  </body>
</html>
