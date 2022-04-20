<?php
include'../../../../connect/connect.php';
if(empty($_SESSION['email'])){
    header("location: ../../../../login/index.php");
}else{
    $email=$_SESSION['email'];
    $chuongtrinh_khuyenmai=mysqli_query($conn,"SELECT *FROM chuongtrinh_khuyenmai WHERE email_khachhang='$email'");


    if (isset($_POST['luu'])){
        $error='';
        $TENMAKHUYENMAI=$_POST['TENMAKHUYENMAI'];
        $APDUNG=isset($_POST['APDUNG'])?'1':'0';
        $id_chuongtrinh=isset($_POST['id_chuongtrinh'])?$_POST['id_chuongtrinh']:'0';
        $GIATRIKHUYENMAI=$_POST['GIATRIKHUYENMAI'];
        $GIATRIGIAMTOIDA=$_POST['GIATRIGIAMTOIDA'];
        $DIEUKIEN=$_POST['DIEUKIEN'];
        if ($DIEUKIEN==3){
            $DK_SOLUONG=$_POST['DK_SOLUONG'];
        }else {
            $DK_SOLUONG='';
        }
        $GIOIHAN=$_POST['GIOIHAN'];
        if ($GIOIHAN==2){
            $GH_SOLUONG=$_POST['GH_SOLUONG'];
        }else {
            $GH_SOLUONG='';
        } 
        $THOIGIAN_BATDAU=$_POST['THOIGIAN_BATDAU'];
        $THOIGIAN_KETTHUC=$_POST['THOIGIAN_KETTHUC'];
        $TONGGIAY_BATDAU=strtotime($THOIGIAN_BATDAU);
        $TONGGIAY_KETTHUC=strtotime($THOIGIAN_KETTHUC);
        if (empty($TENMAKHUYENMAI)){
            $error="Tên mã khuyến mãi không được để trống";
        }else if (empty($GIATRIKHUYENMAI)){
            $error="Giá trị khuyến mãi không được để trống";
        }else if (empty($GIATRIGIAMTOIDA)){
            $error="Giá trị giảm tối đa không được để trống";
        }else if (empty($THOIGIAN_BATDAU)){
            $error="Thời gian bắt đầu không được để trống";
        }else if (empty($THOIGIAN_KETTHUC)){
            $error="Thời gian kết thúc không được để trống";
        }else if ($THOIGIAN_BATDAU>$THOIGIAN_KETTHUC){
            $error="Thời gian kết thúc không được nhỏ hơn thời gian bắt đầu";
        }else if (empty($error)){
            $sql="INSERT INTO ma_khuyenmai(email_khachhang,TENMAKHUYENMAI,id_chuongtrinh,GIATRIKHUYENMAI,GIATRIGIAMTOIDA,DIEUKIEN,DK_SOLUONG,GIOIHAN,GH_SOLUONG,THOIGIAN_BATDAU,TONGGIAY_BATDAU,THOIGIAN_KETTHUC,TONGGIAY_KETTHUC) VALUES ('$email','$TENMAKHUYENMAI','$id_chuongtrinh','$GIATRIKHUYENMAI','$GIATRIGIAMTOIDA','$DIEUKIEN','$DK_SOLUONG','$GIOIHAN','$GH_SOLUONG','$THOIGIAN_BATDAU','$TONGGIAY_BATDAU','$THOIGIAN_KETTHUC','$TONGGIAY_KETTHUC')";
            $query=mysqli_query($conn,$sql);
            if ($query==false){
                $error="Mã này đã tồn tài";
            }else {
                header("location:../khuyen_mai.php");
            }
        }
    }else if (isset($_POST['huy'])){
        header("location:../khuyen_mai.php");
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
    <link rel="stylesheet" href="./css/them_ma.css">
    <link rel="stylesheet" href="/Home_main_page/css/reset.css">
</head>
<body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <form action=""method="post">
        <div class="them_ma_container">
            <div class="title">
                <ul>
                    <li>
                        <h2>Thêm mã khuyến mãi</h2>
                    </li>
                    <li class="right">
                        <button name="luu">Lưu</button>
                    </li>
                    <li class="right">
                        <button onclick="cancle()"name="huy">Huỷ</button>
                    </li>
                </ul>
            </div>
            <div class="main">
                <div class="create_code">
                    <h2>Mã khuyến mãi (*)</h2>
                    <input class="create_code_input" type="text" id="code"name="TENMAKHUYENMAI" placeholder="Nhập mã khuyến mãi">
                    <a id="code_cr"></a>
                    <p>Khách hàng sẽ nhập mã khuyến mãi này ở màn hình thanh toán</p>
                    <input class="create_code_checkbox" type="checkbox" id="checkBoxDanhMuc" onclick="CheckBox2()"name="APDUNG"><a style="color: black">Áp dụng cùng với chương trình khuyến mãi</a>
                    <div id="checkbox_danh_muc" class="hide_select">
                        <select name="id_chuongtrinh" id="">
                            <option value="" disabled selected>Tên chương trình</option>
                            <?php foreach($chuongtrinh_khuyenmai as $key => $value) {?>
                                <option value="<?php echo $value['id_chuongtrinh'] ?>"><?php echo $value['TENCHUONGTRINH'] ?></option>
                            <?php  }?>
                        </select>
                    </div>
                    <br>
                </div>
                <div class="value" style="height: 25rem">
                    <h2>Giá trị (*)</h2>
                    <div class="part1">
                        <p>Giá trị khuyến mãi (%)</p>
                        <input type="number" name="GIATRIKHUYENMAI" id="valueKM">
                        <a id="value1"></a>
                    </div>
                    <div class="part1">
                        <p>Giá trị giảm tối đa</p>
                        <input type="number" name="GIATRIGIAMTOIDA" id="valueMax">
                        <a id="value2"></a>
                    </div>
                </div>
                <div class="apply_condition">
                    <h2>Điều kiện áp dụng cho</h2>
                    <input type="radio" id="" value="1" checked name="DIEUKIEN">Không có<br>
                    
                    <input type="radio" id="" value="2" name="DIEUKIEN">Tổng giá trị đơn hàng tối thiểu<br>
                    <input type="radio" name="DIEUKIEN" value="3" id="apply_4">Tổng số lượng sản phẩm được khuyến mãi tối thiểu
                    <div id="show">
                        <input class="count" type="number" name="DK_SOLUONG" placeholder="Nhập số lượng" id="showid">
                        <a id="value_error"></a>
                    </div>
                </div>
                <div class="max_value">
                    <h2>Giới hạn sử dụng</h2>
                    <input type="radio" checked  name="GIOIHAN"value="1">Giới hạn mỗi lần khách hàng chỉ sử dụng mã giảm giá này 1 lần
                    <br>
                    <input type="radio" id="showCheckBox" name="GIOIHAN"value="2" onclick="CheckBox()">Giới hạn số lần mã giảm giá được áp dụng
                    <div id="show_checkbox" class="hide_checkbox">
                        <input class="count" type="number"name="GH_SOLUONG" placeholder="Nhập số lượng" id="num">
                        <a id="count1"></a>
                    </div>
                    
                </div>
                <div class="time">
                    <h2>Thời gian (*)</h2>
                    <div class="part1_time">
                        <label for="">Thời gian bắt đầu</label><br>
                        <input type="datetime-local"name="THOIGIAN_BATDAU" id="timeStart">
                        <a id="time1"></a>
                    </div>
                    <div class="part1_time">
                        <label for="">Thời gian kết thúc</label><br>
                        <input type="datetime-local"name="THOIGIAN_KETTHUC" id="timeEnd">
                        <a id="time2"></a>
                    </div>
                </div>
            </div>
            <span class="error sub-text"><?php echo(isset($error)?$error:'')?></span>
        </div>
    </form>
    <script src="./them_ma_js/them_ma.js"></script>
</body>
</html>