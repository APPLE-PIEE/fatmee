<?php
    include'../connect/connect.php';
    session_destroy();
    header("location:../main-page/index.php");
?>