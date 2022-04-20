<?php
include'../connect/connect.php';
include_once '../mail/index.php';
$mail= new Mailer();
$error='';
if(!empty($_SESSION['dangnhap'])){
  header("location: ../Home_main_page/index.php");
}

if(isset($_POST['email'])){
  $email=$_POST['email'];
  $password=md5($_POST['password']);
  if(empty($email)){
    $error='Bạn chưa nhập tài khoản';
  }
  if(empty($password)){
    $error='Bạn chưa nhập mật khẩu';
  }
  $sql="SELECT *FROM khachhang WHERE email='$email'";
  $query=mysqli_query($conn,$sql);
  $data=mysqli_fetch_assoc($query);
  $check=mysqli_num_rows($query);
  if ($check==0){
    $error='Tài khoản không tồn tại';
  }else{
    if($data['password']!=$password){
    $error='Mật khẩu không đúng';
    }else{
      $_SESSION['email']=$email;
      $_SESSION['dangnhap']=true;
      header("location: ../main-page/index.php");
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
    <title>Đăng nhập</title>
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
      <form action="" method="post" class="form-login">
        <h1 class="header-text bold">Đăng nhập</h1>
        <p class="sub-text">Chào bạn, đăng nhập để tiếp tục !</p>
        <p class="sub-text">
          Hoặc <a href="../register/index.php" class="sub-link">Tạo tài khoản mới</a>
        </p>
        <div class="form-group">
          <input
            type="email"
            name="email"
            placeholder="Nhập email"
            class="input-text"
            autocomplete="e-mail"
          /><br />
          <div class="relative">
            <input
              type="password"
              name="password"
              placeholder="Nhập mật khẩu"
              id="passwd"
              class="input-text"
            />
            <i class="fas fa-eye showpwd" onclick="showPassword('passwd', this)"></i>
          </div>
          <button type="submit">Đăng nhập</button>
        </div>
        <span class="error sub-text"><?php echo(isset($error)?$error:'')?></span>
        <p class="m-20-0">
          <a href="../forgot_password/index.php" class="semi-bold sub-link">Quên mật khẩu</a>
        </p>
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
