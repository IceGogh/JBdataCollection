<?php
session_start();
if(!$_SESSION['uid']){
//    header('refresh:0; checkIn.php');
    header('location: http://localhost/Jiabao0519/datas/admin/checkIn.php/checkIn.php');
}