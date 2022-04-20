<?php
include'../connect/connect.php';
if (!empty($_SESSION['email'])){
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
    if (isset($_POST['mua1'])){ 
      $TENMONAN='Khai Vị Tam Hợp';
      $GIA='235000'; $THELOAI='Khai Vị'; 
      $IMAGE='khaivitamhop.jpg'; 
      $SOLUONG=$_POST['SL1']; 
      $sql="INSERT INTO giohang(email_khachhang,IMAGE,TENMONAN,GIA,THELOAI,SOLUONG) VALUES('$email','$IMAGE','$TENMONAN','$GIA','$THELOAI','$SOLUONG');";
      $query=mysqli_query($conn,$sql); 
    } 
    if (isset($_POST['tim1'])){ 
      $TENMONAN='Khai Vị Tam Hợp'; $GIA='235000';
      $THELOAI='Khai Vị'; $IMAGE='khaivitamhop.jpg'; 
      $sql="SELECT *FROM yeuthich WHERE email_khachhang='$email'AND TENMONAN='$TENMONAN'"; 
      $query=mysqli_query($conn,$sql);
      $check=mysqli_num_rows($query); 
      if ($check==0){ 
        $sql="INSERT INTO yeuthich(email_khachhang,IMAGE,TENMONAN,GIA,THELOAI) VALUES('$email','$IMAGE','$TENMONAN','$GIA','$THELOAI');"; 
        $query=mysqli_query($conn,$sql); 
      }else {
        header("location:index.php"); 
      } 
    } 
    if (isset($_POST['mua2'])){ 
      $TENMONAN='Pizza Hải Sản Sốt Tiêu Đen'; 
      $GIA='69000'; 
      $THELOAI='Pizza'; 
      $IMAGE='pizza.jpeg'; 
      $SOLUONG=$_POST['SL2']; 
      $sql="INSERT INTO giohang(email_khachhang,IMAGE,TENMONAN,GIA,THELOAI,SOLUONG) VALUES('$email','$IMAGE','$TENMONAN','$GIA','$THELOAI','$SOLUONG');";
      $query=mysqli_query($conn,$sql); 
    } 
    if (isset($_POST['tim2'])){ 
      $TENMONAN='Pizza Hải Sản Sốt Tiêu Đen'; 
      $GIA='69000'; 
      $THELOAI='Pizza'; 
      $IMAGE='pizza.jpeg'; 
      $sql="SELECT *FROM yeuthich WHERE email_khachhang='$email'AND TENMONAN='$TENMONAN'"; $query=mysqli_query($conn,$sql);
      $check=mysqli_num_rows($query); 
      if ($check==0){ 
        $sql="INSERT INTO yeuthich(email_khachhang,IMAGE,TENMONAN,GIA,THELOAI) VALUES('$email','$IMAGE','$TENMONAN','$GIA','$THELOAI');"; 
        $query=mysqli_query($conn,$sql); 
      }else {
        header("location:index.php"); 
      } 
    } if (isset($_POST['mua3'])){ 
      $TENMONAN='Jollibee - 02 miếng gà giòn vui vẻ + 01 ly pepsi thường + tặng 1 lon pepsi blackpink'; 
      $GIA='139000'; 
      $THELOAI='Thức ăn nhanh';
      $IMAGE='gavuive.jpeg'; 
      $SOLUONG=$_POST['SL3']; 
      $sql="INSERT INTO giohang(email_khachhang,IMAGE,TENMONAN,GIA,THELOAI,SOLUONG) VALUES('$email','$IMAGE','$TENMONAN','$GIA','$THELOAI','$SOLUONG');";
      $query=mysqli_query($conn,$sql); 
    } 
    if (isset($_POST['tim3'])){ 
      $TENMONAN='Jollibee - 02 miếng gà giòn vui vẻ + 01 ly pepsi thường + tặng 1 lon pepsi blackpink'; 
      $GIA='139000'; 
      $THELOAI='Thức ăn nhanh'; 
      $IMAGE='gavuive.jpeg'; 
      $sql="SELECT *FROM yeuthich WHERE email_khachhang='$email'AND TENMONAN='$TENMONAN'"; $query=mysqli_query($conn,$sql); 
      $check=mysqli_num_rows($query);
      if($check==0){ 
        $sql="INSERT INTO yeuthich(email_khachhang,IMAGE,TENMONAN,GIA,THELOAI) VALUES('$email','$IMAGE','$TENMONAN','$GIA','$THELOAI');"; 
        $query=mysqli_query($conn,$sql); 
      }else {
        header("location:index.php"); 
      } 
    } if (isset($_POST['mua4'])){ 
      $TENMONAN='Combo Lộc Phúc';
      $GIA='86000'; 
      $THELOAI='Thức ăn nhanh'; 
      $IMAGE='phucloc.png'; 
      $SOLUONG=$_POST['SL4']; 
      $sql="INSERT INTO giohang(email_khachhang,IMAGE,TENMONAN,GIA,THELOAI,SOLUONG) VALUES('$email','$IMAGE','$TENMONAN','$GIA','$THELOAI','$SOLUONG');";
      $query=mysqli_query($conn,$sql); 
    } 
    if (isset($_POST['tim4'])){
      $TENMONAN='Combo Lộc Phúc';
      $GIA='86000'; 
      $THELOAI='Thức ăn nhanh'; 
      $IMAGE='phucloc.png'; 
        $sql="SELECT *FROM yeuthich WHERE email_khachhang='$email'AND TENMONAN='$TENMONAN'"; $query=mysqli_query($conn,$sql);
      $check=mysqli_num_rows($query); 
      if ($check==0){ $sql="INSERT INTO yeuthich(email_khachhang,IMAGE,TENMONAN,GIA,THELOAI)VALUES('$email','$IMAGE','$TENMONAN','$GIA','$THELOAI');"; $query=mysqli_query($conn,$sql); 
      }else {
        header("location:index.php"); 
      } 
    } 
    if (isset($_POST['mua5'])){
      $TENMONAN='1 Burger bò Teriyaki trứng + 1 Mì Ý + 1 Khoai Tây Chiên + 1 Pepsi'; $GIA='79000'; 
      $THELOAI='Thức ăn nhanh';
      $IMAGE='burger.png'; 
      $SOLUONG=$_POST['SL4']; 
      $sql="INSERT INTO giohang(email_khachhang,IMAGE,TENMONAN,GIA,THELOAI,SOLUONG) VALUES('$email','$IMAGE','$TENMONAN','$GIA','$THELOAI','$SOLUONG');";
      $query=mysqli_query($conn,$sql); 
    } 
    if (isset($_POST['tim5'])){
      $TENMONAN='1 Burger bò Teriyaki trứng + 1 Mì Ý + 1 Khoai Tây Chiên + 1 Pepsi'; $GIA='79000'; 
      $THELOAI='Thức ăn nhanh';
      $IMAGE='burger.png'; 
        $sql="SELECT *FROM yeuthich WHERE email_khachhang='$email'AND TENMONAN='$TENMONAN'"; $query=mysqli_query($conn,$sql);
      $check=mysqli_num_rows($query); 
      if($check==0){
        $sql="INSERT INTO yeuthich(email_khachhang,IMAGE,TENMONAN,GIA,THELOAI) VALUES('$email','$IMAGE','$TENMONAN','$GIA','$THELOAI');"; 
        $query=mysqli_query($conn,$sql); 
      }else {
        header("location:index.php"); 
      } 
    } 
    if (isset($_POST['mua6'])){
      $TENMONAN='1 Gà Sốt Trứng Muối + 1 Pepsi'; $GIA='36000'; $THELOAI='Thức ăn nhanh'; $IMAGE='gatrungmuoi.png'; 
      $SOLUONG=$_POST['SL6'];
      $sql="INSERT INTO giohang(email_khachhang,IMAGE,TENMONAN,GIA,THELOAI,SOLUONG) VALUES('$email','$IMAGE','$TENMONAN','$GIA','$THELOAI','$SOLUONG');";
      $query=mysqli_query($conn,$sql); 
    } 
    if (isset($_POST['tim6'])){
      $TENMONAN='1 Gà Sốt Trứng Muối + 1 Pepsi'; $GIA='36000'; 
      $THELOAI='Thức ăn nhanh'; 
      $IMAGE='gatrungmuoi.png'; 
      $sql="SELECT *FROM yeuthich WHERE email_khachhang='$email'AND TENMONAN='$TENMONAN'"; $query=mysqli_query($conn,$sql);
      $check=mysqli_num_rows($query); 
      if ($check==0){ 
        $sql="INSERT INTO yeuthich(email_khachhang,IMAGE,TENMONAN,GIA,THELOAI) VALUES('$email','$IMAGE','$TENMONAN','$GIA','$THELOAI');"; 
        $query=mysqli_query($conn,$sql); 
      }else {
        header("location:index.php"); 
      } 
    } 
    if (isset($_POST['mua7'])){
      $TENMONAN='Sữa chua Tocotoco';
      $GIA='20000'; 
      $THELOAI='Đồ uống'; 
      $IMAGE='trasuatoco.jpeg'; 
      $SOLUONG=$_POST['SL7']; 
      $sql="INSERT INTO giohang(email_khachhang,IMAGE,TENMONAN,GIA,THELOAI,SOLUONG) VALUES('$email','$IMAGE','$TENMONAN','$GIA','$THELOAI','$SOLUONG');";
      $query=mysqli_query($conn,$sql); 
    } 
    if (isset($_POST['tim7'])){
      $TENMONAN='Sữa chua Tocotoco';
      $GIA='20000'; $THELOAI='Đồ uống'; 
      $IMAGE='trasuatoco.jpeg'; 
      $sql="SELECT *FROM yeuthich WHERE email_khachhang='$email'AND TENMONAN='$TENMONAN'"; $query=mysqli_query($conn,$sql);
      $check=mysqli_num_rows($query); 
      if ($check==0){ 
        $sql="INSERT INTO yeuthich(email_khachhang,IMAGE,TENMONAN,GIA,THELOAI) VALUES('$email','$IMAGE','$TENMONAN','$GIA','$THELOAI');"; 
        $query=mysqli_query($conn,$sql); 
      }else {
        header("location:index.php"); 
      } 
    } 
    if (isset($_POST['mua8'])){
      $TENMONAN='Beefsteak Bò Sốt Tiêu';
      $GIA='70000'; 
      $THELOAI='Beefsteak'; 
      $IMAGE='beefsteak.jpeg'; 
      $SOLUONG=$_POST['SL8']; 
      $sql="INSERT INTO giohang(email_khachhang,IMAGE,TENMONAN,GIA,THELOAI,SOLUONG) VALUES('$email','$IMAGE','$TENMONAN','$GIA','$THELOAI','$SOLUONG');";
      $query=mysqli_query($conn,$sql); 
    } 
    if (isset($_POST['tim8'])){ 
      $TENMONAN='Beefsteak Bò Sốt Tiêu';
      $GIA='70000'; 
      $THELOAI='Beefsteak'; 
      $IMAGE='beefsteak.jpeg'; 
      $sql="SELECT *FROM yeuthich WHERE email_khachhang='$email'AND TENMONAN='$TENMONAN'"; $query=mysqli_query($conn,$sql);
      $check=mysqli_num_rows($query); 
      if ($check==0){ 
        $sql="INSERT INTO yeuthich(email_khachhang,IMAGE,TENMONAN,GIA,THELOAI) VALUES('$email','$IMAGE','$TENMONAN','$GIA','$THELOAI');"; 
        $query=mysqli_query($conn,$sql); 
      }else {
        header("location:index.php"); 
      } 
    } 
    if (isset($_POST['mua9'])){ 
      $TENMONAN='Bánh Bạch Tuộc';
      $GIA='99000'; 
      $THELOAI='Ăn vặt'; 
      $IMAGE='banhbachtuoc.jpeg'; 
      $SOLUONG=$_POST['SL9']; 
      $sql="INSERT INTO giohang(email_khachhang,IMAGE,TENMONAN,GIA,THELOAI,SOLUONG) VALUES('$email','$IMAGE','$TENMONAN','$GIA','$THELOAI','$SOLUONG');";
      $query=mysqli_query($conn,$sql); 
    } 
    if (isset($_POST['tim9'])){
      $TENMONAN='Bánh Bạch Tuộc';
      $GIA='99000'; 
      $THELOAI='Ăn vặt'; 
      $IMAGE='banhbachtuoc.jpeg'; 
      $sql="SELECT *FROM yeuthich WHERE email_khachhang='$email'AND TENMONAN='$TENMONAN'"; $query=mysqli_query($conn,$sql);
      $check=mysqli_num_rows($query); 
      if ($check==0){ 
        $sql="INSERT INTO yeuthich(email_khachhang,IMAGE,TENMONAN,GIA,THELOAI) VALUES('$email','$IMAGE','$TENMONAN','$GIA','$THELOAI');"; 
        $query=mysqli_query($conn,$sql); 
      }else {
        header("location:index.php"); 
      } 
    } 
    if (isset($_POST['mua10'])){
      $TENMONAN='Gà Lá Chanh Tóp Mỡ Ngũ Vị'; 
      $GIA='105000'; 
      $THELOAI='Đồ ăn mặn'; 
      $IMAGE='galachanh.jpeg'; 
      $SOLUONG=$_POST['SL10'];
      $sql="INSERT INTO giohang(email_khachhang,IMAGE,TENMONAN,GIA,THELOAI,SOLUONG) VALUES('$email','$IMAGE','$TENMONAN','$GIA','$THELOAI','$SOLUONG');";
      $query=mysqli_query($conn,$sql); 
    } 
    if (isset($_POST['tim10'])){ 
      $TENMONAN='Gà Lá Chanh Tóp Mỡ Ngũ Vị'; 
      $GIA='105000'; 
      $THELOAI='Đồ ăn mặn'; 
      $IMAGE='galachanh.jpeg'; 
      $sql="SELECT *FROM yeuthich WHERE email_khachhang='$email'AND TENMONAN='$TENMONAN'"; $query=mysqli_query($conn,$sql);
      $check=mysqli_num_rows($query); 
      if ($check==0){ 
        $sql="INSERT INTO yeuthich(email_khachhang,IMAGE,TENMONAN,GIA,THELOAI) VALUES('$email','$IMAGE','$TENMONAN','$GIA','$THELOAI');"; 
        $query=mysqli_query($conn,$sql); 
      }else {
        header("location:index.php"); 
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
    <link rel="stylesheet" href="../assets/css/food/monan.css" />
    <title>FATMe - Món ăn</title>
  </head>
  <body>
    <form action="" method="post" enctype="multipart/form-data">
      <div class="totop">
        <a href="#" class="goto-top"></a>
      </div>
      <div class="wrapper">
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
              <a class="menu-link" href="#">Món ăn</a>
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
                          <div class="dropdown-item-text-price"><?php echo formatMoney1($value['GIA'])?>đ</div>
                        </div>
                        <div class="dropdown-item-right">
                          <a href="xoa_thich.php?id=<?php echo $value['id_monan']?>">
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

        <main>
          <!-- banner -->
          <section class="banner">
            <!-- banner slide top -->
            <div class="banner-slide slider-responsive-banner">
              <div class="banner-list">
                <div class="banner-item">
                  <div class="banner-header">
                    <span
                      class="banner-caption green global-heading global-heading--normal show-on-scroll"
                      >Fresh 100% organic fruits</span
                    >
                    <h2 class="banner-heading global-heading global-heading--big show-on-scroll">
                      Liên kết các cửa hàng với bạn nhanh chóng
                    </h2>
                    <p class="banner-desc global-text show-on-scroll">
                      Hướng đến việc tiện lợi khi ở nhà mà cũng có đồ ăn mọi lúc mọi nơi, chúng tôi
                      sẽ là người giúp các bạn thực hiện việc đó dễ dàng hơn.
                    </p>
                    <a class="button button--dark" href="#!">Xem ngay</a>
                  </div>
                  <div class="banner-image">
                    <img
                      src="https://images.unsplash.com/photo-1567620905732-2d1ec7ab7445?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8Zm9vZHxlbnwwfDF8MHx8&auto=format&fit=crop&w=500&q=60"
                      alt="Banner"
                      class="banner-image-item"
                    />
                  </div>
                </div>
              </div>
              <div class="banner-list">
                <div class="banner-item">
                  <div class="banner-header">
                    <span
                      class="banner-caption green global-heading global-heading--normal show-on-scroll"
                      >Fresh 100% organic fruits</span
                    >
                    <h2 class="banner-heading global-heading global-heading--big show-on-scroll">
                      Liên kết các cửa hàng với bạn nhanh chóng
                    </h2>
                    <p class="banner-desc global-text show-on-scroll">
                      Hướng đến việc tiện lợi khi ở nhà mà cũng có đồ ăn mọi lúc mọi nơi, chúng tôi
                      sẽ là người giúp các bạn thực hiện việc đó dễ dàng hơn.
                    </p>
                    <a class="button button--dark" href="#!">Xem ngay</a>
                  </div>
                  <div class="banner-image">
                    <img
                      src="https://images.unsplash.com/photo-1501959915551-4e8d30928317?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MTR8fGZvb2R8ZW58MHwxfDB8fA%3D%3D&auto=format&fit=crop&w=500&q=60"
                      alt="Banner"
                      class="banner-image-item"
                    />
                  </div>
                </div>
              </div>
              <div class="banner-list">
                <div class="banner-item">
                  <div class="banner-header">
                    <span
                      class="banner-caption green global-heading global-heading--normal show-on-scroll"
                      >Fresh 100% organic fruits</span
                    >
                    <h2 class="banner-heading global-heading global-heading--big show-on-scroll">
                      Liên kết các cửa hàng với bạn nhanh chóng
                    </h2>
                    <p class="banner-desc global-text show-on-scroll">
                      Hướng đến việc tiện lợi khi ở nhà mà cũng có đồ ăn mọi lúc mọi nơi, chúng tôi
                      sẽ là người giúp các bạn thực hiện việc đó dễ dàng hơn.
                    </p>
                    <a class="button button--dark" href="#!">Xem ngay</a>
                  </div>
                  <div class="banner-image">
                    <img
                      src="https://images.unsplash.com/photo-1555939594-58d7cb561ad1?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MTJ8fGZvb2R8ZW58MHwxfDB8fA%3D%3D&auto=format&fit=crop&w=500&q=60"
                      alt="Banner"
                      class="banner-image-item"
                    />
                  </div>
                </div>
              </div>
            </div>
            <!-- banner product -->
            <div class="food-container">
              <div class="banner-product">
                <div class="banner-product-list slider-responsive-banner-list">
                  <div class="banner-product-list-item">
                    <div class="banner-product-item orange-bg">
                      <div class="banner-product-header">
                        <div
                          class="banner-product-sale green global-heading global-heading--normal show-on-scroll"
                        >
                          Giảm giá 30%
                        </div>
                        <div
                          class="banner-product-title global-heading global-heading--normal show-on-scroll"
                        >
                          Grab food
                        </div>
                        <a
                          class="button button--green"
                          href="https://food.grab.com/vn/vi/"
                          target="_blank"
                          >Xem ngay</a
                        >
                      </div>
                      <div class="banner-product-image">
                        <img
                          src="../assets/images/main-images/brand-grab.png"
                          alt="Banner"
                          class="banner-product-image-item"
                        />
                      </div>
                    </div>
                  </div>
                  <div class="banner-product-list-item">
                    <div class="banner-product-item green-bg">
                      <div class="banner-product-header">
                        <div
                          class="banner-product-sale red global-heading global-heading--normal show-on-scroll"
                        >
                          Giảm giá 50%
                        </div>
                        <div
                          class="banner-product-title global-heading global-heading--normal show-on-scroll"
                        >
                          Loship
                        </div>
                        <a class="button button--red" href="https://loship.vn/" target="_blank"
                          >Xem ngay</a
                        >
                      </div>
                      <div class="banner-product-image">
                        <img
                          src="../assets/images/main-images/brand-loship.png"
                          alt="Banner"
                          class="banner-product-image-item"
                        />
                      </div>
                    </div>
                  </div>
                  <div class="banner-product-list-item">
                    <div class="banner-product-item blue-dark-bg">
                      <div class="banner-product-header">
                        <div
                          class="banner-product-sale blue-dark global-heading global-heading--normal show-on-scroll"
                        >
                          Giảm giá 10%
                        </div>
                        <div
                          class="banner-product-title global-heading global-heading--normal show-on-scroll"
                        >
                          Gojek
                        </div>
                        <a
                          class="button button--dark"
                          href="https://www.gojek.com/vn/"
                          target="_blank"
                          >Xem ngay</a
                        >
                      </div>
                      <div class="banner-product-image">
                        <img
                          src="../assets/images/main-images/brand-gojek.png"
                          alt="Banner"
                          class="banner-product-image-item"
                        />
                      </div>
                    </div>
                  </div>
                  <div class="banner-product-list-item">
                    <div class="banner-product-item green-bg">
                      <div class="banner-product-header">
                        <div
                          class="banner-product-sale orange global-heading global-heading--normal show-on-scroll"
                        >
                          Giảm giá 70%
                        </div>
                        <div
                          class="banner-product-title global-heading global-heading--normal show-on-scroll"
                        >
                          Shopee Food
                        </div>
                        <a
                          class="button button--orange"
                          href="https://shopeefood.vn/"
                          target="_blank"
                          >Xem ngay</a
                        >
                      </div>
                      <div class="banner-product-image">
                        <img
                          src="../assets/images/main-images/brand-shopeefood.png"
                          alt="Banner"
                          class="banner-product-image-item"
                        />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
          <!-- end banner -->
          <!-- category -->
          <section class="category" id="category">
            <div class="food-container">
              <div class="food-header">
                <h2
                  class="food-heading global-heading global-food-heading show-on-scroll is-visible"
                >
                  Thể loại
                </h2>
                <div class="food-more">
                  <a href="type_food/type_food.php" class="food-link">Xem thêm</a>
                  <img src="../assets/images/main-images/icon-arrow-right.png" alt="" />
                </div>
              </div>
              <div class="category-list slider-responsive-category-list">
                <div class="category-list-item green-bgfull">
                  <a href="#!">
                    <div class="category-item">
                      <div class="category-item-image">
                        <img
                          src="../assets/images/food/cagetory1.png"
                          alt="Banner"
                          class="category-item-image-item"
                        />
                      </div>
                      <div class="category-item-header">
                        <div class="category-item-special global-text show-on-scroll">Món ngon</div>
                        <div
                          class="category-item-title global-heading global-heading--normal show-on-scroll"
                        >
                          rau củ sạch
                        </div>
                      </div>
                    </div>
                  </a>
                </div>
                <div class="category-list-item orange-bgfull">
                  <a href="#!">
                    <div class="category-item">
                      <div class="category-item-image">
                        <img
                          src="../assets/images/food/cagetory2.png"
                          alt="Banner"
                          class="category-item-image-item"
                        />
                      </div>
                      <div class="category-item-header">
                        <div class="category-item-special global-text show-on-scroll">
                          Bánh ngọt
                        </div>
                        <div
                          class="category-item-title global-heading global-heading--normal show-on-scroll"
                        >
                          Giảm giá 30%
                        </div>
                      </div>
                    </div>
                  </a>
                </div>
                <div class="category-list-item blue-dark-bgfull">
                  <a href="#!">
                    <div class="category-item">
                      <div class="category-item-image">
                        <img
                          src="../assets/images/food/cagetory1.png"
                          alt="Banner"
                          class="category-item-image-item"
                        />
                      </div>
                      <div class="category-item-header">
                        <div class="category-item-special global-text show-on-scroll">
                          Trái cây tươi
                        </div>
                        <div
                          class="category-item-title global-heading global-heading--normal show-on-scroll"
                        >
                          Giảm giá 30%
                        </div>
                      </div>
                    </div>
                  </a>
                </div>
                <div class="category-list-item green-bgfull">
                  <a href="#!">
                    <div class="category-item">
                      <div class="category-item-image">
                        <img
                          src="../assets/images/food/cagetory2.png"
                          alt="Banner"
                          class="category-item-image-item"
                        />
                      </div>
                      <div class="category-item-header">
                        <div class="category-item-special global-text show-on-scroll">
                          Trái cây tươi
                        </div>
                        <div
                          class="category-item-title global-heading global-heading--normal show-on-scroll"
                        >
                          Giảm giá 30%
                        </div>
                      </div>
                    </div>
                  </a>
                </div>
                <div class="category-list-item orange-bgfull">
                  <a href="#!">
                    <div class="category-item">
                      <div class="category-item-image">
                        <img
                          src="https://images.unsplash.com/photo-1557800636-894a64c1696f?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8NXx8ZnJ1aXR8ZW58MHwxfDB8fA%3D%3D&auto=format&fit=crop&w=500&q=60"
                          alt="Banner"
                          class="category-item-image-item"
                        />
                      </div>
                      <div class="category-item-header">
                        <div class="category-item-special global-text show-on-scroll">
                          Trái cây tươi
                        </div>
                        <div
                          class="category-item-title global-heading global-heading--normal show-on-scroll"
                        >
                          Giảm giá 30%
                        </div>
                      </div>
                    </div>
                  </a>
                </div>
              </div>
            </div>
          </section>
          <!-- end category -->
          <!-- product -->
          <section class="product">
            <div class="food-container">
              <div class="food-header">
                <h2
                  class="food-heading global-heading global-food-heading show-on-scroll is-visible"
                >
                  Có thể bạn thích
                </h2>
              </div>
              <div class="product-list slider-responsive-product-list">
                <div class="product-list-item">
                  <a href="./monan1/index.php">
                    <div class="product-item" id="gaga">
                      <div class="product-item-top">
                        <div class="product-item-sale green-bgfull">Mới có</div>
                        <button class="button-heart" name="tim1">
                          <img
                            src="../assets/images/main-images/icon-heart.png"
                            alt=""
                            class="heart"
                          />
                        </button>
                      </div>
                      <div class="product-item-image">
                        <img src="../assets/images/food/khaivitamhop.jpg" alt="" name="IMAGE" />
                      </div>
                      <div class="product-item-name">
                        <div class="product-item-special global-text show-on-scroll">Khai Vị</div>
                        <div
                          class="product-item-title global-heading global-heading--normal show-on-scroll"
                        >
                          Khai Vị Tam Hợp
                        </div>
                      </div>
                      <div class="product-item-price global-heading--normal">
                        <div class="product-item-price-new">
                          <span class="price-new">235.000</span>
                          <span class="price-new-unit">đ</span>
                        </div>
                        <div class="product-item-price-old">
                          <span class="price-old"></span>
                          <span class="price-old-unit"></span>
                        </div>
                      </div>
                      <div class="product-item-bottom">
                        <div class="product-item-number">
                          <div class="buttons_added">
                            <input class="minus is-form" type="button" value="-" />
                            <input
                              aria-label="quantity"
                              class="input-qty"
                              max="10"
                              min="1"
                              name="SL1"
                              type="number"
                              value="1"
                            />
                            <input class="plus is-form" type="button" value="+" />
                          </div>
                        </div>
                        <button class="button-shoppingcart" name="mua1">
                          <img
                            class="product-item-shoppingcart"
                            src="../assets/images/main-images/icon-shoppingcart.png"
                            alt=""
                          />
                        </button>
                      </div>
                    </div>
                  </a>
                </div>
                <div class="product-list-item">
                  <a href="./monan2/index.php">
                    <div class="product-item">
                      <div class="product-item-top">
                        <div class="product-item-sale green-bgfull">Mới có</div>
                        <button class="button-heart" name="tim2">
                          <img
                            src="../assets/images/main-images/icon-heart.png"
                            alt=""
                            class="heart"
                          />
                        </button>
                      </div>
                      <div class="product-item-image">
                        <img src="../assets/images/food/pizza.jpeg" alt="" />
                      </div>
                      <div class="product-item-name">
                        <div class="product-item-special global-text show-on-scroll">Pizza</div>
                        <div
                          class="product-item-title global-heading global-heading--normal show-on-scroll"
                        >
                          Pizza Hải Sản Sốt Tiêu Đen
                        </div>
                      </div>
                      <div class="product-item-price global-heading--normal">
                        <div class="product-item-price-new">
                          <span class="price-new">69.000</span>
                          <span class="price-new-unit">đ</span>
                        </div>
                        <!-- <div class="product-item-price-old">
                          <span class="price-old">1.000.000</span>
                          <span class="price-old-unit">đ</span>
                        </div> -->
                      </div>
                      <div class="product-item-bottom">
                        <div class="product-item-number">
                          <div class="buttons_added">
                            <input class="minus is-form" type="button" value="-" />
                            <input
                              aria-label="quantity"
                              class="input-qty"
                              max="10"
                              min="1"
                              name="SL2"
                              type="number"
                              value="1"
                            />
                            <input class="plus is-form" type="button" value="+" />
                          </div>
                        </div>
                        <button class="button-shoppingcart" name="mua2">
                          <img
                            class="product-item-shoppingcart"
                            src="../assets/images/main-images/icon-shoppingcart.png"
                            alt=""
                          />
                        </button>
                      </div>
                    </div>
                  </a>
                </div>
                <div class="product-list-item">
                  <a href="./monan1/index.php">
                    <div class="product-item">
                      <div class="product-item-top">
                        <div class="product-item-sale">Giảm giá khi mua combo</div>
                        <button class="button-heart" name="tim3">
                          <img
                            src="../assets/images/main-images/icon-heart.png"
                            alt=""
                            class="heart"
                          />
                        </button>
                      </div>
                      <div class="product-item-image">
                        <img
                          style="height: 200px"
                          src="../assets/images/food/gavuive.jpeg"
                          alt=""
                        />
                      </div>
                      <div class="product-item-name">
                        <div class="product-item-special global-text show-on-scroll">
                          Thức ăn nhanh
                        </div>
                        <div
                          class="product-item-title global-heading global-heading--normal show-on-scroll"
                        >
                          Jollibee - 02 miếng gà giòn vui vẻ + 01 ly pepsi thường + tặng 1 lon pepsi
                          blackpink
                        </div>
                      </div>
                      <div class="product-item-price global-heading--normal">
                        <div class="product-item-price-new">
                          <span class="price-new">139 000</span>
                          <span class="price-new-unit">đ</span>
                        </div>
                        <div class="product-item-price-old">
                          <span class="price-old">160 000</span>
                          <span class="price-old-unit">đ</span>
                        </div>
                      </div>
                      <div class="product-item-bottom">
                        <div class="product-item-number">
                          <div class="buttons_added">
                            <input class="minus is-form" type="button" value="-" />
                            <input
                              aria-label="quantity"
                              class="input-qty"
                              max="10"
                              min="1"
                              name="SL3"
                              type="number"
                              value="1"
                            />
                            <input class="plus is-form" type="button" value="+" />
                          </div>
                        </div>
                        <button class="button-shoppingcart" name="mua3">
                          <img
                            class="product-item-shoppingcart"
                            src="../assets/images/main-images/icon-shoppingcart.png"
                            alt=""
                          />
                        </button>
                      </div>
                    </div>
                  </a>
                </div>
                <div class="product-list-item">
                  <a href="./monan1/index.php">
                    <div class="product-item">
                      <div class="product-item-top">
                        <div class="product-item-sale">Giảm giá khi mua combo</div>
                        <button class="button-heart" name="tim4">
                          <img
                            src="../assets/images/main-images/icon-heart.png"
                            alt=""
                            class="heart"
                          />
                        </button>
                      </div>
                      <div class="product-item-image">
                        <img style="height: 200px" src="../assets/images/food/phucloc.png" alt="" />
                      </div>
                      <div class="product-item-name">
                        <div class="product-item-special global-text show-on-scroll">
                          Thức ăn nhanh
                        </div>
                        <div
                          class="product-item-title global-heading global-heading--normal show-on-scroll"
                        >
                          Combo Lộc Phúc
                        </div>
                      </div>
                      <div class="product-item-price global-heading--normal">
                        <div class="product-item-price-new">
                          <span class="price-new">86 000</span>
                          <span class="price-new-unit">đ</span>
                        </div>
                        <div class="product-item-price-old">
                          <span class="price-old">125 000</span>
                          <span class="price-old-unit">đ</span>
                        </div>
                      </div>
                      <div class="product-item-bottom">
                        <div class="product-item-number">
                          <div class="buttons_added">
                            <input class="minus is-form" type="button" value="-" />
                            <input
                              aria-label="quantity"
                              class="input-qty"
                              max="10"
                              min="1"
                              name="SL4"
                              type="number"
                              value="1"
                            />
                            <input class="plus is-form" type="button" value="+" />
                          </div>
                        </div>
                        <button class="button-shoppingcart" name="mua4">
                          <img
                            class="product-item-shoppingcart"
                            src="../assets/images/main-images/icon-shoppingcart.png"
                            alt=""
                          />
                        </button>
                      </div>
                    </div>
                  </a>
                </div>
                <div class="product-list-item">
                  <a href="./monan1/index.php">
                    <div class="product-item">
                      <div class="product-item-top">
                        <div class="product-item-sale">Giảm giá khi mua combo</div>
                        <button class="button-heart" name="tim5">
                          <img
                            src="../assets/images/main-images/icon-heart.png"
                            alt=""
                            class="heart"
                          />
                        </button>
                      </div>
                      <div class="product-item-image">
                        <img style="height: 200px" src="../assets/images/food/burger.png" alt="" />
                      </div>
                      <div class="product-item-name">
                        <div class="product-item-special global-text show-on-scroll">
                          Thức ăn nhanh
                        </div>
                        <div
                          class="product-item-title global-heading global-heading--normal show-on-scroll"
                        >
                          1 Burger bò Teriyaki trứng + 1 Mì Ý + 1 Khoai Tây Chiên + 1 Pepsi
                        </div>
                      </div>
                      <div class="product-item-price global-heading--normal">
                        <div class="product-item-price-new">
                          <span class="price-new">79 000</span>
                          <span class="price-new-unit">đ</span>
                        </div>
                        <div class="product-item-price-old">
                          <span class="price-old">120 000</span>
                          <span class="price-old-unit">đ</span>
                        </div>
                      </div>
                      <div class="product-item-bottom">
                        <div class="product-item-number">
                          <div class="buttons_added">
                            <input class="minus is-form" type="button" value="-" />
                            <input
                              aria-label="quantity"
                              class="input-qty"
                              max="10"
                              min="1"
                              name="SL5"
                              type="number"
                              value="1"
                            />
                            <input class="plus is-form" type="button" value="+" />
                          </div>
                        </div>
                        <button class="button-shoppingcart" name="mua5">
                          <img
                            class="product-item-shoppingcart"
                            src="../assets/images/main-images/icon-shoppingcart.png"
                            alt=""
                          />
                        </button>
                      </div>
                    </div>
                  </a>
                </div>
                <div class="product-list-item">
                  <a href="./monan1/index.php">
                    <div class="product-item">
                      <div class="product-item-top">
                        <div class="product-item-sale">Giảm giá khi mua combo</div>
                        <button class="button-heart" name="tim6">
                          <img
                            src="../assets/images/main-images/icon-heart.png"
                            alt=""
                            class="heart"
                          />
                        </button>
                      </div>
                      <div class="product-item-image">
                        <img
                          style="height: 200px"
                          src="../assets/images/food/gatrungmuoi.png"
                          alt=""
                        />
                      </div>
                      <div class="product-item-name">
                        <div class="product-item-special global-text show-on-scroll">
                          Thức ăn nhanh
                        </div>
                        <div
                          class="product-item-title global-heading global-heading--normal show-on-scroll"
                        >
                          1 Gà Sốt Trứng Muối + 1 Pepsi
                        </div>
                      </div>
                      <div class="product-item-price global-heading--normal">
                        <div class="product-item-price-new">
                          <span class="price-new">36 000</span>
                          <span class="price-new-unit">đ</span>
                        </div>
                        <div class="product-item-price-old">
                          <span class="price-old">39 000</span>
                          <span class="price-old-unit">đ</span>
                        </div>
                      </div>
                      <div class="product-item-bottom">
                        <div class="product-item-number">
                          <div class="buttons_added">
                            <input class="minus is-form" type="button" value="-" />
                            <input
                              aria-label="quantity"
                              class="input-qty"
                              max="10"
                              min="1"
                              name="SL6"
                              type="number"
                              value="1"
                            />
                            <input class="plus is-form" type="button" value="+" />
                          </div>
                        </div>
                        <button class="button-shoppingcart" name="mua6">
                          <img
                            class="product-item-shoppingcart"
                            src="../assets/images/main-images/icon-shoppingcart.png"
                            alt=""
                          />
                        </button>
                      </div>
                    </div>
                  </a>
                </div>
                <div class="product-list-item">
                  <a href="./monan1/index.php">
                    <div class="product-item">
                      <div class="product-item-top">
                        <div class="product-item-sale">Giảm giá 50%</div>
                        <button class="button-heart" name="tim7">
                          <img
                            src="../assets/images/main-images/icon-heart.png"
                            alt=""
                            class="heart"
                          />
                        </button>
                      </div>
                      <div class="product-item-image">
                        <img
                          style="height: 200px"
                          src="../assets/images/food/trasuatoco.jpeg"
                          alt=""
                        />
                      </div>
                      <div class="product-item-name">
                        <div class="product-item-special global-text show-on-scroll">Đồ uống</div>
                        <div
                          class="product-item-title global-heading global-heading--normal show-on-scroll"
                        >
                          Sữa chua Tocotoco
                        </div>
                      </div>
                      <div class="product-item-price global-heading--normal">
                        <div class="product-item-price-new">
                          <span class="price-new">20 000</span>
                          <span class="price-new-unit">đ</span>
                        </div>
                        <div class="product-item-price-old">
                          <span class="price-old">40 000</span>
                          <span class="price-old-unit">đ</span>
                        </div>
                      </div>
                      <div class="product-item-bottom">
                        <div class="product-item-number">
                          <div class="buttons_added">
                            <input class="minus is-form" type="button" value="-" />
                            <input
                              aria-label="quantity"
                              class="input-qty"
                              max="10"
                              min="1"
                              name="SL7"
                              type="number"
                              value="1"
                            />
                            <input class="plus is-form" type="button" value="+" />
                          </div>
                        </div>
                        <button class="button-shoppingcart" name="mua7">
                          <img
                            class="product-item-shoppingcart"
                            src="../assets/images/main-images/icon-shoppingcart.png"
                            alt=""
                          />
                        </button>
                      </div>
                    </div>
                  </a>
                </div>
              </div>
            </div>
          </section>
          <section class="product-2">
            <div class="food-container">
              <div class="food-header">
                <h2
                  class="food-heading global-heading global-food-heading show-on-scroll is-visible"
                >
                  Mọi người ăn gì?
                </h2>
              </div>
              <div class="product-list slider-responsive-product-list">
                <div class="product-list-item">
                  <div class="product-item">
                    <div class="product-item-top">
                      <div class="product-item-sale green-bgfull">Đang hot</div>
                      <button class="button-heart" name="tim8">
                        <img
                          src="../assets/images/main-images/icon-heart.png"
                          alt=""
                          class="heart"
                        />
                      </button>
                    </div>
                    <div class="product-item-image">
                      <img src="../assets/images/food/beefsteak.jpeg" alt="" />
                    </div>
                    <div class="product-item-name">
                      <div class="product-item-special global-text show-on-scroll">Beefsteak</div>
                      <div
                        class="product-item-title global-heading global-heading--normal show-on-scroll"
                      >
                        Beefsteak Bò Sốt Tiêu
                      </div>
                    </div>
                    <div class="product-item-price global-heading--normal">
                      <div class="product-item-price-new">
                        <span class="price-new">70.000</span>
                        <span class="price-new-unit">đ</span>
                      </div>
                      <!-- <div class="product-item-price-old">
                        <span class="price-old">1.000.000</span>
                        <span class="price-old-unit">đ</span>
                      </div> -->
                    </div>
                    <div class="product-item-bottom">
                      <div class="product-item-number">
                        <div class="buttons_added">
                          <input class="minus is-form" type="button" value="-" />
                          <input
                            aria-label="quantity"
                            class="input-qty"
                            max="10"
                            min="1"
                            name="SL8"
                            type="number"
                            value="1"
                          />
                          <input class="plus is-form" type="button" value="+" />
                        </div>
                      </div>
                      <button class="button-shoppingcart" name="mua8">
                        <img
                          class="product-item-shoppingcart"
                          src="../assets/images/main-images/icon-shoppingcart.png"
                          alt=""
                        />
                      </button>
                    </div>
                  </div>
                </div>
                <div class="product-list-item">
                  <div class="product-item">
                    <div class="product-item-top">
                      <div class="product-item-sale green-bgfull">Đang hot</div>
                      <button class="button-heart" name="tim9">
                        <img
                          src="../assets/images/main-images/icon-heart.png"
                          alt=""
                          class="heart"
                        />
                      </button>
                    </div>
                    <div class="product-item-image">
                      <img src="../assets/images/food/banhbachtuoc.jpeg" alt="" />
                    </div>
                    <div class="product-item-name">
                      <div class="product-item-special global-text show-on-scroll">Ăn vặt</div>
                      <div
                        class="product-item-title global-heading global-heading--normal show-on-scroll"
                      >
                        Bánh Bạch Tuộc
                      </div>
                    </div>
                    <div class="product-item-price global-heading--normal">
                      <div class="product-item-price-new">
                        <span class="price-new">99.000</span>
                        <span class="price-new-unit">đ</span>
                      </div>
                      <!-- <div class="product-item-price-old">
                        <span class="price-old">1.000.000</span>
                        <span class="price-old-unit">đ</span>
                      </div> -->
                    </div>
                    <div class="product-item-bottom">
                      <div class="product-item-number">
                        <div class="buttons_added">
                          <input class="minus is-form" type="button" value="-" />
                          <input
                            aria-label="quantity"
                            class="input-qty"
                            max="10"
                            min="1"
                            name="SL9"
                            type="number"
                            value="1"
                          />
                          <input class="plus is-form" type="button" value="+" />
                        </div>
                      </div>
                      <button class="button-shoppingcart" name="mua9">
                        <img
                          class="product-item-shoppingcart"
                          src="../assets/images/main-images/icon-shoppingcart.png"
                          alt=""
                        />
                      </button>
                    </div>
                  </div>
                </div>
                <div class="product-list-item">
                  <div class="product-item">
                    <div class="product-item-top">
                      <!-- <div class="product-item-sale">Giảm giá <span class="percent">50</span>%</div> -->
                      <button class="button-heart" name="tim10">
                        <img
                          src="../assets/images/main-images/icon-heart.png"
                          alt=""
                          class="heart"
                        />
                      </button>
                    </div>
                    <div class="product-item-image">
                      <img src="../assets/images/food/galachanh.jpeg" alt="" />
                    </div>
                    <div class="product-item-name">
                      <div class="product-item-special global-text show-on-scroll">Đồ ăn mặn</div>
                      <div
                        class="product-item-title global-heading global-heading--normal show-on-scroll"
                      >
                        Gà Lá Chanh Tóp Mỡ Ngũ Vị
                      </div>
                    </div>
                    <div class="product-item-price global-heading--normal">
                      <div class="product-item-price-new">
                        <span class="price-new">105.000</span>
                        <span class="price-new-unit">đ</span>
                      </div>
                      <!-- <div class="product-item-price-old">
                        <span class="price-old">1.000.000</span>
                        <span class="price-old-unit">đ</span>
                      </div> -->
                    </div>
                    <div class="product-item-bottom">
                      <div class="product-item-number">
                        <div class="buttons_added">
                          <input class="minus is-form" type="button" value="-" />
                          <input
                            aria-label="quantity"
                            class="input-qty"
                            max="10"
                            min="1"
                            name="SL10"
                            type="number"
                            value="1"
                          />
                          <input class="plus is-form" type="button" value="+" />
                        </div>
                      </div>
                      <button class="button-shoppingcart" name="mua10">
                        <img
                          class="product-item-shoppingcart"
                          src="../assets/images/main-images/icon-shoppingcart.png"
                          alt=""
                        />
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
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
        </main>
      </div>
      <!-- footer -->
      <footer class="footer">
        <div class="container">
          <div class="footer-container">
            <div class="footer-column">
              <a href="#" class="footer-logo">
                <img srcset="../assets/images/main-images/logo.png 2x" alt="" />
              </a>
              <p class="footer-desc text">
                Yêu là phải nói, đói là phải ăn, gọi FatMe thật nhanh, giao tận tay khách
              </p>
              <div class="social">
                <a
                  href="https://www.facebook.com/FootAtTheMoment/"
                  target="_blank"
                  class="social-item"
                >
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
      <script src="../assets/js/main.js"></script>
      <script src="../assets/js/food.js"></script>
    </form>
  </body>
</html>
