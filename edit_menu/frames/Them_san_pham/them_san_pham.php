<!-- <!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="./css/reset.css" />
    <link rel="stylesheet" href="./css/Them_san_pham.css">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600;1,700&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.13.0/css/all.css"
      integrity="sha384-Bfad6CLCknfcloXFOyFnlgtENryhrpZCe29RTifKEixXQZ38WheV+i/6YWSzkz3V"
      crossorigin="anonymous"
    />
  </head>
  <body>
  
   <form action="">

    <div class="container">
      <div class="container_left">
        <div class="header">
          <h1>Thêm sản phẩm</h1>
        </div>
        <ul class="list_menu">
          <li>
            <label class="list_name" for="name_product">Tên sản phẩm<i class="fas fa-exclamation-circle"></i></label> <br>
            <input placeholder="Nhập tên sản phẩm" name="#" id="name_product" type="text">
          </li>
          <li>
            <label  class="list_name" for="info_product">Nội dung<i class="fas fa-exclamation-circle"></i></label> <br>
            <textarea rows="5" placeholder="Nhập thông tin sản phẩm " id="info_product" type="text" ></textarea>
          </li>
        </ul>
        <ul class="list_menu">
          <li>
            <label  class="list_name" for="name_product">Ảnh sản phẩm <i class="fas fa-exclamation-circle"></i></label> <br>
           <ul class="list_img">
             <li>
                <img src="./images/new_img.PNG" alt="">
                <div class="img">
                  <i class="fas fa-times-circle"></i>
                  <img  src="./images/01_img.jpg" alt="" >    
                </div>
               <div class="img">
                  <i class="fas fa-times-circle"></i>
                  <img src="./images/02_img.jpg" alt="">
               </div>
                
             </li>
           </ul>
          </li>
         
        </ul>

      </div>
      <div class="container_right">
        <ul class="list_menu">
          <li>
            <label  class="list_name" for="name_product">Trạng thái<i class="fas fa-exclamation-circle"></i></label> <br>
            <input type="radio" id="html" name="fav_language" value="HTML">
            <label for="html">HTML</label><br>
            <input type="radio" id="css" name="fav_language" value="CSS">
            <label for="css">CSS</label><br>
          </li>
          <li>
            <label for="info_product">Nội dung<i class="fas fa-exclamation-circle"></i></label> <br>
            <textarea rows="5" placeholder="Nhập thông tin sản phẩm " id="info_product" type="text" ></textarea>
          </li>
        </ul>
        <div class="save">
          <button>Lưu</button>
          <button>Huỷ</button>
        </div>
      </div>
    </div>
   </form>
  <script src="./scripts/index.js"></script>
</html> -->

