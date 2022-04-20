<?php
    include'../../../connect/connect.php';
    if(empty($_SESSION['email'])){
        header("location: ../../../login/index.php");
    }else{
        $email=$_SESSION['email'];
        $sql="SELECT * FROM danhmuc INNER JOIN monan ON danhmuc.id_danhmuc = monan.id_danhmuc WHERE monan.email_khachhang='$email'";
        $query=mysqli_query($conn,$sql);
    }
    if(isset($_POST['xoa_all'])){
        require_once("xoa_nhieu.php");        
    }
    if (isset($_POST['timkiem'])){
        if (empty($_POST['TK_ten_danh_muc'])&&empty($_POST['TK_gia'])&&empty($_POST['TK_ngay_dang'])&&!empty($_POST['TK_trang_thai'])&&empty($_POST['TK_tu_khoa'])){
            $TK_trang_thai=$_POST['TK_trang_thai'];
            $sql="SELECT * FROM danhmuc INNER JOIN monan ON danhmuc.id_danhmuc = monan.id_danhmuc WHERE monan.email_khachhang='$email' AND monan.TRANGTHAI = '$TK_trang_thai';";
        }else if (empty($_POST['TK_ten_danh_muc'])&&empty($_POST['TK_gia'])&&!empty($_POST['TK_ngay_dang'])&&empty($_POST['TK_trang_thai'])&&empty($_POST['TK_tu_khoa'])){
            if (isset($_POST['TK_ngay_dang'])){
                $ngay=$_POST['TK_ngay_dang'];
                $tach_ngay = explode("-", $ngay);
                $TK_ngay_dang=$tach_ngay[2].'/'.$tach_ngay[1].'/'.$tach_ngay[0]; 
            }
            $sql="SELECT * FROM danhmuc INNER JOIN monan ON danhmuc.id_danhmuc = monan.id_danhmuc WHERE monan.email_khachhang='$email' AND monan.NGAYDANG LIKE '%$TK_ngay_dang%';";
        }else if (empty($_POST['TK_tu_khoa'])&&empty($_POST['TK_ten_danh_muc'])&&empty($_POST['TK_gia'])&&!empty($_POST['TK_ngay_dang'])&&!empty($_POST['TK_trang_thai'])){
            if (isset($_POST['TK_ngay_dang'])){
                $ngay=$_POST['TK_ngay_dang'];
                $tach_ngay = explode("-", $ngay);
                $TK_ngay_dang=$tach_ngay[2].'/'.$tach_ngay[1].'/'.$tach_ngay[0]; 
            }
            $TK_trang_thai=$_POST['TK_trang_thai'];
            $sql="SELECT * FROM danhmuc INNER JOIN monan ON danhmuc.id_danhmuc = monan.id_danhmuc WHERE monan.email_khachhang='$email'AND monan.NGAYDANG LIKE '%$TK_ngay_dang%'AND monan.TRANGTHAI = '$TK_trang_thai';";
        }else if (empty($_POST['TK_ten_danh_muc'])&&!empty($_POST['TK_gia'])&&empty($_POST['TK_ngay_dang'])&&empty($_POST['TK_trang_thai'])&&empty($_POST['TK_tu_khoa'])){
            $TK_gia=$_POST['TK_gia'];
            $TK_gia_goc='100000000';
            if ($TK_gia==1){
                $TK_gia_goc=10000;
            }else if ($TK_gia==2){
                $TK_gia_goc=100000;
            }else if($TK_gia==3) {
                $TK_gia_goc=200000;
            }else if($TK_gia==4) {
                $TK_gia_goc=1000000;
            }
            $sql="SELECT * FROM danhmuc INNER JOIN monan ON danhmuc.id_danhmuc = monan.id_danhmuc WHERE monan.email_khachhang='$email' AND monan.GIA < '$TK_gia_goc';";
        }else if (empty($_POST['TK_tu_khoa'])&&empty($_POST['TK_ten_danh_muc'])&&!empty($_POST['TK_gia'])&&empty($_POST['TK_ngay_dang'])&&!empty($_POST['TK_trang_thai'])){
            $TK_gia=$_POST['TK_gia'];
            $TK_gia_goc='100000000';
            if ($TK_gia==1){
                $TK_gia_goc=10000;
            }else if ($TK_gia==2){
                $TK_gia_goc=100000;
            }else if($TK_gia==3) {
                $TK_gia_goc=200000;
            }else if($TK_gia==4) {
                $TK_gia_goc=1000000;
            }
            $TK_trang_thai=$_POST['TK_trang_thai'];
            $sql="SELECT * FROM danhmuc INNER JOIN monan ON danhmuc.id_danhmuc = monan.id_danhmuc WHERE monan.email_khachhang='$email'AND monan.GIA < '$TK_gia_goc'AND monan.TRANGTHAI = '$TK_trang_thai';";
        }else if (empty($_POST['TK_tu_khoa'])&&empty($_POST['TK_ten_danh_muc'])&&!empty($_POST['TK_gia'])&&!empty($_POST['TK_ngay_dang'])&&empty($_POST['TK_trang_thai'])){
            $TK_gia=$_POST['TK_gia'];
            $TK_gia_goc='100000000';
            if ($TK_gia==1){
                $TK_gia_goc=10000;
            }else if ($TK_gia==2){
                $TK_gia_goc=100000;
            }else if($TK_gia==3) {
                $TK_gia_goc=200000;
            }else if($TK_gia==4) {
                $TK_gia_goc=1000000;
            }
            if (isset($_POST['TK_ngay_dang'])){
                $ngay=$_POST['TK_ngay_dang'];
                $tach_ngay = explode("-", $ngay);
                $TK_ngay_dang=$tach_ngay[2].'/'.$tach_ngay[1].'/'.$tach_ngay[0]; 
            }
            $sql="SELECT * FROM danhmuc INNER JOIN monan ON danhmuc.id_danhmuc = monan.id_danhmuc WHERE monan.email_khachhang='$email'AND monan.GIA < '$TK_gia_goc'AND monan.NGAYDANG LIKE '%$TK_ngay_dang%';";
        }else if (empty($_POST['TK_tu_khoa'])&&empty($_POST['TK_ten_danh_muc'])&&!empty($_POST['TK_gia'])&&!empty($_POST['TK_ngay_dang'])&&!empty($_POST['TK_trang_thai'])){
            $TK_gia=$_POST['TK_gia'];
            $TK_gia_goc='100000000';
            if ($TK_gia==1){
                $TK_gia_goc=10000;
            }else if ($TK_gia==2){
                $TK_gia_goc=100000;
            }else if($TK_gia==3) {
                $TK_gia_goc=200000;
            }else if($TK_gia==4) {
                $TK_gia_goc=1000000;
            }
            if (isset($_POST['TK_ngay_dang'])){
                $ngay=$_POST['TK_ngay_dang'];
                $tach_ngay = explode("-", $ngay);
                $TK_ngay_dang=$tach_ngay[2].'/'.$tach_ngay[1].'/'.$tach_ngay[0]; 
            }
            $TK_trang_thai=$_POST['TK_trang_thai'];
            $sql="SELECT * FROM danhmuc INNER JOIN monan ON danhmuc.id_danhmuc = monan.id_danhmuc WHERE monan.email_khachhang='$email'AND monan.GIA < '$TK_gia_goc' AND monan.NGAYDANG LIKE '%$TK_ngay_dang%'AND monan.TRANGTHAI = '$TK_trang_thai';";
        }else if (!empty($_POST['TK_ten_danh_muc'])&&empty($_POST['TK_gia'])&&empty($_POST['TK_ngay_dang'])&&empty($_POST['TK_trang_thai'])&&empty($_POST['TK_tu_khoa'])){
            $TK_ten_danh_muc=$_POST['TK_ten_danh_muc'];
            $sql="SELECT * FROM danhmuc INNER JOIN monan ON danhmuc.id_danhmuc = monan.id_danhmuc WHERE monan.email_khachhang='$email' AND monan.id_danhmuc = '$TK_ten_danh_muc';";
        }else if (empty($_POST['TK_tu_khoa'])&&!empty($_POST['TK_ten_danh_muc'])&&empty($_POST['TK_gia'])&&empty($_POST['TK_ngay_dang'])&&!empty($_POST['TK_trang_thai'])){
            $TK_ten_danh_muc=$_POST['TK_ten_danh_muc'];
            $TK_trang_thai=$_POST['TK_trang_thai'];
            $sql="SELECT * FROM danhmuc INNER JOIN monan ON danhmuc.id_danhmuc = monan.id_danhmuc WHERE monan.email_khachhang='$email'AND monan.id_danhmuc = '$TK_ten_danh_muc'AND monan.TRANGTHAI = '$TK_trang_thai';";
        }else if (empty($_POST['TK_tu_khoa'])&&!empty($_POST['TK_ten_danh_muc'])&&empty($_POST['TK_gia'])&&!empty($_POST['TK_ngay_dang'])&&empty($_POST['TK_trang_thai'])){
            $TK_ten_danh_muc=$_POST['TK_ten_danh_muc'];
            if (isset($_POST['TK_ngay_dang'])){
                $ngay=$_POST['TK_ngay_dang'];
                $tach_ngay = explode("-", $ngay);
                $TK_ngay_dang=$tach_ngay[2].'/'.$tach_ngay[1].'/'.$tach_ngay[0]; 
            }
            $sql="SELECT * FROM danhmuc INNER JOIN monan ON danhmuc.id_danhmuc = monan.id_danhmuc WHERE monan.email_khachhang='$email' AND monan.id_danhmuc = '$TK_ten_danh_muc'AND monan.NGAYDANG LIKE '%$TK_ngay_dang%';";
        }else if (empty($_POST['TK_tu_khoa'])&&!empty($_POST['TK_ten_danh_muc'])&&empty($_POST['TK_gia'])&&!empty($_POST['TK_ngay_dang'])&&!empty($_POST['TK_trang_thai'])){
            $TK_ten_danh_muc=$_POST['TK_ten_danh_muc'];
            if (isset($_POST['TK_ngay_dang'])){
                $ngay=$_POST['TK_ngay_dang'];
                $tach_ngay = explode("-", $ngay);
                $TK_ngay_dang=$tach_ngay[2].'/'.$tach_ngay[1].'/'.$tach_ngay[0]; 
            }
            $TK_trang_thai=$_POST['TK_trang_thai'];
            $sql="SELECT * FROM danhmuc INNER JOIN monan ON danhmuc.id_danhmuc = monan.id_danhmuc WHERE monan.email_khachhang='$email' AND monan.id_danhmuc = '$TK_ten_danh_muc'AND monan.NGAYDANG LIKE '%$TK_ngay_dang%'AND monan.TRANGTHAI = '$TK_trang_thai';";
        }else if (empty($_POST['TK_tu_khoa'])&&!empty($_POST['TK_ten_danh_muc'])&&!empty($_POST['TK_gia'])&&empty($_POST['TK_ngay_dang'])&&empty($_POST['TK_trang_thai'])){
            $TK_ten_danh_muc=$_POST['TK_ten_danh_muc'];
            $TK_gia=$_POST['TK_gia'];
            $TK_gia_goc='100000000';
            if ($TK_gia==1){
                $TK_gia_goc=10000;
            }else if ($TK_gia==2){
                $TK_gia_goc=100000;
            }else if($TK_gia==3) {
                $TK_gia_goc=200000;
            }else if($TK_gia==4) {
                $TK_gia_goc=1000000;
            }
            $sql="SELECT * FROM danhmuc INNER JOIN monan ON danhmuc.id_danhmuc = monan.id_danhmuc WHERE monan.email_khachhang='$email' AND monan.id_danhmuc = '$TK_ten_danh_muc'AND monan.GIA < '$TK_gia_goc';";
        }else if (empty($_POST['TK_tu_khoa'])&&!empty($_POST['TK_ten_danh_muc'])&&!empty($_POST['TK_gia'])&&empty($_POST['TK_ngay_dang'])&&!empty($_POST['TK_trang_thai'])){
            $TK_ten_danh_muc=$_POST['TK_ten_danh_muc'];
            $TK_gia=$_POST['TK_gia'];
            $TK_gia_goc='100000000';
            if ($TK_gia==1){
                $TK_gia_goc=10000;
            }else if ($TK_gia==2){
                $TK_gia_goc=100000;
            }else if($TK_gia==3) {
                $TK_gia_goc=200000;
            }else if($TK_gia==4) {
                $TK_gia_goc=1000000;
            }
            $TK_trang_thai=$_POST['TK_trang_thai'];
            $sql="SELECT * FROM danhmuc INNER JOIN monan ON danhmuc.id_danhmuc = monan.id_danhmuc WHERE monan.email_khachhang='$email'AND monan.id_danhmuc = '$TK_ten_danh_muc'AND monan.GIA < '$TK_gia_goc' AND monan.TRANGTHAI = '$TK_trang_thai';";
        }else if (empty($_POST['TK_tu_khoa'])&&!empty($_POST['TK_ten_danh_muc'])&&!empty($_POST['TK_gia'])&&!empty($_POST['TK_ngay_dang'])&&empty($_POST['TK_trang_thai'])){
            $TK_ten_danh_muc=$_POST['TK_ten_danh_muc'];
            $TK_gia=$_POST['TK_gia'];
            $TK_gia_goc='100000000';
            if ($TK_gia==1){
                $TK_gia_goc=10000;
            }else if ($TK_gia==2){
                $TK_gia_goc=100000;
            }else if($TK_gia==3) {
                $TK_gia_goc=200000;
            }else if($TK_gia==4) {
                $TK_gia_goc=1000000;
            }
            if (isset($_POST['TK_ngay_dang'])){
                $ngay=$_POST['TK_ngay_dang'];
                $tach_ngay = explode("-", $ngay);
                $TK_ngay_dang=$tach_ngay[2].'/'.$tach_ngay[1].'/'.$tach_ngay[0]; 
            }
            $sql="SELECT * FROM danhmuc INNER JOIN monan ON danhmuc.id_danhmuc = monan.id_danhmuc WHERE monan.email_khachhang='$email'AND monan.id_danhmuc = '$TK_ten_danh_muc'AND monan.GIA < '$TK_gia_goc' AND monan.NGAYDANG LIKE '%$TK_ngay_dang%';";
        }else if (empty($_POST['TK_tu_khoa'])&&!empty($_POST['TK_ten_danh_muc'])&&!empty($_POST['TK_gia'])&&!empty($_POST['TK_ngay_dang'])&&!empty($_POST['TK_trang_thai'])){
            $TK_ten_danh_muc=$_POST['TK_ten_danh_muc'];
            $TK_gia=$_POST['TK_gia'];
            $TK_gia_goc='100000000';
            if ($TK_gia==1){
                $TK_gia_goc=10000;
            }else if ($TK_gia==2){
                $TK_gia_goc=100000;
            }else if($TK_gia==3) {
                $TK_gia_goc=200000;
            }else if($TK_gia==4) {
                $TK_gia_goc=1000000;
            }
            if (isset($_POST['TK_ngay_dang'])){
                $ngay=$_POST['TK_ngay_dang'];
                $tach_ngay = explode("-", $ngay);
                $TK_ngay_dang=$tach_ngay[2].'/'.$tach_ngay[1].'/'.$tach_ngay[0]; 
            }
            $TK_trang_thai=$_POST['TK_trang_thai'];
            $sql="SELECT * FROM danhmuc INNER JOIN monan ON danhmuc.id_danhmuc = monan.id_danhmuc WHERE monan.email_khachhang='$email' AND monan.id_danhmuc = '$TK_ten_danh_muc'AND monan.GIA < '$TK_gia_goc' AND monan.NGAYDANG LIKE '%$TK_ngay_dang%'AND monan.TRANGTHAI = '$TK_trang_thai';";
        }else if (empty($_POST['TK_ten_danh_muc'])&&empty($_POST['TK_gia'])&&empty($_POST['TK_ngay_dang'])&&empty($_POST['TK_trang_thai'])&&!empty($_POST['TK_tu_khoa'])){
            $TK_tu_khoa=$_POST['TK_tu_khoa'];
            $sql="SELECT * FROM danhmuc INNER JOIN monan ON danhmuc.id_danhmuc = monan.id_danhmuc WHERE monan.email_khachhang='$email' AND monan.TENMONAN LIKE '%$TK_tu_khoa%';";
        }else if (!empty($_POST['TK_tu_khoa'])&&empty($_POST['TK_ten_danh_muc'])&&empty($_POST['TK_gia'])&&empty($_POST['TK_ngay_dang'])&&!empty($_POST['TK_trang_thai'])){
            $TK_tu_khoa=$_POST['TK_tu_khoa'];
            $TK_trang_thai=$_POST['TK_trang_thai'];
            $sql="SELECT * FROM danhmuc INNER JOIN monan ON danhmuc.id_danhmuc = monan.id_danhmuc WHERE monan.email_khachhang='$email' AND monan.TENMONAN LIKE '%$TK_tu_khoa%'AND monan.TRANGTHAI = '$TK_trang_thai';";
        }else if (!empty($_POST['TK_tu_khoa'])&&empty($_POST['TK_ten_danh_muc'])&&empty($_POST['TK_gia'])&&!empty($_POST['TK_ngay_dang'])&&empty($_POST['TK_trang_thai'])){
            $TK_tu_khoa=$_POST['TK_tu_khoa'];
            if (isset($_POST['TK_ngay_dang'])){
                $ngay=$_POST['TK_ngay_dang'];
                $tach_ngay = explode("-", $ngay);
                $TK_ngay_dang=$tach_ngay[2].'/'.$tach_ngay[1].'/'.$tach_ngay[0]; 
            }
            $sql="SELECT * FROM danhmuc INNER JOIN monan ON danhmuc.id_danhmuc = monan.id_danhmuc WHERE monan.email_khachhang='$email' AND monan.TENMONAN LIKE '%$TK_tu_khoa%'AND monan.NGAYDANG LIKE '%$TK_ngay_dang%';";
        }else if (!empty($_POST['TK_tu_khoa'])&&empty($_POST['TK_ten_danh_muc'])&&empty($_POST['TK_gia'])&&!empty($_POST['TK_ngay_dang'])&&!empty($_POST['TK_trang_thai'])){
            $TK_tu_khoa=$_POST['TK_tu_khoa'];
            if (isset($_POST['TK_ngay_dang'])){
                $ngay=$_POST['TK_ngay_dang'];
                $tach_ngay = explode("-", $ngay);
                $TK_ngay_dang=$tach_ngay[2].'/'.$tach_ngay[1].'/'.$tach_ngay[0]; 
            }
            $TK_trang_thai=$_POST['TK_trang_thai'];
            $sql="SELECT * FROM danhmuc INNER JOIN monan ON danhmuc.id_danhmuc = monan.id_danhmuc WHERE monan.email_khachhang='$email' AND monan.TENMONAN LIKE '%$TK_tu_khoa%'AND monan.NGAYDANG LIKE '%$TK_ngay_dang%'AND monan.TRANGTHAI = '$TK_trang_thai';";
        }else if (!empty($_POST['TK_tu_khoa'])&&empty($_POST['TK_ten_danh_muc'])&&!empty($_POST['TK_gia'])&&empty($_POST['TK_ngay_dang'])&&empty($_POST['TK_trang_thai'])){
            $TK_tu_khoa=$_POST['TK_tu_khoa'];
            $TK_gia=$_POST['TK_gia'];
            $TK_gia_goc='100000000';
            if ($TK_gia==1){
                $TK_gia_goc=10000;
            }else if ($TK_gia==2){
                $TK_gia_goc=100000;
            }else if($TK_gia==3) {
                $TK_gia_goc=200000;
            }else if($TK_gia==4) {
                $TK_gia_goc=1000000;
            }
            $sql="SELECT * FROM danhmuc INNER JOIN monan ON danhmuc.id_danhmuc = monan.id_danhmuc WHERE monan.email_khachhang='$email' AND monan.TENMONAN LIKE '%$TK_tu_khoa%'AND monan.GIA < '$TK_gia_goc';";
        }else if (!empty($_POST['TK_tu_khoa'])&&empty($_POST['TK_ten_danh_muc'])&&!empty($_POST['TK_gia'])&&empty($_POST['TK_ngay_dang'])&&!empty($_POST['TK_trang_thai'])){
            $TK_tu_khoa=$_POST['TK_tu_khoa'];
            $TK_gia=$_POST['TK_gia'];
            $TK_gia_goc='100000000';
            if ($TK_gia==1){
                $TK_gia_goc=10000;
            }else if ($TK_gia==2){
                $TK_gia_goc=100000;
            }else if($TK_gia==3) {
                $TK_gia_goc=200000;
            }else if($TK_gia==4) {
                $TK_gia_goc=1000000;
            }
            $TK_trang_thai=$_POST['TK_trang_thai'];
            $sql="SELECT * FROM danhmuc INNER JOIN monan ON danhmuc.id_danhmuc = monan.id_danhmuc WHERE monan.email_khachhang='$email' AND monan.TENMONAN LIKE '%$TK_tu_khoa%'AND monan.GIA < '$TK_gia_goc'AND monan.TRANGTHAI = '$TK_trang_thai';";
        }else if (!empty($_POST['TK_tu_khoa'])&&empty($_POST['TK_ten_danh_muc'])&&!empty($_POST['TK_gia'])&&!empty($_POST['TK_ngay_dang'])&&empty($_POST['TK_trang_thai'])){
            $TK_tu_khoa=$_POST['TK_tu_khoa'];
            $TK_gia=$_POST['TK_gia'];
            $TK_gia_goc='100000000';
            if ($TK_gia==1){
                $TK_gia_goc=10000;
            }else if ($TK_gia==2){
                $TK_gia_goc=100000;
            }else if($TK_gia==3) {
                $TK_gia_goc=200000;
            }else if($TK_gia==4) {
                $TK_gia_goc=1000000;
            }
            if (isset($_POST['TK_ngay_dang'])){
                $ngay=$_POST['TK_ngay_dang'];
                $tach_ngay = explode("-", $ngay);
                $TK_ngay_dang=$tach_ngay[2].'/'.$tach_ngay[1].'/'.$tach_ngay[0]; 
            }
            $sql="SELECT * FROM danhmuc INNER JOIN monan ON danhmuc.id_danhmuc = monan.id_danhmuc WHERE monan.email_khachhang='$email' AND monan.TENMONAN LIKE '%$TK_tu_khoa%'AND monan.GIA < '$TK_gia_goc'AND monan.NGAYDANG LIKE '%$TK_ngay_dang%';";
        }else if (!empty($_POST['TK_tu_khoa'])&&empty($_POST['TK_ten_danh_muc'])&&!empty($_POST['TK_gia'])&&!empty($_POST['TK_ngay_dang'])&&!empty($_POST['TK_trang_thai'])){
            $TK_tu_khoa=$_POST['TK_tu_khoa'];
            $TK_gia=$_POST['TK_gia'];
            $TK_gia_goc='100000000';
            if ($TK_gia==1){
                $TK_gia_goc=10000;
            }else if ($TK_gia==2){
                $TK_gia_goc=100000;
            }else if($TK_gia==3) {
                $TK_gia_goc=200000;
            }else if($TK_gia==4) {
                $TK_gia_goc=1000000;
            }
            if (isset($_POST['TK_ngay_dang'])){
                $ngay=$_POST['TK_ngay_dang'];
                $tach_ngay = explode("-", $ngay);
                $TK_ngay_dang=$tach_ngay[2].'/'.$tach_ngay[1].'/'.$tach_ngay[0]; 
            }
            $TK_trang_thai=$_POST['TK_trang_thai'];
            $sql="SELECT * FROM danhmuc INNER JOIN monan ON danhmuc.id_danhmuc = monan.id_danhmuc WHERE monan.email_khachhang='$email' AND monan.TENMONAN LIKE '%$TK_tu_khoa%'AND monan.GIA < '$TK_gia_goc'AND monan.NGAYDANG LIKE '%$TK_ngay_dang%'AND monan.TRANGTHAI = '$TK_trang_thai';";
        }else if (!empty($_POST['TK_tu_khoa'])&&!empty($_POST['TK_ten_danh_muc'])&&empty($_POST['TK_gia'])&&empty($_POST['TK_ngay_dang'])&&empty($_POST['TK_trang_thai'])){
            $TK_tu_khoa=$_POST['TK_tu_khoa'];
            $TK_ten_danh_muc=$_POST['TK_ten_danh_muc'];
            $sql="SELECT monan.IMAGE,monan.TENMONAN,danhmuc.TENDANHMUC,monan.GIA,monan.NGAYDANG,monan.TRANGTHAI,monan.id_monan FROM danhmuc INNER JOIN monan ON danhmuc.id_danhmuc = monan.id_danhmuc WHERE monan.email_khachhang='$email' AND monan.TENMONAN LIKE '%$TK_tu_khoa%'AND monan.id_danhmuc = '$TK_ten_danh_muc';";
        }else if (!empty($_POST['TK_tu_khoa'])&&!empty($_POST['TK_ten_danh_muc'])&&empty($_POST['TK_gia'])&&empty($_POST['TK_ngay_dang'])&&!empty($_POST['TK_trang_thai'])){
            $TK_tu_khoa=$_POST['TK_tu_khoa'];
            $TK_ten_danh_muc=$_POST['TK_ten_danh_muc'];
            $TK_trang_thai=$_POST['TK_trang_thai'];
            $sql="SELECT * FROM danhmuc INNER JOIN monan ON danhmuc.id_danhmuc = monan.id_danhmuc WHERE monan.email_khachhang='$email'AND monan.TENMONAN LIKE '%$TK_tu_khoa%'AND monan.id_danhmuc = '$TK_ten_danh_muc' AND monan.TRANGTHAI = '$TK_trang_thai';";
        }else if (!empty($_POST['TK_tu_khoa'])&&!empty($_POST['TK_ten_danh_muc'])&&empty($_POST['TK_gia'])&&!empty($_POST['TK_ngay_dang'])&&empty($_POST['TK_trang_thai'])){
            $TK_tu_khoa=$_POST['TK_tu_khoa'];
            $TK_ten_danh_muc=$_POST['TK_ten_danh_muc'];
            if (isset($_POST['TK_ngay_dang'])){
                $ngay=$_POST['TK_ngay_dang'];
                $tach_ngay = explode("-", $ngay);
                $TK_ngay_dang=$tach_ngay[2].'/'.$tach_ngay[1].'/'.$tach_ngay[0]; 
            }
            $sql="SELECT * FROM danhmuc INNER JOIN monan ON danhmuc.id_danhmuc = monan.id_danhmuc WHERE monan.email_khachhang='$email'AND monan.TENMONAN LIKE '%$TK_tu_khoa%'AND monan.id_danhmuc = '$TK_ten_danh_muc' AND monan.NGAYDANG LIKE '%$TK_ngay_dang%';";
        }else if (!empty($_POST['TK_tu_khoa'])&&!empty($_POST['TK_ten_danh_muc'])&&empty($_POST['TK_gia'])&&!empty($_POST['TK_ngay_dang'])&&!empty($_POST['TK_trang_thai'])){
            $TK_tu_khoa=$_POST['TK_tu_khoa'];
            $TK_ten_danh_muc=$_POST['TK_ten_danh_muc'];
            if (isset($_POST['TK_ngay_dang'])){
                $ngay=$_POST['TK_ngay_dang'];
                $tach_ngay = explode("-", $ngay);
                $TK_ngay_dang=$tach_ngay[2].'/'.$tach_ngay[1].'/'.$tach_ngay[0]; 
            }
            $TK_trang_thai=$_POST['TK_trang_thai'];
            $sql="SELECT * FROM danhmuc INNER JOIN monan ON danhmuc.id_danhmuc = monan.id_danhmuc WHERE monan.email_khachhang='$email'AND monan.TENMONAN LIKE '%$TK_tu_khoa%'AND monan.id_danhmuc = '$TK_ten_danh_muc' AND monan.NGAYDANG LIKE '%$TK_ngay_dang%'AND monan.TRANGTHAI = '$TK_trang_thai';";
        }else if (!empty($_POST['TK_tu_khoa'])&&!empty($_POST['TK_ten_danh_muc'])&&!empty($_POST['TK_gia'])&&empty($_POST['TK_ngay_dang'])&&empty($_POST['TK_trang_thai'])){
            $TK_tu_khoa=$_POST['TK_tu_khoa'];
            $TK_ten_danh_muc=$_POST['TK_ten_danh_muc'];
            $TK_gia=$_POST['TK_gia'];
            $TK_gia_goc='100000000';
            if ($TK_gia==1){
                $TK_gia_goc=10000;
            }else if ($TK_gia==2){
                $TK_gia_goc=100000;
            }else if($TK_gia==3) {
                $TK_gia_goc=200000;
            }else if($TK_gia==4) {
                $TK_gia_goc=1000000;
            }
            $sql="SELECT * FROM danhmuc INNER JOIN monan ON danhmuc.id_danhmuc = monan.id_danhmuc WHERE monan.email_khachhang='$email'AND monan.TENMONAN LIKE '%$TK_tu_khoa%'AND monan.id_danhmuc = '$TK_ten_danh_muc'AND monan.GIA < '$TK_gia_goc';";
        }else if (!empty($_POST['TK_tu_khoa'])&&!empty($_POST['TK_ten_danh_muc'])&&!empty($_POST['TK_gia'])&&empty($_POST['TK_ngay_dang'])&&!empty($_POST['TK_trang_thai'])){
            $TK_tu_khoa=$_POST['TK_tu_khoa'];
            $TK_ten_danh_muc=$_POST['TK_ten_danh_muc'];
            $TK_gia=$_POST['TK_gia'];
            $TK_gia_goc='100000000';
            if ($TK_gia==1){
                $TK_gia_goc=10000;
            }else if ($TK_gia==2){
                $TK_gia_goc=100000;
            }else if($TK_gia==3) {
                $TK_gia_goc=200000;
            }else if($TK_gia==4) {
                $TK_gia_goc=1000000;
            }
            $TK_trang_thai=$_POST['TK_trang_thai'];
            $sql="SELECT * FROM danhmuc INNER JOIN monan ON danhmuc.id_danhmuc = monan.id_danhmuc WHERE monan.email_khachhang='$email'AND monan.TENMONAN LIKE '%$TK_tu_khoa%'AND monan.id_danhmuc = '$TK_ten_danh_muc'AND monan.GIA < '$TK_gia_goc'AND monan.TRANGTHAI = '$TK_trang_thai';";
        }else  if (!empty($_POST['TK_tu_khoa'])&&!empty($_POST['TK_ten_danh_muc'])&&!empty($_POST['TK_gia'])&&!empty($_POST['TK_ngay_dang'])&&empty($_POST['TK_trang_thai'])){
            $TK_tu_khoa=$_POST['TK_tu_khoa'];
            $TK_ten_danh_muc=$_POST['TK_ten_danh_muc'];
            $TK_gia=$_POST['TK_gia'];
            $TK_gia_goc='100000000';
            if ($TK_gia==1){
                $TK_gia_goc=10000;
            }else if ($TK_gia==2){
                $TK_gia_goc=100000;
            }else if($TK_gia==3) {
                $TK_gia_goc=200000;
            }else if($TK_gia==4) {
                $TK_gia_goc=1000000;
            }
            if (isset($_POST['TK_ngay_dang'])){
                $ngay=$_POST['TK_ngay_dang'];
                $tach_ngay = explode("-", $ngay);
                $TK_ngay_dang=$tach_ngay[2].'/'.$tach_ngay[1].'/'.$tach_ngay[0]; 
            }
            $sql="SELECT * FROM danhmuc INNER JOIN monan ON danhmuc.id_danhmuc = monan.id_danhmuc WHERE monan.email_khachhang='$email'AND monan.TENMONAN LIKE '%$TK_tu_khoa%' AND monan.id_danhmuc = '$TK_ten_danh_muc'AND monan.GIA < '$TK_gia_goc' AND monan.NGAYDANG LIKE '%$TK_ngay_dang%';";
        }else if (!empty($_POST['TK_tu_khoa'])&&!empty($_POST['TK_ten_danh_muc'])&&!empty($_POST['TK_gia'])&&!empty($_POST['TK_ngay_dang'])&&!empty($_POST['TK_trang_thai'])){
            $TK_tu_khoa=$_POST['TK_tu_khoa'];
            $TK_ten_danh_muc=$_POST['TK_ten_danh_muc'];
            $TK_gia=$_POST['TK_gia'];
            $TK_gia_goc='100000000';
            if ($TK_gia==1){
                $TK_gia_goc=10000;
            }else if ($TK_gia==2){
                $TK_gia_goc=100000;
            }else if($TK_gia==3) {
                $TK_gia_goc=200000;
            }else if($TK_gia==4) {
                $TK_gia_goc=1000000;
            }
            if (isset($_POST['TK_ngay_dang'])){
                $ngay=$_POST['TK_ngay_dang'];
                $tach_ngay = explode("-", $ngay);
                $TK_ngay_dang=$tach_ngay[2].'/'.$tach_ngay[1].'/'.$tach_ngay[0]; 
            }
            $TK_trang_thai=$_POST['TK_trang_thai'];
            $sql="SELECT * FROM danhmuc INNER JOIN monan ON danhmuc.id_danhmuc = monan.id_danhmuc WHERE monan.email_khachhang='$email'AND monan.TENMONAN LIKE '%$TK_tu_khoa%'AND monan.id_danhmuc = '$TK_ten_danh_muc'AND monan.GIA < '$TK_gia_goc' AND monan.NGAYDANG LIKE '%$TK_ngay_dang%'AND monan.TRANGTHAI = '$TK_trang_thai';";
        }
        $query=mysqli_query($conn,$sql);
    }
    $timkiem=mysqli_query($conn,"SELECT *FROM danhmuc WHERE email_khachhang='$email'");
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Quản lý sản phẩm</title>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600;1,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css" integrity="sha384-Bfad6CLCknfcloXFOyFnlgtENryhrpZCe29RTifKEixXQZ38WheV+i/6YWSzkz3V" crossorigin="anonymous" />
    <link rel="stylesheet" href="/Home_main_page/css/reset.css" />
    <link rel="stylesheet" href="./quan_ly_san_pham.css/quan_ly_san_pham.css" />


    <style>
        .btn_a_them_mon{
            width: 15rem;
            background-color: #FF5500;
            border-radius: 5px;
            text-align: center;
            float: right;
            font-size: 15.3333px;
            color: white;
            text-decoration: none;
        }
        .btn_a_them_mon:hover {
            background-color: var(--color-button-hover);
        }
        .checked_btn{
            width: 8rem;
            padding-top: 5px;
        }
        .all{
            margin-left: 1px !important;
            width: 2.2rem ;
            height: 2.2rem;
        }
    </style>
