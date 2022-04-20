<?php
    $del=isset($_POST['del'])?$_POST['del']:'';
    if(empty($del)){
    header("location:danh_muc_mon_an.php");
    }else{
        $strIn='';
        $count=1;
        foreach($del as $key=>$value){
            if($count<sizeof($del)){
                $strIn=$strIn.$value.',';
            }
            else {
                $strIn=$strIn.$value;
            }
            $count++;
        }
        $sql_del="DELETE FROM danhmuc WHERE id_danhmuc in($strIn)";
        $xoa=mysqli_query($conn,$sql_del);
        if ($xoa){
            header("location:danh_muc_mon_an.php");
        }
        else echo "Danh mục có món ăn không thể xóa";
    }
?>