<?php

include "connectAdmin.php";
$name = $_GET['name'];
$phone = $_GET['phone'];
$location = $_GET['location'];
$house = $_GET['house'];
$content = $_GET['content'];
$href = $_GET['url'];
$IP = $_GET['IP'];
date_default_timezone_set('Asia/Shanghai');
$time =  date('Y-m-d H:i:s');
//  星期
$weekArray = array("日", "一", "二", "三", "四", "五", "六");
$week = $weekArray[date('w')];
echo '<br/>'.$week.'<br/>';
// 数据拦截验证
    // $name 为中文名称
if (preg_match("/^[\x80-\xff]{6,30}$/", $name)){
    $sql = "insert into user (name, phone, location, house, IP, href, time, content, week) value ('$name', '$phone', '$location', '$house', '$IP', '$href', '$time', '$content', '$week')";
    $query = mysqli_query($con, $sql);
    if(!$query){
        die('Error: ' . mysqli_error($con));
    }else{
        echo "提交成功";

        //  同时发送email到QQ邮箱
        $to = "4535292@qq.com";
        $subject = "新客户：".$name.' 手机号码:'.$phone;
        $message = "新客户：".$name."\n".'手机号码:'.$phone."\n".
            "客服访问地址： ".$href."\n".'客户所在地：'.$location.' 小区名字: '.$house."\n"."客户留言时间： ".$time;


//mail ($to, $subject , $message , $headers);

        if(mail($to, $subject, $message)){
            echo "Ok.";
        }else{
            echo "send mail fail.";
        };
        // 数据成功传输后  生成JS 关闭get请求页面
        echo "<script>window.close('sendInfo');</script>";

    }
}
mysqli_close($con);
?>