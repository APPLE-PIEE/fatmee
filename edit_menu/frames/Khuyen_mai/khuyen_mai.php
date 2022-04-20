<?php
include'../../../connect/connect.php';
if(empty($_SESSION['email'])){
    header("location: ../../../login/index.php");
}else{
    $email=$_SESSION['email'];
    $sql="SELECT * FROM ma_khuyenmai  WHERE email_khachhang='$email'";
    $query=mysqli_query($conn,$sql);
    if (isset($_POST['them'])){
        header("location: them_ma/them_ma.php");
    }
    if (isset($_POST['timkiem'])){
        if (empty($_POST['TK_trang_thai'])&&!empty($_POST['TK_bat_dau'])&&!empty($_POST['TK_ket_thuc'])){
            if (isset($_POST['TK_bat_dau'])){
                $ngay=$_POST['TK_bat_dau'];
                $tach_ngay = explode("-", $ngay);
                $TK_bat_dau=$tach_ngay[0].'-'.$tach_ngay[1].'-'.$tach_ngay[2]; 
            }
            if (isset($_POST['TK_ket_thuc'])){
                $ngay=$_POST['TK_ket_thuc'];
                $tach_ngay = explode("-", $ngay);
                $TK_ket_thuc=$tach_ngay[0].'-'.$tach_ngay[1].'-'.$tach_ngay[2]; 
            }
            $sql="SELECT * FROM ma_khuyenmai WHERE email_khachhang='$email' AND THOIGIAN_BATDAU LIKE '%$TK_bat_dau%' AND THOIGIAN_KETTHUC LIKE '%$TK_ket_thuc%';";
        }else if (empty($_POST['TK_trang_thai'])&&!empty($_POST['TK_bat_dau'])&&empty($_POST['TK_ket_thuc'])){
            if (isset($_POST['TK_bat_dau'])){
                $ngay=$_POST['TK_bat_dau'];
                $tach_ngay = explode("-", $ngay);
                $TK_bat_dau=$tach_ngay[0].'-'.$tach_ngay[1].'-'.$tach_ngay[2]; 
            }
            $sql="SELECT * FROM ma_khuyenmai WHERE email_khachhang='$email' AND THOIGIAN_BATDAU LIKE '%$TK_bat_dau%';";
        }else if (empty($_POST['TK_trang_thai'])&&!empty($_POST['TK_bat_dau'])&&empty($_POST['TK_ket_thuc'])){
            if (isset($_POST['TK_ket_thuc'])){
                $ngay=$_POST['TK_ket_thuc'];
                $tach_ngay = explode("-", $ngay);
                $TK_ket_thuc=$tach_ngay[0].'-'.$tach_ngay[1].'-'.$tach_ngay[2]; 
            }
            $sql="SELECT * FROM ma_khuyenmai WHERE email_khachhang='$email' AND THOIGIAN_KETTHUC LIKE '%$TK_ket_thuc%';";
        }else if (!empty($_POST['TK_trang_thai'])&&empty($_POST['TK_bat_dau'])&&empty($_POST['TK_ket_thuc'])){
            $TK_trang_thai=$_POST['TK_trang_thai'];
            $hientai=time();
            if ($TK_trang_thai==1){
                $sql="SELECT * FROM ma_khuyenmai WHERE email_khachhang='$email' AND TONGGIAY_BATDAU < '$hientai' AND TONGGIAY_KETTHUC >'$hientai';";
            } else if ($TK_trang_thai==2){
                $sql="SELECT * FROM ma_khuyenmai WHERE email_khachhang='$email' AND TONGGIAY_BATDAU > '$hientai' AND TONGGIAY_KETTHUC >'$hientai';";
            } else {
                $sql="SELECT * FROM ma_khuyenmai WHERE email_khachhang='$email' AND TONGGIAY_BATDAU < '$hientai' AND TONGGIAY_KETTHUC <'$hientai';";
            }
        }else if (!empty($_POST['TK_trang_thai'])&&empty($_POST['TK_bat_dau'])&&!empty($_POST['TK_ket_thuc'])){
            if (isset($_POST['TK_ket_thuc'])){
                $ngay=$_POST['TK_ket_thuc'];
                $tach_ngay = explode("-", $ngay);
                $TK_ket_thuc=$tach_ngay[0].'-'.$tach_ngay[1].'-'.$tach_ngay[2]; 
            }
            $TK_trang_thai=$_POST['TK_trang_thai'];
            $hientai=time();
            if ($TK_trang_thai==1){
                $sql="SELECT * FROM ma_khuyenmai WHERE email_khachhang='$email' AND TONGGIAY_BATDAU < '$hientai' AND TONGGIAY_KETTHUC >'$hientai'AND THOIGIAN_KETTHUC LIKE '%$TK_ket_thuc%';";
            } else if ($TK_trang_thai==2){
                $sql="SELECT * FROM ma_khuyenmai WHERE email_khachhang='$email' AND TONGGIAY_BATDAU > '$hientai' AND TONGGIAY_KETTHUC >'$hientai'AND THOIGIAN_KETTHUC LIKE '%$TK_ket_thuc%';";
            } else {
                $sql="SELECT * FROM ma_khuyenmai WHERE email_khachhang='$email' AND TONGGIAY_BATDAU < '$hientai' AND TONGGIAY_KETTHUC <'$hientai'AND THOIGIAN_KETTHUC LIKE '%$TK_ket_thuc%';";
            }
        }else if (!empty($_POST['TK_trang_thai'])&&!empty($_POST['TK_bat_dau'])&&empty($_POST['TK_ket_thuc'])){
            if (isset($_POST['TK_bat_dau'])){
                $ngay=$_POST['TK_bat_dau'];
                $tach_ngay = explode("-", $ngay);
                $TK_bat_dau=$tach_ngay[0].'-'.$tach_ngay[1].'-'.$tach_ngay[2]; 
            }
            $TK_trang_thai=$_POST['TK_trang_thai'];
            $hientai=time();
            if ($TK_trang_thai==1){
                $sql="SELECT * FROM ma_khuyenmai WHERE email_khachhang='$email' AND TONGGIAY_BATDAU < '$hientai' AND TONGGIAY_KETTHUC >'$hientai'AND THOIGIAN_BATDAU LIKE '%$TK_bat_dau%';";
            } else if ($TK_trang_thai==2){
                $sql="SELECT * FROM ma_khuyenmai WHERE email_khachhang='$email' AND TONGGIAY_BATDAU > '$hientai' AND TONGGIAY_KETTHUC >'$hientai'AND THOIGIAN_BATDAU LIKE '%$TK_bat_dau%';";
            } else {
                $sql="SELECT * FROM ma_khuyenmai WHERE email_khachhang='$email' AND TONGGIAY_BATDAU < '$hientai' AND TONGGIAY_KETTHUC <'$hientai'AND THOIGIAN_BATDAU LIKE '%$TK_bat_dau%';";
            }
        }else if (!empty($_POST['TK_trang_thai'])&&!empty($_POST['TK_bat_dau'])&&!empty($_POST['TK_ket_thuc'])){
            if (isset($_POST['TK_bat_dau'])){
                $ngay=$_POST['TK_bat_dau'];
                $tach_ngay = explode("-", $ngay);
                $TK_bat_dau=$tach_ngay[0].'-'.$tach_ngay[1].'-'.$tach_ngay[2]; 
            }
            if (isset($_POST['TK_ket_thuc'])){
                $ngay=$_POST['TK_ket_thuc'];
                $tach_ngay = explode("-", $ngay);
                $TK_ket_thuc=$tach_ngay[0].'-'.$tach_ngay[1].'-'.$tach_ngay[2]; 
            }
            $TK_trang_thai=$_POST['TK_trang_thai'];
            $hientai=time();
            if ($TK_trang_thai==1){
                $sql="SELECT * FROM ma_khuyenmai WHERE email_khachhang='$email' AND TONGGIAY_BATDAU < '$hientai' AND TONGGIAY_KETTHUC >'$hientai'AND THOIGIAN_BATDAU LIKE '%$TK_bat_dau%'AND THOIGIAN_BATDAU LIKE '%$TK_bat_dau%';";
            } else if ($TK_trang_thai==2){
                $sql="SELECT * FROM ma_khuyenmai WHERE email_khachhang='$email' AND TONGGIAY_BATDAU > '$hientai' AND TONGGIAY_KETTHUC >'$hientai'AND THOIGIAN_BATDAU LIKE '%$TK_bat_dau%'AND THOIGIAN_BATDAU LIKE '%$TK_bat_dau%';";
            } else {
                $sql="SELECT * FROM ma_khuyenmai WHERE email_khachhang='$email' AND TONGGIAY_BATDAU < '$hientai' AND TONGGIAY_KETTHUC <'$hientai'AND THOIGIAN_BATDAU LIKE '%$TK_bat_dau%'AND THOIGIAN_BATDAU LIKE '%$TK_bat_dau%';";
            }
        }
        $query=mysqli_query($conn,$sql);
    }
    if (isset($_POST['xoa_all'])){
        require_once("xoa_nhieu.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Khuyến mãi</title>
    <link rel="stylesheet" href="./khuyen_mai_css/khuyen_mai.css">
    <link rel="stylesheet" href="/Home_main_page/css/reset.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css" integrity="sha384-Bfad6CLCknfcloXFOyFnlgtENryhrpZCe29RTifKEixXQZ38WheV+i/6YWSzkz3V" crossorigin="anonymous" />
</head>

<body>
    <script src="./khuyen_mai_js/khuyen_mai.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>


    <script type="text/javascript">
        $(document).ready(function() {
            $('#select_all').on('click', function() {
                if (this.checked) {
                    $('.checkbox-con').each(function() {
                        this.checked = true;
                    });
                } else {
                    $('.checkbox-con').each(function() {
                        this.checked = false;
                    });
                }
            });

            $('.checkbox-con').on('click', function() {
                if ($('.checkbox-con:checked').length == $('.checkbox-con').length) {
                    $('#select_all').prop('checked', true);
                } else {
                    $('#select_all').prop('checked', false);
                }
            });
        });
    </script>


    <form action="" method="post">
        <div class="khuyen_mai_container">
            <div class="header">
                <h3>Mã khuyến mãi</h3>
                <!-- <button onclick="KhuyenMai()">Thêm phiếu giảm giá</button> -->
                <button name="them">Thêm phiếu giảm giá</button>
            </div>
            <div class="sap_xep">
                <ul>
                    <!-- <li><input type="checkbox" class="all"> All</li> -->
                    <!-- <li>
                        <select name="" id="">
                            <option value="" disabled selected>Loại khuyến mãi</option>
                            <option value="">Freeship</option>
                            <option value="">Mua 1 tặng 1</option>
                            <option value="">Giảm giá</option>
                            
                        </select>
                    </li> -->
                    <li>
                        <select name="TK_trang_thai" id="">
                            <option value="" disabled selected>Trạng thái</option>
                            <option value="1">Đang áp dụng</option>
                            <option value="2">Sắp diễn ra</option>
                            <option value="3">Mã hết hạn</option>
                        </select>
                    </li>
                    <li>
                        <a>Thời gian bắt đầu</a>
                        <input class="time" name="TK_bat_dau"type="date">
                    </li>
                    <li>
                        <a>Thời gian kết thúc</a>
                        <input class="time" name="TK_ket_thuc"type="date">
                    </li>
                    <li>
                        <button class="btn_search"name="timkiem">Tìm kiếm</button>
                    </li>
                </ul>

                <div class="scroll_table">
                    <table>
                        <thead>
                            <tr>
                                <th class="checked_btn"><input class="all" type="checkbox" id="select_all">All</th>
                                <th>STT</th>
                                <th>Mã khuyến mãi</th>
                                <th>Trạng thái</th>
                                <th>Giá trị khuyến mãi (%)</th>
                                <th>Giá trị giảm tối đa</th>
                                <th>Thời gian bắt đầu</th>
                                <th>Thời gian kết thúc</th>
                                <th class="more_button_col"></th>
                            </tr>
                        </thead>
                        <tbody>

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
                        
                        foreach($query as $key=>$value)  {?>
                                    <tr>
                                        <td> 
                                        <input type="checkbox" name="id_makhuyenmai[]" value="<?php echo $value['id_makhuyenmai']?>" class="checkbox-con" />
                                        </td>
                                        <td>
                                            <?php echo $key+1 ?>
                                        </td>
                                        <td>
                                            <?php echo $value['TENMAKHUYENMAI']?>
                                        </td>
                                        <?php if(time()<$value['TONGGIAY_BATDAU']) {?>
                                        <td>Sắp diễn ra</td>
                                        <?php } else if(time()>=$value['TONGGIAY_BATDAU']&&time()<=$value['TONGGIAY_KETTHUC']){?>
                                        <td>Đang áp dụng</td>
                                        <?php }else {?>
                                        <td>Mã hết hạn</td>
                                        <?php }?> 
                                        <td>
                                            <?php echo $value['GIATRIKHUYENMAI']?>
                                        </td> 
                                        <td>
                                            <?php echo formatMoney($value['GIATRIGIAMTOIDA'])." vnđ"?>
                                        </td>
                                        <td>
                                            <?php echo $value['THOIGIAN_BATDAU']?>
                                        </td>
                                        <td>
                                            <?php echo $value['THOIGIAN_KETTHUC']?>
                                        </td>
                                        <td class="more_button_col">
                                            <div class="dropdown_more_btn">
                                                <button class="more_button">
                                                    <a><i class="fas fa-ellipsis-h"></i></a>
                                                </button>
                                                <div class="dropdown_content_more">
                                                    <a href="xoa_ma.php?id=<?php echo$value['id_makhuyenmai']?>"><i class="fas fa-trash-alt"></i>Xoá</a>
                                                    <a href="./Thong_tin_MKM/thong_tin_MKM.php?id=<?php echo$value['id_makhuyenmai']?>"><i class="fas fa-info"></i>sửa</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php }?> 
                        </tbody>
                    </table>
                </div>
                <form action="">
                    <button class="btn_del"name="xoa_all">Xoá mã khuyến mãi</button>
                </form>
            </div>
        </div>
    </form>
</body>

</html>