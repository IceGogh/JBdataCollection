<?php
session_start();
include "../connectAdmin.php";
if(!$_POST['from'] || !$_POST['name'] || !$_POST['phone']){
    echo "<script>alert(\"请确认信息填写正确！\")</script>";
    header("refresh:0; addInfo.php?id=$_SESSION[uid]");
}else{
    date_default_timezone_set('Asia/Shanghai');
    $time = date('Y-m-d H:i:s');
    $weekArray = array("日", "一", "二", "三", "四", "五", "六");
    $week = $weekArray[date('w')];
    $team =  floor($_SESSION['uid']/10);

    $add = "insert into user (name, phone, location, house, time, status, infoFrom, team, week, weico, customer, guide) value ('$_POST[name]', '$_POST[phone]', '$_POST[city]', '$_POST[house]', '$time', '2' , '$_POST[from]', '$team', '$week', '$_POST[weico]', '$_SESSION[name]', '$_POST[guide]')";

    $query = mysqli_query($con, $add);
    if(!$query){
        echo "Error: ".mysqli_error($con);
    }else{
        echo '<script>alert("添加数据成功！...返回系统首页")</script>';
        header("refresh:0, url=../admin/adminIndex.php");
    }

}

?>