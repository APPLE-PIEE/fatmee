<?php
include'../connect/connect.php';
if(!empty($_SESSION['dangnhap'])){
  header("location: ../Home_main_page/index.php");
}
$error='';
if(isset($_POST['submit'])){
  $code1=$_POST['code1'];
  $code2=$_POST['code2'];
  $code3=$_POST['code3'];
  $code4=$_POST['code4'];
  $code=$code1*1000+$code2*100+$code3*10+$code4;
  if($code!=$_SESSION['code']){
    $error="Mã xác nhận không đúng";
  }else{
    header("location: reset_password.php");
  }
}


?>






<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Xác nhận mật khẩu</title>
    <link rel="shortcut icon" href="../monan_main_page/img/logo/logo-main.png" type="image/x-icon" />
    <link rel="stylesheet" href="./css/reset.css" />
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
    <a href="../main-page/index.php" class="image-main-auth">
      <img src="../assets/images/main-images/logo.png" alt="Logo" class="">
    </a>
    <div class="container">
      <form action="" class="form-forgot" method="post" >
        <!-- icon back -->
        <div class="form-forgot-icon">
          <a href="../forgot_password/index.php"><i class="fas fa-arrow-left sub-link"></i></a>
        </div>
        <h1 class="header-text bold">Xác nhận mã</h1>
        <p class="sub-text">
          Chúng tôi đã gửi một mã đến email của bạn. <br />Vui lòng kiểm tra email!
        </p>
        <div class="form-group">
          <div class="number-code">
            <input type="text" name="code1" id="" class="input-code" />
            <input type="text" name="code2" id="" class="input-code" />
            <input type="text" name="code3" id="" class="input-code" />
            <input type="text" name="code4" id="" class="input-code" />
          </div>
          <span class="error sub-text"><?php echo(isset($error)?$error:'')?></span>
          <button type="submit"name="submit">Gửi</button>
        </div>
      </form>
    </div>
  </body>
  <script src="./scripts/index.js"></script>
</html>
