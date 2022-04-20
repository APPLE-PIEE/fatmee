<?php
    include'../connect/connect.php';
    session_destroy();
    header("location:index.php");
?>