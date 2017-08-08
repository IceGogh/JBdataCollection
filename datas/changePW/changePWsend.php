<?php
include "../connectAdmin.php";
echo $_GET['id'].'<br/>';
echo $_POST['oldPw'].'<br/>';
echo $_POST['newPw'].'<br/>';
echo $_POST['newPw2'].'<br/>';
$oldpw = "select password from adminuser where phone = '$_GET[id]'";
$query = mysqli_query($con, $oldpw);
$old =   mysqli_fetch_assoc($query)['password'];

if(!$query){
    echo "Error: ".mysqli_error($con);
    include "reloadPW.php";
}else{
    if($old != $_POST['oldPw']){
        echo '<script>alert("原密码错误!")</script>';
        include "reloadPW.php";
    }else{
        if( $_POST['newPw'] != $_POST['newPw2']){
            echo '<script>alert("请重新确认新密码两次一致!")</script>';
            include "reloadPW.php";
        }else{
            $change = "update adminuser set password = '$_POST[newPw]' where phone = $_GET[id]";
            $query = mysqli_query($con, $change);
            if(!$query){
                echo "Error: 修改密码失败.. 错误原因 ：".mysqli_error($con);
            }else{
                echo '<script>alert("修改密码成功,请重新登录系统!")</script>';
                include "../lgOut.php";
                header('refresh:0; url=../admin/checkIn.php');
            }
        }
    }
}
?>