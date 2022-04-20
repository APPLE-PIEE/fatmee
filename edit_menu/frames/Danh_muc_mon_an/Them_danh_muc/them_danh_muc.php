<?php
    include'../../../../connect/connect.php';
    $email=$_SESSION['email'];
    $error='';
    if (isset($_POST['luu'])){
        $TENDANHMUC=$_POST['TENDANHMUC'];
        $MOTA=$_POST['MOTA'];
        $TRANGTHAI=$_POST['TRANGTHAI'];
        if(empty($MOTA)){
            $error="Mô tả không được để trống";
        }
        if(empty($TENDANHMUC)){
            $error="Tên danh mục không được để trống";
        }
        if (empty($error)){
            
            $now=getdate();
            $NGAYDANG=$now['mday'].'/'.$now['mon'].'/'.$now['year'].' '.$now['hours'].':'.$now['minutes'].':'.$now['seconds'];
            $sql="INSERT INTO danhmuc (email_khachhang,TENDANHMUC,MOTA,TRANGTHAI,NGAYDANG) VALUES ('$email','$TENDANHMUC','$MOTA','$TRANGTHAI','$NGAYDANG')";
            $query=mysqli_query($conn,$sql);
            if ($query==false) $error='Đã có danh mục này';
            else{
                header("location:../danh_muc_mon_an.php");
            }
        }
    }else if (isset($_POST['huy'])){
        header("location:../danh_muc_mon_an.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm danh mục</title>
    <link rel="stylesheet" href="/Home_main_page/css/reset.css">
    <link rel="stylesheet" href="./css/them_danh_muc.css">
</head>
<body>
    <form action=""method="post">
        <script src="./js/them_danh_muc.js"></script>
        <div class="them_ma_container">
            <div class="title">
                <ul>
                    <li><h2>Thêm danh mục sản phẩm</h2></li>
                    <li class="right">
                        <button onclick="save()"name="luu">Lưu</button>
                    </li>
                    <li class="right">
                        <button onclick="cancle()"name="huy">Huỷ</button>
                    </li>
                </ul>
            </div>
            <div class="main">
                <div class="content">
                    <div class="left">
                        <label for="">Tên danh mục (*)</label><a id="show_error"></a><br>
                        <input class="ten" type="text" id="name"name="TENDANHMUC" placeholder="Nhập tên danh mục" autofocus><br>
                        <label for="">Mô tả (*)</label><a id="content_error"></a><br>
                        <textarea id="descript"name="MOTA" cols="30" rows="10" placeholder="Nhập nội dung danh mục sản phẩm"></textarea><br>
                    </div>
                    <div class="right">
                        <label for="">Trạng thái</label><br>
                        <input type="radio" name="TRANGTHAI" checked="checked" value="1">Hiện
                        <input type="radio" name="TRANGTHAI" value="2">Ẩn
                        <!-- <select name="" id="">
                            <option value="">Đang áp dụng</option>
                            <option value="">Sắp xảy ra</option>
                            <option value="">Ngưng áp dụng</option>
                        </select> -->
                        <br>
                        <!-- <label for="">Thời gian (*)</label><br>
                        <input type="date" class="date_time" id="date">
                        <p style="color: red" id="error"></p> -->
                        <br>
                    </div>
                </div>
            </div>
        </div>
        <span class="error sub-text"><?php echo(isset($error)?$error:'')?></span>
    </form>
</body>
</html>