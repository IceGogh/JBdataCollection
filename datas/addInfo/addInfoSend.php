<?php
session_start();
include "../connectAdmin.php";
if(!$_POST['from']){
    echo "<script>alert(\"信息渠道未填写！\")</script>";
    header("refresh:0; addInfo.php?id=$_SESSION[uid]");
}
date_default_timezone_set('Asia/Shanghai');
$time = date('Y-m-d H:i:s');
$weekArray = array("日", "一", "二", "三", "四", "五", "六");
$week = $weekArray[date('w')];
$team =  substr($_SESSION['uid'],0,1);

$add = "insert into user (name, phone, location, house, time, checkOr, sendOr, infoFrom, team, week, weico, customer) value ('$_POST[name]', '$_POST[phone]', '$_POST[city]', '$_POST[house]', '$time', '1', '1', '$_POST[from]', '$team', '$week', '$_POST[weico]', '$_SESSION[name]')";

$query = mysqli_query($con, $add);
if(!$query){
    echo "Error: ".mysqli_error($con);
}else{
    echo '<script>alert("添加数据成功！...返回系统首页")</script>';
    header("refresh:0, url=../admin/adminIndex.php");
}

?>