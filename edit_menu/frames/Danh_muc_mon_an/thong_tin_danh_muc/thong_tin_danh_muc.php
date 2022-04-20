<?php
    include'../../../../connect/connect.php';
    if(empty($_SESSION['email'])){
        header("location: ../../../login/index.php");
    }else{
        $id=$_GET['id'];
        $sql="SELECT * FROM danhmuc WHERE id_danhmuc=$id";
        $danhmuc=mysqli_query($conn,$sql);
        $danhsach= mysqli_fetch_assoc($danhmuc);
    
        if(isset($_POST['sua'])){
            $TENDANHMUC=$_POST['TENDANHMUC'];
            $MOTA=$_POST['MOTA'];
            $TRANGTHAI=$_POST['TRANGTHAI'];
            $sql="UPDATE danhmuc  SET TENDANHMUC='$TENDANHMUC', MOTA='$MOTA', TRANGTHAI='$TRANGTHAI' where id_danhmuc=$id";
            $query=mysqli_query($conn,$sql);
            if($query) header("location: ../danh_muc_mon_an.php");
            else echo "Lỗi";
            }
        if(isset($_POST['huy'])){
            header("location: ../danh_muc_mon_an.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin danh mục</title>
    <link rel="stylesheet" href="/Home_main_page/css/reset.css">
    <link rel="stylesheet" href="../Them_danh_muc/css/them_danh_muc.css">
</head>

<body>
    <script src="./js/thong_tin_danh_muc.js"></script>
    <form action=""method="post">
        <div class="them_ma_container">
            <div class="title">
                <ul>
                    <li>
                        <h2>Thông tin danh mục sản phẩm</h2>
                    </li>
                    <li class="right">
                        <button onclick="save()"name="sua">Sửa</button>
                    </li>
                    <li class="right">
                        <button onclick="cancle()"name="huy">Huỷ</button>
                    </li>
                </ul>
            </div>
            <div class="main">
                <div class="content">
                    <div class="left">
                        <label for="">Tên danh mục (*)</label>
                        <a id="show_error"></a><br>
                        <input class="ten" type="text" id="name"name="TENDANHMUC" value="<?php echo $danhsach['TENDANHMUC']?>"><br>
                        <label for="">Mô tả (*)</label>
                        <a id="content_error"></a><br>
                        <textarea name="MOTA" id="descript" cols="30" rows="10" ><?php echo $danhsach['MOTA']?></textarea>
                        <br>
                    </div>
                    <div class="right">
                        <label for="">Trạng thái</label><br>
                        <input type="radio" name="TRANGTHAI" value="1" <?php echo (($danhsach['TRANGTHAI']==1)?'checked':'')?>>Hiện
                        <input type="radio" name="TRANGTHAI" value="0"<?php echo (($danhsach['TRANGTHAI']==2)?'checked':'' )?>>Ẩn
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>

</html>