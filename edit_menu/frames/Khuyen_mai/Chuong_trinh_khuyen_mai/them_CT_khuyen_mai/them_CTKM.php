<?php
include'../../../../../connect/connect.php';
$error='';
$email=$_SESSION['email'];
if(isset($_POST['tenchuongtrinh'])){
    $tenchuongtrinh=$_POST['tenchuongtrinh'];
    $loaikhuyenmai=$_POST['loaikhuyenmai'];
    $thoigian_batdau=$_POST['thoigian_batdau'];
    $thoigian_ketthuc=$_POST['thoigian_ketthuc'];
    $tonggiay_batdau=strtotime($thoigian_batdau);
    $tonggiay_ketthuc=strtotime($thoigian_ketthuc);
    if($tenchuongtrinh==''){
        $error="Tên chương trình không được để trống";
    }
    else if($thoigian_batdau==''){
        $error="Thời gian bắt đầu không được để trống";
    }
    else if($thoigian_ketthuc==''){
        $error="Thời gian kết thúc không được để trống";
    }
    else if($thoigian_ketthuc < $thoigian_batdau){
        $error="Thời gian kết thúc không được nhỏ hơn thời gian bắt đầu";
    }
    else if(empty($error)){
        $sql="INSERT INTO chuongtrinh_khuyenmai(email_khachhang,TENCHUONGTRINH,LOAIKHUYENMAI,THOIGIAN_BATDAU,TONGGIAY_BATDAU,THOIGIAN_KETTHUC,TONGGIAY_KETTHUC) VALUES ('$email','$tenchuongtrinh','$loaikhuyenmai','$thoigian_batdau','$tonggiay_batdau','$thoigian_ketthuc','$tonggiay_ketthuc')";
        $query=mysqli_query($conn,$sql);
        if ($query==false) $error='error:Đã có danh mục này';
        else header('location: ../chuong_trinh_khuyen_mai.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Mã Khuyến Mãi</title>
    <link rel="stylesheet" href="./css/CTKM.css">
</head>
<body>

    <form action=""method="post">
        <div class="them_ma_container">
            <div class="title">
                <ul>
                    <li>
                        <h2>Thêm chương trình khuyến mãi</h2>
                    </li>
                    <li class="right">
                        <button type="submit">Lưu</button>
                    </li>
                    <li class="right">
                        <button type="submit" onclick="cancle()">Huỷ</button>
                    </li>
                </ul>
            </div>
            <div class="main">
                <div class="create_code">
                    <h2>Tên chương trình khuyến mãi</h2>
                    <input class="create_code_input" type="text" id=""name="tenchuongtrinh" placeholder="Nhập tên chương trình khuyến mãi">
                    <!-- <p>Khách hàng sẽ nhập mã khuyến mãi này ở màn hình thanh toán</p> -->
                    <!-- <input class="create_code_checkbox" type="checkbox"><a>Áp dụng cùng với chương trình khuyến mãi</a> -->
                </div>
                <div class="apply_condition">
                    <h2>Ap dụng cho</h2>
                    <input type="radio"name="loaikhuyenmai"value="1"checked="checked">Tất cả món ăn<br>
                    <input type="radio"name="loaikhuyenmai"value="2">Danh mục món ăn<br>
                    <input type="radio"name="loaikhuyenmai"value="3">Món ăn<br>
                </div>
                <div class="time">
                    <h2>Thời gian</h2>
                    <div class="part1_time">
                        <label for="">Thời gian kết thúc</label><br>
                        <input type="datetime-local"name="thoigian_ketthuc"><br>
                    </div>
                    <div class="part1_time">
                        <label for="">Thời gian bắt đầu</label><br>
                        <input type="datetime-local"name="thoigian_batdau">
                    </div>
                </div>
            </div>
        </div>
        
    </form>
    <span class="error sub-text"><?php echo(isset($error)?$error:'')?></span>
    <script src="./js/CTKM.js"></script>
</body>
</html>