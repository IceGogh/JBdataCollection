<?php
session_start();
include '../connectAdmin.php';

$name = $_POST['name'];
$customer = $_POST['customer'];
$phone = $_POST['phone'];
$location = $_POST['location'];
$house = $_POST['house'];
$href= '';
$time ='';
$dealer = $_POST['dealer'];
$renew = "update user set status = '$_POST[status]', infoFrom = '$_POST[from]', name = '$name', phone = '$phone', location = '$location' , consult = '$_POST[consult]', arrive = '$_POST[arrive]', customer = '$customer' , house = '$house', guide = '$_POST[guide]', dealer = '$dealer' where id = '$_POST[id]'";
$query = mysqli_query($con, $renew);
if(!$query){
    echo mysqli_error($con);
    echo "<script>alert('修改失败')</script>";

}else{
    echo "<script>alert('修改成功')</script>";
    // 判定是否为 肖右生组
    if($_SESSION['uid'] == 1000 ){
        // 是否为 曾漂亮
        if($customer == '曾漂亮'){
//            $to = "249390602@qq.com";
            include '../sendMail.php';


        }else if($customer == '涂品品'){
//            $to = "1016769871@qq.com";
            include '../sendMail.php';

        }else if($customer == '肖玉洁'){
//            $to = "497472544@qq.com";
            include '../sendMail.php';
        };

    // 判定是否为 柴慧组
    }else if($_SESSION['uid'] == 2000){
        if($customer == '谢蓉'){
//            $to = "971722844@qq.com";
            include '../sendMail.php';

        }else if($customer == '彭靖'){
//            $to = "2088826118@qq.com";
            include '../sendMail.php';

        }else if($customer == '黄丽'){
//            $to = "1219181721@qq.com";
            include '../sendMail.php';
        }
    }
}
header("refresh:0; url=updata.php?id=$_POST[id]");