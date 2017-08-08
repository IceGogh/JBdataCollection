<?php

include '../connectAdmin.php';

$renew = "update user set location = '$_POST[location]' , weico = '$_POST[weico]' , house = '$_POST[house]' where id = $_POST[id]";
$query = mysqli_query($con, $renew);
if(!$query){
    echo mysqli_error($con);
    echo "<script>alert('修改失败')</script>";
}else{
    echo "<script>alert('修改成功')</script>";

}
header("refresh:0; url=updata.php?id=$_POST[id]");