<?php
include'../../../connect/connect.php';
function formatMoney($number, $fractional=false) {  
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





if(empty($_SESSION['email'])){
  header("location: ../../../login/index.php");
}else{
  $email=$_SESSION['email'];
  $error='';
  $danhmuc = mysqli_query($conn,"SELECT *FROM danhmuc WHERE email_khachhang='$email'");
  if(isset($_POST['luu'])){
    $TENMONAN=$_POST['TENMONAN'];
    $MOTA=$_POST['MOTA'];
    if (isset($_FILES['IMAGE'])){
      $file=$_FILES['IMAGE'];
      $file_name=$file['name'];
      move_uploaded_file($file['tmp_name'],'../../../img-uploads/'.$file_name);
    }
    $TRANGTHAI=$_POST['TRANGTHAI'];
    $GIA=$_POST['GIA'];
    // $GIA=formatMoney($GIA)." vnđ";
    $id_danhmuc=$_POST['TENDANHMUC'];
    if(empty($id_danhmuc)){
      $error='Bạn chọn danh mục';
    }else if(empty($GIA)){
      $error='Bạn chưa nhập giá';
    }else if(empty($MOTA)){
      $error='Bạn chưa nhập mô tả';
    }else if(empty($TENMONAN)){
      $error='Bạn chưa nhập tên món ăn';
    }
    if (empty($error)){
      $now=getdate();
      $ngay_nho=$now['mday'];
      if($ngay_nho<10){
        $ngay_nho='0'.$ngay_nho;
      }
      $thang_nho=$now['mon'];
      if ($thang_nho<10){
        $thang_nho='0'.$thang_nho;
      }
      $NGAYDANG=$ngay_nho.'/'.$thang_nho.'/'.$now['year'].' '.$now['hours'].':'.$now['minutes'].':'.$now['seconds'];
      $sql="INSERT INTO monan(email_khachhang,TENMONAN,MOTA,id_danhmuc,GIA,NGAYDANG,TRANGTHAI,IMAGE) VALUES('$email','$TENMONAN','$MOTA','$id_danhmuc','$GIA','$NGAYDANG','$TRANGTHAI','$file_name')";
      $query=mysqli_query($conn,$sql);
      if($query){
        header("location: ../Quan_ly_san_pham/quan_ly_san_pham.php");
      }
      else{
        $error="Món ăn này đã tồn tại";
      } 
    }
  }else if (isset($_POST['huy'])){
    header("location: ../Quan_ly_san_pham/quan_ly_san_pham.php");
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sản phẩm</title>
    <link rel="stylesheet" href="">
    <link rel="stylesheet" href="../Thong_tin_san_pham/thong_tin_css/thong_tin_san_pham.css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css" integrity="sha384-Bfad6CLCknfcloXFOyFnlgtENryhrpZCe29RTifKEixXQZ38WheV+i/6YWSzkz3V" crossorigin="anonymous" />
    <link rel="stylesheet" href="/Home_main_page/css/reset.css">
</head>

<body>
  <form action=""method="post"enctype="multipart/form-data">
    <div class="thongtin_sanpham_container">
        <div class="header_container">
            <h2>Thêm món ăn</h2>
        </div>
        <div class="body_container">
            <div class="thong_tin">
                <div class="san_pham_moi">
                    <h3>Tên món ăn (*)</h3>
                    <input type="text" id="name"name="TENMONAN" placeholder="Nhập tên món ăn">
                    <div class="error">
                        <a id="mon_an"></a>
                    </div>
                    <h3>Mô tả</h3>
                    <textarea name="MOTA" id="describe" cols="30" rows="10" placeholder="Mô tả món ăn ..."></textarea>
                </div><br>

                <div class="hinh_anh">
                    <h3>Ảnh món ăn (*)</h3>
                    <div class="add_img">
                        <!-- <i class="fas fa-images"></i><br> -->
                        <input type="file"name="IMAGE" value="" id="img" >
                    </div>
                    <div class="error">
                        <a id="img_error"></a>
                    </div>
                </div>
            </div>
            <div class="trang_thai">
                <h3>Trạng thái</h3>
                <input type="radio" name="TRANGTHAI" value="1" checked><a>Hiện</a><br>
                <input type="radio" name="TRANGTHAI" value="2"><a>Ẩn</a><br>
                <h3 style="display: inline;">Giá tiền (*)</h3>
                <a style="color: red" id="idMoney"></a> <br>
                <input type="number" name="GIA" id="money1" class="money" placeholder="Nhập giá tiền">
                <h3>Danh mục</h3>
                <select name="TENDANHMUC" id="type">
                  <option value="">________Tên danh mục________</option>
                  <?php foreach($danhmuc as $key => $value) {?>
                    <option value="<?php echo $value['id_danhmuc'] ?>"><?php echo $value['TENDANHMUC'] ?></option>
                    <?php  }?>
              </select><br>
                <!-- <label for="">Địa chỉ</label><br>
              <input type="text" class="local" placeholder="Địa chỉ nhập món ăn">
              <br>
              <label>Thời gian</label><br>
              <input class="money" id="time" type="datetime-local"> -->
                <div class="save">
                    <button id="save"name="luu" onclick="saveInfo()"><h3>Lưu</h3></button>
                    <button id="cancle"name="huy" onclick="cancleInfo()"><h3>Huỷ</h3></button>
                </div>
                <div class="trung">
                <span><?php echo(isset($error)?$error:'')?></span>
                </div>
            </div>
        </div>
    </div>
  </form>
    <script src="./scripts/index.js"></script>
</body>

</html>