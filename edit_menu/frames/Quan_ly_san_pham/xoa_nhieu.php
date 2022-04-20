<?php
    // include'../../../connect/connect.php';
    $id_monan=isset($_POST['id_monan'])?$_POST['id_monan']:'';
    if(empty($id_monan)){
        header("location:quan_ly_san_pham.php");
    }
    $strIn='';
    $count=1;
    foreach($id_monan as $key=>$value){
        if($count<sizeof($id_monan)){
            $strIn=$strIn.$value.',';
        }
        else {
            $strIn=$strIn.$value;
        }
        $count++;
    }
    // echo $strIn;
    $sql_del="DELETE FROM monan WHERE id_monan in($strIn)";
    $xoa=mysqli_query($conn,$sql_del);
    if ($xoa){
        header("location:quan_ly_san_pham.php");
    }

    // $del=(isset($_POST['del']))?$_POST['del']:'';
    // var_dump($del);


?>