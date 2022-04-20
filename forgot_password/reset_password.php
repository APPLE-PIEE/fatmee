<?php
include'../connect/connect.php';
if(!empty($_SESSION['dangnhap'])){
  header("location: ../Home_main_page/index.php");
}
$error='';
if (isset($_POST['submit'])){
  $password=md5($_POST['password']);
  $repassword=md5($_POST['repassword']);
  $email=$_SESSION['email'];
  if(empty($password)){
    $error='Bạn chưa nhập mật khẩu';
  }
  if($password!=$repassword){
    $error='Mật khẩu nhập lại không đúng';
  }
  if (empty($error)){
    $sql="UPDATE khachhang SET password= '$password' WHERE email='$email'";
    $query=mysqli_query($conn,$sql);
    $_SESSION['email']=$email;
    $_SESSION['dangnhap']=true;
    header("location: ../login/index.php");
  }
}
?>








<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Đặt lại mật khẩu</title>
    <link rel="stylesheet" href="./css/reset.css" />
    <link rel="shortcut icon" href="../monan_main_page/img/logo/logo-main.png" type="image/x-icon" />
    <link rel="stylesheet" href="./css/app.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
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
    <div class="container">
      <form action="" class="form-forgot"method="post">
        <!-- icon back -->
        <div class="form-forgot-icon">
          <a href="../login/index.php"><i class="fas fa-arrow-left sub-link"></i></a>
        </div>
        <h1 class="header-text bold">Mật khẩu mới</h1>
        <span><?php echo(isset($error)?$error:'')?></span>
        <p class="sub-text">Hãy nhập lại mật khẩu mới!</p>
        <div class="form-group">
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
          <p class="error sub-text">
          </p>
          <button type="submit"name="submit">Gửi</button>
        </div>
      </form>
    </div>
  </body>
  <script src="./scripts/index.js"></script>
</html>
