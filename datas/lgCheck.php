<?php
session_start();
if(!$_SESSION['uid']){
//    header('refresh:0; checkIn.php');
    header('location: checkIn.php');
}