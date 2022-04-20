<?php
    $id_chuongtrinh=isset($_POST['id_chuongtrinh'])?$_POST['id_chuongtrinh']:'';
    if(empty($id_chuongtrinh)){
        header("location: chuong_trinh_khuyen_mai.php");
    }
    $strIn='';
    $count=1;
    foreach($id_chuongtrinh as $key=>$value){
        if($count<sizeof($id_chuongtrinh)){
            $strIn=$strIn.$value.',';
        }else {
            $strIn=$strIn.$value;
        }
        $count++;
    }
    $sql_del="DELETE FROM chuongtrinh_khuyenmai WHERE id_chuongtrinh in($strIn)";
    $xoa=mysqli_query($conn,$sql_del);
    if ($xoa){
        header("location:chuong_trinh_khuyen_mai.php");
    }

?>