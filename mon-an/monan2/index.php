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
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" crossorigin="anonymous" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css"
    />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- my css -->
    <link rel="stylesheet" href="../../assets/css/main-page/app.css" />
    <link rel="stylesheet" href="../../assets/css/food/monan2.css" />
    <title>FATMe - Món ăn</title>
  </head>
  <body>
    <div class="totop">
      <a href="#" class="goto-top"></a>
    </div>
    <div class="wrapper">
      <header class="header">
        <div class="navigation">
          <a href="#"
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

      <section class="section1">
        <div id="demo" class="carousel slide col-md-5" data-bs-ride="carousel">

            <!-- Indicators/dots -->
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
            </div>

            <!-- The slideshow/carousel -->
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="./img/image (5).jpg" alt="Los Angeles" class="d-block"
                        style="width:650px; height:350px;">
                </div>
                <div class="carousel-item">
                    <img src="./img/image (6).jpg" alt="Chicago" class="d-block" style="width:650px; height:350px;">
                </div>
                <div class="carousel-item">
                    <img src="./img/image (7).jpg" alt="New York" class="d-block"
                        style="width:650px; height:350px;">
                </div>
            </div>

            <!-- Left and right controls/icons -->
            <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>

        <div class="noidungsp col-md-6">
            <h3>KHAI VỊ TAM HỢP</h3>
            <div style="padding-left: none;" class="care">
                <div class="care_box1">
                    3232 &nbsp;<i class="fas fa-heart"></i>
                </div>
                <div class="care_box2">
                    11 Đánh Giá
                </div>
                <div class="care_box3">
                    231 Lượt Mua
                </div>
            </div>
            <div class="price">
                <h2>
                    ₫235.000 - ₫265.000
                </h2>

                <b class="Cheap"><i class="fas fa-donate"></i> &nbsp;Rẻ hơn hoàn tiền</b>

            </div>
            <div class="voucher">
                <div class="voucher-list">
                    Mã Giảm Giá
                    <div class="img-voucher">
                        <img src="./img/Capture.PNG" alt="">
                        <img src="./img/Capture1.PNG" alt="">
                        <img src="./img/Capture6.PNG" alt="">
                        <img src="./img/Capture3.PNG" alt="">
                        <img src="./img/Capture4.PNG" alt="">
                        <span>Xem Tất Cả &nbsp;</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>
                <div class="voucher-info">
                    <p style="color: black;"> Mã giảm giá của Shop</p>
                    <span>Tiết kiệm hơn khi áp dụng mã giảm giá của Shop. Liên hệ với Shop nếu gặp trục trặc về mã
                        giảm giá do Shop tự tạo.</span>
                    <div class="voucher-box">
                        <div class="voucher-box-img"><img src="./img/avt1.png" alt=""></div>
                        <div class="voucher-box-nd">
                            <p>Miễn phí vận chuyển</p>
                            <p> Đơn hàng trên ₫50.000</p>
                            <p style="color: red;" class="hsd">Còn 3 ngày nữa</p>
                        </div>
                        <div class="voucher-save">
                            <button>Lưu</button>
                        </div>
                    </div>
                    <div class="voucher-box">
                        <div class="voucher-box-img"><img src="./img/avt2.jpg" alt=""></div>
                        <div class="voucher-box-nd">
                            <p>Giảm ₫10.000</p>
                            <p> Đơn hàng trên ₫20.000</p>
                            <p class="hsd">HSD: 31-12-2021</p>
                        </div>
                        <div class="voucher-save">
                            <button>Lưu</button>
                        </div>
                    </div>
                    <div class="voucher-box">
                        <div class="voucher-box-img"><img src="./img/avt3.jpg" alt=""></div>
                        <div class="voucher-box-nd">
                            <p>Giảm ₫20.000</p>
                            <p> Đơn hàng trên ₫50.000</p>
                            <p class="hsd">HSD: 1-2-2022</p>
                        </div>
                        <div class="voucher-save">
                            <button>Lưu</button>
                        </div>
                    </div>
                    <div class="voucher-box">
                        <div class="voucher-box-img"><img src="./img/avt4.jpg" alt=""></div>
                        <div class="voucher-box-nd">
                            <p>Giảm ₫25.000</p>
                            <p> Đơn hàng trên ₫50.000</p>
                            <p style="color: red;" class="hsd">Còn 2 Ngày Nữa</p>
                        </div>
                        <div class="voucher-save">
                            <button>Lưu</button>
                        </div>
                    </div>

                </div>
            </div>
            <div class="ship">
                <div class="ship-lable">
                    Vận Chuyển
                </div>
                <div class="ship-address">

                    <p><i class="fas fa-shipping-fast"></i> &nbsp;Miễn phí vận chuyển cho đơn hàng trên 50.000₫</p>
                    <span> &nbsp;<i class="fas fa-map-marker-alt"></i> &nbsp; &nbsp; 191 Lê Đức Thọ, P. 17, Gò Vấp,
                        TP. HCM</span>
                </div>

            </div>

            <div class="product-quantity">
                <div class="ship-lable">
                    Số Lượng
                </div>
                <div class="ship-address-number">
                    <input type="number">

                </div>

            </div>
            <div class="shoppingcart">
                <button class="shoppingcart-box1"><i class="fas fa-cart-plus"></i> &nbsp; Thêm Vào Giỏ Hàng
                </button>
                <button class="shoppingcart-box2">Mua Ngay</button>

            </div>
        </div>

    </section>
    <section class="section2">
        <div>
            <h2>Thông tin sản phẩm </h2>
            <ul class="nav nav-pills mb-3 " id="pills-tab" role="tablist">
                <li class="nav-item " role="presentation">
                    <button class="btn btn-secondary nav-link  active" id="pills-home-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                        aria-selected="true">Mô tả sản phẩm</button>
                </li>

                <li class="nav-item" role="presentation">
                    <button class="btn btn-secondary nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"
                        aria-selected="false">Nguyên Liệu</button>
                </li>

            </ul>
            <div style="padding: 0px 20px;" class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                    aria-labelledby="pills-home-tab">
                    <ul>
                        <li> <i>
                                Ngon không cưỡng nổi vị gà hấp nước mắm nhĩ đậm đà, thơ ngon cùng xôi 3 màu, 3 vị
                                đẹp mắt,
                                ngon miệng. Gà Hấp Nước Mắm sẽ để lại dấu ấn khó quên với thực khách khi món ăn hấp
                                dẫn này
                                xuất hiện
                                trên bàn tiệc.</i></li>
                        <li> <i><b>Gà Hấp Nước Mắm</b> là một phiên bản Gà lên mâm hoàn toàn mới toanh của quán.
                                Nhìn mâm gà
                                thôi đã
                                thấy hấp dẫn bắt mắt với Gà được hấp màu nâu cánh gián đẹp mắt, cùng 3 loại xôi lá
                                dứa, lá
                                cải và xôi gấc nhìn là muốn ăn ngay rồi.</i> </li>
                        <li> Gà sử dụng cho món này là <b <i><u>Gà Nòi Lai </u></i> </b> - Là giống ngon nhất trong
                            các loại
                            <i><b>Gà Ta </b></i> do chính quán kết hợp với người dân nuôi tại Bến Tre theo kỹ thuật
                            riêng để
                            thịt gà ngon nhất. Gà tơ, từ 4 đến 5 tháng tuổi, ôm trứng và hạt sen tạo sự đẳng cấp và
                            khác
                            biệt.
                        </li>
                        <li> Xôi gấc, xôi lá cải là màu của trái gấc và của cải bó xôi 100%, tuyệt đối không phẩm
                            màu!<br></li>
                        <li> <span style="font-size: 14px;"> <b><i> Gà Hấp</i></b> Nước Mắm là một phiên bản Gà lên
                                mâm hoàn toàn mới toanh của quán.
                                Nhìn mâm gà thôi đã thấy hấp dẫn bắt mắt với Gà được hấp màu nâu cánh gián đẹp mắt,
                                cùng 3
                                loại xôi lá dứa, lá cải
                                và xôi gấc nhìn là muốn ăn ngay rồi.
                            </span></li>

                    </ul>


                </div>
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <ul>
                        <li>Size ( M ) : gà 1kg6 , 4 người dùng.</li>
                        <li>12 khoanh xôi cuộn 3 màu,gỏi hành tây,trứng non, nước trộn gỏi, dưa leo, cà chua, rau
                            răm, muối tiêu tắc, nước chấm xôi, bao tay xé gà.</li>
                    </ul>
                </div>

            </div>
        </div>
    </section>
    <section class="section3">
        <h2>Đánh giá sản phẩm</h2>
        <div class=" d-flex justify-content-center mt-100 mb-100">
            <div class="comment-widgets m-b-20">
                <div class="d-flex flex-row comment-row">
                    <div class="p-2"><span class="round"><img src="./img/avt1.png" alt="user"
                                width="50"></span></div>
                    <div class="comment-text w-100">
                        <h5> <b>Bùi Thị Thêu</b> </h5>
                        <div class="comment-footer"> <span class="date">April 14, 2019</span> <span
                                class="label label-info">Pending</span> <span class="action-icons"> <a href="#"
                                    data-abc="true"><i class="fa fa-pencil"></i></a> <a href="#" data-abc="true"><i
                                        class="fa fa-rotate-right"></i></a> <a href="#" data-abc="true"><i
                                        class="fa fa-heart"></i></a> </span> </div>
                        <p class="m-b-5 m-t-10">Trong rượu, ta tìm thấy trí tuệ. Trong bia, ta thấy được sức mạnh. Trong nước lọc, ta phát hiện vi khuẩn, và cuối cùng trong ăn uống, ta tìm thấy niềm vui.Nếu có càng nhiều người trong chúng ta coi trọng thứ ăn, những lời chúc tụng và các bài hát hơn là tích trữ vàng, thế giới này hẳn đã vui vẻ hơn nhiều – J.R.R. Tolkien –.</p>
                    </div>
                </div>
                <div class="d-flex flex-row comment-row ">
                    <div class="p-2"><span class="round"><img src="./img/avt2.jpg" alt="user"
                                width="50"></span></div>
                    <div class="comment-text active w-100">
                        <h5><b> Nguyễn Minh Phụng</b></h5>
                        <div class="comment-footer"> <span class="date">March 13, 2020</span> <span
                                class="label label-success">Approved</span> <span class="action-icons active"> <a
                                    href="#" data-abc="true"><i class="fa fa-pencil"></i></a> <a href="#"
                                    data-abc="true"><i class="fa fa-rotate-right text-success"></i></a> <a href="#"
                                    data-abc="true"><i class="fa fa-heart text-danger"></i></a> </span> </div>
                        <p class="m-b-5 m-t-10">Tôi mắc phải rất nhiều sai lầm khi yêu, hối hận gần như tất cả các cuộc tình mình trải qua. Tuy nhiên, tôi không hề hối tiếc vì những món ăn đã đi liền với chúng.</p>
                    </div>
                </div>
                <div class="d-flex flex-row comment-row">
                    <div class="p-2"><span class="round"><img src="./img/avt3.jpg" alt="user"
                                width="50"></span></div>
                    <div class="comment-text w-100">
                        <h5> <b>Nguyễn Minh Tuấn</b> </h5>
                        <div class="comment-footer"> <span class="date">Jan 20, 2020</span> <span
                                class="label label-danger">Rejected</span> <span class="action-icons"> <a href="#"
                                    data-abc="true"><i class="fa fa-pencil"></i></a> <a href="#" data-abc="true"><i
                                        class="fa fa-rotate-right"></i></a> <a href="#" data-abc="true"><i
                                        class="fa fa-heart"></i></a> </span> </div>
                        <p class="m-b-5 m-t-10">ôi mắc phải rất nhiều sai lầm khi yêu, hội hận hầu như tất cả các cuộc tình mình từng trải qua. Tuy nhiên, tôi không hề hối tiếc vì những món ăn ngon đi liền với chúng. Trong rượu, ta tìm thấy trí tuệ. Trong bia, ta nhìn ra sức mạnh. Trong nước lọc, ta phát hiện vi khuẩn.</p>
                    </div>
                </div>
                <div class="d-flex flex-row comment-row">
                    <div class="p-2"><span class="round"><img src="./img/avt5.jpg" alt="user"
                                width="50"></span></div>
                    <div class="comment-text w-100">
                        <h5> <b>Lã Mai Win</b> </h5>
                        <div class="comment-footer"> <span class="date">March 20, 2020</span> <span
                                class="label label-info">Pending</span> <span class="action-icons"> <a href="#"
                                    data-abc="true"><i class="fa fa-pencil"></i></a> <a href="#" data-abc="true"><i
                                        class="fa fa-rotate-right"></i></a> <a href="#" data-abc="true"><i
                                        class="fa fa-heart"></i></a> </span> </div>
                        <p class="m-b-5 m-t-10">Mỗi lần tôi đối mặt với đồ ăn, tôi đều tự nói với bản thân “Ăn nữa sẽ chết” và kết quả đã chứng minh cho thấy tôi không hề sợ chết.</p>
                    </div>
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
            <a href="index.html" class="footer-logo">
              <img srcset="../../assets/images/main-images/logo.png 2x" alt="" />
            </a>
            <p class="footer-desc text">
              Lorem, ipsum dolor sit amet consectetur adipisicing elit. Inventore, qui error,
              aspernatur ut velit saepe adipisci reprehenderit maxime suscipit ea non earum
              repudiandae aliquid doloremque nihil pariatur, culpa iste officiis?
            </p>
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


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
  </body>
</html>
