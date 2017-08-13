<?php

include '../connectAdmin.php';

$name = $_POST['name'];
$customer = $_POST['customer'];
$phone = $_POST['phone'];
$location = $_POST['location'];
$house = $_POST['house'];
$href= '';
$time ='';
$dealer = $_POST['dealer'];
$renew = "update user set status = '$_POST[status]', infoFrom = '$_POST[from]', name = '$name', phone = '$phone', location = '$location' , weico = '$_POST[weico]', customer = '$customer' , house = '$house', guide = '$_POST[guide]', dealer = '$dealer' where id = '$_POST[id]'";
$query = mysqli_query($con, $renew);
if(!$query){
    echo mysqli_error($con);
    echo "<script>alert('修改失败')</script>";

}else{
    echo "<script>alert('修改成功')</script>";

    if($customer == '曾漂亮'){
        $to = "4535292@qq.com";
        include '../sendMail.php';

    }else if($customer == '涂品品'){
        $to = "250219627@qq.com";
        include '../sendMail.php';

    }else if($customer == '谢蓉'){
        $to = "250219627@qq.com";
        include '../sendMail.php';

    }



}
header("refresh:0; url=updata.php?id=$_POST[id]");