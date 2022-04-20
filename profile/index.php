<?php
include'../connect/connect.php';
if(empty($_SESSION['email'])){
  header("location: ../login/index.php");
}else {
  $email=$_SESSION['email'];
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

  $sql="SELECT * FROM khachhang WHERE email='$email'";
  $query=mysqli_query($conn,$sql);
  $taikhoan= mysqli_fetch_assoc($query);

  if (isset($_POST['account'])){
    require_once("index.php");
  }
  if (isset($_POST['luu'])){
    $HOTEN=$_POST['HOTEN'];
    $CMND=$_POST['CMND'];
    $day=$_POST['day'];
    $month=$_POST['month'];
    $year=$_POST['year'];
    $SODIENTHOAI=$_POST['SODIENTHOAI'];
    $MOTA=$_POST['MOTA'];
    $email=$_SESSION['email'];
    $sql="UPDATE khachhang SET HOTEN='$HOTEN',CMND='$CMND',NGAY='$day',THANG='$month',NAM='$year',SODIENTHOAI='$SODIENTHOAI',MOTA='$MOTA' WHERE email='$email'";
    $query=mysqli_query($conn,$sql);
    if ($query==false){
      echo "lỗi";
    }else {
      header("location:index.php");
    }
  }
  if (isset($_POST['thaydoi'])){
    $error='';
    $old=md5($_POST['old']);
    $new=md5($_POST['new']);
    $renew=md5($_POST['renew']);
    if(empty($old)){
      $error='Bạn chưa nhập mật khẩu cũ';
    } else if(empty($new)){
      $error='Bạn chưa nhập mật khẩu mới';
    }else if($new!=$renew){
      $error='Mật khẩu nhập lại không đúng';
    } else if ($old!=$taikhoan['password']){
      $error='Mật khẩu cũ không đúng';
    }else if (!empty($error)){

    }
    else if (empty($error)){
      $sql="UPDATE khachhang SET password= '$new' WHERE email='$email'";
      $query=mysqli_query($conn,$sql);
      if ($query){
        header("location:index.php");
      }
    }
  }else if (isset($_POST['huy'])){
    header("location:index.php");
  }
}

?>