</head>

<body>


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

<form action=""method="post"enctype="multipart/form-data">
    <div class="quan_ly_san_pham_container">
        <div class="header_container">
            <ul>
                <li>
                    <h3>Danh sách món ăn</h3>
                </li>
                <li class="btn_add">
                    
                    <a href="../../frames/Them_san_pham/them_san_pham.php" class="btn_a_them_mon">Thêm món</a>
                    <!-- <button onclick="add()">Thêm món</button> -->
                </li>
            </ul>
        </div>
        <div class="body_container">
            <!-- <div class="part1">
          <ul>
            <li><i class="fas fa-download"></i><a href="">Nhập danh sách</a></li>
            <li><i class="fas fa-upload"></i><a href="">Xuất danh sách</a></li>
            <li><input type="radio" />Hiển thị <input type="radio" />Ẩn</li>
          </ul>
          </div> -->
            <div class="sap_xep">
                <ul>
                    <li class="search">
                        <input tyle="text" placeholder="Tên món ăn" name="TK_tu_khoa"/>
                    </li>
                    <li>
                        <select name="TK_ten_danh_muc" id="">
                            <option value="" disabled selected>Danh mục</option>
                            <?php foreach($timkiem as $key => $value) {?>
                                <option value="<?php echo $value['id_danhmuc'] ?>"><?php echo $value['TENDANHMUC'] ?></option>
                            <?php  }?>
                        </select>
                    </li>
                    <li>
                        <select name="TK_gia" id="">
                            <option value="" disabled selected>Giá</option>
                            <option value="1">< 10,000 vnđ </option>
                            <option value="2">< 100,000 vnđ</option>
                            <option value="3">< 200,000 vnđ</option>
                            <option value="4">< 1,000,000 vnđ</option>
                        </select>
                    </li>
                    <li class="date_time">
                        <input type="date"name="TK_ngay_dang" placeholder="Ngày đăng" />
                    </li>
                    <li class="status">
                        <select name="TK_trang_thai" id="">
                            <option value="" disabled selected>Trạng thái</option>
                            <option value="1">Hiện</option>
                            <option value="2">Ẩn</option>
                        </select>
                    </li>
                    <li>
                        <button name="timkiem">Tìm kiếm</button>
                    </li>

                </ul>
                
            </div>
            <div class="scroll_table">
                <table>
                    <thead>
                        <tr>
                            <th class="checked_btn"><input class="all" type="checkbox" id="select_all" />All</th>
                            <th>STT</th>
                            <th>Hình ảnh</th>
                            <th>Tên sản phẩm</th>
                            <th>Danh mục</th>
                            <th>Giá</th>
                            <th>Ngày đăng</th>
                            <th>Trạng thái</th>
                            <th></th>
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
                        
                        foreach($query as $key=>$value)  { 
                            
                        ?>
                                    <tr>
                                        <td> 
                                        <input type="checkbox" name="id_monan[]" value="<?php echo $value['id_monan']?>" class="checkbox-con" />
                                        </td>
                                        <td>
                                            <?php echo $key+1 ?>
                                        </td>
                                        <td>
                                            <img src="../../../img-uploads/<?php echo $value['IMAGE']?>" alt="lỗi">
                                        </td>
                                        <td>
                                            <?php echo $value['TENMONAN']?>
                                        </td>
                                        <td>
                                            <?php echo $value['TENDANHMUC']?>
                                        </td> 
                                        <td>
                                            <?php echo formatMoney($value['GIA'])." vnđ"?>
                                        </td>
                                        <td>
                                            <?php echo $value['NGAYDANG']?>
                                        </td>
                                        <?php if ($value['TRANGTHAI']==1){ ?>
                                            <td>Hiện</td>
                                        <?php } else {?>
                                            <td>Ẩn</td>
                                        <?php }?>
                                        <td>
                                            <div class="dropdown_more_btn">
                                                <button class="more_button">
                                                    <i class="fas fa-ellipsis-h"></i>
                                                </button>
                                                <div class="dropdown_content_more"name="xoa">
                                                    <a href="xoa_mon_an.php?id=<?php echo $value['id_monan']; ?>"><i class="fas fa-trash-alt"></i>Xoá</a>
                                                    <a href="../../../edit_menu/frames/Thong_tin_san_pham/thong_tin_san_pham.php?id=<?php echo $value['id_monan']; ?>"><i class="fas fa-info"></i>Sửa</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php }?> 
                            </tbody>
                    </table>
                </div>
            <div class="btn">
                <button name="xoa_all">Xoá sản phẩm</button>
            </div>
        </div>
    </div>
    </form>
    <script src="./Quan_ly_san_pham_js/quan_ly_san_pham.js"></script>
</body>

</html>