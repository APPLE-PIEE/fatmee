<?php
include'../../../connect/connect.php';
if(empty($_SESSION['email'])){
    header("location: ../../../login/index.php");
}else{
    $id=$_GET['id'];
    $sql="SELECT * FROM monan WHERE id_monan=$id";
    $monan=mysqli_query($conn,$sql);
    $danhsachmonan= mysqli_fetch_assoc($monan);
}
$danhmuc = mysqli_query($conn,"SELECT *FROM DANHMUC WHERE email_khachhang='$email'");
if(isset($_POST['sua'])){
    $TenMonAn=$_POST['TenMonAn'];
    $MOTA=$_POST['MOTA'];
    $TRANGTHAI=$_POST['TRANGTHAI'];
    $GIA=$_POST['GIA'];
    $TENDANHMUC=$_POST['TENDANHMUC'];
    if (isset($_FILES['IMAGE'])){
        $file=$_FILES['IMAGE'];
        $file_name=$file['name'];
        if (empty($file_name)){
            $sql="UPDATE monan  SET TENMONAN='$TenMonAn', MOTA='$MOTA', TRANGTHAI=$TRANGTHAI, GIA='$GIA',id_danhmuc='$TENDANHMUC' where id_monan=$id";
        }else {
            move_uploaded_file($file['tmp_name'],'../../../img-uploads/'.$file_name);
            $sql="UPDATE monan  SET TENMONAN='$TenMonAn', MOTA='$MOTA', TRANGTHAI=$TRANGTHAI, GIA='$GIA',id_danhmuc='$TENDANHMUC', IMAGE='$file_name'where id_monan=$id";
        }
    $query=mysqli_query($conn,$sql);
    if($query) header("location: ../Quan_ly_san_pham/quan_ly_san_pham.php");
    else echo "Lỗi";
    }
}
if(isset($_POST['huy'])){
    header("location: ../Quan_ly_san_pham/quan_ly_san_pham.php");
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin sản phẩm</title>
    <link rel="stylesheet" href="./thong_tin_css/thong_tin_san_pham.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css" integrity="sha384-Bfad6CLCknfcloXFOyFnlgtENryhrpZCe29RTifKEixXQZ38WheV+i/6YWSzkz3V" crossorigin="anonymous"/>
    <link rel="stylesheet" href="/Home_main_page/css/reset.css">
</head>
<body>
    <form action=""method="post"enctype="multipart/form-data">
        <div class="thongtin_sanpham_container">
            <div class="header_container">
                <h2>Sửa món ăn</h2>
            </div>
            <div class="body_container">
                <div class="thong_tin">
                    <div class="san_pham_moi">
                        <h3>Tên món ăn (*)</h3>
                        <input type="text" id="name"name="TenMonAn" value="<?php echo $danhsachmonan['TENMONAN']?>">
                        <div class="error">
                            <a id="mon_an"></a>
                        </div>
                        <h3>Mô tả</h3>
                        <textarea name="MOTA" id="describe" cols="30" rows="10" ><?php echo $danhsachmonan['MOTA']?></textarea>
                    </div><br>
                    
                    <div class="hinh_anh">
                        <h3>Ảnh món ăn (*)</h3>
                        <div class="add_img">
                            <!-- <i class="fas fa-images"></i><br> -->
                            <input type="file" id="img"name="IMAGE">
                            <img src="../../../img-uploads/<?php echo $danhsachmonan['IMAGE']  ?>" alt="" style="width:100px;text-align:left">
                        </div>
                        <div class="error">
                        <a id="img_error"></a>
                        </div>
                    </div>
                </div>
                <div class="trang_thai">
                    <h3>Trạng thái</h3>
                    <input type="radio" name="TRANGTHAI" value="1" <?php echo (($danhsachmonan['TRANGTHAI']==1)?'checked':'')?>>Hiện
                    <input type="radio" name="TRANGTHAI" value="0"<?php echo (($danhsachmonan['TRANGTHAI']==2)?'checked':'' )?>>Ẩn
                    <h3 style="display: inline;">Giá tiền (*)</h3><a style="color: red" id="idMoney"></a> <br>
                    <input type="number" id="money1" class="money" name="GIA"value="<?php echo $danhsachmonan['GIA']?>">
                    <h3>Danh mục</h3>
                    <select name="TENDANHMUC" id="type">
                        <option value="">________Tên danh mục________</option>  
                        <?php foreach($danhmuc as $key => $value) {?>
                            <option value="<?php echo $value['id_danhmuc'] ?>"<?php echo (($value['id_danhmuc']==$danhsachmonan['id_danhmuc'])?'selected':'')?>> 
                        <?php echo $value['TENDANHMUC'] ?></option>
                    <?php  }?>
                    </select><br>
                    <!-- <label for="">Địa chỉ</label><br>
                    <input type="text" class="local" placeholder="Địa chỉ nhập món ăn">
                    <br>
                    <label>Thời gian</label><br>
                    <input class="money" id="time" type="datetime-local"> -->
                    <div class="save">
                    <button id="save" onclick="saveInfo()"name="sua"><h3>Sửa</h3></button>
                    <button id="cancle" onclick="cancleInfo()"name="huy"><h3>Huỷ</h3></button>
                    </div>
                    <div class="trung">
                        <span>Món ăn đã tồn tại</span>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <script src="./thong_tinJS/thong_tin_san_pham.js"></script>
</body>
</html>