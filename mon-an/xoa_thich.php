<?php
include'../connect/connect.php';
if(empty($_SESSION['email'])){
    header("location: ../login/index.php");
}else{
    $id=$_GET['id'];
    $sql="DELETE FROM yeuthich WHERE id_monan=$id";
    $query=mysqli_query($conn,$sql);
    header("location:index.php");
}

?>