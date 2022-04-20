<?php
include'../../../connect/connect.php';
if(empty($_SESSION['email'])){
    header("location: ../../../login/index.php");
}else{
    $id=$_GET['id'];
    $sql="DELETE FROM monan WHERE id_monan=$id";
    $query=mysqli_query($conn,$sql);
    header("location: quan_ly_san_pham.php");
    
}

?>