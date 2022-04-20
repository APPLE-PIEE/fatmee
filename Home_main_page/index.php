<?php
include'../connect/connect.php';
if(empty($_SESSION['email'])){
    header("location: ../login/index.php");
  }
?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Quản Lý bán hàng</title>
        <link rel="shortcut icon" href="../monan_main_page/img/logo/logo-main.png" type="image/x-icon" />
        <link rel="stylesheet" href="./css/reset.css" />
        <link rel="stylesheet" href="../edit_menu/css/edit_menu.css">
        <link rel="stylesheet" href="./css/Home_page.css" />
        <link rel="stylesheet" href="../edit_menu/frames/Danh_muc_mon_an/css/menu.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    </head>

    <body>
        <div class="container">

            <div class="header_container">
                <div class="centered">
                    <ul class="list_menu">
                        <li class="img_li">
                            <a href=""><img class="img_icon" src="./images/Logo .png" /></a>

                        </li>
                        <li class="search">
                            <div>
                                <i class="fas fa-search" style="font-size: 25px"></i>
                                <input class="type_search" type="text" placeholder="Bạn muốn tìm..." />
                                <button>Tìm kiếm</button>
                            </div>
                        </li>
                        <li class="header-others">
                            <ul>
                                <li class="icon">
                                    <a><i class="fab fa-facebook-messenger"></i></a>
                                </li>
                                <li class="icon">
                                    <a><i class="fas fa-bell"></i></a>
                                </li>
                                <li>
                                    <!-- <div class="dropdown_more">
                      <i class="style_more fas fa-bars"></i>
                      <div id="moreDropdown" class="dropdown_more_content">
                        <a target="content" onclick="more()" href="../edit_menu/frames/Them_san_pham/them_san_pham.html"
                          ><i class="fas fa-plus-square"></i></i>Thêm sản phẩm</a
                        >

                        <a target="content" href="../edit_menu/frames/Danh_sach_san_pham/Danh_sach_san_pham.html"><i class="fas fa-list"></i>Danh sách sản phẩm</a>

                      </div>
                    </div> -->
                                    <div class="icon_more">
                                        <button onclick="more()" class="more_button"><i class="style_more fas fa-bars"></i></button>
                                        <div id="moreDropdown" class="dropdown_more_content">
                                            <a target="content" href="../edit_menu/frames/Them_san_pham/them_san_pham.php"><i class="fas fa-plus-square"></i></i>Thêm sản phẩm</a>

                                            <a target="content" href="../edit_menu/frames/Thong_tin_san_pham/.php"><i class="fas fa-list"></i>Danh sách sản phẩm</a>
                                            <!-- <a href=""><i class="fas fa-key"></i>Mật khẩu</a>
                        <a href=""><i class="fas fa-sign-out-alt"></i>Đăng xuất</a> -->
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="dropdown">
                                        <img class="img_account" src="./images/anh-anime.jpg" />
                                        <button onclick="avatar()" class="dropbtn">Nhóm 11</button>
                                        <div id="myDropdown" class="dropdown-content">
                                            <!-- href="/Main_page/home/ho_so_ca_nhan/ho_so.html -->
                                            <a target="content" href="../main-page/index.php"><i class="fas fa-user"></i>Hồ sơ cá nhân</a
                        >
                        <a href=""><i class="fas fa-store-alt"></i>Thông tin shop</a>
                                            <a href=""><i class="fas fa-key"></i>Mật khẩu</a>
                                            <a href=""><i class="fas fa-sign-out-alt"></i>Đăng xuất</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="body_container">
                <div class="frame_menu">
                    <div class="content-menu">
                        <ul class="menu">
                            <h3><i class="fas fa-utensils"> &nbsp;&nbsp; </i>Sản Phẩm</h3>

                            <li>
                                <ul class="sub-menu">
                                    <li> <a target="content-list" href="../edit_menu/frames/Quan_ly_san_pham/quan_ly_san_pham.php">Danh sách món ăn</a></li>
                                    <li> <a target="content-list" href="../edit_menu/frames/Danh_muc_mon_an/danh_muc_mon_an.php">Danh mục món ăn</a></li>
                                </ul>
                            </li>
                        </ul>

                        <ul class="menu">
                            <h3><i class="fas fa-clipboard">&nbsp;&nbsp;</i>Đơn Hàng</h3>
                            <li>
                                <ul class="sub-menu">
                                    <li> <a target="content-list" href="../edit_menu/frames/Don_hang/don_hang.html">Tất cả đơn hàng</a></li>
                                    <!-- <li> <a target="content-list" href="">Tạo đơn hàng</a></li>
                                    <li> <a target="content-list" href="">Đơn hàng nháp</a></li> -->
                                </ul>
                            </li>
                        </ul>
                        <ul class="menu">
                            <h3><i class="fas fa-gift">&nbsp;&nbsp;</i>Khuyến mãi</h3>
                            <li>
                                <ul class="sub-menu">
                                    <li> <a target="content-list" href="../edit_menu/frames/Khuyen_mai/khuyen_mai.php">Mã khuyến mãi</a></li>
                                    <li> <a target="content-list" href="../edit_menu/frames/Khuyen_mai/Chuong_trinh_khuyen_mai/chuong_trinh_khuyen_mai.php">Chương trình khuyến mãi</a></li>
                                    <!-- <li> <a target="content-list" href="../edit_menu/frames/Khuyen_mai/Chuong_trinh_khuyen_mai/chuong_trinh_khuyen_mai.php">Chương trình khuyến mãi</a></li> -->
                                </ul>
                            </li>
                        </ul>
                        <ul class="menu">
                            <h3><i class="fas fa-tools">&nbsp;&nbsp;</i>Khách hàng</h3>
                            <li>
                                <ul class="sub-menu">
                                    <li><a target="content-list" href="../edit_menu/frames/Khach_hang/khach_hang.html">Phương thức thanh toán</a></li>
                                    <!-- <li><a target="content-list" href="">Phương thức vận chuyển</a></li>
                                    <li><a target="content-list" href="">Thông báo</a></li>
                                    <li><a target="content-list" href="">Tài khoản và phân quyền</a></li> -->
                                </ul>
                            </li>
                            <h3><i class="fas fa-tools">&nbsp;&nbsp;</i>Cấu hình</h3>
                            <!-- <li>
                                <ul class="sub-menu">
                                    <li><a target="content-list" href="">Phương thức thanh toán</a></li>
                                    <li><a target="content-list" href="">Phương thức vận chuyển</a></li>
                                    <li><a target="content-list" href="">Thông báo</a></li>
                                    <li><a target="content-list" href="">Tài khoản và phân quyền</a></li>
                                </ul>
                            </li> -->
                        </ul>
                    </div>
                    <div class="danh_muc_container">
                        <iframe src="../edit_menu/frames/Quan_ly_san_pham/quan_ly_san_pham.php" frameborder="0" name="content-list"></iframe>
                    </div>
                </div>
            </div>
            <!-- <div class="footer">
          <h1>FATME.com</h1>
          <div class="info_fatme">
            <ul>
              <li>Liên kết</li>
              <li>Contact</li>
              <li>Fanpage</li>
            </ul>
          </div>
          <div class="icon_fatme">
            <ul>
              <li><i class="fab fa-facebook-square"></i></li>
              <li><i class="fab fa-instagram"></i></li>
              <li><i class="fab fa-youtube"></i></li>
            </ul>
          </div>

        </div> -->
    </body>
    <script src="./scripts/index.js"></script>

    </html>