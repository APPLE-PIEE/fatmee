<?php
    $id_makhuyenmai=isset($_POST['id_makhuyenmai'])?$_POST['id_makhuyenmai']:'';
    if(empty($id_makhuyenmai)){
        header("location: khuyen_mai.php");
    }
    $strIn='';
    $count=1;
    foreach($id_makhuyenmai as $key=>$value){
        if($count<sizeof($id_makhuyenmai)){
            $strIn=$strIn.$value.',';
        }else {
            $strIn=$strIn.$value;
        }
        $count++;
    }
    $sql_del="DELETE FROM ma_khuyenmai WHERE id_makhuyenmai in($strIn)";
    $xoa=mysqli_query($conn,$sql_del);
    if ($xoa){
        header("location: khuyen_mai.php");
    }

?>