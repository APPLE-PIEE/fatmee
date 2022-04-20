<?php
include'../connect/connect.php';
if(!empty($_SESSION['dangnhap'])){
  header("location: ../Home_main_page/index.php");
}

$error='';
if (isset($_POST['email'])){
  $email=$_POST['email'];
  $password=md5($_POST['password']);
  $repassword=md5($_POST['repassword']);

  if(empty($email)){
    $error='Bạn chưa nhập e-mail';
  }
  elseif(empty($password)){
    $error='Bạn chưa nhập mật khẩu';
  }
  elseif($password!=$repassword){
    $error='Mật khẩu nhập lại không đúng';
  }
  elseif(!isset($_POST['checkbox'])){
    $error='Bạn chưa chấp nhận điều khoản';
  }
  elseif (empty($error)){
    $sql="INSERT INTO khachhang(email,password)  VALUES('$email','$password')";
    $query=mysqli_query($conn,$sql);
    if($query==false){
      $error='Địa chỉ e-mail đã tồn tại';
    }
    else{
      $_SESSION['email']=$email;
      $_SESSION['dangnhap']=true;
      header("location: ../profile/index.php");
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Đăng ký</title>
    <link rel="stylesheet" href="./css/reset.css" />
    <link rel="stylesheet" href="./css/app.css" />
    <link rel="shortcut icon" href="../monan_main_page/img/logo/logo-main.png" type="image/x-icon" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600;1,700&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
      integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p"
      crossorigin="anonymous"
    />
  </head>
  <body>
    <a href="../main-page/index.php" class="image-main-auth">
      <img src="../assets/images/main-images/logo.png" alt="Logo" class="">
    </a>
    <div class="container">
      <form action="" method="post" class="form-register">
        <h1 class="header-text bold">Tạo tài khoản</h1>
        <p class="sub-text">
          Bạn đã có tài khoản?
          <a href="../login/index.php" class="sub-link">Đăng nhập</a>
        </p>
        <div class="form-group">
          <input type="email" name="email" placeholder="Nhập e-mail" class="input-text" />
          <div class="relative">
            <input
              id="passwd1"
              type="password"
              name="password"
              placeholder="Nhập mật khẩu"
              class="input-text"
            />
            <i class="fas fa-eye showpwd" onclick="showPassword('passwd1', this)"></i>
          </div>
          <div class="relative">
            <input
              id="passwd2"
              type="password"
              name="repassword"
              placeholder="Nhập lại mật khẩu"
              class="input-text"
            />
            <i class="fas fa-eye showpwd" onclick="showPassword('passwd2', this)"></i>

          </div>
          <div class="dieukhoan">
            <input type="checkbox" name="checkbox" class="input-checkbox" id="checkbox" />
            <label for="checkbox" class="sub-link">Chấp nhận điều khoản và dịch vụ</label>
          </div>
          <button type="submit">Đăng ký</button>
        </div>
        <span class="error"><?php echo(isset($error)?$error:'')?></span>
        <p class="m-20-0"><a href="../forgot_password/index.php" class="semi-bold sub-link">Quên mật khẩu</a></p>
        <div class="m-40-0 upcase light or">
          <span class="abs-text">hoặc</span>
          <hr />
        </div>
        <ul>
          <li>
            <a href="#"><i class="fab fa-facebook icon" id="fb"></i></a>
          </li>
          <li>
            <a href="#"><i class="fab fa-apple icon" id="apple"></i></a>
          </li>
          <li>
            <a href="#"><i class="fab fa-google-plus icon" id="gg"></i></a>
          </li>
          <li>
            <a href="#"><i class="fab fa-twitter icon" id="tw"></i></a>
          </li>
        </ul>
      </form>
    </div>
  </body>
  <script src="./scripts/index.js"></script>
</html>

