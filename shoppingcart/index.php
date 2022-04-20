<?php
include"../connect/connect.php";
if(empty($_SESSION['email'])){
    header("location: ../login/index.php");
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
} ?>

<!DOCTYPE html>
<html lang="en">
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
    <link rel="stylesheet" href="../assets/css/cart/cart.css" />
    <link
      rel="stylesheet"
      href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
      crossorigin="anonymous"
    />

    <title>FATMe - Giỏ hàng</title>
  </head>

  <body>
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
            <li class="menu-item">
              <a class="menu-link" href="../main-page/index.php">Trang chủ</a>
            </li>
            <li class="menu-item">
              <a class="menu-link" href="../mon-an/index.php">Món ăn</a>
            </li>
            <li class="menu-item"><a class="menu-link" href="../blog/index.php">Blog</a></li>
            <li class="menu-item">
              <a class="menu-link" href="../service/index.php">Dịch vụ</a>
            </li>
            <li class="menu-item"><a class="menu-link" href="../contact/index.php">Liên hệ</a></li>
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
                <?php foreach($dsyeuthich as $key=>$value) { ?>
                  <li class="dropdown-item auth-like-dropdown-item">
                        <img
                          src="../assets/images/food/<?php echo $value['IMAGE']?>"
                          alt="Hình thức ăn"
                          class="dropdown-item-image"
                        />
                        <div class="dropdown-item-text">
                          <div class="dropdown-item-text-desc"><?php echo $value['THELOAI']?></div>
                          <div class="dropdown-item-text-title"><?php echo $value['TENMONAN']?></div>
                          <div class="dropdown-item-text-price"><?php echo $value['GIA']?></div>
                        </div>
                        <div class="dropdown-item-right">
                          <a href="xoa_thich.php?id=<?php echo $value['id_monan']?>">
                            <img class="trash"src="../assets/images/main-images/icon-trash.png" alt="trash"/>
                          </a>
                            <img class="heart"src="../assets/images/main-images/icon-heart-fill.png"alt="heart"/>
                        </div>
                    </li>
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
                  <li class="auth-shoppingcart-dropdown-item">
                    <a
                      class="auth-shoppingcart-dropdown-link"
                      href="../shoppingcart/index.index.php"
                    >
                      Giỏ hàng
                    </a>
                  </li>
                  <li class="auth-shoppingcart-dropdown-item">
                    <a class="auth-shoppingcart-dropdown-link" href="#!"> Đặt hàng </a>
                  </li>
                </ul>
              </div>
              <div class="auth-user">
                <div class="auth-user-top">
                  <img src="../assets/images/main-images/icon-user.png" alt="user" />
                  <span class="auth-username"><?php echo $account ?></span>
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
                    <a class="auth-user-dropdown-link" href="../mon-an/dx.php">Đăng xuất</a>
                  </li>
                </ul>
              </div>
            </li>
          </ul>
          <label for="toggle-check" class="toggle"
            ><img src="../assets/images/main-images/menu.png" alt="Menu"
          /></label>
          <label for="toggle-check" class="overlay"></label>
        </div>
      </header>

      <main>
        <p
          style="
            color: #635f85;
            font-size: 27px;
            font-weight: 500;
            margin: 0 auto;
            width: max-content;
          "
        >
          GIỎ HÀNG
        </p>

        <div class="shopping-cart">
          <div class="column-labels">
            <label class="product-image">Ảnh</label>
            <label class="product-details">Tên Món Ăn</label>
            <label class="product-price">Giá Tiền </label>
            <label class="product-quantity">Số Lượng</label>
            <label class="product-removal">Xóa</label>
            <label class="product-line-price">Tổng Tiền</label>
          </div>
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
                  foreach($dsgiohang as $key=>$value) { ?>
          <div class="product">
            <div class="product-image">
              <img src="../assets/images/food/<?php echo $value['IMAGE']?>" />
            </div>
            <div class="product-details">
              <p class="product-title"><?php echo $value['TENMONAN']?></p>
            </div>
            <div class="product-price"><?php echo formatMoney($value['GIA'])?></div>
            <div class="product-quantity">
              <input
                class="input-pro"
                type="number"
                value="<?php echo $value['SOLUONG']?>"
                min="1"
              />
            </div>
            <div class="product-removal">
              <button style="background: none" class="remove-product">
                <a href="xoa.php?id=<?php echo $value['id_monan'];?>">
                  <i class="far fa-trash-alt"></i
                ></a>
              </button>
            </div>
            <div class="product-line-price">
              <?php echo formatMoney($value['GIA']*$value['SOLUONG'])?>
            </div>
          </div>
          <?php }?>
          <?php
                  $tongtien=0;
                    foreach($dsgiohang as $key=>$value) {
          $tongtien=$tongtien+$value['GIA']*$value['SOLUONG']; }?>

          <div class="totals">
            <div class="totals-item">
              <label>Tổng Tiền </label>
              <div class="totals-value" id="cart-subtotal">
                <?php echo formatMoney($tongtien) ?>
              </div>
            </div>
            <!-- <div class="totals-item">
                        <label>Phí Ship (5%)</label>
                        <div class="totals-value" id="cart-tax">3.60</div>
                    </div> -->
            <div class="totals-item">
              <label>Phí Ship (15.000)</label>
              <div class="totals-value" id="cart-shipping">15,000</div>
            </div>
            <div class="totals-item totals-item-total">
              <label>Thanh Toán</label>
              <div class="totals-value" id="cart-total">
                <?php echo formatMoney($tongtien+15000) ?>
              </div>
            </div>
          </div>

          <button class="checkout">Đặt Hàng</button>
        </div>
      </main>
      <br /><br /><br />
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
              Lorem, ipsum dolor sit amet consectetur adipisicing elit. Inventore, qui error,
              aspernatur ut velit saepe adipisci reprehenderit maxime suscipit ea non earum
              repudiandae aliquid doloremque nihil pariatur, culpa iste officiis?
            </p>
            <div class="social">
              <a href="#" class="social-item">
                <img srcset="../assets/images/main-images/facebook.png 2x" alt="" />
              </a>
              <a href="#" class="social-item">
                <img srcset="../assets/images/main-images/twitter.png 2x" alt="" />
              </a>
              <a href="#" class="social-item">
                <img srcset="../assets/images/main-images/instagram.png 2x" alt="" />
              </a>
              <a href="#" class="social-item">
                <img srcset="../assets/images/main-images/apple.png 2x" alt="" />
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
    <script src="../assets/js/main.js"></script>
    <script src="./script.js"></script>
  </body>
</html>
