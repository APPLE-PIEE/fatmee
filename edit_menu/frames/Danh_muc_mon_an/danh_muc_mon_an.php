<?php
include'../../../connect/connect.php';
if(empty($_SESSION['email'])){
    header("location: ../../../login/index.php");
}else{
    $email=$_SESSION['email'];
    $sql="SELECT *FROM danhmuc WHERE email_khachhang= '$email'";
    $danhmucmonan = mysqli_query($conn,$sql);
    if (isset($_POST['xoa_all'])){
        require_once("xoa_nhieu.php");
    }
    if (isset($_POST['timkiem'])){
        if (!empty($_POST['TK_tu_khoa'])&&empty($_POST['TK_ngay_dang'])&&empty($_POST['TK_trang_thai'])){
            $TK_tu_khoa=$_POST['TK_tu_khoa'];
            $sql="SELECT * FROM danhmuc WHERE email_khachhang='$email' AND TENDANHMUC LIKE '%$TK_tu_khoa%';";
        }else if(empty($_POST['TK_tu_khoa'])&&!empty($_POST['TK_ngay_dang'])&&!empty($_POST['TK_trang_thai'])){
            if (isset($_POST['TK_ngay_dang'])){
                $ngay=$_POST['TK_ngay_dang'];
                $tach_ngay = explode("-", $ngay);
                $TK_ngay_dang=$tach_ngay[2].'/'.$tach_ngay[1].'/'.$tach_ngay[0]; 
            }
            $TK_trang_thai=$_POST['TK_trang_thai'];
            $sql="SELECT * FROM danhmuc WHERE email_khachhang='$email' AND NGAYDANG LIKE '%$TK_ngay_dang%'AND TRANGTHAI = '$TK_trang_thai';";
        }else if(empty($_POST['TK_tu_khoa'])&&empty($_POST['TK_ngay_dang'])&&!empty($_POST['TK_trang_thai'])){
            $TK_trang_thai=$_POST['TK_trang_thai'];
            $sql="SELECT * FROM danhmuc WHERE email_khachhang='$email' AND TRANGTHAI = '$TK_trang_thai';";
        }else if(empty($_POST['TK_tu_khoa'])&&!empty($_POST['TK_ngay_dang'])&&empty($_POST['TK_trang_thai'])){
            if (isset($_POST['TK_ngay_dang'])){
                $ngay=$_POST['TK_ngay_dang'];
                $tach_ngay = explode("-", $ngay);
                $TK_ngay_dang=$tach_ngay[2].'/'.$tach_ngay[1].'/'.$tach_ngay[0]; 
            }
            $sql="SELECT * FROM danhmuc WHERE email_khachhang='$email' AND NGAYDANG LIKE '%$TK_ngay_dang%';";
        }else if (!empty($_POST['TK_tu_khoa'])&&!empty($_POST['TK_ngay_dang'])&&empty($_POST['TK_trang_thai'])){
            $TK_tu_khoa=$_POST['TK_tu_khoa'];
            if (isset($_POST['TK_ngay_dang'])){
                $ngay=$_POST['TK_ngay_dang'];
                $tach_ngay = explode("-", $ngay);
                $TK_ngay_dang=$tach_ngay[2].'/'.$tach_ngay[1].'/'.$tach_ngay[0]; 
            }
            $sql="SELECT * FROM danhmuc WHERE email_khachhang='$email' AND TENDANHMUC LIKE '%$TK_tu_khoa%'AND NGAYDANG LIKE '%$TK_ngay_dang%';";
        }else if (!empty($_POST['TK_tu_khoa'])&&empty($_POST['TK_ngay_dang'])&&!empty($_POST['TK_trang_thai'])){
            $TK_tu_khoa=$_POST['TK_tu_khoa'];
            $TK_trang_thai=$_POST['TK_trang_thai'];
            $sql="SELECT * FROM danhmuc WHERE email_khachhang='$email' AND TENDANHMUC LIKE '%$TK_tu_khoa%' AND TRANGTHAI = '$TK_trang_thai';";
        }else if(!empty($_POST['TK_tu_khoa'])&&!empty($_POST['TK_ngay_dang'])&&!empty($_POST['TK_trang_thai'])){
            if (isset($_POST['TK_ngay_dang'])){
                $TK_tu_khoa=$_POST['TK_tu_khoa'];
                $ngay=$_POST['TK_ngay_dang'];
                $tach_ngay = explode("-", $ngay);
                $TK_ngay_dang=$tach_ngay[2].'/'.$tach_ngay[1].'/'.$tach_ngay[0]; 
            }
            $TK_trang_thai=$_POST['TK_trang_thai'];
            $sql="SELECT * FROM danhmuc WHERE email_khachhang='$email' AND NGAYDANG LIKE '%$TK_ngay_dang%'AND TRANGTHAI = '$TK_trang_thai'AND TENDANHMUC LIKE '%$TK_tu_khoa%';";
        }
        $danhmucmonan = mysqli_query($conn,$sql);
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Danh mục sản phầm</title>
    <link rel="stylesheet" href="./css/danh_muc_mon_an.css">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600;1,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css" integrity="sha384-Bfad6CLCknfcloXFOyFnlgtENryhrpZCe29RTifKEixXQZ38WheV+i/6YWSzkz3V" crossorigin="anonymous" />
    <link rel="stylesheet" href="/Home_main_page/css/reset.css" />
    <style>
.header a {
    float: right;
    margin-right: 1rem;
    margin-top: -3.5rem;
    border: none;
    background-color: var(--color-primary);
    width: 15rem;
    color: white;
    border-radius: 5px;
    text-decoration: none;
    text-align:center;
}

.header a:hover {
    background-color: var(--color-button-hover);
}

    </style>


</head>

<body>
    <script src="./js/danh_muc_mon_an.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#select_all').on('click', function() {
                if (this.checked) {
                    $('.checkbox').each(function() {
                        this.checked = true;
                    });
                } else {
                    $('.checkbox').each(function() {
                        this.checked = false;
                    });
                }
            });
            $('.checkbox').on('click', function() {
                if ($('.checkbox:checked').length == $('.checkbox').length) {
                    $('#select_all').prop('checked', true);
                } else {
                    $('#select_all').prop('checked', false);
                }
            });
        });
    </script>
    <!-- <img src="/edit_menu/frames/Danh_muc_mon_an/Them_danh_muc/them_danh_muc.html" alt=""> -->
    <form action=""method="post">
        <div class="khuyen_mai_container">
            <div class="header">
                <h3>Danh mục món ăn</h3>
                <a href="Them_danh_muc/them_danh_muc.php"name="them_danh_muc">Thêm danh mục</a>
            </div>
            <div class="sap_xep">
                <ul>
                    <li>
                        <a>Tên Danh Mục</a>
                        <input class="time" name="TK_tu_khoa" type="text" placeholder="Nhập tên danh mục" />
                    </li>
                    <!-- <li>
                        <select name="" id="">
                            <option value="" disabled selected>Loại danh mục</option>
                            <option value="">Sinh nhật</option>
                            <option value="">Quốc tế phụ nữ</option>
                            <option value="">Đám cưới</option>
                            <option value="">Tiệc tại gia</option>
                        </select>
                    </li> -->
                    <li>
                        <select name="TK_trang_thai" id="">
                            <option value="" disabled selected>Trạng thái</option>
                            <option value="1">Hiện</option>
                            <option value="2">Ẩn</option>
                        </select>
                    </li>
                    <li>
                        <a>Ngày bắt đầu</a>
                        <input class="time" name="TK_ngay_dang"type="date" />
                    </li>
                    <li>
                        <button class="btn_search"name="timkiem">Tìm kiếm</button>
                    </li>
                </ul>
                <div class="scroll_table">
                    <table>
                        <thead>
                            <tr>
                                <th class="checked_btn"><input class="all" type="checkbox" id="select_all" /> All</th>
                                <th>STT</th>
                                <th>Tên danh mục</th>
                                <th>Trạng thái</th>
                                <th>Ngày đăng</th>
                                <th class="more_button_col"></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($danhmucmonan as $key=>$value)  { ?>   
                        <tr>
                            <td class="checked_btn">
                                <input type="checkbox"name="del[]"value="<?php echo $value['id_danhmuc']?>" class="checkbox" />
                            </td>
                            <td><?php echo$key+1 ?></td>
                            <td><?php echo $value['TENDANHMUC']   ?></td>
                            <?php if ($value['TRANGTHAI']==1){ ?>
                                <td>Hiện</td>
                            <?php } else {?>
                                <td>Ẩn</td>
                            <?php }?>
                            <td><?php echo $value['NGAYDANG']?></td>
                            <td class="more_button_col">
                                <div class="dropdown_more_btn">
                                    <button class="more_button">
                                        <a><i class="fas fa-ellipsis-h"></i></a>
                                    </button>
                                    <div class="dropdown_content">
                                        <a href="xoa_danh_muc.php?id=<?php echo $value['id_danhmuc']; ?>"><i class="fas fa-trash-alt"></i>Xoá</a>
                                        <a href="./thong_tin_danh_muc/thong_tin_danh_muc.php?id=<?php echo $value['id_danhmuc']; ?>"><i class="fas fa-info"></i>Sửa</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php   }?>
                    </tbody>
                </table>
            </div>
            <button name="xoa_all"class="btn_del">Xoá tất cả</button>
        </div>
    </form>
</body>
</html>