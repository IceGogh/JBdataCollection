<?php
session_start();
if(!$_SESSION['uid']){
//    header('refresh:0; checkIn.php');
    header('location: http://www.siemensgabor.com/datas/admin/checkIn.php');
}