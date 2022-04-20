<?php
include'../../../connect/connect.php';
if(empty($_SESSION['email'])){
    header("location: ../../../login/index.php");
}else{
    $id=$_GET['id'];
    $sql="DELETE FROM ma_khuyenmai WHERE id_makhuyenmai=$id";
    $query=mysqli_query($conn,$sql);
    header("location: khuyen_mai.php");
    
}

?>