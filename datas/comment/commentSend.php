<?php
include '../lgCheck.php';
include '../connectAdmin.php';
date_default_timezone_set("Asia/Shanghai");
$time = date("Y-h-d H:i:s");

// 新加 备注
$newCommentWords = '<p>'.$_POST['comment'].'</p>'.$time.' by: '.$_SESSION['name'].'<hr/>';
$oldComment = "select comment from user where id = $_GET[id]";
$result = mysqli_query($con, $oldComment);
$newCommentWords .= mysqli_fetch_assoc($result)['comment'];
echo $newCommentWords;
$addComment = "update user set comment = '$newCommentWords' where id = $_GET[id]";
$query = mysqli_query($con, $addComment);
if(!$query){
    echo "Error: 添加备注失败".mysqli_error($con);
}else{
    echo "<script>alert('添加成功!')</script>";
    //  中文转码 避免重载后的url乱码
    $encodeName = urlencode($_GET['name']);
    header("refresh:0; url=commentIndex.php?id=$_GET[id]&name=$encodeName");
}
?>