<html>
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="./images/images-main/logo-main.png" type="image/x-icon" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />

    <link
      rel="stylesheet"
      href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
      crossorigin="anonymous"
    />

    <link
      href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600;1,700&display=swap"
      rel="stylesheet"
    />
    <!-- css link -->
    <!-- CSS only -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/css/bootstrap.min.css"
    />
    <!-- JavaScript Bundle with Popper -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      crossorigin="anonymous"
    ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css"
    />
    <!-- my css -->
    <link rel="stylesheet" href="./css/app.css" />
    <link rel="stylesheet" href="../assets/css/main-page/app.css" />
    <link rel="stylesheet" href="../assets/css/profile/profile.css">
    <title>FATMe - Blog</title>
  </head>
  <body>
    <form action=""method="post">
    <div class="totop">
      <a
        href="#"
        class="goto-top"
        style="
          background: url(./images/images-main/gototop.svg) no-repeat center,
            linear-gradient(45deg, #f67102 5.1%, #f4a91e 86.29%);
        "
      ></a>
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
                    <a class="auth-user-dropdown-link" href="#!">Tài khoản</a>
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
            ><img src="../assets/images/main-images/menu.png" alt="Menu"
          /></label>
          <label for="toggle-check" class="overlay"></label>
        </div>

      </header>

      <section class="">
        <div class="container">
          <h1 class="mb-5">Account Settings</h1>
          <div class="bg-white shadow rounded-lg d-block d-sm-flex">
            <div class="profile-tab-nav border-right">
              <div class="p-4">
                <div class="img-circle text-center mb-3">
                  <img src="./images/anh-tho-cute-dang-yeu.jpg" alt="Image" class="shadow" style="margin-left:28%" />

                </div>
                <h4 class="text-center"><?php if ($taikhoan['HOTEN']=="USER OF FATME") { echo "Chưa có tên gì hết nè !";}else {echo $taikhoan['HOTEN']; }?></h4>
              </div>
              <div
                class="nav flex-column nav-pills"
                id="v-pills-tab"
                role="tablist"
                aria-orientation="vertical"
              >
                <a
                  class="nav-link active"
                  id="account-tab"
                  data-toggle="pill"
                  href="#account"
                  role="tab"
                  aria-controls="account"
                  aria-selected="true"
                >
                  <i class="fa fa-home text-center mr-1"></i>
                  Thông tin của bạn
                </a>
                <a
                  class="nav-link"
                  id="password-tab"
                  data-toggle="pill"
                  href="#password"
                  role="tab"
                  aria-controls="password"
                  aria-selected="false"
                >
                  <i class="fa fa-key text-center mr-1"></i>
                  Quản lý mật khẩu
                </a>
                <a
                  class="nav-link"
                  id="security-tab"
                  data-toggle="pill"
                  href="#security"
                  role="tab"
                  aria-controls="security"
                  aria-selected="false"
                >
                <i class="fas fa-map-marker-alt"></i>
                  Quản lý địa chỉ
                </a>


              </div>
            </div>
            <div class="tab-content p-4 p-md-5" id="v-pills-tabContent">
              <div
                class="tab-pane fade show active"
                id="account"
                role="tabpanel"
                aria-labelledby="account-tab"
              >
                <h3 class="mb-4">Thông tin tài khoản</h3>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Họ & Tên </label>
                      <input type="text" class="form-control" name="HOTEN" value="<?php echo$taikhoan['HOTEN']?>" />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>CMND/CCCD</label>
                      <input type="text" name="CMND"class="form-control" value="<?php echo$taikhoan['CMND']?>" />
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <select name="day" id="" class="form-control">
                        <option value="1">Ngày 1</option>
                        <option value="2">Ngày 2</option>
                        <option value="3">Ngày 3</option>
                        <option value="4">Ngày 4</option>
                        <option value="5">Ngày 5</option>
                        <option value="6">Ngày 6</option>
                        <option value="7">Ngày 7</option>
                        <option value="8">Ngày 8</option>
                        <option value="9">Ngày 9</option>
                        <option value="9">Ngày 9</option>
                        <option value="9">Ngày 9</option>
                        <option value="9">Ngày 9</option>
                        <option value="9">Ngày 9</option>
                        <option value="9">Ngày 9</option>
                        <option value="9">Ngày 9</option>
                        <option value="10">Ngày 10</option>
                        <option value="11">Ngày 11</option>
                        <option value="12">Ngày 12</option>
                        <option value="13">Ngày 13</option>
                        <option value="14">Ngày 14</option>
                        <option value="15">Ngày 15</option>
                        <option value="16">Ngày 16</option>
                        <option value="17">Ngày 17</option>
                        <option value="18">Ngày 18</option>
                        <option value="19">Ngày 19</option>
                        <option value="20">Ngày 20</option>
                        <option value="21">Ngày 21</option>
                        <option value="22">Ngày 22</option>
                        <option value="23">Ngày 23</option>
                        <option value="24">Ngày 24</option>
                        <option value="25">Ngày 25</option>
                        <option value="26">Ngày 26</option>
                        <option value="27">Ngày 27</option>
                        <option value="28">Ngày 28</option>
                        <option value="29">Ngày 29</option>
                        <option value="30">Ngày 30</option>
                        <option value="31">Ngày 31</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <select name="month" id="" class="form-control">
                        <option value="1">Tháng 1</option>
                        <option value="2">Tháng 2</option>
                        <option value="3">Tháng 3</option>
                        <option value="4">Tháng 4</option>
                        <option value="5">Tháng 5</option>
                        <option value="6">Tháng 6</option>
                        <option value="7">Tháng 7</option>
                        <option value="8">Tháng 8</option>
                        <option value="9">Tháng 9</option>
                        <option value="10">Tháng 10</option>
                        <option value="11">Tháng 11</option>
                        <option value="12">Tháng 12</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <select name="year" id="" class="form-control">
                        <option value="1985">Năm 1985</option>
                        <option value="1986">Năm 1986</option>
                        <option value="1987">Năm 1987</option>
                        <option value="1988">Năm 1988</option>
                        <option value="1989">Năm 1989</option>
                        <option value="1990">Năm 1990</option>
                        <option value="1991">Năm 1991</option>
                        <option value="1992">Năm 1992</option>
                        <option value="1993">Năm 1993</option>
                        <option value="1994">Năm 1994</option>
                        <option value="1995">Năm 1995</option>
                        <option value="1996">Năm 1996</option>
                        <option value="1997">Năm 1997</option>
                        <option value="1998">Năm 1998</option>
                        <option value="1999">Năm 1999</option>
                        <option value="2000">Năm 2000</option>
                        <option value="2001">Năm 2001</option>
                        <option value="2002">Năm 2002</option>
                        <option value="2003">Năm 2003</option>
                        <option value="2004">Năm 2004</option>
                        <option value="2005">Năm 2005</option>
                        <option value="2006">Năm 2006</option>
                        <option value="2007">Năm 2007</option>
                        <option value="2009">Năm 2009</option>
                        <option value="2010">Năm 2010</option>
                        <option value="2011">Năm 2011</option>
                        <option value="2012">Năm 2012</option>
                        <option value="2013">Năm 2013</option>
                        <option value="2014">Năm 2014</option>
                        <option value="2015">Năm 2015</option>
                        <option value="2016">Năm 2016</option>
                        <option value="2017">Năm 2017</option>
                        <option value="2018">Năm 2018</option>
                        <option value="2019">Năm 2019</option>
                        <option value="2020">Năm 2020</option>
                        <option value="2021">Năm 2021</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Email</label>
                      <input type="mail"name="email"disabled class="form-control" value="<?php echo$taikhoan['email'] ?>" />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Số Điện Thoại</label>
                      <input type="tel" class="form-control" name="SODIENTHOAI" value="<?php echo $taikhoan['SODIENTHOAI']?>" />
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Giói Thiệu Bản Thân </label>
                      <textarea class="form-control"name="MOTA" rows="4"><?php echo $taikhoan['MOTA']?></textarea>
                    </div>
                  </div>
                </div>
                <div>
                  <button class="btn btn-primary"name="luu">Lưu</button>
                </div>
              </div>
              <div
                class="tab-pane fade"
                id="password"
                role="tabpanel"
                aria-labelledby="password-tab"
              >
                <h3 class="mb-4">Thay đổi mật khẩu</h3>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Mật khẩu cũ</label>
                      <input type="password"name="old" class="form-control" />
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Mật khẩu mới</label>
                      <input type="password"name="new" class="form-control" />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Nhập mật khẩu mới</label>
                      <input type="password"name="renew" class="form-control" />
                    </div>
                  </div>
                </div>
                <div>
                  <button class="btn btn-primary"name="thaydoi">Thay đổi</button>
                  <button class="btn btn-light"name="huy">Hủy</button>
                </div>
                <span><?php echo(isset($error)?$error:'')?></span>
              </div>
              <div
                class="tab-pane fade"
                id="security"
                role="tabpanel"
                aria-labelledby="security-tab"
              >
                <h3 class="mb-4">Security Settings</h3>

                <div class="accordion" id="accordionExample">
                  <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                      <button
                        class="accordion-button"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#collapseOne"
                        aria-expanded="true"
                        aria-controls="collapseOne"
                      >
                        Nhà riêng
                      </button>
                    </h2>
                    <div
                      id="collapseOne"
                      class="accordion-collapse collapse show"
                      aria-labelledby="headingOne"
                      data-bs-parent="#accordionExample"
                    >
                      <div class="accordion-body">
                     <span class="address-lable">BUI THI THEU </span> <span class="address-default" ><i class="far fa-check-circle"></i> Địa chỉ mặc định <br></span> <br>
       <span class="address-lable"> Địa chỉ:</span> ký túc xá khu a khu phố 6, Phường Linh Trung, Quận Thủ Đức, Hồ Chí Minh
       <br> <br> <span  class="address-lable">Điện thoại:</span>  0368311698
                      </div>
                    </div>
                  </div>
                  <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">

                    </h2>
                    <div
                      id="collapseOne"
                      class="accordion-collapse collapse show"
                      aria-labelledby="headingOne"
                      data-bs-parent="#accordionExample"
                    >
                      <div class="accordion-body">

                      </div>
                  </div>
                  <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                      <button
                        class="accordion-button collapsed"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#collapseThree"
                        aria-expanded="false"
                        aria-controls="collapseThree"
                      >
                        Ký túc xá
                      </button>
                    </h2>
                    <div
                      id="collapseThree"
                      class="accordion-collapse collapse"
                      aria-labelledby="headingThree"
                      data-bs-parent="#accordionExample"
                    >
                      <div class="accordion-body">
                     <span class="address-lable">BUI THI THEU </span> <span class="address-default" ><i class="far fa-check-circle"> </i> <br></span> <br>
       <span class="address-lable"> Địa chỉ:</span> ký túc xá khu a khu phố 6, Phường Linh Trung, Quận Thủ Đức, Hồ Chí Minh
       <br> <br> <span  class="address-lable">Điện thoại:</span>  0368363854
                      </div>
                    </div>
                  </div>
                </div>
                <div>
                  <button class="btn btn-primary">Update</button>
                  <button class="btn btn-light">Cancel</button>
                </div>
              </div>


            </div>
          </div>
        </div>
      </section>
    </div>
    <footer class="footer my-5">
      <div class="container">
        <div class="footer-container">
          <div class="footer-column">
            <a href="index.html" class="footer-logo">
              <img srcset="./images/images-main/logo.png 2x" alt="" />
            </a>
            <p class="footer-desc text">Yêu là phải nói, đói là phải ăn, gọi FatMe thật nhanh, giao tận tay khách</p>
            <div class="social">
              <a href="#" class="social-item">
                <img srcset="./images/images-main/facebook.png 2x" alt="" />
              </a>
              <a href="#" class="social-item">
                <img srcset="./images/images-main/twitter.png 2x" alt="" />
              </a>
              <a href="#" class="social-item">
                <img srcset="./images/images-main/instagram.png 2x" alt="" />
              </a>
              <a href="#" class="social-item">
                <img srcset="./images/images-main/apple.png 2x" alt="" />
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
    <!-- script -->
    <script src="./app.js"></script>
    </form>
  </body>
</html>
