<?php
//echo $_POST['uid'].'<br/>';
//echo $_POST['location'];
//foreach ($_POST as $key => $val){
//    echo $key.': '.$val.'<br/>';
//}

include 'connectAdmin.php';

$renew = "update user set location = '$_POST[location]' where id = '$_POST[id]'";
$query = mysqli_query($con, $renew);
if(!$query){
    echo "<script>alert('修改失败')</script>";
}else{
    echo "<script>alert('修改成功')</script>";

}
header("refresh:0; updata.php?id=$_POST[id]");