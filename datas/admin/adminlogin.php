<?php
session_start();
//header("Content-Type: text/html; charset=utf8");


include ('../connectAdmin.php');

$phone = $_POST['phone'];//post获得用户名
$password = $_POST['password'];//post获得用户密码单值
if($phone && $password){
    $sql = "select * from adminuser where phone = '$phone' and password = '$password'";

    $result = mysqli_query($con, $sql);


    if($rows = mysqli_num_rows($result)){

        $_SESSION['uid'] = $phone;
        $arr = mysqli_fetch_assoc($result);
        $_SESSION['power'] = $arr['power'];
        $_SESSION['name'] = $arr['name'];
        header("refresh:0; url=adminIndex.php");
        exit;
    }else{
        echo "用户名或密码错误";
//        session_destroy();
        echo "<script>alert('密码错误..跳转')</script>";
        header("refresh:0; url=checkIn.php");

        exit;
    };

}else{
    echo "表单填写不完整";
    header("refresh:0; url=checkIn.php");
    exit;
}
//mysqli_close($con);

?>
