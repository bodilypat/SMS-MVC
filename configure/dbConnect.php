<?php
    $dbcon=mysqli_connect("localhost", "root", "", "artgallery");
    if(mysqli_connect_errno()){
        echo "connect fail".mysqli_connect_error();
    }
?>
